<?php
$sub_menu = "100400";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'w');

if ($w == '')
{
    $required_mb_id = 'required';
    $required_mb_id_class = 'required alnum_';
    $required_mb_password = 'required';
    $sound_only = '<strong class="sound_only">필수</strong>';

    $mb['mb_mailling'] = 1;
    $mb['mb_open'] = 1;
    $mb['mb_level'] = $config['cf_register_level'];
    $html_title = '추가';
}
else if ($w == 'u')
{
    $mb_no = $_GET['mb_no'];
    if (!$mb_no)
        alert("선택된 베너가 없습니다. ");
    $mb = getBanner($mb_no);

    $required_mb_id = 'readonly';
    $required_mb_password = '';
    $html_title = '수정';

    $mb['mb_no'] = get_text($mb['mb_no']);
    $mb['mb_id'] = get_text($mb['mb_id']);
    $mb['mb_url'] = get_text($mb['mb_url']);
    $mb['mb_type'] = get_text($mb['mb_type']);
    $mb['mb_nolink'] = get_text($mb['mb_nolink']);
    $mb['mb_newpop'] = get_text($mb['mb_newpop']);
    $mb['mb_homepage'] = get_text($mb['mb_homepage']);
    $mb['mb_order'] = get_text($mb['mb_order']);
    $mb['mb_btn_text'] = get_text($mb['mb_btn_text']);
    $mb['mb_datetime'] = get_text($mb['mb_datetime']);
    $mb['mb_open'] = get_text($mb['mb_open']);
    $mb['mb_open_date'] = get_text($mb['mb_open_date']);
    $mb['mb_img_pc'] = get_text($mb['mb_img_pc']);
    $mb['mb_img_mo'] = get_text($mb['mb_img_mo']);
    $mb['mb_1'] = get_text($mb['mb_1']);
    $mb['mb_2'] = get_text($mb['mb_2']);
    $mb['mb_3'] = get_text($mb['mb_3']);
    $mb['mb_4'] = get_text($mb['mb_4']);
    $mb['mb_5'] = get_text($mb['mb_5']);
    $mb['mb_6'] = get_text($mb['mb_6']);
    $mb['mb_7'] = get_text($mb['mb_7']);
    $mb['mb_8'] = get_text($mb['mb_8']);
    $mb['mb_9'] = get_text($mb['mb_9']);
    $mb['mb_10'] = get_text($mb['mb_10']);
}
else
    alert('제대로 된 값이 넘어오지 않았습니다.');
 $g5['title'] .= "";
$g5['title'] .= '메인베너 '.$html_title;
include_once('./admin.head.php');

// add_javascript('js 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_javascript(G5_POSTCODE_JS, 0);    //다음 주소 js
?>

