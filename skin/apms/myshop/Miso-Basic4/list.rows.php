<?php
if (!defined('_GNUBOARD_')) exit;

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


$list_cnt = count($list);

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
?>
	<div class="item-row">
		<div class="item-list item-col is-round-item<?php echo $is_now;?>">
			<div class="bg-white">
				<div class="item-image">
					<?php if($wset['thumb_h'] > 0) { // 이미지 높이값이 있을 경우?>
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
										<img src="<?php echo $list[$i]['img']['src'];?>" alt="<?php echo $list[$i]['img']['alt'];?>" class="wr-img">
									</div>
								</a>
							</div>
						</div>
					<?php } else { ?>
						<div class="item-img w-round-item-img">
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
								<img src="<?php echo $list[$i]['img']['src'];?>" alt="<?php echo $list[$i]['img']['alt'];?>" class="wr-img">
							</a>
						</div>
					<?php } ?>
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
<?php } ?>
