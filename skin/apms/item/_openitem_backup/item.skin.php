<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// StyleSheet
add_stylesheet('<link rel="stylesheet" href="'.$skin_url.'/style_1.css" type="text/css" media="screen">',0);

// 썸네일 만들기
function apms_get_item_thumbnail($img, $width, $height=0, $id='') {

    $file = G5_DATA_PATH.'/item/'.$img;

	if(is_file($file))
        $size = @getimagesize($file);

    if($size[2] < 1 || $size[2] > 3)
        return;

	if($width > 0) {
		$img_width = $size[0];
		$img_height = $size[1];
		$filename = basename($file);
		$filepath = dirname($file);

		$thumb = thumbnail($filename, $filepath, $filepath, $width, $height, true, true);

		if($thumb) {
			$file_url = str_replace(G5_PATH, G5_URL, $filepath.'/'.$thumb);
			$str = '<img src="'.$file_url.'"';
			if($id)
				$str .= ' id="'.$id.'"';
			$str .= ' alt="">';
		} else {
			return;
		}
	} else {
	    $file_url = G5_DATA_URL.'/item/'.$img;
	}

	$str = '<img src="'.$file_url.'"';
	if($id)
		$str .= ' id="'.$id.'"';
	$str .= ' alt="">';

    return $str;
}

// 관련상품 전체 추출을 위해서 재세팅함
$rmods = 100;
$rrows = 1;

// 버튼
$btn1 = (isset($wset['btn1']) && $wset['btn1']) ? $wset['btn1'] : 'navy';
$btn2 = (isset($wset['btn2']) && $wset['btn2']) ? $wset['btn2'] : 'color';

// 별점
$wset['istar'] = (isset($wset['istar']) && $wset['istar']) ? $wset['istar'] : 'red';

// 큰이미지
$big_w = (isset($wset['big_w']) && ($wset['big_w'] > 0 || $wset['big_w'] == "0")) ? $wset['big_w'] : 500;
$big_h = (isset($wset['big_h']) && ($wset['big_h'] > 0 || $wset['big_h'] == "0")) ? $wset['big_h'] : 500;

// 헤드스킨
if(isset($wset['hskin']) && $wset['hskin']) {
	add_stylesheet('<link rel="stylesheet" href="'.G5_CSS_URL.'/head/'.$wset['hskin'].'.css" media="screen">', 0);
	$head_class = 'list-head';
} else {
	$head_class = (isset($wset['hcolor']) && $wset['hcolor']) ? 'border-'.$wset['hcolor'] : 'border-black';
}

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$item_skin_url.'/style.css" media="screen">', 0);

if($is_orderable) echo '<script src="'.$item_skin_url.'/shop.js"></script>'.PHP_EOL;

$new = ($it['pt_num'] >= (G5_SERVER_TIME - (24 * 3600))) ? true : false;

// 할인
$cur_price = $dc = '';
if($it['it_cust_price'] > 0 && $it['it_price'] > 0) {
	$dc = round((($it['it_cust_price'] - $it['it_price']) / $it['it_cust_price']) * 100);
	$cur_price = '<strike>'.number_format($it['it_cust_price']).'원</strike> ';
	//$cur_price .= '<span class="dc">'.$dc.'% DC</span> ';
}

// 아이콘
$item_icon = item_icon($it);

// 이용기간
if($is_ramintime) { 
	$remain_day = (int)(($is_reamintime - G5_SERVER_TIME) / 86400); //남은일수
	$attach_list .= '<a class="list-group-item" href="#"><i class="fa fa-bell"></i> '.date("Y.m.d H:i", $is_remaintime).'('.number_format($remain_day).'일 남음)까지 이용가능합니다.</a>'.PHP_EOL;
}

$it_comment_cnt = ($it['pt_comment'] > 0) ? ' <b class="orangered en">'.number_format($it['pt_comment']).'</b>' : 0;
$it_use_cnt = ($item_use_count > 0) ? ' <b class="orangered en">'.number_format($item_use_count).'</b>' : 0;
$it_qa_cnt = ($item_qa_count > 0) ? ' <b class="orangered en">'.number_format($item_qa_count).'</b>' : 0;

$is_seller = ($it['pt_id'] && $it['pt_id'] != $config['cf_admin']) ? true : false;

// 상단 네비
if($nav_title) {
	$nav_cnt = count($nav);
	for($i=0;$i < $nav_cnt; $i++) { 
		$nav[$i]['nav'] = '<a href="./list.php?ca_id='.$nav[$i]['ca_id'].'"><span class="text-muted">'.$nav[$i]['name'];
		if($nav[$i]['cnt']) {
			$nav[$i]['nav'] .= '('.number_format($nav[$i]['cnt']).')';
		}
		$nav[$i]['nav'] .= '</span></a>';
	}
	$page_name = $nav_title;
	$page_nav1 = $nav[0]['nav'];
	$page_nav2 = $nav[1]['nav'];
	$page_nav3 = $nav[2]['nav'];
}

//헤더 네비
if($nav_title) {
	$header_skin = (isset($wset['header_skin']) && $wset['header_skin']) ? $wset['header_skin'] : 'basic';
	if($header_skin != 'none') {
		$header_color = (isset($wset['header_color']) && $wset['header_color']) ? $wset['header_color'] : 'navy';
		include_once('./header.php');
	}
}

?>

