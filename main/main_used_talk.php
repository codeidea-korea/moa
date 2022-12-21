<?php
include_once("./_common.php");
$sql = "SELECT * from {$g5['g5_shop_item_use_table']}
		where  is_confirm = '1'
		order by is_time desc
		limit 10";
$result = sql_query($sql);
for ($i = 0; $row = sql_fetch_array($result);$i++) {
	$it = get_it_item($row['it_id']);
	$tchr = apms_member($it['pt_id']);
	//print_r2($tchr);
		?>
				<li class="column col-4 col-md-6">
					<div class="balloon-item">
						<div class="balloon-msg"><?php echo nl2br(stripcslashes($row['is_content']));?></div>
						<div class="balloon-author"><strong><?php echo $row['is_name'];?></strong>님</div>
					</div>
					<div class="balloon-teacher">
						<figure class="avatar avatar-sm" data-initial="R">
							<img src="data/avatar05.jpg" alt="" />
						</figure>
						<a href="/shop/item.php?it_id=<?php echo $row['it_id']?>"><strong><?php echo $tchr['mb_nick']?></strong> 선생님 수업 확인하기</a>
					</div>
				</li>
<?php				
}
?>