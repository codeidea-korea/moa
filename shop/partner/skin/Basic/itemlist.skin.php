<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
?>

<?php
//html 팝업
include_once(G5_ADMIN_PATH.'/_add/pop.cancel-class.php'); //폐강처리
include_once($skin_path.'/pop.moim-info.php'); //모임신청인원정보
?>

<div class="section-title">모임 내역</div>

<div class="boxContainer padding40">

	<form name="frm_search" action="/shop/partner/" method="get">
		<input type="hidden" name="ap" value="<?php echo $ap;?>">
		<div class="data-search-wrap fx-wrap label120">
			<div class="fx-list">
				<div class="fx-list-label">검색</div>
				<div class="fx-list-con">
					<select name="sfl" class="">
						<option value="a.it_name"  <?php if ($sfl == 'a.it_name') { echo "selected";}?>>모임명</option>
						<option value="a.it_id"  <?php if ($sfl == 'a.it_id') { echo "selected";}?>>모임ID</option>
						<!-- <option>호스트명</option> -->
					</select>
					<input type="text" name="stx" value="<?php echo $stx?>" class="span160" placeholder="모임명/호스트명">
				</div>
			</div>
			<div class="fx-list">
				<div class="fx-list-label">모임 유형</div>
				<div class="fx-list-con">
					<select name="sch_moa_onoff" class="">
						<option value="">온.오프 전체</option>
						<option value="오프라인" <?php if ($sch_moa_onoff == '오프라인') { echo "selected";}?>>오프라인</option>
						<option value="온라인" <?php if ($sch_moa_onoff == '온라인') { echo "selected";}?>>온라인</option>
					</select>
					<!-- <select name="sch_moa_time" class="">				
						<option>N회차</option>
						<option>1회차</option>
					</select> -->
					<select name="sch_moa_form" class="">
						<option value="">자율+고정 모임</option>
						<option value="자율형" <?php if ($sch_moa_form == '자율형') { echo "selected";}?>>자율형 모임</option>
						<option value="고정형" <?php if ($sch_moa_form == '고정형') { echo "selected";}?>>고정형 모임</option>
					</select>
				</div>
			</div>
			<div class="fx-list flex-top">
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
								sdt = '';
								edt = ''; 
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
					<p class="span mt10">
						<label class="radio-wrap"><input type="radio" name="sch_status" value="all" <?php if ($sch_status == 'all') { echo "checked";}?> ><span></span>전체 모임 보기</label>
						<label class="radio-wrap"><input type="radio" name="sch_status" value="1"  <?php if ($sch_status == '1') { echo "checked";}?>><span></span>승인된 모임만 보기</label>
						<label class="radio-wrap"><input type="radio" name="sch_status" value="5"  <?php if ($sch_status == '5') { echo "checked";}?>><span></span>폐강된 모임만 보기</label>
					</p>
				</div>
			</div>
			<div class="btnSet">
				<button type="submit" class="btnSearch active btn btn-danger btn-sm btn-block">조회</button>
				<a href="./?ap=<?php echo $ap;?>" class="btnReset">초기화</a>
			</div>
		</div>
	</form>

	<div class="well none" style="padding-bottom:3px;">
		<form class="form" role="form" name="flist">
		<input type="hidden" name="ap" value="<?php echo $ap;?>">
		<input type="hidden" name="save_stx" value="<?php echo $stx; ?>">
			<div class="row">
				<div class="col-sm-3">
					<div class="form-group">
						<label for="sca" class="sound_only">분류선택</label>
						<select name="sca" id="sca" class="form-control input-sm">
							<option value="">카테고리</option>
							<?php echo $category_options;?>
						</select>
						<script>document.getElementById("sca").value = "<?php echo $sca; ?>";</script>
					</div>
				</div>
				<div class="col-sm-3">
					<div class="form-group">
						<div class="form-group">
							<label for="stx" class="sound_only">검색어</label>
							<input type="text" name="stx" value="<?php echo $stx ?>" id="stx" class="form-control input-sm" placeholder="제목 검색어">
						</div>
					</div>
				</div>
				<div class="col-sm-3">
					<div class="form-group">
						<button type="submit" class="btn btn-primary btn-sm btn-block"><i class="fa fa-search"></i> 보기</button>
					</div>
				</div>
				<div class="col-sm-3">
					<div class="form-group">
						<a href="./?ap=item" class="btn btn-danger btn-sm btn-block"><i class="fa fa-upload"></i> 신규등록</a>
					</div>
				</div>
			</div>
		</form>
	</div>

	<p class="mb5">총 모임수 <?php echo number_format($total_count); ?>개</p>

	<form class="form" role="form" name="fitemlistupdate" method="post" action="./itemlistupdate.php" onsubmit="return fitemlist_submit(this);" autocomplete="off">
	<input type="hidden" name="ap" value="<?php echo $ap;?>">
	<input type="hidden" name="sca" value="<?php echo $sca; ?>">
	<input type="hidden" name="sst" value="<?php echo $sst; ?>">
	<input type="hidden" name="sod" value="<?php echo $sod; ?>">
	<input type="hidden" name="sfl" value="<?php echo $sfl; ?>">
	<input type="hidden" name="stx" value="<?php echo $stx; ?>">
	<input type="hidden" name="page" value="<?php echo $page; ?>">

		
		<!--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->

		<div class="tbl-basic outline odd th-h5 fs15 line-nth-1">
			<table>
				<colgroup>
					<col width="50">
					<col width="100">
					<col width="130">
					<col>
					<col width="100">
					<col width="100">
					<col width="100">
					<col width="120">
					
				</colgroup>
				<thead>
				<tr>
					<th scope="col">
						<label for="chkall" class="sound_only">전체</label>
						<input type="checkbox" name="chkall" value="1" id="chkall" onclick="check_all(this.form)">
					</th>
					<!-- <th scope="col">순서</th> -->
					<th scope="col"><?php echo subject_sort_link('it_id', 'ap='.$ap.'&amp;sca='.$sca); ?>모임ID</a></th>				
					<th scope="col">썸네일</th>
					<th scope="col"><?php echo subject_sort_link('it_name', 'ap='.$ap.'&amp;sca='.$sca); ?>모임명</a></th>
					<th scope="col"><?php echo subject_sort_link('it_price', 'ap='.$ap.'&amp;sca='.$sca); ?>정가가격</a></th>
					<th scope="col">인원수</th>
					<!-- <th scope="col">모집마감일</th> -->
					<th scope="col">모임 일시</th>
					<th scope="col">모임상태</th>
					<th scope="col">관리</th>
				</tr>
				</thead>
				<tbody>
				<?php for ($i=0; $i < count($list); $i++) {  ?>
					<tr>
						<td>
							<?
							if($row['moa_status'] == 6) {
								?>&nbsp;<?
							} else {
							?>
							<label for="chk_<?php echo $i; ?>" class="sound_only"><?php echo get_text($list[$i]['it_name']); ?></label>
							<input type="checkbox" name="chk[]" value="<?php echo $i ?>" id="chk_<?php echo $i; ?>">
							<input type="hidden" name="it_id[<?php echo $i; ?>]" value="<?php echo $list[$i]['it_id']; ?>">
							<? } ?>
						</td>
						<!-- <td>
							<input type="text" name="pt_show[<?php echo $i; ?>]" value="<?php echo $list[$i]['pt_show']; ?>" size="4" class="span55">
						</td> -->
						<td>
							<a href="<?php echo $list[$i]['href']; ?>"><nobr><?php echo $list[$i]['it_id'];?></nobr></a>
						</td>
						<td>
							<a <?php echo getStatusValue($list[$i]['moa_status']) == '폐강' ? ('class="closed"') : '' ; ?> href="<?php echo $list[$i]['href']; ?>"><img src="<?php echo $list[$i]['as_thumb']; ?>" alt="" width="80px" height="80px"></a>
						</td>				
						<td class="tleft">
						<!--
							<a href="<?php echo $list[$i]['href']; ?>"><b><?php echo $list[$i]['wr_subject'];?></b></a>
							-->
							<span data-href="#pop-moim-info" class="aplyInfo pop-inline color-blue" data-wr_id="<?php echo $list[$i]['wr_id']; ?>" data-it_id="<?php echo $list[$i]['it_id']; ?>">
								<b><?php echo $list[$i]['wr_subject'];?></b>
							</span>

							<sub class="block">
								<?=$list[$i]['moa_onoff']?> / <?=$list[$i]['ca_name']?> / <?=$list[$i]['moa_type']?>
							</sub>
						</td>
						<td >
							<?php if ($list[$i]['it_cust_price']!=$list[$i]['it_price']) { ?>
								<strike style="color:#aaa"><?php echo number_format($list[$i]['wr_3']); ?></strike><br>
							<?php } ?>
							<?php echo number_format($list[$i]['wr_4']); ?>
						</td>
						<td>
							<?php $su = countAplyerMoaClass($list[$i]['it_id']); ?>
							<span data-href="#pop-moim-info" class="aplyInfo pop-inline color-blue" data-it_id="<?php echo $list[$i]['it_id']; ?>">
							<?php echo $su['cnt'] ? $su['cnt'] : '0'; ?>/<?php echo $list[$i]['tot'];?>
							</span>
						</td>
						<td>
							<!-- [고정형, 자율형] -->
							<?php echo $list[$i]['moa_form'];?><sub class="block"><?php echo $list[$i]['day'].' '.$list[$i]['time'];?></sub>
						</td>
						<td>
							<?php 
								$moa_status = getStatusValue($list[$i]['moa_status']);
								if($moa_status == '반려') {
									echo '<span class="aplyInfo pop-inline color-blue" onclick="openRefusePup(\''.$list[$i]['moa_refuse_reason'].'\')">' .$moa_status. '</span>';
								} else {
									echo $moa_status;
								}
							?>
						</td><!-- [승인, 대기중, 반려] -->
						<td class="td_mng td_mng_s">
							<?
							if($row['moa_status'] == 6) {
								?>정산됨<?
							} else {
							?>
							<?
								if(getStatusValue($list[$i]['moa_status']) == '폐강') {
									?>&nbsp;<?
								} else {
									?>
									<span data-href="#pop-cancel-class" data-wr_id="<?php echo $list[$i]['wr_id']; ?>" class="close_moim pop-inline btn mini span50">폐강</span>
									<a href="./?ap=moa_write&amp;w=u&amp;wr_id=<?php echo $list[$i]['wr_id']?>" class="btn btn_03 mini">수정</a>
									<!-- <a href="#" class="btn btn_01 mini">삭제</a> -->
									<?
								}
							}
							?>
						</td>
					</tr>
				<?php } ?>
				<?php if ($i == 0) { ?>
					<tr><td colspan="13" class="text-center">등록된 자료가 없습니다.</td></tr>
				<?php } ?>
				</tbody>
			</table>
		</div>

		<div class="btn_list01 btn_list">
			<input type="submit" name="act_button" value="선택삭제" onclick="document.pressed=this.value" class="btn btn_02">
			<!-- <input type="submit" name="act_button" value="선택수정" onclick="document.pressed=this.value" class="btn btn_02"> -->
		</div>

		<div class="btn_fixed_top">
			<a href="./?ap=moa_write" class="btn btn_01">신규등록</a>
		</div>

		<div class="mt20">
			<?php if($total_count > 0) { ?>
			<ul class="pagination pagination-sm en" style="margin-top:0; padding-top:0;">
				<?php echo apms_paging($write_pages, $page, $total_page, $list_page); ?>
			</ul>
			<?php } ?>
		</div>

	</form>

