<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css" media="screen">', 0);

// 간격
$gap_right = ($boset['gap_r'] == "") ? 0 : $boset['gap_r'];
$gap_bottom = ($boset['gap_b'] == "") ? 30 : $boset['gap_b'];

$list_cnt = count($list);

?>

<div class="tag-cloud">
	<div class="background-embed">
		<div class="container grid-xl">
		    <fieldset id="bo_sch">
		        <legend>게시물 검색</legend>
		
		        <form name="fsearch" method="get">
		        <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
		        <input type="hidden" name="sca" value="<?php echo $sca ?>">
		        <input type="hidden" name="sop" value="and">
		        <label for="sfl" class="sound_only">검색대상</label>
		        <select name="sfl" id="sfl">
		            <option value="wr_subject||wr_name,1"<?php echo get_selected($sfl, 'wr_subject||wr_name,1'), true; ?>></option>
		        </select>
		        <label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
		        <input type="text" name="stx" value="<?php echo stripslashes($stx) ?>" required id="stx" class="sch_input" size="25" maxlength="20" placeholder="DISCOVER YOUR KEYWORDS.">
		        <button type="submit" value="검색" class="sch_btn"><i class="fa fa-search" aria-hidden="true"></i><span class="sound_only">검색</span></button>
		        </form>
		    </fieldset> 
		</div>
	</div>
	<div class="container grid-xl">
		<span class="label">
			<?php 
			// 해당 게시판 전체 태그 노출 영역. 향후 태그와 카테고리를 공통 헤더 영역에 추가 예정.
			for ($i=0; $i < $list_cnt; $i++)  {
				$tag_list = apms_get_tag($list[$i]['as_tag']);
				?>
					<?php echo $tag_list;?>
			<?php } ?>
		</span>
		<?php if($notice_count > 0) include_once($board_skin_path.'/notice.skin.php'); // 공지사항	?>
		<?php if($is_category) include_once($board_skin_path.'/category.skin.php'); // 카테고리	?>
	</div>
</div>

