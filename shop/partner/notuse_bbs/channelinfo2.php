<?php
include_once('./_common.php');



if( !isset($it) && !get_session("ss_tv_idx") ){
    if( !headers_sent() ){  //헤더를 보내기 전이면 검색엔진에서 제외합니다.
    }
    /*
    if( !G5_IS_MOBILE ){    //PC 에서는 검색엔진 화면에 노출하지 않도록 수정
        return;
    }
    */
}

include_once(G5_LIB_PATH.'/thumbnail.lib.php');

// 현재페이지, 총페이지수, 한페이지에 보여줄 행, URL
function channelinfo2_page($write_pages, $cur_page, $total_page, $url, $add="")
{
    //$url = preg_replace('#&amp;page=[0-9]*(&amp;page=)$#', '$1', $url);
    $url = preg_replace('#&amp;page=[0-9]*#', '', $url) . '&amp;page=';

    $str = '';
    if ($cur_page > 1) {
        $str .= '<a href="'.$url.'1'.$add.'" class="pg2_page pg2_start">처음</a>'.PHP_EOL;
    }

    $start_page = ( ( (int)( ($cur_page - 1 ) / $write_pages ) ) * $write_pages ) + 1;
    $end_page = $start_page + $write_pages - 1;

    if ($end_page >= $total_page) $end_page = $total_page;

    if ($start_page > 1) $str .= '<a href="'.$url.($start_page-1).$add.'" class="pg2_page pg2_prev">이전</a>'.PHP_EOL;

    if ($total_page > 1) {
        for ($k=$start_page;$k<=$end_page;$k++) {
            if ($cur_page != $k)
                $str .= '<a href="'.$url.$k.$add.'" class="pg2_page">'.$k.'</a><span class="sound_only">페이지</span>'.PHP_EOL;
            else
                $str .= '<span class="sound_only">열린</span><strong class="pg2_current">'.$k.'</strong><span class="sound_only">페이지</span>'.PHP_EOL;
        }
    }

    if ($total_page > $end_page) $str .= '<a href="'.$url.($end_page+1).$add.'" class="pg2_page pg2_next">다음</a>'.PHP_EOL;

    if ($cur_page < $total_page) {
        $str .= '<a href="'.$url.$total_page.$add.'" class="pg2_page pg2_end">맨끝</a>'.PHP_EOL;
    }

    if ($str)
        return "<nav class=\"pg2_wrap\"><span class=\"pg\">{$str}</span></nav>";
    else
        return "";
}

$ingmember_list = "./ingmemberlist.php";
$ingmember_form = "./ingmemberform.php?it_id=".$it_id;
$ingmember_formupdate = "./ingmemberformupdate.php?it_id=".$it_id;

 
    $sql_first = "
            select distinct botable, bosub, wr_id, wr_subject, wr_datetime, wr_1, wr_8, wr_9, wr_10, as_thumb, wr_comment, as_list, mb_id, wr_name
            ";
    $sql_common = getMyCelebBestList2(); //$channels['mb_id']); //" from g5_write_reghealth a ";

    //if (!$is_admin)
    //$add_sql = " where mb_id = '{$member['mb_id']}' ";

//$sql = " select * ".$sql_common;
//echo $sql."<BR>";
//return;
// 테이블의 전체 레코드수만 얻음
$sql = " select COUNT(*) as cnt from (" . $sql_frst.$sql_common.$add_sql.") x ";

$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = 3; //2018-08-16.이종석.한페이지에서 3개만 뽑도록
$total_page  = ceil($total_count / $rows); // 전체 페이지 계산
if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 레코드 구함

$sql = $sql_first.$sql_common.$add_sql." order by a.mb_id asc, botable asc limit $from_record, $rows ";
//if($member['mb_id'] == 'pletho') echo "query : ".$sql."<BR>";
$result = sql_query($sql);
//echo $sql."<br/>";

//    $ingmember_skin = G5_SKIN_PATH.'/member/basic/ingmember.skin.php';
    

//2018-08-16.이종석.테스트용
//$ingmember_skin = G5_SKIN_PATH.'/member/basic/channelinfo2.skin.php';
$ingmember_skin = G5_SKIN_PATH.'/member/basic/channelinfo2.skin.php';


if(!file_exists($ingmember_skin)) {
    echo str_replace(G5_PATH.'/', '', $ingmember_skin).' 스킨 파일이 존재하지 않습니다.';
} else {
    include_once($ingmember_skin);
}
?>