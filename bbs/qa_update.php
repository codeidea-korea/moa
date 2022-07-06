<?php
include_once('./_common.php');

/*==========================
$w == a : 답변
$w == r : 추가질문
$w == u : 수정
==========================*/

if($is_guest)
    alert('회원이시라면 로그인 후 이용해 보십시오.', './login.php?url='.urlencode(G5_URL.'/shop/item.php?it_id=' . $_POST['it_id']));

$msg = array();

// 1:1문의 설정값
$qaconfig = get_qa_config();

// 관리자 체크
if (chk_multiple_admin($member['mb_id'], $qaconfig['as_admin'])) {
    $is_admin = 'super';
}

//if(trim($qaconfig['qa_category'])) {
//    if($w != 'a') {
//        $category = explode('|', $qaconfig['qa_category']);
//        if(!in_array($qa_category, $category))
//            alert('분류를 올바르게 지정해 주십시오.');
//    }
//} else {
//    alert('1:1문의 설정에서 분류를 설정해 주십시오');
//}

$iq_subject = '';
if (isset($_POST['iq_subject'])) {
    $iq_subject = substr(trim($_POST['iq_subject']),0,255);
    $iq_subject = preg_replace("#[\\\]+$#", "", $iq_subject);
}
if ($qa_subject == '') {
    $msg[] = '<strong>제목</strong>을 입력하세요.';
}

$iq_question = '';
if (isset($_POST['iq_question'])) {
    $iq_question = substr(trim($_POST['iq_question']),0,65536);
    $iq_question = preg_replace("#[\\\]+$#", "", $iq_question);
}
if ($iq_content == '') {
    $msg[] = '<strong>내용</strong>을 입력하세요.';
}

// 090710
if (substr_count($iq_content, '&#') > 50) {
    alert('내용에 올바르지 않은 코드가 다수 포함되어 있습니다.');
    exit;
}

if (empty($_POST)) {
    alert("파일 또는 글내용의 크기가 서버에서 설정한 값을 넘어 오류가 발생하였습니다.\\npost_max_size=".ini_get('post_max_size')." , upload_max_filesize=".$upload_max_filesize."\\n게시판관리자 또는 서버관리자에게 문의 바랍니다.");
}

if($w == 'u' || $w == 'a' || $w == 'r') {
    if($w == 'a' && !$is_admin)
        alert('답변은 관리자만 등록할 수 있습니다.');

    $sql = " select * from g5_shop_item_qa where iq_id = '$iq_id' ";
    if(!$is_admin) {
        $sql .= " and mb_id = '{$member['mb_id']}' ";
    }

    $write = sql_fetch($sql);

    if($w == 'u') {
        if(!$write['iq_id'])
            alert('게시글이 존재하지 않습니다.\\n삭제되었거나 자신의 글이 아닌 경우입니다.');

        if(!$is_admin) {
            if($write['iq_answer'] != '')
                alert('답변이 등록된 문의글은 수정할 수 없습니다.');

            if($write['mb_id'] != $member['mb_id'])
                alert('게시글을 수정할 권한이 없습니다.\\n\\n올바른 방법으로 이용해 주십시오.', G5_URL);
        }
    }

    if($w == 'a') {
        if(!$write['iq_id'])
            alert('문의글이 존재하지 않아 답변글을 등록할 수 없습니다.');

        if($write['iq_answer'] != '')
            alert('답변이 등록된 문의글은 수정할 수 없습니다.');
    }
}

