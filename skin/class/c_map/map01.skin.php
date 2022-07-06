<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>
<!-- 지도  -->
<div class="s_content mt16">
    <div class="map_tit">
        <p>용산구</p> <span>주변 모임</span>
    </div>
    <div class="map_btn">
        <button onclick="$('#metfilter').addClass('on')">모든 분야의 모임</button>
        <button onclick="$('#calendar').addClass('on')">날짜 선택</button>
        <button onclick="$('#s_filter').addClass('on')">필터</button>
    </div>
</div>

<?php for($i=0;$row=sql_fetch_array($query);$i++) { ?>
    <input type="hidden" value="<?php echo $row['as_thumb']?>" class="hidden_img" />
    <input type="hidden" value="<?php echo $row['wr_subject']?>" class="hidden_subject" />
    <input type="hidden" value="<?php echo $row['moa_addr1'] ?>" class="hidden_area" />
<?php } ?>

<!-- 지도 부분 -->
<div class="map_area"id="map_area">
</div>

<script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=7f658734584879ca284ed00f717e81a1&libraries=services"></script>
<script>
    var container = document.getElementById('map_area'); //지도를 담을 영역의 DOM 레퍼런스

    // 지도 확대 축소를 제어할 수 있는  줌 컨트롤을 생성합니다
    var zoomControl = new kakao.maps.ZoomControl();
    var geocoder = new kakao.maps.services.Geocoder();
    var options = { //지도를 생성할 때 필요한 기본 옵션
        center: new kakao.maps.LatLng(37.4910941147932, 127.074163955752), //지도의 중심좌표.
        level: 10 //지도의 레벨(확대, 축소 정도)
    };

    var map = new kakao.maps.Map(container, options); //지도 생성 및 객체 리턴
    map.addControl(zoomControl, kakao.maps.ControlPosition.RIGHT);

    var content = [];
    if($('.hidden_area').length > 0) {
        for(var j=0; j< $('.hidden_area').length; j++ ) {
            var point = $('.hidden_area').eq(j).val();
            var imageSrc = $('.hidden_img').eq(j).val();
            var subject = $('.hidden_subject').eq(j).val();
            var overlay = new kakao.maps.CustomOverlay({
                content: '<div class="wrap">' +
                    '    <div class="info">' +
                    '        <div class="title">' + subject +
                    '           <div class="close" onclick="overlay.setMap(null);" title="닫기">X</div>' +
                    '        </div>' +
                    '        <div class="body">' +
                    '            <div class="img">' +
                    '                <img src="'+ imageSrc +'" width="73" height="70">' +
                    '           </div>' +
                    '            <div class="desc">' +
                    '                <div class="ellipsis">'+ point +'</div>' +
                    '            </div>' +
                    '        </div>' +
                    '    </div>' +
                    '</div>',
                position: new kakao.maps.LatLng(37.49887, 127.026581)
            })
            geocoder.addressSearch("'" + point + "'", function (result, status) {
                console.log(result);
                if (status === kakao.maps.services.Status.OK) {

                    var coords = new kakao.maps.LatLng(result[0].y, result[0].x);

                    // 결과값으로 받은 위치를 마커로 표시합니다
                    var marker = new kakao.maps.Marker({
                        map: map,
                        position: coords
                    });
                }
                kakao.maps.event.addListener(marker, 'click', function() {
                    overlay.setMap(map);
                });
            });

        }
    }

</script>

<!-- 날짜 팝업 -->
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
</div>

<!--필터 팝업-->
<div class="s_filter_pop" id="s_filter">
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

<!--분야 팝업-->
<div class="s_filter_pop" id="metfilter">
    <div class="layerBody">
        <div class="confirm">
            <div class="">
                <div class="close_box">
                    <button class="close_b" onclick="$('#metfilter').removeClass('on')"><img src="../images/close_b.svg" alt=""> </button><span>분야 설정</span>
                </div>
                <div class="map_check">
                    <ul>
                        <li>
                            <input type="checkbox" id="box_00">
                            <label for="box_00">모든 분야의 모임</label>
                        </li>
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
                <div class="pop_btn">
                    <button class="gy" onclick="$('#metfilter').removeClass('on')">필터초기화</button>
                    <button class="gn" onclick="$('#metfilter').removeClass('on')">적용하기</button>
                </div>
            </div>
        </div>
    </div>
</div>