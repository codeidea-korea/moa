<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>

<section>
<script src="<?php echo G5_JS_URL ?>/jquery.register_form.js"></script>
<?php if($config['cf_cert_use'] && ($config['cf_cert_ipin'] || $config['cf_cert_hp'])) { ?>
    <script src="<?php echo G5_JS_URL ?>/certify.js?v=<?php echo APMS_SVER; ?>"></script>
<?php } ?>

<form id="fregisterform" name="fregisterform" action="<?php echo MOA_LOGIN_URL; ?>/e-mail02.php" method="post" enctype="multipart/form-data" autocomplete="off">
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
    <div class="wrapper">
        <div class="content">
            <div class="line_input">
                <p>이메일 주소</p>
                <input type="hidden" name="mb_email" value="<?php echo $member['mb_email'] ?>" id="reg_mb_email" maxlength="150" >
                <input type="email" placeholder="예) moa@moa.co.kr" oninvalid="this.setCustomValidity('이메일을 입력해주세요.')" oninput="this.setCustomValidity('')"  name="mb_id" value="<?php echo $member['mb_id'] ?>" id="reg_mb_id" required <?php echo $readonly ?> class="form-input half_input required <?php echo $readonly ?>" minlength="3" maxlength="150" >
                <p>비밀번호</p>
                <input type="password" type="password" name="mb_password" oninvalid="this.setCustomValidity('비밀번호를 입력해주세요.')" oninput="this.setCustomValidity('')" id="reg_mb_password" required
                    placeholder="비밀번호">
                <p>비밀번호 확인</p>
                <input class="error" type="password" name="mb_password_re" id="reg_mb_password_re" required
                    placeholder="비밀번호 확인">
                <span class="warning">비밀번호가 일치하지 않습니다.</span>
                <p>이름</p>
                <input type="text" id="reg_mb_name" name="mb_name" oninvalid="this.setCustomValidity('이름을 입력해주세요.')" oninput="this.setCustomValidity('')" value="<?php echo get_text($member['mb_name']) ?>" required <?php echo $readonly; ?> class="form-input half_input required <?php echo $readonly ?>" size="10" placeholder="이름">
                <p>닉네임</p>
                <input type="hidden" name="mb_nick_default" value="<?php echo isset($member['mb_nick'])?get_text($member['mb_nick']):''; ?>">
                            <input type="text" oninvalid="this.setCustomValidity('닉네임을 입력해주세요.')" oninput="this.setCustomValidity('')" name="mb_nick" value="<?php echo isset($member['mb_nick'])?get_text($member['mb_nick']):''; ?>" id="reg_mb_nick" required class="form-input required nospace  half_input" size="10" maxlength="20" placeholder="닉네임">
                            <p class="form-input-hint" style="display:none"></p>
                
            </div>
            <div class="p156">
                <button class="inactive on" type="submit">다음</button>
            </div>
        </div>
    </div>
    
</form>

</section>
<script>
$(function() {
    $("#reg_mb_password, #reg_mb_password_re").change(function() {
        var pwd1 = $("#reg_mb_password").val();
        var pwd2 = $("#reg_mb_password_re").val();
        if (pwd1 == pwd2) {
            $(".warning").hide();
            $("#reg_mb_password_re").removeClass("error");
        }
        else {
            $(".warning").show();
            $("#reg_mb_password_re").addClass("error");
        }
    });

    $('#fregisterform').submit(function(){
        var email = $('input[name="mb_id"]').val();

        var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;


        if (!re.test(email)) {
            alert("올바른 이메일 주소를 입력하세요");
            return false;
        }
    })
});
</script>