<?php
if (!defined('_GNUBOARD_')) exit; //개별 페이지 접근 불가

if(!$wset['slider']) {
	$wset['slider'] = 2;
	for($i=1; $i <= 2; $i++) {
		$wset['use'.$i] = 1;
		$wset['cl'.$i] = 'center';
		$wset['img'.$i] = $widget_url.'/img/title.jpg';
		$wset['cs'.$i] = 'title';
		$wset['cf'.$i] = 'white';
		$wset['cc'.$i] = 'black';
		$wset['caption'.$i] = '위젯설정에서 사용할 타이틀을 등록해 주세요.';
	}
}

// 높이
$height = (isset($wset['height']) && $wset['height']) ? $wset['height'] : '400px';
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

// 작은화살표
$is_small = (isset($wset['small']) && $wset['small']) ? ' div-carousel' : '';

$list = array();

// 슬라이더
$k=0;
for ($i=1; $i <= $wset['slider']; $i++) {
	//echo $wset['baner'.$i]."|";
	if(!$wset['use'.$i]) continue; // 사용하지 않으면 건너뜀

	$list[$k]['cl'] = ($wset['cl'.$i]) ? ' background-position:'.$wset['cl'.$i].' center;' : '';
	$list[$k]['img'] = $wset['img'.$i];
	$list[$k]['link'] = ($wset['link'.$i]) ? $wset['link'.$i] : 'javascript:;';
	$list[$k]['label'] = $wset['label'.$i];
	$list[$k]['txt'] = $wset['txt'.$i];
	$list[$k]['cs'] = $wset['cs'.$i];
	$list[$k]['caption'] = $wset['caption'.$i];
	$list[$k]['cf'] = $wset['cf'.$i];
	$list[$k]['cc'] = $wset['cc'.$i];
	$list[$k]['baner'] = $wset['baner'.$i];
	 for($s=1,$no=1; $s <= $wset['baner'.$i]; $s++,$no++){
		$list[$k]['baner_img'][$no] = $wset['img'.$i.'-'.$no];
		$list[$k]['baner_link'][$no] = $wset['link'.$i.'-'.$no];
	 }
	$k++;
}
//print_r2($list);
$list_cnt = count($list);

// 랜덤
if($wset['rdm'] && $list_cnt) shuffle($list);

// 랜덤아이디
$widget_id = apms_id();

