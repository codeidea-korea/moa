<?php
if (!defined('G5_USE_SHOP') || !G5_USE_SHOP) return;
if ($_a != "y") {

    $menu['menu400'] = array ();
    $menu['menu400'][] = array('400000', '전체모임관리', G5_ADMIN_URL.'/shop_admin/', 'shop_config');
    $menu['menu400'][] = array('400410', '모임관리', G5_ADMIN_URL.'/shop_admin/itemmoa_list.php', 'scf_item_moa');
//    $menu['menu400'][] = array('400400', '참여자 목록', G5_ADMIN_URL.'/shop_admin/orderer_list.php', 'scf_orderer', 1);
    //$menu['menu400'][] = array('400650', '사용후기', G5_ADMIN_URL.'/shop_admin/itemuselist.php', 'scf_ps');
    
    //$menu['menu400'][] = array('400660', '문의사항', G5_ADMIN_URL.'/shop_admin/itemqalist.php', 'scf_item_qna');
    //$menu['menu400'][] = array('400810', '쿠폰존등록관리', G5_ADMIN_URL.'/shop_admin/couponzonelist.php', 'scf_coupon_zone');
    //$menu['menu400'][] = array('400800', '쿠폰관리 ', G5_ADMIN_URL.'/shop_admin/couponlist.php', 'scf_coupon');
    
    
    
}

else {
    if ($_a == "y" && $_extMenu) {
        // $menu['menu400'][] = array('400430', '수강신청목록', G5_ADMIN_URL . '/shop_admin/courseslist.php', 'scf_courses', 1);
        // $menu['menu400'][] = array('400310', '모임커리큘럼 관리', G5_ADMIN_URL.'/shop_admin/lec_curriculum_list.php', 'scf_lec_curriculum');
        // $menu['menu400'][] = array('400420', '도서관리', G5_ADMIN_URL.'/shop_admin/itembook_list.php', 'scf_item_book');
        //$menu['menu400'][] = array('400440', '개인결제관리', G5_ADMIN_URL.'/shop_admin/personalpaylist.php', 'scf_personalpay', 1);
        //$menu['menu400'][] = array('400410', '미완료주문', G5_ADMIN_URL.'/shop_admin/inorderlist.php', 'scf_inorder', 1);
        $menu['menu400'][] = array('400620', '상품재고관리', G5_ADMIN_URL.'/shop_admin/itemstocklist.php', 'scf_item_stock');
        $menu['menu400'][] = array('400610', '상품유형관리', G5_ADMIN_URL.'/shop_admin/itemtypelist.php', 'scf_item_type');
        $menu['menu400'][] = array('400500', '상품옵션재고관리', G5_ADMIN_URL.'/shop_admin/optionstocklist.php', 'scf_item_option');
        //$menu['menu400'][] = array('400810', '쿠폰존관리', G5_ADMIN_URL.'/shop_admin/couponzonelist.php', 'scf_coupon_zone');
        $menu['menu400'][] = array('400300', '상품관리', G5_ADMIN_URL.'/shop_admin/itemlist.php', 'scf_item');
        //$menu['menu400'][] = array('400750', '추가배송비관리', G5_ADMIN_URL.'/shop_admin/sendcostlist.php', 'scf_sendcost', 1);
        $menu['menu400'][] = array('400820', '오프라인쿠폰관리 ', G5_ADMIN_URL.'/shop_admin/couponoffline.php', 'scf_coupon_offline');
    }
}