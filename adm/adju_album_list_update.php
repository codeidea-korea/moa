<?php
$sub_menu = "750000";
include_once('./_common.php');

check_demo();

if (!count($_POST['chk'])) {
    alert($_POST['act_button']." 하실 항목을 하나 이상 체크하세요.");
}

auth_check($auth[$sub_menu], 'w');

check_admin_token();

if ($_POST['act_button'] == "선택수정") {
        // 현재 일괄수정 대상이 없음 

	
    for ($i=0; $i<count($_POST['chk']); $i++)
    {
        // 실제 번호를 넘김
        $k = $_POST['chk'][$i];

        $mb = get_album($_POST['no'][$k]);

        if (!$mb['no']) {
            $msg .= $mb['no'].' : 앨범자료가 존재하지 않습니다.\\n';
        }
        else {
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

            $sql = " update {$g5['adju_album_table']}
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

    for ($i=0; $i<count($_POST['chk']); $i++)
    {
        // 실제 번호를 넘김
        $k = $_POST['chk'][$i];

        $mb = get_album($_POST['no'][$k]);

        if (!$mb['no']) {
            $msg .= $mb['no'].' : 앨범자료가 존재하지 않습니다.\\n';
        } else {
            // 회원자료 삭제
            //member_delete($mb['no']);
            $sql =" delete from {$g5['adju_album_table']} where no = '{$mb['no']}' ";
            echo $sql."<BR>";
			sql_query($sql, false);
            //exit;
			//if($_POST['act_button'] == "완전삭제") {			}
        }
    }
}

if ($msg)
    //echo '<script> alert("'.$msg.'"); </script>';
    alert($msg);

goto_url('./adju_album_list.php?'.$qstr);
?>