<div class="item-wrap" >

	<?php echo $it_head_html; // 상단 HTML; ?>

	<div class="item-head">
		<div class="row" >
			<div class="col-sm-6 col img-container" >
				<?php if($item_icon) { ?>
					<div class="label-tack"><?php echo $item_icon; ?></div>
				<?php } ?>
				<?php if(false && $dc) {?>
					<div class="label-band bg-red">DC</div>
				<?php } else if($new) {?>
					<div class="label-band bg-blue">New</div>
				<?php } ?>
				<div id="sit_pvi">
					<div id="sit_pvi_big" >
						<?php
						// youtube img
						/*
						$v = (apms_video_info($it['it_youtube']));
						$vimg = apms_video_img($v['video_url'], $v['vid'], $v['type']);
						if ($vimg) {
							$vimg = "<img src='{$vimg}' >";
							echo $vimg;
						}
						*/

						//공급사로고
						$attach = apms_get_file('partner', $it['pt_id']); 
						//if ($member['mb_id']=='tester8')	print_r2($attach);
						if($attach[3]['file']) { 
							$vimg = $attach[3]['path']."/".$attach[3]['file'];
							if ($vimg) {
								$vimg = "<img src='{$vimg}' >";//style='width:max-width:200px;max-height:80px'
								echo $vimg;
							}
						} 
						
						
						

						$big_img_count = 0;
						$thumbnails = array();
						for($i=1; $i<=10; $i++) {
							if(!$it['it_img'.$i])
								continue;

							// 큰이미지 썸네일
							$img = apms_get_item_thumbnail($it['it_img'.$i], $big_w, $big_h);;

							if($img) {
								// 썸네일
								$thumb = apms_get_item_thumbnail($it['it_img'.$i], 10, 10);
								$thumbnails[] = $thumb;
								$thumb_first = ($big_img_count) ? '' : ' visible';
								echo '<a href="'.G5_SHOP_URL.'/largeimage.php?it_id='.$it['it_id'].'&amp;no='.$i.'" target="_blank" class="popup_item_image'.$thumb_first.'">'.$img.'</a>';

								$big_img_count++;
							}
						}
						?>
					</div>
					<?php 
						// 그림자
						if(isset($wset['ishadow']) && $wset['ishadow']) echo apms_shadow($wset['ishadow']);

						// 썸네일
						$thumb1 = true;
						$thumb_count = 0;
						$total_count = count($thumbnails);
						if(false && $total_count > 0) {
							echo '<div id="sit_pvi_thumb">';
							foreach($thumbnails as $val) {
								$thumb_count++;
								echo '<a class="img_thumb">'.$val.'<span class="sound_only"> '.$thumb_count.'번째 이미지 새창</span></a>';
							}
							echo '</div>';
						}
					?>
				</div>
			</div>
			<div class="col-sm-6 col form-container">
				<div id="buy_form" class="text">
					<h1><?php 
					$pt = get_member($it['pt_id']);
					echo "<p class='supplier' style='width:100%;font-size:14px;color:#77aa88'>".$pt['mb_name']."</p>";
					echo stripslashes($it['it_name']); // 상품명 
					?>

					<?php if ($it['loc_id']) {
						if ($it['loc_id'])
						$sql = "select * from g5_shop_category where ca_id = '{$it['loc_id']}' ";
						$locinfo = sql_fetch($sql);
						if ($locinfo) {
							echo "<span style='width:100%;text-align:right;font-size:16px'>[".$locinfo['ca_name']."]</span>";
						}
					}
					?>
					</h1>
					<?php if($it['it_basic']) { ?>
						<div class="desc"><?php echo $it['it_basic']; ?></div>
					<?php } ?>
					<div class="price font-16 en">
						<?php if (false && $it['it_use_avg']) { ?>
							<div class="pull-right">
								<span class="font-20 <?php echo $wset['istar'];?>"><?php echo apms_get_star($it['it_use_avg']); //평균별점 ?></span>
							</div>
						<?php } ?>
						<div class="pull-left">
							<?php //if ($it['pt_type'] == '1') {?>

							<?php if (!$it['it_use']) { // 판매가능이 아닐 경우 ?>
								<b>판매중지</b>
							<?php } else if ($it['it_tel_inq']) { // 전화문의일 경우 ?>
								<b class="blue">전화문의</b>
							<?php } else { // 전화문의가 아닐 경우

								?>
								<b class="font-18 red"><?php echo display_price(get_price($it), $it['it_tel_inq']);?></b>
								<?php echo $cur_price;?>
							<?php } ?>
							<?php //} else {?>

							<?php //} ?>
						</div>
						<div class="clearfix"></div>
					</div>

					<form name="fitem" method="post" action="<?php echo $action_url; ?>" class="form" role="form" onsubmit="return fitem_submit(this);">
					<input type="hidden" name="it_id[]" value="<?php echo $it_id; ?>">
					<input type="hidden" name="it_msg1[]" value="<?php echo $it['pt_msg1']; ?>">
					<input type="hidden" name="it_msg2[]" value="<?php echo $it['pt_msg2']; ?>">
					<input type="hidden" name="it_msg3[]" value="<?php echo $it['pt_msg3']; ?>">
					<input type="hidden" name="sw_direct">
					<input type="hidden" name="url">
					<?php if ($it['it_use'] && !$it['it_tel_inq']) { ?>
						<input type="hidden" id="it_price" value="<?php echo get_price($it); ?>">
					<?php } ?>

					<div class="option-line"></div>

					<div id="item_option">
						<table class="table option-tbl">
						<tbody>
						<?php if ($it['it_maker']) { ?>
							<tr><th>제조사</th><td><?php echo $it['it_maker']; ?></td></tr>
						<?php } ?>
						<?php if ($it['it_origin']) { ?>
							<tr><th>원산지</th><td><?php echo $it['it_origin']; ?></td></tr>
						<?php } ?>
						<?php if ($it['it_brand']) { ?>
							<tr><th>브랜드</th><td><?php echo $it['it_brand']; ?></td></tr>
						<?php } ?>
						<?php if ($it['it_model']) { ?>
							<tr><th>모델</th><td><?php echo $it['it_model']; ?></td></tr>
						<?php } ?>
						<?php if($it['it_maker'] || $it['it_origin'] || $it['it_brand'] || $it['it_model']) { ?>
							<tr><td colspan="2"><div class="option-line"></div></td></tr>
						<?php } ?>
						<?php if ($config['cf_use_point']) { // 포인트 사용한다면 ?> 
							<tr>
							<th>포인트</th>
							<td>
								<?php
									if($it['it_point_type'] == 2) {
										echo '구매금액(추가옵션 제외)의 '.$it['it_point'].'%';
									} else {
										$it_point = get_item_point($it);
										echo number_format($it_point).'점';
									}
								?>
								적립
							</td>
							</tr>
						<?php } ?>
						<?php
							$ct_send_cost_label = '배송비';

							if($it['it_sc_type'] == 1)
								$sc_method = '무료배송';
							else {
								if($it['it_sc_method'] == 1)
									$sc_method = '수령후 지불';
								else if($it['it_sc_method'] == 2) {
									$ct_send_cost_label = '<label for="ct_send_cost">배송비결제</label>';
									$sc_method = '<select name="ct_send_cost" id="ct_send_cost" class="form-control input-sm">
													  <option value="0">주문시 결제</option>
													  <option value="1">수령후 지불</option>
												  </select>';
								}
								else
									$sc_method = '주문시 결제';
							}
						?>
						<?php if ($it['pt_type'] == '1') {?>
						<tr><th><?php echo $ct_send_cost_label; ?></th><td><?php echo $sc_method; ?></td></tr>
						<?php } ?>
						<?php if($option_item) { ?>
							<?php echo $option_item; // 선택옵션	?>
						<?php }	?>
						<?php if($supply_item) { ?>
							<?php echo $supply_item; // 추가옵션 ?>
						<?php }	?>
						</tbody>
						</table>

						<?php if($is_soldout) { ?>
							<p id="sit_ov_soldout" class="help-block font-11 blue">현재 재고가 부족하여 구매할 수 없습니다.</p>
						<?php } else { ?>
							<?php if($it['it_buy_min_qty'] || $it['it_buy_max_qty']) { ?>
								<p class="help-block font-11">
									<?php if($it['it_buy_min_qty']) { ?>
										최소 구매수량은 <b class="red"><?php echo number_format($it['it_buy_min_qty']); ?>개</b>
									<?php } ?>
									<?php if($it['it_buy_min_qty'] && $it['it_buy_max_qty']) { ?>
										,
									<?php } ?>
									<?php if($it['it_buy_max_qty']) { ?>
										최대 구매수량은 <b class="red"><?php echo number_format($it['it_buy_max_qty']); ?>개</b>
									<?php } ?>
									입니다.
								</p>
							<?php } ?>
						<?php } ?>

						<?php if ($is_orderable) { ?>
							<div id="it_sel_option">
								<?php
								if(!$option_item) {
									if(!$it['it_buy_min_qty'])
										$it['it_buy_min_qty'] = 1;
								?>
									<ul id="it_opt_added" class="list-group">
										<li class="it_opt_list list-group-item">
											<input type="hidden" name="io_type[<?php echo $it_id; ?>][]" value="0">
											<input type="hidden" name="io_id[<?php echo $it_id; ?>][]" value="">
											<input type="hidden" name="io_value[<?php echo $it_id; ?>][]" value="<?php echo $it['it_name']; ?>">
											<input type="hidden" class="io_price" value="0">
											<input type="hidden" class="io_stock" value="<?php echo $it['it_stock_qty']; ?>">
											<div class="row">
												<div class="col-sm-6">
													<label>
														<span class="it_opt_subj"><?php echo $it['it_name']; ?></span>
														<span class="it_opt_prc"><span class="sound_only">(+0원)</span></span>
													</label>
												</div>
												<div class="col-sm-6">
													<div class="input-group">
														<label for="ct_qty_<?php echo $i; ?>" class="sound_only">수량</label>
														<input type="text" name="ct_qty[<?php echo $it_id; ?>][]" value="<?php echo $it['it_buy_min_qty']; ?>" id="ct_qty_<?php echo $i; ?>" class="form-control input-sm" size="5">
														<div class="input-group-btn">
															<button type="button" class="it_qty_plus btn btn-lightgray btn-sm"><i class="fa fa-plus-circle fa-lg"></i><span class="sound_only">증가</span></button>
															<button type="button" class="it_qty_minus btn btn-lightgray btn-sm"><i class="fa fa-minus-circle fa-lg"></i><span class="sound_only">감소</span></button>
														</div>
													</div>
												</div>
											</div>
											<?php if($it['pt_msg1']) { ?>
												<div class="option-msg">
													<input type="text" name="pt_msg1[<?php echo $it_id; ?>][]" class="form-control input-sm" placeholder="<?php echo $it['pt_msg1'];?>">
												</div>
											<?php } ?>
											<?php if($it['pt_msg2']) { ?>
												<div class="option-msg">
													<input type="text" name="pt_msg2[<?php echo $it_id; ?>][]" class="form-control input-sm" placeholder="<?php echo $it['pt_msg2'];?>">
												</div>
											<?php } ?>
											<?php if($it['pt_msg3']) { ?>
												<div class="option-msg">
													<input type="text" name="pt_msg3[<?php echo $it_id; ?>][]" class="form-control input-sm" placeholder="<?php echo $it['pt_msg3'];?>">
												</div>
											<?php } ?>
										</li>
									</ul>
									<script>
									$(function() {
										price_calculate();
									});
									</script>
								<?php } ?>
							</div>
							<!-- 총 구매액 -->
							<div class="price-sum">
							<?php //if ($it['pt_type'] == '1') {?>
								총 금액 <b><span id="it_tot_price" class="font-20 red en">0원</span></b>
							<?php //} ?>
							</div>
						<?php } ?>
					</div>

					<div class="item-form-footer text-center" width="100%" >
						<?php if ($is_orderable) { ?>
							<ul class="item-form-btn" style="text-align:right">
							<?php
							if (!($it['pt_type'] == '2' || $caid=='10' || $caid2=='10' || $caid3=='10')) {?>
							<li>
								<a href="#" class="btn btn-item btn-block" onclick="apms_wishlist('<?php echo $it['it_id']; ?>'); return false;">
									<i class="fa fa-heart fa-lg red"></i> 위시
								</a>
							</li>
							<?php } ?>
							<li>
								<a href="#" class="btn btn-item btn-block" onclick="apms_recommend('<?php echo $it['it_id']; ?>', '<?php echo $ca_id; ?>'); return false;">
									<i class="fa fa-envelope fa-lg green"></i> 추천
								</a>
							</li>
							<?php
							$caid = substr($it['ca_id'],0,2);
							$caid2 = substr($it['ca_id2'],0,2);
							$caid3 = substr($it['ca_id3'],0,2);
							 if ($it['pt_type'] == '2' || $caid=='10' || $caid2=='10' || $caid3=='10') {?>
							<li style="padding-right:20px; "><input type="button" onclick="popup_counsel('<?php echo $it['it_id']; ?>');" value="상담하기" class="btn btn-<?php echo $btn2;?> btn-block"><!-- <p><a href="#?w=690" rel="popup1" class="poplight">___</a></p> --></li>
						<?php } else { ?>
							<li style="padding-right:15px; "><input type="submit" onclick="document.pressed=this.value;" value="바로구매" class="btn btn-<?php echo $btn2;?> btn-block"></li>
							<li style="padding-right:20px; "><input type="submit" onclick="document.pressed=this.value;" value="장바구니" class="btn btn-<?php echo $btn1;?> btn-block"></li>
						<?php } ?>
							<li class="sns-union" style="padding-top:7px; padding-left:0px; line-height:30px;">
								<!-- <i class="fa fa-external-link" style="font-size:20px; cursor:hand;"></i> -->
								<i class="fa fa-share-square green" style="font-size:23px; cursor:pointer;"></i> 
								<span style="font-size:14px; cursor:hand; padding-bottom:14px; cursor:pointer; ">공유</span>
							</li>
							</ul>

							<?php if ($naverpay_button_js) { ?>
								<div class="text-right" style="margin:10px 0px;"><?php echo $naverpay_request_js.$naverpay_button_js; ?></div>
							<?php } ?>
						<?php } ?>
						<?php if(!$is_orderable && $it['it_soldout'] && $it['it_stock_sms']) { ?>
							<button type="button" onclick="popup_stocksms('<?php echo $it['it_id']; ?>','<?php echo $ca_id; ?>');" class="btn btn-<?php echo $btn2;?> btn-lg">재입고알림(SMS)</a>
						<?php } ?>
						<div class="sns-icon pull-right">
						
						<div class="sns-share-icon" style="display:none;padding:15px;border:0.1px solid #AAA;margin-left:10px;margin-right:10px" >
							<?php 
								$sns_url  = G5_SHOP_URL.'/item.php?it_id='.$it_id;
								$sns_title = get_text($it['it_name'].' | '.$config['cf_title']);
								$sns_img = $item_skin_url.'/img';
								echo  get_sns_share_link('facebook', $sns_url, $sns_title, $sns_img.'/sns_fb.png', $seometa['img']['src']).' ';
								echo  get_sns_share_link('twitter', $sns_url, $sns_title, $sns_img.'/sns_twt.png', $seometa['img']['src']).' ';
								echo  get_sns_share_link('googleplus', $sns_url, $sns_title, $sns_img.'/sns_goo.png', $seometa['img']['src']).' ';
								echo  get_sns_share_link('kakaostory', $sns_url, $sns_title, $sns_img.'/sns_kakaostory.png', $seometa['img']['src']).' ';
								echo  get_sns_share_link('kakaotalk', $sns_url, $sns_title, $sns_img.'/sns_kakao.png', $seometa['img']['src']).' ';
								echo  get_sns_share_link('naverband', $sns_url, $sns_title, $sns_img.'/sns_naverband.png', $seometa['img']['src']).' ';
							?>
						</div>
					</div>
						
					</div>
					</form>

					<script>
						// BS3
						$(function() {
							$("select.it_option").addClass("form-control input-sm");
							$("select.it_supply").addClass("form-control input-sm");
						});

						// 재입고SMS 알림
						function popup_stocksms(it_id, ca_id) {
							url = "./itemstocksms.php?it_id=" + it_id + "&ca_id=" + ca_id;
							opt = "scrollbars=yes,width=616,height=420,top=10,left=10";
							popup_window(url, "itemstocksms", opt);
						}
						function popup_counsel(it_id) {
							//url = "<?php echo G5_BBS_URL."/write.php?bo_table=counsel&it_id=";?>"+ it_id;
							url = "<?php echo G5_URL."/shop/itemcouncelform.php?it_id=";?>"+ it_id;
							opt = "scrollbars=yes,width=656,height=720,top=10,left=10"; //height=720,
							popup_window(url, "itemcouncel", opt);

						}
						// 바로구매, 장바구니 폼 전송
						function fitem_submit(f) {

							f.action = "<?php echo $action_url; ?>";
							f.target = "";



							if (document.pressed == "장바구니") {
								f.sw_direct.value = 0;
							} else { // 바로구매
								f.sw_direct.value = 1;
							}

							// 판매가격이 0 보다 작다면
							if (document.getElementById("it_price").value < 0) {
								alert("전화로 문의해 주시면 감사하겠습니다.");
								return false;
							}

							if($(".it_opt_list").size() < 1) {
								alert("선택옵션을 선택해 주십시오.");
								return false;
							}

							var val, io_type, result = true;
							var sum_qty = 0;
							var min_qty = parseInt(<?php echo $it['it_buy_min_qty']; ?>);
							var max_qty = parseInt(<?php echo $it['it_buy_max_qty']; ?>);
							var $el_type = $("input[name^=io_type]");

							$("input[name^=ct_qty]").each(function(index) {
								val = $(this).val();

								if(val.length < 1) {
									alert("수량을 입력해 주십시오.");
									result = false;
									return false;
								}

								if(val.replace(/[0-9]/g, "").length > 0) {
									alert("수량은 숫자로 입력해 주십시오.");
									result = false;
									return false;
								}

								if(parseInt(val.replace(/[^0-9]/g, "")) < 1) {
									alert("수량은 1이상 입력해 주십시오.");
									result = false;
									return false;
								}

								io_type = $el_type.eq(index).val();
								if(io_type == "0")
									sum_qty += parseInt(val);
							});

							if(!result) {
								return false;
							}

							if(min_qty > 0 && sum_qty < min_qty) {
								alert("선택옵션 개수 총합 "+number_format(String(min_qty))+"개 이상 주문해 주십시오.");
								return false;
							}

							if(max_qty > 0 && sum_qty > max_qty) {
								alert("선택옵션 개수 총합 "+number_format(String(max_qty))+"개 이하로 주문해 주십시오.");
								return false;
							}

							if (document.pressed == "장바구니") {
								$.post("./itemcart.php", $(f).serialize(), function(error) {
									if(error != "OK") {
										alert(error.replace(/\\n/g, "\n"));
										return false;
									} else {
										if(confirm("장바구니에 담겼습니다.\n\n바로 확인하시겠습니까?")) {
											document.location.href = "./cart.php";
										}
									}
								});
								return false;
							} else {
								return true;
							}
						}

						// Wishlist
						function apms_wishlist(it_id) {
							if(!it_id) {
								alert("코드가 올바르지 않습니다.");
								return false;
							}

							$.post("./itemwishlist.php", { it_id: it_id },	function(error) {
								if(error != "OK") {
									alert(error.replace(/\\n/g, "\n"));
									return false;
								} else {
									if(confirm("위시리스트에 담겼습니다.\n\n바로 확인하시겠습니까?")) {
										document.location.href = "./wishlist.php";
									}
								}
							});

							return false;
						}

						// Recommend
						function apms_recommend(it_id, ca_id) {
							if (!g5_is_member) {
								alert("회원만 추천하실 수 있습니다.");
							} else {
								url = "./itemrecommend.php?it_id=" + it_id + "&ca_id=" + ca_id;
								opt = "scrollbars=yes,width=616,height=420,top=10,left=10";
								popup_window(url, "itemrecommend", opt);
							}
						}

						$(function() {
							$(".sns-union").click(function() {
								$(".sns-share-icon").slideToggle();
							});


						});
					</script>

					
					
					<?php if ($is_tag) { // 태그 ?>
						<p class="tag"><i class="fa fa-tags"></i> <?php echo $tag_list;?></p>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>

	<div class="clearfix"></div>
	<style>
		.caution {clear:both; background-color: #FDFDFD; border-radius: 15px; border:1px solid #FAFAFA;
		
			padding:5px; height:120px;}
		.caution_i {float:left; width:50px;margin-right: 20px;position: relative;margin-left:20px;}
		.caution_text {position: relative; float:left;
			font-size:20px;
			width:80%;max-width:800px; 
			margin-top:10px;
			padding:5px;
		}
	</style>
	<!-- <div class="caution">
		<div class="caution_i">
		<h2><i class="fa fa-bullhorn circle light-circle normal"></i></h2>
		</div>
		<div class="caution_text">
			<span class="caution_test2">명시된 진료 및 수술 가격은 임직원 분들만을 위한 우대혜택 가격으로, <br>
				<span class="orangered">병원으로 직접 예약시 본 혜택을</span> 받으실 수 없습니다.
			</span>
		</div>
	</div> -->
	<div class="clearfix"></div>
	<?php if($is_viewer || $is_link) { 
		// 보기용 첨부파일 확장자에 따른 FA 아이콘 - array(이미지, 비디오, 오디오, PDF)
		$viewer_fa = array("picture-o", "video-camera", "music", "file-powerpoint-o");
	?>
		<div class="item-view-icon text-center">

			<ul>
			<?php if($is_link) { ?>
				<?php for($i=0; $i < count($link); $i++) { ?>
					<li>
						<a href="<?php echo $link[$i]['url']; ?>" target="_blank"<?php echo ($link[$i]['name']) ? ' title="'.$link[$i]['name'].'"' : ''; ?>>
							<i class="fa fa-<?php echo ($link[$i]['fa']) ? $link[$i]['fa'] : 'link';?> circle light-circle normal"></i>
							<span>관련링크</span>
						</a>
					</li>
				<?php } ?>
			<?php } ?>

			<?php if($is_viewer) { ?>
				<?php for($i=0; $i < count($viewer); $i++) { $v = ($viewer[$i]['ext'] - 1); ?>
					<li>
					<?php if($viewer[$i]['href_view']) { ?>
						<a href="<?php echo $viewer[$i]['href_view'];?>" class="view_win">
							<i class="fa fa-<?php echo $viewer_fa[$v];?> circle light-circle normal"></i>
							<span><?php echo ($viewer[$i]['free']) ? '무료보기' : '바로보기';?></span>
						</a>
					<?php } else { ?>
						<a onclick="alert('구매한 회원만 볼 수 있습니다.');">
							<i class="fa fa-<?php echo $viewer_fa[$v];?> circle light-circle normal"></i>
							<span>유료보기</span>
						</a>
					<?php } ?>
					</li>
				<?php } ?>
			<?php } ?>
			</ul>
			<div class="clearfix"></div>
		</div>
		<script>
			var view_win = function(href) {
				var new_win = window.open(href, 'view_win', 'left=0,top=0,width=640,height=480,toolbar=0,location=0,scrollbars=0,resizable=1,status=0,menubar=0');
				new_win.focus();
			}
			$(function() {
				$(".view_win").click(function() {
					view_win(this.href);
					return false;
				});
			});
		</script>
	<?php } ?>

	<?php if($is_download) { 
		$download_cnt = count($download);	
	?>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><i class="fa fa-download"></i> Download</h3>
			</div>
			<div class="list-group">
				<?php for($i=0; $i < $download_cnt; $i++) { ?>
					<a class="list-group-item font-16 en" href="<?php echo ($download[$i]['href']) ? $download[$i]['href'] : 'javascript:alert(\'구매한 회원만 다운로드할 수 있습니다.\');';?>">
						<?php echo $i + 1;?>. <?php echo $download[$i]['source'];?> <span class="font-13">(<?php echo $download[$i]['size'];?>)</span>
						<?php if($download[$i]['free']) { ?>
							<?php if($download[$i]['guest_use']) { ?>
								<span class="label label-default pull-right down-label">무료</span> 
							<?php } else { ?>
								<span class="label label-primary pull-right down-label">회원</span> 
							<?php } ?>
						<?php } else { ?>
							<span class="label label-danger pull-right down-label">유료</span> 
						<?php } ?>
					</a>
				<?php } ?>
			</div>
		</div>
	<?php } ?>

	<?php if ($is_torrent) { // 토렌트 파일정보 ?>
		<?php for($i=0; $i < count($torrent); $i++) { ?>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title"><i class="fa fa-cube"></i> <?php echo $torrent[$i]['name'];?></h3>
				</div>
				<div class="panel-body">
					<span class="pull-right hidden-xs text-muted en font-11"><i class="fa fa-clock-o"></i> <?php echo date("Y-m-d H:i", $torrent[$i]['date']);?></span>
					<?php if ($torrent[$i]['is_size']) { ?>
							<b class="en font-16"><i class="fa fa-cube"></i> <?php echo $torrent[$i]['info']['name'];?> (<?php echo $torrent[$i]['info']['size'];?>)</b>
					<?php } else { ?>
						<p><b class="en font-16"><i class="fa fa-cubes"></i> Total <?php echo $torrent[$i]['info']['total_size'];?></b></p>
						<div class="text-muted font-12">
							<?php for ($j=0;$j < count($torrent[$i]['info']['file']);$j++) { 
								echo ($j + 1).'. '.implode(', ', $torrent[$i]['info']['file'][$j]['name']).' ('.$torrent[$i]['info']['file'][$j]['size'].')<br>'."\n";
							} ?>
						</div>
					<?php } ?>
				</div>
				<ul class="list-group">
					<li class="list-group-item en font-14 break-word"><i class="fa fa-magnet"></i> <?php echo $torrent[$i]['magnet'];?></li>
					<li class="list-group-item break-word">
						<div class="text-muted" style="font-size:12px;">
							<?php for ($j=0;$j < count($torrent[$i]['tracker']);$j++) { ?>
								<i class="fa fa-tags"></i> <?php echo $torrent[$i]['tracker'][$j];?><br>
							<?php } ?>
						</div>
					</li>
					<?php if($torrent[$i]['comment']) { ?>
						<li class="list-group-item en font-14 break-word"><i class="fa fa-bell"></i> <?php echo $torrent[$i]['comment'];?></li>
					<?php } ?>
				</ul>
			</div>
		<?php } ?>
	<?php } ?>

	<div id="tspot"></div>

	<div class="item-tab">
		<div class="tabs">
			<ul class="nav nav-tabs tabs-top">
				<li class="tab-explan active"><a href="#item_tab1" data-toggle="tab" ref="explan" tid="0">상품상세설명</a></li>
				<li class="tab-delivery"><a href="#item_tab5" data-toggle="tab" ref="delivery" tid="0">필수/배송/교환/반품</a></li>
				<?php $tab_last = true; ?>
				<?php if ($write_href) { ?>
					<li class="tab-right<?php echo ($tab_last) ? ' last' : '';?>"><a href="<?php echo $write_href;?>">등록</a></li>
				<?php $tab_last = false; } ?>
				<?php if($edit_href) { ?>
					<li class="tab-right<?php echo ($tab_last) ? ' last' : '';?>"><a href="<?php echo $edit_href;?>">수정</a></li>
				<?php $tab_last = false; } ?>
				<?php if(false && $next_href) { ?>
					<li class="tab-right<?php echo ($tab_last) ? ' last' : '';?>"><a href="<?php echo $next_href;?>" title="<?php echo $next_item;?>">다음상품</a></li>
				<?php $tab_last = false; } ?>
				<?php if(false && $prev_href) { ?>
					<li class="tab-right<?php echo ($tab_last) ? ' last' : '';?>"><a href="<?php echo $prev_href;?>" title="<?php echo $prev_item;?>">이전상품</a></li>
				<?php } ?>
			</ul>
			<div class="tab-content bg-white">
				<div class="tab-pane active" id="item_tab1">
						<?php
						if ($it['it_youtube']) {
							echo apms_video($it['it_youtube']);
						}
						?>
					<div class="item-explan img-resize">
						<?php echo apms_link_video($link_video); // 링크 비디오 체크 ?>
						<?php if ($it['pt_explan']) { // 구매회원에게만 추가로 보이는 상세설명 ?>
							<div class="well"><?php echo apms_explan($it['pt_explan']); ?></div>
						<?php } ?>
						<?php echo apms_explan($it['it_explan']); ?>
					</div>

					<?php if ($is_good) { // 추천 ?>
						<div class="item-good-box">
							<span class="item-good">
								<a href="#" onclick="apms_good('<?php echo $it_id;?>', '', 'good', 'it_good'); return false;">
									<b id="it_good"><?php echo number_format($it['pt_good']) ?></b>
									<br>
									<i class="fa fa-thumbs-up"></i>
								</a>
							</span>
							<span class="item-nogood">
								<a href="#" onclick="apms_good('<?php echo $it_id;?>', '', 'nogood', 'it_nogood'); return false;">
									<b id="it_nogood"><?php echo number_format($it['pt_nogood']) ?></b>
									<br>
									<i class="fa fa-thumbs-down"></i>
								</a>
							</span>
						</div>
					<?php } ?>

					<?php if ($is_tag) { // 태그 ?>
						<p class="text-muted"><i class="fa fa-tags"></i> <?php echo $tag_list;?></p>
					<?php } ?>

					<?php if ($is_ccl) { // CCL ?>
						<div class="well">
							<img src="<?php echo $ccl_img;?>" alt="CCL" />  &nbsp; 본 자료는 <u><?php echo $ccl_license;?></u>에 따라 이용할 수 있습니다.
						</div>
					<?php } ?>

					<?php if(isset($wset['seller']) && $wset['seller']) { // 판매자 ?>
						<div class="panel panel-default item-seller">
							<div class="panel-heading">
								<h3 class="panel-title">
									<?php if($author['partner']) { ?>
										<a href="<?php echo $at_href['myshop'];?>?id=<?php echo $author['mb_id'];?>" class="pull-right">
											<span class="label label-primary"><span class="font-11 en">My Shop</span></span>
										</a>
									<?php } ?>
									Seller
								</h3>
							</div>
							<div class="panel-body">
								<div class="pull-left text-center auth-photo">
									<div class="img-photo">
										<?php echo ($author['photo']) ? '<img src="'.$author['photo'].'" alt="">' : '<i class="fa fa-user"></i>'; ?>
									</div>
									<div class="btn-group" style="margin-top:-30px;white-space:nowrap;">
										<button type="button" class="btn btn-color btn-sm" onclick="apms_like('<?php echo $author['mb_id'];?>', 'like', 'it_like'); return false;" title="Like">
											<i class="fa fa-thumbs-up"></i> <span id="it_like"><?php echo number_format($author['liked']) ?></span>
										</button>
										<button type="button" class="btn btn-color btn-sm" onclick="apms_like('<?php echo $author['mb_id'];?>', 'follow', 'it_follow'); return false;" title="Follow">
											<i class="fa fa-users"></i> <span id="it_follow"><?php echo $author['followed']; ?></span>
										</button>
									</div>
								</div>
								<div class="auth-info">
									<div style="margin-bottom:4px;">
										<span class="pull-right">Lv.<?php echo $author['level'];?></span>
										<b><?php echo $author['name']; ?></b> &nbsp;<span class="text-muted font-11"><?php echo $author['grade'];?></span>
									</div>
									<div class="div-progress progress progress-striped no-margin">
										<div class="progress-bar progress-bar-exp" role="progressbar" aria-valuenow="<?php echo round($author['exp_per']);?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo round($author['exp_per']);?>%;">
											<span class="sr-only"><?php echo number_format($author['exp']);?> (<?php echo $author['exp_per'];?>%)</span>
										</div>
									</div>
									<p style="margin-top:10px;">
										<?php echo ($author['signature']) ? $author['signature'] : '등록된 서명이 없습니다.'; ?>
									</p>
								</div>
								<div class="clearfix"></div>
							</div>
						</div>
					<?php } ?>
				</div>

					<?php include_once($item_skin_path.'/item.mapinfo.php'); // 주소 지도 ?>
				<div class="tab-pane" id="item_tab2">
				</div>
				<div class="tab-pane" id="item_tab5">
					<?php include_once($item_skin_path.'/item.delivery.php'); // 필수 및 배송정보?>
				</div>

			</div>
			<ul class="nav nav-tabs tabs-bottom">
				<li class="tab-explan active"><a href="#item_tab1" data-toggle="tab" ref="explan" tid="1">상품상세설명</a></li>
				<!--
				<li class="tab-companymap"><a href="#item_tab2" data-toggle="tab" ref="companymap" tid="1">회사위치지도</a></li>
			-->
				<li class="tab-delivery"><a href="#item_tab5" data-toggle="tab" ref="delivery" tid="1">필수/배송/교환/반품</a></li>
				<?php if(false && $prev_href) { ?>
					<li><a href="<?php echo $prev_href;?>" title="<?php echo $prev_item;?>">이전상품</a></li>
				<?php } ?>
				<?php if(false && $next_href) { ?>
					<li><a href="<?php echo $next_href;?>" title="<?php echo $next_item;?>">다음상품</a></li>
				<?php } ?>
			</ul>
		</div>
	</div>

	<div class="h20"></div>

	<?php if ($is_relation) { ?>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><i class="fa fa-share-alt"></i> Relation Items</h3>
			</div>
			<div class="panel-body">
				<div id="itemrelation">
					<?php include_once('./itemrelation.php'); ?>
				</div>
			</div>
		</div>
	<?php } ?>

	<!-- 위젯에서 해당글 클릭시 이동위치 : icv - 댓글, iuv - 후기, iqv - 문의 -->
	<div id="iuv"></div>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title"><i class="fa fa-camera"></i> <span class="font-18"><?php echo $it_use_cnt;?></span> Reviews</h3>
		</div>
		<div class="panel-body" style="padding-bottom:0px;">
			<div id="itemuse">
				<?php include_once('./itemuse.php'); ?>
			</div>
		</div>
	</div>
   <!-- 상품문의 수정 -->
    <a name="10" style="display: block;"></a>
	<div id="iqv"></div>
	<div class="panel panel-default">
		<div class="panel-heading">
			<?php
				$caid = substr($it['ca_id'],0,2);
				$caid2 = substr($it['ca_id2'],0,2);
				$caid3 = substr($it['ca_id3'],0,2);
				 if ($it['pt_type'] == '2' || $caid=='10' || $caid2=='10' || $caid3=='10') {?>
				<h3 class="panel-title"><i class="fa fa-comments-o"></i> <span class="font-18"><?php echo $it_qa_cnt;?></span> 온라인 상담</h3>
			<?php } else { ?>
				<h3 class="panel-title"><i class="fa fa-comments-o"></i> <span class="font-18"><?php echo $it_qa_cnt;?></span> Questions</h3>
			<?php } ?>
		</div>
		<div class="panel-body" style="padding-bottom:0px;">
			<div id="itemqa">
				<?php include_once('./itemqa.php'); ?>
			</div>
		</div>
	</div>

	<?php if(false && $is_comment) { ?>
		<div id="icv"></div>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><i class="fa fa-commenting"></i> <span class="font-18"><?php echo $it_comment_cnt;?></span> Comments</h3>
			</div>
			<div class="panel-body">
				<?php include_once('./itemcomment.php'); ?>
			</div>
		</div>
	<?php } ?>
<p><a href="#?w=690" rel="popup1" class="poplight">___</a></p>
	<?php echo $it_tail_html; // 하단 HTML ?>

	<div class="btn-group btn-group-justified">
		<?php if(false && $prev_href) { ?>
			<a class="btn btn-<?php echo $btn1;?>" href="<?php echo $prev_href;?>" title="<?php echo $prev_item;?>"><i class="fa fa-chevron-circle-left"></i> 이전</a>
		<?php } ?>
		<?php if(false && $next_href) { ?>
			<a class="btn btn-<?php echo $btn1;?>" href="<?php echo $next_href;?>" title="<?php echo $next_item;?>"><i class="fa fa-chevron-circle-right"></i> 다음</a>
		<?php } ?>
		<?php if($edit_href) { ?>
			<a class="btn btn-<?php echo $btn1;?>" href="<?php echo $edit_href;?>"><i class="fa fa-plus"></i><span class="hidden-xs"> 수정</span></a>
		<?php } ?>
		<?php if ($write_href) { ?>
			<a class="btn btn-<?php echo $btn1;?>" href="<?php echo $write_href;?>"><i class="fa fa-upload"></i><span class="hidden-xs"> 등록</span></a>
		<?php } ?>
		<?php if($item_href) { ?>
			<a class="btn btn-<?php echo $btn1;?>" href="<?php echo $item_href;?>"><i class="fa fa-th-large"></i><span class="hidden-xs"> 관리</span></a>
		<?php } ?>
		<?php if($setup_href) { ?>
			<a class="btn btn-<?php echo $btn1;?> win_memo" href="<?php echo $setup_href;?>"><i class="fa fa-cogs"></i><span class="hidden-xs"> 스킨설정</span></a>
		<?php } ?>
		<a class="btn btn-<?php echo $btn2;?>" href="<?php echo $list_href;?>"><i class="fa fa-bars"></i> 목록</a>
	</div>

	<div class="h30"></div>
</div>





<script>
$(function() {

	$('.item-tab a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
		var ref = $(e.target).attr("ref") // activated tab
		var tid = $(e.target).attr("tid") // activated tab
		$('.item-tab .nav-tabs li').removeClass('active');
		$('.tab-'+ref).addClass('active');
		if(tid == "1") {
			location.href = "#tspot";
		}
	});

    // 상품이미지 첫번째 링크
    $("#sit_pvi_big a:first").addClass("visible");

    // 상품이미지 미리보기 (썸네일에 마우스 오버시)
    $("#sit_pvi .img_thumb").bind("mouseover focus", function(){
        var idx = $("#sit_pvi .img_thumb").index($(this));
        $("#sit_pvi_big a.visible").removeClass("visible");
        $("#sit_pvi_big a:eq("+idx+")").addClass("visible");
    });

    // 상품이미지 크게보기
    $(".popup_item_image").click(function() {
        var url = $(this).attr("href");
        var top = 10;
        var left = 10;
        var opt = 'scrollbars=yes,top='+top+',left='+left;
        popup_window(url, "largeimage", opt);

        return false;
    });

	$("a.view_image").click(function() {
		window.open(this.href, "large_image", "location=yes,links=no,toolbar=no,top=10,left=10,width=10,height=10,resizable=yes,scrollbars=no,status=no");
		return false;
	});
});
</script>



