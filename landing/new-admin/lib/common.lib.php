<?php

//파일명 뒤에 최근 수정일 붙이기
function get_url($url ) {
	$url .= "?ver=".date("Ymdhis",filemtime($url)); 
    return $url;
}
