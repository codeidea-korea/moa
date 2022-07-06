<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가 

add_stylesheet('<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,400italic,700,800" type="text/css">',0);
add_stylesheet('<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Raleway:300,200,100" type="text/css">',0);
add_stylesheet('<link rel="stylesheet" href="'.$skin_url.'/assets/css/bootstrap.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.$skin_url.'/style.css" type="text/css" media="screen">',0);

?>


<!-- 김과장 추가 -->
<style>
#login-wrapper{position:absolute;top:0;left:0;width:100%;height:100%;display:flex;align-items:center;justify-content:center;align-items:stretch;font-size:14px;}
#login-wrapper{}
#login-wrapper .bg{flex:1.25;position:relative;background-repeat:no-repeat;background-position:center;background-size:cover;}
#login-wrapper .bg .title{color:#fff;font-size:50px;line-height:1.3em;position:absolute;bottom:90px;left:90px;}
#login-wrapper .loginContainer{flex:1;position:relative;display:flex;align-items:center;justify-content:center;}
#login-wrapper .loginContainer .inner{width:365px;margin-bottom:50px;}
#login-wrapper .loginContainer .logo{text-align:center;margin-bottom:20px;}
#login-wrapper .loginContainer .title{text-align:center;font-size:20px;line-height:1em;font-weight:500;margin-bottom:50px;}
#login-wrapper .loginContainer .input-wrap{position:relative;display:block;}
#login-wrapper .loginContainer .input-wrap input{font-size:15px;height:50px !important;background:transparent !important;border:0;border-bottom:1px solid #C2C2C2 !important;border-radius:0 !important;box-shadow:none !important;
	font-family:'Noto Sans KR', sans-serif;padding-left:20px;padding-right:40px;}
#login-wrapper .loginContainer .input-wrap[class*='icon-login-']:after{content:'';display:block;position:absolute;top:0;right:0;z-index:3;width:40px;height:100%;background-position:center;background-repeat:no-repeat;
	display:flex;align-items:center;justify-content:center;}
