<?php
$sub_menu = "200110";
include_once('./_common.php');

if($w == 'u') {
    $sub_menu = "200100";
}
auth_check($auth[$sub_menu], 'w');

if ($w == '')
{
    $required_mb_id = 'required';
    $required_mb_id_class = 'required alnum_';
    $required_mb_password = 'required';
    $sound_only = '<strong class="sound_only">필수</strong>';

    $mb['mb_mailling'] = 1;
    $mb['mb_open'] = 1;
    $mb['mb_level'] = $config['cf_register_level'];
    $html_title = '추가';
}
else if ($w == 'u')
{
    $mb = get_member($mb_id);
    if (!$mb['mb_id'])
        alert('존재하지 않는 회원자료입니다.');

    if ($is_admin != 'super' && $mb['mb_level'] >= $member['mb_level'])
        alert('자신보다 권한이 높거나 같은 회원은 수정할 수 없습니다.');

    $required_mb_id = 'readonly';
    $required_mb_password = '';
    $html_title = '수정';

    $mb['mb_name'] = get_text($mb['mb_name']);
    $mb['mb_nick'] = get_text($mb['mb_nick']);
    $mb['mb_email'] = get_text($mb['mb_id']);
    $mb['mb_homepage'] = get_text($mb['mb_homepage']);
    $mb['mb_birth'] = get_text($mb['mb_birth']);
    $mb['mb_tel'] = get_text($mb['mb_tel']);
    $mb['mb_hp'] = get_text($mb['mb_hp']);
    $mb['mb_addr1'] = get_text($mb['mb_addr1']);
    $mb['mb_addr2'] = get_text($mb['mb_addr2']);
    $mb['mb_addr3'] = get_text($mb['mb_addr3']);
    $mb['mb_signature'] = get_text($mb['mb_signature']);
    $mb['mb_recommend'] = get_text($mb['mb_recommend']);
    $mb['mb_profile'] = get_text($mb['mb_profile']);
    $mb['mb_1'] = get_text($mb['mb_1']);
    $mb['mb_2'] = get_text($mb['mb_2']);
    $mb['mb_3'] = get_text($mb['mb_3']);
    $mb['mb_4'] = get_text($mb['mb_4']);
    $mb['mb_5'] = get_text($mb['mb_5']);
    $mb['mb_6'] = get_text($mb['mb_6']);
    $mb['mb_7'] = get_text($mb['mb_7']);
    $mb['mb_8'] = get_text($mb['mb_8']);
    $mb['mb_9'] = get_text($mb['mb_9']);
    $mb['mb_10'] = get_text($mb['mb_10']);
}
else
    alert('제대로 된 값이 넘어오지 않았습니다.');

// 본인확인방법
switch($mb['mb_certify']) {
    case 'hp':
        $mb_certify_case = '휴대폰';
        $mb_certify_val = 'hp';
        break;
    case 'ipin':
        $mb_certify_case = '아이핀';
        $mb_certify_val = 'ipin';
        break;
    case 'admin':
        $mb_certify_case = '관리자 수정';
        $mb_certify_val = 'admin';
        break;
    default:
        $mb_certify_case = '';
        $mb_certify_val = 'admin';
        break;
}

// 본인확인
$mb_certify_yes  =  $mb['mb_certify'] ? 'checked="checked"' : '';
$mb_certify_no   = !$mb['mb_certify'] ? 'checked="checked"' : '';

// 성인인증
$mb_adult_yes       =  $mb['mb_adult']      ? 'checked="checked"' : '';
$mb_adult_no        = !$mb['mb_adult']      ? 'checked="checked"' : '';

//메일수신
$mb_mailling_yes    =  $mb['mb_mailling']   ? 'checked="checked"' : '';
$mb_mailling_no     = !$mb['mb_mailling']   ? 'checked="checked"' : '';

// SMS 수신
$mb_sms_yes         =  $mb['mb_sms']        ? 'checked="checked"' : '';
$mb_sms_no          = !$mb['mb_sms']        ? 'checked="checked"' : '';

// 정보 공개
$mb_open_yes        =  $mb['mb_open']       ? 'checked="checked"' : '';
$mb_open_no         = !$mb['mb_open']       ? 'checked="checked"' : '';

if (isset($mb['mb_certify'])) {
    // 날짜시간형이라면 drop 시킴
    if (preg_match("/-/", $mb['mb_certify'])) {
        sql_query(" ALTER TABLE `{$g5['member_table']}` DROP `mb_certify` ", false);
    }
} else {
    sql_query(" ALTER TABLE `{$g5['member_table']}` ADD `mb_certify` TINYINT(4) NOT NULL DEFAULT '0' AFTER `mb_hp` ", false);
}

