<?php
include_once('./_common.php');
define('_INDEX_', true);

if(!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가



$strSql = "select * from g5_write_class where wr_id>10 ";
$result = sql_query($strSql);
while ($row = sql_fetch_array($result)) {


    $subSql = "select it_img1, it_img2, it_img3 from g5_shop_item where it_2='".$row['wr_id']."' order by it_id asc limit  0, 1";
    $subRow = sql_fetch($subSql);

    $tmpi = "";
    $arr1 = explode('/', $subRow['it_img1']);
    if ($arr1[1] != ""){
        $tmpi = $arr1[1];
    }else{
        $arr2 = explode('/', $subRow['it_img2']);
        if ($arr2[1] != ""){
            $tmpi = $arr2[1];
        }else{
            $arr3 = explode('/', $subRow['it_img3']);
            if ($arr3[1] != ""){
                $tmpi = $arr3[1];
            }else{
                $tmpi = "";
            }
        }
    }

    $url = 'https://www.moa-friends.com/data/file/class/'.$tmpi;

    $sql = "update g5_write_class set as_thumb='".$url."' where wr_id=".$row['wr_id'];
    //sql_query($sql);
}
?>
