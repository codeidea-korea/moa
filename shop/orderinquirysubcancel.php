<?php
include_once('./_common.php');

function get_member_refund_order($mb_id, $type='host', $ment='부분 환불', $od_id, $isAllCancel = false)
{
    global $g5, $is_admin;

    $res = array();
    
    $od = sql_fetch(" select * from {$g5['g5_shop_order_table']} where od_id = '$od_id' and mb_id = '{$mb_id}' ");

    if (!$od['od_id']) {
        return;
    }

    // 주문상품의 상태가 주문인지 체크
    $sql = " select SUM(IF((ct_status = '입금' || ct_status='완료'), 1, 0)) as od_count2,
                    COUNT(*) as od_count1
                from {$g5['g5_shop_cart_table']}
                where od_id = '$od_id' ";
                //echo $od['od_cancel_price'] . "/" . $sql; exit;
    $ct = sql_fetch($sql);

    $uid = md5($od['od_id'].$od['od_time'].$od['od_ip']);

    if($od['od_cancel_price'] > 0 || $ct['od_count1'] != $ct['od_count2']) {
        $res['error'] = true;
        $res['msg'] = "취소할 수 있는 주문이 아닙니다.";
        return $res;
    }

    $cancel_price = $od['od_cart_price'];
    $remain_price = 0;

    if($isAllCancel == true){
        // 첫 모임 남은 날짜 기준 환불 수수료 처리 
        $sql ="select player.idx, player.status, cart.od_id  
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
                    $res['error'] = true;
                    $res['msg'] = "취소할 수 있는 주문이 아닙니다. (모임 전일부터 취소/환불이 불가능합니다.)";
                    return $res;
                }
            }
        } else {
            // 전체 취소
            $remain_price = 0;
        }
    }

    $isAllCancel = $remain_price == 0 ? 1 : 0;

    // PG 결제 취소
    if($od['od_tno']) {
        switch($od['od_pg']) {
            case 'lg':
                /*
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
                    /*
                } else {
                    //2)API 요청 실패 화면처리
                    $msg = "결제 취소요청이 실패하였습니다.\\n";
                    $msg .= "TX Response_code = " . $xpay->Response_Code() . "\\n";
                    $msg .= "TX Response_msg = " . $xpay->Response_Msg();

                    alert($msg);
                }
                */
                $msg = "결제 취소요청이 실패하였습니다.\\n";
                $res['error'] = true;
                $res['msg'] = $msg;
                return $res;
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
                            $res['error'] = true;
                            $res['msg'] = '이미 취소된 거래입니다.' . iconv_utf8($res_msg);
                            return $res;
                        }
                        $res['error'] = true;
                        $res['msg'] = iconv_utf8($res_msg).' 코드 : '.$res_cd;
                        return $res;
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
                        $res['error'] = true;
                        $res['msg'] = iconv_utf8($inipay->GetResult("ResultMsg")).' 코드 : '.$inipay->GetResult("ResultCode");
                        return $res;
                    }
                }
                break;
            default:
                require_once('./settle_kcp.inc.php');

                $_POST['tno'] = $od['od_tno'];
                $_POST['req_tx'] = 'mod';
                if($isAllCancel == 1) {
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

    $sql = " update deb_class_aplyer 
                set status = '취소' 
                where od_id = '{$od_id}' ";
    sql_query($sql);


    // 쿠폰 사용 이력 취소 (삭제)
    $sql = " delete from {$g5['g5_shop_coupon_log_table']} where mb_id = '{$mb_id}' and od_id = '$od_id' ";
    sql_query($sql);

    // 장바구니 자료 취소
    sql_query(" update {$g5['g5_shop_cart_table']} set ct_status = '취소' where od_id = '$od_id' ");

    // 주문 취소
    $cancel_memo = addslashes(strip_tags($cancel_memo));

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
                    od_shop_memo = concat(od_shop_memo,\"\\n{$ment} - ".G5_TIME_YMDHIS." (환불 이유 : {$cancel_memo})\")
                where od_id = '$od_id' ";
    sql_query($sql);

    // 주문취소 회원의 포인트를 되돌려 줌
    if ($od['od_receipt_point'] > 0)
        insert_point($mb_id, $od['od_receipt_point'], "주문번호 $od_id " . $ment);

    $res['error'] = false;
    $res['msg'] = "성공";
    return $res;
}

?>