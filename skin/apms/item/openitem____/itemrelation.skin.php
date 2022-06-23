<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// Owl Carousel
apms_script('owlcarousel');

$is_autoplay = (isset($wset['auto']) && ($wset['auto'] > 0 || $wset['auto'] == "0")) ? $wset['auto'] : 3000;
$is_speed = (isset($wset['speed']) && $wset['speed'] > 0) ? $wset['speed'] : 0;
if(G5_IS_MOBLE) {
	$is_lazy = false;
} else {
	$is_lazy = (isset($wset['lazy']) && $wset['lazy']) ? true : false;
}

$wset['thumb_w'] = (isset($wset['thumb_w']) && $wset['thumb_w'] > 0) ? $wset['thumb_w'] : 400;
$wset['thumb_h'] = (isset($wset['thumb_h']) && $wset['thumb_h'] > 0) ? $wset['thumb_h'] : 500;
$img_h = apms_img_height($wset['thumb_w'], $wset['thumb_h'], '100');

$wset['line'] = (isset($wset['line']) && $wset['line'] > 0) ? $wset['line'] : 3;
$line_height = 20 * $wset['line'];
if($line_height) $line_height = $line_height + 14;

// 간격
$gap = (isset($wset['gap']) && ($wset['gap'] > 0 || $wset['gap'] == "0")) ? $wset['gap'] : 15;

// 가로수
$item = (isset($wset['item']) && $wset['item'] > 0) ? $wset['item'] : 4;

// 기본수
$lg = $md = $sm = $xs = $item;

// 새상품
$wset['new'] = (isset($wset['new']) && $wset['new']) ? $wset['new'] : 'red';
$new_item = (isset($wset['newtime']) && $wset['newtime']) ? $wset['newtime'] : 24;

// 별점
$wset['star'] = (isset($wset['star']) && $wset['star']) ? $wset['star'] : '1';
$is_star = ($wset['star'] != "1") ? true : false;

// 포인트
$wset['pbg'] = (isset($wset['pbg']) && $wset['pbg']) ? $wset['pbg'] : 'navy';

// 숨김항목
$is_buy = (isset($wset['buy']) && $wset['buy']) ? false : true;
$is_cmt = (isset($wset['cmt']) && $wset['cmt']) ? false : true;
$is_good = (isset($wset['good']) && $wset['good']) ? false : true;

// 보임항목
$is_use = (isset($wset['use']) && $wset['use']) ? true : false;
$is_qa = (isset($wset['qa']) && $wset['qa']) ? true : false;
$is_hit = (isset($wset['hit']) && $wset['hit']) ? true : false;

$is_info = ($is_star || $is_use || $is_qa || $is_buy || $is_cmt || $is_good || $is_hit) ? true : false;

// 그림자
$is_shadow = (isset($wset['shadow']) && $wset['shadow']) ? apms_shadow($wset['shadow']) : '';

// 랜덤아이디
$widget_id = 'item_relation_list';

$list_cnt = count($list);

