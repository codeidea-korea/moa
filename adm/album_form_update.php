<?php
$sub_menu = "750000";
include_once("./_common.php");
include_once(G5_LIB_PATH."/register.lib.php");
include_once(G5_LIB_PATH.'/thumbnail.lib.php');
error_reporting(E_ALL);

if ($w == 'u')
    check_demo();

auth_check($auth[$sub_menu], 'w');

$act = $_POST['act'];

check_admin_token();
if ($act == 'album') {
    //print_r2($_POST);
    $no = procAlbum($_POST);
    //exit;
    /*
    $no = $_POST['no'];
    $catalog_num = $_POST['catalog_num'];
    $album_name = $_POST['album_name'];
    $artist_name = $_POST['artist_name'];
    $album_content = $_POST['album_content'];
    $flac88 = $_POST['flac88'];
    $flac176 = $_POST['flac176'];
    $flac256 = $_POST['flac256'];
    $dsd64 = $_POST['dsd64'];
    $dsd128 = $_POST['dsd128'];
    $dsd256 = $_POST['dsd256'];
    $flac88_price = $_POST['flac88_price'];
    $flac176_price = $_POST['flac176_price'];
    $flac256_price = $_POST['flac256_price'];
    $dsd64_price = $_POST['dsd64_price'];
    $dsd128_price = $_POST['dsd128_price'];
    $dsd256_price = $_POST['dsd256_price'];

    $sql_common = "  
                    catalog_num = '{$catalog_num}',
                    artist_name = '{$artist_name}',
                    album_name = '{$album_name}',
                    album_content = '{$album_content}',
                    flac88 = '{$flac88}',
                    flac176 = '{$flac176}',
                    flac256 = '{$flac256}',
                    dsd64 = '{$dsd64}',
                    dsd128 = '{$dsd128}',
                    dsd256 = '{$dsd256}',
                    flac88_price = '{$flac88_price}',
                    flac176_price = '{$flac176_price}',
                    flac256_price = '{$flac256_price}',
                    dsd64_price = '{$dsd64_price}',
                    dsd128_price = '{$dsd128_price}',
                    dsd256_price = '{$dsd256_price}'

                ";

    if ($w == '')
    {
        $insql = " insert into {$g5['album_table']}  
                    set  regdate = now(), 
                        mb_id = '{$member['mb_id']}',
                         {$sql_common} ";
    }
    else if ($w == 'u')
    {

        $insql = " update {$g5['album_table']} 
                    set {$sql_common}
                         , regdate = now()
                    where no = '{$no}' ";
    }
    else
        alert('제대로 된 값이 넘어오지 않았습니다.');
    sql_query($insql);
    if ($w == '')
        $no = sql_insert_id();
    */
    //print_r2($_POST);
    //echo $insql."<BR>";exit;

    $fail_od_id = array();
    $total_count = 0;
    $fail_count = 0;
    $succ_count = 0;
    $fail_str = "";
    $uploaded_del = isset($_POST['uploaded_del'])?$_POST['uploaded_del']:'';

    if ($uploaded_del) {
        $dsql = "delete from {$g5['album_table']} x where x.adju_basic_no = '{$no}' ";
        //echo $dsql."<BR>";
        //exit;
        sql_query($dsql);
    }
}
else {

    procAlbumSong($_POST);
    /*
    $no = $_POST['no'];
    $w = $_POST['w'];
    $ord = $_POST['ord'];
    $album_no = $_POST['album_no'];
    $title = $_POST['title'];
    $genre = $_POST['genre'];
    $artist_name = $_POST['artist_name'];
    $length = $_POST['length'];
    $content = $_POST['content'];
    $ord = ($ord)?$ord:0;

    $sql_common = "  
                    ord = '{$ord}',
                    title = '{$title}',
                    genre = '{$genre}',
                    artist_name = '{$artist_name}',
                    album_no = '{$album_no}',
                    length = '{$length}',
                    content = '{$content}'
                   

                ";

    if ($w == '')
    {
        $insql = " insert into {$g5['album_song_table']}  
                    set  regdate = now(), 
                        mb_id = '{$member['mb_id']}',
                         {$sql_common} ";
    }
    else if ($w == 'u')
    {

        $insql = " update {$g5['album_song_table']} 
                    set {$sql_common}
                         , regdate = now()
                    where no = '{$no}' ";
    }
    else
        alert('제대로 된 값이 넘어오지 않았습니다.');
    sql_query($insql);
    if ($w == '')
        $no = sql_insert_id();
    */
    //echo $insql."<BR>";
    //exit;
    $no = $album_no;
    //alert("아직 곡정보는 개발중입니다.");
}
$g5['title'] = ' 앨범 저장 처리 결과';
include_once(G5_ADMIN_PATH.'/admin.head.sub.php');
?>

