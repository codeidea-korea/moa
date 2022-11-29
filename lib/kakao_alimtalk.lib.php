<?

// NORMAL - 즉시발송 / ONETIME - 1회예약 / WEEKLY - 매주정기예약 / MONTHLY - 매월정기예약
function sendBfAlimTalk($templetNo, $replaceText, $reserve_type = 'NORMAL', $receiver, $start_reserve_time){

    if(empty($start_reserve_time)) {
        $start_reserve_time = date('Y-m-d H:i:s');
    }
    
    $ch = curl_init();

    $username = "moafriends";                //필수입력
    $key = "UCL6eiAdjVQqDwY";         //필수입력
    $kakao_plus_id = "moafriends";            //필수입력
    $user_template_no = $templetNo;            //필수입력 (하단 259 라인 API 이용하여 확인)

    $receiver = '['.$receiver.']';

    // 대체문자 정보 추가
    $kakao_faild_type = "1";          // 1 : 대체문자(SMS) / 2 : 대체문자(LMS) / 3 : 대체문자(MMS) 대체문자 사용시 필수 입력
    $title = $replaceText;
    $message = '[$NAME]님 알림 문자 입니다. 전화번호 : [$MOBILE] 비고1 : [$NOTE1] 비고2 : [$NOTE2] 비고3 : [$NOTE3] 비고4 : [$NOTE4] 비고5 : [$NOTE5]';             //대체문자 사용시 필수입력
    $sender = "010-9570-8831";                    //대체문자 사용시 필수입력

    // 예약발송 정보 추가
    $end_reserve_time = $start_reserve_time;
    $remained_count = 1;

    $return_url_yn = TRUE;        //return_url 사용시 필수 입력
    $return_url = 0;

    /* 여기까지 수정해주시기 바랍니다. */

    $message = str_replace(' ', ' ', $message);  //유니코드 공백문자 치환, 대체문자 발송시 주석 해제

    // 첨부파일이 있을 시 아래 주석을 해제하고 첨부하실 파일의 URL을 입력하여 주시기 바랍니다.
    // jpg파일당 300kb 제한 3개까지 가능합니다.
    //$file[] = array('attc' => 'https://directsend.co.kr/jpgimg1.jpg');
    //$file[] = array('attc' => 'https://directsend.co.kr/jpgimg2.jpg');
    //$file[] = array('attc' => 'https://directsend.co.kr/jpgimg3.jpg');
    //$attaches = json_encode($file);

    $postvars = '"username":"'.$username.'"';
    $postvars = $postvars.', "key":"'.$key.'"';
    $postvars = $postvars.', "kakao_plus_id":"'.$kakao_plus_id.'"';
    $postvars = $postvars.', "user_template_no":"'.$user_template_no.'"';
    $postvars = $postvars.', "receiver":'.$receiver;
    //$postvars = $postvars.', "address_books":"'.$address_books.'"';       //주소록 사용할 경우 주석 해제 바랍니다.
    //$postvars = $postvars.', "duplicate_yn":"'.$duplicate_yn.'"';         //중복 발송을 허용할 경우 주석 해제 바랍니다.
    //$postvars = $postvars.', "kakao_faild_type":"'.$kakao_faild_type.'"'; //대체문자 사용시 주석해제 바랍니다.
    //$postvars = $postvars.', "title":"'.$title.'"';                       //대체문자 사용시 주석해제 바랍니다.
    //$postvars = $postvars.', "message":"'.$message.'"';                   //대체문자 사용시 주석해제 바랍니다
    //$postvars = $postvars.', "sender":"'.$sender.'"';                     //대체문자 사용시 주석해제 바랍니다.
    //$postvars = $postvars.', "reserve_type":"'.$reserve_type.'"';                // 예약 관련 정보 사용할 경우 주석 해제 바랍니다.
    //$postvars = $postvars.', "start_reserve_time":"'.$start_reserve_time.'"';    // 예약 관련 정보 사용할 경우 주석 해제 바랍니다.
    //$postvars = $postvars.', "end_reserve_time":"'.$end_reserve_time.'"';        // 예약 관련 정보 사용할 경우 주석 해제 바랍니다.
    //$postvars = $postvars.', "remained_count":"'.$remained_count.'"';            // 예약 관련 정보 사용할 경우 주석 해제 바랍니다.
    //$postvars = $postvars.', "return_url_yn":'.$return_url_yn;       // return_url이 있는 경우 주석해제 바랍니다.
    //$postvars = $postvars.', "return_url":"'.$return_url.'" ';       // return_url이 있는 경우 주석해제 바랍니다.
    //$postvars = $postvars.', "attaches":'.$attaches;   //첨부파일이 있는 경우 주석해제 바랍니다.
    $postvars = '{'.$postvars.'}';      //JSON 데이터

    $url = "https://directsend.co.kr/index.php/api_v2/kakao_notice";         //URL

    //헤더정보
    $headers = array("cache-control: no-cache","content-type: application/json; charset=utf-8");

    curl_setopt($ch,CURLOPT_URL, $url);
    curl_setopt($ch,CURLOPT_POST, true);
    curl_setopt($ch,CURLOPT_POSTFIELDS, $postvars);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch,CURLOPT_CONNECTTIMEOUT ,3);
    curl_setopt($ch,CURLOPT_TIMEOUT, 60);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    $response = curl_exec($ch);

    /* status code
        1   : 정상발송 (성공코드는 다이렉트센드 DB서버에 정상수신됨을 뜻하며 발송성공(실패)의 결과는 발송완료 이후 확인 가능합니다.)
        300 : POST validation 실패
        301 : receiver 유효한 번호가 아님
        302 : api key or user is invalid
        303 : 분당 300건 이상 API 호출을 할 수 없습니다.
        304 : 대체문자 message validation 실패
        305 : 발신 프로필키 유효한 키가 아님
        306 : 잔액부족
        307 : return_url이 없음
        308 : 대체문자 utf-8 인코딩 에러 발생
        309 : 대체문자 message length = 0
        310 : 대체문자 euckr 인코딩 에러 발생
        311 : 대체문자 sender 유효한 번호가 아님
        312 : 대체문자 title validation 실패
        313 : 카카오 내용 validation 실패
        314 : 이미지 갯수 초과
        315 : 이미지 확장자 오류
        316 : 이미지 업로드 실패
        317 : 이미지 용량 300kb 초과
        318 : 예약정보가 유효하지 않습니다.
        319 : 동일 예약시간으로는 200회 이상 API 호출을 할 수 없습니다.
        999 : Internal Error.
    */

    //curl 에러 확인
    if(curl_errno($ch)){
        echo 'Curl error: ' . curl_error($ch);
    }else{
        print_r($response);
    }

    curl_close ($ch);
}
?>