<?php
include_once("./_common.php");
include_once(G5_LIB_PATH."/register.lib.php");
include_once(G5_LIB_PATH.'/thumbnail.lib.php');
$wdata = array();
if($_FILES['excelfile']['tmp_name']) {

    $file = $_FILES['excelfile']['tmp_name'];

    include_once(G5_LIB_PATH.'/Excel/reader.php');

    $data = new Spreadsheet_Excel_Reader();




    $updir = "/adju_excel";
    // 디렉토리가 없다면 생성합니다. (퍼미션도 변경하구요.)
    @mkdir(G5_DATA_PATH.$updir, G5_DIR_PERMISSION);
    @chmod(G5_DATA_PATH.$updir, G5_DIR_PERMISSION);

    $updir .= "/".$g5['adju_basic_table'];

    @mkdir(G5_DATA_PATH.$updir, G5_DIR_PERMISSION);
    @chmod(G5_DATA_PATH.$updir, G5_DIR_PERMISSION);

    $chars_array = array_merge(range(0,9), range('a','z'), range('A','Z'));
    
    // 저장될 파일명 
    $dfname = "";

    // 가변 파일 업로드
    $file_upload_msg = '';
    $upload = array();
    $tmp_file = $file; //$_FILES['excelfile']['tmp_name'];
    if (is_uploaded_file($tmp_file)) {
        $filename = $_FILES['excelfile']['name'];
        $filename = preg_replace("/\.(php|pht|phtm|htm|cgi|pl|exe|jsp|asp|inc)/i", "$0-x", $filename);
        shuffle($chars_array);
        $shuffle = implode('', $chars_array);
        $dfname = abs(ip2long($_SERVER['REMOTE_ADDR'])).'_'.substr($shuffle,0,8).'_'.replace_filename($filename);
        $dest_dir = G5_DATA_PATH.$updir."/";
        $dest_url = "/data/".$updir."/";
        $dest_file = $dest_dir.$dfname;
        // 업로드가 안된다면 에러메세지 출력하고 죽어버립니다.
        $error_code = copy($tmp_file, $dest_file) or die($_FILES['excelfile']['error']);
        //$error_code = move_uploaded_file($tmp_file, $dest_file) or die($_FILES['excelfile']['error']);
        
        $insql = " update {$g5['adju_basic_table']} 
                set filename='{$dfname}', dirname='{$dest_url}'
                where no = '{$no}' ";
        sql_query($insql);
        // 올라간 파일의 퍼미션을 변경합니다.
        chmod($dest_file, G5_FILE_PERMISSION);
    }

    




    // Set output Encoding.
    $data->setOutputEncoding('UTF-8');

    /***
    * if you want you can change 'iconv' to mb_convert_encoding:
    * $data->setUTFEncoder('mb');
    *
    **/

    /***
    * By default rows & cols indeces start with 1
    * For change initial index use:
    * $data->setRowColOffset(0);
    *
    **/



    /***
    *  Some function for formatting output.
    * $data->setDefaultFormat('%.2f');
    * setDefaultFormat - set format for columns with unknown formatting
    *
    * $data->setColumnFormat(4, '%.3f');
    * setColumnFormat - set format for column (apply only to number fields)
    *
    **/

    $data->read($file);

    /*


     $data->sheets[0]['numRows'] - count rows
     $data->sheets[0]['numCols'] - count columns
     $data->sheets[0]['cells'][$i][$j] - data from $i-row $j-column

     $data->sheets[0]['cellsInfo'][$i][$j] - extended info about cell

        $data->sheets[0]['cellsInfo'][$i][$j]['type'] = "date" | "number" | "unknown"
            if 'type' == "unknown" - use 'raw' value, because  cell contain value with format '0.00';
        $data->sheets[0]['cellsInfo'][$i][$j]['raw'] = value if cell without format
        $data->sheets[0]['cellsInfo'][$i][$j]['colspan']
        $data->sheets[0]['cellsInfo'][$i][$j]['rowspan']
    */

    error_reporting(E_ALL ^ E_NOTICE);

   
    // $i 사용시 ordermail.inc.php의 $i 때문에 무한루프에 빠짐
    for ($k = 2; $k <= $data->sheets[0]['numRows']; $k++) {
        $total_count++;
        $adju_basic_no = $no;
        $nation = addslashes($data->sheets[0]['cells'][$k][1]);
        $adjuym = addslashes($data->sheets[0]['cells'][$k][2]);
        $song_code  = addslashes(trim($data->sheets[0]['cells'][$k][3]));
        $song_name = addslashes($data->sheets[0]['cells'][$k][4]);
        $singer = addslashes($data->sheets[0]['cells'][$k][5]);
        $album_company = addslashes($data->sheets[0]['cells'][$k][6]);
        $service_type = addslashes($data->sheets[0]['cells'][$k][7]);
        $album_code = addslashes($data->sheets[0]['cells'][$k][8]);
        $sale_amount = addslashes($data->sheets[0]['cells'][$k][9]);
        $digital_royalty = addslashes($data->sheets[0]['cells'][$k][10]);

        
        if(!$adjuym || !$song_code || !$album_code || !$album_company || !$service_type || !$singer) {
            $fail_str .= "adjuym : ".$adjuym." - song_code : ".$song_code." - album_code :".$album_code." - album_company :".$album_company." - service_type : ".$service_type."<BR>";
            $fail_count++;
            $fail_serial_no[] = $song_code;
            continue;
        }


        // 주문정보
        $od = sql_fetch(" select count(*) cnt from {$g5['adju_data_table']} 
                where adju_ym = '{$adjuym}' 
                and nation = '{$nation}'
                and song_code = '{$song_code}'
                and singer = '{$singer}'
                and album_company = '{$album_company}'
                and service_type = '{$service_type}'
                and album_code = '{$album_code}'
                ");
        /*
        //중복체크 인데, 중복 허용으로 값 업로드 
        if ($od['cnt']) {
            $fail_count++;
            $fail_serial_no[] = $serial_no;
            continue;
        }
        */
        $wdata[$k] = $data->sheets[0]['cells'][$k];

        $serialprod['serial_no'] = $serial_no;
        $serialprod['model_name'] = $model_name;
        $serialprod['valid_date'] = $valid_date;

        $upsql = "insert into {$g5['adju_data_table']} set 
                 nation = '{$nation}'
                , adju_basic_no = '{$adju_basic_no}' 
                , adju_ym = '{$adjuym}' 
                , song_code = '{$song_code}'
                , song_name = '{$song_name}'
                , singer = '{$singer}'
                , album_company = '{$album_company}'
                , service_type = '{$service_type}'
                , album_code = '{$album_code}'
                , sale_amount = '{$sale_amount}'
                , digital_royalty = '{$digital_royalty}'

                , mb_id = '{$member['mb_id']}'
                , regdate = now()
                ";
        //echo $upsql."<BR>";
        sql_query($upsql);

        $succ_count++;

    }
}
