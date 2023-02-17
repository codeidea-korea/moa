<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>
<style>
.header  {
    z-index:99999;
}
.header button.prev02 {
    position: absolute;
    height: 62px;;
    left: 5%;
    background: url(../images/prev_wh.svg) no-repeat 50% 50%;
    background-size: 10px;
	border:0px solid red;
	width:50px;
	font-weight:bold;
}
.header h2.pageTit {
    text-align: center;
    font-size: 2rem;
    padding: 19px 0 0;
    color: var(--dark-gray);
    font-weight: bold;
}
</style>
<section class="hj_main">
    <div class="sp_area" style="height: calc(100% - 62px);">
        <div class="header">
            <button class="prev02" onclick="location.href='/'"><</button>
            <h2 class="pageTit">호스트 지원하기</h2>
        </div>
        <div class="sp_txt">
            <img src="../images/s_Moa_logo.svg" alt="">
            <p>좋아하는 일<br>
                걱정없이 하세요.</p>
            <p>모아에서 당신의 재능을 마음껏 펼치세요.<br>
                당신의 더 멋진 활동을 위해 모아가 함께합니다.</p>
        </div>
        <!-- <p class="site">www.2교시hostadmin.co.kr</p> -->
        <div class="btn_fixed">
        <?php



        //if(!$partner['pt_register']) { // 등록심사중이면
        //		alert('회원님은 현재 등록심사 중입니다.', G5_URL);
        //	}

        if ($is_member) {
            $partner = array();
            $partner = apms_partner($member['mb_id']);
            if($partner['pt_no'] != "") { // 등록심사중이면
                ?>
                <button class="inactive on" style="height:62px;">등록심사 중</button>
                <?php
            }else{
                ?>
                <button class="inactive on" onclick="location.href='/shop/partner/register.php'" style="height:62px;">1분안에 호스트 시작하기</button>
                <?php
            }

        ?> 
        <!--로그인한 사용자 링크 -->

        <?php 
        } else { ?>
        <button class="inactive on" onclick="location.href='<?php echo C_MAIN_PATH;?>/main.php'" style="height:62px;">1분안에 호스트 시작하기</button>
        <?php } ?>
        </div>
    </div>
    
</section>