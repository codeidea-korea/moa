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
        <!-- <button onclick="$('#s_filter').addClass('on')">필터</button> -->
    </div>
</div>

<?php for($i=0;$row=sql_fetch_array($query);$i++) { ?>
    <input type="hidden" value="<?php echo $row['as_thumb']?>" class="hidden_img" />
    <input type="hidden" value="<?php echo $row['wr_subject']?>" class="hidden_subject" />
    <input type="hidden" value="<?php echo $row['moa_addr1'] ?>" class="hidden_area" />
    <input type="hidden" value="<?php echo $row['it_id'] ?>" class="hidden_it_id" />
    <input type="hidden" value="<?php echo $row['moa_status'] ?>" class="hidden_moa_status" />
    <input type="hidden" value="" class="hidden_moa_latitude" />
    <input type="hidden" value="" class="hidden_moa_longitude" />
<?php } ?>

<form id="mapform" method="post" action="<?=$_SERVER['PHP_SELF']?>">
<input type="hidden" name="category_list" id="category_list" value="<?=$_REQUEST['category_list']?>">
<input type="hidden" name="scal_date" id="scal_date" value="<?=$_REQUEST['scal_date']?>">
</form>

<!-- 지도 부분 -->
<div class="map_area"id="map_area">
</div>

<script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=7f658734584879ca284ed00f717e81a1&libraries=services"></script>
<script>
    // 2022.08.24. botbinoo. 내 위치 정보 호출 설계
    function getMyPosition(){
        if(navigator && navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(pos) {
                const latitude = pos.coords.latitude;
                const longitude = pos.coords.longitude;
                console.log("현재 위치는 : " + latitude + ", "+ longitude);

                processingLocationData(pos);
            }, gpsError);
            return;
        } else if(window.ReactNativeWebView){
            // NOTICE: 리액트 웹뷰에서 position 을 요구한다.
            window.ReactNativeWebView.postMessage(
                JSON.stringify({ type: "GPS_INFO", dept: 'read' })
            );
        } else {
            alert('GPS 를 사용할 수 없습니다.');
        }
    }

    function gpsError(e){
        
        switch (e.code)
        {
            case e.PERMISSION_DENIED:
                alert("권한이 부족합니다.");
                break;
            case e.POSITION_UNAVAILABLE:
                alert("위치 정보를 사용할 수 없습니다.");
                break;
            case e.TIMEOUT:
                alert("연동 시간이 만료되었습니다.");
                break;
            case e.UNKNOWN_ERROR:
                alert("알 수 없는 오류입니다.");
                break;
            default:
                alert(e.message);
                break;
        }
        
        alert(e.message);
    }
    
    function processingLocationData(location){
        const latitude = !location || !location.coords || location.coords.latitude;
        const longitude = !location || !location.coords || location.coords.longitude;
        
        if(latitude === true || longitude === true) {
            alert('GPS 정보를 불러오는데 실패하였습니다.');
            return;
        }
        const latlng = new kakao.maps.LatLng(latitude, longitude);
        
        geocoder.coord2Address(latlng.getLng(), latlng.getLat(), function(result, status){
            if (status === kakao.maps.services.Status.OK) {
                $('.map_tit > p').text(result[0].address.address_name);
            }
        });

        const options = { //지도를 생성할 때 필요한 기본 옵션
            center: latlng, //지도의 중심좌표.
            level: 10 //지도의 레벨(확대, 축소 정도)
        };

        map.setCenter(latlng);
    }
    
    function receiveMsgFromParent( e ) {
        const response = JSON.parse(e.data);

        const type = response.type;
        if(!type) {
            console.log('송수신 : null');
            return false;
        }
        switch (type) {
            case 'GPS_INFO':
                if(! response.is_success) {
                    console.log('GPS 오류 발생 : ' + response.data);
                    alert('GPS 를 사용할 수 없습니다.');
                    return false;
                }

                const location = {
                    coords: {
                        latitude: response.data.latitude
                        , longitude: response.data.longitude
                    }
                };
                processingLocationData(location);
                break;
            default:
                return false;
        }
    }

    // 하나 애플, 하나는 안드 기종
    document.addEventListener( 'message', receiveMsgFromParent );
    window.addEventListener( 'message', receiveMsgFromParent );


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
    drawMap();

    /*
    var content = [];
    if($('.hidden_area').length > 0) {
        for(var j=0; j< $('.hidden_area').length; j++ ) {
            const point = $('.hidden_area').eq(j).val();
            const imageSrc = $('.hidden_img').eq(j).val();
            const subject = $('.hidden_subject').eq(j).val();
            const it_id = $('.hidden_it_id').eq(j).val();
            /*
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

        }
    }
    */

    var overlay = null;

    function openMarkerOverlay(idx, map){
        if(overlay != null){
            closeOverlay();
        }
        const point = $('.hidden_area').eq(idx).val();
        const imageSrc = $('.hidden_img').eq(idx).val();
        const subject = $('.hidden_subject').eq(idx).val();
        const it_id = $('.hidden_it_id').eq(idx).val();
        const latitude = $('.hidden_moa_latitude').eq(idx).val();
        const longitude = $('.hidden_moa_longitude').eq(idx).val();
        
                        
        overlay = new kakao.maps.CustomOverlay({
            content: '<div class="wrap location_map">' +
                '    <div class="info">' +
                '        <div class="close" onclick="overlay.setMap(null);" title="닫기"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M310.6 361.4c12.5 12.5 12.5 32.75 0 45.25C304.4 412.9 296.2 416 288 416s-16.38-3.125-22.62-9.375L160 301.3L54.63 406.6C48.38 412.9 40.19 416 32 416S15.63 412.9 9.375 406.6c-12.5-12.5-12.5-32.75 0-45.25l105.4-105.4L9.375 150.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0L160 210.8l105.4-105.4c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25l-105.4 105.4L310.6 361.4z"/></svg></div>' +
                '        <div class="body">' + 
                '            <a href=\'/shop/item.php?it_id='+it_id+'\' target="_blank">' +
                '               <div class="img">' +
                '                    <img src="'+ imageSrc +'" width="50" height="50">' +
                '               </div>' +
                '               <div class="title">' + subject +
                '               <div class="desc">' +
                '                 <div class="ellipsis">'+ point +'</div>' +
                '               </div>' +
                '               </a>' +
                '           </div>' +
                '        </div>' + 
                '    </div>' +
                '</div>',
            position: new kakao.maps.LatLng(latitude, longitude),
            map: map
        });
        overlay.setMap(map);
    }
    function closeOverlay() {
        overlay.setMap(null);
    }

    function drawMap(){
        if($('.hidden_area').length > 0) {
            for(var j=0; j< $('.hidden_area').length; j++ ) {
                const point = $('.hidden_area').eq(j).val();
                const imageSrc = $('.hidden_img').eq(j).val();
                const subject = $('.hidden_subject').eq(j).val();
                const it_id = $('.hidden_it_id').eq(j).val();
                
                const latitudeTag = $('.hidden_moa_latitude').eq(j);
                const longitudeTag = $('.hidden_moa_longitude').eq(j);
                const idx = j;

                geocoder.addressSearch("'" + point + "'", function (result, status) {
                    console.log(result);
                    if (status === kakao.maps.services.Status.OK) {

                        var coords = new kakao.maps.LatLng(result[0].y, result[0].x);

                        // 결과값으로 받은 위치를 마커로 표시합니다
                        var marker = new kakao.maps.Marker({
                            map: map,
                            position: coords
                        });

                        $(latitudeTag).val(result[0].y);
                        $(longitudeTag).val(result[0].x);

                        kakao.maps.event.addListener(marker, 'click', function(event) {
                            openMarkerOverlay(idx, map);
                        });
                    }
                });
            }
        }
    }
    $(document).ready(function(){
        getMyPosition();
    });

