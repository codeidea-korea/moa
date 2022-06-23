<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

$i = 1;

$sql = "select c.pt_company_name, b.* from g5_shop_item a, g5_member b, g5_apms_partner c
		where a.it_id = '{$it_id}'
		and a.pt_id = b.mb_id
		and a.pt_id = c.pt_id";
$minfo = sql_fetch($sql);
$juso = "";
if ($minfo['mb_addr1']) {
	$juso = $minfo['mb_addr1'];
}
?>

<div class="tbox-head no-line">
	<span class="red">◆</span>
	위치 정보
</div>
<?php 
//echo $minfo['mb_addr1']."<BR>"; 
//echo $juso."<BR>"; 
if ($minfo['pt_company_name'])
	$cname = $minfo['pt_company_name'];
else
	$cname = $minfo['mb_name'];
//if ($juso) {?>
    <style>
        .mapsview {
            max-width:1200px;
            width:100%;
            height:<?php echo (G5_IS_MOBILE)?'250':'450';?>px;
            text-align:center;
        }
    </style>
<div class="tbox-body">
	
<div id="map" class="mapsview"></div>
<script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=97c95cbb190fb8e4521df3ad25fa81ad&libraries=services"></script>
<script>
var mapContainer = document.getElementById('map'), // 지도를 표시할 div 
    mapOption = {
        center: new kakao.maps.LatLng(33.450701, 126.570667), // 지도의 중심좌표
        level: 3 // 지도의 확대 레벨
    };  

// 지도를 생성합니다    
var map = new kakao.maps.Map(mapContainer, mapOption); 

// 주소-좌표 변환 객체를 생성합니다
var geocoder = new kakao.maps.services.Geocoder();

// 주소로 좌표를 검색합니다
geocoder.addressSearch('<?php echo $juso?>', function(result, status) {

    // 정상적으로 검색이 완료됐으면 
     if (status === kakao.maps.services.Status.OK) {

        var coords = new kakao.maps.LatLng(result[0].y, result[0].x);

        // 결과값으로 받은 위치를 마커로 표시합니다
        var marker = new kakao.maps.Marker({
            map: map,
            position: coords
        });

        // 인포윈도우로 장소에 대한 설명을 표시합니다
        var infowindow = new kakao.maps.InfoWindow({
            content: '<div style="width:150px;text-align:center;padding:6px 0;"><?php echo $cname;?></div>'
        });
        infowindow.open(map, marker);

        // 지도의 중심을 결과값으로 받은 위치로 이동시킵니다
        map.setCenter(coords);
    } 
});    
</script>
</div>

<?php //} ?>