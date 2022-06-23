<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>

<!-- 당일 수강 가능 클래스 리스트 -->
<div class="day_banner">
    <img src="../images/day_text.svg" alt="">
    <div><span><?php echo date('m월 d일'); ?> 당일 수강 가능한 클래스</span></div>
</div>
<div class="other_class">
    <p>다른 날짜의 모임 추천이 필요하신가요?</p>
</div>

<div class="s_content mt25 mb20">
    <div class="cla_cho">
        <button class="date_box" onclick="$('#calendar').addClass('on')"><?php echo date('m월 d일', strtotime($date)); ?></button>
    </div>
</div>

<div class="calendar_pop" id="calendar">
    <div class="layerBody">
        <div class="confirm">
            <div class="mentBox">
                <div class="close_box">
                    <button class="close_b" onclick="$('#calendar').removeClass('on')"><img src="../images/close_b.svg" alt=""></button><span>날짜선택</span>
                </div>
                <div id="myID"></div>
                <script>
                    flatpickr("#myID", {
                        inline: true,
                        "locale": "ko",
                        dateFormat: 'm월 d일',
                        altInput: true,
                        onChange: function(selDate, dateStr, instance) {
                            $('.date_box').text(dateStr);
                            $('#calendar').removeClass('on');
                            var date = new Date(selDate);
                            location.href = '/c_detail/d_today.php?date=' + date.getFullYear() + '/' + (date.getMonth() + 1) + '/' + date.getDate();
                        }
                    });
                </script>
            </div>
        </div>
    </div>
</div>