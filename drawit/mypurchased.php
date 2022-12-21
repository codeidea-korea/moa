<?php // 미리보기용 글로벌 헤더 로드
include_once "./_common.php";
include_once (G5_PATH."/head.php");

?>

		<ul class="tab tab-block">
			<li class="tab-item active">
				<a href="<?php echo UHD_URL ?>/mypurchased.php">음원 구입 목록</a>
			</li>
			<li class="tab-item">
				<a href="<?php echo G5_SHOP_URL ?>/coupon.php">쿠폰 관리</a>
			</li>
			<li class="tab-item none">
				<a href="<?php echo G5_SHOP_URL ?>/orderinquiry.php">결제/이용 내역</a>
			</li>
		</ul>
		
		<section class="tab-content">
								
            <div class="single-header">
            	<h2>
                	<span class="typcn typcn-download"></i>
                	<strong>음원 구입 목록</strong>
                </h2>
            </div>

			<div class="attention">
				<h5>안내사항</h5>
				결제가 완료된 음원은 결제일로부터 30일동안 다운로드가 가능합니다.
			</div>

			<table class="table table-hover">
				<caption><span class="hidden">내 계정의 음원 구입 목록 내역 테이블입니다.</span></caption>
				<colgroup>
					<col class="td-category" />
					<col class="td-detail" />
					<col class="td-date" />
					<col class="td-download" />
				</colgroup>
				<thead>
					<tr>
						<th>
							<select class="form-select">
								<option data-category="default">음질</option>
								<option data-category="flac88">Flac88</option>
								<option data-category="flac176">Flac176</option>
								<option data-category="dsd64">DSD64</option>
								<option data-category="dsd256">DSD256</option>
							</select>
						</th>
						<th>설명</th>
						<th>날짜</th>
						<th>다운로드</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$list = getPayedFlacList($member['mb_id']);
					$lcnt = ($list)?count($list):0;

					for ($i=0;$i < $lcnt;$i++) {?>
					
					<tr data-category="flac88">
						<td class="td-num"><strong class="label"><?php echo $list[$i]['it_3'];?></strong></td>
						<td>
							<a href="/shop/item.php?it_id=<?php echo $list[$i]['it_id'];?>"><strong><?php  echo $list[$i]['title'];?></strong> <i class="typcn typcn-arrow-right"></i><br />
							트랙을 구매했습니다.</a>
						</td>
						<td class="td-num"><?php echo $list[$i]['buyday'];?></td>
						<td>
							<?php if ($list[$i]['able']) {?>
							<button class="btn btn-action" title="다운로드하기" onclick="fdown('<?php echo $list[$i]['no'];?>');"><i class="icon icon-download"></i></button>
							<?php } ?>
						</td>
					</tr>
					<?php } ?>

					
				</tbody>
			</table>

		</section>

    </div>
       
    <iframe name="fdn" id='fdn' src="" style="width:0px;height:0px" frameborder="0"></iframe>
    <script>
    	function fdown(songs) {
    		var f = document.fdn;
    		f.action="/uhd/fdownload.php";
    		f.sno.value=songs;
    		f.submit();
    	}
    </script>
    <form target='fdn' name='ffdn' id='ffdn'>
    	<input type='hidden' name='sno' id='sno' value=''>
    </form>
<?php // 미리보기용 글로벌 푸터 로드
include_once (G5_PATH."/tail.php");
	//include "footer.php";
?>