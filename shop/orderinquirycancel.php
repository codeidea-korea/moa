<?php
include_once('./_common.php');

$mb_id = $member['mb_id'];
$type = $_POST['stype'];
$ment = '주문자 본인 취소';
if($type == 'host') {
    // 호스트가 취소처리를 할 경우
    $mb_id = $_POST['uid'];
    $od_id = $_POST['odid'];
    $ment = '호스트의 예약 취소';
} else {
    // 세션에 저장된 토큰과 폼으로 넘어온 토큰을 비교하여 틀리면 에러
    if ($token && get_session("ss_token") == $token) {
        // 맞으면 세션을 지워 다시 입력폼을 통해서 들어오도록 한다.
        set_session("ss_token", "");
    } else {
        set_session("ss_token", "");
        alert("토큰 에러", G5_SHOP_URL);
    }
}

$od = sql_fetch(" select * from {$g5['g5_shop_order_table']} where od_id = '$od_id' and mb_id = '{$mb_id}' ");

if (!$od['od_id']) {
    alert("존재하는 주문이 아닙니다.");
}

// 주문상품의 상태가 주문인지 체크
$sql = " select SUM(IF((ct_status = '입금' || ct_status='완료'), 1, 0)) as od_count2,
                COUNT(*) as od_count1
            from {$g5['g5_shop_cart_table']}
            where od_id = '$od_id' ";
			//echo $od['od_cancel_price'] . "/" . $sql; exit;
$ct = sql_fetch($sql);

$uid = md5($od['od_id'].$od['od_time'].$od['od_ip']);
$sendUrl = G5_SHOP_URL."/orderinquiryview.php?od_id=$od_id&amp;uid=$uid&amp;p=history";

if($type == 'host') {
    $sendUrl = G5_SHOP_URL."/partner/?ap=moim_membership";
}

if($od['od_cancel_price'] > 0 || $ct['od_count1'] != $ct['od_count2']) {
    alert("취소할 수 있는 주문이 아닙니다.", G5_SHOP_URL."/orderinquiryview.php?od_id=$od_id&amp;uid=$uid&amp;p=history");
}

$cancel_price = $od['od_cart_price'];
// 첫 모임 남은 날짜 기준 환불 수수료 처리 
$sql ="select player.idx, player.status, cart.od_id, player.aplydate   
    from deb_class_aplyer player 
        join g5_shop_item item on player.wr_id = item.it_2 
        join g5_shop_cart cart on item.it_id = cart.it_id and cart.od_id = '{$od_id}' 
    where player.mb_id = '{$mb_id}'";
$player = sql_fetch($sql);

if($player['status'] == '예약확정') {
    // 부분 취소 체크
    /*
    $sql = "select cart.od_id, deb.day 
        from deb_class_item deb 
            join g5_shop_item si on si.it_id = deb.it_id 
            join g5_write_class wc on wc.wr_id = si.it_2 
            join g5_shop_cart cart on si.it_id = cart.it_id 
        where cart.od_id = '{$od_id}' and wc.moa_form = '고정형' 
        order by deb.day asc 
        limit 1 ";
    $classItems = sql_fetch($sql);
    */

    $today = date("Y-m-d");
    if(empty($player['aplydate']) || $player['aplydate'] == ''){
        // 자율형이던가, 날짜 미기입 과거건 등 시스템 이슈는 환불처리
    } else {
        $targetTime = strtotime($player['aplydate']);
        if($targetTime < strtotime('-6 days')) {
            $remain_price = 0;
        } else if($targetTime > strtotime('-1 days')) {
            $remain_price = 70 * ((int)$cancel_price) / 100;
            $cancel_price = ((int)$cancel_price) - ((int) $remain_price);
        } else {
            alert("취소할 수 있는 주문이 아닙니다. (모임 전일부터 취소/환불이 불가능합니다.) ", $sendUrl);
        }
    }
} else {
    // 전체 취소
    $remain_price = 0;
}

$isAllCancel = $cancel_price == $remain_price ? 1 : 0;

