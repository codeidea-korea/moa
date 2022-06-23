<?php
if (!defined('_GNUBOARD_')) exit; //개별 페이지 접근 불가

if(!$wset['color_t']) { $wset['color_t'] = '#4dc2bc'; }
if(!$wset['color_tb']) { $wset['color_tb'] = '#ffffff'; }

?>
<style>
#parallax-2 .triangle i { color: <?php echo $wset['color_tb'];?>; }
#parallax-2 .triangle { border-top-color: <?php echo $wset['color_t'];?>; }
#parallax-2 { background-image: url(<?php echo $wset['background-img'];?>); background-repeat: repeat-y; background-position: 50% 0; background-attachment: fixed; }
</style>
<section id="parallax-2" class="section-4" data-speed="4" data-type="background" style="background-position: 50% -1012px;">
	<div class="player2  mb_YTPlayer isMuted" data-speed="2" data-type="background" data-property="{videoURL:'nFS4GonXg64',containment:'self',showControls: true,autoPlay:true, mute:true, startAt:0,opacity:1}" style="opacity: 1; z-index: 0; background-image: none;">

		<div class="parallaxCover2">
			<div class="container">
				<?php if($wset['tuse']){ ?>
				<div class="triangle bgcolor-flat1">
					<a href="#parallax-2" class="kso-scroll"><i class="fa fa-arrow-down"></i></a>
				</div>
				<?php } ?>
				<div class="col-md-6 col-lg-6">
					<div class="text-center mBottom20 animated" data-animtype="fadeInLeft" data-animrepeat="0"  data-animdelay="1s">
						<h3><?php echo $wset['title'];?></h3>
						<p class="text-trans"><?php echo $wset['content'];?></p>
						<p><br>
						</p>
						</div>
						<div class="text-center  animated" data-animtype="fadeInUp" data-animrepeat="0"  data-animdelay="1s">
							<a href="<?php echo $wset['dlink'];?>" class="btn-flat btn-large flatBgColor-b">Read More</a>
						</div>
				</div>
				<div class="col-md-6 col-lg-6">
					<div class="text-center animated" data-animtype="fadeInRight" data-animrepeat="0"  data-animdelay="1s">
						<div class="text-center animated" data-animtype="fadeInRight" data-animrepeat="0"  data-animdelay="1s" style="position:relative;height:0;padding-bottom:56.25%"><iframe src="<?php echo $wset['youtube'];?>?ecver=2" width="640" height="360" frameborder="0" style="position:absolute;width:100%;height:100%;left:0" allowfullscreen></iframe></div>
				</div>
			</div>
		</div>
	</div>
</section>