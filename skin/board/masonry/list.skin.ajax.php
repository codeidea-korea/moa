<?php
@include_once('../../../common.php');		// 테마의 스킨일때 common.php 의 위치
include_once(G5_LIB_PATH.'/thumbnail.lib.php');
include_once($board_skin_path.'/skin.lib.php');
		
if (!isset($page) || (isset($page) && $page == 0)) $page = 1;

$width = $board['bo_table_width'];
if ($width <= 100)
    $width .= '%';
else
    $width .='px';

// IP보이기 사용 여부
$ip = "";
$is_ip_view = $board['bo_use_ip_view'];
if ($is_admin) {
    $is_ip_view = true;
    if ($write && array_key_exists('wr_ip', $write)) {
        $ip = $write['wr_ip'];
    }
} else {
    // 관리자가 아니라면 IP 주소를 감춘후 보여줍니다.
    if (isset($write['wr_ip'])) {
        $ip = preg_replace("/([0-9]+).([0-9]+).([0-9]+).([0-9]+)/", G5_IP_DISPLAY, $write['wr_ip']);
    }
}

// 분류 사용
$is_category = false;
$category_name = '';
if ($board['bo_use_category']) {
    $is_category = true;
    if (array_key_exists('ca_name', $write)) {
        $category_name = $write['ca_name']; // 분류명
    }
}

// 추천 사용
$is_good = false;
if ($board['bo_use_good'])
    $is_good = true;

// 비추천 사용
$is_nogood = false;
if ($board['bo_use_nogood'])
    $is_nogood = true;

$admin_href = "";
// 최고관리자 또는 그룹관리자라면
if ($member['mb_id'] && ($is_admin === 'super' || $group['gr_admin'] === $member['mb_id']))
    $admin_href = G5_ADMIN_URL.'/board_form.php?w=u&amp;bo_table='.$bo_table;

//include_once(G5_BBS_PATH.'/board_head.php');

// 게시물 아이디가 있다면 게시물 보기를 INCLUDE
if (isset($wr_id) && $wr_id) {
    include_once(G5_BBS_PATH.'/view.php');
}

// 분류 사용 여부
$is_category = false;
$category_option = '';
if ($board['bo_use_category']) {
    $is_category = true;
    //$category_href = get_pretty_url($bo_table);
    $category_href = $bo_table;

    $category_option .= '<li><a href="'.$category_href.'"';
    if ($sca=='')
        $category_option .= ' id="bo_cate_on"';
    $category_option .= '>전체</a></li>';

    $categories = explode('|', $board['bo_category_list']); // 구분자가 , 로 되어 있음
    for ($i=0; $i<count($categories); $i++) {
        $category = trim($categories[$i]);
        if ($category=='') continue;
        //$category_option .= '<li><a href="'.(get_pretty_url($bo_table,'','sca='.urlencode($category))).'"';
        $category_option .= '<li><a href="'.G5_BBS_URL.'/board.php?bo_table=$bo_table&sca='.urlencode($category).'"';
        $category_msg = '';
        if ($category==$sca) { // 현재 선택된 카테고리라면
            $category_option .= ' id="bo_cate_on"';
            $category_msg = '<span class="sound_only">열린 분류 </span>';
        }
        $category_option .= '>'.$category_msg.$category.'</a></li>';
    }
}

$sop = strtolower($sop);
if ($sop != 'and' && $sop != 'or')
    $sop = 'and';

// 분류 선택 또는 검색어가 있다면
$stx = trim($stx);
//검색인지 아닌지 구분하는 변수 초기화
$is_search_bbs = false;

if ($sca || $stx || $stx === '0') {     //검색이면
    $is_search_bbs = true;      //검색구분변수 true 지정
    $sql_search = get_sql_search($sca, $sfl, $stx, $sop);

    // 가장 작은 번호를 얻어서 변수에 저장 (하단의 페이징에서 사용)
    $sql = " select MIN(wr_num) as min_wr_num from {$write_table} ";
    $row = sql_fetch($sql);
    $min_spt = (int)$row['min_wr_num'];

    if (!$spt) $spt = $min_spt;

    $sql_search .= " and (wr_num between {$spt} and ({$spt} + {$config['cf_search_part']})) ";

    // 원글만 얻는다. (코멘트의 내용도 검색하기 위함)
    // 라엘님 제안 코드로 대체 http://sir.kr/g5_bug/2922
    $sql = " SELECT COUNT(DISTINCT `wr_parent`) AS `cnt` FROM {$write_table} WHERE {$sql_search} ";
    $row = sql_fetch($sql);
    $total_count = $row['cnt'];
    /*
    $sql = " select distinct wr_parent from {$write_table} where {$sql_search} ";
    $result = sql_query($sql);
    $total_count = sql_num_rows($result);
    */
} else {
    $sql_search = "";

    $total_count = $board['bo_count_write'];
}

if(G5_IS_MOBILE) {
    $page_rows = $board['bo_mobile_page_rows'];
    $list_page_rows = $board['bo_mobile_page_rows'];
} else {
    $page_rows = $board['bo_page_rows'];
    $list_page_rows = $board['bo_page_rows'];
}

