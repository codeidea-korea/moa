<?php
include_once('./_common.php');

if($is_guest) { 
	alert('파트너만 이용가능합니다.', $prev_url);
}

if (get_session('pp_payment_id') != $member['mb_id']) {
	alert("직접 링크로는 등록이 불가합니다.\\n\\n출금신청 화면을 통하여 이용하시기 바랍니다.", $prev_url);
}

$prev_url = '/shop/partner/?ap=payrequest';
include_once(G5_LIB_PATH.'/apms.account.lib.php');

// APMS Config
$partner = array();
$account = array();
$list = array();
$partner = apms_partner($member['mb_id']);
//var_dump($partner);

if($partner['pt_id']) { //파트너 정보가 있으면
	if(!$partner['pt_register']) { // 등록심사중이면
		alert('회원님은 현재 등록심사 중입니다.', $prev_url);
	}
	if($partner['pt_leave']) { // 탈퇴한 회원이면
		alert('회원님은 파트너에서 탈퇴하셨습니다.\\n\\n재등록을 원하시면 관리자에게 문의바랍니다.', $prev_url);
	}
	if(!$partner['pt_partner'] && !$partner['pt_marketer']) { // 권한해제 회원이면
		alert('회원님은 파트너 권한이 해제된 상태입니다.\\n\\n권한 재등록을 원하시면 관리자에게 문의바랍니다.', $prev_url);
	}
} else {
	alert('등록된 파트너만 이용가능합니다.', $prev_url);
}

if($partner['pt_bank_limit']) {
	alert('회원님은 현재 출금신청이 제한된 상태입니다.', $prev_url);
}

if(!$partner['pt_company']) {
	alert('정산정보의 미등록으로 현재 출금신청이 제한된 상태입니다.', $prev_url);
}

//계정현황
$pp_field = 0; // 호스트, 마케터:1

if ($_POST['pp_type'] == "1"){
	$pp_jumin = $_POST['co_num1'] . "-" . $_POST['co_num2'] . "-" . $_POST['co_num3'];
}else{
	$pp_jumin = $_POST['jumin1'] . "-" . $_POST['jumin2'];
}

$sql = " insert into {$g5['apms_payment']}
			set mb_id = '{$member['mb_id']}',
				 pp_company = '{$partner['pt_company']}',
				 pp_type = '{".$_POST['pp_type']."',
				 pp_means = '".$_POST['pp_means']."',
				 pp_flag = '{$partner['pt_flag']}',
				 pp_field = '".$pp_field."',
				 pp_amount = '".$_POST['pp_amount']."',
				 pp_datetime = '".G5_TIME_YMDHIS."',
				 pp_ip = '{$_SERVER['REMOTE_ADDR']}',
				 pp_name = '".$_POST['pp_name']."',
				 pp_jumin = '".$pp_jumin."',
				 pp_od_ids = '".$_POST['od_id_list']."',
				 pp_memo = '$pp_memo' ";
sql_query($sql);
$new_pp_id = sql_insert_id();

// 주문정보에서 정산신청 상태값 변경한다. 
$strSql = "update g5_shop_order set calculate_status='1', calculate_pp_id=".$new_pp_id." where od_id in (".$_POST['od_id_list'].")";
sql_query($strSql);

//신청완료
alert('출금신청을 하였습니다.', $prev_url)

?>