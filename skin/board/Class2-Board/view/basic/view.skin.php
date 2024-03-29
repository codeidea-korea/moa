<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$view_skin_url.'/view.css" media="screen">', 0);

$attach_list = '';
if ($view['link']) {
	// 링크
	for ($i=1; $i<=count($view['link']); $i++) {
		if ($view['link'][$i]) {
			$attach_list .= '<a class="list-group-item break-word" href="'.$view['link_href'][$i].'" target="_blank">';
			$attach_list .= '<i class="fa fa-link"></i> '.cut_str($view['link'][$i], 70).' &nbsp;<span class="blue">+ '.$view['link_hit'][$i].'</span></a>'.PHP_EOL;
		}
	}
}

// 가변 파일
$j = 0;
if ($view['file']['count']) {
	for ($i=0; $i<count($view['file']); $i++) {
		if (isset($view['file'][$i]['source']) && $view['file'][$i]['source'] && !$view['file'][$i]['view']) {
			if ($board['bo_download_point'] < 0 && $j == 0) {
				$attach_list .= '<a class="list-group-item"><i class="fa fa-bell red"></i> 다운로드시 <b>'.number_format(abs($board['bo_download_point'])).'</b>'.AS_MP.' 차감 (최초 1회 / 재다운로드시 차감없음)</a>'.PHP_EOL;
			}
			$file_tooltip = '';
			if($view['file'][$i]['content']) {
				$file_tooltip = ' data-original-title="'.strip_tags($view['file'][$i]['content']).'" data-toggle="tooltip"';
			}
			$attach_list .= '<a class="list-group-item break-word view_file_download at-tip" href="'.$view['file'][$i]['href'].'"'.$file_tooltip.'>';
			$attach_list .= '<span class="pull-right hidden-xs text-muted"><i class="fa fa-clock-o"></i> '.date("Y.m.d H:i", strtotime($view['file'][$i]['datetime'])).'</span>';
			$attach_list .= '<i class="fa fa-download"></i> '.$view['file'][$i]['source'].' ('.$view['file'][$i]['size'].') &nbsp;<span class="orangered">+ '.$view['file'][$i]['download'].'</span></a>'.PHP_EOL;
			$j++;
		}
	}
}

$view_font = (G5_IS_MOBILE) ? '' : ' font-12';
$view_subject = get_text($view['wr_subject']);


$arr_notice = explode(',', trim($board['bo_notice']));
if(in_array($view['wr_id'], $arr_notice)) {
	$view['ca_name'] = '공지';
}

?>

<section class="s_content">
	<div class="com_detail_h">
		<div>
			<div class="com_img mt0">
				<!-- 프로필 이미지 공간  -->
				<?php 
				$member_p = apms_member($view['mb_id']);
				//print_r2($member);
				if ($member_p['photo']) { ?>
					<img src="<?php echo $member_p['photo'];?> " alt="">
				<?php } 
				else { ?>
					<img src="../images/default_img.svg" alt="">
				<?php } ?>
				
			</div>
			<div class="com_dt">
				<!-- <p>익명</p> -->
				<p><? echo $view['wr_name']; ?></p>
				<p class="ellipsis2"><?php echo cut_str(get_text($view['wr_subject']), 70); ?></p>
				<span itemprop="datePublished" content="<?php echo date('Y-m-dTH:i:s', $view['date']);?>">
					<?php echo apms_date($view['date'], 'orangered', 'before'); //시간 ?>
				</span>
			</div>
		</div>
		<div class="item">
			<span class="community_chip color_b"><?php echo $view['ca_name']?></span>
		</div>
	</div>
</section>