if(isset($mb['mb_adult'])) {
    sql_query(" ALTER TABLE `{$g5['member_table']}` CHANGE `mb_adult` `mb_adult` TINYINT(4) NOT NULL DEFAULT '0' ", false);
} else {
    sql_query(" ALTER TABLE `{$g5['member_table']}` ADD `mb_adult` TINYINT NOT NULL DEFAULT '0' AFTER `mb_certify` ", false);
}

// 지번주소 필드추가
if(!isset($mb['mb_addr_jibeon'])) {
    sql_query(" ALTER TABLE {$g5['member_table']} ADD `mb_addr_jibeon` varchar(255) NOT NULL DEFAULT '' AFTER `mb_addr2` ", false);
}

// 건물명필드추가
if(!isset($mb['mb_addr3'])) {
    sql_query(" ALTER TABLE {$g5['member_table']} ADD `mb_addr3` varchar(255) NOT NULL DEFAULT '' AFTER `mb_addr2` ", false);
}

// 중복가입 확인필드 추가
if(!isset($mb['mb_dupinfo'])) {
    sql_query(" ALTER TABLE {$g5['member_table']} ADD `mb_dupinfo` varchar(255) NOT NULL DEFAULT '' AFTER `mb_adult` ", false);
}

// 이메일인증 체크 필드추가
if(!isset($mb['mb_email_certify2'])) {
    sql_query(" ALTER TABLE {$g5['member_table']} ADD `mb_email_certify2` varchar(255) NOT NULL DEFAULT '' AFTER `mb_email_certify` ", false);
}
$sql = "select b.*, if (b.pt_id is not null, '호스트','게스트') mb_gubun, 
if (d.file_type = 'free-file', '프리랜서',
    if (d.file_type = 'namecard' or d.file_type='name-camera', '직장인',
        if (c.cert_yn = 1,'직장인','미인증')
   )
) mb_type, ";
$sql_common = " from {$g5['member_table']} a
	left outer join {$g5['apms_partner']} b on (b.pt_id = a.mb_id) 
	left outer join {$g5['certi_mail']} c on (c.mb_id = a.mb_id and c.cert_yn = 1) 
	left outer join {$g5['certi_image']} d on (d.mb_id = a.mb_id) 
	";

$sql_search = " where (1) and a.mb_id = '{$mb['mb_id']}' ";
$mbinfo = sql_fetch($sql);


if ($mb['mb_intercept_date']) $g5['title'] = "차단된 ";
else $g5['title'] .= "";
$g5['title'] .= '회원 '.$html_title;
include_once('./admin.head.php');

// add_javascript('js 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_javascript(G5_POSTCODE_JS, 0);    //다음 주소 js
?>

<div class="boxContainer padding40">

<form name="fmember" id="fmember" action="./member_form_update.php" onsubmit="return fmember_submit(this);" method="post" enctype="multipart/form-data">
<input type="hidden" name="w" value="<?php echo $w ?>">
<input type="hidden" name="sfl" value="<?php echo $sfl ?>">
<input type="hidden" name="stx" value="<?php echo $stx ?>">
<input type="hidden" name="sst" value="<?php echo $sst ?>">
<input type="hidden" name="sod" value="<?php echo $sod ?>">
<input type="hidden" name="page" value="<?php echo $page ?>">
<input type="hidden" name="token" value="">

<div class="tbl-excel tleft">
    <table>
    <caption><?php echo $g5['title']; ?></caption>
    <colgroup>
        <col width="170">
        <col>
    </colgroup>
    <tbody>
    <tr>
        <th scope="row"><label for="mb_id">아이디<?php echo $sound_only ?></label></th>
        <td>
            <input type="email" name="mb_id" value="<?php echo $mb['mb_id'] ?>" id="mb_id" <?php echo $required_mb_id ?> class="frm_input <?php echo $required_mb_id_class ?>" size="15" minlength="3" placeholder="이메일 형식으로 입력해주세요.">
            <?php if (false&&$w=='u'){ ?><a href="./boardgroupmember_form.php?mb_id=<?php echo $mb['mb_id'] ?>">접근가능그룹보기</a><?php } ?>
        </td>
    </tr>
	<tr>
        <th scope="row"><label for="mb_password">비밀번호<?php echo $sound_only ?></label></th>
        <td><input type="password" name="mb_password" id="mb_password" <?php echo $required_mb_password ?> class="frm_input <?php echo $required_mb_password ?>" size="15" maxlength="20"></td>
    </tr>
    <tr>
        <th scope="row"><label for="mb_name">이름(실명)<strong class="sound_only">필수</strong></label></th>
        <td><input type="text" name="mb_name" value="<?php echo $mb['mb_name'] ?>" id="mb_name" required class="required frm_input" size="15" maxlength="20"></td>
    </tr>