if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)

// 년도 2자리
$today2 = G5_TIME_YMD;

$list = array();
$i = 0;
$notice_count = 0;
$notice_array = array();

// 공지 처리
if (!$is_search_bbs) {
    $arr_notice = explode(',', trim($board['bo_notice']));
    $from_notice_idx = ($page - 1) * $page_rows;
    if($from_notice_idx < 0)
        $from_notice_idx = 0;
    $board_notice_count = count($arr_notice);

    for ($k=0; $k<$board_notice_count; $k++) {
        if (trim($arr_notice[$k]) == '') continue;

        $row = sql_fetch(" select * from {$write_table} where wr_id = '{$arr_notice[$k]}' ");

        if (!$row['wr_id']) continue;

        $notice_array[] = $row['wr_id'];

        if($k < $from_notice_idx) continue;

        $list[$i] = get_list($row, $board, $board_skin_url, G5_IS_MOBILE ? $board['bo_mobile_subject_len'] : $board['bo_subject_len']);
        $list[$i]['is_notice'] = true;

        $i++;
        $notice_count++;

        if($notice_count >= $list_page_rows)
            break;
    }
}

$total_page  = ceil($total_count / $page_rows);  // 전체 페이지 계산
$from_record = ($page - 1) * $page_rows; // 시작 열을 구함

// 공지글이 있으면 변수에 반영
if(!empty($notice_array)) {
    $from_record -= count($notice_array);

    if($from_record < 0)
        $from_record = 0;

    if($notice_count > 0)
        $page_rows -= $notice_count;

    if($page_rows < 0)
        $page_rows = $list_page_rows;
}

// 관리자라면 CheckBox 보임
$is_checkbox = false;
if ($is_member && ($is_admin == 'super' || $group['gr_admin'] == $member['mb_id'] || $board['bo_admin'] == $member['mb_id']))
    $is_checkbox = true;

// 정렬에 사용하는 QUERY_STRING
$qstr2 = 'bo_table='.$bo_table.'&amp;sop='.$sop;

// 0 으로 나눌시 오류를 방지하기 위하여 값이 없으면 1 로 설정
$bo_gallery_cols = $board['bo_gallery_cols'] ? $board['bo_gallery_cols'] : 1;
$td_width = (int)(100 / $bo_gallery_cols);

// 정렬
// 인덱스 필드가 아니면 정렬에 사용하지 않음
//if (!$sst || ($sst && !(strstr($sst, 'wr_id') || strstr($sst, "wr_datetime")))) {
if (!$sst) {
    if ($board['bo_sort_field']) {
        $sst = $board['bo_sort_field'];
    } else {
        $sst  = "wr_num, wr_reply";
        $sod = "";
    }
} else {
    // 게시물 리스트의 정렬 대상 필드가 아니라면 공백으로 (nasca 님 09.06.16)
    // 리스트에서 다른 필드로 정렬을 하려면 아래의 코드에 해당 필드를 추가하세요.
    // $sst = preg_match("/^(wr_subject|wr_datetime|wr_hit|wr_good|wr_nogood)$/i", $sst) ? $sst : "";
    $sst = preg_match("/^(wr_datetime|wr_hit|wr_good|wr_nogood)$/i", $sst) ? $sst : "";
}

if(!$sst)
    $sst  = "wr_num, wr_reply";

if ($sst) {
    $sql_order = " order by {$sst} {$sod} ";
}

if ($is_search_bbs) {
    $sql = " select distinct wr_parent from {$write_table} where {$sql_search} {$sql_order} limit {$from_record}, $page_rows ";
} else {
    $sql = " select * from {$write_table} where wr_is_comment = 0 ";
    if(!empty($notice_array))
        $sql .= " and wr_id not in (".implode(', ', $notice_array).") ";
    $sql .= " {$sql_order} limit {$from_record}, $page_rows ";
}

// 페이지의 공지개수가 목록수 보다 작을 때만 실행
if($page_rows > 0) {
    $result = sql_query($sql);

    $k = 0;

    while ($row = sql_fetch_array($result))
    {
        // 검색일 경우 wr_id만 얻었으므로 다시 한행을 얻는다
        if ($is_search_bbs)
            $row = sql_fetch(" select * from {$write_table} where wr_id = '{$row['wr_parent']}' ");

        $list[$i] = get_list($row, $board, $board_skin_url, G5_IS_MOBILE ? $board['bo_mobile_subject_len'] : $board['bo_subject_len']);
        if (strstr($sfl, 'subject')) {
            $list[$i]['subject'] = search_font($stx, $list[$i]['subject']);
        }
        $list[$i]['is_notice'] = false;
        $list_num = $total_count - ($page - 1) * $list_page_rows - $notice_count;
        $list[$i]['num'] = $list_num - $k;

        $i++;
        $k++;
    }
}
?>

