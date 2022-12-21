<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>

<!-- 카테고리 화면 -->
<section class="s_content">
    <div class="select_area">
        <div class="cate_sel">
            <select name="" id="">
                <option value="">오프라인</option>
                <option value="">온라인</option>
                <option value="">온·오프라인</option>
            </select>
            <div class="cla_cho slctRgn">
                <button  onclick="location.href='<?php echo C_CATEGORY_PATH;?>/category02.php'">지역선택</button>
            </div>
        </div>
        <a href="<?php echo C_MAIN_PATH;?>/main_search.php"><img src="../images/icon_magnifier_1.svg" alt=""></a>
    </div>
</section>

<section class="s_content">
    <ul class="category">
        <li>
            <a href="<?php echo C_CATEGORY_PATH;?>/category03.php">
                <div>
                    <p>액티비티</p>
                    <img src="../images/activity_ic_.svg" alt="">
                </div>
            </a>
            <a href="<?php echo C_CATEGORY_PATH;?>/category03.php">
                <div>
                    <p>자기계발</p>
                    <img src="../images/self-development_ic_.svg" alt="">
                </div>
            </a>
        </li>
        <li>
            <a href="<?php echo C_CATEGORY_PATH;?>/category03.php">
                <div>
                    <p>힐링</p>
                    <img src="../images/healing_ic_.svg" alt="">
                </div>
            </a>
            <a href="<?php echo C_CATEGORY_PATH;?>/category03.php">
                <div>
                    <p>문화예술</p>
                    <img src="../images/culture_ic_.svg" alt="">
                </div>
            </a>
        </li>
        <li>
            <a href="<?php echo C_CATEGORY_PATH;?>/category03.php">
                <div>
                    <p>쿠킹</p>
                    <img src="../images/cooking_ic_.svg" alt="">
                </div>
            </a>
            <a href="<?php echo C_CATEGORY_PATH;?>/category03.php">
                <div>
                    <p>소셜링</p>
                    <img src="../images/social_ic_.svg" alt="">
                </div>
            </a>
        </li>
        <li>
            <a href="<?php echo C_CATEGORY_PATH;?>/category03.php">
                <div>
                    <p>뷰티</p>
                    <img src="../images/beauty_ic_.svg" alt="">
                </div>
            </a>
            <a href="<?php echo C_CATEGORY_PATH;?>/category03.php">
                <div>
                    <p>커리어</p>
                    <img src="../images/career_ic_.svg" alt="">
                </div>
            </a>
        </li>
    </ul>
</section>