<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

include_once(G5_LIB_PATH.'/icode.sms.lib.php'); 
include_once(G5_LIB_PATH.'/icode.lms.lib.php'); 

/******************************************************************************************
 ***  본 파일은  플래토의  저작물입니다.                                                  ***
 ***  본 파일의 내용을 허가업이 도용 / 사용할경우 저작권법에 위배됩니다.                     ***
 ***  허가한 사용자/업체만 사용가능하고, 다른용도로 사용/배포는 불가합니다.                  ***
 ***  본내용을 다른 용도를 원하실경우 저작자인 플래토 에게 구입하여 사용하시기 바랍니다.      ***
 ***                                                                                    ***
 ***                                                                                    ***
 ***  연락처 => 이메일 :   pletho@gmail.com   , 텔레그램 : @pletho , 카카오톡 : @pletho    ***
 ******************************************************************************************/


$_fileId = str_replace("/", "", str_replace(".php", "", $_SERVER['PHP_SELF']));
$rlimitofman = 8;
//공통코드 유형 리스트 조회
function get_common_code_list($type_id)
{
    global $g5;

    $sql = "select * from {$g5['common_code_table']} where type_id = '{$type_id}'";
    $result = sql_query($sql);
    $list = array();
    while ($row = sql_fetch_array($result)) {
        $list[] = $row;
    }

    return $list;
}


//공통코드 유형  조회
function get_common_type($type_id)
{
    global $g5;

    $sql = "select type_id, type_name from {$g5['common_type_table']} where type_id = '{$type_id}'  ";
    $list = sql_fetch($sql);

    return $list;
}

//공통코드 유형 리스트 조회
function get_common_code_name($type_id, $cd_id)
{
    global $g5;

    $sql = "select cd_id, cd_name from {$g5['common_code_table']} where type_id = '{$type_id}' and cd_id= '{$cd_id}' ";
    $list = sql_fetch($sql);

    return $list;
}



// 상품의 중복안되는 키값생성
function getItemKey()
{
    global $g5, $member, $is_admin;
    $key = "ZS";
    if ($is_admin) {
        $key .= getNextVal();
    } else {
        $key = strtoupper(substr($member['mb_id'], 0, 2)) . getNextVal();
    }
    return $key;
}


// Alert
function deb_reload_alert($msg)
{
    echo "<meta http-equiv=\"content-type\" content=\"text/html; charset=utf-8\">";
    echo "<script>";
    if ($msg) echo "alert('" . $msg . "');";
    echo "location.reload();";
    echo "</script>";
    exit;
}

// opener reload Alert
function deb_reload_opener($msg = '')
{
    global $g5;


    echo "<meta http-equiv=\"content-type\" content=\"text/html; charset=utf-8\">";
    echo "<script>";
    if ($msg) echo "alert('" . $msg . "');";
    echo "opener.location.reload();";
    echo "self.close();";
    echo "</script>";
    exit;
}



function get_it_item($it_id)
{
    global $g5;
    $sql = "SELECT * from {$g5['g5_shop_item_table']} where it_id = '{$it_id}'";
    $result = sql_query($sql);
    return sql_fetch_array($result);
}




function get_it_item_album($it2, $it3)
{
    global $g5;
    $sql = "SELECT * 
            from {$g5['g5_shop_item_table']} 
            where it_1='album'
            and it_2 = '{$it2}'
            and it_3 = '{$it3}'
            ";
    //echo $sql."<BR>";
    $result = sql_query($sql);
    return sql_fetch_array($result);
}

// 최신글 추출
// $cache_time 캐시 갱신시간
function latest_shop($skin_dir = '', $ca_id, $rows = 10, $subject_len = 40, $cache_time = 1, $options = '')
{
    global $g5;

    if (!$skin_dir) $skin_dir = 'basic';

    if (preg_match('#^theme/(.+)$#', $skin_dir, $match)) {
        if (G5_IS_MOBILE) {
            $latest_skin_path = G5_THEME_MOBILE_PATH . '/' . G5_SKIN_DIR . '/latest/' . $match[1];
            if (!is_dir($latest_skin_path))
                $latest_skin_path = G5_THEME_PATH . '/' . G5_SKIN_DIR . '/latest/' . $match[1];
            $latest_skin_url = str_replace(G5_PATH, G5_URL, $latest_skin_path);
        } else {
            $latest_skin_path = G5_THEME_PATH . '/' . G5_SKIN_DIR . '/latest/' . $match[1];
            $latest_skin_url = str_replace(G5_PATH, G5_URL, $latest_skin_path);
        }
        $skin_dir = $match[1];
    } else {
        if (G5_IS_MOBILE) {
            $latest_skin_path = G5_MOBILE_PATH . '/' . G5_SKIN_DIR . '/latest/' . $skin_dir;
            $latest_skin_url  = G5_MOBILE_URL . '/' . G5_SKIN_DIR . '/latest/' . $skin_dir;
        } else {
            $latest_skin_path = G5_SKIN_PATH . '/latest/' . $skin_dir;
            $latest_skin_url  = G5_SKIN_URL . '/latest/' . $skin_dir;
        }
    }



    $list = array();

    $categoryrow = sql_fetch("select * from {$g5['g5_shop_category_table']} where ca_id ='{$ca_id}' ");

    $category_name = $categoryrow['ca_name'];

    $sql = " select * from {$g5['g5_shop_item_table']} where ca_id ='{$ca_id}' and it_use = 1 order by it_id limit 0, {$rows} ";
    //echo $sql."<BR>";
    $result = sql_query($sql);
    for ($i = 0; $row = sql_fetch_array($result); $i++) {
        $list[$i] = $row;
        $list[$i]['img'] = get_image($row['it_id'], 200);
    }


    ob_start();
    include $latest_skin_path . '/latest.skin.php';
    $content = ob_get_contents();
    ob_end_clean();

    return $content;
}



// 상품이미지 썸네일 생성
function get_it_thumbnail_url($img, $width, $height = 0, $id = '', $is_crop = false)
{
    $str = '';

    if ($replace_tag = run_replace('get_it_thumbnail_tag', $str, $img, $width, $height, $id, $is_crop)) {
        return $replace_tag;
    }

    $file = G5_DATA_PATH . '/item/' . $img;
    if (is_file($file))
        $size = @getimagesize($file);

    if ($size[2] < 1 || $size[2] > 3)
        return '';

    $img_width = $size[0];
    $img_height = $size[1];
    $filename = basename($file);
    $filepath = dirname($file);

    if ($img_width && !$height) {
        $height = round(($width * $img_height) / $img_width);
    }

    $thumb = thumbnail($filename, $filepath, $filepath, $width, $height, false, $is_crop, 'center', false, $um_value = '80/0.5/3');


    $file_url = str_replace(G5_PATH, G5_URL, $filepath . '/' . $thumb);
    $str = $file_url;

    return $str;
}



// 주석은 간결하게 


// 스팟이미지 업로드
function spot_img_upload($srcfile, $filename, $dir)
{
    if ($filename == '')
        return '';

    $size = @getimagesize($srcfile);
    if ($size[2] < 1 || $size[2] > 3)
        return '';

    //php파일도 getimagesize 에서 Image Type Flag 를 속일수 있다
    if (!preg_match('/\.(gif|jpe?g|png)$/i', $filename))
        return '';

    if (!is_dir($dir)) {
        @mkdir($dir, G5_DIR_PERMISSION);
        @chmod($dir, G5_DIR_PERMISSION);
    }

    $pattern = "/[#\&\+\-%@=\/\\:;,'\"\^`~\|\!\?\*\$#<>\(\)\[\]\{\}]/";

    $filename = preg_replace("/\s+/", "", $filename);
    $filename = preg_replace($pattern, "", $filename);

    $filename = preg_replace_callback(
        "/[가-힣]+/",
        create_function('$matches', 'return base64_encode($matches[0]);'),
        $filename
    );

    $filename = preg_replace($pattern, "", $filename);
    $prepend = '';

    // 동일한 이름의 파일이 있으면 파일명 변경
    if (is_file($dir . '/' . $filename)) {
        for ($i = 0; $i < 20; $i++) {
            $prepend = str_replace('.', '_', microtime(true)) . '_';

            if (is_file($dir . '/' . $prepend . $filename)) {
                usleep(mt_rand(100, 10000));
                continue;
            } else {
                break;
            }
        }
    }

    $filename = $prepend . $filename;

    upload_file($srcfile, $filename, $dir);

    $file = str_replace(G5_DATA_PATH . '/spot/', '', $dir . '/' . $filename);

    return $file;
}


