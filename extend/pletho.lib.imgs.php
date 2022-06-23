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
// 아이템 썸네일 생성
function album_it_thumbnail($it, $thumb_width, $thumb_height, $is_create=false, $is_crop=false, $crop_mode='center', $is_sharpen=true, $um_value='80/0.5/3') {
    global $g5, $config;

    $img = array();
    $limg = array();
    $lalt = array();
    $thumb = array();
    $no_thumb = array('is_thumb'=>false, 'src'=>'', 'alt'=>'', 'org'=>'', 'height'=>'');
    $rows = (isset($it['img_rows']) && $it['img_rows'] > 1) ? $it['img_rows'] : 1;
    $is_thumb_no = (isset($it['is_thumb_no']) && $it['is_thumb_no']) ? true : false;
    $no_img = (isset($it['no_img']) && $it['no_img']) ? $it['no_img'] : '';
    $chk_img = (isset($it['chk_img']) && $it['chk_img']) ? true : false; // Check Image
    $is_thumb = (!$chk_img && isset($it['pt_thumb']) && $it['pt_thumb'] && $rows == "1") ? true : false;
    $itmodel = $it['it_model'];
    $make_thumb = true;
    if($is_thumb && isset($it['pt_thumb']) && $it['pt_thumb'] == "1") {
        $z = 0;
        $make_thumb = false;
        unset($it);
    } else if($is_thumb) {
        $tmp_thumb = apms_video_thumbnail($it['pt_thumb'], 1);
        if($tmp_thumb) {
            $z = 1;
            $img[0]['img'] = $tmp_thumb;
            $img[0]['alt'] = '';
            $make_thumb = false;
            unset($it);
        }
    }

    if($make_thumb) {
        $z = 0;
        for($i=1; $i<=10; $i++) {
            //$it_img = $it['it_img'.$i];
            $it_img = $itmodel."_Cover.jpg";
            $file = UHD_DATA_PATH.'/{$itmodel}/'.$it_img;
            if(!is_file($file))
                continue;

            $size = @getimagesize($file);
            if($size[2] < 1 || $size[2] > 3)
                continue;

            $img[$z]['alt'] = get_text($it['it_name']);
            $img[$z]['img'] = UHD_DATA_URL.'/{$itmodel}/'.$it_img;
            
            $z++;
            if($z == $rows) break;
        }

        if($z != $rows) {
            $result = sql_query(" select * from {$g5['apms_file']} where pf_id = '{$it['it_id']}' and pf_dir = '1' and pf_ext = '1' and pf_purchase_use <> '1' and pf_view_use = '1' order by pf_no ", false);
            while ($row = sql_fetch_array($result)) {
                $file = UHD_DATA_PATH.'/{$itmodel}/'.$it['it_id'].'/'.$row['pf_file'];
                if(!is_file($file))
                    continue;

                $size = @getimagesize($file);
                if($size[2] < 1 || $size[2] > 3)
                    continue;

                $img[$z]['alt'] = get_text($it['it_name']);
                $img[$z]['img'] = UHD_DATA_URL.'/{$itmodel}/'.$it['it_id'].'/'.$row['pf_file'];
            
                $z++;
                if($z == $rows) break;
            }
        }

        if($z != $rows) { //첨부이미지 체크
            $wr_content = $it['it_explan'];
            $matches = get_editor_image($wr_content, false);
            
            $imgs = (is_array($matches[1])) ? $matches[1] : array();
            $imgs_cnt = count($imgs);
            for($i=0; $i < $imgs_cnt; $i++) {
                // 이미지 path 구함
                $p = @parse_url($imgs[$i]);
                if(strpos($p['path'], '/'.UHD_FILE_DIR.'/') != 0)
                    $data_path = preg_replace('/^\/.*\/'.UHD_FILE_DIR.'/', '/'.UHD_FILE_DIR, $p['path']);
                else
                    $data_path = $p['path'];

                $srcfile = UHD_DATA_PATH.$data_path;

                if(is_file($srcfile)) {
                    $size = @getimagesize($srcfile);
                    if(empty($size)) {
                        continue;
                    }

                    $img[$z]['img'] = $imgs[$i];

                    preg_match("/alt=[\"\']?([^\"\']*)[\"\']?/", $matches[0][$i], $malt);
                    $img[$z]['alt'] = get_text($malt[1]);

                    $z++;
                    if($z == $rows) break;

                } else {
                    $limg[] = $imgs[$i];
                    preg_match("/alt=[\"\']?([^\"\']*)[\"\']?/", $matches[0][$i], $malt);
                    $lalt[] = get_text($malt[1]);
                }
            }
        }

        if($z != $rows) { // 링크동영상 체크
            for($i=1; $i < 3; $i++) {
                if($it['pt_link'.$i]) {

                    list($link_video) = explode("|", $it['pt_link'.$i]);

                    $video = apms_video_info($link_video);

                    if(!$video['type']) continue;

                    $srcfile = apms_video_img($video['video_url'], $video['vid'], $video['type'], $video['img']);

                    if(!$srcfile || $srcfile == 'none') continue;

                    $img[$z]['img'] = str_replace(G5_PATH, G5_URL, $srcfile);

                    $z++;
                    if($z == $rows) break;
                }
            }
        }

        if($z != $rows) { //본문동영상 이미지 체크
            if(preg_match_all("/{(동영상|video)\:([^}]*)}/is", $it['it_explan'], $match)) {
                $vimgs = (is_array($match[2])) ? $match[2] : array();
                $vimgs_cnt = count($vimgs);
                for ($i=0; $i < $vimgs_cnt; $i++) {
                    $video = apms_video_info(trim(strip_tags($vimgs[$i])));

                    if(!$video['type']) continue;

                    $srcfile = apms_video_img($video['video_url'], $video['vid'], $video['type'], $video['img']);

                    if(!$srcfile || $srcfile == 'none') continue;

                    $img[$z]['img'] = str_replace(G5_PATH, G5_URL, $srcfile);

                    $z++;
                    if($z == $rows) break;
                }
            }
        }

        if($z != $rows) { //링크 이미지
            for($i=0; $i < count($limg); $i++) {
                $img[$z]['is_thumb'] = false;
                $img[$z]['img'] = $limg[$i];
                $img[$z]['alt'] = $lalt[$i];

                $z++;
                if($z == $rows) break;
            }
        }
    }

    // Check Image
    if($chk_img) {
        $chk_img = (isset($img[0]['img']) && $img[0]['img']) ? $img[0]['img'] : 0;
        return $chk_img;
    }

    if($z == 0) {
        if($no_img) {
            $img[$z]['org'] = $no_img;
            $img[$z]['img'] = $no_img;
            $img[$z]['alt'] = '';
        } else {
            if($rows > 1) {
                $thumb[0] = $no_thumb;
            } else {
                $thumb = $no_thumb;
            }
            return $thumb;
        }
    }

    // 썸네일
    $tmp = array();
    $j = 0;
    for($i = 0; $i < count($img); $i++) {
        if($thumb_width > 0 && !$is_thumb_no) {

            $tmpimg = apms_thumbnail($img[$i]['img'], $thumb_width, $thumb_height, $is_create, $is_crop, $crop_mode, $is_sharpen, $um_value);

            if(!$tmpimg['src']) continue;

            $tmp[$j]['is_thumb'] = $tmpimg['is_thumb'];
            $tmp[$j]['src'] = $tmpimg['src'];
            $tmp[$j]['height'] = $tmpimg['height'];
        } else {
            $tmp[$j]['is_thumb'] = false;
            $tmp[$j]['src'] = $img[$i]['img'];
            $tmp[$j]['height'] = '';
        }
        $tmp[$j]['org'] = $img[$i]['img'];
        $tmp[$j]['alt'] = $img[$i]['alt'];
        $j++;
    }

    if($j == 0) {
        if($rows > 1) {
            $thumb[0] = $no_thumb;
        } else {
            $thumb = $no_thumb;
        }
    } else {
        $thumb = ($rows > 1) ? $tmp : $tmp[0];
    }

    return $thumb;
}


