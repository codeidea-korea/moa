<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>
<script src="/js/rolldate.min.js"></script>
<!-- 프로필설정 -->
<div class="boxContainer padding40">
    <form class="form" role="form" name="fregister" id="fregister" action="<?php echo G5_SHOP_URL ?>/partner/register_form.update.php" onsubmit="return fregister_submit(this);" method="POST" enctype="multipart/form-data" autocomplete="off">
        <input type="hidden" name="ap" value="register_form" />
        <input type="hidden" name="callBackUrl" value="/c_my/my_page01.php" />

        <div class="s_content">
            <div class="p_area fileContainer">
                <div class="profile_img upImg-preview">
                    <!-- 2022.09.06. botbinoo, 프로필 이미지 수정 안되는 오류(리소스 캐싱 문제) -->
                    <!-- <?php echo ($member['photo']) ? '<img src="' . $member['photo'] . '" alt="">' : '<img src="../images/profile_default.svg">';  ?> -->
                    <?php echo ($member['photo']) ? '<img src="' . $member['photo'] . '?v=' . time() . '" alt="">' : '<img src="../images/profile_default.svg">';  ?>
                    <!-- end 2022.09.06. botbinoo, 프로필 이미지 수정 안되는 오류(리소스 캐싱 문제) -->
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

                <style>
                    input[type="number"]::-webkit-outer-spin-button,
                    input[type="number"]::-webkit-inner-spin-button {
                        -webkit-appearance: none;
                        margin: 0;
                    }
                </style>
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

                <div class="" style="margin-top:40px;">
                    <p class="m_title">정보 공개 여부</p>
                    <div class="input_flex" style="padding:10px 0">
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

                <div class="info_list" style="margin-top:15px;">
                    <ul>
                        <li>
                            <p class="m_title">성별</p>
                            <div class="radio_area">
                                <span class="info_radio">
                                    <input type="radio" value="남" <?php echo $member['mb_sex'] == '남' ? 'checked = "checked"' : ''; ?> name="mb_sex" id="radio1" disabled>
                                    <label for="radio1">남</label>
                                </span>
                                <span class="info_radio">
                                    <input type="radio" value="여" <?php echo $member['mb_sex'] == '여' ? 'checked = "checked"' : ''; ?> name="mb_sex" id="radio2" disabled>
                                    <label for="radio2">여</label>
                                </span>
                            </div>
                        </li>
                        <li>
                            <p>생년월일</p>
                            <div class="info_ent">
                                <input readonly type="text" name="mb_birth" id="date_picker" placeholder="생년월일을 입력해주세요" value="<?php echo $member['mb_birth']; ?>">
                            </div>
                        </li>
                        <!-- 1130추가 -->
                        <li>
                            <p>직군</p>
                            <div class="info_ent">
                                <select name="job_group" id="job_group" class="required form-input">
                                    <?php foreach($jobgroup as $group) { ?>
                                        <option value="<?php echo $group; ?>" <?php echo $group == $member['job_group'] ? 'selected' : ''; ?>><?php echo $group; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </li>
                        <li>
                            <p>직무</p>
                            <div class="info_ent">
                                <input type="text" name="job_kind" placeholder="직무를 입력해 주세요." value="<?php echo $member['job_kind']; ?>">
                            </div>
                        </li>
                        <li>
                            <p>직장</p>
                            <div class="info_ent">
                                <input type="text" name="company_name" placeholder="직장을 입력해 주세요." value="<?php echo $member['company_name']; ?>">
                            </div>
                        </li>
                        <li>
                            <p>경력</p>
                            <div class="info_ent">
                                <div style="display:flex;justify-content: center;">
                                    <div class="slider-container" style="width:90%">
                                        <input type="text" id="slider2" class="slider" name="career" value="<?php echo $member['career']; ?>" />
                                    </div>
                                </div>
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
    // 1130추가
    (function() {
        'use strict';

        var init = function() {

            var slider2 = new rSlider({
                target: '#slider2',
                        values: [1, 2, 3, 4, 5],
                range: false,
                set: [<?php echo $member['career']; ?>],
                tooltip: true,
                onChange: function(vals) {
                    console.log(vals);
                }
            });
        };
        window.onload = init;
    })();


    // 업로드 이미지 미리보기
    $('input[type="file"].preview').each(function(index) {
        var inp = $(this);
        var upload = $(this)[0];
        $(this).parent().parent().find('.upImg-preview').attr('id', 'holder_' + index);
        var holder = document.getElementById('holder_' + index);
        upload.onchange = function(e) {
            e.preventDefault();
            var file = upload.files[0],
                reader = new FileReader();
            reader.onload = function(event) {
                var img = new Image();
                img.src = event.target.result;
                //btn.hide();
                //holder.children('img').remove();
                if (inp.hasClass('multiple')) {} else {
                    holder.innerHTML = '';
                }
                holder.appendChild(img);
                //$(holder).css('background-image', 'url("' + reader.result + '")'); //background로 추출
            };
            reader.readAsDataURL(file);
            return false;
        };
    });

    new Rolldate({
        el: '#date_picker',
        format: 'YYYY-MM-DD',
        beginYear: 1920,
        endYear: 2022,
        lang: {
            title: '생년월일',
            cancel: '닫기',
            confirm: '입력',
            year: '',
            month: '',
            day: '',
        }
    })
</script>