?>
<style>
	.img-wrap .img-item img { display: block;border: 0;width: 100%;height: auto;margin: 0px auto;!important; }

	<?php if($wset['slide_style'] == 'clear') { ?>
		.carousel-control.left {
			background-image: -webkit-linear-gradient(left,rgba(0,0,0,0) 0,rgba(0,0,0,0) 100%);
			background-image: -o-linear-gradient(left,rgba(0,0,0,0) 0,rgba(0,0,0,0) 100%);
			background-image: -webkit-gradient(linear,left top,right top,from(rgba(0,0,0,0)),to(rgba(0,0,0,0)));
			background-image: linear-gradient(to right,rgba(0,0,0,0) 0,rgba(0,0,0,0) 100%);
			filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#00000000',endColorstr='#00000000',GradientType=1);
			background-repeat: repeat-x; !important;
		}
		.carousel-control.right {
			right: 0;
			left: auto;
			background-image: -webkit-linear-gradient(left,rgba(0,0,0,0) 0,rgba(0,0,0,0) 100%);
			background-image: -o-linear-gradient(left,rgba(0,0,0,0) 0,rgba(0,0,0,0) 100%);
			background-image: -webkit-gradient(linear,left top,right top,from(rgba(0,0,0,0)),to(rgba(0,0,0,0)));
			background-image: linear-gradient(to right,rgba(0,0,0,0) 0,rgba(0,0,0,0) 100%);
			filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#00000000',endColorstr='#00000000',GradientType=1);
			background-repeat: repeat-x; !important;
		}
	<?php } ?>

	.carousel-control:hover, .carousel-control:focus { color: #fff;text-decoration: none;filter: alpha(opacity=100);outline: 0;opacity: 1; !important; }
	.carousel-control, .carousel-control { color: #fff;text-decoration: none;filter: alpha(opacity=90);outline: 0;opacity: 0.9; !important; }

	#<?php echo $widget_id;?> .item { background-size:cover; background-position:center center; background-repeat:no-repeat; }
	#<?php echo $widget_id;?> .img-wrap { padding-bottom:<?php echo $height;?>; display: block; position: relative;height: 0;overflow: hidden;max-width: 1024px;max-height: <?php echo $height;?>;margin: 0 auto;overflow: hidden;zoom: 1; }

	#<?php echo $widget_id;?> .img-wrap1-1 { padding-bottom:<?php echo $height;?>; display: block; position: relative;height: 0;overflow: hidden;width: 512px;max-height: 400px;margin: 0 auto;overflow: hidden;zoom: 1; }
	#<?php echo $widget_id;?> .img-wrap1-2 { padding-bottom:<?php echo $height;?>; display: block; position: relative;height: 0;overflow: hidden;width: 512px;height: 400px;margin: 0 auto;overflow: hidden;zoom: 1; }
	#<?php echo $widget_id;?> .img-wrap2-1 { padding-bottom:<?php echo $height;?>; display: block; position: relative;height: 0;overflow: hidden;width: 341.3px;height: 400px;margin: 0 auto;overflow: hidden;zoom: 1; }
	#<?php echo $widget_id;?> .img-wrap2-2 { padding-bottom:<?php echo $height;?>; display: block; position: relative;height: 0;overflow: hidden;width: 341.3px;height: 400px;margin: 0 auto;overflow: hidden;zoom: 1; }
	#<?php echo $widget_id;?> .img-wrap2-3 { padding-bottom:<?php echo $height;?>; display: block; position: relative;height: 0;overflow: hidden;width: 341.3px;height: 400px;margin: 0 auto;overflow: hidden;zoom: 1; }


	#<?php echo $widget_id;?> .tab-indicators { position:absolute; left:0; bottom:0; width:100%; }
	#<?php echo $widget_id;?> .nav a { background: rgba(255,255,255, 0.9); color:#000; border-radius: 0px; margin:0px; }
	#<?php echo $widget_id;?> .nav a:hover, #<?php echo $widget_id;?> .nav a:focus,
	#<?php echo $widget_id;?> .nav .active a { background: rgba(0,0,0, 0.6); color:#fff; }


	.carousel-indicators { bottom: 0px !important; }
	.carousel-indicators li {display: inline-block;width: 16px;height: 16px;margin: 0px 4px;text-indent: -999px;cursor: pointer;background-color: #cacaca;background-color: rgba(202,202,202,1);border: 0px solid #cacaca;border-radius: 10px;!important; }
	.carousel-indicators .active { width: 18px;height: 18px;margin: 0;background-color: #78c5eb;!important; }
	.carousel-control { margin-top: -30px !important; /*width:45% !important; */}

	.arr-img { display: block;background-image: url(<?php echo $widget_url; ?>/img/aminablue_main_v3.png);line-height: 500px;overflow: hidden;zoom: 1;!important; }
	.glyphicon-chevron-left { display: block;margin: 0 auto;width: 33px !important;height: 62px !important;text-align: center;!important;background-position: 0px 0px; }
	.glyphicon-chevron-left:hover { background-position: 0px -70px; }
	.glyphicon-chevron-right { display: block;margin: 0 auto;width: 33px !important;height: 62px !important;text-align: center;!important;background-position: -40px -0px;}
	.glyphicon-chevron-right:hover { background-position: -40px -70px; }

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
<style>
#<?php echo $widget_id;?> .carousel-control.right { background-image:none; }
#<?php echo $widget_id;?> .carousel-control.left { background-image:none; }
</style>
<div id="<?php echo $widget_id;?>" class="swipe-carousel carousel<?php echo $is_small;?><?php echo $effect;?>" data-ride="carousel" data-interval="<?php echo $interval;?>">
	<div class="carousel-inner bg-black">
		<?php for ($i=0; $i < $list_cnt; $i++) { ?>
			<div class="item<?php echo (!$i) ? ' active' : '';?>" style="background-image: url('<?php echo $list[$i]['img'];?>');<?php echo $list[$i]['cl'];?>" style="width: 1562px;">
				<!--2개일때 3개일때 각자처리해주자-->
				<?php if($list[$i]['baner'] == "1"){ //1개일때 ?>
					<a href="<?php echo $list[$i]['link'];?>" >
						<div class="img-wrap">
							<a href="<?php echo $list[$i]['baner_link'][1];?>" target="_blank">
								<img src="<?php echo $list[$i]['baner_img'][1]; ?>" >
								<div class="img-item">
									<?php if($list[$i]['label']) { // 라벨 ?>
										<div class="label-band bg-<?php echo $list[$i]['label'];?>"><?php echo apms_fa($list[$i]['txt']); ?></div>
									<?php } ?>
									<?php if($list[$i]['cs'] && $list[$i]['caption']) { // 캡션 ?>
										<div class="en in-<?php echo $list[$i]['cs'];?> font-<?php echo $list[$i]['cf'];?> trans-bg-<?php echo $list[$i]['cc'];?>">
											<?php echo apms_fa($list[$i]['caption']); ?>
										</div>
									<?php } ?>
								</div>
							</a>
						</div>
					</a>
				<?php }else if($list[$i]['baner'] == "2"){ //2개일때  좌우지정 ?>
					<a href="<?php echo $list[$i]['link'];?>">
						<div class="img-wrap">
							<div class="img-item">
								<a href="<?php echo $list[$i]['baner_link'][1];?>" target="_blank" style="float: left;">
									<img src="<?php echo $list[$i]['baner_img'][1]; ?>" >
								</a>
								<a href="<?php echo $list[$i]['baner_link'][2];?>" target="_blank" style="float: left;">
									<img src="<?php echo $list[$i]['baner_img'][2]; ?>" >
								</a>
								<?php if($list[$i]['label']) { // 라벨 ?>
									<div class="label-band bg-<?php echo $list[$i]['label'];?>"><?php echo apms_fa($list[$i]['txt']); ?></div>
								<?php } ?>
								<?php if($list[$i]['cs'] && $list[$i]['caption']) { // 캡션 ?>
									<div class="en in-<?php echo $list[$i]['cs'];?> font-<?php echo $list[$i]['cf'];?> trans-bg-<?php echo $list[$i]['cc'];?>">
										<?php echo apms_fa($list[$i]['caption']); ?>
									</div>
								<?php } ?>
							</div>
						</div>
					</a>

				<?php }else if($list[$i]['baner'] == "3"){ //3개일때?>

					<a href="<?php echo $list[$i]['link'];?>" >
						<div class="img-wrap">
							<!--<img src="<?php echo $list[$i]['baner_img'][2]; ?>" style="vertical-align: middle;" >-->
							<div class="img-item">
								<a href="<?php echo ($list[$i]['baner_link'][1]) ? $list[$i]['baner_link'][1] : '#' ;?>" target="_blank" style="float: left;">
									<img src="<?php echo $list[$i]['baner_img'][1]; ?>" >
								</a>
								<a href="<?php echo ($list[$i]['baner_link'][1]) ? $list[$i]['baner_link'][2] : '#' ;?>" target="_blank" style="float: left;">
									<img src="<?php echo $list[$i]['baner_img'][2]; ?>" >
								</a>
								<a href="<?php echo ($list[$i]['baner_link'][1]) ? $list[$i]['baner_link'][3] : '#' ;?>" target="_blank" style="float: left;">
									<img src="<?php echo $list[$i]['baner_img'][3]; ?>" >
								</a>
								<?php if($list[$i]['label']) { // 라벨 ?>
									<div class="label-band bg-<?php echo $list[$i]['label'];?>"><?php echo apms_fa($list[$i]['txt']); ?></div>
								<?php } ?>
								<?php if($list[$i]['cs'] && $list[$i]['caption']) { // 캡션 ?>
									<div class="en in-<?php echo $list[$i]['cs'];?> font-<?php echo $list[$i]['cf'];?> trans-bg-<?php echo $list[$i]['cc'];?>">
										<?php echo apms_fa($list[$i]['caption']); ?>
									</div>
								<?php } ?>
							</div>
						</div>
					</a>

				<?php }else{ ?>
					<a href="<?php echo $list[$i]['link'];?>" title="<?php echo $list[$i]['baner']; ?>" >
						<div class="img-wrap">
							<div class="img-item">
								<?php if($list[$i]['label']) { // 라벨 ?>
									<div class="label-band bg-<?php echo $list[$i]['label'];?>"><?php echo apms_fa($list[$i]['txt']); ?></div>
								<?php } ?>
								<?php if($list[$i]['cs'] && $list[$i]['caption']) { // 캡션 ?>
									<div class="en in-<?php echo $list[$i]['cs'];?> font-<?php echo $list[$i]['cf'];?> trans-bg-<?php echo $list[$i]['cc'];?>">
										<?php echo apms_fa($list[$i]['caption']); ?>
									</div>
								<?php } ?>
							</div>
						</div>
					</a>
				<?php } ?>
			</div>
		<?php $k++;} ?>
	</div>

	<?php if(!$wset['arrow']) { ?>
		<!-- Controls -->
		<a class="left carousel-control" href="#<?php echo $widget_id;?>" role="button" data-slide="prev">
			<?php if($is_small) { ?>
				<i class="fa fa-chevron-left" aria-hidden="true"></i>
			<?php } else { ?>
			   <span class="glyphicon glyphicon-chevron-left arr-img" aria-hidden="true"></span>
			<?php } ?>
			<span class="sr-only">Previous</span>
		</a>
		<a class="right carousel-control" href="#<?php echo $widget_id;?>" role="button" data-slide="next">
			<?php if($is_small) { ?>
				<i class="fa fa-chevron-right" aria-hidden="true"></i>
			<?php } else { ?>
				<span class="glyphicon glyphicon-chevron-right arr-img" aria-hidden="true"></span>
			<?php } ?>
			<span class="sr-only">Next</span>
		</a>
	<?php } ?>

	<!-- Indicators -->
	<?php if($wset['nav']) { ?>
		<ol class="carousel-indicators">
			<?php for ($i=0; $i < $list_cnt; $i++) { ?>
				<li data-target="#<?php echo $widget_id;?>" data-slide-to="<?php echo $i;?>"<?php echo (!$i) ? ' class="active"' : '';?>></li>
			<?php } ?>
		</ol>
	<?php } ?>
</div>
<?php if($wset['shadow']) echo apms_shadow($wset['shadow']); //그림자 ?>
<?php if($setup_href) { ?>
	<div class="btn-wset text-center p10">
		<a href="<?php echo $setup_href;?>" class="win_memo">
			<span class="text-muted font-12"><i class="fa fa-cog"></i> 위젯설정</span>
		</a>
	</div>
<?php } ?>
