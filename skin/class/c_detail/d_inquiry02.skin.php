<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>

<!-- 문의 작성 -->
<section class="wrapper01">
    <div class="s_content">
        <div class="inquiry_area">
            <textarea name="" id="" placeholder="문의내용을 입력해주세요."></textarea>
            <div class="lounchecL pay_radio mt25">
                <input type="checkbox" id="box_1" name="sequence">
                <label for="box_1">비밀글</label>
            </div>
        </div>
    </div>
    <div class="centerbtn mt25 last_cnt">
        <button class="w100" onclick="$('#alert08').addClass('on')">등록하기</button>
    </div>
</section>
<div class="alert02" id="alert08">
    <div class="layerBody">
        <div class="confirm">
            <div class="mentBox">
                <p class="t_bold">[문의 등록 완료]</p>
                <span class="">문의 등록이 완료되었습니다</span>
                <div class="btn_area">
                    <button class="gn w100" onclick="location.href='<?php echo MOA_DETAIL_URL;?>/d_inquiry01.php'">확인</button>
                </div>
            </div>
        </div>
    </div>
</div>
