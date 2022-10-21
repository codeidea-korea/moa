<?php
error_reporting( E_ALL );
ini_set( "display_errors", 1 );

$sub_menu = "200100";
include_once("./_common.php");

check_demo();

auth_check($auth[$sub_menu], "d");

// check_admin_token();

$msg = "";
for ($i=0; $i<count($chk); $i++)
{
    // 실제 번호를 넘김
    $k = $_POST['chk'][$i];

    $mb = get_member($_POST['mb_id'][$k]);

    if (!$mb['mb_id']) {
        $msg .= "{$mb['mb_id']} : 회원자료가 존재하지 않습니다.\\n";
    } else if ($member['mb_id'] == $mb['mb_id']) {
        $msg .= "{$mb['mb_id']} : 로그인 중인 관리자는 삭제 할 수 없습니다.\\n";
    } else if (is_admin($mb['mb_id']) == "super") {
        $msg .= "{$mb['mb_id']} : 최고 관리자는 삭제할 수 없습니다.\\n";
    } else if ($is_admin != "super" && $mb['mb_level'] >= $member['mb_level']) {
        $msg .= "{$mb['mb_id']} : 자신보다 권한이 높거나 같은 회원은 삭제할 수 없습니다.\\n";
    } else {
        // 회원자료 삭제
//        member_delete($mb['mb_id']);
        $time = date("Ymd");
        $sql = " UPDATE {$g5['member_table']}
                 SET mb_leave_date = '{$time}'
                 WHERE mb_id = '{$mb['mb_id']}' ";
        //echo nl2br($sql)."<BR>";
        $result = sql_query($sql);
        echo $k;
        echo $result;
    }
}

if ($msg)
    echo "<script type='text/javascript'> alert('$msg'); document.location.href = './member_list.php?$qstr'; </script>";
else 
    goto_url("./member_list.php?$qstr");
?>
