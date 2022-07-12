<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
?>

<div class="section-title">문의 관리</div>

<div class="boxContainer padding40">
	
	<form class="form" role="form" name="flist">
	<input type="hidden" name="ap" value="<?php echo $ap;?>">
	<input type="hidden" name="page" value="<?php echo $page; ?>">
	<input type="hidden" name="save_opt" value="<?php echo $opt; ?>">
	<div class="data-search-wrap fx-wrap label120">
		<div class="fx-list none">
			<div class="fx-list-label">검색</div>
			<div class="fx-list-con">
				<select name="sca" id="sca" class="form-control input-sm">
					<option value="">카테고리</option>
					<?php echo $category_options;?>
				</select>
				<script>document.getElementById("sca").value = "<?php echo $sca; ?>";</script>
				<select name="opt" id="opt" class="form-control input-sm">
					<option value="">전체보기</option>
					<option value="1">답변대기</option>
					<option value="2">답변완료</option>
				</select>
				<script>document.getElementById("opt").value = "<?php echo $opt; ?>";</script>
				<button type="submit" class="btn span70">조회</button>
				<a href="./?ap=<?php echo $ap;?>" class="btn reverse gray">초기화</a>
			</div>
		</div>

		<div class="fx-list">
            <div class="fx-list-label">모임 날짜</div>
            <div class="fx-list-con">
                <label class="inp-wrap label-inline"><input type="text" id="sch_startdt"  name="sch_startdt" value="<?php echo $sch_startdt;?>" class="span160 datepicker" placeholder="날짜 선택"><span class="label"></span></label>
                <span>~</span>
                <label class="inp-wrap label-inline"><input type="text" id="sch_enddt" name="sch_enddt" value="<?php echo $sch_enddt;?>" class="span160 datepicker" placeholder="날짜 선택"><span class="label"></span></label>
                <div class="datepickContainer small">
                    <a href="javascript:" onclick="setdate(1);"  class="dl todays">오늘</a>
                    <a href="javascript:" onclick="setdate(2);"  class="dl month1">1개월</a>
                    <a href="javascript:" onclick="setdate(3);"  class="dl month6">6개월</a>
                    <a href="javascript:" onclick="setdate(4);"  class="dl year1 ">1년</a>
                    <a href="javascript:" onclick="setdate(5);"  class="dl year5">5년</a>
                    <a href="javascript:" onclick="setdate(0);"  class="dl allday">전체</a>
                </div>
                <script>
                    var today = "<?php echo $rday['today'];?>";
                    var month1ago = "<?php echo $rday['month1ago'];?>";
                    var month6ago = "<?php echo $rday['month6ago'];?>";
                    var year1ago = "<?php echo $rday['year1ago'];?>";
                    var year5ago = "<?php echo $rday['year5ago'];?>";

                    function setdate(type) {
                        var sdt = today;
                        var edt = today;
                        $(".dl").removeClass("active");
                        switch(type) {
                            case 1 :
                                sdt = today;
                                $(".todays").addClass("active");
                                break;
                            case 2 :
                                sdt = month1ago;
                                $(".month1").addClass("active");
                                break;
                            case 3 :
                                sdt = month6ago;
                                $(".month6").addClass("active");
                                break;
                            case 4 :
                                sdt = year1ago;
                                $(".year1").addClass("active");
                                break;
                            case 5 :
                                sdt = year5ago;
                                $(".year5").addClass("active");
                                break;
                            default :
                                sdt = '2022-01-01';
                                edt = today;
                                $(".allday").addClass("active");
                                break;
                        }
                        $("#sch_startdt").val(sdt);
                        $("#sch_enddt").val(edt);

                    }
                    $(function() {
                        <?php if(!$sch_startdt) { ?>
                        setdate(0);
                        <?php } ?>
                    });
                </script>
            </div>
		</div>
		<div class="fx-list">
			<div class="fx-list-label">검색</div>
			<div class="fx-list-con">
				<select id="sca" name="sca">
