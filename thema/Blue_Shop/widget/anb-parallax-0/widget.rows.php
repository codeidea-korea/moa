<?php
if (!defined('_GNUBOARD_')) exit; //개별 페이지 접근 불가

if(!$wset['color_t']) { $wset['color_t'] = '#74b4d4'; }
if(!$wset['color_tb']) { $wset['color_tb'] = '#ffffff'; }

if(!$wset['title']) { $wset['title'] = 'AMINABLUE'; }
if(!$wset['subject']) { $wset['subject'] = '패럴랙스 영역으로 스크롤을 할 때 시차를 두고 배경이 움직이는 효과로 각 섹션과 섹션 사이의 공간을 활용함으로써 보다 스타일리쉬하게 표현하게 됩니다.'; }

if(!$wset['no_1']) { $wset['no_1'] = '24'; }
if(!$wset['no_2']) { $wset['no_2'] = '10'; }
if(!$wset['no_3']) { $wset['no_3'] = '276'; }
if(!$wset['no_4']) { $wset['no_4'] = '7000'; }

if(!$wset['content_1']) { $wset['content_1'] = '24 hr Customer Care Operations'; }
if(!$wset['content_2']) { $wset['content_2'] = 'Many Years KnowHow'; }
if(!$wset['content_3']) { $wset['content_3'] = 'Complated Projects'; }
if(!$wset['content_4']) { $wset['content_4'] = 'Over Question & Answer'; }

?>
<style>
#parallax-0 .triangle0 { border-top-color: <?php echo $wset['color_t'];?>; }
.triangle0 i { position: absolute; top: -40px; left: 50%; margin-left: -13px; font-size: 30px; color: <?php echo $wset['color_tb'];?>;; }
</style>

<section id="parallax-0" data-speed="2" data-type="background" style="background-position: 50% -1000px;">
	<div class="parallaxCover0">
		<div class="container">
			<?php if($wset['tuse']){ ?>
			<div class="triangle0">
				<a href="#<?php echo $wset['link_1'];?>" class="kso-scroll"><i class="fa fa-arrow-down"></i></a>
			</div>
			<?php } ?>
			<div class="col-md-12 col-lg-12">
				<div class="text-center mBottom20">
					<h3><?php echo $wset['title'];?></h3>
					<p class="widthfix mBottom30"><?php echo $wset['subject'];?></p>
					<!--<a href="#" class="btn-flat btn-large flatBgColor-a">Read More</a>	-->
				</div>
			</div>


			<div class="row text-center countTo">
				<div class="col-md-3 col-sm-6 en animated"
						data-animtype="flip" data-animrepeat="0" data-animspeed="1s" data-animdelay="0.4s">
					<span class="boxed radius3 ">
						<strong class="styleColor" data-from="0" data-to="24" data-speed="1200"><?php echo $wset['no_1'];?></strong>
						<small><?php echo $wset['content_1'];?></small>
					</span>
				</div>

				<div class="col-md-3 col-sm-6">
					<span class="boxed radius3 en  animated"
						data-animtype="flip" data-animrepeat="0" data-animspeed="1s" data-animdelay="0.4s">
						<strong class="styleColor" data-from="2015" data-to="10" data-speed="2000"><?php echo $wset['no_2'];?></strong>
						<small><?php echo $wset['content_2'];?></small>
					</span>
				</div>

				<div class="col-md-3 col-sm-6">
					<span class="boxed radius3 en animated"
						data-animtype="flip" data-animrepeat="0" data-animspeed="1s" data-animdelay="0.4s">
						<strong class="styleColor"  data-from="1" data-to="276" data-speed="3000" data-refresh-interval="50"><?php echo $wset['no_3'];?></strong>
						<small><?php echo $wset['content_3'];?></small>
					</span>
				</div>

				<div class="col-md-3 col-sm-6">
					<span class="boxed radius3 en animated"
						data-animtype="flip" data-animrepeat="0" data-animspeed="1s" data-animdelay="0.4s">
						<strong class="styleColor"  data-to="7000" data-speed="4000"><?php echo $wset['no_4'];?></strong>
						<small><?php echo $wset['content_4'];?></small>
					</span>
				</div>
			</div>
	</div>
</section>