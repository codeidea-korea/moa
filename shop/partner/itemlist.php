<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

//분류권한
$is_cauth = apms_is_cauth();

// 분류
$category = array();
$category_options  = '';
$sql = " select * from {$g5['g5_shop_category_table']} ";
if (!$is_cauth)
    $sql .= " where pt_use = '1' ";
$sql .= " order by ca_order, ca_id ";
$result = sql_query($sql);
for ($i=0; $row=sql_fetch_array($result); $i++) {
	$c = $row['ca_id'];
	$category[$c] = $row['ca_name'];

	$len = strlen($row['ca_id']) / 2 - 1;
    $nbsp = '';
    for ($i=0; $i<$len; $i++) {
        $nbsp .= '&nbsp;&nbsp;&nbsp;';
    }

	if($row['as_line']) {
		$category_options .= "<option value=\"\">".$nbsp."------------</option>\n";
	}

    $category_options .= '<option value="'.$row['ca_id'].'">'.$nbsp.$row['ca_name'].'</option>'.PHP_EOL;
}

$list = array();

//$sfl = '';
$where = " and ";
$sql_search = "";
if ($stx != "") {
	//$sfl = 'it_name';
    if ($sfl != "") {
        $sql_search .= " $where $sfl like '%$stx%' ";
        $where = " and ";
    }
    if ($save_stx != $stx)
        $page = 1;
}

if ($sch_moa_onoff) {
    $sql_search .= " $where c.moa_onoff = '{$sch_moa_onoff}' "; 
}
if ($sch_moa_form) {
    $sql_search .= " $where c.moa_form = '{$sch_moa_form}' "; 
}
if ($sch_status == "1" || $sch_status == "5") {
    $sql_search .= " and c.moa_status = '{$sch_status}' ";

}
$sql_outersearch = "";
if ($sch_startdt && $sch_enddt) {
    $stdt = str_replace("-","",$sch_startdt);
    $eddt = str_replace("-","",$sch_enddt);
    $sql_outersearch .= " $where d.day between '{$sch_startdt}' and '{$sch_enddt}' "; 
}
else if ($sch_startdt && !$sch_enddt) {
    $sql_outersearch .= " $where d.day between '{$sch_startdt}' "; 
}

if ($sca != "") {
    $sql_search .= " $where (a.ca_id like '$sca%' or a.ca_id2 like '$sca%' or a.ca_id3 like '$sca%') ";
}
$write_table = $g5['write_prefix'].'class';
$sql_common = " from {$g5['g5_shop_item_table']} a ,
                     {$g5['g5_shop_category_table']} b,
                     {$write_table} c
                right outer join deb_class_item d on ( d.wr_id = c.wr_id {$sql_outersearch} )
               where a.it_2 = c.wr_id
                and (a.ca_id = b.ca_id ";

// $sql_common .= " and (a.pt_id = '{$mb_id}' or a.it_brand = '{$member['mb_nick']}')";
// $mb_id = 'kakao_a6ff09e6';
$sql_common .= " and (c.mb_id = '{$mb_id}' or a.it_brand = '{$member['mb_nick']}')";
// $sql_common .= " and (c.mb_id = '{$mb_id}')";
$sql_common .= ") "; //and exists(select 'x' from  {$g5['g5_shop_item_table']} d where d.it_2 = a.it_2 order by it_id asc limit 1) ";
$sql_common .= $sql_search;

// 테이블의 전체 레코드수만 얻음
$sql = " select count(DISTINCT c.wr_id) as cnt " . $sql_common;
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_'.MOBILE_.'page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sql_order = "order by a.pt_show, a.pt_num desc, a.it_id desc";

$sql  = " SELECT distinct a.*, b.ca_name, c.*,  d.tot, d.min_tot, d.aply 
           $sql_common group by c.wr_id 
           $sql_order
           limit $from_record, $rows ";
// echo $sql;
$result = sql_query($sql);
for ($i=0; $row=sql_fetch_array($result); $i++) {
	$list[$i] = $row;
	$list[$i]['href'] = G5_SHOP_URL.'/item.php?it_id='.$row['it_id'];

	$c1 = $row['ca_id'];
	$c2 = ($row['ca_id2']) ? $row['ca_id2'] : substr($c1,0,4);
	$c3 = ($row['ca_id3']) ? $row['ca_id3'] : substr($c1,0,2);

	$list[$i]['ca_name1'] = $category[$c1];
	$list[$i]['ca_name2'] = $category[$c2];
	$list[$i]['ca_name3'] = $category[$c3];
}

// 페이징
$write_pages = (G5_IS_MOBILE) ? $config['cf_mobile_pages'] : $config['cf_write_pages'];
$list_page = './?ap='.$ap.'&amp;sca='.$sca.'&amp;save_stx='.$stx.'&amp;stx='.$stx.'&amp;page=';

echo '<script src="./script.js"></script>'.PHP_EOL;


$rday = getSearchDays();

include_once($skin_path.'/itemlist.skin.php');
?>



