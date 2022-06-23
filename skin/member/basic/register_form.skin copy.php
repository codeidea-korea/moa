<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$skin_url.'/style.css" media="screen">', 0);

if($header_skin)
	include_once('./header.php');

?>
<script src="<?php echo G5_JS_URL ?>/jquery.register_form.js"></script>
<?php if($config['cf_cert_use'] && ($config['cf_cert_ipin'] || $config['cf_cert_hp'])) { ?>
    <script src="<?php echo G5_JS_URL ?>/certify.js?v=<?php echo APMS_SVER; ?>"></script>
<?php } ?>

<div class="contents">

			<ul class="tab tab-block">
				<li class="tab-item active myinfo" style="cursor:pointer">
					<a href="#" id="myinfo">내 정보</a>
				</li>
				<li class="tab-item mypass" style="cursor:pointer">
					<a href="#" id="mypass">비밀번호 변경</a>
				</li>
			</ul>
<section class="tab-content myinfos">

	<div class="single-header">
    	<h2>
        	<span class="typcn typcn-spanner"></i>
        	<strong>내 정보 수정</strong>
        </h2>
    </div>
    
	<div class="toast toast-success modal">
		<button class="btn btn-clear float-right"></button>
		정보 업데이트가 완료되었습니다. 
	</div>
	
	<div class="toast toast-success alert alert-warning alert-dismissible fade show" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
	    <span aria-hidden="true">&times;</span>
		</button>
	</div>

	<form cla ss="form-horizontal register-form" role="form" id="fregisterform" name="fregisterform" action="<?php echo $action_url ?>" onsubmit="return fregisterform_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off">
	<input type="hidden" name="w" value="<?php echo $w ?>">
	<input type="hidden" name="url" value="<?php echo $urlencode ?>">
	<input type="hidden" name="pim" value="<?php echo $pim;?>"> 
	<input type="hidden" name="agree" value="<?php echo $agree ?>">
	<input type="hidden" name="agree2" value="<?php echo $agree2 ?>">
	<input type="hidden" name="cert_type" value="<?php echo $member['mb_certify']; ?>">
	<input type="hidden" name="cert_no" value="">
	<?php if (isset($member['mb_sex'])) {  ?><input type="hidden" name="mb_sex" value="<?php echo $member['mb_sex'] ?>"><?php }  ?>
	<?php if (isset($member['mb_nick_date']) && $member['mb_nick_date'] > date("Y-m-d", G5_SERVER_TIME - ($config['cf_nick_modify'] * 86400))) { // 닉네임수정일이 지나지 않았다면  ?>
	<input type="hidden" name="mb_nick_default" value="<?php echo get_text($member['mb_nick']) ?>">
	<input type="hidden" name="mb_nick" value="<?php echo get_text($member['mb_nick']) ?>">
	<?php }  ?>
		<div class="form-group">
			<div class="col-3 col-sm-12">
				<label class="form-label" for="email-id">아이디</label>
			</div>
			<div class="col-9 col-sm-12">
				<input type="text" name="mb_id" value="<?php echo $member['mb_id'] ?>" id="reg_mb_id" <?php echo $required ?> <?php echo $readonly ?> class="form-control input-sm" minlength="3" maxlength="20">
		<span class="fa fa-check form-control-feedback"></span>
			</div>
		</div>
		<div class="form-group">
			<div class="col-3 col-sm-12">
				<label class="form-label" for="name">실명</label>
			</div>
			<div class="col-9 col-sm-12">
				<input type="text" id="reg_mb_name" name="mb_name" value="<?php echo get_text($member['mb_name']) ?>" <?php echo $required ?> <?php echo $readonly; ?> class="form-control input-sm" size="10">
			</div>
		</div>
		<div class="form-group">
			<div class="col-3 col-sm-12">
				<label class="form-label" for="nickname">이용자명</label>
			</div>
			<div class="col-9 col-sm-12">
				<input type="hidden" name="mb_nick_default" value="<?php echo isset($member['mb_nick']) ? get_text($member['mb_nick']) : ''; ?>">
			<input type="text" name="mb_nick" value="<?php echo isset($member['mb_nick']) ? get_text($member['mb_nick']) : ''; ?>" id="reg_mb_nick"  class="form-control input-sm nospace" size="10" maxlength="20">
			</div>
		</div>
		<div class="form-group">
			<div class="col-3 col-sm-12">
				<label class="form-label" for="contact-mobile">휴대폰 번호</label>
			</div>
			<div class="col-9 col-sm-12">
				<input type="text" name="mb_hp" value="<?php echo get_text($member['mb_hp']) ?>" id="reg_mb_hp" <?php echo ($config['cf_req_hp'])?"required":""; ?> class="form-control input-sm" maxlength="20">
			<span class="fa fa-mobile form-control-feedback"></span>
			<?php if ($config['cf_cert_use'] && $config['cf_cert_hp']) { ?>
				<input type="hidden" name="old_mb_hp" value="<?php echo get_text($member['mb_hp']) ?>">
			<?php } ?>
			</div>
		</div>
		<div class="divider"></div>
		
		<?php if ($config['cf_use_addr']) { ?>
		<div class="form-group">
			<div class="col-3 col-sm-12">
				<label class="form-label">주소</label>
			</div>
			<div class="col-9 col-sm-12">
				<div class="input-group">
					<label class="control-label"><?php if ($config['cf_req_addr']) { ?><strong class="sound_only">필수</strong><?php }  ?></label>
					<span class="input-group-addon" onclick="win_zip('fregisterform', 'mb_zip', 'mb_addr1', 'mb_addr2', 'mb_addr3', 'mb_addr_jibeon');">우편번호</span>
					<input type="text" name="mb_zip" value="<?php echo $member['mb_zip1'].$member['mb_zip2'] ?>" id="reg_mb_zip" <?php echo $config['cf_req_addr']?"required":""; ?> class="form-input" size="6" maxlength="6" placeholder="우편번호 검색을 이용해주세요." onclick="win_zip('fregisterform', 'mb_zip', 'mb_addr1', 'mb_addr2', 'mb_addr3', 'mb_addr_jibeon');" readonly>
	                <button type="button" class="btn input-group-btn" style="margin-top:0px;" onclick="win_zip('fregisterform', 'mb_zip', 'mb_addr1', 'mb_addr2', 'mb_addr3', 'mb_addr_jibeon');">검색하기</button>
				</div>
			</div>
		</div>
		
		<div class="form-group">
			<div class="col-3 col-sm-12"></div>
			<div class="col-9 col-sm-12">
				<label class="sound_only" for="reg_mb_addr1">기본주소<?php echo $config['cf_req_addr']?'<strong class="sound_only"> 필수</strong>':''; ?></label>
				<input type="text" name="mb_addr1" value="<?php echo get_text($member['mb_addr1']) ?>" id="reg_mb_addr1" <?php echo $config['cf_req_addr']?"required":""; ?> class="form-control input-sm" size="50" placeholder="자동으로 입력됩니다." readonly>
			</div>
		</div>
		<div class="form-group">
			<div class="col-3 col-sm-12"></div>
			<div class="col-9 col-sm-12">
				<label class="sound_only" for="reg_mb_addr2">상세주소</label>
				<input type="text" name="mb_addr2" value="<?php echo get_text($member['mb_addr2']) ?>" id="reg_mb_addr2" class="form-control input-sm" size="50" placeholder="상세주소를 입력해주세요. 예) 통의동 35-22">
			</div>
		</div>
		<div class="form-group">
			<div class="col-3 col-sm-12"></div>
			<div class="col-9 col-sm-12">
			<label class="sound_only" for="reg_mb_addr3">배송시 참고사항</label>
			<input type="text" name="mb_addr3" value="<?php echo get_text($member['mb_addr3']) ?>" id="reg_mb_addr3" class="form-control input-sm" size="50" placeholder="배송시 참고사항">
			<input type="hidden" name="mb_addr_jibeon" value="<?php echo get_text($member['mb_addr_jibeon']); ?>">
		</div>
	</div>
		
	<?php }  ?>
	
	<div class="divider"></div>
	<!--
	<button type="submit" class="btn btn-primary btn-block btn-lg" accesskey="s" data-dismiss="alert" aria-label="Close"><i class="icon icon-check"></i> <?php echo $w==''?'회원가입':'정보수정'; ?></button>
	-->
	<input type="submit" class="btn btn-primary btn-block btn-lg" accesskey="s"  value="<?php echo $w==''?'회원가입':'정보수정'; ?>">

