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
	<?php //헤더 네비
		if($nav_title) {
			$header_skin = (isset($wset['header_skin']) && $wset['header_skin']) ? $wset['header_skin'] : 'basic';
			if($header_skin != 'none') {
				$header_color = (isset($wset['header_color']) && $wset['header_color']) ? $wset['header_color'] : 'navy';
				include_once('./header.php');
			}
		}
	
		// 분류
		if($is_cate) { 
			$ca_cnt = count($cate);
			$cate_w = ($wset['ctype'] == "2") ? apms_bunhal($ca_cnt, $wset['bunhal']) : '';					
	?>
		<div class="list-category" style="display:">

		
			<div class="dropdown visible-xs">
				<div class="s_content">
				<div class="select_area">
						<div class="cate_sel">
						<!-- 셀렉트 -->
						<select name="categorySelect" id="categorySelect">
							<?php for ($i=0; $i < $ca_cnt; $i++) { ?>
								<option value="<?php echo urlencode($cate[$i]['ca_id']);?>"><?php echo $cate[$i]['name'];?></option>
							<?php } ?>
						</select>
						</div>
						<a href=""><img src="../images/icon_magnifier_1.svg" alt=""></a>   
					</div>
				</div>
				<script>
				$(function() {
					$("#categorySelect").change(function() {
						var ca_id = $("#categorySelect option:selected").val();
						location.href="/shop/list.php?ca_id="+ca_id;
					});
				});
				</script>
				<!--<ul class="dropdown-menu" role="menu" aria-labelledby="categoryLabel">
					<?php for ($i=0; $i < $ca_cnt; $i++) { ?>
						<li<?php if($cate[$i]['on']) echo ' class="selected"';?>>
							<a href="./list.php?ca_id=<?php echo urlencode($cate[$i]['ca_id']);?>"><?php echo $cate[$i]['name'];?></a>
						</li>
					<?php } ?>
					<?php if($up_href) { ?>
						<li role="separator" class="divider"></li>
						<li>
							<a href="<?php echo $up_href;?>">상위분류</a>
						</li>
					<?php } ?>
				</ul>-->
			</div>		
				

			<div class="swiper-container s_nav_sw mb14" <?php echo $wset['tab'];?> tabs<?php echo ($wset['tabline']) ? '' : ' trans-top';?> >
				<div class="swiper2">
					<div class="swiper-wrapper">
						<?php for ($i=0; $i < $ca_cnt; $i++) { ?>
							<div class="swiper-slide">
								<a href="/shop/list.php?ca_id=<?php echo $cate[$i]['ca_id'];?>"><?php echo $cate[$i]['name'];?><?php echo ($cate[$i]['on']) ? '('.number_format($total_count).')' : '';?></a>
							</div>
						<?php } ?>
					</div>
				</div>
			</div>

			<!--<div class="div-tab<?php echo $wset['tab'];?> tabs<?php echo ($wset['tabline']) ? '' : ' trans-top';?> hidden-xs">
				<ul class="nav nav-tabs<?php echo ($wset['ctype'] == "1") ? ' nav-justified' :'';?><?php echo ($cate_w) ? ' text-center' :'';?>">
					<?php for ($i=0; $i < $ca_cnt; $i++) { ?>
						<li<?php echo ($cate[$i]['on']) ? ' class="active"' : '';?><?php echo $cate_w;?>>
							<a href="./list.php?ca_id=<?php echo urlencode($cate[$i]['ca_id']);?>">
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
			</div>-->

			<div class="s_content">
				<div class="srchVlm mt0">
					<p >총 <?php echo ($cate[$i]['on']) ? '('.number_format($total_count).')' : '';?>개</p>
					<div>
						<button onclick="$('#calendar').addClass('on')">날짜</button>
						<button onclick="$('#s_filter').addClass('on')">필터</button>
					</div> 
				</div>
			</div>
		</div>
	<?php } ?>
	
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