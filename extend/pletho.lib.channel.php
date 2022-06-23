<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가


$prt_path = false;

$_speedchk = false;

$g5['sponsor_table'] = G5_TABLE_PREFIX.'sponsor'; // 내용(컨텐츠)정보 테이블
$g5['charge_table'] = G5_TABLE_PREFIX.'charge'; // 내용(컨텐츠)정보 테이블

// 주문대상혹은 주문중인것을 제외하여 제고를 판단
function getAbleQty($it_id) {
	global $g5;
	
	$sql_common = "  from {$g5['g5_shop_item_table']} where it_id = '{$it_id}'";

	$sql  = " select it_id,
					 it_name,
					 it_use,
					 it_stock_qty,
					 it_stock_sms,
					 it_noti_qty,
					 it_soldout
			   $sql_common
			 ";
	$row = sql_fetch($sql);
	//echo "sql : ".$sql.";<br>";
	// 선택옵션이 있을 경우 주문대기 수량 계산하지 않음
	$sql2 = " select count(*) as cnt from {$g5['g5_shop_item_option_table']} where it_id = '{$it_id}' and io_type = '0' and io_use = '1' ";
	$row2 = sql_fetch($sql2);
	//echo "sql2 : ".$sql2.";<br>";
	if(!$row2['cnt']) {
		$sql1 = " select SUM(ct_qty) as sum_qty
					from {$g5['g5_shop_cart_table']}
				   where it_id = '{$row['it_id']}'
					 and ct_stock_use = '0'
					 and ct_status in ('포인트차감','주문', '입금', '준비') ";
					 // 쇼핑중인것은 포함하지 않음
	//echo "sql1 : ".$sql1.";<br>";					 
		$row1 = sql_fetch($sql1);
		$wait_qty = $row1['sum_qty'];
	}

	if (!$wait_qty) $wait_qty = 0;
	// 가재고 (미래재고)
	$temporary_qty = $row['it_stock_qty'] - $wait_qty;
	//echo "총재고 : ".$row['it_stock_qty']." , 주문,입금,준비 : ".$wait_qty."<br>";
	//exit;
	return $temporary_qty;
}



function getPoint($mb_id) {
	global $g5;
	$rtn = sql_fetch("select mb_point from g5_member where mb_id = '{$mb_id}' ");
	return (!$rtn['mb_point'])?0:$rtn['mb_point'];
}



