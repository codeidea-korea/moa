<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$list_skin_url.'/list.css" media="screen">', 0);

// 헤드스킨
if(isset($boset['hskin']) && $boset['hskin']) {
	add_stylesheet('<link rel="stylesheet" href="'.G5_CSS_URL.'/head/'.$boset['hskin'].'.css" media="screen">', 0);
	$head_class = 'list-head';
} else {
	$head_class = (isset($boset['hcolor']) && $boset['hcolor']) ? 'border-'.$boset['hcolor'] : 'border-black';
}

// 숨김설정
$is_num = (isset($boset['lnum']) && $boset['lnum']) ? false : true;
$is_name = (isset($boset['lname']) && $boset['lname']) ? false : true;
$is_date = (isset($boset['ldate']) && $boset['ldate']) ? false : true;
$is_hit = (isset($boset['lhit']) && $boset['lhit']) ? false : true;
$is_vicon = (isset($boset['vicon']) && $boset['vicon']) ? false : true;

// 보임설정
$is_category = (isset($boset['lcate']) && $boset['lcate']) ? true : false;
$is_thumb = (isset($boset['lthumb']) && $boset['lthumb']) ? true : false;
$is_down = (isset($boset['ldown']) && $boset['ldown']) ? true : false;
$is_visit = (isset($boset['lvisit']) && $boset['lvisit']) ? true : false;
$is_good = (isset($boset['lgood']) && $boset['lgood']) ? true : false;
$is_nogood = (isset($boset['lnogood']) && $boset['lnogood']) ? true : false;

// 포토
$fa_photo = (isset($boset['ficon']) && $boset['ficon']) ? apms_fa($boset['ficon']) : '<i class="fa fa-user"></i>';

// 출력설정
$num_notice = ($is_thumb) ? '*' : '<span class="wr-icon wr-notice"></span>';

?>
<?php if($is_thumb) { ?>
	<style>
		.list-board .list-body .thumb-icon a { 
			<?php echo (isset($boset['ibg']) && $boset['ibg']) ? 'background:'.apms_color($boset['icolor']).'; color:#fff' : 'color:'.apms_color($boset['icolor']);?>; 
		}
	</style>
<?php } ?>

