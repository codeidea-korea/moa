<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>

<section class="wrapper01">
    <div class="s_content">
        <div class="tabs04 pr">
            <input id="host" type="radio" name="tab_item04" checked="">
            <label class="tab_item04" for="host">1.약관동의</label>
            <input id="group" type="radio" name="tab_item04">
            <label class="tab_item04" for="group">2.계정정보</label>
            <input id="host_info" type="radio" name="tab_item04">
            <label class="tab_item04" for="host_info">3.호스트정보</label>
            <hr class="hr02">
            
            <div class="tab_content p0 bt" id="host_content">
                <!--
                <div class="h_termbox">
                    <p class="h_terms">이용약관</p>
                    <p class="h_thermstxt">Moa 서비스 이용 계약을 포한하는 약관(이용약관, 개인 정보 취급 방침)이니 꼭 확인해주세요. (Moa 이용 수수료율은 [중계수수료 (13%) + PG수수료(5%) / VAT 10%별도]이며, 자세한 사항은 이용약관을 확인해주시기 바랍니다.</p>
                </div>
-->
                <div class="t_list_area">
                    <input type="checkbox" id="box1">
                    <label for="box1" class="terms_list">개인정보 취급 방침</label>
                    <section id="con01">
                        <div class="box_txt">
                            제 1조 (목적)<br>
                            이약관은 주식회사 2교시 (이하”회사"라 함)가 운영하는 컴퓨터 등 정보통신 설비를 이용하여
                        </div>
                    </section>

                    <input type="checkbox" id="box2">
                    <label for="box2" class="terms_list">이용약관</label>
                    <section id="con02">
                        <div class="box_txt">
                            제 1조 (목적)<br>
                            이약관은 주식회사 2교시 (이하”회사"라 함)가 운영하는 컴퓨터 등 정보통신 설비를 이용하여
                        </div>
                    </section>

                    <input type="checkbox" id="box3">
                    <label for="box3" class="terms_list">커뮤니티 이용약관</label>
                    <section id="con03">
                        <div class="box_txt">
                            제 1조 (목적)<br>
                            이약관은 주식회사 2교시 (이하”회사"라 함)가 운영하는 컴퓨터 등 정보통신 설비를 이용하여
                        </div>
                    </section>

                    <input type="checkbox" id="box4">
                    <label for="box4" class="terms_list">이용약관 (구매자)</label>
                    <section id="con04">
                        <div class="box_txt">
                            제 1조 (목적)<br>
                            이약관은 주식회사 2교시 (이하”회사"라 함)가 운영하는 컴퓨터 등 정보통신 설비를 이용하여
                        </div>
                    </section>
                    
                </div>
            </div>
            
            <div class="tab_content p0" id="group_content">
                <div class="common_input">
                    <div class="mt15">
                        <div class="input_flex">
                            <input type="email" placeholder="이메일을 입력해주세요.">
                            <div class="cominput_btn02">
                                <button class="on">중복확인</button>
                            </div>
                        </div>
                        <span class="inform p12">
                            *올바른 이메일 형식이 아닙니다.
                        </span>
                        <span class="inform02 p12">
                            ·아이디로 사용할 이메일 주소를 입력해주세요.<br>
                            ·아직 Moa 가입을 하지 않으셨다면, Moa 계정이 함께 생성됩니다.
                        </span>

                        <!-- 이메일 중복 확인 완료 후 -->
                        <span class="inform02 p12">
                            ·계약서 및 Moa 관련 안내 사항 등을 메일로 전달드립니다.
                        </span>
                    </div>
                        <!-- 이메일 중복 확인 완료 후 -->
                    <div class="mt15">
                        <div class="input_flex">
                            <input type="password" placeholder="비밀번호 입력">
                        </div>
                    </div>
                        <!-- 이메일 중복 확인 완료 후 -->
                    <div class="mt15">
                        <div class="input_flex">
                            <input type="password" placeholder="비밀번호 입력">
                        </div>
                    </div>
                    <span class="inform02 p12">
                        ·6~20자 영문 대소문자, 숫자, 특수문자 중 2가지 이상 조합  
                    </span>
                </div>

                <div class="two_btn mt40">
                    <button class="inactive">취소</button>
                    <button class="inactive on">완료</button>
                </div>
                    
            </div>

            <div class="tab_content p0 bt" id="host_info_content">
                <div class="mt20">
                    <p class="m_title">프로필</p>
                    <div class="citation_photo02">
                        <!-- 업로드 이미지 class 삭제해야함 -->
                        <img class="w28" src="../images/Photo_default.svg" alt="">
                    </div>
                    <div class="common_input">
                        <div class="mt15">
                            <div class="input_flex">
                                <input type="text" placeholder="파일없음" disabled="">
                            </div>
                            <span class="inform02 ">
                                ·용량 2MB 이하 jpg,png
                            </span>
                        </div>
                    </div>
                    <div class="btw_btn p10">
                        <!-- 이미지 업로드 -->
                        <input type="file" name="file" id="file" style="display:none">
                        <button onclick="onclick=document.all.file.click()">이미지 업로드</button>
                        <!-- 카메라 호출 -->
                        <input type="file" accept="image/*" capture="camera" name="camera" id="camera" style="display:none">
                        <button onclick="onclick=document.all.camera.click()">촬영</button>
                    </div>
                </div>

                <div class="common_input">
                    <div class="mt20">
                        <p class="m_title">이메일</p>
                        <div class="input_flex">
                            <input type="email" placeholder="이메일을 입력해주세요.">
                        </div>
                        <span class="inform02 ">
                            ·실제 사용하시는 이메일 주소를 입력해주세요.<br>
                            해당 이메일로 공지사항 및 상품 수정 요청 등 중요 알람이 발송됩니다.
                        </span>
                    </div>

                    <div class="mt20">
                        <p class="m_title">휴대폰 번호</p>
                        <div class="input_flex">
                            <input type="number" pattern="\d*" placeholder="휴대폰 번호 (-없이 입력)">
                            <div class="cominput_btn02">
                                <button class="on">전송</button>
                            </div>
                        </div>
                        <div class="input_flex mt10">
                            <input type="number" placeholder="인증번호 입력">
                            <div class="cominput_btn02">
                                <button class="on">인증하기</button>
                            </div>
                        </div>
                        <span class="inform02 ">
                            ·실제 사용하시는 이메일 주소를 입력해주세요.<br>
                            해당 이메일로 공지사항 및 상품 수정 요청 등 중요 알람이 발송됩니다.
                        </span>
                    </div>

                    <div class="mt20">
                        <p class="m_title">호스트 명</p>
                        <div class="input_flex">
                            <input class="pr40" type="text" placeholder="호스트 명 입력">
                            <span class="limit">0/20</span>
                        </div>
                        <span class="inform02 ">
                            ·게스트들에게 보여지는 닉네임 입니다.
                        </span>
                    </div>

                    
                    <div class="mt20">
                        <p class="m_title">공개연락처 <span class="tre">(선택)</span></p>
                        <div class="input_flex">
                            <input type="number" placeholder="공개 연락처 입력">
                        </div>
                        <span class="inform02 ">
                            ·Moa 대원(회원)에게 노출되는 공개 연락처입니다.
                            ·미입력 시 인증한 연락처가 노출됩니다.
                        </span>
                    </div>

                    
                    <div class="mt20">
                        <p class="m_title">소개 <span class="tre">(선택)</span></p>
                        <div class="brief_history">
                            <textarea name="" id="" cols="30" rows="10" placeholder="간단한 소개와 약력을 입력해주세요."></textarea>
                            <span class="limit02">0/20</span>
                        </div>
                        <span class="inform02 ">
                            ·Moa 대원(회원)에게 호스트님을 소개해 주세요.<br>
                            ·호스트님만의 개성을 담거나, 신뢰감을 줄 수 있는 전문적인 사항들을
                            입력하시면 좋습니다.
                        </span>
                    </div>

                    <div class="two_btn mt40 last_cnt">
                        <button class="inactive">취소</button>
                        <!-- 이메일 가입 안 했을 때 가입폼으로 -->
                        <button style="display:none" class="inactive on" onclick="location.href='<?php echo MOA_LOGIN_URL;?>/certification.php'">완료</button>
                        <!-- 이메일 가입했을 때 가입폼으로 -->
                        <button class="inactive on" onclick="location.href='<?php echo MOA_HOSTJ_URL;?>/host_join04.php'">완료</button>
                    </div>
                </div>
             </div>
        </div>
    </div>
</section>