<!--상담신청 스크롤 버튼 -->

<style type="text/css">
#topbar{
 width:119px;
 position:absolute;
 visibility: hidden;
 z-index: 9999;
}
</style>

<script type="text/javascript">
var persistclose=1 //set to 0 or 1. 1 means once the bar is manually closed, it will remain closed for browser session
var startX = 1051 //좌측으로부터 거리
var startY = 420 //상단으로부터 거리

function iecompattest(){
return (document.compatMode && document.compatMode!="BackCompat")? document.documentElement : document.body
}

function get_cookie(Name) {
var search = Name + "="
var returnvalue = "";
if (document.cookie.length > 0) {
offset = document.cookie.indexOf(search)
if (offset != -1) {
offset += search.length
end = document.cookie.indexOf(";", offset);
if (end == -1) end = document.cookie.length;
returnvalue=unescape(document.cookie.substring(offset, end))
}
}
return returnvalue;
}

var verticalpos="fromtop"

function closebar(){
if (persistclose)
document.cookie="remainclosed=1"
document.getElementById("topbar").style.visibility="hidden"

}

function staticbar(){

    var ns = (navigator.appName.indexOf("Netscape") != -1);
    var d = document;
    function ml(id){
        var el=d.getElementById(id);
        if (!persistclose || persistclose && get_cookie("remainclosed")=="0")
        el.style.visibility="visible"
        if(d.layers)el.style=el;
        el.sP=function(x,y){this.style.left=x+"px";this.style.top=y+"px";};
        el.x = startX;
        if (verticalpos=="fromtop")
        el.y = startY;
        else{
        el.y = ns ? pageYOffset + innerHeight : iecompattest().scrollTop + iecompattest().clientHeight;
        el.y -= startY;
        }
        return el;
    }
    window.stayTopLeft=function(){
        if (verticalpos=="fromtop"){
        var pY = ns ? pageYOffset : iecompattest().scrollTop;
        ftlObj.y += (pY + startY - ftlObj.y)/8;
        }
        else{
        var pY = ns ? pageYOffset + innerHeight : iecompattest().scrollTop + iecompattest().clientHeight;
        ftlObj.y += (pY - startY - ftlObj.y)/8;
        }
        ftlObj.sP(ftlObj.x, ftlObj.y);
        setTimeout("stayTopLeft()", 10);
    }
    ftlObj = ml("topbar");
    stayTopLeft();
}

