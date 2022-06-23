<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

include_once(G5_CAPTCHA_PATH.'/captcha.lib.php');
?>
<div class="btn-group btn-group-block">
    <button type="button" class="btn btn-primary">로그인</button>
    <button type="button" class="btn">회원가입</button>
</div>

<!-- 로그인 레이어 -->
<div id="pop-login" class="layer-set layer-sticky" style="display:none;">
    <div class="layer layer-sm">
        <button type="button" class="btn-layer-close"><i class="icon icon-cross">닫기</i></button>
        <div class="layer-header">
            <h4>시작하기</h4>
        </div>
        <div class="layer-body">
            <form name="foutlogin" action="<?php echo $outlogin_action_url ?>" onsubmit="return fhead_submit(this);" method="post" autocomplete="off">
                <fieldset>
                    <input type="hidden" name="url" value="<?php echo $outlogin_url ?>">
                    <div class="form-group">
                        <label for="ol_id" id="ol_idlabel" class="form-label sound_only">Email<strong>필수</strong></label>
                        <input type="text" id="ol_id" name="mb_id" required maxlength="200" class="form-input" placeholder="email">
                    </div>
                    <div class="form-group">
                        <label for="ol_pw" id="ol_pwlabel" class="form-label sound_only">비밀번호<strong>필수</strong></label>
                        <input type="password" name="mb_password" id="ol_pw" required maxlength="20" class="form-input" placeholder="비밀번호">
                    </div>
                    <div class="form-group">
                        <label class="form-switch">
                            <input type="checkbox" name="auto_login" value="1" id="auto_login">
                            <i class="form-icon"></i> 내 로그인 정보 기억하기
                        </label>
                    </div>
                    <input type="submit" id="ol_submit" value="로그인" class="btn btn-block btn-lg">
                </fieldset>
            </form>
        </div>
        <div class="layer-tint">
            <a href="#" class="text-dark">아이디/비밀번호를 찾아주세요</a>
        </div>
    </div>
</div>

<script>
    $omi = $('#ol_id');
    $omp = $('#ol_pw');
    $omi_label = $('#ol_idlabel');
    $omi_label.addClass('ol_idlabel');
    $omp_label = $('#ol_pwlabel');
    $omp_label.addClass('ol_pwlabel');

    $(function() {

        $("#auto_login").click(function(){
            if ($(this).is(":checked")) {
                if(!confirm("자동로그인을 사용하시면 다음부터 회원아이디와 비밀번호를 입력하실 필요가 없습니다.\n\n공공장소에서는 개인정보가 유출될 수 있으니 사용을 자제하여 주십시오.\n\n자동로그인을 사용하시겠습니까?"))
                    return false;
            }
        });
    });

    function fhead_submit(f)
    {
        return true;
    }
</script>

<!-- 계정찾기 레이어 -->
<div id="pop-find-account" class="layer-set layer-sticky" style="display:none;">
<?php

$skin_path = $member_skin_path;
$skin_url = $member_skin_url;

$action_url = G5_HTTPS_BBS_URL."/password_lost2.php";
?>
    <div class="layer layer-sm">
        <button type="button" class="btn-layer-close"><i class="icon icon-cross">닫기</i></button>
        <div class="layer-header">
            <h4>내 정보 찾기</h4>
        </div>
        <div class="layer-body">
            <p class="box-desc">가입된 이메일 정보를 입력해주시면, 비밀번호를 리셋할 수 있는 URL을 메일로 보내드려요.</p>
            <form m class="form-horizontal" role="form" name="fpasswordlost" action="<?php echo $action_url ?>" onsubmit="return fpasswordlost_submit(this);" method="post" autocomplete="off">
                <fieldset>
                    <div class="form-group has-error">
                        <label class="form-label" for="input-find-id">이메일</label>
                        <input class="form-input" type="text" id="input-find-id" placeholder="ex) uhd@music.com" autocomplete="email">
                        <p class="form-input-hint">존재하지 않는 가입 정보입니다.</p>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-10">
                            <?php echo captcha_html(); ?>
                        </div>
                    </div>
                    <button class="btn btn-block btn-primary btn-lg">메일보내기 <i class="icon icon-forward"></i></button>
                </fieldset>
            </form>
        </div>
    </div>
