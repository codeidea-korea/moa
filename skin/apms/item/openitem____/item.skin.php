<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// StyleSheet
add_stylesheet('<link rel="stylesheet" href="'.$item_skin_url.'/style_1.css" type="text/css" media="screen">',0);
//권한자 만 등록가능 
$write_href = ($member['mb_level'] > 2)?G5_BBS_URL."/write.php?bo_table=class":"";
$edit_href = ($member['mb_level'] > 2)?G5_BBS_URL."/write.php?bo_table=class&w=u&wr_id=".$it['it_2']:"";


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

<div class="item-wrap container grid-xl" >

	<?php echo $it_head_html; // 상단 HTML; ?>

	<?php 
	// ***********************************************
	// 수업시간   2019-09-05 추가 
	// ********************************************** 
	 include_once $item_skin_path."/item.class.timelist.php"; 

		// 이미지 상단 출력
		
	 ?>

	
	<div class="item-head">
		<div class="row" >
			<div class="col-sm-12 col img-container" >
				<?php if($item_icon) { ?>
					<div class="label-tack"><?php echo $item_icon; ?></div>
				<?php } ?>
				<?php if(false && $dc) {?>
					<div class="label-band bg-red">DC</div>
				<?php } else if($new) {?>
					<div class="label-band bg-blue">New</div>
				<?php } ?>
						</div>
				</div>
				<div class="clearfix"></div>
	
			</div>
		</div>
		<div class="row" >
			<div class="col-sm-6 col form-container">
				
			</div>
		</div>
	</div>
			
		<div class="column col-8 col-md-12">

			<ul class="tab">
				<li class="tab-item active" data-tabname="tab-info">
					<a href="#class-info">수업 설명</a>
				</li>
				<li class="tab-item" data-tabname="tab-career">
					<a href="#teacher-career">선생님 경력</a>
				</li>
				<li class="tab-item" data-tabname="tab-attention">
					<a href="#class-attention">주의사항</a>
				</li>
				<li class="tab-item">
					<a href="/drawit/board_list.php">수업 후기</a>
				</li>
			</ul>
				
			<div class="tab-content" data-tabname-content="tab-info">
				<h4>선생님 소개</h4>
