<?php
if (!defined('_GNUBOARD_')) exit; //개별 페이지 접근 불가

?>
<style>
#section-6 { color:#000; }
#section-6 .triangle { border-top-color: <?php echo $wset['color_t'];?>; }
#section-6 .triangle i { position: absolute; top: -40px; left: 50%; margin-left: -13px; font-size: 30px; color: <?php echo $wset['color_tb'];?>; }
</style>
<section id="section-6" class="section-6">
		<?php if($wset['tuse']){ ?>
			<div class="triangle">
				<a href="#<?php echo $wset['link_1'];?>" class="kso-scroll"><i class="fa fa-arrow-down"></i></a>
			</div>
		<?php } ?>
	<div class="choose-us-block content text-center margin-bottom-40" id="faq" style="background-color:#fff;padding: 100px 0 40px 0;">
		<div class="container">
			<h2>FAQ</h2>
			<h4><?php echo $wset['title'];?></h4>
			<div class="row">
				<div class="col-md-6 col-sm-6 col-xs-12 text-left">
					<img src="<?php echo $wset['img'];?>" alt="Why to choose us" class="img-responsive">
				</div>
				<div class="col-md-6 col-sm-6 col-xs-12 text-left">
					<div class="panel-group" id="accordion1">
						<?php for($i=0,$i2=1;$i<$wset['cnt'];$i++,$i2++){ ?>
						<div class="panel panel-default">
							<div class="panel-heading">
								<h5 class="panel-title">
									<a class="accordion-toggle <?php echo ($i2 == '1') ? '' : 'collapsed' ;?>"" data-toggle="collapse" data-parent="#accordion<?php echo $i2;?>" href="#accordion<?php echo $i2;?>_<?php echo $i;?>" aria-expanded="true"><?php echo ($wset['subject_'.$i2]);?></a>
								</h5>
							</div>
						<div id="accordion<?php echo $i2;?>_<?php echo $i;?>" class="panel-collapse collapse <?php echo ($i2 == '1') ? 'in' : '' ;?>" aria-expanded="true" style="">
							<div class="panel-body">
								<p><?php echo $wset['content_'.$i2];?></p>
							</div>
						</div>
						<?php } ?>


					<!--<div class="panel panel-default">
						<div class="panel-heading">
							<h5 class="panel-title">
								<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion1" href="#accordion1_1" aria-expanded="false">임시 예약한 방은 결제를 하지 않으면 어떻게 되나요?</a>
							</h5>
						</div>
					<div id="accordion1_1" class="panel-collapse collapse" aria-expanded="false" style="">
						<div class="panel-body">
							<p>카트에 담긴 객실은 15분간 담겨지게 되며 <br>예약완료된 상품의 결루 미결제시 2시간후 자동 예약이 취소됩니다.</p>
						</div>
					</div>
				</div>

				<div class="panel panel-default">
					<div class="panel-heading">
						<h5 class="panel-title">
							<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion2" href="#accordion1_2" aria-expanded="true">결제완료된 객실의 환불에 대해 알려주세요</a>
						</h5>
					</div>
					<div id="accordion1_2" class="panel-collapse collapse" aria-expanded="true" style="">
					<div class="panel-body">
						<p>예약당일은 환불이 불가하며  <br>취소시 입금액의 이용7일이전 전체환불 이용6일전 30% 이용5일전 이용40% <br>4일전50% 이용3일전 50% 이용2일전 70% 이용1일전 80% 환불이 가능합니다.</p>
					</div>
				</div>
			</div>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h5 class="panel-title">
						<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion3" href="#accordion1_3" aria-expanded="false">객실 예약시 복수 선택이 가능한가요? </a>
					</h5>
				</div>
				<div id="accordion1_3" class="panel-collapse collapse" aria-expanded="false" style="">
					<div class="panel-body">
						<p>같은 날짜의 객실은 복수 예약이 가능합니다.<br>예약 날짜가 다른 객실은 각각 예약 결제 하셔야합니다..</p>
					</div>
				</div>
			</div>
		</div>-->
	</div>
</section>