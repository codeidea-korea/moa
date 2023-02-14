<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
?>
<link rel="stylesheet" href="<?php echo $skin_url;?>/assets/css/morris.css">
<script src="<?php echo $skin_url;?>/assets/js/raphael-min.js"></script>
<script src="<?php echo $skin_url;?>/assets/js/morris.min.js"></script>



<section id="main">
	
	<div class="section-title">내 정보</div>
<?php //print_r3($partner);?>
	<div class="flex gap20 flex-stretch" style="max-width:1500px;">
		<div class="boxContainer flex flex-top span650">
			<!--<div class="main-profile-thumb no-img" style=""></div> //이미지가 없을때 -->
			<div class="main-profile-thumb">
                <!-- 2022.09.06. botbinoo, 프로필 이미지 수정 안되는 오류(리소스 캐싱 문제) -->
                <!--  <?php echo ($member['photo']) ? '<img src="'.$member['photo'].'" alt="" width="100%">' : '<span class="no-img"></span>'; ?> -->
                <?php echo ($member['photo']) ? '<img src="'.$member['photo'].'?v='.time().'" alt="" width="100%">' : '<span class="no-img"></span>'; ?>
                <!-- end 2022.09.06. botbinoo, 프로필 이미지 수정 안되는 오류(리소스 캐싱 문제) -->
            </div>
			<div class="main-profile-con">
				<div class="header">
					<span class="name"><?php echo $partner['pt_name'];?> 님</span>
<!--					<span class="mb-tag super-host">슈퍼 호스트</span>-->
<!--					<span class="mb-tag super-host">슈퍼 호스트</span>-->
<!--					<span class="mb-tag super-guest">슈퍼 게스트</span>-->
<!--					<span class="mb-tag guest">일반 게스트</span>-->
					<span class="mb-tag host">호스트</span>
					<p class="fs12 color-gray mt5">초대코드 : <?php echo $member['invite_code'];?></p>
				</div>
				<div class="con">
					<?php echo nl2br($partner['pt_memo']);?>
				</div>
				<div class="btnSet tleft">
					<a href="/shop/partner/?ap=register_form" class="btn gray span150">내 정보 수정</a>
					<a href="/shop/partner/?ap=moa_write" class="btn span160">모임 등록하기</a>
				</div>
			</div>
		</div>
        <?php $count = getDashBoardInfo($partner['pt_id']);?>
		<div class="flex1 flex gap20 column">
			<div class="flex flex1 gap20 flex-stretch">
				<div class="boxContainer flex1 flexCenter column">
					<span class="h2 mainColor mb15"><?php echo $count['moa_count'] ? $count['moa_count'] : 0; ?></span>
					<span class="fs16 color-gray noto500">이번 달 진행모임</span>
				</div>
				<div class="boxContainer flex1 flexCenter column">
					<span class="h2 mainColor mb15"><?php echo $count['moa_use'] ? $count['moa_use'] : 0; ?></span>
					<span class="fs16 color-gray noto500">내 모임 후기</span>
				</div>
				<div class="boxContainer flex1 flexCenter column">
					<span class="h2 mainColor mb15"><?php echo $count['moa_use_star'] ? $count['moa_use_star'] : 0; ?></span>
					<span class="fs16 color-gray noto500">평균 모임 별점</span>
				</div>
				<div class="boxContainer flex1 flexCenter column">
					<span class="h2 mainColor mb15"><?php echo $count['answer_rate'] ? number_format($count['answer_rate'],0) : 0; ?>%</span>
					<span class="fs16 color-gray noto500">QnA 응답률</span>
				</div>
			</div>
			<div class="flex flex1 gap20 flex-stretch">
				<!-- <div class="boxContainer flex1">
					<div class="flex flex-middle">
						<span class="fs16 color-gray noto500">사용된 포인트</span>
						<span class="right fs22 bold"><?php echo $count['thismonth_point'] ? number_format($count['thismonth_point']) : 0; ?> P</span>
					</div>
					<hr>
					<div class="flex flex-middle">
						<span class="fs16 color-gray noto500">사용된 쿠폰 금액</span>
						<span class="right fs22 bold"><?php echo $count['thismonth_point'] ? number_format($count['thismonth_point']) : 0; ?>원</span>
					</div>
				</div> -->
				<div class="boxContainer flex1">
					<div class="flex flex-middle">
						<span class="fs16 color-gray noto500">이번 달 매출액</span>
						<span class="right fs22 bold"><?php echo $count['thismonth_sales'] ? number_format($count['thismonth_sales']) : 0; ?>원</span>
					</div>
					<hr>
					<div class="flex flex-middle">
						<span class="fs16 color-gray noto500">전체 매출액</span>
						<span class="right fs22 bold"><?php echo $count['total_sales'] ? number_format($count['total_sales']) : 0; ?>원</span>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="mt60"></div>

	<div class="flex gap25 flex-stretch" style="max-width:1500px;">
		<div class="flex1">
			<div class="section-title">
				공지사항
				<div class="rightSet none"><a href="#" class="more">더보기</a></div>
			</div>
			<div class="boxContainer">
				
				<div class="tbl-basic  td-h6">
					<table>
						<colgroup>
							<col width="220">
							<col>
						</colgroup>
						<thead>
							<tr>
								<th class="tleft">등록일</th>
								<th class="tleft">게시글 제목</th>
							</tr>
						</thead>
						<tbody>
                        <?php $notice = getListNotice();
                        $cnt = count($notice) < 10 ? count($notice) : 10;
                        for($i=0;$i<$cnt;$i++) { ?>
							<tr>
								<td class="tleft"><span class="date"><?php echo date('Y-m-d H:i', strtotime($notice[$i]['regdate'])); ?></span></td>
								<td class="subject"><a href="/shop/partner/bbs/board.php?bo_table=notice&wr_id=<?php echo $notice[$i]['wr_id']; ?>"><?php echo $notice[$i]['SUBJECT']; ?></a></td>
							</tr>
                        <?php } ?>
						</tbody>
					</table>
				</div>
                <div class="btnSet mt20">
                    <a href="/shop/partner/?ap=moa_list&bo_table=notice" class="btn small color-white">전체보기<i class="ml5 arrow-right"></i></a>
                </div>
			</div>
		</div>
		<div class="span320 flex gap5 column">
			<div class="section-title">고객센터</div>
			<div class="boxContainer flex1">
