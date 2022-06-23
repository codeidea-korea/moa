<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

$status_option = '';
$status = "";
if (isset($write['status']))
    $status = $write['status'];
$status_option = get_status_option($bo_table, $status);



// 게시글에 첨부된 파일을 얻는다. (배열로 반환)
function get_class_item($bo_table, $wr_id)
{
    global $g5, $qstr;
    $class_item = array();
    $class_item['count'] = 0;
    $sql = " select * from {$g5['class_item_table']} 
    		 where bo_table = '$bo_table' and wr_id = '$wr_id' order by cls_no ";
    //echo $sql."<BR>";
    $result = sql_query($sql);
    while ($row = sql_fetch_array($result))
    {
        $no = $row['cls_no'];
        $bf_content = $row['content'] ? html_purifier($row['content']) : '';
        $class_item[$no]['idx'] = $row['idx'];
        $class_item[$no]['cls_no'] = $row['cls_no'];
        $class_item[$no]['day'] = $row['day'];
        $class_item[$no]['time'] = $row['time'];
        // 4.00.11 - 파일 path 추가
        $class_item[$no]['type'] = $row['type'];
        $class_item[$no]['cls_content'] = $bf_content;
        $class_item[$no]['content'] = get_text($bf_content);
        $class_item['count']++;
    }

    return $class_item;
}

$class_item = get_class_item($bo_table, $wr_id);
//--------------------------------------------------------------------------
// 가변 경력
$class_item_script = "";
$class_item_length = -1;
//echo "count : ".$class_item['count']."<BR>";
// 수정의 경우 파일업로드 필드가 가변적으로 늘어나야 하고 삭제 표시도 해주어야 합니다.
if ($w == "u") {
    for ($i=0; $i<$class_item['count']; $i++) {
        //echo "idx : ".$class_item[$i]['idx']."<BR>";
        if ($class_item[$i]['idx']) {

			$class_item_script .= "add_class_item(\"";
			if ($is_class_item_content) {
				$class_item_script .= "<div class='col-sm-5'><div class='form-group'><input type='text'name='bf_content[$i]' value='".addslashes(get_text($class_item[$i]['bf_content']))."' class='form-control input-sm' placeholder='이미지에 대한 내용을 입력하세요.'></div></div>";
			}
			$class_item_script .= "<div class='col-sm-12'><div class='form-group'><label class='checkbox-inline'><input type='checkbox' name='cls_date_del[$i]' value='{$class_item[$i]['idx']}'> {$class_item[$i]['day']} {$class_item[$i]['time']}강의시간 삭제</label> </div></div>";
			$class_item_script .= "\"";
			$class_item_script .= ",\"";
			$class_item_script .= "<div class='col-sm-10'><div class='form-group'><div class='input-group input-group-sm '><select name='cls_type[]' class='form-control'>";
            $class_item_script .="<option value='0' ".(($class_item[$i]['type'] == '0')?" selected ":""). ">본강의 </option>";
            $class_item_script .="<option value='1' ".(($class_item[$i]['type'] == '1')?" selected ":""). ">보조강의</option>";
            $class_item_script .="<option value='2' ".(($class_item[$i]['type'] == '2')?" selected ":""). ">휴강</option>";
            $class_item_script .="<option value='2' ".(($class_item[$i]['type'] == '3')?" selected ":""). ">종강</option>";
            $class_item_script .="</select><input type='text' class='form-control input-sm cls_date' name='cls_day[]' placeholder='강의일자' value='".$class_item[$i]['day']."'>:<select  class='form-control input-sm' name='cls_time[]' placeholder='강의시간 ' >";
            $t = "";
            $sel_t = $class_item[$i]['time'];
            for ($j = 8; $j < 20;$j++) {
                $t = (($j<10)?"0":"").$j.":00";

                $class_item_script .= "<option value='{$t}' ";
                if ($sel_t == $t) { 
                    $class_item_script .= " selected ";
                }
                $class_item_script .= ">".$t."</option>";
                $t = (($j<10)?"0":"").$j.":30";
                $class_item_script .= "<option value='{$t}' ";
                if ($sel_t == $t) { 
                    $class_item_script .= " selected ";
                }
                $class_item_script .= ">{$t}</option>";
            }
            $t = (($j<10)?"0":"").$j.":00";
            $class_item_script .= "<option value='{$t}'>{$t}</option></select>";
                
            $class_item_script .= "<input type='text' class='form-control input-sm' name='cls_content[]' placeholder='강의내용' value='{$class_item[$i]['content']}'></div></div></div>";
			$class_item_script .= "\"";
			$class_item_script .=");\n";
        } else {
            $class_item_script .= "add_class_item('');\n";
		}
    }
    $class_item_length = $class_item['count'] - 1;
}

if ($class_item_length < 0) {
    $class_item_script .= "add_class_item('');\n";
    $class_item_length = 0;
}
//--------------------------------------------------------------------------
$class_item_script .= " addpicker(); ";
?>