<script type="text/javascript" src="<?php echo $board_skin_url;?>/dist/simple-lightbox.js"></script>
<link href='<?php echo $board_skin_url;?>/dist/simplelightbox.min.css' rel='stylesheet' type='text/css'>
<script>
    $(function(){
        var $gallery = $('.img a').simpleLightbox();

        $gallery.on('show.simplelightbox', function(){
            console.log('Requested for showing');
        })
        .on('shown.simplelightbox', function(){
            console.log('Shown');
        })
        .on('close.simplelightbox', function(){
            console.log('Requested for closing');
        })
        .on('closed.simplelightbox', function(){
            console.log('Closed');
        })
        .on('change.simplelightbox', function(){
            console.log('Requested for change');
        })
        .on('next.simplelightbox', function(){
            console.log('Requested for next');
        })
        .on('prev.simplelightbox', function(){
            console.log('Requested for prev');
        })
        .on('nextImageLoaded.simplelightbox', function(){
            console.log('Next image loaded');
        })
        .on('prevImageLoaded.simplelightbox', function(){
            console.log('Prev image loaded');
        })
        .on('changed.simplelightbox', function(){
            console.log('Image changed');
        })
        .on('nextDone.simplelightbox', function(){
            console.log('Image changed to next');
        })
        .on('prevDone.simplelightbox', function(){
            console.log('Image changed to prev');
        })
        .on('error.simplelightbox', function(e){
            console.log('No image found, go to the next/prev');
            console.log(e);
        });
    });
</script>

<?php 
for ($i=0; $i<count($list); $i++) {

	$classes = array();
	
	$classes[] = 'gw_gl_li';
	$classes[] = 'col-gn-'.$bo_gallery_cols;

	if( $wr_id && $wr_id == $list[$i]['wr_id'] ){
		$classes[] = 'gall_now';
	}

    $b_rand = rand(1,10);
    $bigstyle = "";
    if ($b_rand > 5) {
        $bigstyle=" class='big' ";
    }
?>
<li class="<?php echo implode(' ', $classes); ?> list-item" data-page="<?php echo $page; ?>">
	<div class="box list-item" data-num="<? echo $list[$i]['wr_id']; ?>">
		<div class="gall_chk chk_box">
			<?php if ($is_checkbox) { ?>
			<input type="checkbox" name="chk_wr_id[]" value="<?php echo $list[$i]['wr_id'] ?>" id="chk_wr_id_<?php echo $list[$i]['wr_id'] ?>" class="selec_chk">
			<label for="chk_wr_id_<?php echo $list[$i]['wr_id'] ?>">
				<span></span>
				<b class="sound_only"><?php echo $list[$i]['subject'] ?></b>
			</label>
			
			<?php } ?>
			<span class="sound_only">
				<?php
				if ($wr_id == $list[$i]['wr_id'])
					echo "<span class=\"bo_current\">열람중</span>";
				else
					echo $list[$i]['num'];
				 ?>
			</span>
		</div>
		<div class="con grid-item">
			<span class="more"><?php echo $event_str; ?></span>	
			<div class="img">
					<?php
                    
					$manImg = get_list_thumbnail2($board['bo_table'], $list[$i]['wr_id'], "1024", 0, false, true);?>

				<!--<a href="<?php echo $list[$i]['href'] ?>" >-->
                <a href="<?php echo $manImg['src'];?>" <?php echo $bigstyle; ?>>
					<!-- 썸네일 이미지 없을 때 -->
                    <?php
                    $thumb = get_list_thumbnail2($board['bo_table'], $list[$i]['wr_id'], $board['bo_gallery_width'], 0, false, true);
					if ($list[$i]['is_notice']) { // 공지사항
						if($thumb['src']) {
							$img_content = '<img src="'.$thumb['src'].'" alt="'.$thumb['alt'].'" >';
						} else {
							$img_content = '<div class="no_thumb"><i class="fa fa-bookmark"></i><span>공지</span></div>';
						}
					} else if ($list[$i]['icon_secret']) { // 비밀글
						$img_content = '<div class="no_thumb"><i class="fa fa-lock"></i><span>Secret</span></div>';
					} else {
						if($thumb['src']) {
							$img_content = '<img src="'.$thumb['src'].'" alt="'.$thumb['alt'].'" >';
						} else {
							$img_content = '<div class="no_thumb"><i class="fa fa-picture-o"></i><span>No Image</span></div>';
						}
					}

					echo $img_content;
					?>
				</a>
			</div>
			<div class="gal-info">
				<?php
				$mb = apms_member($list[$i]['mb_id']);
				?>
				<span>
					<figure class="avatar avatar-md">
						<img src="<?php echo $mb['photo'] ?>" alt="회원이미지">
					</figure>
						<?php //echo $list[$i]['name'];?>
						<?php echo $mb['name'];?>
				</span>
				
				<?php /*
				<div class="list-details font-12 text-muted">
					
					<span class="pull-left">
						<?php echo $list[$i]['subject'];?>
					</span>
					<div class="clearfix"></div>
				</div>
			*/ 	?>
			
			</div>
		</div>
	</div>
</li>
<?php } ?>
