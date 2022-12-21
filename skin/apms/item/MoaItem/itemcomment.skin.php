<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 회원사진, 대댓글 이름
if(G5_IS_MOBILE) {
	$depth_gap = 20;
	$is_cmt_photo = (!$wset['cmt_photo'] || $wset['cmt_photo'] == "2") ? true : false;
	$is_replyname = ($wset['cmt_re'] == "1" || $wset['cmt_re'] == "3") ? true : false;
} else {
	$is_cmt_photo = (!$wset['cmt_photo'] || $wset['cmt_photo'] == "1") ? true : false;
	$is_replyname = ($wset['cmt_re'] == "1" || $wset['cmt_re'] == "2") ? true : false;
	$depth_gap = ($is_cmt_photo) ? 64 : 30;
}

?>

<div id="itemcomment">
	<!-- 댓글 시작 { -->
	<section id="it_vc" class="comment-media<?php echo (G5_IS_MOBILE) ? ' comment-mobile' : '';?>">
		<?php
		$cmt_amt = count($list);
		for ($i=0; $i<$cmt_amt; $i++) {
			$comment_id = $list[$i]['wr_id'];
			$cmt_depth = ""; // 댓글단계
			$cmt_depth = strlen($list[$i]['wr_comment_reply']) * $depth_gap;
			$comment = $list[$i]['content'];
		 ?>

			<div class="media" id="c_<?php echo $comment_id ?>"<?php echo ($cmt_depth) ? ' style="margin-left:'.$cmt_depth.'px;"' : ''; ?>>
				<?php 
					if($is_cmt_photo) { // 회원사진
						$cmt_photo_url = apms_photo_url($list[$i]['mb_id']);
						$cmt_photo = ($cmt_photo_url) ? '<img src="'.$cmt_photo_url.'" alt="" class="media-object">' : '<div class="media-object"><i class="fa fa-user"></i></div>';
						echo '<div class="photo pull-left">'.$cmt_photo.'</div>'.PHP_EOL;
					 }
				?>
				<div class="media-body">
					<div class="media-heading">
						<b><?php echo $list[$i]['name'] ?></b>
						<span class="font-11 text-muted">
							<span class="hidden-xs media-info">
								<i class="fa fa-clock-o"></i>
								<?php echo apms_datetime($list[$i]['date'], 'Y.m.d H:i');?>
							</span>
							<?php if ($is_admin == 'super') { ?> 
								<span class="hidden-xs media-info"><i class="fa fa-thumb-tack"></i> <?php echo $list[$i]['ip']; ?></span>
							<?php } ?>
						</span>
						&nbsp;
						<?php if ($list[$i]['wr_facebook_user']) { ?>
							<a href="https://www.facebook.com/profile.php?id=<?php echo $list[$i]['wr_facebook_user']; ?>" target="_blank">
								<i class="fa fa-facebook"></i><span class="sound_only">페이스북에도 등록됨</span>
							</a>
						<?php } ?>
						<?php if ($list[$i]['wr_twitter_user']) { ?>
							<a href="https://www.twitter.com/<?php echo $list[$i]['wr_twitter_user']; ?>" target="_blank">
								<i class="fa fa-facebook"></i><span class="sound_only">트위터에도 등록됨</span>
							</a>
						<?php } ?>

						<?php if($list[$i]['is_reply'] || $list[$i]['is_edit'] || $list[$i]['is_del'] || $is_shingo || $is_admin) {
							if($w == 'cu') {
								$sql = " select wr_id, wr_content from {$g5['apms_comment']} where wr_id = '$it_id' and wr_id = '$c_id' ";
								$cmt = sql_fetch($sql);
								$c_wr_content = $cmt['wr_content'];
							}
						 ?>
							<div class="pull-right font-11 ">
								<?php if ($list[$i]['is_reply']) { ?>
									<a href="#" onclick="comment_box('<?php echo $comment_id ?>', 'c'); return false;">
										<span class="text-muted">답변</span>
									</a>
								<?php } ?>
								<?php if ($list[$i]['is_edit']) { ?>
									<a href="#" onclick="comment_box('<?php echo $comment_id ?>', 'cu'); return false;">
										<span class="text-muted media-btn">수정</span>
									</a>
								<?php } ?>
								<?php if ($list[$i]['is_del'])  { ?>
									<a href="#" onclick="apms_delete('itemcomment', '<?php echo $list[$i]['del_href'];?>','<?php echo $list[$i]['del_return'];?>'); return false;">
										<span class="text-muted media-btn">삭제</span>
									</a>
								<?php } ?>
								<?php if ($is_shingo)  { ?>
									<a href="#" onclick="apms_shingo('<?php echo $list[$i]['it_id'];?>', '<?php echo $comment_id ?>'); return false;">
										<span class="text-muted media-btn">신고</span>
									</a>
								<?php } ?>
								<?php if ($is_admin) { ?>
									<?php if ($list[$i]['is_lock']) { // 글이 잠긴상태이면 ?>
										<a href="#" onclick="apms_shingo('<?php echo $list[$i]['it_id'];?>', '<?php echo $comment_id;?>', 'unlock'); return false;">
											<span class="text-muted media-btn">해제</span>
										</a>
									<?php } else { ?>
										<a href="#" onclick="apms_shingo('<?php echo $list[$i]['it_id'];?>', '<?php echo $comment_id;?>', 'lock'); return false;">
											<span class="text-muted media-btn">잠금</span>
										</a>
									<?php } ?>
								<?php } ?>
							</div>
						<?php } ?>
					</div>
					<div class="media-content">
						<?php if (strstr($list[$i]['wr_option'], "secret")) { ?>
							<img src="<?php echo $item_skin_url;?>/img/icon_secret.gif" alt="">
						<?php } ?>
						<?php echo ($is_replyname && $list[$i]['reply_name']) ? '<b>[<span class="en">@</span>'.$list[$i]['reply_name'].']</b>'.PHP_EOL : ''; ?>
						<?php echo $comment ?>
						<?php if(!G5_IS_MOBILE) { // PC ?>
							<span id="edit_<?php echo $comment_id ?>"></span><!-- 수정 -->
							<span id="reply_<?php echo $comment_id ?>"></span><!-- 답변 -->
							<input type="hidden" value="<?php echo $itemcomment_url.'&amp;page='.$page; ?>" id="comment_url_<?php echo $comment_id ?>">
							<input type="hidden" value="<?php echo $page; ?>" id="comment_page_<?php echo $comment_id ?>">
							<input type="hidden" value="<?php echo strstr($list[$i]['wr_option'],"secret") ?>" id="secret_comment_<?php echo $comment_id ?>">
							<textarea id="save_comment_<?php echo $comment_id ?>" style="display:none"><?php echo get_text($list[$i]['content1'], 0) ?></textarea>
						<?php } ?>
					</div>
			  </div>
			</div>
			<?php if(G5_IS_MOBILE) { // Mobile ?>
				<span id="edit_<?php echo $comment_id ?>"></span><!-- 수정 -->
				<span id="reply_<?php echo $comment_id ?>"></span><!-- 답변 -->
				<input type="hidden" value="<?php echo $itemcomment_url.'&amp;page='.$page; ?>" id="comment_url_<?php echo $comment_id ?>">
				<input type="hidden" value="<?php echo $page; ?>" id="comment_page_<?php echo $comment_id ?>">
				<input type="hidden" value="<?php echo strstr($list[$i]['wr_option'],"secret") ?>" id="secret_comment_<?php echo $comment_id ?>">
				<textarea id="save_comment_<?php echo $comment_id ?>" style="display:none"><?php echo get_text($list[$i]['content1'], 0) ?></textarea>
			<?php } ?>
		<?php } ?>
	</section>

	<?php if($total_page > 1) { ?>
		<div class="item-page text-center">
			<ul class="pagination pagination-sm en no-margin">
				<?php echo apms_ajax_paging('itemcomment', $write_pages, $page, $total_page, $list_page); ?>
			</ul>
		</div>
	<?php } ?>
</div>
<!-- } 댓글 끝 -->

