<?php
if (!defined('_GNUBOARD_')) exit; //개별 페이지 접근 불가

if(!$wset['subject_1']) { $wset['subject_1'] = '아미나 사용자라면 완벽호환'; }
if(!$wset['subject_2']) { $wset['subject_2'] = '아미나 블루가 만들어가는 새로운 기준'; }
if(!$wset['img1']) { $wset['img1'] = '아미나 사용자라면 완벽호환'; }
if(!$wset['subject_3']) { $wset['subject_3'] = 'AMINA BLUE SHOP'; }

if(!$wset['color_t']) { $wset['color_t'] = '#fff'; }
if(!$wset['color_tb']) { $wset['color_tb'] = '#000'; }

$pvm = $_GET['pvm'];
?>
<style>
#kso-info .triangle{ border-top-color: <?php echo $wset['color_t']; ?>;position: relative; }
.triangle i { position: absolute;top: -40px;left: 50%;margin-left: -13px;font-size: 30px;color: <?php echo $wset['color_tb']; ?>; }
</style>

<section id="kso-info" class="kso-section" style="background-color:#fff;">
	<?php if($wset['tuse'] == '1' ){ ?>
	<div class="triangle">
		<a href="#<?php echo $wset['link_1'];?>" class="kso-scroll"><i class="fa fa-arrow-down"></i></a>
	</div>
	<?php } ?>
	<div class="container">
		<div class="col-md-12">
			<div class="text-center" style="margin-top:70px;">
				<span style="font-weight:blod;font-family:나눔;font-size:22px;letter-spacing:-1px"><?php echo $wset['subject_1']; ?></span>
			</div>
			<div class="text-center" >
				<span style="font-weight:blod;font-family:나눔;font-size:36px;letter-spacing:-2px"><?php echo $wset['subject_2']; ?></span>
			</div>
			<div class="div-title-block-bold text-center" style="margin:20px 0 15px;">
				<span style="padding:0px 15px; margin:0px;">
					<img src="<?php echo $wset['img1']; ?>">
				</span>
			</div>

			<div class="text-center" style="">
				<span style="font-weight:blod;font-family:나눔;font-size:20px;letter-spacing:-2px"><?php echo $wset['subject_3']; ?></span>
			</div>
			<div style="top:20px;">
				<?php echo apms_widget('basic-shop-item-slider2', 'kso-post-wm113'); ?>
			</div>
		</div>
	</div>
</section>