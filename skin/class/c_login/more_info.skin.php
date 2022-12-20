<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>

<section class="wrapper">
    <div class="content">
        <div class="con_area">
            <div class="info_list">
                <ul>
                    <li>
                        <p>직군</p>
                        <div class="select_st">
                            <select name="" id="">
                                <option value="">디자이너 &gt;</option>
                            </select>
                        </div>
                    </li>
                    <li>
                        <p>직무</p>
                        <div class="select_st">
                            <select name="" id="">
                                <option value="">모바일 디자이너 &gt;</option>
                            </select>
                        </div>
                    </li>
                    <li>
                        <p>기업명</p>
                        <div class="info_ent serch">
                            <a href="<?php echo C_LOGIN_PATH;?>/company_search.php">회사명을 입력해주세요</a>
                        </div>
                    </li>

                    <!-- 생년월일 --> 
                    <li>
                        <p>생년월일</p>
                        <div class="info_ent">
                            <input readonly type="text" id="date_picker" placeholder="생년월일을 입력해주세요">
                        </div>
                        
                    </li>
                    <li>
                        <p>성별</p>
                        <div class="radio_area">
                            <span class="info_radio">
                                <input type="radio" name="dd1" id="radio1">
                                <label for="radio1">남</label>
                            </span>
                            <span class="info_radio">
                                <input type="radio" name="dd1" id="radio2">
                                <label for="radio2">여</label>
                            </span>
                        </div>
                    </li>
                </ul>
            </div>
            
            <!-- 경력슬라이더 --> 
            <div class="slider_area">
                <p>총 경력</p>
                <div class="slider-container">
                                    <input type="hidden" name="career" />
                                    <input type="text" id="slider2" class="slider" />
                </div>
            </div>
            <div class="infock_area">
                <ul>
                    <li>
                        <p>관심사선택<br/>(2개 이상)</p>
                        <div class="infock_list">
                            <ul>
                                <li>
                                    <input type="checkbox" id="box_01">
                                    <label for="box_01">액티비티</label>
                                    <input type="checkbox" id="box_02">
                                    <label for="box_02">커리어</label>
                                </li>
                                <li>
                                    <input type="checkbox" id="box_03">
                                    <label for="box_03">쿠킹/베이킹</label>
                                    <input type="checkbox" id="box_04">
                                    <label for="box_04">소셜링</label>
                                </li>
                                <li>
                                    <input type="checkbox" id="box_05">
                                    <label for="box_05">문화예술</label>
                                    <input type="checkbox" id="box_06">
                                    <label for="box_06">힐링</label>
                                </li>
                                <li>
                                    <input type="checkbox" id="box_07">
                                    <label for="box_07">뷰티</label>
                                    <input type="checkbox" id="box_08">
                                    <label for="box_08">자기계발</label>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="invite_code">
                <p>초대코드</p>
                <div class="common_input">
                    <input type="text" placeholder="초대코드를 입력하세요">
                </div>
            </div>
        </div>
    </div>
    <div class="btwbtn_layout">
        <button class="inactive">취소</button>
        <button class="inactive on">완료</button>
    </div>
</section>
<!-- 경력 script -->
<script>
    (function () {
        'use strict';

        var init = function () {                

            var slider2 = new rSlider({
                target: '#slider2',
                values: ['1~3년', '3~6년', '6~9년', '9~12년', '12~15년+'],
                range: false,
                set: ['1~3년'],
                tooltip: true,
                onChange: function(vals) {
                    console.log(vals);
                    switch(vals){
                        case '1~3년':
                            $('input[name=career]').val(1);
                            break;
                        case '3~6년':
                            $('input[name=career]').val(2);
                            break;
                        case '6~9년':
                            $('input[name=career]').val(3);
                            break;
                        case '9~12년':
                            $('input[name=career]').val(4);
                            break;
                        case '12~15년+':
                            $('input[name=career]').val(5);
                            break;
                    }
                }
            });
        };
        window.onload = init;
    })();
</script>
    
<!-- 생년월일 script -->
<script>
    new Rolldate({
        el: '#date_picker',
        format: 'YYYY-MM-DD',
        beginYear: 1970,
        endYear: 2003,
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