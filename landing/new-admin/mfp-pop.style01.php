
<div id="pop-style1" class="layerPopup zoom-anim-dialog mfp-hide">
	<div class="popContainer">
		
		<header class="pop-header">
			프로젝트 목록
		</header>

		<form name="" action="" method="post">
		<div class="tbl-basic cell td-h1">
			<div class="tbl-header">
				<div class="caption">총 000건</div>
			</div>
			<table id="resident_list">
				<colgroup>
					<col width="60">
					<col>
					<col width="180">
					<col width="180">
				</colgroup>
				<thead>
					<tr>
						<th><label class="checkbox-wrap"><input type="checkbox" class="chkall" data-group="bo_chk" /><span></span></label></th>
						<th>프로젝트명</th>
						<th>담당자</th>
						<th>소속</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><label class="checkbox-wrap"><input type="checkbox" name="" class="bo_chk" /><span></span></label></td>
						<td>
							<div class="tipContainer">
								<span class="el">콘텐츠기업 온라인상담회</span>
								<div class="hidden-box">
									담당자 : 정진일<br>
									연락처 : +83-22-555<br>
									E-mail : abcdefg@abcd.com
								</div>
							</div>
						</td>
						<td>홍길동</td>
						<td>콘진원</td>
					</tr>
					<tr>
						<td><label class="checkbox-wrap"><input type="checkbox" name="" class="bo_chk" /><span></span></label></td>
						<td>
							<div class="tipContainer">
								<span class="el">콘텐츠기업 온라인상담회</span>
								<div class="hidden-box">
									담당자 : 정진일<br>
									연락처 : +83-22-555<br>
									E-mail : abcdefg@abcd.com
								</div>
							</div>
						</td>
						<td>홍길동</td>
						<td>콘진원</td>
					</tr>
					<tr>
						<td><label class="checkbox-wrap"><input type="checkbox" name="" class="bo_chk" /><span></span></label></td>
						<td>
							<div class="tipContainer">
								<span class="el">콘텐츠기업 온라인상담회</span>
								<div class="hidden-box">
									담당자 : 정진일<br>
									연락처 : +83-22-555<br>
									E-mail : abcdefg@abcd.com
								</div>
							</div>
						</td>
						<td>홍길동</td>
						<td>콘진원</td>
					</tr>
				</tbody>			
			</table>
			<div class="tbl-footer">
				<a href="#" class="btn black mini">선택 삭제</a>
			</div>
			<div class="btnSet">
				<a href="#" class="btn large blue span120">등록하기</a>
				<a href="#" class="btn large gray popClose">취소</a>
			</div>
		</div>
		</form>

	</div>	
</div>



<script>
function all_checked(sw) {
	var f = document.fboardlist;

	for (var i=0; i<f.length; i++) {
		if (f.elements[i].name == "chk[]")
			f.elements[i].checked = sw;
	}
}
</script>