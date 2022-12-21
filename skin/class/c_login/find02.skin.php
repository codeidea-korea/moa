<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>

<section class="wrapper">
    <div class="s_content">
        <div class="signup_area">
            <div class="common_input">
                <input type="text" placeholder="이름">
            </div>
            <div class="common_input">
                <input type="text" placeholder="이메일">
            </div>
            <span class="warning p0">
                새로운 비밀번호 설정 가능한 링크 전송을 요청했습니다. 이메일이 오지 않으면 입력 정보가 정확한지 다시 확인해주세요.
            </span>
            <div class="p45">
                <button class="inactive on" onclick="$('#alert01').addClass('on')">이메일로 비밀번호 전송</button>
            </div>
        </div>
    </div>
</section>

<!-- 완료 팝업창 -->
<div class="alert" id="alert01">
    <div class="layerBody">
        <div class="confirm">
            <div class="mentBox">
                <img src="../images/comp_ic.svg" alt=""><br><br>
                <p class="t_bold">
                    [전송 완료] <br>
                    이메일로 보내드린 링크로<br> 비밀번호재설정을 해주세요.
                </p><div class="p17">
                    <button class="inactive on h45" onclick="$('#alert01').removeClass('on')">확인</button>
                </div> 
            </div>
        </div>
    </div>
</div>