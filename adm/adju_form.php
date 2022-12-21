<?php
$sub_menu = "750200";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'w');
$no = $_GET['no'];
if ($w == '')
{
    $required_mb_id = 'required';
    $required_mb_id_class = 'required alnum_';
    $required_mb_password = 'required';
    $sound_only = '<strong class="sound_only">필수</strong>';

    $html_title = '추가';
}
else if ($w == 'u')
{
    $sql = "select * from {$g5['adju_basic_table']} where no = '{$no}'";
    //echo $sql."<BR>";
    $mb = sql_fetch($sql);

    $required_mb_id = 'readonly';
    $required_mb_password = '';
    $html_title = '수정';

    $mb['adju_ym'] = get_text($mb['adju_ym']);
    $mb['album_no'] = get_text($mb['album_no']);
    $mb['sale_quantity'] = get_text($mb['sale_quantity']);
    $mb['cd_price'] = get_text($mb['cd_price']);
    $mb['bep'] = get_text($mb['bep']);
    $mb['royalty_rate'] = get_text($mb['royalty_rate']);
    $mb['physical_rate'] = get_text($mb['physical_rate']);
    $mb['china_royalty'] = get_text($mb['china_royalty']);
    $mb['admin_adju'] = get_text($mb['admin_adju']);
}
else {
    alert('제대로 된 값이 넘어오지 않았습니다.');
}



$g5['title'] .= "";
$g5['title'] .= '정산등록 '.$html_title;
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
.adju_item {text-align:right;padding-right:10px}
</style>
<form name="fmember" id="fmember" action="./adju_form_update.php" onsubmit="return fmember_submit(this);" method="post" enctype="multipart/form-data"  autocomplete="off">
<input type="hidden" name="w" value="<?php echo $w ?>">
<input type="hidden" name="sfl" value="<?php echo $sfl ?>">
<input type="hidden" name="stx" value="<?php echo $stx ?>">
<input type="hidden" name="sst" value="<?php echo $sst ?>">
<input type="hidden" name="sod" value="<?php echo $sod ?>">
<input type="hidden" name="page" value="<?php echo $page ?>">
<input type="hidden" name="token" value="">

