<?php
include_once('./_common.php');


if (isset($_REQUEST['moa_onoff'])) { // 온오프
    $moa_onoff = clean_xss_tags(trim($_REQUEST['moa_onoff']));
    if ($moa_onoff)
        $qstr .= '&amp;moa_onoff=' . urlencode($moa_onoff);
} else {
    $moa_onoff = '';
}

if (isset($_REQUEST['moa_area1'])) { // 온오프
    $moa_area1 = clean_xss_tags(trim($_REQUEST['moa_area1']));
    if ($moa_area1)
        $qstr .= '&amp;moa_area1=' . urlencode($moa_area1);
} else {
    $moa_area1 = '';
}

if (isset($_REQUEST['moa_area2'])) { // 온오프
    $moa_area2 = clean_xss_tags(trim($_REQUEST['moa_area2']));
    if ($moa_area2)
        $qstr .= '&amp;moa_area2=' . urlencode($moa_area2);
} else {
    $moa_area2 = '';
}