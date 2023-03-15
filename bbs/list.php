<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 분류 사용 여부
$is_category = false;
$category_option = '';
if ($board['bo_use_category']) {
    $is_category = true;
    $category_href = G5_BBS_URL.'/board.php?bo_table='.$bo_table;

    $category_option .= '<li><a href="'.$category_href.'"';
    if ($sca=='')
        $category_option .= ' id="bo_cate_on"';
    $category_option .= '>전체</a></li>';

    $categories = explode('|', $board['bo_category_list']); // 구분자가 , 로 되어 있음
    for ($i=0; $i<count($categories); $i++) {
        $category = trim($categories[$i]);
        if ($category=='') continue;
        $category_option .= '<li><a href="'.($category_href."&amp;sca=".urlencode($category)).'"';
        $category_msg = '';
        if ($category==$sca) { // 현재 선택된 카테고리라면
            $category_option .= ' id="bo_cate_on"';
            $category_msg = '<span class="sound_only">열린 분류 </span>';
        }
        $category_option .= '>'.$category_msg.$category.'</a></li>';
    }
}

$sop = strtolower($sop);
if ($sop != 'and' && $sop != 'or')
    $sop = 'and';

// 분류 선택 또는 검색어가 있다면
$stx = trim($stx);
$stx = addslashes($stx);
$stx = htmlspecialchars($stx);

//검색인지 아닌지 구분하는 변수 초기화
$is_search_bbs = false;

// 2022.08.21. botbinoo, 일자 검색, 정렬, 회차 조건 추가
/*
$searchTime = $_POST['searchTime'];
$composition = $_POST['composition'];
$sequence = $_POST['sequence'];
*/
if($bo_table == 'class') {
    
    $where = "";
    $having = "";
    $orderBy = "";
    // g5_write_class + 모임정보 + 모임상세일정(스케쥴) + 댓글
    $qstr = $qstr . "&searchTime=" . $searchTime . "&composition=" . $composition . "&sequence=" . $sequence;
    if(isset($searchTime) && $searchTime != '') {
        $searchTimes = explode( ' ~ ', $searchTime );
        $startedAt = $searchTimes[0];
        $endedAt = $searchTimes[1];
        // 모임 기간이 포함된 경우만 조회
        $where = $where . " and item.day between '{$startedAt}' and '{$endedAt}' ";
    }

    $moa_onoff = $_REQUEST['moa_onoff'];
    if($moa_onoff){
        $where = $where . " and moa_onoff = '" . $moa_onoff . "' ";
    }
    $moa_addr1 = $_REQUEST['area'];
    if(isset($moa_addr1) && $moa_addr1 != '지역선택'){
        if(mb_strpos($moa_addr1, "_") > 0){
            $moa_addr1 = mb_substr($moa_addr1, mb_strpos($moa_addr1, "_") + 1, NULL, "UTF-8");
        }
        if(mb_strpos($moa_addr1, "/") > 0){
            $moa_addrs = explode("/", $moa_addr1);
    
            $where = $where . " and ( ";
            for($inx = 0; $inx < count($moa_addrs); $inx++){
                $where = $where . " moa_addr1 like '%" . $moa_addrs[$inx] . "%' " . ($inx+1 < count($moa_addrs) ? ' or ' : '');
            }
            $where = $where . " ) ";
        } else {
            $where = $where . " and moa_addr1 like '%" . $moa_addr1 . "%' ";
        }
    }

    if(isset($composition) && $composition != '') {
        // 구성 갯수로 판단하여 조회
        switch($composition){
            case '1':
                $having = $having . " having count(*) = 1 ";
                break;
            case 'n':
                $having = $having . " having count(*) > 1 ";
                break;
            case 'all':
            default: break;
        }
    }

    if(isset($sequence) && $sequence != '') {
        switch($sequence){
            case 'recent':
                $orderBy = $orderBy . " order by wr_datetime desc  ";
                break;
            case 'popular':
    //            $orderBy = $orderBy . " order by count(o.idx) desc  ";
                break;
            case 'review':
                $orderBy = $orderBy . " order by cnt_reply desc  ";
                break;
            case 'lowcost':
                $orderBy = $orderBy . " order by it_price asc  ";
                break;
            case 'highcost':
                $orderBy = $orderBy . " order by it_price desc  ";
                break;
            default: break;
        }
    }
    $today = date("Y-m-d h:i:s", time());
    if($where != "" || $having != "" || $orderBy != ""){
        $write_table = "(
            select 
                class.*, reply.cnt_reply cnt_reply, shop.it_price it_price, item.day
            from g5_write_class as class
                join g5_shop_item as shop on shop.it_2 = class.wr_id
                join g5_shop_cart as cart on cart.it_id = shop.it_id
                join (select c.* from deb_class_item as c 
                    join g5_shop_item as i on i.it_id = c.it_id 
                    group by it_2 {$having}) as cnt_item on shop.it_id = cnt_item.it_id
                join deb_class_item as item on shop.it_id = item.it_id
                left join (select count(*) cnt_reply, it_id from g5_shop_item_use group by it_id) as reply on reply.it_id = shop.it_id
            where 1=1
                {$where} 
            and class.moa_form = '자율형' or (class.moa_form = '고정형' and DATE_FORMAT(CONCAT(item.day, ' ' , item.time, ':' , item.minute, ':00'), '%Y-%m-%d %h:%i:%s') >= '{$today}')
            group by class.wr_id)";
    } else if($bo_table == 'class'){
        $write_table = "(
            select 
                class.*, item.day, deb.first_day 
            from g5_write_class as class
                join g5_shop_item as shop on shop.it_2 = class.wr_id
                join deb_class_item as item on shop.it_id = item.it_id
                join (select wr_id, it_id, min(day),concat(day,' ',time,':',minute,':00') as first_day from deb_class_item group by wr_id) as deb on shop.it_id = deb.it_id 
            where 1=1
                {$where} 
            and class.moa_form = '자율형' or (class.moa_form = '고정형' and DATE_FORMAT(CONCAT(item.day, ' ' , item.time, ':' , item.minute, ':00'), '%Y-%m-%d %h:%i:%s') >= '{$today}')
            group by class.wr_id)";
    }
}
// end 2022.08.21. botbinoo, 일자 검색, 정렬, 회차 조건 추가

