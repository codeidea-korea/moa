<?php
$name=isset($_GET['name'])?$_GET['name']:"";

$_GET['slf'] = "wr_subject";
$_GET['stx'] = $name;
$_GET['bo_table'] = "teachers";

include_once('./_common.php');
@extract($_GET);
//$board = sql_fetch(" select * from {$g5['board_table']} where bo_table = '$bo_table' ");
include_once(G5_PATH."/bbs/board.php");
