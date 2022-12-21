<?php
// $menu['menu100'] = array (
//     array('100000', '환경설정', G5_ADMIN_URL.'/config_form.php',   'config'),
//     array('100100', '기본환경설정', G5_ADMIN_URL.'/config_form.php',   'cf_basic'),
//     array('100200', '관리권한설정', G5_ADMIN_URL.'/auth_list.php',     'cf_auth'),
//     array('100280', '테마설정', G5_ADMIN_URL.'/theme.php',     'cf_theme', 1),
//     array('100290', '메뉴설정', G5_ADMIN_URL.'/menu_list.php',     'cf_menu', 1),
//     array('100300', '메일 테스트', G5_ADMIN_URL.'/sendmail_test.php', 'cf_mailtest'),
//     array('100310', '팝업레이어관리', G5_ADMIN_URL.'/newwinlist.php', 'scf_poplayer'),
    
//     array('100800', '세션파일 일괄삭제',G5_ADMIN_URL.'/session_file_delete.php', 'cf_session', 1),
//     array('100900', '캐시파일 일괄삭제',G5_ADMIN_URL.'/cache_file_delete.php',   'cf_cache', 1),
//     array('100910', '캡챠파일 일괄삭제',G5_ADMIN_URL.'/captcha_file_delete.php',   'cf_captcha', 1),
//     array('100920', '썸네일파일 일괄삭제',G5_ADMIN_URL.'/thumbnail_file_delete.php',   'cf_thumbnail', 1),
//     array('100500', 'phpinfo()',        G5_ADMIN_URL.'/phpinfo.php',       'cf_phpinfo')
// );

// if(version_compare(phpversion(), '5.3.0', '>=') && defined('G5_BROWSCAP_USE') && G5_BROWSCAP_USE) {
//     $menu['menu100'][] = array('100510', 'Browscap 업데이트', G5_ADMIN_URL.'/browscap.php', 'cf_browscap');
//     $menu['menu100'][] = array('100520', '접속로그 변환', G5_ADMIN_URL.'/browscap_convert.php', 'cf_visit_cnvrt');
// }

// $menu['menu100'][] = array('100410', 'DB업그레이드', G5_ADMIN_URL.'/dbupgrade.php', 'db_upgrade');
// $menu['menu100'][] = array('100400', '부가서비스', G5_ADMIN_URL.'/service.php', 'cf_service');


//////////////////////////////////////


$_extMenu = false;
$mbid = $member['mb_id'];
$sudmin = 'pletho';
if (strrpos($mbid,$sudmin)!==false )
    $_extMenu = true;

if ($_a != "y") {
    $menu['menu100'] = array ();
        //    array('100100', '기본환경설정', G5_ADMIN_URL.'/config_form.php',   'cf_basic'),
        //array('100190', '기본약관설정', G5_ADMIN_URL.'/apms_admin/apms.admin.php?ap=npage',     'cf_page'),
        //array('100200', '관리권한설정', G5_ADMIN_URL.'/auth_list.php',     'cf_auth'),
        //array('100900', '캐시파일 일괄삭제',G5_ADMIN_URL.'/cache_file_delete.php',   'cf_cache', 1),
        //array('100910', '캡챠파일 일괄삭제',G5_ADMIN_URL.'/captcha_file_delete.php',   'cf_captcha', 1),
        //array('100920', '썸네일파일 일괄삭제',G5_ADMIN_URL.'/thumbnail_file_delete.php',   'cf_thumbnail', 1),
        //);
    if ($_extMenu) {
        $menu['menu100'][] =array('100000', '환경설정', G5_ADMIN_URL.'/config_form.php',   'config');
        $menu['menu100'][] =array('100100', '기본환경설정', G5_ADMIN_URL.'/config_form.php',   'config');
        
        $menu['menu100'][] = array('100999', '*관리모드', G5_ADMIN_URL.'/?_a=y', 'cf_a');
        $menu['menu100'][] = array('100900', '『 지역코드유형 』', G5_ADMIN_URL.'/common_type_list.php', 'scf_common_type', 1);
        $menu['menu100'][] = array('100950', '『 지역코드 』', G5_ADMIN_URL.'/common_code_list.php', 'scf_common_code', 1);
        $menu['menu100'][] = array('111100', '분류관리', G5_ADMIN_URL.'/shop_admin/categorylist.php', 'scf_cate');
        $menu['menu100'][] = array('100988', '결제기능설정', G5_ADMIN_URL.'/shop_admin/configform.php', 'scf_config');
    
    }

}
else {
    $menu['menu100'] = array (
        array('100000', '환경설정', G5_ADMIN_URL.'/config_form.php',   'config'),
        array('100100', '기본환경설정', G5_ADMIN_URL.'/config_form.php',   'cf_basic'),
        array('100200', '관리권한설정', G5_ADMIN_URL.'/auth_list.php',     'cf_auth'),
        array('100280', '테마설정', G5_ADMIN_URL.'/theme.php',     'cf_theme', 1),
        array('100290', '메뉴설정', G5_ADMIN_URL.'/menu_list.php',     'cf_menu', 1),
        array('100300', '메일 테스트', G5_ADMIN_URL.'/sendmail_test.php', 'cf_mailtest'),
        array('100310', '팝업레이어관리', G5_ADMIN_URL.'/newwinlist.php', 'scf_poplayer'),
        array('100800', '세션파일 일괄삭제',G5_ADMIN_URL.'/session_file_delete.php', 'cf_session', 1),
        array('100900', '캐시파일 일괄삭제',G5_ADMIN_URL.'/cache_file_delete.php',   'cf_cache', 1),
        array('100910', '캡챠파일 일괄삭제',G5_ADMIN_URL.'/captcha_file_delete.php',   'cf_captcha', 1),
        array('100920', '썸네일파일 일괄삭제',G5_ADMIN_URL.'/thumbnail_file_delete.php',   'cf_thumbnail', 1),
        array('100500', 'phpinfo()',        G5_ADMIN_URL.'/phpinfo.php',       'cf_phpinfo'),

    );
    if ($_extMenu)
        $menu['menu100'][] = array('100999', '*일반관리모드', G5_ADMIN_URL.'/?_a=n', 'cf_a');

    if(version_compare(phpversion(), '5.3.0', '>=') && defined('G5_BROWSCAP_USE') && G5_BROWSCAP_USE) {
        $menu['menu100'][] = array('100510', 'Browscap 업데이트', G5_ADMIN_URL.'/browscap.php', 'cf_browscap');
        $menu['menu100'][] = array('100520', '접속로그 변환', G5_ADMIN_URL.'/browscap_convert.php', 'cf_visit_cnvrt');
    }
    
    //$menu['menu100'][] = array('100410', 'DB업그레이드', G5_ADMIN_URL.'/dbupgrade.php', 'db_upgrade');
    //$menu['menu100'][] = array('100400', '부가서비스', G5_ADMIN_URL.'/service.php', 'cf_service');
}
