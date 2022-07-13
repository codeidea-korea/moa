<?php
$sub_menu = '580410';
include_once('./_common.php');

auth_check($auth[$sub_menu], "r");

$g5['title'] = '리뷰관리';
include_once (G5_ADMIN_PATH.'/admin.head.php');

$where = " where ";
$sql_search = "";
if ($stx != "") {
    if ($sfl != "") {
        $sql_search .= " $where $sfl like '%$stx%' ";
        $where = " and ";
    }
    if ($save_stx != $stx)
        $page = 1;
}

if ($sca != "" && $sca != '전체') {
    $sql_search .= " and d.ca_name = '$sca' ";
}

if ($sfl == "")  $sfl = "a.it_name";
if (!$sst) {
    $sst = "is_id";
    $sod = "desc";
}

$sql_common = "  from {$g5['g5_shop_item_use_table']} a
                 join {$g5['g5_shop_item_table']} b on (a.it_id = b.it_id)
                 join {$g5['member_table']} c on (a.mb_id = c.mb_id)
                 join g5_write_class d on (c.mb_id = d.mb_id) ";
$sql_common .= $sql_search;

// 테이블의 전체 레코드수만 얻음
$sql = " select count(*) as cnt " . $sql_common;
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sql  = " select *
          $sql_common
          order by $sst $sod, is_id desc
          limit $from_record, $rows ";
echo $sql;
$result = sql_query($sql);

//$qstr = 'page='.$page.'&amp;sst='.$sst.'&amp;sod='.$sod.'&amp;stx='.$stx;
$qstr .= ($qstr ? '&amp;' : '').'sca='.$sca.'&amp;save_stx='.$stx;

$listall = '<a href="'.$_SERVER['SCRIPT_NAME'].'" class="ov_listall">전체목록</a>';
?>

<div class="boxContainer">

<div class="local_ov01 local_ov none">
    <?php echo $listall; ?>
    <span class="btn_ov01"><span class="ov_txt"> 전체 후기내역</span><span class="ov_num">  <?php echo $total_count; ?>건</span></span>
</div>


<form name="flist" class="local_sch01 local_sch">
<input type="hidden" name="page" value="<?php echo $page; ?>">
<input type="hidden" name="save_stx" value="<?php echo $stx; ?>">
<div class="data-search-wrap fx-wrap label120 mb10">
	<div class="fx-list">
		<div class="fx-list-con">
			<select name="sca" id="sca">
				<option value=''>전체분류</option>
				<?php
				$sql1 = " select ca_id, ca_name, as_line from {$g5['g5_shop_category_table']} order by ca_order, ca_id ";
				$result1 = sql_query($sql1);
				for ($i=0; $row1=sql_fetch_array($result1); $i++) {
					$len = strlen($row1['ca_id']) / 2 - 1;
					$nbsp = "";
					for ($i=0; $i<$len; $i++) $nbsp .= "&nbsp;&nbsp;&nbsp;";
					if($row1['as_line']) {
						echo "<option value=\"\">".$nbsp."------------</option>\n";
					}
					$selected = ($row1['ca_name'] == $sca) ? ' selected="selected"' : '';
					echo '<option value="'.$row1['ca_name'].'"'.$selected.'>'.$nbsp.$row1['ca_name'].'</option>'.PHP_EOL;
				}
				?>
			</select>
			<select name="sfl" id="sfl">
				<option value="it_name" <?php echo get_selected($sfl, 'it_name'); ?>>상품명</option>
				<option value="a.it_id" <?php echo get_selected($sfl, 'a.it_id'); ?>>상품코드</option>
				<option value="is_name" <?php echo get_selected($sfl, 'is_name'); ?>>이름</option>
				<?php if(USE_PARTNER) { ?>
					<option value="pt_id" <?php echo get_selected($sfl, 'a.pt_id'); ?>>파트너 아이디</option>
				<?php } ?>
			</select>
			<input type="text" name="stx" id="stx" value="<?php echo $stx; ?>" class="span300" placeholder="검색어">
			<button type="submit" class="btnSearch">검색</button>
			<button type="button" class="btnReset">초기화</button>
		</div>
	</div>
