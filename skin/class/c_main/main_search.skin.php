<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>
<!-- 메인 검색 -->
<section class="s_content">
    <div class="m_search main_search">
        <div class="search_input">
            <input type="text" value="<?php echo $word; ?>" id="search_word" placeholder="클래스를 검색하세요">
        </div>
        <button type="button" id="search_btn">검색</button>
    </div>
    <div class="search_area">
        <div class="com_tit sa_tit">
            <p>최근검색어</p>
            <button class="all_delete">모두 지우기</button>
        </div>
        <ul class="sa_list">
            <?php
                $words = "select * from deb_word_search where mb_id = '{$member['mb_id']}' order by search_date desc";
                $result = sql_query($words);
                while($row = sql_fetch_array($result)) {
            ?>
                <li>
                    <button class="search_word" onclick="location.href='?word=<?php echo $row['search_word']; ?>'"><?php echo $row['search_word']; ?></button>
                </li>
            <?php } ?>
        </ul>
    </div>
    <div class="pplrtSrch">
        <div class="d_tit cr">
            인기 검색어
        </div>
        <ol>
            <?php
                $famous = "select search_word, count(*) cnt from deb_word_search group by search_word order by cnt desc";
                $famous_word = sql_query($famous);
                $i = 1;
                while($row2 = sql_fetch_array($famous_word)) {
            ?>
                    <li><?php echo $i; ?>.<button type="button" class="search_word"><?php echo $row2['search_word']; ?></button></li>
            <?php $i++; } ?>
        </ol>
    </div>
</section>

<!-- 검색 리스트 검색 후 -->
<section class="srchVlm s_content">
    <p>총 <?php echo count($list); ?>개</p>
    <!-- <div style="display:none;">
        <button onclick="$('#calendar').addClass('on')">날짜</button>
        <button onclick="$('#s_filter').addClass('on')">필터</button>
    </div>  -->
</section>

<!-- 검색 리스트 날짜 팝업 -->
<!-- <div class="calendar_pop" id="calendar" style="display:none;">
    <div class="layerBody">
        <div class="confirm">
            <div class="mentBox">
                <div class="close_box">
                    <button class="close_b" onclick="$('#calendar').removeClass('on')"><img src="../images/close_b.svg" alt=""></button><span>날짜선택</span>
                </div>
                <div id="myID"></div>
                <script>
                    flatpickr("#myID", {
                        mode: "range",
                        inline: true,
                        "locale": "ko",
                        disableMobile: "true"
                    });
                </script>
                <div class="c_btn">
                    <button class="inactive on" onclick="$('#calendar').removeClass('on')">1월 24일 - 1월 26일</button>
                </div>
            </div>
        </div>
    </div>
</div> -->

<!-- 검색 리스트 필터 팝업 -->
<div class="s_filter_pop" id="s_filter" style="display:none;">
    <div class="layerBody">
        <div class="confirm">
            <div class="mentBox">
                <div class="close_box">
                    <button class="close_b" onclick="$('#s_filter').removeClass('on')"><img src="../images/close_b.svg" alt=""> </button><span>필터</span>
                </div>
                <span class="s_tit">정렬</span>
                <div class="lounchecL s_filter_radio">
                    <input type="radio" id="box_1" name="sequence">
                    <label for="box_1">최신순</label>
                    <input type="radio" id="box_2" name="sequence">
                    <label for="box_2">인기순</label>
                    <input type="radio" id="box_3" name="sequence">
                    <label for="box_3">리뷰순</label>
                    <input type="radio" id="box_4" name="sequence">
                    <label for="box_4">가격 낮은순</label>
                    <input type="radio" id="box5" name="sequence">
                    <label for="box5">가격 높은순</label>
                </div>
                <div class="lounchecL s_filter_radio line">
                    <input type="radio" id="box_6" name="composition">
                    <label for="box_6">1회 구성만 보기</label>
                    <input type="radio" id="box_7" name="composition">
                    <label for="box_7">N회 구성만 보기</label>
                    <input type="radio" id="box_8" name="composition">
                    <label for="box_8">전체 보기</label>
                </div>
                <div class="pop_btn">
                    <button class="gy" onclick="$('#s_filter').removeClass('on')">필터초기화</button>
                    <button class="gn" onclick="$('#s_filter').removeClass('on')">적용하기</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function ajax_word(word) {
        $.ajax({
            url: '/ajax/wordSearch.php',
            data: { 'word': word },
            type: "POST",
            success: function(data) {
                location.href = '/c_main/main_search.php?word=' + word;
            }
        })
    }
    $(document).ready(function(){
        $('#search_btn').on('click', function(){
            ajax_word($('#search_word').val());
        })

        $('.search_word').click(function(){
            ajax_word($(this).text());
        })

        $('.all_delete').click(function(){
            if(confirm('모두 지우시겠습니끼?')) {
                $.ajax({
                    url: '/ajax/wordDel.php',
                    data: {'all': 1},
                    type: "POST",
                    success: function (data) {
                        location.href = '/c_main/main_search.php';
                    }
                })
            } else {
                return false;
            }
        })
    })
</script>