function album_thumbnail($url, $thumb_width, $thumb_height, $is_create=false, $is_crop=false, $crop_mode='center', $is_sharpen=false, $um_value='80/0.5/3') {

    if(!$url) return;

    $thumb = array();

    // 이미지 path 구함
    $p = @parse_url($url);
    if(strpos($p['path'], '/'.UHD_DATA_DIR.'/') != 0)
        $data_path = preg_replace('/^\/.*\/'.UHD_DATA_DIR.'/', '/'.UHD_DATA_DIR, $p['path']);
    else
        $data_path = $p['path'];


    $srcfile = G5_PATH.$data_path;
    if(strpos($p['path'], '/'.G5_DATA_DIR.'/') != 0)
        $data_path = preg_replace('/^\/.*\/'.G5_DATA_DIR.'/', '/'.G5_DATA_DIR, $p['path']);
    
    $targetfile = G5_PATH.$data_path;

    $is_thumb = false;
    if(is_file($srcfile) && $thumb_width > 0) {

        $size = @getimagesize($srcfile);
        if(empty($size))
            return;

        // jpg 이면 exif 체크
        if($size[2] == 2 && function_exists('exif_read_data')) {
            $degree = 0;
            $exif = @exif_read_data($srcfile);
            if(!empty($exif['Orientation'])) {
                switch($exif['Orientation']) {
                    case 8:
                        $degree = 90;
                        break;
                    case 3:
                        $degree = 180;
                        break;
                    case 6:
                        $degree = -90;
                        break;
                }

                // 세로사진의 경우 가로, 세로 값 바꿈
                if($degree == 90 || $degree == -90) {
                    $tmp = $size;
                    $size[0] = $tmp[1];
                    $size[1] = $tmp[0];
                }
            }
        }

        // 원본 width가 thumb_width보다 작다면
        if($size[0] <= $thumb_width) {
            $thumb['src'] = $url;
            $thumb['height'] = $size[1];
            $thumb['is_thumb'] = false;
            return $thumb;
        }

        // Animated GIF 체크
        $is_animated = false;
        if($size[2] == 1) {
            $is_animated = is_animated_gif($srcfile);
        }

        // 이미지 높이
        $img_height = round(($thumb_width * $size[1]) / $size[0]);

        $filename = basename($srcfile);
        $filepath = dirname($srcfile);
        $targetpath = dirname($targetfile);
        // 썸네일 생성
        if(!$is_animated) {
            $thumb_file = thumbnail($filename, $filepath, $targetpath, $thumb_width, $thumb_height, $is_create, $is_crop, $crop_mode, $is_sharpen, $um_value);
            //echo $thumb_file."<BR>";
            $is_thumb = true;
        } else {
            $thumb_file = $filename;
            $is_thumb = false;
        }

        if(!$thumb_file) {
            $thumb['src'] = $url;
            $thumb['height'] = $size[1];
            $thumb['is_thumb'] = false;
            return $thumb;
        }

        $url = UHD_URL . str_replace($filename, $thumb_file, $data_path);
    }

    $thumb['src'] = $url;
    $thumb['height'] = $img_height;
    $thumb['is_thumb'] = $is_thumb;
    $thumb['thumb'] = $thumb_file;
//print_r2($thumb);
    return $thumb;
}




