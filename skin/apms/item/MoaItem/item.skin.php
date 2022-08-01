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

if(!$member['mb_id'] || ($member['mb_status'] != '승인' && $member['mb_level'] < 3)) {
    alert('승인된 회원만 조회가 가능합니다.', G5_URL);
}
?>
<!-- <link rel="stylesheet" href="/dist/typicons.css">
<link rel="stylesheet" href="/css/q.css"> -->
<!-- <link rel="stylesheet" href="/dist/spectre-icons.min.css"> -->
<!-- <link rel="stylesheet" href="/dist/spectre-exp.min.css">
<link rel="stylesheet" href="/dist/spectre.min.css"> -->

<div class="top_detail_wrap">
	<div class="wrapper detail_wrap detail_wrap02">
        <!-- 메인 슬라이드 -->
        <div class="swiper-container detail_slide">
            <div class="swiper9">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
						<?php
						//echo "as : [".$data['as_thumb']."]<BR>";
						if ($data['as_thumb']=="" || $data['as_thumb']=="1") {

							$data['as_thumb'] = "/images/moa_logo.svg";
						}
						?>
                        <img src="<?php echo $data['as_thumb']; ?>" alt="" height="298px">
                    </div>
                    <?php
                        $likechk = checkLikeOn('class',$it_id, $member['mb_id']);
                        $likeon = ($likechk)?"on":"";
                        $likenoon = ($likechk)?"":"";
                    ?>
                    <button class="lick_btn <?= $likeon; ?>" onclick="deb_goods_like('<?php echo $it_id ?>', 'good'); return false;"></button>
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
	</div>
	<!-- 제목 -->
	<div class="s_content detail_con">
		<div class="dt_con1">
			<h3>
				<?php echo $data['wr_subject'] ?>
			</h3>
			<span class="tit_chip"><?php echo $data['moa_onoff']; ?></span>
		</div>
		<div class="clctn_ic">
			<div>
				<img src=".././images/meet_icon/위치.svg" alt="">
				<p><?php echo $data['moa_area1'] ?></p>
				<span><?php echo $data['moa_area2']; ?></span>
			</div>
			<div>
				<img src=".././images/meet_icon/clock_ic.svg" alt="">
				<p>1회당</p>
				<span><?php echo $it['timelimit'] ?>분</span>
			</div>
			<div>
				<img src=".././images/meet_icon/personnel_ic.svg" alt="">
				<p><?= $data['wr_2'] > 0 ? $data['wr_2'] : 0; ?>명</p>
				<span>최소 인원 <?php echo $data['wr_1'] > 0 ? $data['wr_1'] : 0; ?>명</span>
			</div>
			<div>
				<img src=".././images/meet_icon/<?php echo $data['moa_type'] ?>.svg" alt="">
				<p><?php echo $data['moa_type']; ?></p>
			</div>
		</div>
	</div>


	<!--모임 스케쥴-->
	<div class="s_content detail_con">
		<div class="dt_h4">
			<h4>모임 스케쥴</h4>
		</div>
		<?php
			$class = "select * from g5_write_class b join g5_shop_item a 
						on b.wr_id = a.it_2 join deb_class_item c 
						on a.it_id = c.it_id where a.it_2 = '{$data['wr_id']}'";
			$schedules = sql_query($class);
		?>
		<div class="schedule">
			<ul>
				<?php
				while($schedule = sql_fetch_array($schedules)) { ?>
				<li>
					<span><?php echo date('m-d', strtotime($schedule['day'])) ?></span>
					<span><?php echo $schedule['cls_no'] + 1; ?>회차</span>
					<span><?php echo $schedule['wr_subject']; ?></span>
					<span><?php echo $schedule['time'] . ':' . $schedule['minute']; ?> (<?php echo $schedule['timelimit']; ?>분)</span>
				</li>
				<?php if(sql_num_rows($schedules) > 1 && ($schedule['cls_no'] + 1) != sql_num_rows($schedules)) {?>
					<li><img src="../images/arrow-r.svg" alt=""></li>
				<?php }
				}?>
			</ul>
		</div>
	</div>
	<!-- 모집 현황 -->
	<div class="s_content detail_con">
		<div class="dt_h4">
			<h4>모집 현황</h4>
		</div>
		<div class="owchip_area">
			<div class="owchip_recru on">
				<span></span>
				<?php $arr = ['준비중','모집승인','반려','모집삭제', '모집취소','폐강']; ?>
				<span><?= $arr[$data['moa_status']]; ?></span>
				<p>(<?php echo getMoimAdmitApplyCountIt($it['it_id']) ?>/<?php echo $data['wr_2'] > 0 ? $data['wr_2'] : 0; ?>명)</p>
			</div>
			<!--<div class="owchip_com">
				<span></span>
				<span>모집중</span>
				<p>18:00~20:00</p>
				<p>(2/4명)</p>
			</div>-->
		</div>
	</div>
	<!-- 호스트 소개 -->
	<?php
		$user = "select * from g5_member where mb_id = '{$data['mb_id']}'";
		$result = sql_fetch($user);
	?>
	<div class="s_content detail_con" >
		<div class="d_tit">
			호스트 소개
		</div>
		<div class="host_info">
			<div class="hpro_img"><?php echo ($result['as_photo']) ? '<img src="'.$result['as_photo'].'" alt="">' : '<span class="no-img"></span>'; //사진 ?></div>
			<div class="t_area">
				<?php $cnt = getDashBoardInfo($data['mb_id']); ?>
				<p><?php echo $result['mb_nick']; ?><span>모임개수<?php echo $cnt['moa_count']; ?></span><span>리뷰<?php echo $cnt['moa_use'] ?>개</span></p>
				<p class="txt">
					<?php echo $result['mb_signature']; ?>
				</p>
				<?php $hash = explode(',', $result['hash_tag']); ?>
				<?php if(count($hash) > 0 && $hash[0] != '') { ?>
					<p class="h_hash">
						<?php for($i=0;$i<count($hash);$i++) { ?>
							<span>#<?php echo $hash[$i]; ?></span>
						<?php } ?>
					</p>
				<?php }?>
			</div>
		</div>
	</div>
	<!-- 호스트 소개 끝 -->

	<!-- tab영역 -->
	<div class="s_content detail_con pr_pl">
		<div class="tabs">
			<input id="dtl" type="radio" name="tab_item" checked>
			<label class="tab_item" for="dtl">상세 정보</label>
			<input id="review" type="radio" name="tab_item">
			<label class="tab_item" for="review">후기 <span><?php echo $it_use_cnt;?></span></label>
			<input id="qa" type="radio" name="tab_item">
			<label class="tab_item" for="qa">Q&A <span><?= $it_qa_cnt; ?></span></label>
			<input id="rfnd" type="radio" name="tab_item">
			<label class="tab_item" for="rfnd">환불정책</label>
			<hr>
			<div class="tab_content" id="dtl_content">
				<div class="s_content detail_con">
					<div class="d_tit">
						모임 소개
					</div>
					<p>
						<?= $data['wr_content']; ?>
					</p>

					<!-- <?php $tags = explode(',', $data['as_tag']); ?>
					<span class="hash">
						<?php foreach($tags as $tag) {
							echo '#' . $tag;
						} ?>
					</span> -->
					<p class="division"></p>
				</div>
				

				<!-- 커리큘럼 -->
				<div class="s_content detail_con" >
					<div class="curriculum">
						<div class="d_tit">
							커리큘럼
						</div>
						<p><?php echo nl2br($data['moa_curriculum'], 1); ?></p>
					</div>
					<p class="division"></p>
				</div>
				<!-- 커리큘러 끝 -->

				<!-- 포함 /불포함 지도-->
				<div class="s_content detail_con" >
					<?php if($data['moa_support']) { ?>
						<div class="d_tit cr mt14">
							포함 사항
							<div class="com_chip color_green">
								<?php $support = array_values(array_filter(explode(',', $data['moa_support']))); ?>
								<?php for($i=0;$i<count($support);$i++) { ?>
									<?php if (trim($support[$i]) != "") {?>
										<span><?=$support[$i]?></span>
									<?php }?>
								<?php } ?>
							</div>
						</div>
					<?php } ?>
					<?php if($data['moa_nosupport']) { ?>
						<div class="d_tit cr mt14">
							불포함 사항
							<div class="com_chip color_gray">
								<?php $nosupport = array_values(array_filter(explode(',', $data['moa_nosupport']))); ?>
								<?php for($i=0;$i<count($nosupport);$i++) { ?>
									<?php if (trim($nosupport[$i]) != "") {?>
										<span><?=$nosupport[$i]?></span>
									<?php }?>
								<?php } ?>
							</div>
						</div>
					<?php } ?>
					<?php if($data['moa_supplies']) { ?>
						<div class="d_tit cr mt14">
							준비물
							<div class="com_chip color_red">
								<?php $supplies = array_values(array_filter(explode(',', $data['moa_supplies']))); ?>
								<?php for($i=0;$i<count($supplies);$i++) { ?>
									<?php if (trim($supplies[$i]) != "") {?>
										<span><?=$supplies[$i]?></span>
									<?php }?>
								<?php } ?>
							</div>
						</div>
					<?php } ?>
                    <?php if($data['as_tag']) { ?>
                        <div class="d_tit cr mt14">
                            해시태그
                            <div class="com_chip color_gray">
                                <?php $hash = array_values(array_filter(explode(',', $data['as_tag']))); ?>
                                <?php for($i=0;$i<count($hash);$i++) { ?>
									<?php if (trim($hash[$i]) != "") {?>
										<span><?=$hash[$i]?></span>
									<?php }?>
                                <?php } ?>
                            </div>
                        </div>
                    <?php } ?>
					<!-- map -->
					<div class="mt25">
						<div id="map" style="width:700px;height:600px;"></div>
					</div>
					<!--신고버튼-->
					<div class="d_tit cr mt14">
						<div class="com_chip color_red">
							<span onclick="report_btn('모임1')" style="cursor:pointer;">신고</span>
							<span onclick="report_btn('모임2')" style="cursor:pointer;">차단</span>
						</div>
					</div>
					<!--신고버튼-->
				</div>
				<!-- 포함 /불포함 지도 끝-->				
			</div>
			<div class="tab_content" id="review_content">
				<div class="s_content detail_con">
					<div class="more col_green">
						<button onclick="location.href='/c_detail/d_review.php?it_id=<?php echo $it_id ?>'">후기 작성하기</button>
					</div>
					<div class="re_txt">
						<p><?php echo $item_use_count;?>개의 후기</p>
						<?php for($i=0;$i<(floor($total_score / $item_use_count));$i++) { ?>
							<span class="on"></span>
						<?php } ?>
						<?php for($i=0;$i<(5-($total_score / $item_use_count));$i++) { ?>
							<span></span>
						<?php } ?>
						<p><?= $total_score / $item_use_count > 0 ? number_format(($total_score / $item_use_count), 1) : ''; ?></p>
					</div>
					<?php if(count($item) > 0) { ?>
						<?php for($j=0;$j<count($item);$j++) { ?>
							<div class="review">
								<div class="pro_img"><?= $item[$i]['mb_img']; ?></div>
								<div class="t_area p_layout">
									<div class="t_area02" style="align-items: flex-start;flex-direction: column;">
										<p><?= $item[$j]['is_name']; ?><span><?= date('y-m-d', strtotime($item[$j]['is_time'])); ?></span></p>
										<div class="scope re_txt">
											<?php for($i=0;$i<$item[$j]['is_score'];$i++) { ?>
												<span class="on"></span>
											<?php } ?>
											<?php for($i=0;$i<(5 - $item[$j]['is_score']);$i++) { ?>
												<span></span>
											<?php } ?>
											<p><?= number_format($item[$j]['is_score'], 1); ?></p>
											<div style="display:flex;position:absolute;right:10px;">
												<p onclick="report_btn('후기1')" style="font-size:13px;color: #EB5757;background: rgba(235, 87, 87, 0.05);border: 1px solid #EB5757;border-radius: 38px;padding: 6px 12px !important;margin:0 3px;">신고</p>
												<p onclick="report_btn('후기2')" style="font-size:13px;color: #EB5757;background: rgba(235, 87, 87, 0.05);border: 1px solid #EB5757;border-radius: 38px;padding: 6px 12px !important;margin:0 3px;">차단</p>
											</div>	
										</div>
									</div>
									<p class="txt">
										<?= $item[$j]['is_content']; ?>
									</p>
								</div>
							</div>
						<?php if($total > 3) { ?>
						<div class="more">
							<button>후기 더보기</button>
						</div>
						<?php }
							}
						} else { ?>
							<div class="review">
								<div class="t_area">
									<p>작성된 후기가 없습니다.</p>
								</div>
							</div>
						<?php } ?>
				</div>
			</div>
			<div class="tab_content" id="qa_content">
				<div class="s_content detail_con">
					<div class="more col_green">
						<button onclick="location.href='/c_detail/d_qna.php?it_id=<?php echo $it_id ?>'">문의 작성하기</button>
					</div>
					<?php if(sql_num_rows($qna) > 0) {
					while($row = sql_fetch_array($qna)) { ?>
						<div class="review">
							<div class="pro_img"><?php echo moaMemberProfile($row['mb_id']); ?></div>
							<div class="t_area">
								<p><?= $row['mb_id']; ?><span><?= date('y-m-d', strtotime($row['iq_time'])); ?></span><span onclick="report_btn('Q&A1')" style="color: #EB5757;background: rgba(235, 87, 87, 0.05);border: 1px solid #EB5757;border-radius: 38px;padding: 6px 16px !important;margin:0 5px;">신고</span><span onclick="report_btn('Q&A2')" style="color: #EB5757;background: rgba(235, 87, 87, 0.05);border: 1px solid #EB5757;border-radius: 38px;padding: 6px 16px !important;margin:0 5px;">차단</span><i <?= $row['iq_answer'] != '' ? 'class="on"' : ''; ?>><?= $row['iq_answer'] != '' ? '답변 완료' : '답변 미완료' ?></i></p>
								<p class="txt">
									<?php if($row['iq_secret']) { ?>
										<span class="secret">비밀글입니다</span>
									<?php } else { ?>
										<?php echo $row['iq_question'] ?>
									<?php } ?>
									<?php if($row['iq_answer'] != '') { ?>
										<div class="re">
											<p><?= $row['pt_id'] ?></p>
											<p class="re_text">
												<?php if($row['iq_secret']) { ?>
													<span class="secret">비밀글입니다</span>
												<?php } else { ?>
													<?= $row['iq_answer']; ?>
												<?php } ?>
											</p>
										</div>
									<?php } ?>
								</p>
							</div>
						</div>
					<?php }
					} else { ?>
						<div class="review">
							<div class="t_area">
								<p>작성된 Q&A가 없습니다.</p>
							</div>
						</div>
					<?php } ?>
				</div>
			</div>
			<div class="tab_content" id="rfnd_content">
				<div class="s_content detail_con">
					<div class="tab_refund">
						<div class="refund_tit">환불정책</div>
						<ul>
							<li>1. 모임결제 후 1시간 이내 취소 시, 100% 환불(포인트/쿠폰 복원).</li>
							<li>2. 모임 6일 전 취소 시, 60% 환불</li>
							<li>3. 모임 5일 전 취소 시, 50% 환불</li>
							<li>4. 모임 4일 전 취소 시, 40% 환불</li>
							<li>5. 모임 3일 전 취소 시, 30% 환불</li>
							<li>6. 모임 2일 전 취소 시, 20% 환불</li>
							<li>7. 모임 1일 전 취소 시, 10% 환불</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>

    <div class="expected_cost none" >
        <div class="cost_area">
            <span class="ex_cost">예상비용</span>
            <div class="cost"><?php $data['wr_4'] > 0 ? number_format($data['wr_4']) . '원 <span>(회당)</span>':  '무료'; ?></div>
        </div>
        <?php if(number_format($data['wr_2']) > getMoimAdmitApplyCountIt($it['it_id'])) { ?>
            <button type="button" onclick="$('.btn_submit').click();">결제하기</button>
        <?php } else { ?>
            <button type="button" onclick="alert('인원이 초과 되었습니다.');" disabled>마감</button>
        <?php } ?>
    </div>