if($w == '' || $w == 'a' || $w == 'r') {
    if($w == '' || $w == 'r') {
        $row = sql_fetch(" select MIN(qa_num) as min_qa_num from g5_shop_item_qa ");
        $qa_num = $row['min_qa_num'] - 1;
    }

    if($w == 'a') {
        $qa_num = $write['qa_num'];
        $qa_parent = $write['iq_id'];
    }

    $sql = " insert into g5_shop_item_qa
                set it_id          = '$it_id',
                    mb_id           = '{$member['mb_id']}',
                    iq_secret        = '0',
                    iq_name        = '{$member['mb_nick']}',
                    iq_email        = '{$member['mb_email']}',
                    iq_hp      = '{$member['mb_hp']}',
                    iq_subject   = '$iq_subject',
                    iq_question     = '$iq_question',
                    iq_time         = '".date('Y-m-d H:i:s')."',
                    iq_ip      = '{$_SERVER['REMOTE_ADDR']}'
                    ";
    sql_query($sql);

    if($w == '' || $w == 'r') {
        $qa_id = sql_insert_id();

        if($w == 'r' && $write['qa_related']) {
            $qa_related = $write['qa_related'];
        } else {
            $qa_related = $qa_id;
        }

        $sql = " update g5_shop_item_qa
                    set iq_answer   = '$iq_answer',
                        pt_it  = '{$member['mb_no']}'
                        pt_id  = '{$member['mb_id']}'
                    where qa_id = '$qa_id' ";
        sql_query($sql);

        //알림
        $qa_admin_list = ($qaconfig['as_admin']) ? $config['cf_admin'].','.$qaconfig['as_admin'] : $config['cf_admin'];
        $qa_admin = explode(",", $qa_admin_list);
        $qa_admin = array_unique($qa_admin);

        for($i=0;$i < count($qa_admin);$i++) {

            $admin_id = trim($qa_admin[$i]);

            if(!$admin_id) continue;

            // APMS : 내글반응 등록
            apms_response('qa', 'qa', '', '', $qa_id, $qa_subject, $admin_id, $member['mb_id'], $member['mb_nick']);
        }
    }

    if($w == 'a') {
        $sql = " update {$g5['qa_content_table']}
                    set qa_status = '1'
                    where qa_id = '{$write['qa_parent']}' ";
        sql_query($sql);

        // APMS : 내글반응 등록
        apms_response('qa', 'qa', '', '', $write['qa_parent'], $write['qa_subject'], $write['mb_id'], '', '답변완료');
    }
} else if($w == 'u') {
    $sql = " update g5_shop_item_qa
                set it_id          = '$it_id',
                    mb_id           = '{$member['mb_id']}',
                    iq_secret        = '0',
                    iq_name        = '{$member['mb_nick']}',
                    iq_email        = '{$member['mb_email']}',
                    iq_hp      = '{$member['mb_hp']}',
                    iq_subject   = '$iq_subject',
                    iq_question     = '$iq_question',
                    iq_time         = '".date('Y-m-d H:i:s')."',
                    iq_ip      = '{$_SERVER['REMOTE_ADDR']}'";

    sql_query($sql);
}