<!--	<tr>-->
<!--        <th scope="row"><label for="mb_email">이메일<strong class="sound_only">필수</strong></label></th>-->
<!--        <td><input type="text" name="mb_email" value="--><?php //echo $mb['mb_email'] ?><!--" id="mb_email" maxlength="100" required class="required frm_input email" size="30"></td>-->
<!--    </tr>-->
	<tr>
        <th scope="row">이메일 수신</th>
        <td>
            <input type="radio" name="mb_mailling" value="1" id="mb_mailling_yes" <?php echo $mb_mailling_yes; ?> data-label="예">
            <input type="radio" name="mb_mailling" value="0" id="mb_mailling_no" <?php echo $mb_mailling_no; ?>  data-label="아니오">
        </td>
    </tr>
	<tr>
        <th scope="row">SNS 수신</th>
        <td>
            <input type="radio" name="sns" value="1" id="" checked data-label="예">
            <input type="radio" name="sns" value="0" id="" data-label="아니오">
        </td>
    </tr>
	<tr class="none">
        <th scope="row">포인트</th>
        <td><?php echo number_format($mb['mb_point']) ?> 점 <a href="./point_list.php?sfl=mb_id&amp;stx=<?php echo $mb['mb_id'] ?>" target="_blank" class="color-blue ml15">상세보기</a></td>
    </tr>
	<tr class="none">
        <th scope="row">쿠폰</th>
        <td>3개 <a href="#" target="_blank" class="color-blue ml15">상세보기</a></td>
    </tr>
	<tr>
		<th>회원등급</th>
		<td>
			<select name="mb_level">
				<option <?php echo $mb['mb_level'] == '1' ? 'selected'  : ''; ?> value="1">일반게스트</option>
				<option <?php echo $mb['mb_level'] == '2' ? 'selected'  : ''; ?> value="2">호스트</option>
				<option <?php echo $mb['mb_level'] == '3' ? 'selected'  : ''; ?> value="3">수퍼호스트</option>
                <?php if ($mb['mb_level']>3) {
                    ?>
                <option value="<?php echo $mb['mb_level']?>">관리자레벨</option>
                <?php 
                }
                if ($is_super) {?> {
                ?>
				<option <?php echo $mb['mb_level'] == '4' ? 'selected'  : ''; ?> value="4">관리자(직원)</option>
                <?php } ?>
			</select>
		</td>
	</tr>
	<tr>
		<th>가입/접속</th>
		<td><?php echo $mb['mb_today_login'];?></td>
	</tr>
	<!-- <tr>
		<th>로그인</th>
		<td>총 로그인 1회 (마지막 로그인 기록 : 카카오톡으로 13:23:34)로 로그인</td>
	</tr> -->
	<tr>
		<th>회원코드</th>
		<td>
			<span><?php echo $mb['invite_code'];?></span>
			<!-- <span class="ml30">-5000포인트 지급</span> -->
		</td>
	</tr>
    <tr class="no ne">
        <th scope="row"><label for="mb_leave_date">탈퇴일자</label></th>
        <td>
            <input type="text" name="mb_leave_date" value="<?php echo $mb['mb_leave_date'] ?>" id="mb_leave_date" class="frm_input" maxlength="8">
            <input type="checkbox" value="<?php echo date("Ymd"); ?>" id="mb_leave_date_set_today" onclick="if (this.form.mb_leave_date.value==this.form.mb_leave_date.defaultValue) {
this.form.mb_leave_date.value=this.value; } else { this.form.mb_leave_date.value=this.form.mb_leave_date.defaultValue; }">
            <label for="mb_leave_date_set_today">탈퇴일을 오늘로 지정</label>
        </td>
    </tr>
	<tr class="no ne">
        <th scope="row">접근차단일자</th>
        <td>
            <input type="text" name="mb_intercept_date" value="<?php echo $mb['mb_intercept_date'] ?>" id="mb_intercept_date" class="frm_input" maxlength="8">
            <input type="checkbox" value="<?php echo date("Ymd"); ?>" id="mb_intercept_date_set_today" onclick="if