</div> 
<!--신고버튼-->
<script>
function report_btn(val){
	if(val=='모임1'){
		var result = confirm('해당 모임을 신고하시겠습니까?');

		if(result) {
		   //yes
		   //location.replace('index.php');
		   alert('신고되었습니다. 관리자 확인 후 처리예정입니다. 감사합니다.');
		   //처리예정 
		   /*
			$.ajax({
				type: 'POST',
				url: "../../app/ajax_check.php",
				data: {
					checkName : "company_01_ck",
					company_token_val : company_token_val,
					token_val : $('#token_val').val()
				},
				cache: false,
				async: false,
				error : function(request,status,error){
					alert("code : "+request.status+"\r\nmessage : " + request.responseText);
				},
				beforeSend:function(x){
				//처리중 화면구성
				},
				success: function(result) {
					result = result.replace(/(^\s*)|(\s*$)/g, "");
					var re=result.split("///");
					if(re[0]=='ok'){
						$("#company_01").html(re[1]);
						$("#company_01").selectpicker('refresh');
						
						$("#company_02").html(re[2]);
						$("#company_02").selectpicker('refresh');
						
						$("#company_03").html(re[3]);
						$("#company_03").selectpicker('refresh');
					}else{}
				}
			});
			*/
		} else {
			//no
		}
	}else if(val=='후기1'){
		var result = confirm('해당 후기를 신고하시겠습니까?');
		if(result) {
		   alert('신고되었습니다. 관리자 확인 후 처리예정입니다. 감사합니다.');
		} else {}
	}else if(val=='Q&A1'){
		var result = confirm('해당 질문을 신고하시겠습니까?');
		if(result) {
		   alert('신고되었습니다. 관리자 확인 후 처리예정입니다. 감사합니다.');
		} else {}

	}else if(val=='모임2'){
		var result = confirm('해당 사용자를 차단하시겠습니까?');

		if(result) {
		   alert('관리자 확인 후 처리예정입니다. 감사합니다.');
		} else {}
	}else if(val=='후기2'){
		var result = confirm('해당 사용자를 차단하시겠습니까?');

		if(result) {
		   alert('관리자 확인 후 처리예정입니다. 감사합니다.');
		} else {}
	}else if(val=='Q&A2'){
		var result = confirm('해당 사용자를 차단하시겠습니까?');

		if(result) {
		   alert('관리자 확인 후 처리예정입니다. 감사합니다.');
		} else {}
	}else{
	}
}
</script>
<!--신고버튼-->
<div class="item-wrap container grid-lg" >

	<?php echo $it_head_html; // 상단 HTML; ?>

	<?php
	// ***********************************************
	// 모임시간   2019-09-05 추가
	// **********************************************
	include_once $item_skin_path."/item.class.timelist.php";
	$view = get_bbs($it['it_2']);

		// 이미지 상단 출력

	 ?>

	<div class="class-info columns col-gapless pay_area">

		<div class="column col-8 col-md-12" style="display:none;">

		<?php if($item_icon) { ?>
			<div class="label-tack"><?php echo $item_icon; ?></div>
		<?php } ?>
		<?php if(false && $dc) {?>
			<div class="label-band bg-red">DC</div>
		<?php } else if($new) {?>
			<div class="label-band bg-blue">New</div>
		<?php } ?>

		<ul class="tab none">
			<li class="tab-item active" data-tabname="tab-info">
				<a href="#class-info">모임 설명</a>
			</li>
			<li class="tab-item" data-tabname="tab-career">
				<a href="#teacher-career">호스트 정보</a>
			</li>
			<li class="tab-item" data-tabname="tab-attention">
				<a href="#class-attention">주의사항</a>
			</li>
			<?php /* <li class="tab-item">
				<a href="#review">모임 후기</a>
			</li> */?>
		</ul>

		<div class="tab-content" data-tabname-content="tab-info none" >

			<h4>모임 소개</h4>
			<p>
				<div itemprop="description" class="view-content">
					<?php echo get_view_thumbnail($view['content']); ?>
				</div>
			</p>

			<h4>호스트 소개</h4>
			<?php
			$mb = apms_member($data['mb_id']);
			?>
			<p>
				<?php
				if ($mb['mb_signature']) {
					echo nl2br(stripcslashes($mb['mb_signature']));
				}
				?>
			</p>
			<?php //echo latest("portfolio", "portfolio", 9, 25); ?>
			<?php echo latest_writer("portfolio", "portfolio", $mb['mb_id'], 9, 25); ?>

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

		<div class="tab-content none" data-tabname-content="tab-career" >
			<h4>주요 정보</h4>
			<p><?php
				if ($mb['mb_profile']) {
					echo nl2br(stripcslashes($mb['mb_profile']));
				}
				?>
			</p>
		</div>

		<div class="tab-content none" data-tabname-content="tab-attention">
			<?php include_once 'caution.php' ?>
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
			<div class="panel" >
			<?php
			$pt = get_member($it['pt_id']);
			?>

			<div id="buy_form none" class="text">
				<div class="panel-header text-center none" >
				<figure class="avatar avatar-lg">
					<?php if ($mb['photo']) {
					echo "<img src='{$mb['photo']}' />";
				} ?>
				</figure>
				<div class="panel-title none">
					<strong><?php echo $pt['mb_name'];?></strong>
					<em><?php echo $pt['mb_nick'];?></em>
				</div>
			</div>
			<div class="panel-body">
				<div class="arrow_top">
					<a>
						<svg class="transforem" xmlns="http://www.w3.org/2000/svg" width="38.07" height="19.742" viewBox="0 0 38.07 19.742">
						<path id="패스_20160" data-name="패스 20160" d="M-13998-18866.35l18.328-18.328,18.328,18.328" transform="translate(13998.707 18885.385)" fill="none" stroke="#707070" stroke-linecap="round" stroke-width="1"/>
					</svg>
					</a>
				</div>
				<dl class="panel_layout">
					<dt style="font-size:12px;">모임일시</dt>
					<dd style="font-size:12px;"><?php echo $it['day'] ? date('Y-m-d', strtotime($it['day'])) . ' ' . $it['time'] . ':' . $it['minute'] : ''; ?></dd>
					<dt style="font-size:12px;">주제</dt>
					<dd style="font-size:12px;"><?php echo stripslashes($it['it_name']); // 상품명 ?></dd>
					<dt style="font-size:12px;">참가료</dt>
					<dd style="font-size:12px;"><strike><?php echo  $cur_price;?></strike></dd>
					<dt style="font-size:12px;">할인률</dt>
					<dd style="font-size:12px;">
						<?php echo 100 - floor(($it['it_price'] / $it['it_cust_price']) * 100);?>%
					</dd>
                    <dt style="font-size:12px;">총 비용</dt>
                    <dd style="font-size:12px;color:red;">
                        <?php echo number_format($it['it_price']);?>원
                    </dd>
				</dl>
				<div class="panel-desc none " ><?php echo nl2br(stripcslashes($it['it_6'])); ?></div>
			</div>

			<div class="price font-16 en">
				<?php if (false && $it['it_use_avg']) { ?>
					<div class="pull-right">
						<span class="font-20 <?php echo $wset['istar'];?>"><?php echo apms_get_star($it['it_use_avg']); //평균별점 ?></span>
					</div>
				<?php } ?>

				<div class="clearfix"></div>
			</div>

			<div id="item_option">
				<table class="table option-tbl">
				<tbody>

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
					<div id="it_sel_option none" >
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
									<div class="row none" >
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
				<div class="panel-footer" style="padding-top:0 !important;;">
				<?php 
				$aplystatus = checkAbleClassAply($it['it_id']);
				//secho "'".$aplystatus."'<br>";
				if ( $aplystatus) { ?>
				<div class="make_payment">
					<div class="pay">
						<p>예상비용</p>
						<p>
							<?php 
							if ($it['it_price'] > 0){
								if ($it['it_price'] == $it['it_cust_price']){
									echo number_format($it['it_price']) . '원';
								}else{
									echo '<s>' . number_format($it['it_cust_price']) . '원</s><br>' . number_format($it['it_price']) . '원';
								}
							}else{
								echo "무료";
							}
							?>
						</p>
					</div>
                    <?php if(number_format($data['wr_2']) > getMoimAdmitApplyCountIt($it['it_id'])) { ?>
                        <button class="btn btn-primary btn-lg btn-block application"  onclick="document.pressed=this.value;" value="바로구매">결제하기</button>
                    <?php } else { ?>
                        <button type="button" class="btn btn-lg btn-block application" onclick="alert('인원이 초과 되었습니다.');" disabled>마감</button>
                    <?php } ?>
				</div>
				<?php } ?>
				<?php //echo (chk_wishcnt($it['it_id'],$member['mb_id']))?'Y':'N';?>
				<div class="btn-group btn-group-block">
					<button class="btn" onClick="apms_wishlist('<?php echo $it['it_id']; ?>'); return false;">
						<i class="typcn typcn-flag"></i>
						<span>찜</span>
						<em><?php echo get_wishcnt($it['it_id']);?></em>
					</button>
					<button class="btn" onclick="document.pressed=this.value;" value="장바구니" >
						<i class="typcn typcn-shopping-cart"></i>
						<span>장바구니</span>
					</button>
				</div>
			</div>
				<div class="sns-icon pull-right">

				<div class="sns-share-icon none" style=";padding:15px;border:0.1px solid #AAA;margin-left:10px;margin-right:10px" >
					<?php
						$sns_url  = G5_SHOP_URL.'/item.php?it_id='.$it_id;
						$sns_title = get_text($it['it_name'].' | '.$config['cf_title']);
						$sns_img = $item_skin_url.'/img';
                    echo  get_sns_share_link('facebook', $sns_url, $sns_title, $sns_img.'/sns/facebook.png').' ';
                    echo  get_sns_share_link('twitter', $sns_url, $sns_title, $sns_img.'/sns/twtitter.png').' ';
                    echo  get_sns_share_link('googleplus', $sns_url, $sns_title, $sns_img.'/sns/googleplus.png').' ';
                    echo  get_sns_share_link('kakaostory', $sns_url, $sns_title, $sns_img.'/sns/kakaostory.png').' ';
                    echo  get_sns_share_link('kakaotalk', $sns_url, $sns_title, $sns_img.'/sns/kakaotalk.png').' ';
                    echo  get_sns_share_link('naverband', $sns_url, $sns_title, $sns_img.'/sns/naverband.png').' ';
					?>
				</div>
			</div>

			</div>
            <script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=7f658734584879ca284ed00f717e81a1&libraries=services"></script>
            <script>
                var mapContainer = document.getElementById('map'), // 지도를 표시할 div
                    mapOption = {
                        center: new kakao.maps.LatLng(33.450701, 126.570667), // 지도의 중심좌표
                        level: 3 // 지도의 확대 레벨
                    };

                // 지도를 생성합니다
                var map = new kakao.maps.Map(mapContainer, mapOption);

                var mapTypeControl = new kakao.maps.MapTypeControl();

                // 지도에 컨트롤을 추가해야 지도위에 표시됩니다
                // kakao.maps.ControlPosition은 컨트롤이 표시될 위치를 정의하는데 TOPRIGHT는 오른쪽 위를 의미합니다
                map.addControl(mapTypeControl, kakao.maps.ControlPosition.TOPRIGHT);

                // 지도 확대 축소를 제어할 수 있는  줌 컨트롤을 생성합니다
                var zoomControl = new kakao.maps.ZoomControl();
                map.addControl(zoomControl, kakao.maps.ControlPosition.RIGHT);

                // 주소-좌표 변환 객체를 생성합니다
                var geocoder = new kakao.maps.services.Geocoder();

                // 주소로 좌표를 검색합니다
                geocoder.addressSearch('<?php echo $it['moa_addr1']; ?>', function(result, status) {
                    // 정상적으로 검색이 완료됐으면
                    if (status === kakao.maps.services.Status.OK) {

                        var coords = new kakao.maps.LatLng(result[0].y, result[0].x);

                        // 결과값으로 받은 위치를 마커로 표시합니다
                        var marker = new kakao.maps.Marker({
                            map: map,
                            position: coords
                        });

                        // 지도의 중심을 결과값으로 받은 위치로 이동시킵니다
                        map.setCenter(coords);
                    }
                });
            </script>

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



					// if (document.pressed == "장바구니") {
					// 	f.sw_direct.value = 0;
					// } else { // 바로구매
					// 	f.sw_direct.value = 1;
					// }
					f.sw_direct.value = 1;

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

			</script>

		</div>



		</div>
	</form>
	</div>

