<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>

<!-- 커뮤니티 상세 화면 -->
<section class="s_content">
    <div class="com_detail_h">
        <div>
            <div class="com_img mt0">
                <img src="../images/default_img.svg" alt="">
            </div>
            <div class="com_dt">
                <p>익명</p>
                <p class="ellipsis2">오늘 정말 만족스러웠어용가리 가나다라마바사아자차카타파하가나다라마바사</p>
                <span>22시간전</span>
            </div>
        </div>
        <div class="item">
            <span class="community_chip color_b">자유</span>
        </div>
    </div>
</section>

<section class="s_content">
    <div class="com_text_area">
        <img src="../images/visual_img/볼링이미지.png" alt="">
        <p class=" mt25">오늘의 수업 사진이에요! 너무 즐거운 시간이었어용</p>
    </div>
</section>

<section class="s_content">
    <div class="com_like">
        <div class="ic_area">
            <span class="on">6</span>
            <span>8</span>
        </div>
    </div>
</section>

<section class="s_content">
    <div class="com_other">
        <ul class="community last_list">
            <li>
                <div>
                    <div class="info">
                        <div class="com_img">
                            <img src="../images/default_img.svg" alt="">
                        </div>
                    </div>
                    <div class="com_tarea">
                        <p>익명<span>22시간전</span></p>
                        <p>오늘의 수업 사진이에요!너무 즐거운 시간이었어용가리 가나다라마바사아자차카타파하가나다라마바사</p>
                        <div class="comm_dflex">
                            <a href="">좋아요</a> <a href="">답글달기</a> <img src="../images/com_like_on.svg" alt=""><span>6</span>
                        </div>
                    </div>
                    <a class="dec" onclick="$('#alert10').addClass('on')"><img src="../images/Dec.svg" alt=""></a>
                </div>
                <ul class="ment">
                    <li>
                        <div>
                            <div class="info">
                                <div class="com_img">
                                    <img src="../images/default_img.svg" alt="">
                                </div>
                            </div>
                            <div class="com_tarea">
                                <p>익명<span>22시간전</span></p>
                                <p>오늘의 수업 사진이에요!너무 즐거운 시간이었어용가리 가나다라마바사아자차카타파하가나다라마바사</p>
                                <div class="comm_dflex">
                                    <a href="">좋아요</a> <a href="">답글달기</a> <img src="../images/com_like_on.svg" alt=""><span>6</span>
                                </div>
                            </div>
                            <a class="dec" onclick="$('#alert10').addClass('on')"><img src="../images/Dec.svg" alt=""></a>
                        </div>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</section>

<!-- 신고하기 팝업 -->
<div class="i_laypop" id="alert10">
    <div class="layerBody">
        <div class="confirm">
            <div class="mentBox">
                <button class="bgr color_red" onclick="$('#alert10').removeClass('on')">신고하기</button>
                <button class="color_dg" onclick="$('#alert10').removeClass('on')">닫기</button>
                
            </div>
        </div>
    </div>
</div>