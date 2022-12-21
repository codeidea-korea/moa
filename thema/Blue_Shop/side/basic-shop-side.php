<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가 

// 위젯 대표아이디 설정
$wid = 'SSB';

// 게시판 제목 폰트 설정
$font = 'font-16 en';

// 게시판 제목 하단라인컬러 설정 - red, blue, green, orangered, black, orange, yellow, navy, violet, deepblue, crimson..
$line = 'navy';

?>
<style>
	.widget-side .div-title-underbar { margin-bottom:15px; }
	.widget-side .div-title-underbar span { padding-bottom:4px; }
	.widget-side .div-title-underbar span b { font-weight:500; }
	.widget-box { margin-bottom:25px; background-color: #fff;}
</style>

<div class="widget-side">

	<?php if(!G5_IS_MOBILE) { //PC일 때만 출력 ?>
		<div class="hidden-sm hidden-xs view-colorset2">
			<!-- 로그인 시작 -->
			<div class="div-title-underbar">
				<span class="div-title-underbar-bold border-<?php echo $line;?> <?php echo $font;?>">
					<b><?php echo ($is_member) ? 'Profile' : 'Login';?></b>
				</span>
			</div>

			<div class="widget-box">
				<?php echo apms_widget('basic-outlogin'); //외부로그인 ?>
			</div>
			<!-- 로그인 끝 -->
		</div>
	<?php } ?>

	<div class="row">
		<div class="col-md-12 col-sm-6">

			<!-- 아이콘 시작 -->
			<div class="view-colorset2">
				<div class="div-title-underbar">
					<span class="div-title-underbar-bold border-<?php echo $line;?> <?php echo $font;?>">
						<b>Service</b>
					</span>
				</div>

				<div class="widget-box">
					<?php echo apms_widget('basic-shop-icon'); ?>
				</div>
			</div>
			<!-- 아이콘 끝 -->

			<!-- 이벤트 시작 -->
			<div class="view-colorset2">
				<div class="div-title-underbar">
					<a href="<?php echo $at_href['event'];?>">
						<span class="pull-right lightgray <?php echo $font;?>">+</span>
						<span class="div-title-underbar-bold border-<?php echo $line;?> <?php echo $font;?>">
							<b>Event</b>
						</span>
					</a>
				</div>
				<div class="widget-box">
					<?php echo apms_widget('basic-shop-event-slider', $wid.'-ws1', 'caption=1 nav=1 sm=2', 'auto=0'); ?>
				</div>
			</div>
			<!-- 이벤트 끝 -->	

			<!-- 이벤트 시작 -->
			<div class="view-colorset2" style="padding:5px;">
				<!--<div class="div-title-underbar">
					<a href="<?php echo $at_href['event'];?>">
						<span class="pull-right lightgray <?php echo $font;?>">+</span>
						<span class="div-title-underbar-bold border-<?php echo $line;?> <?php echo $font;?>">
							<b>Banner</b>
						</span>
					</a>
				</div>-->
				<div class="widget-box" style="margin-bottom:0px;">
					<?php echo apms_widget('basic-banner', 'side_banner');?>
				</div>
			</div>
			<!-- 이벤트 끝 -->	

			<!-- 알림 시작 -->
				<div class="view-colorset2">
				<div class="div-title-underbar">
					<a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=basic">
						<span class="pull-right lightgray <?php echo $font;?>">+</span>
						<span class="div-title-underbar-bold border-<?php echo $line;?> <?php echo $font;?>">
							<b>Notice</b>
						</span>
					</a>
				</div>
				<div class="widget-box">
					<?php echo apms_widget('basic-post-list', $wid.'-ws2', 'icon={아이콘:bell} date=1 strong=1,2'); ?>
				</div>
			</div>
			<!-- 알림 끝 -->		
	
		</div>
		<div class="col-md-12 col-sm-6">

			<!-- 후기 시작 -->
			<div class="view-colorset2">
				<div class="div-title-underbar">
					<a href="<?php echo $at_href['iuse'];?>">
						<span class="pull-right lightgray <?php echo $font;?>">+</span>
						<span class="div-title-underbar-bold border-<?php echo $line;?> <?php echo $font;?>">
							<b>Review</b>
						</span>
					</a>
				</div>
				<div class="widget-box">
					<?php echo apms_widget('basic-shop-post', $wid.'-ws3', 'mode=use icon={아이콘:star} star=red new=blue strong=1,2'); ?>
				</div>
			</div>
			<!-- 후기 끝 -->

			<!-- 문의 시작 -->
			<div class="view-colorset2">
				<div class="div-title-underbar">
					<a href="<?php echo $at_href['iqa'];?>">
						<span class="pull-right lightgray <?php echo $font;?>">+</span>
						<span class="div-title-underbar-bold border-<?php echo $line;?> <?php echo $font;?>">
							<b>Q & A</b>
						</span>
					</a>
				</div>
				<div class="widget-box">
					<?php echo apms_widget('basic-shop-post', $wid.'-ws4', 'mode=qa icon={아이콘:user} new=green strong=1,2'); ?>
				</div>
			</div>
			<!-- 문의 끝 -->

			<!-- 댓글 시작 -->
			<div class="view-colorset2">
				<div class="div-title-underbar">
					<span class="div-title-underbar-bold border-<?php echo $line;?> <?php echo $font;?>">
						<b>Comment</b>
					</span>
				</div>
				<div class="widget-box">
					<?php echo apms_widget('basic-shop-post', $wid.'-ws5', 'mode=comment icon={아이콘:comment} strong=1'); ?>
				</div>
			</div>
			<!-- 댓글 끝 -->

		</div>
	</div>

	<!-- 배너 시작 -->
	<div class="view-colorset2">
		<div class="div-title-underbar">
			<span class="div-title-underbar-bold border-<?php echo $line;?> <?php echo $font;?>">
				<b>Banner</b>
			</span>
		</div>
		<div class="widget-box">
			<?php echo apms_widget('basic-shop-banner-slider', $wid.'-ws6', 'nav=1 md=3 sm=2 xs=2', 'auto=0'); ?>
		</div>
	</div>
	<!-- 배너 끝 -->

	<!-- 고객센터 시작 -->
	<div class="view-colorset2">
		<div class="div-title-underbar">
			<a href="<?php echo $at_href['secret'];?>">
				<span class="pull-right lightgray <?php echo $font;?>">+</span>
				<span class="div-title-underbar-bold border-<?php echo $line;?> <?php echo $font;?>">
					<b>CS Center</b>
				</span>
			</a>
		</div>
		<div class="widget-box">
			<div class="en red font-24">
				<i class="fa fa-phone"></i> <b>070.7137.5222</b>
			</div>

			<div class="h10"></div>

			<div class="help-block">
				월-금 : 10:30 ~ 18:30, 토/일/공휴일 휴무
				<br>
				런치타임 : 13:00 ~ 14:00
			</div>
			<h4>Bank Info</h4>
			<div class="help-block">
				신한은행 140-011-619385
				<!--<br>
				기업은행 000-000000-00-000-->
			</div>
			예금주 (주)아미나블루

		</div>
	</div>
	<!-- 고객센터 끝 -->

	<!-- SNS아이콘 시작 -->
	<div class="view-colorset2">
		<div class="widget-box text-center">
			<?php echo $sns_share_icon; // SNS 공유아이콘 ?>
		</div>
	</div>
	<!-- SNS아이콘 끝 -->

</div>