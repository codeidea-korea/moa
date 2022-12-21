<?php
include_once("./_common.php");
$write_table = $g5['write_prefix']."class";
$sql = "SELECT distinct a.wr_id, c.it_id, c.it_2, b.mb_name, b.mb_nick, b.mb_1, b.mb_id
		 from {$write_table} a, 
			  {$g5['member_table']} b,
			  {$g5['g5_shop_item_table']} c
		where a.mb_id = b.mb_id
		and b.as_partner = '1'
		and a.wr_id = c.it_2
		and c.it_id = (select max(d.it_id) 
				from {$g5['g5_shop_item_table']} d 
					where d.it_id = c.it_id
					and d.it_2 = c.it_2)
		-- and curdate() <= date(it_4)
		and exists(select 'x' from {$g5['member_table']} x where b.mb_id <> x.mb_id)
		group by it_2
		-- order by wr_hit desc
	";
$result = sql_query($sql);
//echo $sql."<BR>";
	for ($i=0; $row = sql_fetch_array($result);$i++) {
		$mb = apms_member($row['mb_id']);
		$pf = get_portfolio($row['mb_id']);
		$pfh = "";
		if ($pf) {
			$pfh = $pf['history'];
			$pcnt = 0;
			if ($pfh)	{
				$pcnt = count($pfh);
			}
		}
		?>
				<li class="card">
					<div class="card-header">
						<figure class="avatar avatar-xl float-left" data-initial="D">
							<img src="<?php echo ($mb['photo'])?$mb['photo']:"/data/avatar00.jpg";?>" alt="" />
						</figure>
						<div class="card-title text-ellipsis">
							<a href="/bbs/channel.php?cid=<?php echo $mb['mb_id'];?>" class="float-right">자세히보기</a>
							<!--<a href="/shop/item.php?it_id=<?php echo $row['it_id'];?>" class="float-right">자세히보기</a>-->
							<strong><?php echo $row['mb_name'];?></strong>
						</div>
						<div class="card-subtitle text-ellipsis"><?php echo bbs_get_tag($row['mb_1']);?></div>
						<div class="card-info text-ellipsis">
							<?php 
							for ($i=0; $i < $pcnt;$i++) {?>
							<span class="label"><?php echo ($pfh[$i]['content']);?></span>
							<?php } ?>
						</div>
					</div>
				</li>
	<?php } ?>