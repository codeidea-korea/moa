<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

?>
    <!-- 모임상세 결제 푸터 -->
        <div class="expected_cost">
            <div class="cost_area">
                <span class="ex_cost">예상비용</span>
                <div class="cost">30,000원<span>(회당)</span></div>
            </div>
            <button onclick="location.href='<?php echo MOA_DETAIL_URL;?>/d_payment.php'">결제하기</button>
        </div>
        <?php include_once (G5_PATH."/includers.php");?>
    </body>
    <script src="<?php echo MOA_URL;?>/js/common.js"></script>
</html>