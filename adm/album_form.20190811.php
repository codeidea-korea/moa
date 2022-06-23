<?php
$sub_menu = "750000";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'w');
$no = $_GET['no'];

$songdata = array("1"=>"flac88"
                , "2"=>"flac176"
                , "3"=>"flac256"
                , "4"=>"dsd64"
                , "5"=>"dsd128"
                , "6"=>"dsd256"
            );
$songprice = array("1"=>"3500"
                , "2"=>"4500"
                , "3"=>"5500"
                , "4"=>"6500"
                , "5"=>"7800"
                , "6"=>"9000"
            );
$albumprice = array("1"=>"100000"
                , "2"=>"120000"
                , "3"=>"130000"
                , "4"=>"115000"
                , "5"=>"125000"
                , "6"=>"150000"
            );
$limits = count($songdata);

if ($w == '')
{
    $sound_only = '<strong class="sound_only">필수</strong>';

    $html_title = '추가';
}
else if ($w == 'u')
{
    $sql = "select * from {$g5['album_table']} where no = '{$no}'";
    //echo $sql."<BR>";
    $album = sql_fetch($sql);

    $required_mb_id = 'readonly';
    $required_mb_password = '';
    $html_title = '수정';

    $album['catalog_num'] = get_text($album['catalog_num']);
    $album['album_name'] = get_text($album['album_name']);
    $album['album_content'] = get_text($album['album_content']);
}
else {
    alert('제대로 된 값이 넘어오지 않았습니다.');
}



$g5['title'] .= "";
$g5['title'] .= '앨범등록 '.$html_title;
include_once('./admin.head.php');

// add_javascript('js 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_javascript(G5_POSTCODE_JS, 0);    //다음 주소 js
?>
    <script src="https://cdn.rawgit.com/digitalBush/jquery.maskedinput/1.4.1/dist/jquery.maskedinput.min.js"></script>
    <link href="https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css" rel="stylesheet" type="text/css" />    
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>

    <link href="/css/MonthPicker.css" rel="stylesheet" type="text/css" />
    <script src="/js/MonthPicker.js"></script>
<style>

.icon {
    vertical-align: bottom;
    margin-top: 2px;
    margin-bottom: 3px;
    cursor: pointer;
}

.icon:active {
    opacity: .5;
}

.ui-button-text {
    padding: .4em .6em;
    line-height: 0.8;
}

.month-year-input {
  width: 60px;
  margin-right: 2px;
}

.readonly {
    border:0px;
    background-color: #FEFEFE;
}
.album_item {text-align:right;padding-right:10px}
</style>
<script>

</script>   
<form name="falbum" id="falbum" action="./album_form_update.php" onsubmit="return falbum_submit(this);" method="post" enctype="multipart/form-data"  autocomplete="off">
    <input type="hidden" name="act" value="album">
    <input type="hidden" name="w" value="<?php echo $w ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="sst" value="<?php echo $sst ?>">
    <input type="hidden" name="sod" value="<?php echo $sod ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">
    <input type="hidden" name="token" value="">
    <input type="hidden" name="no" id="no" value="<?php echo $album['no'];?>">

