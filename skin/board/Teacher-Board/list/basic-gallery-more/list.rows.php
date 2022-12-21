<?php
if (!defined('_GNUBOARD_')) {
	// AJAX일 때
	$is_ajax = true;
	include_once('../../../../../common.php');
	include_once(G5_BBS_PATH.'/list.rows.php');
	$list_cnt = count($list);
	if(!$list_cnt) exit;

	// 창열기
	$is_modal_js = $is_link_target = '';
	if($boset['modal'] == "1") { // 모달
		$is_modal_js = ' onclick="view_modal(this.href); return false;"';
	} else if($boset['modal'] == "2") { //링크#1
		$is_link_target = ' target="_blank"';
	}

	if(!$boset['list_skin']) $boset['list_skin'] = 'basic'; // 목록스킨

	$list_skin_url = $board_skin_url.'/list/'.$boset['list_skin'];
	$list_skin_path = $board_skin_path.'/list/'.$boset['list_skin'];

	// 썸네일 - 기본 400x300 크기(4:3)
	$thumb_w = (isset($boset['thumb_w']) && ($boset['thumb_w'] > 0 || $boset['thumb_w'] == "0")) ? (int)$boset['thumb_w'] : 400;
	$thumb_h = (isset($boset['thumb_h']) && ($boset['thumb_h'] > 0 || $boset['thumb_h'] == "0")) ? (int)$boset['thumb_h'] : 300;
	$is_masonry = ($thumb_h) ? false : true;

	// 글내용 - 기본 100자
	$is_cont = (isset($boset['lcont']) && ($boset['lcont'] > 0 || $boset['lcont'] == "0")) ? (int)$boset['lcont'] : 100;

	// 썸네일 포토
	$fa_color = (isset($boset['ibg']) && $boset['ibg']) ? ' bg-'.$boset['icolor'] : ' bg-light '.$boset['icolor'];
	$fa_photo = (isset($boset['ficon']) && $boset['ficon']) ? apms_fa($boset['ficon']) : '<i class="fa fa-picture-o"></i>';

	// 날짜
	$is_dtype = (isset($boset['dtype']) && $boset['dtype']) ? $boset['dtype'] : 'Y.m.d';

	// 숨김설정
	$is_vicon = (isset($boset['vicon']) && $boset['vicon']) ? false : true;
	$is_name = (isset($boset['lname']) && $boset['lname']) ? false : true;
	$is_hit = (isset($boset['lhit']) && $boset['lhit']) ? false : true;
	$is_category = (isset($boset['lcate']) && $boset['lcate']) ? false : $is_category;

	// 보임설정
	$is_date = (isset($boset['ldate']) && $boset['ldate']) ? true : false;
	$is_down = (isset($boset['ldown']) && $boset['ldown']) ? true : false;
	$is_dpoint = (isset($boset['ldpoint']) && $boset['ldpoint']) ? true : false;
	$is_visit = (isset($boset['lvisit']) && $boset['lvisit']) ? true : false;
	$is_good = (isset($boset['lgood']) && $boset['lgood']) ? true : false;
	$is_nogood = (isset($boset['lnogood']) && $boset['lnogood']) ? true : false;
	$is_shadow = (isset($boset['shadow']) && $boset['shadow']) ? apms_shadow($boset['shadow']) : '';

}

