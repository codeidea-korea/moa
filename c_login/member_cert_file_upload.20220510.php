<?php
include_once('./_common.php');
include_once(G5_LIB_PATH.'/naver_syndi.lib.php');
include_once(G5_CAPTCHA_PATH.'/captcha.lib.php');

$upload_max_filesize = ini_get('upload_max_filesize');

if (empty($_POST)) {
    alert("파일 또는 글내용의 크기가 서버에서 설정한 값을 넘어 오류가 발생하였습니다.\\npost_max_size=".ini_get('post_max_size')." , upload_max_filesize=".$upload_max_filesize."\\n게시판관리자 또는 서버관리자에게 문의 바랍니다.");
}


// 파일개수 체크
$file_count   = 0;
$upload_count = count($_FILES['bf_file']['name']);

for ($i=0; $i<$upload_count; $i++) {
    if($_FILES['bf_file']['name'][$i] && is_uploaded_file($_FILES['bf_file']['tmp_name'][$i]))
        $file_count++;
}

$days = date("Y-m");
// 디렉토리가 없다면 생성합니다. (퍼미션도 변경하구요.)
@mkdir(G5_DATA_PATH.'/certi/'.$days, G5_DIR_PERMISSION);
@chmod(G5_DATA_PATH.'/certi/'.$days, G5_DIR_PERMISSION);

$chars_array = array_merge(range(0,9), range('a','z'), range('A','Z'));

// 가변 파일 업로드
$file_upload_msg = '';
$upload = array();
//echo "<BR><BR><BR><BR>count : ".count($_FILES['bf_file']['name'])."<BR>";
for ($i=0; $i<count($_FILES['bf_file']['name']); $i++) {
    $upload[$i]['file']     = '';
    $upload[$i]['source']   = '';
    $upload[$i]['filesize'] = 0;
    $upload[$i]['image']    = array();
    $upload[$i]['image'][0] = '';
    $upload[$i]['image'][1] = '';
    $upload[$i]['image'][2] = '';

   
    // $tmp_file  = $_FILES['bf_file']['tmp_name'][$i];
    // $filesize  = $_FILES['bf_file']['size'][$i];
    // $filename  = $_FILES['bf_file']['name'][$i];
    // //$filename  = get_safe_filename($filename);
    $tmp_file  = $_FILES['bf_file']['tmp_name'];
    $filesize  = $_FILES['bf_file']['size'];
    $filename  = $_FILES['bf_file']['name'];
    //$filename  = get_safe_filename($filename);

    // 서버에 설정된 값보다 큰파일을 업로드 한다면
    if ($filename) {
        if ($_FILES['bf_file']['error'] == 1) {
            $file_upload_msg .= '\"'.$filename.'\" 파일의 용량이 서버에 설정('.$upload_max_filesize.')된 값보다 크므로 업로드 할 수 없습니다.\\n';
            continue;
        }
        else if ($_FILES['bf_file']['error'] != 0) {
            $file_upload_msg .= '\"'.$filename.'\" 파일이 정상적으로 업로드 되지 않았습니다.\\n';
            continue;
        }
    }

    if (is_uploaded_file($tmp_file)) {
        // 관리자가 아니면서 설정한 업로드 사이즈보다 크다면 건너뜀
        if (!$is_admin && $filesize > $board['bo_upload_size']) {
            $file_upload_msg .= '\"'.$filename.'\" 파일의 용량('.number_format($filesize).' 바이트)이 게시판에 설정('.number_format($board['bo_upload_size']).' 바이트)된 값보다 크므로 업로드 하지 않습니다.\\n';
            continue;
        }

        //=================================================================\
        // 090714
        // 이미지나 플래시 파일에 악성코드를 심어 업로드 하는 경우를 방지
        // 에러메세지는 출력하지 않는다.
        //-----------------------------------------------------------------
        $timg = @getimagesize($tmp_file);
        // image type
        if ( preg_match("/\.({$config['cf_image_extension']})$/i", $filename) ||
             preg_match("/\.({$config['cf_flash_extension']})$/i", $filename) ) {
            if ($timg['2'] < 1 || $timg['2'] > 16)
                continue;
        }
        //=================================================================

        $upload[$i]['image'] = $timg;

        // // 4.00.11 - 글답변에서 파일 업로드시 원글의 파일이 삭제되는 오류를 수정
        // if ($w == 'u') {
        //     // 존재하는 파일이 있다면 삭제합니다.
        //     $row = sql_fetch(" select bf_file from {$g5['board_file_table']} where bo_table = '$bo_table' and wr_id = '$wr_id' and bf_no = '$i' ");
        //     @unlink(G5_DATA_PATH.'/certi/'.$days.'/'.$row['bf_file']);
        //     // 이미지파일이면 썸네일삭제
        //     if(preg_match("/\.({$config['cf_image_extension']})$/i", $row['bf_file'])) {
        //         delete_board_thumbnail($bo_table, $row['bf_file']);
        //     }
        // }

        // 프로그램 원래 파일명
        $upload[$i]['source'] = $filename;
        $upload[$i]['filesize'] = $filesize;

        // 아래의 문자열이 들어간 파일은 -x 를 붙여서 웹경로를 알더라도 실행을 하지 못하도록 함
        $filename = preg_replace("/\.(php|pht|phtm|htm|cgi|pl|exe|jsp|asp|inc)/i", "$0-x", $filename);

        shuffle($chars_array);
        $shuffle = implode('', $chars_array);

        // 첨부파일 첨부시 첨부파일명에 공백이 포함되어 있으면 일부 PC에서 보이지 않거나 다운로드 되지 않는 현상이 있습니다. (길상여의 님 090925)
        $upload[$i]['file'] = abs(ip2long($_SERVER['REMOTE_ADDR'])).'_'.substr($shuffle,0,8).'_'.replace_filename($filename);

        $dest_file = G5_DATA_PATH.'/certi/'.$days.'/'.$upload[$i]['file'];

        // 업로드가 안된다면 에러메세지 출력하고 죽어버립니다.
        $error_code = move_uploaded_file($tmp_file, $dest_file) or die($_FILES['bf_file']['error']);

        // 올라간 파일의 퍼미션을 변경합니다.
        chmod($dest_file, G5_FILE_PERMISSION);
        //echo "-----------여기는------<BR>";
    }
}


