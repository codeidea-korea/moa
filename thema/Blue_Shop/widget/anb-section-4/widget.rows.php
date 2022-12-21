<?php
if (!defined('_GNUBOARD_')) exit; //개별 페이지 접근 불가

if(!$wset['title']) { $wset['title'] = 'OUR TEAM'; }
if(!$wset['link_1']) { $wset['link_1'] = 'section-4'; }

if(!$wset['img1']) { $wset['img1'] = 'http://ag53.ode.kr/data/apms/background/t111.png'; }
if(!$wset['img2']) { $wset['img2'] = 'http://ag53.ode.kr/data/apms/background/t222.png'; }
if(!$wset['img3']) { $wset['img3'] = 'http://ag53.ode.kr/data/apms/background/t333.png'; }
if(!$wset['img4']) { $wset['img4'] = 'http://ag53.ode.kr/data/apms/background/t444.png'; }

if(!$wset['title_1']) { $wset['title_1'] = 'CEO'; }
if(!$wset['title_2']) { $wset['title_2'] = 'Director'; }
if(!$wset['title_3']) { $wset['title_3'] = '퍼블리셔'; }
if(!$wset['title_4']) { $wset['title_4'] = '디자이너'; }

if(!$wset['position_1']) { $wset['position_1'] = 'CEO/Director/Developer'; }
if(!$wset['position_1']) { $wset['position_1'] = 'Director/Developer'; }
if(!$wset['position_1']) { $wset['position_1'] = 'Publisher'; }
if(!$wset['position_1']) { $wset['position_1'] = 'Web Designer'; }

if(!$wset['greeting_1']) { $wset['greeting_1'] = '인사말을 넣으세요!'; }
if(!$wset['greeting_2']) { $wset['greeting_2'] = '인사말을 넣으세요!'; }
if(!$wset['greeting_3']) { $wset['greeting_3'] = '인사말을 넣으세요!'; }
if(!$wset['greeting_4']) { $wset['greeting_4'] = '인사말을 넣으세요!'; }
?>
<style>
#section-4 .triangle { border-top-color: <?php echo $wset['color_t'];?>; }
#section-4 .triangle i { position: absolute; top: -40px; left: 50%; margin-left: -13px; font-size: 30px; color: <?php echo $wset['color_tb'];?>; }
</style>
<section id="section-4" class="section-4">
	<div class="container">
		<?php if($wset['tuse']){ ?>
		<div class="triangle">
			<a href="#<?php echo $wset['link_1'];?>" class="kso-scroll"><i class="fa fa-arrow-down"></i></a>
		</div>
		<?php } ?>
		<div class="row">
			<div class="col-md-12">
				<div class="text-center mBottom60 animated" data-animtype="fadeInDown"	data-animrepeat="0" data-animspeed="0.5s" data-animdelay="0.7s">
						<div class="hvr-wobble-vertical hvr-bubble-bottom">
							<h1><?php echo $wset['title'];?></h1>
						</div>

					</div>
				<div class="row">
						<div class="team-photo"></div>
							<div class="col-lg-3 col-md-3 animated"
									data-animtype="rollIn"
									data-animrepeat="0"
									data-animspeed="0.5s"
									data-animdelay="0.7s">
							<div class="iconBox text-center">
								<div class="teamBg hvr-bounce-in">
									<img src="<?php echo ($wset['img1']);?>">
								</div>
								<h4 class="teamTitle"><?php echo $wset['title_1'];?></h4>
									<small><?php echo $wset['position_1'];?></small>
									<p class="font14"><?php echo $wset['greeting_1'];?></p>
							</div>
					</div>

					<div class="col-lg-3 col-md-3  animated"
								data-animtype="rollIn"
								data-animrepeat="0"
								data-animspeed="1s"
								data-animdelay="1.2s">
						<div class="iconBox text-center">
							<div class="teamBg hvr-pulse-shrink">
								<img src="<?php echo ($wset['img2']);?>">
							</div>
							<h4 class="teamTitle"><?php echo $wset['title_2'];?></h4>
							<small><?php echo $wset['position_2'];?></small>
							<p class="font14"><?php echo $wset['greeting_2'];?></p>
						</div>
					</div>

					<div class="col-lg-3 col-md-3 animated"
								data-animtype="bounceIn"
								data-animrepeat="0"
								data-animspeed="1s"
								data-animdelay="1.7s">
						<div class="iconBox text-center">
							<div class="teamBg hvr-buzz-out">
								<img src="<?php echo ($wset['img3']);?>">
								</div>
							<h4 class="teamTitle"><?php echo $wset['title_3'];?></h4>
							<small><?php echo $wset['position_3'];?></small>
							<p class="font14"><?php echo $wset['greeting_3'];?></p>
						</div>
					</div>

					<div class="col-lg-3 col-md-3 animated"
								data-animtype="bounceIn"
								data-animrepeat="0"
								data-animspeed="1s"
								data-animdelay="2.2s">
						<div class="iconBox text-center">
							<div class="teamBg hvr-grow-rotate">
								<img src="<?php echo ($wset['img4']);?>">
								</div>
							<h4 class="teamTitle"><?php echo $wset['title_4'];?></h4>
							<small><?php echo $wset['position_4'];?></small>
							<p class="font14"><?php echo $wset['greeting_4'];?></p>
						</div>
					</div>

				</div>
			</div>
		</div><!-- End Onepage Team -->
	</div>
</section>