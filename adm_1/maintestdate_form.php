<?php
$sub_menu = "100420";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'w');

if ($w == '')
{
    $html_title = '추가';
}
else if ($w == 'u')
{
    $td_no = $_GET['td_no'];
    if (!$td_no)
        alert("선택된 일정항목이 없습니다. ");
    $mb = getTableContents($td_no,'maintestdate','td');
    $required_td_id = 'readonly';
    $required_td_password = '';
    $html_title = '수정';

    $mb['td_no'] = get_text($mb['td_no']);
    $mb['mb_id'] = get_text($mb['mb_id']);
    $mb['td_url'] = get_text($mb['td_url']);
    $mb['td_type'] = get_text($mb['td_type']);
    $mb['td_order'] = get_text($mb['td_order']);
    $mb['td_btn_text'] = get_text($mb['td_btn_text']);
    $mb['td_datetime'] = get_text($mb['td_datetime']);
    $mb['td_open'] = get_text($mb['td_open']);
    $mb['td_open_date'] = get_text($mb['td_open_date']);
    $mb['td_img_pc'] = get_text($mb['td_img_pc']);
    $mb['td_img_mo'] = get_text($mb['td_img_mo']);
    $mb['td_1'] = get_text($mb['td_1']);
    $mb['td_2'] = get_text($mb['td_2']);
    $mb['td_3'] = get_text($mb['td_3']);
    $mb['td_4'] = get_text($mb['td_4']);
    $mb['td_5'] = get_text($mb['td_5']);
    $mb['td_6'] = get_text($mb['td_6']);
    $mb['td_7'] = get_text($mb['td_7']);
    $mb['td_8'] = get_text($mb['td_8']);
    $mb['td_9'] = get_text($mb['td_9']);
    $mb['td_10'] = get_text($mb['td_10']);
}
else
    alert('제대로 된 값이 넘어오지 않았습니다.');
 $g5['title'] .= "";
$g5['title'] .= '메인시험일정 '.$html_title;
include_once('./admin.head.php');

// add_javascript('js 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_javascript(G5_POSTCODE_JS, 0);    //다음 주소 js
?>

<form name="fmember" id="fmember" action="./maintestdate_form_update.php" onsubmit="return fmember_submit(this);" method="post" enctype="multipart/form-data">
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
        <th scope="row"><label for="mb_id">아이디<?php echo $sound_only ?></label></th>
        <td>
            <input type="hidden" name="mb_id" value="<?php echo $member['mb_id']; ?>" id="mb_id" >
            <input type="hidden" name="td_no" value="<?php echo $mb['td_no']; ?>" id="td_no" >
            <?php echo $member['mb_id']; ?>
        </td>
    </tr>
    <tr>
        <th scope="row"><label for="td_testyear">시험연도<strong class="sound_only">필수</strong></label></th>
        <td><select  name="td_testyear" value="<?php echo $mb['td_order']; ?>" id="td_testyear" required class="required frm_input"  >
            <?php 
            for ($i=2017; $i < 2030; $i++) {
                if ($i == $mb['td_testyear']) $chk = "selected";
                echo "<option value='{$i}' {$chk} >".$i."</option>";
            }
            ?>
        </select>
        </td>
        
    </tr>
    <tr >
        <th scope="row"><label for="td_order">순번</label></th>
        <td> <input type="text" name="td_order" id="td_order" value="<?php echo $mb['td_order'] ?>" style="max-width:500px;width:100%" class=" frm_input " ></td>
    </tr>
    <tr style="display:none">
        <th scope="row"><label for="td_level">VOD URL</label></th>
        <td> <input type="text" name="td_url" id="td_url" value="<?php echo $mb['td_url'] ?>" style="max-width:500px;width:100%" class=" frm_input " ></td>
    </tr>
    <tr>
        <th scope="row"><label for="td_btn_text">시험일정 설명<strong class="sound_only">필수</strong></label></th>
        <td><input type="text" name="td_btn_text" value="<?php echo $mb['td_btn_text'] ?>" id="td_btn_text" maxlength="100"  class=" frm_input " size="30"></td>
       
    </tr>
    
    <tr style="display:">
        <th scope="row"><label for="td_img_pc">이미지</label></th>
        <td colspan="3">
            <input type="file" name="td_img_pc" id="td_img_pc">
            <?php
            $td_dir = 'pc';
            $icon_file = G5_PATH.$mb['td_img_pc'];
            if (file_exists($icon_file)) {
                //$icon_url = G5_DATA_URL.'/maintestdate/'.$td_dir.'/'.$mb['td_img_pc'];
                $icon_url = $mb['td_img_pc'];
                echo '<img src="'.$icon_url.'" alt="" style="max-width:300px;width:100%">';
                echo '<input type="checkbox" id="del_td_img_pc" name="del_td_img_pc" value="1">삭제';
            }
            ?>
            <br/>
            ※ 파일업로드시 파일명에 특수문자가 있는경우는 비정상처리 또는 오류가 발생될수있습니다. 
        </td>
    </tr>
    <tr style="display:none">
        <th scope="row"><label for="td_img_mo">모바일 이미지</label></th>
        <td colspan="3">
            <input type="file" name="td_img_mo" id="td_img_mo">
            <?php
            $td_dir = 'mobile';
            //$icon_file = G5_DATA_PATH.'/maintestdate/'.$td_dir.'/'.$mb['td_img_mo'];
            $icon_file = G5_PATH.$mb['td_img_mo'];
            if (file_exists($icon_file)) {
                $icon_url = G5_DATA_URL.'/maintestdate/'.$td_dir.'/'.$mb['td_img_mo'];
                $icon_url = $mb['td_img_mo'];
                echo '<img src="'.$icon_url.'" alt="" style="max-width:300px;width:100%">';
                echo '<input type="checkbox" id="del_td_img_mo" name="del_td_img_mo" value="1">삭제';
            }
            ?>
        </td>
    </tr>
   
   

    <?php if ($w == 'u') { ?>
    <tr>
        <th scope="row">등록일</th>
        <td><?php echo $mb['td_datetime'] ?></td>
    </tr>
    <?php } ?>

    
    
    <?php for ($i=1; $i<=10; $i++) { ?>
    <tr style="display:none">
        <th scope="row"><label for="td_<?php echo $i ?>">여분 필드 <?php echo $i ?></label></th>
        <td colspan="3"><input type="text" name="td_<?php echo $i ?>" value="<?php echo $mb['td_'.$i] ?>" id="td_<?php echo $i ?>" class="frm_input" size="30" maxlength="255"></td>
    </tr>
    <?php } ?>

    </tbody>
    </table>
</div>

<div class="btn_fixed_top">
    <a href="./maintestdate_list.php?<?php echo $qstr ?>" class="btn btn_02">목록</a>
    <input type="submit" value="확인" class="btn_submit btn" accesskey='s'>
</div>
</form>

<script>
function fmember_submit(f)
{
    if (!f.td_img_pc.value.match(/\.(gif|jpe?g|png)$/i) && f.td_img_pc.value) {
        alert('PC용 베너는 이미지 파일만 가능합니다.');
        return false;
    }

    if (!f.td_img_mo.value.match(/\.(gif|jpe?g|png)$/i) && f.td_img_mo.value) {
        alert('PC용 베너는 이미지 파일만 가능합니다.');
        return false;
    }

    return true;
}
</script>

<?php
include_once('./admin.tail.php');
?>
