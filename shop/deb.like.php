<?php
include_once('./_common.php');

// 자바스크립트 사용가능할 때
if($_POST['js'] == "on") {
    $error = $success = $count = "";

    function print_result($error, $success, $count) {
		echo '{ "error": "' . $error . '", "success": "' . $success . '", "count": "' . $count . '" }';
        exit;
    }

    if (!$is_member) {
        $error = '회원만 가능합니다.';
        print_result($error, $success, $count);
    }

    if (!$it_id) {
        $error = '값이 제대로 넘어오지 않았습니다.';
        print_result($error, $success, $count);
    }

    // $ss_name = 'ss_item_'.$it_id;
    // if (!get_session($ss_name)) {
    //     $error = '해당 모임에서만 좋아요 또는 싫어요 하실 수 있습니다.';
    //     print_result($error, $success, $count);
    // }

    if (!$default['pt_good_use']) {
        $error = '좋아요 기능을 사용하지 않습니다.';
        print_result($error, $success, $count);
    }

	// 상품정보
	$it = apms_it($it_id);

	if (!$it['it_id']) {
        $error = '모임이 존재하지 않습니다.';
        print_result($error, $success, $count);
    }

	// 구매여부
	if(!$is_admin && $default['pt_good_use'] == "2" && $it['pt_id'] != $member['mb_id']) {
		if(!apms_it_payment($it_id)) {
			$error = '신청이 완료된 회원만 가능합니다.';
	        print_result($error, $success, $count);
		}
	}

    if ($good == 'good' || $good == 'nogood') {
        if($it['pt_id'] == $member['mb_id']) {
            // kij 수정 20221223
			//$error = '자신의 모임에는 좋아요 또는 싫어요 하실 수 없습니다.';
			$error = '자신의 모임에는 찜하기 하실 수 없습니다.';
	        print_result($error, $success, $count);
        }

        $sql = " select pg_flag from {$g5['apms_good']} where it_id = '{$it_id}' and mb_id = '{$member['mb_id']}' and pg_flag in ('good', 'nogood') ";
        $row = sql_fetch($sql);
        if ($row['pg_flag']) {
            $status = ($good == 'good') ? '좋아요' : '싫어요';
            //            $error = "이미 $status 하셨습니다.";

            // 2022.12.20. 토글 효과로 변경
            $notGood = $good == 'good' ? 'nogood' : 'good';
            
            sql_query(" update {$g5['g5_shop_item_table']} set pt_{$good} = pt_{$good} + 1 where it_id = '{$it_id}' ");
            sql_query(" update {$g5['g5_shop_item_table']} set pt_{$notGood} = pt_{$notGood} - 1 where it_id = '{$it_id}' ");

			// 내역 생성
            sql_query(" delete from {$g5['apms_good']} where it_id = '{$it_id}' and mb_id = '{$member['mb_id']}' and pg_flag = '{$row['pg_flag']}' ");
            sql_query(" insert {$g5['apms_good']} set it_id = '{$it_id}', mb_id = '{$member['mb_id']}', pg_flag = '{$good}', pg_datetime = '".G5_TIME_YMDHIS."' ");

            if ($good == "good"){
                $success = $status.' 하셨습니다.';
            }else{
                $success = "찜한 모임에서 해제되었습니다.";
            }
            
	        print_result($error, $success, $count);
        } else {
            // 좋아요(찬성), 싫어요(반대) 카운트 증가
            sql_query(" update {$g5['g5_shop_item_table']} set pt_{$good} = pt_{$good} + 1 where it_id = '{$it_id}' ");

			// 내역 생성
            sql_query(" insert {$g5['apms_good']} set it_id = '{$it_id}', mb_id = '{$member['mb_id']}', pg_flag = '{$good}', pg_datetime = '".G5_TIME_YMDHIS."' ");

			// 내글반응
			apms_response('it', $good, $it['it_id'], '', '', $it['it_name'], $it['pt_id'], $member['mb_id'], $member['mb_nick']);

            $status = ($good == 'good') ? '좋아요' : '싫어요';
			$good_point = (int)$default['pt_good_point'];
			$good_msg = $it['it_id'].' 모임를 '.$status.' 했습니다.';
			if($good_point) {
				insert_point($member['mb_id'], $good_point, $good_msg, $it['it_id'], $it['pt_id'], '@'.$good);
			}

            $sql = " select pt_{$good} as count from {$g5['g5_shop_item_table']} where it_id = '$it_id' ";
            $row = sql_fetch($sql);

            $count = $row['count'];

			$success = $status.' 하셨습니다.';
	        print_result($error, $success, $count);
        }
    }
} else {

    if (!$is_member) {
        alert('회원만 가능합니다.');
    }

    if (!$it_id) {
        alert('값이 제대로 넘어오지 않았습니다.');
	}

    // $ss_name = 'ss_item_'.$it_id;
    // if (!get_session($ss_name)) {
    //     alert('해당 모임에서만 좋아요 또는 싫어요 하실 수 있습니다.');
    // }

    if (!$default['pt_good_use']) {
        alert('좋아요 기능을 사용하지 않습니다.');
    }

	// 상품정보
	$it = apms_it($it_id);

	if (!$it['it_id']) {
        alert('모임이 존재하지 않습니다.');
    }

	// 구매여부
	if(!$is_admin && $default['pt_good_use'] == "2" && $it['pt_id'] != $member['mb_id']) {
		if(!apms_it_payment($it_id)) {
			alert('신청이 완료된 회원만 가능합니다.');
		}
	}

    if ($good == 'good' || $good == 'nogood') {
        if($it['pt_id'] == $member['mb_id']) {
            alert('자신의 모임에는 좋아요 또는 싫어요 하실 수 없습니다.');
		}

        $sql = " select pg_flag from {$g5['apms_good']} where it_id = '{$it_id}' and mb_id = '{$member['mb_id']}' and pg_flag in ('good', 'nogood') ";
        $row = sql_fetch($sql);
		if ($row['pg_flag']) {
            $status = ($row['pg_flag'] == 'good') ? '좋아요' : '싫어요';
            alert("이미 $status 하셨습니다.");
        } else {
            // 좋아요(찬성), 싫어요(반대) 카운트 증가
            sql_query(" update {$g5['g5_shop_item_table']} set pt_{$good} = pt_{$good} + 1 where it_id = '{$it_id}' ");

			// 내역 생성
            sql_query(" insert {$g5['apms_good']} set it_id = '{$it_id}', mb_id = '{$member['mb_id']}', pg_flag = '{$good}', pg_datetime = '".G5_TIME_YMDHIS."' ");

			// 내글반응
			apms_response('it', $good, $it['it_id'], '', '', $it['it_name'], $it['pt_id'], $member['mb_id'], $member['mb_nick']);

            $status = ($good == 'good') ? '좋아요' : '싫어요';
			$good_point = (int)$default['pt_good_point'];
			$good_msg = $it['it_id'].' 모임를 '.$status.' 했습니다.';
			if($good_point) {
				insert_point($member['mb_id'], $good_point, $good_msg, $it['it_id'], $it['pt_id'], '@'.$good);
			}

			$href = './item.php?it_id='.$it_id;

			alert("$status 하셨습니다.", '', false);
        }
    }
}

?>