<?php
if (!defined('_GNUBOARD_')) exit; //개별 페이지 접근 불가

//add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$widget_url.'/widget.css" media="screen">', 0);

// 링크 열기
$wset['modal'] = (isset($wset['modal'])) ? $wset['modal'] : '';
$is_modal_js = $is_link_target = '';
if($wset['modal'] == "1") { //모달
	$is_modal_js = apms_script('modal');
} else if($wset['modal'] == "2") { //링크#1
	$is_link_target = ' target="_blank"';
}

$wset['thumb_w'] = (isset($wset['thumb_w']) && $wset['thumb_w'] > 0) ? $wset['thumb_w'] : 400;
$wset['thumb_h'] = (isset($wset['thumb_h']) && $wset['thumb_h'] > 0) ? $wset['thumb_h'] : 300;
$img_h = apms_img_height($wset['thumb_w'], $wset['thumb_h'], '75');

$wset['line'] = (isset($wset['line']) && $wset['line'] > 0) ? $wset['line'] : 1;
$line_height = 20 * $wset['line'];
if($wset['line'] > 1) $line_height = $line_height + 4;

// 간격
$gap = (isset($wset['gap']) && ($wset['gap'] > 0 || $wset['gap'] == "0")) ? $wset['gap'] : 15;
$gapb = (isset($wset['gapb']) && ($wset['gapb'] > 0 || $wset['gapb'] == "0")) ? $wset['gapb'] : 15;

// 가로수
$item = (isset($wset['item']) && $wset['item'] > 0) ? $wset['item'] : 6;

// 랜덤아이디
$widget_id = apms_id(); // Random ID

if(!$wset['title']){ $wset['title'] = 'OUR SERVICES'; }

?>
<style>
.anb-section2-body { padding: 15px 15px 0px; margin: 0px; position: relative; width: 100%; overflow: hidden; }
.anb-section-2 .post-row{ float:left; }
	/*#<?php echo $widget_id;?> { margin-right:<?php echo $gap * (-1);?>px; margin-bottom:<?php echo $gapb * (-1);?>px; }*/
	#<?php echo $widget_id;?> .post-row { width:<?php echo apms_img_width($item);?>%; }
	/*#<?php echo $widget_id;?> .post-list { margin-right:<?php echo $gap;?>px; margin-bottom:<?php echo $gapb;?>px; }*/
	#<?php echo $widget_id;?> .post-subject { height:<?php echo $line_height;?>px; }
	#<?php echo $widget_id;?> .img-wrap { padding-bottom:<?php echo $img_h;?>%; }
	<?php if(_RESPONSIVE_) { // 반응형일 때만 작동
		$lg = (isset($wset['lg']) && $wset['lg'] > 0) ? $wset['lg'] : 4;
		$lgg = (isset($wset['lgg']) && ($wset['lgg'] > 0 || $wset['lgg'] == "0")) ? $wset['lgg'] : $gap;
		$lgb = (isset($wset['lgb']) && ($wset['lgb'] > 0 || $wset['lgb'] == "0")) ? $wset['lgb'] : $gapb;

		$md = (isset($wset['md']) && $wset['md'] > 0) ? $wset['md'] : 4;
		$mdg = (isset($wset['mdg']) && ($wset['mdg'] > 0 || $wset['mdg'] == "0")) ? $wset['mdg'] : $lgg;
		$mdb = (isset($wset['mdb']) && ($wset['mdb'] > 0 || $wset['mdb'] == "0")) ? $wset['mdb'] : $lgb;

		$sm = (isset($wset['sm']) && $wset['sm'] > 0) ? $wset['sm'] : 3;
		$smg = (isset($wset['smg']) && ($wset['smg'] > 0 || $wset['smg'] == "0")) ? $wset['smg'] : $mdg;
		$smb = (isset($wset['smb']) && ($wset['smb'] > 0 || $wset['smb'] == "0")) ? $wset['smb'] : $mdb;

		$xs = (isset($wset['xs']) && $wset['xs'] > 0) ? $wset['xs'] : 2;
		$xsg = (isset($wset['xsg']) && ($wset['xsg'] > 0 || $wset['xsg'] == "0")) ? $wset['xsg'] : $smg;
		$xsb = (isset($wset['xsb']) && ($wset['xsb'] > 0 || $wset['xsb'] == "0")) ? $wset['xsb'] : $smb;
	?>
	@media (max-width:1199px) {
		.responsive #<?php echo $widget_id;?> { margin-right:<?php echo $lgg * (-1);?>px; margin-bottom:<?php echo $lgb * (-1);?>px; }
		.responsive #<?php echo $widget_id;?> .post-row { width:<?php echo apms_img_width($lg);?>%; }
		/*.responsive #<?php echo $widget_id;?> .post-list { margin-right:<?php echo $lgg;?>px; margin-bottom:<?php echo $lgb;?>px; }*/
	}
	@media (max-width:991px) {
		.responsive #<?php echo $widget_id;?> { margin-right:<?php echo $mdg * (-1);?>px; margin-bottom:<?php echo $mdb * (-1);?>px; }
		.responsive #<?php echo $widget_id;?> .post-row { width:<?php echo apms_img_width($md);?>%; }
		/*.responsive #<?php echo $widget_id;?> .post-list { margin-right:<?php echo $mdg;?>px; margin-bottom:<?php echo $mdb;?>px; }*/
	}
	@media (max-width:767px) {
		.responsive #<?php echo $widget_id;?> { margin-right:<?php echo $smg * (-1);?>px; margin-bottom:<?php echo $smb * (-1);?>px; }
		.responsive #<?php echo $widget_id;?> .post-row { width:<?php echo apms_img_width($sm);?>%; }
		/*.responsive #<?php echo $widget_id;?> .post-list { margin-right:<?php echo $smg;?>px; margin-bottom:<?php echo $smb;?>px; }*/
	}
	@media (max-width:480px) {
		.responsive #<?php echo $widget_id;?> { margin-right:<?php echo $xsg * (-1);?>px; margin-bottom:<?php echo $xsb * (-1);?>px; }
		.responsive #<?php echo $widget_id;?> .post-row { width:<?php echo apms_img_width($xs);?>%; }
		/*.responsive #<?php echo $widget_id;?> .post-list { margin-right:<?php echo $xsg;?>px; margin-bottom:<?php echo $xsb;?>px; }*/
	}
	<?php } ?>

