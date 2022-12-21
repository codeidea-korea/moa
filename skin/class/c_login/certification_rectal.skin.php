<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>

<section class="wrapper">
    <div class="content">
        <div class="con_area">
            <p class="rectal_t">인증 방식 
            <!-- 선택  (택1-필수) -->
            </p>
        </div>
        <div class="p19 certemail">
            <div class="lounchecL radio">
                
                <input type="radio" id="cert1" name="certi" value="1" class=" certi">
                <label for="cert1">
                &nbsp;회사 이메일로 인증하기 (링크 인증)
                </label>
            </div>
            <div class="common_input p15 " >
            <form method="post" enctype="multipart/form-data" action="/c_login/member_cert_mail_send.php" id="frmComEmail">
                <!-- 2022.09.05. 이메일 입력후 active 효과 스타일 적용 -->
                <!--
                <div class="input_flex">
                    <input type="text" placeholder="이메일을 입력하세요" name="com_email" id="com_email">
                    <div class="cominput_btn">
                        <button>전송</button>
                    </div>
                </div>
                -->
                <div class="input_flex">
                    <input type="text" placeholder="이메일을 입력하세요" name="com_email" id="com_email" onkeyup="checkEmail(this)">
                    <div class="cominput_btn">
                        <button>전송</button>
                    </div>
                </div>
                <style>
                    .cominput_btn button.on{
                        border:1px solid var(--main-color);
                        color:var(--main-color);
                        background:#fff;
                    }
                </style>
                <script>
                    function checkEmail(target){
                        var regex = /^[0-9a-zA-Z]([-_\.]?[0-9a-zA-Z])*@[0-9a-zA-Z]([-_\.]?[0-9a-zA-Z])*\.[a-zA-Z]{2,3}$/;
                        if(regex.test(target.value)) {
                            $('.cominput_btn > button').addClass('on');
                        } else {
                            $('.cominput_btn > button').removeClass('on');
                        }
                    }
                    $(document).ready(function(){
                        $('#frmComEmail')[0].onsubmit = function(){
                            if($('.cominput_btn > button').hasClass('on')) {
                                return wrestSubmit();
                            }
                            return false;
                        };
                    });
                </script>
                <!-- end 2022.09.05. 이메일 입력후 active 효과 스타일 적용 -->

            </form>
            </div>
        </div>
        <div class="p22 certnamecard">
            <form name="frmnamecard" id="frmnamecard" method="post" enctype="multipart/form-data" 
                action="<?php echo MOA_LOGIN_URL;?>/certification_loading.php">
            <div class="lounchecL radio">
            
                
                <input type="radio" id="cert2" name="certi" value="2" class=" certi">
                <label for="cert2">
                &nbsp;회사 명함으로 인증하기
                </label>
            
            </div>
            <div class="p15 ">
                <form method="post" enctype="multipart/form-data" action="">
                 <input type="hidden" name="f_kind" id="f_kind" value="namecard">
                 <div id="imgViewArea" class="citation_photo">
                    <img id="imgArea" src="../images/Photo_default.svg" alt=""  onerror="imgAreaError()">
                </div>
                    <div class="btw_btn02 p10">
                        <!-- 이미지 업로드 -->
                        <input type="file" accept="image/*" name="bf_file" id="namecard" style="display:none">
                        <button type="button" onclick="onCamera();">이미지 업로드/카메라</button>
                        
                        <!-- 카메라 호출 -->
<!--                        <input type="file" accept="image/*" name="camera" id="camera" style="display:none">-->
<!--                        <button type="button" onclick="onCamera('c');" >촬영</button>-->
                    </div>
                    <div class="lowbtn_layout mt25 p0">
                        <button type="submit" class="inactive on">완료</button>
                    </div>
                </form>
            </div>
            </form>
        </div>
    </div>
</section>

<script>
function onCamera() {
    $("#namecard").removeAttr("capture");
    $("#f_kind").val("name-file");
    document.all.bf_file.click();
}
$(function() {
    function onload() {
        var t = '<?php echo $t;?>';
        if (t == 'e') {
            $(".certemail").show();
            $(".certnamecard").hide();
            $("#cert1").attr("checked",true);
        }
        else {
            $(".certemail").hide();
            $(".certnamecard").show();
            $("#cert2").attr("checked",true);
        }
    }
    onload();
    

   // 콘텐츠 수정 :: 사진 수정 시 이미지 미리보기
	function readURL(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e) {
				$('#imgArea').attr('src', e.target.result); 
			}
			reader.readAsDataURL(input.files[0]);
		}
	}

	$(":input[name='bf_file']").change(function() {
		if( $(":input[name='bf_file']").val() == '' ) {
			$('#imgArea').attr('src' , '');  
		}
		$('#imgViewArea').css({ 'display' : '' });
		readURL(this);
       
	});
  
	// 이미지 에러 시 미리보기영역 미노출
	function imgAreaError(){
		$('#imgViewArea').css({ 'display' : 'none' });
	}

    function procfileUpload(obj) {
        //alert("aaaaa");
        if (!obj)
            return false;
        //alert("show");
        return true;
    }
});
</script>