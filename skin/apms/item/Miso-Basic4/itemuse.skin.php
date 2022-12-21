<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if(!isset($wset['istar']) || !$wset['istar']) $wset['istar'] = 'red';

$list_cnt = count($list);

?>

<div class="help-block">
	<i class="fa fa-commenting-o"></i>
	<?php echo ($is_free_write) ? '구매와 상관없이 ' : '구매하신 분만 ';?>
	후기를 등록할 수 있으며, 후기와 관계없는 글, 판매, 양도, 광고, 욕설, 비방, 도배 등의 글은 예고 없이 삭제됩니다.
</div>

<div class="list-board">
	<div class="div-head <?php echo $head_class;?>">
		<span class="num first">번호</span>
		<span class="subj second">제목</span>
		<span class="name hidden-xs">이름</span>
		<span class="date hidden-xs">날짜</span>
		<span class="name">별점</span>
	</div>
	<ul class="board-list">
	<?php for ($i=0; $i < $list_cnt; $i++) { ?>
		<li>
			<a href="#" onclick="more_is('more_is_<?php echo $i; ?>'); return false;">
				<div class="num"><?php echo $list[$i]['is_num']; ?></div>
				<div class="subj ellipsis cursor">
					<?php if ($list[$i]['pt_photo']) { ?>
						<img src="<?php echo $item_skin_url;?>/img/icon_photo.gif" alt="">
					<?php } ?>
					<?php echo $list[$i]['is_subject']; ?>
				</div>
				<div class="name ellipsis hidden-xs"><?php echo $list[$i]['is_name']; ?></div>
				<div class="date hidden-xs"><?php echo apms_datetime($list[$i]['is_time'], 'Y.m.d');?></div>
				<div class="name">
					<span class="font-14 <?php echo $wset['istar'];?>"><?php echo apms_get_star($list[$i]['is_score']); //별점 ?></span>
				</div>
			</a>
			<div class="media" id="more_is_<?php echo $i; ?>" style="display:none;">
				<div class="hit text-center pull-left">
					<?php echo ($list[$i]['is_photo']) ? '<img src="'.$list[$i]['is_photo'].'" alt="" class="normal circle">' : '<i class="fa fa-user normal circle bg-light gray"></i>'; ?>
				</div>
				<div class="media-body">
					<div class="info">
						<div class="pull-left">
							<b><?php echo $list[$i]['is_name']; ?></b>
						</div>
						<?php if ($list[$i]['is_btn']) { ?>
							<div class="pull-right">
								<a href="#" onclick="apms_form('itemuse_form', '<?php echo $list[$i]['is_edit_href'];?>'); return false; ">
									<span class="text-muted">수정</span>
								</a>
								&nbsp;
								<a href="#" onclick="apms_delete('itemuse', '<?php echo $list[$i]['is_del_href'];?>', '<?php echo $list[$i]['is_del_return'];?>'); return false; ">
									<span class="text-muted">삭제</span>
								</a>
								&nbsp;
							</div>
						<?php } ?>
						<div class="clearfix"></div>
					</div>
					<div class="img-resize">
						<?php echo get_view_thumbnail($list[$i]['is_content'], $default['pt_img_width']); // 후기 내용 ?>
						<?php if ($list[$i]['is_reply']) { 
							//답글제목 : $list[$i]['is_reply_subject']
							//답글작성 : $list[$i]['is_reply_name']
						?>
							<div class="well well-sm">
								<?php echo get_view_thumbnail($list[$i]['is_reply_content'], $default['pt_img_width']); ?>
							</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</li>
	<?php } ?>
	<?php if (!$i) { ?>
		<li class="none text-center text-muted">
			등록된 후기가 없습니다.	
		</li>
	<?php } ?>
	</ul>
	<div class="clearfix"></div>	
</div>

<div class="use-btn">
	<div class="item-page pull-left" style="margin-top:0px;">
		<ul class="pagination pagination-sm en no-margin">
			<?php echo apms_ajax_paging('itemuse', $write_pages, $page, $total_page, $list_page); ?>
		</ul>
		<div class="clearfix"></div>
	</div>
	<div class="pull-right">
		<div class="btn-group">
			<button type="button" class="btn btn-<?php echo $btn2;?> btn-sm" onclick="apms_form('itemuse_form', '<?php echo $itemuse_form; ?>');">
				<i class="fa fa-pencil"></i> 후기쓰기<span class="sound_only"> 새 창</span>
			</button>
			<a class="btn btn-<?php echo $btn1;?> btn-sm" href="<?php echo $itemuse_list; ?>"><i class="fa fa-plus"></i> 더보기</a>
		</div>
	</div>
	<div class="clearfix"></div>
</div>

<script>
function more_is(id) {
	$("#" + id).toggle();
}
</script>