// 목록
for ($i=0; $i <= $list_cnt; $i++) { 

	//공지글 제외
	if($list[$i]['is_notice']) continue; 

	//라벨 체크
	$wr_label = '';
	$is_lock = false;
	if ($list[$i]['icon_secret'] || $list[$i]['is_lock']) {
		$is_lock = true;
		$wr_label = '<div class="label-cap bg-orange">Lock</div>';	
	} else {
		if ($wr_id == $list[$i]['wr_id']) {
			$wr_label = '<div class="label-cap bg-green">Now</div>';	
		} else if ($list[$i]['icon_hot']) {
			$wr_label = '<div class="label-cap bg-red">Hot</div>';	
		} else if ($list[$i]['icon_new']) {
			$wr_label = '<div class="label-cap bg-blue">New</div>';	
		}
	}

	// 링크이동
	$list[$i]['target'] = '';
	if($is_link_target && !$list[$i]['is_notice'] && $list[$i]['wr_link1']) {
		$list[$i]['target'] = $is_link_target;
		$list[$i]['href'] = $list[$i]['link_href'][1];
	}

	// 썸네일
	$wr_vicon = ($is_vicon && ($list[$i]['as_list'] == "2" || $list[$i]['as_list'] == "3")) ? '<i class="fa fa-play-circle-o wr-vicon"></i>' : ''; // 비디오 아이콘
	$thumb = apms_wr_thumbnail($bo_table, $list[$i], $thumb_w, $thumb_h, false, true); // 썸네일
	$wr_thumb = ($thumb['src']) ? '<img src="'.$thumb['src'].'" alt="'.$thumb['alt'].'" class="wr-img">' : '<div class="thumb-icon'.$fa_color.'"><div class="wr-fa">'.$fa_photo.'</div></div>';

	// 날짜
	$wr_date = ($is_date) ? '<div class="wr-date en">'.date($is_dtype, $list[$i]['date']).'</div>' : '';

	// 회원사진
	$wr_mb = '';
	if($is_mb) {
		$wr_mb = apms_photo_url($list[$i]['mb_id']);
		$wr_mb = ($wr_mb) ? '<span class="wr-mb"><img src="'.$wr_mb.'"></span>' : '<span class="wr-mb"><i class="fa fa-user"></i></span>';
	}

?>
	<div class="list-row">
		<?php if ($i == $list_cnt) { ?>

		<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
		<!-- sidebar -->
		<ins id="adsense" class="adsbygoogle"
		     style="display:inline-block;max-width:280px;width:100%;height:360px"
		     data-ad-client="ca-pub-8266358868959424"
		     data-ad-slot="7071154829"></ins>
		<script>
		ads = document.getElementById("adsense");
		ads.id = "adsense"+adsensecnt;
		if (adsensecnt == 0)
		(adsbygoogle = window.adsbygoogle || []).push({});
		else {
			$("#"+ads.id).hide();
		}
		adsensecnt++;
		</script>
		<?php }
		else { ?>
		
		<div class="list-col">
			<div class="list-box<?php echo ($wr_id == $list[$i]['wr_id']) ? ' active' : '';?>">
				<div class="list-front">
					<div class="list-img">
						<a href="<?php echo $list[$i]['href'];?>"<?php echo $list[$i]['target'];?><?php echo $is_modal_js;?>>
							<?php if($is_masonry && $thumb['src']) { ?>
								<div class="list-thumb">
									<?php echo $wr_label;?>
									<?php echo $wr_vicon;?>
									<?php echo $wr_date;?>
									<?php echo $wr_thumb;?>
								</div>
							<?php } else { ?>
								<div class="imgframe">
									<div class="img-wrap">
										<?php echo $wr_label;?>
										<?php echo $wr_vicon;?>
										<?php echo $wr_date;?>
										<div class="img-item">
											<?php echo $wr_thumb;?>
										</div>
									</div>
								</div>
							<?php } ?>
						</a>
						<?php if ($is_checkbox) { ?>
							<div class="list-chk">
								<input type="checkbox" name="chk_wr_id[]" value="<?php echo $list[$i]['wr_id'] ?>" id="chk_wr_id_<?php echo $i ?>">
							</div>
						<?php } ?>
					</div>
					<?php echo $is_shadow; //그림자 ?>
					<div class="list-text">
						<?php if($is_category) { ?>
							<div class="div-title-underline-thin font-12">
								<?php echo ($list[$i]['ca_name']) ? $list[$i]['ca_name'] : '미분류';?>
							</div>
							<div class="clearfix"></div>
						<?php } ?>
						<div class="list-desc">
							<a href="<?php echo $list[$i]['href'];?>"<?php echo $list[$i]['target'];?><?php echo $is_modal_js;?>>
								<strong class="en"><?php echo $list[$i]['wr_subject'];?></strong>
								<?php if($is_cont) { ?>
									<div class="h5"></div>
									<div class="text-muted font-12">
										<?php echo apms_cut_text($list[$i]['wr_content'], $is_cont); ?>
									</div>
								<?php } ?>
							</a>
						</div>
						<div class="list-info font-12">
							<div class="pull-left">
								<?php echo $wr_mb;?>
								<?php echo ($is_name) ? $list[$i]['name'] : ''; ?>
							</div>
							<div class="pull-right en font-14">
								<i class="fa fa-commenting blue"></i> 
								<?php echo $list[$i]['wr_comment'];?>
								<?php if($is_dpoint) { ?>
									<i class="fa fa-gift green"></i>
									<?php echo $list[$i]['as_down'];?>
								<?php } ?>
								<?php if($is_down) { ?>
									<i class="fa fa-download skyblue"></i>
									<?php echo $list[$i]['as_download'];?>
								<?php } ?>
								<?php if($is_visit) { ?>
									<i class="fa fa-share navy"></i>
									<?php echo ($list[$i]['wr_link1_hit'] + $list[$i]['wr_link2_hit']);?>
								<?php } ?>
								<?php if($is_good) { ?>
									<i class="fa fa-heart orangered"></i> 
									<?php echo $list[$i]['wr_good'];?>
								<?php } ?>
								<?php if($is_nogood) { ?>
									<i class="fa fa-meh-o"></i> 
									<?php echo $list[$i]['wr_nogood'];?>
								<?php } ?>
								<?php if($is_hit) { ?>
									<i class="fa fa-eye violet"></i> 
									<?php echo $list[$i]['wr_hit'];?>
								<?php } ?>
							</div>
							<div class="clearfix"></div>
						</div>
					</div>	
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
		<?php } ?>
	</div>
<?php } ?>