<div class="tbl_frm01 tbl_wrap">
    <table>
    <caption><?php echo $g5['title']; ?></caption>
    <colgroup>
        <col class="grid_4">
        <col>
    </colgroup>
    <tbody>
    <tr>
        <th scope="row"><label for="catalog_num">카타록 No</label></th>
        <td><input type="text" name="catalog_num" value="<?php echo $album['catalog_num'] ?>" id="catalog_num"  class=" frm_input " size="20" maxlength="20">
        </td>

    </tr>
    <tr>
        <th scope="row"><label for="artist_name">아티스트명<?php echo $sound_only ?></label></th>
        <td>
            <input type="text" name="artist_name" id="artist_name" value="<?php echo $album['artist_name'];?>"  class=" frm_input " size="120" >
        </td>
    </tr>
    <tr>
        <th scope="row"><label for="album_name">앨범제목<?php echo $sound_only ?></label></th>
        <td>
            <input type="text" name="album_name" id="album_name" value="<?php echo $album['album_name'];?>"  class=" frm_input " size="120" >
        </td>
    </tr>
    <tr>
        <th scope="row"><label for="genre">장르<?php echo $sound_only ?></label></th>
        <td>
            <input type="text" name="genre" id="genre" value="<?php echo $album['genre'];?>"  class=" frm_input " size="50" >
        </td>
    </tr>
    <tr>
        <th scope="row"><label for="price">앨범 가격<?php echo $sound_only ?></label></th>
        <td>
            <input type="text" name="price" id="price" value="<?php echo ($album['price'])?$album['price']:$albumprice[1];?>"  class=" frm_input album_item" size="30" >원

        </td>
    </tr>
    <tr>
        <th scope="row"><label for="album_content">앨범설명<?php echo $sound_only ?></label></th>
        <td>
            <textarea name="album_content" id="album_content" class=" frm_input "><?php echo $album['album_content'];?></textarea>
        </td>
    </tr>
    <tr>
        <th>음원별 가격 </th>
        <td>
            <table >
                <tr>
                    <th>음원</th>
                    <th>
                        적용여부
                    </th>
                    <th>앨범 음원별 가격</th>
                    <th>곡 음원별 가격</th>
                </tr>
            <?php 
           
            for ($i=1; $i <=$limits;$i++) {?>
            <tr>
                <th scope="row"><label for="<?php echo $songdata[$i];?>"><?php echo $songdata[$i];?></label></th>
                <td>
                    <input type="checkbox" name="<?php echo $songdata[$i];?>" id="<?php echo $songdata[$i];?>" value="1" class=" frm_input album_item" size="1" 
                    <?php if ($album[$songdata[$i]]) { echo " checked ";} ?> >
                </td>
                <td>
                    <input type="text" name="price_<?php echo $songdata[$i];?>" id="price_<?php echo $songdata[$i];?>" 
                        value="<?php 
                        if ($album["price_".$songdata[$i]]) {
                            echo $album["price_".$songdata[$i]];
                        } else { 
                            echo $albumprice[$i];
                        }
                        ?>"  class=" frm_input album_item" size="15" maxlength="20">
                </td>
                <td>
                    <input type="text" name="<?php echo $songdata[$i];?>_price" id="<?php echo $songdata[$i];?>_price" 
                        value="<?php 
                        if ($album[$songdata[$i]."_price"]) {
                            echo $album[$songdata[$i]."_price"];
                        } else { 
                            echo $songprice[$i];
                        }
                        ?>"  class=" frm_input album_item" size="15" maxlength="20">
                </td>
            </tr>
            <?php } ?>
            </table>
        </td>
        </tr>
    

  
    
    </tbody>
    </table>
</div>

<div class="btn_fixed_top">
    <a href="./album_list.php?<?php echo $qstr ?>" class="btn btn_02">목록</a>
    <input type="submit" value="앨범등록 저장" class="btn_submit btn" accesskey='s'>
</div>
</form>

<form name="fsong" id="fsong" action="./album_form_update.php" onsubmit="return fsong_submit(this);" method="post" enctype="multipart/form-data"  autocomplete="off">
    <input type="hidden" name="act" value="song">
    <input type="hidden" name="w" value="">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="sst" value="<?php echo $sst ?>">
    <input type="hidden" name="sod" value="<?php echo $sod ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">
    <input type="hidden" name="token" value="">
    <input type="hidden" name="album_no" id="album_no" value="<?php echo $album['no'];?>">

