<?php
$sub_menu = "300900";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'w');

check_admin_token();

$type_id = $_POST['type_id'];
$type_name = $_POST['type_name'];
$type_order = $_POST['type_order'];
$type_desc = $_POST['type_desc'];


$codes = sql_fetch("select count(*) cnt from {$g5['common_type_table']} where type_id = '{$type_id}' ");

if (!$codes['cnt'])  {
    if ($w == '') {
        $sql = "INSERT into ";
        $sql_add = "";
    }
    else {
        $sql = "UPDATE ";
        $sql_add = " where type_id = '{$type_id}' ";
    }
    $sql .= " {$g5['common_type_table']} SET
            regdate = now(),
            reg_mb_id ='{$member['mb_id']}', ";
    $sql .= " type_id= '{$type_id}', ";
    $sql .= " type_name= '{$type_name}', ";
    if ($type_order) $sql .= " type_order= '{$type_order}', ";
    $sql .= " type_desc= '{$type_desc}' ";
    $sql .= $sql_add;
    
    //echo nl2br($sql)."<BR>"; exit;
    sql_query($sql);
}

//exit;
goto_url('./common_type_list.php?'.$qstr);
?>
