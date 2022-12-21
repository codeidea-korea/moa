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
if($ca_id) $qstr .= '&amp;ca_id='.$ca_id;
if($type) $qstr .= '&amp;type='.$type;
if($sort) $qstr .= '&amp;sort='.$sort;
if($sortodr) $qstr .= '&amp;sortodr='.$sortodr;

if($is_more) {
	// 무한스크롤
	apms_script('infinite');

	$npg = ($page > 1) ? ($page - 1) : 0;
	$more_href = $skin_url.'/list.rows.php?lt='.urlencode(THEMA);
	$more_href .= '&amp;ls='.urlencode($ls);
	$more_href .= '&amp;lm=type';
	$more_href .= $qstr;
	$more_href .= '&amp;npg='.$npg;
	$more_href .= '&amp;page=2';
}

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$skin_url.'/style.css" media="screen">', 0);

// 글내용 높이
if($wset['thumb_h'] > 0) {
	$img_h = apms_img_height($wset['thumb_w'], $wset['thumb_h']);
	$wset['line'] = (isset($wset['line']) && $wset['line'] > 0) ? $wset['line'] : 3;
	$line_height = 20 * $wset['line'];
	if($line_height) $line_height = $line_height + 14;
}

// 간격
$gap = (isset($wset['gap']) && ($wset['gap'] > 0 || $wset['gap'] == "0")) ? $wset['gap'] : 15;
$gapb = (isset($wset['gapb']) && ($wset['gapb'] > 0 || $wset['gapb'] == "0")) ? $wset['gapb'] : 15;

// 가로수
$item = (isset($wset['item']) && $wset['item'] > 0) ? $wset['item'] : 4;

$widget_id = 'item_type'; // Random ID

?>
<style>
	#<?php echo $widget_id;?> .item-wrap { margin-right:<?php echo $gap * (-1);?>px; margin-bottom:<?php echo $gapb * (-1);?>px; }
	#<?php echo $widget_id;?> .item-row { width:<?php echo apms_img_width($item);?>%; }
	#<?php echo $widget_id;?> .item-list { margin-right:<?php echo $gap;?>px; margin-bottom:<?php echo $gapb;?>px; }
	<?php if($wset['thumb_h'] > 0) { ?>
	#<?php echo $widget_id;?> .item-content { height:<?php echo $line_height;?>px; }
	#<?php echo $widget_id;?> .img-wrap { padding-bottom:<?php echo $img_h;?>%; }
	<?php } ?>
	<?php if(_RESPONSIVE_) { // 반응형일 때만 작동
			$lg = (isset($wset['lg']) && $wset['lg'] > 0) ? $wset['lg'] : 3;
		$lgg = (isset($wset['lgg']) && ($wset['lgg'] > 0 || $wset['lgg'] == "0")) ? $wset['lgg'] : $gap;
		$lgb = (isset($wset['lgb']) && ($wset['lgb'] > 0 || $wset['lgb'] == "0")) ? $wset['lgb'] : $gapb;

		$md = (isset($wset['md']) && $wset['md'] > 0) ? $wset['md'] : 2;
		$mdg = (isset($wset['mdg']) && ($wset['mdg'] > 0 || $wset['mdg'] == "0")) ? $wset['mdg'] : $lgg;
		$mdb = (isset($wset['mdb']) && ($wset['mdb'] > 0 || $wset['mdb'] == "0")) ? $wset['mdb'] : $lgb;

		$sm = (isset($wset['sm']) && $wset['sm'] > 0) ? $wset['sm'] : 2;
		$smg = (isset($wset['smg']) && ($wset['smg'] > 0 || $wset['smg'] == "0")) ? $wset['smg'] : $mdg;
		$smb = (isset($wset['smb']) && ($wset['smb'] > 0 || $wset['smb'] == "0")) ? $wset['smb'] : $mdb;

		$xs = (isset($wset['xs']) && $wset['xs'] > 0) ? $wset['xs'] : 1;
		$xsg = (isset($wset['xsg']) && ($wset['xsg'] > 0 || $wset['xsg'] == "0")) ? $wset['xsg'] : $smg;
		$xsb = (isset($wset['xsb']) && ($wset['xsb'] > 0 || $wset['xsb'] == "0")) ? $wset['xsb'] : $smb;
	?>
	@media (max-width:1199px) { 
		.responsive #<?php echo $widget_id;?> .item-wrap { margin-right:<?php echo $lgg * (-1);?>px; margin-bottom:<?php echo $lgb * (-1);?>px; }
		.responsive #<?php echo $widget_id;?> .item-row { width:<?php echo apms_img_width($lg);?>%; } 
		.responsive #<?php echo $widget_id;?> .item-list { margin-right:<?php echo $lgg;?>px; margin-bottom:<?php echo $lgb;?>px; }
	}
	@media (max-width:991px) { 
		.responsive #<?php echo $widget_id;?> .item-wrap { margin-right:<?php echo $mdg * (-1);?>px; margin-bottom:<?php echo $mdb * (-1);?>px; }
		.responsive #<?php echo $widget_id;?> .item-row { width:<?php echo apms_img_width($md);?>%; } 
		.responsive #<?php echo $widget_id;?> .item-list { margin-right:<?php echo $mdg;?>px; margin-bottom:<?php echo $mdb;?>px; }
	}
	@media (max-width:767px) { 
		.responsive #<?php echo $widget_id;?> .item-wrap { margin-right:<?php echo $smg * (-1);?>px; margin-bottom:<?php echo $smb * (-1);?>px; }
		.responsive #<?php echo $widget_id;?> .item-row { width:<?php echo apms_img_width($sm);?>%; } 
		.responsive #<?php echo $widget_id;?> .item-list { margin-right:<?php echo $smg;?>px; margin-bottom:<?php echo $smb;?>px; }
	}
	@media (max-width:480px) { 
		.responsive #<?php echo $widget_id;?> .item-wrap { margin-right:<?php echo $xsg * (-1);?>px; margin-bottom:<?php echo $xsb * (-1);?>px; }
		.responsive #<?php echo $widget_id;?> .item-row { width:<?php echo apms_img_width($xs);?>%; } 
		.responsive #<?php echo $widget_id;?> .item-list { margin-right:<?php echo $xsg;?>px; margin-bottom:<?php echo $xsb;?>px; }
	}
	<?php } ?>
