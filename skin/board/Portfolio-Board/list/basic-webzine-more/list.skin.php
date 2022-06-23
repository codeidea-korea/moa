<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 썸네일 - 기본 400x300 크기(4:3)
$thumb_w = (isset($boset['thumb_w']) && $boset['thumb_w'] > 0) ? (int)$boset['thumb_w'] : 400;
$thumb_h = (isset($boset['thumb_h']) && $boset['thumb_h'] > 0) ? (int)$boset['thumb_h'] : 300;
$thumb_s = (isset($boset['thumb_s']) && $boset['thumb_s']) ? $boset['thumb_s'] : ''; //유튜브 1.35
$img_h = apms_img_height($thumb_w, $thumb_h, '75');

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$list_skin_url.'/list.css" media="screen">', 0);

// 간격 - 기본 15px
$gap = (isset($boset['gap']) && ($boset['gap'] > 0 || $boset['gap'] == "0")) ? (int)$boset['gap'] : 15;

// 반응형 - 기본 너비
$item = (isset($boset['item']) && $boset['item'] > 0) ? (int)$boset['item'] : 27;
$lg = (isset($boset['lg']) && $boset['lg'] > 0) ? (int)$boset['lg'] : 35;
$md = (isset($boset['md']) && $boset['md'] > 0) ? (int)$boset['md'] : 40;
$sm = (isset($boset['sm']) && $boset['sm'] > 0) ? (int)$boset['sm'] : 45;

// 글내용 - 기본 200자
$is_cont = (isset($boset['lcont']) && ($boset['lcont'] > 0 || $boset['lcont'] == "0")) ? (int)$boset['lcont'] : 200;

// 줄수 - 기본 5줄
$is_line = (isset($boset['cline']) && $boset['cline'] >= 1) ? (int)$boset['cline'] : 4;
$is_line = ($is_cont) ? $is_line * 20 + 25 : $is_line * 20 + 15; //line-height:20px, 제목과 내용간격 5px

// 썸네일 포토
$fa_color = (isset($boset['ibg']) && $boset['ibg']) ? ' bg-'.$boset['icolor'] : ' bg-light '.$boset['icolor'];
$fa_photo = (isset($boset['ficon']) && $boset['ficon']) ? apms_fa($boset['ficon']) : '<i class="fa fa-picture-o"></i>';

// 날짜
$is_dtype = (isset($boset['dtype']) && $boset['dtype']) ? $boset['dtype'] : 'Y.m.d';

// 숨김설정
$is_vicon = (isset($boset['vicon']) && $boset['vicon']) ? false : true;
$is_name = (isset($boset['lname']) && $boset['lname']) ? false : true;
$is_hit = (isset($boset['lhit']) && $boset['lhit']) ? false : true;
$is_category = (isset($boset['lcate']) && $boset['lcate']) ? false : $is_category;
$is_date = (isset($boset['ldate']) && $boset['ldate']) ? false : true;

// 보임설정
$is_down = (isset($boset['ldown']) && $boset['ldown']) ? true : false;
$is_dpoint = (isset($boset['ldpoint']) && $boset['ldpoint']) ? true : false;
$is_visit = (isset($boset['lvisit']) && $boset['lvisit']) ? true : false;
$is_good = (isset($boset['lgood']) && $boset['lgood']) ? true : false;
$is_nogood = (isset($boset['lnogood']) && $boset['lnogood']) ? true : false;
$is_mb = (isset($boset['lmb']) && $boset['lmb']) ? ' is-photo' : '';

$is_style = (isset($boset['lbody']) && $boset['lbody']) ? $boset['lbody'] : 'basic';

?>
<style>
	.list-body { margin-top:<?php echo (isset($boset['tgap']) && $boset['tgap'] > 0) ? $boset['tgap'] : 0;?>px;  } 
	.list-body .list-img { width:<?php echo $item;?>%;  } 
	.list-body .img-wrap { padding-bottom:<?php echo $img_h;?>% !important; }
	.list-body .list-desc { height:<?php echo $is_line;?>px; }
	<?php if($thumb_s) { //스케일 ?>
	.list-body .list-img .wr-img { -webkit-transform: scale(<?php echo $thumb_s;?>); -moz-transform: scale(<?php echo $thumb_s;?>); -o-transform: scale(<?php echo $thumb_s;?>); -ms-transform: scale(<?php echo $thumb_s;?>); transform: scale(<?php echo $thumb_s;?>); }
	<?php } ?>
	<?php if($gap) { //간격 ?>
	.list-body { overflow:hidden; margin-bottom:-<?php echo $gap;?>px; }
	.list-body .list-col { margin-bottom: <?php echo $gap;?>px; }
	.line-body.list-body .list-box .list-front,
	.line-round-body.list-body .list-box .list-front { padding-bottom:<?php echo $gap;?>px; }
	<?php } ?>
	<?php if($is_mode == "1") { ?>
	.list-board .list-more a:hover { color:<?php echo (isset($boset['moreb']) && $boset['moreb']) ? apms_color($boset['moreb']) : 'orangered';?>; }
	<?php } ?>
	<?php if(_RESPONSIVE_) { //반응형일 때만 작동 ?>
		<?php if($lg) { ?>
		@media (max-width: <?php echo (isset($boset['lgbp']) && $boset['lgbp'] > 0) ? $boset['lgbp'] : 1199;?>px) { 
			.responsive .list-body .list-img { width:<?php echo $lg;?>%; } 
		}
		<?php } ?>
		<?php if($md) { ?>
		@media (max-width: <?php echo (isset($boset['mdbp']) && $boset['mdbp'] > 0) ? $boset['mdbp'] : 991;?>px) { 
			.responsive .list-body .list-img { width:<?php echo $md;?>%; } 
		}
		<?php } ?>
		<?php if($sm) { ?>
		@media (max-width: <?php echo (isset($boset['smbp']) && $boset['smbp'] > 0) ? $boset['smbp'] : 767;?>px) { 
			.responsive .list-body .list-img { width:<?php echo $sm;?>%; } 
		}
		<?php } ?>
	<?php } ?>
