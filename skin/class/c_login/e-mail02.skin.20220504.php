<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>
 <section class="wrapper">
 <form id="fregisterform" name="fregisterform" action="./e-mail02.php" onsubmit="return fregisterform_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off">
        <input type="hidden" name="w" value="<?php echo $w ?>">
        <input type="hidden" name="url" value="<?php echo $urlencode ?>">
        
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
            <input type="hidden" name="mb_id" value="<?php echo $mb_id;?>">
            <?php echo $mb_id;?>
        </div>
        <div class="agree_area">
            <div class="all_agree">
                <input type="checkbox" id="agreeall" >
                <label for="agree1">전체 동의</label>
            </div>
            <div class="agree_list">
                <div>
                    <input type="checkbox" id="agree1" name="agree1" value="1">
                    <label for="agree1">[필수] 만14세 이상이며 모두 동의합니다.</label>
                </div>
                <div>
                    <input type="checkbox" id="agree2" name="agree2" value="1">
                    <label for="agree2">[필수] 이용약관에 모두 동의합니다. </label>
                </div>
                <div>
                    <input type="checkbox" id="agree3" name="agree3" value='1'>
                    <label for="agree3">[필수] 개인정보 처리방침</label>
                </div>
                <div>
                    <input type="checkbox" id="agree5" name="agree5">
                    <label for="agree5">[선택] 광고성 정보 수신에 모두 동의합니다.</label>
                    <div class="selec">
                        <ul>
                            <li>
                                <input type="checkbox" id="box6" name="box6" value="1">
                                <label for="box6">PUSH 알림</label>
                            </li>
                            <li>
                                <input type="checkbox" id="box7" name="box7" value="1">
                                <label for="box7">이메일</label>
                            </li>
                            <li>
                                <input type="checkbox" id="box8" name="box8" value="1" >
                                <label for="box8">SMS</label>
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
            <button class="inactive on" onclick="location.href='<?php echo C_LOGIN_PATH;?>/sign_up.php'">다음</button>
        </div>
        
    </div>
    </form>
</section>