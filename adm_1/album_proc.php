<?php
$sub_menu = "750200";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'w');
$no = $_GET['no'];

//error_reporting(E_ALL);


//ini_set('display_errors', '1');
//error_reporting(E_ALL);

require G5_PATH.'/flac/src/Flac.php';
use bluemoehre\Flac;
check_demo();

//auth_check($auth[$sub_menu], 'w');

//check_admin_token();

//$default_path = G5_PATH."/Content_data";
$default_path = G5_PATH."/content-files";
$music_file_url = "AGCD0116";
$procdir = isset($_GET['procdir'])?$_GET['procdir']:'';
//echo "------------<br>".__DIR__."<BR>";


$contdata = array();
$tmp = dir($default_path);
while ($entry = $tmp->read()) {
    // php 파일만 include 함
    $contdata[] = $entry;
}
$dirs = array();
if(!empty($contdata) && is_array($contdata)) {
    natsort($contdata);

    foreach($contdata as $file) {
        if(is_dir($default_path.'/'.$file)) { // 폴더이면 
            if ($file != "." && $file != ".." ) 
             $dirs[] = $file; 
        } 
    }
    unset($file);
}
//unset($contdata);
//print_r2($dirs);


include_once('./admin.head.php');
//include_once(G5_ADMIN_PATH.'/admin.head.sub.php');

$cnt = count($dirs);
echo "<h2>앨범 코드</h2>";
echo "<ul>";
for ($i =0 ;$i < $cnt; $i++) {
    $sql = "SELECT album_name,
                (SELECT count(*) from {$g5['album_song_table']} x where x.album_no = a.no) song_cnt
            FROM {$g5['album_table']} a
            where catalog_num = '{$dirs[$i]}' ";
    $row = sql_fetch($sql);
    ?>
    <li><a href="<?php echo $_SERVER['PHP_SELF'];?>?procdir=<?php echo $dirs[$i];?>"><?php echo $dirs[$i];?></a>
        <?php if ($row && $row['album_name']) {
            echo "::  album : ".$row['album_name']." - songs : ".$row['song_cnt']."  ";
        }
        ?>
    </li>
    <?php
}
echo "</ul>";
//echo $cnt."<BR>";
if ($procdir) {
    $list = getDirFlac($procdir, $default_path);
    //print_r2($list);
}

function getFlacinfo($file, $default_path,$dir) {
    global $g5;
    $info = array();
    $flac_file_path = $default_path.'/'.$dir.'/flac88/'.$file;

    $chk_dir = $default_path.'/'.$dir;
    if (!is_dir($chk_dir)) {
        $flac_file_path = $default_path.'/'.$dir.'/flac176/'.$file;        
        if (!is_dir($chk_dir)) {
            $flac_file_path = $default_path.'/'.$dir.'/flac256/'.$file;        
            if (!is_dir($chk_dir)) {
                $flac_file_path = $default_path.'/'.$dir.'/flac352/'.$file;        
                if (!is_dir($chk_dir)) {
                    $flac_file_path = $default_path.'/'.$dir.'/flac44/'.$file;        
                }
        
            }
        
        }
        alert('폴더가 존재하지 않습니다. 확인후 다시시도 해주시기 바랍니다.');
    }

    $t = microtime(true);
    $flac = new Flac($flac_file_path);
    $t = microtime(true) - $t;
    $imgdir = str_replace(G5_PATH,"",$default_path);

    $info['img'] = G5_URL.''.$imgdir.'/'.$dir.'/'.substr($dir, 0, 8).'_Cover.jpg';
    $info['img2'] = $default_path.'/'.$dir.'/'.substr($dir, 0, 8).'_Cover.jpg';
    //echo "------------<br>";
    $info['comments'] = $flac->getVorbisComment()['comments'];
    $flac = null;
    return $info;
    
}

function getDirFlac($dir, $default_path) {
    global $g5;

    //$cnt = count($dirs);
    //$list = array();
    //echo $cnt."<BR>";
    //for ($a=0; $a < $cnt; $a++) {
        //$dir = $dirs[$a];
        $info = "";
        $files = getfiles($dir, $default_path);
        if ($files) {
            if (is_array($files))
                $cnts = count($files);
            else 
                $cnts = 1;
        }
        else 
            $cnts = 0;
        
        if ($cnts>0) {
            $info = array();

        echo "<h2>곡명</h2>";
        }
        echo "<ul>";
        for ($i=0; $i < $cnts; $i++) {

            $info[$i] = getFlacinfo($files[$i],$default_path,$dir);
            $info[$i]['comments']['w'] = '';
            $info[$i]['comments']['catalog_num'] = $dir;
            $info[$i]['comments']['filename'] = $files[$i];
            echo "<span sytle='border:1px solid #222;background-color:#222;height:2px;width:500px'><br>";
            echo "<li>".$files[$i]."</li>";
            procAlbumSong($info[$i]['comments']);
            echo "<span sytle='border:1px solid #222;background-color:#222;height:2px;width:500px'><br>";
            //print_r2($info[$i]['comments']);
        } 
        echo "</ul>";

        //$list[$a] = $info;
    //}  
    //return $list;
    return $info;

}

function getDirFlacs($dirs, $default_path) {
    global $g5;

    $cnt = count($dirs);
    $list = array();
    //echo $cnt."<BR>";
    for ($a=0; $a < $cnt; $a++) {
        $dir = $dirs[$a];
        
        $files = getfiles($dir, $default_path);
        $cnts = count($files);
        //print_r2($files);
        for ($i=0; $i < $cnts; $i++) {

            $info = getFlacinfo($files[$i],$default_path,$dir);
        //    print_r2($info);
        } 
        $list[$a] = $info;
    }  
    return $list;

}

//*/


include_once('./admin.tail.php');
?>
