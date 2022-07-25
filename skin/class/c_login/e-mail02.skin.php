<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>
<script src="/js/common.js?ver=<?php echo G5_JS_VER;?>"></script>
<script>
var g5_bbs_url   = "/bbs";
</script>
 <section class="wrapper">
 <form id="fregisterform" name="fregisterform" action="<?php echo $register_action_url ?>" onsubmit="return fregisterform_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off">
        <input type="hidden" name="w" value="<?php echo $w ?>">
        <input type="hidden" name="url" value="<?php echo $urlencode ?>">
        <input type="hidden" name="token" id="token" value="">
        
        <input type="hidden" name="cert_type" value="<?php echo $member['mb_certify']; ?>">
        <input type="hidden" name="cert_no" value="">
        <?php if (isset($member['mb_sex'])) {  ?><input type="hidden" name="mb_sex" value="<?php echo $member['mb_sex'] ?>"><?php }  ?>
        <?php if (isset($member['mb_nick_date']) && $member['mb_nick_date'] > date("Y-m-d", G5_SERVER_TIME - ($config['cf_nick_modify'] * 86400))) { // 닉네임수정일이 지나지 않았다면  ?>
            <input type="hidden" name="mb_nick_default" value="<?php echo get_text($member['mb_nick']) ?>">
            <input type="hidden" name="mb_nick" value="<?php echo get_text($member['mb_nick']) ?>">
        <?php }  
        else {?>
        <input type="hidden" name="mb_name" value="<?php echo $mb_name ?>">
        <input type="hidden" name="mb_nick" value="<?php echo $mb_nick ?>">
        <?php } ?>
    <div class="content">
        <div class="line_input">
            <p>이메일 주소</p>
            <input type="hidden" name="mb_email" value="<?php echo $mb_email;?>">
            <input type="hidden" name="mb_password" value="<?php echo $mb_password;?>">
            <input type="hidden" name="mb_password_re" value="<?php echo $mb_password_re;?>">
            <input type="hidden" name="mb_id" value="<?php echo $mb_id;?>">
			<input type="hidden" name="mb_hp" value="<?php echo $mb_hp;?>">
            <input type="hidden" name="mb_birth" value="<?php echo $mb_birth;?>">
            <?php echo $mb_id;?>
        </div>
        <div class="agree_area">
            <div class="all_agree">
                <input type="checkbox" id="agreeall" >
                <label for="agreeall">전체 동의</label>
            </div>
            <div class="agree_list">
                <div>
                    <input type="checkbox" id="agree1" name="agree1" required value="1" class="agreechk">
                    <label for="agree1">[필수] 만14세 이상이며 모두 동의합니다. 가나다</label>
                </div>
                <div>
                    <input type="checkbox" id="agree2" name="agree2" required value="1" class="agreechk">
                    <label for="agree2">[필수] 이용약관에 모두 동의합니다.</label>
                </div>
                <div>
                    <input type="checkbox" id="agree3" name="agree3" required value='1' class="agreechk">
                    <label for="agree3">[필수] 개인정보 처리방침</label>
                </div>
                <div>
                    <input type="checkbox" id="agree5" name="agree5" class="agreechk">
                    <label for="agree5">[선택] 광고성 정보 수신에 모두 동의합니다.</label>
                    <div class="selec">
                        <ul>
                            <li>
                                <input type="checkbox" id="agree6" name="agree6" value="1" class="boxs">
                                <label for="agree6">PUSH 알림</label>
                            </li>
                            <li>
                                <input type="checkbox" id="agree7" name="agree7" value="1" class="boxs">
                                <label for="agree7">이메일</label>
                            </li>
                            <li>
                                <input type="checkbox" id="agree8" name="agree8" value="1"  class="boxs">
                                <label for="agree8">SMS</label>
                            </li>
                            <li>
                                <p>
                                    이벤트 혜택 등 다양한 정보를 받을 수 있어요
                                </p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            
        </div>
        <div class="p38">
            <button type="submit" class="singup inactive on">다음</button>
        </div>

    </div>
    </form>
</section>


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

    $("#agreeall").change(function() {
        var allchk = $("#agreeall").is(":checked");
        if (allchk) {
            $(".agreechk").prop('checked',true);
        }
        else {
            $(".agreechk").prop('checked',false);
        }
        var chk5 = $("#agree5").is(":checked");
        if (chk5) {
            $(".boxs").prop('checked',true);
        }
        else {
            $(".boxs").prop('checked',false);
        }
    });

    $("#agree5").change(function() {
        var chk5 = $("#agree5").is(":checked");
        if (chk5) {
            $(".boxs").prop('checked',true);
        }
        else {
            $(".boxs").prop('checked',false);
        }
    });

    function regtoken() {
        var f = document.fregisterform;
        var token = get_write_token('register');

        if(!token) {
            alert(aslang[41]); //토큰 정보가 올바르지 않습니다.
            return false;
        }

        var $f = $(f);

        // if(typeof f.token === "undefined")
        //     $f.prepend('<input type="hidden" name="token" value="">');

        //$f.find("input[name=token]").val(token);
        $("#token").val(token);

     //   return true;
    };
    regtoken();
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
