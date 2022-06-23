<?php
/******************************************************************************************
***  본 파일은  플래토의  저작물입니다.                                                  ***
***  본 파일의 내용을 허가업이 도용 / 사용할경우 저작권법에 위배됩니다.                     ***
***  허가한 사용자/업체만 사용가능하고, 다른용도로 사용/배포는 불가합니다.                  ***
***  본내용을 다른 용도를 원하실경우 저작자인 플래토 에게 구입하여 사용하시기 바랍니다.      ***
***                                                                                    ***
***                                                                                    ***
***  연락처 => 이메일 :   pletho@gmail.com   , 텔레그램 : @pletho , 카카오톡 : @pletho    ***
******************************************************************************************/
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_PATH."/lib/shop.lib.php");


if ($is_admin)
$includers = true;

$_log = true;

if (true)   {
    error_reporting(E_ERROR | E_PARSE); //     error_reporting(E_ALL);
    ini_set("display_errors", 1);
}


/////////////////////////////////////////////////////////////////////
// 게시판 사이즈에 맞추어서 설정하세요

// 동영상 재생 사이즈 설정
$movie_width = "728";
$movie_height = "413";

// 섬네일 사이즈 설정
$thumb_width = "160";
$thumb_height = "90";
/////////////////////////////////////////////////////////////////////

// 유튜브 동영상 주소에서 동영상 ID만 추출하는 함수
function get_youtubeid($url) {
    $id = str_replace("https://youtu.be/", "", $url);
    $id = str_replace("http://youtu.be/", "", $id);
    $id = str_replace("https://www.youtube.com/watch?v=", "", $id);
    $id = str_replace("http://www.youtube.com/watch?v=", "", $id);
    
    return $id;
}

function get_vimeoid($url) {
    $id = str_replace("https://vimeo.com/channels/staffpicks/", "", $url);
    $id = str_replace("https://vimeo.com/channels/staffpicks/", "", $id);
    $id = str_replace("https://vimeo.com/", "", $id);
    $id = str_replace("http://vimeo.com/", "", $id);

    return $id;
}

function get_vimeoThumb($id) {
    $apiurl = "http://vimeo.com/api/v2/video/".$id.".xml";
    $response = file_get_contents($apiurl);
    $xml = simplexml_load_string($response);

    $thumbUrl = $xml->video->thumbnail_medium;

    return $thumbUrl;
}


// 동영상 리스트 
function getListLecVod($cc_id, $table = 'lec_curriculum_vod', $_h = 'cc_id')  {
    global $g5;

    $tables = $g5[$table."_table"];
    $sql = "select * from {$tables} where ".$_h." = '{$cc_id}' ";
    $sql .= " order by cv_order asc, cv_no asc ";
    //echo $sql."<BR>";
    $list = array();
    $result = sql_query($sql);
    $i = 0;
    while ($row = sql_fetch_array($result)) {
        $list[$i] = $row;
        $i++;
    }

    return $list;
}



function getBanner($mb_no, $table = 'mainbanner')  {
    global $g5;

    $tables = $g5[$table."_table"];
    $sql = "select * from {$tables} where mb_no = '{$mb_no}' ";
    $row = sql_fetch($sql);

    return $row;
}

function getTableContents($mb_no, $table = 'mainbanner', $_h = 'mb')  {
    global $g5;

    $tables = $g5[$table."_table"];
    $sql = "select * from {$tables} where ".$_h."_no = '{$mb_no}' ";
    //echo $sql."<BR>";
    $row = sql_fetch($sql);

    return $row;
}



function getLecContents($mb_no, $table = 'mainbanner', $_h = 'cc_id')  {
    global $g5;

    $tables = $g5[$table."_table"];
    $sql = "select * from {$tables} where ".$_h." = '{$mb_no}' ";
    //echo $sql."<BR>";
    $row = sql_fetch($sql);

    return $row;
}


// 컨텐츠 삭제
function mainContent_delete($mb_no, $table = 'mainbanner', $_h = 'mb')
{
    global $config;
    global $g5;
    $tables = $g5[$table."_table"];
    $sql = " select * from {$tables} where ".$_h."_no= '".$mb_no."' ";
    $mb = sql_fetch($sql);
    //echo $sql.'<BR>';

    // 이미 삭제된 회원은 제외
    if(preg_match('#^[0-9]{8}.*삭제함#', $mb[$_h.'_memo']))
        return;

    // 회원자료는 정보만 없앤 후 아이디는 보관하여 다른 사람이 사용하지 못하도록 함 : 061025
    //$sql = " update {$g5['mainbanner_table']} set mb_img_pc = '', mb_img_mo = '', mb_url = '', mb_btn_text = '' where mb_no = '{$mb_no}' ";
    $sql = " delete from  {$tables}  where ".$_h."_no = '{$mb_no}' ";
    sql_query($sql);
    //echo $sql.'<BR>';
}



