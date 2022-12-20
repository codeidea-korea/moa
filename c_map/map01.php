<?php
include_once("./_common.php");


//로직영역
$str = "샘플페이지가 정상적으로 나와라";
/*******************
 * 
 * 
 * 
 * 개발자가 처리할 영역
 */

//해시테그 클릭 시 화면 타이틀 재테크,예술,자기계발,다이어트 변경해야함

 //헤더영역(공통파일)
include_once(CLASS_PATH."/header.php");

$header_title = '위치';
//main head(공통파일)
include_once(CLASS_PATH."/head.php");

// $sql = "select moa_addr1, mb_id, as_thumb, wr_subject from g5_write_class where moa_addr1 != '' order by mb_id desc";
$today = date("Y-m-d", time());
$sql = "select class.*, item.day, shop.it_id from g5_write_class as class
            join g5_shop_item as shop on shop.it_2 = class.wr_id
            join deb_class_item as item on shop.it_id = item.it_id
		where class.moa_addr1 != '' 
		and class.moa_onoff = '오프라인' 
		and class.moa_status = 1 
		and item.day > '".$today."' ";
if ($_REQUEST['category_list'] != ""){
	$category_list = "'" . str_replace(",", "','", $_REQUEST['category_list']) . "'";
	$sql = $sql . " and class.ca_name in (".$category_list.")";
}

if ($_REQUEST['scal_date'] != ""){
	if (strpos($_REQUEST['scal_date'], '~') > -1){
		$arr_date = explode(' ~ ', $_REQUEST['scal_date']);
		$sql = $sql . " and item.day >= '".$arr_date[0]."' and item.day <= '".$arr_date[1]."'";
	}else{
		$sql = $sql . " and item.day >= '".$_REQUEST['scal_date']."'";
	}
}

$sql = $sql ." group by class.wr_id order by class.mb_id desc";
$query = sql_query($sql);

//contents 영역
include_once(MOA_MAP_SKIN."/map01.skin.php");


//푸터영역(공통파일)
include_once(CLASS_PATH."/footer.php");