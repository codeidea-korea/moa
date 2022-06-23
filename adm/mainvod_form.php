<?php
$sub_menu = "100410";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'w');

if ($w == '')
{
    $html_title = '추가';
}
else if ($w == 'u')
{
    $mv_no = $_GET['mv_no'];
    if (!$mv_no)
        alert("선택된 베너가 없습니다. ");
    $mb = getTableContents($mv_no,'mainvod','mv');
    $required_mv_id = 'readonly';
    $required_mv_password = '';
    $html_title = '수정';

    $mb['mv_no'] = get_text($mb['mv_no']);
    $mb['mb_id'] = get_text($mb['mb_id']);
    $mb['mv_url'] = get_text($mb['mv_url']);
    $mb['mv_type'] = get_text($mb['mv_type']);
    $mb['mv_order'] = get_text($mb['mv_order']);
    $mb['mv_btn_text'] = get_text($mb['mv_btn_text']);
    $mb['mv_datetime'] = get_text($mb['mv_datetime']);
    $mb['mv_open'] = get_text($mb['mv_open']);
    $mb['mv_open_date'] = get_text($mb['mv_open_date']);
    $mb['mv_img_pc'] = get_text($mb['mv_img_pc']);
    $mb['mv_img_mo'] = get_text($mb['mv_img_mo']);
    $mb['mv_1'] = get_text($mb['mv_1']);
    $mb['mv_2'] = get_text($mb['mv_2']);
    $mb['mv_3'] = get_text($mb['mv_3']);
    $mb['mv_4'] = get_text($mb['mv_4']);
    $mb['mv_5'] = get_text($mb['mv_5']);
    $mb['mv_6'] = get_text($mb['mv_6']);
    $mb['mv_7'] = get_text($mb['mv_7']);
    $mb['mv_8'] = get_text($mb['mv_8']);
    $mb['mv_9'] = get_text($mb['mv_9']);
    $mb['mv_10'] = get_text($mb['mv_10']);
}
else
    alert('제대로 된 값이 넘어오지 않았습니다.');
 $g5['title'] .= "";
$g5['title'] .= '메인VOD '.$html_title;
include_once('./admin.head.php');

// add_javascript('js 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_javascript(G5_POSTCODE_JS, 0);    //다음 주소 js
?>

<form name="fmember" id="fmember" action="./mainvod_form_update.php" onsubmit="return fmember_submit(this);" method="post" enctype="multipart/form-data">
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
            <input type="hidden" name="mv_no" value="<?php echo $mb['mv_no']; ?>" id="mv_no" >
            <?php echo $member['mb_id']; ?>
        </td>
    </tr>
    <tr>
        <th scope="row"><label for="mv_order">우선순위<strong class="sound_only">필수</strong></label></th>
        <td><input type="text" name="mv_order" value="<?php echo $mb['mv_order']; ?>" id="mv_order" required class="required frm_input" size="15"  maxlength="20"></td>
        
    </tr>
    <tr>
        <th scope="row"><label for="mv_level">VOD URL</label></th>
        <td> <input type="text" name="mv_url" id="mv_url" value="<?php echo $mb['mv_url'] ?>" style="max-width:500px;width:100%" class="required frm_input " ></td>
    </tr>
    <tr>
        <th scope="row"><label for="mv_btn_text">VOD설명<strong class="sound_only">필수</strong></label></th>
        <td><input type="text" name="mv_btn_text" value="<?php echo $mb['mv_btn_text'] ?>" id="mv_btn_text" maxlength="100" required class="required frm_input " size="30"></td>
       
    </tr>
    
    <tr style="display:none">
        <th scope="row"><label for="mv_img_pc">PC이미지</label></th>
        <td colspan="3">
            <input type="file" name="mv_img_pc" id="mv_img_pc">
            <?php
            $mv_dir = 'pc';
            $icon_file = G5_PATH.$mb['mv_img_pc'];
            if (file_exists($icon_file)) {
                //$icon_url = G5_DATA_URL.'/mainvod/'.$mv_dir.'/'.$mb['mv_img_pc'];
                $icon_url = $mb['mv_img_pc'];
                echo '<img src="'.$icon_url.'" alt="" style="max-width:300px;width:100%">';
                echo '<input type="checkbox" id="del_mv_img_pc" name="del_mv_img_pc" value="1">삭제';
            }
            ?>
        </td>
    </tr>
    <tr style="display:none">
        <th scope="row"><label for="mv_img_mo">모바일 이미지</label></th>
        <td colspan="3">
            <input type="file" name="mv_img_mo" id="mv_img_mo">
            <?php
            $mv_dir = 'mobile';
            //$icon_file = G5_DATA_PATH.'/mainvod/'.$mv_dir.'/'.$mb['mv_img_mo'];
            $icon_file = G5_PATH.$mb['mv_img_mo'];
            if (file_exists($icon_file)) {
                $icon_url = G5_DATA_URL.'/mainvod/'.$mv_dir.'/'.$mb['mv_img_mo'];
                $icon_url = $mb['mv_img_mo'];
                echo '<img src="'.$icon_url.'" alt="" style="max-width:300px;width:100%">';
                echo '<input type="checkbox" id="del_mv_img_mo" name="del_mv_img_mo" value="1">삭제';
            }
            ?>
        </td>
    </tr>
   
   

    <?php if ($w == 'u') { ?>
    <tr>
        <th scope="row">등록일</th>
        <td><?php echo $mb['mv_datetime'] ?></td>
    </tr>
    <?php } ?>

    

    <?php for ($i=1; $i<=10; $i++) { ?>
    <tr>
        <th scope="row"><label for="mv_<?php echo $i ?>">여분 필드 <?php echo $i ?></label></th>
        <td colspan="3"><input type="text" name="mv_<?php echo $i ?>" value="<?php echo $mb['mv_'.$i] ?>" id="mv_<?php echo $i ?>" class="frm_input" size="30" maxlength="255"></td>
    </tr>
    <?php } ?>

    </tbody>
    </table>
</div>

<div class="btn_fixed_top">
    <a href="./mainvod_list.php?<?php echo $qstr ?>" class="btn btn_02">목록</a>
    <input type="submit" value="확인" class="btn_submit btn" accesskey='s'>
</div>
</form>

<script>
function fmember_submit(f)
{
    if (!f.mv_img_pc.value.match(/\.(gif|jpe?g|png)$/i) && f.mv_img_pc.value) {
        alert('PC용 베너는 이미지 파일만 가능합니다.');
        return false;
    }

    if (!f.mv_img_mo.value.match(/\.(gif|jpe?g|png)$/i) && f.mv_img_mo.value) {
        alert('PC용 베너는 이미지 파일만 가능합니다.');
        return false;
    }

    return true;
}
</script>

<?php
include_once('./admin.tail.php');
?>