(this.form.mb_intercept_date.value==this.form.mb_intercept_date.defaultValue) { this.form.mb_intercept_date.value=this.value; } else {
this.form.mb_intercept_date.value=this.form.mb_intercept_date.defaultValue; }">
            <label for="mb_intercept_date_set_today">접근차단일을 오늘로 지정</label>
        </td>
    </tr>

	</tbody>
	</table>


	<table class="mt50">
    <caption><?php echo $g5['title']; ?></caption>
    <colgroup>
        <col width="170">
        <col>
    </colgroup>
    <tbody>
	<tr>
        <td scope="row">직장인/프리랜서</td>
        <td>
			<?php echo $mbinfo['mb_type'];?>
        </td>
    </tr>
	<tr>
        <td scope="row"><label for="mb_nick">닉네임<strong class="sound_only">필수</strong></label></td>
        <td><input type="text" name="mb_nick" value="<?php echo $mb['mb_nick'] ?>" id="mb_nick" required class="required frm_input" size="15" maxlength="20"></td>
    </tr>
	<tr>
        <td scope="row"><label for="mb_hp">휴대폰번호</label></td>
        <td><input type="text" name="mb_hp" value="<?php echo $mb['mb_hp'] ?>" id="mb_hp" class="frm_input" size="15" maxlength="20"></td>
    </tr>
	<tr>
        <td scope="row">성별</td>
        <td>
			<input type="radio" name="mb_sex" value="남" id="mb_sex" <? echo $mb['mb_sex'] == '남' ? 'checked' : ''; ?> data-label="남">
            <input type="radio" name="mb_sex" value="여" id="mb_sex" <? echo $mb['mb_sex'] == '여' ? 'checked' : ''; ?> data-label="여">
        </td>
    </tr>
	<tr>
        <td scope="row">생년월일</td>
        <td><input type="text" name="mb_birth" value="<?php echo $mb['mb_birth'];?>" id="mb_birth" class="span200"></td>
    </tr>
	<tr>
        <td scope="row">직장</td>
        <td><input type="text" name="company_name" value="<?php echo $mb['company_name'];?>" id="company_name" class="span250"></td>
    </tr>
	<!-- <tr>
        <td scope="row">신입/경력</td>
        <td><input type="text" name="" value="" id="" class="span250"></td>
    </tr> -->
	<tr>
        <td scope="row">직군</td>
        <td><input type="text" name="job_group" value="<?php echo $mb['job_group'];?>" id="job_group" class="span250"></td>
    </tr>
	<tr>
        <td scope="row">직무</td>
        <td><input type="text" name="job_kind" value="<?php echo $mb['job_kind'];?>" id="job_kind" class="span250"></td>
    </tr>
    <tr>
        <td scope="row">인증 여부</td>
        <td>
            <?php 
            /*
            $cert = array('대기', '완료');
            $row = "SELECT file_path, bf_file, cert_yn, count(*) cnt FROM deb_certi_image WHERE mb_id = '{$mb['mb_id']}'";
            $result = sql_fetch($row);
            if($mb['com_cert_yn'] != null) {
                $com_cert = $cert[$mb['com_cert_yn']];
            } else if($result['cnt'] > 0) {
                $com_cert = $cert[$result['cert_yn']];
            } else {
                $com_cert = '미신청';
            }
            */
            $row = "SELECT file_path, bf_file, cert_yn, count(*) cnt FROM deb_certi_image WHERE mb_id = '{$mb['mb_id']}'";
            $result = sql_fetch($row);
            ?>
            <input type="hidden" name="com_cert_yn" value="<?php echo $mb['com_cert_yn'] ?>" id="com_cert_yn" class="span250" />
            <span><?php echo $mb['mb_status']; ?></span>
        </td>
    </tr>
    <?php if($result['cnt'] > 0) {?>
    <tr>
        <td scope="row">
            인증 사진
        </td>
        <td>
            <img src="<?php echo $result['file_path'] ?>/<?php echo $result['bf_file']; ?>" width="200px" />
        </td>
    </tr>
    <?php } ?>

	<!----------------------------------------------------------------------------------------------------------------------------------------------------->
	<!----------------------------------------------------------------------------------------------------------------------------------------------------->
	<!----------------------------------------------------------------------------------------------------------------------------------------------------->

    <tr class="none">
        <th scope="row"><label for="mb_level">회원 권한</label></th>
        <td><?php //echo get_member_level_select('mb_level', 1, $member['mb_level'], $mb['mb_level']) ?></td>
    </tr>
	 
	<?php if($mb['as_date']) { ?>
		<tr class="none">
			<th scope="row"><label for="mb_level">이용 기간</label></th>
			<td>
				<?php echo date("Y년 m월 d일 H시 i분 s초", $mb['as_date']);?>까지
				:
				± <input type="text" name="as_date_plus" value="" id="as_date_plus" maxlength="20" class="frm_input" size="4"> 일 증감하기
				&nbsp;
				<label><input type="checkbox" value="1" name="as_leave" id="as_leave"> 멤버쉽 해제하기(※주의! 체크시 이용기간이 초기화됨)</label>
			</td>
		</tr>
	<?php } ?>	
	<tr class="none">
        <th scope="row"><label for="mb_homepage">홈페이지</label></th>
        <td><input type="text" name="mb_homepage" value="<?php echo $mb['mb_homepage'] ?>" id="mb_homepage" class="frm_input" maxlength="255" size="15"></td>
    </tr>
    <tr class="none">
        <th scope="row"><label for="mb_hp">휴대폰번호</label></th>
        <!-- <td><input type="text" name="mb_hp" value="<?php echo $mb['mb_hp'] ?>" id="mb_hp" class="frm_input" size="15" maxlength="20"></td> -->
    </tr>
	<tr class="none">
        <th scope="row"><label for="mb_tel">전화번호</label></th>
        <td><input type="text" name="mb_tel" value="<?php echo $mb['mb_tel'] ?>" id="mb_tel" class="frm_input" size="15" maxlength="20"></td>
    </tr>
    <tr class="none">
        <th scope="row">본인확인방법</th>
        <td>
            <input type="radio" name="mb_certify_case" value="ipin" id="mb_certify_ipin" <?php if($mb['mb_certify'] == 'ipin') echo 'checked="checked"'; ?>>
            <label for="mb_certify_ipin">아이핀</label>
            <input type="radio" name="mb_certify_case" value="hp" id="mb_certify_hp" <?php if($mb['mb_certify'] == 'hp') echo 'checked="checked"'; ?>>
            <label for="mb_certify_hp">휴대폰</label>
        </td>
    </tr>
    <tr class="none">
        <th scope="row">본인확인</th>
        <td>
            <input type="radio" name="mb_certify" value="1" id="mb_certify_yes" <?php echo $mb_certify_yes; ?>>
            <label for="mb_certify_yes">예</label>
            <input type="radio" name="mb_certify" value="" id="mb_certify_no" <?php echo $mb_certify_no; ?>>
            <label for="mb_certify_no">아니오</label>
        </td>
    </tr>
	<tr class="none">
        <th scope="row">성인인증</th>
        <td>
            <input type="radio" name="mb_adult" value="1" id="mb_adult_yes" <?php echo $mb_adult_yes; ?>>
            <label for="mb_adult_yes">예</label>
            <input type="radio" name="mb_adult" value="0" id="mb_adult_no" <?php echo $mb_adult_no; ?>>
            <label for="mb_adult_no">아니오</label>
        </td>
    </tr>
    <tr class="none">
        <th scope="row">주소</th>
        <td class="td_addr_line">
            <label for="mb_zip" class="sound_only">우편번호</label>
            <input type="text" name="mb_zip" value="<?php echo $mb['mb_zip1'].$mb['mb_zip2']; ?>" id="mb_zip" class="frm_input readonly" size="5" maxlength="6">
            <button type="button" class="btn_frmline" onclick="win_zip('fmember', 'mb_zip', 'mb_addr1', 'mb_addr2', 'mb_addr3', 'mb_addr_jibeon');">주소 검색</button><br>
            <input type="text" name="mb_addr1" value="<?php echo $mb['mb_addr1'] ?>" id="mb_addr1" class="frm_input readonly" size="60">
            <label for="mb_addr1">기본주소</label><br>
            <input type="text" name="mb_addr2" value="<?php echo $mb['mb_addr2'] ?>" id="mb_addr2" class="frm_input" size="60">
            <label for="mb_addr2">상세주소</label>
            <br>
            <input type="text" name="mb_addr3" value="<?php echo $mb['mb_addr3'] ?>" id="mb_addr3" class="frm_input" size="60">
            <label for="mb_addr3">참고항목</label>
            <input type="hidden" name="mb_addr_jibeon" value="<?php echo $mb['mb_addr_jibeon']; ?>"><br>
        </td>
    </tr>
    <tr class="none">
        <th scope="row"><label for="mb_icon">회원아이콘</label></th>
        <td>
            <?php echo help('이미지 크기는 <strong>넓이 '.$config['cf_member_icon_width'].'픽셀 높이 '.$config['cf_member_icon_height'].'픽셀</strong>로 해주세요.') ?>
            <input type="file" name="mb_icon" id="mb_icon">
            <?php
            $mb_dir = substr($mb['mb_id'],0,2);
            $icon_file = G5_DATA_PATH.'/member/'.$mb_dir.'/'.$mb['mb_id'].'.gif';
            if (file_exists($icon_file)) {
                $icon_url = G5_DATA_URL.'/member/'.$mb_dir.'/'.$mb['mb_id'].'.gif';
                echo '<img src="'.$icon_url.'" alt="">';
                echo '<input type="checkbox" id="del_mb_icon" name="del_mb_icon" value="1">삭제';
            }
            ?>
        </td>
    </tr>
    <tr class="none">
        <th scope="row"><label for="mb_img">회원이미지</label></th>
        <td>
            <?php echo help('이미지 크기는 <strong>넓이 '.$config['cf_member_img_width'].'픽셀 높이 '.$config['cf_member_img_height'].'픽셀</strong>로 해주세요.') ?>
            <input type="file" name="mb_img" id="mb_img">
            <?php
            $mb_dir = substr($mb['mb_id'],0,2);
            $icon_file = G5_DATA_PATH.'/member_image/'.$mb_dir.'/'.$mb['mb_id'].'.gif';
            if (file_exists($icon_file)) {
                $icon_url = G5_DATA_URL.'/member_image/'.$mb_dir.'/'.$mb['mb_id'].'.gif';
                echo '<img src="'.$icon_url.'" alt="">';
                echo '<input type="checkbox" id="del_mb_img" name="del_mb_img" value="1">삭제';
            }
            ?>
        </td>
    </tr>	
	<tr class="none">
        <th scope="row"><label for="mb_sms_yes">SMS 수신</label></th>
        <td>
            <input type="radio" name="mb_sms" value="1" id="mb_sms_yes" <?php echo $mb_sms_yes; ?>>
            <label for="mb_sms_yes">예</label>
            <input type="radio" name="mb_sms" value="0" id="mb_sms_no" <?php echo $mb_sms_no; ?>>
            <label for="mb_sms_no">아니오</label>
        </td>
    </tr>
    <tr class="none">
        <th scope="row">정보 공개</th>
        <td>
            <input type="radio" name="mb_open" value="1" id="mb_open_yes" <?php echo $mb_open_yes; ?>>
            <label for="mb_open_yes">예</label>
            <input type="radio" name="mb_open" value="0" id="mb_open_no" <?php echo $mb_open_no; ?>>
            <label for="mb_open_no">아니오</label>
        </td>
    </tr>
    <tr class="none">
        <th scope="row"><label for="mb_signature">그 밖의 간략한 소개 (서명)</label></th>
        <td><textarea  name="mb_signature" id="mb_signature"><?php echo $mb['mb_signature'] ?></textarea></td>
    </tr>
    <tr class="none">
        <th scope="row"><label for="mb_profile">주요경력(기존 자기소개)</label></th>
        <td><textarea name="mb_profile" id="mb_profile"><?php echo $mb['mb_profile'] ?></textarea></td>
    </tr>
    <tr class="none">
        <th scope="row"><label for="mb_memo">메모</label></th>
        <td><textarea name="mb_memo" id="mb_memo"><?php echo $mb['mb_memo'] ?></textarea></td>
    </tr>

    <?php if ($w == 'u') { ?>
    <tr class="none">
        <th scope="row">회원가입일</th>
        <td><?php echo $mb['mb_datetime'] ?></td>
        <th scope="row">최근접속일</th>
        <td><?php echo $mb['mb_today_login'] ?></td>
    </tr>
    <tr class="none">
        <th scope="row">IP</th>
        <td><?php echo $mb['mb_ip'] ?></td>
    </tr>
    <?php if ($config['cf_use_email_certify']) { ?>
    <tr class="none">
        <th scope="row">인증일시</th>
        <td>
            <?php if ($mb['mb_email_certify'] == '0000-00-00 00:00:00') { ?>
            <?php echo help('회원님이 메일을 수신할 수 없는 경우 등에 직접 인증처리를 하실 수 있습니다.') ?>
            <input type="checkbox" name="passive_certify" id="passive_certify">
            <label for="passive_certify">수동인증</label>
            <?php } else { ?>
            <?php echo $mb['mb_email_certify'] ?>
            <?php } ?>
        </td>
    </tr>
    <?php } ?>
    <?php } ?>

    <?php if ($config['cf_use_recommend']) { // 추천인 사용 ?>
    <tr class="none">
        <th scope="row">추천인</th>
        <td><?php echo ($mb['mb_recommend'] ? get_text($mb['mb_recommend']) : '없음'); // 081022 : CSRF 보안 결함으로 인한 코드 수정 ?></td>
    </tr>
    <?php } ?>

    <tr class="none">
        <th scope="row"><label for="mb_leave_date">탈퇴일자</label></th>
        <td>
            <input type="text" name="mb_leave_date" value="<?php echo $mb['mb_leave_date'] ?>" id="mb_leave_date" class="frm_input" maxlength="8">
            <input type="checkbox" value="<?php echo date("Ymd"); ?>" id="mb_leave_date_set_today" onclick="if (this.form.mb_leave_date.value==this.form.mb_leave_date.defaultValue) {
