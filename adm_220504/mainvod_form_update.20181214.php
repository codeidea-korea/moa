<?php
$sub_menu = "100410";
include_once("./_common.php");
include_once(G5_LIB_PATH."/register.lib.php");

include_once(G5_LIB_PATH.'/thumbnail.lib.php');

if ($w == 'u') {
    check_demo();
}

//auth_check($auth[$sub_menu], 'w');

//check_admin_token();

$mb_id = trim($_POST['mb_id']);
$mv_no = trim($_POST['mv_no']);

    //procUpload($filearr, $dir, $subdir='', $thumbcreate = false, $thumbwidth=100, $thumbheight=50, $delyn=false )
/*
    $files = procUpload($_FILES['mv_img_pc'], 'mainvod', 'pc', true, $thumbwidth=100, $thumbheight=50, $delyn=false );
    $mv_img_pc = $files['name'];
    $mv_img_pc_thumb = $files['thumb'];

    $files = procUpload($_FILES['mv_img_mo'], 'mainvod', 'mobile', true, $thumbwidth=100, $thumbheight=50, $delyn=false );
    $mv_img_mo = $files['name'];
    $mv_img_mo_thumb = $files['thumb'];
*/
    


$sql_common = "  mb_id = '{$member['mb_id']}',
                 mv_url = '{$_POST['mv_url']}',
                 mv_order = '{$_POST['mv_order']}',
                 mv_btn_text = '{$_POST['mv_btn_text']}',
                 mv_open = '{$_POST['mv_open']}',
                 mv_open_date = '{$_POST['mv_open_date']}',
                 mv_1 = '{$_POST['mv_1']}',
                 mv_2 = '{$_POST['mv_2']}',
                 mv_3 = '{$_POST['mv_3']}',
                 mv_4 = '{$_POST['mv_4']}',
                 mv_5 = '{$_POST['mv_5']}',
                 mv_6 = '{$_POST['mv_6']}',
                 mv_7 = '{$_POST['mv_7']}',
                 mv_8 = '{$_POST['mv_8']}',
                 mv_9 = '{$_POST['mv_9']}',
                 mv_10 = '{$_POST['mv_10']}' ";

if ($mv_img_pc)
    $sql_file = "    mv_img_pc = '{$mv_img_pc}',
                 mv_img_pc_thumb = '{$mv_img_pc_thumb}',
            ";
if ($mv_img_mo)
    $sql_file .="                 
                 mv_img_mo = '{$mv_img_mo}',
                 mv_img_mo_thumb = '{$mv_img_mo_thumb}',
                 ";
if ($w == '')
{
    $mb = getTableContents($mv_no,'mainvod','mv'););
    if ($mb['mv_no'])
        alert('이미 존재하는 베너 입니다.\\n '.$mb['mv_btn_text'].'\\n');

    
    $sql = " insert into {$g5['mainvod_table']} set mv_datetime = '".G5_TIME_YMDHIS."', {$sql_file} {$sql_common} ";
    sql_query($sql);
    //echo $sql."<BR>";
    $mv_no = sql_insert_id();
    //echo "mv_no = ".$mv_no."<BR>";
    //exit;
}
else if ($w == 'u')
{
    $mb = getTableContents($mv_no,'mainvod','mv'););
    if (!$mb['mv_no'])
        alert('존재하지 않는 VOD자료입니다.');


    $sql = " update {$g5['mainvod_table']}
                set {$sql_file} {$sql_common}
                     
                where mv_no = '{$mv_no}' ";
    sql_query($sql);
}
else
    alert('제대로 된 값이 넘어오지 않았습니다.');


goto_url('./mainvod_form.php?'.$qstr.'&amp;w=u&amp;mv_no='.$mv_no, false);
?>