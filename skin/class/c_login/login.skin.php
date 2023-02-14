<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

set_session('prev_url', $_SERVER['HTTP_REFERER']);

function get_client_ip() {
    $ipaddress = "";

    if(getenv('HTTP_CLIENT_IP'))                $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))     $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))         $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))       $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))           $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))              $ipaddress = getenv('REMOTE_ADDR');
    else                                        $ipaddress = "UNKNOWN";
    
    return $ipaddress;
}

?>
<section class="login_wrap">
        <div class="cnter">
            <div class="login_logo">
                <img src="../images/logo.svg" alt="">
            </div>
        <form method="post" action="./login_check.php">
            <div class="line_input">
                <p>이메일 주소</p>
                <input type="text" name="mb_id" placeholder="예) moa@moa.co.kr">
                <p>비밀번호</p>
                <input type="password" name="mb_password">
            </div>
            <?php if($config['cf_social_login_use']) { //소셜 로그인 사용시
				$social_pop_once = false;

				$self_url = G5_BBS_URL."/login.php";

				//새창을 사용한다면
				if( social_service_check('naver') || social_service_check('kakao') ) {
					$self_url = G5_SOCIAL_LOGIN_URL.'/popup.php';
				}
			?>
            <div class="login_button">
                <button  class="login_btn">로그인</button>
			    <?php if( social_service_check('kakao') ) {     //카카오 로그인을 사용한다면 ?>	
                    <button type="button" class="kakao_btn sns-wrap social_link" onClick="location.href='/plugin/social/kakao_callback.php?provider=kakao'">카카오톡으로 계속하기</button>
			    <?php }     //end if ?>
                <?php if( social_service_check('naver') ) {     //네이버 로그인을 사용한다면 ?>
                    <!--
                    <button  type="button" class="naver_btn sns-wrap social_link" onClick="winSocial('<?php echo $self_url;?>?provider=naver')">네이버로 계속하기</button>
                    -->
                    <!--
                    <button  type="button" class="naver_btn sns-wrap social_link" onClick="location.href='https://.codeidea.io/plugin/social/naver_callback.php?provider=naver'">네이버로 계속하기</button>
                    -->
                <?php }     //end if ?>
                <?php if( social_service_check('google') ) {     //구글 로그인을 사용한다면 ?>
                    <!--
                    <button  type="button" class="google_btn sns-wrap social_link" onClick="winSocial('<?php echo $self_url;?>?provider=google')">Google 로 계속하기</button>
                    -->
                    <!--
                    <button  type="button" class="google_btn sns-wrap social_link" onClick="location.href='https://.codeidea.io/plugin/social/google_callback.php?provider=google'">Google 로 계속하기</button>
                    -->
                <?php }     //end if ?>
				<?php //echo get_client_ip();   //|| strpos($_SERVER['REMOTE_ADDR'], "118.37.1.137") !== false   //임시 테스트 환경 구성(IP로 구분) ?>
                <?php //if( social_service_check('apple') && strpos(get_client_ip(), "118.37.1.137") !== false ) {     //애플 로그인을 사용한다면 ?>
                    <!-- 20230105 이전의 흔적들은 일단 주석처리함 -->
                    <!--
                    <button type="button" class="Apple_btn sns-wrap social_link" onClick="winSocial('<?php echo $self_url; ?>?provider=Apple')">Apple 로 계속하기</button>
                    <button type="button" class="Apple_btn sns-wrap social_link" 
                    onClick="location.href='https://appleid.apple.com/auth/authorize?client_id=moaFriendsId&redirect_uri=https://www.moa-friends.com/plugin/social/apple_callback.php?provider=apple&response_type=code id_token&state=signin&scope=name email&response_mode=form_post'">Apple 로 계속하기</button>
                    -->

                    <!-- 20230105 애플 로그인 1차 완료 (바로 아래의 주석 1줄을 제거하면 기능 확인 가능-->
                    <button type="button" class="Apple_btn sns-wrap social_link" onClick="location.href='/plugin/social/apple_callback.php?provider=Apple'">Apple 로 계속하기</button>
                <?php //}     //end if ?>
            </div>
            <?php 
            //if( G5_SOCIAL_USE_POPUP && !$social_pop_once ){
            if(  !$social_pop_once ){
                $social_pop_once = true;
                ?>
                <script>
                    function winSocial(href) {
                        //$(".sns-wrap").on("click", function(e){
                          //  e.preventDefault();

                            var pop_url = href;
                            var newWin = window.open(
                                pop_url, 
                                "social_sing_on", 
                                "location=0,status=0,scrollbars=1,width=600,height=500"
                            );

                            if(!newWin || newWin.closed || typeof newWin.closed=='undefined')
                                    alert('브라우저에서 팝업이 차단되어 있습니다. 팝업 활성화 후 다시 시도해 주세요.');

                            return false;
                        //});
                    }
					function kakaoLogin(){
						location.href = 'https://kauth.kakao.com/oauth/authorize?client_id=93cbf78a4220ab184ef355f10197b699&response_type=code&redirect_uri=<?=urlencode("https://www.moa-friends.com/plugin/social/kakao_callback.php")?>';
					}
                </script>
                <?php } ?>
            <?php } ?>

        </form>
            <div class="login_etc">
                <a href="/c_login/e-mail01.php">이메일 가입</a>
                <span></span>
                <a href="<?php echo G5_BBS_URL.'/email_lost.php'?>" class="win_password_lost" target="_blank">이메일 찾기</a>
                <span></span>
                <a href="<?php echo G5_BBS_URL.'/password_lost.php'?>" class="win_password_lost" target="_blank">비밀번호 찾기</a>
            </div>
<!--            <p class="recent_login">최근 로그인은 카카오톡입니다.</p>-->
            <div class="look">
                <a href="/c_main/main.php">둘러보기</a>
            </div>
        </div>
 </section>
 <?php include_once (G5_PATH."/includers.php");?>
