<?php
include_once("./_common.php");

$word = $_POST['word'] ? $_POST['word'] : '';

$search = "select se_id from deb_word_search where search_word = '{$word}' and mb_id = '{$member['mb_id']}'";
$result = sql_fetch($search);

if(!$result['se_id']) {
    $sql = " insert into deb_word_search (mb_id, search_word, search_date) values ('{$member['mb_id']}', '{$word}', '" . date('Y-m-d H:i:s') . "')";
    $query = sql_query($sql);
} else {
    $sql = "update deb_word_search set search_date = '" . date('Y-m-d H:i:s') . "' where se_id = '{$result['se_id']}'";
    $query = sql_query($sql);
}

