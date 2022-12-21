<?php
if (!defined('_GNUBOARD_')) exit; //개별 페이지 접근 불가

if(!$wset['link_1']){ $wset['link_1'] = 'kso-info2'; }

if(!$wset['subject']){ $wset['subject'] = 'AMINABLUE INFORMATION'; }

if(!$wset['subject_1']){ $wset['subject_1'] = 'MODERN DESIGN'; }
if(!$wset['subject_2']){ $wset['subject_2'] = 'ONEPAGE LAYOUT'; }
if(!$wset['subject_3']){ $wset['subject_3'] = 'FLEXIBILITY'; }
if(!$wset['subject_4']){ $wset['subject_4'] = 'RESPONSIVE DESIGN'; }
if(!$wset['subject_5']){ $wset['subject_5'] = 'RARALLAX EFFECTS'; }
if(!$wset['subject_6']){ $wset['subject_6'] = 'BACKGROUND VIDEOS'; }

if(!$wset['content_1']){ $wset['content_1'] = '단순히 고통이라는 이유 때문에 고통 그 자체를 사랑하거나 추구하거나 소유하려는 자는 없다. 다만 노역과 고통이 아주 큰 즐거움을 선사'; }
if(!$wset['content_2']){ $wset['content_2'] = '단순히 고통이라는 이유 때문에 고통 그 자체를 사랑하거나 추구하거나 소유하려는 자는 없다. 다만 노역과 고통이 아주 큰 즐거움을 선사'; }
if(!$wset['content_3']){ $wset['content_3'] = '단순히 고통이라는 이유 때문에 고통 그 자체를 사랑하거나 추구하거나 소유하려는 자는 없다. 다만 노역과 고통이 아주 큰 즐거움을 선사'; }
if(!$wset['content_4']){ $wset['content_4'] = '단순히 고통이라는 이유 때문에 고통 그 자체를 사랑하거나 추구하거나 소유하려는 자는 없다. 다만 노역과 고통이 아주 큰 즐거움을 선사'; }
if(!$wset['content_5']){ $wset['content_5'] = '단순히 고통이라는 이유 때문에 고통 그 자체를 사랑하거나 추구하거나 소유하려는 자는 없다. 다만 노역과 고통이 아주 큰 즐거움을 선사'; }
if(!$wset['content_6']){ $wset['content_6'] = '단순히 고통이라는 이유 때문에 고통 그 자체를 사랑하거나 추구하거나 소유하려는 자는 없다. 다만 노역과 고통이 아주 큰 즐거움을 선사'; }

if(!$wset['icon_1']){ $wset['icon_1'] = '{아이콘:desktop}'; }
if(!$wset['icon_2']){ $wset['icon_2'] = '{아이콘:puzzle-piece}'; }
if(!$wset['icon_3']){ $wset['icon_3'] = '{아이콘:umbrella}'; }
if(!$wset['icon_4']){ $wset['icon_4'] = '{아이콘:columns}'; }
if(!$wset['icon_5']){ $wset['icon_5'] = '{아이콘:magic}'; }
if(!$wset['icon_6']){ $wset['icon_6'] = '{아이콘:video-camera}'; }

// FA Icon
function apms_fa2($str){
	$str = ($str) ? preg_replace_callback("/{(아이콘|icon)\:([^}]*)}/is", "apms_callback_icon2", $str) : $str;
	return $str;
}

function apms_callback_icon2($m) {
	return apms_icon2($m[2]);
}

// Icon
function apms_icon2($str){

	if(!$str || $str == 'none') return;

	list($icon, $opt) = explode(";", $str);
	switch($opt) {
		case 'c' : $str = "<i class='".$icon."'></i>"; break;
		case 't' : $str = $icon; break;
		default	 : $str = "<i class='fa fa-".$icon." fa-stack-1x fa-inverse'></i>"; break;
	}

	return $str;
}

$wset['icon_1'] = apms_fa2($wset['icon_1']);
$wset['icon_2'] = apms_fa2($wset['icon_2']);
$wset['icon_3'] = apms_fa2($wset['icon_3']);
$wset['icon_4'] = apms_fa2($wset['icon_4']);
$wset['icon_5'] = apms_fa2($wset['icon_5']);
$wset['icon_6'] = apms_fa2($wset['icon_6']);
?>