// 게시판 이미지를 Item 이미지로 복사 
function lec_copy_file($bo_table, $wr_id, $it_id) {
    global $g5;
 // 존재하는 파일이 있다면 복제합니다.
    $target_dir = G5_DATA_PATH.'/item/'.$it_id;
    @mkdir($target_dir, G5_DIR_PERMISSION);
    @chmod($target_dir, G5_DIR_PERMISSION);

    $sql = " select bf_file from {$g5['board_file_table']} where bo_table = '$bo_table' and wr_id = '$wr_id' order by bf_no ";
    $result = sql_query($sql);
    $upsql = "update {$g5['g5_shop_item_table']} set ";
    $upsql_add = "";
    $upsql_where = " where it_id = '{$it_id}' "; 
    for ($i = 1; $row = sql_fetch_array($result);$i++) {

        $ori_file = G5_DATA_PATH.'/file/'.$bo_table.'/'.$row['bf_file'];
        $targetsrc = $it_id.'/'.$row['bf_file'];
        $target_file = $target_dir.'/'.$row['bf_file'];
        //if (file_exists($ori_file)) {
            copy($ori_file, $target_file);
            chmod($target_file, G5_FILE_PERMISSION);
            if ($upsql_add) $upsql_add.= ", ";
            $upsql_add .= " it_img".$i." = '".$targetsrc."' ";
        //}
    }
    //echo $ori_file." ::: ".$targetsrc."  ... ".$target_file."<BR>";
    //echo $sql."<BR>";
    if ($upsql_add) {
        sql_query($upsql.$upsql_add.$upsql_where);
    }
    //echo $upsql.$upsql_add.$upsql_where."<BR>";
    //exit;


}



