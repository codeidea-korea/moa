<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가 
include_once(THEMA_PATH.'/assets/thema.php');
include_once(G5_LIB_PATH.'/outlogin.lib.php');
include_once(G5_LIB_PATH.'/popular.lib.php');
include_once(G5_LIB_PATH.'/latest.lib.php');
include_once(G5_LIB_PATH.'/apms.lib.php');

?>

<div class="header">
    <button class="prev"></button>
    <h2 class="pageTit">타이틀</h2>

    <!-- 모임 상세페이지 아이콘 -->
    <div class="ic_area dp_none">
        <a href=""><img src="../images/top_like_ic.svg" alt=""></a>
        <a onclick="$('#alert05').addClass('on')"><img src="../images/share_ic.svg" alt=""></a>
    </div>

    <!-- 채팅 아이콘 -->
    <!--버튼 클릭 시 호스트로 변경 / 게스트로 변경 텍스트 변경되어야함-->
    <button class="change_h dp_none">게스트로 변경</button>

     <!-- 문의 아이콘 문의작성 클릭 시 작성페이지 이동-->
     <a href="<?php echo C_DETAIL_PATH;?>/inquiry02.php" class="in_write dp_none">문의작성</a>

     <!-- 커뮤니티 아이콘 -->
     <div class="ic_area t34 dp_none">
        <a href=""><img src="../images/dot_more.svg" alt=""></a>
    </div>

    <!-- 마이페이지 설정 아이콘 -->
    <div class="ic_area dp_none">
        <a href=""><img src="../images/icon_setting.svg" alt=""></a>
    </div>

    <!-- 프로필 설정 아이콘 -->
    <button class="textbtn dp_none" onclick="$('#alert14').addClass('on')">저장</button>
</div>
<div class="first_cnt"></div>

<!-- 공유하기 팝업 -->
<div class="alert02" id="alert05">
    <div class="layerBody">
        <div class="confirm">
            <div class="mentBox">
                <p class="t_bold">공유하기</p>
                <span>친구에게 모임을 공유하세요!</span>
                <ul>
                    <li>
                        <img src="../images/kakao_s.svg" alt="">
                        <p>카카오톡</p>
                    </li>
                    <li>
                        <img src="../images/sms_s.svg" alt="">
                        <p>SMS</p>
                    </li>
                    <li>
                        <img src="../images/code_s.svg" alt="">
                        <p>코드복사하기</p>
                    </li>
                </ul>
                <div class="close_btn">
                    <button onclick="$('#alert05').removeClass('on')"><img src="../images/close_ic_.svg" alt=""></button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 프로필 저장하기 팝업-->
<div class="alert02" id="alert14">
    <div class="layerBody">
        <div class="confirm">
            <div class="mentBox">
                <span class="mt40">프로필 수정이 완료되었습니다</span>
                <div class="btn_area">
                    <button class="gy" onclick="$('#alert14').removeClass('on')">취소</button>
                    <button class="gn" onclick="$('#alert14').removeClass('on')">확인</button>
                </div>
            </div>
        </div>
    </div>
</div>
<section class="navbar-section account-set">
			<?php  echo outlogin(); ?>

		  
		</section>

<!-- 컨텐츠 -->
<div class="contents container grid-xl">
	
<?php 
//print_r2($menu);
?>