</div>

<script>
function fpasswordlost_submit(f) {
    <?php echo chk_captcha_js();  ?>

    return true;
}
/*
$(function() {
    var sw = screen.width;
    var sh = screen.height;
    var cw = document.body.clientWidth;
    var ch = document.body.clientHeight;
    var top  = sh / 2 - ch / 2 - 100;
    var left = sw / 2 - cw / 2;
    moveTo(left, top);
});
*/
</script>
<!-- 회원가입 레이어 -->
<script src="<?php echo G5_JS_URL ?>/jquery.register_form.js"></script>
<?php if($config['cf_cert_use'] && ($config['cf_cert_ipin'] || $config['cf_cert_hp'])) { ?>
    <script src="<?php echo G5_JS_URL ?>/certify.js?v=<?php echo G5_JS_VER; ?>"></script>
<?php } ?>
<?php
$register_action_url = "/bbs/register_form_update.php";
?>
<div id="pop-register" class="layer-set layer-sticky">
    <form id="fregisterform" name="fregisterform" action="<?php echo $register_action_url ?>" onsubmit="return fregisterform_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off">
        <input type="hidden" name="w" value="<?php echo $w ?>">
        <input type="hidden" name="url" value="<?php echo $urlencode ?>">
        <input type="hidden" name="agree" value="<?php echo $agree ?>">
        <input type="hidden" name="agree2" value="<?php echo $agree2 ?>">
        <input type="hidden" name="cert_type" value="<?php echo $member['mb_certify']; ?>">
        <input type="hidden" name="cert_no" value="">
        <?php if (isset($member['mb_sex'])) {  ?><input type="hidden" name="mb_sex" value="<?php echo $member['mb_sex'] ?>"><?php }  ?>
        <?php if (isset($member['mb_nick_date']) && $member['mb_nick_date'] > date("Y-m-d", G5_SERVER_TIME - ($config['cf_nick_modify'] * 86400))) { // 닉네임수정일이 지나지 않았다면  ?>
            <input type="hidden" name="mb_nick_default" value="<?php echo get_text($member['mb_nick']) ?>">
            <input type="hidden" name="mb_nick" value="<?php echo get_text($member['mb_nick']) ?>">
        <?php }  ?>
        <div class="layer layer-sm">
            <button type="button" class="btn-layer-close"><i class="icon icon-cross"></i></button>
            <div class="layer-header">
                <h4>회원가입하기</h4>
            </div>
            <div class="layer-body">
                <form>
                    <fieldset>
                        <div class="form-group">
                            <label class="form-label" for="input-register-id">이메일</label>

                            <input type="hidden" name="mb_email" value="<?php echo $member['mb_email'] ?>" id="reg_mb_email"  maxlength="150" >
                            <input type="text" name="mb_id" value="<?php echo $member['mb_id'] ?>" id="reg_mb_id" <?php echo $required ?> <?php echo $readonly ?> class="form-input half_input <?php echo $required ?> <?php echo $readonly ?>" minlength="3" maxlength="150" placeholder="Email ">
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="input-register-pass">비밀번호</label>
                            <input type="password" name="mb_password" id="reg_mb_password" <?php echo $required ?> class="form-input half_input <?php echo $required ?>" minlength="3" maxlength="20" placeholder="비밀번호">
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="input-register-pass">비밀번호 확인</label>
                            <input type="password" name="mb_password_re" id="reg_mb_password_re" <?php echo $required ?> class="form-input half_input right_input <?php echo $required ?>" minlength="3" maxlength="20" placeholder="비밀번호 확인">
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="input-register-pass">이름</label>
                            <input type="text" id="reg_mb_name" name="mb_name" value="<?php echo get_text($member['mb_name']) ?>" <?php echo $required ?> <?php echo $readonly; ?> class="form-input half_input <?php echo $required ?> <?php echo $readonly ?>" size="10" placeholder="이름">
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="input-register-name">닉네임</label>
                            <input type="hidden" name="mb_nick_default" value="<?php echo isset($member['mb_nick'])?get_text($member['mb_nick']):''; ?>">
                            <input type="text" name="mb_nick" value="<?php echo isset($member['mb_nick'])?get_text($member['mb_nick']):''; ?>" id="reg_mb_nick" required class="form-input required nospace  half_input" size="10" maxlength="20" placeholder="닉네임">
                            <p class="form-input-hint" style="display:none"></p>
                        </div>
                        <div class="form-group">
                            <label class="form-switch">
                                <input type="checkbox">
                                <i class="form-icon"></i> <a href="#" class="text-dark">이용약관</a>에 동의합니다.
                            </label>
                        </div>
                        <input type="submit" value="회원가입" id="btn_submit" class="btn btn-block btn-lg" accesskey="s">
                    </fieldset>
                </form>
            </div>
        </div>
    </form>
