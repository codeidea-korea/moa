<?php
$sub_menu = "100420";
include_once("./_common.php");
include_once(G5_LIB_PATH."/register.lib.php");
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

if ($w == 'u')
    check_demo();

//auth_check($auth[$sub_menu], 'w');

check_admin_token();

$mb_id = trim($_POST['mb_id']);
$td_no = trim($_POST['td_no']);

    //procUpload($filearr, $dir, $subdir='', $thumbcreate = false, $thumbwidth=100, $thumbheight=50, $delyn=false )
    $files = procUpload($_FILES['td_img_pc'], 'maintestdate', 'pc', true, $thumbwidth=100, $thumbheight=50, $delyn=false );
    $td_img_pc = $files['name'];
    $td_img_pc_thumb = $files['thumb'];
/*

    $files = procUpload($_FILES['td_img_mo'], 'maintestdate', 'mobile', true, $thumbwidth=100, $thumbheight=50, $delyn=false );
    $td_img_mo = $files['name'];
    $td_img_mo_thumb = $files['thumb'];
*/
    


                 //td_order = '{$_POST['td_order']}',
$sql_common = "  mb_id = '{$member['mb_id']}',
                 td_url = '{$_POST['td_url']}',
                 td_btn_text = '{$_POST['td_btn_text']}',
                 td_open = '{$_POST['td_open']}',
                 td_open_date = '{$_POST['td_open_date']}',
                 td_testyear = '{$_POST['td_testyear']}',
                 td_order = '{$_POST['td_order']}',
                 td_1 = '{$_POST['td_1']}',
                 td_2 = '{$_POST['td_2']}',
                 td_3 = '{$_POST['td_3']}',
                 td_4 = '{$_POST['td_4']}',
                 td_5 = '{$_POST['td_5']}',
                 td_6 = '{$_POST['td_6']}',
                 td_7 = '{$_POST['td_7']}',
                 td_8 = '{$_POST['td_8']}',
                 td_9 = '{$_POST['td_9']}',
                 td_10 = '{$_POST['td_10']}' ";

if ($td_img_pc)
    $sql_file = "    td_img_pc = '{$td_img_pc}',
                 td_img_pc_thumb = '{$td_img_pc_thumb}',
            ";
if ($td_img_mo)
    $sql_file .="                 
                 td_img_mo = '{$td_img_mo}',
                 td_img_mo_thumb = '{$td_img_mo_thumb}',
                 ";
if ($w == '')
{
    $mb = getTableContents($td_no,'maintestdate','td');
    if ($mb['td_no'])
        alert('이미 존재하는 베너 입니다.\\n '.$mb['td_btn_text'].'\\n');

    
    $sql = " insert into {$g5['maintestdate_table']} set td_datetime = '".G5_TIME_YMDHIS."', {$sql_file} {$sql_common} ";
    sql_query($sql);
    //echo $sql."<BR>";
    $td_no = sql_insert_id();
    //echo "td_no = ".$td_no."<BR>";
    //exit;
}
else if ($w == 'u')
{
    $mb = getTableContents($td_no,'maintestdate','td');
    if (!$mb['td_no'])
        alert('존재하지 않는 메인시험일정 자료입니다.');


    $sql = " update {$g5['maintestdate_table']}
                set {$sql_file} {$sql_common}
                     
                where td_no = '{$td_no}' ";
    sql_query($sql);
}
else
    alert('제대로 된 값이 넘어오지 않았습니다.');


goto_url('./maintestdate_form.php?'.$qstr.'&amp;w=u&amp;td_no='.$td_no, false);
?>