<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>

<!-- 커뮤니티 화면 -->

<!-- 메뉴 슬라이드 -->
<section class="swiper-container s_nav_sw mb14">
    <div class="swiper2">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
            <a href="" class="on">전체</a>
            </div>
            <div class="swiper-slide">
                <a href="">인기글</a>
            </div>
            <div class="swiper-slide">
                <a href="">자유</a>
            </div>
            <div class="swiper-slide">
                <a href="">연애</a>
            </div>
            <div class="swiper-slide">
                <a href="">직장 고민 상담소</a>
            </div>
            <div class="swiper-slide">
                <a href="">취미생활</a>
            </div>
            <div class="swiper-slide">
                <a href="">모임열어주세요</a>
            </div>
        </div>
    </div>
</section>

<!-- 검색 -->
<section class="s_content">
    <div class="m_search to_layout">
        <input type="text" placeholder="검색어를 입력해주세요.">
        <a class="" href="<?php echo MOA_COMMUNITY_URL;?>/community04.php">
            <div>
                <span>MY</span>
            </div>
        </a>  
    </div>
</section>

<!-- 커뮤니티 리스트 -->
<section class="s_content">
    <ul class="community last_list">
        <li>
            <a href="<?php echo MOA_COMMUNITY_URL;?>/community02.php">
                <div>
                    <div class="com_tarea">
                        <p>오늘 정말 만족스러웠어요!<span>22시간전</span></p>
                        <p class="ellipsis2">오늘의 수업 사진이에요!너무 즐거운 시간이었어용가리 가나다라마바사아자차카타파하가나다라마바사</p>
                    </div>
                    <div class="info">
                        <p>익명</p>
                        <div class="com_img">
                            <img src="../images/default_img.svg" alt="">
                        </div>
                    </div>
                </div>
            </a>
            <div class="com_icon">
                <span class="community_chip color_g">취미생활</span>
                <div class="ic_area">
                    <span>6</span>
                    <span>8</span>
                </div>
            </div>
        </li>
        <li>
           <a href="<?php echo MOA_COMMUNITY_URL;?>/community02.php">
                <div>
                    <div class="com_tarea">
                        <p>오늘 정말 만족스러웠어요!<span>22시간전</span></p>
                        <p class="ellipsis2">오늘의 수업 사진이에요!너무 즐거운 시간이었어용가리 가나다라마바사아자차카타파하가나다라마바사</p>
                    </div>
                    <div class="info">
                        <p>익명</p>
                        <div class="com_img">
                            <img src="../images/default_img.svg" alt="">
                        </div>
                    </div>
                </div>
            </a>
            <div class="com_icon">
                <span class="community_chip color_p">모임열어주세요</span>
                <div class="ic_area">
                    <span>6</span>
                    <span>8</span>
                </div>
            </div>
        </li>
        <li>
        <a href="<?php echo MOA_COMMUNITY_URL;?>/community02.php">
                <div>
                    <div class="com_tarea">
                        <p>오늘 정말 만족스러웠어요!<span>22시간전</span></p>
                        <p class="ellipsis2">오늘의 수업 사진이에요!너무 즐거운 시간이었어용가리 가나다라마바사아자차카타파하가나다라마바사</p>
                    </div>
                    <div class="info">
                        <p>익명</p>
                        <div class="com_img">
                            <img src="../images/default_img.svg" alt="">
                        </div>
                    </div>
                </div>
            </a>
            <div class="com_icon">
                <span class="community_chip color_r">인기글</span>
                <div class="ic_area">
                    <span>6</span>
                    <span>8</span>
                </div>
            </div>
        </li>
        <li>
        <a href="<?php echo MOA_COMMUNITY_URL;?>/community02.php">
                <div>
                    <div class="com_tarea">
                        <p>오늘 정말 만족스러웠어요!<span>22시간전</span></p>
                        <p class="ellipsis2">오늘의 수업 사진이에요!너무 즐거운 시간이었어용가리 가나다라마바사아자차카타파하가나다라마바사</p>
                    </div>
                    <div class="info">
                        <p>익명</p>
                        <div class="com_img">
                            <img src="../images/default_img.svg" alt="">
                        </div>
                    </div>
                </div>
            </a>
            <div class="com_icon">
                <span class="community_chip color_b">자유</span>
                <div class="ic_area">
                    <span>6</span>
                    <span>8</span>
                </div>
            </div>
        </li>
    </ul>
</section>