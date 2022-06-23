<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// Load Script
if($boset['masonry']) {
	apms_script('masonry');
	apms_script('imagesloaded');
}
if($boset['lightbox']) apms_script('lightbox');

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$list_skin_url.'/list.css" media="screen">', 0);

// 너비
$item_w = apms_img_width($board['bo_gallery_cols']);

// 간격
$gap_right = ($boset['gap_r'] == "") ? 15 : $boset['gap_r'];
$gap_bottom = ($boset['gap_b'] == "") ? 30 : $boset['gap_b'];

// 이미지 비율
$thumb_w = $board['bo_'.MOBILE_.'gallery_width'];
$thumb_h = $board['bo_'.MOBILE_.'gallery_height'];
$img_h = apms_img_height($thumb_w, $thumb_h); // 이미지 높이

// 제목
$ellipsis = ($boset['sone'] && !G5_IS_MOBILE) ? ' class="ellipsis"' : '';

// 날짜
$is_date = '';
if($boset['date']) {
	$is_date = ($boset['trans']) ? 'trans-bg-'.$boset['date'] : 'bg-'.$boset['date'];
	$is_date = ($boset['right']) ? $is_date.' right' : $is_date.' left';
}

?>
<style>
	.list-wrap .list-container { overflow:hidden; margin-right:<?php echo ($gap_right > 0) ? '-'.$gap_right : 0;?>px; margin-bottom:<?php echo ($gap_bottom > 15) ? 0 : 15;?>px; }
	.list-wrap .list-row { float:left; width:<?php echo $item_w;?>%; }
	.list-wrap .list-item { margin-right:<?php echo $gap_right;?>px; margin-bottom:<?php echo $gap_bottom;?>px; }
</style>

    <div class="calendar_pop" id="calendar">
        <div class="layerBody">
            <div class="confirm">
                <div class="mentBox">
                    <div class="close_box">
                        <button class="close_b" onclick="$('#calendar').removeClass('on')"><img src="../images/close_b.svg" alt=""></button><span>날짜선택</span>
                    </div>
                    <div id="myID"></div>
                    <script>
                        flatpickr("#myID", {
                            mode: "range",
                            inline: true,
                            "locale": "ko",
                            disableMobile: "true"
                        });
                    </script>
                    <div class="c_btn">
                        <button class="inactive on" onclick="$('#calendar').removeClass('on')">1월 24일 - 1월 26일</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="s_filter_pop" id="s_filter">
        <div class="layerBody">
            <div class="confirm">
                <div class="mentBox">
                    <div class="close_box">
                        <button class="close_b" onclick="$('#s_filter').removeClass('on')"><img src="../images/close_b.svg" alt=""> </button><span>필터</span>
                    </div>
                    <span class="s_tit">정렬</span>
                    <div class="lounchecL s_filter_radio">
                        <input type="radio" id="box_1" name="sequence">
                        <label for="box_1">최신순</label>
                        <input type="radio" id="box_2" name="sequence">
                        <label for="box_2">인기순</label>
                        <input type="radio" id="box_3" name="sequence">
                        <label for="box_3">리뷰순</label>
                        <input type="radio" id="box_4" name="sequence">
                        <label for="box_4">가격 낮은순</label>
                        <input type="radio" id="box5" name="sequence">
                        <label for="box5">가격 높은순</label>
                    </div>
                    <div class="lounchecL s_filter_radio line">
                        <input type="radio" id="box_6" name="composition">
                        <label for="box_6">1회 구성만 보기</label>
                        <input type="radio" id="box_7" name="composition">
                        <label for="box_7">N회 구성만 보기</label>
                        <input type="radio" id="box_8" name="composition">
                        <label for="box_8">전체 보기</label>
                    </div>
                    <div class="pop_btn">
                        <button class="gy" onclick="$('#s_filter').removeClass('on')">필터초기화</button>
                        <button class="gn" onclick="$('#s_filter').removeClass('on')">적용하기</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

<div class="s_content">
	<div class="srchVlm mt0">
		<!--게시글 갯수 구현-->
		<p>총 4개</p>
		<!--게시글 갯수 구현-->
		<div>
			<!--날짜/필터-->
			<button type="button" onclick="$('#calendar').addClass('on')">날짜</button>
			<button type="button" onclick="$('#s_filter').addClass('on')">필터</button>
			<!--날짜/필터-->
		</div> 
	</div>
</div>