<div class="list-board">

	<section class="s_content">
    <ul class="community last_list">
	<?php
	for ($i=0; $i < $list_cnt; $i++) { 
		

		//아이콘 체크
		$wr_icon = '';
		$is_lock = false;
		if ($list[$i]['icon_secret'] || $list[$i]['is_lock']) {
			$wr_icon = '<span class="wr-icon wr-secret"></span>';
			$is_lock = true;
		} else if ($list[$i]['icon_hot']) {
			$wr_icon = '<span class="wr-icon wr-hot"></span>';
		} else if ($list[$i]['icon_new']) {
			$wr_icon = '<span class="wr-icon wr-new"></span>';
		} else if ($list[$i]['icon_video']) {
			$wr_icon = '<span class="wr-icon wr-video"></span>';
		} else if ($list[$i]['icon_image']) {
			$wr_icon = '<span class="wr-icon wr-image"></span>';
		} else if ($list[$i]['icon_file']) {
			$wr_icon = '<span class="wr-icon wr-file"></span>';
		}

		// 공지, 현재글 스타일 체크
		$li_css = '';
		if ($list[$i]['is_notice']) { // 공지사항
			$li_css = ' bg-light';
			$list[$i]['num'] = $num_notice;
			$list[$i]['ca_name'] = '공지';
			$list[$i]['subject'] = '<b>'.$list[$i]['subject'].'</b>';
			$wr_icon = ($is_thumb) ? '' : '<b class="wr-hidden">[알림]</b>';
		} else {
			if($is_category && $list[$i]['ca_name']) {
				//$list[$i]['subject'] = '['.$list[$i]['ca_name'].'] '.$list[$i]['subject'];
			}
			if ($wr_id == $list[$i]['wr_id']) {
				$li_css = ' bg-light';
				$list[$i]['num'] = '<span class="wr-text orangered">열람중</span>';
				$list[$i]['subject'] = '<b class="red">'.$list[$i]['subject'].'</b>';
			}
		}

		// 링크이동
		$list[$i]['target'] = '';
//		if($is_link_target && !$list[$i]['is_notice'] && $list[$i]['wr_link1']) {
		if($is_link_target && $list[$i]['wr_link1']) {
			$list[$i]['target'] = $is_link_target;
			$list[$i]['href'] = $list[$i]['link_href'][1];
		}

	?>
        <li>
            <!-- <a href="<?php echo $list[$i]['href']; ?>"> -->
            <a href="<?php echo $list[$i]['href']; ?>">
                <div>
                    <div class="com_tarea">
                    <p>
						<?php echo $list[$i]['subject']; ?>
						<span><?php echo apms_date($list[$i]['date'], 'orangered', 'before', 'm.d', 'Y.m.d'); ?></span>
					</p>
                        <p class="ellipsis2"><?php echo substr($list[$i]['content'],80);?></p>
                    </div>
                    <div class="info">
                        <p><?php echo $list[$i]['name']; ?></p>
                        <div class="com_img">
						<?php 
						$member = apms_member($list[$i]['mb_id']);
						//print_r2($member);
						if ($member['photo']) { ?>
							<img src="<?php echo $member['photo'];?> " alt="">
						<?php } 
						else { ?>
							<img src="../images/default_img.svg" alt="">
						<?php } ?>
                        </div>
                    </div>
                </div>
            </a>
				<?php 
				//좋아요 기능구현
//				$likechk = checkLikeOn('class',$list[$i]['wr_id'],$member['mb_id']);
				$wr_id = $list[$i]['wr_id'];
				$sql = "SELECT count(wr_id) as cnt from {$g5['board_good_table']} 
					where wr_id = '{$wr_id}' 
					and mb_id = '{$mb_id}' ";
			//					echo $sql;
				$cntRow = sql_fetch($sql);
				$likechk = $cntRow['cnt'] > 0;

				$likeon = ($likechk)?"on":"";
				$likenoon = ($likechk)?"":"";
				?>
            <div class="com_icon">
                <span class="community_chip color_g"><?php echo $list[$i]['ca_name'];?></span>
                <div class="ic_area">
                    <span class="<?php echo $likeon;?>" onclick="fn_deb_apms_like(this, '<?php echo $bo_table;?>', '<?php echo $list[$i]['wr_id'];?>', '<?php echo $likenoon;?>good', 'wr_<?php echo $likenoon;?>good'); return false;">
					<?php
					
					 echo $list[$i]['wr_good'];?></span>
                    <span><?php echo $list[$i]['wr_comment']; ?></span>
                </div>
            </div>
        </li>
        
		<?php } ?>
    </ul>
</section>