if ($sca || $stx || $stx === '0') {     //검색이면
    $is_search_bbs = true;      //검색구분변수 true 지정
    $sql_search = get_sql_search($sca, $sfl, $stx, $sop);

	// 가장 작은 번호를 얻어서 변수에 저장 (하단의 페이징에서 사용)
    $sql = " select MIN(wr_num) as min_wr_num from {$write_table} ";
    $row = sql_fetch($sql);
    $min_spt = (int)$row['min_wr_num'];

    if (!$spt) $spt = $min_spt;

    $sql_search .= " and (wr_num between {$spt} and ({$spt} + {$config['cf_search_part']})) ";
    if($bo_table == 'class') { $sql_search .= " and (moa_status = 1) "; }

	if($sql_apms_where) $sql_search .= $sql_apms_where;

    // 원글만 얻는다. (코멘트의 내용도 검색하기 위함)
    // 라엘님 제안 코드로 대체 http://sir.kr/g5_bug/2922
    $sql = " SELECT COUNT(DISTINCT `wr_parent`) AS `cnt` FROM {$write_table} as l WHERE {$sql_search} ";
    $row = sql_fetch($sql);
    $total_count = $row['cnt'];
    /*
    $sql = " select distinct wr_parent from {$write_table} where {$sql_search} ";
    $result = sql_query($sql);
    $total_count = sql_num_rows($result);
    */
} else {
    $sql_search = "(1)";
    if($bo_table == 'class') { $sql_search .= " and (moa_status = 1)"; }
    $sql = " SELECT COUNT(DISTINCT `wr_parent`) AS `cnt` FROM {$write_table} as l WHERE {$sql_search}";
    $row = sql_fetch($sql);
    $total_count = $row['cnt'];
}
if($bo_table == 'class') { 
    $where = '';
    if ($sca) {
        $where .= " and a.ca_name = '{$sca}' ";
    }
    if ($stx) {
        $where .= " and a.wr_subject like '%{$stx}%' ";
    }
    $sql = " select count(*) as cnt from {$write_table} a where a.wr_is_comment = 0 {$where} and a.moa_status = 1 ";
    $row = sql_fetch($sql);
    $total_count = $row['cnt'];
    $where = "";
}


if(G5_IS_MOBILE) {
    $page_rows = $board['bo_mobile_page_rows'];
    $list_page_rows = $board['bo_mobile_page_rows'];
} else {
    $page_rows = $board['bo_page_rows'];
    $list_page_rows = $board['bo_page_rows'];
}

if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)

// 년도 2자리
$today2 = G5_TIME_YMD;

$list = array();
$i = 0;
$notice_count = 0;
$notice_array = array();