// 한페이지에 보여줄 행, 현재페이지, 총페이지수, URL
function get_paging_id($write_pages, $cur_page, $total_page, $url, $id='',$add="")
{
	global $aslang;

	$str2 = "<style type='text/css'>";
	$str2 .=" .".$id."_pg_wrap {clear:both;margin:0 0 20px;padding:20px 0 0;text-align:center} ";
	$str2 .=".".$id."_pg {} ";
	$str2 .=".".$id."_pg_page, .".$id."_pg_current {display:inline-block;padding:0 8px;height:25px;color:#000;letter-spacing:0;line-height:2.2em;vertical-align:middle} ";
	$str2 .=".".$id."_pg a:focus, .".$id."_pg a:hover {text-decoration:none} ";
	$str2 .=".".$id."_pg_page {background:#e4eaec;text-decoration:none} ";
	$str2 .=".".$id."_pg_start, .".$id."_pg_prev {} ";
	$str2 .=".".$id."_pg_end, .".$id."pg_next {} ";
	$str2 .=".".$id."_pg_current {display:inline-block;margin:0 4px 0 0;background:#333;color:#fff;font-weight:normal} ";
	$str2 .="</style>";

	//$url = preg_replace('#&amp;page=[0-9]*(&amp;page=)$#', '$1', $url);
    $url = preg_replace('#&amp;page=[0-9]*#', '', $url) . '&amp;page=';

    $str = '';
    if ($cur_page > 1) {
        $str .= '<a href="'.$url.'1'.$add.'" class="'.$id.'_pg_page '.$id.'_pg_start">'.$aslang['pg_start'].'</a>'.PHP_EOL; //처음
    }

    $start_page = ( ( (int)( ($cur_page - 1 ) / $write_pages ) ) * $write_pages ) + 1;
    $end_page = $start_page + $write_pages - 1;

    if ($end_page >= $total_page) $end_page = $total_page;

    if ($start_page > 1) $str .= '<a href="'.$url.($start_page-1).$add.'" class="'.$id.'_pg_page '.$id.'_pg_prev">'.$aslang['pg_prev'].'</a>'.PHP_EOL; //이전

    if ($total_page > 1) {
        for ($k=$start_page;$k<=$end_page;$k++) {
            if ($cur_page != $k)
                $str .= '<a href="'.$url.$k.$add.'" class="'.$id.'_pg_page">'.$k.'<span class="sound_only">'.$aslang['pg_page'].'</span></a>'.PHP_EOL; //페이지
            else
                $str .= '<span class="sound_only">'.$aslang['pg_now'].'</span><strong class="'.$id.'_pg_current">'.$k.'</strong><span class="sound_only">'.$aslang['pg_page'].'</span>'.PHP_EOL; //현재 페이지
        }
    }

    if ($total_page > $end_page) $str .= '<a href="'.$url.($end_page+1).$add.'" class="'.$id.'_pg_page '.$id.'_pg_next">'.$aslang['pg_next'].'</a>'.PHP_EOL; //다음

    if ($cur_page < $total_page) {
        $str .= '<a href="'.$url.$total_page.$add.'" class="'.$id.'_pg_page '.$id.'_pg_end">'.$aslang['pg_end'].'</a>'.PHP_EOL; //맨끝
    }

    if ($str)
        return $str2."<nav class=\"".$id."_pg_wrap\"><span class=\"".$id."_pg\">{$str}</span></nav>";
    else
        return "";
}
/*

 
// schedule 을 wr_id기준으로 정지 
function setStopScheduleId($wr_id, $edate='') {
    global $g5, $member;
    //$row = getCheckSchedule();
    // 체크대상을 뽑아서 현재 진행중인것을 중지 
    if (!$edate)
        $enddate = " curdate() ";
    else
        $enddate = " '{$edate}' ";

    $sql = "update g5_write_schedule
            set wr_10 = if(curdate() >= date({$enddate}), '중지', '참여'), wr_2 = {$enddate}
            where wr_id = '{$wr_id}'
        ";
    //echo $sql."<BR>";
    try {
        $row = sql_query($sql);
        $rtn = true;
    }
    catch(Exception $e) {
        $rtn = false;
    }
    return $rtn;
}
*/
function getSqlCelebList($mb_id) {
	global $g5, $member;

	$sql = "select * from g5_board a
			where gr_id = 'category' ";
	$result = sql_query($sql);
	while ($row = sql_fetch_array($result))	{
		if ($sqls) $sqls .= " union all ";
		$sqls .= "select mb_id, '{$row['bo_table']}' botable, '{$row['bo_subject']}' bosub, count(*) cnt 
				from g5_write_".$row['bo_table']." where wr_is_comment = '0' group by mb_id ";
	}

	$sqlr = " from g5_member a, ({$sqls}) b where a.mb_id = b.mb_id and a.mb_id = '{$mb_id}' ";
	//$result = sql_query($sql);
	return $sqlr;
}

