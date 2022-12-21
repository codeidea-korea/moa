<?php
$sub_menu = '580220';
include_once('./_common.php');

auth_check($auth[$sub_menu], "r");

if( !isset($g5['new_win_table']) ){
    die('<meta charset="utf-8">/data/dbconfig.php 파일에 <strong>$g5[\'new_win_table\'] = G5_TABLE_PREFIX.\'new_win\';</strong> 를 추가해 주세요.');
}
//내용(컨텐츠)정보 테이블이 있는지 검사한다.
if(!sql_query(" DESCRIBE {$g5['new_win_table']} ", false)) {
    if(sql_query(" DESCRIBE {$g5['g5_shop_new_win_table']} ", false)) {
        sql_query(" ALTER TABLE {$g5['g5_shop_new_win_table']} RENAME TO `{$g5['new_win_table']}` ;", false);
    } else {
       $query_cp = sql_query(" CREATE TABLE IF NOT EXISTS `{$g5['new_win_table']}` (
                      `nw_id` int(11) NOT NULL AUTO_INCREMENT,
                      `nw_division` varchar(10) NOT NULL DEFAULT 'both',
                      `nw_device` varchar(10) NOT NULL DEFAULT 'both',
                      `nw_begin_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
                      `nw_end_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
                      `nw_disable_hours` int(11) NOT NULL DEFAULT '0',
                      `nw_left` int(11) NOT NULL DEFAULT '0',
                      `nw_top` int(11) NOT NULL DEFAULT '0',
                      `nw_height` int(11) NOT NULL DEFAULT '0',
                      `nw_width` int(11) NOT NULL DEFAULT '0',
                      `nw_subject` text NOT NULL,
                      `nw_content` text NOT NULL,
                      `nw_content_html` tinyint(4) NOT NULL DEFAULT '0',
                      PRIMARY KEY (`nw_id`)
                    ) ENGINE=MyISAM DEFAULT CHARSET=utf8 ", true);
    }
}

$g5['title'] = '팝업 관리';
include_once (G5_ADMIN_PATH.'/admin.head.php');

$sql_common = " from {$g5['new_win_table']} where (1)";
$sql_where = '';
if($_GET['stx'] != '') {
    $sql_where .= " and (nw_subject like '%{$stx}%' or nw_content like '%{$stx}%')";
}
if($_GET['r1'] && $_GET['r1'] != '전체') {
    $sql_where .= " and nw_r1 = '{$r1}'";
}

// 테이블의 전체 레코드수만 얻음
$sql = " select count(*) as cnt " . $sql_common . ' ' . $sql_where;
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$sql = "select * $sql_common $sql_where order by nw_id desc ";
$result = sql_query($sql);
?>

<div class="boxContainer">
	
	<p class="mb15">메인페이지에 노출될 배너를 설정 관리 합니다.</p>
	<form name="fsearch" id="fsearch" method="get">
	<div class="data-search-wrap fx-wrap label120 mb10">
		<div class="fx-list">
			<div class="fx-list-con">
				<div class="inline-flex mr50">
					<input type="radio" <?php echo $_GET['r1'] == '전체' ? 'checked' : '' ?> value="전체" name="r1" data-label="전체">
                    <input type="radio" <?php echo $_GET['r1'] == '대기' ? 'checked' : '' ?> value="대기" name="r1" data-label="대기">
					<input type="radio" <?php echo $_GET['r1'] == '진행' ? 'checked' : '' ?> value="진행" name="r1" data-label="진행">
					<input type="radio" <?php echo $_GET['r1'] == '종료' ? 'checked' : '' ?> value="종료" name="r1" data-label="종료">
				</div>
				<input type="text" name="stx" value="<?php echo $_GET['stx']; ?>" class="span250" placeholder="제목, 내용">
				<button type="submit" class="btnSearch">검색</button>
				<a href="#" class="btnReset">초기화</a>
			</div>
		</div>
	</div>
	</form>

	<div class="tbl-basic outline odd">
		<table>
		<caption><?php echo $g5['title']; ?> 목록</caption>
		<thead>
		<tr>
			<th scope="col">노출순위</th>
			<th scope="col">제목</th>
			<th scope="col">기간</th>
			<th scope="col">노출 기기</th>
			<th scope="col">순위조절</th>
			<th scope="col">관리</th>
		</tr>
		</thead>
		<tbody>
		<?php
		for ($i=0; $row=sql_fetch_array($result); $i++) {
			$bg = 'bg'.($i%2);

			switch($row['nw_device']) {
				case 'pc':
					$nw_device = 'PC';
					break;
				case 'mobile':
					$nw_device = '모바일';
					break;
				default:
					$nw_device = '모두';
					break;
			}
		?>
		<tr>
			<td><?php echo $row['nw_id']; ?></td>
            <td><a class="pop_btn" data-pop_id="<?php echo $row['nw_id']; ?>"><?php echo $row['nw_subject']; ?></a></td>
			<td><?php echo substr($row['nw_begin_time'],2,14); ?> ~ <?php echo substr($row['nw_end_time'],2,14); ?></td>
			<td><?php echo $nw_device ?></td><!-- [대기,진행,종료] -->
			<td>
				<div class="flex flex-center">
					<button type="button" class="order-up">위로</button>
					<button type="button" class="order-down">아래로</button>
				</div>
			</td>
			<td class="td_mng td_mng_m">
				<a href="./newwinform.php?w=u&amp;nw_id=<?php echo $row['nw_id']; ?>" class="btn btn_03"><span class="sound_only"><?php echo $row['nw_subject']; ?> </span>수정</a>
				<a href="./newwinformupdate.php?w=d&amp;nw_id=<?php echo $row['nw_id']; ?>" onclick="return delete_confirm(this);" class="btn btn_02"><span class="sound_only"><?php echo $row['nw_subject']; ?> </span>삭제</a>
			</td>
		</tr>
		<?php
		}

		if ($i == 0) {
			echo '<tr><td colspan="11" class="empty_table">자료가 한건도 없습니다.</td></tr>';
		}
		?>
		</tbody>
		</table>
	</div>

	<div class="btn_fixed_top ">
		<a href="./newwinform.php" class="btn btn_01">신규등록</a>
	</div>

	<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, "{$_SERVER['SCRIPT_NAME']}?$qstr&amp;page="); ?>