</script>



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
                            <input type="checkbox" id="box_00" value="all" class="chkall">
                            <label for="box_00">모든 분야의 모임</label>
                        </li>
                        <li>
                            <input type="checkbox" id="box_01" name="ca_name[]" value="액티비티" <?=(strpos($_REQUEST['category_list'], '액티비티') > -1)?'checked':''?>>
                            <label for="box_01">액티비티</label>
                            <input type="checkbox" id="box_02" name="ca_name[]" value="커리어" <?=(strpos($_REQUEST['category_list'], '커리어') > -1)?'checked':''?>>
                            <label for="box_02">커리어</label>
                        </li>
                        <li>
                            <input type="checkbox" id="box_03" name="ca_name[]" value="쿠킹/베이킹" <?=(strpos($_REQUEST['category_list'], '쿠킹/베이킹') > -1)?'checked':''?>>
                            <label for="box_03">쿠킹/베이킹</label>
                            <input type="checkbox" id="box_04" name="ca_name[]" value="소셜링" <?=(strpos($_REQUEST['category_list'], '소셜링') > -1)?'checked':''?>>
                            <label for="box_04">소셜링</label>
                        </li>
                        <li>
                            <input type="checkbox" id="box_05" name="ca_name[]" value="문화예술" <?=(strpos($_REQUEST['category_list'], '문화예술') > -1)?'checked':''?>>
                            <label for="box_05">문화예술</label>
                            <input type="checkbox" id="box_06" name="ca_name[]" value="힐링" <?=(strpos($_REQUEST['category_list'], '힐링') > -1)?'checked':''?>>
                            <label for="box_06">힐링</label>
                        </li>
                        <li>
                            <input type="checkbox" id="box_07" name="ca_name[]" value="뷰티" <?=(strpos($_REQUEST['category_list'], '뷰티') > -1)?'checked':''?>>
                            <label for="box_07">뷰티</label>
                            <input type="checkbox" id="box_08">
                            <label for="box_08">자기계발</label name="ca_name[]" value="자기계발" <?=(strpos($_REQUEST['category_list'], '자기계발') > -1)?'checked':''?>>
                        </li>
                    </ul>
                </div>
                <div class="pop_btn">
                    <button class="gy btnFilterReset">필터초기화</button>
                    <button class="gn btnApply">적용하기</button>
                </div>
            </div>
        </div>
    </div>
