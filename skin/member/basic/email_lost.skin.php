<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$skin_url.'/style.css" media="screen">', 0);

?>

<!-- 이메일 찾기 -->
<form class="form-horizontal" role="form" name="fpasswordlost" action="<?php echo $action_url ?>" onsubmit="return fpasswordlost_submit(this);" method="post" autocomplete="off">

    <div class="panel panel-default common_input">
        <div class="panel-heading"><strong>이메일 찾기</strong></div>
        <div class="panel-body">
            <p class="help-block">
                회원가입 시 등록하신 핸드폰 번호를 입력해 주세요. 해당 이메일로 정보를 보내드립니다.
            </p>
            <div class="mt20 mb20">
                <p class="m_title">휴대폰 번호 입력</p>
                <div class="input_flex">
                    <input type="number" pattern="\d*" name="pt_hp" id="pt_hp" placeholder="휴대폰 번호 (-없이 입력)">
                    <div class="cominput_btn02">
                        <button class="on">전송</button>
                    </div>
                </div>
                <div class="input_flex mt10" style="">
                    <input type="number" placeholder="인증번호 입력">
                    <div class="cominput_btn02">
                        <button class="on">인증하기</button>
                    </div>
                </div>
            </div>

            <div class="two_btn mt40">
                <button class="inactive on" type="button" onclick="window.close();">닫기</button>
                <button class="inactive on" type="submit">확인</button>
            </div>
        </div>

    </div>
</form>