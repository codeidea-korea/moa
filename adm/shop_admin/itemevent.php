<?php
$sub_menu = '580110';
include_once('./_common.php');

auth_check($auth[$sub_menu], "r");

$g5['title'] = '이벤트관리';
include_once (G5_ADMIN_PATH.'/admin.head.php');

// APMS 불러오기
include_once(G5_ADMIN_PATH.'/apms_admin/config/ev_type.php');

$sql_common = " from {$g5['g5_shop_event_table']} ";

// 테이블의 전체 레코드수만 얻음
$sql = " select count(*) as cnt " . $sql_common;
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$sql = "select * $sql_common order by ev_id desc ";
$result = sql_query($sql);
?>

<div class="boxContainer">

	<form name="" action="" method="post">
	<div class="data-search-wrap fx-wrap label120 mb10">
		<div class="fx-list">
			<div class="fx-list-con">
				<input type="text" name="" value="" class="span250" placeholder="제목, 내용">
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
			<th scope="col">대표이미지</th>
			<th scope="col">제목</th>
			<th scope="col">시작일</th>
			<th scope="col">종료일</th>
			<th scope="col">진행상황</th>
			<th scope="col">관리</th>
		</tr>
		</thead>
		<tbody>
		<?php
		for ($i=0; $row=sql_fetch_array($result); $i++) {

			$href = "";
			$sql = " select count(ev_id) as cnt from {$g5['g5_shop_event_item_table']} where ev_id = '{$row['ev_id']}' ";
			$ev = sql_fetch($sql);
			if ($ev['cnt']) {
				$href = '<a href="javascript:;" onclick="itemeventwin('.$row['ev_id'].');">';
				$href_close = '</a>';
			}
			if ($row['ev_subject_strong']) $subject = '<strong>'.$row['ev_subject'].'</strong>';
			else $subject = $row['ev_subject'];

			$t = $row['ev_type'];
			$type = ($ev_type[$t]) ? ' - '.$ev_type[$t] : '';
			
			//(김과장) 이미지 확인차 임시 추가..
			$mimg_str = "";
			$mimg = G5_DATA_PATH.'/event/'.$row['ev_id'].'_m';
			if (file_exists($mimg)) {				
				$mimg_str = '<img src="'.G5_DATA_URL.'/event/'.$row['ev_id'].'_m" style="max-width:150px" alt="">';
			}
		?>
		<tr>
			<td style="width:200px"><?php echo $mimg_str; ?></td>
			<td class="td_left"><?php echo $subject; ?><span style="color:#888;"><?php echo $type;?></span></td>
			<td class="">2022.03.14 13:22:40</td>
			<td class="">2022.03.14 13:22:40</td>
			<td class="">이벤트 예정</td>
			<td class="td_mng td_mng_l">
				<a href="./itemeventform.php?w=u&amp;ev_id=<?php echo $row['ev_id']; ?>" class="btn btn_03">수정</a>
				<a href="<?php echo G5_SHOP_URL; ?>/event.php?ev_id=<?php echo $row['ev_id']; ?>" class="btn btn_02">보기</a>
				<a href="./itemeventformupdate.php?w=d&amp;ev_id=<?php echo $row['ev_id']; ?>" onclick="return delete_confirm(this);" class="btn btn_02">삭제</a>
			</td>
		</tr>

		<?php
		}

		if ($i == 0) {
			echo '<tr><td colspan="5" class="empty_table">자료가 없습니다.</td></tr>';
		}
		?>
		</tbody>
		</table>
	</div>

	<div class="btn_fixed_top">
		<a href="./itemeventform.php" class="btn btn_01">이벤트 추가</a>
	</div>

</div>

<!--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
<!--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
<!--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->

<div class="local_ov01 local_ov none">
	<span class="btn_ov01"><span class="ov_txt">전체 이벤트</span><span class="ov_num"> <?php echo $total_count; ?>건</span></span>  
</div>

<div class="tbl-basic outline odd none">
    <table>
    <caption><?php echo $g5['title']; ?> 목록</caption>
    <thead>
    <tr>
        <th scope="col">이벤트번호</th>
		<th scope="col">제목</th>
        <th scope="col">연결상품</th>
        <th scope="col">사용</th>
        <th scope="col">관리</th>
    </tr>
    </thead>
    <tbody>
    <?php
    for ($i=0; $row=sql_fetch_array($result); $i++) {

        $href = "";
        $sql = " select count(ev_id) as cnt from {$g5['g5_shop_event_item_table']} where ev_id = '{$row['ev_id']}' ";
        $ev = sql_fetch($sql);
        if ($ev['cnt']) {
            $href = '<a href="javascript:;" onclick="itemeventwin('.$row['ev_id'].');">';
            $href_close = '</a>';
        }
        if ($row['ev_subject_strong']) $subject = '<strong>'.$row['ev_subject'].'</strong>';
        else $subject = $row['ev_subject'];

		$t = $row['ev_type'];
		$type = ($ev_type[$t]) ? ' - '.$ev_type[$t] : '';
	?>
    <tr>
        <td class="td_num"><?php echo $row['ev_id']; ?></td>
        <td class="td_left"><?php echo $subject; ?><span style="color:#888;"><?php echo $type;?></span></td>
        <td class="td_num"><?php echo $href; ?><?php echo $ev['cnt']; ?><?php echo $href_close; ?></td>
        <td class="td_boolean"><?php echo $row['ev_use'] ? '<span class="txt_true">예</span>' : '<span class="txt_false">아니오</span>'; ?></td>
        <td class="td_mng td_mng_l">
            <a href="./itemeventform.php?w=u&amp;ev_id=<?php echo $row['ev_id']; ?>" class="btn btn_03">수정</a>
            <a href="<?php echo G5_SHOP_URL; ?>/event.php?ev_id=<?php echo $row['ev_id']; ?>" class="btn btn_02">보기</a>
            <a href="./itemeventformupdate.php?w=d&amp;ev_id=<?php echo $row['ev_id']; ?>" onclick="return delete_confirm(this);" class="btn btn_02">삭제</a>
        </td>
    </tr>

    <?php
    }

    if ($i == 0) {
        echo '<tr><td colspan="5" class="empty_table">자료가 없습니다.</td></tr>';
    }
    ?>
    </tbody>
    </table>
</div>


<script>
function itemeventwin(ev_id)
{
    window.open("./itemeventwin.php?ev_id="+ev_id, "itemeventwin", "left=10,top=10,width=500,height=600,scrollbars=1");
}
</script>

<?php
include_once (G5_ADMIN_PATH.'/admin.tail.php');
?>