// 공지 처리
$arr_notice = explode(',', trim($board['bo_notice']));
if (!$stx) {
    $from_notice_idx = ($page - 1) * $page_rows;
    if($from_notice_idx < 0)
        $from_notice_idx = 0;
    $board_notice_count = count($arr_notice);

    for ($k=0; $k<$board_notice_count; $k++) {
        if (trim($arr_notice[$k]) == '') continue;

        $row = sql_fetch(" select * from {$write_table} a where wr_id = '{$arr_notice[$k]}' ");

        if (!$row['wr_id']) continue;

		// 분류일 때
		if($sca) {
			if($row['ca_name'] != '공지' && $sca != $row['ca_name']) continue;
		}

		$notice_array[] = $row['wr_id'];

        if($k < $from_notice_idx) continue;

        $list[$i] = get_list($row, $board, $board_skin_url, G5_IS_MOBILE ? $board['bo_mobile_subject_len'] : $board['bo_subject_len']);
        $list[$i]['is_notice'] = true;

        $i++;
        $notice_count++;

        if($notice_count >= $list_page_rows)
            break;
    }
}
// 2022.08.25. botbinoo, 공지사항 테이블은 사용하지 않고, 각 카테고리에서 관리자가 옵션으로 [공지]를 선택할 경우도 공지로 표현되도록 수정
if($bo_table == 'community'){
    
    $list = array();
    $notice_count = 0;
    $notice_array = array();

    $board_notice_count = count($arr_notice);
    $i = 0;

    for ($k=0; $k<$board_notice_count; $k++) {
        if (trim($arr_notice[$k]) == '') continue;

        $row = sql_fetch(" select * from {$write_table} where wr_id = '{$arr_notice[$k]}' order by wr_last desc ");

//		$notice_array[] = $row['wr_id'];
        $list[$i] = $row;
        // subject
        $list[$i]['is_notice'] = true;
        $list[$i]['subject'] = $row['wr_subject'];
//        $list[$i]['link_href'] = $row['link_href'];
        $list[$i]['name'] = $row['wr_name'];
        $list[$i]['photo'] = $row['photo'];
        $list[$i]['mb_id'] = $row['mb_id'];
        $list[$i]['date'] = strtotime($row['wr_datetime']);
        $list[$i]['ca_name'] = $row['ca_name'];
        $list[$i]['wr_good'] = $row['wr_good'];
        $list[$i]['content'] = $row['wr_content'];
        $list[$i]['wr_comment'] = $row['wr_comment'];
        $list[$i]['wr_link1'] = $row['wr_link1'];
        $list[$i]['href'] = '/bbs/board.php?bo_table=community&wr_id=' . $row['wr_id'];
        

        $i++;
    }
    
    $mb_id = $member['mb_id'];
}
// end 2022.08.25. botbinoo, 공지사항 테이블은 사용하지 않고, 각 카테고리에서 관리자가 옵션으로 [공지]를 선택할 경우도 공지로 표현되도록 수정

$total_page  = ceil($total_count / $page_rows);  // 전체 페이지 계산
$from_record = ($page - 1) * $page_rows; // 시작 열을 구함

// 공지글이 있으면 변수에 반영
if(!empty($notice_array)) {
    //$from_record -= count($notice_array);

    if($from_record < 0)
        $from_record = 0;

    //if($notice_count > 0)
        //$page_rows -= $notice_count;

    if($page_rows < 0)
        $page_rows = $list_page_rows;
}

// 관리자라면 CheckBox 보임
$is_checkbox = false;
if ($is_admin)
    $is_checkbox = true;

// 정렬에 사용하는 QUERY_STRING
$qstr2 = 'bo_table='.$bo_table.'&amp;sop='.$sop.'&amp;'.$qstr;
if($sca) $qstr2 .= '&amp;sca='.urlencode($sca);

// 0 으로 나눌시 오류를 방지하기 위하여 값이 없으면 1 로 설정
$bo_gallery_cols = $board['bo_gallery_cols'] ? $board['bo_gallery_cols'] : 1;
$td_width = (int)(100 / $bo_gallery_cols);

// 정렬
// 인덱스 필드가 아니면 정렬에 사용하지 않음
//if (!$sst || ($sst && !(strstr($sst, 'wr_id') || strstr($sst, "wr_datetime")))) {
if (!$sst) {
    if ($board['bo_sort_field']) {
        $sst = $board['bo_sort_field'];
    } else {
        $sst  = "wr_num, wr_reply";
        $sod = "";
    }
} else {
    // 게시물 리스트의 정렬 대상 필드가 아니라면 공백으로 (nasca 님 09.06.16)
    // 리스트에서 다른 필드로 정렬을 하려면 아래의 코드에 해당 필드를 추가하세요.
    // $sst = preg_match("/^(wr_subject|wr_datetime|wr_hit|wr_good|wr_nogood)$/i", $sst) ? $sst : "";
    $sst = preg_match("/^(wr_datetime|wr_hit|wr_good|wr_nogood|wr_comment|as_view|as_down|as_download|as_poll|as_update|wr_link1_hit|wr_link2_hit)$/i", $sst) ? $sst : "";
}