<section class="board-list<?php echo (G5_IS_MOBILE) ? ' font-14' : '';?> container">

	<style>
		.list-wrap .list-container { overflow:hidden; margin-right:<?php echo ($gap_right > 0) ? '-'.$gap_right : 0;?>px; margin-bottom:<?php echo ($gap_bottom > 15) ? 0 : 15;?>px; }
		.list-wrap .list-row { float:left; width:<?php echo $item_w;?>%; }
		.list-wrap .list-item { margin-right:<?php echo $gap_right;?>px; margin-bottom:<?php echo $gap_bottom;?>px; }
	</style>
	<div class="list-wrap container-fluid container">
		<form name="fboardlist" id="fboardlist" action="./board_list_update.php" onsubmit="return fboardlist_submit(this);" method="post" role="form" class="form">
			<input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
			<input type="hidden" name="sfl" value="<?php echo $sfl ?>">
			<input type="hidden" name="stx" value="<?php echo $stx ?>">
			<input type="hidden" name="spt" value="<?php echo $spt ?>">
			<input type="hidden" name="sca" value="<?php echo $sca ?>">
			<input type="hidden" name="sst" value="<?php echo $sst ?>">
			<input type="hidden" name="sod" value="<?php echo $sod ?>">
			<input type="hidden" name="page" value="<?php echo $page ?>">
			<input type="hidden" name="sw" value="">

			<div class="list-container" id="ajax_data">
				<div class="grid">
				<?php 
					$k = 0;
					for ($i=0; $i < $list_cnt; $i++) { 
	
						if($list[$i]['is_notice']) continue;		
	
						//아이콘 체크
						$is_lock = false;
	
						// 썸네일
						$list[$i]['no_img'] = $board_skin_url.'/img/no-img.jpg'; // No-Image
						$img = apms_wr_thumbnail($bo_table, $list[$i], $thumb_w, $thumb_h, false, true);
	
				?>
					<div class="grid-item col-xs-8">
						<div class="list-item grid-item-content">
							<?php if($thumb_h > 0) { ?>
								<div class="imgframe">
									<div class="img-wrap" style="padding-bottom:<?php echo $img_h;?>%;">
										<div class="img-item">
											<?php echo $wr_label;?>
											<?php if ($is_checkbox) { ?>
												<div class="label-tack">
													<input type="checkbox" name="chk_wr_id[]" value="<?php echo $list[$i]['wr_id'] ?>" id="chk_wr_id_<?php echo $i ?>">
												</div>	
											<?php } ?>
											<a href="<?php echo $list[$i]['href'];?>">
												<img src="<?php echo $img['src'];?>" alt="<?php echo $img['alt'];?>">
											</a>
										</div>
									</div>
								</div>
							<?php } else { ?>
								<div class="list-img card-image">
									<?php echo $wr_label;?>
									<?php if ($is_checkbox) { ?>
										<div class="label-tack">
											<input type="checkbox" name="chk_wr_id[]" value="<?php echo $list[$i]['wr_id'] ?>" id="chk_wr_id_<?php echo $i ?>">
										</div>	
									<?php } ?>
									<a href="<?php echo $list[$i]['href'];?>">
										<img src="<?php echo $img['src'];?>" alt="<?php echo $img['alt'];?>">
									</a>
								</div>
							<?php } ?>
							
							<div class="gal-info">
	
								<span>
									<figure class="avatar avatar-md">
										<img src="<?php echo $mb_img_url ?>" alt="회원이미지">
									</figure>
										<?php echo $list[$i]['name'];?>
								</span>
								
								<?php /*
								<div class="list-details font-12 text-muted">
									
									<span class="pull-left">
										<?php echo $list[$i]['subject'];?>
									</span>
									<div class="clearfix"></div>
								</div>
							*/ 	?>
							
							</div>
						</div>
					</div>
			<?php $k++; } ?>
				</div>
				</div>
			</div>

			<?php if (!$is_list) { ?>
				<div class="text-center text-muted list-none" datano="no">게시물이 없습니다.</div>
			<?php } ?>
			
			<div class="btn btn-more btn-lg btn-block">더보기 more</div>
			
			<div class="list-btn-box">
				<?php if ($list_href || $write_href) { ?>
					<div class="form-group pull-right list-btn">
						<div class="btn-group dropup">
							<?php if ($boset['sort']) { ?>
								<a id="sortLabel" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn btn-black btn-sm">
									<i class="fa fa-sort"></i><span>정렬</span>
								</a>
								<ul class="dropdown-menu" role="menu" aria-labelledby="sortLabel">
									<li<?php echo ($sst == 'wr_datetime') ? ' class="sort"' : '';?>><?php echo subject_sort_link('wr_datetime', $qstr2, 1) ?>날짜순</a></li>
									<li<?php echo ($sst == 'wr_hit') ? ' class="sort"' : '';?>><?php echo subject_sort_link('wr_hit', $qstr2, 1) ?>조회순</a></li>
									<?php if ($is_good) { ?>
										<li<?php echo ($sst == 'wr_good') ? ' class="sort"' : '';?>><?php echo subject_sort_link('wr_good', $qstr2, 1) ?>추천순</a></li>
									<?php } ?>
									<?php if ($is_nogood) { ?>
										<li<?php echo ($sst == 'wr_nogood') ? ' class="sort"' : '';?>><?php echo subject_sort_link('wr_nogood', $qstr2, 1) ?>비추천순</a></li>
									<?php } ?>
									<li><a href="./board.php?bo_table=<?php echo $bo_table;?>&amp;sca=<?php echo urlencode($sca);?>">초기화</a></li>
								</ul>
							<?php } ?>
							<?php if ($list_href) { ?><a href="<?php echo $list_href ?>" class="btn btn-black btn-sm"><i class="fa fa-bars"></i><span>목록</span></a><?php } ?>
							<?php if ($write_href) { ?><a href="<?php echo $write_href ?>" class="btn btn-color btn-sm"><i class="fa fa-pencil"></i><span>글쓰기</span></a><?php } ?>
						</div>
					</div>
				<?php } ?>
				<div class="form-group list-btn font-12">
					<div class="btn-group">
						<?php if ($rss_href) { ?>
							<a href="<?php echo $rss_href; ?>" class="btn btn-color btn-sm"><i class="fa fa-rss"></i></a>
						<?php } ?>
						<?php if ($is_checkbox || $setup_href || $admin_href) { ?>
							<?php if ($is_checkbox) { ?>
								<button type="submit" name="btn_submit" value="선택삭제" onclick="document.pressed=this.value" class="btn btn-black btn-sm"><i class="fa fa-times"></i><span class="hidden-xs"> 선택삭제</span></button>
								<button type="submit" name="btn_submit" value="선택복사" onclick="document.pressed=this.value" class="btn btn-black btn-sm"><i class="fa fa-clipboard"></i><span class="hidden-xs"> 선택복사</span></button>
								<button type="submit" name="btn_submit" value="선택이동" onclick="document.pressed=this.value" class="btn btn-black btn-sm"><i class="fa fa-arrows"></i><span class="hidden-xs"> 선택이동</span></button>
								<button type="button" id="btn_chkall" class="btn btn-black btn-sm"><i class="fa fa-check"></i><span class="hidden-xs"> 전체선택</span></button>
							<?php } ?>
							<?php if ($admin_href) { ?>
								<a href="<?php echo $admin_href; ?>" class="btn btn-black btn-sm"><i class="fa fa-cog"></i></a>
							<?php } ?>
							<?php if ($setup_href) { ?>
								<a href="<?php echo $setup_href; ?>" class="btn btn-color btn-sm win_memo"><i class="fa fa-cogs"></i><span class="hidden-xs"> 설정</span></a>
							<?php } ?>
						<?php } ?>
					</div>
				</div>
				<div class="clearfix"></div>
			</div>
		</form>

		<?php if($total_count > 0) { ?>
			<div class="list-page text-center">
				<ul class="pagination pagination-sm en">
					<?php if($prev_part_href) { ?>
						<li><a href="<?php echo $prev_part_href;?>">이전검색</a></li>
					<?php } ?>
					<?php echo apms_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, './board.php?bo_table='.$bo_table.$qstr.'&amp;page=');?>
					<?php if($next_part_href) { ?>
						<li><a href="<?php echo $next_part_href;?>">다음검색</a></li>
					<?php } ?>
				</ul>
			</div>
		<?php } ?>

		<div class="clearfix"></div>

		<?php if($is_checkbox) { ?>
			<noscript>
			<p>자바스크립트를 사용하지 않는 경우<br>별도의 확인 절차 없이 바로 선택삭제 처리하므로 주의하시기 바랍니다.</p>
			</noscript>
		<?php } ?>
		
	</div>
