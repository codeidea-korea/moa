<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

$icolor = (isset($wset['icolor']) && $wset['icolor']) ? $wset['icolor'] : 'navy';

// 헤더
$header_skin = (isset($wset['header_skin']) && $wset['header_skin']) ? $wset['header_skin'] : 'basic';
if($header_skin != 'none') {
	$page_name = (isset($wset['title']) && $wset['title']) ? $wset['title'] : '이벤트';
	$header_color = (isset($wset['header_color']) && $wset['header_color']) ? $wset['header_color'] : 'navy';
	include_once('./header.php');
}

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$skin_url.'/style.css" media="screen">', 0);

$event_cnt = count($event);

for($i=0; $i < $event_cnt; $i++) { 
?>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">
				<a href="<?php echo $event[$i]['ev_href'];?>">
					<i class="fa fa-gift fa-lg <?php echo $icolor;?>"></i>
					<?php echo $event[$i]['ev_subject'];?>
				</a>
			</h3>
		</div>
		<div class="panel-body">
			<a href="<?php echo $event[$i]['ev_href'];?>">
				<img src="<?php echo $event[$i]['ev_banner'];?>" alt="<?php echo $event[$i]['ev_subject'];?>" class="ev-img">
			</a>
		</div>
	</div>
<?php } ?>
<?php if(!$event_cnt) { ?>
	<div class="ev-none">진행 중인 이벤트가 없습니다.</div>
<?php } ?>

<div class="ev-page text-center">
	<ul class="pagination pagination-sm no-margin en">
		<?php echo apms_paging($write_pages, $page, $total_page, $list_page); ?>
	</ul>
	<div class="clearfix"></div>
</div>

<?php if ($is_admin || $setup_href || $admin_href) { ?>
	<div class="h20"></div>
	<div class="text-center">
		<div class="btn-group">
			<?php if ($admin_href) { ?>
				<a class="btn btn-navy btn-sm" href="<?php echo $admin_href;?>"><i class="fa fa-th-large"></i> 관리</a>
			<?php } ?>
			<?php if($is_admin) { ?>
				<a class="btn btn-navy btn-sm" href="<?php echo G5_ADMIN_URL;?>/apms_admin/apms.admin.php?ap=thema"><i class="fa fa-cog"></i> 설정</a>
			<?php } ?>
			<?php if ($setup_href) { ?>
				<a class="btn btn-red btn-sm win_memo" href="<?php echo $setup_href;?>"><i class="fa fa-cogs"></i> 스킨설정</a>
			<?php } ?>
		</div>
	</div>
<?php } ?>