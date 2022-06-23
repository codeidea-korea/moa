<?php
if (!defined('_GNUBOARD_')) exit; //개별 페이지 접근 불가

//add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$widget_url.'/widget.css">', 0);

if(!$wset['slider']) {
	$wset['slider'] = 2;
	for($i=1; $i <= 2; $i++) {
		$wset['use'.$i] = 1;
		$wset['cl'.$i] = 'center';
		$wset['img'.$i] = $widget_url.'/img/banner.jpg';
	}
}

// 높이
$height = (isset($wset['height']) && $wset['height']) ? $wset['height'] : '200px';
$lg = (isset($wset['lg']) && $wset['lg']) ? $wset['lg'] : '';
$md = (isset($wset['md']) && $wset['md']) ? $wset['md'] : '';
$sm = (isset($wset['sm']) && $wset['sm']) ? $wset['sm'] : '';
$xs = (isset($wset['xs']) && $wset['xs']) ? $wset['xs'] : '';

// 효과
$effect = apms_carousel_effect($wset['effect']);

// 간격
if($wset['auto'] == "") {
	$wset['auto'] = 3000;
}
$interval = apms_carousel_interval($wset['auto']);

$list = array();

// 슬라이더
$k=0;
for ($i=1; $i <= $wset['slider']; $i++) {

	if(!$wset['use'.$i]) continue; // 사용하지 않으면 건너뜀

	$list[$k]['cl'] = ($wset['cl'.$i]) ? ' background-position:'.$wset['cl'.$i].' center;' : '';
	$list[$k]['img'] = $wset['img'.$i];
	$list[$k]['link'] = ($wset['link'.$i]) ? $wset['link'.$i] : 'javascript:;';
	$list[$k]['target'] = ($wset['target'.$i]) ? ' target="'.$wset['target'.$i].'"' : '';
	$k++;
}

$list_cnt = count($list);

// 랜덤
if($wset['rdm'] && $list_cnt) shuffle($list);

// 랜덤아이디
$widget_id = apms_id(); 

?>
<style>

	#<?php echo $widget_id;?> .item { background-size:cover; background-position:center center; background-repeat:no-repeat; }
	#<?php echo $widget_id;?> .img-wrap { padding-bottom:<?php echo $height;?>; }
	#<?php echo $widget_id;?> .tab-indicators { position:absolute; left:0; bottom:0; width:100%; }
	#<?php echo $widget_id;?> .nav a { background: rgba(255,255,255, 0.9); color:#000; border-radius: 0px; margin:0px; }
	#<?php echo $widget_id;?> .nav a:hover, #<?php echo $widget_id;?> .nav a:focus,
	#<?php echo $widget_id;?> .nav .active a { background: rgba(0,0,0, 0.6); color:#fff; }
	<?php if(_RESPONSIVE_) { //반응형일 때만 작동 ?>
		<?php if($lg) { ?>
		@media (max-width:1199px) { 
			.responsive #<?php echo $widget_id;?> .img-wrap { padding-bottom:<?php echo $lg;?> !important; } 
		}
		<?php } ?>
		<?php if($md) { ?>
		@media (max-width:991px) { 
			.responsive #<?php echo $widget_id;?> .img-wrap { padding-bottom:<?php echo $md;?> !important; } 
		}
		<?php } ?>
		<?php if($sm) { ?>
		@media (max-width:767px) { 
			.responsive #<?php echo $widget_id;?> .img-wrap { padding-bottom:<?php echo $sm;?> !important; } 
		}
		<?php } ?>
		<?php if($xs) { ?>
		@media (max-width:480px) { 
			.responsive #<?php echo $widget_id;?> .img-wrap { padding-bottom:<?php echo $xs;?> !important; } 
		}
		<?php } ?>
	<?php } ?>
</style>
<div id="<?php echo $widget_id;?>" class="basic-banner swipe-carousel carousel div-carousel<?php echo $effect;?>" data-ride="carousel" data-interval="<?php echo $interval;?>">
	<div class="carousel-inner">
		<?php for ($i=0; $i < $list_cnt; $i++) { ?>
			<div class="item<?php echo (!$i) ? ' active' : '';?>" style="background-image: url('<?php echo $list[$i]['img'];?>');<?php echo $list[$i]['cl'];?>">
				<a href="<?php echo $list[$i]['link'];?>"<?php echo $list[$i]['target'];?>>
					<div class="img-wrap">
						<div class="img-item">
							&nbsp;
						</div>
					</div>
				</a>
			</div>
		<?php $k++;} ?>
	</div>

	<!-- Controls 
	<a class="left carousel-control" href="#<?php echo $widget_id;?>" role="button" data-slide="prev">
		<i class="fa fa-angle-left" aria-hidden="true"></i>
		<span class="sr-only">Previous</span>
	</a>
	<a class="right carousel-control" href="#<?php echo $widget_id;?>" role="button" data-slide="next">
		<i class="fa fa-angle-right" aria-hidden="true"></i>
		<span class="sr-only">Next</span>
	</a>
	-->
	<!-- Indicators -->
	<?php if($wset['nav']) { ?>
		<ol class="carousel-indicators" style="z-index:2;margin-bottom:0px;bottom:<?php echo ($wset['dot']) ? $wset['dot'] : '10px';?>;">
			<?php for ($i=0; $i < $list_cnt; $i++) { ?>
				<li data-target="#<?php echo $widget_id;?>" data-slide-to="<?php echo $i;?>"<?php echo (!$i) ? ' class="active"' : '';?>></li>
			<?php } ?>
		</ol>
	<?php } ?>
</div>
<?php if($setup_href) { ?>
	<div class="btn-wset text-center p10">
		<a href="<?php echo $setup_href;?>" class="win_memo">
			<span class="text-muted font-12"><i class="fa fa-cog"></i> 설정하기</span>
		</a>
	</div>
<?php } ?>