?>
<style>
	#<?php echo $widget_id;?> .owl-container { margin-right:<?php echo $gap * (-1);?>px;}
	#<?php echo $widget_id;?> .owl-next { right:<?php echo $gap;?>px; }
	#<?php echo $widget_id;?> .owl-hide { margin-right:<?php echo ($item > 1) ? ($gap * ($item - 1)) : $gap;?>px; }
	#<?php echo $widget_id;?> .owl-hide .item { width:<?php echo apms_img_width($item);?>%; } 
	#<?php echo $widget_id;?> .item-list { margin-right:<?php echo $gap;?>px; }
	#<?php echo $widget_id;?> .item-content { height:<?php echo $line_height;?>px; }
	#<?php echo $widget_id;?> .img-wrap { padding-bottom:<?php echo $img_h;?>%; }
	<?php if(_RESPONSIVE_) { //반응형일 때만 작동 
		$lg = (isset($wset['lg']) && $wset['lg'] > 0) ? $wset['lg'] : 3;
		$lgg = (isset($wset['lgg']) && ($wset['lgg'] > 0 || $wset['lgg'] == "0")) ? $wset['lgg'] : $gap;

		$md = (isset($wset['md']) && $wset['md'] > 0) ? $wset['md'] : 2;
		$mdg = (isset($wset['mdg']) && ($wset['mdg'] > 0 || $wset['mdg'] == "0")) ? $wset['mdg'] : $lgg;

		$sm = (isset($wset['sm']) && $wset['sm'] > 0) ? $wset['sm'] : 2;
		$smg = (isset($wset['smg']) && ($wset['smg'] > 0 || $wset['smg'] == "0")) ? $wset['smg'] : $mdg;

		$xs = (isset($wset['xs']) && $wset['xs'] > 0) ? $wset['xs'] : 1;
		$xsg = (isset($wset['xsg']) && ($wset['xsg'] > 0 || $wset['xsg'] == "0")) ? $wset['xsg'] : $smg;
	?>
	@media (max-width:1199px) { 
		.responsive #<?php echo $widget_id;?> .owl-container { margin-right:<?php echo $lgg * (-1);?>px;}
		.responsive #<?php echo $widget_id;?> .owl-next { right:<?php echo $lgg;?>px; }
		.responsive #<?php echo $widget_id;?> .owl-hide { margin-right:<?php echo ($lg > 1) ? ($lgg * ($lg - 1)) : $lgg;?>px; }
		.responsive #<?php echo $widget_id;?> .owl-hide .item { width:<?php echo apms_img_width($lg);?>%; } 
		.responsive #<?php echo $widget_id;?> .item-list { margin-right:<?php echo $lgg;?>px; }
	}
	@media (max-width:991px) { 
		.responsive #<?php echo $widget_id;?> .owl-container { margin-right:<?php echo $mdg * (-1);?>px;}
		.responsive #<?php echo $widget_id;?> .owl-next { right:<?php echo $mdg;?>px; }
		.responsive #<?php echo $widget_id;?> .owl-hide { margin-right:<?php echo ($md > 1) ? ($mdg * ($md - 1)) : $mdg;?>px; }
		.responsive #<?php echo $widget_id;?> .owl-hide .item { width:<?php echo apms_img_width($md);?>%; } 
		.responsive #<?php echo $widget_id;?> .item-list { margin-right:<?php echo $mdg;?>px; }
	}
	@media (max-width:767px) { 
		.responsive #<?php echo $widget_id;?> .owl-container { margin-right:<?php echo $smg * (-1);?>px;}
		.responsive #<?php echo $widget_id;?> .owl-next { right:<?php echo $smg;?>px; }
		.responsive #<?php echo $widget_id;?> .owl-hide { margin-right:<?php echo ($sm > 1) ? ($smg * ($sm - 1)) : $smg;?>px; }
		.responsive #<?php echo $widget_id;?> .owl-hide .item { width:<?php echo apms_img_width($sm);?>%; } 
		.responsive #<?php echo $widget_id;?> .item-list { margin-right:<?php echo $smg;?>px; }
	}
	@media (max-width:480px) { 
		.responsive #<?php echo $widget_id;?> .owl-container { margin-right:<?php echo $xsg * (-1);?>px;}
		.responsive #<?php echo $widget_id;?> .owl-next { right:<?php echo $xsg;?>px; }
		.responsive #<?php echo $widget_id;?> .owl-hide { margin-right:<?php echo ($xs > 1) ? ($xsg * ($xs - 1)) : $xsg;?>px; }
		.responsive #<?php echo $widget_id;?> .owl-hide .item { width:<?php echo apms_img_width($xs);?>%; } 
		.responsive #<?php echo $widget_id;?> .item-list { margin-right:<?php echo $xsg;?>px; }
	}
	<?php } ?>
</style>