// 아이템 썸네일 생성
function deb_list_it_thumbnail($it, $thumb_width, $thumb_height, $is_create=false, $is_crop=false, $crop_mode='center', $is_sharpen=true, $um_value='80/0.5/3') {
    global $g5, $config;

    $img = array();
    $limg = array();
    $lalt = array();
    $thumb = array();
    $no_thumb = array('is_thumb'=>false, 'src'=>'', 'alt'=>'', 'org'=>'', 'height'=>'');
    $rows = (isset($it['img_rows']) && $it['img_rows'] > 1) ? $it['img_rows'] : 1;
    $is_thumb_no = false;//(isset($it['is_thumb_no']) && $it['is_thumb_no']) ? true : false;
    $no_img = (isset($it['no_img']) && $it['no_img']) ? $it['no_img'] : '';
    $chk_img = (isset($it['chk_img']) && $it['chk_img']) ? true : false; // Check Image true; //$is_create;
    $is_thumb = (!$chk_img && isset($it['pt_thumb']) && $it['pt_thumb'] && $rows == "1") ? true : false;

    $make_thumb = true;
    
    if($is_thumb && isset($it['pt_thumb']) && $it['pt_thumb'] == "1") {
        $z = 0;
        $make_thumb = false;
        unset($it);
    } else if($is_thumb) {
        $tmp_thumb = apms_video_thumbnail($it['pt_thumb'], 1);
        if($tmp_thumb) {
            $z = 1;
            $img[0]['img'] = $tmp_thumb;
            $img[0]['alt'] = '';
            $make_thumb = false;
            unset($it);
        }
    }
    //print_r2($no_thumb);
    //echo " no thumb : ".$no_thumb.", rows : ". $rows. ", no_img :  ". $no_img. ", is_thumb : ".$is_thumb."<BR>";
    //echo "make_thumb :".$make_thumb."<BR>";
    if($make_thumb) {
        $z = 0;
        for($i=1; $i<=10; $i++) {
            $it_img = $it['it_img'.$i];
            $file = G5_DATA_PATH.'/item/'.$it_img;
            //echo $file."<BR>";
            if(!is_file($file))
                continue;

            $size = @getimagesize($file);
            if($size[2] < 1 || $size[2] > 3)
                continue;

            $img[$z]['alt'] = get_text($it['it_name']);
            $img[$z]['img'] = G5_DATA_URL.'/item/'.$it_img;
            //print_r2($img);
            $z++;
            if($z == $rows) break;
        }
        //echo $z.":".$rows."<BR>";
        if($z != $rows) {
            $result = sql_query(" select * from {$g5['apms_file']} where pf_id = '{$it['it_id']}' and pf_dir = '1' and pf_ext = '1' and pf_purchase_use <> '1' and pf_view_use = '1' order by pf_no ", false);
            while ($row = sql_fetch_array($result)) {
                $file = G5_DATA_PATH.'/item/'.$it['it_id'].'/'.$row['pf_file'];
                if(!is_file($file))
                    continue;

                $size = @getimagesize($file);
                if($size[2] < 1 || $size[2] > 3)
                    continue;

                $img[$z]['alt'] = get_text($it['it_name']);
                $img[$z]['img'] = G5_DATA_URL.'/item/'.$it['it_id'].'/'.$row['pf_file'];
            
                $z++;
                if($z == $rows) break;
            }
        }

        if($z != $rows) { //첨부이미지 체크
            $wr_content = $it['it_explan'];
            $matches = get_editor_image($wr_content, false);
            
            $imgs = (is_array($matches[1])) ? $matches[1] : array();
            $imgs_cnt = count($imgs);
            for($i=0; $i < $imgs_cnt; $i++) {
                // 이미지 path 구함
                $p = @parse_url($imgs[$i]);
                if(strpos($p['path'], '/'.G5_DATA_DIR.'/') != 0)
                    $data_path = preg_replace('/^\/.*\/'.G5_DATA_DIR.'/', '/'.G5_DATA_DIR, $p['path']);
                else
                    $data_path = $p['path'];

                $srcfile = G5_PATH.$data_path;

                if(is_file($srcfile)) {
                    $size = @getimagesize($srcfile);
                    if(empty($size)) {
                        continue;
                    }

                    $img[$z]['img'] = $imgs[$i];

                    preg_match("/alt=[\"\']?([^\"\']*)[\"\']?/", $matches[0][$i], $malt);
                    $img[$z]['alt'] = get_text($malt[1]);

                    $z++;
                    if($z == $rows) break;

                } else {
                    $limg[] = $imgs[$i];
                    preg_match("/alt=[\"\']?([^\"\']*)[\"\']?/", $matches[0][$i], $malt);
                    $lalt[] = get_text($malt[1]);
                }
            }
        }

        if($z != $rows) { // 링크동영상 체크
            for($i=1; $i < 3; $i++) {
                if($it['pt_link'.$i]) {

                    list($link_video) = explode("|", $it['pt_link'.$i]);

                    $video = apms_video_info($link_video);

                    if(!$video['type']) continue;

                    $srcfile = apms_video_img($video['video_url'], $video['vid'], $video['type'], $video['img']);

                    if(!$srcfile || $srcfile == 'none') continue;

                    $img[$z]['img'] = str_replace(G5_PATH, G5_URL, $srcfile);

                    $z++;
                    if($z == $rows) break;
                }
            }
        }

        if($z != $rows) { //본문동영상 이미지 체크
            if(preg_match_all("/{(동영상|video)\:([^}]*)}/is", $it['it_explan'], $match)) {
                $vimgs = (is_array($match[2])) ? $match[2] : array();
                $vimgs_cnt = count($vimgs);
                for ($i=0; $i < $vimgs_cnt; $i++) {
                    $video = apms_video_info(trim(strip_tags($vimgs[$i])));

                    if(!$video['type']) continue;

                    $srcfile = apms_video_img($video['video_url'], $video['vid'], $video['type'], $video['img']);

                    if(!$srcfile || $srcfile == 'none') continue;

                    $img[$z]['img'] = str_replace(G5_PATH, G5_URL, $srcfile);

                    $z++;
                    if($z == $rows) break;
                }
            }
        }

        if($z != $rows) { //링크 이미지
            for($i=0; $i < count($limg); $i++) {
                $img[$z]['is_thumb'] = false;
                $img[$z]['img'] = $limg[$i];
                $img[$z]['alt'] = $lalt[$i];

                $z++;
                if($z == $rows) break;
            }
        }
    }
    //echo "chk_img : ".$chk_img."<BR>";
    // Check Image
    /*
    if($chk_img) {
        $chk_img = (isset($img[0]['img']) && $img[0]['img']) ? $img[0]['img'] : 0;
        return $chk_img;
    }
    */

    if($z == 0) {
        if($no_img) {
            $img[$z]['org'] = $no_img;
            $img[$z]['img'] = $no_img;
            $img[$z]['alt'] = '';
        } else {
            if($rows > 1) {
                $thumb[0] = $no_thumb;
            } else {
                $thumb = $no_thumb;
            }
            return $thumb;
        }
    }
    //print_r2($img);
    // 썸네일
    $tmp = array();
    $j = 0;
    for($i = 0; $i < count($img); $i++) {
        //print_r2($img);
        if($thumb_width > 0 && !$is_thumb_no) {

            $tmpimg = debs_thumbnail($img[$i]['img'], $thumb_width, $thumb_height, $is_create, $is_crop, $crop_mode, $is_sharpen, $um_value);

            if(!$tmpimg['src']) continue;

            $tmp[$j]['is_thumb'] = $tmpimg['is_thumb'];
            $tmp[$j]['src'] = $tmpimg['src'];
            $tmp[$j]['height'] = $tmpimg['height'];
        } else {
            $tmp[$j]['is_thumb'] = false;
            $tmp[$j]['src'] = $img[$i]['img'];
            $tmp[$j]['height'] = '';
        }
        $tmp[$j]['org'] = $img[$i]['img'];
        $tmp[$j]['alt'] = $img[$i]['alt'];
        $j++;
    }

    if($j == 0) {
        if($rows > 1) {
            $thumb[0] = $no_thumb;
        } else {
            $thumb = $no_thumb;
        }
    } else {
        $thumb = ($rows > 1) ? $tmp : $tmp[0];
    }

    return $thumb;
}