<section id="kso-info2" class="kso-section" style="background-color:#fff;">
	<div class="container">
		<div class="col-md-12">
			<?php if($wset['tuse']){ ?>
			<div class="triangle">
				<a href="#<?php echo $wset['link_1'];?>" class="kso-scroll"><i class="fa fa-arrow-down"></i></a>
			</div>
			<?php } ?>
			<div class="row">
				<div style="padding-top:60px;">
					<div class="text-center animated mBottom60 " data-animtype="fadeInDown" data-animrepeat="0" data-animspeed="1s" data-animdelay="1.5s">
						<h2><?php echo $wset['subject'];?></h2>
						<div class="plus-line"><span>+</span></div>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-6 col-md-4">
				<div class=" animated " data-animtype="fadeInLeft" data-animrepeat="0" data-animspeed="1s" data-animdelay="0.5s">
					<span class="fa-stack fa-3x pull-right conceptHover">
					  <i class="fa fa-circle fa-stack-2x"></i>
					  <?php echo $wset['icon_1']; ?>
					</span>
					<h4 class="text-right"><?php echo $wset['subject_1'];?></h4>
					<p class="text-right"><?php echo $wset['content_1']; ?></p>
				</div>
				<div class="animated " data-animtype="fadeInLeft" data-animrepeat="0" data-animspeed="1s" data-animdelay="1s">
					<span class="fa-stack fa-3x pull-right conceptHover">
					  <i class="fa fa-circle fa-stack-2x"></i>
					  <?php echo $wset['icon_2']; ?>
					</span>
					<h4 class="text-right"><?php echo $wset['subject_2'];?></h4>
					<p class="text-right"><?php echo $wset['content_2']; ?></p>
				</div>
				<div class="animated " data-animtype="fadeInLeft" data-animrepeat="0" data-animspeed="1s" data-animdelay="1.5s">
					<span class="fa-stack fa-3x pull-right conceptHover">
					  <i class="fa fa-circle fa-stack-2x"></i>
					  <?php echo $wset['icon_3']; ?>
					</span>
					<h4 class="text-right"><?php echo $wset['subject_3'];?></h4>
					<p class="text-right"><?php echo $wset['content_3']; ?></p>
				</div>			</div>
			<div class="col-md-4 hidden-sm hidden-xs">
				<div class="center-img kso-ifUp   animated " data-animtype="fadeInUp" data-animrepeat="0" data-animspeed="1s" data-animdelay="0.5s"><!--kso-hidden-->
					<img src="<?php echo $wset['img1']; ?>" class="img-responsive center-block">
				</div>
			</div>
			<div class="col-sm-6 col-md-4 mBottom20">
				<div class="animated " data-animtype="fadeInRight" data-animrepeat="0" data-animspeed="1s" data-animdelay="0.5s">
					<span class="fa-stack fa-3x pull-left conceptHover">
					  <i class="fa fa-circle fa-stack-2x"></i>
					  <?php echo $wset['icon_4']; ?>
					</span>
					<h4><?php echo $wset['subject_4'];?></h4>
					<p><?php echo $wset['content_4']; ?></p>
				</div>
				<div class="animated " data-animtype="fadeInRight" data-animrepeat="0" data-animspeed="1s" data-animdelay="1s">
					<span class="fa-stack fa-3x pull-left conceptHover">
					  <i class="fa fa-circle fa-stack-2x"></i>
					  <?php echo $wset['icon_5']; ?>
					</span>
					<h4><?php echo $wset['subject_5'];?></h4>
					<p><?php echo $wset['content_5']; ?></p>
				</div>
				<div class="animated " data-animtype="fadeInRight" data-animrepeat="0" data-animspeed="1s" data-animdelay="1.5s">
					<span class="fa-stack fa-3x pull-left conceptHover">
					  <i class="fa fa-circle fa-stack-2x"></i>
					  <?php echo $wset['icon_6']; ?>
					</span>
					<h4><?php echo $wset['subject_6'];?></h4>
					<p><?php echo $wset['content_6']; ?></p>
				</div>
			</div>
		</div>
	</div>
</section>