</section>
</form>
	<section class="tab-content mypasss" style="display:none">
        <div class="single-header">
        	<h2>
            	<span class="typcn typcn-spanner">
            	<strong>내 비밀번호 변경</strong>
            </span></h2>
        </div>

		<form cla ss="form-horizontal register-form" role="form" id="fregisterform2" name="fregisterform2" action="<?php echo "/bbs/register_form_update2.php" ?>" onsubmit="return fregisterform_submit2(this);" method="post" enctype="multipart/form-data" autocomplete="off">
			<input type="hidden" name="w" value="<?php echo $w ?>">
			<input type="hidden" name="url" value="<?php echo $urlencode ?>">
			<input type="hidden" name="pim" value="<?php echo $pim;?>"> 
			
			<input type="hidden" name="mb_id" value="<?php echo $member['mb_id'] ?>">
			<div class="form-group has-error">
				<div class="col-3 col-sm-12">
					<label class="form-label" for="pass">현재 비밀번호</label>
				</div>
				<div class="col-9 col-sm-12">
					<input class="form-input" type="password" id="mb_password_old" placeholder="●●●●●●">
					<p class="form-input-hint">현재 비밀번호를 입력해 주세요.</p>
				</div>
			</div>
			<div class="divider"></div>
			<div class="form-group">
				<div class="col-3 col-sm-12">
					<label class="form-label" for="pass">새 비밀번호</label>
				</div>
				<div class="col-9 col-sm-12">
					<input class="form-input" type="password" id="mb_password" name="mb_password" placeholder="●●●●●●">
				</div>
			</div>
			<div class="form-group">
				<div class="col-3 col-sm-12">
					<label class="form-label" for="pass">새 비밀번호 확인</label>
				</div>
				<div class="col-9 col-sm-12">
					<input class="form-input" type="password" id="mb_password_re"  name="mb_password_re" placeholder="●●●●●●">
				</div>
			</div>
			<div class="divider"></div>
			<input type="submit" class="btn btn-primary btn-block btn-lg" value="비밀번호 수정하기">
		</form>


