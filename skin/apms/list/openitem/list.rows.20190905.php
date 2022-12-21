<?php
if (!defined('_GNUBOARD_')) {

	include_once('../../../../common.php');

	define('THEMA', $lt);
	define('THEMA_PATH', G5_PATH.'/thema/'.$lt);
	define('THEMA_URL', G5_URL.'/thema/'.$lt);
	define('IS_SHOP', true);

	include_once(G5_SHOP_PATH.'/list.rows.php');

	$list_skin_path = G5_SKIN_PATH.'/apms/list/'.$ls;
	$list_skin_url = G5_SKIN_URL.'/apms/list/'.$ls;

	//썸네일
	$wset['thumb_w'] = (isset($wset['thumb_w']) && $wset['thumb_w'] > 0) ? $wset['thumb_w'] : 400;
	$wset['thumb_h'] = (isset($wset['thumb_h']) && ($wset['thumb_h'] > 0 || $wset['thumb_h'] == "0")) ? $wset['thumb_h'] : 200;
}

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

	$is_now = '';
	if($it_id == $list[$i]['it_id']) {
		$is_now = ' now';
		$item_label = '<div class="label-cap bg-navy">Now</div>';	
	} else if($dc || $list[$i]['it_type5']) {
		//$item_label = '<div class="label-cap bg-red">DC</div>';	
	} else if($list[$i]['pt_num'] >= (G5_SERVER_TIME - ($new_item * 3600))) {
		$item_label = '<div class="label-cap bg-'.$wset['new'].'">New</div>';
	}

	// 이미지
	$list[$i]['img'] = apms_it_thumbnail($list[$i], $wset['thumb_w'], $wset['thumb_h'], false, true);

	// 아이콘
	$item_icon = item_icon($list[$i]);
?>
	<div class="column col-4 col-md-6 col-xs-12">
		<?php if($is_info) { ?>
			<?php if ($is_rank) { ?>
				<span class="rank-icon en bg-<?php echo $is_rank;?>"><?php echo $rank;?></span>	
			<?php } ?>
			<?php if($is_star) { ?>
				<span class="item-star"><?php echo apms_get_star($list[$i]['it_use_avg'], $wset['star']); //평균별점 ?></span>
			<?php } ?>
		<?php } ?>
		<a href="<?php echo $list[$i]['href'];?>">
			<div class="card">
				<div class="item_label"><?php echo $item_label;?></div>
				<div class="card-image">
					<img class="img-responsive" src="<?php echo $list[$i]['img']['src'];?>" alt="강의 썸네일">
				</div>
				<div class="card-header">
					<button class="btn btn-sm float-right">
					<i class="icon icon-flag"></i>
					<span>찜</span>
					<em><?php echo number_format($list[$i]['pt_good']);?></em>
				</button>
				<div class="card-title text-ellipsis"><?php echo $list[$i]['it_name']; ?></div>
				<div class="card-subtitle text-gray text-ellipsis"><?php echo $list[$i]['it_brand'];?> 선생님</div>
			</div>
			<div class="card-body text-clip"><?php echo ($list[$i]['it_basic']) ? $list[$i]['it_basic'] : apms_cut_text($list[$i]['it_explan'], 120); ?></div>
			<div class="card-footer">
				<?php if($is_tag) { ?>
					<span class="label">
						<?php echo $list[$i]['pt_tag'];?>
					</span>
				<?php } ?>
			</div>
		</div>
	</a>
</div>
<?php } ?>
