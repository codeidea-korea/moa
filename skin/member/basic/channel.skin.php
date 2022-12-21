<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$skin_url.'/style.css" media="screen">', 0);

if($header_skin)
	include_once('./header.php');

?>

<div class="ptb">
	<div class="help_tit">
	    		<p>채널</p>
	</div>

	<div class="mypage-skin">
		<?php if ($channels) {
			$channelinfo = getCelebInfo($channels['mb_id']);
			?>
		<div class="panel panel-default view-author">
			<div class="panel-heading">
				<h3 class="panel-title">선생님  Profile</h3>
			</div>
			<div class="panel-body">
				<div id="celeb_background_image" >
						<?php
						if ($channelinfo['bgimg']) { echo ' <img src="'.$channelinfo['bgimg'].'" style="max-width:1024px;width:100%;" >';}
						?>
					</div>
				<div class="pull-left text-center auth-photo">
					<div class="img-photo">
						<?php echo ($channels['photo']) ? '<img src="'.$channels['photo'].'" alt="">' : '<img src="/img/reporter.svg" alt="" title="">'; ?>
					</div>
					<div class="btn-group" style="margin-top:-30px;white-space:nowrap;">
						<button type="button" class="btn btn-color btn-sm" onclick="apms_like('<?php echo $channels['mb_id'];?>', 'like', 'it_like'); return false;" title="Like">
							<i class="fa fa-thumbs-up"></i> <span id="it_like"><?php echo number_format($channels['liked']) ?></span>
						</button>
						<button type="button" class="btn btn-color btn-sm" onclick="apms_like('<?php echo $channels['mb_id'];?>', 'follow', 'it_follow'); return false;" title="Subscribe">
							<i class="fa fa-users"></i> <span id="it_follow"><?php echo $channels['followed']; ?></span>
						</button>
					</div>
				</div>
				<div class="auth-info" >
					
					<div class="en font-14 " style="margin-bottom:6px;">
						<span class="pull-right font-12 none">Lv.<?php echo $channels['level'];?></span>
						<b class="chanel_name"><?php echo $channels['name']; ?></b> &nbsp;<span class="text-muted en font-12 none"><?php echo $channels['grade'];?></span>
					</div>
					<div class="div-progress progress progress-striped no-margin">
						<div class="progress-bar progress-bar-exp" role="progressbar" aria-valuenow="<?php echo round($channels['exp_per']);?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo round($channels['exp_per']);?>%;">
							<span class="sr-only"><?php echo number_format($channels['exp']);?> (<?php echo $channels['exp_per'];?>%)</span>
						</div>
					</div>
					<p style="margin-top:6px;">
						<?php echo ($mb_signature) ? $mb_signature : '등록된 서명이 없습니다.'; ?>
					</p>

					
				
					<div class="panel panel-default">
						<div class="panel-heading">
							<h3 class="panel-title">선생님 Info</h3>
						</div>
						<ul class="list-group">
							<li class="list-group-item">
								<span class="pull-right"><?php echo ($channels['mb_email'] ? $channels['mb_email'] : '미등록'); ?></span>
								E-Mail
							</li>
							<li class="list-group-item">
								<span class="pull-right"><?php echo $channels['mb_datetime']; ?></span>
								셀럽 시작일
							</li>
							<li class="list-group-item">
								<span class="pull-right"><?php
								if ($channels['mb_signature'])
								echo $channels['mb_signature'];
								else echo "없음"; ?></span>
								서명
							</li>
							<li class="list-group-item">
								<span class="pull-right"><?php echo $channelinfo['viewcnt']; ?></span>
								조회수
							</li>
							<li class="list-group-item">
								<span class="pull-right"><?php echo $channelinfo['regcnt']; ?></span>
								등록글수
							</li>
							<?php if($channels['mb_addr1']) { ?>
								<li class="list-group-item">
									<?php echo sprintf("(%s-%s)", $channels['mb_zip1'], $channels['mb_zip2']).' '.print_address($channels['mb_addr1'], $channels['mb_addr2'], $channels['mb_addr3'], $channels['mb_addr_jibeon']); ?>
								</li>
							<?php } ?>
						</ul>
						<div class="panel-heading">
							<h3 class="panel-title">자기소개</h3>
						</div>
						<ul class="list-group">
							<li class="list-group-item">
								<span class="pull-right"><?php if($channels['mb_profile']) { ?>
								<?php echo conv_content($channels['mb_profile'],0);?>
								<?php } ?></span>
							</li>
						</ul>
						
					</div>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
		<?php } ?>

<style>
/* The switch - the box around the slider */
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

/* Hide default HTML checkbox */
.switch input {display:none;}

