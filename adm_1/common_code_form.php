<?php
$sub_menu = "300950";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'w');
$idx = $_GET['idx'];
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
    $sql = "SELECT * from {$g5['common_code_table']} where idx = '{$idx}'
             ";
    //echo $sql."<BR>";
    $items = sql_fetch($sql);

    $required_mb_id = 'readonly';
    $required_mb_password = '';
    $html_title = '수정';

    $items['type_id'] = get_text($items['type_id']);
    $items['cd_id'] = get_text($items['cd_id']);
    $items['cd_name'] = get_text($items['cd_name']);
    $items['cd_desc'] = get_text($items['cd_desc']);
    $items['cd_order'] = get_text($items['cd_order']);
    $items['use_yn'] = get_text($items['use_yn']);
}
else {
    alert('제대로 된 값이 넘어오지 않았습니다.');
}



$g5['title'] .= "";
$g5['title'] .= '지역코드등록 '.$html_title;
include_once('./admin.head.php');

// add_javascript('js 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_javascript(G5_POSTCODE_JS, 0);    //다음 주소 js
?>
    <script src="https://cdn.rawgit.com/digitalBush/jquery.maskedinput/1.4.1/dist/jquery.maskedinput.min.js"></script>
    <link href="https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css" rel="stylesheet" type="text/css" />    
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>

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
.common_code_item {text-align:left;padding-right:10px}
</style>
<form name="fmember" id="fmember" action="./common_code_form_update.php" onsubmit="return fmember_submit(this);" method="post" enctype="multipart/form-data"  autocomplete="off">
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
        <th scope="row"><label for="maker_no">코드유형<?php echo $sound_only ?></label></th>
        <td>
            <input type="hidden" name="idx" id="idx" value="<?php echo $items['idx'];?>">
            <select name="type_id" id="type_id" required class="required frm_input">
                <option value=''>--코드유형--</option>
            <?php 
            $msql = "SELECT * 
                     from {$g5['common_type_table']} a 
                     
                     order by type_order asc, type_name asc ";
            $mresult = sql_query($msql);
            while ($row = sql_fetch_array($mresult)) {?>
                <option <?php if ($row['type_id'] == $items['type_id']) { ?>selected <?php } ?>
                        value="<?php echo $row['type_id']?>"
                    >
                    <?php echo $row['type_name'];?>
                    </option>
            <?php } ?>
            </select>
        </td>
    </tr>
    
    <tr>
        <th scope="row"><label for="cd_id">코드ID </label></th>
        <td><input type="text" name="cd_id" value="<?php echo $items['cd_id'] ?>" id="cd_id"  class="required frm_input common_code_item" size="15" maxlength="20" required></td>
    </tr>
   <tr>
        <th scope="row"><label for="cd_name">코드명 </label></th>
        <td><input type="text" name="cd_name" value="<?php echo $items['cd_name'] ?>" id="cd_name"  class="required frm_input common_code_item" size="15" maxlength="20" required></td>
    </tr>
    <tr>
        <th scope="row"><label for="cd_order">순번</label></th>
        <td><input type="text" name="cd_order" value="<?php echo $items['cd_order'] ?>" id="cd_order"  class=" frm_input  common_code_item" size="35" maxlength="100"></td>
    </tr>
    <tr>
        <th scope="row"><label for="use_yn">사용여부</label></th>
        <td>
             <select name="use_yn" id="use_yn" >
                <option value=''>--선택--</option>
                <option <?php if ($items['use_yn'] == 'Y') { ?>selected <?php } ?>  value="Y" > Y </option>
                <option <?php if ($items['use_yn'] == 'N') { ?>selected <?php } ?>  value="N" > N </option>
           
            </select>
        </td>
    </tr>
    <tr>
        <th scope="row"><label for="cd_desc">설명</label></th>
        <td><textarea type="text" name="cd_desc" id="cd_desc"   class=" frm_input content common_code_item" rows="7" style="max-width:500px;width:100%;text-align:left;" placeholder="-"
            ><?php echo $items['cd_desc'] ?></textarea></td>
    </tr>
    
<?php
/*
    <tr>
        <th scope="row"><label for="excelfile">엑셀파일 업로드</label></th>
        <td> <input type="file" name="excelfile" id="excelfile" class="btn"> <a href="/data/common_code_sample_data.xls" class="btn" >샘플파일</a></td>
    </tr>
    */
?>
    
    </tbody>
    </table>
</div>

<div class="btn_fixed_top">
    <a href="./common_code_list.php?<?php echo $qstr ?>" class="btn btn_02">목록</a>
    <input type="submit" value="공통코드 등록 저장" class="btn_submit btn" accesskey='s'>
</div>
</form>

<script>
$(function() {
    /*
    $("#a_name").change(function() {
        var a = $("#a_name option:selected").val();
        var item = a.split("|");
        var str = "";
        item.forEach(function(val)  {
            str += "val : "+val+"\n";
        });
        $("#a_no").val(item[0]);
        $("#price").val(item[1]);
        $("#bep").val(item[2]);
        $("#rate").val(item[3]);

        //alert(str);
    });
    */
});



function fmember_submit(f)
{

    return true;
}
</script>

<?php
include_once('./admin.tail.php');
?>
