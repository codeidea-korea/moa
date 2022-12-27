<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

/** 
 * $write_prefix : g5_write
 * $bo_table : class
 * $write_table : g5_write_class
*/


$moa_curriculum = isset($_POST['moa_curriculum'])?$_POST['moa_curriculum']:"";
$moa_supplies = isset($_POST['moa_supplies'])?$_POST['moa_supplies']:"";
$moa_support = isset($_POST['moa_support'])?$_POST['moa_support']:"";
$moa_nosupport = isset($_POST['moa_nosupport'])?$_POST['moa_nosupport']:"";
$moa_onoff = isset($_POST['moa_onoff'])?$_POST['moa_onoff']:"";
$moa_area1 = isset($_POST['moa_area1'])?$_POST['moa_area1']:"";
$moa_area2 = isset($_POST['moa_area2'])?$_POST['moa_area2']:"";
$moa_totime = isset($_POST['moa_totime'])?$_POST['moa_totime']:"";
$moa_reglimittime = isset($_POST['moa_reglimittime'])?$_POST['moa_reglimittime']:"";
$moa_type = isset($_POST['moa_type'])?$_POST['moa_type']:"";
$moa_form = isset($_POST['moa_form'])?$_POST['moa_form']:"";
$moa_addr1 = isset($_POST['moa_addr1'])?$_POST['moa_addr1']:"";
$moa_addr2 = isset($_POST['moa_addr2'])?$_POST['moa_addr2']:"";
$moa_addr_ext = isset($_POST['moa_addr_ext'])?$_POST['moa_addr_ext']:"";
$moa_latitude = isset($_POST['moa_latitude'])?$_POST['moa_latitude']:"";
$moa_longitude = isset($_POST['moa_longitude'])?$_POST['moa_longitude']:"";
$moa_zipcode = isset($_POST['moa_zipcode'])?$_POST['moa_zipcode']:"";
$moa_status = isset($_POST['moa_status'])?$_POST['moa_status']:"0";


$write_table = $g5['write_prefix'].$bo_table;
$sql = "UPDATE $write_table SET ";
$sql .= " moa_curriculum = '{$moa_curriculum}' ";
$sql .= " , moa_supplies = '{$moa_supplies}' ";
$sql .= " , moa_support = '{$moa_support}' ";
$sql .= " , moa_nosupport = '{$moa_nosupport}' ";
$sql .= " , moa_totime = '{$moa_totime}' ";
$sql .= " , moa_reglimittime = '{$moa_reglimittime}' ";
$sql .= " , moa_type = '{$moa_type}' ";
$sql .= " , moa_form = '{$moa_form}' ";
$sql .= " , moa_addr1 = '{$moa_addr1}' ";
$sql .= " , moa_addr2 = '{$moa_addr2}' ";
$sql .= " , moa_addr_ext = '{$moa_addr_ext}' ";
$sql .= " , moa_latitude = '{$moa_latitude}' ";
$sql .= " , moa_longitude = '{$moa_longitude}' ";
$sql .= " , moa_zipcode = '{$moa_zipcode}' ";
$sql .= " , moa_onoff = '{$moa_onoff}' ";
$sql .= " , moa_area1 = '{$moa_area1}' ";
$sql .= " , moa_area2 = '{$moa_area2}' ";
$sql .= " , moa_status = '{$moa_status}' ";
$sql .= " where wr_id = '{$wr_id}' ";

sql_query($sql);