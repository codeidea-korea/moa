<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>

<!-- 채팅 화면 -->
<section class="wrapper01">
    <div class="s_content">
        <div class="chat_infor">
            <div class="chat_img img_ct">
                <img src="../images/visual_img/당일수강.png" alt="">
            </div>
            <div class="infor_area">
                <p class="ellipsis1">딥 아틀리에 가나다라 마바사 아자차카 타파하</p>
                <p class="ellipsis2">[성수] 물레 도자기 + 컬러 액션 페인팅
                    3작품 가나다라 마바사 아자차카 타파하하하하 </p>
                <p>15,000원</p>
            </div>
            <a class="dot_ic" href=""></a>
        </div>
        </div>

        <div class="s_content mt20">
        <div class="day_mark">
            <span>2022년 1월 20일</span>
        </div>
        </div>

        <!-- 채팅 시작 -->
        <div class="s_content mt20">
        <!-- 상대방 -->
        <div class="chat_others mt30">
            <div class="img_ct">
                <img src="../images/visual_img/default.png" alt="">
            </div>
            <div class="id_con">
                <p>딥 아틀리에</p>
                <ul>
                    <li>
                        <span>안녕하세요 땡그랑 버디님! 가나다라 마바사 아자차카 타파하</span>
                    </li>
                    <li>
                        <span>어쩐일이시죠? 가나다라마바사 아자차카타파하</span>
                        <span class="c_time">오후 7:27</span>
                    </li>
                </ul>
            </div>
        </div>
        <!-- 본인 -->
        <div class="chat_me mt30">
            <ul>
                <li>
                    <span>안녕하세요 ~ 리더님! 문의드릴 것이 있습니다.가나다라마바사 아자차카타파하</span> 
                </li>
                <li>
                    <span class="c_time">오후 7:27</span>
                    <span>안녕하세요 ~ 리더님! 문의드릴 것이 있습니다.가나다라마바사 아자차카타파하</span> 
                </li>
            </ul>
        </div>
    </div>
</section>

<!--채팅방 나가기 팝업 -->
<div class="i_laypop on" id="alert06">
    <div class="layerBody">
        <div class="confirm">
            <div class="mentBox">
                <button class="bgr color_blue" onclick="$('#alert06').removeClass('on')">채팅방 나가기</button>
                <button class="color_blue" onclick="$('#alert06').removeClass('on')">취소</button>
            </div>
        </div>
    </div>
</div>