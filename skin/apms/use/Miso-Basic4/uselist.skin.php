<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

// Common Skin
@include_once($skin_path.'/common.skin.php');

// 헤드스킨
if(isset($wset['hskin']) && $wset['hskin']) {
	add_stylesheet('<link rel="stylesheet" href="'.G5_CSS_URL.'/head/'.$wset['hskin'].'.css" media="screen">', 0);
	$head_class = 'list-head';
} else {
	$head_class = (isset($wset['hcolor']) && $wset['hcolor']) ? 'border-'.$wset['hcolor'] : 'border-black';
}

// 검색버튼
$sbtn = (isset($wset['sbtn']) && $wset['sbtn']) ? $wset['sbtn'] : 'navy';

// 박스라인
$boxline = (isset($wset['bline']) && $wset['bline']) ? $wset['bline'] : 'navy';

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$skin_url.'/style.css" media="screen">', 0);

$list_cnt = count($list);

?>
<aside>
	<div class="use-box">
		<form class="form" role="form" method="get" action="./itemuselist.php">
			<div class="row">
				<div class="col-sm-3">
					<div class="form-group">
						<label for="ca_id" class="sound_only">분류</label>
						<select name="ca_id" id="ca_id" class="form-control input-sm">
							<option value="">카테고리</option>
							<?php echo apms_category($ca_id);?>
						</select>
					</div>
				</div>
				<div class="col-sm-3">
					<div class="form-group">
						<label for="sfl" class="sound_only">검색항목<strong class="sound_only"> 필수</strong></label>
						<select name="sfl" id="sfl" class="form-control input-sm">
							<option value="">선택</option>
							<option value="b.it_name"    <?php echo get_selected($sfl, "b.it_name", true); ?>>상품명</option>
							<option value="a.it_id"      <?php echo get_selected($sfl, "a.it_id"); ?>>상품코드</option>
							<option value="a.is_subject" <?php echo get_selected($sfl, "a.is_subject"); ?>>후기제목</option>
							<option value="a.is_name"    <?php echo get_selected($sfl, "a.is_id"); ?>>작성자명</option>
							<option value="a.mb_id"      <?php echo get_selected($sfl, "a.mb_id"); ?>>작성자아이디</option>
						</select>
					</div>
				</div>
				<div class="col-sm-3">
					<div class="form-group">
						<div class="form-group">
							<label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
							<input type="text" name="stx" value="<?php echo $stx; ?>" id="stx" class="form-control input-sm" placeholder="검색어">
						</div>
					</div>
				</div>
				<div class="col-sm-3">
					<div class="form-group">
						<button type="submit" class="btn btn-<?php echo $sbtn;?> btn-sm btn-block"><i class="fa fa-search"></i> 검색하기</button>
					</div>
				</div>
			</div>
		</form>
	</div>

	<div class="div-box-light" style="border-color:<?php echo apms_color($boxline);?>"> 
		총 <b><?php echo number_format($total_count);?></b>개의 후기가 등록되어 있습니다.
	</div>

	<div class="h20"></div>

</aside>

<div class="list-board">
	<div class="div-head <?php echo $head_class;?>">
		<span class="num first">번호</span>
		<span class="photo second">포토</span>
		<span class="subj">제목</span>
		<span class="name hidden-xs">이름</span>
		<span class="date hidden-xs">날짜</span>
		<span class="name">별점</span>
	</div>
	<ul class="board-list">
	<?php for ($i=0; $i < $list_cnt; $i++) { 
		$img = apms_it_write_thumbnail($list[$i]['it_id'], $list[$i]['is_content'], 80, 80);
		$img['src'] = ($img['src']) ? $img['src'] : $list[$i]['is_photo'];
	?>
		<li>
			<a href="<?php echo $list[$i]['is_href']; ?>">
				<div class="num"><?php echo $list[$i]['is_num']; ?></div>
				<div class="photo">
					<?php echo ($img['src']) ? '<img src="'.$img['src'].'" alt="'.$img['src'].'">' : '<i class="fa fa-user"></i>'; ?>
				</div>
				<div class="subj cursor">
					<div class="ellipsis">
						<?php if ($list[$i]['pt_photo']) { ?>
							<img src="<?php echo $skin_url;?>/img/icon_photo.gif" alt="">
						<?php } ?>
						<?php echo $list[$i]['is_subject']; ?>
					</div>
					<div class="ellipsis text-muted">
						<i class="fa fa-gift"></i> <?php echo $list[$i]['it_name']; ?>
					</div>
				</div>
				<div class="name ellipsis hidden-xs"><?php echo $list[$i]['is_name']; ?></div>
				<div class="date hidden-xs"><?php echo apms_datetime($list[$i]['is_time'], 'Y.m.d');?></div>
				<div class="name">
					<span class="font-14 <?php echo $scolor;?>"><?php echo apms_get_star($list[$i]['is_score']); //별점 ?></span>
				</div>
			</a>
		</li>
	<?php } ?>
	<?php if (!$list_cnt) { ?>
		<li class="use-none text-center text-muted">
			등록된 후기가 없습니다.	
		</li>
	<?php } ?>
	</ul>
	<div class="clearfix"></div>	
</div>

<div class="use-page text-center">
	<ul class="pagination pagination-sm en no-margin">
		<?php echo apms_paging($write_pages, $page, $total_page, $list_page); ?>
	</ul>
</div>

<?php if ($is_admin || $setup_href) { ?>
	<div class="h20"></div>
	<div class="text-center">
		<div class="btn-group">
			<?php if($is_admin) { ?>
				<a class="btn btn-<?php echo $btn1;?> btn-sm" href="<?php echo G5_ADMIN_URL;?>/apms_admin/apms.admin.php?ap=thema"><i class="fa fa-cog"></i> 설정</a>
			<?php } ?>
			<?php if($setup_href) { ?>
				<a class="btn btn-<?php echo $btn2;?> btn-sm win_memo" href="<?php echo $setup_href;?>"><i class="fa fa-cogs"></i> 스킨설정</a>
			<?php } ?>
		</div>
	</div>
<?php } ?>