</div>
</section>


<script>
$(function() {
	$("#reg_zip_find").css("display", "inline-block");

	<?php if($config['cf_cert_use'] && $config['cf_cert_ipin']) { ?>
	// 아이핀인증
	$("#win_ipin_cert").click(function(e) {
		if(!cert_confirm())
			return false;

		var url = "<?php echo G5_OKNAME_URL; ?>/ipin1.php";
		certify_win_open('kcb-ipin', url, e);
		return;
	});

	<?php } ?>
	<?php if($config['cf_cert_use'] && $config['cf_cert_hp']) { ?>
	// 휴대폰인증
	$("#win_hp_cert").click(function(e) {
		if(!cert_confirm())
			return false;

		<?php
		switch($config['cf_cert_hp']) {
			case 'kcb':
				$cert_url = G5_OKNAME_URL.'/hpcert1.php';
				$cert_type = 'kcb-hp';
				break;
			case 'kcp':
				$cert_url = G5_KCPCERT_URL.'/kcpcert_form.php';
				$cert_type = 'kcp-hp';
				break;
			case 'lg':
				$cert_url = G5_LGXPAY_URL.'/AuthOnlyReq.php';
				$cert_type = 'lg-hp';
				break;
			default:
				echo 'alert("기본환경설정에서 휴대폰 본인확인 설정을 해주십시오");';
				echo 'return false;';
				break;
		}
		?>

		certify_win_open("<?php echo $cert_type; ?>", "<?php echo $cert_url; ?>", e);
		return;
	});
	<?php } ?>
});

// submit 최종 폼체크
function fregisterform_submit(f) {
	//alert(f);
	// 회원아이디 검사
	if (f.w.value == "") {
		var msg = reg_mb_id_check();
		if (msg) {
			alert(msg);
			f.mb_id.select();
			return false;
		}
	}

	if (f.w.value == "") {
		if (f.mb_password.value.length < 3) {
			alert("비밀번호를 3글자 이상 입력하십시오.");
			f.mb_password.focus();
			return false;
		}
	}

	if (f.mb_password.value != f.mb_password_re.value) {
		alert("비밀번호가 같지 않습니다.");
		f.mb_password_re.focus();
		return false;
	}

	if (f.mb_password.value.length > 0) {
		if (f.mb_password_re.value.length < 3) {
			alert("비밀번호를 3글자 이상 입력하십시오.");
			f.mb_password_re.focus();
			return false;
		}
	}

	// 이름 검사
	if (f.w.value=="") {
		if (f.mb_name.value.length < 1) {
			alert("이름을 입력하십시오.");
			f.mb_name.focus();
			return false;
		}

		/*
		var pattern = /([^가-힣\x20])/i;
		if (pattern.test(f.mb_name.value)) {
			alert("이름은 한글로 입력하십시오.");
			f.mb_name.select();
			return false;
		}
		*/
	}

	<?php if($w == '' && $config['cf_cert_use'] && $config['cf_cert_req']) { ?>
	// 본인확인 체크
	if(f.cert_no.value=="") {
		alert("회원가입을 위해서는 본인확인을 해주셔야 합니다.");
		return false;
	}
	<?php } ?>
	// E-mail 검사
	if ((f.w.value == "") || (f.w.value == "u" && f.mb_email.defaultValue != f.mb_email.value)) {
		var msg = reg_mb_email_check();
		if (msg) {
			alert(msg);
			f.reg_mb_email.select();
			return false;
		}
	}
	
		

	//document.getElementById("btn_submit").disabled = "disabled";

	return true;
}


// submit 최종 폼체크
function fregisterform_submit2(f) {

	if (f.w.value == "") {
		if (f.mb_password_old.value.length < 3) {
			alert("이전비밀번호를 3글자 이상 입력하십시오.");
			f.mb_password_old.focus();
			return false;
		}
		if (f.mb_password.value.length < 3) {
			alert("비밀번호를 3글자 이상 입력하십시오.");
			f.mb_password.focus();
			return false;
		}
	}

	if (f.mb_password.value != f.mb_password_re.value) {
		alert("비밀번호가 같지 않습니다.");
		f.mb_password_re.focus();
		return false;
	}

	if (f.mb_password.value.length > 0) {
		if (f.mb_password_re.value.length < 3) {
			alert("비밀번호를 3글자 이상 입력하십시오.");
			f.mb_password_re.focus();
			return false;
		}
	}

	

	return true;
}

$(function() {
	$("#myinfo").click(function() {
		$(".myinfos").show();
		$(".mypasss").hide();

	});
	$("#mypass").click(function() {
		$(".myinfos").hide();
		$(".mypasss").show();
	});
});
</script>
