<?php
if (!defined('G5_USE_SHOP') || !G5_USE_SHOP) return;
if ($_a == "y" && $_extMenu) {
    $menu['menu540'] = array ();
    $menu['menu540'][] = array('540000', '통계관리', G5_ADMIN_URL.'/shop_admin/itemsellrank.php', 'shop_stats');
	$menu['menu540'][] = array('540110', '수익기록', G5_ADMIN_URL.'/shop_admin/itemsellrank.php', 'shop_stats');
    //$menu['menu540'][] = array('540110', '이벤트관리', G5_ADMIN_URL.'/shop_admin/itemevent.php', 'scf_event');
    // $menu['menu540'][] = array('540100', '메인베너관리', G5_ADMIN_URL.'/shop_admin/bannerlist.php', 'scf_banner');

  
    
}