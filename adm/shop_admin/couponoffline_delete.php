<?php
$sub_menu = '400820';
include_once('./_common.php');

check_demo();

auth_check($auth[$sub_menu], 'd');

check_admin_token();

$count = count($_POST['chk']);
if(!$count)
    alert('선택삭제 하실 항목을 하나이상 선택해 주세요.');

for ($i=0; $i<$count; $i++)
{
    // 실제 번호를 넘김
    $k = $_POST['chk'][$i];

    $sql = " delete from {$g5['g5_shop_coupon_offline_table']} where co_id = '{$_POST['co_id'][$k]}' ";
    $result = sql_query($sql);
    if ($result) {
		$sql = " delete from {$g5['g5_shop_coupon_table']} where co_id = '{$_POST['co_id'][$k]}' and mb_id = '' ";
		sql_query($sql);
    }
}

goto_url('./couponoffline.php?'.$qstr);
?>