</div>

<div class="h20" id="review"></div>

<div class="total-panel none" >

<?php if ($is_relation) { ?>
	<div class="panel panel-default panel-review">
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
<div class="panel panel-default panel-review">
	<div class="panel-heading">
		<h3 class="panel-title"><i class="fa fa-camera"></i> <span class="font-18"><?php echo $it_use_cnt;?></span> 개의 후기가 있네요.</h3>
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
<div class="panel panel-default panel-review">
	<div class="panel-heading">

		<h3 class="panel-title"><i class="fa fa-comments-o"></i> <span class="font-18"><?php// echo $it_qa_cnt;?></span> 질문있습니다!</h3>

	</div>
	<div class="panel-body" style="padding-bottom:0px;">
		<div id="itemqa">
			<?php include_once('./itemqa.php'); ?>
		</div>
	</div>
</div>

<?php if(false && $is_comment) { ?>
	<div id="icv"></div>
	<div class="panel panel-default panel-review">
		<div class="panel-heading">
			<h3 class="panel-title"><i class="fa fa-commenting"></i> <span class="font-18"><?php echo $it_comment_cnt;?></span> Comments</h3>
		</div>
		<div class="panel-body">
			<?php include_once('./itemcomment.php'); ?>
		</div>
	</div>
<?php } ?>
</div>


<p><a href="#?w=690" rel="popup1" class="poplight none" >___</a></p>
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

// 펼치기 
$(function() {
	$('.panel_layout').hide();
	$('.arrow_top > a').click(function(){
		$('.panel_layout').slideToggle(500);
		$('.panel_layout').css('display', 'flex');
		$('.arrow_top > a > svg').toggleClass('transform');
	});
});
</script>


<?php include_once('./itemlist.php'); // 분류목록 ?>

