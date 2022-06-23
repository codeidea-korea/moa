<?php
if (!defined('_GNUBOARD_')) exit; //개별 페이지 접근 불가

$wset['title'] = '오시는 길';
$wset['gmap'] = '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3164.458544041227!2d127.11930005163384!3d37.52068677970748!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x357ca5610ed8f483%3A0x5e38157c0815a26f!2z7Jis66a87ZS96rO17JuQ!5e0!3m2!1sko!2skr!4v1536917126302" width="600" height="550" frameborder="0" style="border:0" allowfullscreen></iframe>';
?>
<style>
#section-5 .triangle { border-top-color: <?php echo $wset['color_t'];?>; }
#section-5 .triangle i { position: absolute; top: -40px; left: 50%; margin-left: -13px; font-size: 30px; color: <?php echo $wset['color_tb'];?>; }
</style>
<section id="section-5" class="section-5">

	<?php if($wset['tuse']){ ?>
	<div class="triangle">
		<a href="#<?php echo $wset['link_1'];?>" class="kso-scroll"><i class="fa fa-arrow-down"></i></a>
	</div>
	<?php } ?>

	<div class="testimonials-block content content-center margin-bottom-65" id="traffic" style="background-color: #fff; padding: 100px 0 50px 0;">
		<div class="container">

			<div class="item col-md-12 col-sm-12 col-xs-12" >
				<h3 class="div-title-underbar">
					<span class="div-title-underbar-bold border-<?php echo $headline;?>" style="color:#000;">
						<?php echo $wset['title']; ?>
					</span>
				</h3>

				<br>

				<div class="div-iframe" style="padding:10px; border:1px solid #eee;height:440px;" >
					<div class="iframe-wrap" style="height:420px;padding-bottom:0%;" >
						<?php echo $wset['gmap']; ?>
					</div>
				</div>
			</div>

		</div>
	</div>

</section>