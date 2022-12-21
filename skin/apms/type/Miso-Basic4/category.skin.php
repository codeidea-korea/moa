<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

//분류
$ca_qstr = (isset($ca_id) && $ca_id) ? '&amp;ca_id='.urlencode($ca_id) : '';

?>

<aside>
	<?php //헤더 네비
		$header_skin = (isset($wset['header_skin']) && $wset['header_skin']) ? $wset['header_skin'] : 'basic';
		if($header_skin != 'none') {
			$header_color = (isset($wset['header_color']) && $wset['header_color']) ? $wset['header_color'] : 'navy';
			include_once('./header.php');
		}
	
		// 분류
		if($is_cate) { 
			$ca_cnt = count($cate);
			$cate_w = ($wset['ctype'] == "2") ? apms_bunhal($ca_cnt, $wset['bunhal']) : '';					
	?>
		<div class="list-category">
			<div class="div-tab<?php echo $wset['tab'];?> tabs<?php echo ($wset['tabline']) ? '' : ' trans-top';?> hidden-xs">
				<ul class="nav nav-tabs<?php echo ($wset['ctype'] == "1") ? ' nav-justified' :'';?><?php echo ($cate_w) ? ' text-center' :'';?>">
					<?php for ($i=0; $i < $ca_cnt; $i++) { ?>
						<li<?php echo ($cate[$i]['on']) ? ' class="active"' : '';?><?php echo $cate_w;?>>
							<a href="./listtype.php?type=<?php echo $type;?>&amp;ca_id=<?php echo urlencode($cate[$i]['ca_id']);?>">
								<?php echo $cate[$i]['name'];?><?php echo ($cate[$i]['on']) ? '('.number_format($total_count).')' : '';?>
							</a>
						</li>
					<?php } ?>
					<?php if($up_href) { ?>
						<li>
							<a href="<?php echo $up_href;?>">상위분류</a>
						</li>
					<?php } ?>
				</ul>
			</div>
			<div class="dropdown visible-xs">
				<a id="categoryLabel" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn btn-color btn-block">
					<?php echo ($ca_id) ? $ca['ca_name'] : '카테고리';?>(<?php echo number_format($total_count);?>)
					<span class="caret"></span>
				</a>
				<ul class="dropdown-menu" role="menu" aria-labelledby="categoryLabel">
					<?php for ($i=0; $i < $ca_cnt; $i++) { ?>
						<li<?php if($cate[$i]['on']) echo ' class="selected"';?>>
							<a href="./listtype.php?type=<?php echo $type;?>&amp;ca_id=<?php echo urlencode($cate[$i]['ca_id']);?>"><?php echo $cate[$i]['name'];?></a>
						</li>
					<?php } ?>
					<?php if($up_href) { ?>
						<li role="separator" class="divider"></li>
						<li>
							<a href="<?php echo $up_href;?>">상위분류</a>
						</li>
					<?php } ?>
				</ul>
			</div>
		</div>
	<?php } ?>

	<div class="list-sort">
		<div class="hidden-xs">
			<div class="pull-left">
				<a <?php echo ($type == '1') ? 'class="on" ' : '';?>href="./listtype.php?type=1<?php echo $ca_qstr;?>">히트상품</a>
				<a <?php echo ($type == '2') ? 'class="on" ' : '';?>href="./listtype.php?type=2<?php echo $ca_qstr;?>">추천상품</a>
				<a <?php echo ($type == '3') ? 'class="on" ' : '';?>href="./listtype.php?type=3<?php echo $ca_qstr;?>">최신상품</a>
				<a <?php echo ($type == '4') ? 'class="on" ' : '';?>href="./listtype.php?type=4<?php echo $ca_qstr;?>">인기상품</a>
				<a <?php echo ($type == '5') ? 'class="on" ' : '';?>href="./listtype.php?type=5<?php echo $ca_qstr;?>">할인상품</a>
			</div>
			<div class="pull-right visible-lg">
				<a <?php echo ($sort == 'it_price' && $sortodr == 'desc') ? 'class="on" ' : '';?>href="<?php echo $list_sort_href; ?>it_price&amp;sortodr=desc">높은가격순</a>
				<a <?php echo ($sort == 'it_price' && $sortodr == 'asc') ? 'class="on" ' : '';?>href="<?php echo $list_sort_href; ?>it_price&amp;sortodr=asc">낮은가격순</a>
				<a <?php echo ($sort == 'it_sum_qty') ? 'class="on" ' : '';?>href="<?php echo $list_sort_href; ?>it_sum_qty&amp;sortodr=desc">판매순</a>
				<a <?php echo ($sort == 'it_use_avg') ? 'class="on" ' : '';?>href="<?php echo $list_sort_href; ?>it_use_avg&amp;sortodr=desc">평점순</a>
				<a <?php echo ($sort == 'it_use_cnt') ? 'class="on" ' : '';?>href="<?php echo $list_sort_href; ?>it_use_cnt&amp;sortodr=desc">후기순</a>
				<a <?php echo ($sort == 'pt_comment') ? 'class="on" ' : '';?>href="<?php echo $list_sort_href; ?>pt_comment&amp;sortodr=desc">댓글순</a>
				<a <?php echo ($sort == 'it_update_time') ? 'class="on" ' : '';?>href="<?php echo $list_sort_href; ?>it_update_time&amp;sortodr=desc">최근순</a>
			</div>
			<div class="clearfix"></div>
		</div>

		<div class="dropdown visible-xs">
			<a id="sortLabel" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn btn-black btn-block">
				상품유형
				<span class="caret"></span>
			</a>
			<ul class="dropdown-menu" role="menu" aria-labelledby="sortLabel">
				<li><a <?php echo ($type == '1') ? 'class="on" ' : '';?>href="./listtype.php?type=1<?php echo $ca_qstr;?>">히트상품</a></li>
				<li><a <?php echo ($type == '2') ? 'class="on" ' : '';?>href="./listtype.php?type=2<?php echo $ca_qstr;?>">추천상품</a></li>
				<li><a <?php echo ($type == '3') ? 'class="on" ' : '';?>href="./listtype.php?type=3<?php echo $ca_qstr;?>">최신상품</a></li>
				<li><a <?php echo ($type == '4') ? 'class="on" ' : '';?>href="./listtype.php?type=4<?php echo $ca_qstr;?>">인기상품</a></li>
				<li><a <?php echo ($type == '5') ? 'class="on" ' : '';?>href="./listtype.php?type=5<?php echo $ca_qstr;?>">할인상품</a></li>
				<li role="separator" class="divider"></li>
				<li><a <?php echo ($sort == 'it_price' && $sortodr == 'desc') ? 'class="on" ' : '';?>href="<?php echo $list_sort_href; ?>it_price&amp;sortodr=desc">높은가격순</a></li>
				<li><a <?php echo ($sort == 'it_price' && $sortodr == 'asc') ? 'class="on" ' : '';?>href="<?php echo $list_sort_href; ?>it_price&amp;sortodr=asc">낮은가격순</a></li>
				<li><a <?php echo ($sort == 'it_sum_qty') ? 'class="on" ' : '';?>href="<?php echo $list_sort_href; ?>it_sum_qty&amp;sortodr=desc">판매많은순</a></li>
				<li><a <?php echo ($sort == 'it_use_avg') ? 'class="on" ' : '';?>href="<?php echo $list_sort_href; ?>it_use_avg&amp;sortodr=desc">평점높은순</a></li>
				<li><a <?php echo ($sort == 'it_use_cnt') ? 'class="on" ' : '';?>href="<?php echo $list_sort_href; ?>it_use_cnt&amp;sortodr=desc">후기많은순</a></li>
				<li><a <?php echo ($sort == 'pt_comment') ? 'class="on" ' : '';?>href="<?php echo $list_sort_href; ?>pt_comment&amp;sortodr=desc">댓글많은순</a></li>
				<li><a <?php echo ($sort == 'it_update_time') ? 'class="on" ' : '';?>href="<?php echo $list_sort_href; ?>it_update_time&amp;sortodr=desc">최근등록순</a></li>
			</ul>
		</div>
	</div>
	<?php if($is_more == "2") { // 무한스크롤일 경우에만 출력 ?>
		<div class="well well-sm text-center list-control">
			<div class="pull-left">
				<ul class="pagination pagination-sm en no-margin">
					<?php echo apms_paging($write_pages, $page, $total_page, $list_page); ?>
				</ul>
				<div class="clearfix"></div>
			</div>
			<div class="pull-right">
				<div class="btn-group">
					<?php if($setup_href) { ?>
						<a class="btn btn-<?php echo $btn1;?> btn-sm win_memo" href="<?php echo $setup_href;?>"><i class="fa fa-cogs"></i> 스킨설정</a>
					<?php } ?>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	<?php } ?>
</aside>