</section>
<script>
	
/*	
	$(function(){

var $container = $('.list-container');

	$container.imagesLoaded(function(){
	  $container.masonry({
	    itemSelector: '.grid-item',
	    columnWidth: 4,
	    isAnimated: true
	  });
	});
});

	$container.infinitescroll({
	  navSelector  : $(".list-page .active"),    // selector for the paged navigation 
	  nextSelector : '.next',  // selector for the NEXT link (to page 2)
	  itemSelector : '.box',     // selector for all items you'll retrieve
	  loading: {
	      finishedMsg: 'No more photos to show.',
	      img: 'loader.gif'
	    }
	  },
	  // trigger Masonry as a callback
	  function( newElements ) {
	    // hide new items while they are loading
	    var $newElems = $( newElements ).css({ opacity: 0 });
	    // ensure that images load before adding to masonry layout
	    $newElems.imagesLoaded(function(){
	      // show elems now they're ready
	      $newElems.animate({ opacity: 1 });
	      $container.masonry( 'appended', $newElems, true ); 
	    });
	  }
	);

*/
	
var page_on = $(".list-container").find(".list-page .active");
var page_check = $(".list-page .active").text();
$(document).ready(function () {
    if (page_check == "object Object") {
        $(".list-page .active").text("0");
    } else {
        $(".list-page .active").text("2");
    }
});

$(".btn-more").click(function(){
    $( this ).html('<i class="fa fa-spinner fa-spin"></i>');
    var disp_li_length = $(".grid-item > li").length;
    var page_n = $(".list-page .active").html();
    $.get("<?=G5_URL?>/bbs/board.php?bo_table=<?=$bo_table?>&ajax_ck=1&sca=<?php echo urlencode($sca) ?>&page="+page_n, function( data ) {
        var append_data = $(data).find("#ajax_data").html();
        var cking = $(data).find(".list-none").attr("datano");
        if (page_check == 0) {
            $(".btn-more").html("더 이상 게시글이 없습니다.");
            return false;
        }
        if (cking != "no"){
            $("#page_txt").html("");
            $("#ajax_data").append(append_data);
            $(".list-page .active").html(parseInt(page_n)+1);
            $(".btn-more").html("더 보기");
        } else {
            $(".btn-more").html("더 이상 게시글이 없습니다.");
        }
    });
});

// init Masonry
var $grid = $('.grid').masonry({
	itemSelector: '.grid-item',
	columnWidth: 4,
	isAnimated: true
});

</script>
<?php if ($is_checkbox) { ?>
<script>
	
function all_checked(sw) {
	var f = document.fboardlist;

	for (var i=0; i<f.length; i++) {
		if (f.elements[i].name == "chk_wr_id[]")
			f.elements[i].checked = sw;
	}
}
$(function(){
	$("#btn_chkall").click(function(){
		var clicked_checked = $(this);

		if(clicked_checked.hasClass('active')) {
			all_checked(false);
			clicked_checked.removeClass('active');
		} else {
			all_checked(true);
			clicked_checked.addClass('active');
		}
	});
});
function fboardlist_submit(f) {
	var chk_count = 0;

	for (var i=0; i<f.length; i++) {
		if (f.elements[i].name == "chk_wr_id[]" && f.elements[i].checked)
			chk_count++;
	}

	if (!chk_count) {
		alert(document.pressed + "할 게시물을 하나 이상 선택하세요.");
		return false;
	}

	if(document.pressed == "선택복사") {
		select_copy("copy");
		return;
	}

	if(document.pressed == "선택이동") {
		select_copy("move");
		return;
	}

	if(document.pressed == "선택삭제") {
		if (!confirm("선택한 게시물을 정말 삭제하시겠습니까?\n\n한번 삭제한 자료는 복구할 수 없습니다\n\n답변글이 있는 게시글을 선택하신 경우\n답변글도 선택하셔야 게시글이 삭제됩니다."))
			return false;

		f.removeAttribute("target");
		f.action = "./board_list_update.php";
	}

	return true;
}

// 선택한 게시물 복사 및 이동
function select_copy(sw) {
	var f = document.fboardlist;

	if (sw == "copy")
		str = "복사";
	else
		str = "이동";

	var sub_win = window.open("", "move", "left=50, top=50, width=500, height=550, scrollbars=1");

	f.sw.value = sw;
	f.target = "move";
	f.action = "./move.php";
	f.submit();
}
</script>
<?php } ?>
<!-- } 게시판 목록 끝 -->