<!--				<a href="#" class="btn reverse gray span chat-link"  data-mb_id="admin">1:1 실시간 상담</a> -->
				<a href="/c_my/my_service_center02.php" class="btn reverse gray span mt10">문의 상담</a>
				<div class="span tcenter" style="position:absolute;bottom:30px;left:0;">
					<p class="fs18">고객센터 0000-0000</p>
					<p class="mt15 color-gray">
						평일오전 10시 - 오후6시<br>
						(점심시간 12: 30 ~ 13:30)
					</p>
				</div>
			</div>
		</div>
	</div>

</section>






<div class="none">

<?php if(IS_SELLER) { ?>
	<div class="dashboard-head">
		<a href="#" class="btn">포트폴리오 관리 바로가기</a>
	</div>
	<div class="row en font-14">
		<div class="col-lg-3 col-md-6">
			<div class="panel panel-info">
				<div class="panel-heading">
					<div class="row">
						<div class="col-sm-4 hidden-xs">
							<i class="fa fa-shopping-cart fa-5x"></i>
						</div>
						<div class="col-sm-8 col-xs-12 text-right">
							<p class="announcement-heading"><?php echo number_format($today_sales);?></p>
							<p class="announcement-text">오늘의 수강신청자</p>
						</div>
					</div>
				</div>
				<a href="./?ap=saleitem">
					<div class="panel-footer announcement-bottom">
						<div class="row">
							<div class="col-xs-6">
								등록 중인 강좌 정보
							</div>
							<div class="col-xs-6 text-right">
								<i class="fa fa-arrow-circle-right"></i>
							</div>
						</div>
					</div>
				</a>
			</div>
		</div>
		<div class="col-lg-3 col-md-6">
			<div class="panel panel-warning">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-4">
							<i class="fa fa-comment fa-5x"></i>
						</div>
						<div class="col-xs-8 text-right">
							<p class="announcement-heading"><?php echo number_format($today_comments);?></p>
							<p class="announcement-text">오늘의 반응</p>
						</div>
					</div>
				</div>
				<a href="./?ap=comment">
					<div class="panel-footer announcement-bottom">
						<div class="row">
							<div class="col-xs-6">
								유저들의 반응을 확인하세요.
							</div>
							<div class="col-xs-6 text-right">
								<i class="fa fa-arrow-circle-right"></i>
							</div>
						</div>
					</div>
				</a>
			</div>
		</div>
		<div class="col-lg-3 col-md-6">
			<div class="panel panel-danger">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-4">
							<i class="fa fa-question-circle fa-5x"></i>
						</div>
						<div class="col-xs-8 text-right">
							<p class="announcement-heading"><?php echo number_format($today_questions);?></p>
							<p class="announcement-text">오늘의 질문</p>
						</div>
					</div>
				</div>
				<a href="./?ap=qalist">
					<div class="panel-footer announcement-bottom">
						<div class="row">
							<div class="col-xs-6">
								질문은 가장 빠르게 답변해주세요!
							</div>
							<div class="col-xs-6 text-right">
								<i class="fa fa-arrow-circle-right"></i>
							</div>
						</div>
					</div>
				</a>
			</div>
		</div>
		<div class="col-lg-3 col-md-6">
			<div class="panel panel-success">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-4">
							<i class="fa fa-star fa-5x"></i>
						</div>
						<div class="col-xs-8 text-right">
							<p class="announcement-heading"><?php echo number_format($today_reviews);?></p>
							<p class="announcement-text">오늘의 리뷰</p>
						</div>
					</div>
				</div>
				<a href="./?ap=uselist">
					<div class="panel-footer announcement-bottom">
						<div class="row">
							<div class="col-xs-6">
								놓힌 리뷰는 없나요? 
							</div>
							<div class="col-xs-6 text-right">
								<i class="fa fa-arrow-circle-right"></i>
							</div>
						</div>
					</div>
				</a>
			</div>
		</div>
	</div><!-- /.row -->

	<div class="panel panel-primary">
		<div class="panel-heading">
			<a href="./?ap=salelist">
				<h3 class="panel-title white">
					<i class="fa fa-arrow-circle-right pull-right"></i>
					<i class="fa fa-line-chart"></i> 지난 30일간의 변화를 살펴보세요!
				</h3>
			</a>
		</div>
		<div class="panel-body">
			<div id="morris-chart-sales"></div>
		</div>
	</div>

	<script>
		Morris.Area({
		  // ID of the element in which to draw the chart.
		  element: 'morris-chart-sales',
		  // Chart data records -- each entry in this array corresponds to a point on
		  // the chart.
		  data: [
			<?php for ($i=0; $i < count($list); $i++) { ?>
			  { d: '<?php echo $list[$i]['date'];?>', sales: <?php echo $list[$i]['sale'];?> },
			<?php } ?>
		  ],
		  // The name of the data record attribute that contains x-visitss.
		  xkey: 'd',
		  // A list of names of data record attributes that contain y-visitss.
		  ykeys: ['sales'],
		  // Labels for the ykeys -- will be displayed when you hover over the
		  // chart.
		  labels: ['Sales'],
		  // Disables line smoothing
		  smooth: false,
		});
	</script>
<?php } ?>