if (window.addEventListener)
window.addEventListener("load", staticbar, false)
else if (window.attachEvent)
window.attachEvent("onload", staticbar)
else if (document.getElementById)
window.onload=staticbar

 

// 클릭시 부드럽게 상단으로 올라가기
function back_top()
{
        x = document.body.scrollLeft;
        y = document.body.scrollTop;
        step = 2;

        while ((x != 0) || (y != 0)) {
                scroll (x, y);
                step += (step * step / 300);
                x -= step;
                y -= step;
                if (x < 0) x = 0;
                if (y < 0) y = 0;
        }
        scroll (0, 0);
}
</script>



<?php
	$caid = substr($it['ca_id'],0,2);
	$caid2 = substr($it['ca_id2'],0,2);
	$caid3 = substr($it['ca_id3'],0,2);
	if ($it['pt_type'] == '2' || $caid=='10' || $caid2=='10' || $caid3=='10') {?>

<!-- <div class="top" onClick="back_top()" style="cursor:pointer" id="topbar">
    <a href="#" >
      <img src="http://well.theye.co.kr/img/phone.png" width="119px" onclick="popup_counsel('<?php echo $it['it_id']; ?>');" >
    </a><br>
    <a href="#10" >
      <img src="http://well.theye.co.kr/img/online.png" width="119px">
    </a> -->
</div>


<?php } else { ?>
	<img src="http://well.theye.co.kr/img/bu_councel_no.png" width="10px" >
<?php } ?>