<div class="new_win">
    <h1><?php echo $g5['title']; ?></h1>

    <div class="local_desc01 local_desc">
        <p>앨범저장 처리를 완료했습니다.</p>
    </div>


    <div class="btn_confirm01 btn_confirm">
        <button type="button" onclick="goFinish();">확인완료</button>
    </div>
<?php //print_r2($wdata); ?>
</div>
<script>
    function goFinish() {
        var loc = "<?php echo './album_form.php?'.$qstr.'&amp;w=u&amp;no='.$no;?>";
        location.href=loc;
    }
    </script>
<?php


goto_url('./album_form.php?'.$qstr.'&amp;w=u&amp;no='.$no, false);


/*


function procAlbumSong($datas) {
    global $g5, $member;
    if ($datas['artist'])
        $datas['artist_name'] = $datas['artist'];

    $no = $datas['no'];
    $w = $datas['w'];
    $ord = $datas['ord'];
    $album_no = $datas['album_no'];
    $title = $datas['title'];
    $genre = $datas['genre'];
    $artist_name = $datas['artist_name'];
    $length = $datas['length'];
    $content = $datas['content'];

    $album = $datas['album'];
    $catalog_num = $datas['catalog_num'];

    $ord = ($ord)?$ord:0;
    if (!$album_no) {
        $sql = "SELECT * from {$g5['album_table']}  
                WHERE catalog_num = '{$catalog_num}' ";
        $row = sql_fetch($sql);
        if ($row && $row['catalog_num']) {
            $album_no = $row['album_no'];
        }
        else {
            $datas['album_name'] = $datas['album'];
            $aldata = $datas;
            $aldata['w'] = '';
            $album_no = procAlbum($aldata);
        }   
    }
    $sql_common = "  
                    ord = '{$ord}',
                    title = '{$title}',
                    genre = '{$genre}',
                    artist_name = '{$artist_name}',
                    album_no = '{$album_no}',
                    length = '{$length}',
                    content = '{$content}'
                   

                ";

    if ($w == '')
    {
        $insql = " INSERT into {$g5['album_song_table']}  
                    set  regdate = now(), 
                        mb_id = '{$member['mb_id']}',
                         {$sql_common} ";
    }
    else if ($w == 'u')
    {

        $insql = " UPDATE {$g5['album_song_table']} 
                    set {$sql_common}
                         , regdate = now()
                    where no = '{$no}' ";
    }
    else
        alert('제대로 된 값이 넘어오지 않았습니다.');
    sql_query($insql);
    if ($w == '')
        $no = sql_insert_id();
    return $no;
}

function procAlbum($datas) {
    global $g5, $member;

    $w = $datas['w'];
    $no = $datas['no'];
    $catalog_num = $datas['catalog_num'];
    $album_name = $datas['album_name'];
    $artist_name = $datas['artist_name'];
    $album_content = $datas['album_content'];
    $flac88 = $datas['flac88'];
    $flac176 = $datas['flac176'];
    $flac256 = $datas['flac256'];
    $dsd64 = $datas['dsd64'];
    $dsd128 = $datas['dsd128'];
    $dsd256 = $datas['dsd256'];
    $flac88_price = $datas['flac88_price'];
    $flac176_price = $datas['flac176_price'];
    $flac256_price = $datas['flac256_price'];
    $dsd64_price = $datas['dsd64_price'];
    $dsd128_price = $datas['dsd128_price'];
    $dsd256_price = $datas['dsd256_price'];

    $sql_common = "  
                    catalog_num = '{$catalog_num}',
                    artist_name = '{$artist_name}',
                    album_name = '{$album_name}',
                    album_content = '{$album_content}',
                    flac88 = '{$flac88}',
                    flac176 = '{$flac176}',
                    flac256 = '{$flac256}',
                    dsd64 = '{$dsd64}',
                    dsd128 = '{$dsd128}',
                    dsd256 = '{$dsd256}',
                    flac88_price = '{$flac88_price}',
                    flac176_price = '{$flac176_price}',
                    flac256_price = '{$flac256_price}',
                    dsd64_price = '{$dsd64_price}',
                    dsd128_price = '{$dsd128_price}',
                    dsd256_price = '{$dsd256_price}'

                ";

    if ($w == '')
    {
        $insql = " INSERT into {$g5['album_table']}  
                    set  regdate = now(), 
                        mb_id = '{$member['mb_id']}',
                         {$sql_common} ";
    }
    else if ($w == 'u')
    {

        $insql = " UPDATE {$g5['album_table']} 
                    set {$sql_common}
                         , regdate = now()
                    where no = '{$no}' ";
    }
    else
        alert('제대로 된 값이 넘어오지 않았습니다.');
    sql_query($insql);
    if ($w == '')
        $no = sql_insert_id();
    return $no;
}
*/
?>