<?php if(IS_MARKETER) { ?>
	<h1><i class="fa fa-database"></i> Marketer's Summary</h1>

	<div class="row en font-14">
		<div class="col-lg-3 col-md-6">
			<div class="panel panel-info">
				<div class="panel-heading">
					<div class="row">
						<div class="col-sm-4 hidden-xs">
							<i class="fa fa-database fa-5x"></i>
						</div>
						<div class="col-sm-8 col-xs-12 text-right">
							<p class="announcement-heading"><?php echo number_format($today_profit);?></p>
							<p class="announcement-text">Today's Profit</p>
						</div>
					</div>
				</div>
				<a href="./?ap=profititem">
					<div class="panel-footer announcement-bottom">
						<div class="row">
							<div class="col-xs-6">
								View Profit Items
							</div>
							<div class="col-xs-6 text-right">
								<i class="fa fa-arrow-circle-right"></i>
							</div>
						</div>
					</div>
				</a>
			</div>
		</div>
		<div class="col-lg-3 col-md-6">
			<div class="panel panel-warning">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-4">
							<i class="fa fa-fire fa-5x"></i>
						</div>
						<div class="col-xs-8 text-right">
							<p class="announcement-heading">Level <?php echo $partner['pt_level'];?></p>
							<p class="announcement-text">My Level</p>
						</div>
					</div>
				</div>
				<div class="panel-footer announcement-bottom">
					<div class="text-right">
						<i class="fa fa-fire"></i> Basic Profit × <?php echo number_format($partner['pt_level_benefit']);?>% Bonus
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-3 col-md-6">
			<div class="panel panel-danger">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-4">
							<i class="fa fa-gift fa-5x"></i>
						</div>
						<div class="col-xs-8 text-right">
							<p class="announcement-heading"><?php echo number_format($partner['pt_benefit']);?>%</p>
							<p class="announcement-text">My Incentive</p>
						</div>
					</div>
				</div>
				<div class="panel-footer announcement-bottom">
					<div class="text-right">
						<i class="fa fa-gift"></i> Basic Profit × <?php echo number_format($partner['pt_benefit']);?>% Bonus
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-3 col-md-6">
			<div class="panel panel-success">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-4">
							<i class="fa fa-cubes fa-5x"></i>
						</div>
						<div class="col-xs-8 text-right">
							<p class="announcement-heading"><?php echo number_format($partner['pt_level_benefit'] + $partner['pt_benefit']);?>%</p>
							<p class="announcement-text">Total Incentive</p>
						</div>
					</div>
				</div>
				<div class="panel-footer announcement-bottom">
					<div class="text-right">
						<i class="fa fa-cube"></i> Basic Profit × <?php echo number_format($partner['pt_level_benefit'] + $partner['pt_benefit']);?>% Bonus
					</div>
				</div>
			</div>
		</div>
	</div><!-- /.row -->

	<div class="panel panel-primary">
		<div class="panel-heading">
			<a href="./?ap=mlist">
				<h3 class="panel-title white">
					<i class="fa fa-arrow-circle-right pull-right"></i>
					<i class="fa fa-line-chart"></i> My Profit Statistics for 30 days
				</h3>
			</a>
		</div>
		<div class="panel-body">
			<div id="morris-chart-profit"></div>
		</div>
	</div>

	<script>
		Morris.Area({
		  // ID of the element in which to draw the chart.
		  element: 'morris-chart-profit',
		  // Chart data records -- each entry in this array corresponds to a point on
		  // the chart.
		  data: [
			<?php for ($i=0; $i < count($list2); $i++) { ?>
			  { d: '<?php echo $list2[$i]['date'];?>', profit: <?php echo $list2[$i]['profit'];?> },
			<?php } ?>
		  ],
		  // The name of the data record attribute that contains x-visitss.
		  xkey: 'd',
		  // A list of names of data record attributes that contain y-visitss.
		  ykeys: ['profit'],
		  // Labels for the ykeys -- will be displayed when you hover over the
		  // chart.
		  labels: ['Profit'],
		  // Disables line smoothing
		  smooth: false,
		});
	</script>
<?php } ?>