// 베스트게시물 생성하기 
function createBestContentList($to_day = " curdate() ")	{
	global $g5, $member;

	if ($to_day == " curdate() ")
		$sql = "select count(*) cnt from best_content_list where date = {$to_day} ";
	else
		$sql = "select count(*) cnt from best_content_list where date = '{$to_day}'' ";

	$row = sql_fetch($sql);
	if ($row > 0) 
		return;

	$sql = "select * from g5_board 
			where gr_id = 'category' ";
	$result = sql_query($sql);
	while ($row = sql_fetch_array($result))	{
		if ($sqls) $sqls .= " union all ";
		$sqls .= "select 
					'{$row['bo_table']}' botable, 
					'{$row['bo_subject']}' bosub, 
					a.wr_id, 
					a.wr_subject , 
					a.wr_hit , 
					a.wr_good  , 
					a.wr_nogood , 
					a.wr_datetime,
					a.mb_id,
					a.wr_1,
					a.wr_8,
					a.wr_9,
					a.wr_10,
					x.vi_date,
					x.vi_time 
			 from g5_write_".$row['bo_table']." a,
			 	  g5_visit x
			 where ( ";
		if ($to_day == " curdate() ")
			$sqls .= "     (datediff(x.vi_date, {$to_day}) = -1 and hour(x.vi_time) >= 7)
		 			    or (datediff(x.vi_date, {$to_day}) = 0 and hour(x.vi_time) < 7) ";
		else
			$sqls .= "     (datediff(x.vi_date, '{$to_day}') = -1 and hour(x.vi_time) >= 7)
			    			or (datediff(x.vi_date, '{$to_day}') = 0 and hour(x.vi_time) < 7) ";
		$sqls .= " )		
	 		    and x.bo_table <> ''
	 		    and x.wr_id <>'0'
			 	and a.wr_is_comment = '0' 
			 	and x.bo_table = '{$row['bo_table']}'
			 	and x.wr_id = a.wr_id 
			 ";
	}

	$sqlc = "select count(*) cnt from best_content_list limit 1";
	$rowc = sql_fetch($sqlc);

	if ($rowc['cnt'] < 1 )
		$sqlr = " CREATE TABLE IF NOT EXISTS best_content_list as ";
	else
		$sqlr = " insert into best_content_list  ";
	$sqlr .= "
				select 
				distinct 
				";
				if ($to_day == " curdate() ")
					$sqlr .= " {$to_day} date, ";
				else
					$sqlr .= " '{$to_day}' date, ";
	$sqlr .= "
				a.botable, 
				a.bosub, 
				a.wr_id, 
				a.wr_subject subject, 
				a.wr_hit hit,
				a.wr_good  good,
				a.wr_nogood nogood,
				a.wr_datetime datetime,
				a.mb_id,
				a.wr_1,
				a.wr_8,
				a.wr_9,
				a.wr_10
			  from ({$sqls}) a 
			  ";
	//echo $sqlr."<BR>";
	sql_query($sqlr);
	echo "create " .$to_day." best content complete ! <BR>";

	
}



//인기 기자 리스트 생성  
function createBestCelebList($to_day = " curdate() ")	{
	global $g5, $member;

	if ($to_day == " curdate() ")
		$sql = "select count(*) cnt from best_celeb_list where date = {$to_day} ";
	else
		$sql = "select count(*) cnt from best_celeb_list where date = '{$to_day}'' ";
	$row = sql_fetch($sql);
	if ($row > 0) 
		return;
	$sql = "select 
				a.bo_table, 
				a.bo_subject
		    from g5_board a
		    where 
	             a.gr_id = 'category' 
	        ";
	$result = sql_query($sql);
	while ($row = @sql_fetch_array($result))	{
		if ($sqls) $sqls .= " union all ";
		$sqls .= "select 
					'{$row['bo_table']}' botable, 
					'{$row['bo_subject']}' bosub, 
					a.wr_id, 
					a.wr_subject , 
					a.wr_hit , 
					a.wr_good  , 
					a.wr_nogood , 
					a.wr_datetime,
					a.mb_id,
					a.wr_1,
					a.wr_8,
					a.wr_9,
					a.wr_10,
					x.vi_date,
					x.vi_time 
			 from g5_write_".$row['bo_table']." a,
			 	  g5_member b,
			 	  g5_visit x

			 where ( ";
		if ($to_day == " curdate() ")
			$sqls .= "     (datediff(x.vi_date, {$to_day}) = -1 and hour(x.vi_time) >= 7)
		 			    or (datediff(x.vi_date, {$to_day}) = 0 and hour(x.vi_time) < 7)
		    				 ";
		else
			$sqls .= "     (datediff(x.vi_date, '{$to_day}') = -1 and hour(x.vi_time) >= 7)
			    			or (datediff(x.vi_date, '{$to_day}') = 0 and hour(x.vi_time) < 7)
		    				 ";
			$sqls .= "
				)
	 		    and x.bo_table <> ''
	 		    and x.wr_id <>'0'
			 	and a.wr_is_comment = '0' 
			 	and a.mb_id = b.mb_id
			 	and x.bo_table = '{$row['bo_table']}'
			 	and x.wr_id = a.wr_id 
			 ";

	}

	$sqlc = "select count(*) cnt from best_celeb_list limit 1";
	$rowc = sql_fetch($sqlc);

	if ($rowc['cnt'] < 1 )
		$sqlr = " CREATE TABLE IF NOT EXISTS best_celeb_list as ";
	else
		$sqlr = " insert into best_celeb_list  ";
	$sqlr .= "
				select 
				";
				if ($to_day == " curdate() ")
					$sqlr .= " {$to_day} date, ";
				else
					$sqlr .= " '{$to_day}' date, ";
	$sqlr .= "
	
				a.mb_id,
				count(a.vi_date) cnt,
				sum(a.wr_hit) hit,
				sum(a.wr_good)  good,
				sum(a.wr_nogood) nogood,
				sum(a.wr_1) wr_1,
				sum(a.wr_10) wr_10
			  from ({$sqls}) a 
			  group by a.mb_id
			  ";
	//if ($member['mb_id'] == 'pletho')	
	//echo $sqlr."<BR>";
	sql_query($sqlr);
	echo "create " .$to_day." best celeb complete ! <BR>";
	
}
 


//베스트 리스트 10 
function getBestListOld($limit = 10) {
	global $g5, $member;

	$sql = "select * from g5_board 
			where gr_id = 'category' ";
	$result = sql_query($sql);
	while ($row = sql_fetch_array($result))	{
		if ($sqls) $sqls .= " union all ";
		$sqls .= "select 
					'{$row['bo_table']}' botable, 
					'{$row['bo_subject']}' bosub, 
					a.wr_id, 
					a.wr_subject , 
					a.wr_hit , 
					a.wr_good  , 
					a.wr_nogood , 
					a.wr_datetime,
					a.mb_id,
					a.wr_1,
					a.wr_8,
					a.wr_9,
					a.wr_10,
					x.vi_date,
					x.vi_time 
			 from g5_write_".$row['bo_table']." a,
			 	  g5_visit x
			 where (
			 	    (datediff(x.vi_date, curdate()) = -1 and hour(x.vi_time) >= 7)
	 			    or (datediff(x.vi_date, curdate()) = 0 and hour(x.vi_time) < 7)
	 		    )
	 		    and x.bo_table <> ''
	 		    and x.wr_id <>'0'
			 	and a.wr_is_comment = '0' 
			 	and x.bo_table = '{$row['bo_table']}'
			 	and x.wr_id = a.wr_id 
			 ";
	}

	$list = array();
	$sqlr = " select 
				distinct 
				a.botable, 
				a.bosub, 
				a.wr_id, 
				a.wr_subject subject, 
				a.wr_hit hit,
				a.wr_good  good,
				a.wr_nogood nogood,
				a.wr_datetime datetime,
				a.mb_id,
				a.wr_1,
				a.wr_8,
				a.wr_9,
				a.wr_10
			  from ({$sqls}) a 
			  order by a.wr_hit desc 
			  limit {$limit} ";
	//if ($member['mb_id'] == 'pletho')	echo $sqlr."<BR>";
	$resultr = sql_query($sqlr,false);
	$i = 0;

	while ($rows = sql_fetch_array($resultr))	{
		$list[$i] = $rows;
		$i++;
	}
	return $list;
}

//베스트 리스트 10 
function getBestList($limit = 10) {
	global $g5, $member;

	$list = array();
	$sql = "select count(*) cnt from best_content_list where date = curdate()";
	$row = sql_fetch($sql);
	if ($row > 0)
		$val = " 0 ";
	else 
		$val = " -1 ";
	$sqlr = " select distinct a.* from best_content_list a 
			  where datediff(a.date, curdate()) = {$val}
			  order by (hit + good + wr_10 - nogood) desc 
			  limit {$limit} ";
	//if ($member['mb_id'] == 'pletho')	echo $sqlr."<BR>";
	$resultr = sql_query($sqlr,false);
	$i = 0;

	while ($rows = sql_fetch_array($resultr))	{
		$list[$i] = $rows;
		$i++;
	}
	return $list;
}

 
 //베스트 리스트 10  //2018-08-16.이종석.시간조건 상관없이 무조건 가지고 오기 위해서 함수 추가함 (getBestList와 동일하고, where조건에 시간만 없어짐)
function getBestList2($limit = 10) {
	global $g5, $member;

	$sql = "select * from g5_board 
			where gr_id = 'category' ";
	$result = sql_query($sql);
	while ($row = sql_fetch_array($result))	{
		if ($sqls) $sqls .= " union all ";
		$sqls .= "select 
					'{$row['bo_table']}' botable, 
					'{$row['bo_subject']}' bosub, 
					a.*,
					x.vi_date,
					x.vi_time 
			 from g5_write_".$row['bo_table']." a,
			 	  g5_visit x
			 where (
			 	    1
	 		    )
	 		    and x.bo_table <> ''
	 		    and x.wr_id <>'0'
			 	and a.wr_is_comment = '0' 
			 	and x.bo_table = '{$row['bo_table']}'
			 	and x.wr_id = a.wr_id 
			 ";
	}

	$list = array();
	$sqlr = " select 
				distinct 
				a.botable, 
				a.bosub, 
				a.wr_id,
				a.wr_name,
				a.wr_subject subject, 
				a.wr_hit hit,
				a.wr_good  good,
				a.wr_nogood nogood,
				a.wr_datetime datetime,
				a.mb_id,
				a.wr_1,
				a.wr_8,
				a.wr_9,
				a.wr_10,
                a.as_list,
                a.ca_name,
                a.wr_comment,
                a.wr_content,
                a.as_thumb
			  from ({$sqls}) a 
			  order by (a.wr_hit+a.wr_good+a.wr_10-a.wr_nogood) desc 
			  limit {$limit} ";
	//if ($member['mb_id'] == 'pletho')	echo $sqlr."<BR>";
	$resultr = sql_query($sqlr,false);
	$i = 0;

	while ($rows = sql_fetch_array($resultr))	{
		$list[$i] = $rows;
		$i++;
	}
	return $list;
}


//인기 기자 베스트 리스트 10 
function getBestManListOld($limit = 10) {
	global $g5, $member;

	$sql = "select 
				a.bo_table, 
				a.bo_subject
		    from g5_board a
		    where 
	             a.gr_id = 'category' 
	        ";
	$result = sql_query($sql);
	while ($row = @sql_fetch_array($result))	{
		if ($sqls) $sqls .= " union all ";
		$sqls .= "select 
					'{$row['bo_table']}' botable, 
					'{$row['bo_subject']}' bosub, 
					a.wr_id, 
					a.wr_subject , 
					a.wr_hit , 
					a.wr_good  , 
					a.wr_nogood , 
					a.wr_datetime,
					a.mb_id,
					a.wr_1,
					a.wr_8,
					a.wr_9,
					a.wr_10,
					x.vi_date,
					x.vi_time 
			 from g5_write_".$row['bo_table']." a,
			 	  g5_member b,
			 	  g5_visit x

			 where (
			 	    (datediff(x.vi_date, curdate()) = -1 and hour(x.vi_time) >= 7)
	 			    or (datediff(x.vi_date, curdate()) = 0 and hour(x.vi_time) < 7)
	 		    )
	 		    and x.bo_table <> ''
	 		    and x.wr_id <>'0'
			 	and a.wr_is_comment = '0' 
			 	and a.mb_id = b.mb_id
			 	and x.bo_table = '{$row['bo_table']}'
			 	and x.wr_id = a.wr_id 
			 ";

	}

	$list = array();
	$sqlr = " select 
				a.mb_id,
				count(a.vi_date) cnt,
				sum(a.wr_hit) hit,
				sum(a.wr_good)  good,
				sum(a.wr_nogood) nogood,
				sum(a.wr_1),
				sum(a.wr_10) wr_10
			  from ({$sqls}) a 
			  group by a.mb_id
			  order by (hit+good+wr_10) desc
			  limit {$limit} ";
	//if ($member['mb_id'] == 'pletho')	echo $sqlr."<BR>";
	$resultr = @sql_query($sqlr,false);
	$i = 0;

	while ($rows = @sql_fetch_array($resultr))	{
		$list[$i] = $rows;
		//$list[$i]['mb'] = get_member($rows['mb_id']);
		$i++;
	}
	return $list;
}
 


//인기 기자 베스트 리스트 10 
function getBestManList($limit = 10) {
	global $g5, $member;


	$list = array();
	$val = "";
	for ($i =0;$i < 10; $i++)	{
		$sql = "select count(*) cnt from best_celeb_list where datediff(date,curdate()) = {$i}";
		$row = sql_fetch($sql);
		if ($row['cnt'] > 0)	{
			if ($i == 0)	
				$val = " 0 ";
			else 
				$val = " -".$i." ";
			break;
		}
	}
	if ($val != "") {


		$sqlr = " select distinct a.* from best_celeb_list a 
				  where datediff(a.date, curdate()) = {$val}
				  order by (hit + good + wr_10 ) desc
				  limit {$limit} ";

		//if ($member['mb_id'] == 'pletho')	echo $sqlr."<BR>";
		$resultr = @sql_query($sqlr,false);
		$i = 0;

		while ($rows = @sql_fetch_array($resultr))	{
			$list[$i] = $rows;
			//$list[$i]['mb'] = get_member($rows['mb_id']);
			$i++;
		}
		return $list;
	}
}
 
// 관심 기자 영역
function getSubscribeList($kind = 0) {
	global $g5, $member;

	//echo "getSubscribeList<br>";
	$sql = " select 
				b.mb_id mb_id
				, b.mb_name name
				, b.mb_nick nick
			 from {$g5['apms_like']} a, {$g5['member_table']} b
			 where a.to_id = b.mb_id 
			    and a.mb_id = '{$member['mb_id']}' 
			 	and flag = 'follow' ";
	$result = sql_query($sql);
	$list = array();
	for ($i= 0; $row = sql_fetch_array($result); $i++) {
		$mem = apms_member($row['wr_id']);
		$list[$i] = $row;
		if ($mem['photo'])			$list[$i]['photo'] = $mem['photo'];
	}

	return $list;
}

function getBestSearchWord($limits = 7,$days = 7)	{
	global $g5;

	$sql = "select 
				pp_word word, count(*) cnt  
			from g5_popular
			where pp_date between adddate(curdate(), -{$days}) and curdate()
			group by pp_word
			order by cnt desc
			limit {$limits}
			";
	$result = sql_query($sql);

	$list = array();
	$linkf = "<a href='/bbs/search.php?stx=";
	$linkm = "'>";
	$linkt = "</a>";
	for($i = 0; $row = sql_fetch_array($result);$i++)	{
		$list[$i] = $row;
		$list[$i]['link'] = $linkf.$row['word'].$linkm.$row['word'].$linkt;
	}
	return $list;

}

function printBestSearchList($limits = 7,$days = 7, $id='',$class='')	{
	global $g5;

	$list = getBestSearchWord($limits, $days);
	$cnt = count($list);

	echo "<ul {$id} {$class} >";
	for ($i=0;$i < $cnt; $i++)	{
		echo "<li><span >".($i+1)."</span>&nbsp;<span>";
		echo $list[$i]['link'];
		echo "</span></li>";
	}
	echo "<ul>";
}



//베스트 리스트 10 
function getMyCelebRecentList($limit = 10) {
	global $g5, $member;

	$sql = "select * from g5_board 
			where gr_id = 'category' ";
	$result = sql_query($sql);
	while ($row = sql_fetch_array($result))	{
		if ($sqls) $sqls .= " union all ";
		$sqls .= "select 
					'{$row['bo_table']}' botable, 
					'{$row['bo_subject']}' bosub, 
					a.wr_id, 
					a.wr_subject , 
					a.wr_hit , 
					a.wr_good  , 
					a.wr_nogood , 
					a.wr_datetime,
					a.mb_id,
					a.wr_1,
					a.wr_8,
					a.wr_9,
					a.wr_10
			 from g5_write_".$row['bo_table']." a
			 where (
			 	    (datediff(a.wr_datetime, curdate()) >= -7 and hour(a.wr_datetime) >= 7)
	 			    or (datediff(a.wr_datetime, curdate()) = 0 and hour(a.wr_datetime) < 7)
	 		    )
			 	and a.wr_is_comment = '0' 
			 	and a.mb_id = '{$member['mb_id']}'
			 ";
	}

	$list = array();
	$sqlr = " select 
				distinct 
				a.botable, 
				a.bosub, 
				a.wr_id, 
				a.wr_subject subject, 
				a.wr_hit hit,
				a.wr_good  good,
				a.wr_nogood nogood,
				a.wr_datetime datetime,
				a.mb_id,
				a.wr_1,
				a.wr_8,
				a.wr_9,
				a.wr_10 
				";
	$sqlr  =  "  from ({$sqls}) a ";
			  //order by a.wr_hit desc 			  limit {$limit} ";
	//if ($member['mb_id'] == 'pletho')	echo $sqlr."<BR>";
	return $sqlr;
	/*
	$resultr = sql_query($sqlr,false);
	$i = 0;

	while ($rows = sql_fetch_array($resultr))	{
		$list[$i] = $rows;
		$i++;
	}
	return $list;
	*/
}

//최신글리스트 2 //2018-08-16.이종석.정해진 컬럼 이외에 다 가져오기 위해
function getMyCelebRecentList2($limit = 10) {
	global $g5, $member;

	$sql = "select * from g5_board 
			where gr_id = 'category' ";
	$result = sql_query($sql);
	while ($row = sql_fetch_array($result))	{
		if ($sqls) $sqls .= " union all ";
		$sqls .= "select 
					'{$row['bo_table']}' botable, 
					'{$row['bo_subject']}' bosub, 
					a.*
			 from g5_write_".$row['bo_table']." a
			 where ( 
			  1=1 ";
			 //			 	    (datediff(a.wr_datetime, curdate()) >= -7 and hour(a.wr_datetime) >= 7)
			 //			    or (datediff(a.wr_datetime, curdate()) = 0 and hour(a.wr_datetime) < 7)
	 	$sqls.=   " )
			 	and a.wr_is_comment = '0' 
			 	and a.mb_id = '{$member['mb_id']}'
			 ";
	}

	$list = array();
	$sqlr = " select 
				distinct 
				a.botable, 
				a.bosub, 
				a.wr_id, 
				a.wr_subject subject, 
				a.wr_hit hit,
				a.wr_good  good,
				a.wr_nogood nogood,
				a.wr_datetime datetime,
				a.mb_id,
				a.wr_1,
				a.wr_8,
				a.wr_9,
				a.wr_10,
                a.as_list,
                a.ca_name,
                a.wr_comment,
                a.wr_content,
                a.as_thumb
				";
	$sqlr  =  "  from ({$sqls}) a ";
			  //order by a.wr_hit desc 			  limit {$limit} ";
	//if ($member['mb_id'] == 'pletho')	echo $sqlr."<BR>";
	return $sqlr;
	/*
	$resultr = sql_query($sqlr,false);
	$i = 0;

	while ($rows = sql_fetch_array($resultr))	{
		$list[$i] = $rows;
		$i++;
	}
	return $list;
	*/
}


//셀럽의 관련글 기본 3개 
function getCelebRelatonList($mb_id, $limit = 3) {
	global $g5, $member;

	$sql = "select * from g5_board 
			where gr_id = 'category' ";
	$result = sql_query($sql);
	while ($row = sql_fetch_array($result))	{
		if ($sqls) $sqls .= " union all ";
		$sqls .= "select 
					'{$row['bo_table']}' botable, 
					'{$row['bo_subject']}' bosub, 
					a.*
			 from g5_write_".$row['bo_table']." a
			 where (
			 	    (datediff(a.wr_datetime, curdate()) >= -7 and hour(a.wr_datetime) >= 7)
	 			    or (datediff(a.wr_datetime, curdate()) = 0 and hour(a.wr_datetime) < 7)
	 		    )
			 	and a.wr_is_comment = '0' 
			 	and a.mb_id = '{$mb_id}'
			 ";
	}

	$list = array();
	$sqlr = " select 
				distinct 
				a.botable, 
				a.bosub, 
				a.wr_id, 
				a.wr_subject subject, 
				a.wr_hit hit,
				a.wr_good  good,
				a.wr_nogood nogood,
				a.wr_datetime datetime,
				a.mb_id,
				a.wr_1,
				a.wr_8,
				a.wr_9,
				a.wr_10,
                a.as_list,
                a.ca_name,
                a.wr_comment,
                a.wr_content,
                a.as_thumb
				from ({$sqls}) a 
			  order by a.wr_hit desc
			  limit {$limit} ";
	//if ($member['mb_id'] == 'pletho')	echo $sqlr."<BR>";
	//return $sqlr;
	
	$resultr = sql_query($sqlr,false);
	$i = 0;

	while ($rows = sql_fetch_array($resultr))	{
		$list[$i] = $rows;
		$i++;
	}
	return $list;
	//*/
}



//셀럽의 조회수, 등록수 
function getCelebInfo($mb_id) {
	global $g5, $member, $celebs;

	$sql = "select * from g5_board 
			where gr_id = 'category' ";
	$result = sql_query($sql);
	while ($row = sql_fetch_array($result))	{
		//			 (	    (datediff(a.wr_datetime, curdate()) >= -7 and hour(a.wr_datetime) >= 7)
	 	//		    or (datediff(a.wr_datetime, curdate()) = 0 and hour(a.wr_datetime) < 7) )

		if ($sqls) $sqls .= " union all ";
		$sqls .= "select 
					'{$row['bo_table']}' botable, 
					'{$row['bo_subject']}' bosub, 
					a.wr_id, 
					a.wr_subject , 
					a.wr_hit , 
					a.wr_good  , 
					a.wr_nogood , 
					a.wr_datetime,
					a.mb_id,
					a.wr_1,
					a.wr_8,
					a.wr_9,
					a.wr_10
			 from g5_write_".$row['bo_table']." a
			 where 1=1
			 	and a.wr_is_comment = '0' 
			 	and a.mb_id = '{$mb_id}'
			 ";
	}

	$list = array();
	$sqlr = " select sum(hit) cnt from (
				select 
				distinct
				a.botable, 
				a.bosub, 
				a.wr_id, 
				a.wr_subject subject, 
				a.wr_hit hit,
				a.wr_good  good,
				a.wr_nogood nogood,
				a.wr_datetime datetime,
				a.mb_id,
				a.wr_1,
				a.wr_8,
				a.wr_9,
				a.wr_10 
				from ({$sqls}) a 
				) x
			  ";
	//if ($member['mb_id'] == 'pletho') echo $sqlr;

	$rowr = sql_fetch($sqlr,false);

	$list['viewcnt'] = $rowr['cnt'];

	$sqlq = " select count(*) cnt from (
				select 
				distinct
				a.botable, 
				a.bosub, 
				a.wr_id, 
				a.wr_subject subject, 
				a.wr_hit hit,
				a.wr_good  good,
				a.wr_nogood nogood,
				a.wr_datetime datetime,
				a.mb_id,
				a.wr_1,
				a.wr_8,
				a.wr_9,
				a.wr_10 
				from ({$sqls}) a 
				) x
			  ";
	
	$rowq = sql_fetch($sqlq,false);

	$list['regcnt'] = $rowq['cnt'];

	$list['bgimg'] = G5_DATA_URL.'/member/'.substr($mb_id,0,2).'/'.$celebs['mb_background'];
	
	
	return $list;
	//*/
}


