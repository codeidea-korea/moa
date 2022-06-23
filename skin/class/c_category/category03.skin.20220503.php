<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>

<!-- 카테고리 상세 화면 -->
<div class="s_content">
    <div class="select_area">
        <div class="cate_sel">
            <select name="" id="">
                <option value="">액티비티</option>
            </select>
        </div>
        <a href="<?php echo C_MAIN_PATH;?>/main_search.php"><img src="../images/icon_magnifier_1.svg" alt=""></a>
    </div>
</div>

<div class="swiper-container s_nav_sw mb14">
    <div class="swiper2 swiper-initialized swiper-horizontal swiper-pointer-events swiper-free-mode swiper-backface-hidden">
        <div class="swiper-wrapper" id="swiper-wrapper-f3006158e1ac04be" aria-live="polite">
            <div class="swiper-slide swiper-slide-active" role="group" aria-label="1 / 4">
            <a href="" class="on">액티비티 전체</a>
            </div>
            <div class="swiper-slide swiper-slide-next" role="group" aria-label="2 / 4">
                <a href="">클라이밍</a>
            </div>
            <div class="swiper-slide" role="group" aria-label="3 / 4">
                <a href="">실내다이빙</a>
            </div>
            <div class="swiper-slide" role="group" aria-label="4 / 4">
                <a href="">스키</a>
            </div>
        </div>
    <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span></div>
</div>

<div class="s_content">
    <div class="srchVlm mt0">
        <p>총 4개</p>
        <div>
            <button onclick="$('#calendar').addClass('on')">날짜</button>
            <button onclick="$('#s_filter').addClass('on')">필터</button>
        </div> 
    </div>
</div>

<div class="s_content mt25">
    <ul class="day_list">
        <li>
            <a href="">
                <div class="thumb_box">
                    <div></div>
                </div>
                <div class="lctn">오프라인</div>
                <div class="ttl">[홍대] 방송댄스&amp;재즈댄스 도전기</div>
                <div class="rated">
                    <span class="on"></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <p>후기 38개</p> 
                </div>
                <p class="sale"></p>
                <div class="dsc_price">
                    <span>15,000원</span>
                    <p>
                        <span>당일사용</span>
                    </p>
                </div>
            </a>    
            <button class="lick_btn on"></button>
        </li>
    </ul>
</div>

<!-- 날짜 필터 버튼 -->
<section class="srchVlm s_content">
    <p>총 4개</p>
    <div>
        <button onclick="$('#calendar').addClass('on')">날짜</button>
        <button onclick="$('#s_filter').addClass('on')">필터</button>
    </div> 
</section>

<!-- 날짜 팝업 -->
<div class="calendar_pop" id="calendar">
    <div class="layerBody">
        <div class="confirm">
            <div class="mentBox">
                <div class="close_box">
                    <button class="close_b" onclick="$('#calendar').removeClass('on')"><img src="../images/close_b.svg" alt=""></button><span>날짜선택</span>
                </div>
                <div id="myID"></div>
                <script>
                    flatpickr("#myID", {
                        mode: "range",
                        inline: true,
                        "locale": "ko",
                        disableMobile: "true"
                    });
                </script>
                <div class="c_btn">
                    <button class="inactive on" onclick="$('#calendar').removeClass('on')">1월 24일 - 1월 26일</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 필터 팝업 -->
<div class="s_filter_pop" id="s_filter">
    <div class="layerBody">
        <div class="confirm">
            <div class="mentBox">
                <div class="close_box">
                    <button class="close_b" onclick="$('#s_filter').removeClass('on')"><img src="../images/close_b.svg" alt=""> </button><span>필터</span>
                </div>
                <span class="s_tit">정렬</span>
                <div class="lounchecL s_filter_radio">
                    <input type="radio" id="box_1" name="sequence">
                    <label for="box_1">최신순</label>
                    <input type="radio" id="box_2" name="sequence">
                    <label for="box_2">인기순</label>
                    <input type="radio" id="box_3" name="sequence">
                    <label for="box_3">리뷰순</label>
                    <input type="radio" id="box_4" name="sequence">
                    <label for="box_4">가격 낮은순</label>
                    <input type="radio" id="box5" name="sequence">
                    <label for="box5">가격 높은순</label>
                </div>
                <div class="lounchecL s_filter_radio line">
                    <input type="radio" id="box_6" name="composition">
                    <label for="box_6">1회 구성만 보기</label>
                    <input type="radio" id="box_7" name="composition">
                    <label for="box_7">N회 구성만 보기</label>
                    <input type="radio" id="box_8" name="composition">
                    <label for="box_8">전체 보기</label>
                </div>
                <div class="pop_btn">
                    <button class="gy" onclick="$('#s_filter').removeClass('on')">필터초기화</button>
                    <button class="gn" onclick="$('#s_filter').removeClass('on')">적용하기</button>
                </div>
            </div>
        </div>
    </div>
</div>