.section-2 .img-wrap .img-item img {
    display: block;
    border: 0;
    width: 100%;
    height: auto;
    margin: 0px auto;
    display: block;
    /* height: 0; */
    overflow: hidden;
    text-align: center;
    background: #f5f5f5;
    /*border: solid 2px #ffffff;*/
}

#<?php echo $widget_id;?> .section-2 .img-wrap .img-item { border: solid 2px #ffffff; }
#<?php echo $widget_id;?> .section-2 .post-image:hover img {  background:#fff; transition: all 0.8s ease-in-out; -webkit-transform: scale(1.3, 1.3);  -moz-transform: scale(1.3, 1.3);  -ms-transform: scale(1.3, 1.3);  -o-transform: scale(1.3, 1.3);  transform: scale(1.3, 1.3);  }

#section-2 .triangle i { position: absolute; top: -40px; left: 50%; margin-left: -13px; font-size: 30px; color: <?php echo $wset['color_tb'];?>;}
#section-2 .triangle { border-top-color: <?php echo $wset['color_t'];?>; }
</style>

<div id="<?php echo $widget_id;?>" class="anb-section-2">
	<section id="section-2" class="section-2">
		<div class="container2">
			<?php if($wset['tuse']){ ?>
			<div class="triangle">
				<a href="#section-2" class="kso-scroll"><i class="fa fa-arrow-down"></i></a>
			</div>
			<?php } ?>
			<div class="text-center mBottom60   animated" data-animtype="fadeInDown" data-animrepeat="0" data-animspeed="1s" data-animdelay="0.2s">
				<a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=basic">
					<h1 style="margin-bottom: 30px;color:#fff;"><?php echo $wset['title'];?></h1>
				</a>
				<!--<p class="text-trans">다양한 포트폴리오를 보러가길 원하시면 위 <b style="color:deepskyblue;">PORTFOLIO</b> 클릭 </p>-->
			</div>
			<div class="anb-section2-body   animated" data-animtype="fadeInUp" data-animrepeat="0" data-animspeed="1s" data-animdelay="0.5s">
				<?php
					if($wset['cache'] > 0) { // 캐시적용시
						echo apms_widget_cache($widget_path.'/widget.rows.php', $wname, $wid, $wset);
					} else {
						include($widget_path.'/widget.rows.php');
					}
				?>
			</div>
		</div>
	</section>
</div>

<?php if($setup_href) { ?>
	<div class="btn-wset text-center p10">
		<a href="<?php echo $setup_href;?>" class="win_memo">
			<span class="text-muted font-12"><i class="fa fa-cog"></i> 위젯설정</span>
		</a>
	</div>
<?php } ?>