this.form.mb_leave_date.value=this.value; } else { this.form.mb_leave_date.value=this.form.mb_leave_date.defaultValue; }">
            <label for="mb_leave_date_set_today">탈퇴일을 오늘로 지정</label>
        </td>
    </tr>
	<tr class="none">
        <th scope="row">접근차단일자</th>
        <td>
            <input type="text" name="mb_intercept_date" value="<?php echo $mb['mb_intercept_date'] ?>" id="mb_intercept_date" class="frm_input" maxlength="8">
            <input type="checkbox" value="<?php echo date("Ymd"); ?>" id="mb_intercept_date_set_today" onclick="if
(this.form.mb_intercept_date.value==this.form.mb_intercept_date.defaultValue) { this.form.mb_intercept_date.value=this.value; } else {
this.form.mb_intercept_date.value=this.form.mb_intercept_date.defaultValue; }">
            <label for="mb_intercept_date_set_today">접근차단일을 오늘로 지정</label>
        </td>
    </tr>

    <?php
    //소셜계정이 있다면
    if(function_exists('social_login_link_account') && $mb['mb_id'] ){
        if( $my_social_accounts = social_login_link_account($mb['mb_id'], false, 'get_data') ){ ?>

    <tr class="none">
    <th>소셜계정목록</th>
    <td>
        <ul class="social_link_box">
            <li class="social_login_container">
                <h4>연결된 소셜 계정 목록</h4>
                <?php foreach($my_social_accounts as $account){     //반복문
                    if( empty($account) ) continue;

                    $provider = strtolower($account['provider']);
                    $provider_name = social_get_provider_service_name($provider);
                ?>
                <div class="account_provider" data-mpno="social_<?php echo $account['mp_no'];?>" >
                    <div class="sns-wrap-32 sns-wrap-over">
                        <span class="sns-icon sns-<?php echo $provider; ?>" title="<?php echo $provider_name; ?>">
                            <span class="ico"></span>
                            <span class="txt"><?php echo $provider_name; ?></span>
                        </span>

                        <span class="provider_name"><?php echo $provider_name;   //서비스이름?> ( <?php echo $account['displayname']; ?> )</span>
                        <span class="account_hidden" style="display:none"><?php echo $account['mb_id']; ?></span>
                    </div>
                    <div class="btn_info"><a href="<?php echo G5_SOCIAL_LOGIN_URL.'/unlink.php?mp_no='.$account['mp_no'] ?>" class="social_unlink" data-provider="<?php echo $account['mp_no'];?>" >연동해제</a> <span class="sound_only"><?php echo substr($account['mp_register_day'], 2, 14); ?></span></div>
                </div>
                <?php } //end foreach ?>
            </li>
        </ul>
        <script>
        jQuery(function($){
            $(".account_provider").on("click", ".social_unlink", function(e){
                e.preventDefault();

                if (!confirm('정말 이 계정 연결을 삭제하시겠습니까?')) {
                    return false;
                }

                var ajax_url = "<?php echo G5_SOCIAL_LOGIN_URL.'/unlink.php' ?>";
                var mb_id = '',
                    mp_no = $(this).attr("data-provider"),
                    $mp_el = $(this).parents(".account_provider");

                    mb_id = $mp_el.find(".account_hidden").text();

                if( ! mp_no ){
                    alert('잘못된 요청! mp_no 값이 없습니다.');
                    return;
                }

                $.ajax({
                    url: ajax_url,
                    type: 'POST',
                    data: {
                        'mp_no': mp_no,
                        'mb_id': mb_id
                    },
                    dataType: 'json',
                    async: false,
                    success: function(data, textStatus) {
                        if (data.error) {
                            alert(data.error);
                            return false;
                        } else {
                            alert("연결이 해제 되었습니다.");
                            $mp_el.fadeOut("normal", function() {
                                $(this).remove();
                            });
                        }
                    }
                });

                return;
            });
        });
        </script>

    </td>
    </tr>

    <?php
        }   //end if
    }   //end if
    ?>

    <?php for ($i=1; $i<=10; $i++) { ?>
    <tr class="none">
        <th scope="row"><label for="mb_<?php echo $i ?>">여분 필드 <?php echo $i ?></label></th>
        <td><input type="text" name="mb_<?php echo $i ?>" value="<?php echo $mb['mb_'.$i] ?>" id="mb_<?php echo $i ?>" class="frm_input" size="30" maxlength="255"></td>
    </tr>
    <?php } ?>

    </tbody>
    </table>
