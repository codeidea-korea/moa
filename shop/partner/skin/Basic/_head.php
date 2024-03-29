<?php 
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가 

//add_stylesheet('<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,400italic,700,800" type="text/css">',0);
//add_stylesheet('<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:300,200,100" type="text/css">',0);
//add_stylesheet('<link rel="stylesheet" href="'.$skin_url.'/assets/css/bootstrap.min.css" type="text/css" media="screen">',0);
//add_stylesheet('<link rel="stylesheet" href="'.$skin_url.'/style.css" type="text/css" media="screen">',0);
//add_stylesheet('<link rel="stylesheet" href="/css/q.css" type="text/css" media="screen">',0);
//echo '<link rel="stylesheet" href="/shop/partner/skin/Basic/style.css" type="text/css" media="screen">';
echo '<link rel="stylesheet" href="'.get_url('/shop/partner/skin/Basic/style.css').'" type="text/css" media="screen">';
?>

<header id="topContainer">
	
	<div class="logo"><a href="<?php echo G5_URL;?>">MOA</a></div>
	<div class="loaction"></div>
	<script>
	//location text넣기
	$(document).ready(function(){
		var opener_name = $('#sideContainer #nav_ul li.open > a').text(),
			page_name = $('#sideContainer #nav_ul li.active').text() ? $('#sideContainer #nav_ul li.active').text() : '';
		if(typeof opener_name !== typeof undefined && opener_name !== '') {
			$('#topContainer .loaction').append('<span>'+opener_name+'</span>');
		}
		$('#topContainer .loaction').append('<span>'+page_name+'</span>');
	});
	</script>
	<ul class="gbMenu">
		<li><a href="<?php echo G5_URL ?>" class="home" title="홈으로">홈으로</a></li>
		<li id="tnb_logout"><a href="<?php echo $at_href['logout'];?>?_go=host">로그아웃</a></li>
	</ul>

	<div class="member">
		<div class="user">
			<div class="photo">
                <!-- 2022.09.06. botbinoo, 프로필 이미지 수정 안되는 오류(리소스 캐싱 문제) -->
				<!-- <a href="<?php echo $at_href['myphoto'];?>" target="_blank" class="win_memo"> -->
				<a href="#" class="" onclick="openImg('<?php echo $at_href['myphoto'];?>')">
					<!-- <?php echo ($member['photo']) ? '<img src="'.$member['photo'].'" alt="">' : '<span class="no-img"></span>'; //사진 ?> -->
					<?php echo ($member['photo']) ? '<img src="'.$member['photo'].'?v='.time().'" alt="">' : '<span class="no-img"></span>'; //사진 ?>
                <!-- end 2022.09.06. botbinoo, 프로필 이미지 수정 안되는 오류(리소스 캐싱 문제) -->
				</a>
				<script>
				function openImg(link){
					var filter = "win16|win32|win64|mac"; 
					if(navigator.platform){
						if(0 > filter.indexOf(navigator.platform.toLowerCase())){
							location.href = link;
						}else{
							win_memo(link);
						}
					}
				}
				</script>
			</div>
			<div class="name">
				<?php echo $member['mb_nick'];?>
			</div>
		</div>			
	</div>
</header>



