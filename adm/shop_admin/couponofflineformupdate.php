<?php
$sub_menu = '400810';
include_once('./_common.php');

auth_check($auth[$sub_menu], "w");

check_admin_token();

@mkdir(G5_DATA_PATH."/coupon", G5_DIR_PERMISSION);
@chmod(G5_DATA_PATH."/coupon", G5_DIR_PERMISSION);

$_POST = array_map('trim', $_POST);

if(!$_POST['co_subject'])
    alert('쿠폰이름을 입력해 주십시오.');

if(!$_POST['co_start'] || ($_POST['co_end'] != 0 && $_POST['co_end'] == ''))
    alert('발급 시작일과 종료일을 입력해 주십시오.');

if($_POST['co_end'] != 0 && $_POST['co_start'] > $_POST['co_end'])
    alert('발급 시작일은 종료일 이전으로 입력해 주십시오.');

if($_POST['co_end'] != 0 && $_POST['co_end'] < G5_TIME_YMD)
    alert('종료일은 오늘('.G5_TIME_YMD.')이후로 입력해 주십시오.');

if($_POST['co_method'] == 0 && !$_POST['co_target'])
    alert('적용상품을 입력해 주십시오.');

if($_POST['co_method'] == 1 && !$_POST['co_target'])
    alert('적용분류를 입력해 주십시오.');

if(!$_POST['co_price']) {
    if($_POST['co_type'])
        alert('할인비율을 입력해 주십시오.');
    else
        alert('할인금액을 입력해 주십시오.');
}

if($_POST['co_type'] && ($_POST['co_price'] < 1 || $_POST['co_price'] > 100))
    alert('할인비율을은 1과 100사이 값으로 입력해 주십시오.');

if($_POST['co_method'] == 0) {
    $sql = " select count(*) as cnt from {$g5['g5_shop_item_table']} where it_id = '$co_target' and it_nocoupon = '0' ";
    $row = sql_fetch($sql);
    if(!$row['cnt'])
        alert('입력하신 상품코드는 존재하지 않는 코드이거나 쿠폰적용안함으로 설정된 상품입니다.');
} else if($_POST['co_method'] == 1) {
    $sql = " select count(*) as cnt from {$g5['g5_shop_category_table']} where ca_id = '$co_target' and ca_nocoupon = '0' ";
    $row = sql_fetch($sql);
    if(!$row['cnt'])
        alert('입력하신 분류코드는 존재하지 않는 분류코드이거나 쿠폰적용안함으로 설정된 분류입니다.');
}

if ($_POST['co_number'] <= 0) {
	alert('입력하신 생성 쿠폰 수가 1이상 되어야 합니다.');
}


$sql_common = " co_subject  = '{$_POST['co_subject']}',
                co_start    = '{$_POST['co_start']}',
                co_end      = '{$_POST['co_end']}',
                co_period   = '{$_POST['co_period']}',
                co_method   = '{$_POST['co_method']}',
                co_target   = '{$_POST['co_target']}',
                co_price    = '{$_POST['co_price']}',
                co_type     = '{$_POST['co_type']}',
                co_trunc    = '{$_POST['co_trunc']}',
                co_minimum  = '{$_POST['co_minimum']}',
                co_maximum  = '{$_POST['co_maximum']}',
                co_number	= '{$_POST['co_number']}' ";

if($w == '') {

    $sql = " INSERT INTO {$g5['g5_shop_coupon_offline_table']}
                set $sql_common,
                    co_datetime = '".G5_TIME_YMDHIS."' ";
    sql_query($sql, true);

    $co_id = sql_insert_id();
	
	
	$coupon_ids = array();
	for ($i = 0; $i < $_POST['co_number']; $i++) {
		$j = 0;
	    do {
	        $cp_id = get_coupon_id();
	
	        $sql3 = " select count(*) as cnt from {$g5['g5_shop_coupon_table']} where cp_id = '$cp_id' ";
	        $row3 = sql_fetch($sql3);
	
	        if(!$row3['cnt'])
	            break;
	        else {
	            if($j > 100)
	                die('Coupon ID Error');
	        }
	    } while(1);
	    
	    $sql = " INSERT INTO {$g5['g5_shop_coupon_table']}
	                ( cp_id, co_id, cp_subject, cp_method, cp_target, cp_start, cp_end, cp_type, cp_price, cp_trunc, cp_minimum, cp_maximum, cp_datetime )
	            VALUES
	                ( '$cp_id', '$co_id', '$co_subject', '$co_method', '$co_target', '$co_start', '9999-12-31', '$co_type', '$co_price', '$co_trunc', '$co_minimum', '$co_maximum', '".G5_TIME_YMDHIS."' ) ";
	    sql_query($sql);
    }
    
}

goto_url('./couponoffline.php?'.$qstr);
?>