</style>
<div class="list-board">
	<?php if($notice_count > 0) { //공지사항 ?>
		<div class="wr-notice">
			<ul class="list-group no-margin">
			<?php for ($i=0; $i < $notice_count; $i++) { 
					if(!$list[$i]['is_notice']) break; //공지가 아니면 끝냄 
			?>
				 <li class="list-group-item">
					<a href="<?php echo $list[$i]['href'];?>"<?php echo $is_modal_js;?>>
						<span class="hidden-xs pull-right text-muted">
							<i class="fa fa-clock-o"></i> <?php echo date("Y.m.d", $list[$i]['date']);?>
						</span>
						<i class="fa fa-bell orangered"></i>
						<strong><?php echo $list[$i]['subject'];?></strong>
						<?php if($list[$i]['wr_comment']) { ?>
							<span class="count red"><?php echo $list[$i]['wr_comment'];?></span>
						<?php } ?>
					</a>
				</li>
			<?php } ?>
			</ul>
		</div>
	<?php } ?>
	<div id="list-body" class="list-body <?php echo $is_style;?>-body <?php echo (isset($boset['lborder']) && $boset['lborder']) ? $boset['lborder'] : 'color';?>-body<?php echo $is_mb;?>">
	<?php 
		$is_ajax = false;
		include_once($list_skin_path.'/list.rows.php'); 
	?>
	</div>
	<div class="clearfix"></div>
	<?php if (!$is_list) { ?>
		<div class="wr-none">게시물이 없습니다.</div>
	<?php } ?>
	<?php if($is_mode) { ?>
		<div id="list-nav">
			<a href="<?php echo $list_skin_url;?>/list.rows.php?bo_table=<?php echo $bo_table;?>&amp;lskin=<?php echo $boset['list_skin'];?><?php echo preg_replace("/&amp;page\=([0-9]+)/", "", $qstr);?>&amp;npg=<?php echo ($page > 1) ? ($page - 1) : 0;?>&amp;page=2"></a>
		</div>
		<?php if($is_mode == "1") { ?>
			<div class="list-more">
				<a id="list-more" class="cursor" title="더보기">
					<i class="fa fa-arrow-circle-down"></i>
				</a>
			</div>
		<?php } ?>
		<script type="text/javascript">
			$(function(){
				var $container = $('#list-body');
				$container.infinitescroll({
					navSelector  : '#list-nav',    // selector for the paged navigation
					nextSelector : '#list-nav a',  // selector for the NEXT link (to page 2)
					itemSelector : '.list-row',     // selector for all items you'll retrieve
					loading: {
						msgText: '로딩 중...',
						finishedMsg: '더이상 글이 없습니다.',
						img: '<?php echo APMS_PLUGIN_URL;?>/img/loader.gif',
					}
				}, function( newElements ) { // trigger Masonry as a callback
					var $newElems = $( newElements ).css({ opacity: 0 });
					$newElems.imagesLoaded(function(){
						$container.append($newElems);
					}).animate({ opacity: 1 });
				});
				<?php if($is_mode == "1") { ?>
				$(window).unbind('.infscr');
				$('#list-more').click(function(){
				   $container.infinitescroll('retrieve');
				   $('#list-nav').show();
					return false;
				});
				$(document).ajaxError(function(e,xhr,opt){
					if(xhr.status==404) $('#list-nav').remove();
				});
				<?php } ?>
			});
		</script>
	<?php } ?>
</div>
<div class="h20"></div>
<?php if ($is_checkbox) { ?>
	<div class="modal fade" id="adminModal" tabindex="-1" role="dialog" aria-labelledby="adminModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-body">
					<div class="form-group">
						<button type="button" class="btn-chkall btn btn-<?php echo $btn2;?> btn-sm btn-block btn-chkall"><i class="fa fa-check"></i> 전체선택</button>
					</div>
					<div class="form-group">
						<button type="submit" name="btn_submit" value="선택삭제" onclick="document.pressed=this.value" class="btn btn-<?php echo $btn1;?> btn-sm btn-block"><i class="fa fa-times"></i> 선택삭제</button>
					</div>
					<div class="form-group">
						<button type="submit" name="btn_submit" value="선택복사" onclick="document.pressed=this.value" class="btn btn-<?php echo $btn1;?> btn-sm btn-block"><i class="fa fa-clipboard"></i> 선택복사</button>
					</div>
					<button type="submit" name="btn_submit" value="선택이동" onclick="document.pressed=this.value" class="btn btn-<?php echo $btn1;?> btn-sm btn-block"><i class="fa fa-arrows"></i> 선택이동</button>
				</div>
			</div>
		</div>
	</div>
<?php } ?>