<?php
if (!defined('_GNUBOARD_')) exit;

function print_menu1($key, $no) {
    global $menu;

    $str = print_menu2($key, $no);

    return $str;
}

function print_menu2($key, $no) {
    global $menu, $auth_menu, $is_admin, $auth, $g5, $sub_menu;

    $str = "<ul class=\"gnb_2dul\">";
    for($i=1; $i<count($menu[$key]); $i++) {

		if(!$menu[$key][$i][1])
			continue;

        if ($is_admin != 'super' && (!array_key_exists($menu[$key][$i][0],$auth) || !strstr($auth[$menu[$key][$i][0]], 'r')))
            continue;
        if ($menu && is_array($menu) && $menu[$key] && $menu[$key][$i] && $menu[$key][$i][4] ) {

	        if (($menu[$key][$i][4] == 1 && $gnb_grp_style == false) || ($menu[$key][$i][4] != 1 && $gnb_grp_style == true)) $gnb_grp_div = 'gnb_grp_div';
	        else $gnb_grp_div = '';

	        if ($menu[$key][$i][4] == 1) $gnb_grp_style = 'gnb_grp_style';
	        else $gnb_grp_style = '';
        }
        else {
			$gnb_grp_div = '';        	
			$gnb_grp_style = '';
        }

		if (isset($sub_menu) && $sub_menu == $menu[$key][$i][0]) $gnb_on = ' on';
        else $gnb_on = '';

        $str .= '<li class="gnb_2dli"><a href="'.$menu[$key][$i][2].'" class="gnb_2da '.$gnb_grp_style.' '.$gnb_grp_div.$gnb_on.'">'.$menu[$key][$i][1].'</a></li>';

        $auth_menu[$menu[$key][$i][0]] = $menu[$key][$i][1];
    }
    $str .= "</ul>";

    return $str;
}

// Load Setting
$aset = array();
$aset = apms_admin_skin($_POST['asave'], $_POST['aset']); // 설정값 불러오기
$aset['css'] = (isset($aset['css']) && $aset['css']) ? $aset['css'] : 'basic'; // CSS스킨
$aset['logo'] = (isset($aset['logo']) && $aset['logo']) ? $aset['logo'] : '{아이콘:cube} ADMINISTRATOR'; // 텍스트 로고
$aset['font'] = (isset($aset['font']) && $aset['font']) ? $aset['font'] : '#fff'; // 메뉴 호버시 글자색
$aset['hover'] = (isset($aset['hover']) && $aset['hover']) ? $aset['hover'] : '#08a2cd'; // 메뉴 호버시 배경색
$aset['fixed'] = (isset($aset['fixed']) && $aset['fixed']) ? true : false; // 메뉴 상단고정

?>

<script>
var tempX = 0;
var tempY = 0;

function imageview(id, w, h)
{

    menu(id);

    var el_id = document.getElementById(id);

    //submenu = eval(name+".style");
    submenu = el_id.style;
    submenu.left = tempX - ( w + 11 );
    submenu.top  = tempY - ( h / 2 );

    selectBoxVisible();

    if (el_id.style.display != 'none')
        selectBoxHidden(id);
}
</script>

<style>
#inb a:hover, #side_menu a:hover, #side_menu a:focus, .gnb_1dli_on .gnb_1da, .gnb_1dli_air .gnb_1da, .gnb_2da:focus, .gnb_2da:hover {
	color: <?php echo $aset['font'];?> !important;
	background: <?php echo $aset['hover'];?> !important;
}
</style>

<?php
//echo '<link rel="stylesheet" href="'.get_url(ADMIN_SKIN_URL.'/css/'.$aset['css'].'/admin.css').'">'.PHP_EOL;
//김과장 추가
echo '<link rel="stylesheet" href="'.get_url(G5_ADMIN_URL.'/css/original.css').'">'.PHP_EOL;
echo '<link rel="stylesheet" href="'.get_url(G5_ADMIN_URL.'/js/datepicker/datepicker.css').'">'.PHP_EOL;
echo '<link rel="stylesheet" href="'.get_url(G5_ADMIN_URL.'/js/bootstrap-select/bootstrap-select.css').'">'.PHP_EOL;	
echo '<link rel="stylesheet" href="'.get_url(G5_ADMIN_URL.'/css/new-adminDefault.css').'">'.PHP_EOL;
echo '<link rel="stylesheet" href="'.get_url(G5_ADMIN_URL.'/css/new-admin.css').'">'.PHP_EOL;

