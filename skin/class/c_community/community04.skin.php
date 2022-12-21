<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>

<!-- 내가 쓴 글 / 내가 댓글 단 글 화면 -->
<!-- tab영역 -->
<div class="s_content">
    <div class="tabs02">
        <input id="host" type="radio" name="tab_item02" checked="">
        <label class="tab_item02" for="host">내가 쓴 글</label>
        <input id="group" type="radio" name="tab_item02">
        <label class="tab_item02" for="group">내가 댓글 단 글 </label>
        <hr>

        <!-- 내가 쓴 글 -->
        <div class="tab_content p0 bt" id="host_content">
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
        </div>
        
        <!-- 내가 단 댓글 -->
        <div class="tab_content p0" id="group_content">
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
                        <span class="community_chip color_b">자유</span>
                        <div class="ic_area">
                            <span>6</span>
                            <span>8</span>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>