<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>

<!-- only 게스트 심사 후  -->
<section class="detail_con">
    <div class="s_con_bg">
        <div class="m_idarea">
            <div class="id_txt">
                <p class="ellipsis1">Hello123 가나다라마 마바사 아자차카타파하</p>
                <button>
                    <span class="ellipsis1">추천코드 CALSQ2M1D 가나다라마바사 아자차카 타파하</span> <img src="../images/ic_up.png" alt=""></button>
            </div>
            <div class="profile_imgarea">
            <div class="profile_img" onclick="location.href='<?php echo MOA_MY_URL;?>/my_page05.php'">
                    <img src="../images/profile_default.svg" alt="">
                </div>
                <button>프로필 수정</button>
            </div>
        </div>
        <div class="point_coupon mt25">
            <a class="m_point" href="<?php echo MOA_MY_URL;?>/my_coupon03.php">
                <div>포인트</div>
                <div>0</div>
            </a>
            <a class="m_coupon" href="<?php echo MOA_MY_URL;?>/my_coupon01.php">
                <div>쿠폰</div>
                <div>0 <span>장</span></div>
            </a>
        </div>
        <div class="m_box mt10">
            <a href="<?php echo MOA_MY_URL;?>/my_review03.php">나의 후기</a>
            <a href="<?php echo MOA_MY_URL;?>/my_inquiry02.php">나의 문의</a>
            <a href="<?php echo C_DETAIL_PATH;?>/d_wish.php"><img src="../images/ic_wish.svg" alt="">찜한 목록</a>
        </div>
    </div>
</section>