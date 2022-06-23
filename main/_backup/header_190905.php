<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가 
include_once(THEMA_PATH.'/assets/thema.php');
include_once(G5_LIB_PATH.'/outlogin.lib.php');
include_once(G5_LIB_PATH.'/popular.lib.php');
include_once(G5_LIB_PATH.'/latest.lib.php');
include_once(G5_LIB_PATH.'/apms.lib.php');

?>

<div id="thema_wrapper" class="wrapper <?php echo $is_thema_layout;?> <?php echo $is_thema_font;?>">

<!-- 글로벌 헤더 -->
<div class="header">
	<header class="navbar container grid-lg">
		<section class="navbar-section">
			<a href="/" class="navbar-brand"><img src="/imgs/logo.png" alt="DRAWIT logo" /></a>
			<?php 
			//print_r2($menu);
			for ($i=1; $i < $menu_cnt; $i++) {

				//if(!$menu[$i]['gr_id']) continue;

			?>
				<a href="<?php echo $menu[$i]['href'];?>" class="btn btn-link"><?php echo $menu[$i]['name'];?></a>
			<?php } //for ?>
			
		</section>
		<section class="navbar-center">
			<button type="button" class="btn-search"><i class="form-icon icon icon-search"></i></button>
			<div class="search-set input-group grid-lg">
				<form action="/drawit/search_result.php">
					<input class="form-input" type="text" placeholder="찾고 있는 선생님이나 수업이 있나요?" autofocus="true"/>
					<input type="submit" hidden="true" value="검색" />
					<div class="search-recommend container grid-lg">
						<a href="/drawit/search_result.php" class="label">웹툰</a>
						<a href="/drawit/search_result.php" class="label">드로잉</a>
						<a href="/drawit/search_result.php" class="label">일러스트</a>
						<a href="/drawit/search_result.php" class="label">아이패드</a>
						<a href="/drawit/search_result.php" class="label">입시전문</a>
						<a href="/drawit/search_result.php" class="label">3D</a>
					</div>
				</form>
			</div>
		</section>
		<section class="navbar-section account-set">
			<?php  echo outlogin(); ?>

		  
		</section>
	</header>
</div>
<?php 
//print_r2($menu);
?>