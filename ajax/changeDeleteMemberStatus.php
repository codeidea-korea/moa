<?php
include_once("./_common.php");
include_once("../shop/orderinquirysubcancel.php");

$mb_id = $_POST['mb_id'];
$status = $_POST['status'];
if(is_array($mb_id)) {
    $mb_id = implode("','", $mb_id);
}
if($mb_id) {
    $today = date("Ymd", time());

    $sql = "select * from g5_member where mb_id in ('{$mb_id}') and mb_apply_yn = 1";
    $result = sql_fetch($sql);

    $html = '<!doctype html>
    <html lang="ko">
    <head>
    <meta charset="utf-8">
    <title>회원 탈퇴</title>
    </head>

    <body>

    <div style="margin:30px auto;width:600px;">
        <div style="border:1px solid #ededed">
            <h1 style="padding:24px 30px 10px 30px;background:#fff;font-size:inherit;margin:0;border-bottom:1px solid #ccc;">
                <p style="font-size:24px;color:#111;margin-bottom: 8px;">회원 탈퇴되었습니다.</p>
            </h1>
            <span style="display:block;padding:25px 25px;background:#fff;text-align:center">
                <a style="padding: 8px 22px;background:#E3EF27;color:#4C4338;border-radius: 4px;" href="'.G5_URL.'" target="_blank">'.$config['cf_title'].'</a>
            </span>
        </div>
    </div>
    </body>
    </html>';

    $subject = '[MOA] 회원 탈퇴되었습니다.';
    $body = urlencode($html);

    while($row = sql_fetch_array($result)) {
        $receiver = '{"name":"'.$row['mb_nick'].'", "email":"'.$row['mb_email'].'", "mobile":"'.$row['mb_hp'].'", "note1":"", "note2":"", "note3":"", "note4":"", "note5":""}';
        $receiver = '['.$receiver.']';
        $bodytag = '0';
        $mail_type = 'NORMAL';

        $partner = sql_fetch("select * from {$g5['apms_partner']} where pt_id = '{$row['mb_id']}'");
        $host = $partner['pt_level'] > 1;

        // 호스트인 경우 : 남은 모임 환불 처리
        if($host){
            // step 1: 탈퇴할 계정의 모임 조회 (승인 상태)
            $qr = "select wr_id, wr_subject from g5_write_class where mb_id = '".$row['mb_id']."' and moa_status = 1";
            $moimResult = sql_fetch($sql);
            $moims = array();
            $moim_ids = '';
            while($moim = sql_fetch_array($moimResult)) {
                array_push($moims, $moim);
                $moim_ids = $moim['wr_id'];
            }
            // step 2: 조회된 모임내 승인된 참여자 조회
            // step 3: 승인된 참여자 주문번호 조회
            if(is_array($moims)) {
                $moim_ids = implode(",", $moims['wr_id']);
            }
            $qr = "select cart.od_id, cart.mb_id  
                    from g5_shop_cart cart, 
                        (select mb_id, it_id, wr_id from deb_class_aplyer where wr_id in (".$moim_ids.") and status = '예약확정') deb
                    where cart.mb_id = deb.mb_id and cart.it_id = deb.it_id and (cart.ct_status = '입금' or cart.ct_status='완료')";
            $orderResult = sql_fetch($sql);

            // step 4: 참여자 주문번호별 환불 진행
            // step 5: 조회된 모임내 승인된 참여자 취소 처리
            while($order = sql_fetch_array($orderResult)) {
                get_member_level_select($order['mb_id'], $type='host', $ment='부분 환불', $order['od_id']);
            }
            // step 6: 탈퇴할 계정의 모임 폐강 처리
            $sql = "update g5_write_class set moa_status = 5 where wr_id in (".$moim_ids.")";
            sql_fetch($sql);
        } else {
            // 일반 회원인 경우, 내가 주문한 모든 주문의 환불 처리
            // step 1: 예약확정된 내가 예약한 모든 환불가능한 주문 조회
            $qr = "select cart.od_id, cart.mb_id  
                    from g5_shop_cart cart, 
                        (select mb_id, it_id, wr_id from deb_class_aplyer where mb_id = '".$row['mb_id']."' and status = '예약확정') deb
                    where cart.mb_id = deb.mb_id and cart.it_id = deb.it_id and (cart.ct_status = '입금' or cart.ct_status='완료')";
            $orderResult = sql_fetch($sql);

            // step 4: 주문번호별 환불 진행
            // step 5: 조회된 모임내 승인된 참여자 취소 처리
            while($order = sql_fetch_array($orderResult)) {
                get_member_level_select($order['mb_id'], $type='host', $ment='부분 환불', $order['od_id']);
            }
        }

        // step 7: 탈퇴 처리
        $sql = "update g5_member set mb_leave_date = '{$today}' where mb_id = '".$row['mb_id']."'";
        sql_query($sql);

        sendDirectMail($subject, $body, $config['cf_admin_email'], $config['cf_admin_email_name'], $receiver, $bodytag, $mail_type);
        sendBfAlimTalk(3, '[모아]에서 탈퇴되었습니다. 등록하셨던 모임, 참여한 모임에서 모두 해지 되었습니다. 카드사 환불기간후 약관에 따라 환불됩니다.', 'NORMAL', $receiver);
    }

    echo json_encode($result);
}