</div>

<div class="layer-popup" id="popup01">
	<div class="popContainer">
		<div class="pop-inner">
			<span class="pop-closer">팝업닫기</span>
			
			<header class="pop-header">
				반려사유
			</header>

			<div class="text_area">
				<span id="refuse_msg"></span>
			</div>

			<div class="btn_choice">
				<button type="button" class="btnSubmit">확인</button>
			</div>
		</div>
	</div>

	<div class="pop-bg"></div>
</div>

<script>
function openRefusePup(msg){
	$('#refuse_msg').text(msg);
	$('#popup01').addClass('open');
}
function fitemlist_submit(f)
{
    if (!is_checked("chk[]")) {
        alert(document.pressed+" 하실 항목을 하나 이상 선택하세요.");
        return false;
    }

    if(document.pressed == "선택삭제") {
        if(!confirm("선택한 자료를 정말 삭제하시겠습니까?")) {
            return false;
        }
    }

    return true;
}

$('.close_moim').click(function(){
    var wr_id = $(this).data('wr_id');

    $('#fregister').children('input[name="wr_id"]').val(wr_id);
})

$('.aplyInfo').click(function(){
    console.log($(this).data('it_id'));
    $('#applyInfo').children().remove();
    $.ajax({
        type: "POST",
        url: '<?php echo G5_URL; ?>/ajax/getMoimInfo.php',
        data: {
            'it_id': $(this).data('it_id'), 'wr_id': $(this).data('wr_id')
        },
        dataType: "json",
        success: function(data) {
			//console.log(data); return false;
            var info = data.info;

			$('#applyInfo').html('');
			$('#applyPeople').html('');
			
			var sum = 0;
            if(data.info.length > 0) {
                for(var i=0; i<info.length; i++) {
					if(info[i]['status'] != '예약확정') {
						continue;
					}
					sum++;
                    $('#applyPeople').append('<tr>' +
                        '<td>' + info[i]['aplydate'] + ' ' + info[i]['aplytime'] + '</td>' +
                        '<td>' + info[i]['timelimit'] + '</td>' +
//                        '<td>' + su['cnt'] + '/' + su['tot'] + '</td>' +
                        '<td>' + info[i]['status'] + '</td>' +
                        '<td>' + info[i]['mb_name'] + '</td>' +
                        '<td>' + info[i]['mb_hp'] + '</td>' +
                        '</tr>');
                }
            }
			
			var applyInfoHtml = "";
			for(var i=0; i<data.moims.length; i++){
				applyInfoHtml += '<tr>';
				if (i == 0){
					applyInfoHtml += '<td rowspan=' + data.moims.length + '>' + data.moims[i].it_name + '</td>';
					applyInfoHtml += '<td rowspan=' + data.moims.length + '>' + data.moims[i].it_time + '</td>';
				}
				applyInfoHtml += '<td>' + data.moims[i].it_id + '</td>';
				applyInfoHtml += '<td>' + data.moims[i].it_4 + '</td>';
				if (i == 0){
					applyInfoHtml += '<td rowspan=' + data.moims.length + '>' + data.moims[i].wr_2 + '/' + data.moims[i].tot + '</td>';
				}
				applyInfoHtml += '</tr>';
			}
			$('#applyInfo').append(applyInfoHtml);
        }, error: function(error) {
            console.log(error);
        }
    })
})
</script>