#login-wrapper .loginContainer .input-wrap.icon-login-id:after{background-image:url('<?=$skin_url?>/img/icon-login-id.png');}
#login-wrapper .loginContainer .input-wrap.icon-login-pw:after{background-image:url('<?=$skin_url?>/img/icon-login-pw.png');}
#login-wrapper .loginContainer .btn.login{width:100%;height:56px;font-size:18px;margin-bottom:25px;border-radius:4px;font-weight:500;background:#d0db23;}
#login-wrapper .loginContainer .btn.login:hover{background:#bcc712;}
#login-wrapper .loginContainer .sbtn-set{display:flex;align-items:center;padding:0 20px;}
#login-wrapper .loginContainer .sbtn-set li{flex:1;text-align:center;}
#login-wrapper .loginContainer .sbtn-set li:not(:first-child){margin-left:20px;padding-left:20px;border-left:1px solid rgba(0,0,0,0.1);}
#login-wrapper .loginContainer .sbtn-set a{text-align:center;padding:3px 10px;color:#6E6E6E;transition:all .2s ease-in-out;}
#login-wrapper .loginContainer .sbtn-set a:hover{color:#bcc710;}
#login-wrapper .loginContainer .btn-set{display:flex;align-items:center;gap:15px;}
#login-wrapper .loginContainer .btn-set > *{flex:1;}
#login-wrapper .loginContainer .btn-set [class*='btn-']{height:56px;font-size:14px;color:#fff;font-weight:500;border-radius:4px;display:inline-flex;align-items:center;padding:0 10px}
#login-wrapper .loginContainer .btn-set [class*='btn-'] img{margin-right:5px;}
#login-wrapper .loginContainer .btn-set .btn-naver{background:#00BF18}
#login-wrapper .loginContainer .btn-set .btn-kakao{background:#FEE000;color:#3C1F1F;}
.hr{display:flex;align-items:center;justify-content:center;column-gap:1.2em;font-family:'Noto Sans KR', sans-serif;font-weight:400;color:#C2C2C2;font-size:14px;}
.hr:before{content:'';flex:1;width:100%;height:2px;background:rgba(0,0,0,0.1);}
.hr:after{content:'';flex:1;width:100%;height:2px;background:rgba(0,0,0,0.1);}
@media screen and (max-width:1000px) { /* 반응형 */
	#login-wrapper .bg{width:100%;height:100%;position:absolute;top:0;left:0;z-index:5;}
	#login-wrapper .bg .title{color:#fff;font-size:20px;line-height:1.3em;position:absolute;bottom:40px;left:20px;}
	#login-wrapper .loginContainer{width:100%;height:100%;position:absolute;top:0;left:0;z-index:9;}
	#login-wrapper .loginContainer .inner{background:rgba(255,255,255,0.95);padding:25px 30px;border-radius:14px;}
	#login-wrapper .loginContainer .input-wrap input{padding-left:10px;padding-right:35px;}
	#login-wrapper .loginContainer .input-wrap[class*='icon-login-']:after{width:22px;background-size:100%;}
}
</style>

<section id="login-wrapper">

	<div class="bg" style="background-image:url('<?=$skin_url?>/img/login-bg.png');">
		<div class="title noto200">
			여기는 직장인들의<br>
			건전한 커뮤니티,<br>
			Moa 입니다.
		</div>
	</div>

	<div class="loginContainer flex-center">
	<form role="form" name="flogin" class="" action="<?php echo $action_url; ?>" method="post">
		<div class="inner">
			<div class="logo"><img src="<?=G5_URL?>/images/moa_logo.svg"></div>
			<div class="title">호스트 로그인</div>
			<label class="input-wrap icon-login-id"><input type="text" name="mb_id" id="" required class="large span" placeholder="아이디(이메일)를 입력해주세요."></label>
			<label class="input-wrap icon-login-pw"><input type="password" name="mb_password" id="" required class="large span" placeholder="비밀번호를 입력해주세요."></label>
			<button class="btn login mt40" type="submit">로그인</button>
            <?php if($config['cf_social_login_use']) { //소셜 로그인 사용시
            $social_pop_once = false;

            $self_url = G5_BBS_URL."/login.php";

            //새창을 사용한다면
            if( social_service_check('naver') || social_service_check('kakao') ) {
                $self_url = G5_SOCIAL_LOGIN_URL.'/popup.php';
            }
            ?>
            <div class="login_button">
                <?php if( social_service_check('kakao') ) {     //카카오 로그인을 사용한다면 ?>
                    <button type="button" class="kakao_btn sns-wrap social_link" onClick="winSocial('<?php echo $self_url;?>?provider=kakao');">카카오톡으로 계속하기</button>
                <?php }     //end if ?>
                <?php if( social_service_check('naver') ) {     //네이버 로그인을 사용한다면 ?>
                    <button  type="button" class="naver_btn sns-wrap social_link" onClick="winSocial('<?php echo $self_url;?>?provider=naver')">네이버로 계속하기</button>
                <?php }     //end if ?>
                <!-- <button class="Apple_btn">Apple로 계속하기</button> -->
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
                </script>
            <?php } ?>
            <?php } ?>
			<!--
			링크값이 없어서 임시 주석처리 (김과장)
			<ul class="sbtn-set">
				<li><a href="#">호스트가입</a></li>
				<li><a href="#">비밀번호 찾기</a></li>
			</ul>
			<div class="hr mt35 mb30">or</div>			
			<div class="btn-set">
				<a href="#" class="btn-naver"><img src="<?=$skin_url?>/img/btn-naver.png">네이버로 로그인</a>
				<a href="#" class="btn-kakao"><img src="<?=$skin_url?>/img/btn-kakao.png">카카오로 로그인</a>
			</div>
			-->
		</div>
	</form>
	</div>

</section>


<!--
<div id="sub-wrapper" class="sub-container">
	<div class="box-login">
		<div class="box-block">
			<div class="header">							
				<h3 class="text-center">Partner Login Access</h3>
			</div>
			<form role="form" name="flogin" class="form-horizontal" action="<?php echo $action_url; ?>" method="post" style="margin-bottom: 0px !important;">
			<div class="content">
				<div class="form-group">
					<div class="col-sm-12">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-user"></i></span>
							<input type="text" placeholder="User ID" id="login_id" name="mb_id" required class="form-control input-sm">
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-12">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-lock"></i></span>
							<input type="password" placeholder="Password" id="login_pw" required name="mb_password" class="form-control input-sm">
						</div>
					</div>
				</div>
			</div>
			<div class="foot">
				<button class="btn btn-primary" type="submit">Login</button>
			</div>
			</form>
		</div>
		<div class="text-center box-links"><a href="<?php echo G5_URL;?>">Home</a></div>
	</div> 
</div>
-->

<!-- JavaScript -->
<script type="text/javascript" src="<?php echo $skin_url;?>/assets/js/bootstrap.min.js"></script>