//베스트 리스트 10 
function getMyCelebBestList($limit = 10) {
	global $g5, $member;

	$sql = "select * from g5_board 
			where gr_id = 'category' ";
	$result = sql_query($sql);
	while ($row = sql_fetch_array($result))	{
		if ($sqls) $sqls .= " union all ";
		$sqls .= "select 
					'{$row['bo_table']}' botable, 
					'{$row['bo_subject']}' bosub, 
					
					a.wr_id, 
					a.wr_subject , 
					a.wr_hit , 
					a.wr_good  , 
					a.wr_nogood , 
					a.wr_datetime,
					a.mb_id,
					a.wr_1,
					a.wr_8,
					a.wr_9,
					a.wr_10,
					x.vi_date,
					x.vi_time 
			 from g5_write_".$row['bo_table']." a,
			 	  g5_visit x
			 where (
			 	    (datediff(x.vi_date, curdate()) = -1 and hour(x.vi_time) >= 7)
	 			    or (datediff(x.vi_date, curdate()) = 0 and hour(x.vi_time) < 7)
	 		    )
	 		    and x.bo_table <> ''
	 		    and x.wr_id <>'0'
			 	and a.wr_is_comment = '0' 
			 	and x.bo_table = '{$row['bo_table']}'
			 	and x.wr_id = a.wr_id 
			 	and a.mb_id = '{$member['mb_id']}'
			 ";
	}

	$list = array();
	$sqlr = "  from ({$sqls}) a ";
			  //order by a.wr_hit desc 			  limit {$limit} ";
	//if ($member['mb_id'] == 'pletho')	echo $sqlr."<BR>";
	return $sqlr;
	/*
	$resultr = sql_query($sqlr,false);
	$i = 0;

	while ($rows = sql_fetch_array($resultr))	{
		$list[$i] = $rows;
		$i++;
	}
	return $list;
	*/
}


