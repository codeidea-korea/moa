<?php

//if ($_a != "y") {
    $menu['menu300'] = array (
        array('300000', '커뮤니티관리', ''.G5_ADMIN_URL.'/board_list.php', 'board'),
        array('300100', '커뮤니티관리', ''.G5_ADMIN_URL.'/board_list.php', 'bbs_board'),
        array('300500', '1:1문의설정', ''.G5_ADMIN_URL.'/qa_config.php', 'qa'),
        array('300600', '내용관리', G5_ADMIN_URL.'/contentlist.php', 'scf_contents', 1),
        array('300700', 'FAQ관리', G5_ADMIN_URL.'/faqmasterlist.php', 'scf_faq', 1),
        array('300820', '글,댓글 현황', G5_ADMIN_URL.'/write_count.php', 'scf_write_count'),
    );
    // array('300300', '인기검색어관리', ''.G5_ADMIN_URL.'/popular_list.php', 'bbs_poplist', 1),
    // array('300400', '인기검색어순위', ''.G5_ADMIN_URL.'/popular_rank.php', 'bbs_poprank', 1),
    // }
    $menu['menu300'][] = array('300950', '『 지역코드 』', G5_ADMIN_URL.'/common_code_list.php', 'scf_common_code', 1);
    // else {
        if ($_extMenu) {
        $menu['menu300'][] = array('300900', '『 공통코드유형 』', G5_ADMIN_URL.'/common_type_list.php', 'scf_common_type', 1);
        $menu['menu300'][] = array('300110', '커뮤니티설정관리', G5_ADMIN_URL.'/board_list.php',   'bbs_board2');
        $menu['menu300'][] = array('300200', '그룹관리', G5_ADMIN_URL.'/boardgroup_list?_a=y', 'bbs_group');

    }
    
// }