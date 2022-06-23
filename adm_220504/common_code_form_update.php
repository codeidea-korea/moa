<?php
$sub_menu = "300950";
include_once("./_common.php");
include_once(G5_LIB_PATH."/register.lib.php");
include_once(G5_LIB_PATH.'/thumbnail.lib.php');
error_reporting(E_ALL);

if ($w == 'u')
    check_demo();


    //print_r2($_POST); exit;
auth_check($auth[$sub_menu], 'w');

check_admin_token();
$cd_order = (isset($_POST['cd_order']) && $_POST['cd_order'])?$_POST['cd_order']:0;
$sql_common = "  
                type_id = '{$_POST['type_id']}',
                cd_id = '{$_POST['cd_id']}',
                cd_name = '{$_POST['cd_name']}',
                
                cd_desc = '{$_POST['cd_desc']}',
                use_yn = '{$_POST['use_yn']}',
                cd_order = '{$cd_order}'

            ";
            //  car_kind = '{$_POST['car_kind']}',

if ($w == '')
{
    $insql = " insert into {$g5['common_code_table']}  
                set  regdate = now(), 
                    reg_mb_id = '{$member['mb_id']}',
                     {$sql_common} ";
}
else if ($w == 'u')
{

    $insql = " update {$g5['common_code_table']} 
                set {$sql_common}
                     , regdate = now()
                where idx = '{$idx}' ";
}
else
    alert('제대로 된 값이 넘어오지 않았습니다.');
//echo $insql."<BR>";
sql_query($insql);
if ($w == '')
    $no = sql_insert_id();

//print_r2($_POST); exit;
$qstr = "";

//goto_url('./common_code_form.php?'.$qstr.'&amp;w=u&amp;no='.$no, false);
goto_url('./common_code_list.php?'.$qstr, false);
?>