<?php
if (!defined('_GNUBOARD_')) exit; //개별 페이지 접근 불가

if(!$wset['title']){ $wset['title'] = 'OUR SERVICES'; }
if(!$wset['subject']){ $wset['subject'] = '당신을 위한 전문가가 있습니다. 아미나블루가 도와드리겠습니다. 만족시킬 것입니다'; }

if(!$wset['icon_1']){ $wset['icon_1'] = '{아이콘:globe}'; }
if(!$wset['icon_2']){ $wset['icon_2'] = '{아이콘:desktop}'; }
if(!$wset['icon_3']){ $wset['icon_3'] = '{아이콘:magic}'; }

if(!$wset['title_1']){ $wset['title_1'] = 'GLOBAL WEB TRAND'; }
if(!$wset['title_2']){ $wset['title_2'] = 'RESPONSIVE DESIGN'; }
if(!$wset['title_3']){ $wset['title_3'] = 'PARTNER SHIP'; }

if(!$wset['content_1']){ $wset['content_1'] = '기존 국내 스타일을 배제하고 글로벌 웹트랜드에 맞춰 새롭고 모던한 디자인으로 웹사이트를 구축합니다.'; }
if(!$wset['content_2']){ $wset['content_2'] = '다양한 디바이스에서 정확한 사이즈로 최적화하여 쾌적하게 사이트를 이용할 수 있도록 반응형으로 웹사이트를 구축합니다.'; }
if(!$wset['content_3']){ $wset['content_3'] = '제작만 하고 끝이 아닌 파트터쉽 관계를 유지합니다. 어려움이 있으면 언제든지 문의주세요. 만족시킬 것입니다.'; }

// FA Icon
function apms_fa3($str){
	$str = ($str) ? preg_replace_callback("/{(아이콘|icon)\:([^}]*)}/is", "apms_callback_icon3", $str) : $str;
	return $str;
}

function apms_callback_icon3($m) {
	return apms_icon3($m[2]);
}

// Icon
function apms_icon3($str){

	if(!$str || $str == 'none') return;

	list($icon, $opt) = explode(";", $str);
	switch($opt) {
		case 'c' : $str = "<i class='".$icon."'></i>"; break;
		case 't' : $str = $icon; break;
		default	 : $str = "<i class='fa fa-".$icon." fa-5x'></i>"; break;
	}

	return $str;
}

$wset['icon_1'] = apms_fa3($wset['icon_1']);
$wset['icon_2'] = apms_fa3($wset['icon_2']);
$wset['icon_3'] = apms_fa3($wset['icon_3']);

?>
<style>
#section-1 .triangle i { position: absolute; top: -40px; left: 50%; margin-left: -13px; font-size: 30px; color: <?php echo $wset['color_tb'];?>;}
#section-1 .triangle { border-top-color: <?php echo $wset['color_t'];?>; }
</style>
<section id="section-1" class="section-1">
	<div class="container">
		<?php if($wset['tuse']){ ?>
		<div class="triangle">
			<a href="#section-1" class="kso-scroll"><i class="fa fa-arrow-down"></i></a>
		</div>
		<?php } ?>
		<div class="row">
			<div class="col-md-12">
				<div class="text-center mBottom60 animated"
						data-animtype="fadeInDown" data-animrepeat="0" data-animspeed="1s" data-animdelay="1s">
					<div class="hvr-pop">
						<h1 style="color:#74b4d4"><?php echo $wset['title'];?></h1>
					</div>
					<p><?php echo $wset['subject'];?></p>
				</div>


				<div class="row">
					<div class="col-sm-4 col-md-4 " >
						<div class="iconBox text-center  animated nemo"
							data-animtype="fadeInLeft" data-animrepeat="0" data-animspeed="1s" data-animdelay="1s">
							<div class="iconBg hvr-grow">
								<?php echo $wset['icon_1'];?>
							</div>
							<h3 class="iconTitle"><?php echo $wset['title_1'];?></h3>
							<p class="ptext mBottom20"><?php echo $wset['content_1'];?></p>
							<a href="<?php echo $wset['link_more1'];?>" class="btn-flat conceptBgColor btn-xs rounded">Read More</a>
						</div>
					</div>
					<div class="col-sm-4 col-md-4 ">
						<div class="iconBox text-center  animated nemo"
							data-animtype="fadeInUp" data-animrepeat="0" data-animspeed="1s" data-animdelay="1s">
							<div class="iconBg  hvr-grow">
								<?php echo $wset['icon_2'];?>
							</div>
							<h3 class="iconTitle"><?php echo $wset['title_2'];?></h3>
							<p class="ptext mBottom20"><?php echo $wset['content_2'];?></p>
							<a href="<?php echo $wset['link_more2'];?>" class="btn-flat conceptBgColor btn-xs rounded">Read More</a>
						</div>
					</div>
					<div class="col-sm-4 col-md-4 ">
						<div class="iconBox text-center   animated nemo"
							data-animtype="fadeInRight" data-animrepeat="0" data-animspeed="1s" data-animdelay="1s">
							<div class="iconBg hvr-grow">
								<?php echo $wset['icon_3'];?>
							</div>
							<h3 class="iconTitle"><?php echo $wset['title_3'];?></h3>
							<p class="ptext mBottom20"><?php echo $wset['content_3'];?></p>
							<a href="<?php echo $wset['link_more3'];?>" class="btn-flat conceptBgColor btn-xs rounded">Read More</a>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
</section>