</style>

<?php include_once($skin_path.'/category.skin.php'); //분류 ?>

<div id="<?php echo $widget_id;?>" class="shop-list<?php echo (isset($xs) && $xs > 1) ? ' xs-2' : '';?>">
	<div class="item-wrap">
		<?php include($skin_path.'/list.rows.php');	?>
	</div>
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
		<?php if($is_more == "1") { ?>
			<div id="<?php echo $widget_id;?>-more" class="item-more">
				<a href="#" title="더보기">
					<span class="<?php echo (isset($wset['moreb']) && $wset['moreb']) ? $wset['moreb'] : 'lightgray';?>"> 
						<i class="fa fa-arrow-circle-down fa-4x"></i><span class="sound_only">더보기</span>
					</span>
				</a>
			</div>
		<?php } ?>
	<?php } ?>
</div>
<div class="list-page text-center">
	<ul class="pagination pagination-sm en no-margin">
		<?php echo apms_paging($write_pages, $page, $total_page, $list_page); ?>
	</ul>
	<div class="clearfix"></div>
</div>

<?php if ($is_admin || $setup_href) { ?>
	<div class="h20"></div>
	<div class="text-center">
		<div class="btn-group">
			<?php if ($config_href) { ?>
				<a class="btn btn-<?php echo $btn1;?> btn-sm" href="<?php echo $config_href;?>"><i class="fa fa-cog"></i> 설정</a>
			<?php } ?>
			<?php if($setup_href) { ?>
				<a class="btn btn-<?php echo $btn1;?> btn-sm win_memo" href="<?php echo $setup_href;?>"><i class="fa fa-cogs"></i> 스킨설정</a>
			<?php } ?>
		</div>
	</div>
<?php } ?>

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