// 파일을 업로드 함
function upload_file2($srcfile, $destfile, $dir)
{
    if ($destfile == "") return false;
    // 업로드 한후 , 퍼미션을 변경함
    @move_uploaded_file($srcfile, $dir . '/' . $destfile);
    @chmod($dir . '/' . $destfile, G5_FILE_PERMISSION);
    return true;
}




// 환전요청
function request_point($mb_id, $point, $content = '', $po_status = '', $po_desc = '')
{
    global $config;
    global $g5;
    global $is_admin;

    // 포인트 사용을 하지 않는다면 return
    if (!$config['cf_use_point']) {
        return 0;
    }

    // 포인트가 없다면 업데이트 할 필요 없음
    if ($point == 0) {
        return 0;
    }

    // 회원아이디가 없다면 업데이트 할 필요 없음
    if ($mb_id == '') {
        return 0;
    }
    $mb = sql_fetch(" SELECT mb_id from {$g5['member_table']} where mb_id = '$mb_id' ");
    if (!$mb['mb_id']) {
        return 0;
    }

    // 회원포인트
    $mb_point = get_point_sum($mb_id);

    // 이미 등록된 내역이라면 건너뜀 - 반복기능 추가  --확인할방법없음
    /*
    if (!$repeat && ($rel_table || $rel_id || $rel_action))
    {
        $sql = " SELECT count(*) as cnt from {$g5['exchange_table']}
                  where mb_id = '$mb_id'
                    and po_rel_table = '$rel_table'
                    and po_rel_id = '$rel_id'
                    and po_rel_action = '$rel_action' ";
        $row = sql_fetch($sql);
        if ($row['cnt'])
            return -1;
    }
    */
    if ($mb_point < $point) return 0;  // 소유한 Cel보다 화전요구한게 많으면 취소

    $po_mb_point = $mb_point + $point;
    $money = $point * 100;
    $sql = " INSERT INTO {$g5['exchange_table']}
                set mb_id = '$mb_id',
                    po_datetime = '" . G5_TIME_YMDHIS . "',
                    po_content = '" . addslashes($content) . "',
                    po_cel = '$point',
                    po_money = '$money',
                    po_use_point = '0',
                    po_mb_point = '$po_mb_point',
                    po_status = '$po_status',
                    po_desc = '$po_desc' ";
    sql_query($sql);

    // XP UPDATE
    //update_xp($mb_id, $point, $content, $rel_table, $rel_action);

    return 1;
}




// 환전 포인트 부여
function insert_point_ex($mb_id, $point, $content = '', $rel_table = '', $rel_id = '', $rel_action = '', $expire = 0, $repeat = 0)
{
    global $config;
    global $g5;
    global $is_admin;

    $receive = "<pre>";
    $receive .= " mb_id : " . $mb_id . "<BR>";
    $receive .= " point : " . $point . "<BR>";
    $receive .= " content : " . $content . "<BR>";
    $receive .= " rel_table : " . $rel_table . "<BR>";
    $receive .= " rel_id : " . $rel_id . "<BR>";
    $receive .= " rel_action : " . $rel_action . "<BR>";
    $receive .= "</pre>";
    //echo $receive;
    // 포인트 사용을 하지 않는다면 return
    //if (!$config['cf_use_point']) { return 0; }
    //echo "1"."<BR>";
    // 포인트가 없다면 업데이트 할 필요 없음
    if ($point == 0) {
        return 0;
    }
    //echo "2"."<BR>";
    // 회원아이디가 없다면 업데이트 할 필요 없음
    if ($mb_id == '') {
        return 0;
    }
    $mb = sql_fetch(" SELECT mb_id from {$g5['member_table']} where mb_id = '$mb_id' ");
    if (!$mb['mb_id']) {
        return 0;
    }
    //echo "3"."<BR>";
    // 회원포인트
    $mb_point = get_point_sum($mb_id);
    //echo "4"."<BR>";
    // 이미 등록된 내역이라면 건너뜀 - 반복기능 추가
    if (!$repeat && ($rel_table || $rel_id || $rel_action)) {
        $sql = " SELECT count(*) as cnt from {$g5['point_table']}
                  where mb_id = '$mb_id'
                    and po_rel_table = '$rel_table'
                    and po_rel_id = '$rel_id'
                    and po_rel_action = '$rel_action' ";
        $row = sql_fetch($sql);
        //echo "<pre>".$sql."<BR>"."</pre>";    
        if ($row['cnt']) {
            //echo "<pre> cnt : ".$row['cnt']."<BR>"."</pre>";    
            return -1;
        }
    }
    //echo "5"."<BR>";
    // 포인트 건별 생성
    $po_expire_date = '9999-12-31';
    if ($config['cf_point_term'] > 0) {
        if ($expire > 0)
            $po_expire_date = date('Y-m-d', strtotime('+' . ($expire - 1) . ' days', G5_SERVER_TIME));
        else
            $po_expire_date = date('Y-m-d', strtotime('+' . ($config['cf_point_term'] - 1) . ' days', G5_SERVER_TIME));
    }
    //echo "6"."<BR>";
    $po_expired = 0;
    if ($point < 0) {
        $po_expired = 1;
        $po_expire_date = G5_TIME_YMD;
    }
    //echo "7"."<BR>";    
    $po_mb_point = $mb_point + $point;

    $sql = " INSERT INTO {$g5['point_table']}
                set mb_id = '$mb_id',
                    po_datetime = '" . G5_TIME_YMDHIS . "',
                    po_content = '" . addslashes($content) . "',
                    po_point = '$point',
                    po_use_point = '0',
                    po_mb_point = '$po_mb_point',
                    po_expired = '$po_expired',
                    po_expire_date = '$po_expire_date',
                    po_rel_table = '$rel_table',
                    po_rel_id = '$rel_id',
                    po_rel_action = '$rel_action' ";
    //echo "<pre>".$sql."<BR>"."</pre>";    
    sql_query($sql);
    //echo "8"."<BR>";
    // 포인트를 사용한 경우 포인트 내역에 사용금액 기록
    if ($point < 0) {
        insert_use_point($mb_id, $point);
    }
    //echo "9"."<BR>";
    // 포인트 UPDATE
    $sql = " update {$g5['member_table']} set mb_point = '$po_mb_point' where mb_id = '$mb_id' ";
    sql_query($sql);
    //echo "10"."<BR>";
    // XP UPDATE
    update_xp($mb_id, $point, $content, $rel_table, $rel_action);
    //echo "11"."<BR>";
    return 1;
}




// 회원 정보를 얻는다.
function get_member_email($mb_id, $fields = '*')
{
    global $g5;

    //$mb_id = preg_replace("/[^0-9a-z_]+/i", "", $mb_id);

    return sql_fetch(" select $fields from {$g5['member_table']} where mb_id = TRIM('$mb_id') ");
}