echo '<script type="text/javascript" src="'.G5_ADMIN_URL.'/js/easing.js"></script>'.PHP_EOL;
echo '<script type="text/javascript" src="'.G5_ADMIN_URL.'/js/sideContainer.js"></script>'.PHP_EOL;
echo '<script type="text/javascript" src="'.G5_ADMIN_URL.'/js/bootstrap-select/bootstrap.min.js"></script>'.PHP_EOL;
echo '<script type="text/javascript" src="'.get_url(G5_ADMIN_URL.'/js/bootstrap-select/bootstrap-select.js').'"></script>'.PHP_EOL;
echo '<script type="text/javascript" src="'.get_url(G5_ADMIN_URL.'/js/datepicker/datepicker.js').'"></script>'.PHP_EOL;
echo '<script type="text/javascript" src="'.G5_ADMIN_URL.'/js/datepicker/datepicker.ko-KR.js"></script>'.PHP_EOL;
echo '<script type="text/javascript" src="'.get_url(G5_ADMIN_URL.'/js/myform.js').'"></script>'.PHP_EOL;
echo '<script type="text/javascript" src="'.get_url(G5_ADMIN_URL.'/js/myScript.js').'"></script>'.PHP_EOL;
?>


<div id="to_content"><a href="#container">본문 바로가기</a></div>

<header id="topContainer" class="<?php echo $inner;?>">

	<div class="logo"><a href="<?php echo G5_ADMIN_URL ?>"><?php echo apms_fa($aset['logo']);?></a></div>
	<div class="loaction"><?php if($menu['menu'.substr($sub_menu, 0, 3)][0][1]) echo '<span>'.$menu['menu'.substr($sub_menu, 0, 3)][0][1].'</span>';?><span><?php echo $g5['title'] ?></span></div>
	<ul class="gbMenu">
		<li><a href="<?php echo G5_URL ?>" class="home" title="홈으로">홈으로</a></li>
		<li><a href="<?php echo G5_ADMIN_URL ?>/member_form.php?w=u&amp;mb_id=<?php echo $member['mb_id'] ?>">관리자정보</a></li>
		<li><a href="<?php echo G5_ADMIN_URL ?>/config_form.php">기본환경</a></li>
