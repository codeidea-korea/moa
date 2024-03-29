<?php
include_once('./_common.php');
include_once(G5_LIB_PATH.'/naver_syndi.lib.php');
include_once(G5_CAPTCHA_PATH.'/captcha.lib.php');

// 토큰체크
check_write_token($bo_table);

$g5['title'] = '리뷰 저장';

$msg = array();

$it_id = $_POST['it_id'];
$is_score = $_POST['is_score'];
$is_ip = $_SERVER["REMOTE_ADDR"];

$is_subject = '';
if (isset($_POST['is_subject'])) {
    $is_subject = substr(trim($_POST['is_subject']),0,255);
    $is_subject = preg_replace("#[\\\]+$#", "", $is_subject);
}
if ($is_subject == '') {
    $msg[] = '<strong>제목</strong>을 입력하세요.';
}

$is_content = '';
if (isset($_POST['is_content'])) {
    $is_content = substr(trim($_POST['is_content']),0,65536);
    $is_content = preg_replace("#[\\\]+$#", "", $is_content);
}
if ($is_content == '') {
    $msg[] = '<strong>내용</strong>을 입력하세요.';
}

// 090710
if (substr_count($is_content, '&#') > 50) {
    alert('내용에 올바르지 않은 코드가 다수 포함되어 있습니다.');
    exit;
}

// 외부에서 글을 등록할 수 있는 버그가 존재하므로 비밀글은 사용일 경우에만 가능해야 함
if (!$is_admin && !$board['bo_use_secret'] && (stripos($_POST['html'], 'secret') !== false || stripos($_POST['secret'], 'secret') !== false || stripos($_POST['mail'], 'secret') !== false)) {
    alert('비밀글 미사용 게시판 이므로 비밀글로 등록할 수 없습니다.');
}

$secret = '';
if (isset($_POST['secret']) && $_POST['secret']) {
    if(preg_match('#secret#', strtolower($_POST['secret']), $matches))
        $secret = $matches[0];
}

// 외부에서 글을 등록할 수 있는 버그가 존재하므로 비밀글 무조건 사용일때는 관리자를 제외(공지)하고 무조건 비밀글로 등록
if (!$is_admin && $board['bo_use_secret'] == 2) {
    $secret = 'secret';
}

$as_update = '';
if ($w == 'u' && isset($_POST['as_update']) && $_POST['as_update']) {
    $as_update = G5_TIME_YMDHIS;
}

@include_once($board_skin_path.'/write_update.head.skin.php');

if ($w == '' || $w == 'u') {

    // 외부에서 글을 등록할 수 있는 버그가 존재하므로 공지는 관리자만 등록이 가능해야 함
    if (!$is_admin && $notice) {
        alert('관리자만 공지할 수 있습니다.');
    }

    //회원 자신이 쓴글을 수정할 경우 공지가 풀리는 경우가 있음
    if($w == 'u' && !$is_admin && $board['bo_notice'] && in_array($wr['wr_id'], $notice_array)){
        $notice = 1;
    }

    // 김선용 1.00 : 글쓰기 권한과 수정은 별도로 처리되어야 함
    if($w =='u' && $member['mb_id'] && $wr['mb_id'] === $member['mb_id']) {
        ;
    } else if ($member['mb_level'] < $board['bo_write_level']) {
        alert('글을 쓸 권한이 없습니다.');
    }

} else {
    alert('w 값이 제대로 넘어오지 않았습니다.');
}


if (!isset($_POST['is_subject']) || !trim($_POST['is_subject']))
    alert('제목을 입력하여 주십시오.');

if ($w == '' || $w == 'r') {

    if ($member['mb_id']) {
        $mb_id = $member['mb_id'];
        $wr_name = addslashes(clean_xss_tags($board['bo_use_name'] ? $member['mb_name'] : $member['mb_nick']));
        $wr_password = $member['mb_password'];
        if($member['mb_open']) {
            $wr_email = addslashes($member['mb_email']);
            $wr_homepage = addslashes(clean_xss_tags($member['mb_homepage']));
        } else {
            $wr_email = '';
            $wr_homepage = '';
        }
        $as_level = (int)$member['as_level'];
    } else {
        $mb_id = '';
        // 비회원의 경우 이름이 누락되는 경우가 있음
        $wr_name = clean_xss_tags(trim($_POST['wr_name']));
        if (!$wr_name)
            alert('이름은 필히 입력하셔야 합니다.');
        $wr_password = get_encrypt_string($wr_password);
        $wr_email = get_email_address(trim($_POST['wr_email']));
        $wr_homepage = clean_xss_tags($wr_homepage);
        $as_level = 1;
    }

    if ($w == 'r') {
        // 답변의 원글이 비밀글이라면 비밀번호는 원글과 동일하게 넣는다.
        if ($secret)
            $wr_password = $wr['wr_password'];

        $wr_id = $wr_id . $reply;
        $wr_num = $write['wr_num'];
        $wr_reply = $reply;
        $as_re_name = $wr['wr_name'];
        $as_re_mb = $wr['mb_id'];
    } else {
        $wr_num = get_next_num($write_table);
        $wr_reply = '';
        if($w == '' && $as_re_mb) {
            $as_re_name = $wr_name;
        }
    }

    // 외부 이미지 저장
    if($board['as_save']) {
        $wr_content = apms_content_image($wr_content);
    }

    $sql = " insert into g5_shop_item_use
                set it_id = '$it_id',
                     mb_id = '{$member['mb_id']}',
                     is_name = '{$mbmer['mb_nick']}',
                     is_password = '$is_password',
                     is_score = '$is_score',
                     is_subject = '$is_subject',
                     is_content = '$is_content',
                     is_time = '" . date('Y-m-d H:i:s') . "',
                     is_ip = $is_ip,
                     is_confirm = 0 ";
    sql_query($sql);

    $wr_id = sql_insert_id();

    // 쓰기 포인트 부여
    if ($w == '') {

        insert_point($member['mb_id'], '1000', "리뷰 {$it_id} 글쓰기", 'g5_shop_item_use', $it_id, '쓰기');

    }

}

// 사용자 코드 실행
@include_once($board_skin_path.'/write_update.skin.php');
@include_once($board_skin_path.'/write_update.tail.skin.php');

delete_cache_latest($bo_table);

alert('리뷰가 등록되었습니다.', '/shop/item.php?it_id=' . $it_id);
?>
