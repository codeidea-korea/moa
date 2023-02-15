<?php
include_once('./_common.php');

/*
if(USE_G5_THEME && defined('G5_THEME_PATH')) {
    require_once(G5_SHOP_PATH.'/yc/ordercoupon.php');
    return;
}
*/

if($is_guest) { exit; } 
$price = (int)preg_replace('#[^0-9]#', '', $_POST['price']);
if($price <= 0) { die('상품금액이 0원이므로 쿠폰을 사용할 수 없습니다.'); } 

$list = array();

$sql = " select * from {$g5['g5_shop_coupon_table']} where cp_no in (".$_POST['coupon_ids'].")";
//echo $sql;
$result = sql_query($sql);
$count = sql_num_rows($result);
$z = 0;
for($i=0; $row=sql_fetch_array($result); $i++) {
	if(is_used_coupon($member['mb_id'], $row['cp_id'])) { continue; }	// 사용한 쿠폰인지 체크
	$list[$z] = $row;
	$dc = 0;
	if($row['cp_type']) {
		$dc = floor(($price * ($row['cp_price'] / 100)) / $row['cp_trunc']) * $row['cp_trunc'];
	} else {
		$dc = $row['cp_price'];
	}

	if($row['cp_maximum'] && $dc > $row['cp_maximum']) { $dc = $row['cp_maximum']; } 
	$list[$z]['dc'] = $dc;
	$z++;
}
$is_coupon = ($z > 0) ? true : false;
?>

<div id="od_coupon_frm">
    <?php if($is_coupon == true) { ?>
		<div class="table-responsive">
			<table class="div-table table">
				<thead>
				<tr class="active">
					<th class="text-center" scope="col">쿠폰명</th>
					<th class="text-center" scope="col" style="width:60px;">할인</th>
					<th class="text-center" scope="col" style="width:70px;">적용</th>
				</tr>
				</thead>
				<tbody>
				<?php for($i=0; $i < count($list); $i++) { ?>
					<tr>
						<td>
							<input type="hidden" name="o_cp_id[]" value="<?php echo $list[$i]['cp_id']; ?>">
							<input type="hidden" name="o_cp_prc[]" value="<?php echo $list[$i]['dc']; ?>">
							<input type="hidden" name="o_cp_subj[]" value="<?php echo $list[$i]['cp_subject']; ?>">
							<?php echo get_text($list[$i]['cp_subject']); ?>
						</td>
						<td class="text-center"><?php echo number_format($list[$i]['dc']); ?></td>
						<td class="text-center"><button data-dismiss="modal" type="button" class="od_cp_apply btn btn-black btn-xs">적용</button></td>
					</tr>
				<?php }	?>
				</tbody>
			</table>
		</div>
	<?php } else { ?>
		<p class="text-center">사용할 수 있는 쿠폰이 없습니다.</p>
    <?php } ?>
</div>