/* The slider */
.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 30px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>


<style>
/* //2018-08-16.이종석.[S]임의로 스타일 그대로 복사해서 넣음 */
.lb_list_best .lr_list_best { width:33.33%; }
.lb_list_best .lr_list_best .img-wrap { padding-bottom:75% !important; }
    .lb_list_best { overflow:hidden; margin-right:-15px; margin-bottom:-15px; }
.lb_list_best .list-col { margin-right:15px; margin-bottom: 15px; }
    .lb_list_best .list-desc { height:85px; }
    .lb_list_best .list-more a:hover { color:rgb(51, 51, 51); }
                @media (max-width: 1199px) {
    .responsive .lb_list_best .lr_list_best { width:33.33%; }
}
                @media (max-width: 991px) {
    .responsive .lb_list_best .lr_list_best { width:33.33%; }
}
                @media (max-width: 767px) {
    .responsive .lb_list_best .lr_list_best { width:50%; }
}
                @media (max-width: 480px) {
    .responsive .lb_list_best .lr_list_best { width:100%; }
}

.list-body .list-row { float:left; width:33.33%; }
.list-body .list-row .img-wrap { padding-bottom:75% !important; }
        .list-body { overflow:hidden; margin-right:-15px; margin-bottom:-15px; }
.list-body .list-col { margin-right:15px; margin-bottom: 15px; }
        .list-body .list-desc { height:85px; }
        .list-board .list-more a:hover { color:rgb(51, 51, 51); }
                    @media (max-width: 1199px) {
        .responsive .list-body .list-row { width:33.33%; }
    }
                    @media (max-width: 991px) {
        .responsive .list-body .list-row { width:33.33%; }
    }
                    @media (max-width: 767px) {
        .responsive .list-body .list-row { width:50%; }
    }
                    @media (max-width: 480px) {
        .responsive .list-body .list-row { width:100%; }
    }

.list-top { line-height:1px; }

