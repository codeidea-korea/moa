<?php
$sub_menu = "530110";
include_once('./_common.php');

$g5['title'] .= '포인트 관리';
include_once(G5_ADMIN_PATH.'/admin.head.php');

if ($w == 'u') {


	$sql = " update {$g5['config_table']}
				set 
					cf_use_point = '{$_POST['cf_use_point']}',
					cf_point_term = '{$_POST['cf_point_term']}',
					cf_review_point = '{$_POST['cf_review_point']}',
					cf_use_host_reg = '{$_POST['cf_use_host_reg']}',
					cf_use_review = '{$_POST['cf_use_review']}',
					cf_host_reg_point = '{$_POST['cf_host_reg_point']}',
					cf_register_point = '{$_POST['cf_register_point']}',
					cf_use_recommend = '{$_POST['cf_use_recommend']}',
					cf_recommend_point = '{$_POST['cf_recommend_point']}'
					
						";
	//echo nl2br($sql)."<BR>";
	sql_query($sql);
}

$config = sql_fetch("select * from {$g5['config_table']} ");

?>




<div class="boxContainer padding40">
	
	<form name="frmPoint" id="frmPoint" action="/adm/_add/point_config.php" method="post">
		<input type="hidden" name="w" value="u">
	<div class="wr-wrap label250 list-padding15">

		<div class="wr-list flex-top">
			<div class="wr-list-label">발송 포인트 기본 설정</div>
			<div class="wr-list-con">
				<div class="tbl-excel td-h4">
					<table>
						<colgroup>
							<col width="180">
							<col>
						</colgroup>
						<tbody>
							<tr>
								<th>포인트 유효기간</th>
								<td class="tleft">
									1.제한없음 <?php echo help('기간을 0으로 설정시 포인트 유효기간 제한이 없습니다.') ?><br>
									2.지급일 기준 <input type="text" name="cf_point_term" value="<?php echo $config['cf_point_term']; ?>" id="cf_point_term" class="span60 simple ml5"> 일  사용가능 (ex. 총 365일)
								</td>
							</tr>
							<tr class="none">
								<th class="line-height120">포인트 만료기간<p class="fs11">(만료기간이후 정산 출금 불가능)</p></th>
								<td class="tleft">
									설정함  / 설정 안 함<br>
									알림시점  만료일 기준
								</td>
							</tr>
						</tbody>			
					</table>
				</div>
			</div>
		</div>

		<div class="wr-list flex-top">
			<div class="wr-list-label">포인트 유형 설정</div>
			<div class="wr-list-con">
				<div class="tbl-excel td-h4">
					<table>
						<colgroup>
							<col width="180">
							<col>
						</colgroup>
						<tbody>
							<tr>
								<th>회원가입 포인트</th>
								<td class="tleft">
									<div class="flex mb10">
										<label class="radio-wrap"><input type="radio" name="reg_point_use" id="reg_point_use1" value="1" checked><span></span>사용함</label>
										<label class="radio-wrap ml30"><input type="radio" name="reg_point_use"  id="reg_point_use2" value="0"><span></span>사용안함</label>
									</div>
									<input type="text" name="cf_register_point"  id="cf_register_point" value="<?php echo $config['cf_register_point'];?>" class="span160 ml5" placeholder="포인트 금액" data-label-right="point">
								</td>
							</tr>
							<tr>
								<th>추천인 포인트</th>
								<td class="tleft">
									<div class="flex mb10">
										<label class="radio-wrap"><input type="radio" name="cf_use_recommend" value="1" id="cf_use_recommend1" <?php echo $config['cf_use_recommend']?'checked':''; ?>><span></span>사용함</label>
										<label class="radio-wrap ml30"><input type="radio" name="cf_use_recommend" value="0" id="cf_use_recommend2" <?php echo !$config['cf_use_recommend']?'checked':''; ?>><span></span>사용안함</label>
									</div>
									<input type="text" name="cf_recommend_point" value="<?php echo $config['cf_recommend_point'];?>" class="span160 ml5" placeholder="포인트 금액" data-label-right="point">
								</td>
							</tr>
							<tr>
								<th>리뷰 등록 포인트</th>
								<td class="tleft">
									<div class="flex mb10">
										<label class="radio-wrap"><input type="radio" name="cf_use_review" value="1" id="cf_use_review1" <?php echo $config['cf_use_review']?'checked':''; ?>><span></span>사용함</label>
										<label class="radio-wrap ml30"><input type="radio" name="cf_use_review" value="0" id="cf_use_review2" <?php echo !$config['cf_use_review']?'checked':''; ?>><span></span>사용안함</label>
									</div>
									<input type="text" name="cf_review_point" value="<?php echo $config['cf_review_point'];?>" class="span160 ml5" placeholder="포인트 금액" data-label-right="point">
								</td>
							</tr>
							<tr>
								<th>호스트 등록시 제공 포인트</th>
								<td class="tleft">
									<div class="flex mb10">
										<label class="radio-wrap"><input type="radio" name="cf_use_host_reg" value="1" id="cf_use_host_reg1" <?php echo $config['cf_use_host_reg']?'checked':''; ?>><span></span>사용함</label>
										<label class="radio-wrap ml30"><input type="radio" name="cf_use_host_reg" value="0" id="cf_use_host_reg0" <?php echo !$config['cf_use_host_reg']?'checked':''; ?>><span></span>사용안함</label>
									</div>
									<input type="text" name="cf_host_reg_point" value="<?php echo $config['cf_host_reg_point'];?>" class="span160 ml5" placeholder="포인트 금액" data-label-right="point">
								</td>
							</tr>
						</tbody>			
					</table>
					<script>
					$(function() {
						$("input[name=reg_point_use]").change(function() {
							var regpoint = $('input[name=reg_point_use]:checked').val();
							if (regpoint == '1') {
								$("#cf_register_point").attr("disable", false);
							}
							else if (regpoint == '0') {
								$("#cf_register_point").val("");
								$("#cf_register_point").attr("disable", true);
							}
						});
					});
					</script>
				</div>
			</div>
		</div>

		

	</div>

	<div class="btn_fixed_top">
		<a href="./member_list.php?<?php echo $qstr ?>" class="btn btn_02">취소</a>
		<input type="submit" value="저장" class="btn_submit btn" accesskey='s'>
	</div>

	</form>

</div>

<?php
include_once('./admin.tail.php');
?>