// 상태 옵션을 얻음
function get_status_option($bo_table = '', $status = '')
{
    global $g5, $board, $is_admin, $aslang;

    $statuses = array("신청", "확인중", "유효", "정지", "탈퇴");
    $str = "";
    for ($i = 0; $i < count($statuses); $i++) {
        $this_status = trim($statuses[$i]);
        if (!$this_status) continue;
        if (!$is_admin && $i > 0)
            break;

        $str .= "<option value=\"$statuses[$i]\"";
        if ($this_status == $status) {
            $str .= ' selected="selected"';
        }
        $str .= ">$statuses[$i]</option>\n";
    }

    return $str;
}




// 클래스를 Item대상으로 추출 기능 
function procClassToItem($vals)
{
    global $g5;
    //print_r2($vals);

    foreach ($vals as $key => $val) {
        $$key = isset($vals[$key]) ? strip_tags($vals[$key]) : '';
    }
    $sqlc = "SELECT * from {$g5['class_item_table']} a
             where bo_table = '{$it_3}' and wr_id ='{$it_2}' order by cls_no ";

    //echo $sqlc."<BR>";
    $result = sql_query($sqlc);
    $list = array();
    for ($i = 0; $row = sql_fetch_array($result); $i++) {
        $days = str_replace('.','',str_replace('-','', $row['day']));
        $datetime = substr($days, 0, 4) . "." . substr($days, 4, 2) . "." . substr($days, 6, 2) . ". " . $row['time'].":".$row['minute'];
        $tot = $row['tot'];
        $list[$i] = array();
        $list[$i]['date'] = $datetime;
        $list[$i]['tot'] = $tot;
        $list[$i]['content'] = $row['content'];
        $list[$i]['idx'] = $row['idx'];
        $list[$i]['it_id'] = $row['it_id'];
        $list[$i]['it_form'] = $row['moa_form'];
    }
    //print_r2($list);
    return $list;
}


// BBS 를 Item으로 변환하는 기능 
function procWrite2Item($bo_table, $wr_id)
{
    global $g5;
    //echo "album_no : ".$album_no."<BR>";
    if (!$bo_table || !$wr_id)
        return false;
    $write_table = $g5['write_prefix'] . $bo_table;
    $sql = "SELECT * from {$write_table} where wr_id = '{$wr_id}'";
    $moa = sql_fetch($sql);

    $vals['ca_id'] = '10';   // 카테고리는 기본 카테고리.. 추후 장르에 따라. 분류 나중에..
    //$vals['ca_id'] = $ca['ca_id'];   // 
    $x = 0;
    $vals['it_1'] = 'moa';
    $vals['it_2'] = $moa['wr_id'];
    $vals['it_3'] = $bo_table;
    $list = procClassToItem($vals);
    $cnts = 0;
    if ($list)
        $cnts = count($list);
    for ($i = 0; $i < $cnts; $i++) {
        $vals = array();
        //$genre = "모임";
        $genre = $moa['ca_name'];
        $sqlc = "SELECT * from {$g5['g5_shop_category_table']} a
                 where ca_name like '%{$genre}%' 
                 order by length(ca_id) 
                 desc limit 1 ";
        $rows = sql_fetch($sqlc);
        $ca_id = $rows['ca_id'];
        $vals['ca_id'] = $ca_id;   // 카테고리는 '모임' 기본 
        $chkit = true;
        if ($list[$i]['it_id']) {
            $vals['it_id'] = $list[$i]['it_id'];
            $vals['procType'] = 'update';
            $it = get_it_item($vals['it_id']);

            if ($it['it_id']) {
                $chkit = false;
            }
        }

        if ($chkit) {
            $vals['it_id'] = "moa_" . (time() + $x);
            $vals['procType'] = 'new';
        }
        $x++;

        $vals['it_cust_price'] = ($moa['wr_3']) ? $moa['wr_3'] : 0;   // 0원이면 기본 10만원으로
        $vals['it_price'] = ($moa['wr_4']) ? $moa['wr_4'] : 0;   // 0원이면 기본 10만원으로
        $vals['it_name'] = $moa['wr_subject'];
        $vals['it_model'] = $list[$i]['content'];
        $vals['it_explan'] = $moa['wr_content'];
        $vals['it_basic'] = $moa['wr_content'];
        $vals['it_brand'] = $it_basic = $moa['wr_name'];
        $vals['it_use'] = '1';
        if ($list[$i]['moa_form'] == "고정형") {
            $vals['it_stock_qty'] = $moa['wr_1'];
            $vals['pt_tag'] = $moa['as_tag'];
            $vals['pt_id'] = $moa['mb_id'];
            $vals['it_tel_inq'] = "0";
            $vals['it_stock_qty'] = $list[$i]['tot'];
        } else {
            $vals['it_tel_inq'] = "1";
            $vals['it_stock_qty'] = 9999999;
        }

        $vals['it_1'] = 'moa';
        $vals['it_2'] = $moa['wr_id'];
        $vals['it_3'] = $bo_table;
        $vals['it_4'] = $list[$i]['date'];
        $vals['it_5'] = $list[$i]['tot'];
        $vals['it_6'] = $list[$i]['content'];
        $vals['it_7'] = $list[$i]['idx'];
        $vals['it_8'] = $moa['wr_4'];



        if ($vals['it_id']) {
            $it = procItemAdd($vals);
            if ($vals['it_id']) {
                $upsql = "UPDATE {$g5['class_item_table']}
                              SET it_id = '{$vals['it_id']}'
                              where idx  = '{$list[$i]['idx']}'  ";
                sql_query($upsql);
                //echo $upsql."<BR>";
            }
            //procOptionAdd($vals);
            itemdeleteInBbs($vals['it_id']);
            lec_copy_file($bo_table, $moa['wr_id'], $vals['it_id']);
        }
    }
    //print_r2($list); 
    //print_r2($vals); exit;
    return $vals['it_id'];
}


// Item을 조건에 따라 추가하는 기능 
function procItemAdd($vals)
{
    global $g5;
    //print_r2($vals);

    foreach ($vals as $key => $val) {
        //echo $key."<BR>";
        $$key = isset($vals[$key]) ? strip_tags($vals[$key]) : '';
        //echo $$key."<BR>";

    }
    $sqlc = "SELECT * from {$g5['g5_shop_category_table']} a
             where ca_name like '%{$genre}%' order by length(ca_id) desc limit 1 ";
    $rows = sql_fetch($sqlc);
    $ca_id2 = '';
    if ($rows && $rows['ca_id'])
        $ca_id2 = $rows['ca_id'];
    $sql_common = " ca_id               = '10',
                    ca_id2              = '$ca_id2',
                    it_name             = '$it_name',
                    it_brand            = '$it_brand',
                    it_model            = '$it_model',
                    it_basic            = '$it_basic',
                    it_info_gubun            = 'digital_contents',
                    it_option_subject            = '일자',
                    it_explan           = '$it_explan',
                    it_cust_price            = '$it_cust_price',
                    it_price            = '$it_price',
                    it_origin           = '$it_origin',
                    it_use              = '$it_use',
                    it_ip               = '{$_SERVER['REMOTE_ADDR']}',
                    it_order            = '$it_order',
                    pt_tag              = '$pt_tag',
                    it_sc_type          = '1',
                    it_stock_qty        = '$it_stock_qty',
                    it_1 = '{$it_1}',
                    it_2 = '{$it_2}',
                    it_3 = '{$it_3}',
                    it_4 = '{$it_4}',
                    it_5 = '{$it_5}',
                    it_6 = '{$it_6}',
                    it_7 = '{$it_7}',
                    it_8 = '{$it_8}',
                    pt_id = '{$pt_id}'

                    "; // APMS : 2014.07.20



    $t_it_id = preg_replace("/[A-Za-z0-9\-_]/", "", $it_id);
    if ($t_it_id)
        alert('코드는 영문자, 숫자, -, _ 만 사용할 수 있습니다.');

    $pt_num = time();
    $sql_common .= " , it_time = '" . G5_TIME_YMDHIS . "' ";
    $sql_common .= " , it_update_time = '" . G5_TIME_YMDHIS . "' ";
    if ($vals['procType'] == 'new') {
        $sql = " insert {$g5['g5_shop_item_table']} 
                    set it_id = '$it_id',
                        pt_num = '$pt_num',
                        $sql_common ";
    } else if ($vals['procType'] == "update") {
        $sql = " update  {$g5['g5_shop_item_table']} 
                    set pt_num = '$pt_num',
                        $sql_common 
                    where it_id = '$it_id' ";
    }


    //echo $sql."<BR>";
    if (!trim($it_id)) {
        alert('코드가 없으므로 추가하실 수 없습니다.');
    }

    if ($it_name)
        sql_query($sql);
    return $it_id;
    //}
}