<!-- //상담신청 스크롤 버튼 -->


<!-- 상담모달팝업 -->

<style type="text/css">
img {border: none;}
#fade {
	display: none;
	background: #000; 
	position: fixed; left: 0; top: 0; 
	z-index: 10;
	width: 100%; height: 100%;
	opacity: .80;
	z-index: 9999;
}
.popup_block{
	display: none;
	background: #fff;
	padding: 20px; 	
	border: 10px solid #ddd;
	float: left;
	font-size: 1.2em;
	position: fixed;
	top: 30%; left: 50%;
	z-index: 99999;
	-webkit-box-shadow: 0px 0px 20px #000;
	-moz-box-shadow: 0px 0px 20px #000;
	box-shadow: 0px 0px 20px #000;
	-webkit-border-radius: 10px;
	-moz-border-radius: 10px;
	border-radius: 10px;
}
img.btn_close {
	float: right; 
	margin: -55px -20px 0 0;
}
.popup p {
	padding: 5px 10px;
	margin: 5px 0;
}
/*--Making IE6 Understand Fixed Positioning--*/
*html #fade {
	position: absolute;
}
*html .popup_block {
	position: absolute;
}
</style>



<!--POPUP START-->
<?php

// Common Skin
if(!$move) $wset['header_skin'] = 'none';
@include_once($skin_path.'/common.skin.php');

