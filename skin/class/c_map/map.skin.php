<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>

<!-- 지도  -->
<div class="s_content">
    <div class="map_tit">
        <p>용산구</p> <span>주변 모임</span>
    </div>
    <div class="map_btn">
        <button onclick="$('#metfilter').addClass('on')">모든 분야의 모임</button>
        <button onclick="$('#calendar').addClass('on')">날짜 선택</button>
        <button onclick="$('#s_filter').addClass('on')">필터</button>
    </div>
</div>

<!-- 지도 부분 -->
<div class="map_area">
    <div class="loc_search">
    <button class=""><img src="../images/loc_search.svg" alt=""></button>
    </div>
    <!-- 위치아이콘 -->
    <button class="picker"> <img src="../images/ic_picker.svg" alt=""> </button>
    <!-- 이미지 위치아이콘 -->
    <div class="map_marker_b">
        <span><img src="../images/visual_img/bowling.png" alt=""></span>
    </div>
    <img style="width:100%" src="../images/visual_img/map_01.png" alt="">
</div>

<div class="map_mark_c">
    <!-- 지도 본인위치 버튼 -->
    <div class="loc_btn">
        <button href=""><img src="../images/loc_btn.svg" alt=""></button>
    </div>
    <div class="map_img">
        <img src="../images/visual_img/볼링이미지.png" alt="">
    </div>
    <div class="map_txt">
        <span>성동 • 마포 • 서대문</span>
        <p class="ellipsis2">[홍대] 방송댄스&amp;재즈댄스 도전기 가나다라마바사 아자차카타파하</p>
        <div class="rated">
            <span class="on"></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <p>후기 38개</p> 
        </div>
        <div class="map_price">
            <p>15000원</p>
        </div>
    </div>
</div>


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

<!--필터 팝업-->
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

<!--분야 팝업-->
<div class="s_filter_pop" id="metfilter">
    <div class="layerBody">
        <div class="confirm">
            <div class="">
                <div class="close_box">
                    <button class="close_b" onclick="$('#metfilter').removeClass('on')"><img src="../images/close_b.svg" alt=""> </button><span>분야 설정</span>
                </div>
                <div class="map_check">
                    <ul>
                        <li>
                            <input type="checkbox" id="box_00">
                            <label for="box_00">모든 분야의 모임</label>
                        </li>
                        <li>
                            <input type="checkbox" id="box_01">
                            <label for="box_01">액티비티</label>
                            <input type="checkbox" id="box_02">
                            <label for="box_02">커리어</label>
                        </li>
                        <li>
                            <input type="checkbox" id="box_03">
                            <label for="box_03">쿠킹/베이킹</label>
                            <input type="checkbox" id="box_04">
                            <label for="box_04">소셜링</label>
                        </li>
                        <li>
                            <input type="checkbox" id="box_05">
                            <label for="box_05">문화예술</label>
                            <input type="checkbox" id="box_06">
                            <label for="box_06">힐링</label>
                        </li>
                        <li>
                            <input type="checkbox" id="box_07">
                            <label for="box_07">뷰티</label>
                            <input type="checkbox" id="box_08">
                            <label for="box_08">자기계발</label>
                        </li>
                    </ul>
                </div>
                <div class="pop_btn">
                    <button class="gy" onclick="$('#metfilter').removeClass('on')">필터초기화</button>
                    <button class="gn" onclick="$('#metfilter').removeClass('on')">적용하기</button>
                </div>
            </div>
        </div>
    </div>
</div>