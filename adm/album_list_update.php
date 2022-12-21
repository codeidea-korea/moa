<?php
$sub_menu = "750000";
include_once('./_common.php');

check_demo();

if (!count($_POST['chk'])) {
    alert($_POST['act_button']." 하실 항목을 하나 이상 체크하세요.");
}

auth_check($auth[$sub_menu], 'w');

check_admin_token();

if ($_POST['act_button'] == "상품전환") {
        // 현재 일괄수정 대상이 없음 

	
    for ($i=0; $i<count($_POST['chk']); $i++)
    {
        // 실제 번호를 넘김
        $k = $_POST['chk'][$i];

        $album = get_album($_POST['no'][$k]);

        if (!$album['no']) {
            $msg .= $album['no'].' : 앨범자료가 존재하지 않습니다.\\n';
        }
        else if (!$album['album_name'])    {
            $msg .= $album['no'].' : 앨범타이틀이 존재하지 않습니다.\\n';
        }
        else {

            $it[$i]['album'] = procAlbum2Item($album['no']);
            //echo 'album proc end<BR>';
            $it[$i]['song'] = prodSong2Item($album['no']);
            //echo 'song proc end<BR>';
            $msg = "상품전환/수정을 완료하였습니다.";
        }
        //echo $msg."<BR>";
        //exit;
    }

} else if ($_POST['act_button'] == "선택삭제" || $_POST['act_button'] == "완전삭제") {

    for ($i=0; $i<count($_POST['chk']); $i++)
    {
        // 실제 번호를 넘김
        $k = $_POST['chk'][$i];

        $album = get_album($_POST['no'][$k]);
        $songs = get_album_song_rows($_POST['no'][$k]);
        if (!$album['no']) {
            $msg .= $album['no'].' : 앨범자료가 존재하지 않습니다.\\n';
        } else {
            // 곡정보 삭제
            
            $sql =" delete from {$g5['album_song_table']} where album_no = '{$album['no']}' ";
            echo $sql."<BR>";
            sql_query($sql, false);

            $sql =" delete from {$g5['album_table']} where no = '{$album['no']}' ";
            echo $sql."<BR>";
            sql_query($sql, false);
            //exit;
			//if($_POST['act_button'] == "완전삭제") {			}
        }
    }
}

    //echo '<script> alert("'.$msg.'"); </script>';
if ($msg)
    alert($msg, './album_list.php?'.$qstr);
//print_r2($it);
goto_url('./album_list.php?'.$qstr);
?>
