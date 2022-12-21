<?php
$sub_menu = "100950";
include_once('./_common.php');

check_demo();

if (!count($_POST['chk'])) {
    alert($_POST['act_button']." 하실 항목을 하나 이상 체크하세요.");
}

auth_check($auth[$sub_menu], 'w');

check_admin_token();


print_r2($_POST);
$msg = "";
//echo "<BR>"; exit;
/*
if ($_POST['act_button'] == "선택수정") {
        // 현재 일괄수정 대상이 없음 

	
    for ($i=0; $i<count($_POST['chk']); $i++)
    {
        // 실제 번호를 넘김
        $k = $_POST['chk'][$i];

        $items = sql_fetch("select * from  {$g5['common_code_table']} where no = '{$_POST['no'][$k]}' ");

        if (!$items['no']) {
            $msg .= $items['no'].' : 정산자료가 존재하지 않습니다.\\n';
        }
        else {
            // 일괄수정 대상이 존재할때 코드추가 
        }
    }

} else */

if ($_POST['act_button'] == "선택삭제" || $_POST['act_button'] == "완전삭제") {
    for ($i=0; $i<count($_POST['chk']); $i++)    {
        // 실제 번호를 넘김
        $k = $_POST['chk'][$i];

        $items = sql_fetch("select * from  {$g5['common_code_table']} where idx = '{$_POST['idx'][$k]}' ");

        if (!$items['idx']) {
            $msg .= $items['idx'].' : 자료가 존재하지 않습니다.\\n';
        } 
        else {
            // 회원자료 삭제
            //member_delete($items['idx']);
            $sql =" delete from  {$g5['common_code_table']} where idx = '{$items['idx']}' ";
            echo $sql."<BR>";
			sql_query($sql, false);
            //exit;
			//if($_POST['act_button'] == "완전삭제") {			}
        }
    }
}

if ($msg)
    alert($msg);
    //echo '<script> alert("'.$msg.'"); </script>';
//*/
goto_url('./common_code_list.php?'.$qstr);
?>
