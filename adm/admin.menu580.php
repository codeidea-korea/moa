<?php
if (!defined('G5_USE_SHOP') || !G5_USE_SHOP) return;
$menu['menu580'] = array ();
$menu['menu580'][] = array('580000', '기타관리', G5_ADMIN_URL.'/shop_admin/itemsellrank.php', 'shop_stats');
$menu['menu580'][] = array('580110', '이벤트관리', G5_ADMIN_URL.'/shop_admin/itemevent.php', 'scf_event');
$menu['menu580'][] = array('580120', '메인베너관리', G5_ADMIN_URL.'/shop_admin/bannerlist.php', 'scf_banner');
$menu['menu580'][] = array('580220', '팝업관리', G5_ADMIN_URL.'/newwinlist.php', 'scf_popup', 1);
$menu['menu580'][] = array('580300', '고객센터관리', ''.G5_ADMIN_URL.'/bbs/board.php?bo_table=qa', 'bbs_board_qna');
$menu['menu580'][] = array('580400', 'FAQ관리',G5_ADMIN_URL.'/faqmasterlist.php', 'scf_item_qna');

$menu['menu580'][] = array('580410', '후기관리', G5_ADMIN_URL.'/shop_admin/itemuselist.php', 'scf_ps');
//$menu['menu580'][] = array('580430', '1:1문의사항', ''.G5_ADMIN_URL.'/qa_config.php', 'qa');

//if ($_extMenu) {

    //$menu['menu580'][] = array('580210', '메인팝업', G5_ADMIN_URL.'/newwinlist.php', 'main_popup', 1);

    //$menu['menu580'][] = array('580300', '앱푸시', G5_ADMIN_URL.'/shop_admin/itemstocksms.php', 'sst_stock_sms', 1);
    //$menu['menu580'][] = array('900000', '문자발송관리', G5_SMS5_ADMIN_URL.'/config.php', 'sms5');
    //$menu['menu580'][] = array('580440', '공지사항', G5_ADMIN_URL.'/shop_admin/content_list_notice.php', 'sst_compare', 1);
    //$menu['menu580'][] = array('580900', '채팅', G5_ADMIN_URL.'/chatting.php', 'sst_chatting', 1);
    
//}