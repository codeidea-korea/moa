<?php

extract($_GET);
//$write_table = $g5['write_table'].$bo_table;
$write_table = "g5_write_teachers";
if (!$wr_id) {
	if ($it && $it['it_2']) {
		$wr_id = $it['it_2'];
	}
}
if ($name) {
	$sql = "SELECT * from $write_table where instr(wr_subject, {$name}) ";
}
if ($wr_id) {
	$sql = "SELECT * from $write_table where wr_id = '{$wr_id}'";
}
$row = sql_fetch($sql);
$bo =  sql_fetch(" select * from {$g5['board_table']} where bo_table = '$bo_table' ");
$skin_url = G5_SKIN_URL."/".(is_mobile())?$bo['bo_mobile_skin']:$bo['bo_skin'];
$pf = get_view2($row,'teachers',$skin_url);

echo $wr_id."<BR>";
//print_r2($pf);


?>
내용이 없는 이유는 선생님으로 등록된 사람이 상품을 등록해야 해당 포트폴리오 정보를 추출할수있습니다.
<br>
	<div class="divider divider-lg" data-content="선생님 포트폴리오"></div>
		
		<div class="portfolio columns">
			<div class="column col-4 col-md-6 col-sm-12">
                <div class="card">
					<div class="card-header">
						<div class="card-title h5">네오위즈 "카발 온라인" 게임 원화</div>
						<div class="card-subtitle text-gray">게임의 컨셉 리드부터 작화 총괄.</div>
					</div>
					<div class="card-image"><img class="img-responsive" src="/drawit/data/portfolio0.jpg"></div>
				</div>
            </div>
			<div class="column col-4 col-md-6 col-sm-12">
                <div class="card">
					<div class="card-header">
						<div class="card-title h5">네오위즈 "카발 온라인" 게임 원화</div>
						<div class="card-subtitle text-gray">게임의 컨셉 리드부터 작화 총괄.</div>
					</div>
					<div class="card-image"><img class="img-responsive" src="/drawit/data/portfolio0.jpg"></div>
				</div>
            </div>
			<div class="column col-4 col-md-6 col-sm-12">
                <div class="card">
					<div class="card-header">
						<div class="card-title h5">네오위즈 "카발 온라인" 게임 원화</div>
						<div class="card-subtitle text-gray">게임의 컨셉 리드부터 작화 총괄.</div>
					</div>
					<div class="card-image"><img class="img-responsive" src="/drawit/data/portfolio0.jpg"></div>
				</div>
            </div>
			<div class="column col-4 col-md-6 col-sm-12">
                <div class="card">
					<div class="card-header">
						<div class="card-title h5">네오위즈 "카발 온라인" 게임 원화</div>
						<div class="card-subtitle text-gray">게임의 컨셉 리드부터 작화 총괄.</div>
					</div>
					<div class="card-image"><img class="img-responsive" src="/drawit/data/portfolio0.jpg"></div>
				</div>
            </div>
			<div class="column col-4 col-md-6 col-sm-12">
                <div class="card">
					<div class="card-header">
						<div class="card-title h5">네오위즈 "카발 온라인" 게임 원화</div>
						<div class="card-subtitle text-gray">게임의 컨셉 리드부터 작화 총괄.</div>
					</div>
					<div class="card-image"><img class="img-responsive" src="/drawit/data/portfolio0.jpg"></div>
				</div>
            </div>
			<div class="column col-4 col-md-6 col-sm-12">
                <div class="card">
					<div class="card-header">
						<div class="card-title h5">네오위즈 "카발 온라인" 게임 원화</div>
						<div class="card-subtitle text-gray">게임의 컨셉 리드부터 작화 총괄.</div>
					</div>
					<div class="card-image"><img class="img-responsive" src="/drawit/data/portfolio0.jpg"></div>
				</div>
            </div>
			<div class="column col-4 col-md-6 col-sm-12">
                <div class="card">
					<div class="card-header">
						<div class="card-title h5">네오위즈 "카발 온라인" 게임 원화</div>
						<div class="card-subtitle text-gray">게임의 컨셉 리드부터 작화 총괄.</div>
					</div>
					<div class="card-image"><img class="img-responsive" src="/drawit/data/portfolio0.jpg"></div>
				</div>
            </div>
			<div class="column col-4 col-md-6 col-sm-12">
                <div class="card">
					<div class="card-header">
						<div class="card-title h5">네오위즈 "카발 온라인" 게임 원화</div>
						<div class="card-subtitle text-gray">게임의 컨셉 리드부터 작화 총괄.</div>
					</div>
					<div class="card-image"><img class="img-responsive" src="/drawit/data/portfolio0.jpg"></div>
				</div>
            </div>
		</div>