if(!$sst)
    $sst  = "wr_num, wr_reply";

if ($sst) {
    $sql_order = " order by {$sql_apms_orderby} {$sst} {$sod} ";
}
if($orderBy != "") {
    $sql_order = $orderBy;
}

if ($is_search_bbs) {
    if($bo_table == 'class') { $sql_search .= " and (moa_status = 1) "; }
    $sql = " select distinct wr_parent from {$write_table} where {$sql_search} {$sql_order} limit {$from_record}, $page_rows ";
} else {
    $sql = " select * from {$write_table} a where wr_is_comment = 0 {$sql_apms_where} ";
    if($bo_table == 'class') { $sql .= " and (moa_status = 1) "; }
    if(!$is_notice_list && $notice_count)
        $sql .= " and wr_id not in (".implode(', ', $arr_notice).")";
    $sql .= " {$sql_order} limit {$from_record}, $page_rows ";
}

if($bo_table == 'class') { 
    $where = '';
    if ($sca) {
        $where .= " and a.ca_name = '{$sca}' ";
    }
    if ($stx) {
        $where .= " and a.wr_subject like '%{$stx}%' ";
    }
    $sql = " select * from {$write_table} a where 1=1 {$where} and a.moa_status = 1 {$sql_order} limit {$from_record}, $page_rows ";
}

// 페이지의 공지개수가 목록수 보다 작을 때만 실행
$k = 0;
if($page_rows > 0) {
    $result = sql_query($sql);
    if ($member['mb_no']=="58") { print_r2($sql); }
    while ($row = sql_fetch_array($result))
    {
        // 검색일 경우 wr_id만 얻었으므로 다시 한행을 얻는다
        if ($sca || $stx)
            $row = sql_fetch(" select * from {$write_table} a where wr_id = '{$row['wr_parent']}' ");

        $list[$i] = get_list($row, $board, $board_skin_url, G5_IS_MOBILE ? $board['bo_mobile_subject_len'] : $board['bo_subject_len']);
        if (strstr($sfl, 'subject')) {
            $list[$i]['subject'] = search_font($stx, $list[$i]['subject']);
        }
        $list[$i]['is_notice'] = false;
        $list_num = $total_count - ($page - 1) * $list_page_rows;
        $list[$i]['num'] = $list_num - $k;

        $i++;
        $k++;
    }
}

$is_list = ($k) ? true : false;

$write_pages = get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, './board.php?bo_table='.$bo_table.$qstr.'&amp;page=');

$list_href = '';
$prev_part_href = '';
$next_part_href = '';
if ($is_search_bbs) {
    $list_href = './board.php?bo_table='.$bo_table;

    $patterns = array('#&amp;page=[0-9]*#', '#&amp;spt=[0-9\-]*#');

    //if ($prev_spt >= $min_spt)
    $prev_spt = $spt - $config['cf_search_part'];
    if (isset($min_spt) && $prev_spt >= $min_spt) {
        $qstr1 = preg_replace($patterns, '', $qstr);
        $prev_part_href = './board.php?bo_table='.$bo_table.$qstr1.'&amp;spt='.$prev_spt.'&amp;page=1';
        $write_pages = page_insertbefore($write_pages, '<a href="'.$prev_part_href.'" class="pg_page pg_prev">이전검색</a>');
    }

    $next_spt = $spt + $config['cf_search_part'];
    if ($next_spt < 0) {
        $qstr1 = preg_replace($patterns, '', $qstr);
        $next_part_href = './board.php?bo_table='.$bo_table.$qstr1.'&amp;spt='.$next_spt.'&amp;page=1';
        $write_pages = page_insertafter($write_pages, '<a href="'.$next_part_href.'" class="pg_page pg_end">다음검색</a>');
    }
}

$write_href = '';
if ($member['mb_level'] >= $board['bo_write_level']) {
    $write_href = './write.php?bo_table='.$bo_table;
}

$nobr_begin = $nobr_end = "";
if (preg_match("/gecko|firefox/i", $_SERVER['HTTP_USER_AGENT'])) {
    $nobr_begin = '<nobr>';
    $nobr_end   = '</nobr>';
}

// RSS 보기 사용에 체크가 되어 있어야 RSS 보기 가능 061106
$rss_href = '';
if ($board['bo_use_rss_view']) {
    $rss_href = './rss.php?bo_table='.$bo_table;
}

$stx = get_text(stripslashes($stx));

include_once($board_skin_path.'/list.skin.php');
?>
