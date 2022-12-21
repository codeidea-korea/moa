<?php
$sub_menu = "750000";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'w');

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
    $sql = "select * from {$g5['adju_album_table']} where no = '{$no}'";
    $ab = sql_fetch($sql);

    $required_mb_id = 'readonly';
    $required_mb_password = '';
    $html_title = '수정';

    $ab['album_name'] = get_text($ab['album_name']);
    $ab['cd_price'] = get_text($ab['cd_price']);
    $ab['bep'] = get_text($ab['bep']);
    $ab['royalty_rate'] = get_text($ab['royalty_rate']);
    $ab['physical_rate'] = get_text($ab['physical_rate']);
}
else {
    alert('제대로 된 값이 넘어오지 않았습니다.');
}



$g5['title'] .= "";
$g5['title'] .= '앨범 '.$html_title;
include_once('./admin.head.php');

// add_javascript('js 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_javascript(G5_POSTCODE_JS, 0);    //다음 주소 js
?>
<style>
    .adju_item {text-align:right;padding-right:10px}
</style>
<form name="fmember" id="fmember" action="./adju_album_form_update.php" onsubmit="return fmember_submit(this);" method="post" enctype="multipart/form-data">
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
        <col class="grid_4">
        <col>
    </colgroup>
    <tbody>
    <tr>
        <th scope="row"><label for="album_name">앨범명(제작사)<?php echo $sound_only ?></label></th>
        <td>
            <input type="hidden" name="no" id="no" value="<?php echo $ab['no'];?>">
            <select name="album_name" id="album_name" >
                <option value="">--앨범선택--</option>
            <?php 
            $msql = "select * from g5_member where mb_level = '3' order by mb_name asc ";
            $mresult = sql_query($msql);
            while ($row = sql_fetch_array($mresult)) {?>
                <option value="<?php echo $row['mb_4'];?>" <?php if ($row['mb_4'] == $ab['album_name']) { ?>selected <?php } ?>><?php echo $row['mb_4'];?></option>
            <?php } ?>
            </select>
            <?php if (false && $w=='u'){ ?><a href="./boardgroupmember_form.php?mb_id=<?php echo $ab['mb_id'] ?>">검색</a><?php } ?>
        </td>
    </tr>
    <tr>
        <th scope="row"><label for="cd_price">CD 출고가</label></th>
        <td><input type="text" name="cd_price" value="<?php echo $ab['cd_price'] ?>" id="cd_price"  class=" frm_input adju_item" size="25" maxlength="20">원</td>
    </tr>
    <tr>
        <th scope="row"><label for="bep">BEP</label></th>
        <td><input type="text" name="bep" value="<?php echo $ab['bep'] ?>" id="bep"  class=" frm_input adju_item" size="15" maxlength="20" >원</td>
    </tr>
    <tr>
        <th scope="row"><label for="royalty_rate">정산 요율</label></th>
        <td><input type="text" name="royalty_rate" value="<?php echo $ab['royalty_rate'] ?>" id="royalty_rate"  class=" frm_input adju_item" size="15" maxlength="20" >%</td>
    </tr>

  
  
    
    </tbody>
    </table>
</div>

<?php 
//echo "ab[no] : ".$ab['no']."<BR>";

$list = get_alblum_singer_rows($ab['no']);
$slist = get_singer_rows();
if ($list)
    $cnt = count($list);
else
    $cnt = 1;
if ($slist)
    $scnt = count($slist);

?>
<div class="tbl_frm01 tbl_wrap">
    <button type="button" name="addStaff" class="btn btn-default" >앨범참여가수 추가</button>
    <table border="1" style="width:950px">
        <tbody>
            <?php
            for ($i = 0; $i < $cnt; $i++) {
            ?>
            <tr name="trStaff">
                <td style="width:150px"><strong>앨범참여가수 #<?php echo ($i+1)?></strong></td>
                <td style="width:800px">
                    <select class="form-control adju_item" name="singer_id[]" >
                        <option value="" >가수선택</option>
                        <?php
                        for ($j = 0; $j < $scnt; $j++) {
                            ?>
                            <option value="<?php echo $slist[$j]['mb_id']?>" 
                                <?php if ($list[$i]['singer_id'] == $slist[$j]['mb_id']) {
                                    echo " selected ";
                                }?>

                                >
                                <?php echo $slist[$j]['mb_name'];?>
                            </option>
                            <?php
                        }
                        ?>
                    </select>
                    <input type="text" name="sbep[]" 
                        placeholder="가수BEP" class="form-control adju_item"
                        value="<?php echo $list[$i]['bep'];?>">
                    <input type="text" name="sroyalty_rate[]" 
                        placeholder="정산요율" class="form-control adju_item"
                        value="<?php echo $list[$i]['royalty_rate'];?>">
                </td>
            </tr>
            <?php 
            }
            ?>
        </tbody>
    </table>
  <input type="hidden" name="scnt" id="scnt" value="<?php echo $i?>">

<script>
    //추가 버튼
    var singercnt = (parseInt($("#scnt").val())+1);
    $(document).on("click","button[name=addStaff]",function(){
        //alert("aa");
         
        var addStaffText =  ' <tr name="trStaff">';
        addStaffText += '<td style="width:150px"><strong>앨범참여가수 #'+singercnt+'</strong></td>';
        addStaffText += '                <td style="width:800px">';
        addStaffText += '                    <select class="form-control adju_item" name="singer_id[]" >';
        addStaffText += '                        <option value="" >가수선택</option>';
        addStaffText += '<?php for ($j = 0; $j < $scnt; $j++) {?><option value="<?php echo $slist[$j]['mb_id']?>" ><?php echo $slist[$j]['mb_name'];?></option><?php }?></select>';
        addStaffText += '                    <input type="text" name="sbep[]" class="form-control adju_item" value="" placeholder="가수BEP" >';
        addStaffText += '                    <input type="text" name="sroyalty_rate[]" class="form-control adju_item" placeholder="정산요율" value= "" >';
        addStaffText += '       <button class="btn btn-default" name="delStaff">삭제</button>';
        addStaffText += '                </td>';
        addStaffText += '            </tr>';
             
        var trHtml = $( "tr[name=trStaff]:last" ); //last를 사용하여 trStaff라는 명을 가진 마지막 태그 호출
         
        singercnt++;
        trHtml.after(addStaffText); //마지막 trStaff명 뒤에 붙인다.
        $("#scnt").val(singercnt);
    });
     
    //삭제 버튼
    $(document).on("click","button[name=delStaff]",function(){
         
        var trHtml = $(this).parent().parent();
         
        trHtml.remove(); //tr 테그 삭제
        //singercnt--;
         
    });
</script>
</div>
<div class="btn_fixed_top">
    <a href="./adju_album_list.php?<?php echo $qstr ?>" class="btn btn_02">목록</a>
    <input type="submit" value="앨범등록 저장" class="btn_submit btn" accesskey='s'>
</div>
</form>

<script>
function fmember_submit(f)
{

    return true;
}
</script>

<?php
include_once('./admin.tail.php');
?>