//베스트 리스트 10 //2018-08-16.이종석.추가
function getMyCelebBestList2($limit = 10) {
	global $g5, $member;

	$sql = "select * from g5_board 
			where gr_id = 'category' ";
	$result = sql_query($sql);
	while ($row = sql_fetch_array($result))	{
		if ($sqls) $sqls .= " union all ";
		//, x.vi_date,x.vi_time 
		$sqls .= "select 
					'{$row['bo_table']}' botable, 
					'{$row['bo_subject']}' bosub, 
					a.*

			 from g5_write_".$row['bo_table']." a,
			 	  g5_visit x
			 where (
			 	    1
	 		    )
	 		    and x.bo_table <> ''
	 		    and x.wr_id <>'0'
			 	and a.wr_is_comment = '0' 
			 	and x.bo_table = '{$row['bo_table']}'
			 	and x.wr_id = a.wr_id 
			 	and a.mb_id = '{$member['mb_id']}'
			 ";
	}

	$list = array();
	$sqlr = "  from ({$sqls}) a ";
			  //order by a.wr_hit desc 			  limit {$limit} ";
	//if ($member['mb_id'] == 'pletho')	echo $sqlr."<BR>";
	return $sqlr;
	/*
	$resultr = sql_query($sqlr,false);
	$i = 0;

	while ($rows = sql_fetch_array($resultr))	{
		$list[$i] = $rows;
		$i++;
	}
	return $list;
	*/
}