<div id="<?php echo $widget_id;?>" class="shop-relation<?php echo (isset($xs) && $xs > 1) ? ' xs-2' : '';?>">
	<div class="owl-show">
		<div class="owl-container">
			<div class="owl-carousel">
			<?php 
			for ($i=0; $i < $list_cnt; $i++) { 

				$item_label = $dc = '';
				if($list[$i]['it_cust_price'] > 0 && $list[$i]['it_price'] > 0) {
					$dc = round((($list[$i]['it_cust_price'] - $list[$i]['it_price']) / $list[$i]['it_cust_price']) * 100);
				}

				if($dc || $list[$i]['it_type5']) {
					$item_label = '<div class="label-cap bg-red">DC</div>';	
				} else if($list[$i]['pt_num'] >= (G5_SERVER_TIME - ($new_item * 3600))) {
					$item_label = '<div class="label-cap bg-'.$wset['new'].'">New</div>';
				}

				// 이미지
				$list[$i]['img'] = apms_it_thumbnail($list[$i], $wset['thumb_w'], $wset['thumb_h'], false, true);

				// 아이콘
				$item_icon = item_icon($list[$i]);

				// Lazy
				$img_src = ($is_lazy) ? 'data-src="'.$list[$i]['img']['src'].'" class="lazyOwl"' : 'src="'.$list[$i]['img']['src'].'"';

			?>
				<div class="item">
					<div class="item-list item-col is-round-item">
						<div class="bg-white">
							<div class="item-image">
								<div class="imgframe">
									<div class="img-wrap is-round-item-img">
										<a href="<?php echo $list[$i]['href'];?>">
											<?php echo $item_label;?>
											<?php if($item_icon) { ?>
												<div class="item-icon"><?php echo $item_icon;?></div>
											<?php } ?>
											<?php if($list[$i]['it_point']) { ?>
												<div class="item-point rank-icon trans-bg-<?php echo $wset['pbg'];?>">
													<span><?php echo ($list[$i]['it_point_type'] == 2) ? $list[$i]['it_point'].'%' : number_format(get_item_point($list[$i])).' '.AS_MP;?></span> 적립
												</div>
											<?php } ?>
											<div class="img-item">
												<img <?php echo $img_src;?> alt="<?php echo $list[$i]['img']['alt'];?>" class="wr-img">
											</div>
										</a>
									</div>
								</div>
							</div>
							<div class="is-item-content">
								<?php echo $is_shadow; //그림자 ?>
								<div class="item-content">
									<a href="<?php echo $list[$i]['href'];?>">
										<?php if ($is_rank) { ?>
											<span class="rank-icon en bg-<?php echo $is_rank;?>"><?php echo $rank;?></span>	
										<?php } ?>
										<strong>
											<?php echo $list[$i]['it_name'];?>
										</strong>
										<div class="item-desc text-muted">
											<?php echo $list[$i]['it_basic']; ?>
										</div>
									</a>
								</div>
								<div class="item-cur-price text-muted">
									<?php if($dc) { ?>
										<strike><?php echo number_format($list[$i]['it_cust_price']);?>원</strike>
									<?php } ?>
								</div>
								<div class="item-price">
									<?php if($dc) { ?>
										<div class="pull-left">
											<b><span class="font-18 en orangered"><?php echo $dc;?>%</span></b>
										</div>
									<?php } ?>
									<div class="pull-right">
										<b>
											<?php if($list[$i]['it_tel_inq']) { ?>
												전화문의
											<?php } else { ?>
												<span class="font-18 en"><?php echo number_format($list[$i]['it_price']);?></span>원
											<?php } ?>
										</b>
									</div>
									<div class="clearfix"></div>
								</div>
								<?php if($is_info) { ?>
									<div class="item-info en">
										<?php if($is_star) { ?>
											<span class="item-star">
												<?php echo apms_get_star($list[$i]['it_use_avg'], $wset['star']); //평균별점 ?>
											</span>
										<?php } ?>
										<?php if($is_use) { ?>
											<span>
												<i class="fa fa-pencil-square-o violet"></i>
												<?php echo number_format($list[$i]['it_use_cnt']);?>
											</span>
										<?php } ?>
										<?php if($is_qa) { ?>
											<span>
												<i class="fa fa-question-circle orange"></i>
												<?php echo number_format($list[$i]['pt_qa']);?>
											</span>
										<?php } ?>
										<?php if($is_buy) { ?>
											<span>
												<i class="fa fa-shopping-cart green"></i>
												<?php echo number_format($list[$i]['it_sum_qty']);?>
											</span>
										<?php } ?>
										<?php if($is_cmt) { ?>
											<span>
												<i class="fa fa-commenting blue"></i> 
												<?php echo number_format($list[$i]['pt_comment']);?>
											</span>
										<?php } ?>
										<?php if($is_good) { ?>
											<span>
												<i class="fa fa-heart orangered"></i> 
												<?php echo number_format($list[$i]['pt_good']);?>
											</span>
										<?php } ?>
										<?php if($is_hit) { ?>
											<span>
												<i class="fa fa-eye navy"></i> 
												<?php echo number_format($list[$i]['it_hit']);?>
											</span>
										<?php } ?>
									</div>
								<?php } ?>
							</div>
						</div>
					</div>
				</div>
			<?php ; } ?>
			</div>
		</div>
	</div>
	<div class="owl-hide">
		<div class="item">
			<div class="item-list is-round-item">
				<div class="bg-white">
					<div class="item-image">
						<div class="imgframe">
							<div class="img-wrap is-round-item-img">
								<div class="img-item">&nbsp;</div>
							</div>
						</div>
					</div>
					<div class="is-item-content">
						<?php echo $is_shadow; //그림자 ?>
						<div class="item-content">&nbsp;</div>
						<div class="item-cur-price">&nbsp;</div>
						<div class="item-price">&nbsp;</div>
						<?php if($is_info) { ?>
							<div class="item-info en">&nbsp;</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
$(document).ready(function(){
	$('#<?php echo $widget_id;?> .owl-carousel').owlCarousel({
		<?php if(isset($wset['rdm']) && $wset['rdm']) { ?> 
		beforeInit : function(elem){
			owl_random(elem);
		},
		<?php } ?>
		<?php if($is_autoplay > 0) { ?>
			autoPlay:<?php echo $is_autoplay; ?>,
		<?php } ?>
		<?php if($is_speed) { ?>
			slideSpeed:<?php echo $is_speed; ?>,
		<?php } ?>
		<?php if($is_lazy) { ?>
			lazyLoad : true,
		<?php } ?>
		items:<?php echo $item;?>,
		itemsDesktop:[1199,<?php echo $lg;?>],
		itemsDesktopSmall:[991,<?php echo $md;?>],
		itemsTablet:[767,<?php echo $sm;?>],
		itemsMobile:[480,<?php echo $xs;?>],
		pagination:<?php echo ($wset['dot']) ? 'true' : 'false';?>,
		<?php if(isset($wset['nav']) && $wset['nav']) { ?> 
		navigation:false,
		<?php } else { ?>
		navigationText:['<i class="fa fa-chevron-left"></i>','<i class="fa fa-chevron-right"></i>'],
		navigation:true,
		<?php } ?>
		loop:true,
		afterInit : function() {
			$('#<?php echo $widget_id;?> .owl-hide').hide();
		}
	});
});
</script>