// Item Option 추가하는 기능 
function procOptionAdd($vals)
{
    global $g5;
    //print_r2($vals);

    foreach ($vals as $key => $val) {
        //echo $key."<BR>";
        $$key = isset($vals[$key]) ? strip_tags($vals[$key]) : '';
        //echo $$key."<BR>";

    }
    $sqlc = "SELECT * from {$g5['class_item_table']} a
             where bo_table = '{$it_3}'and wr_id ='{$it_2}' order by cls_no ";
    //echo $sqlc."<BR>";
    $result = sql_query($sqlc);
    for ($i = 0; $row = sql_fetch_array($result); $i++) {
        //day
        //time
        //content
        //tot
        $io_id = substr($row['day'], 0, 4) . "." . substr($row['day'], 4, 2) . "." . substr($row['day'], 6, 2) . ". " . $row['time'];
        $io_price = 0;
        $io_stock_qty = $row['tot'];
        $io_noti_qty = ($row['tot'] - 2 > 0) ? $row['tot'] - 2 : $row['tot'];
        $sqlio = "SELECT count(*) cnt from {$g5['g5_shop_item_option_table']} 
                  where io_id = '{$io_id}' and it_id ='{$it_id}'";
        //echo $sqlio."<BR>";
        $chkio = sql_fetch($sqlio);

        $sql_add1 = " io_id               = '{$io_id}' ";
        $sql_add2 = " it_id             = '{$it_id}' ";

        $sql_common = " io_type              = '0',
                        io_use              = '1',
                        io_stock_qty            = '{$io_stock_qty}',
                        io_noti_qty            = '{$io_noti_qty}',
                        io_price            = '{$io_price}'
                        "; // APMS : 2019.09.05

        if ($chkio['cnt'] == 0) {
            $sql = " INSERT {$g5['g5_shop_item_option_table']} 
                    set $sql_add1 , $sql_add2, $sql_common ";
        } else if ($vals['procType'] == "update") {
            $sql = " UPDATE  {$g5['g5_shop_item_option_table']} 
                    set $sql_common 
                    where $sql_add1 and $sql_add2 ";
        }
        //echo $sql."<BR>";
        sql_query($sql);
    }
    //exit;

}






// 기본적으로 수업정보 추출 
// 사용방법 
//  $view = get_bbs($wr_id);
function get_bbs($wr_id, $bo_table = 'class')
{
    global $g5;
    if (!$wr_id)
        return false;
    $write_table = $g5['write_prefix'] . $bo_table;
    $bbs = get_write($write_table, $wr_id);
    $board = sql_fetch(" select * from {$g5['board_table']} where bo_table = '$bo_table' ");
    return get_view($bbs, $board, '');
}

// 상품기본정보 추출 
// 사용방법
// $it = get_item_info($it_id)
function get_item_info($it_id)
{
    global $g5;
    if (!$it_id)
        return false;
    $sql = "SELECT * from {$g5['g5_shop_item_table']} 
            where it_id = '{$it_id}' ";

    return sql_fetch($sql);
}

// 수업의 상세 정보 추출 

function get_item_detail($it_id)
{
    global $g5;
    if (!$it_id)
        return false;

    $sql = "SELECT a.* from {$g5['class_item_table']} a, {$g5['g5_shop_item_table']} b
            where a.wr_id = b.it_2
            and a.bo_table = b.it_3
            and b.it_id = '{$it_id}'
            order by cls_no";
    $list = array();
    $result = sql_query($sql);
    for ($i = 0; $row = sql_fetch_array($result); $i++) {
        $list[$i] = $row;
    }
    return $list;
}

function checkProfile($mb_id)
{
    global $g5;
    if (!$mb_id)
        return false;
    $bo_table = 'teachers';
    $write_table = "g5_write_" . $bo_table;
    $sql = "SELECT count(*) cnt  from $write_table 
            where mb_id = '{$mb_id}'";

    //echo $sql."<BR>";
    $row = sql_fetch($sql);
    return ($row['cnt'] > 0) ? true : false;
}

function get_portfolio($mb_id)
{
    global $g5;
    if (!$mb_id)
        return false;
    $bo_table = 'teachers';
    $write_table = "g5_write_" . $bo_table;
    $sql = "SELECT * from $write_table 
            where mb_id = '{$mb_id}'";

    //echo $sql."<BR>";
    $row = sql_fetch($sql);
    $file = get_file2($bo_table, $row['wr_id']);
    $list = array();
    $sql3 = "SELECT * from {$g5['teacher_history_table']}
             where wr_id = '{$row['wr_id']}' and bo_table = 'teachers' order by bh_no";
    $result3 = sql_query($sql3);
    $list['info'] = array();
    $list['info'] = $row;
    $list['profile'] = $file;
    $list['history'] = array();
    for ($i = 0; $rows = sql_fetch_array($result3); $i++) {
        $list['history'][$i] = array();
        $list['history'][$i] = $rows;
    }
    return $list;
}

function get_history($mb_id)
{
    global $g5;
    if (!$mb_id)
        return false;
    $bo_table = 'teachers';
    $write_table = "g5_write_" . $bo_table;
    $sql = "SELECT * from $write_table 
            where mb_id = '{$mb_id}'";

    //echo $sql."<BR>";
    $row = sql_fetch($sql);
    $file = get_file2($bo_table, $row['wr_id']);
    $list = array();
    $sql3 = "SELECT * from {$g5['teacher_history_table']}
             where wr_id = '{$row['wr_id']}' and bo_table = 'teachers' order by bh_no";
    $result3 = sql_query($sql3);
    $list['info'] = array();
    $list['info'] = $row;
    $list['profile'] = $file;
    $list['history'] = array();
    for ($i = 0; $rows = sql_fetch_array($result3); $i++) {
        $list['history'][$i] = array();
        $list['history'][$i] = $rows;
    }
    return $list;
}


function get_portid($mb_id)
{
    global $g5, $member;
    if (!$mb_id)
        alert('적상적으로 접근하세요!');
    $bo_table = 'teachers';
    $write_table = "g5_write_" . $bo_table;
    $sql = "SELECT wr_id from $write_table 
            where mb_id = '{$mb_id}'";
    $row = sql_fetch($sql);
    return $row['wr_id'];
}


function get_myportfolio()
{
    global $g5, $member;
    if (!$member['mb_id'])
        alert('로그인후 시도하세요!');

    $wr_id = get_portid($member['mb_id']);
    if (!$wr_id)
        $str = "";
    else
        $str = G5_BBS_URL . "/board.php?bo_table=teachers&wr_id=" . $wr_id;
    return $str;
}



