<?php
include_once("./_common.php");

function sendSMS($phoneNo, $wr_subject)
{
	return;
	
	$result = array();
	
	$sender = "01054405414";                    //필수입력

	/* 예약 API 사용시 여기서부터 삭제후 이용 하시기 바랍니다. */
	$ch = curl_init();
	/* 여기서부터 수정해주시기 바랍니다. */
	$title = "[MOA] 모임이 폐강 되었습니다.";
	$message = '안녕하세요. MOA 입니다. '.$wr_subject.'';             //필수입력
	$username = "codeidea";                //필수입력
	$key = "mUJrCPVuyMOq02W";           //필수입력
	
	// 이력 등록
	$sql = " insert into send_sms_history (sender_phone, receive_phone, title, message, created_at) 
			values ('{$sender}','{$phoneNo}','{$title}','{$message}',now()) ";
	$result = sql_query($sql);

	//수신자 정보 추가 - 필수 입력(주소록 미사용시), 치환문자 미사용시 치환문자 데이터를 입력하지 않고 사용할수 있습니다.
	//치환문자 미사용시 "{"mobile":"01000000001"} 번호만 입력 해주시기 바랍니다.
	$receiver = '{"mobile":"' .$phoneNo. '","note1":"","note2":"","note3":"","note4":"","note5":""}';
	$receiver = '['.$receiver.']';

	// 예약발송 정보 추가
	$sms_type = 'NORMAL'; // NORMAL - 즉시발송 / ONETIME - 1회예약 / WEEKLY - 매주정기예약 / MONTHLY - 매월정기예약
	$start_reserve_time = date('Y-m-d H:i:s'); //  발송하고자 하는 시간(시,분단위까지만 가능) (동일한 예약 시간으로는 200회 이상 API 호출을 할 수 없습니다.)
	$end_reserve_time = date('Y-m-d H:i:s'); //  발송이 끝나는 시간 1회 예약일 경우 $start_reserve_time = $end_reserve_time
	// WEEKLY | MONTHLY 일 경우에 시작 시간부터 끝나는 시간까지 발송되는 횟수 Ex) type = WEEKLY, start_reserve_time = '2017-05-17 13:00:00', end_reserve_time = '2017-05-24 13:00:00' 이면 remained_count = 2 로 되어야 합니다.
	$remained_count = 1;
	// 예약 수정/취소 API는 소스 하단을 참고 해주시기 바랍니다.

	// 실제 발송성공실패 여부를 받기 원하실 경우 아래 주석을 해제하신 후, 사이트에 등록한 URL 번호를 입력해 주시기 바랍니다.
	$return_url_yn = TRUE;        //return_url 사용시 필수 입력
	$return_url = 1;

	/* 여기까지 수정해주시기 바랍니다. */
	$message = str_replace(' ', ' ', $message);  //유니코드 공백문자 치환

	// 첨부파일이 있을 시 아래 주석을 해제하고 첨부하실 파일의 URL을 입력하여 주시기 바랍니다.
	// jpg파일당 300kb 제한 3개까지 가능합니다.
	//$file[] = array('attc' => 'https://directsend.co.kr/jpgimg1.jpg');
	//$file[] = array('attc' => 'https://directsend.co.kr/jpgimg2.jpg');
	//$file[] = array('attc' => 'https://directsend.co.kr/jpgimg3.jpg');
	//$attaches = json_encode($file);

	$postvars = '"title":"'.$title.'"';
	$postvars = $postvars.', "message":"'.$message.'"';
	$postvars = $postvars.', "sender":"'.$sender.'"';
	$postvars = $postvars.', "username":"'.$username.'"';
	$postvars = $postvars.', "receiver":'.$receiver.'';
	//$postvars = $postvars.', "address_books":"'.$address_books.'"';       //주소록 사용할 경우 주석 해제
	$postvars = $postvars.', "return_url_yn":'.$return_url_yn;       // return_url이 있는 경우 주석해제 바랍니다.
	$postvars = $postvars.', "return_url":'.$return_url;       // return_url이 있는 경우 주석해제 바랍니다.
	//$postvars = $postvars.', "attaches":'.$attaches;   //첨부파일이 있는 경우 주석해제 바랍니다.
	$postvars = $postvars.', "key":"'.$key.'"';
	$postvars = '{'.$postvars.'}';      //JSON 데이터

	$url = "https://directsend.co.kr/index.php/api_v2/sms_change_word";         //URL

	//헤더정보
	$headers = array("cache-control: no-cache","content-type: application/json; charset=utf-8");

	curl_setopt($ch,CURLOPT_URL, $url);
	curl_setopt($ch,CURLOPT_POST, true);
	curl_setopt($ch,CURLOPT_POSTFIELDS, $postvars);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch,CURLOPT_CONNECTTIMEOUT ,3);
	curl_setopt($ch,CURLOPT_TIMEOUT, 20);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	$response = curl_exec($ch);
	$response = json_decode($response);

	/*
		* response 성공
		* {"status":0}
		* 성공 코드번호 (성공코드는 다이렉트센드 DB서버에 정상수신됨을 뜻하며 발송성공(실패)의 결과는 발송완료 이후 확인 가능합니다.)
		*
		* 잘못된 번호가 포함된 경우
		* {"status":0, "msg":"유효하지 않는 번호를 제외하고 발송 완료 하였습니다.", "msg_detail":"error mobile : 01000000001aa, 010112"}
		* 성공 코드번호 (성공코드는 다이렉트센드 DB서버에 정상수신됨을 뜻하며 발송성공(실패)의 결과는 발송완료 이후 확인 가능합니다.), 내용, 잘못된 데이터
		*
	*/
	/*
		status code
		0   : 정상발송 (성공코드는 다이렉트센드 DB서버에 정상수신됨을 뜻하며 발송성공(실패)의 결과는 발송완료 이후 확인 가능합니다.)
		100 : POST validation 실패
		101 : sender 유효한 번호가 아님
		102 : receiver 유효한 번호가 아님
		103 : api key or user is invalid
		104 : recipient count = 0
		105 : message length = 0
		106 : message validation 실패
		107 : 이미지 업로드 실패
		108 : 이미지 갯수 초과
		109 : return_url이 없음
		110 : 이미지 용량 300kb 초과
		111 : 이미지 확장자 오류
		112 : euckr 인코딩 에러 발생
		113 : utf-8 인코딩 에러 발생
		114 : 예약정보가 유효하지 않습니다.
		200 : 동일 예약시간으로는 200회 이상 API 호출을 할 수 없습니다.
		201 : 분당 300회 이상 API 호출을 할 수 없습니다.
		205 : 잔액부족
		999 : Internal Error.
	*/

	//curl 에러 확인
	if(curl_errno($ch)){
		$result['ment'] = curl_error($ch);
		return $result;
	}else{
		if($response->status != '0')
		{
			$result['ment'] = $response->msg;
			return $result;
		}
		if(!empty($response->msg))
		{
			$result['ment'] = $response->msg;
			return $result;
		}
	}
	curl_close ($ch);
	return $result;
}
