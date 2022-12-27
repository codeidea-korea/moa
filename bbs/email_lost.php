<?php
include_once('./_common.php');
include_once(G5_LIB_PATH.'/icode.sms.lib.php'); 
if($is_lost_sub) {
    include_once(G5_PATH.'/head.sub.php');
    if(!USE_G5_THEME) @include_once(THEMA_PATH.'/head.sub.php');
} else {
    include_once('./_head.php');
} ?>

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
                    <!-- <form name="frmHpSeek" id="frmHpSeek" method="post" action="" > -->
                    <input type="number" pattern="\d*" name="hp_no" id="hp_no" placeholder="휴대폰 번호 (-없이 입력)">
                    <div class="cominput_btn02">
                        <button type="button" class="sendhp on">전송</button>
                    </div>
                    <!-- </form> -->
                </div>
                <div class="input_flex mt10" style="">
                    <!-- <form name="frmHpCerti" id="frmHpCerti" method="post" action="" > -->
                    <input type="number" name="certino" id="certino" placeholder="인증번호 입력">
                    <div class="cominput_btn02">
                        <button type="button" class="certion on">인증하기</button>
                    </div>
                    <!-- </form> -->
                </div>
            </div>

            <div class="two_btn mt40">
                <button class="inactive on" type="button" onclick="window.close();">닫기</button>
                <!-- <button class="inactive on" type="button">확인</button> -->
            </div>
        </div>

    </div>
</form>
<script>
	$(function() {
		$(".sendhp").click(function() {
			var hp_no = $("#hp_no").val();
			if (hp_no) {
				$.ajax({
					url: "/ajax/sendSMSofFindEmail.php",
					type: "POST",
					data: {
						"hp_no": hp_no
					},
					dataType: "text",
					async: false,
					cache: false,
					success: function(data) {
							console.log(data);
                        if (data) {
                            alert(data);
                        }
					}
				});
			}
		});
        $(".certion").click(function() {
			var hp_no = $("#hp_no").val();
			var certino = $("#certino").val();
			if (hp_no) {
				$.ajax({
					url: "/ajax/certiSMSofFindEmail.php",
					type: "POST",
					data: {
						"hp_no": hp_no,
                        "certino":certino
					},
					dataType: "json",
					async: false,
					cache: false,
					success: function(data) {
                        if (data.code=="1") {
                            alert(data.msg);
                            window.close();
                        }
                        else {
                            alert(data.msg);
                        }
					}
				});
			}
		});
	});
	</script>