<section itemscope itemtype="http://schema.org/NewsArticle">
	<article itemprop="articleBody">
		<!--<h1 itemprop="headline" content="<?php echo $view_subject;?>">
			<?php if($view['photo']) { ?><span class="talker-photo hidden-xs"><?php echo $view['photo'];?></span><?php } ?>
			<?php echo cut_str(get_text($view['wr_subject']), 70); ?>
		</h1>-->
		<!--<div class="panel panel-default view-head<?php echo ($attach_list) ? '' : ' no-attach';?>">
			<div class="panel-heading">
				<div class="ellipsis text-muted<?php echo $view_font;?>">
					<span itemprop="publisher" content="<?php echo get_text($view['wr_name']);?>">
						<?php echo $view['name']; //등록자 ?>
					</span>
					<?php echo ($is_ip_view) ? '<span class="print-hide hidden-xs">('.$ip.')</span>' : ''; ?>
					<?php if($view['ca_name']) { ?>
						<span class="hidden-xs">
							<span class="sp"></span>
							<i class="fa fa-tag"></i>
							<?php echo $view['ca_name']; //분류 ?>
						</span>
					<?php } ?>
					<span class="sp"></span>
					<i class="fa fa-comment"></i>
					<?php echo ($view['wr_comment']) ? '<b class="red">'.$view['wr_comment'].'</b>' : 0; //댓글수 ?>
					<span class="sp"></span>
					<i class="fa fa-eye"></i>
					<?php echo $view['wr_hit']; //조회수 ?>

					<?php if($is_good) { ?>
						<span class="sp"></span>
						<i class="fa fa-thumbs-up"></i>
						<?php echo $view['wr_good']; //추천수 ?>
					<?php } ?>
					<?php if($is_nogood) { ?>
						<span class="sp"></span>
						<i class="fa fa-thumbs-down"></i>
						<?php echo $view['wr_nogood']; //비추천수 ?>
					<?php } ?>
					<span class="pull-right">
						<i class="fa fa-clock-o"></i>
						<span itemprop="datePublished" content="<?php echo date('Y-m-dTH:i:s', $view['date']);?>">
							<?php echo apms_date($view['date'], 'orangered', 'before'); //시간 ?>
						</span>
					</span>
				</div>
			</div>-->
		   <?php
				if($attach_list) {
					echo '<div class="list-group'.$view_font.'">'.$attach_list.'</div>'.PHP_EOL;
				}
			?>
		</div>

		<div class="view-padding">

			<?php if ($is_torrent) echo apms_addon('torrent-basic'); // 토렌트 파일정보 ?>

			<?php
				// 이미지 상단 출력
				$v_img_count = count($view['file']);
				if($v_img_count && $is_img_head) {
					echo '<div class="view-img">'.PHP_EOL;
					for ($i=0; $i<=count($view['file']); $i++) {
						if ($view['file'][$i]['view']) {
							echo get_view_thumbnail($view['file'][$i]['view']);
						}
					}
					echo '</div>'.PHP_EOL;
				}
			 ?>

			<div itemprop="description" class="view-content">
				<?php echo get_view_thumbnail($view['content']); ?>
			</div>

			<?php
				// 이미지 하단 출력
				if($v_img_count && $is_img_tail) {
					echo '<div class="view-img">'.PHP_EOL;
					for ($i=0; $i<=count($view['file']); $i++) {
						if ($view['file'][$i]['view']) {
							echo get_view_thumbnail($view['file'][$i]['view']);
						}
					}
					echo '</div>'.PHP_EOL;
				}
			?>
		</div>

		<?php if ($good_href || $nogood_href) { ?>
			<div class="s_content mt25">
				<div class="com_like">
					<div class="ic_area">
						<div style="display:flex;justify-content: space-between;">
							<div>
								<span class="<?=$my_goods_board_id?>" onclick="fn_deb_apms_like(this, '<?php echo $bo_table;?>', '<?php echo $wr_id;?>', 'good', 'wr_good'); return false;"><?php echo $view['wr_good']; //추천수 ?></span>
								<span onclick="fn_deb_comment_focus();"><?php echo ($view['wr_comment']) ?></span>
							</div>
							<div style="display:flex;gap:5px;">
								<?php if ($update_href) { ?>
									<a role="button" href="<?php echo $update_href ?>" class="btn btn-<?php echo $btn1;?> btn-sm" title="수정"<?php echo $modal_target;?>>수정</span></a>
								<?php } ?>
								<?php if ($delete_href) { ?>
									<a role="button" href="<?php echo $delete_href ?>" class="btn btn-<?php echo $btn1;?> btn-sm" title="삭제" onclick="<?php echo (APMS_PIM) ? 'modal_' : '';?>del(this.href); return false;">삭제</a>
								<?php } ?>
							</div>
						</div>
					</div>
				</div>
			</div>
			
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
				function fn_deb_comment_focus(){
					$('#bo_vc_w').show();
					$('#wr_content').focus();
				}
			</script>

		<?php } else { //여백주기 ?>
			<div class="h40"></div>
		<?php } ?>

		<?php if ($is_tag) { // 태그 ?>
			<p class="view-tag view-padding<?php echo $view_font;?>"><i class="fa fa-tags"></i> <?php echo $tag_list;?></p>
		<?php } ?>
	</article>
</section>

<?php include_once(G5_BBS_PATH . '/view_comment.php'); ?>
