<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>

<!-- 채팅 리스트 화면 -->
<section class="s_content">
    <!-- 탭영역 -->
    <div class="tabs02">
        <input id="host" type="radio" name="tab_item02" checked="">
        <label class="tab_item02" for="host">호스트와 1:1</label>
        <input id="group" type="radio" name="tab_item02">
        <label class="tab_item02" for="group">모임별 그룹</label>
        <hr>
        <!-- 첫번째 탭 -->
        <div class="tab_content" id="host_content">
            <div class="write">
                <button class="write_btn"><img src="../images/icon_write.svg" alt=""></button>
            </div>
            <div class="check_group on" onclick="location.href='<?php echo MOA_CHAT_URL;?>/chat02.php'">
                <input id="group_check" type="checkbox">
                <label for="group_check">
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
                    </div>
                </label>
            </div>
            <div class="check_group on">
                <input id="group_check02" type="checkbox">
                <label for="group_check02">
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
                    </div>
                </label>
            </div>
        </div>
        
        <!-- 두번째 탭 -->
        <div class="tab_content" id="group_content">
            <div class="write">
                <button class="write_btn"><img src="../images/icon_write.svg" alt=""></button>
            </div>
            <div class="check_group on">
                <input id="group_check03" type="checkbox">
                <label for="group_check03">
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
                    </div>
                </label>
            </div>
        </div>
        <button class="inactive on">삭제</button>
    </div>
</section>