</div>


<?php if ($w == 'u') { ?>
<div class="mt50"></div>
<div class="none">		
    <div class="box-header">접속이력 - 회원 로그</div>
    <div class="tbl-excel th-h1 td-h4 color-gray">				
        <table>
            <thead>
                <tr>
                    <th style="height:32px;">일시</th>
                    <th style="height:32px;">접속IP</th>
                    <th style="height:32px;">접속 위치</th>
                    <th style="height:32px;">매체</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>2022.03.14   12:40:12</td>
                    <td>112.123.45.789</td>
                    <td>한국, 서울</td>
                    <td>Windows, Chrome</td>
                </tr>
                <tr>
                    <td>2022.03.14   12:40:12</td>
                    <td>112.123.45.789</td>
                    <td>한국, 서울</td>
                    <td>Windows, Chrome</td>
                </tr>
                <tr>
                    <td>2022.03.14   12:40:12</td>
                    <td>112.123.45.789</td>
                    <td>한국, 서울</td>
                    <td>Windows, Chrome</td>
                </tr>
            </tbody>			
        </table>				
    </div>
</div>
<div class="mt50"></div>

<div class="flex">
	<div class="tbl-excel td-h4 tleft flex1">				
		<table>
			<tbody>
				<tr>
					<th width="150">추천인코드</th>
					<td><?php echo $mb['mb_recommend'];?></td>
				</tr>
			</tbody>			
		</table>				
	</div>
	<div class="tbl-excel td-h4 tleft flex1 none">				
		<table>
			<tbody>
				<tr>
					<th width="150">추천한 회원 수</th>
					<td>9명<a href="#" class="btn mini span80 fright">목록보기</a></td>
				</tr>
			</tbody>			
		</table>				
	</div>
</div>

<div class="mt25"></div>

<div class="pagination none">
	<a href="#" class="pg-btn first"></a>
	<a href="#" class="pg-btn prev"></a>
	<a href="#" class="pg-btn active">1</a>
	<a href="#" class="pg-btn">2</a>
	<a href="#" class="pg-btn">3</a>
	<a href="#" class="pg-btn">4</a>
	<a href="#" class="pg-btn">5</a>
	<a href="#" class="pg-btn">6</a>
	<a href="#" class="pg-btn">7</a>
	<a href="#" class="pg-btn">8</a>
	<a href="#" class="pg-btn">9</a>
	<a href="#" class="pg-btn">10</a>
	<a href="#" class="pg-btn next"></a>
	<a href="#" class="pg-btn last"></a>
</div>
<div class="mt40"></div>
<?php } ?>