</div>
</form>

<form name="fitemuselist" method="post" action="./itemuselistupdate.php" onsubmit="return fitemuselist_submit(this);" autocomplete="off">
<input type="hidden" name="sca" value="<?php echo $sca; ?>">
<input type="hidden" name="sst" value="<?php echo $sst; ?>">
<input type="hidden" name="sod" value="<?php echo $sod; ?>">
<input type="hidden" name="sfl" value="<?php echo $sfl; ?>">
<input type="hidden" name="stx" value="<?php echo $stx; ?>">
<input type="hidden" name="page" value="<?php echo $page; ?>">

<div class="tbl-basic fs14 outline odd line-nth-1" id="itemuselist">
    <table>
    <caption><?php echo $g5['title']; ?> 목록</caption>
    <thead>
    <tr>
        <th scope="col">
            <label for="chkall" class="sound_only">사용후기 전체</label>
            <input type="checkbox" name="chkall" value="1" id="chkall" onclick="check_all(this.form)">
        </th>
        <th scope="col"><?php echo subject_sort_link("it_id"); ?><!--상품코드-->모임 ID</a></th>
		<th scope="col"><?php echo subject_sort_link("it_name"); ?><!--상품명-->모임명</a></th>
		<th scope="col"><?php echo subject_sort_link("is_subject"); ?>제목</a></th>
        <th scope="col"><?php echo subject_sort_link("mb_name"); ?>작성자</a></th>
		<th scope="col">작성일</th>
		<th scope="col">포인트지급</th>
		<th scope="col">조회수</th>
        <th scope="col"><?php echo subject_sort_link("is_score"); ?>별점</a></th>
        <th scope="col"><?php echo subject_sort_link("is_reply_subject"); ?>답변</a></th>
		<?php if(USE_PARTNER) { ?>
	        <th scope="col"><?php echo subject_sort_link("a.pt_id"); ?>파트너</a></th>
		<?php } ?>
		<th scope="col"><?php echo subject_sort_link("is_confirm"); ?>확인</a></th>
        <th scope="col">관리</th>
    </tr>
    </thead>
    <tbody>
    <?php
    for ($i=0; $row=sql_fetch_array($result); $i++) {
        $href = G5_SHOP_URL.'/item.php?it_id='.$row['it_id'];
//        $name = get_sideview($row['mb_id'], get_text($row['is_name']), $row['mb_email'], $row['mb_homepage']);
        $is_content = get_view_thumbnail(conv_content($row['is_content'], 1), 300);

        $bg = 'bg'.($i%2);
    ?>

    <tr class="<?php echo $bg; ?>">
        <td class="td_chk">
            <label for="chk_<?php echo $i; ?>" class="sound_only"><?php echo get_text($row['is_subject']) ?> 사용후기</label>
            <input type="checkbox" name="chk[]" value="<?php echo $i ?>" id="chk_<?php echo $i; ?>">
            <input type="hidden" name="is_id[<?php echo $i; ?>]" value="<?php echo $row['is_id']; ?>">
            <input type="hidden" name="it_id[<?php echo $i; ?>]" value="<?php echo $row['it_id']; ?>">
        </td>
        <td class="td_code" style="white-space:nowrap;">
			<div style="font-size:11px; letter-spacing:-1px;"><?php echo apms_pt_it($row['pt_it'],1);?></div>
			<b><?php echo $row['it_id']; ?></b>
        </td>
        <td class="td_left"><a href="<?php echo $href; ?>"><?php echo get_it_image($row['it_id'], 50, 50); ?>&nbsp;&nbsp;<?php echo cut_str($row['it_name'],30); ?></a></td>        
        <td class="sit_use_subject td_left">
            <a href="#" class="use_href" onclick="return false;" target="<?php echo $i; ?>"><?php echo get_text($row['is_subject']); ?><span class="tit_op">열기</span></a>
            <div id="use_div<?php echo $i; ?>" class="use_div" style="display:none;">
                <?php echo $is_content; ?>
            </div>
		</td>
		<td class="td_name"><?php echo get_text($row['is_name']); ?></td>
		<td><?php echo date('Y-m-d H:i', strtotime($row['is_time'])); ?></td>
		<td>200p</td>
		<td>12</td>
        <td class="td_select">
            <label for="score_<?php echo $i; ?>" class="sound_only">평점</label>
            <select name="is_score[<?php echo $i; ?>]" id="score_<?php echo $i; ?>">
            <option value="5" <?php echo get_selected($row['is_score'], "5"); ?>>5</option>
            <option value="4" <?php echo get_selected($row['is_score'], "4"); ?>>4</option>
            <option value="3" <?php echo get_selected($row['is_score'], "3"); ?>>3</option>
            <option value="2" <?php echo get_selected($row['is_score'], "2"); ?>>2</option>
            <option value="1" <?php echo get_selected($row['is_score'], "1"); ?>>1</option>
            </select>
        </td>		
        <td class="td_num"><?php echo (!empty($row['is_reply_content'])) ? '등록' : '';?></td>
		<?php if(USE_PARTNER) { ?>
	        <td class="td_code"><?php echo ($row['pt_id']) ? $row['pt_id'] : '-';?></td>
		<?php } ?>
        <td class="td_chk2">
            <label for="confirm_<?php echo $i; ?>" class="sound_only">확인</label>
            <input type="checkbox" name="is_confirm[<?php echo $i; ?>]" <?php echo ($row['is_confirm'] ? 'checked' : ''); ?> value="1" id="confirm_<?php echo $i; ?>">
        </td>
        <td class="td_mng td_mng_s">
            <a href="./itemuseform.php?w=u&amp;is_id=<?php echo $row['is_id']; ?>&amp;<?php echo $qstr; ?>" class="btn btn_03"><span class="sound_only"><?php echo get_text($row['is_subject']); ?> </span>수정</a>
        </td>
    </tr>

    <?php
    }

    if ($i == 0) {
		$colspan = (USE_PARTNER) ? 10 : 9;
        echo '<tr><td colspan="'.$colspan.'" class="empty_table"><span>자료가 없습니다.</span></td></tr>';
    }
    ?>
    </tbody>
    </table>