<!--					<option value="iq_question" --><?php //echo $sca == 'iq_question' ? 'selected' : ''; ?><!--상품명</option>-->
					<option value="iq_question" <?php echo $sca == 'iq_question' ? 'selected' : ''; ?>>문의 내용</option>
					<option value="iq_name" <?php echo $sca == 'iq_name' ? 'selected' : ''; ?>>문의한 게스트</option>
				</select>
				<input type="text" name="stx" value="<?php echo $stx; ?>" placeholder="검색어를 입력해주세요.">
			</div>
		</div>
		<div class="btnSet">
			<button type="submit" class="btnSearch">조회</button>
			<a href="./?ap=<?php echo $ap;?>" class="btnReset">초기화</a>
		</div>
	</div>
	</form>


	<p class="mb10">문의 수 <?php echo number_format($total_count);?></p>
	
	<div class="tbl-basic outline odd th-h5 ">
		<table>
			<colgroup>
				<col width="150">
				<col width="150">
				<col>
				<col>
				<col>
				<col>
				<col width="150">
			</colgroup>
			<thead>
				<tr>
					<th scope="col">상태</th>
					<th scope="col">비밀글</th>
					<th scope="col">문의내용</th>
					<th scope="col">문의한 게스트</th>
					<th scope="col">최종 문의일</th>
					<th scope="col">최종 답변일</th>
					<th scope="col">답변관리</th>
				</tr>
			</thead>
			<tbody>
				<?php  for ($i=0; $i < count($list); $i++) { ?>
				<tr>
					<td><?=$list[$i]['iq_answer']?'답변완료':'답변대기'?></td>
					<td><?=$list[$i]['iq_secret']?'비밀글':'공개글'?></td>
					<td><?php echo nl2br($list[$i]['iq_question']); ?></td>
					<td><?php echo $list[$i]['iq_name']; ?></td>
					<td><?php echo apms_datetime($list[$i]['iq_time'], 'Y-m-d');?></td>
					<td>
						<?php 
						if ($list[$i]['iq_answer']){
							echo substr($list[$i]['pt_answer_time'],0,10);
						}else{
							echo "-";
						}
						?>
					</td>
					<td><a href="<?php echo $list[$i]['ans_href'];?>" class="btn small <?=$list[$i]['iq_answer']?'gray':''?>"><?=$list[$i]['iq_answer']?'답변수정':'답변하기'?></a></td>
				</tr>
				<?php } ?>
				<?php  if ($i == 0) echo '<tr><td colspan="7" class="text-center">등록된 문의가 없습니다.</td></tr>'; ?>
			</tbody>
		</table>
	</div>
	
	<ul class="pagination">
		<?php echo apms_paging($write_pages, $page, $total_page, $list_page); ?>
	</ul>

	<!------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------>
	<!------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------>
	<!------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------>

	<div class="at-media none">
	<?php 
		for ($i=0; $i < count($list); $i++) { 
			// 이미지
			if($list[$i]['iq_photo']) {
				$img['src'] = $list[$i]['iq_photo'];
			} else {
				$img = apms_it_write_thumbnail($list[$i]['it_id'], $list[$i]['iq_question'], 80, 80);
				$img['src'] = $img['src'];
			}
	?>
		<div class="media">
			<div class="img-thumbnail photo pull-left">
				<a href="#" onclick="more_iq('more_iq_<?php echo $i; ?>'); return false;">
					<?php echo ($img['src']) ? '<img src="'.$img['src'].'" alt="'.$img['src'].'">' : '<i class="fa fa-user"></i>'; ?>
				</a>
			</div>
			<div class="media-body">
				<h5 class="media-heading">
					<a href="#" onclick="more_iq('more_iq_<?php echo $i; ?>'); return false;">
						<span class="pull-right text-muted font-11 en">no.<?php echo $list[$i]['iq_num']; ?></span>
						<?php if($list[$i]['iq_secret']) { ?>
							<i class="fa fa-lock orange"></i>
						<?php } ?>					
						<?php echo $list[$i]['iq_subject']; ?>
					</a>
				</h5>
				<div class="media-item">
					<a href="<?php echo $list[$i]['it_href'];?>" target="_blank"><span class="text-muted"><?php echo $list[$i]['it_name']; ?></span></a>
				</div>
				<div class="media-info en text-muted">
					<?php if($list[$i]['iq_answer']) { ?>
						<span class="blue"><i></i> 답변완료</span>
					<?php } else { ?>
						<i></i> 답변대기
					<?php } ?>

					<i class="fa fa-user"></i>
					<?php echo $list[$i]['iq_name']; ?>

					<i class="fa fa-clock-o"></i>
					<time datetime="<?php echo date('Y-m-d\TH:i:s+09:00', $list[$i]['iq_time']) ?>"><?php echo apms_datetime($list[$i]['iq_time'], 'Y.m.d H:i');?></time>

				</div>
				<div class="media-content media-resize" id="more_iq_<?php echo $i; ?>" style="display:none;">
					<?php echo get_view_thumbnail($list[$i]['iq_question'], $default['pt_img_width']); // 문의 내용 ?>
					<?php if($list[$i]['iq_answer']) { ?>
						<div class="media media-reply">
							<div class="photo-ans pull-left">
								<?php echo ($list[$i]['ans_photo']) ? '<img src="'.$list[$i]['ans_photo'].'" alt="">' : '<i class="fa fa-user"></i>'; ?>
							</div>
							<div class="media-body">
								<?php echo get_view_thumbnail($list[$i]['iq_answer'], $default['pt_img_width']); ?>
								<div style="margin-top:10px;">
									<a href="<?php echo $list[$i]['ans_href'];?>" class="btn btn-default btn-sm"><i class="fa fa-comment"></i> 답변수정</a>
								</div>
							</div>
						</div>
					<?php } else { ?>
						<div style="margin-top:10px;">
							<a href="<?php echo $list[$i]['ans_href'];?>" class="btn btn-default btn-sm"><i class="fa fa-comment"></i> 답변하기</a>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
	<?php } ?>
	</div>

	<?php if ($i == 0) echo '<p class="text-center text-muted none" style="padding:50px 0px;">등록된 문의가 없습니다.</p>'; ?>

	<?php if($total_count > 0) { ?>
		<div class="text-center none">
			<ul class="pagination pagination-sm en">
				<?php echo apms_paging($write_pages, $page, $total_page, $list_page); ?>
			</ul>
		</div>
	<?php } ?>

</div>

<script>
function more_iq(id) {
	$("#" + id).toggle();
}
</script>