// Get Tag
function bbs_get_tag($it_tag, $opt = '')
{

    $it_tag = apms_get_text($it_tag);

    if (!$it_tag) return;

    $tag = array();
    $tag = explode(",", $it_tag);

    if ($opt) { //해시태그
        $hash1 = '<span class="hash-tag">#';
        $hash2 = '</span>';
    } else {
        $hash1 = '';
        $hash2 = '';
    }

    $sec = ', ';
    $list = '';
    foreach ($tag as $val) {
        $val = trim($val);
        $list .= '<a href="' . G5_BBS_URL . '/board.php?bo_table=class&sfl=as_tag&stx=' . urlencode($val) . '" rel="tag">' . $hash1 . $val . $hash2 . '</a>' . $sec;
    }

    $list = substr($list, 0, strlen($list) - strlen($sec));

    return $list;
}




if (!function_exists("itemdeleteInBbs")) {

    // 상품삭제
    // 메세지출력후 주문개별내역페이지로 이동
    function itemdeleteInBbs($it_id)
    {
        global $g5, $is_admin;

        $sql = " select it_explan, it_mobile_explan, it_img1, it_img2, it_img3, it_img4, it_img5, it_img6, it_img7, it_img8, it_img9, it_img10, pt_thumb
                    from {$g5['g5_shop_item_table']} where it_id = '$it_id' ";
        $it = sql_fetch($sql);

        // 상품 이미지 삭제
        $dir_list = array();
        for ($i = 1; $i <= 10; $i++) {
            $file = G5_DATA_PATH . '/item/' . $it['it_img' . $i];
            if (is_file($file) && $it['it_img' . $i]) {
                @unlink($file);
                $dir = dirname($file);
                delete_item_thumbnail($dir, basename($file));

                if (!in_array($dir, $dir_list))
                    $dir_list[] = $dir;
            }
        }



        // APMS : 파일삭제 - 2014.07.20
        apms_delete_file('item', $it_id);

        // APMS : 폴더삭제 - 2014.07.25
        //apms_delete_dir($it_id);
    }
}

itemdeleteInBbs($it_id);


// 상품별 Wish 갯수 추출 
function get_wishcnt($it_id)
{
    global $g5;

    $sql = "SELECT count(*) cnt from {$g5['g5_shop_wish_table']}
            where it_id = '{$it_id}' ";
    $row = sql_fetch($sql);
    return $row['cnt'];
}

// 상품에 내가 Wish 했는지 확인 
function chk_wishcnt($it_id, $mb_id)
{
    global $g5;

    $sql = "SELECT count(*) cnt from {$g5['g5_shop_wish_table']}
            where it_id = '{$it_id}' and mb_id='{$mb_id}' ";
    $row = sql_fetch($sql);
    return $row['cnt'];
}


function get_random_str()
{
    $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
    $var_size = strlen($chars);
    $rtnstr = "";
    $size = mt_rand(10, 20);
    for ($x = 0; $x < $size; $x++) {
        $random_str = $chars[rand(0, $var_size - 1)];
        $rtnstr .= $random_str;
    }
    return $rtnstr;
}

// 추천인 코드 발생
function getRecommendCode()
{
    $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
    $var_size = strlen($chars);
    $rtnstr = "";
    $size = mt_rand(8, 10);
    for ($x = 0; $x < $size; $x++) {
        $random_str = $chars[rand(0, $var_size - 1)];
        $rtnstr .= $random_str;
    }
    return $rtnstr;
}


function get_random_num($length=6)
{
    $chars = "1234567890";
    $var_size = strlen($chars);
    $rtnstr = "";
    $size = mt_rand($length, $length);
    for ($x = 0; $x < $size; $x++) {
        $random_str = $chars[rand(0, $var_size - 1)];
        $rtnstr .= $random_str;
    }
    return $rtnstr;
}

// 모임카테고리 불러오기 
// reutrn array()
function getCaListOfClass()
{
    global $g5;
    $sql = "SELECT bo_category_list ca_list 
            from {$g5['board_table']}
            where bo_table = 'class' 
            ";
    $row = sql_fetch($sql);
    $ca_list = explode("|", $row['ca_list']);
    return $ca_list;
}

//좋아요체크
function checkLikeOn($bo_table, $it_id, $mb_id)
{
    global $g5;
    $sql = "SELECT count(*) cnt from {$g5['apms_good']} 
            where it_id = '{$it_id}'
            and mb_id = '{$mb_id}' ";
    $row = sql_fetch($sql);
    if ($row['cnt'] > 0)
        return true;
    else
        return false;
}

//상품코드로 모임정보추출  2022-05-11
function getWrInIt($it_id)
{
    global $g5;
    $write_table = $g5['write_prefix'] . 'class';

    $sql = "SELECT
                wr_subject  -- 모임제목
                , wr_content  -- 소개
                , wr_name -- 글쓴이닉네임
                , wr_good -- 추천수
                , wr_1 -- 정원
                , wr_2 -- 기본가
                , wr_3 -- 할인가
                , wr_4 -- 사용안함(미정)
                , wr_5 -- 최소인원
                , ca_name -- 카테고리
                , as_thumb  -- 썸네일
                , as_star_cnt -- 별갯수(미사용중)
                , as_tag -- 해시태그
                , as_icon 
                , as_map
                , mb_id -- 모임개설자ID
                , moa_curriculum    -- 커리큘럼
                , moa_supplies  -- 준비물
                , moa_support  -- 제공품
                , moa_nosupport -- 미제공품
                , moa_totime -- 모임시간(~120분)
                , moa_reglimittime -- 모임신청가능시간
                , moa_type -- 모임유형
                , moa_onoff  -- 온.오프라인
                , moa_area1 -- 지역1 
                , moa_area2  -- 지역2
                , moa_status  -- 상태 (1 유효)
                , moa_addr1  -- 주소1
                , moa_addr2  -- 주소2
                , moa_zipcode  -- 우편번호
                , moa_latitude  -- 위치정보
                , moa_longitude  -- 위치정보
                , wr_id
            FROM {$g5['g5_shop_item_table']} a,
             {$write_table} b
            WHERE a.it_id = '{$it_id}'
            and a.it_2 = b.wr_id
            ";
    $row = sql_fetch($sql);
    return $row;
}


// 해시태그 리스트
function getHashTagList($bo_table = 'class')
{
    global $g5;

    $sql = "SELECT bo_table, it_id, wr_id, mb_id, TYPE, idx, tag, sum(cnt) cnt
            FROM (
                SELECT 
                    a.bo_table 
                    , if (a.it_id = '', 
                        (SELECT it_id FROM g5_shop_item i 
                        WHERE i.it_2 = a.wr_id LIMIT 1), a.it_id) it_id
                    , a.wr_id
                    , a.mb_id
                    , b.type
                    , b.idx
                    , b.tag
                    , b.cnt 
                FROM g5_apms_tag_log a , g5_apms_tag b
                WHERE a.bo_table = 'class'
                    AND a.tag_id = b.id
                
                ORDER BY b.tag desc
            ) xx
            WHERE it_id <> ''
            GROUP BY idx, tag
            ORDER BY cnt desc, idx asc";
    $result = sql_query($sql);
    $list = array();
    while ($row = sql_fetch_array($result)) {
        $list[] = $row;
    }
    return $list;
}

// It_id 에 신청된 주문건(신청건)
// return Integer
function getAplyCountIt($it_id)
{
    global $g5;

    if (!$it_id)
        return 0;
    $sql = "SELECT COUNT(*) cnt
            FROM g5_shop_order a, g5_shop_cart b
            WHERE a.od_id = b.od_id
            AND b.it_id = '{$it_id}'
            AND a.od_status = '완료'
            ";
    $row = sql_fetch($sql);
    return $row['cnt'];
}