<!--		<li><a href="--><?php //echo G5_ADMIN_URL ?><!--/service.php">부가서비스</a></li>-->
		<!-- <li><a href="<?php echo G5_URL ?>/">커뮤니티</a></li>
		<?php if(defined('G5_USE_SHOP')) { ?>
		<li><a href="<?php echo G5_ADMIN_URL ?>/shop_admin/configform.php">쇼핑몰환경</a></li>
		<li><a href="<?php echo G5_SHOP_URL ?>/">쇼핑몰</a></li> -->
		<?php } ?>
		<li id="tnb_logout"><a href="<?php echo G5_BBS_URL ?>/logout.php">로그아웃</a></li>
	</ul>

	<div class="member">
		<div class="user">
			<div class="photo">
				<a href="<?php echo $at_href['myphoto'];?>" target="_blank" class="win_memo">
					<?php echo ($member['photo']) ? '<img src="'.$member['photo'].'" alt="">' : '<span class="no-img"></span>'; //사진 ?>
				</a>
			</div>
			<div class="name">
				<?php echo apms_sideview($member['mb_id'], $member['mb_nick'], $member['mb_email'], $member['mb_homepage'], 'no');?> 
				<?php if($member['grade']) echo '<span class="tag">'.$member['grade'].'</span>';?>
			</div>
		</div>
		<ul class="msg none">
			<li>
				<a href="<?php echo $at_href['response'];?>" target="_blank" class="win_memo icon_response">
					미확인 알림
					<?php if($member['response'] > 0) echo '<span class="num">'.number_format($member['response']).'</span>';?>
				</a>		
			</li>
			<li>
				<a href="<?php echo $at_href['memo'];?>" target="_blank" class="win_memo icon_memo">
					미확인 쪽지
					<?php if($member['memo'] > 0) echo '<span class="num">'.number_format($member['memo']).'</span>';?>
				</a>		
			</li>
		</ul>			
	</div>

	<div id="hd_wrap" class="none">
		<h1><?php echo $config['cf_title'] ?></h1>

		<div id="logo"><a href="<?php echo G5_ADMIN_URL ?>"><?php echo apms_fa($aset['logo']);?></a></div>

		<ul id="tnb">
			<li><a href="<?php echo G5_ADMIN_URL ?>/member_form.php?w=u&amp;mb_id=<?php echo $member['mb_id'] ?>">관리자정보</a></li>
			<li><a href="<?php echo G5_ADMIN_URL ?>/config_form.php">기본환경</a></li>
			<li><a href="<?php echo G5_ADMIN_URL ?>/service.php">부가서비스</a></li>
			<!-- <li><a href="<?php echo G5_URL ?>/">커뮤니티</a></li>
			<?php if(defined('G5_USE_SHOP')) { ?>
			<li><a href="<?php echo G5_ADMIN_URL ?>/shop_admin/configform.php">쇼핑몰환경</a></li>
			<li><a href="<?php echo G5_SHOP_URL ?>/">쇼핑몰</a></li> -->
			<?php } ?>
			<li id="tnb_logout"><a href="<?php echo G5_BBS_URL ?>/logout.php">로그아웃</a></li>
		</ul>
		
		<nav id="gnb">
			<div id="inb">
				<a href="<?php echo G5_URL ?>/" title="커뮤니티"><i class="fa fa-home"></i></a>
				<?php if(IS_YC) { ?>
					<a href="<?php echo G5_SHOP_URL ?>/" title="쇼핑몰"><i class="fa fa-shopping-cart"></i></a>
				<?php } ?>
				<a class="cursor btn-switcher" title="스킨설정"><i class="fa fa-cog"></i></a>
				<a href="<?php echo G5_BBS_URL ?>/logout.php" title="로그아웃"><i class="fa fa-sign-out"></i></a>
			</div>
			<?php
			$gnb_str = "<ul id=\"gnb_1dul\">";
			
			$gnb_index_class = ($is_index) ? ' gnb_1dli_air' : '';

			foreach($amenu as $key=>$value) {
				$href1 = $href2 = '';
				if ($menu['menu'.$key][0][2]) {
					$href1 = '<a href="'.$menu['menu'.$key][0][2].'" class="gnb_1da">';
					$href2 = '</a>';
				} else {
					continue;
				}
				$current_class = "";
				if (isset($sub_menu) && (substr($sub_menu, 0, 3) == substr($menu['menu'.$key][0][0], 0, 3)))
					$current_class = " gnb_1dli_air";
				$gnb_str .= '<li class="gnb_1dli'.$current_class.'">'.PHP_EOL;
				$gnb_str .=  $href1 . $menu['menu'.$key][0][1] . $href2;
				$gnb_str .=  print_menu1('menu'.$key, 1);
				$gnb_str .=  "</li>";
			}
			$gnb_str .= "</ul>";
			echo $gnb_str;
			?>
		</nav>
	</div>

</header>