<div class="tbl_frm01 tbl_wrap">
    <table>
    <caption><?php echo $g5['title']; ?></caption>
    <colgroup>
        <col class="grid_4">
        <col>
    </colgroup>
    <tbody>
    <tr>
        <th scope="row"><label for="adju_ym">정산월</label></th>
        <td><input type="month" name="adju_ym" value="<?php echo $mb['adju_ym'] ?>" id="adju_ym" readonly class=" frm_input " size="25" maxlength="20">
        </td>

    </tr>
    <tr>
        <th scope="row"><label for="album_no">앨범명(제작사)<?php echo $sound_only ?></label></th>
        <td>
            <input type="hidden" name="no" id="no" value="<?php echo $mb['no'];?>">
            <input type="hidden" name="album_no" id="album_no" value="<?php echo $mb['album_no'];?>">
            <select name="album_name" id="album_name" >
                <option value=''>--앨범선택--</option>
            <?php 
            $msql = "select * 
                     from deb_album a 
                     order by album_name asc ";
            $mresult = sql_query($msql);
            while ($row = sql_fetch_array($mresult)) {?>
                <option <?php if ($row['no'] == $mb['album_no']) { ?>selected <?php } ?>
                        value="<?php echo $row['no']."|".$row['cd_price']."|".$row['bep']."|".$row['royalty_rate'];?>"
                    >
                    <?php echo $row['album_name'];?>
                    </option>
            <?php } ?>
            </select>
        </td>
    </tr>
    <tr>
        <th scope="row"><label for="sale_quantity">매출수량</label></th>
        <td><input type="text" name="sale_quantity" value="<?php echo $mb['sale_quantity'] ?>" id="sale_quantity"  class=" frm_input adju_item" size="15" maxlength="20"></td>
    </tr>
    <tr>
        <th scope="row"><label for="cd_price">CD 출고가</label></th>
        <td><input type="text" name="cd_price" value="<?php echo $mb['cd_price'] ?>" id="cd_price"  readonly class=" frm_input readonly adju_item" size="15" maxlength="20">원</td>
    </tr>
    <tr>
        <th scope="row"><label for="bep">BEP</label></th>
        <td><input type="text" name="bep" value="<?php echo $mb['bep'] ?>" id="bep"  readonly class=" frm_input readonly adju_item" size="15" maxlength="20" placeholder="-"
            >원</td>
    </tr>
    <tr>
        <th scope="row"><label for="royalty_rate">정산 요율</label></th>
        <td><input type="text" name="royalty_rate" value="<?php echo $mb['royalty_rate'] ?>" id="royalty_rate"  readonly class=" frm_input readonly adju_item" size="15" maxlength="20">%</td>
    </tr>
    <tr>
        <th scope="row"><label for="physical_rate">피지컬 요율</label></th>
        <td><input type="text" name="physical_rate" value="<?php echo $mb['physical_rate'] ?>" id="physical_rate"  class=" frm_input adju_item" size="15" maxlength="20">%</td>
    </tr>
    <tr>
        <th scope="row"><label for="china_royalty">중국 로열티</label></th>
        <td><input type="text" name="china_royalty" value="<?php echo $mb['china_royalty'] ?>" id="china_royalty"  class=" frm_input adju_item" size="15" maxlength="20">원</td>
    </tr>
    <tr>
        <th scope="row"><label for="admin_adju">관리자 기본정산용</label></th>
        <td><input type="text" name="admin_adju" value="<?php echo $mb['admin_adju'] ?>" id="admin_adju"  class=" frm_input adju_item" size="15" maxlength="20">%</td>
    </tr>
    <tr>
        <th scope="row"><label for="excelfile">엑셀파일 업로드</label></th>
        <td> <input type="file" name="excelfile" id="excelfile" class="btn"> <a href="/data/adju_sample_data.xls" class="btn" >샘플파일</a></td>
    </tr>
    <?php
    $sqls = "select count(*) cnt from {$g5['adju_data_table']} a where a.adju_basic_no = '{$no}' ";
    //echo $sqls."<BR>";
    $chk = sql_fetch($sqls);
    if ($chk['cnt']) {
    $sqls = "select * from {$g5['adju_data_table']} a where a.adju_basic_no = '{$no}' ";
    $results = sql_query($sqls);
    ?>
    <tr>
        <td colspan="2">
            <h4>업로드된 엑셀 내용</h4>
            <div>
            <input type="checkbox" value="1" name="uploaded_del" >업로드데이타 전체삭제
        </div>
            <table >
                <?php 
                $exstr = "adju_basic_no, mb_id, regdate";
                $valtitle = array(
                            'no' => '번호'
                            , 'adju_ym'=>'정산월'
                            , 'nation'=>'국내/해외'
                            , 'song_code'=>'곡코드'
                            , 'song_name'=>'곡'
                            , 'singer'=>'회원명(가창자)'
                            , 'album_company'=>'앨범(제작사)'
                            , 'service_type'=>'서비스구분'
                            , 'album_code'=>'앨범코드'
                            , 'sale_amount'=>'판매금액'
                            , 'digital_royalty'=>'디지탈로열티'
                            );
                for ($i=0; $rows = sql_fetch_array($results);$i++) {
                    if ($i == 0) {
                    ?>
                <tr>
                    <?php 
                    foreach($rows as $key => $val) {
                        if (strrpos($exstr, $key)=== false) {
                        ?>
                    <th>
                        <?php
                         echo $valtitle[$key]; ?>
                    </th>
                    <?php 
                        }
                    } 
                    ?>

                </tr>
                <?php
                    }

                    ?>
                <tr>
                <?php 
                    foreach($rows as $key => $val) {
                        if (strrpos($exstr, $key)=== false) {

                        ?>
                    <td>
                        <?php echo $val;?>
                    </td>
                    <?php 
                        }
                    } ?>
                </tr>
                    <?php
                }
                ?>

            </table>

        </th>
    </tr>
    <?php 

    } ?>

  
    
    </tbody>
    </table>
</div>

<div class="btn_fixed_top">
    <a href="./adju_list.php?<?php echo $qstr ?>" class="btn btn_02">목록</a>
    <input type="submit" value="정산등록 저장" class="btn_submit btn" accesskey='s'>
</div>
</form>

<script>
$(function() {
    
    $('#adju_ym').MonthPicker({ 
        Button: false,
        MonthFormat: 'M,yy', // Short month name, Full year.
        //adju_ym
    });

    $('#adju_ym').click(function() {
//        alert($('#adju_ym').val());

    });
    $("#album_name").change(function() {
        var a = $("#album_name option:selected").val();
        var album = a.split("|");
        var str = "";
        album.forEach(function(val)  {
            str += "val : "+val+"\n";
        });
        $("#album_no").val(album[0]);
        $("#cd_price").val(album[1]);
        $("#bep").val(album[2]);
        $("#royalty_rate").val(album[3]);

        //alert(str);
    });
});



function fmember_submit(f)
{

    return true;
}
</script>

<?php
include_once('./admin.tail.php');
?>
