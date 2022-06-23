<?php

//echo $it_id."<BR>";
$iteminfo = get_item_detail($it_id);
 //print_r2($iteminfo);

$cnt = 0;
if ($iteminfo)
	$cnt = count($iteminfo);
for ($i=0; $i < $cnt; $i++) {
	//echo $iteminfo[$i]['day']." ".$iteminfo[$i]['time']."<BR>";
	$mb = apms_member($iteminfo[$i]['mb_id']);
	$pf = get_portfolio($iteminfo[$i]['mb_id']);
		//print_r2($pfh);
}
	//echo " PHP 에서  print_r2(\$iteminfo);이걸로 찍어서 확인하시면 정보 볼수있습니다. <BR>";
	$pfh = "";
	if ($pf) {
		$pfh = $pf['history'];
		$pcnt = 0;
		if ($pfh)	{
			$pcnt = count($pfh);
		}
	}
	$lsql = "SELECT * from g5_write_class a where a.wr_id = '{$it['it_2']}' ";
	$cla  = sql_fetch($lsql);

	$csql = "SELECT * from deb_class_item 
			 where bo_table='class' 
			 	and wr_id = '{$it['it_2']}'
			 	and curdate() < date(day)  ";
		//echo nl2br($csql);
	$cresult = sql_query($csql);
	?>

	<h3>수강 신청이 가능한 강의 <i class="icon icon-caret"></i></h3>
		<ul class="class-schedule columns">
		<?php
		for ($i = 0; $row = sql_fetch_array($cresult);$i++) {		?>
			<li class="column col-4 col-md-6">
				<div class="card">
					<div class="card-header">
						<label class="form-checkbox form-inline">
							<input type="checkbox" class='gotoit' value="<?php echo $row['it_id'];?>" OnChange="gotourl(this.value);"><i class="form-icon"></i> 수강신청 가능
						</label>
					</div>
					<dl class="class-schedule">
						<dt>수업 일정</dt>
						<dd><?php echo $row['content'] ?></dd>
						<dd><?php echo $row['day'] ?>요일 (<?php echo $row['time'];?>)</dd>
					</dl>
				</div>
			</li>
		<?php } ?>

		<script>
			var gotourl = function(it_id) {
				location.href="/shop/item.php?it_id="+it_id;

			};
		</script>