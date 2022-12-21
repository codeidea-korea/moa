<?php
$sub_menu = "100420";
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


        $mb = getTableContents($_POST['td_no'][$k],'maintestdate','td');

        if (!$mb['mb_no']) {
            $msg .= $mb['mb_no'].' : 회원자료가 존재하지 않습니다.\\n';
        } else {
            
            $sql = " update {$g5['maintestdate_table']}
                        set td_url = '{$_POST['mb_url'][$k]}',
                            td_open = '{$mb_open}'
                        where td_no = '{$_POST['mb_no'][$k]}' ";
            sql_query($sql);
        }
    }

} else if ($_POST['act_button'] == "선택삭제") {
    //var_dump($_POST);
    for ($i=0; $i<count($_POST['chk']); $i++)
    {
        // 실제 번호를 넘김
        $k = $_POST['chk'][$i];
        $mb = getTableContents($_POST['td_no'][$k],'maintestdate','td'); 

        if (!$mb['td_no']) {
            $msg .= $mb['td_no'].' : 베너 자료가 존재하지 않습니다.\\n';
        } else {
            // 자료 삭제
            mainContent_delete($mb['td_no'],'maintestdate','mv');
        }
    }
}

if ($msg)
    //echo '<script> alert("'.$msg.'"); </script>';
    alert($msg);

goto_url('./maintestdate_list.php?'.$qstr);
?>