// StyleSheet
add_stylesheet('<link rel="stylesheet" href="'.$skin_url.'/style_1.css" type="text/css" media="screen">',0);

$domain = $_SERVER['HTTP_HOST'];
if ($member['mb_id']=='pletho') {
	//print_r2($domain);
}
?>

<script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="<?php echo G5_JS_URL?>/jquery-ui-timepicker-addon.js" type="text/javascript" ></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<div id="popup1" class="popup_block">
	<div class="form-header" style="margin-top:-25px;">
		<h3>상담신청</h3>
	</div>
	<div style="border-bottom:1px solid #aeaeae; top:77px;"class="form-header" ></div>
	<div style="padding-top:20px;"></div>
	<div class="form-body">

		<form name="fitemqa" class="form-light padding-15" role="form" method="post" action="./itemcouncelformupdate.php" onsubmit="return fitemqa_submit(this);" autocomplete="off">
			<input type="hidden" name="w" value="<?php echo $w; ?>">
			<input type="hidden" name="it_id" value="<?php echo $it_id; ?>">
			<input type="hidden" name="iq_id" value="<?php echo $iq_id; ?>">
			<input type="hidden" name="ca_id" value="<?php echo $ca_id; ?>">
			<input type="hidden" name="qrows" value="<?php echo $qrows; ?>">
			<input type="hidden" name="page" value="<?php echo $page; ?>">
			<input type="hidden" name="move" value="<?php echo $move; ?>">
			<input type="hidden" name="domain" value="<?php echo $domain; ?>">

			<div class="row" >
				<div class="col-sm-6"  style="width:100%; ">
					<div class="form-group" style="padding-bottom:5px;"> 
					 
						<label for="iq_company" style="width:100px;clear:both;position:relative;float:left"><b class="en">기업명</b></label>
                         
						<input type="text" id="iq_company" name="iq_company" value="<?php echo $qa['iq_company']; ?>" class="form-control input-sm required"  size="30" style="width:180px; float:left;">&nbsp;&nbsp;*(선택)기업명 입력시 더 많은 혜택을 받을실 수 있습니다
						
					</div>
				</div>
				
				<?php if (!$member['mb_id']) {?>
				<div class="col-sm-6" style="width:100%; ">
					<div class="form-group">
						<label for="iq_name" style="width:100px;clear:both;position:relative;float:left"><b class="en">이름</b></label>
						<input type="text" id="iq_name" name="iq_name" value="<?php echo $qa['iq_name']; ?>" class="form-control input-sm required"  required size="30" style="width:180px;">
					</div>
				</div>
				<?php } ?>
				<div class="col-sm-6" style="display:none">
					<div class="form-group">
						<label for="iq_email"><b class="en">이메일</b></label>
						<input type="text" id="iq_email"name="iq_email" value="<?php echo $qa['iq_email']; ?>" class="form-control input-sm" size="30" style="width:180px;">
					</div>
				</div>
				<div class="col-sm-6" style="width:100%;  padding-bottom:10px;"">
					<label for="iq_hp" style="width:100px;clear:both;position:relative;float:left"><b class="en">연락처</b></label>
					<input type="text" id="iq_hp" name="iq_hp" value="<?php echo $qa['iq_hp']; ?>" class="form-control input-sm required " required size="30" style="width:180px; float:left; "maxlength="13" onfocus="OnCheckPhone(this)" onKeyup="OnCheckPhone(this)">

					&nbsp;&nbsp; *전화번호를 정확히 입력해 주세요 
				</div>
			</div>
			<!-- <div class="form-group" >
				<label for="iq_subject"><b class="en">제목</b><strong class="sound_only"> 필수</strong></label>
				<input type="text" name="iq_subject" value="<?php echo get_text($qa['iq_subject']); ?>" id="iq_subject" required class="form-control input-sm minlength=2" minlength="2" maxlength="250" >
			</div> -->
			<div class="form-group" >
				<label for="req_time" style="width:100px;clear:both;position:relative;float:left"><b class="en">상담가능시간</b><strong class="sound_only"> 필수</strong></label>
				<input type="hidden" name="req_time" id="req_time" value="<?php echo get_text($qa['req_time']); ?>" id="req_time">&nbsp;&nbsp;
				<input type="text" name="req_time1" id="req_time1" value="<?php echo get_text($qa['req_time']); ?>" id="req_time1" required class="form-control input-sm minlength=2" minlength="2" maxlength="10" placeholder="상담가능시간" style="width:100px;float:left;position:relative;">
				<select id="req_time2" name="req_time2" class="form-control input-sm " style="width:80px;float:left;position:relative; ">
					<?php for ($i=0;$i < 24; $i++) {?>
						<option value="<?php echo ($i < 10)?"0".$i:$i;?>:00"><?php echo ($i < 10)?"0".$i:$i;?>:00</option>
						<option value="<?php echo ($i < 10)?"0".$i:$i;?>:30"><?php echo ($i < 10)?"0".$i:$i;?>:30</option>
					<?php } ?>
				</select>*선택한 시간에 상담 전화를 드립니다
			</div>
				
			<script>
			$(function() {
  //모든 datepicker에 대한 공통 옵션 설정
	            $.datepicker.setDefaults({
	                dateFormat: 'yy-mm-dd' //Input Display Format 변경
	                ,showOtherMonths: true //빈 공간에 현재월의 앞뒤월의 날짜를 표시
	                ,showMonthAfterYear:true //년도 먼저 나오고, 뒤에 월 표시
	                ,changeYear: true //콤보박스에서 년 선택 가능
	                ,changeMonth: true //콤보박스에서 월 선택 가능                
	             //   ,showOn: "both" //button:버튼을 표시하고,버튼을 눌러야만 달력 표시 ^ both:버튼을 표시하고,버튼을 누르거나 input을 클릭하면 달력 표시  
	              //  ,buttonImage: "http://jqueryui.com/resources/demos/datepicker/images/calendar.gif" //버튼 이미지 경로
	             //  ,buttonImageOnly: true //기본 버튼의 회색 부분을 없애고, 이미지만 보이게 함
	             //   ,buttonText: "선택" //버튼에 마우스 갖다 댔을 때 표시되는 텍스트                
	                ,yearSuffix: "년" //달력의 년도 부분 뒤에 붙는 텍스트
	                ,monthNamesShort: ['1','2','3','4','5','6','7','8','9','10','11','12'] //달력의 월 부분 텍스트
	                ,monthNames: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'] //달력의 월 부분 Tooltip 텍스트
	                ,dayNamesMin: ['일','월','화','수','목','금','토'] //달력의 요일 부분 텍스트
	                ,dayNames: ['일요일','월요일','화요일','수요일','목요일','금요일','토요일'] //달력의 요일 부분 Tooltip 텍스트
	                ,minDate: "-0M" //최소 선택일자(-1D:하루전, -1M:한달전, -1Y:일년전)
	                ,maxDate: "+1M" //최대 선택일자(+1D:하루후, -1M:한달후, -1Y:일년후)                    
	            });
	            $("#req_time2").change(function() {
	            	$("#req_time").val($("#req_time1").val()+" "+$("#req_time2").val());
	            });
	 			$("#req_time1").change(function() {
	            	$("#req_time").val($("#req_time1").val()+" "+$("#req_time2").val());
	            });
	 
	            //input을 datepicker로 선언
	            $("#req_time1").datepicker({
	            	
	            });                    
	            /*
	            */
	            //$("#datepicker2").datepicker();
	            
	            //From의 초기값을 오늘 날짜로 설정
	            $('#req_time1').datepicker('setDate', 'today'); //(-1D:하루전, -1M:한달전, -1Y:일년전), (+1D:하루후, -1M:한달후, -1Y:일년후)
	            //To의 초기값을 내일로 설정
	            //$('#datepicker2').datepicker('setDate', '+1D'); //(-1D:하루전, -1M:한달전, -1Y:일년전), (+1D:하루후, -1M:한달후, -1Y:일년후)
	            /*
				$('#req_time').datetimepicker({
				  showSecond: true,
				  dateFormat: 'yy-mm-dd',
				  timeFormat: 'hh:mm:ss'
				});
				*/
	        });
				/*
				*/
			</script>
			<div class="form-group" style="padding-bottom:20px;">
			    <label for="iq_subject" style="width:100px;clear:both;position:relative;float:left"><b class="en">상담내용</b></label>
				<input type="text" id="iq_subject" name="iq_subject" value="<?php echo get_text($qa['iq_subject']); ?>" id="iq_subject" required class="form-control input-sm minlength=2" minlength="2" maxlength="150" style="width:530px; float:left;">
			</div>
			<div class="form-group"  style="padding-top:5px;">
				<label for="pt_loc" style="width:100px;clear:both;position:relative;float:left; "><b class="en">지점선택</b>&nbsp;&nbsp;</label>
				<?php 
				$selected = get_pt_loc($it_id);
				$ptinfo = get_ptinfo_loc_list($it_id);
				if ($ptinfo) { ?>
				<select name="pt_loc" id="pt_loc">
					<?php
					for ($i = 1; $i <= 10; $i++) {
						if ($ptinfo['pt_'.$i]) {
						?>
						<option value="<?php echo $ptinfo['pt_'.$i];?>"><?php echo $ptinfo['pt_'.$i];?></option>
					<?php }
					}
					?>
				</select>
				<?php } 
				else {?>	
				<input type="text" name="pt_loc" value="<?php echo get_pt_loc($it_id); ?>" id="pt_loc"  class="form-control input-sm minlength=2" minlength="2" maxlength="250" placeholder="">
				<?php } ?>
			</div>
            
			<style>
				.text-muted { float:left; }
				.agrees {cursor:pointer;float:left;}
				#agreecontent {clear:both;}
			</style>
			<script>
				$(function() {
					$(".agrees").click(function() {
						$("#agreecontent").slideToggle();
					});
				});
			</script>
			
			<div class="form-group" >
				<label class="text-muted"><input type="checkbox" name="iq_agree" value="1" > 개인정보 수집동의&nbsp;</label><p class="agrees">&nbsp;[내용보기]</p>
				<div id="agreecontent" style="display:none;border:1px solid #777;padding:10px;background-color: #F0F0F0;">
					더예 서비스는 개인정보보호법, 정보통신망 이용촉진 및 정보보호 등에 관한 법률등 관련 법령상의 개인정보보호 규정을 준수합니다.<br>

					<span style="font-weight:bold; color:#2c9403;">1. 개인정보 수집 및 이용주체</span><br>
					병원 또는 병원홍보 및 마케대행 법인(수집정보는 담당자 이외에는 권한 없이 열람할 수 없습니다.)<br>

					<span style="font-weight:bold; color:#2c9403;">2. 동의를 거부할 권리 및 동의 거부에 따른 불이익</span><br>
					신청자는 개인정보제공 등에 관해 동의하지 않을 권리가 있습니다.<br>
					다만 이 경우 상담신청이 불가능합니다.<br>

					<span style="font-weight:bold; color:#2c9403;">3. 수집하는 개인정보 항목</span><br>
					신청자의 이름, 전화번호, 상담내용 등 상담을 위한 사항<br>

					<span style="font-weight:bold; color:#2c9403;">4. 수집 및 이용목적</span><br>
				     개인정보를외부에 제공하지 않으며 상담진행, 답변전달 등을 위해서만 이용합니다.<br>

					<span style="font-weight:bold; color:#2c9403;">5. 보유기간 및 이용기간</span><br>
					수집된 정보는 상담과 진료예약이 완료되면 지체없이 파기합니다.<br>
				</div>
			</div>
			<div class="h10"></div>
			
			<div class="text-center"  style="width:100px;clear:both;position:relative; left:270px;">
				<button type="submit" class="btn btn-<?php echo $btn2;?> btn-sm" style="padding:5px 20px;"><strong>상담신청</strong></button>
				<!-- <?php if($move) { ?>
					<button type="button" class="btn btn-<?php echo $btn1;?> btn-sm" onclick="history.go(-1);">취소</button>
				<?php } else { ?>
					<a href="#"><button type="button" class="btn btn-<?php echo $btn1;?> btn-sm" onclick="close " >닫기</button></a>
				<?php } ?> -->
				
			</div>
	
	</div>
