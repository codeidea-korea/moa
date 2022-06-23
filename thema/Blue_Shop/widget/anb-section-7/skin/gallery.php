<?php
if (!defined('_GNUBOARD_')) exit; //개별 페이지 접근 불가

// 썸네일
$wset['thumb_w'] = ($wset['thumb_w'] == "") ? 400 : (int)$wset['thumb_w'];
$wset['thumb_h'] = ($wset['thumb_h'] == "") ? 0 : (int)$wset['thumb_h'];

$is_org = false;
if(!$wset['thumb_w']) {
	$is_org = true;
	$wset['thumb_w'] = 10;
	$wset['thumb_h'] = 10;
}

// 추출
$list = miso_widget_list($wset, $widget_path, $widget_url);
$list_cnt = count($list);

if(!$list_cnt && $is_ajax) return;

?>
<?php if(!$is_ajax) { ?>
<ul class="post post-gallery">
<?php } ?>
<li class="item">
<?php
// 리스트
for ($i=0; $i < $list_cnt; $i++) { 

	// 이미지
	$img = $bgcolor = $bgimg = '';
	if($list[$i]['img']['src']) {
		$tmpimg = ($is_org) ? $list[$i]['img']['org'] : $list[$i]['img']['src'];
		if($is_masonry_img) {
			$img = '<img src="'.$tmpimg.'" alt="" class="img-masonry">';
		} else {
			$bgimg = ' style="background-image: url(\''.$tmpimg.'\');"';
		}
	} else {
		$bgcolor = ' bg-'.substr($list[$i]['rank'], -1);
	}
?>
	<?php if($i > 0 && $i%$is_sero == 0) { ?>
		</li>
		<li class="item">
	<?php } ?>
	<div class="item-box">
		<a href="<?php echo $list[$i]['img_href'];?>"<?php echo $list[$i]['img_target'];?>>
			<div class="img-box img-bg<?php echo $bgcolor;?>"<?php echo $bgimg;?>>
				<div class="img-item">
					<?php echo $img;?>
					<?php echo $raster;?>
					<?php echo $list[$i]['label'];?>
				</div>
			</div>
		</a>
		<div class="img-content">
			<a href="<?php echo $list[$i]['href'];?>"<?php echo $list[$i]['target'];?>>
				<div class="<?php echo $line;?>">
					<?php echo $list[$i]['bullet'];?>
					<?php echo $list[$i]['subject'];?>
				</div>
			</a>
			<p class="font-12 ellipsis">
				<?php echo $list[$i]['name'];?>
				<?php if($list[$i]['comment']) { ?>
					<span class="count">
						+<?php echo $list[$i]['comment'];?>
					</span>
				<?php } ?>
				&nbsp;
				<?php echo apms_date($list[$i]['date'], '', 'before', 'm.d', 'Y.m.d'); ?>
			</p>
		</div>
	</div>
<?php } ?>
<?php if(!$list_cnt) { ?>
	<div class="item-box">
		<div class="img-box bg-light">
			<div class="img-item">
				&nbsp;
			</div>
		</div>
		<div class="img-content text-center">
			<p class="ellipsis">
				게시물이 없습니다.
			</p>
			<p>관리자</p>
		</div>
	</div>
<?php } ?>
</li>
<?php if(!$is_ajax) { ?>
</ul>
<?php } ?>