// 데이타 삭제
function deleteLecContent($idx, $table = 'lec_curriculum', $_h = 'cc', $key = 'cc_id')
{
    global $config;
    global $g5;
    $tables = $g5[$table."_table"];
    $sql = " select * from {$tables} where ".$key." = '".$idx."' ";
    $mb = sql_fetch($sql);
    //echo $sql.'<BR>';

    // 이미 삭제된 회원은 제외
    //if(preg_match('#^[0-9]{8}.*삭제함#', $mb[$_h.'_memo']))        return;

    // 회원자료는 정보만 없앤 후 아이디는 보관하여 다른 사람이 사용하지 못하도록 함 : 061025
    //$sql = " update {$g5['mainbanner_table']} set mb_img_pc = '', mb_img_mo = '', mb_url = '', mb_btn_text = '' where mb_no = '{$mb_no}' ";
    $sql = " delete from  {$tables}  where ".$key." = '{$idx}' ";
    sql_query($sql);
    //echo $sql.'<BR>';
    // 이미지 삭제
    if ($mb[$_h.'_img_pc'])  @unlink(G5_DATA_PATH.'/'.$mb[$_h.'_img_pc']);
    if ($mb[$_h.'_img_mo']) @unlink(G5_DATA_PATH.'/'.$mb[$_h.'_img_mo']);
    if ($mb[$_h.'_img_pc_thumb']) @unlink(G5_DATA_PATH.'/'.$mb[$_h.'_img_pc_thumb']);
    if ($mb[$_h.'_img_mo_thumb']) @unlink(G5_DATA_PATH.'/'.$mb[$_h.'_img_mo_thumb']);
}


// 베너삭제
function mainbanner_delete($mb_no)
{
    global $config;
    global $g5;

    $sql = " select * from {$g5['mainbanner_table']} where mb_no = '".$mb_no."' ";
    $mb = sql_fetch($sql);

    // 이미 삭제된 회원은 제외
    if(preg_match('#^[0-9]{8}.*삭제함#', $mb['mb_memo']))
        return;

    // 회원자료는 정보만 없앤 후 아이디는 보관하여 다른 사람이 사용하지 못하도록 함 : 061025
    //$sql = " update {$g5['mainbanner_table']} set mb_img_pc = '', mb_img_mo = '', mb_url = '', mb_btn_text = '' where mb_no = '{$mb_no}' ";
    $sql = " delete from  {$g5['mainbanner_table']}  where mb_no = '{$mb_no}' ";
    sql_query($sql);

    // 아이콘 삭제
    @unlink(G5_PATH.'/'.$mb['mb_img_pc']);
    @unlink(G5_PATH.'/'.$mb['mb_img_mo']);
}


function procUpload($filearr, $dir, $subdir='', $thumbcreate = false, $thumbwidth=100, $thumbheight=50, $delyn=false )  {
    global $g5;

   

    $chkdir =G5_DATA_PATH."/".$dir; 
    if (!is_dir($chkdir))
        mkdir($chkdir, G5_DIR_PERMISSION);

    // 회원 아이콘 삭제

    if ($delyn)
        @unlink(G5_DATA_PATH."/".$dir."/".$subdir."/".$filearr['name']);

    $image_regex = "/(\.(gif|jpe?g|png))$/i";
    $upload_file = $filearr['name'];

    // 아이콘 업로드
    if (isset($filearr) && is_uploaded_file($filearr['tmp_name'])) {
        if (!preg_match($image_regex, $filearr['name'])) {
            alert($filearr['name'] . '은(는) 이미지 파일이 아닙니다.');
        }

        if (preg_match($image_regex, $filearr['name'])) {
            $uploaddir = G5_DATA_PATH."/".$dir."/".$subdir;
            if (!is_dir($uploaddir))   {
                mkdir($uploaddir, G5_DIR_PERMISSION);
                chmod($uploaddir, G5_DIR_PERMISSION);
            }

            $dest_path = $uploaddir."/".$upload_file;
            $tmp_file = $filearr['tmp_name'];
            if (is_uploaded_file($tmp_file)) {
                move_uploaded_file($tmp_file, $dest_path);
                chmod($dest_path, G5_FILE_PERMISSION);
                //echo "업로드 중 ".$uploaddir."<BR>".$dest_path."<BR>";
            }

            if ($thumbcreate)   {
                if (file_exists($dest_path)) {
                    $size = @getimagesize($dest_path);
                    if ($size[0] > $thumbwidth || $size[1] > $thumbheight) {
                        $thumb = null;
                        if($size[2] === 2 || $size[2] === 3) {
                            //jpg 또는 png 파일 적용
                            $thumb = thumbnail($upload_file, $uploaddir, $uploaddir, $thumbwidth*2, $thumbheight*2, true, true);
                            //if($thumb) {
                                //rename($mainbanner_dir.'/'.$thumb, $dest_path);
                            //}
                        }
                    }
                }
            }

            
        }
    }
    $files = array();
    if ($upload_file)   {

        $files['name'] = "/".G5_DATA_DIR."/".$dir."/".$subdir."/".$upload_file;
        $files['thumb'] = "/".G5_DATA_DIR."/".$dir."/".$subdir."/".$thumb;
    }
    else {
        $files['name'] = $files['thumb'] = '';
    }
 
    return $files;
}




