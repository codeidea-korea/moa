<?php
$sub_menu = "400310";
include_once('./_common.php');
include_once(G5_EDITOR_LIB);
include_once(G5_LIB_PATH.'/iteminfo.lib.php');



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


        $mb = getLecContents($_POST['cc_id'][$k],'lec_curriculum','cc_id');

        if (!$mb['cc_id']) {
            $msg .= $mb['cc_id'].' : 회원자료가 존재하지 않습니다.\\n';
        } else {
            
            $sql = " update {$g5['lec_curriculum_table']}
                        set  cc_order = '{$_POST['cc_order'][$k]}'
                        where cc_id = '{$_POST['cc_id'][$k]}' ";
            sql_query($sql);
        }
    }

} else if ($_POST['act_button'] == "선택삭제") {
    //var_dump($_POST);
    for ($i=0; $i<count($_POST['chk']); $i++)
    {
        // 실제 번호를 넘김
        $k = $_POST['chk'][$i];
        $mb = getLecContents($_POST['cc_id'][$k],'lec_curriculum','cc_id'); 

        if (!$mb['cc_id']) {
            $msg .= $mb['cc_id'].' : 커리큘럼 자료가 존재하지 않습니다.\\n';
        } else {
            // 자료 삭제
            deleteLecContent($mb['cc_id'],'lec_curriculum','cc_id','cc_id');
        }
    }
}

if ($msg)
    //echo '<script> alert("'.$msg.'"); </script>';
    alert($msg);

goto_url('./lec_curriculum_list.php?'.$qstr);
?>