<?php
$mb = apms_member($it['pt_id']);
?>
				<p>
					<?php
					if ($mb['photo']) {
						echo "<img src='{$mb['photo']}' />";
					}
					if ($mb['mb_signature']) {
						echo nl2br(stripcslashes($mb['mb_signature']));
					}
						?>
							
						</p>
				
				<h4>수업 소개</h4>
				<p><div itemprop="description" class="view-content">
						<?php echo get_view_thumbnail($view['content']); ?>
					</div>
						
					</p>
				<p>
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
				
				<div class="clearfix"></div>

			</div>
			
			<div class="tab-content" data-tabname-content="tab-career" style="display:none;">
				<h4>주요 경력</h4>
				<p><?php 
					if ($mb['mb_profile']) {
						echo nl2br(stripcslashes($mb['mb_profile']));
					}
					?>
				</p>
				<!--
				<ul>
					<li class="text-ellipsis">
						<span class="text-gray">2012 - 2013</span>
						이스트소프트 - 카발 1,2 원화 및 일러스트
					</li>
					<li class="text-ellipsis">
						<span class="text-gray">2014 - 2016</span>
						(Japan) 사이버에이전트 어플리봇스튜디오 소속</li>
					</li>
					<li class="text-ellipsis">
						<span class="text-gray">2017 - 2018</span>
						(China) 유주게임즈 리드 컨셉 아티스트
					</li>
					<li class="text-ellipsis">
						<span class="text-gray">2014 - 2016</span>
						(Japan) 사이버에이전트 어플리봇스튜디오 소속</li>
					</li>
					<li class="text-ellipsis">
						<span class="text-gray">2017 - 2018</span>
						(China) 유주게임즈 리드 컨셉 아티스트
					</li>
				</ul>
				<h5>그 밖의 경력</h5>
				<ul>
					<li class="text-ellipsis">
						<span class="text-gray">2012 - 2013</span>
						이스트소프트 - 카발 1,2 원화 및 일러스트
					</li>
					<li class="text-ellipsis">
						<span class="text-gray">2014 - 2016</span>
						(Japan) 사이버에이전트 어플리봇스튜디오 소속</li>
					</li>
					<li class="text-ellipsis">
						<span class="text-gray">2017 - 2018</span>
						(China) 유주게임즈 리드 컨셉 아티스트
					</li>
					<li class="text-ellipsis">
						<span class="text-gray">2017 - 2018</span>
						(China) 유주게임즈 리드 컨셉 아티스트
					</li>

					<li class="text-ellipsis">
						<span class="text-gray">2012 - 2013</span>
						이스트소프트 - 카발 1,2 원화 및 일러스트
					</li>
					<li class="text-ellipsis">
						<span class="text-gray">2014 - 2016</span>
						(Japan) 사이버에이전트 어플리봇스튜디오 소속</li>
					</li>
					<li class="text-ellipsis">
						<span class="text-gray">2017 - 2018</span>
						(China) 유주게임즈 리드 컨셉 아티스트
					</li>
					<li class="text-ellipsis">
						<span class="text-gray">2017 - 2018</span>
						(China) 유주게임즈 리드 컨셉 아티스트
					</li>
					<li class="text-ellipsis">
						<span class="text-gray">2017 - 2018</span>
						(China) 유주게임즈 리드 컨셉 아티스트
					</li>
					<li class="text-ellipsis">
						<span class="text-gray">2017 - 2018</span>
						(China) 유주게임즈 리드 컨셉 아티스트
					</li>
				</ul>
				<div class="keyword-cloud">
					<span class="label">게임원화</span>
					<span class="label">프로작가</span>
					<span class="label">이스트소프트</span>
					<span class="label">드로잉</span>
					<span class="label">해외진출</span>
					<span class="label">포트폴리오</span>
					<span class="label">입시전문</span>
					<span class="label">취업</span>
				</div>
			-->
			</div>
		
			<div class="tab-content" data-tabname-content="tab-attention" style="display:none;">
				<h4>수업 결제 전 주의사항</h4>
				<ul>
					<li>안드로이드 OS 4.4 이상부터 신규 설치 및 업데이트가 가능하며, 카카오톡 버전 5.4.0부터 이용이 가능합니다.</li>
					<li>카카오톡 암호를 분실한 경우, 사용 중이던 카카오톡을 삭제한 후 다시 설치 하시면 정상적으로 이용하실 수 있습니다. 단, 기존 데이터는 삭제 됩니다.</li>
					<li>위치정보이용동의 메뉴는 카카오톡의 위치기반 서비스를 시작하실 때 보여집니다. 채팅방 키보드 메뉴 중 '지도' 기능을 사용하거나, 검색결과 중 현재위치 중심의 결과를 보고자 하실 때 (예.우리동네 날씨) 위치정보이용동의를 하실 수 있습니다.</li>
				</ul>
				<h4>환불 안내</h4>
				<ul>
					<li>드로잇에서는 선생님들의 정당한 수업 스케쥴과 수업료 프로세스를 위해 특별한 경우 외에는 환불을 해드리지 않습니다.</li>
					<li>환불을 받으려면 수업 시간 최소 3일 이전에 환불 신청을 해야합니다.</li>
					<li>기본적으로 환불은 포인트로 되돌려 드립니다.</li>
				</ul>
			</div>

		</div>
		
		<div class="column col-4 col-md-12">
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
			<div class="panel">
				<?php
				$pt = get_member($it['pt_id']);
				?>
				<div id="buy_form" class="text">
					<div class="panel-header text-center">
					<figure class="avatar avatar-xl"><img src="./data/avatar03.jpg" alt="Avatar"></figure>
					<div class="panel-title">
						<strong><?php echo $pt['mb_name'];?></strong>
						<em>Renian</em>
					</div>
				</div>
				<h1><?php 
				
				echo stripslashes($it['it_name']); // 상품명 
				?>

				
				</h1>
				<div class="panel-body">
					<dl>
						<dt>주제</dt>
						<dd><strong><?php echo $it['it_model']; ?></strong></dd>
						<dt>수강료</dt>
						<dd><strike><b class="font-18 red"><strike><?php echo display_price($it['it_sc_price']);?></strike></b>원</strike></dd>
						<dt>할인가</dt>
						<dd>
							<div class="panel-price">
								<strong><b class="font-18 red"><?php echo display_price(get_price($it), $it['it_tel_inq']);?></b>
							<?php echo $cur_price;?></strong>
								<em>원</em>
							</div>
						</dd>
					</dl>
					<div class="panel-desc"><?php echo $it['it_basic']; ?></div>
				</div>
				
				<div class="price font-16 en">
					<?php if (false && $it['it_use_avg']) { ?>
						<div class="pull-right">
							<span class="font-20 <?php echo $wset['istar'];?>"><?php echo apms_get_star($it['it_use_avg']); //평균별점 ?></span>
						</div>
					<?php } ?>
					
					<div class="clearfix"></div>
				</div>

				