// 메인배너출력
function display_main_banner($position, $skin='')
{
    global $g5;

    if (!$position) $position = '중앙';
    if (!$skin) $skin = 'banner.skin.php';

    $skin_path = G5_SKIN_PATH.'/main/'.$skin;
    if(G5_IS_MOBILE)
        $skin_path = G5_MOBILE_PATH.'/'.$skin;
    //echo " skin_path : ".$skin_path.file_exists($skin_path)."<BR>";
    if(file_exists($skin_path)) {
        // 접속기기
        //$sql_device = " and ( bn_device = 'both' or bn_device = 'pc' ) ";
        //if(G5_IS_MOBILE)
            //$sql_device = " and ( bn_device = 'both' or bn_device = 'mobile' ) ";

        // 배너 출력
        $sql = " select * from {$g5['mainbanner_table']} where 1=1 order by mb_order, mb_no desc ";
        $result = sql_query($sql);
        //echo $sql."<BR>";
        include $skin_path;

    } else {
        echo '<p>'.str_replace(G5_PATH.'/', '', $skin_path).'파일이 존재하지 않습니다.</p>';
    }
}

function getMyLecList($type = '수강중') {
    global $g5, $member;

    if ($type == "수강중")
        $addsql = " and curdate() between a.start_date and a.end_date ";
    if ($type == "종료")
        $addsql = " and curdate() > a.end_date ";
    $sql = "select b.it_id, b.it_name, b.ca_id, b.ca_id2, if (b.ca_id2 is not null, b.ca_id2, b.ca_id) caid, a.start_date sdate, a.end_date edate, b.it_origin days, datediff(a.end_date, curdate()) etc_days,
                if (substr(b.ca_id, 1, 2) = '10' or substr(b.ca_id2, 1,2) = '10', '강의','도서') type 
            from {$g5['g5_shop_cart_table']} a, {$g5['g5_shop_item_table']} b 
            where a.it_id = b.it_id
                and a.mb_id = '{$member['mb_id']}'
                and (substr(b.ca_id, 1, 2) = '10' or substr(b.ca_id2, 1,2) = '10')
                and a.ct_status='완료'
                {$addsql}
            ";
    $list = array();
    //echo "sql : ".$sql."<BR>";
    $result = sql_query($sql);
    for ($i=0; $row = sql_fetch_array($result);$i++) {
        $list[$i] = array();
        $list[$i] = $row;
    }
    return $list;

}



function getBuyList() {
    global $g5, $member;

   
    $sql = "select b.it_id, b.it_name, b.ca_id, b.ca_id2, if (b.ca_id2 is not null, b.ca_id2, b.ca_id) caid, a.start_date sdate, a.end_date edate, b.it_origin days,
                if (substr(b.ca_id, 1, 2) = '10' or substr(b.ca_id2, 1,2) = '10', '강의','도서') type 
            from {$g5['g5_shop_cart_table']} a, {$g5['g5_shop_item_table']} b 
            where a.it_id = b.it_id
                and a.mb_id = '{$member['mb_id']}'
                and (substr(b.ca_id, 1, 2) = '10' or substr(b.ca_id2, 1,2) = '10' 
                    or substr(b.ca_id, 1, 2) = '20' or substr(b.ca_id2, 1,2) = '20')
                and a.ct_status='완료'
            ";
    $list = array();
    //echo "<pre>".$sql."</pre><br>";
    $result = sql_query($sql);
    for ($i=0; $row = sql_fetch_array($result);$i++) {
        $list[$i] = array();
        $list[$i] = $row;
    }
    return $list;

}


function getCurriculumList($itid) {
    global $g5;
    $sql = "select a.it_id, b.* from {$g5['item_curriculum_table']} a, 
                {$g5['lec_curriculum_table']} b
            where a.it_id = '{$itid}'
                and a.cc_id = b.cc_id
            order by cc_order asc
            ";
    //echo "curri : ".$sql."<br>";
    $result = sql_query($sql);
    $list = array();

    for($i =0;$row = sql_fetch_array($result); $i++){
        $list[$i] = $row;
    }
    return $list;
}

function getCurriculumVodList($ccid,$status=0) {
    global $g5;

    if (!$ccid) return false;
    //echo $status."<BR>";
    if ($status)
        $stsql = " , '1' ";

    $sql = "select * from {$g5['lec_curriculum_vod_table']} a
            where a.cc_id = '{$ccid}'
            and cv_type in ('0' {$stsql} )
            order by cv_no asc
            ";
    //echo "currsivod : ".$sql."<BR>";
    $result = sql_query($sql);
    $list = array();

    for($i =0;$row = sql_fetch_array($result); $i++){
        $list[$i] = $row;
    }
    return $list;

}


