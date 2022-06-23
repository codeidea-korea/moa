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
	$thumb_w = (isset($boset['thumb_w']) && $boset['thumb_w'] > 0) ? (int)$boset['thumb_w'] : 400;
	$thumb_h = (isset($boset['thumb_h']) && $boset['thumb_h'] > 0) ? (int)$boset['thumb_h'] : 300;

	// 글내용 - 기본 200자
	$is_cont = (isset($boset['lcont']) && ($boset['lcont'] > 0 || $boset['lcont'] == "0")) ? (int)$boset['lcont'] : 200;

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
	$is_date = (isset($boset['ldate']) && $boset['ldate']) ? false : true;

	// 보임설정
	$is_down = (isset($boset['ldown']) && $boset['ldown']) ? true : false;
	$is_dpoint = (isset($boset['ldpoint']) && $boset['ldpoint']) ? true : false;
	$is_visit = (isset($boset['lvisit']) && $boset['lvisit']) ? true : false;
	$is_good = (isset($boset['lgood']) && $boset['lgood']) ? true : false;
	$is_nogood = (isset($boset['lnogood']) && $boset['lnogood']) ? true : false;
}

// 목록
for ($i=0; $i < $list_cnt; $i++) { 

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

?>
	<div class="list-row">
		<div class="list-col">
			<div class="list-box<?php echo ($wr_id == $list[$i]['wr_id']) ? ' active' : '';?>">
				<div class="list-front">
					<div class="list-tbl">
						<div class="list-img list-cell">
							<a href="<?php echo $list[$i]['href'];?>"<?php echo $list[$i]['target'];?><?php echo $is_modal_js;?>>
								<div class="imgframe">
									<div class="img-wrap">
										<?php echo $wr_label;?>
										<?php echo $wr_vicon;?>
										<div class="img-item">
											<?php echo $wr_thumb;?>
										</div>
									</div>
								</div>
							</a>
							<?php if ($is_checkbox) { ?>
								<div class="list-chk">
									<input type="checkbox" name="chk_wr_id[]" value="<?php echo $list[$i]['wr_id'] ?>" id="chk_wr_id_<?php echo $i ?>">
								</div>
							<?php } ?>
						</div>
						<div class="list-text list-cell">
							<?php if($is_category) { ?>
								<div class="div-title-underline-thin font-12">
									<?php echo ($list[$i]['ca_name']) ? $list[$i]['ca_name'] : '미분류';?>
								</div>
								<div class="clearfix"></div>
							<?php } ?>
							<div class="list-desc">
								<a href="<?php echo $list[$i]['href'];?>"<?php echo $list[$i]['target'];?><?php echo $is_modal_js;?>>
									<strong class="en"><?php echo $list[$i]['wr_subject'];?></strong>
								</a>
								<div class="list-info font-13">
									<?php if($is_name) { ?>
										<span class="sp font-12">
											<?php echo $list[$i]['name']; ?>
										</span>
									<?php } ?>
									<span class="sp en">
										<i class="fa fa-commenting blue"></i> 
										<?php echo $list[$i]['wr_comment'];?>
									</span>
									<?php if($is_dpoint) { ?>
										<span class="sp en">
											<i class="fa fa-gift green"></i>
											<?php echo $list[$i]['as_down'];?>
										</span>
									<?php } ?>
									<?php if($is_down) { ?>
										<span class="sp en">
											<i class="fa fa-download skyblue"></i>
											<?php echo $list[$i]['as_download'];?>
										</span>
									<?php } ?>
									<?php if($is_visit) { ?>
										<span class="sp en">
											<i class="fa fa-share navy"></i>
											<?php echo ($list[$i]['wr_link1_hit'] + $list[$i]['wr_link2_hit']);?>
										</span>
									<?php } ?>
									<?php if($is_good) { ?>
										<span class="sp en">
											<i class="fa fa-heart orangered"></i> 
											<?php echo $list[$i]['wr_good'];?>
										</span>
									<?php } ?>
									<?php if($is_nogood) { ?>
										<span class="sp en">
											<i class="fa fa-meh-o"></i> 
											<?php echo $list[$i]['wr_nogood'];?>
										</span>
									<?php } ?>
									<?php if($is_hit) { ?>
										<span class="sp en">
											<i class="fa fa-eye violet"></i> 
											<?php echo $list[$i]['wr_hit'];?>
										</span>
									<?php } ?>
									<?php if($is_date) { ?>
										<span class="sp en">
											<i class="fa fa-clock-o text-muted"></i> 
											<?php echo date($is_dtype, $list[$i]['date']);?>
										</span>
									<?php } ?>
								</div>
								<?php if($is_cont) { ?>
									<a href="<?php echo $list[$i]['href'];?>"<?php echo $list[$i]['target'];?><?php echo $is_modal_js;?>>
										<div class="text-muted font-12">
											<?php echo apms_cut_text($list[$i]['wr_content'], $is_cont); ?>
										</div>
									</a>
								<?php } ?>
							</div>
						</div>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</div>
<?php } ?>