</div>

<script>
	function fitemqa_submit(f) {
		<?php echo $editor_js; ?>
		if (f.iq_agree.checked == false) {
			alert("개인정보 수집동의에 동의하셔야 합니다!");
			return false;
		}

		return true;
	}

	// BS3
	$(function(){
		$("#iq_question").addClass("form-control input-sm form-iq-size");
		$("#iq_answer").addClass("form-control input-sm form-iq-size");
	});
</script>


<script type="text/javascript" src="jquery-1.4.2.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
						   		   
	//When you click on a link with class of poplight and the href starts with a # 
	$('a.poplight[href^=#]').click(function() {
		var popID = $(this).attr('rel'); //Get Popup Name
		var popURL = $(this).attr('href'); //Get Popup href to define size
				
		//Pull Query & Variables from href URL
		var query= popURL.split('?');
		var dim= query[1].split('&');
		var popWidth = dim[0].split('=')[1]; //Gets the first query string value

		//Fade in the Popup and add close button
		$('#' + popID).fadeIn().css({ 'width': Number( popWidth ) }).prepend('<a href="#" class="close"><img src="http://well.theye.co.kr/img/close_pop.png" class="btn_close" title="Close Window" alt="Close" ></a>');
		
		//Define margin for center alignment (vertical + horizontal) - we add 80 to the height/width to accomodate for the padding + border width defined in the css
		var popMargTop = ($('#' + popID).height() + 80) / 2;
		var popMargLeft = ($('#' + popID).width() + 80) / 2;
		
		//Apply Margin to Popup
		$('#' + popID).css({ 
			'margin-top' : -popMargTop,
			'margin-left' : -popMargLeft
		});
		
		//Fade in Background
		$('body').append('<div id="fade"></div>'); //Add the fade layer to bottom of the body tag.
		$('#fade').css({'filter' : 'alpha(opacity=80)'}).fadeIn(); //Fade in the fade layer 
		
		return false;
	});
	
	
	//Close Popups and Fade Layer
	$('a.close, #fade').live('click', function() { //When clicking on the close or fade layer...
	  	$('#fade , .popup_block').fadeOut(function() {
			$('#fade, a.close').remove();  
	}); //fade them both out
		
		return false;
	});

	
});

</script>

