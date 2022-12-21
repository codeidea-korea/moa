<?php
if (!defined('G5_USE_SHOP') || !G5_USE_SHOP) return;
//if ($_extMenu) {
    $menu['menu520'] = array ();
    $menu['menu520'][] = array('520000', '쿠폰관리', G5_ADMIN_URL.'/shop_admin/couponlist.php', 'scf_coupon');
    //$menu['menu520'][] = array('520100', '쿠폰관리', G5_ADMIN_URL.'/shop_admin/couponzonelist.php', 'scf_coupon_zone');
    //$menu['menu520'][] = array('520110', '쿠폰이용현황', G5_ADMIN_URL.'/shop_admin/couponlist.php', 'scf_banner');
    
//}