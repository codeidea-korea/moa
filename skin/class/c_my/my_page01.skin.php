<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>

<!-- 게스트모드 인증 전 -->
<section class="detail_con">
    <div class="s_con_bg">
        <?php if (!$member['mb_id']) {?>
        
        <p class="m_error">
            <span>로그인 및 소속 인증이 되지 않았습니다.<br>소속 인증을 진행해주세요.</span>
        </p>
        <?php } ?>
        <div class="m_idarea">
            <?php if (!$member['mb_id']) {?>
        
            <div class="id_txt">
                <p>로그인을 진행해주세요</p> 
                <button onclick="location.href='/c_login/login.php';">로그인</button> 
            </div>
            <?php } 
            else { ?>

            <div class="id_txt">
                <p class="ellipsis1"><?php echo $member['mb_id']."(".$member['mb_nick'].")";?></p>
                <!-- <button><span class="ellipsis1">추천코드 CALSQ2M1D 가나다라마바사 아자차카 타파하</span> <img src="../images/ic_up.png" alt=""></button> -->
            </div>
            <div class="profile_imgarea">
                <div class="profile_img" onclick="location.href='<?php echo MOA_MY_URL;?>/my_page05.php'">
                    <?php echo ($member['photo']) ? '<img src="'.$member['photo'].'" alt="">' : '<span class="no-img"></span>'; //사진 ?>
                </div>
                <a href="/c_my/my_page05.php?ap=register_form">프로필 수정</a>
            </div>
            <?php } ?>
        </div>
        <?php if ($member['mb_id']) {?>
        <div class="point_coupon mt25">
            <a class="m_point" href="<?php echo MOA_MY_URL;?>/my_coupon03.php">
                <div>포인트</div>
                <div><?php echo number_format($member['mb_point']);?>P</div>
            </a>
            <a class="m_coupon" href="<?php echo MOA_MY_URL;?>/my_coupon01.php">
                <div>쿠폰</div>
                <div><?php echo $result['cnt']; ?><span>장</span></div>
            </a>
        </div>
        <div class="m_box mt10">
            <a href="<?php echo MOA_MY_URL;?>/my_review03.php">나의 후기</a>
            <a href="<?php echo MOA_MY_URL;?>/my_inquiry02.php">나의 문의</a>
            <a href="<?php echo MOA_DETAIL_URL;?>/d_wish.php"><img src="../images/ic_wish.svg" alt="">찜한 목록</a>
        </div>
        <?php } ?>
    </div>
</section>

