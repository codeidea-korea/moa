<?php
$sub_menu = "750300";
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
    $sql = "select * from {$g5['adju_basic_table']} where no = '{$no}'";
    $mb = sql_fetch($sql);

    $required_mb_id = 'readonly';
    $required_mb_password = '';
    $html_title = '수정';

    $mb['album_name'] = get_text($mb['album_name']);
    $mb['cd_price'] = get_text($mb['cd_price']);
    $mb['bep'] = get_text($mb['bep']);
    $mb['royalty_rate'] = get_text($mb['royalty_rate']);
    $mb['physical_rate'] = get_text($mb['physical_rate']);
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
<form name="fmember" id="fmember" action="./adju_basic_form_update.php" onsubmit="return fmember_submit(this);" method="post" enctype="multipart/form-data">
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
            <input type="hidden" name="no" id="no" value="<?php echo $mb['no'];?>">
            <select name="album_name" id="album_name" >
                <option value=''>--앨범선택--</option>
            <?php 
            $msql = "select * from g5_member where mb_level = '3' order by mb_name asc ";
            $mresult = sql_query($msql);
            while ($row = sql_fetch_array($mresult)) {?>
                <option value="<?php echo $row['mb_name'];?>" <?php if ($row['mb_name'] == $mb['album_name']) { ?>selected <?php } ?>><?php echo $row['mb_name'];?></option>
            <?php } ?>
            </select>
            <?php if ($w=='u'){ ?><a href="./boardgroupmember_form.php?mb_id=<?php echo $mb['mb_id'] ?>">검색</a><?php } ?>
        </td>
    </tr>
    <tr>
        <th scope="row"><label for="cd_price">CD 출고가</label></th>
        <td><input type="text" name="cd_price" value="<?php echo $mb['cd_price'] ?>" id="cd_price"  class=" frm_input" size="25" maxlength="20"></td>
    </tr>
    <tr>
        <th scope="row"><label for="bep">BEP</label></th>
        <td><input type="text" name="bep" value="<?php echo $mb['bep'] ?>" id="bep"  class=" frm_input" size="15" maxlength="20"></td>
    </tr>
    <tr>
        <th scope="row"><label for="royalty_rate">정산 요율</label></th>
        <td><input type="text" name="royalty_rate" value="<?php echo $mb['royalty_rate'] ?>" id="royalty_rate"  class=" frm_input" size="15" maxlength="20"></td>
    </tr>

  
  
    
    </tbody>
    </table>
</div>

<div class="btn_fixed_top">
    <a href="./member_list2.php?<?php echo $qstr ?>" class="btn btn_02">목록</a>
    <input type="submit" value="앨범등록하기" class="btn_submit btn" accesskey='s'>
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
