<?php
include_once('./_common.php');
$ap = $_POST['ap'];

if($is_guest) {
	alert('회원만 이용가능합니다.', APMS_PARTNER_URL.'/login.php');
}
if($ap == 'register_form') {
	if($_POST['mb_password'] != $_POST['mb_password2'] && $_POST['mb_password']) {
		alert('비밀번호 확인이 일치하지 않습니다.');
		return false;
	} else if (substr($_POST['mb_hp'], 0, 3) != '010' ){
		alert('휴대폰번호는 010으로 시작해야만 합니다.');
		return false;
	} else {
		//파일등록
		function apms_photo_upload($mb_id, $del_photo, $file)
		{
			global $g5, $config, $xp;

			if (!$mb_id) return;

			//Photo Size
			//$photo_w = (isset($xp['xp_photo']) && $xp['xp_photo']) ? $xp['xp_photo'] : 80;
			//$photo_h = $photo_w;

			$photo_w = (isset($config['cf_member_img_width']) && $config['cf_member_img_width']) ? $config['cf_member_img_width'] : 80;
			$photo_h = (isset($config['cf_member_img_height']) && $config['cf_member_img_height']) ? $config['cf_member_img_height'] : 80;

			$photo_dir = G5_DATA_PATH . '/member_image/' . substr($mb_id, 0, 2);
			$temp_dir = G5_DATA_PATH . '/member_image/temp';
			
			//Delete Photo
			if ($del_photo == "1") {
				@unlink($photo_dir . '/' . $mb_id . '.gif');
				sql_query(" update {$g5['member_table']} set as_photo = '0' where mb_id = '$mb_id' ", false);
			}

			//Upload Photo
			if (is_uploaded_file($file['pt_file']['tmp_name'])) {
				if (!preg_match("/(\.(gif|jpe?g|bmp|png))$/i", $file['pt_file']['name'])) {
					alert(aslang('alert', 'is_image', array($file['pt_file']['name']))); //은(는) 이미지(gif/jpg/png) 파일이 아닙니다.
				} else {

					if (!is_dir(G5_DATA_PATH . '/member_image')) {
						@mkdir(G5_DATA_PATH . '/member_image', G5_DIR_PERMISSION);
						@chmod(G5_DATA_PATH . '/member_image', G5_DIR_PERMISSION);
					}

					if (!is_dir($photo_dir)) {
						@mkdir($photo_dir, G5_DIR_PERMISSION);
						@chmod($photo_dir, G5_DIR_PERMISSION);
					}

					if (!is_dir($temp_dir)) {
						@mkdir($temp_dir, G5_DIR_PERMISSION);
						@chmod($temp_dir, G5_DIR_PERMISSION);
					}

					$filename = $file['pt_file']['name'];
					$filename = preg_replace('/(<|>|=)/', '', $filename);
					$filename = preg_replace("/\.(php|phtm|htm|cgi|pl|exe|jsp|asp|inc)/i", "$0-x", $filename);
echo $filename;
					$chars_array = array_merge(range(0, 9), range('a', 'z'), range('A', 'Z'));
					shuffle($chars_array);
					$shuffle = implode('', $chars_array);
					$filename = abs(ip2long($_SERVER['REMOTE_ADDR'])) . '_' . substr($shuffle, 0, 8) . '_' . replace_filename($filename);

					$org_photo = $photo_dir . '/' . $mb_id . '.gif';
					$temp_photo = $temp_dir . '/' . $filename;

					move_uploaded_file($file['pt_file']['tmp_name'], $temp_photo) or die($file['pt_file']['error']);
					chmod($temp_photo, G5_FILE_PERMISSION);
					if (is_file($temp_photo)) {
						$size = @getimagesize($temp_photo);

						//Non Image
						if (!$size[0]) {
							@unlink($temp_photo);
							alert(aslang('alert', 'is_photo')); //회원사진 등록에 실패했습니다. 이미지 파일이 정상적으로 업로드 되지 않았거나, 이미지 파일이 아닙니다.
						}

						//Animated GIF
						$is_animated = false;
						if ($size[2] == 1) {
							$is_animated = is_animated_gif($temp_photo);
						}

						if ($is_animated) {
							@unlink($temp_photo);
							alert(aslang('alert', 'is_photo_gif')); //움직이는 GIF 파일은 회원사진으로 등록할 수 없습니다.
						} else {
							$thumb = thumbnail($filename, $temp_dir, $temp_dir, $photo_w, $photo_h, true, true);
							if ($thumb) {
								if ($size[2] == 2) { //jpg
									$src = @imagecreatefromjpeg($temp_dir . '/' . $thumb);
									@imagegif($src, $temp_dir . '/' . $thumb);
								} else if ($size[2] == 3) { //png
									$src = @imagecreatefrompng($temp_dir . '/' . $thumb);
									@imagealphablending($src, true);
									@imagegif($src, $temp_dir . '/' . $thumb);
								}
								chmod($temp_dir . '/' . $thumb, G5_FILE_PERMISSION);
								copy($temp_dir . '/' . $thumb, $org_photo);
								chmod($org_photo, G5_FILE_PERMISSION);
								@unlink($temp_dir . '/' . $thumb);
								@unlink($temp_photo);
								sql_query(" update {$g5['member_table']} set as_photo = '1' where mb_id = '$mb_id' ", false);
							} else {
								@unlink($temp_photo);
								//회원사진 등록에 실패했습니다. 이미지 파일이 정상적으로 업로드 되지 않았거나, 이미지 파일이 아닙니다.
								alert(aslang('alert', 'is_photo'), G5_BBS_URL . '/myphoto.php');
							}
						}
					}
				}
			}
		}

		$mb_nick = $_POST['mb_nick'];
		$mb_email = $_POST['mb_email'];
		$mb_hp = $_POST['mb_hp'];
		$mb_recommend = $_POST['mb_recommend'];
		$mb_sex = $_POST['mb_sex'];
		$mb_open = $_POST['mb_open'];
		$mb_birth = $_POST['mb_birth'];
		$mb_password = get_encrypt_string($_POST['mb_password']);

		if (!preg_match("/([0-9a-zA-Z_-]+)@([0-9a-zA-Z_-]+)\.([0-9a-zA-Z_-]+)/", $mb_email)) {
			alert('이메일 주소가 형식에 맞지 않습니다.');
		}
		apms_photo_upload($member['mb_id'], '', $_FILES);
		//정보등록
		$common = '';
		if($mb_password != '') {
			$common = ", mb_password = '{$mb_password}'";
		}
		$sql = " UPDATE {$g5['member_table']}
				set mb_nick = '{$mb_nick}',
					mb_email = '{$mb_email}',
					mb_hp = '{$mb_hp}',
					mb_recommend = '{$mb_recommend}',
					mb_sex = '{$mb_sex}',
					mb_open = '{$mb_open}',
					mb_birth = '{$mb_birth}'
					{$common}
                    where mb_id = '{$member['mb_id']}' ";
		sql_query($sql);

		alert('회원정보수정이 완료되었습니다.');
	}
} else {
	$is_seller = (isset($apms['apms_partner']) && $apms['apms_partner']) ? true : false;
	$is_marketer = (isset($apms['apms_marketer']) && $apms['apms_marketer']) ? true : false;
	$is_company = (isset($apms['apms_company']) && $apms['apms_company']) ? true : false;
	$is_personal = (isset($apms['apms_personal']) && $apms['apms_personal']) ? true : false;

	if(!$is_seller && !$is_marketer) {
		alert('지금은 호스트 등록을 받지 않습니다.', G5_URL);
	}

	if(!$is_company && !$is_personal) {
		alert('지금은 호스트 등록을 받지 않습니다.', G5_URL);
	}

	$partner = array();
	$partner = apms_partner($member['mb_id']);

	if($partner['pt_id']) { //호스트 정보가 있으면

		if(!$partner['pt_register']) { // 등록심사중이면
			alert('회원님은 현재 등록심사 중입니다.', G5_URL);
		}

		if($partner['pt_leave']) { // 탈퇴한 회원이면
			alert('회원님은 호스트에서 탈퇴하셨습니다.\\n\\n재등록을 원하시면 관리자에게 문의바랍니다.', G5_URL);
		}

		if(!$partner['pt_partner'] && !$partner['pt_marketer']) { // 권한해제 회원이면
			alert('회원님은 호스트 권한이 해제된 상태입니다.\\n\\n권한 재등록을 원하시면 관리자에게 문의바랍니다.', G5_URL);
		}

		alert('회원님은 호스트로 등록되신 분입니다.\\n\\n호스트 페이지로 이동합니다.', APMS_PARTNER_URL);
	}

// 호스트 등록
	if(!$is_admin) {
		$register_no_msg = '';
		if($apms['apms_email_yes'] && !$member['mb_email_certify']) {
			$register_no_msg .= '이메일인증';
		}
		if($apms['apms_cert_yes'] && !$member['mb_certify']) {
			if($register_no_msg) $register_no_msg .= ', ';
			$register_no_msg .= '본인인증';
		}
		if($apms['apms_adult_yes'] && !$member['mb_adult']) {
			if($register_no_msg) $register_no_msg .= ', ';
			$register_no_msg .= '성인인증';
		}

		if($register_no_msg) {
			alert($register_no_msg.' 회원만 호스트 등록이 가능합니다.\\n\\n정보수정에서 인증 후 등록할 수 있습니다.', G5_BBS_URL.'/member_confirm.php?url=register_form.php');
		}
	}

	if (!$_POST['pt_partner'] && !$_POST['pt_marketer']) {
		alert('신청할 호스트 분야를 선택해 주세요.');
	}

// if ((!$is_seller && $_POST['pt_partner'] == "1") || (!$is_marketer && $_POST['pt_marketer'] == "1")) {
// 	alert('잘못된 신청분야를 선택하셨습니다.');
// }

// if (!isset($_POST['pt_type']) || !$_POST['pt_type']) {
// 	alert('등록할 유형을 선택하셔야 가입하실 수 있습니다.');
// }

// if (($_POST['pt_type'] != "1" && $_POST['pt_type'] != "2") || (!$is_company && $_POST['pt_type'] == "1") || (!$is_personal && $_POST['pt_type'] == "2")) {
// 	alert('잘못된 유형을 선택하셨습니다.');
// }

// if (!isset($_POST['agree']) || !$_POST['agree']) {
// 	alert('가입약관의 내용에 동의하셔야 가입하실 수 있습니다.');
// }

	if(!$pt_name) {
		alert('호스트명을 입력하세요.');
	}

	if(!$pt_hp) {
		alert('연락처를 입력하세요.');
	}

	if (!preg_match("/([0-9a-zA-Z_-]+)@([0-9a-zA-Z_-]+)\.([0-9a-zA-Z_-]+)/", $pt_email)) {
		alert('이메일 주소가 형식에 맞지 않습니다.');
	}

	$pt_partner = ($pt_partner) ? 1 : 0;
	$pt_marketer = ($pt_marketer) ? 1 : 0;
	$pt_hp = preg_replace('/[^0-9\-]/', '', strip_tags($pt_hp));
	$pt_email = get_email_address($pt_email);

	if(!$pt_email) {
		alert('이메일을 입력하세요.');
	}

	if (empty($_POST)) {
		alert("파일 또는 글내용의 크기가 서버에서 설정한 값을 넘어 오류가 발생하였습니다.\\npost_max_size=".ini_get('post_max_size')." , upload_max_filesize=".ini_get('upload_max_filesize')."\\n게시판관리자 또는 서버관리자에게 문의 바랍니다.");
	}

//파일등록
	$file_upload_msg = apms_upload_file('partner', $member['mb_id']);

	if ($file_upload_msg) {
		alert($file_upload_msg, G5_URL);
	} else {

		//자동등록
		$pt_register = ($apms['apms_register']) ? date("Ymd") : '';

		//정보등록
		$sql = " UPdate {$g5['apms_partner']}
				set pt_partner = '{$pt_partner}',
					pt_marketer = '{$pt_marketer}',
					pt_type = '{$pt_type}',
					pt_name = '{$pt_name}',
					pt_hp = '{$pt_hp}',
					pt_email = '{$pt_email}' 
                    where pt_id = '{$member['mb_id']}' ";
		// pt_register = '{$pt_register}',
		// pt_datetime = '".G5_TIME_YMDHIS."',
		sql_query($sql);

		// 호스트 신청 알림쪽지 발송
		$msg = $member['mb_nick'].'('.$member['mb_id'].')님이 호스트 등록을 신청하셨습니다.';
		$mb_list = $config['cf_admin'].','.$config['as_admin'];
		$mb = array_unique(explode(",", $mb_list));
		for($i=0; $i < count($mb); $i++) {
			$tmp_row = sql_fetch(" select max(me_id) as max_me_id from {$g5['memo_table']} ");
			$me_id = $tmp_row['max_me_id'] + 1;

			// 쪽지 INSERT
			sql_query(" insert into {$g5['memo_table']} ( me_id, me_recv_mb_id, me_send_mb_id, me_send_datetime, me_memo ) values ( '$me_id', '{$mb[$i]}', '{$config['cf_admin']}', '".G5_TIME_YMDHIS."', '{$msg}' ) ", false);

			// 읽지 않은 쪽지체크
			$tmp_row2 = sql_fetch(" select count(*) as cnt from {$g5['memo_table']} where me_recv_mb_id = '{$mb[$i]}' and me_read_datetime = '0000-00-00 00:00:00' ", false);

			// 실시간 쪽지 알림 기능
			sql_query(" update {$g5['member_table']} set mb_memo_call = '{$config['cf_admin']}', as_memo = '{$tmp_row2['cnt']}' where mb_id = '{$mb[$i]}' ", false);
		}

		if($pt_register) {
			//회원정보변경
			sql_query(" update {$g5['member_table']} set as_partner = '{$pt_partner}', as_marketer = '{$pt_marketer}' where mb_id = '{$member['mb_id']}' ");

			alert('호스트 등록이 완료되었습니다.', APMS_PARTNER_URL);
		} else {
			alert('호스트 등록을 신청하셨습니다.\\n\\n신청내용에 대한 검토 후 등록이 완료됩니다.', G5_URL);
		}
	}
}

?>