<script>
	function fn_deb_apms_like(target, bo_table, wr_id, act, id, wc_id){
		var href;
		const targetTag = target;

		if(wr_id && wc_id) {
			href = './deb.like.comment.php?bo_table=' + bo_table + '&wr_id=' + wr_id + '&good=' + act + '&wc_id=' + wc_id;
		} else {
			if(wr_id) {
				href = './deb.like.apms.php?bo_table=' + bo_table + '&wr_id=' + wr_id + '&good=' + act;
			} else {
				href = './deb.like.php?bo_table=' + bo_table + '&good=' + act;
			}
		}

		$.ajaxSetup({ async:false });
		$.post(href, { js: "on" }, function(data) {
			if(data.error) {
				alert(data.error);
				/*
				$(targetTag).removeClass('on');
				setTimeout(() => {
					$(targetTag).removeClass('on');
				}, (150));
				*/
				return false;
			} else if(data.success) {
				alert(data.success);
				$(targetTag).text(number_format(String(data.count)));
				
				$(targetTag).addClass('on');
				setTimeout(() => {
					$(targetTag).addClass('on');
				}, (150));
			}
		}, "json");
	}
	$(document).ready(function(){
		$(".ic_area span").off();
		setTimeout(() => {
			$(".ic_area span").off();
		}, (250));
	});
	</script>


	<ul class="list-body" style="display:none">
	<?php
	for ($i=0; $i < $list_cnt; $i++) { 

		//아이콘 체크
		$wr_icon = '';
		$is_lock = false;
		if ($list[$i]['icon_secret'] || $list[$i]['is_lock']) {
			$wr_icon = '<span class="wr-icon wr-secret"></span>';
			$is_lock = true;
		} else if ($list[$i]['icon_hot']) {
			$wr_icon = '<span class="wr-icon wr-hot"></span>';
		} else if ($list[$i]['icon_new']) {
			$wr_icon = '<span class="wr-icon wr-new"></span>';
		} else if ($list[$i]['icon_video']) {
			$wr_icon = '<span class="wr-icon wr-video"></span>';
		} else if ($list[$i]['icon_image']) {
			$wr_icon = '<span class="wr-icon wr-image"></span>';
		} else if ($list[$i]['icon_file']) {
			$wr_icon = '<span class="wr-icon wr-file"></span>';
		}

		// 공지, 현재글 스타일 체크
		$li_css = '';
		if ($list[$i]['is_notice']) { // 공지사항
			$li_css = ' bg-light';
			$list[$i]['num'] = $num_notice;
			$list[$i]['ca_name'] = '';
			$list[$i]['subject'] = '<b>'.$list[$i]['subject'].'</b>';
			$wr_icon = ($is_thumb) ? '' : '<b class="wr-hidden">[알림]</b>';
		} else {
			if($is_category && $list[$i]['ca_name']) {
				$list[$i]['subject'] = '['.$list[$i]['ca_name'].'] '.$list[$i]['subject'];
			}
			if ($wr_id == $list[$i]['wr_id']) {
				$li_css = ' bg-light';
				$list[$i]['num'] = '<span class="wr-text orangered">열람중</span>';
				$list[$i]['subject'] = '<b class="red">'.$list[$i]['subject'].'</b>';
			}
		}

		// 링크이동
		$list[$i]['target'] = '';
		if($is_link_target && !$list[$i]['is_notice'] && $list[$i]['wr_link1']) {
			$list[$i]['target'] = $is_link_target;
			$list[$i]['href'] = $list[$i]['link_href'][1];
		}

	?>
		<li class="list-item<?php echo $li_css;?>">
			<?php if ($is_checkbox) { ?>
				<div class="wr-chk">
					<input type="checkbox" name="chk_wr_id[]" value="<?php echo $list[$i]['wr_id'] ?>" id="chk_wr_id_<?php echo $i ?>">
				</div>
			<?php } ?>
			<?php if($is_num) { ?>
				<div class="wr-num hidden-xs"><?php echo $list[$i]['num']; ?></div>
			<?php } ?>
			<div class="wr-subject">
				<a href="<?php echo $list[$i]['href']; ?>" class="item-subject"<?php echo $list[$i]['target'];?><?php echo $is_modal_js;?>>
					<?php if ($list[$i]['wr_comment']) { ?>
						<span class="orangered visible-xs pull-right wr-comment">
							<i class="fa fa-comment lightgray"></i>
							<b><?php echo $list[$i]['wr_comment']; ?></b>
						</span>
					<?php } ?>
					<?php echo $list[$i]['icon_reply']; ?>
					<?php echo $wr_icon; ?>
					<?php echo $list[$i]['subject']; ?>
					<span>
							<i class="fa fa-clock-o"></i>
							<?php echo apms_date($list[$i]['date'], 'orangered', 'before', 'm.d', 'Y.m.d'); ?>
						</span>
					<?php if ($list[$i]['wr_comment']) { ?>
						<span class="count orangered hidden-xs"><?php echo $list[$i]['wr_comment']; ?></span>
					<?php } ?>
				</a>
				<?php if(!$list[$i]['is_notice']) { //공지가 아닐경우 ?>
					<div class="item-details text-muted font-12 visible-xs ellipsis">
						<?php if($is_name) { ?>
							<span><?php echo $list[$i]['name']; ?></span>
						<?php } ?>
						<span><i class="fa fa-eye"></i> <?php echo $list[$i]['wr_hit']; ?></span>
						<?php if($is_down) { ?>
							<span><i class="fa fa-download"></i> <?php echo $list[$i]['as_download'];?></span>
						<?php } ?>
						<?php if($is_visit) { ?>
							<span><i class="fa fa-share"></i> <?php echo ($list[$i]['wr_link1_hit'] + $list[$i]['wr_link2_hit']);?></span>
						<?php } ?>
						<?php if($is_good) { ?>
							<span><i class="fa fa-thumbs-up"></i> <?php echo $list[$i]['wr_good'];?></span>
						<?php } ?>
						<?php if($is_nogood) { ?>
							<span><i class="fa fa-thumbs-down"></i> <?php echo $list[$i]['wr_nogood'];?></span>
						<?php } ?>
						
					</div>
				<?php } ?>
				<div class="wr-name hidden-xs">
					여기는 컨텐츠영역입니다.80자 이내로해주세요<!--// 로직에서 추가해주세요-->
					<?php echo substr($list[$i]['content'],80);?>
				</div>
			</div>
			<?php if($is_thumb) { ?>
				<div class="wr-thumb">
					<?php if ($list[$i]['is_notice']) { ?>
						<span class="wr-icon wr-notice"></span>
					<?php } else {
						$wr_vicon = ($is_vicon && ($list[$i]['as_list'] == "2" || $list[$i]['as_list'] == "3")) ? '<i class="fa fa-play-circle-o wr-vicon"></i>' : ''; // 비디오 아이콘
						$img = apms_wr_thumbnail($bo_table, $list[$i], 50, 50, false, true); // 썸네일
						if($img['src']) { 
					?>
							<div class="thumb-img">
								<div class="img-wrap" style="padding-bottom:100%;">
									<div class="img-item">
										<a href="<?php echo $list[$i]['href']; ?>"<?php echo $list[$i]['target'];?><?php echo $is_modal_js;?>>
											<?php echo $wr_vicon;?>
											<img src="<?php echo $img['src'];?>">
										</a>
									</div>
								</div>
							</div>
						<?php } else { ?>
							<div class="thumb-icon">
								<a href="<?php echo $list[$i]['href']; ?>"<?php echo $list[$i]['target'];?><?php echo $is_modal_js;?>>
									<?php
										// 아이콘
										$thumb_icon = ($list[$i]['as_icon']) ? apms_fa(apms_emo($list[$i]['as_icon'])) : '';
										if(!$thumb_icon) {
											$thumb_icon = apms_photo_url($list[$i]['mb_id']);
											$thumb_icon = ($thumb_icon) ? '<img src="'.$thumb_icon.'">' : $fa_photo;
										}
										echo $wr_vicon;
										echo $thumb_icon;
									?>
								</a>
							</div>
						<?php } ?>
					<?php } ?>
				</div>
			<?php } ?>
			
			<?php if($is_name) { ?>
				<div class="wr-name hidden-xs">
					<?php echo $list[$i]['name'];?>
				</div>
			<?php } ?>
			<?php if($is_date) { ?>
				<div class="wr-date hidden-xs">
					<?php echo apms_date($list[$i]['date'], 'orangered', 'H:i', 'm.d', 'Y.m.d'); ?>
				</div>
			<?php } ?>
			<?php if($is_hit) { ?>
				<div class="wr-hit hidden-xs">
					<?php echo $list[$i]['wr_hit'];?>
				</div>
			<?php } ?>
			<?php if($is_down) { ?>
				<div class="wr-down hidden-xs">
					<?php echo $list[$i]['as_download'];?>
				</div>
			<?php } ?>
			<?php if($is_visit) { ?>
				<div class="wr-visit hidden-xs">
					<?php echo ($list[$i]['wr_link1_hit'] + $list[$i]['wr_link2_hit']);?>
				</div>
			<?php } ?>
			<?php if($is_good) { ?>
				<div class="wr-good hidden-xs">
					<?php echo $list[$i]['wr_good'];?>
				</div>
			<?php } ?>
			<?php if($is_nogood) { ?>
				<div class="wr-nogood hidden-xs">
					<?php echo $list[$i]['wr_nogood'];?>
				</div>
			<?php } ?>
		</li>
	<?php } ?>
	</ul>
	<div class="clearfix"></div>
	<?php if (!$is_list) { ?>
		<div class="wr-none">게시물이 없습니다.</div>
	<?php } ?>
</div>