// SMS 알림
if($config['cf_sms_use'] == 'icode' && $qaconfig['qa_use_sms']) {
    if($config['cf_sms_type'] == 'LMS') {
        include_once(G5_LIB_PATH.'/icode.lms.lib.php');

        $port_setting = get_icode_port_type($config['cf_icode_id'], $config['cf_icode_pw']);

        // SMS 모듈 클래스 생성
        if($port_setting !== false) {
            // 답변글은 질문 등록자에게 전송
            if($w == 'a' && $write['qa_sms_recv'] && trim($write['qa_hp'])) {
                $sms_content = $config['cf_title'].' '.$qaconfig['qa_title'].'에 답변이 등록되었습니다.';
                $send_number = preg_replace('/[^0-9]/', '', $qaconfig['qa_send_number']);
                $recv_number = preg_replace('/[^0-9]/', '', $write['qa_hp']);

                if($recv_number) {
                    $strDest     = array();
                    $strDest[]   = $recv_number;
                    $strCallBack = $send_number;
                    $strCaller   = iconv_euckr(trim($config['cf_title']));
                    $strSubject  = '';
                    $strURL      = '';
                    $strData     = iconv_euckr($sms_content);
                    $strDate     = '';
                    $nCount      = count($strDest);

                    $SMS = new LMS;
                    $SMS->SMS_con($config['cf_icode_server_ip'], $config['cf_icode_id'], $config['cf_icode_pw'], $port_setting);
                    $res = $SMS->Add($strDest, $strCallBack, $strCaller, $strSubject, $strURL, $strData, $strDate, $nCount);

                    if($res) {
                        $SMS->Send();
                    }

                    $SMS->Init(); // 보관하고 있던 결과값을 지웁니다.
                }
            }

            // 문의글 등록시 관리자에게 전송
            if(($w == '' || $w == 'r') && trim($qaconfig['qa_admin_hp'])) {
                $sms_content = $config['cf_title'].' '.$qaconfig['qa_title'].'에 문의글이 등록되었습니다.';
                $send_number = preg_replace('/[^0-9]/', '', $qaconfig['qa_send_number']);
                $recv_number = preg_replace('/[^0-9]/', '', $qaconfig['qa_admin_hp']);

                if($recv_number) {
                    $strDest     = array();
                    $strDest[]   = $recv_number;
                    $strCallBack = $send_number;
                    $strCaller   = iconv_euckr(trim($config['cf_title']));;
                    $strSubject  = '';
                    $strURL      = '';
                    $strData     = iconv_euckr($sms_content);
                    $strDate     = '';
                    $nCount      = count($strDest);

                    $SMS = new LMS;
                    $SMS->SMS_con($config['cf_icode_server_ip'], $config['cf_icode_id'], $config['cf_icode_pw'], $port_setting);
                    $res = $SMS->Add($strDest, $strCallBack, $strCaller, $strSubject, $strURL, $strData, $strDate, $nCount);

                    if($res) {
                        $SMS->Send();
                    }

                    $SMS->Init(); // 보관하고 있던 결과값을 지웁니다.
                }
            }
        }
    } else {
        include_once(G5_LIB_PATH.'/icode.sms.lib.php');

        // 답변글은 질문 등록자에게 전송
        if($w == 'a' && $write['qa_sms_recv'] && trim($write['qa_hp'])) {
            $sms_content = $config['cf_title'].' '.$qaconfig['qa_title'].'에 답변이 등록되었습니다.';
            $send_number = preg_replace('/[^0-9]/', '', $qaconfig['qa_send_number']);
            $recv_number = preg_replace('/[^0-9]/', '', $write['qa_hp']);

            if($recv_number) {
                $SMS = new SMS; // SMS 연결
                $SMS->SMS_con($config['cf_icode_server_ip'], $config['cf_icode_id'], $config['cf_icode_pw'], $config['cf_icode_server_port']);
                $SMS->Add($recv_number, $send_number, $config['cf_icode_id'], iconv("utf-8", "euc-kr", stripslashes($sms_content)), "");
                $SMS->Send();
            }
        }

        // 문의글 등록시 관리자에게 전송
        if(($w == '' || $w == 'r') && trim($qaconfig['qa_admin_hp'])) {
            $sms_content = $config['cf_title'].' '.$qaconfig['qa_title'].'에 문의글이 등록되었습니다.';
            $send_number = preg_replace('/[^0-9]/', '', $qaconfig['qa_send_number']);
            $recv_number = preg_replace('/[^0-9]/', '', $qaconfig['qa_admin_hp']);

            if($recv_number) {
                $SMS = new SMS; // SMS 연결
                $SMS->SMS_con($config['cf_icode_server_ip'], $config['cf_icode_id'], $config['cf_icode_pw'], $config['cf_icode_server_port']);
                $SMS->Add($recv_number, $send_number, $config['cf_icode_id'], iconv("utf-8", "euc-kr", stripslashes($sms_content)), "");
                $SMS->Send();
            }
        }
    }
}

// 답변 이메일전송
if($w == 'a' && $write['qa_email_recv'] && trim($write['qa_email'])) {
    include_once(G5_LIB_PATH.'/mailer.lib.php');

    $subject = $config['cf_title'].' '.$qaconfig['qa_title'].' 답변 알림 메일';
    $content = nl2br(conv_unescape_nl(stripslashes($qa_content)));

    mailer($config['cf_admin_email_name'], $config['cf_admin_email'], $write['qa_email'], $subject, $content, 1);
}

// 문의글등록 이메일전송
if(($w == '' || $w == 'r') && trim($qaconfig['qa_admin_email'])) {
    include_once(G5_LIB_PATH.'/mailer.lib.php');

    $subject = $config['cf_title'].' '.$qaconfig['qa_title'].' 질문 알림 메일';
    $content = nl2br(conv_unescape_nl(stripslashes($qa_content)));

    mailer($config['cf_admin_email_name'], $qa_email, $qaconfig['qa_admin_email'], $subject, $content, 1);
}

if ($file_upload_msg)
    alert($file_upload_msg, '/shop/item.php?it_id=' . $_POST['it_id']);
else
    goto_url('/shop/item.php?it_id=' . $_POST['it_id']);
?>