// APMS 썸네일 생성
function debs_thumbnail($url, $thumb_width, $thumb_height, $is_create=false, $is_crop=false, $crop_mode='center', $is_sharpen=false, $um_value='80/0.5/3') {

    if(!$url) return;

    $thumb = array();

    // 이미지 path 구함
    $p = @parse_url($url);
    if(strpos($p['path'], '/'.G5_DATA_DIR.'/') != 0)
        $data_path = preg_replace('/^\/.*\/'.G5_DATA_DIR.'/', '/'.G5_DATA_DIR, $p['path']);
    else
        $data_path = $p['path'];

    $srcfile = G5_PATH.$data_path;
//echo $srcfile."<BR>";
    $is_thumb = false;
    if(is_file($srcfile) && $thumb_width > 0) {

        $size = @getimagesize($srcfile);
        if(empty($size))
            return;

        // jpg 이면 exif 체크
        if($size[2] == 2 && function_exists('exif_read_data')) {
            $degree = 0;
            $exif = @exif_read_data($srcfile);
            if(!empty($exif['Orientation'])) {
                switch($exif['Orientation']) {
                    case 8:
                        $degree = 90;
                        break;
                    case 3:
                        $degree = 180;
                        break;
                    case 6:
                        $degree = -90;
                        break;
                }

                // 세로사진의 경우 가로, 세로 값 바꿈
                if($degree == 90 || $degree == -90) {
                    $tmp = $size;
                    $size[0] = $tmp[1];
                    $size[1] = $tmp[0];
                }
            }
        }

        // 원본 width가 thumb_width보다 작다면
        if($size[0] <= $thumb_width) {
            $thumb['src'] = $url;
            $thumb['height'] = $size[1];
            $thumb['is_thumb'] = false;
            return $thumb;
        }

        // Animated GIF 체크
        $is_animated = false;
        if($size[2] == 1) {
            $is_animated = is_animated_gif($srcfile);
        }

        // 이미지 높이
        $img_height = round(($thumb_width * $size[1]) / $size[0]);

        $filename = basename($srcfile);
        $filepath = dirname($srcfile);

        // 썸네일 생성
        if(!$is_animated) {
            $thumb_file = thumbnail($filename, $filepath, $filepath, $thumb_width, $thumb_height, $is_create, $is_crop, $crop_mode, $is_sharpen, $um_value);
            $is_thumb = true;
        } else {
            $thumb_file = $filename;
            $is_thumb = false;
        }

        if(!$thumb_file) {
            $thumb['src'] = $url;
            $thumb['height'] = $size[1];
            $thumb['is_thumb'] = false;
            return $thumb;
        }

        $url = G5_URL . str_replace($filename, $thumb_file, $data_path);
    }

    $thumb['src'] = $url;
    $thumb['height'] = $img_height;
    $thumb['is_thumb'] = $is_thumb;

    return $thumb;
}


// 썸네일 만들기
function apms_get_item_thumbnail($img, $width, $height=0, $id='') {

    $file = G5_DATA_PATH.'/item/'.$img;

    if(is_file($file))
        $size = @getimagesize($file);

    if($size && ($size[2] < 1 || $size[2] > 3) )
        return;
    else 
        $size=array("500","500");

    if($width > 0) {
        $img_width = $size[0];
        $img_height = $size[1];
        $filename = basename($file);
        $filepath = dirname($file);


        $thumb = thumbnail($filename, $filepath, $filepath, $width, $height, true, true);
        //echo "thumb : ".$thumb."<BR>";
        if($thumb) {
            $file_url = str_replace(G5_PATH, G5_URL, $filepath.'/'.$thumb);
            //echo $file_url."<BR>";
            $str = '<img src="'.$file_url.'"';
            if($id)
                $str .= ' id="'.$id.'"';
            $str .= ' alt="">';
        } else {
            return;
        }
    } else {
        $file_url = G5_DATA_URL.'/item/'.$img;
    }

    $str = '<img src="'.$file_url.'"';
    if($id)
        $str .= ' id="'.$id.'"';
    $str .= ' alt="">';

    return $str;
}