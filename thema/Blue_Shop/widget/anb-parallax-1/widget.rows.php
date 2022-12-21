<?php
if (!defined('_GNUBOARD_')) exit; //개별 페이지 접근 불가

if(!$wset['color_t']) { $wset['color_t'] = '#56b6f1'; }
if(!$wset['color_tb']) { $wset['color_tb'] = '#ffffff'; }

if(!$wset['img1']) { $wset['img1'] = 'http://ag53.ode.kr/data/apms/background/I_phone.png'; }
if(!$wset['title']) { $wset['title'] = 'Amina Hybrid Push App'; }
if(!$wset['content']) { $wset['content'] = '아미나 유져를 위한 필수 APP 아미나블루 하이브리드 푸시앱은 아미나빌더와의 완벽호환은 물론 쇼핑몰,기업,커뮤니티등 다양한 사업환경에 최적화된 하이브리드 푸시앱입니다. 다양한 방식의 푸시알림과 내글반응 연동으로 직관적인 푸시리스트를 제공합니다. 총18종류의 푸시 아이콘은 푸시유형에 따라 푸시리스트를 제공합니다. 다양한 디바이스에서 정확한 사이즈로 최적화하여 쾌적하게 사이트를 이용할 수 있도록 반응형으로 웹사이트를 구축합니다. 제작만 하고 끝이 아닌 파트터쉽 관계를 유지합니다. 사트이를 운영함에 있어 유용한 기능을 손쉽게 설정할 수 있도록 다양한 부가기능을 제공합니다. 어려움이 있으면 언제든지 문의주세요. 만족시킬 것입니다.'; }
if(!$wset['dlink']) { $wset['dlink'] = '#parallax-1'; }

?>
<style>
#parallax-1 .triangle i { color: <?php echo $wset['color_tb'];?>; }
#parallax-1 .triangle { border-top-color: <?php echo $wset['color_t'];?>; }
</style>
<section id="parallax-1" data-speed="2" data-type="background" style="/*background-position: 50% -1000px;*/">
	<div class="parallaxCover1">
		<div class="container">
			<?php if($wset['tuse']){ ?>
			<div class="triangle">
				<a href="#parallax-1" class="kso-scroll"><i class="fa fa-arrow-down"></i></a>
			</div>
			<?php } ?>
			<!--<div class="text-center mBottom20">
				<h2>PARALLAX ELEMENT</h2>
				<p class="widthfix mBottom30">패럴랙스 영역으로 스크롤을 할 때 시차를 두고 배경이 움직이는 효과로 각 섹션과 섹션 사이의 공간을 활용함으로써 보다 스타일리쉬하게 표현하게 됩니다.</p>
			</div>-->

			<div class="col-md-6">
				<div class="animated  " data-animtype="fadeInLeft" data-animrepeat="0" data-animspeed="1s" data-animdelay="1s">
					<img src="<?php echo $wset['img1'];?>" class="center-block img-responsive">
				</div>
			</div>
			<div class="col-md-6">
				<div class="element-wrap">
					<div class="animated " data-animtype="fadeInDown" data-animrepeat="0" data-animspeed="1s" data-animdelay="1s">
						<h2><strong><?php echo $wset['title'];?></strong></h2>
						<div class="title-line-o"></div><br><br>
					</div>
					<div class="animated" data-animtype="fadeInRight" data-animrepeat="0" data-animspeed="1s" data-animdelay="1s">
						<p class="mBottom20" style="  font-size: 13px;">
						<?php echo $wset['content'];?></p>
					</div>
					<div class="title-line-o"></div><br><br>


					<div class="animated " data-animtype="fadeInUp" data-animrepeat="0" data-animspeed="1s" data-animdelay="1.5s">
						<a href="<?php echo $wset['dlink'];?>" class="btn-kso kso-px1Up delay-06s kso-hidden conceptBgColor animated fadeInUp" style="color:#ffffff;">
							자세한 내용 보기
						</a>
					</div>
			</div>
		</div>
	</div>
</section>