//인기카테고리 추출
// 배열 (카테고리명, 히트수) 역순
function getHitCategory()
{
    global $g5;

    $sql = "SELECT ca_name, wr_id, sum(wr_hit) cnt  
    FROM g5_write_class
    WHERE ca_name <> ''
    GROUP BY ca_name
    ORDER BY sum(wr_hit) desc";
    $result = sql_query($sql);
    $list = array();
    while ($row = sql_fetch_array($result)) {
        $list[] = $row;
    }
    return $list;
}

// 인기 모임순  - 정보
// 배열로 받아오기
function getFavoriteClass($limit = 10, $ca_name)
{
    global $g5;
    $common = '';
    if($ca_name || $ca_name != '') { $common = " WHERE ca_name = '{$ca_name}'"; }
    $sql = "SELECT * FROM (
                SELECT
                    wr_id   
                    , (SELECT it_id FROM g5_shop_item i 
                        WHERE i.it_2 = a.wr_id LIMIT 1) it_id
                    , wr_subject  -- 모임제목
                    , wr_content  -- 소개
                    , wr_name -- 글쓴이닉네임
                    , wr_good -- 추천수
                    , wr_1 -- 정원
                    , wr_2 -- 기본가
                    , wr_3 -- 할인가
                    , wr_4 -- 사용안함(미정)
                    , wr_5 -- 최소인원
                    , ca_name -- 카테고리
                    , as_thumb  -- 썸네일
                    , as_star_cnt -- 별갯수(미사용중)
                    , as_tag -- 해시태그
                    , as_icon 
                    , as_map
                    , mb_id -- 모임개설자ID
                    , moa_curriculum    -- 커리큘럼
                    , moa_supplies  -- 준비물
                    , moa_support  -- 제공품
                    , moa_nosupport -- 미제공품
                    , moa_totime -- 모임시간(~120분)
                    , moa_reglimittime -- 모임신청가능시간
                    , moa_type -- 모임유형
                    , moa_onoff  -- 온.오프라인
                    , moa_area1 -- 지역1 
                    , moa_area2  -- 지역2
                    , moa_status  -- 상태 (1 유효)
                    , moa_addr1  -- 주소1
                    , moa_addr2  -- 주소2
                    , moa_zipcode  -- 우편번호
                    , moa_latitude  -- 위치정보
                    , moa_longitude  -- 위치정보
                    
                FROM g5_write_class a {$common} 
                ORDER BY wr_hit desc
            ) xx
            WHERE xx.it_id <> '' LIMIT 0, {$limit}";
    $result = sql_query($sql);
    $list = array();
    while ($row = sql_fetch_array($result)) {
        $list[] = $row;
    }
    return $list;
}

//후기1건의 별점- Itid
function getStarpointIt($it_id)
{
    global $g5;

    $sql = "SELECT it_id, round(SUM(is_score) / COUNT(*)) starpoint, COUNT(*) cnt
            FROM g5_shop_item_use
            WHERE it_id = '{$it_id}' 
            GROUP BY it_id";
    $row = sql_fetch($sql);
    return $row;
}

//후기1건의 별점 - Wrid
function getStrpointWr($wr_id)
{
    global $g5;
    $sql = "SELECT 
                wr_id, 
                if (starpoint = '', 0, if (starpoint IS NULL, 0, starpoint)) starpoint, 
                cnt
            FROM ( SELECT b.it_2 wr_id, round(SUM(is_score) / COUNT(*)) starpoint, COUNT(*) cnt
                FROM g5_shop_item b
                left outer join g5_shop_item_use a on a.it_id = b.it_id
                Where b.it_2 <> ''
                AND b.it_2 = '{$wr_id}}'
                GROUP BY b.it_2
            ) xx
            ";
    //echo nl2br($sql); 
    $row = sql_fetch($sql);
    return $row;
}

function printSql($sql)
{
    global $g5, $member, $thruaddr2, $thisaddr, $_print;

    $prton = false;
    if (strrpos($member['mb_id'], 'pletho') !== false || $thruaddr2 == $thisaddr) {
        $prton = true;
    }

    if ($_print)
        $prton = true;

    if ($prton) {
        echo "<div style='height:100px;width:100%'>";
        echo "<div style='margin-left:200px;'>";
        echo nl2br($sql);
        echo "</div>";
        echo "</div>------------------------";
    }
}

function print_r3($arr)
{
    printVal($arr);
}

function printVal($arr)
{
    global $g5, $member, $thruaddr2, $thisaddr, $_print;

    $prton = false;
    if (strrpos($member['mb_id'], 'pletho') !== false || $thruaddr2 == $thisaddr) {
        $prton = true;
    }

    if ($_print)
        $prton = true;

    if ($prton) {
        //echo "<div style='height:100px;width:100%'>";
        //echo "<div style='margin-left:200px;'>";
        //echo 
        print_r2($arr);
        //echo "</div>";
        //echo "</div>------------------------";
    }
}

function getStatusValue($status)
{
    global $g5;
    $v = array(
        0 => "준비",
        1 => "승인",
        2 => "반려",
        3 => "삭제",
        4 => "취소",
        5 => "폐강"
    );
    return $v[$status];
}

// 호스트 프로필 이미지경로추출
function getHostProfileImg($pf_id)
{
    global $g5;

    $attach = apms_get_file('partner', $pf_id);
    $filename = G5_ADMIN_URL . "/img/temp/temp_user.png";
    if ($attach[4]['path'] && $attach[4]['file'])
        $filename = $attach[4]['path'] . "/" . $attach[4]['file'];
    return $filename;
}

// 호스트 프로필 이미지 출력
function viewHostProfileImg($pf_id)
{
    global $g5;

    echo "<img src='" . getHostProfileImg($pf_id) . "'>";
}



// 회원 프로필
function moaMemberProfile($mb_id)
{
    global $g5, $config, $bo_table;
    // "/images/profile_default.svg"
    //"/img/no-profile-img.png";

    $tmp_name = "/images/profile_default.svg";
    if ($mb_id) {
        if ($config['cf_use_member_icon']) {
            $mb_dir = substr($mb_id, 0, 2);
            $icon_file = G5_DATA_PATH . '/member/' . $mb_dir . '/' . $mb_id . '.gif';

            if (is_file($icon_file)) {
                $width = $config['cf_member_icon_width'];
                $height = $config['cf_member_icon_height'];
                $icon_file_url = G5_DATA_URL . '/member/' . $mb_dir . '/' . $mb_id . '.gif';
                $tmp_name = '<img src="' . $icon_file_url . '" width="' . $width . '" height="' . $height . '" alt=""> ';
            } else {
                $tmp_name = '<img src="' . $tmp_name . '">';
            }
        } else {
            $tmp_name = '<img src="' . $tmp_name . '">';
        }
        //$title_mb_id = '['.$mb_id.']';
    } else {
        $tmp_name = '<img src="' . $tmp_name . '">';
    }

    return $tmp_name;
}



// 추천인코드 자동추가 2022-05-18 pletho
if ($member['mb_id'] != "" && $member['invite_code'] == "") {
    $invite_code = getRecommendCode();
    $sql = "UPDATE {$g5['member_table']} SET invite_code = '{$invite_code}' where mb_id = '{$member['mb_id']}' ";
    sql_query($sql);
    $member['invite_code'] = $invite_code;
}