<?php if($notice) { // 전체 알림 ?>
	<div class="alert alert-success alert-dismissable">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<?php echo $notice;?>
	</div>
<?php } ?>

<div class="row">
  	<div class="col-md-6">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title"><i class="fa fa-calculator"></i> My Account</h3>
			</div>
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table" style="margin-bottom:13px;">
					<tbody>
					<tr class="active" style="font-weight:bold;">
						<td class="text-center" scope="col">상태</td>
						<td class="text-center" scope="col">신청일</td>
						<td class="text-center" scope="col">접수번호</td>
						<td class="text-center" scope="col">신청금액</td>
						<td class="text-center" scope="col">출금방법</td>
					</tr>
					<?php for ($i=0; $i < count($account); $i++) { ?>
						<tr>
							<td class="text-center"><?php echo $account[$i]['pp_confirm'];?></td>
							<td class="text-center"><?php echo $account[$i]['pp_date'];?></td>
							<td class="text-center"><?php echo $account[$i]['pp_no'];?></td>
							<td class="text-right"><?php echo number_format($account[$i]['pp_amount']);?></td>
							<td class="text-center"><?php echo $account[$i]['pp_means'];?></td>
						</tr>
					<?php } ?>
					<?php if ($i == 0) { ?>
						<tr><td colspan="5" class="text-center">등록된 자료가 없습니다.</td></tr>
					<?php } ?>
					</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title"><i class="fa fa-coffee"></i> My Information</h3>
			</div>
			<div class="panel-body">
				<div class="table-responsive" style="margin-bottom:0px;">
					<table class="table" style="margin-bottom:0px;">
					<tbody>
					<tr>
						<td>등록정보 : <?php echo $company_info; ?> 호스트</td>
					</tr>
					<tr>
						<td>담당정보 : <?php echo ($partner['pt_name']) ? $partner['pt_name'].' ('.$partner['pt_hp'].', '.$partner['pt_email'].')' : '미등록'; ?></td>
					</tr>
					<tr>
						<td>정산유형 : <?php echo ($partner['pt_company']) ? $partner['pt_company'] : '미등록'; ?></td>
					</tr>
					<tr>
						<td>정산방법 : <?php echo $account_info;?></td>
					</tr>
					<tr>
						<td>정산계좌 :
							<?php if($partner['pt_bank_name']) { ?>
								<?php echo $partner['pt_bank_name'];?>
								<?php echo $partner['pt_bank_account'];?>
								<?php echo $partner['pt_bank_holder'];?>
							<?php } else { ?>
								미등록
							<?php } ?>
						</td>
					</tr>
					</tbody>
					</table>

					<?php if($message) { // 메시지 ?>
						<div class="well" style="margin:10px 0px 0px;">
							<?php echo $message;?>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</div><!-- /.row -->


</div>