<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가


/******************************************************************************************
***  본 파일은  플래토의  저작물입니다.                                                  ***
***  본 파일의 내용을 허가업이 도용 / 사용할경우 저작권법에 위배됩니다.                     ***
***  허가한 사용자/업체만 사용가능하고, 다른용도로 사용/배포는 불가합니다.                  ***
***  본내용을 다른 용도를 원하실경우 저작자인 플래토 에게 구입하여 사용하시기 바랍니다.      ***
***                                                                                    ***
***                                                                                    ***
***  연락처 => 이메일 :   pletho@gmail.com   , 텔레그램 : @pletho , 카카오톡 : @pletho    ***
******************************************************************************************/
define('CLASS_PATH', G5_PATH.'/class');
define('CLASS_SKIN_PATH', G5_SKIN_PATH.'/class');


define('MOA_PATH', G5_PATH.'/moa_mobile');
define('MOA_URL', G5_URL.'/moa_mobile');

/*<?php echo C_MAIN_PATH;?>/main.php 예시*/
/*onclick="location.href='<?php echo C_LOGIN_PATH;?>/sign_up.php'" 예시*/
define('C_LOGIN_PATH', G5_PATH.'/c_login');
define('C_MAIN_PATH', G5_PATH.'/c_main');
define('C_DETAIL_PATH', G5_PATH.'/c_detail');
define('C_HOSTJ_PATH', G5_PATH.'/c_hostJ');
define('C_CHAT_PATH', G5_PATH.'/c_chat');
define('C_CATEGORY_PATH', G5_PATH.'/c_category');
define('C_COMMUNITY_PATH', G5_PATH.'/c_community');
define('C_MY_PATH', G5_PATH.'/c_my');
define('C_MAP_PATH', G5_PATH.'/c_map');


//define('MOA_LOGIN_PATH', CLASS_PATH.'/login');
define('MOA_LOGIN_SKIN', CLASS_SKIN_PATH.'/c_login');
define('MOA_LOGIN_URL', G5_URL.'/c_login');

define('MOA_MAIN_SKIN', CLASS_SKIN_PATH.'/c_main');
define('MOA_MAIN_URL', G5_URL.'/c_main');

define('MOA_DETAIL_SKIN', CLASS_SKIN_PATH.'/c_detail');
define('MOA_DETAIL_URL', G5_URL.'/c_detail');

define('MOA_HOSTJ_SKIN', CLASS_SKIN_PATH.'/c_hostJ');
define('MOA_HOSTJ_URL', G5_URL.'/c_hostJ');

define('MOA_CHAT_SKIN', CLASS_SKIN_PATH.'/c_chat');
define('MOA_CHAT_URL', G5_URL.'/c_chat');

define('MOA_CATEGORY_SKIN', CLASS_SKIN_PATH.'/c_category');
define('MOA_CATEGORY_URL', G5_URL.'/c_category');

define('MOA_COMMUNITY_SKIN', CLASS_SKIN_PATH.'/c_community');
define('MOA_COMMUNITY_URL', G5_URL.'/c_community');

define('MOA_MY_SKIN', CLASS_SKIN_PATH.'/c_my');
define('MOA_MY_URL', G5_URL.'/c_my');

define('MOA_MAP_SKIN', CLASS_SKIN_PATH.'/c_map');
define('MOA_MAP_URL', G5_URL.'/c_map');

define('CLASS_SKIN_URL', G5_SKIN_URL.'/class');
define('CLASS_URL', G5_URL.'/class');






$is_cert = ($member['mb_id'])?$member['com_cert_yn']:0;