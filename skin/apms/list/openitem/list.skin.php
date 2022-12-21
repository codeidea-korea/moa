<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

// 버튼
$btn1 = (isset($wset['btn1']) && $wset['btn1']) ? $wset['btn1'] : 'navy';
$btn2 = (isset($wset['btn2']) && $wset['btn2']) ? $wset['btn2'] : 'color';

// 메이슨리는 기본
apms_script('imagesloaded');
apms_script('masonry');

// 썸네일
$wset['thumb_w'] = (isset($wset['thumb_w']) && $wset['thumb_w'] > 0) ? $wset['thumb_w'] : 400;
$wset['thumb_h'] = (isset($wset['thumb_h']) && ($wset['thumb_h'] > 0 || $wset['thumb_h'] == "0")) ? $wset['thumb_h'] : 500;

// 기본 스타일
if(!isset($wset['more']) || !$wset['more']) {
	$wset['more'] = 1;
}

$is_more = ($wset['more'] != "3") ? $wset['more'] : 0;

// 링크설정
$qstr = '';
if($is_event) $qstr .= '&amp;lm=ev';
if($ev_id) $qstr .= '&amp;ev_id='.$ev_id;
if($ca_id) $qstr .= '&amp;ca_id='.$ca_id;
if($type) $qstr .= '&amp;type='.$type;
if($sort) $qstr .= '&amp;sort='.$sort;
if($sortodr) $qstr .= '&amp;sortodr='.$sortodr;
if($etype) $qstr .= '&amp;etype='.$etype;
if($eimg) $qstr .= '&amp;eimg='.$eimg;

if($is_more) {
	// 무한스크롤
	apms_script('infinite');

	$npg = ($page > 1) ? ($page - 1) : 0;
	$more_href = $list_skin_url.'/list.rows.php?lt='.urlencode(THEMA);
	$more_href .= '&amp;ls='.urlencode($ls);
	$more_href .= $qstr;
	$more_href .= '&amp;npg='.$npg;
	$more_href .= '&amp;page=2';
}

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$list_skin_url.'/style.css" media="screen">', 0);

// 글내용 높이
if($wset['thumb_h'] > 0) {
	$img_h = apms_img_height($wset['thumb_w'], $wset['thumb_h']);
	$wset['line'] = (isset($wset['line']) && $wset['line'] > 0) ? $wset['line'] : 3;
	$line_height = 20 * $wset['line'];
	if($line_height) $line_height = $line_height + 14;
}

$widget_id = 'item_list'; // Random ID

?>

<div class="container grid-xl">
	
	<?php if(!$_main) include_once($list_skin_path.'/category.skin.php'); //분류 ?>
	
	<div id="<?php echo $widget_id;?>" class="class-list columns">
		<?php include($list_skin_path.'/list.rows.php'); ?>
		<div class="clearfix"></div>
		<?php if(!$list_cnt) { ?>
			<div class="well list-none">
				등록된 상품이 없습니다.
			</div>
		<?php } ?>
		<?php if($is_more) { ?>
			<div id="<?php echo $widget_id;?>-nav" class="item-nav">
				<a href="<?php echo $more_href;?>"></a>
			</div>
			<?php if(false && $is_more == "1") { ?>
				<button type="button" id="<?php echo $widget_id;?>-more" class="btn btn-more btn-lg btn-block">수업 더보기</button>
			<?php } ?>
		<?php } ?>
	</div>
	<div class="list-page text-center">
		<div class="pull-left">
			<ul class="pagination pagination-sm en no-margin">
				<?php //echo apms_paging($write_pages, $page, $total_page, $list_page); ?>
			</ul>
			<div class="clearfix"></div>
		</div>
		<div class="pull-right">
			<div class="btn-group">
				<?php if ($is_event) { ?>
					<a class="btn btn-<?php echo $btn2;?> btn-sm" href="./event.php"><i class="fa fa-gift"></i> 이벤트</a>
				<?php } ?>
				<?php
				if (!$is_main && $member['as_partner'] > 2) {
					$write_href=G5_BBS_URL."/write.php?bo_table=class";
				}
				else
					$write_href ="";
				 if ($write_href) { ?>
					<a class="btn btn-<?php echo $btn1;?> btn-sm" href="<?php echo $write_href;?>"><i class="fa fa-upload"></i> 등록</a>
				<?php } ?>
				<?php if ($admin_href) { ?>
					<a class="btn btn-<?php echo $btn1;?> btn-sm" href="<?php echo $admin_href;?>"><i class="fa fa-th-large"></i> 관리</a>
				<?php } ?>
				<?php if ($config_href) { ?>
					<a class="btn btn-<?php echo $btn1;?> btn-sm" href="<?php echo $config_href;?>"><i class="fa fa-cog"></i> 설정</a>
				<?php } ?>
				<?php if($setup_href) { ?>
					<a class="btn btn-<?php echo $btn1;?> btn-sm win_memo" href="<?php echo $setup_href;?>"><i class="fa fa-cogs"></i> 스킨설정</a>
				<?php } ?>
				<?php if (false && $rss_href) { ?>
					<a class="btn btn-<?php echo $btn2;?> btn-sm" title="카테고리 RSS 구독하기" href="<?php echo $rss_href;?>" target="_blank"><i class="fa fa-rss fa-lg"></i></a>
				<?php } ?>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
</div>
<script>
	$(function(){
		var $<?php echo $widget_id;?> = $('#<?php echo $widget_id;?> .item-wrap');
		$<?php echo $widget_id;?>.imagesLoaded(function(){
			$<?php echo $widget_id;?>.masonry({
				columnWidth : '.item-row',
				itemSelector : '.item-row',
				percentPosition: true,
				isAnimated: true
			});
		});
		<?php if($is_more) { ?>
		$<?php echo $widget_id;?>.infinitescroll({
			navSelector  : '#<?php echo $widget_id;?>-nav', 
			nextSelector : '#<?php echo $widget_id;?>-nav a',
			itemSelector : '.item-row', 
			loading: {
				msgText: '로딩 중...',
				finishedMsg: '더이상 상품이 없습니다.',
				img: '<?php echo APMS_PLUGIN_URL;?>/img/loader.gif',
			}
		}, function( newElements ) {
			var $newElems = $( newElements ).css({ opacity: 0 });
			$newElems.imagesLoaded(function(){
				$newElems.animate({ opacity: 1 });
				$<?php echo $widget_id;?>.masonry('appended', $newElems, true);
			});
		});
		<?php if($is_more == "1") { ?>
		$(window).unbind('#<?php echo $widget_id;?> .infscr');
		$('#<?php echo $widget_id;?>-more a').click(function(){
		   $<?php echo $widget_id;?>.infinitescroll('retrieve');
		   $('#<?php echo $widget_id;?>-nav').show();
			return false;
		});
		$(document).ajaxError(function(e,xhr,opt){
			if(xhr.status==404) $('#<?php echo $widget_id;?>-nav').remove();
		});
		<?php } ?>
		<?php } ?>
		$(".sidebar-toggle").on('click', function(){
			setTimeout(function(){ $<?php echo $widget_id;?>.masonry('layout'); }, 500);
		});
		$(".main-sidebar").on('hover', function(){
			setTimeout(function(){ 
				$(".sidebar-expanded-on-hover .main-sidebar").mouseover(function() { 
					$<?php echo $widget_id;?>.masonry('layout');
				}).mouseout(function() { 
					setTimeout(function(){ $<?php echo $widget_id;?>.masonry('layout'); }, 500);
				});
			}, 500);
		});
	});
</script>
