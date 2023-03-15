<?php
include_once('./_common.php');
include_once(G5_LIB_PATH.'/kakao_alimtalk.lib.php');

// 익일 00:00 ~ 00:00 까지의 모든 모임중
// - 모임내 확정된 인원중 취소되지 않은 인원에게 카톡 알림 전달

$tags = array();

$today = date('Y-m-d', time());

// 폐강 되지 않았고, 정산이 끝나지 않은 모임정보와 호스트 정보를 가져온다.
$sql = " select item.*, class.wr_id, class.wr_subject, class.moa_addr1, memb.mb_name, memb.mb_email, memb.mb_hp
        from deb_class_item item
            left join g5_write_class class on item.wr_id = class.wr_id 
            left join g5_member memb on item.mb_id = memb.mb_id 
        where 1=1 
        and class.moa_status != '폐강' and class.moa_status != '5'
        and class.moa_status != '정산' and class.moa_status != '6'
        and DATE_ADD(item.day, INTERVAL 1 DAY) = '".$today."'";
$result = sql_query($sql);
//and ord.od_status in ('입금', '완료') 
while($row = sql_fetch_array($result)) {
    array_push($tags, $row);
}

for($inx = 0; $inx < count($tags); $inx++){
        
    // kakao send
    include_once(G5_LIB_PATH."/kakao_alimtalk.lib.php");
    {
        $replaceText = '호스트 후기 알림';
        $reserve_type = 'NORMAL';
        $start_reserve_time = date('Y-m-d H:i:s');
        $reciver = '{"name":"'.$tags[$inx]["mb_name"].'","mobile":"'.$tags[$inx]["mb_hp"].'"}';
        sendBfAlimTalk(156, $replaceText, $reserve_type, $reciver, $start_reserve_time);
    }

    $sql = " select plyer.*, memb.mb_name, memb.mb_email, memb.mb_hp
            from deb_class_aplyer plyer
                left join g5_member memb on plyer.mb_id = memb.mb_id 
            where 1=1 
            and plyer.wr_id = '".$tags[$inx]["wr_id"]."'
            and plyer.status = '예약확정'";
    $result = sql_query($sql);
    //and ord.od_status in ('입금', '완료') 
    while($row = sql_fetch_array($result)) {
        // kakao send
        include_once(G5_LIB_PATH."/kakao_alimtalk.lib.php");
        {
            $replaceText = '게스트 후기 알림';
            $reserve_type = 'NORMAL';
            $start_reserve_time = date('Y-m-d H:i:s');
            $reciver = '{"name":"'.$row["mb_name"].'","mobile":"'.$row["mb_hp"].'"}';
            sendBfAlimTalk(123, $replaceText, $reserve_type, $reciver, $start_reserve_time);
        }
    }
}
?>