// PG 결제 취소
if($od['od_tno']) {
    switch($od['od_pg']) {
        case 'lg':
            require_once('./settle_lg.inc.php');
            $LGD_TID    = $od['od_tno'];        //LG유플러스으로 부터 내려받은 거래번호(LGD_TID)

            $xpay = new XPay($configPath, $CST_PLATFORM);

            // Mert Key 설정
            $xpay->set_config_value('t'.$LGD_MID, $config['cf_lg_mert_key']);
            $xpay->set_config_value($LGD_MID, $config['cf_lg_mert_key']);
            $xpay->Init_TX($LGD_MID);

            $xpay->Set("LGD_TXNAME", "Cancel");
            $xpay->Set("LGD_TID", $LGD_TID);

            if ($xpay->TX()) {
                //1)결제취소결과 화면처리(성공,실패 결과 처리를 하시기 바랍니다.)
                /*
                echo "결제 취소요청이 완료되었습니다.  <br>";
                echo "TX Response_code = " . $xpay->Response_Code() . "<br>";
                echo "TX Response_msg = " . $xpay->Response_Msg() . "<p>";
                */
            } else {
                //2)API 요청 실패 화면처리
                $msg = "결제 취소요청이 실패하였습니다.\\n";
                $msg .= "TX Response_code = " . $xpay->Response_Code() . "\\n";
                $msg .= "TX Response_msg = " . $xpay->Response_Msg();

                alert($msg);
            }
            break;
        case 'inicis':
            include_once(G5_SHOP_PATH.'/settle_inicis.inc.php');
            $cancel_msg = iconv_euckr($ment . '-'.$cancel_memo);

            if($isAllCancel == 1) {
                /*********************
                 * 3. 취소 정보 설정 *
                 *********************/
                $inipay->SetField("type",      "Refund");                        // 고정 (절대 수정 불가)
                $inipay->SetField("mid",       $default['de_inicis_mid']);       // 상점아이디
                /**************************************************************************************************
                 * admin 은 키패스워드 변수명입니다. 수정하시면 안됩니다. 1111의 부분만 수정해서 사용하시기 바랍니다.
                 * 키패스워드는 상점관리자 페이지(https://iniweb.inicis.com)의 비밀번호가 아닙니다. 주의해 주시기 바랍니다.
                 * 키패스워드는 숫자 4자리로만 구성됩니다. 이 값은 키파일 발급시 결정됩니다.
                 * 키패스워드 값을 확인하시려면 상점측에 발급된 키파일 안의 readme.txt 파일을 참조해 주십시오.
                 **************************************************************************************************/
                $inipay->SetField("admin",     $default['de_inicis_admin_key']); //비대칭 사용키 키패스워드
                $inipay->SetField("tid",       $od['od_tno']);                   // 취소할 거래의 거래아이디
                $inipay->SetField("cancelmsg", $cancel_msg);                     // 취소사유
            } else {
                $vat_mny       = round((int)$tax_mny / 1.1);
                
                $currency      = 'WON';
                $oldtid        = $od['od_tno'];
                $buyeremail    = $od['od_email'];
                
                /***********************
                 * 3. 재승인 정보 설정 *
                 ***********************/
                $inipay->SetField("type",          "repay");                         // 고정 (절대 수정 불가)
                $inipay->SetField("pgid",          "INIphpRPAY");                    // 고정 (절대 수정 불가)
                $inipay->SetField("subpgip",       "203.238.3.10");                  // 고정
                $inipay->SetField("mid",           $default['de_inicis_mid']);       // 상점아이디
                $inipay->SetField("admin",         $default['de_inicis_admin_key']); //비대칭 사용키 키패스워드
                $inipay->SetField("oldtid",        $oldtid);                         // 취소할 거래의 거래아이디
                $inipay->SetField("currency",      $currency);                       // 화폐단위
                $inipay->SetField("price",         $cancel_price);                   // 취소금액
                $inipay->SetField("confirm_price", $remain_price);                   // 승인요청금액
                $inipay->SetField("buyeremail",    $buyeremail);                     // 구매자 이메일 주소
                $inipay->SetField("tax",           0);                            // 부가세금액
                $inipay->SetField("taxfree",       0);                        // 비과세금액
            }   

            /****************
             * 4. 취소 요청 *
             ****************/
            $inipay->startAction();

            /****************************************************************
             * 5. 취소 결과                                           	*
             *                                                        	*
             * 결과코드 : $inipay->getResult('ResultCode') ("00"이면 취소 성공)  	*
             * 결과내용 : $inipay->getResult('ResultMsg') (취소결과에 대한 설명) 	*
             * 취소날짜 : $inipay->getResult('CancelDate') (YYYYMMDD)          	*
             * 취소시각 : $inipay->getResult('CancelTime') (HHMMSS)            	*
             * 현금영수증 취소 승인번호 : $inipay->getResult('CSHR_CancelNum')    *
             * (현금영수증 발급 취소시에만 리턴됨)                          *
             ****************************************************************/

            if($isAllCancel == 1){
                $res_cd  = $inipay->getResult('ResultCode');
                $res_msg = $inipay->getResult('ResultMsg');
    
                if($res_cd != '00') {
                    if($res_cd == '01') {
                        alert('이미 취소된 거래입니다.' . iconv_utf8($res_msg));
                    }
                    alert(iconv_utf8($res_msg).' 코드 : '.$res_cd);
                }
            } else {
                if($inipay->getResult('ResultCode') == '00') {
                    // 환불금액기록
                   $tno      = $inipay->getResult('PRTC_TID');
                   $re_price = $inipay->getResult('PRTC_Price');
               
                   $sql = " update {$g5['g5_shop_order_table']}
                               set od_refund_price = od_refund_price + '$re_price',
                                   od_shop_memo = concat(od_shop_memo, \"$mod_memo\")
                               where od_id = '{$od['od_id']}'
                                 and od_tno = '$tno' ";
                   sql_query($sql);
               
                   // 미수금 등의 정보 업데이트
                   $info = get_order_info($od_id);
               
                   $sql = " update {$g5['g5_shop_order_table']}
                               set od_misu     = '{$info['od_misu']}',
                                   od_tax_mny  = '{$info['od_tax_mny']}',
                                   od_vat_mny  = '{$info['od_vat_mny']}',
                                   od_free_mny = '{$info['od_free_mny']}'
                               where od_id = '$od_id' ";
                   sql_query($sql);
                } else {
                    alert(iconv_utf8($inipay->GetResult("ResultMsg")).' 코드 : '.$inipay->GetResult("ResultCode"));
                }
            }
            break;
        default:
            require_once('./settle_kcp.inc.php');

            $_POST['tno'] = $od['od_tno'];
            $_POST['req_tx'] = 'mod';
            if($isAllCancel != 1) {
                $_POST['mod_type'] = 'STSC';
            } else {
                $_POST['mod_type'] = 'STPC';
            }
            if($od['od_escrow']) {
                $_POST['req_tx'] = 'mod_escrow';
                $_POST['mod_type'] = 'STE2';
                if($od['od_settle_case'] == '가상계좌')
                    $_POST['mod_type'] = 'STE5';
            }
            if($isAllCancel != 1) {
                $_POST['mod_mny'] = $cancel_price;
                $_POST['rem_mny'] = $remain_price;
            }
            $_POST['mod_desc'] = iconv("utf-8", "euc-kr", $ment . '-'.$cancel_memo);
            $_POST['site_cd'] = $default['de_kcp_mid'];

            // 취소내역 한글깨짐방지
            setlocale(LC_CTYPE, 'ko_KR.euc-kr');

            include G5_SHOP_PATH.'/kcp/pp_ax_hub.php';

            // locale 설정 초기화
            setlocale(LC_CTYPE, '');
    }
}

// 장바구니 자료 취소
sql_query(" update {$g5['g5_shop_cart_table']} set ct_status = '취소' where od_id = '$od_id' ");

// 주문 취소
$cancel_memo = addslashes(strip_tags($cancel_memo));
// $cancel_price = $od['od_cart_price'];

$sql = " update {$g5['g5_shop_order_table']}
            set od_send_cost = '$remain_price',
                od_send_cost2 = '0',
                od_receipt_price = '0',
                od_receipt_point = '0',
                od_misu = '0',
                od_cancel_price = '$cancel_price',
                od_cart_coupon = '0',
                od_coupon = '0',
                od_send_coupon = '0',
                od_status = '취소',
                od_shop_memo = concat(od_shop_memo,\"\\n{$ment} - ".G5_TIME_YMDHIS." (취소이유 : {$cancel_memo})\")
            where od_id = '$od_id' ";
sql_query($sql);

// 주문취소 회원의 포인트를 되돌려 줌
if ($od['od_receipt_point'] > 0)
    insert_point($mb_id, $od['od_receipt_point'], "주문번호 $od_id " . $ment);

if($type == 'host') {
    include_once(G5_LIB_PATH."/kakao_alimtalk.lib.php");
    $sql = "select cart.od_id, wc.wr_subject, mem.mb_name, mem.mb_hp  
    from g5_write_class wc  
        join g5_shop_item si on wc.wr_id = si.it_2 
        join g5_shop_cart cart on si.it_id = cart.it_id
        join g5_member mem on wc.mb_id = mem.mb_id
        where cart.od_id = '{$od_id}' ";
    $classItems = sql_fetch($sql);

    {
        $sql = "select mem.*   
        from g5_shop_cart cart 
            join g5_member mem on cart.mb_id = mem.mb_id
            where cart.od_id = '{$od_id}' ";
        $mem = sql_fetch($sql);

        $replaceText = ' [모임 신청 취소 안내]
 
        #{이름} 사원 님께서 신청해 주신 #{비고1} 모임이 
        #{비고2}의 사유로 아쉽게도 신청 취소되었습니다 :(
        
        모시지 못하게 되어 대단히 안타깝습니다.
        다음에 더 즐거운 모임에서 꼭 뵐 수 있길 바랍니다.
        
        감사합니다!';
        $reserve_type = 'NORMAL';
        $start_reserve_time = date('Y-m-d H:i:s');
        $reciver = '{"name":"'.$mem['mb_name'].'","mobile":"'.$mem['mb_hp'].'",
            "note1":"'.$classItems['wr_subject'].'",
            "note2":"'.$cancel_memo.'"}';
        sendBfAlimTalk(42, $replaceText, $reserve_type, $reciver, $start_reserve_time);
    }
} else {
    $sql = "select cart.od_id, wc.wr_subject, mem.mb_name, mem.mb_hp  
    from g5_write_class wc  
        join g5_shop_item si on wc.wr_id = si.it_2 
        join g5_shop_cart cart on si.it_id = cart.it_id
        join g5_member mem on wc.mb_id = mem.mb_id
        where cart.od_id = '{$od_id}' ";
    $classItems = sql_fetch($sql);

    include_once(G5_LIB_PATH."/kakao_alimtalk.lib.php");
    {
        $sql = "select mem.*   
        from g5_shop_cart cart 
            join g5_member mem on cart.mb_id = mem.mb_id
            where cart.od_id = '{$od_id}' ";
        $mem = sql_fetch($sql);

        $replaceText = ' [모아프렌즈] [결제 취소 안내]

        #{이름} 사원 님께서 신청해 주신 #{비고1} 모임의 결제가
        정상적으로 취소되었습니다.
        
        결제 금액은 환불정책에 따라 환불되며, 영업일 기준 3~7일이 소요될 수 있습니다.
        
        감사합니다.';
        $start_reserve_time = date('Y-m-d H:i:s');
        $reciver = '{"name":"'.$mem['mb_name'].'","mobile":"'.$mem['mb_hp'].'","note1":"'.$classItems['wr_subject'].'"}';
        sendBfAlimTalk(45, $replaceText, $reserve_type, $reciver, $start_reserve_time);
    }
    {
        $replaceText = ' [모아프렌즈] [게스트 신청 취소]

        #{비고1} 모임 게스트가 신청을 취소했습니다 ㅠ.ㅠ
        
        [마이페이지] - [호스트관리모드] - [모임 관리] - [모임 신청자관리]에서
        참석 인원을 다시 한 번 확인해 주세요!';
        $reserve_type = 'NORMAL';
        $start_reserve_time = date('Y-m-d H:i:s');
        $reciver = '{"name":"'.$classItems['mb_name'].'","mobile":"'.$classItems['mb_hp'].'","note1":"'.$classItems['wr_subject'].'"}';
        sendBfAlimTalk(78, $replaceText, $reserve_type, $reciver, $start_reserve_time);
    }
}
goto_url($sendUrl);
?>