<form name="fmember" id="fmember" action="./mainbanner_form_update.php" onsubmit="return fmember_submit(this);" method="post" enctype="multipart/form-data">
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
            <input type="hidden" name="mb_no" value="<?php echo $mb['mb_no']; ?>" id="mb_no" >
            <?php echo $member['mb_id']; ?>
        </td>
    </tr>
    <tr>
        <th scope="row"><label for="mb_order">우선순위<strong class="sound_only">필수</strong></label></th>
        <td><input type="text" name="mb_order" value="<?php echo $mb['mb_order']; ?>" id="mb_order" required class="required frm_input" size="15"  maxlength="20"></td>
        
    </tr>
    <tr>
        <th scope="row"><label for="mb_level">클릭링크 URL</label></th>
        <td>
            <table border=0><tr><td width="170">
            <input type="checkbox" name="mb_nolink" id="mb_nolink" 
            <?php if ($mb['mb_nolink']) echo " checked "?> value="<?php echo $mb['mb_nolink']?>">클릭 링크 연결 안함 </td>
            <td>
                <input type="checkbox" name="mb_newpop" id="mb_newpop" 
            <?php if ($mb['mb_newpop']) echo " checked "?> value="<?php echo $mb['mb_newpop']?>">새창으로 열림  
            </td>
            </tr>
            <tr>
                <td> URL </td>
                <td> <input type="text" name="mb_url" id="mb_url" value="<?php echo $mb['mb_url'] ?>" size="50" class="required frm_input " ></td>
            </tr>
            </table>
        </td>
    </tr>
    <tr>
        <th scope="row"><label for="mb_btn_text">버튼텍스트<strong class="sound_only">필수</strong></label></th>
        <td><input type="text" name="mb_btn_text" value="<?php echo $mb['mb_btn_text'] ?>" id="mb_btn_text" maxlength="100" required class="required frm_input " size="30"></td>
       
    </tr>

    <!-- 하단의 보조 문구도 수정가능하도록 수정 - 19.03.08 - -->
    <tr>
	    <th scope="row">
		    <label for="mb_sub_btn_text">
			    버튼 보조 텍스트
			    <strong class="sound_only">필수</strong>
		    </label>
	    </th>
	    <td>
		    <input
			    type="text" name="mb_sub_btn_text" id="mb_sub_btn_text" required
			    class="required frm_input frm_input_full"
			    value="<?php echo $mb['mb_sub_btn_text']; ?>"
		    >
	    </td>
    </tr>
    
    <tr>
        <th scope="row"><label for="mb_img_pc">PC이미지</label></th>
        <td colspan="3">
            <input type="file" name="mb_img_pc" id="mb_img_pc">
            <?php
            $mb_dir = 'pc';
            $icon_file = G5_PATH.$mb['mb_img_pc'];
            if (file_exists($icon_file)) {
                //$icon_url = G5_DATA_URL.'/mainbanner/'.$mb_dir.'/'.$mb['mb_img_pc'];
                $icon_url = $mb['mb_img_pc'];
                echo '<img src="'.$icon_url.'" alt="" style="max-width:300px;width:100%">';
                echo '<input type="checkbox" id="del_mb_img_pc" name="del_mb_img_pc" value="1">삭제';
            }
            ?>
            <br/>
            ※ 파일업로드시 파일명에 특수문자가 있는경우는 비정상처리 또는 오류가 발생될수있습니다. 
        </td>
    </tr>
    <tr>
        <th scope="row"><label for="mb_img_mo">모바일 이미지</label></th>
        <td colspan="3">
            <input type="file" name="mb_img_mo" id="mb_img_mo">
            <?php
            $mb_dir = 'mobile';
            //$icon_file = G5_DATA_PATH.'/mainbanner/'.$mb_dir.'/'.$mb['mb_img_mo'];
            $icon_file = G5_PATH.$mb['mb_img_mo'];
            if (file_exists($icon_file)) {
                //$icon_url = G5_DATA_URL.'/mainbanner/'.$mb_dir.'/'.$mb['mb_img_mo'];
                $icon_url = $mb['mb_img_mo'];
                echo '<img src="'.$icon_url.'" alt="" style="max-width:300px;width:100%">';
                echo '<input type="checkbox" id="del_mb_img_mo" name="del_mb_img_mo" value="1">삭제';
            }
            ?>
            <br/>
            ※ 파일업로드시 파일명에 특수문자가 있는경우는 비정상처리 또는 오류가 발생될수있습니다. 
        </td>
    </tr>
    <tr>
        <th scope="row"><label for="mb_img_1">추가이미지PC</label></th>
        <td colspan="3">
            <input type="file" name="mb_img_1" id="mb_img_1">
            <?php
            $mb_dir = 'pc';
            $icon_file = G5_PATH.$mb['mb_1'];
            if (file_exists($icon_file)) {
                $icon_url = $mb['mb_1'];
                echo '<img src="'.$icon_url.'" alt="" style="max-width:300px;width:100%">';
                echo '<input type="checkbox" id="del_mb_img_1" name="del_mb_img_1" value="1">삭제';
            }
            ?>
            <br/>
            ※ 파일업로드시 파일명에 특수문자가 있는경우는 비정상처리 또는 오류가 발생될수있습니다. 
        </td>
    </tr>
    <tr>
        <th scope="row"><label for="mb_img_3">추가이미지Moblie</label></th>
        <td colspan="3">
            <input type="file" name="mb_img_3" id="mb_img_3">
            <?php
            $mb_dir = 'mobile';
            $icon_file = G5_PATH.$mb['mb_3'];
            if (file_exists($icon_file)) {
                $icon_url = $mb['mb_3'];
                echo '<img src="'.$icon_url.'" alt="" style="max-width:300px;width:100%">';
                echo '<input type="checkbox" id="del_mb_img_3" name="del_mb_img_3" value="1">삭제';
            }
            ?>
            <br/>
            ※ 파일업로드시 파일명에 특수문자가 있는경우는 비정상처리 또는 오류가 발생될수있습니다. 
        </td>
    </tr>

    <!-- 배경 파일 업로드 가능하게 수정 - 19.03.08 - -->
	<tr>
		<th scope="row">
			<label for="mb_5">배경이미지 PC</label>
		</th>
		<td colspan="3">
			<input type="file" name="mb_5" id="mb_5">
			<?php
			if ($mb['mb_5']) {
				$iconFile = G5_PATH . $mb['mb_5'];
				if (is_file($iconFile)) { ?>
			<img src="<?php echo $mb['mb_5']; ?>" alt="" style="width:100%; max-width:300px;">
			<input type="checkbox" id="del_mb_5" name="del_mb_5" value="1" placeholder="삭제">
			삭제
				<?php }
			}
			?>
			<br>
			※ 파일업로드시 파일명에 특수문자가 있는경우는 비정상처리 또는 오류가 발생될수있습니다.
		</td>
	</tr>
    <tr>
	    <th scope="row">
		    <label for="mb_7">배경이미지 Mobile</label>
	    </th>
	    <td colspan="3">
		    <input type="file" name="mb_7" id="mb_7">
		    <?php
		    if ($mb['mb_7']) {
		    	$iconFile = G5_PATH . $mb['mb_7'];
		    	if (is_file($iconFile)) { ?>
		    <img src="<?php echo $mb['mb_7']; ?>" alt="" style="width:100%; max-width:300px;">
		    <input type="checkbox" id="del_mb_7" name="del_mb_7" value="1" placeholder="삭제">
		    삭제
			    <?php }
		    }
		    ?>
		    <br>
		    ※ 파일업로드시 파일명에 특수문자가 있는경우는 비정상처리 또는 오류가 발생될수있습니다.
	    </td>
    </tr>

    <?php if ($w == 'u') { ?>
    <tr>
        <th scope="row">베너등록일</th>
        <td><?php echo $mb['mb_datetime'] ?></td>
        <th scope="row">베너실시일</th>
        <td><?php echo $mb['mb_open'] ?></td>
    </tr>
    <?php } ?>

    

    <?php for ($i=1; $i<=10; $i++) { ?>
    <tr  style="display:none">
        <th scope="row"><label for="mb_<?php echo $i ?>">여분 필드 <?php echo $i ?></label></th>
        <td colspan="3"><input type="text" name="mb_<?php echo $i ?>" value="<?php echo $mb['mb_'.$i] ?>" id="mb_<?php echo $i ?>" class="frm_input" size="30" maxlength="255"></td>
    </tr>
    <?php } ?>

    </tbody>
    </table>
</div>

<div class="btn_fixed_top">
    <a href="./mainbanner_list.php?<?php echo $qstr ?>" class="btn btn_02">목록</a>
    <input type="submit" value="확인" class="btn_submit btn" accesskey='s'>
</div>
</form>

<script>
function fmember_submit(f)
{
    if (!f.mb_img_pc.value.match(/\.(gif|jpe?g|png)$/i) && f.mb_img_pc.value) {
        alert('PC용 베너는 이미지 파일만 가능합니다.');
        return false;
    }

    if (!f.mb_img_mo.value.match(/\.(gif|jpe?g|png)$/i) && f.mb_img_mo.value) {
        alert('PC용 베너는 이미지 파일만 가능합니다.');
        return false;
    }

    if (!f.mb_img_1.value.match(/\.(gif|jpe?g|png)$/i) && f.mb_img_1.value) {
        alert('PC용 베너는 이미지 파일만 가능합니다.');
        return false;
    }

    if (!f.mb_img_3.value.match(/\.(gif|jpe?g|png)$/i) && f.mb_img_3.value) {
        alert('PC용 베너는 이미지 파일만 가능합니다.');
        return false;
    }

    return true;
}
</script>

<?php
include_once('./admin.tail.php');
?>