<div class="s_content mt25">
	<ul class="day_list">
	<?php
	// 목록출력
	$k = 0;
	for ($i=0; $i < $list_cnt; $i++) { 

		if($list[$i]['is_notice']) continue;		

		// 아이콘 체크
		$is_lock = false;
		$wr_icon = $wr_label = '';
		if ($list[$i]['icon_secret'] || $list[$i]['is_lock']) {
			$wr_icon = '<span class="wr-icon wr-secret"></span>';
			$wr_label = '<div class="label-cap bg-red">Lock</div>';
			$is_lock = true;
		} else if ($list[$i]['icon_hot']) {
			$wr_icon = '<span class="wr-icon wr-hot"></span>';
			$wr_label = '<div class="label-cap bg-orange">Hot</div>';
		} else if ($list[$i]['icon_new']) {
			$wr_icon = '<span class="wr-icon wr-new"></span>';
			$wr_label = '<div class="label-cap bg-green">New</div>';
		}

		if($wr_id && $list[$i]['wr_id'] == $wr_id) {
			$wr_label = '<div class="label-cap bg-blue">Now</div>';
		}

		// 링크
		$list[$i]['target'] = '';
		if($is_link_target && !$list[$i]['is_notice'] && $list[$i]['wr_link1']) {
			$list[$i]['target'] = $is_link_target;
			$list[$i]['href'] = $list[$i]['link_href'][1];
		}

		$list[$i]['no_img'] = $board_skin_url.'/img/no-img.jpg'; // No-Image
		if($boset['lightbox']) { //라이트박스
			$img = ($is_lock) ? apms_thumbnail($list[$i]['no_img'], 0, 0, false, true) : apms_wr_thumbnail($bo_table, $list[$i], 0, 0, false, true);
			$thumb = apms_thumbnail($img['src'], $thumb_w, $thumb_h, false, true); // 썸네일
			$caption = "<a href='".$list[$i]['href']."'>".str_replace('"', '\'', $wr_icon).apms_get_html($list[$i]['subject'], 1);
			$caption .= " &nbsp;<i class='fa fa-comment'></i> ";
			if($list[$i]['wr_comment']) $caption .= "<span class='en orangered'>".$list[$i]['wr_comment']."</span>&nbsp; ";
			$caption .= "<span class='font-normal font-11'>댓글달기</span></a>";
		} else {
			$thumb = ($is_lock) ? apms_thumbnail($list[$i]['no_img'], $thumb_w, $thumb_h, false, true) : apms_wr_thumbnail($bo_table, $list[$i], $thumb_w, $thumb_h, false, true);
		}

$sql = "SELECT * from g5_shop_item where it_2 = '{$list[$i]['wr_id']}' ";
//echo $sql."<BR>";

$row = sql_fetch($sql);
$href = G5_SHOP_URL."/item.php?it_id=".$row['it_id'];
$list[$i]['href'] = $href;
//print_r2($row);
	?>
		<?php if(!$boset['masonry'] && $k > 0 && $k%$board['bo_gallery_cols'] == 0) { ?>
			<!-- <div class="list-row clearfix"></div> -->
		<?php } ?>

                <li>
                    <a href="">
                        <div class="thumb_box" style="background: url('') 0 0 no-repeat;">
                            <!-- <div></div> -->
							<?php if($boset['lightbox']) { //라이트박스 ?>
								<a href="<?php echo $img['src'];?>" data-lightbox="<?php echo $bo_table;?>-lightbox" data-title="<?php echo $caption;?>">
							<?php } else { ?>
								<a href="<?php echo $list[$i]['href'];?>"<?php echo $list[$i]['target'];?><?php echo $is_modal_js;?>>
							<?php } ?>
								<img src="<?php echo $thumb['src'];?>" alt="<?php echo $thumb['alt'];?>" style="width:208px;height:208px;">
							</a>
                        </div>
                        <div class="lctn">오프라인</div>
                        <div class="ttl"><?php echo $list[$i]['subject'];?></div>
						<!--별점구현/후기구현-->
                        <div class="rated">
                            <span class="on"></span>
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                            <p>후기 38개</p> 
                        </div>
						<!--별점구현/후기구현-->
						<?php 
						$likeon = (checkLikeOn('class',$list[$i]['wr_id'],$member['mb_id']))?"on":"";
						?>
                        <button class="lick_btn <?php echo $likeon;?>" onclick="deb_apms_like('<?php echo $bo_table;?>', '<?php echo $list[$i]['wr_id'];?>', 'good', 'wr_good'); return false;"></button>
                        <p class="sale"></p>	
                        <div class="dsc_price">
							<!--금액구현-->
                            <span><?php echo number_format($list[$i]['wr_3'])?>원</span>
							<!--금액구현-->
							<!--사용시점구현-->
                            <p>
                                <span>당일사용</span>
                            </p>
							<!--사용시점구현-->
                        </div>
                    </a>    
                </li>

		<div class="list-row" style="display:none;">
			<div class="list-item">
				<?php if($thumb_h > 0) { ?>
					<div class="imgframe">
						<div class="img-wrap" style="padding-bottom:<?php echo $img_h;?>%;">
							<div class="img-item">
								<?php echo $wr_label;?>
								<?php if ($is_checkbox) { ?>
									<div class="tack-check<?php echo ($boset['right']) ? '-left' : '';?>">
										<input type="checkbox" name="chk_wr_id[]" value="<?php echo $list[$i]['wr_id'] ?>" id="chk_wr_id_<?php echo $i ?>">
									</div>	
								<?php } ?>
								<?php if($boset['lightbox']) { //라이트박스 ?>
									<a href="<?php echo $img['src'];?>" data-lightbox="<?php echo $bo_table;?>-lightbox" data-title="<?php echo $caption;?>">
								<?php } else { ?>
									<a href="<?php echo $list[$i]['href'];?>"<?php echo $list[$i]['target'];?><?php echo $is_modal_js;?>>
								<?php } ?>
									<img src="<?php echo $thumb['src'];?>" alt="<?php echo $thumb['alt'];?>">
								</a>
							</div>
						</div>
							<div class="list-date en">
								카테고리 이름
							</div>
						<?php if($is_date) { ?>
							<div class="list-date en" style="display:none;">
								<?php echo date("Y.m.d", $list[$i]['date']); ?>
							</div>
						<?php } ?>
					</div>
				<?php } else { ?>
					<div class="list-img">
						<?php echo $wr_label;?>
						<?php if ($is_checkbox) { ?>
							<div class="tack-check<?php echo ($boset['right']) ? '-left' : '';?>">
								<input type="checkbox" name="chk_wr_id[]" value="<?php echo $list[$i]['wr_id'] ?>" id="chk_wr_id_<?php echo $i ?>">
							</div>	
						<?php } ?>
						<?php if($boset['lightbox']) { //라이트박스 ?>
							<a href="<?php echo $img['src'];?>" data-lightbox="<?php echo $bo_table;?>-lightbox" data-title="<?php echo $caption;?>">
						<?php } else { ?>
							<a href="<?php echo $list[$i]['href'];?>"<?php echo $list[$i]['target'];?><?php echo $is_modal_js;?>>
						<?php } ?>
							<img src="<?php echo $thumb['src'];?>" alt="<?php echo $thumb['alt'];?>">
						</a>
						<?php if($is_date) { ?>
							<div class="list-date <?php echo $is_date;?> en">
								<?php echo date("Y.m.d", $list[$i]['date']); ?>
							</div>
						<?php } ?>
					</div>
				<?php } ?>
				<?php if($boset['shadow']) echo apms_shadow($boset['shadow']); //그림자 ?>
				<h2>
					<a href="<?php echo $list[$i]['href'];?>"<?php echo $ellipsis;?><?php echo $list[$i]['target'];?><?php echo $is_modal_js;?>>
						<?php if($wr_id && $list[$i]['wr_id'] == $wr_id) {?>
							<span class="crimson"><?php echo $list[$i]['subject'];?></span>
						<?php } else { ?>
							<?php echo $list[$i]['subject'];?>
						<?php } ?>
					</a>
				</h2>
				<div class="list-date en">
					별점 후기 38개
				</div>
				<div class="list-date en">
					15,000 원
				</div>

				<div class="list-details text-muted" style="display:none;">
					<span class="pull-left">
						<?php echo $list[$i]['name'];?>
					</span>
					<span class="pull-right">
						<i class="fa fa-comment"></i>
						<?php echo ($list[$i]['wr_comment']) ? '<span class="red">'.number_format($list[$i]['wr_comment']).'</span>' : 0;?>
						&nbsp;&nbsp;
						<i class="fa fa-eye"></i>
						<?php echo number_format($list[$i]['wr_hit']);?>
						<?php if ($boset['udp'] && $list[$i]['as_down']) { ?>
							&nbsp;&nbsp;
							<i class="fa fa-download"></i>
							<?php echo number_format($list[$i]['as_down']); ?>P
						<?php } ?>
					</span>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	<?php $k++; } ?>
	</ul>
</div>

<div class="clearfix"></div>

<?php if (!$list_cnt) { ?>
	<div class="text-center text-muted list-none">게시물이 없습니다.</div>
<?php } ?>

<?php if($boset['masonry']) { // 메이선리 ?>
	<script>
		$(function(){
			var $container = $('.list-container');
			$container.imagesLoaded(function(){
				$container.masonry({
					columnWidth : '.list-row',
					itemSelector : '.list-row',
					isAnimated: true
				});
			});
		});
	</script>
<?php } ?>