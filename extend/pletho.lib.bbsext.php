<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가


/******************************************************************************************
***  본 파일은  플래토의  저작물입니다.                                                  ***
***  본 파일의 내용을 허가업이 도용 / 사용할경우 저작권법에 위배됩니다.                     ***
***  허가한 사용자/업체만 사용가능하고, 다른용도로 사용/배포는 불가합니다.                  ***
***  본내용을 다른 용도를 원하실경우 저작자인 플래토 에게 구입하여 사용하시기 바랍니다.      ***
***                                                                                    ***
***                                                                                    ***
***  연락처 => 이메일 :   pletho@gmail.com   , 텔레그램 : @pletho , 카카오톡 : @pletho    ***
******************************************************************************************/



// 게시물 정보($write_row)를 출력하기 위하여 $list로 가공된 정보를 복사 및 가공
function get_list2($write_row, $board, $skin_url, $subject_len=40)
{
    global $g5, $config;
    global $qstr, $page;

    //$t = get_microtime();

    // 배열전체를 복사
    $list = $write_row;
    unset($write_row);

    $board_notice = array_map('trim', explode(',', $board['bo_notice']));
    $list['is_notice'] = in_array($list['wr_id'], $board_notice);

    if ($subject_len)
        $list['subject'] = conv_subject($list['wr_subject'], $subject_len, '…');
    else
        $list['subject'] = conv_subject($list['wr_subject'], $board['bo_subject_len'], '…');

	// 확장데이터
	if($list['as_extend']) {
		$wr_extend = apms_unpack($list['wr_content']);
		$list['content'] = $wr_extend['content'];
		unset($wr_extend);
	} else {
		$list['content'] = $list['wr_content'];
	}

	// 목록에서 내용 미리보기 사용한 게시판만 내용을 변환함 (속도 향상) : kkal3(커피)님께서 알려주셨습니다.
    if ($board['bo_use_list_content']) {
		$html = 0;
		if (strstr($list['wr_option'], 'html1'))
			$html = 1;
		else if (strstr($list['wr_option'], 'html2'))
			$html = 2;

        $list['content'] = conv_content($list['content'], $html);
	}

    $list['comment_cnt'] = '';
    if ($list['wr_comment'])
        $list['comment_cnt'] = "<span class=\"cnt_cmt\">".$list['wr_comment']."</span>";

    // 당일인 경우 시간으로 표시함
    $list['datetime'] = substr($list['wr_datetime'],0,10);
    $list['datetime2'] = $list['wr_datetime'];
    $list['date'] = strtotime($list['wr_datetime']);
    $list['update'] = substr($list['as_update'],0,1);
	$list['update'] = ($list['update'] == "0") ? 0 : strtotime($list['as_update']);

	if ($list['datetime'] == G5_TIME_YMD)
        $list['datetime2'] = substr($list['datetime2'],11,5);
    else
        $list['datetime2'] = substr($list['datetime2'],5,5);
    // 4.1
    $list['last'] = substr($list['wr_last'],0,10);
    $list['last2'] = $list['wr_last'];
    if ($list['last'] == G5_TIME_YMD)
        $list['last2'] = substr($list['last2'],11,5);
    else
        $list['last2'] = substr($list['last2'],5,5);

    $list['wr_homepage'] = get_text($list['wr_homepage']);

    $tmp_name2 = cut_str($list['wr_name'], $config['cf_cut_name']); // 설정된 자리수 만큼만 이름 출력
    $tmp_name = get_text($tmp_name2); // 설정된 자리수 만큼만 이름 출력
    if ($board['bo_use_sideview']) {
		$lvl = ($board['as_level']) ? 'yes' : 'no';
		$list['name'] = apms_sideview($list['mb_id'], $tmp_name2, $list['wr_email'], $list['wr_homepage'], $list['as_level'], $lvl); // APMS 용으로 교체
	} else {
		if ($board['as_level']) {
			$tmp_name = xp_icon($list['mb_id'], $list['as_level']).' '.$tmp_name;
		}
		$list['name'] = '<span class="'.($list['mb_id']?'sv_member':'sv_guest').'">'.$tmp_name.'</span>';
	}

    $reply = $list['wr_reply'];

    $list['reply'] = strlen($reply)*10;

    $list['icon_reply'] = '';
    if ($list['reply'])
        $list['icon_reply'] = '<img src="'.$skin_url.'/img/icon_reply.gif" class="icon_reply" style="margin-left:'.$list['reply'].'px;" alt="">';

    $list['icon_link'] = '';
    if ($list['wr_link1'] || $list['wr_link2'])
        $list['icon_link'] = '<i class="fa fa-link" aria-hidden="true"></i> ';

    // 분류명 링크
    $list['ca_name_href'] = G5_BBS_URL.'/board.php?bo_table='.$board['bo_table'].'&amp;sca='.urlencode($list['ca_name']);
    if($list['ca_name']) {
	    $list['ca_name'] = clean_xss_tags($list['ca_name']);
        //$list['ca_name'] = preg_replace("/[\<\>\'\"\\\'\\\"\%\=\(\)\/\^\*]/", "", $list['ca_name']);
	    $list['ca_name'] = preg_replace("/[\<\>\'\"\\\'\\\"\%\=\(\)\^\*]/", "", $list['ca_name']);
	}
    $list['href'] = G5_BBS_URL.'/board.php?bo_table='.$board['bo_table'].'&amp;wr_id='.$list['wr_id'].$qstr;
    $list['comment_href'] = $list['href'];

    $list['icon_new'] = '';
    if ($board['bo_new']) {
		$new_date = date("Y-m-d H:i:s", G5_SERVER_TIME - ($board['bo_new'] * 3600));
		if($list['wr_datetime'] >= $new_date) {
	        $list['icon_new'] = '<img src="'.$skin_url.'/img/icon_new.gif" class="title_icon" alt="">';
		} else if($list['as_update'] >= $new_date) {
	        $list['icon_new'] = '<img src="'.$skin_url.'/img/icon_new.gif" class="title_icon" alt="">';
		}
	}

    $list['icon_hot'] = '';
    if ($board['bo_hot'] && $list['wr_hit'] >= $board['bo_hot'])
        $list['icon_hot'] = '<i class="fa fa-heart" aria-hidden="true"></i> ';

	$list['is_lock'] = false;
    $list['icon_secret'] = '';
    if (strstr($list['wr_option'], 'secret')) {
        $list['icon_secret'] = '<i class="fa fa-lock" aria-hidden="true"></i> ';
	} else if($list['as_shingo'] < 0) {
		$list['is_lock'] = true;
		$list['icon_secret'] = '<i class="fa fa-lock" aria-hidden="true"></i> ';
	}

	$list['icon_image'] = '';
	$list['icon_video'] = '';

	if ($list['as_list'] == "3") {
        $list['icon_image'] = '<i class="fa fa-picture-o" aria-hidden="true"></i> ';
        $list['icon_video'] = '<i class="fa fa-video-camera" aria-hidden="true"></i> ';
	} else if($list['as_list'] == "2") {
        $list['icon_video'] = '<i class="fa fa-video-camera" aria-hidden="true"></i> ';
	} else if($list['as_list'] == "1") {
        $list['icon_image'] = '<i class="fa fa-picture-o" aria-hidden="true"></i> ';
	}

	$list['icon_extra'] = '';
	if ($list['as_extra'] == "1") {
        $list['icon_extra'] = '<i class="fa fa-star" aria-hidden="true"></i> ';
	} else if ($list['as_extra'] == "2") {
        $list['icon_extra'] = '<i class="fa fa-signal" aria-hidden="true"></i> ';
	} else if ($list['as_extra'] == "3") {
        $list['icon_extra'] = '<i class="fa fa-commenting-o" aria-hidden="true"></i> ';
	}

    // 링크
    for ($i=1; $i<=G5_LINK_COUNT; $i++) {
		if($list['is_lock']) { //잠근글이면 제외
			$list["wr_link{$i}"] = "";
		}
        $list['link'][$i] = set_http(get_text($list["wr_link{$i}"]));
        $list['link_href'][$i] = G5_BBS_URL.'/link.php?bo_table='.$board['bo_table'].'&amp;wr_id='.$list['wr_id'].'&amp;no='.$i.$qstr;
        $list['link_hit'][$i] = (int)$list["wr_link{$i}_hit"];
    }

    // 가변 파일
    if ($board['bo_use_list_file'] || ($list['wr_file'] && $subject_len == 255) /* view 인 경우 */) {
        $list['file'] = ($list['is_lock']) ? array() : get_file($board['bo_table'], $list['wr_id']);
    } else {
        $list['file']['count'] = $list['wr_file'];
    }

    if ($list['file']['count'])
        $list['icon_file'] = '<i class="fa fa-download" aria-hidden="true"></i> ';

    return $list;
}