$f_kind = $_POST['f_kind'];
// 나중에 테이블에 저장하는 이유는 $wr_id 값을 저장해야 하기 때문입니다.
for ($i=0; $i<count($upload); $i++)
{
    if (!get_magic_quotes_gpc()) {
        $upload[$i]['source'] = addslashes($upload[$i]['source']);
    }

    $row = sql_fetch(" select count(*) as cnt from deb_certi_image where  mb_id = '{$member['mb_id']}' ");
    if ($row['cnt'])
    {
        // 삭제에 체크가 있거나 파일이 있다면 업데이트를 합니다.
        // 그렇지 않다면 내용만 업데이트 합니다.

       
            $sql = " update deb_certi_image
                        set filename = '{$upload[$i]['source']}',
                            file_type = '{$f_kind}',
                            file_path = '/data/certi/{$days}',
                            bf_file = '{$upload[$i]['file']}',
                             bf_filesize = '{$upload[$i]['filesize']}',
                             bf_width = '{$upload[$i]['image']['0']}',
                             bf_height = '{$upload[$i]['image']['1']}',
                             bf_type = '{$upload[$i]['image']['2']}',
                             regdate = '".G5_TIME_YMDHIS."'
                      where mb_id = '{$member['mb_id']}'
                                 ";
            sql_query($sql);
       
    }
    else
    {
        $sql = " insert into deb_certi_image
                    set 
                    mb_id = '{$member['mb_id']}', 
                    filename = '{$upload[$i]['source']}',
                    file_type = '{$f_kind}',
                    file_path = '/data/certi/{$days}',
                    bf_file = '{$upload[$i]['file']}',
                    bf_filesize = '{$upload[$i]['filesize']}',
                    bf_width = '{$upload[$i]['image']['0']}',
                    bf_height = '{$upload[$i]['image']['1']}',
                    bf_type = '{$upload[$i]['image']['2']}',
                    regdate = '".G5_TIME_YMDHIS."'
                    ";
        sql_query($sql);
    }
}


// echo "<BR><BR><BR><BR><BR>";
// echo " files :: ";
// print_r2($_FILES);

// echo "<BR><BR><BR><BR><BR>";
// print_r2($upload);
// echo "<BR> error_code : ".$error_code."<BR>";