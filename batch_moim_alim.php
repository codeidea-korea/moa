<?php
include_once('./_common.php');
include_once(G5_LIB_PATH.'/kakao_alimtalk.lib.php');

// 익일 00:00 ~ 00:00 까지의 모든 모임중
// - 모임내 확정된 인원중 취소되지 않은 인원에게 카톡 알림 전달

$tags = array();

// 폐강 되지 않았고, 정산이 끝나지 않은 모임정보와 사용자 정보를 가져온다.
$sql = " select distinct player.idx, class.wr_id, class.wr_subject, class.moa_addr1, player.mb_id, memb.mb_name, memb.mb_email, memb.mb_hp 
        from g5_shop_cart cart 
            join g5_shop_order ord on cart.od_id = ord.od_id 
            join g5_shop_item item on cart.it_id = item.it_id 
            join g5_write_class class on item.it_2 = class.wr_id 
            join deb_class_aplyer player on player.mb_id = cart.mb_id and player.wr_id = class.wr_id and player.it_id = item.it_id and ord.mb_id = player.mb_id 
            left join g5_member memb on ord.mb_id = memb.mb_id 
        where 1=1 
        and ord.od_status in ('입금', '완료') 
        and player.status = '예약확정' 
        and class.moa_status != '폐강' and class.moa_status != '5'
        and class.moa_status != '정산' and class.moa_status != '6' ";
$result = sql_query($sql);

while($row = sql_fetch_array($result)) {
    array_push($tags, $row);
}

$startDay = date('Y-m-d', time());
$endDay = date('Y-m-d', strtotime('+2 day'));

for($inx = 0; $inx < count($tags); $inx++){

    $sql = " select count(deitem.wr_id) cnt 
            from deb_class_item deitem 
                join g5_write_class class on deitem.wr_id = class.wr_id 
            where 1=1 
            and deitem.wr_id = ".$tags['wr_id']." 
            and deitem.day > '".$startDay."'
            and deitem.day < '".$endDay."' ";
    $result = sql_query($sql);
    $row = sql_fetch_array($result);

    if($row['cnt'] < 1) {
        // 익일에는 모임이 없는 경우
        continue;
    }

    $sql = " select deitem.* 
            from deb_class_item deitem 
                join g5_write_class class on deitem.wr_id = class.wr_id 
            where 1=1 
            and deitem.wr_id = ".$tags['wr_id']." 
            and deitem.day > '".$startDay."'
            and deitem.day < '".$endDay."' ";
    $result = sql_query($sql);
    $row = sql_fetch_array($result);

    // kakao send
    include_once(G5_LIB_PATH."/kakao_alimtalk.lib.php");
    {
        $replaceText = '드디어 D-1! 🥳
        내일은 모임이 진행되는 날입니다!
        
        모임명: '.$tags['wr_subject'].'
        일시: '.$row['day'] . ' ' . $row['time'] .':' . $row['minute'].'
        장소: '.$tags['moa_addr1'].'
        
        모임 진행 전,
        모임 일정 및 유의사항을 다시 한 번 확인해 주세요!';
        $reserve_type = 'NORMAL';
        $start_reserve_time = date('Y-m-d H:i:s');
        $reciver = '{"name":"'.$tags["mb_name"].'","mobile":"'.$tags["mb_hp"].'","note1":"'.$tags['wr_subject'].'"}
        ,"note2":"'.$row['day'] . ' ' . $row['time'] .':' . $row['minute'].'"},"note3":"'.$tags['moa_addr1'].'"}';
        sendBfAlimTalk(87, $replaceText, $reserve_type, $reciver, $start_reserve_time);
    }
}

?>

