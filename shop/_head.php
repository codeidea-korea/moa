<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if(USE_G5_THEME && defined('G5_THEME_PATH') && G5_IS_MOBILE)
    include_once(G5_MSHOP_PATH.'/shop.head.php');
else
    include_once(G5_SHOP_PATH.'/shop.head.php');

?>
