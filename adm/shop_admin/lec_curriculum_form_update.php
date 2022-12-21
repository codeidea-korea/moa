<?php
$sub_menu = "400310";
include_once("./_common.php");
include_once(G5_EDITOR_LIB);
include_once(G5_LIB_PATH.'/iteminfo.lib.php');

include_once(G5_LIB_PATH."/register.lib.php");
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

if ($w == 'u')
    check_demo();

//auth_check($auth[$sub_menu], 'w');

check_admin_token();

$mb_id = trim($_POST['mb_id']);
$cc_id = trim($_POST['cc_id']);
//echo "<pre>";
//var_dump($_POST);
//echo "</pre>";
//exit;
    //procUpload($filearr, $dir, $subdir='', $thumbcreate = false, $thumbwidth=100, $thumbheight=50, $delyn=false )
    $files = procUpload($_FILES['cc_img_pc'], 'lec_curriculum', 'pc', true, $thumbwidth=100, $thumbheight=50, $delyn=false );
    $cc_img_pc = $files['name'];
    $cc_img_pc_thumb = $files['thumb'];
/*

    $files = procUpload($_FILES['cc_img_mo'], 'lec_curriculum', 'mobile', true, $thumbwidth=100, $thumbheight=50, $delyn=false );
    $cc_img_mo = $files['name'];
    $cc_img_mo_thumb = $files['thumb'];
*/
    

//                 cc_memo = '{$_POST['cc_memo']}',

$sql_common = "  mb_id = '{$member['mb_id']}',
                 cc_name = '{$_POST['cc_name']}',
                 cc_order = '{$_POST['cc_order']}',
                 cc_1 = '{$_POST['cc_1']}',
                 cc_2 = '{$_POST['cc_2']}',
                 cc_3 = '{$_POST['cc_3']}',
                 cc_4 = '{$_POST['cc_4']}',
                 cc_5 = '{$_POST['cc_5']}',
                 cc_6 = '{$_POST['cc_6']}',
                 cc_7 = '{$_POST['cc_7']}',
                 cc_8 = '{$_POST['cc_8']}',
                 cc_9 = '{$_POST['cc_9']}',
                 cc_10 = '{$_POST['cc_10']}' ";

if ($cc_img_pc)
    $sql_file = "    cc_img_pc = '{$cc_img_pc}',
                 cc_img_pc_thumb = '{$cc_img_pc_thumb}',
            ";
if ($cc_img_mo)
    $sql_file .="                 
                 cc_img_mo = '{$cc_img_mo}',
                 cc_img_mo_thumb = '{$cc_img_mo_thumb}',
                 ";
if ($w == '')
{
    $mb = getLecContents($cc_id,'lec_curriculum','cc_id');
    if ($mb['cc_id'])
        alert('이미 존재하는 커리큘럼 입니다.\\n '.$mb['cc_name'].'\\n');

    
    $sql = " insert into {$g5['lec_curriculum_table']} set cc_datetime = '".G5_TIME_YMDHIS."', {$sql_file} {$sql_common} ";
    sql_query($sql);
    //echo $sql."<BR>";
    $cc_id = sql_insert_id();
    //echo "cc_id = ".$cc_id."<BR>";
    //exit;
}
else if ($w == 'u')
{
    $mb = getLecContents($cc_id,'lec_curriculum','cc_id');
    if (!$mb['cc_id'])
        alert('존재하지 않는 커리큘럼 자료입니다.');


    $sql = " update {$g5['lec_curriculum_table']}
                set {$sql_file} {$sql_common}
                     
                where cc_id = '{$cc_id}' ";
    sql_query($sql);
}
else
    alert('제대로 된 값이 넘어오지 않았습니다.');

$count = $_POST['count'];
$cv_no = $_POST['cv_no'];
$cv_title = $_POST['cv_title'];
$cv_type = $_POST['cv_type'];
$cv_playtime = $_POST['cv_playtime'];
$cv_url = $_POST['cv_url'];
$delcv = $_POST['delcv'];
//echo "count : ".$count."<BR>";
if ($count && $count > 0)   {
    for($i = 0; $i < $count; $i++)  {
        $sql_common = " mb_id = '{$member['mb_id']}' ";
        $sql_common .= ", cc_id = '{$cc_id}' ";
        $sql_common .= ", cv_title = '{$cv_title[$i]}' ";
        $sql_common .= ", cv_type = '{$cv_type[$i]}' ";
        $sql_common .= ", cv_playtime = '{$cv_playtime[$i]}' ";
        $sql_common .= ", cv_url = '{$cv_url[$i]}' ";

        $before = 0;
        if ($cv_no[$i]) {
            $sql = "select count(*) cnt from {$g5['lec_curriculum_vod_table']} where cv_no = '{$cv_no[$i]}' ";
            $row = sql_fetch($sql);
            $before = $row['cnt'];
        }

        if ($before)  {
            $sql = "update {$g5['lec_curriculum_vod_table']} ";
            $sql .= "set ".$sql_common;
            $sql .="  where cv_no = '{$cv_no[$i]}' ";
        }
        else {
            $sql = "insert into {$g5['lec_curriculum_vod_table']} ";
            $sql .= "set ".$sql_common;
        }
        sql_query($sql);

        if ($delcv) {
            $sql = "delete from {$g5['lec_curriculum_vod_table']} ";
            $sql .= " where cv_no in ({$delcv}) ";
            echo $sql."<BR>";
            sql_query($sql);
        //echo " idx : ".$i." : ".$sql."<BR>";
        }
        //exit;

    }

}
//exit;


goto_url('./lec_curriculum_form.php?'.$qstr.'&amp;w=u&amp;cc_id='.$cc_id, false);
?>