<div class="btn_fixed_top">
    <a href="./member_list.php?<?php echo $qstr ?>" class="btn btn_02">목록</a>
    <input type="submit" value="확인" class="btn_submit btn" accesskey='s'>

    <?php if($mb['mb_status'] == '대기'){ ?>
        <input type="button" value="승인" class="btn" onclick="approve(1)">
    <?php } ?>
</div>
</form>

</div>

<script>
function fmember_submit(f)
{
    if (!f.mb_icon.value.match(/\.(gif|jpe?g|png)$/i) && f.mb_icon.value) {
        alert('아이콘은 이미지 파일만 가능합니다.');
        return false;
    }

    if (!f.mb_img.value.match(/\.(gif|jpe?g|png)$/i) && f.mb_img.value) {
        alert('회원이미지는 이미지 파일만 가능합니다.');
        return false;
    }

    return true;
}
function approve(status){
    if(confirm('직장인 인증을 하시겠습니까?')) {
        $.ajax({
            type: "POST",
            url: '/ajax/changeMemberCert.php',
            data: {'status': status, 'mb_id': "<?php echo $mb['mb_id'] ?>"},
            cache: false,
            async: false,
            dataType: "json",
            success: function (data) {
                alert('상태가 변경되었습니다.');
                location.reload();
            }
        })
    } else {
        return false;
    }
}
</script>

<?php
include_once('./admin.tail.php');
?>
