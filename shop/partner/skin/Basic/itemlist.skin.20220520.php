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

	<form name="" action="" method="post">
	<div class="data-search-wrap fx-wrap label120">
		<div class="fx-list">
			<div class="fx-list-label">검색</div>
			<div class="fx-list-con">
				<select class="">
					<option>호스트명</option>
					<option>모임명</option>
					<option>모임ID</option>
				</select>
				<input type="text" name="" value="" class="span160" placeholder="모임명/호스트명">
			</div>
		</div>
		<div class="fx-list">
			<div class="fx-list-label">모임 유형</div>
			<div class="fx-list-con">
				<select class="">
					<option>오프라인</option>
					<option>온라인</option>
					<option>전체</option>
				</select>
				<select class="">				
					<option>N회차</option>
					<option>1회차</option>
				</select>
				<select class="">
					<option>자율형 모임</option>
					<option>고정형 모임</option>
				</select>
			</div>
		</div>
		<div class="fx-list flex-top">
			<div class="fx-list-label">모임 날짜</div>
			<div class="fx-list-con">
				<label class="inp-wrap label-inline"><input type="text" name="" value="" class="span160 datepicker" placeholder="날짜 선택"><span class="label"></span></label>
				<span>~</span>
				<label class="inp-wrap label-inline"><input type="text" name="" value="" class="span160 datepicker" placeholder="날짜 선택"><span class="label"></span></label>
				<div class="datepickContainer small">
					<a href="#" class="dl active">오늘</a>
					<a href="#" class="dl">1개월</a>
					<a href="#" class="dl">6개월</a>	
					<a href="#" class="dl">1년</a>	
					<a href="#" class="dl">5년</a>
					<a href="#" class="dl">전체</a>
				</div>
				<p class="span mt10">
					<label class="radio-wrap"><input type="radio" name="rrr" value="" ><span></span>승인된 모임만 보기</label>
					<label class="radio-wrap"><input type="radio" name="rrr" value="" checked><span></span>폐강된 모임만 보기</label>
				</p>
			</div>
		</div>
		<div class="btnSet">
			<button type="submit" class="btnSearch">조회</button>
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

		<div class="tbl-basic outline odd th-h5 line-nth-1 none">
			<table>
			<thead>
			<tr>
				<th width="40" class="text-center" scope="col">
					<label for="chkall" class="sound_only">전체</label>
					<input type="checkbox" name="chkall" value="1" id="chkall" onclick="check_all(this.form)">
				</th>
				<th width="60" class="text-center" scope="col">순서</th>
				<th width="60" class="text-center" scope="col">이미지</th>
				<th class="text-center" scope="col"><?php echo subject_sort_link('it_name', 'ap='.$ap.'&amp;sca='.$sca); ?>제목</a></th>
				<th width="100" class="text-center" scope="col"><?php echo subject_sort_link('it_id', 'ap='.$ap.'&amp;sca='.$sca); ?>상품코드</a></th>
				<th width="100" class="text-right" scope="col"><?php echo subject_sort_link('it_price', 'ap='.$ap.'&amp;sca='.$sca); ?>가격</a></th>
				<th width="80" class="text-right" scope="col"><?php echo subject_sort_link('it_point', 'ap='.$ap.'&amp;sca='.$sca); ?>포인트</a></th>
				<th width="80" class="text-right" scope="col"><?php echo subject_sort_link('it_stock_qty', 'ap='.$ap.'&amp;sca='.$sca); ?>재고</a></th>
				<th width="80" class="text-center" scope="col"><?php echo subject_sort_link('it_use', 'ap='.$ap.'&amp;sca='.$sca); ?>판매</a></th>
				<th width="60" class="text-center" scope="col"><?php echo subject_sort_link('it_soldout', 'ap='.$ap.'&amp;sca='.$sca); ?>품절</a></th>
				<th width="60" class="text-center" scope="col">관리</th>
				<th width="60" class="text-center" scope="col">비고</th>
			</tr>
			</thead>
			<tbody>
			<?php for ($i=0; $i < count($list); $i++) { ?>
			<tr>
				<td class="text-center">
					<label for="chk_<?php echo $i; ?>" class="sound_only"><?php echo get_text($list[$i]['it_name']); ?></label>
					<input type="checkbox" name="chk[]" value="<?php echo $i ?>" id="chk_<?php echo $i; ?>">
					<input type="hidden" name="it_id[<?php echo $i; ?>]" value="<?php echo $list[$i]['it_id']; ?>">
				</td>
				<td class="text-center">
					<input type="text" name="pt_show[<?php echo $i; ?>]" value="<?php echo $list[$i]['pt_show']; ?>" size="4" class="frm_input">
				</td>
				<td class="text-center">
					<a href="<?php echo $list[$i]['href']; ?>">
						<?php echo get_it_image($list[$i]['it_id'], 40, 40);?>
						<?php// echo get_it_image($list[$i]['wr_subject'], 40, 40);?>
					</a>
				</td>
				<td>
					<a href="<?php echo $list[$i]['href']; ?>"><b><?php echo $list[$i]['it_name'];?></b></a>
					<div class="text-muted" style="margin-top:4px;">
						<?php echo apms_pt_it($list[$i]['pt_it'],1);?>
						<?php echo ($list[$i]['ca_name1']) ? ' / '.$list[$i]['ca_name1'] : '';?>
						<?php echo ($list[$i]['ca_name2']) ? ' / '.$list[$i]['ca_name2'] : '';?>
						<?php echo ($list[$i]['ca_name3']) ? ' / '.$list[$i]['ca_name3'] : '';?>
					</div>
				</td>
				<td class="text-center">
					<a href="<?php echo $list[$i]['href']; ?>">
						<nobr><?php echo $list[$i]['it_id'];?></nobr>
					</a>
				</td>
				<td class="text-right">
					<?php echo number_format($list[$i]['it_price']); ?>
				</td>
				<td class="text-right">
					<?php echo ($list[$i]['it_point_type']) ? $list[$i]['it_point'].'%' : number_format($list[$i]['it_point']); ?>
				</td>
				<td class="text-right">
					<?php echo number_format($list[$i]['it_stock_qty']); ?>
				</td>
				<td class="text-center">
					<label for="use_<?php echo $i; ?>" class="sound_only">판매여부</label>
					<input type="checkbox" name="it_use[<?php echo $i; ?>]" <?php echo ($list[$i]['it_use'] ? 'checked' : ''); ?> value="1" id="use_<?php echo $i; ?>">
				</td>
				<td class="text-center">
					<label for="soldout_<?php echo $i; ?>" class="sound_only">품절</label>
					<input type="checkbox" name="it_soldout[<?php echo $i; ?>]" <?php echo ($list[$i]['it_soldout'] ? 'checked' : ''); ?> value="1" id="soldout_<?php echo $i; ?>">
				</td>
				<!--<td class="text-center">
					<a href="./?ap=item&amp;w=u&amp;it_id=<?php echo $list[$i]['it_id']; ?>&amp;fn=<?php echo $list[$i]['pt_form'];?>&amp;ca_id=<?php echo $list[$i]['ca_id']; ?>">수정</a>
				</td>-->
				<td class="td_mng td_mng_s">
					<a href="./?ap=moa_write&amp;w=u&amp;wr_id=<?php echo $list[$i]['wr_id']?>" class="btn btn_03 mini">수정</a>
				</td>
				<td class="text-center">
					<?php echo ($list[$i]['pt_reserve_use']) ? subject_sort_link('pt_reserve_use', 'mode=list&amp;sca='.$sca, 1).'예약</a>' : ''; ?>
				</td>
			</tr>
			<?php } ?>
			<?php if ($i == 0) { ?>
				<tr><td colspan="12" class="text-center">등록된 자료가 없습니다.</td></tr>
			<?php } ?>
			</tbody>
			</table>
		</div>
		
		<!--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
		<!--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
		<!--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->

		<div class="tbl-basic outline odd th-h5 fs15 line-nth-1">
			<table>
			<colgroup>
				<col width="60">
				<col width="90">
				<col width="160">
				<col width="120">
				<col>
			</colgroup>
			<thead>
			<tr>
				<th scope="col">
					<label for="chkall" class="sound_only">전체</label>
					<input type="checkbox" name="chkall" value="1" id="chkall" onclick="check_all(this.form)">
				</th>
				<th scope="col">순서</th>
				<th scope="col"><?php echo subject_sort_link('it_id', 'ap='.$ap.'&amp;sca='.$sca); ?>모임ID</a></th>				
				<th scope="col">썸네일</th>
				<th scope="col"><?php echo subject_sort_link('it_name', 'ap='.$ap.'&amp;sca='.$sca); ?>모임명</a></th>
				<th scope="col">모임상태</th>
				<th scope="col"><?php echo subject_sort_link('it_price', 'ap='.$ap.'&amp;sca='.$sca); ?>정가가격</a></th>
				<th scope="col">인원수</th>
				<th scope="col">모집마감일</th>
				<th scope="col">모임 일시</th>
				<th scope="col">승인상태</th>
				<th scope="col">폐강여부</th>
				<th scope="col">관리</th>
			</tr>
			</thead>
			<tbody>
			<?php for ($i=0; $i < count($list); $i++) { ?>
			<tr>
				<td>
					<label for="chk_<?php echo $i; ?>" class="sound_only"><?php echo get_text($list[$i]['it_name']); ?></label>
					<input type="checkbox" name="chk[]" value="<?php echo $i ?>" id="chk_<?php echo $i; ?>">
					<input type="hidden" name="it_id[<?php echo $i; ?>]" value="<?php echo $list[$i]['it_id']; ?>">
				</td>
				<td>
					<input type="text" name="pt_show[<?php echo $i; ?>]" value="<?php echo $list[$i]['pt_show']; ?>" size="4" class="span55">
				</td>
				<td>
					<a href="<?php echo $list[$i]['href']; ?>"><nobr><?php echo $list[$i]['it_id'];?></nobr></a>
				</td>
				<td>
					<a href="<?php echo $list[$i]['href']; ?>"><?php echo get_it_image($list[$i]['it_id'], 80, 80);?></a>
				</td>				
				<td class="tleft">
					<a href="<?php echo $list[$i]['href']; ?>"><b><?php echo $list[$i]['it_name'];?></b></a>
					<sub class="block">
						<?php echo apms_pt_it($list[$i]['pt_it'],1);?>
						<?php echo ($list[$i]['ca_name1']) ? ' / '.$list[$i]['ca_name1'] : '';?>
						<?php echo ($list[$i]['ca_name2']) ? ' / '.$list[$i]['ca_name2'] : '';?>
						<?php echo ($list[$i]['ca_name3']) ? ' / '.$list[$i]['ca_name3'] : '';?>
					</sub>
				</td>
				<td>종료</td><!-- [종료, 모집중, 모집완료] -->				
				<td >
					<?php echo number_format($list[$i]['it_price']); ?>
				</td>
				<td><span data-href="#pop-moim-info" class="pop-inline color-blue">5/5</span></td>
				<td>2022-03-01</td>
				<td>고정형<sub class="block">2022-03-01 20:20</sub></td><!-- [고정형, 자율형] -->
				<td>승인</td><!-- [승인, 대기중, 반려] -->
				<td><span data-href="#pop-cancel-class" class="pop-inline btn mini span50">폐강</span></td>
				<td class="td_mng td_mng_s">
					<a href="./?ap=moa_write&amp;w=u&amp;wr_id=<?php echo $list[$i]['wr_id']?>" class="btn btn_03 mini">수정</a>
					<a href="#" class="btn btn_01 mini">삭제</a>
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

<script>
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
</script>
