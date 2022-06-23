<?php

if ($_a != "y") {
}

else {
    $menu['menu300'] = array ();
    // array('300300', '인기검색어관리', ''.G5_ADMIN_URL.'/popular_list.php', 'bbs_poplist', 1),
    // array('300400', '인기검색어순위', ''.G5_ADMIN_URL.'/popular_rank.php', 'bbs_poprank', 1),
    if ($_extMenu) {
        $menu['menu300'][] = array('300000', '게시판설정', ''.G5_ADMIN_URL.'/common_code_list.php', 'scf_common_code');
        $menu['menu300'][] = array('300100', '게시판관리', ''.G5_ADMIN_URL.'/board_list.php', 'bbs_board');
        $menu['menu300'][] = array('300500', '1:1문의설정', ''.G5_ADMIN_URL.'/qa_config.php', 'qa');
        $menu['menu300'][] = array('300600', '내용관리', G5_ADMIN_URL.'/contentlist.php', 'scf_contents', 1);
        $menu['menu300'][] = array('300700', 'FAQ관리', G5_ADMIN_URL.'/faqmasterlist.php', 'scf_faq', 1);
        $menu['menu300'][] = array('300820', '글,댓글 현황', G5_ADMIN_URL.'/write_count.php', 'scf_write_count');
        $menu['menu300'][] = array('300110', '커뮤니티설정관리', G5_ADMIN_URL.'/board_list.php',   'bbs_board2');
        $menu['menu300'][] = array('300200', '그룹관리', G5_ADMIN_URL.'/boardgroup_list.php?_a=y', 'bbs_group');

    }
    
}