</div>

<script>
$(function() {
    $("#reg_zip_find").css("display", "inline-block");

    <?php if($config['cf_cert_use'] && $config['cf_cert_ipin']) { ?>
    // 아이핀인증
    $("#win_ipin_cert").click(function() {
        if(!cert_confirm())
            return false;

        var url = "<?php echo G5_OKNAME_URL; ?>/ipin1.php";
        certify_win_open('kcb-ipin', url);
        return;
    });

    <?php } ?>
    <?php if($config['cf_cert_use'] && $config['cf_cert_hp']) { ?>
    // 휴대폰인증
    $("#win_hp_cert").click(function() {
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

        certify_win_open("<?php echo $cert_type; ?>", "<?php echo $cert_url; ?>");
        return;
    });
    <?php } ?>
});

// submit 최종 폼체크
function fregisterform_submit(f)
{
    // 회원아이디 검사
    if (f.w.value == "") {
        var msg = reg_mb_id_check();
        if (msg) {
            alert(msg);
            f.mb_id.select();
            return false;
        }
    }
    f.mb_email.value = f.mb_id.value;

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

    // 닉네임 검사
    if ((f.w.value == "") || (f.w.value == "u" && f.mb_nick.defaultValue != f.mb_nick.value)) {
        var msg = reg_mb_nick_check();
        if (msg) {
            alert(msg);
            f.reg_mb_nick.select();
            return false;
        }
    }

    // E-mail 검사
    if ((f.w.value == "") || (f.w.value == "u" && f.mb_email.defaultValue != f.mb_email.value)) {
        var msg = reg_mb_email_check();
        if (msg) {
            alert(msg);
            f.reg_mb_email.select();
            return false;
        }
    }

    <?php if (($config['cf_use_hp'] || $config['cf_cert_hp']) && $config['cf_req_hp']) {  ?>
    // 휴대폰번호 체크
    var msg = reg_mb_hp_check();
    if (msg) {
        alert(msg);
        f.reg_mb_hp.select();
        return false;
    }
    <?php } ?>

    if (typeof f.mb_icon != "undefined") {
        if (f.mb_icon.value) {
            if (!f.mb_icon.value.toLowerCase().match(/.(gif|jpe?g|png)$/i)) {
                alert("회원아이콘이 이미지 파일이 아닙니다.");
                f.mb_icon.focus();
                return false;
            }
        }
    }

    if (typeof f.mb_img != "undefined") {
        if (f.mb_img.value) {
            if (!f.mb_img.value.toLowerCase().match(/.(gif|jpe?g|png)$/i)) {
                alert("회원이미지가 이미지 파일이 아닙니다.");
                f.mb_img.focus();
                return false;
            }
        }
    }

    if (typeof(f.mb_recommend) != "undefined" && f.mb_recommend.value) {
        if (f.mb_id.value == f.mb_recommend.value) {
            alert("본인을 추천할 수 없습니다.");
            f.mb_recommend.focus();
            return false;
        }

        var msg = reg_mb_recommend_check();
        if (msg) {
            alert(msg);
            f.mb_recommend.select();
            return false;
        }
    }

    document.getElementById("btn_submit").disabled = "disabled";

    return true;
}
</script>
