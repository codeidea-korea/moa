<?php

//echo $it_id."<BR>";
$list = get_item_detail($it_id);
// print_r2($list);

$cnt = 0;
if ($list)
	$cnt = count($list);
for ($i=0; $i < $cnt; $i++) {
	echo $list[$i]['day']." ".$list[$i]['time']."<BR>";
}
	echo " PHP 에서  print_r2(\$list);이걸로 찍어서 확인하시면 정보 볼수있습니다. <BR>";
?>

	<h3>열린 수업 일정 선택 <i class="icon icon-caret"></i></h3>
		<ul class="class-schedule columns">
			<li class="column col-4 col-md-6">
				<div class="card">
					<div class="card-header">
						<label class="form-checkbox form-inline">
							<input type="checkbox"><i class="form-icon"></i> 수강신청 가능
						</label>
					</div>
					<dl class="class-schedule">
						<dt>수업 일정</dt>
						<dd>19년 3월 27일 수요일 (16:00 ~ 19:00)</dd>
					</dl>
				</div>
			</li>
			<li class="column col-4 col-md-6">
				<div class="card">
					<div class="card-header">
						<label class="form-checkbox form-inline">
							<input type="checkbox"><i class="form-icon"></i> 수강신청 가능
						</label>
					</div>
					<dl class="class-schedule">
						<dt>수업 일정</dt>
						<dd>19년 3월 27일 수요일 (16:00 ~ 19:00)</dd>
					</dl>
				</div>
			</li>
			<li class="column col-4 col-md-6">
				<div class="card is-close">
					<div class="card-header">
						<label class="form-checkbox form-inline">
							<input type="checkbox" disabled><i class="form-icon"></i> 수강신청 불가
						</label>
					</div>
					<dl class="class-schedule">
						<dt>수업 일정</dt>
						<dd>19년 3월 27일 수요일 (16:00 ~ 19:00)</dd>
					</dl>
				</div>
			</li>
		</ul>
		<button type="button" class="btn btn-lg btn-block">일정 더보기</button>