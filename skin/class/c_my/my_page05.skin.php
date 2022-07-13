<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>

<!-- 프로필설정 -->
<div class="boxContainer padding40">
<form class="form" role="form" name="fregister" id="fregister" action="<?php echo G5_SHOP_URL ?>/partner/register_form.update.php" onsubmit="return fregister_submit(this);" method="POST" enctype="multipart/form-data" autocomplete="off">
    <input type="hidden" name="ap" value="register_form" />
    <div class="s_content">
        <div class="p_area fileContainer">
            <div class="profile_img upImg-preview">
                <?php echo ($member['photo']) ? '<img src="'.$member['photo'].'" alt="">' : '<img src="../images/profile_default.svg">';  ?>
            </div>
            <div class="up_profile02">
                <input type="file" id="up_profile" name="pt_file" class="preview">
                <label for="up_profile" class="upload-btn"><img src="../images/up_profile.svg" alt=""></label>
            </div>
            <p class="p_id"><?php echo $member['mb_id']; ?></p>
                <!-- <a href="" class="connect">네이버 계정 연결</a> -->
            <div class="my_ment">
                회원님은 <b>반가운 분</b>입니다. <span><?php echo $member['grade']; ?></span>
            </div>
        </div>
    </div>
    <div class="s_content">
        <div class="common_input">
            <div class="mt15">
                <p class="m_title">닉네임</p>
                <div class="input_flex">
                    <input type="text" name="mb_nick" value="<?php echo $member['mb_nick']; ?>" placeholder="닉네임">
                </div>
            </div>

            <div class="mt15">
                <p class="m_title">비밀번호</p>
                <div class="input_flex">
                    <input type="password" name="mb_password" value="" placeholder="비밀번호 입력">
                </div>
            </div>

            <div class="mt15">
                <p class="m_title">비밀번호 확인</p>
                <div class="input_flex">
                    <input type="password" name="mb_password2" value="" placeholder="비밀번호 입력 확인">
                </div>
            </div>

            <div class="mt15">
                <p class="m_title">휴대폰 번호</p>
                <div class="input_flex">
                    <input type="number" pattern="\d*" name="mb_hp" placeholder="휴대폰 번호" value="<?php echo $member['mb_hp']; ?>">
                </div>
            </div>

            <div class="mt15">
                <p class="m_title">이메일</p>
                <div class="input_flex">
                    <input type="email" placeholder="이메일" name="mb_email" value="<?php echo $member['mb_email'] ?>">
                </div>
            </div>

            <div class="mt15">
                <p class="m_title">한 줄 소개 입력</p>
                <div class="input_flex">
                    <input type="text" placeholder="한 줄 소개 입력" name="mb_recommend" value="<?php echo $member['mb_recommend']; ?>">
                </div>
            </div>

            <div class="mt15">
                <p class="m_title">정보 공개 여부</p>
                <div class="input_flex">
                    <span class="info_radio">
                        <input type="radio" value="1" <?php echo $member['mb_open'] == '1' ? 'checked = "checked"' : ''; ?> name="mb_open" id="mb_open1">
                        <label for="mb_open1">공개</label>
                    </span>
                    <span class="info_radio">
                        <input type="radio" value="0" <?php echo $member['mb_open'] == '0' ? 'checked = "checked"' : ''; ?> name="mb_open" id="mb_open2">
                        <label for="mb_open2">비공개</label>
                    </span>
                </div>
            </div>

            <div class="info_list">
                <ul>
                    <li>
                        <p class="m_title">성별</p>
                        <div class="radio_area">
                            <span class="info_radio">
                                <input type="radio" value="남" <?php echo $member['mb_sex'] == '남' ? 'checked = "checked"' : ''; ?> name="mb_sex" id="radio1">
                                <label for="radio1">남</label>
                            </span>
                            <span class="info_radio">
                                <input type="radio" value="여" <?php echo $member['mb_sex'] == '여' ? 'checked = "checked"' : ''; ?> name="mb_sex" id="radio2">
                                <label for="radio2">여</label>
                            </span>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="btn_fixed_top">
        <button class="inactive on" type="submit">완료</button>
    </div>
</form>
</div>
<script>
    // 업로드 이미지 미리보기
    $('input[type="file"].preview').each(function(index) {
        var inp = $(this);
        var upload = $(this)[0];
        $(this).parent().parent().find('.upImg-preview').attr('id', 'holder_' + index);
        var holder = document.getElementById('holder_' + index);
        upload.onchange = function (e) {
            e.preventDefault();
            var file = upload.files[0],
                reader = new FileReader();
            reader.onload = function (event) {
                var img = new Image();
                img.src = event.target.result;
                //btn.hide();
                //holder.children('img').remove();
                if(inp.hasClass('multiple')) {
                } else {
                    holder.innerHTML = '';
                }
                holder.appendChild(img);
                //$(holder).css('background-image', 'url("' + reader.result + '")'); //background로 추출
            };
            reader.readAsDataURL(file);
            return false;
        };
    });
</script>