<?php
$sub_menu = "100410";
include_once('./_common.php');



if (!count($_POST['chk'])) {
    alert($_POST['act_button']." 하실 항목을 하나 이상 체크하세요.");
}

//auth_check($auth[$sub_menu], 'w');
//check_admin_token();

if ($_POST['act_button'] == "선택수정") {
    for ($i=0; $i<count($_POST['chk']); $i++)
    {
        // 실제 번호를 넘김
        $k = $_POST['chk'][$i];


        $mb = getTableContents($_POST['mv_no'][$k],'mainvod','mv');

        if (!$mb['mb_no']) {
            $msg .= $mb['mb_no'].' : 회원자료가 존재하지 않습니다.\\n';
        } else {
            
            $sql = " update {$g5['mainvod_table']}
                        set mb_url = '{$_POST['mb_url'][$k]}',
                            mb_open = '{$mb_open}'
                        where mb_no = '{$_POST['mb_no'][$k]}' ";
            sql_query($sql);
        }
    }

} else if ($_POST['act_button'] == "선택삭제") {
    //var_dump($_POST);
    for ($i=0; $i<count($_POST['chk']); $i++)
    {
        // 실제 번호를 넘김
        $k = $_POST['chk'][$i];
        $mb = getTableContents($_POST['mv_no'][$k],'mainvod','mv'); 

        if (!$mb['mv_no']) {
            $msg .= $mb['mv_no'].' : 베너 자료가 존재하지 않습니다.\\n';
        } else {
            // 자료 삭제
            mainContent_delete($mb['mv_no'],'mainvod','mv');
        }
    }
}

if ($msg)
    //echo '<script> alert("'.$msg.'"); </script>';
    alert($msg);

goto_url('./mainvod_list.php?'.$qstr);
?>
