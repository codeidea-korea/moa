<?php
if (!defined('G5_USE_SHOP') || !G5_USE_SHOP) return;
if ($_extMenu) {
    $menu['menu510'] = array ();
    $menu['menu510'][] = array('510000', '수익|정산관리', G5_ADMIN_URL.'/shop_admin/itemsellrank.php', 'shop_stats');
    $menu['menu510'][] = array('510006', '호스트입출금', ''.G5_ADMIN_URL.'/apms_admin/apms.admin.php?ap=payment', 'apms_payment', 1);
    $menu['menu510'][] = array('510001', '정산비율설정', ''.G5_ADMIN_URL.'/apms_admin/apms.admin.php?ap=basic', 'apms_basic');
    $menu['menu510'][] = array('510002', '정산내역보기', ''.G5_ADMIN_URL.'/apms_admin/apms.admin.php?ap=adjustlist', 'apms_adjustlist');
    //$menu['menu510'][] = array('510110', '세금계산서', G5_ADMIN_URL.'/shop_admin/itemevent.php', 'scf_event');
    //$menu['menu510'][] = array('510100', '부가세신고', G5_ADMIN_URL.'/shop_admin/bannerlist.php', 'scf_banner');

   
}