<div id="wrapper">
	
	<div id="sideContainer" class="<?php echo $inner;?>">
		<div class="sideCon-inner">
			<nav id="nav">
				<ul id="nav_ul">					
					<li <?php if(strpos(basename($_SERVER['PHP_SELF']),'index') !== false) echo 'class="active"'; ?>><a href="<?php echo G5_ADMIN_URL ?>">대시보드</a></li>
					<?php foreach($amenu as $key=>$value) {
						if ($menu['menu'.$key][0][1] && $menu['menu'.$key][0][2]) {							
							$d1_active_class = substr($sub_menu, 0, 3) == substr($menu['menu'.$key][0][0], 0, 3) ? ' class="active"' : '';
							echo '<li'.$d1_active_class.'><a href="'.$menu['menu'.$key][0][2].'">'.$menu['menu'.$key][0][1].'</a>';
							$menu_key = substr($sub_menu, 0, 3);
							$nl = '';							
							for($i=1; $i<count($menu['menu'.$key]); $i++) {
								if ($is_admin != 'super' && (!array_key_exists($menu['menu'.$key][$i][0],$auth) || !strstr($auth[$menu['menu'.$key][$i][0]], 'r'))) continue;								
								$d2_active_class = (isset($sub_menu) && $sub_menu == $menu['menu'.$key][$i][0]) ? ' class="active"' : '';
								$nl .= '<li'.$d2_active_class.'><a href="'.$menu['menu'.$key][$i][2].'">'.$menu['menu'.$key][$i][1].'</a></li>';
							}
							if($nl) echo '<ul>'.$nl.'</ul>'.PHP_EOL;
							echo '</li>'.PHP_EOL;
						}
					} ?>
				</ul>
			</nav>
		</div>
	</div>

	<div id="side_wrap" class="none">
		<div id="side_login">
			<div class="user">
				<div class="photo">
					<a href="<?php echo $at_href['myphoto'];?>" target="_blank" class="win_memo">
						<?php echo ($member['photo']) ? '<img src="'.$member['photo'].'" alt="">' : '<i class="fa fa-user-plus"></i>'; //사진 ?>
					</a>
				</div>
				<div class="name">
					<p>
						<?php echo apms_sideview($member['mb_id'], $member['mb_nick'], $member['mb_email'], $member['mb_homepage'], 'no');?> 
					</p>
					<?php echo $member['grade'];?>
				</div>
			</div>
			<ul class="msg">
				<li>
					<a href="<?php echo $at_href['response'];?>" target="_blank" class="win_memo">
						미확인 알림
						<span class="pull-right">
							<?php echo ($member['response'] > 0) ? '<b class="red">'.number_format($member['response']).'</b> 개' : '없음';?>
						</span>
					</a>		
				</li>
				<li>
					<a href="<?php echo $at_href['memo'];?>" target="_blank" class="win_memo">
						미확인 쪽지
						<span class="pull-right">
							<?php echo ($member['memo'] > 0) ? '<b class="orangered">'.number_format($member['memo']).'</b> 개' : '없음';?>
						</span>
					</a>		
				</li>
			</ul>
		</div>
		
		<ul id="side_menu" class="<?php echo $inner;?>">
		<?php
			foreach($amenu as $key=>$value) {
				if ($menu['menu'.$key][0][1] && $menu['menu'.$key][0][2]) {
					if (isset($sub_menu) && $sub_menu && (substr($sub_menu, 0, 3) == substr($menu['menu'.$key][0][0], 0, 3))) {

						echo '<li><a href="'.$menu['menu'.$key][0][2].'" class="on">'.$menu['menu'.$key][0][1].'</a>';

						$menu_key = substr($sub_menu, 0, 3);
						$nl = '';
						foreach($menu['menu'.$menu_key] as $key=>$value) {

							if(!($value[1] && $value[2])) continue;

							if($key > 0) {
								if ($is_admin != 'super' && (!array_key_exists($value[0],$auth) || !strstr($auth[$value[0]], 'r')))
									continue;

								$on_class = ($sub_menu == $value[0]) ? ' class="on"' : '';

								$nl .= '<li><a href="'.$value[2].'"'.$on_class.'>'.$value[1].'</a></li>'.PHP_EOL;
							}
						}

						if($nl) echo '<ul>'.$nl.'</ul>'.PHP_EOL;

						echo '</li>'.PHP_EOL;
					} else {
						echo '<li><a href="'.$menu['menu'.$key][0][2].'">'.$menu['menu'.$key][0][1].'</a></li>';
					}
				}
			}
		?>
		</ul>
	</div>

	<div id="page-wrapper">
		<div id="container">
			<div id="text_size">
				<!-- font_resize('엘리먼트id', '제거할 class', '추가할 class'); -->
				<button onclick="font_resize('container', 'ts_up ts_up2', '');"><img src="<?php echo G5_ADMIN_URL ?>/img/ts01.gif" alt="기본"></button>
				<button onclick="font_resize('container', 'ts_up ts_up2', 'ts_up');"><img src="<?php echo G5_ADMIN_URL ?>/img/ts02.gif" alt="크게"></button>
				<button onclick="font_resize('container', 'ts_up ts_up2', 'ts_up2');"><img src="<?php echo G5_ADMIN_URL ?>/img/ts03.gif" alt="더크게"></button>
			</div>
			<!--<h1><?php echo $g5['title'] ?></h1>-->
			<div class="page-title"><?php echo $g5['title'] ?></div>