<div id="wrapper">

	<div id="sideContainer" class="">
		<div class="sideCon-inner">
			<nav id="nav">
				<ul id="nav_ul">
					<?php if(IS_SELLER) { ?>
					<li class="<?=!$ap?'active':''?>"><a href="./">홈</a></li>
					<li>
						<a href="#">내정보</a>
						<ul>
							<li class="<?=$ap == 'register_form'?'active':''?>"><a href="/shop/partner/?ap=register_form">프로필 관리</a></li>
							<!--<li><a href="/shop/mypage.php" target="_blank">추가 정보 관리</a></li>-->
							<li class="<?=$ap == 'register_form_step2'?'active':''?>"><a href="/shop/partner/?ap=register_form_step2">추가 정보 관리</a></li>
							<li class="<?=$ap == 'my_accounts'?'active':''?>"><a href="/shop/partner/?ap=my_accounts">정산 정보 관리</a></li>
						</ul>
					</li>
					<li>
						<a href="#">모임관리</a>
						<ul>
							<li class="<?=($ap == 'moa_write' && $w=='u') || $ap == 'list' ?'active':''?>"><a href="/shop/partner/?ap=list">모임 내역</a></li>
							<!--<li class=""><a href="#">진행중인 모임</a></li>-->
							<li class="<?=$ap == 'moim_membership'?'active':''?>"><a href="/shop/partner/?ap=moim_membership">모임 신청자 관리</a></li>
							<li class="<?=$ap == 'qalist' || $ap == 'qaform'?'active':''?>"><a href="/shop/partner/?ap=qalist">문의 관리</a></li>
							<li class="<?=$ap == 'uselist'?'active':''?>"><a href="/shop/partner/?ap=uselist">후기 관리</a></li>
						</ul>
					</li>
					<!--<li><a href="/bbs/write.php?bo_table=class" target="_blank">모임생성</a></li>-->
					<!-- <li class="<?=$ap == 'moa_write' && !$w ?'active':''?>"><a href="/shop/partner/?ap=moa_write" target="_blank">모임생성</a></li> -->
					<li class="<?=$ap == 'moa_write' && !$w ?'active':''?>"><a href="/shop/partner/?ap=moa_write">모임생성</a></li>
					<li>
						<a href="#">정산 관리</a>
						<ul>
							<li class="<?=$ap == 'salelist'?'active':''?>"><a href="/shop/partner/?ap=salelist">매출 현황</a></li>
							<li class="<?=$ap == 'payrequest'?'active':''?>"><a href="/shop/partner/?ap=payrequest">정산 신청</a></li>
							<li class="<?=$ap == 'paylist'?'active':''?>"><a href="/shop/partner/?ap=paylist">정산 내역</a></li>
						</ul>
					</li>
					<?php } ?>

					<?php if(IS_SELLER) { ?>
						<!--<li<?php if(!$ap) echo ' class="active"';?> style="margin-top:50px">
							<a href="./"><i class="fa fa-dashboard fa-lg"></i> 대시보드</a>
						</li>
						<li<?php if($ap == 'list' || $ap == 'item') echo ' class="active"';?>>
							<a href="./?ap=list"><i class="fa fa-cube fa-lg"></i> 자료관리</a>
						</li>
						<li<?php if($ap == 'comment') echo ' class="active"';?>>
							<a href="./?ap=comment"><i class="fa fa-comment fa-lg"></i> 댓글관리</a>
						</li>
						<li<?php if($ap == 'qalist') echo ' class="active"';?>>
							<a href="./?ap=qalist"><i class="fa fa-question-circle fa-lg"></i> 문의관리</a>
						</li>
						<li<?php if($ap == 'uselist') echo ' class="active"';?>>
							<a href="./?ap=uselist"><i class="fa fa-star fa-lg"></i> 후기관리</a>
						</li>
						<li<?php if($ap == 'salelist') echo ' class="active"';?>>
							<a href="./?ap=salelist"><i class="fa fa-line-chart fa-lg"></i> 판매현황</a>
						</li>
						<li<?php if($ap == 'saleitem') echo ' class="active"';?>>
							<a href="./?ap=saleitem"><i class="fa fa-shopping-cart fa-lg"></i> 판매자료</a>
						</li>
						<?php if(false) {?>
						<li<?php if($ap == 'delivery') echo ' class="active"';?>>
							<a href="./?ap=delivery"><i class="fa fa-truck fa-lg"></i> 배송관리</a>
						</li>
						<li<?php if($ap == 'sendcost') echo ' class="active"';?>>
							<a href="./?ap=sendcost"><i class="fa fa-tag fa-lg"></i> 배송비용</a>
						</li>
						<?php } ?>
						<li<?php if($ap == 'cancelitem') echo ' class="active"';?>>
							<a href="./?ap=cancelitem"><i class="fa fa-cart-arrow-down fa-lg"></i> 취소내역</a>
						</li>
						<li<?php if($ap == 'paylist') echo ' class="active"';?>>
							<a href="./?ap=paylist"><i class="fa fa-calculator fa-lg"></i> 출금관리</a>
						</li>-->
					<?php } ?>
				</ul>
			</nav>
		</div>
	</div>

	<!-- Sidebar -->
	<nav class="navbar navbar-inverse navbar-fixed-top en none" role="navigation">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="./">
				<span>
					<?php echo ($member['photo']) ? '<img src="'.$member['photo'].'" alt="" class="photo">' : '<i class="fa fa-cubes fa-lg"></i>'; //사진 ?>
					My Admin
				</span>
			</a>
		</div>
		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse navbar-ex1-collapse">
			<ul class="nav navbar-nav side-nav">
				<?php if(IS_SELLER) { ?>
					<li<?php if(!$ap) echo ' class="active"';?>>
						<a href="./"><i class="fa fa-dashboard fa-lg"></i> 대시보드</a>
					</li>
					<li<?php if($ap == 'list' || $ap == 'item') echo ' class="active"';?>>
						<a href="./?ap=list"><i class="fa fa-cube fa-lg"></i> 자료관리</a>
					</li>
					<li<?php if($ap == 'comment') echo ' class="active"';?>>
						<a href="./?ap=comment"><i class="fa fa-comment fa-lg"></i> 댓글관리</a>
					</li>
					<li<?php if($ap == 'qalist') echo ' class="active"';?>>
						<a href="./?ap=qalist"><i class="fa fa-question-circle fa-lg"></i> 문의관리</a>
					</li>
					<li<?php if($ap == 'uselist') echo ' class="active"';?>>
						<a href="./?ap=uselist"><i class="fa fa-star fa-lg"></i> 후기관리</a>
					</li>
					<li<?php if($ap == 'salelist') echo ' class="active"';?>>
						<a href="./?ap=salelist"><i class="fa fa-line-chart fa-lg"></i> 판매현황</a>
					</li>
					<li<?php if($ap == 'saleitem') echo ' class="active"';?>>
						<a href="./?ap=saleitem"><i class="fa fa-shopping-cart fa-lg"></i> 판매자료</a>
					</li>
					<?php if(false) {?>
					<li<?php if($ap == 'delivery') echo ' class="active"';?>>
						<a href="./?ap=delivery"><i class="fa fa-truck fa-lg"></i> 배송관리</a>
					</li>
					<li<?php if($ap == 'sendcost') echo ' class="active"';?>>
						<a href="./?ap=sendcost"><i class="fa fa-tag fa-lg"></i> 배송비용</a>
					</li>
					<?php } ?>
					<li<?php if($ap == 'cancelitem') echo ' class="active"';?>>
						<a href="./?ap=cancelitem"><i class="fa fa-cart-arrow-down fa-lg"></i> 취소내역</a>
					</li>
					<li<?php if($ap == 'paylist') echo ' class="active"';?>>
						<a href="./?ap=paylist"><i class="fa fa-calculator fa-lg"></i> 출금관리</a>
					</li>
				<?php } ?>
				<?php if(IS_MARKETER) { ?>
					<li class="bg-green">
						<a><span class="white"><i class="fa fa-database fa-lg"></i> 추천인(마케터)</span></a>
					</li>
					<li<?php if(!$ap) echo ' class="active"';?>>
						<a href="./"><i class="fa fa-dashboard fa-lg"></i> 대시보드</a>
					</li>
					<li<?php if($ap == 'mitem') echo ' class="active"';?>>
						<a href="./?ap=mitem"><i class="fa fa-cube fa-lg"></i> 수익자료</a>
					</li>
					<li<?php if($ap == 'mlist') echo ' class="active"';?>>
						<a href="./?ap=mlist"><i class="fa fa-line-chart fa-lg"></i> 수익현황</a>
					</li>
					<li<?php if($ap == 'mitemlist') echo ' class="active"';?>>
						<a href="./?ap=mitemlist"><i class="fa fa-database fa-lg"></i> 수익내역</a>
					</li>
					<li<?php if($ap == 'mcancelitem') echo ' class="active"';?>>
						<a href="./?ap=mcancelitem"><i class="fa fa-cart-arrow-down fa-lg"></i> 취소내역</a>
					</li>
					<li<?php if($ap == 'mpaylist') echo ' class="active"';?>>
						<a href="./?ap=mpaylist"><i class="fa fa-calculator fa-lg"></i> 출금관리</a>
					</li>
				<?php } ?>
			</ul>
			<ul class="nav navbar-nav navbar-left">
				<li class="hidden-xs">
					<a>
						<i class="fa fa-user fa-lg"></i>
						<?php echo xp_icon($member['mb_id'], $member['level']);?>
						<?php echo $member['mb_nick'];?>
					</a>
				</li>
				<?php if($member['admin']) { ?>
					<li><a href="<?php echo G5_ADMIN_URL;?>"><i class="fa fa-cog fa-lg"></i> 관리자</a></li>
				<?php } ?>
				<li>
					<a href="<?php echo $at_href['response'];?>" target="_blank" class="win_memo">
						<i class="fa fa-retweet fa-lg"></i> 내글반응
						<?php if ($member['response']) { ?>
							<span class="badge bg-blue"><?php echo number_format($member['response']);?></span>
						<?php } ?>
					</a>		
				</li>
				<li>
					<a href="<?php echo $at_href['memo'];?>" target="_blank" class="win_memo">
						<i class="fa fa-envelope-o fa-lg"></i> 쪽지함
						<?php if ($member['memo']) { ?>
							<span class="badge bg-green"><?php echo number_format($member['memo']);?></span>
						<?php } ?>
					</a>		
				</li>
				<li>
					<a href="<?php echo $at_href['secret'];?>"><i class="fa fa-user-secret fa-lg"></i> 1:1문의</a>
				</li>
				<?php if(IS_SELLER) { ?>
					<li>
						<a href="<?php echo G5_SHOP_URL;?>/myshop.php?id=<?php echo urlencode($member['mb_id']);?>"><i class="fa fa-home fa-lg"></i> 내개설모임</a>
					</li>
				<?php } ?>
				
				<li>
					<a href="<?php echo G5_URL;?>"><i class="fa fa-users fa-lg"></i> MOA 메인</a>
				</li>
				<li>
					<a href="<?php echo $at_href['logout'];?>">
						<i class="fa fa-sign-out fa-lg"></i> 로그아웃
					</a>
				</li>
			</ul>
		</div><!-- /.navbar-collapse -->
	</nav>

	<div id="page-wrapper">
	<?//=$skin_url;?>