</div>
<div class="layer-popup" id="popup01">
    <div class="popContainer">
        <div class="pop-inner">
            <span class="pop-closer">팝업닫기</span>
            <header class="pop-header">

            </header>
            <div class="text_area pop_content">

            </div>
        </div>
    </div>

    <div class="pop-bg"></div>
</div>
<!--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
<!--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
<!--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->


<div class="local_ov01 local_ov none"><span class="btn_ov01"><span class="ov_txt">전체 </span><span class="ov_num">  <?php echo $total_count; ?>건</span></span></div>

<div class="tbl_head01 tbl_wrap none">
    <table>
    <caption><?php echo $g5['title']; ?> 목록</caption>
    <thead>
    <tr>
        <th scope="col">번호</th>
        <th scope="col">제목</th>
        <th scope="col">접속기기</th>
        <th scope="col">시작일시</th>
        <th scope="col">종료일시</th>
        <th scope="col">시간</th>
        <th scope="col">Left</th>
        <th scope="col">Top</th>
        <th scope="col">Width</th>
        <th scope="col">Height</th>
        <th scope="col">관리</th>
    </tr>
    </thead>
    <tbody>
    <?php
    for ($i=0; $row=sql_fetch_array($result); $i++) {
        $bg = 'bg'.($i%2);

        switch($row['nw_device']) {
            case 'pc':
                $nw_device = 'PC';
                break;
            case 'mobile':
                $nw_device = '모바일';
                break;
            default:
                $nw_device = '모두';
                break;
        }
    ?>
    <tr class="<?php echo $bg; ?>">
        <td class="td_num"><?php echo $row['nw_id']; ?></td>
        <td class="td_left"><?php echo $row['nw_subject']; ?></td>
        <td class="td_device"><?php echo $nw_device; ?></td>
        <td class="td_datetime"><?php echo substr($row['nw_begin_time'],2,14); ?></td>
        <td class="td_datetime"><?php echo substr($row['nw_end_time'],2,14); ?></td>
        <td class="td_num"><?php echo $row['nw_disable_hours']; ?>시간</td>
        <td class="td_num"><?php echo $row['nw_left']; ?>px</td>
        <td class="td_num"><?php echo $row['nw_top']; ?>px</td>
        <td class="td_num"><?php echo $row['nw_width']; ?>px</td>
        <td class="td_num"><?php echo $row['nw_height']; ?>px</td>
        <td class="td_mng td_mng_m">
            <a href="./newwinform.php?w=u&amp;nw_id=<?php echo $row['nw_id']; ?>" class="btn btn_03"><span class="sound_only"><?php echo $row['nw_subject']; ?> </span>수정</a>
            <a href="./newwinformupdate.php?w=d&amp;nw_id=<?php echo $row['nw_id']; ?>" onclick="return delete_confirm(this);" class="btn btn_02"><span class="sound_only"><?php echo $row['nw_subject']; ?> </span>삭제</a>
        </td>
    </tr>
    <?php
    }

    if ($i == 0) {
        echo '<tr><td colspan="11" class="empty_table">자료가 한건도 없습니다.</td></tr>';
    }
    ?>
    </tbody>
    </table>
</div>
<script>
    $('.pop_btn').click(function(){
        $('.pop-header').text('');
        $('.pop_content').children().remove();
        $.ajax({
            type: "POST",
            url: '/ajax/popContent.php',
            data: {'id': $(this).data('pop_id')},
            cache: false,
            async: false,
            dataType: "json",
            success: function (data) {
                $('.pop-header').text(data.nw_subject);
                $('.pop_content').append(data.nw_content);
                $('#popup01').addClass('open');
            }
        })
    })
</script>


<?php
include_once (G5_ADMIN_PATH.'/admin.tail.php');
?>
