<?php
$sub_menu = "750200";
include_once("./_common.php");
include_once(G5_LIB_PATH."/register.lib.php");
include_once(G5_LIB_PATH.'/thumbnail.lib.php');
error_reporting(E_ALL);

if ($w == 'u')
    check_demo();

auth_check($auth[$sub_menu], 'w');

check_admin_token();

/*
    $mb['adju_ym'] = get_text($mb['album_name']);
    $mb['adju_album_no'] = get_text($mb['adju_album_no']);
    $mb['sale_quantity'] = get_text($mb['sale_quantity']);
    $mb['cd_price'] = get_text($mb['cd_price']);
    $mb['bep'] = get_text($mb['bep']);
    $mb['royalty_rate'] = get_text($mb['royalty_rate']);
    $mb['physical_rate'] = get_text($mb['physical_rate']);
    $mb['china_royalty'] = get_text($mb['china_royalty']);
    $mb['admin_adju'] = get_text($mb['admin_adju']);
    */
$sql_common = "  
                adju_ym = '{$_POST['adju_ym']}',
                album_no = '{$_POST['album_no']}',
                sale_quantity = '{$_POST['sale_quantity']}',
                cd_price = '{$_POST['cd_price']}',
                bep = '{$_POST['bep']}',
                royalty_rate = '{$_POST['royalty_rate']}',
                physical_rate = '{$_POST['physical_rate']}',
                china_royalty = '{$_POST['china_royalty']}',
                admin_adju = '{$_POST['admin_adju']}'

            ";

if ($w == '')
{
    $insql = " insert into {$g5['adju_basic_table']}  
                set  regdate = now(), 
                    mb_id = '{$member['mb_id']}',
                     {$sql_common} ";
}
else if ($w == 'u')
{

    $insql = " update {$g5['adju_basic_table']} 
                set {$sql_common}
                     , regdate = now()
                where no = '{$no}' ";
}
else
    alert('제대로 된 값이 넘어오지 않았습니다.');
//echo $insql."<BR>";
sql_query($insql);
if ($w == '')
    $no = sql_insert_id();
//exit;

$fail_od_id = array();
$total_count = 0;
$fail_count = 0;
$succ_count = 0;
$fail_str = "";

if ($uploaded_del) {
    $dsql = "delete from {$g5['adju_data_table']} x where x.adju_basic_no = '{$no}' ";
    //echo $dsql."<BR>";
    //exit;
    sql_query($dsql);
}

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

$g5['title'] = '시리얼번호 엑셀업로드 처리 결과';
include_once(G5_ADMIN_PATH.'/admin.head.sub.php');
?>

<div class="new_win">
    <h1><?php echo $g5['title']; ?></h1>

    <div class="local_desc01 local_desc">
        <p>업로드처리를 완료했습니다.</p>
    </div>

    <dl id="excelfile_result">
        <dt>총업로드 건수</dt>
        <dd><?php echo number_format($total_count); ?></dd>
        <dt class="result_done">정상 업로드 건수</dt>
        <dd class="result_done"><?php echo number_format($succ_count); ?></dd>
        <dt class="result_fail">실패(중복)건수</dt>
        <dd class="result_fail"><?php echo number_format($fail_count); ?></dd>
        <?php if($fail_count > 0) { ?>
        <dt>실패코드</dt>
        <dd><?php echo implode(', ', $fail_od_id); 
        //echo $fail_str;
        ?></dd>
        <?php } ?>
    </dl>

    <div class="btn_confirm01 btn_confirm">
        <button type="button" onclick="goFinish();">확인완료</button>
    </div>
<?php //print_r2($wdata); ?>
</div>
<script>
    function goFinish() {
        var loc = "<?php echo './adju_form.php?'.$qstr.'&amp;w=u&amp;no='.$no;?>";
        location.href=loc;
    }
    </script>
<?php


goto_url('./adju_form.php?'.$qstr.'&amp;w=u&amp;no='.$no, false);
?>