</div>

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
                        mode: "range", inline: true, "locale": "ko", disableMobile: "true", dateFormat: "Y-m-d", 
						<?php if ($_REQUEST['scal_date'] != ""){?>
							<?php if (strpos($_REQUEST['scal_date'], '~') > -1){?>
								<?php $arr_date = explode(' ~ ', $_REQUEST['scal_date']); ?>
								defaultDate: ["<?=$arr_date[0]?>", "<?=$arr_date[1]?>"], 
							<?php }else{?>
								defaultDate: ["<?=$_REQUEST['scal_date']?>"], 
							<?php }?>
						<?php }?>
						onChange: function(selectedDates, dateStr, instance) {
							$('#selected_cal_date').html(dateStr);
							$('#scal_date').val(dateStr);
						},
                    });
                </script>
                <div class="c_btn">
                    <button class="inactive on btnApply2" id="selected_cal_date"><?=($_REQUEST['scal_date'] != "") ? $_REQUEST['scal_date'] : '날짜를 선택해주세요.'?></button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(function(){
	$('.map_check').on("click", "input[type=checkbox]", function() {
		if ($(this).hasClass('chkall')){
			var checked = $(this).is(":checked");
			if(checked) {
				$(this).parent().parent().find('input[type="checkbox"]').prop("checked", true);
			} else {
				$(this).parent().parent().find('input[type="checkbox"]').prop("checked", false);
			}
		}else{
			if (!$(this).is(":checked")){
				$('.chkall').prop('checked', false);
			}
		}
	});

	$('.btnApply, .btnApply2').click(function(){
		if ($(this).hasClass('btnApply2')){
			if ($('#scal_date').val() == ""){ alert('날짜를 선택해주세요.'); return false; }
		}
		var arrCategory = [];
		$('.map_check input[name*=ca_name]').each(function() {
			console.log('111');
			if ($(this)[0].checked){
				if (!arrCategory.includes($(this).val())){
					arrCategory.push($(this).val());
					$('#category_list').val(arrCategory.join(","));
				}
			}
		});
		$('#metfilter').removeClass('on')
		$('#mapform').submit();
	});

	$('.btnFilterReset').click(function(){
		$('#category_list').val('');
		$('.map_check input[name*=ca_name]').each(function() {
			$(this)[0].checked = false;
		});
		$('#selected_cal_date').html('날짜를 선택해주세요.');
		$('#scal_date').val('');
		//$('#metfilter').removeClass('on')
	});
});
</script>