<div class="tbl_frm01 tbl_wrap">
    <table>
    <caption><?php echo $g5['title']; ?></caption>
    <colgroup>
        <col >
        <col >
        <col >
        <col >
        <col >
        <col >
        <col >
    </colgroup>
    <tbody>
        
    <tr>
        <th scope="row"><label for="no">번호</label></th>
        <th scope="row"><label for="ord">순서</label></th>
        <th scope="row"><label for="title">곡제목</label></th>
        <th scope="row"><label for="genre">장르</label></th>
        <th scope="row"><label for="artist_name">아티스트명</label></th>
        <th scope="row"><label for="length">연주시간</label></th>
        <th scope="row"><label for="content">곡설명</label></th>
    </tr>
    <tr>
        <td><input type="hidden" name="no" id="no" value="<?php echo $song['no'];?>"></td>
        <td>
            <input type="text" name="ord" id="ord" value="<?php echo $song['ord'];?>"  class=" frm_input " size="2" >
        </td>
        <td>
            <input type="text" name="title" id="title" value="<?php echo $song['title'];?>"  class=" frm_input " size="20" >
        </td>
        <td>
            <input type="text" name="genre" id="genre" value="<?php echo $song['genre'];?>"  class=" frm_input " size="20" >
        </td>
        <td>
            <input type="text" name="artist_name" id="artist_name" value="<?php echo $song['artist_name'];?>"  class=" frm_input " size="20" >
        </td>
        <td>
            <input type="text" name="length" id="length" value="<?php echo $song['length'];?>"  class=" frm_input " size="20" >
        </td>
        <td>
            <textarea name="content" id="content" maxlength="500" sytle="width:120px;height:30px"><?php echo $song['content'];?></textarea>
        </td>
        <td>
            
        <input type="submit" value="곡 저장" class="btn_submit btn" accesskey='s'>
    
        </td>
    </tr>
    <?php 
    $sql = "select * from {$g5['album_song_table']} where album_no = '{$album['no']}' ";
    $result = sql_query($sql);
    for ($i=0; $song = sql_fetch_array($result);$i++) {
    ?>
    <tr style="cursor:pointer" 
        Onclick="mod('<?php echo $song['no'];?>','<?php echo $song['ord'];?>','<?php echo $song['title'];?>','<?php echo $song['genre'];?>','<?php echo $song['artist_name'];?>','<?php echo $song['length'];?>','<?php echo str_replace("'","`",$song['content']);?>');">
        <td>
            <?php echo $song['no'];?>
        </td>
        <td>
            <?php echo $song['ord'];?>
        </td>
        <td>
            <?php echo $song['title'];?>
        </td>
        <td>
            <?php echo $song['genre'];?>
        </td>
        <td>
            <?php echo $song['artist_name'];?>
        </td>
        <td>
            <?php echo $song['length'];?>
        </td>
        <td colspan="2">
            <?php echo str_replace("'","`",$song['content']);?>
        </td>
    </tr>
    <?php
    }
    ?>
    </tbody>
    </table>
    
</div>
</form>

<script>
    function mod (no,ord,title,genre,name,length,content) {
        var f = document.fsong;
        f.w.value="u";
        f.no.value=no;
        f.ord.value=ord;
        f.title.value=title;
        f.genre.value=genre;
        f.artist_name.value=name;
        f.length.value=length;
        f.content.value=content;
    }
    function fsong_submit(f)  {
        return true;
    }

    $(function() {
        
       
        //$.datepicker.regional['ko'] = {};
        //$.datepicker.setDefaults($.datepicker.regional['ko']);

        $('#catalog_num').click(function() {
    //        alert($('#catalog_num').val());

        });
       
    });




    function falbum_submit(f)  {
        <?php
        for ($i=1; $i<= $limits;$i++) {

            if ($songdata[$i]) { ?>
    var <?php echo $songdata[$i];?> = $("#<?php echo $songdata[$i];?>");
        if (<?php echo $songdata[$i];?>.is("checked"))
            <?php echo $songdata[$i];?>.val("1");
        <?php
            }
        }
        ?>
        return true;
    }
</script>

<?php
include_once('./admin.tail.php');
?>