function getCurriculumVod($cvno) {
    global $g5;

    if (!$cvno) return false;

    $sql = "select * from {$g5['lec_curriculum_vod_table']} a
            where a.cv_no = '{$cvno}'
            ";
    $row = sql_fetch($sql);
    return $row;

}


function printCurrList($it, $cvno = 0, $target="popplayer") {
    global $g5;
    $curr = getCurriculumList($it);
    $length = count($curr);
    if ($cvno) {
        echo '<div id="playerall">';
        echo '<div id="player" style="background-color:#F0F0F0;position:relative;float:left;width:850px;padding:5px;margin:3px;padding-bottom:30px;" >';
        $vod = getCurriculumVod($cvno);
        //echo "<pre>";print_r($vod);  echo "</pre>";
        palyerVod($vod);
        echo '</div>';
        
    }
    if ($cvno) {
        echo "<div id='playlistall' style='background-color:#EED;float:left;max-width:470px;width:100%;padding:5px'> ";
    }
    for ($i = 0; $i < count($curr); $i++)    {
        echo "<h2>커리큘럼 제목 : ".$curr[$i]['cc_name']."</h2>";
        if ($curr[$i]['cc_img_pc'])   {
            if (file_exists($G5_PATH.$curr[$i]['cc_img_pc'])){
                echo "<div id='currVod".$i."'>";
                echo "<img src='".$curr[$i]['cc_img_pc']."' />";
                echo "</div>";
            }
        }
        echo "<div id='vodlist_".$i."' style='background-color: #FFE;width:100%;border:1px solid #333;padding:5px;'>";
        $vodlist = getCurriculumVodList($curr[$i]['cc_id']);
        $lens = count($vodlist);
        for ($j = 0; $j < $lens; $j++){
            $idx = ($j+1);
            echo "<div class='lecvod' id='lecvod_".$j."' style='clear:both;";
            if ($cvno && $cvno == $vodlist[$j]['cv_no']) 
                echo "background-color:#AAA;";
            else
                echo "background-color: #FFE;";
            echo "width:100%;border:1px solid #333;padding:5px;height:30px;' >";
            echo "<div id='vodid".$idx."' style='padding-left:5px;padding-right:5px;width:30px;position:relative;float:left'>".$idx."</div>";
            echo "<div id='vodtitle".$idx."'  style='padding-left:5px;padding-right:5px;max-width:300px;width:100%;position:relative;float:left;border:0px solid #333;'>".mb_strcut($vodlist[$j]['cv_title'],0,50)."</div>";
            $playon = false;
            // 유료회원여부 확인후 
            // 결제 처리한 사람이면 볼수있도록 동영상 링크 생성 
            // $palyon 여부값 추가 

            if ($vodlist[$j]['cv_type'] == '0') {
                $playon = true;
            }
            echo "<div id='play".$idx."'  style='padding-left:5px;padding-right:5px;;position:relative;float:left;width:70px;border:0px solid #444;'>";
            if ($playon){
                if ($target=="popplayer")
                    echo "<a href='#' onclick=\"popPlayer('{$curr[$i]['it_id']}',{$vodlist[$j]['cv_no']});\" >[보기]</a>";
                else
                    echo "<a href='#' onclick=\"onPlayer('{$curr[$i]['it_id']}',{$vodlist[$j]['cv_no']},'_self');\" >[보기]</a>";

            }
            else {
                echo "[유료]";
            }       
            echo "</div>";
            echo "</div>";

        }
        echo "</div>";

    }

    $str = "<script>
    function popPlayer(it,no) {
        var pop = window.open('/main/popvod.php?it='+it+'&cvno='+no,'popplayer','scrollbars=no,width=1440,height=700,top=100,left=150');
    }
    function onPlayer(it,no) {
        location.href='/main/popvod.php?it='+it+'&cvno='+no;
    }

    </script>
    ";
    if ($cvno)
        echo "</div></div>";
    echo $str;

    
}