function getSelectGrid($bo_table, $gr_id="category")	{
	global $g5,$member;

	$sql = "select * from g5_board where gr_id = '{$gr_id}' order by bo_subject asc ";
	$result = sql_query($sql);
	echo '<div class="col-sm-3">';
	echo "<select id='selectGrId' name='selectGrId'  required class='form-control input-sm'>";
	while ($row = sql_fetch_array($result)) {
		echo "<option value='{$row['bo_table']}' ";
		if ($row['bo_table'] == $bo_table) echo " selected ";
		echo ">";
		echo $row['bo_subject'];
		echo "</option>";
	}
	echo "</select>";

	?>
	<script>
		$(function() {
			$("#selectGrId").change(function(){
				$("#bo_table").val($("#selectGrId option:selected").val());
			});
		});
	</script>
	<?php
	//echo $script;
	echo '</div>';
}

function getSumSponCel($bo_table, $wr_id)	{
	global $g5;

	if (!$bo_table || !$wr_id)
		return;
	$sql = "select sum(wr_10) cnt from g5_write_{$bo_table}
			where wr_is_comment = '1' and wr_parent = '{$wr_id}' ";
			//echo $sql."<BR>";
	$row = sql_fetch($sql);
	return $row['cnt'];
}

/*
​
- 메인 -
​
1. 인기글(10개)
2. 인기기자(10개)
3. 기사 썸네일 - 카테고리 출력
4. 기사 썸네일 - 기자 프로필 이미지 출력
5. 게시글 정렬기능
6. 인기글 출력 (핫이슈)
​
- 서브 (기사 상세)  -
​
1. 글쓴이 (기자) 프로필 출력
2. 구독출력
3. 좋아요싫어요 출력
4. 글쓴이(기자)정보 - 인사말 출력
5. 관련기사 출력
*/


?>
