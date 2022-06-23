<?php
function get_list_thumbnail2($bo_table, $wr_id, $thumb_width, $thumb_height, $is_create=false, $is_crop=true, $crop_mode='center', $is_sharpen=false, $um_value='80/0.5/3')
{
    global $g5, $config;
    $filename = $alt = "";
    $edt = false;

    $sql = " select bf_file, bf_content from {$g5['board_file_table']}
                where bo_table = '$bo_table' and wr_id = '$wr_id' and bf_type between '1' and '3' order by bf_no limit 0, 1 ";
    $row = sql_fetch($sql);

    if($row['bf_file']) {
        $filename = $row['bf_file'];
        $filepath = G5_DATA_PATH.'/file/'.$bo_table;
        $alt = get_text($row['bf_content']);
    } else {
        $write_table = $g5['write_prefix'].$bo_table;
        $sql = " select wr_content from $write_table where wr_id = '$wr_id' ";
        $write = sql_fetch($sql);
        $matches = get_editor_image($write['wr_content'], false);
        $edt = true;

        for($i=0; $i<count($matches[1]); $i++)
        {
            // 이미지 path 구함
            $p = parse_url($matches[1][$i]);
            if(strpos($p['path'], '/'.G5_DATA_DIR.'/') != 0)
                $data_path = preg_replace('/^\/.*\/'.G5_DATA_DIR.'/', '/'.G5_DATA_DIR, $p['path']);
            else
                $data_path = $p['path'];

            $srcfile = G5_PATH.$data_path;

            if(preg_match("/\.({$config['cf_image_extension']})$/i", $srcfile) && is_file($srcfile)) {
                $size = @getimagesize($srcfile);
                if(empty($size))
                    continue;

                $filename = basename($srcfile);
                $filepath = dirname($srcfile);

                preg_match("/alt=[\"\']?([^\"\']*)[\"\']?/", $matches[0][$i], $malt);
                $alt = get_text($malt[1]);

                break;
            }
        }
    }

    if(!$filename)
        return false;

        //입력된 thumb의 width 혹은 height 값이 0 일경우 배율 조절
        $size = @getimagesize($filepath."/".$filename);
        if($thumb_width == 0) {
                $thumb_width = ($size[0]*$thumb_height)/$size[1];
        }else if($thumb_height == 0) {
                $thumb_height = ($size[1]*$thumb_width)/$size[0];
        }
    $tname = thumbnail($filename, $filepath, $filepath, $thumb_width, $thumb_height, $is_create, $is_crop, $crop_mode, $is_sharpen, $um_value);

    if($tname) {
        if($edt) {
            // 오리지날 이미지
            $ori = G5_URL.$data_path;
            // 썸네일 이미지
            $src = G5_URL.str_replace($filename, $tname, $data_path);
        } else {
            $ori = G5_DATA_URL.'/file/'.$bo_table.'/'.$filename;
            $src = G5_DATA_URL.'/file/'.$bo_table.'/'.$tname;
        }
    } else {
        return false;
    }

    $thumb = array("src"=>$src, "ori"=>$ori, "alt"=>$alt, "thumb_width"=>$thumb_width, "thumb_height"=>$thumb_height);

    return $thumb;
}
?>