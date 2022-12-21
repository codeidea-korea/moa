<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>

<!-- 나의 문의 없을 때 -->
<section class="wrapper">
    <div class="s_content">
        <div class="tabs02">
            <input id="host" type="radio" name="tab_item02" checked="">
            <label class="tab_item02" for="host">Q&amp;A</label>
            <input id="group" type="radio" name="tab_item02">
            <label class="tab_item02" for="group">고객센터 1:1문의</label>
            <hr class="t39">

            <div class="tab_content p0 bt" id="host_content">
                <div class="blank_page02">
                    <p class="no_review">
                        작성한 문의 내용이 <br/> 존재하지 않습니다!
                    </p>
                </div> 
            </div>
            
            <div class="tab_content p0" id="group_content">
                <div class="blank_page02">
                    <p class="no_review">
                        작성한 문의 내용이 <br/> 존재하지 않습니다!
                    </p>
                </div>
            </div>

        </div>
    </div>
</sec>