.list-board #infscr-loading { background: rgb(0, 0, 0); margin:0px; padding: 10px; border-radius: 10px; left: 50%; width: 200px; margin-left:-110px; text-align: center; bottom: 50px; color: rgb(255, 255, 255); position: fixed; z-index: 100; opacity: 0.8; -webkit-border-radius: 10px; -moz-border-radius: 10px; }
.list-board .list-more { text-align:center; margin-top:15px; }
.list-board .list-more a { color:#ddd; font-size:60px; }

/* Icon */
.list-board .wr-notice { background:#fafafa; margin-bottom:15px; }
.list-board .wr-notice li { background:none; }
.list-board .wr-vicon { position:absolute; left:15px; bottom:12px; color: rgba(255,255,255,0.8); font-size:32px; z-index:1; text-shadow: 1px 1px 1px #000; }
.list-board .wr-none { padding:50px 0px; text-align:center; color:#888; }

/* List */
.list-body .list-box { position:relative; border:1px solid #ddd; background:#fff; }
.list-body .list-front { position:relative; }
.list-body .list-box:hover,
.list-body .list-box.active { border-width:3px; border-style:solid; overflow:hidden; }
.list-body .list-box:hover .list-front,
.list-body .list-box.active .list-front { margin:-2px; overflow:hidden; }
.list-body .list-chk { position:absolute; left:15px; top:12px; z-index:2; }
.list-body .list-text .div-title-underline-thin { margin:0px 0px 2px; padding:0px 0px 2px; padding-right:1px; letter-spacing:-1px; }

.list-body .list-img { position:relative; }
.list-body .list-img .list-thumb { position:relative; overflow:hidden; max-height:360px; }
.list-body .list-img .list-thumb .wr-img { width:100%; height:auto; }
.list-body .list-img .thumb-icon { position:absolute; left:0; top:0; width:100%; height:100%; }
.list-body .list-img .thumb-icon .wr-fa { position:absolute; left:0; top:50%; width:100%; text-align:center; font-size:50px; margin-top:-25px; }
.list-body .list-img .wr-date { position:absolute; right:15px; bottom:12px; font-size:16px; color: rgba(255,255,255,0.8); text-shadow: 1px 1px 1px #000; z-index:2; letter-spacing:-1px; }
.list-body .list-text { padding:15px; }
.list-body .list-desc { line-height:20px; overflow:hidden; margin-bottom:20px; }
.list-body .list-desc strong { display:block; font-size:16px; font-weight:normal; }
.list-body .list-info .pull-right i { margin-left:10px; margin-right:2px; }
.list-body .list-info .wr-mb { display:inline-block; width:34px; height:34px; border-radius:50%; background:#eee; color:#fff; margin-right:4px; vertical-align:middle; }
.list-body .list-info .wr-mb img { width:34px; height:34px; border-radius:50%; }
.list-body .list-info .wr-mb i { width:34px; height:34px; line-height:34px; text-align:center; font-size:20px; border-radius:50%; }

/* Photo */
.list-body.is-photo .list-info,
.list-body.is-photo .list-info.pull-left,
.list-body.is-photo .list-info.pull-right { line-height: 34px; }
.list-body.is-photo .list-text { padding:15px 15px 10px; }

/* Hover Border */
.color-body.list-body .list-box:hover,
.color-body.list-body .list-box.active { border-color: rgb(233, 27, 35); }

.red-body.list-body .list-box:hover,
.red-body.list-body .list-box.active { border-color: rgb(233, 27, 35); }

.darkred-body.list-body .list-box:hover,
.darkred-body.list-body .list-box.active { border-color: rgb(170, 60, 63); }

.crimson-body.list-body .list-box:hover,
.crimson-body.list-body .list-box.active { border-color: rgb(220, 20, 60); }

.orangered-body.list-body .list-box:hover,
.orangered-body.list-body .list-box.active { border-color: orangered; }

.orange-body.list-body .list-box:hover,
.orange-body.list-body .list-box.active { border-color: rgb(240, 150, 20); }

.green-body.list-body .list-box:hover,
.green-body.list-body .list-box.active { border-color: rgb(140, 195, 70); }

.lightgreen-body.list-body .list-box:hover,
.lightgreen-body.list-body .list-box.active { border-color: rgb(160, 200, 80); }

.deepblue-body.list-body .list-box:hover,
.deepblue-body.list-body .list-box.active { border-color: rgb(0, 125, 180); }

.skyblue-body.list-body .list-box:hover,
.skyblue-body.list-body .list-box.active { border-color: rgb(100, 195, 245); }

.blue-body.list-body .list-box:hover,
.blue-body.list-body .list-box.active { border-color: rgb(52, 152, 219); }

.navy-body.list-body .list-box:hover,
.navy-body.list-body .list-box.active { border-color: rgb(50, 60, 70); }

.violet-body.list-body .list-box:hover,
.violet-body.list-body .list-box.active { border-color: rgb(85, 60, 125); }

.yellow-body.list-body .list-box:hover,
.yellow-body.list-body .list-box.active { border-color: rgb(241, 196, 15); }

.darkgray-body.list-body .list-box:hover,
.darkgray-body.list-body .list-box.active { border-color: #666; }

.gray-body.list-body .list-box:hover,
.gray-body.list-body .list-box.active { border-color: #888; }

.lightgray-body.list-body .list-box:hover,
.lightgray-body.list-body .list-box.active { border-color: #ddd; }

.black-body.list-body .list-box:hover,
.black-body.list-body .list-box.active { border-color: #333; }

.white-body.list-body .list-box:hover,
.white-body.list-body .list-box.active { border-width:1px; border-color: #fff; }
.white-body.list-body .list-box:hover .list-front,
.white-body.list-body .list-box.active .list-front { margin:0px; }

/* Style */
.box-body.list-body .list-img { margin: 10px 10px 0px; }

.round-body.list-body .list-img { margin: 10px 10px 0px; border-radius:15px; }
.round-body.list-body .list-img .wr-img,
.round-body.list-body .list-img .thumb-icon{ border-radius:15px; }
.round-body.list-body .shadow-line { margin:0px 15px; }

.line-body.list-body .list-box { border-left:0; border-top:0; border-right:0; }
.line-body.list-body .list-box:hover .list-front,
.line-body.list-body .list-box.active .list-front { margin:0px 0px -2px; }
.line-body.list-body .list-text { padding-left:10px !important; padding-right:10px !important; }

.line-round-body.list-body .list-box { border-left:0; border-top:0; border-right:0; }
.line-round-body.list-body .list-box:hover .list-front,
.line-round-body.list-body .list-box.active .list-front { margin:0px 0px -2px; }
.line-round-body.list-body .list-img { border-radius:15px; }
.line-round-body.list-body .list-img .wr-img,
.line-round-body.list-body .list-img .thumb-icon{ border-radius:15px; }
.line-round-body.list-body .shadow-line { margin:0px 15px; }
.line-round-body.list-body .list-text { padding-left:10px !important; padding-right:10px !important; }
/* //2018-08-16.이종석.[E]임의로 스타일 그대로 복사해서 넣음 */
</style>

<!--<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> -->

		<div  id="channelinfo1" >
			<?php include_once "./channelinfo1.php"; ?>
		</div>
		<div  id="channelinfo2">
			<?php  include_once "./channelinfo2.php"; ?>
		</div>
		
	</div>
</div>