<?php if($is_item) { //페이지 이동시 작동안함 ?>
	<?php if ($is_comment_write) { ?>
		<aside id="it_vc_w">
			<form id="fviewcomment" name="fviewcomment" class="form" role="form" action="<?php echo $itemcomment_action_url;?>" onsubmit="return fviewcomment_submit(this);" method="post" autocomplete="off">
			<input type="hidden" name="w" value="<?php echo $w ?>" id="w">
			<input type="hidden" name="it_id" value="<?php echo $it_id ?>">
			<input type="hidden" name="ca_id" value="<?php echo $ca_id;?>">
			<input type="hidden" name="comment_id" value="<?php echo $c_id; ?>" id="comment_id">
			<input type="hidden" name="comment_url" value="" id="comment_url">
			<input type="hidden" name="crows" value="<?php echo $crows;?>">
			<input type="hidden" name="page" value="" id="comment_page">

				<div class="comment-box">
					<div class="help-block">
						<i class="fa fa-smile-o fa-lg"></i>
						판매, 양도, 광고, 욕설, 비방, 도배 등의 댓글은 예고 없이 삭제되며, 전화번호, 메일 등 개인정보는 절대 남기지 말아 주세요. 
					</div>

					<div class="form-group comment-content">
						<div class="comment-cell">
							<textarea id="wr_content" name="wr_content" rows=5 maxlength="10000" required class="form-control input-sm"><?php echo $c_wr_content;  ?></textarea>
						</div>
						<div tabindex="14" class="comment-cell comment-submit" onclick="apms_comment('itemcomment');" onKeyDown="apms_comment_onKeyDown();" id="btn_submit">
							등록
						</div>
						<script>
						function apms_comment_onKeyDown() {
							  if(event.keyCode == 13) {
								apms_comment('itemcomment');
							 }
						 }
						</script>
					</div>

					<div class="comment-btn">
						<div class="form-group pull-right">
							<span class="cursor">
								<label class="checkbox-inline"><input type="checkbox" name="wr_secret" value="secret" id="wr_secret"> 비밀글</label>
							</span>
							<span class="cursor" title="이모티콘" onclick="apms_emoticon();">
								<i class="fa fa-smile-o fa-lg"></i><span class="sound_only">이모티콘</span>
							</span>
							<span class="cursor" title="새댓글" onclick="comment_box('','c');">
								<i class="fa fa-pencil fa-lg"></i><span class="sound_only">새댓글 작성</span>
							</span>
							<span class="cursor" title="새로고침" onclick="apms_page('viewcomment','<?php echo $comment_url;?>');">
								<i class="fa fa-refresh fa-lg"></i><span class="sound_only">댓글 새로고침</span>
							</span>
							<span class="cursor" title="늘이기" onclick="apms_textarea('wr_content','down');">
								<i class="fa fa-plus-circle fa-lg"></i><span class="sound_only">입력창 늘이기</span>
							</span>
							<span class="cursor" title="줄이기" onclick="apms_textarea('wr_content','up');">
								<i class="fa fa-minus-circle fa-lg"></i><span class="sound_only">입력창 줄이기</span>
							</span>
						</div>	
						<?php if($is_comment_sns) { ?>
							<div id="it_vc_opt" class="form-group pull-left">
								<ol>
									<li id="it_vc_send_sns"></li>
								</ol>
							</div>
						<?php } ?>
						<div class="clearfix"></div>
					</div>
				</div>
			</form>
		</aside>
	<?php } else { ?>
		<div class="well text-center no-margin">
			<?php if($is_author_comment) { ?>
				지정된 회원만 댓글 등록이 가능합니다.
			<?php } else { ?>
				<a href="<?php echo $itemcomment_login_url;?>">로그인한 회원만 댓글 등록이 가능합니다.</a>
			<?php } ?>
		</div>
	<?php } ?>
<?php } ?>