// 모임 신청자 등록처리 
function procClassAplyer($mb_id, $it_id, $status = '신청') {
    global $g5;
    echo $it_id."<BR>";
    $sql = "SELECT a.wr_id, a.day, a.time, a.minute, a.moa_form
                , b.*
            from 
                {$g5['class_item_table']} a, 
                {$g5['g5_shop_item_table']} b 
            where a.wr_id = b.it_2 
                and b.it_id = a.it_id
                and b.it_id = '{$it_id}' ";
    $row = sql_fetch($sql);
    //echo nl2br($sql)."<BR>";

    $sql_set = " mb_id = '{$mb_id}'
                , wr_id = '{$row['wr_id']}' 
                , it_id = '{$row['it_id']}' 
                , aplydate = '{$row['day']}'
                , aplytime = '{$row['time']}:{$row['minute']}'
                , man = 1
                , pay = '{$row['it_price']}'
                , regdate = now()
                , status = '{$status}' 
            ";
    $sql = "INSERT INTO {$g5['class_aplyer_table']} SET";
    $sql .= $sql_set;
    sql_query($sql);
    //echo nl2br($sql); exit;

    $sql = "UPDATE {$g5['class_item_table']} SET ";
    if ($status == '신청')
        $sql .= " aply = aply + 1 ";
    if ($status == '취소')
        $sql .= " aply = aply - 1 ";
    $sql .= " WHERE wr_id = '{$row['wr_id']}' and it_id='{$row['it_id']}' ";
    sql_query($sql);
}

// 신청가능여부 상품인지 체크 2022-05-21 
// 리턴값 true, false
function checkAbleClassAply($it_id)
{
    global $g5;

    $sql = "SELECT if (aply >= tot, false, true) able 
            from  {$g5['class_item_table']} 
            where it_id = '{$it_id}' ";
    $row = sql_fetch($sql);
    //echo nl2br($sql)."<BR>";
    return ($row['able']) ? true : false;
}


function get_partner($pt_id) {
    global $g5;

    $sql = "select * from g5_apms_partner where pt_id = '{$pt_id}'";
    $partner = sql_fetch($sql);
    return $partner;
}


function getSearchDays() {
    global $g5;
    $sqlday = "SELECT 
            CURDATE() today
            , DATE_SUB(curdate(), INTERVAL 1 MONTH) month1ago 
            , DATE_SUB(curdate(), INTERVAL 6 MONTH) month6ago 
            , DATE_SUB(curdate(), INTERVAL 1 YEAR) year1ago 
            , DATE_SUB(curdate(), INTERVAL 5 YEAR) year5ago ";
    return sql_fetch($sqlday);
}
         

//게시물의 좋아요수 리턴
function getCountLike($wr_id, $bo_table = 'class') {
    global $g5;

    $write_table = $g5['write_prefix'].$bo_table;
    $sql = "select count(*) cnt  from {$write_table} 
            where bo_table = '{$bo_table}' 
                and wr_id = '{$wr_id}'";
    $row = sql_fetch($sql);
    return ($row['cnt'])?$row['cnt']:0;
}


// 모임 신청자 목록
function getAplyerMoaClass($it_id) {
    global $g5;

    $sql = "SELECT a.`status`, a.it_id, a.wr_id, a.aplydate, a.aplytime, b.*, c.timelimit
            FROM g5_member b join deb_class_aplyer a
            on b.mb_id = a.mb_id join deb_class_item c
            on a.it_id = c.it_id
            WHERE a.it_id = '{$it_id}'
     ";

    $result = sql_query($sql);
    $list=  array();
    while ($row = sql_fetch_array($result)) {
        $list[] = $row;
    }
    return $list;
}

//모임신청이 존재하면 false는 
function checkAbleAplyerMoaClass($it_id, $mb_id) {
    global $g5;

    $sql = "SELECT count(*) cnt from deb_class_aplyer 
            WHERE it_id= '{$it_id}'
            and mb_id = '{$mb_id}'
            ";
    $rtn = true;
    $row = sql_fetch($sql);
    if ($row['cnt']>0)  {
        $rtn = false;
    }
    return $rtn;
}

//신청자수 카운트
function countAplyerMoaClass($it_id) {
    global $g5;

    $sql = "SELECT a.it_id, a.tot, count(b.mb_id) cnt
            FROM deb_class_item a, 
                deb_class_aplyer b
            where a.it_id = b.it_id
            and a.it_id = '{$it_id}'
            and b.status <> '취소'
            group by a.it_id  
            ";
    $row = sql_fetch($sql);
    return $row;

}


//공지사항 가져오기
function getListNotice($type='host',$bo_table = 'notice',$limit = 5) {
    global $g5;

    if ($type == 'host') {
       
        $skin_url = "/shop/partner/skin/board/Basic-Board";
        $skin_path = G5_PATH."/shop/partner/skin/board/Basic-Board";
        $board_skin_url = G5_URL."/shop/partner/skin/board/Basic-Board";
        $board_skin_path = G5_PATH."/shop/partner/skin/board/Basic-Board";
        $moa_adm_bbs_path = G5_PATH."/shop/partner/bbs/";
    }
    else {
        
        $skin_url = "/adm/skin/board/Basic-Board";
        $skin_path = G5_PATH."/adm/skin/board/Basic-Board";
        $board_skin_url = G5_URL."/adm/skin/board/Basic-Board";
        $board_skin_path = G5_PATH."/adm/skin/board/Basic-Board";
        $moa_adm_bbs_path = G5_PATH."/adm/bbs/";
    }
    
    $board = sql_fetch(" select * from {$g5['board_table']} where bo_table = '$bo_table' ");


    $write_table = $g5['write_prefix'].$bo_table;
    $sql = "SELECT wr_datetime regdate, wr_subject SUBJECT, wr_id
            FROM g5_write_notice
            where wr_id = wr_parent
            ORDER BY wr_id DESC LIMIT {$limit}";
    $list = array();
    $result = sql_query($sql);
    while($row = sql_fetch_array($result)) {
        $list[] = get_list_host($row, $board, $board_skin_url, G5_IS_MOBILE ? $board['bo_mobile_subject_len'] : $board['bo_subject_len']);
    }

    return $list;
}

// 최근일자별 방문자수
function getLatestVisitCountList($limit= 5) {
    global $g5;

    $sql = "SELECT vi_date, COUNT(vi_ip) cnt FROM g5_visit
            GROUP BY vi_date
            ORDER BY vi_date DESC
            LIMIT {$limit}";
    $result = sql_query($sql);
    $list = array();
    while ($row = sql_fetch_array($result)) {
        $list[] = $row;
    }
    return $list;
}

//대시보드의 카운트정보
function getDashBoardInfo($pt_id) {
    global $g5;

    $sql = " SELECT 
        (
            SELECT COUNT(*) cnt
            FROM g5_write_class
            WHERE DATE(wr_datetime) BETWEEN (LAST_DAY(NOW() - interval 2 month) + interval 1 DAY) AND (LAST_DAY(NOW() - INTERVAL 1 MONTH)) 
            AND wr_parent = wr_id
            AND mb_id = '{$pt_id}'
            AND moa_status NOT IN ('0','4','5')
        ) AS moa_count 
        ,
        (
            SELECT COUNT(*) cnt  
            FROM g5_shop_item_use
            WHERE pt_id = '{$pt_id}'
        ) AS moa_use
        , 
        (
            SELECT round(avg(cast(is_score AS FLOAT)),1) star
            FROM g5_shop_item_use
            WHERE pt_id = '{$pt_id}'
        ) AS moa_use_star
        ,
        (
        ( SELECT COUNT(*) cnt 
        FROM g5_shop_item_qa
          WHERE pt_id = '{$pt_id}'
          AND iq_answer <> '')
          /
        ( SELECT COUNT(*) cnt 
        FROM g5_shop_item_qa
          WHERE pt_id = '{$pt_id}')
          * 100 
         ) AS answer_rate
         , 
        ( 
            SELECT sum(od_cart_price)  
            FROM g5_shop_order a, g5_shop_cart b, g5_shop_item c
            WHERE a.od_id = b.od_id
            AND b.it_id = c.it_id
            AND c.pt_id = '{$pt_id}'
            AND a.od_status = '완료'
        ) AS total_sales
        , 
        (
            SELECT sum(od_cart_price) 
            FROM g5_shop_order a, g5_shop_cart b, g5_shop_item c
            WHERE a.od_id = b.od_id
            AND b.it_id = c.it_id
            AND c.pt_id = '{$pt_id}'
            AND a.od_status = '완료'
            AND date(a.od_time) BETWEEN (LAST_DAY(NOW() - interval 2 month) + interval 1 DAY) AND (LAST_DAY(NOW() - INTERVAL 1 MONTH)) 
        ) AS thismonth_sales
        , 
        (
            SELECT SUM(a.od_cart_coupon) 
            FROM g5_shop_order a, g5_shop_cart b, g5_shop_item c
            WHERE a.od_id = b.od_id
            AND b.it_id = c.it_id
            AND c.pt_id = '{$pt_id}'
            AND a.od_status = '완료'
            AND date(a.od_time) BETWEEN (LAST_DAY(NOW() - interval 2 month) + interval 1 DAY) AND (LAST_DAY(NOW() - INTERVAL 1 MONTH)) 
        ) AS thismonth_coupon
        ,
        (
            SELECT SUM(b.ct_point) 
            FROM g5_shop_order a, g5_shop_cart b, g5_shop_item c
            WHERE a.od_id = b.od_id
            AND b.it_id = c.it_id
            AND c.pt_id = '{$pt_id}'
            AND a.od_status = '완료'
            AND date(a.od_time) BETWEEN (LAST_DAY(NOW() - interval 2 month) + interval 1 DAY) AND (LAST_DAY(NOW() - INTERVAL 1 MONTH)) 
        ) AS thismonth_point
        
    ";

    return sql_fetch($sql);


}


