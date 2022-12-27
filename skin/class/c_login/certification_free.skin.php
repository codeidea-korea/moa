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
    
            <div class="btw_btn02 p10">
                <!-- 이미지 업로드 -->
                <input type="file" accept="image/*" name="bf_file" id="namecard" style="display:none">
                <button type="button" onclick="onCamera();">이미지 업로드/카메라</button>
            </div>
        </div>
    </div>
    <div class="lowbtn_layout mt25">
        <input type="submit" class="inactive on" value="완료" >
    </div>
    </form>
</section>



<script type="text/javascript">
    function onCamera() {
        $("#namecard").removeAttr("capture");
        $("#f_kind").val("name-file");
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
        if ($('#namecard').val() === ""){
            alert('등록된 인증 이미지가 없습니다.'); return false;
        }
        if (!obj)
            return false;
        //alert("show");
        return true;
    }
</script>