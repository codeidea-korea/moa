<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

?>
    <!-- 채팅 푸터 -->
        <div class="chat_win">
            <div class="chat_area">
                <input type="file" accept="image/*" capture="camera" name="camera" id="camera" style="display:none">
                <img onclick="onclick=document.all.camera.click()" src="../images/pick.svg" alt="">
                <div class="chat_send">
                    <input type="text" placeholder="대화를 입력하세요">
                    <button>보내기</button>
                </div>
            </div>
        </div>
        <?php include_once (G5_PATH."/includers.php");?>
    </body>
    <script src="<?php echo MOA_URL;?>/js/common.js"></script>
</html>