</div>

<div class="btn_list01 btn_list">
    <input type="submit" name="act_button" value="선택수정" onclick="document.pressed=this.value" class="btn btn_02">
    <input type="submit" name="act_button" value="선택삭제" onclick="document.pressed=this.value" class="btn btn_02">
</div>
</form>

<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, "{$_SERVER['SCRIPT_NAME']}?$qstr&amp;page="); ?>

</div>

<script>
function fitemuselist_submit(f)
{
    if (!is_checked("chk[]")) {
        alert(document.pressed+" 하실 항목을 하나 이상 선택하세요.");
        return false;
    }

    if(document.pressed == "선택삭제") {
        if(!confirm("선택한 자료를 정말 삭제하시겠습니까?")) {
            return false;
        }
    }

    return true;
}

$(function(){
    $(".btnReset").click(function(){
        $("select").val('default');
        $("select").selectpicker("refresh");
        $('input[name="stx"]').val('');
    })
    $(".use_href").click(function(){
        var $content = $("#use_div"+$(this).attr("target"));
        $(".use_div").each(function(index, value){
            if ($(this).get(0) == $content.get(0)) { // 객체의 비교시 .get(0) 를 사용한다.
                $(this).is(":hidden") ? $(this).show() : $(this).hide();
            } else {
                $(this).hide();
            }
        });
    });
});
</script>

<?php
include_once (G5_ADMIN_PATH.'/admin.tail.php');
?>