function palyerVod($vod) {
    global $g5;
    //print_r($vod);
    //if(array_filter($vod['mv_url'])) { ?>
        <!-- 관련링크 시작 { -->
        <div id="vod_v_link">
            <h2><?php echo $vod['cv_title'];?></h2>
            <ul>
            <!-- 동영상이 있다면 동영상 추출하여 화면 띄우기 -->
            <?php
            // 링크
            $cnt = 0;
            // 동영상 재생 사이즈 설정
//            $movie_width = "728";
//            $movie_height = "413";
            $movie_width = "800";
            $movie_height = "550";

            // 섬네일 사이즈 설정
            $thumb_width = "160";
            $thumb_height = "90";
            //$lengs = count($vod['mv_url']);
            //for ($i=1; $i<=$lengs; $i++) {

                if($vod['cv_url']) {
                    $cnt++;
                    $link = cut_str($vod['cv_url'], 70);
                    $videoId = "";
                    $co_media = "";
                    if(preg_match("/youtu/", $vod['cv_url'])) {
                        $videoId = get_youtubeid($vod['cv_url']);
                        $co_media = "<iframe width='$movie_width' height='$movie_height' src='//www.youtube.com/embed/$videoId' frameborder='0' allowfullscreen></iframe>";
                    }
                    else if(preg_match("/vimeo/", $vod['cv_url'])) {
                        $co_media = "<div class='videoWrapper'>";
                        //$videoId = get_vimeoid($vod['cv_url'][$i]);
                        $videoId = $vod['cv_url'];

                        $co_media .= '<iframe src="https://player.vimeo.com/video/286767593" width="800" height="550" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
                        $co_media .= '<p><a href="'.$videoId.'"></a>';
                        $co_media .="</div>";
                    }
                    if ($co_media)  {
                        echo $co_media;
                        //echo "media : ".$videoId."[end]";
                        echo "<br />";
                    }

                ?>
                <!--
                <li>
                    <i class="fa fa-link" aria-hidden="true"></i> <a href="<?php echo $vod['link_href'][$i] ?>" target="_blank">
                        
                        <strong><?php echo $link ?></strong>
                    </a>
                    <span class="bo_v_link_cnt"><?php echo $vod['link_hit'][$i] ?>회 연결</span>
                </li>-->
                <?php
                }
            //}
            ?>
            </ul>
        </div>

    <?php
    //}
}

function mysql_data_seek( $r, $n){
        if( is_object( $r)) return $r->data_seek( $n);
        else return 0;
}

function printCaName($ca_id) {
    global $g5;
    $ca = sql_fetch("select ca_name from g5_shop_category where ca_id = '{$ca_id}'");
    return $ca['ca_name'];
}

function getResultCaList($ca_id) {
    global $g5;
    $casize = strlen($ca_id);
    $casub = ($casize>2)?substr($ca_id,0,2):$ca_id;
    $sqlc = "select * from g5_shop_category where ca_id like '{$casub}%' and ca_use = '1'";
    $resultc = sql_query($sqlc);
    return $resultc;
}


function getCaNameOfOdid($od_id) {
    global $g5;
    if (!$od_id) return '';
    $sql = " select 
                c.ca_name
            from g5_shop_cart a, g5_shop_item b, g5_shop_category c
            where a.od_id = '{$od_id}'
                and a.it_id = b.it_id
                and c.ca_id = if (b.ca_id2 <> '', b.ca_id2, b.ca_id)
            ";
    $rtn = sql_fetch($sql);
    return $rtn['ca_name'];
}

function getCaNameOfItid($it_id) {
    global $g5;
    if (!$it_id) return '';
    $sql = " select 
                c.ca_name
            from g5_shop_item b, g5_shop_category c
            where b.it_id = '{$it_id}'
                and c.ca_id = if (b.ca_id2 <> '', b.ca_id2, b.ca_id)
            ";
    $rtn = sql_fetch($sql);
    return $rtn['ca_name'];
}

function getItemInfoOfOdid($od_id) {
    global $g5;
    if (!$od_id) return '';
    $sql = " select 
                b.*
            from g5_shop_cart a, g5_shop_item b
            where a.od_id = '{$od_id}'
                and a.it_id = b.it_id
            ";
    $rtn = sql_fetch($sql);
    return $rtn;
}


function getOrderInfoOfOdid($od_id) {
    global $g5;
    if (!$od_id) return '';
    $sql = "select 
                *
            from g5_shop_order 
            where od_id = '{$od_id}'
            ";
    $rtn = sql_fetch($sql);
    return $rtn;
}


function getCaidOfItem($it_id) {
    global $g5;
    if (!$it_id)
        return;
    $sql = "select if (length(ca_id)!=2, substr(ca_id,1,2), ca_id) caid 
            from {$g5['g5_shop_item_table']} 
            where it_id = '{$it_id}' ";
    //echo $sql."<BR>";
    $item = sql_fetch($sql);
    return $item['caid'];
}

// 상품리스트에서 옵션항목
function get_list_options($it_id, $subject, $no, $frm)
{
    global $g5;

    if(!$it_id || !$subject)
        return '';

    $sql = " select * from {$g5['g5_shop_item_option_table']} where io_type = '0' and it_id = '$it_id' and io_use = '1' order by io_no asc ";
    $result = sql_query($sql);
    if(!sql_num_rows($result))
        return '';

    $str = '';
    $subj = explode(',', $subject);

    $subj_count = count($subj);

    if($subj_count > 1) {
        $options = array();

        // 옵션항목 배열에 저장
        for($i=0; $row=sql_fetch_array($result); $i++) {
            $opt_id = explode(chr(30), $row['io_id']);

            for($k=0; $k<$subj_count; $k++) {
                if(!is_array($options[$k]))
                    $options[$k] = array();

                if($opt_id[$k] && !in_array($opt_id[$k], $options[$k]))
                    $options[$k][] = $opt_id[$k];
            }
        }

        // 옵션선택목록 만들기
        for($i=0; $i<$subj_count; $i++) {
            $opt = $options[$i];
            $opt_count = count($opt);
            $disabled = '';
            if($opt_count) {
                $seq = $no.'_'.($i + 1);
                if($i > 0)
                    $disabled = ' disabled="disabled"';
                //$str .= '<div>'.PHP_EOL;
                $str .= '<label for="'.$frm.'_it_option_['.$it_id."_".$seq.']">'.$subj[$i].'</label>'.PHP_EOL;

                $select = '<select id="'.$frm.'_it_option_['.$it_id."_".$seq.']" class="it_options"'.$disabled.'>'.PHP_EOL;
                $select .= '<option value="">선택</option>'.PHP_EOL;
                for($k=0; $k<$opt_count; $k++) {
                    $opt_val = $opt[$k];
                    if(strlen($opt_val)) {
                        $select .= '<option value="'.$opt_val.'">'.$opt_val.'</option>'.PHP_EOL;
                    }
                }
                $select .= '</select>'.PHP_EOL;

                $str .= '<span class="option">'.$select.'</span>'.PHP_EOL;
                //$str .= '</div>'.PHP_EOL;
            }
        }
    } else {
        //$str .= '<div>'.PHP_EOL;
        $str .= '<label for="'.$frm.'_it_option_['.$it_id.'_1]">'.$subj[0].'</label>'.PHP_EOL;

        $select = '<select id="'.$frm.'_it_option_['.$it_id.'_1]" class="it_options select" onchange="changeOption(\''.$frm.'\',this, '.$it_id.');">'.PHP_EOL;
        $select .= '<option value="">선택</option>'.PHP_EOL;
        for($i=0; $row=sql_fetch_array($result); $i++) {
            if($row['io_price'] >= 0)
                $price = '&nbsp;&nbsp;+ '.number_format($row['io_price']).'원';
            else
                $price = '&nbsp;&nbsp; '.number_format($row['io_price']).'원';

            if(!$row['io_stock_qty'])
                $soldout = '&nbsp;&nbsp;[품절]';
            else
                $soldout = '';

            $select .= '<option value="'.$row['io_id'].','.$row['io_price'].','.$row['io_stock_qty'].'">'.$row['io_id'].$price.$soldout.'</option>'.PHP_EOL;
        }
        $select .= '</select>'.PHP_EOL;

        $str .= '<span class="option">'.$select.'</span>'.PHP_EOL;
        //$str .= '</div>'.PHP_EOL;
    }

    return $str;
}

$varList = array();

function setVarList($arr, $name){
    global $varlist;
    $cnt = 0;

    //var_dump($arr);
    //echo "name : ".$name;
    if (isset($varlist) && is_array($varlist))  {
        $cnt = count($varlist);
    }
    else  {
        $varlist = array();
    }
    $varlist[$name] = array();
    $varlist[$name] = $arr;
}


function getVarList() {
    global $varlist;
    //$str = "<pre>";
    foreach($varlist as $key => $val) {

        if (is_array($val)) {
            foreach($val as $key1 => $val1) {
                if (is_array($val1)){
                    foreach($val1 as $key2 => $val2) {
                        if (is_array($val2)){
                            foreach($val2 as $key3 => $val3) {
                                if (is_array($val3)){
                                    foreach($val3 as $key4 => $val4) {
                                        if (is_array($val4)){
                                            $str .= " $".$key."['".$key1."']['".$key2."']['".$key3."']['".$key4."']     =  ".$val4."<br>";
                                        }
                                        else {

                                            if ($val4)  {
                                                if (is_string($key1))
                                                $str .= " $".$key."['".$key1."']['".$key2."']['".$key3."']['".$key4."']     =  ".$val4."<br>";
                                                else{
                                                    if (is_string($key3))
                                                    $str .= " $".$key."[".$key1."]['".$key2."']['".$key3."'']['".$key4."']     =  ".$val4."<br>";
                                                    else
                                                    $str .= " $".$key."[".$key1."]['".$key2."'][".$key3."]['".$key4."']     =  ".$val4."<br>";
                                                    
                                                }
                                            }
                                        }
                                    }
                                }
                                else {

                                    if ($val3)  {
                                        if (is_string($key1))
                                        $str .= " $".$key."['".$key1."']['".$key2."']['".$key3."']     =  ".$val3."<br>";
                                        else
                                        $str .= " $".$key."[".$key1."]['".$key2."']['".$key3."']     =  ".$val3."<br>";
                                    }
                                }
                            }
                        }
                        else {

                            if ($val2)  {
                                if (is_string($key1))
                                $str .= " $".$key."['".$key1."']['".$key2."']     =  ".$val2."<br>";
                                else
                                $str .= " $".$key."[".$key1."]['".$key2."']     =  ".$val2."<br>";

                            }
                        }
                    }        
                }
                else {
                    if ($val1)  {
                        $str .= " $".$key."['".$key1."']     =  ".$val1."<br>";
                    }
                }
            }
        }
        else {
            $str .= " $".key." : ".$val."<BR>";
        }
    }
    //$str .= "</pre>";
    echo $str;
}


function getTypeItid($it_id) {
    global $g5;
    $sql = "select 
                if (substr(b.ca_id, 1, 2) = '10' or substr(b.ca_id2, 1,2) = 10, '강의','도서') type
            from g5_shop_item b
            where b.it_id = '{$it_id}'
            ";
    $rtn = sql_fetch($sql);
    return $rtn['type'];
}

function getTypeOdid($od_id) {
    global $g5;
    if (!$od_id) return '';
    $sql = " select 
                if (substr(b.ca_id, 1, 2) = '10' or substr(b.ca_id2, 1,2) = 10, '강의','도서') type
            from g5_shop_cart a, g5_shop_item b
            where a.od_id = '{$od_id}'
                and a.it_id = b.it_id
            ";
    $rtn = sql_fetch($sql);
    return $rtn['type'];
}


function getEndDtLec($od_id, $ct_id, $ct_status) {
    global $g5;

    if ($ct_status != "완료") return '';
    $sqlo = "select a.*, b.it_origin, 
                 if (substr(b.ca_id, 1, 2) = '10' or substr(b.ca_id2, 1,2) = 10, '강의','도서') type 
                 from {$g5['g5_shop_cart_table']} a, {$g5['g5_shop_item_table']} b
                 where a.od_id = '{$od_id}'
                 and a.ct_id  = '{$ct_id}'
                 and a.it_id = b.it_id ";
    $resulto = sql_query($sqlo);
    while($rowo = sql_fetch_array($resulto)) {
        if ($rowo['type'] == '강의') {
            $days = $rowo['it_origin'];
            if ($days) {
                $days = intval($days);
                $sql = " select DATE_FORMAT(curdate(), '%Y-%m-%d') sdate, DATE_FORMAT(date_add(curdate(), interval {$days} day), '%Y-%m-%d') edate ";
                $r = sql_fetch($sql);
                $addupdate = " , start_date = '{$r['sdate']}' , end_date = '{$r['edate']}' ";
            }
        }
    }



    return $addupdate;
}



function setEndDtLec($od_id, $ct_id, $ct_status) {
    global $g5;

    if ($ct_status != "완료") return '';

    $addupdate = getEndDtLec($od_id, $ct_id, $ct_status);

    if ($addupdate != "")   {
        $sql = " update {$g5['g5_shop_cart_table']}
                    set ct_status     = '$ct_status'
                        {$addupdate}
                    where od_id = '$od_id'
                    and ct_id  = '$ct_id' ";
        //echo $sql."<BR>";
        sql_query($sql);
        //alert($sql);
    }
    return 1;

}


function convertPhone($numbers,$names) {
    global $g5;
    $str = "";
    $hp = explode("-", $numbers);
    $hp1 = array("010","011","013","016","017","018","019","050","070","02","031","032","033"
            ,"034","040","041","042","050","051","052","053", "061", "062");
    foreach($hp1 as $key => $val) {
        $str .= "<option value='".$val."' ";
        if ($hp[0] == $val) $str.= " checked ";
        $str .= ">".$val."</option>";
    }
    $prt = "<input type=\"hidden\" name=\"".$names."\" value=\"".$numbers."\" id=\"".$names."\" class=\"frm_input\" >";
    $prt .= "<select name=\"".$names."1\" id=\"".$names."1\" class=\"sel_wid01\" onchange=\"joinVal".$names."('".$names."');\">";
    $prt .= $str."</select>";
    $prt .= " <i class=\"ns\">-</i> ";
    $prt .= "<input type=\"text\" name=\"".$names."2\" id=\"".$names."2\" value=\"".$hp[1]."\" class=\"frm_input input_wid01\" placeholder=\"\"  onchange=\"joinVal".$names."('".$names."');\" maxlength='4'>";
    $prt .= "<i class=\"ns\">-</i> ";
    $prt .= "<input type=\"text\" name=\"".$names."3\" id=\"".$names."3\" value=\"".$hp[2]."\" class=\"frm_input input_wid01\" placeholder=\"\"  onchange=\"joinVal".$names."('".$names."');\" maxlength='4'>";
    $scripts = "<script>
                    function joinVal".$names."(name){
                        var n1 = $(\"#\"+name+\"1\").val();
                        var n2 = $(\"#\"+name+\"2\").val();
                        var n3 = $(\"#\"+name+\"3\").val();
                        var n = n1+\"-\"+n2+\"-\"+n3;
                        $(\"#\"+name).val(n);
                    }
                </script>";
    echo $prt;
    echo $scripts;
}

function setGoodData($bo_table, $wr_id, $mb_id, $type = 1) {
    global $g5;
    if (!$bo_table || !$wr_id || !$mb_id){
        return 0;
    }
    $sql_add = " ";
    if ($type == 1) $sql_add .= " good = '1' ";
    else $sql_add .= " nogood = '1' ";

    $sql = "select count(*) cnt from g5_good_data
            where bo_table = '{$bo_table}'
            and wr_id = '{$wr_id}'
            and mb_id = '{$mb_id}'
            and ".$sql_add;
    $chk = sql_fetch($sql);
    if ($chk['cnt'] > 0){
        return 2;
    }
    $sql2 = " insert g5_good_data set ";
    $sql2 .= " bo_table = '{$bo_table}' 
               , wr_id = '{$wr_id}'
               , mb_id = '{$mb_id}'
               , {$sql_add}
               , regdate = now() ";
    sql_query($sql2);
    return 1;    
}


function setGoodIsuse($is_id, $mb_id, $type = 1) {
    global $g5;
    if (!$is_id || !$mb_id){
        return 0;
    }
    $sql_add = " ";
    if ($type == 1) $sql_add .= " good = '1' ";
    else $sql_add .= " nogood = '1' ";

    $sql = "select count(*) cnt from g5_good_data
            where is_id = '{$is_id}'
            and mb_id = '{$mb_id}'
            and ".$sql_add;
    //echo $sql."<BR>";
    $chk = sql_fetch($sql);
    if ($chk['cnt'] > 0){
        return 2;
    }
    $sql2 = " insert g5_good_data set ";
    $sql2 .= " is_id = '{$is_id}' 
               , mb_id = '{$mb_id}'
               , {$sql_add}
               , regdate = now() ";
    sql_query($sql2);

    $sql3 = "update g5_shop_item_use 
            set likes = (select count(*) from g5_good_data where is_id = '{$is_id}' and good='1')
            where is_id = '{$is_id}'";
    sql_query($sql3);
    return 1;    
}

function getGoodData($bo_table, $wr_id, $type = 1) {
    global $g5;
    if (!$bo_table || !$wr_id ){
        alert("정상적으로 접근(시도)하세요!");
        return false;
    }
    $sql_add = " ";
    if ($type == 1) $sql_add .= " good = '1' ";
    else $sql_add .= " nogood = '1' ";

    $sql = "select count(*) cnt from g5_good_data
            where bo_table = '{$bo_table}'
            and wr_id = '{$wr_id}'
            and ".$sql_add;
    $chk = sql_fetch($sql);

    return $chk['cnt'];    
}


function getItemUseCount($it_id) {
    global $g5;
    if (!$it_id ){
        alert("정상적으로 접근(시도)하세요!");
        return false;
    }
    
    $sql = "select count(*) cnt from g5_shop_item_use
            where it_id = '{$it_id}'
            ";
    $chk = sql_fetch($sql);

    return $chk['cnt'];    
}

function getGoodIsuse($is_id, $type = 1) {
    global $g5;
    if (!$is_id ){
        alert("정상적으로 접근(시도)하세요!");
        return false;
    }
    $sql_add = " ";
    if ($type == 1) $sql_add .= " good = '1' ";
    else $sql_add .= " nogood = '1' ";

    $sql = "select count(*) cnt from g5_good_data
            where is_id = '{$is_id}'
            and ".$sql_add;
    $chk = sql_fetch($sql);

    return $chk['cnt'];    
}

function chkEventAble($bo_table, $wr_id) {
    global $g5;
    if (!$bo_table || !$wr_id ){
        alert("정상적으로 접근(시도)하세요!");
        return false;
    }
    $write_table ='g5_write_'.$bo_table;
    $sql_add = " ";
    $sql = "select count(*) cnt from {$write_table}
            where wr_id = '{$wr_id}'
            and curdate() between wr_9 and wr_10";
    //echo $sql."<BR>";
    $chk = sql_fetch($sql);

    return $chk['cnt'];
}


function getItemofOrid($od_id) {
    global $g5;
    if (!$od_id ){
        alert("정상적으로 접근(시도)하세요!");
        return false;
    }
    $sql = "select 
                c.it_name, 
                c.it_id, 
                b.start_date, 
                b.end_date, 
                a.* 
            from g5_shop_order a
            left join g5_shop_cart b on (a.od_id = b.od_id)
            left join g5_shop_item c on (b.it_id = c.it_id)
            where a.od_id = '{$od_id}'
            ";
    $oditem = sql_fetch($sql);

    return $oditem;
}


function getItemofitid($it_id) {
    global $g5;
    if (!$it_id ){
        alert("정상적으로 접근(시도)하세요!");
        return false;
    }
    $sql = "select 
                a.* 
            from g5_shop_item a
            where a.it_id = '{$it_id}'
            ";
    $item = sql_fetch($sql);

    return $item;
}

function getHowSerialUseIt($it_id, $is_id) {
    global $g5;

    $sql = "select * from g5_shop_item_use 
            where it_id = '{$it_id}' 
            order by is_id asc ";
    $result = sql_query($sql);
    for ($i=1; $row = sql_fetch_array($result); $i++){
        if ($row['is_id'] == $is_id)
            break;
    }
    return $i;
}


function getWishedCheck($it_id, $mb_id) {
    global $g5;

    $sql = "select count(*) cnt from g5_shop_wish 
            where it_id = '{$it_id}' and mb_id = '{$mb_id}'";
    $chk = sql_fetch($sql);
    return ($chk['cnt'])?true:false;
}