// get_list 의 alias
function get_view2($write_row, $board, $skin_url)
{
    return get_list2($write_row, $board, $skin_url, 255);
}




// 게시글에 첨부된 파일을 얻는다. (배열로 반환)
function get_file2($bo_table, $wr_id)
{
    global $g5, $qstr;

    $file['count'] = 0;
    $sql = " select * from {$g5['board_file_table']} 
    		 where bo_table = '$bo_table' and wr_id = '$wr_id' order by bf_no ";
    $result = sql_query($sql);
    while ($row = sql_fetch_array($result))
    {
    	$sql2 = "select * from {$g5['teacher_profile_table']} 
    			 where bo_table = '$bo_table' and wr_id ='$wr_id' and bf_no = '{$row['bf_no']}' ";
    	$portfolio = sql_fetch($sql2);
        $no = $row['bf_no'];
        $bf_content = $row['bf_content'] ? html_purifier($row['bf_content']) : '';
		$file[$no]['href'] = G5_BBS_URL."/download.php?bo_table=$bo_table&amp;wr_id=$wr_id&amp;no=$no" . $qstr;
        $file[$no]['download'] = $row['bf_download'];
        // 4.00.11 - 파일 path 추가
        $file[$no]['path'] = G5_DATA_URL.'/file/'.$bo_table;
        $file[$no]['size'] = get_filesize($row['bf_filesize']);
        $file[$no]['datetime'] = $row['bf_datetime'];
        $file[$no]['source'] = addslashes($row['bf_source']);
        $file[$no]['bf_content'] = $bf_content;
        $file[$no]['content'] = get_text($bf_content);
        //$file[$no]['view'] = view_file_link($row['bf_file'], $file[$no]['content']);
        $file[$no]['view'] = view_file_link($row['bf_file'], $row['bf_width'], $row['bf_height'], $file[$no]['content']);
        $file[$no]['file'] = $row['bf_file'];
        $file[$no]['image_width'] = $row['bf_width'] ? $row['bf_width'] : 640;
        $file[$no]['image_height'] = $row['bf_height'] ? $row['bf_height'] : 480;
        $file[$no]['image_type'] = $row['bf_type'];
        $file[$no]['title'] = $portfolio['title'];
        $file[$no]['role'] = $portfolio['role'];
        $file['count']++;
    }

    return $file;
}
