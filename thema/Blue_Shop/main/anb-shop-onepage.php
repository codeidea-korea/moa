<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 위젯 대표아이디 설정
$wid = 'COMPANY';

// 게시판 제목 폰트 설정
$font = 'font-16 en';

// 게시판 제목 하단라인컬러 설정 - red, blue, green, orangered, black, orange, yellow, navy, violet, deepblue, crimson..
$line = 'blue';

// 사이드 위치 설정 - left, right
$side = ($at_set['side']) ? 'left' : 'right';

add_stylesheet('<link rel="stylesheet" href="'.COLORSET_URL.'/main_section.css?time='.time().'" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.THEMA_URL.'/assets/css/animate.css?time='.time().'" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.THEMA_URL.'/assets/css/hover.css?time='.time().'" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Jua" type="text/css">',0);
?>
<style>
	.widget-index { overflow:hidden; }
	.widget-index .div-title-underbar { margin-bottom:15px; }
	.widget-index .div-title-underbar span { padding-bottom:4px; }
	.widget-index .div-title-underbar span b { font-weight:500; }
	.widget-index h2.div-title-underbar { font-size:22px; text-align:center; margin-bottom:15px; /* 위젯 타이틀 */ }
	.widget-index h2 .div-title-underbar-bold { font-weight:bold; padding-bottom:4px; border-bottom-width:4px; margin-bottom:-3px; }
	.widget-index .widget-box { margin-bottom:20px; background-color:#fff; padding:10px; }
	.widget-index .widget-img img { display:block; max-width:100%; /* 배너 이미지 */ }
	@media all and (max-width:767px) {
		.responsive .widget-index .widget-box { margin-bottom:0px; }
	}

	.div-title-block-thin, .div-title-block-bold { position: relative; margin-bottom:20px;}
	.div-title-block-bold::before { height: 1px; background: rgb(197, 196, 196); margin-top: -4px; }
</style>
<!--PC-->
<div class="hidden-xs visible-md visible-lg hidden-sm">
	<?php echo apms_widget('anb-title', $wid.'-PC', 'shadow=4 height=400px', 'auto=0'); //타이틀 ?>
</div>
<!--Mobile-->
<div class="visible-xs hidden-md hidden-lg visible-sm">
	<?php echo apms_widget('basic-title', $wid.'-M2', 'shadow=4 height=400px', 'auto=0'); //타이틀 ?>
</div>

<div class="menu-bar2"></div>
<?php echo apms_widget('basic-shop-item-slider2', $wid.'-wm111', ''); ?>

<div class="widget-index">
	<div class="row at-row" style="background-color:#fff;">

		<?php echo apms_widget('anb-kso-info', $wid.'-wm10', ''); ?>

		<?php echo apms_widget('anb-parallax-1', $wid.'-wm11', ''); ?>

		<?php echo apms_widget('anb-section-1', $wid.'-wm12', ''); ?>

		<?php echo apms_widget('anb-parallax-0', $wid.'-wm13', ''); ?>

		<?php echo apms_widget('anb-kso-info2', $wid.'-wm14', ''); ?>

		<?php //echo apms_widget('anb-section-3', $wid.'-wm15', ''); ?>

		<?php //echo apms_widget('basic-post-gallery', $wid.'-wm22', ''); ?>

		<?php echo apms_widget('anb-section-2', $wid.'-wm20', ''); ?>

		<?php echo apms_widget('anb-section-7', $wid.'-wm21', ''); ?>

		<?php echo apms_widget('anb-section-4', $wid.'-wm16', ''); ?>

		<?php echo apms_widget('anb-section-6', $wid.'-wm19', ''); ?>

		<?php echo apms_widget('anb-parallax-2', $wid.'-wm17', ''); ?>

		<?php echo apms_widget('anb-section-5', $wid.'-wm18', ''); ?>



	</div>
</div>
