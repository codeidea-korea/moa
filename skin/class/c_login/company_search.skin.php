<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>

<section class="wrapper">
    <div class="content">
        <div class="con_area">
            <div class="compnay_ent serch">
                <div>
                    <input type="text" placeholder="회사명을 입력해주세요">
                </div>
                
            </div>
            <div class="con_text">
                <p>일치하는 회사가 없습니다.</p>
                <a href="#">'2교시 입력'</a>
            </div>
        </div>
    </div>
</section>
<div class="btwbtn_layout">
    <button class="inactive" onclick="location.href='<?php echo C_LOGIN_PATH;?>/more_info.php'">취소</button>
    <button class="inactive on" onclick="location.href='<?php echo C_LOGIN_PATH;?>/more_info.php'">완료</button>
</div>