function getCountResponse($mb_id) {
    global $g5;

    $row = sql_fetch(" select count(*) as cnt from {$g5['memo_table']} where me_recv_mb_id = '{$mb_id}' and me_read_datetime = '0000-00-00 00:00:00' ", false);
    return $row['cnt'];
}

if ($member['mb_id'] <> '')
    $member['response_cnt'] = getCountResponse($member['mb_id']);



// 문자 발송 함수 장문
function lmsSend($sHp, $rHp, $msg) {
    global $g5, $config;
    $rtn = "";
    try {
        $send_hp = str_replace("-","",$sHp); // - 제거 
        $recv_hp = str_replace("-","",$rHp); // - 제거 
        $strDest = array(); 
        $strDest[0] = $recv_hp; 
        $SMS = new LMS; // SMS 연결 
        $SMS->SMS_con($config['cf_icode_server_ip'], 
                                    $config['cf_icode_id'], 
                                    $config['cf_icode_pw'], 
                                    '1'); 
        $SMS->Add($strDest, 
                            $send_hp, 
                            $config['cf_icode_id'],
                            "",
                            "", 
                            iconv("utf-8", "euc-kr", $msg), 
                            "",
                            "1"); 
//                            iconv("utf-8", "euc-kr", stripslashes($msg)), 
// 메세지에서 특수문자를 제거하여 발송하려면 stripslashes를 추가하세요
        $SMS->Send(); 
        $rtn = true;
    }
    catch(Exception $e) {
        //alert("처리중 문제가 발생했습니다.".$e->getMessage());
        $rtn = false;
    }
    return $rtn;
}
    // 문자보내기 끝 


// 문자 발송 함수 단문
function smsSend($sHp, $rHp, $msg)     {      
    global $g5, $config;
    $rtn = "";
    try {
        $send_hp = str_replace("-","",$sHp); // - 제거 
        $recv_hp = str_replace("-","",$rHp); // - 제거         
        $SMS = new SMS; // SMS 객체 생성
        $SMS->SMS_con($config['cf_icode_server_ip'], 
                                    $config['cf_icode_id'], 
                                    $config['cf_icode_pw'], 
                                    $config['cf_icode_server_port']); 
        $SMS->Add($recv_hp, 
                            $send_hp, 
                            $config['cf_icode_id'], 
                            iconv("utf-8", "euc-kr", stripslashes($msg))
                            , ""); 
        $SMS->Send(); 
        $rtn = true;
    }
    catch(Exception $e) {
        //alert("처리중 문제가 발생했습니다.".$e->getMessage());
        $rtn = false;
    }
    return $rtn;
}

function getStrpointWr2($wr_id)
{
    global $g5;
    $sql = "select count(*) cnt, round(sum(c.is_score)/count(*)) score from g5_write_class a join g5_shop_item b on a.wr_id = b.it_2 join g5_shop_item_use c on b.it_id = c.it_id
            where a.wr_id = '{$wr_id}'";
    $row = sql_fetch($sql);
    return $row;
}

if(! function_exists('sendDirectMail')) {
    function sendDirectMail($subject, $body, $sender, $sender_name, $receiver, $bodytag, $mail_type)
    {
        $username = "codeidea";
        $key = "mUJrCPVuyMOq02W";

        $ch = curl_init();
        $postvars = '"subject":"'.$subject.'"';
        $postvars = $postvars.', "body":"'.$body.'"';
        $postvars = $postvars.', "sender":"'.$sender.'"';
        $postvars = $postvars.', "sender_name":"'.$sender_name.'"';
        $postvars = $postvars.', "username":"'.$username.'"';
        $postvars = $postvars.', "receiver":'.$receiver;

        $postvars = $postvars.', "mail_type":"'.$mail_type.'"';
        //$postvars = $postvars.', "bodytag":"'.$bodytag.'"';
        $postvars = $postvars.', "key":"'.$key.'"';
        $postvars = '{'.$postvars.'}';      //JSON 데이터

        // URL
        $url = "https://directsend.co.kr/index.php/api_v2/mail_change_word";

        //헤더정보
        $headers = array(
            "cache-control: no-cache",
            "content-type: application/json; charset=utf-8"
        );

        curl_setopt($ch,CURLOPT_URL, $url);
        curl_setopt($ch,CURLOPT_POST, true);
        curl_setopt($ch,CURLOPT_POSTFIELDS, $postvars);		//JSON 데이터
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch,CURLOPT_CONNECTTIMEOUT ,3);
        curl_setopt($ch,CURLOPT_TIMEOUT, 60);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec($ch);
//        die($response);
        if(curl_errno($ch)){
            'Curl error: ' . curl_error($ch);
        }else{
            print_R($response);
        }

//        curl_close ($ch);
    }
}

// DirectSend SMS
if(! function_exists('sendDirectSMS')) {
    function sendDirectSMS($title, $message, $sender, $receiver)
    {
        $username = "codeidea";
        $key = "mUJrCPVuyMOq02W";

        $ch = curl_init();

        $postvars = '"title":"'.$title.'"';
        $postvars = $postvars.', "message":"'.$message.'"';
        $postvars = $postvars.', "sender":"'.$sender.'"';
        $postvars = $postvars.', "username":"'.$username.'"';
        $postvars = $postvars.', "receiver":'.$receiver.'';
        $postvars = $postvars.', "key":"'.$key.'"';
        $postvars = '{'.$postvars.'}';

        $url = "https://directsend.co.kr/index.php/api_v2/sms_change_word";

        $headers = array("cache-control: no-cache","content-type: application/json; charset=utf-8");

        curl_setopt($ch,CURLOPT_URL, $url);
        curl_setopt($ch,CURLOPT_POST, true);
        curl_setopt($ch,CURLOPT_POSTFIELDS, $postvars);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch,CURLOPT_CONNECTTIMEOUT ,3);
        curl_setopt($ch,CURLOPT_TIMEOUT, 60);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec($ch);

        if(curl_errno($ch)){
            echo 'Curl error: ' . curl_error($ch);
            return true;

        }else{
            //print_r($response);
            return false;

        }
//        curl_close ($ch);
    }
}