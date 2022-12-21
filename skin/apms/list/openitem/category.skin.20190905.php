<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

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

?>

<aside>
	<?php
			
		// 분류
		if($is_cate) { 
			$ca_cnt = count($cate);
			$cate_w = ($wset['ctype'] == "2") ? apms_bunhal($ca_cnt, $wset['bunhal']) : '';	
			$cate_symbol = array("typcn-pencil","typcn-leaf","typcn-book","typcn-pen","typcn-puzzle");				
	?>
		<ul class="nav-icon">
			<li class="nav-item active">
				<a href="./list.php?ca_id=10">
					<i class="typcn typcn-mortar-board"></i>
					모든 수업
				</a>
			</li>
			<?php for ($i=0; $i < $ca_cnt; $i++) { ?>
			<li class="nav-item <?php echo ($cate[$i]['on']) ? ' active' : '';?><?php echo $cate_w;?>">
				<a href="./list.php?ca_id=<?php echo urlencode($cate[$i]['ca_id']);?>">
					<i class="typcn <?php echo ($cate_symbol[$i]); ?>"></i>
					<?php echo $cate[$i]['name'];?>
				</a>
			</li>
			<?php } ?>
		</ul>
	<?php } ?>

	<div class="list-sort" style="display:none">
		<div class="hidden-xs" >
			<div class="pull-left">
				<a <?php echo ($sort == 'it_price' && $sortodr == 'desc') ? 'class="on" ' : '';?>href="<?php echo $list_sort_href; ?>it_price&amp;sortodr=desc">높은가격순</a>
				<a <?php echo ($sort == 'it_price' && $sortodr == 'asc') ? 'class="on" ' : '';?>href="<?php echo $list_sort_href; ?>it_price&amp;sortodr=asc">낮은가격순</a>
				<a <?php echo ($sort == 'it_sum_qty') ? 'class="on" ' : '';?>href="<?php echo $list_sort_href; ?>it_sum_qty&amp;sortodr=desc">판매순</a>
				<a <?php echo ($sort == 'it_use_avg') ? 'class="on" ' : '';?>href="<?php echo $list_sort_href; ?>it_use_avg&amp;sortodr=desc">평점순</a>
				<a <?php echo ($sort == 'it_use_cnt') ? 'class="on" ' : '';?>href="<?php echo $list_sort_href; ?>it_use_cnt&amp;sortodr=desc">후기순</a>
				<a <?php echo ($sort == 'pt_comment') ? 'class="on" ' : '';?>href="<?php echo $list_sort_href; ?>pt_comment&amp;sortodr=desc">댓글순</a>
				<a <?php echo ($sort == 'it_update_time') ? 'class="on" ' : '';?>href="<?php echo $list_sort_href; ?>it_update_time&amp;sortodr=desc">최근순</a>
			</div>
			<div class="pull-right visible-lg">
				<a <?php echo ($sort == 'it_type1') ? 'class="on" ' : '';?>href="<?php echo $list_sort_href; ?>it_type1&amp;sortodr=desc">히트상품</a>
				<a <?php echo ($sort == 'it_type2') ? 'class="on" ' : '';?>href="<?php echo $list_sort_href; ?>it_type2&amp;sortodr=desc">추천상품</a>
				<a <?php echo ($sort == 'it_type3') ? 'class="on" ' : '';?>href="<?php echo $list_sort_href; ?>it_type3&amp;sortodr=desc">최신상품</a>
				<a <?php echo ($sort == 'it_type4') ? 'class="on" ' : '';?>href="<?php echo $list_sort_href; ?>it_type4&amp;sortodr=desc">인기상품</a>
				<a <?php echo ($sort == 'it_type5') ? 'class="on" ' : '';?>href="<?php echo $list_sort_href; ?>it_type5&amp;sortodr=desc">할인상품</a>
			</div>
			<div class="clearfix"></div>
		</div>

		<div class="dropdown visible-xs" style="display:none">
			<a id="sortLabel" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn btn-black btn-block">
				상품정렬
				<span class="caret"></span>
			</a>
			<ul class="dropdown-menu" role="menu" aria-labelledby="sortLabel">
				<li><a <?php echo ($sort == 'it_price' && $sortodr == 'desc') ? 'class="on" ' : '';?>href="<?php echo $list_sort_href; ?>it_price&amp;sortodr=desc">높은가격순</a></li>
				<li><a <?php echo ($sort == 'it_price' && $sortodr == 'asc') ? 'class="on" ' : '';?>href="<?php echo $list_sort_href; ?>it_price&amp;sortodr=asc">낮은가격순</a></li>
				<li><a <?php echo ($sort == 'it_sum_qty') ? 'class="on" ' : '';?>href="<?php echo $list_sort_href; ?>it_sum_qty&amp;sortodr=desc">판매많은순</a></li>
				<li><a <?php echo ($sort == 'it_use_avg') ? 'class="on" ' : '';?>href="<?php echo $list_sort_href; ?>it_use_avg&amp;sortodr=desc">평점높은순</a></li>
				<li><a <?php echo ($sort == 'it_use_cnt') ? 'class="on" ' : '';?>href="<?php echo $list_sort_href; ?>it_use_cnt&amp;sortodr=desc">후기많은순</a></li>
				<li><a <?php echo ($sort == 'pt_comment') ? 'class="on" ' : '';?>href="<?php echo $list_sort_href; ?>pt_comment&amp;sortodr=desc">댓글많은순</a></li>
				<li><a <?php echo ($sort == 'it_update_time') ? 'class="on" ' : '';?>href="<?php echo $list_sort_href; ?>it_update_time&amp;sortodr=desc">최근등록순</a></li>
				<li role="separator" class="divider"></li>
				<li><a <?php echo ($sort == 'it_type1') ? 'class="on" ' : '';?>href="<?php echo $list_sort_href; ?>it_type1&amp;sortodr=desc">히트상품</a></li>
				<li><a <?php echo ($sort == 'it_type2') ? 'class="on" ' : '';?>href="<?php echo $list_sort_href; ?>it_type2&amp;sortodr=desc">추천상품</a></li>
				<li><a <?php echo ($sort == 'it_type3') ? 'class="on" ' : '';?>href="<?php echo $list_sort_href; ?>it_type3&amp;sortodr=desc">최신상품</a></li>
				<li><a <?php echo ($sort == 'it_type4') ? 'class="on" ' : '';?>href="<?php echo $list_sort_href; ?>it_type4&amp;sortodr=desc">인기상품</a></li>
				<li><a <?php echo ($sort == 'it_type5') ? 'class="on" ' : '';?>href="<?php echo $list_sort_href; ?>it_type5&amp;sortodr=desc">할인상품</a></li>

			</ul>
		</div>
	</div>
	<?php if($is_more == "2") { // 무한스크롤일 경우에만 출력 ?>
		<?php if ($is_admin) {?>
		<div class="well well-sm text-center list-control">
			<div class="pull-left" style="display:none">
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
					<?php if ($write_href) { ?>
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
					<?php if ($rss_href) { ?>
						<a class="btn btn-<?php echo $btn2;?> btn-sm" title="RSS" href="<?php echo $rss_href;?>" target="_blank"><i class="fa fa-rss fa-lg"></i></a>
					<?php } ?>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
		<?php } ?>
	<?php } ?>
</aside>