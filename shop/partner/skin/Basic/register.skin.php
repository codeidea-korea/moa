<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가 

// add_stylesheet('<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,400italic,700,800" type="text/css">',0);
// add_stylesheet('<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Raleway:300,200,100" type="text/css">',0);
// add_stylesheet('<link rel="stylesheet" href="'.$skin_url.'/assets/css/bootstrap.min.css" type="text/css" media="screen">',0);
// add_stylesheet('<link rel="stylesheet" href="'.$skin_url.'/style.css" type="text/css" media="screen">',0);

?>
<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,400italic,700,800" type="text/css">
<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Raleway:300,200,100" type="text/css">
<link rel="stylesheet" href="<?php echo $skin_url?>/assets/css/bootstrap.min.css" type="text/css" media="screen">
<link rel="stylesheet" href="<?php echo $skin_url?>/style.css" type="text/css" media="screen">
<style>
	html { width:100%; height:100%; }
	body { width:100%; height:100%; }
</style>
<div id="sub-wrapper" class="sub-container">
	<div class="box-register">
		<div class="box-block">
			<div class="header">							
				<h3 class="text-center">호스트 신청</h3>
			</div>

		</div>
	</div> 
</div>



    <div class="wrapper">
        <div class="s_content">
            <div class="tabs04 pr">

			<form class="form" role="form" name="fregister" id="fregister" action="<?php echo $action_url ?>" onsubmit="return fregister_submit(this);" method="POST" enctype="multipart/form-data" autocomplete="off">
				
				
				<?php if($is_seller && $is_marketer) { ?>
					<div class="form-group text-center">
						<label><input type="checkbox" name="pt_partner" value="1"> 호스트 신청</label>
						&nbsp; &nbsp; &nbsp;
						<label><input type="checkbox" name="pt_marketer" value="1"> 추천인(마케터) 신청</label>
					</div>
				<?php } else if($is_seller) { ?>
					<input type="hidden" name="pt_partner" value="1">
					<input type="hidden" name="pt_marketer" value="0">
				<?php } else if($is_marketer) { ?>
					<input type="hidden" name="pt_partner" value="0">
					<input type="hidden" name="pt_marketer" value="1">
				<?php } ?>

				<select name="pt_type" required class="form-control input-sm" style="display:none;">
					<option value="2">개인 호스트</option>
				</select>

                <input id="host" type="radio" name="tab_item04" checked="">
                <label class="tab_item04" for="host" style="width: calc(100%/2);">1.약관동의</label>
                <input id="group" type="radio" name="tab_item04">
                <label class="tab_item04" for="group" style="width: calc(100%/2);">2.호스트정보</label>
                <hr class="hr02">
                

                <div class="tab_content p0 bt" id="host_content">
                    <div class="h_termbox">
                        <p class="h_terms">이용약관</p>
                        <p class="h_thermstxt">Moa 서비스 이용 계약을 포한하는 약관(이용약관, 개인 정보 취급 방침)이니 꼭 확인해주세요. (Moa 이용 수수료율은 [중계수수료 (13%) + PG수수료(5%) / VAT 10%별도]이며, 자세한 사항은 이용약관을 확인해주시기 바랍니다.</p>
                    </div>
                    <div class="t_list_area">
                        <input type="checkbox" id="box1">
                        <label for="box1" class="terms_list">개인정보 취급 방침</label>
                        <section id="con01">
                            <div class="box_txt">
                                제 1조 (목적)<br/>
                                이약관은 주식회사 2교시 (이하”회사"라 함)가 운영하는 컴퓨터 등 정보통신 설비를 이용하여
                            </div>
                        </section>

                        <input type="checkbox" id="box2">
                        <label for="box2" class="terms_list">이용약관</label>
                        <section id="con02">
                            <div class="box_txt">
                                제 1조 (목적)<br/>
                                이약관은 주식회사 2교시 (이하”회사"라 함)가 운영하는 컴퓨터 등 정보통신 설비를 이용하여
                            </div>
                        </section>

                        <input type="checkbox" id="box3">
                        <label for="box3" class="terms_list">커뮤니티 이용약관</label>
                        <section id="con03">
                            <div class="box_txt">
                                제 1조 (목적)<br/>
                                이약관은 주식회사 2교시 (이하”회사"라 함)가 운영하는 컴퓨터 등 정보통신 설비를 이용하여
                            </div>
                        </section>

                        <input type="checkbox" id="box4">
                        <label for="box4" class="terms_list">이용약관 (구매자)</label>
                        <section id="con04">
                            <div class="box_txt">
                                제 1조 (목적)<br/>
                                이약관은 주식회사 2교시 (이하”회사"라 함)가 운영하는 컴퓨터 등 정보통신 설비를 이용하여
                            </div>
                        </section>
                       
                        <div style="height:30px"></div>
                    </div>

					<div class="expected_cost">
						<button type="button" style="width:100%;margin:10px;margin-top:0;" onclick="nextStep()">다음</button>
					</div>
                </div>
              
                <div class="tab_content p0" id="group_content">
                    <div class="mt20">
                        <p class="m_title">프로필</p>
                        <!-- <div class="citation_photo02">
                            <img class="w28" src="../images/Photo_default.svg" alt="">
                        </div> -->
                        <div class="common_input">
                            <div class="mt15">
                                <div class="input_flex">
								
								<input type="file" name="pf_file[]" class="form-control input-sm"  title="사업자등록증 또는 신분증 사본 : 용량 <?php echo $upload_max_filesize; ?> 이하만 업로드 가능">

                                <!-- <input type="text" name="pf_file[]" placeholder="파일없음" disabled> -->
                                </div>
                                <span class="inform02 ">
                                    ·용량 2MB 이하 jpg,png
                                </span>
                            </div>
                        </div>
                        <!-- <div class="btw_btn p10">
                            <input type="file" name="file" id="file" style="display:none">
                            <button onclick="onclick=document.all.file.click()">이미지 업로드</button>
                            <button>촬영</button>
                        </div> -->
                    </div>

                    <div class="common_input">
                        <div class="mt20">
                            <p class="m_title">이메일</p>
                            <div class="input_flex">
                                <input type="email" name="pt_email" id="pt_email" placeholder="이메일을 입력해주세요.">
                            </div>
                            <span class="inform02 ">
                               ·실제 사용하시는 이메일 주소를 입력해주세요.<br/>
                                해당 이메일로 공지사항 및 상품 수정 요청 등 중요 알람이 발송됩니다.
                            </span>
                        </div>

                        <div class="mt20" style="display:none;">
                            <p class="m_title">휴대폰 번호</p>
                            <div class="input_flex">
                                <input type="number" pattern="\d*" name="pt_hp" id="pt_hp" placeholder="휴대폰 번호 (-없이 입력)" placeholder="휴대폰 번호 (-없이 입력)">
                                <div class="cominput_btn02">
                                    <button type="button" class="smsSend on">전송</button>
                                </div>
                            </div>
                            <div class="input_flex mt10" style="display:none;">
                                <input type="number" placeholder="인증번호 입력">
                                <div class="cominput_btn02">
                                    <button class="on">인증하기</button>
                                </div>
                            </div>
                            <span class="inform02 ">
                               ·실제 사용하시는 휴대폰 번호를 입력해주세요.<br/>
                                해당 휴대폰 번호로 공지사항 및 상품 수정 요청 등 중요 알람이 발송됩니다.
                            </span>
                        </div>

                        <div class="mt20">
                            <p class="m_title">호스트 명</p>
                            <div class="input_flex">
                                <input class="pr40" type="text" oninvalid="this.setCustomValidity('호스트 명을 입력해주십시오.')"
                                oninput = "setCustomValidity('')" name="pt_name" id="pt_name" required placeholder="호스트 명 입력">
                                <span class="limit">0/20</span>
                            </div>
                            <span class="inform02 ">
                                ·대원들에게 보여지는 닉네임 입니다.
                            </span>
                        </div>

                        
                        <div class="mt20" style="display:none;">
                            <p class="m_title">공개연락처 <span class="tre">(선택)</span></p>
                            <div class="input_flex">
                                <input type="number" placeholder="공개 연락처 입력">
                            </div>
                            <span class="inform02 ">
                                ·Moa 대원(회원)에게 노출되는 공개 연락처입니다.
                                ·미입력 시 인증한 연락처가 노출됩니다.
                            </span>
                        </div>

                        
                        <div class="mt20" style="display:none;">
                            <p class="m_title">소개 <span class="tre">(선택)</span></p>
                            <div class="brief_history">
                                <textarea name="" id="" cols="30" rows="10" placeholder="간단한 소개와 약력을 입력해주세요."></textarea>
                                <span class="limit02">0/20</span>
                            </div>
                            <span class="inform02 ">
                                ·Moa 대원(회원)에게 호스트님을 소개해 주세요.<br/>
                                ·호스트님만의 개성을 담거나, 신뢰감을 줄 수 있는 전문적인 사항들을
                                입력하시면 좋습니다.
                            </span>
                        </div>

                        <div class="form-group checkbox" style="display:none;height:50px">
							<label >
								<input type="checkbox" name="agree" value="1" id="agree11" style="border:1px solid #333;width:25px;height:25px" checked> 호스트가입약관과 상기 정보제공에 동의합니다.
							</label>
						</div>

                        <div class="two_btn mt40">
                            <button class="inactive on" type="button" onclick="location.href='/'">취소</button>
                            <button class="inactive on" type="submit">완료</button>
                        </div>
                    </div>
                 </div>

				 
				</form>


            </div>
        </div>
    </div>
<script>
// $(".smsSend").click(function() {
//     var hp_no = $("#pt_hp").val();
//     if (hp_no) {
//         $.ajax({
//             url: "/ajax/sendSMSofFindEmail.php",
//             type: "POST",
//             data: {
//                 "hp_no": hp_no
//             },
//             dataType: "text",
//             async: false,
//             cache: false,
//             success: function(data) {
//                 if (data) {
//                     alert(data);
//                 }
//             }
//         });
//     }
// });
function nextStep() {
    $('input[name="tab_item04"]').click();
}
</script>

<script>

    function fregister_submit(f) {
        if (!f.agree.checked) {
            alert("호스트가입약관과 정보제공에 동의하셔야 가입하실 수 있습니다.");
            f.agree.focus();
            return false;
        }
        /*
		<?php if($is_seller && $is_marketer) { ?>
        if (!f.pt_partner.checked && !f.pt_marketer.checked) {
            alert("판매자 또는 추천인 중 하나를 선택하셔야 가입하실 수 있습니다.");
            f.pt_partner.focus();
            return false;
        }
		<?php } ?>
		<?php if($use_company && $use_personal) { ?>
			var type = false;
			for(var i=0;i<f.pt_type.length;i++) {
				if(f.pt_type[i].checked == true) {
					type = true;
					break;
				}
			}
			if (!type) {
	            alert("등록할 호스트 유형을 선택해 주세요.");
				return false;
		    }
		<?php } ?>

		//이메일
		var regex = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
		if(regex.test(f.pt_email.value) === false) {  
			alert("잘못된 이메일 형식입니다.");  
            f.pt_email.focus();
			return false;  
		}
        */

        var email = $('input[name="pt_email"]').val();

        var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;


        if (!re.test(email)) {
            alert("올바른 이메일 주소를 입력하세요");
            return false;
        }

		if (confirm("호스트 등록을 신청하시겠습니까?")) {
			f.action = "<?php echo $action_url;?>";
			return true;
		}

		return false;
    }
</script>

<!-- JavaScript -->
<script type="text/javascript" src="<?php echo $skin_url;?>/assets/js/bootstrap.min.js"></script>