<div class="option-line"></div>

				<div id="item_option">
					<table class="table option-tbl">
					<tbody>
					<?php if ($it['it_4']) { ?>
						<tr><th>강의일시</th><td><?php echo $it['it_4']; ?></td></tr>
					<?php } ?>
					
					<?php if ($it['it_maker']) { ?>
						<tr><th>제작자</th><td><?php echo $it['it_maker']; ?></td></tr>
					<?php } ?>
					<?php if ($it['it_origin']) { ?>
						<tr><th>원산지</th><td><?php echo $it['it_origin']; ?></td></tr>
					<?php } ?>
					<?php if ($it['it_brand']) { ?>
						<tr><th>선생님</th><td><?php echo $it['it_brand']; ?></td></tr>
					<?php } ?>
					
					<?php if($it['it_maker'] || $it['it_origin'] || $it['it_brand'] || $it['it_model']) { ?>
						<tr><td colspan="2"><div class="option-line"></div></td></tr>
					<?php } ?>
					<?php if ( false && $config['cf_use_point']) { // 포인트 사용한다면 ?> 
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
											<div class="col-sm-3">
												<label>
													<span class="it_opt_subj">인원<?php //echo $it['it_name']; ?></span>
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


						<?php if ($naverpay_button_js) { ?>
							<div class="text-right" style="margin:10px 0px;"><?php echo $naverpay_request_js.$naverpay_button_js; ?></div>
						<?php } ?>
					<?php } ?>
					<?php if(!$is_orderable && $it['it_soldout'] && $it['it_stock_sms']) { ?>
						<button type="button" onclick="popup_stocksms('<?php echo $it['it_id']; ?>','<?php echo $ca_id; ?>');" class="btn btn-<?php echo $btn2;?> btn-lg">재입고알림(SMS)</a>
					<?php } ?>
					<div class="panel-footer">
					<button class="btn btn-primary btn-lg btn-block"  onclick="document.pressed=this.value;" value="바로구매" >바로 수강신청</button>
					<div class="btn-group btn-group-block">
						<button class="btn" onClick="apms_wishlist('<?php echo $it['it_id']; ?>'); return false;">
							<i class="typcn typcn-flag"></i>	
							<span>찜</span>
							<em>38</em>
						</button>
						<button class="btn" onclick="document.pressed=this.value;" value="장바구니" >
							<i class="typcn typcn-shopping-cart"></i>
							<span>장바구니</span>
						</button>
					</div> 
					<ul class="item-form-btn" style="text-align:right">
						<!--
						<li>
							<a href="#" class="btn btn-item btn-block" onclick="apms_wishlist('<?php echo $it['it_id']; ?>'); return false;">
								<i class="typcn typcn-flag"></i> 찜
							</a>
						</li>
						<li>
							<a href="#" class="btn btn-item btn-block" onclick="apms_recommend('<?php echo $it['it_id']; ?>', '<?php echo $ca_id; ?>'); return false;">
								<i class="fa fa-envelope fa-lg green"></i> 추천
							</a>
						</li> 
						<li style="padding-right:15px; "><input type="submit" onclick="document.pressed=this.value;" value="바로구매" class="btn btn-primary btn-lg btn-block btn btn-<?php echo $btn2;?> "></li>
						<li style="padding-right:20px; "><input type="submit" onclick="document.pressed=this.value;" value="장바구니" class="btn btn-<?php echo $btn1;?> btn-block"></li>
					-->
						<li class="sns-union" style="padding-top:7px; padding-left:0px; line-height:30px;">
							<!-- <i class="fa fa-external-link" style="font-size:20px; cursor:hand;"></i> -->
							<i class="fa fa-share-square green" style="font-size:23px; cursor:pointer;"></i> 
							<span style="font-size:14px; cursor:hand; padding-bottom:14px; cursor:pointer; ">공유</span>
						</li>
						</ul>
				</div>
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
		</form>
		</div>

	</div>
	

	

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

					<?php //include_once($item_skin_path.'/item.mapinfo.php'); // 주소 지도 ?>
				<div class="tab-pane" id="item_tab2">
				</div>
				<div class="tab-pane" id="item_tab5">
					<?php include_once($item_skin_path.'/item.delivery.php'); // 필수 및 배송정보?>
				</div>

			</div>
			<ul class="nav nav-tabs tabs-bottom">
				<li class="tab-explan active"><a href="#item_tab1" data-toggle="tab" ref="explan" tid="1">상품상세설명</a></li>
				
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
			
			<h3 class="panel-title"><i class="fa fa-comments-o"></i> <span class="font-18"><?php echo $it_qa_cnt;?></span> Questions</h3>
			
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

	<?php echo latest("portfolio", "portfolio", 9, 25); ?>
	
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
	var search = Name + "=";
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
function back_top()  {
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


<?php include_once('./itemlist.php'); // 분류목록 ?>
