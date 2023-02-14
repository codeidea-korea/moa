<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가 

// add_stylesheet('<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,400italic,700,800" type="text/css">',0);
// add_stylesheet('<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Raleway:300,200,100" type="text/css">',0);
// add_stylesheet('<link rel="stylesheet" href="'.$skin_url.'/assets/css/bootstrap.min.css" type="text/css" media="screen">',0);
// add_stylesheet('<link rel="stylesheet" href="'.$skin_url.'/style.css" type="text/css" media="screen">',0);

?>



<div class="section-title">프로필 관리</div>

<div class="boxContainer padding40">
<form class="form" role="form" name="fregister" id="fregister" action="<?php echo $action_url ?>" onsubmit="return fregister_submit(this);" method="POST" enctype="multipart/form-data" autocomplete="off">
	<input type="hidden" name="ap" value="<?php echo $_GET['ap']; ?>" />
    <div class="tbl_frm01 tbl_wrap gap15">
		<table>
			<colgroup>
				<col width="150">
				<col>
			</colgroup>

			<tbody>
				<tr>
					<th><label class="required">프로필 사진</label></th>
					<td>
						<div class="fileContainer flex">
							<div class="upImg-preview profile-thumb">
                            <?php echo ($member['photo']) ? '<img src="'.$member['photo'].'?v='.time().'" alt="">' : '<span class="no-img"></span>'; //사진 ?>
                            </div>
							<div class="inner">
								<input type="file" name="pt_file" id="upload-01" class="preview">
								<label for="upload-01" class="upload-btn">사진 수정하기</label>
								<p class="msg">2MB 이하의 png, jpg파일로 올려주세요.</p>
							</div>
						</div>
					</td>
				</tr>
                <tr>
                    <th><span class="m_title required">성별</span></th>
					<? 
					$sql_mem = " select * from g5_member where mb_id = '{$member['mb_id']}' ";
					$user = sql_fetch($sql_mem);
					?>
                    <td>
                        <div class="radio_area">
                            <span class="info_radio">
                                <input type="radio" value="남" <?php echo $user['mb_sex'] == '남' ? 'checked' : ''; ?> name="mb_sex" id="radio1" disabled>
                                <label for="radio1">남</label>
                            </span>
                            <span class="info_radio">
                                <input type="radio" value="여" <?php echo $user['mb_sex'] == '여' ? 'checked' : ''; ?> name="mb_sex" id="radio2" disabled>
                                <label for="radio2">여</label>
                            </span>
                        </div>
                    </td>
                </tr>
				<tr>
					<th class="vertical-top"><label class="required">초대코드</label></th>
					<td>
						<input type="text" name="invite_code" value="<?php echo $member['invite_code'] ?>" class="span450" readOnly placeholder="">
						<p class="fs13 color-gray mt5">자동으로 부여되는 코드이며, 수정이 불가능합니다.</p>
					</td>
				</tr>
				<tr>
					<th class="vertical-top"><label class="required">닉네임</label></th>
					<td>
						<div class="flex gap10">
							<input type="text" name="mb_nick" required value="<?php echo $member['mb_nick'] ?>" class="span450" placeholder=""
							onkeyup="characterCheck(this)" onkeydown="characterCheck(this)"  onchange="characterCheck(this)">
                            <a href="#"  id="search_nick" class="btn reverse">중복확인</a>
                        <input type="hidden" value="" id="is_nick_search" />
						</div>
						<p class="fs13 color-gray mt5">한 달에 3회까지만 수정이 가능합니다.</p>
					</td>
				</tr>
				<tr>
					<th><label class="required">이메일</label></th>
					<td>
						<input type="email" name="mb_email" required value="<?php echo $member['mb_email'] ?>" id="mb_email" class="span450" placeholder="이메일을 입력해주세요.">
					</td>
				</tr>
				<tr>
					<th><label class="required">휴대폰번호</label></th>
					<td>
						<input type="number" value="<?php echo $member['mb_hp'] ?>" required pattern="\d*" name="mb_hp" id="mb_hp" class="span450" placeholder="휴대폰 번호 (-없이 입력)" placeholder="휴대폰 번호 (-없이 입력)">
					</td>
				</tr>
                <tr>
                    <th><label>정보 공개여부</label></th>
                    <td>
                        <span class="info_radio">
                            <input type="radio" value="1" <?php echo $member['mb_open'] == '1' ? 'checked = "checked"' : ''; ?> name="mb_open" id="mb_open1">
                            <label for="mb_open1">공개</label>
                        </span>
                        <span class="info_radio">
                            <input type="radio" value="0" <?php echo $member['mb_open'] == '0' ? 'checked = "checked"' : ''; ?> name="mb_open" id="mb_open2">
                            <label for="mb_open2">비공개</label>
                        </span>
                    </td>
                </tr>
				<tr>
					<th class="vertical-top"><label>한줄 소개 작성</label></th>
					<td>
						<div class="relative span450">
							<textarea name="mb_recommend" class="limited " placeholder="30글자 이내로 작성해주세요." maxlength="30" data-max="30" style="height:90px"><?php echo $member['mb_recommend'] ?></textarea>
							<div class="textCount-wrap"><span class="textCount">0</span> / 30</span></div>
						</div>
					</td>
				</tr>
			</tbody>

		</table>
	</div>

	<div class="btn_fixed_top">
		<button class="btn_02 btn" onclick="location.href='/shop/partner/'">취소</button>
		<button class="btn_submit btn" type="submit">완료</button>
	</div>

</form>
</div>

<script>
    $('document').ready(function(){
        var content = $('.limited').val();
        if (content.length == 0 || content == '') {
            $('.textCount').text('0');
        } else {
            $('.textCount').text(content.length);
        }
    })
    function characterCheck(obj){
        var regExp = /[ \{\}\[\]\/?,;:|\)*~`!^+┼<>\#$%&@\'\"\\\(\=]/gi; 
        if( regExp.test(obj.value) ){
            alert("특수문자는 입력하실수 없습니다.");
//            obj.value = obj.value.substring( 0 , obj.value.length - 1 );
            obj.value = obj.value.replace(regExp, '');
            return false;
        }
        return true;
    }
	$('#search_nick').click(function() {
		var nick = $('input[name=mb_nick]').val();
		if (nick == '') {
			alert('닉네임을 입력해주세요.');
			return false;
		}
		if(!characterCheck($('input[name=mb_nick]'))) {
			return false;
		}
		$.ajax({
			type: "POST",
			url: '/ajax/nickSearch.php',
			data: {
				'nick': nick
			},
			cache: false,
			async: false,
			dataType: "json",
			success: function(data) {
				if (data.cnt > 0) {
					alert('이미 존재하는 닉네임입니다.');
					$('input[name=mb_nick]').val('');
					$('input[name=mb_nick]').focus();
				} else {
					alert('사용 가능한 닉네임입니다.');
					$('#is_nick_search').val(1);
				}
			}
		});
	})

    function fregister_submit(f) {
        // if (!f.agree.checked) {
        //     alert("호스트가입약관과 정보제공에 동의하셔야 가입하실 수 있습니다.");
        //     f.agree.focus();
        //     return false;
        // }
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
		var nick = $('input[name=mb_nick]').val();
		if (nick != '<? echo $member['mb_nick'] ?>' && !$('#is_nick_search').val()) {
			alert('중복 검사를 실행해주세요.');
			return false;
		}

		if (confirm("프로필을 수정하시겠습니까?")) {
			f.action = "<?php echo $action_url;?>";
			return true;
		}

		return false;
    }
</script>
