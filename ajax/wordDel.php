<?php
include_once("./_common.php");

$all = $_POST['all'] ? $_POST['all'] : '';

if($all) {
    $search = "delete from deb_word_search where mb_id = '{$member['mb_id']}'";
    $result = sql_query($search);
}
