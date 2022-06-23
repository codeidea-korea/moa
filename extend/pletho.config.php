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
define('DEB_TABLE_PREFIX', 'deb_');
define('DEB_SHOP_TABLE_PREFIX', 'deb_shop_');
$g5['mainbanner_table'] = DEB_TABLE_PREFIX.'mainbanner';
$g5['mainfooter_table'] = DEB_TABLE_PREFIX.'mainfooter';
$g5['maintestdate_table'] = DEB_TABLE_PREFIX.'maintestdate';
$g5['mainvod_table'] = DEB_TABLE_PREFIX.'mainvod';

$g5['item_curriculum_table'] = DEB_TABLE_PREFIX.'item_curriculum';
$g5['item_lec_table'] = DEB_TABLE_PREFIX.'item_lec';
$g5['item_book_table'] = DEB_TABLE_PREFIX.'item_book';

$g5['lec_curriculum_table'] = DEB_SHOP_TABLE_PREFIX.'curriculum'; 
$g5['lec_curriculum_vod_table'] = DEB_SHOP_TABLE_PREFIX.'curriculum_vod'; 

$g5['album_table'] = DEB_TABLE_PREFIX."album";
$g5['album_song_table'] = DEB_TABLE_PREFIX."album_song";
$g5['adju_album_table'] = DEB_TABLE_PREFIX."adju_album";
$g5['adju_basic_table'] = DEB_TABLE_PREFIX."adju_basic";
$g5['adju_data_table'] = DEB_TABLE_PREFIX."adju_data";
$g5['adju_album_singer_table'] = DEB_TABLE_PREFIX."adju_album_singer";

$g5['teacher_profile_table'] = DEB_TABLE_PREFIX."teacher_profile";
$g5['teacher_history_table'] = DEB_TABLE_PREFIX."teacher_history";
$g5['class_item_table'] = DEB_TABLE_PREFIX."class_item";
$g5['class_aplyer_table'] = DEB_TABLE_PREFIX."class_aplyer";
$g5['certi_mail'] = DEB_TABLE_PREFIX."certi_mail";
$g5['certi_image'] = DEB_TABLE_PREFIX."certi_image";


$g5['common_type_table'] =  DEB_TABLE_PREFIX . "common_type";
$g5['common_code_table'] =  DEB_TABLE_PREFIX . "common_code";



$thisaddr = $_SERVER['REMOTE_ADDR'];

if (!isset($includers)) {

    $thruaddr = "118.37.1.242";
    $thruaddr2 = "1.229.10.200"; //영준집
    $thruaddr3 = "118.37.1.242";  // 수빈집
    $thruaddr4 = "221.158.106.18";  // 수빈집
    $thruaddr5 = "116.41.82.205";  // 윤진아
    $includers = false;
    if ((strrpos($member['mb_id'],'pletho')!==false )
        || $thruaddr == $thisaddr
        || $thruaddr2 == $thisaddr
        || $thruaddr3 == $thisaddr
        || $thruaddr4 == $thisaddr
        || $thruaddr5 == $thisaddr
        )  {
            $includers = true;
    }
}


$sql = "select * from g5_apms";
$apms = sql_fetch($sql);

$banklist = array (
    "NH농협",
    "카카오뱅크",
    "하나은행",
    "국민은행",
    "신한은행",
    "우리은행",
    "대구은행",
    "부산은행",
    "신협은행",
    "케이뱅크",
    "우체국은행",
    "새마을은행",
    "IBK기업은행",
    "한국씨티은행",
);

$jobgroup = array(
    "경영/사무",
    "마케팅/광고/홍보",
    "IT/인터넷",
    "디자인",
    "무역/유통",
    "영업/고객상담/서비스",
    "연구개발/설계",
    "생산/제조",
    "세무/회계",
    "생산/건설/노무",
    "교육/강사",
    "의료/제약",
    "금융/은행",
    "기타업"
);