<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>

<section class="wrapper">
    <div class="content">
        <div class="signup_area">
            <div class="common_input">
                <input type="text" placeholder="닉네임">
                <span class="warning p12">*이미 사용중인 닉네임입니다.</span>
            </div>
            <div class="common_input">
                <input type="text" placeholder="이름">
            </div>
            <div class="common_input">
                <div class="input_flex">
                    <input type="number" pattern="\d*" placeholder="휴대폰 번호 (-없이 입력)">
                    <div class="cominput_btn">
                        <button>인증번호 전송</button>
                    </div>
                </div>
                <span class="inform p12">
                    인증번호 발송을 요청했습니다. 인증번호가 오지 않으면 입력
                    정보가 정확한지 다시 확인해주세요.이미 가입된 번호이거나, 가상전화번호는 인증번호를 받을 수 없습니다. 
                </span>
            </div>
            <div class="common_input">
                <div class="input_flex">
                    <input type="text" placeholder="인증번호 입력">
                    <div class="cominput_btn">
                        <button>인증하기</button>
                    </div>
                </div>
                <span class="warning p12">
                    <span class="sec">02:58</span><br>
                    *3분 이내로 인증번호(6자리)를 입력해 주세요. 입력시간 초과시 "재전송" 버튼을 눌러주세요. *
                </span>
            </div>
            <div class="p45">
                <button class="inactive on" onclick="$('#alert01').addClass('on')">가입하기</button>
            </div>
        </div>
    </div>
 </section>
 <div class="alert" id="alert01">
        <div class="layerBody">
            <div class="confirm">
                <div class="mentBox">
                    <img src="../images/comp_ic.svg" alt=""><br><br>
                    <p class="t_bold">
                        [회원가입 완료]<br> 
                        김모아님,<br>
                         moa에 오신걸 환영합니다!.</p>
                    <div class="p17">
                        <button class="inactive on h45" onclick="$('#alert01').removeClass('on')">확인</button>
                    </div> 
                </div>
            </div>
        </div>
    </div>