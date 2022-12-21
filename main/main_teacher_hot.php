<?php
include_once("./_common.php");
$write_table = $g5['write_prefix']."class";
$sql = "SELECT a.wr_id, c.it_id, c.it_2, b.mb_name, b.mb_nick, b.mb_1, b.mb_id
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
		and curdate() <= date(it_4)
		order by it_hit desc
		limit 10";
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
		$csql = "SELECT COUNT(*) cnt, SUM(aply) aply 
				 FROM g5_write_class a , deb_class_item b
				 WHERE a.wr_id = b.wr_id
				 	AND b.bo_table = 'class'
					AND a.mb_id = '{$mb['mb_id']}'";
		$ct = sql_fetch($csql);
		if ($member['mb_id']=='pletho@gmail.com') {
			
		}
		?>
			
				<li class="card">
					<div class="card-header">
						<figure class="avatar avatar-xl float-left" data-initial="D">
							<img src="<?php echo ($mb['photo'])?$mb['photo']:"/data/avatar00.jpg";?>" alt="" />
						</figure>
						<div class="card-title text-ellipsis">
							<a href="/bbs/channel.php?cid=<?php echo $mb['mb_id'];?>" class="float-right">자세히보기</a>
							<strong><?php echo $row['mb_nick'];?></strong>
							<em><?php echo $row['wr_name'];?></em>
						</div>
						<div class="card-subtitle text-ellipsis"><?php echo bbs_get_tag($row['mb_1']);?></div>
						<div class="card-info">
							<?php 
							for ($i=0; $i < $pcnt;$i++) {?>
							<span class="label"><?php echo ($pfh[$i]['content']);?></span>
							<?php } ?>
							<span>총 수업 <?php echo $ct['cnt'];?>시간</span>
							<span>총 학생 <?php echo $ct['aply'];?>명</span>
						</div>
					</div>
				</li>
	<?php } ?>