<!-- 전화번호 체크 -->
<script> 
function OnCheckPhone(oTa) { 
    var oForm = oTa.form ; 
    var sMsg = oTa.value ; 
    var onlynum = "" ; 
    var imsi=0; 
    onlynum = RemoveDash2(sMsg);  //하이픈 입력시 자동으로 삭제함 
    onlynum =  checkDigit(onlynum);  // 숫자만 입력받게 함 
    var retValue = ""; 

    if(event.keyCode != 12 ) { 
        if(onlynum.substring(0,2) == 02) {  // 서울전화번호일 경우  10자리까지만 나타나교 그 이상의 자리수는 자동삭제 
                if (GetMsgLen(onlynum) <= 1) oTa.value = onlynum ; 
                if (GetMsgLen(onlynum) == 2) oTa.value = onlynum + "-"; 
                if (GetMsgLen(onlynum) == 4) oTa.value = onlynum.substring(0,2) + "-" + onlynum.substring(2,3) ; 
                if (GetMsgLen(onlynum) == 4) oTa.value = onlynum.substring(0,2) + "-" + onlynum.substring(2,4) ; 
                if (GetMsgLen(onlynum) == 5) oTa.value = onlynum.substring(0,2) + "-" + onlynum.substring(2,5) ; 
                if (GetMsgLen(onlynum) == 6) oTa.value = onlynum.substring(0,2) + "-" + onlynum.substring(2,6) ; 
                if (GetMsgLen(onlynum) == 7) oTa.value = onlynum.substring(0,2) + "-" + onlynum.substring(2,5) + "-" + onlynum.substring(5,7) ; ; 
                if (GetMsgLen(onlynum) == 8) oTa.value = onlynum.substring(0,2) + "-" + onlynum.substring(2,6) + "-" + onlynum.substring(6,8) ; 
                if (GetMsgLen(onlynum) == 9) oTa.value = onlynum.substring(0,2) + "-" + onlynum.substring(2,5) + "-" + onlynum.substring(5,9) ; 
                if (GetMsgLen(onlynum) == 10) oTa.value = onlynum.substring(0,2) + "-" + onlynum.substring(2,6) + "-" + onlynum.substring(6,10) ; 
                if (GetMsgLen(onlynum) == 11) oTa.value = onlynum.substring(0,2) + "-" + onlynum.substring(2,6) + "-" + onlynum.substring(6,10) ; 
                if (GetMsgLen(onlynum) == 12) oTa.value = onlynum.substring(0,2) + "-" + onlynum.substring(2,6) + "-" + onlynum.substring(6,10) ; 
        } 
        if(onlynum.substring(0,2) == 05 ) {  // 05로 시작되는 번호 체크 
            if(onlynum.substring(2,3) == 0 ) {  // 050으로 시작되는지 따지기 위한 조건문 
                    if (GetMsgLen(onlynum) <= 3) oTa.value = onlynum ; 
                    if (GetMsgLen(onlynum) == 4) oTa.value = onlynum + "-"; 
                    if (GetMsgLen(onlynum) == 5) oTa.value = onlynum.substring(0,4) + "-" + onlynum.substring(4,5) ; 
                    if (GetMsgLen(onlynum) == 6) oTa.value = onlynum.substring(0,4) + "-" + onlynum.substring(4,6) ; 
                    if (GetMsgLen(onlynum) == 7) oTa.value = onlynum.substring(0,4) + "-" + onlynum.substring(4,7) ; 
                    if (GetMsgLen(onlynum) == 8) oTa.value = onlynum.substring(0,4) + "-" + onlynum.substring(4,8) ; 
                    if (GetMsgLen(onlynum) == 9) oTa.value = onlynum.substring(0,4) + "-" + onlynum.substring(4,7) + "-" + onlynum.substring(7,9) ; ; 
                    if (GetMsgLen(onlynum) == 10) oTa.value = onlynum.substring(0,4) + "-" + onlynum.substring(4,8) + "-" + onlynum.substring(8,10) ; 
                    if (GetMsgLen(onlynum) == 11) oTa.value = onlynum.substring(0,4) + "-" + onlynum.substring(4,7) + "-" + onlynum.substring(7,11) ; 
                    if (GetMsgLen(onlynum) == 12) oTa.value = onlynum.substring(0,4) + "-" + onlynum.substring(4,8) + "-" + onlynum.substring(8,12) ; 
                    if (GetMsgLen(onlynum) == 13) oTa.value = onlynum.substring(0,4) + "-" + onlynum.substring(4,8) + "-" + onlynum.substring(8,12) ; 
          } else { 
                if (GetMsgLen(onlynum) <= 2) oTa.value = onlynum ; 
                if (GetMsgLen(onlynum) == 3) oTa.value = onlynum + "-"; 
                if (GetMsgLen(onlynum) == 4) oTa.value = onlynum.substring(0,3) + "-" + onlynum.substring(3,4) ; 
                if (GetMsgLen(onlynum) == 5) oTa.value = onlynum.substring(0,3) + "-" + onlynum.substring(3,5) ; 
                if (GetMsgLen(onlynum) == 6) oTa.value = onlynum.substring(0,3) + "-" + onlynum.substring(3,6) ; 
                if (GetMsgLen(onlynum) == 7) oTa.value = onlynum.substring(0,3) + "-" + onlynum.substring(3,7) ; 
                if (GetMsgLen(onlynum) == 8) oTa.value = onlynum.substring(0,3) + "-" + onlynum.substring(3,6) + "-" + onlynum.substring(6,8) ; ; 
                if (GetMsgLen(onlynum) == 9) oTa.value = onlynum.substring(0,3) + "-" + onlynum.substring(3,7) + "-" + onlynum.substring(7,9) ; 
                if (GetMsgLen(onlynum) == 10) oTa.value = onlynum.substring(0,3) + "-" + onlynum.substring(3,6) + "-" + onlynum.substring(6,10) ; 
                if (GetMsgLen(onlynum) == 11) oTa.value = onlynum.substring(0,3) + "-" + onlynum.substring(3,7) + "-" + onlynum.substring(7,11) ; 
                if (GetMsgLen(onlynum) == 12) oTa.value = onlynum.substring(0,3) + "-" + onlynum.substring(3,7) + "-" + onlynum.substring(7,11) ; 
          } 
        } 

        if(onlynum.substring(0,2) == 03 || onlynum.substring(0,2) == 04  || onlynum.substring(0,2) == 06  || onlynum.substring(0,2) == 07  || onlynum.substring(0,2) == 08 ) {  // 서울전화번호가 아닌 번호일 경우(070,080포함 // 050번호가 문제군요) 
                if (GetMsgLen(onlynum) <= 2) oTa.value = onlynum ; 
                if (GetMsgLen(onlynum) == 3) oTa.value = onlynum + "-"; 
                if (GetMsgLen(onlynum) == 4) oTa.value = onlynum.substring(0,3) + "-" + onlynum.substring(3,4) ; 
                if (GetMsgLen(onlynum) == 5) oTa.value = onlynum.substring(0,3) + "-" + onlynum.substring(3,5) ; 
                if (GetMsgLen(onlynum) == 6) oTa.value = onlynum.substring(0,3) + "-" + onlynum.substring(3,6) ; 
                if (GetMsgLen(onlynum) == 7) oTa.value = onlynum.substring(0,3) + "-" + onlynum.substring(3,7) ; 
                if (GetMsgLen(onlynum) == 8) oTa.value = onlynum.substring(0,3) + "-" + onlynum.substring(3,6) + "-" + onlynum.substring(6,8) ; ; 
                if (GetMsgLen(onlynum) == 9) oTa.value = onlynum.substring(0,3) + "-" + onlynum.substring(3,7) + "-" + onlynum.substring(7,9) ; 
                if (GetMsgLen(onlynum) == 10) oTa.value = onlynum.substring(0,3) + "-" + onlynum.substring(3,6) + "-" + onlynum.substring(6,10) ; 
                if (GetMsgLen(onlynum) == 11) oTa.value = onlynum.substring(0,3) + "-" + onlynum.substring(3,7) + "-" + onlynum.substring(7,11) ; 
                if (GetMsgLen(onlynum) == 12) oTa.value = onlynum.substring(0,3) + "-" + onlynum.substring(3,7) + "-" + onlynum.substring(7,11) ; 

        } 
        if(onlynum.substring(0,2) == 01) {  //휴대폰일 경우 
            if (GetMsgLen(onlynum) <= 2) oTa.value = onlynum ; 
            if (GetMsgLen(onlynum) == 3) oTa.value = onlynum + "-"; 
            if (GetMsgLen(onlynum) == 4) oTa.value = onlynum.substring(0,3) + "-" + onlynum.substring(3,4) ; 
            if (GetMsgLen(onlynum) == 5) oTa.value = onlynum.substring(0,3) + "-" + onlynum.substring(3,5) ; 
            if (GetMsgLen(onlynum) == 6) oTa.value = onlynum.substring(0,3) + "-" + onlynum.substring(3,6) ; 
            if (GetMsgLen(onlynum) == 7) oTa.value = onlynum.substring(0,3) + "-" + onlynum.substring(3,7) ; 
            if (GetMsgLen(onlynum) == 8) oTa.value = onlynum.substring(0,3) + "-" + onlynum.substring(3,7) + "-" + onlynum.substring(7,8) ; 
            if (GetMsgLen(onlynum) == 9) oTa.value = onlynum.substring(0,3) + "-" + onlynum.substring(3,7) + "-" + onlynum.substring(7,9) ; 
            if (GetMsgLen(onlynum) == 10) oTa.value = onlynum.substring(0,3) + "-" + onlynum.substring(3,6) + "-" + onlynum.substring(6,10) ; 
            if (GetMsgLen(onlynum) == 11) oTa.value = onlynum.substring(0,3) + "-" + onlynum.substring(3,7) + "-" + onlynum.substring(7,11) ; 
            if (GetMsgLen(onlynum) == 12) oTa.value = onlynum.substring(0,3) + "-" + onlynum.substring(3,7) + "-" + onlynum.substring(7,11) ; 
        } 

        if(onlynum.substring(0,1) == 1) {  // 1588, 1688등의 번호일 경우 
            if (GetMsgLen(onlynum) <= 3) oTa.value = onlynum ; 
            if (GetMsgLen(onlynum) == 4) oTa.value = onlynum + "-"; 
            if (GetMsgLen(onlynum) == 5) oTa.value = onlynum.substring(0,4) + "-" + onlynum.substring(4,5) ; 
            if (GetMsgLen(onlynum) == 6) oTa.value = onlynum.substring(0,4) + "-" + onlynum.substring(4,6) ; 
            if (GetMsgLen(onlynum) == 7) oTa.value = onlynum.substring(0,4) + "-" + onlynum.substring(4,7) ; 
            if (GetMsgLen(onlynum) == 8) oTa.value = onlynum.substring(0,4) + "-" + onlynum.substring(4,8) ; 
            if (GetMsgLen(onlynum) == 9) oTa.value = onlynum.substring(0,4) + "-" + onlynum.substring(4,8) ; 
            if (GetMsgLen(onlynum) == 10) oTa.value = onlynum.substring(0,4) + "-" + onlynum.substring(4,8) ; 
            if (GetMsgLen(onlynum) == 11) oTa.value = onlynum.substring(0,4) + "-" + onlynum.substring(4,8) ; 
            if (GetMsgLen(onlynum) == 12) oTa.value = onlynum.substring(0,4) + "-" + onlynum.substring(4,8) ; 
        } 
    } 
} 

function RemoveDash2(sNo) { 
var reNo = "" 
for(var i=0; i<sNo.length; i++) { 
    if ( sNo.charAt(i) != "-" ) { 
    reNo += sNo.charAt(i) 
    } 
} 
return reNo 
} 

function GetMsgLen(sMsg) { // 0-127 1byte, 128~ 2byte 
var count = 0 
    for(var i=0; i<sMsg.length; i++) { 
        if ( sMsg.charCodeAt(i) > 127 ) { 
            count += 2 
        } 
        else { 
            count++ 
        } 
    } 
return count 
} 

function checkDigit(num) { 
    var Digit = "1234567890"; 
    var string = num; 
    var len = string.length 
    var retVal = ""; 

    for (i = 0; i < len; i++) 
    { 
        if (Digit.indexOf(string.substring(i, i+1)) >= 0) 
        { 
            retVal = retVal + string.substring(i, i+1); 
        } 
    } 
    return retVal; 
} 

</script> 

<!-- //상담모달팝업  -->



<?php include_once('./itemlist.php'); // 분류목록 ?>
