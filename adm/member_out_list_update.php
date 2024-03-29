<?php
$sub_menu = "200140";
include_once('./_common.php');

check_demo();

if (!count($_POST['chk'])) {
    alert($_POST['act_button']." 하실 항목을 하나 이상 체크하세요.");
}

check_admin_token();

if ($_POST['act_button'] == "선택수정") {

	auth_check($auth[$sub_menu], 'w');

	//멤버쉽 해제 등급
	$is_membership_withdraw = (defined('APMS_MEMBERSHIP_WITHDRAW') && APMS_MEMBERSHIP_WITHDRAW > 0) ? APMS_MEMBERSHIP_WITHDRAW : 2;

    for ($i=0; $i<count($_POST['chk']); $i++)
    {
        // 실제 번호를 넘김
        $k = $_POST['chk'][$i];

        $mb = get_member($_POST['mb_id'][$k]);

        if (!$mb['mb_id']) {
            $msg .= $mb['mb_id'].' : 회원자료가 존재하지 않습니다.\\n';
        } else if ($is_admin != 'super' && $mb['mb_level'] >= $member['mb_level']) {
            $msg .= $mb['mb_id'].' : 자신보다 권한이 높거나 같은 회원은 수정할 수 없습니다.\\n';
        } else if ($member['mb_id'] == $mb['mb_id']) {
            $msg .= $mb['mb_id'].' : 로그인 중인 관리자는 수정 할 수 없습니다.\\n';
        } else {
            if($_POST['mb_certify'][$k])
                $mb_adult = (int) $_POST['mb_adult'][$k];
            else
                $mb_adult = 0;

			//이용기간 체크
			$sql_as_date = '';
			if(isset($_POST['as_date_del']) && $_POST['as_date_del'][$k]) { // 해제
				$_POST['mb_level'][$k] = $is_membership_withdraw; //초기화
				$sql_as_date = " , as_date = '0'"; // 지움
			} else {
				if(isset($_POST['as_date']) && isset($_POST['as_date_plus'])) { // 증감
					if($_POST['as_date'][$k] && $_POST['as_date_plus'][$k]) {
						$as_date = '';
						if($_POST['as_date_plus'][$k] > 0) {
							$as_date = $_POST['as_date'][$k] + (abs($_POST['as_date_plus'][$k]) * 86400);
						} else if($_POST['as_date_plus'][$k] < 0) {
							$as_date = $_POST['as_date'][$k] - (abs($_POST['as_date_plus'][$k]) * 86400);
						}

						if($as_date) {
							$sql_as_date = " , as_date = '{$as_date}'";
						}
					}
				}
			}

            $sql = " update {$g5['member_table']}
                        set mb_level = '".sql_real_escape_string($_POST['mb_level'][$k])."',
                            mb_intercept_date = '".sql_real_escape_string($_POST['mb_intercept_date'][$k])."',
                            mb_mailling = '".sql_real_escape_string($_POST['mb_mailling'][$k])."',
                            mb_sms = '".sql_real_escape_string($_POST['mb_sms'][$k])."',
                            mb_open = '".sql_real_escape_string($_POST['mb_open'][$k])."',
                            mb_certify = '".sql_real_escape_string($_POST['mb_certify'][$k])."',
                            mb_adult = '{$mb_adult}'
							$sql_as_date
						where mb_id = '".sql_real_escape_string($_POST['mb_id'][$k])."' ";
            sql_query($sql);
        }
    }

} else if ($_POST['act_button'] == "선택삭제" || $_POST['act_button'] == "완전삭제") {

	auth_check($auth[$sub_menu], 'd');

    for ($i=0; $i<count($_POST['chk']); $i++)
    {
        // 실제 번호를 넘김
        $k = $_POST['chk'][$i];

        $mb = get_member($_POST['mb_id'][$k]);

        if (!$mb['mb_id']) {
            $msg .= $mb['mb_id'].' : 회원자료가 존재하지 않습니다.\\n';
        } else if ($member['mb_id'] == $mb['mb_id']) {
            $msg .= $mb['mb_id'].' : 로그인 중인 관리자는 삭제 할 수 없습니다.\\n';
        } else if (is_admin($mb['mb_id']) == 'super') {
            $msg .= $mb['mb_id'].' : 최고 관리자는 삭제할 수 없습니다.\\n';
        } else if ($is_admin != 'super' && $mb['mb_level'] >= $member['mb_level']) {
            $msg .= $mb['mb_id'].' : 자신보다 권한이 높거나 같은 회원은 삭제할 수 없습니다.\\n';
        } else {
            // 회원자료 삭제
            member_delete($mb['mb_id']);

			if($_POST['act_button'] == "완전삭제") {
			    sql_query(" delete from {$g5['member_table']} where mb_id = '{$mb['mb_id']}' ", false);
			}
        }
    }
}

if ($msg) {
    //echo '<script> alert("'.$msg.'"); </script>';
    alert($msg);
}

goto_url('./member_out_list.php?'.$qstr);
?>
