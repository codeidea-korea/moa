<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가


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

$moa_status = '1';

$write_table = $g5['write_prefix'].$bo_table;
$sql = "UPDATE $write_table SET ";
$sql .= " moa_curriculum = '{$moa_curriculum}' ";
$sql .= " , moa_supplies = '{$moa_supplies}' ";
$sql .= " , moa_support = '{$moa_support}' ";
$sql .= " , moa_nosupport = '{$moa_nosupport}' ";
$sql .= " , moa_totime = '{$moa_totime}' ";
$sql .= " , moa_reglimittime = '{$moa_reglimittime}' ";
$sql .= " , moa_type = '{$moa_type}' ";
$sql .= " , moa_onoff = '{$moa_onoff}' ";
$sql .= " , moa_area1 = '{$moa_area1}' ";
$sql .= " , moa_area2 = '{$moa_area2}' ";
$sql .= " , moa_status = '{$moa_status}' ";
$sql .= " where wr_id = '{$wr_id}' ";

sql_query($sql);