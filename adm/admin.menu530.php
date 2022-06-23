<?php
if (!defined('G5_USE_SHOP') || !G5_USE_SHOP) return;
    $menu['menu530'] = array ();
    $menu['menu530'][] = array('530000', '포인트 관리', G5_ADMIN_URL.'/point_list.php', 'mb_point');
    $menu['menu530'][] = array('530110', '포인트 관리', G5_ADMIN_URL.'/_add/point_config.php', 'mb_point2');
    $menu['menu530'][] = array('530120', '포인트 사용내역', G5_ADMIN_URL.'/point_list.php', 'mb_point3');

