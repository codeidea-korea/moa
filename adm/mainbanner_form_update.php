<?php
$sub_menu = "100400";
include_once("./_common.php");
include_once(G5_LIB_PATH."/register.lib.php");
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

if ($w == 'u')
    check_demo();

//auth_check($auth[$sub_menu], 'w');

check_admin_token();

$mb_id = trim($_POST['mb_id']);
$mb_no = trim($_POST['mb_no']);

    //procUpload($filearr, $dir, $subdir='', $thumbcreate = false, $thumbwidth=100, $thumbheight=50, $delyn=false )
    $files = procUpload($_FILES['mb_img_pc'], 'mainbanner', 'pc', true, $thumbwidth=100, $thumbheight=50, $delyn=false );
    $mb_img_pc = $files['name'];
    $mb_img_pc_thumb = $files['thumb'];

    $files = procUpload($_FILES['mb_img_mo'], 'mainbanner', 'mobile', true, $thumbwidth=100, $thumbheight=50, $delyn=false );
    $mb_img_mo = $files['name'];
    $mb_img_mo_thumb = $files['thumb'];

    $files = procUpload($_FILES['mb_img_1'], 'mainbanner', 'pc', true, $thumbwidth=100, $thumbheight=50, $delyn=false );
    $mb_img_1 = $files['name'];
    $mb_img_1_thumb = $files['thumb'];

    $files = procUpload($_FILES['mb_img_3'], 'mainbanner', 'mobile', true, $thumbwidth=100, $thumbheight=50, $delyn=false );
    $mb_img_3 = $files['name'];
    $mb_img_3_thumb = $files['thumb'];

	// 배경 이미지 업로드 가능하게 변경 - 19.03.08 -
	$files      = procUpload(
		$_FILES['mb_5'],
		'mainbanner',
		'pc',
		true,
		100,
		50,
		false
	);
	$mb_5       = $files['name'];
	$mb_5_thumb = $files['thumb'];

	$files      = procUpload(
		$_FILES['mb_7'],
		'mainbanner',
		'pc',
		true,
		100,
		50,
		false
	);
	$mb_7       = $files['name'];
	$mb_7_thumb = $files['thumb'];


$sql_common = "  mb_id = '{$member['mb_id']}',
                 mb_url = '{$_POST['mb_url']}',
                 mb_order = '{$_POST['mb_order']}',
                 mb_nolink = '{$_POST['mb_nolink']}',
                 mb_newpop = '{$_POST['mb_newpop']}',
                 mb_btn_text = '{$_POST['mb_btn_text']}',
                 /* 보조 문구 수정 가능하도록 추가 - 19.03.08 - */
                 `mb_sub_btn_text` = '{$_POST['mb_sub_btn_text']}',
                 mb_open = '{$_POST['mb_open']}',
                 mb_open_date = '{$_POST['mb_open_date']}',
                 /* mb_5 = '{$_POST['mb_5']}',
                 mb_6 = '{$_POST['mb_6']}',
                 mb_7 = '{$_POST['mb_7']}',
                 mb_8 = '{$_POST['mb_8']}', */
                 mb_9 = '{$_POST['mb_9']}',
                 mb_10 = '{$_POST['mb_10']}' ";

if ($mb_img_pc)
    $sql_file = "    mb_img_pc = '{$mb_img_pc}',
                 mb_img_pc_thumb = '{$mb_img_pc_thumb}',
            ";
if ($mb_img_mo)
    $sql_file .="                 
                 mb_img_mo = '{$mb_img_mo}',
                 mb_img_mo_thumb = '{$mb_img_mo_thumb}',
                 ";
if ($mb_img_1)
    $sql_file = "    mb_1 = '{$mb_img_1}',
                 mb_2 = '{$mb_img_1_thumb}',
            ";
if ($mb_img_3)
    $sql_file = "    mb_3 = '{$mb_img_3}',
                 mb_4 = '{$mb_img_3_thumb}',
            ";

if ($mb_5)
	$sql_file = "
		`mb_5` = '{$mb_5}',
		`mb_6` = '{$mb_5_thumb}',
	";

if ($mb_7)
	$sql_file = "
		`mb_7` = '{$mb_7}',
		`mb_8` = '{$mb_7_thumb}',
	";

if ($w == '')
{
    $mb = getBanner($mb_no);
    if ($mb['mb_no'])
        alert('이미 존재하는 베너 입니다.\\n '.$mb['mb_btn_text'].'\\n');

    
    $sql = " insert into {$g5['mainbanner_table']} set mb_datetime = '".G5_TIME_YMDHIS."', {$sql_file} {$sql_common} ";
    sql_query($sql);
    //echo $sql."<BR>";
    $mb_no = sql_insert_id();
    //echo "mb_no = ".$mb_no."<BR>";
    //exit;
}
else if ($w == 'u')
{
    $mb = getBanner($mb_no);
    if (!$mb['mb_no'])
        alert('존재하지 않는 베너자료입니다.');


    /*
    // 회원 이미지 삭제
    if ($del_mb_img)
        @unlink($mb_img_dir.'/'.$mb_icon_img);

    // 아이콘 업로드
    if (isset($_FILES['mb_img']) && is_uploaded_file($_FILES['mb_img']['tmp_name'])) {
        if (!preg_match($image_regex, $_FILES['mb_img']['name'])) {
            alert($_FILES['mb_img']['name'] . '은(는) 이미지 파일이 아닙니다.');
        }
        
        if (preg_match($image_regex, $_FILES['mb_img']['name'])) {
            @mkdir($mb_img_dir, G5_DIR_PERMISSION);
            @chmod($mb_img_dir, G5_DIR_PERMISSION);
            
            $dest_path = $mb_img_dir.'/'.$mb_icon_img;
            
            move_uploaded_file($_FILES['mb_img']['tmp_name'], $dest_path);
            chmod($dest_path, G5_FILE_PERMISSION);

            if (file_exists($dest_path)) {
                $size = @getimagesize($dest_path);
                if ($size[0] > $config['cf_member_img_width'] || $size[1] > $config['cf_member_img_height']) {
                    $thumb = null;
                    if($size[2] === 2 || $size[2] === 3) {
                        //jpg 또는 png 파일 적용
                        $thumb = thumbnail($mb_icon_img, $mb_img_dir, $mb_img_dir, $config['cf_member_img_width'], $config['cf_member_img_height'], true, true);
                        if($thumb) {
                            @unlink($dest_path);
                            rename($mb_img_dir.'/'.$thumb, $dest_path);
                        }
                    }
                    if( !$thumb ){
                        // 아이콘의 폭 또는 높이가 설정값 보다 크다면 이미 업로드 된 아이콘 삭제
                        @unlink($dest_path);
                    }
                }
            }
        }
    }
    */

   

    $sql = " update {$g5['mainbanner_table']}
                set {$sql_file} {$sql_common}
                     
                where mb_no = '{$mb_no}' ";
    sql_query($sql);
}
else
    alert('제대로 된 값이 넘어오지 않았습니다.');


goto_url('./mainbanner_form.php?'.$qstr.'&amp;w=u&amp;mb_no='.$mb_no, false);
?>