<?php

    $menu['menu490'] = array (
        array('490000', '커뮤니티관리', ''.G5_ADMIN_URL.'/bbs/board.php?bo_table=community', 'board_community'),
        
    );
    $menu['menu490'][] = array('490100', '커뮤니티 게시판 관리', ''.G5_ADMIN_URL.'/bbs/board.php?bo_table=community', 'bbs_board_commnunity');
    $menu['menu490'][] = array('490200', '공지사항 게시판 관리', ''.G5_ADMIN_URL.'/bbs/board.php?bo_table=notice', 'bbs_board_notice');
    $menu['menu490'][] = array('490300', 'Q&A 게시판 관리', ''.G5_ADMIN_URL.'/bbs/board.php?bo_table=qa', 'bbs_board_qna');

    if ($_a == "y" && $_extMenu) {
        $menu['menu490'][] = array('490900', '게시판 설정관리', ''.G5_ADMIN_URL.'/board_list.php', 'bbs_board_list');
    }