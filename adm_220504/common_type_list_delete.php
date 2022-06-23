<?php
$sub_menu = '300900';
include_once('./_common.php');

check_demo();

auth_check($auth[$sub_menu], 'd');

check_admin_token();

$count = count($_POST['chk']);
if(!$count)
    alert($_POST['act_button'].' 하실 항목을 하나 이상 체크하세요.');
//echo $count."<BR>";//exit;
//print_r2($_POST);

for ($i=0; $i<$count; $i++) {
    echo $i."<BR>";
    // 실제 번호를 넘김
    $k = $_POST['chk'][$i];
    $type_id = $_POST['type_id'][$k];

    // 포인트 내역정보
    $sql = " select * from {$g5['common_type_table']} where type_id = '{$type_id}' ";
    $row = sql_fetch($sql);
    //echo $sql."<BR>";
    if(!$row['type_id'])
        continue;
    //echo $row['type_id']."<BR>";
    if($row['type_id']) {
        // 코드 내역삭제
        $sql = " delete from {$g5['common_type_table']} where type_id = '{$type_id}' ";
        //echo $sql."<BR>";
        sql_query($sql);
    }
}
   // exit;

goto_url('./common_type_list.php?'.$qstr);
?>