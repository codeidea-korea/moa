<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

$list_cnt = count($list);
?>

<div class="help-block">
	<i class="fa fa-bell"></i>
	상품의 취소/반품/교환/환불 및 배송관련 문의는 <a href="<?php echo $at_href['secret'];?>"><b class="red">고객센터>질문답변</b></a>을 이용해 주세요.
</div>

<div class="list-board">
	<div class="div-head <?php echo $head_class;?>">
		<span class="num first">번호</span>
		<span class="subj second">제목</span>
		<span class="name">이름</span>
		<span class="date hidden-xs">날짜</span>
		<span class="hit">답변</span>
	</div>
	<ul class="board-list">
	<?php for ($i=0; $i < $list_cnt; $i++) { ?>
		<li>
			<a href="#" onclick="more_iq('more_iq_<?php echo $i; ?>'); return false;">
				<div class="num"><?php echo $list[$i]['iq_num']; ?></div>
				<div class="subj ellipsis cursor">
					
					<?php echo $list[$i]['iq_subject']; ?>
					<?php if($list[$i]['iq_secret']) { ?>
						<img src="<?php echo $item_skin_url;?>/img/icon_secret.gif" alt="">
					<?php } ?>
				</div>
				<div class="name ellipsis"><?php echo $list[$i]['iq_name']; ?></div>
				<div class="date hidden-xs"><?php echo apms_datetime($list[$i]['iq_time'], 'Y.m.d');?></div>
				<div class="hit"><?php echo ($list[$i]['iq_answer']) ? '<span class="orangered">완료</span>' : '대기';?></div>
			</a>
			<div class="media" id="more_iq_<?php echo $i; ?>" style="display:none;">
				<div class="hit text-center pull-left">
					<!-- <?php echo ($list[$i]['iq_photo']) ? '<img src="'.$list[$i]['iq_photo'].'" alt="" class="normal circle">' : '<i class="fa fa-user normal circle bg-light gray"></i>'; ?> 
					작성자 이미지 제거--> 
					
				</div>
				<div class="media-body" style="padding-left:80px;">
					<div class="info">
						<div class="pull-left">
							<b>작성자 : <?php echo $list[$i]['iq_name']; ?></b>
						</div>
						<?php if ($list[$i]['iq_btn']) { ?>
							<div class="pull-right">
								<a href="#" onclick="apms_form('itemqa_form', '<?php echo $list[$i]['iq_edit_href'];?>'); return false;">
									<span class="text-muted">수정</span>
								</a>
								&nbsp;
								<a href="#" onclick="apms_delete('itemqa', '<?php echo $list[$i]['iq_del_href'];?>', '<?php echo $list[$i]['iq_del_return'];?>'); return false; ">
									<span class="text-muted">삭제</span>
								</a>
								&nbsp;
							</div>
						<?php } ?>
						<div class="clearfix"></div>
					</div>

					<div class="img-resize">
						<?php echo get_view_thumbnail($list[$i]['iq_question'], $default['pt_img_width']); // 문의 내용 ?>
					</div>

					<?php if($list[$i]['answer']) { ?>
						<div class="div-title-wrap">
							<h5 class="div-title"><i class="fa fa-commenting lightgray"></i> <font color="red">답 변</font></h5>
							<div class="div-sep-wrap">
								<div class="div-sep sep-thin"></div>
							</div>
						</div>
						<div class="media-ans img-resize">
							<?php echo get_view_thumbnail($list[$i]['iq_answer'], $default['pt_img_width']); ?>
							<?php if($list[$i]['iq_btn']) { ?>
								<p>
									<a href="#" onclick="apms_form('itemans_form', '<?php echo $list[$i]['iq_ans_href'];?>'); return false;">
										<span class="text-muted"><i class="fa fa-plus"></i> 답변수정</span>
									</a>
								</p>
							<?php } ?>
						</div>
					<?php } else if($list[$i]['iq_btn']) { ?>
						<p>
							<a href="#" onclick="apms_form('itemans_form', '<?php echo $list[$i]['iq_ans_href'];?>'); return false;">
								<span class="text-muted"><i class="fa fa-comment"></i> 답변하기</span>
							</a>
						</p>
					<?php } ?>
				</div>
			</div>
		</li>
	<?php } ?>
	<?php if (!$i) { ?>
		<li class="none text-center text-muted">
			등록된 문의가 없습니다.	
		</li>
	<?php } ?>
	</ul>
	<div class="clearfix"></div>	
</div>

<div class="qa-btn">
	<div class="item-page pull-left" style="margin-top:0px;">
		<ul class="pagination pagination-sm en no-margin">
			<?php echo apms_ajax_paging('itemqa', $write_pages, $page, $total_page, $list_page); ?>
		</ul>
		<div class="clearfix"></div>
	</div>
	<div class="pull-right">
		<div class="btn-group">
			<button type="button" class="btn btn-<?php echo $btn2;?> btn-sm" onclick="apms_form('itemqa_form', '<?php echo $itemqa_form; ?>');">
				<i class="fa fa-pencil"></i> 문의쓰기<span class="sound_only"> 새 창</span>
			</button>
			<a class="btn btn-<?php echo $btn1;?> btn-sm" href="<?php echo $itemqa_list; ?>"><i class="fa fa-plus"></i> 더보기</a>
		</div>
	</div>
	<div class="clearfix"></div>
</div>

<script>
function more_iq(id) {
	$("#" + id).toggle();
}
</script>