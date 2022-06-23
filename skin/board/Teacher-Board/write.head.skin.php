<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

$status_option = '';
$status = "";
if (isset($write['status']))
    $status = $write['status'];
$status_option = get_status_option($bo_table, $status);


// 게시글에 첨부된 파일을 얻는다. (배열로 반환)
function get_file_ext($bo_table, $wr_id)
{
    global $g5, $qstr;

    $file['count'] = 0;
    $sql = " select * from {$g5['board_file_table']} where bo_table = '$bo_table' and wr_id = '$wr_id' order by bf_no ";
    $result = sql_query($sql);
    while ($row = sql_fetch_array($result))
    {
    	$sql2 = "select * from {$g5['teacher_profile_table']} 
    			 where bo_table = '$bo_table' and wr_id = '$wr_id' and bf_no  = '{$row['bf_no']}'";
    	$profile = sql_fetch($sql2);
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
        $file[$no]['title'] = $profile['title'];
        $file[$no]['role'] = $profile['role'];

        $file['count']++;
    }

    return $file;
}

//--------------------------------------------------------------------------
// 가변 파일

$file = get_file_ext($bo_table, $wr_id);
if($file_count < $file['count'])
    $file_count = $file['count'];

$file_script = "";
$file_length = -1;
// 수정의 경우 파일업로드 필드가 가변적으로 늘어나야 하고 삭제 표시도 해주어야 합니다.
if ($w == "u") {
    for ($i=0; $i<$file['count']; $i++) {
        if ($file[$i]['source']) {
			$file_script .= "add_file(\"";
			if ($is_file_content) {
				$file_script .= "<div class='col-sm-5'><div class='form-group'><input type='text'name='bf_content[$i]' value='".addslashes(get_text($file[$i]['bf_content']))."' class='form-control input-sm' placeholder='이미지에 대한 내용을 입력하세요.'></div></div>";
			}
			// [제목:".$file[$i]['title']."][역할:".$file[$i]['role']."] &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			$file_script .= "<div class='col-sm-12'><div class='form-group'><label class='checkbox-inline'> <input type='checkbox' name='bf_file_del[$i]' value='1'> {$file[$i]['source']}({$file[$i]['size']}) 파일 삭제</label> | <a href='{$file[$i]['href']}'>열기</a></div></div>";
			$file_script .= "\"";

			$file_script .= ",\"";
			if ($i == 0) {
				$file_script .= "<div class='col-sm-10'><div class='form-group'><div class='input-group input-group-sm '><input type='text' class='form-control input-sm' name='pf_title[]' placeholder='포트폴리오 제목' value='".$file[$i]['title']."'><input type='text' class='form-control input-sm' name='pf_role[]' placeholder='역할' value='".$file[$i]['role']."'><span class='input-group-addon' style='width:100px'>메인소개사진 ".$i."</span><input type='file'  accept='image/*;capture=camera' class='form-control input-sm' name='bf_file[]' title='파일 용량 <?php echo $upload_max_filesize; ?> 이하만 업로드 가능'></div></div></div>";
			}
			else {

				$file_script .= "<div class='col-sm-10'><div class='form-group'><div class='input-group input-group-sm '><input type='text' class='form-control input-sm' name='pf_title[]' placeholder='포트폴리오 제목' value='{$file[$i]['title']}'><input type='text' class='form-control input-sm' name='pf_role[]' placeholder='역할' value='{$file[$i]['role']}'><span class='input-group-addon' style='width:100px'>포트폴리오 ".$i."</span><input type='file'  accept='image/*;capture=camera' class='form-control input-sm' name='bf_file[]' title='파일 용량 <?php echo $upload_max_filesize; ?> 이하만 업로드 가능'></div></div></div>";
			} 
			$file_script .= "\"";
			$file_script .=");\n";
        } else {
            $file_script .= "add_file('');\n";
		}
		//echo $file_script."<BR>";
    }
    $file_length = $file['count'] - 1;
}

if ($file_length < 0) {
    $file_script .= "add_file('');\n";
    $file_length = 0;
}
//--------------------------------------------------------------------------


// 게시글에 첨부된 파일을 얻는다. (배열로 반환)
function get_history($bo_table, $wr_id)
{
    global $g5, $qstr;
    $history = array();
    $history['count'] = 0;
    $sql = " select * from {$g5['teacher_history_table']} 
    		 where bo_table = '$bo_table' and wr_id = '$wr_id' order by bh_no ";
    $result = sql_query($sql);
    while ($row = sql_fetch_array($result))
    {
        $no = $row['bh_no'];
        $bf_content = $row['content'] ? html_purifier($row['content']) : '';
        $history[$no]['idx'] = $row['idx'];
        $history[$no]['bh_no'] = $row['bh_no'];
        $history[$no]['asis'] = $row['asis'];
        $history[$no]['tobe'] = $row['tobe'];
        // 4.00.11 - 파일 path 추가
        $history[$no]['type'] = $row['type'];
        $history[$no]['bf_content'] = $bf_content;
        $history[$no]['content'] = get_text($bf_content);
        $history['count']++;
    }

    return $history;
}

$history = get_history($bo_table, $wr_id);
//--------------------------------------------------------------------------
// 가변 경력
$history_script = "";
$history_length = -1;
// 수정의 경우 파일업로드 필드가 가변적으로 늘어나야 하고 삭제 표시도 해주어야 합니다.
if ($w == "u") {
    for ($i=0; $i<$history['count']; $i++) {
        if ($history[$i]['idx']) {
			$history_script .= "add_history(\"";
			if ($is_history_content) {
				$history_script .= "<div class='col-sm-5'><div class='form-group'><input type='text'name='bf_content[$i]' value='".addslashes(get_text($history[$i]['bf_content']))."' class='form-control input-sm' placeholder='이미지에 대한 내용을 입력하세요.'></div></div>";
			}
			$history_script .= "<div class='col-sm-12'><div class='form-group'><label class='checkbox-inline'><input type='checkbox' name='bf_history_del[$i]' value='1'> {$history[$i]['content']} 이력 삭제</label> </div></div>";
			$history_script .= "\"";
			$history_script .= ",\"";
			$history_script .= "<div class='col-sm-10'><div class='form-group'><div class='input-group input-group-sm '><select name='ph_type[]' class='form-control'><option value='0' ".(($history[$i]['type'] == '0')?" selected ":""). ">주요경력</option><option value='1' ".(($history[$i]['type'] == '1')?" selected ":""). ">그밖의경력</option></select><input type='text' class='form-control input-sm' name='ph_asis[]' placeholder='시작일자 ' value=".$history[$i]['asis'].">~<input type='text' class='form-control input-sm' name='ph_tobe[]' placeholder='종료일자 ' value=".$history[$i]['tobe']."><input type='text' class='form-control input-sm' name='ph_content[]' placeholder='경력내용' value=".$history[$i]['content']."></div></div></div>";
			$history_script .= "\"";
			$history_script .=");\n";
        } else {
            $history_script .= "add_history('');\n";
		}
    }
    $history_length = $history['count'] - 1;
}

if ($history_length < 0) {
    $history_script .= "add_history('');\n";
    $history_length = 0;
}
//--------------------------------------------------------------------------

?>