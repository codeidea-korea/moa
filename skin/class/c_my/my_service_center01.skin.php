<?php
include_once("./_common.php");

//헤더영역(공통파일)
include_once(CLASS_PATH."/header.php");

//main head(공통파일)
include_once(CLASS_PATH."/head.php");
?>

<div class="wrapper">
    <div class="content">
        <div class="tab_content p0 bt" id="host_content">
            <div class="t_list_area">
                <input type="checkbox" id="box1">
                <label for="box1" class="terms_list">dummy text</label>
                <section id="con01">
                    <div class="box_txt">
                        dummy text
                    </div>
                </section>

                <input type="checkbox" id="box2">
                <label for="box2" class="terms_list">dummy text</label>
                <section id="con02">
                    <div class="box_txt">
                        dummy text
                    </div>
                </section>

                <input type="checkbox" id="box3">
                <label for="box3" class="terms_list">dummy text</label>
                <section id="con03">
                    <div class="box_txt">
                        dummy text
                    </div>
                </section>

                <input type="checkbox" id="box4">
                <label for="box4" class="terms_list">dummy text</label>
                <section id="con04">
                    <div class="box_txt">
                        dummy text
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>
<?php

//푸터영역(공통파일)
include_once(CLASS_PATH."/footer.php");