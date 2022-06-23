<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>

<section class="wrapper">
    <form method="post" 
        enctype="multipart/form-data" 
        action="/c_login/certification_loading.php" 
        OnSubmit="return procfileUpload(this);" 
        autocomplete="off" 
        role="form" 
        class="form-horizontal"
        >
        <input type="hidden" name="f_kind" id="f_kind" value="free">
    <div class="content">
        <div class="con_area">
            <p class="free_t">
                사업자 증빙 서류/ 전문가 자격증 등 프리랜서 혹은<br>
                사업자 입증 가능한 서류 촬영 후 인증
            </p>
        </div>
        <div class="p20">
            <div id="imgViewArea" class="citation_photo">
                <img id="imgArea" src="../images/Photo_default.svg" alt=""  onerror="imgAreaError()">
            </div>
    
            <div class="btw_btn p10">
                <!-- 이미지 업로드 -->
                <input type="file" accept="image/*" name="bf_file" id="namecard" style="display:none">
                <button type="button" onclick="onCamera('up');">이미지 업로드</button>
                
                <!-- 카메라 호출 -->
                <input type="file" accept="image/*" name="camera" id="camera" style="display:none">
                        
                <button type="button" onclick="onCamera('c');" >촬영</button>
            </div>
        </div>
    </div>
    <div class="lowbtn_layout mt25">
        <input type="submit" class="inactive on" oncl ick="location.href='<?php echo MOA_LOGIN_URL;?>/certification_loading.php'" value="완료" >
    </div>
    </form>
</section>



<script type="text/javascript">
function onCamera(type) {
    if (type=='c') {
        $("#namecard").attr("capture","camera");
        $("#f_kind").val("free-file");

    }
    else {
        $("#namecard").attr("capture","");
        $("#f_kind").val("free-camera");
    }
    document.all.bf_file.click();
}
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
</script>