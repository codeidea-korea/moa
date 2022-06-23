<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

?>
<!-- 공통 푸터 -->
    <nav>
        <ul>
            <li>
                <a class="on" href="/">
                    <span class="mn_home"></span>
                    홈
                </a>
            </li>
            <li>
                <a class="" href="<?php echo MOA_CATEGORY_URL;?>/category01.php">
                    <span class="mn_ctgry"></span>
                    카테고리
                </a>
            </li>
            <li>
                <a class="" href="<?php echo MOA_COMMUNITY_URL;?>/community01.php">
                    <span class="mn_cmnty"></span>
                    커뮤니티
                </a>
            </li>
            <li>
                <a class="" href="<?php echo MOA_MAP_URL;?>/map01.php">
                    <span class="mn_location"></span>
                    위치
                </a>
            </li>
            <li>
                <a class="" href="<?php echo MOA_MY_URL;?>/my_page01.php">
                    <span class="mn_my"></span>
                    마이페이지
                </a>
            </li>
        </ul>
    </nav>
    <!-- 커뮤니티 플러스버튼 -->
    <div class="writ_btn dp_none">
        <a href="<?php echo MOA_COMMUNITY_URL;?>/community03.php"><img src="../images/writing_ic.svg" alt=""></a>
    </div>
    <?php include_once (G5_PATH."/includers.php");?>
</body>
<script src="<?php echo MOA_URL;?>/js/common.js"></script>
</html>