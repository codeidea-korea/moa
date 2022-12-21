<?php
$sub_menu = "400310";
include_once('./_common.php');
include_once(G5_EDITOR_LIB);
include_once(G5_LIB_PATH.'/iteminfo.lib.php');

auth_check($auth[$sub_menu], 'w');

if ($w == '')
{
    $html_title = '추가';
}
else if ($w == 'u')
{
    $cc_id = $_GET['cc_id'];
    if (!$cc_id)
        alert("선택된 커리큘럼이 없습니다. ");
    $mb = getLecContents($cc_id,'lec_curriculum','cc_id');
    $required_cc_id = 'readonly';
    $required_cc_password = '';
    $html_title = '수정';

    $mb['cc_id'] = get_text($mb['cc_id']);
    $mb['mb_id'] = get_text($mb['mb_id']);
    $mb['cc_name'] = get_text($mb['cc_name']);
    $mb['cc_type'] = get_text($mb['cc_type']);
    $mb['cc_order'] = get_text($mb['cc_order']);
    $mb['cc_memo'] = get_text($mb['cc_memo']);
    $mb['cc_datetime'] = get_text($mb['cc_datetime']);
    $mb['cc_img_pc'] = get_text($mb['cc_img_pc']);
    $mb['cc_img_mo'] = get_text($mb['cc_img_mo']);
    $mb['cc_1'] = get_text($mb['cc_1']);
    $mb['cc_2'] = get_text($mb['cc_2']);
    $mb['cc_3'] = get_text($mb['cc_3']);
    $mb['cc_4'] = get_text($mb['cc_4']);
    $mb['cc_5'] = get_text($mb['cc_5']);
    $mb['cc_6'] = get_text($mb['cc_6']);
    $mb['cc_7'] = get_text($mb['cc_7']);
    $mb['cc_8'] = get_text($mb['cc_8']);
    $mb['cc_9'] = get_text($mb['cc_9']);
    $mb['cc_10'] = get_text($mb['cc_10']);
}
else
    alert('제대로 된 값이 넘어오지 않았습니다.');
 $g5['title'] .= "";
$g5['title'] .= '커리큘럼추가 '.$html_title;
include_once (G5_ADMIN_PATH.'/admin.head.php');

// add_javascript('js 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_javascript(G5_POSTCODE_JS, 0);    //다음 주소 js
?>

<form name="fmember" id="fmember" action="./lec_curriculum_form_update.php" onsubmit="return fmember_submit(this);" method="post" enctype="multipart/form-data">
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
            <input type="hidden" name="delcv" id="delcv" value="">
            <input type="hidden" name="mb_id" value="<?php echo $member['mb_id']; ?>" id="mb_id" >
            <input type="hidden" name="cc_id" value="<?php echo $mb['cc_id']; ?>" id="cc_no" >
            <?php echo $member['mb_id']; ?>
        </td>
    </tr>
    <tr>
        <th scope="row"><label for="cc_order">우선순위<strong class="sound_only">필수</strong></label></th>
        <td><input  name="cc_order" value="<?php echo $mb['cc_order']; ?>" id="cc_order" required class="required frm_input"  >
           
        </td>
        
    </tr>
   
    
    <tr style="display:">
        <th scope="row"><label for="cc_img_pc">대표 이미지</label></th>
        <td colspan="3">
            <input type="file" name="cc_img_pc" id="cc_img_pc">
            <?php
            $cc_dir = 'pc';
            $icon_file = G5_PATH.$mb['cc_img_pc'];
            if (file_exists($icon_file)) {
                //$icon_url = G5_DATA_URL.'/lec_curriculum/'.$cc_dir.'/'.$mb['cc_img_pc'];
                $icon_url = $mb['cc_img_pc'];
                echo '<img src="'.$icon_url.'" alt="" style="max-width:300px;width:100%">';
                echo '<input type="checkbox" id="del_cc_img_pc" name="del_cc_img_pc" value="1">삭제';
            }
            ?>
        </td>
    </tr>
   
    <tr style="display:">
        <th scope="row"><label for="cc_name">커리큘럼명</label></th>
        <td> <input type="text" name="cc_name" id="cc_name" value="<?php echo $mb['cc_name'] ?>" style="max-width:500px;width:100%" class=" frm_input " ></td>
    </tr>
   
   

    <?php if ($w == 'u') { ?>
    <tr>
        <th scope="row">등록일</th>
        <td><?php echo $mb['cc_datetime'] ?></td>
    </tr>
    <?php } ?>

    
    
    <?php for ($i=1; $i<=10; $i++) { ?>
    <tr style="display:none">
        <th scope="row"><label for="cc_<?php echo $i ?>">여분 필드 <?php echo $i ?></label></th>
        <td colspan="3"><input type="text" name="cc_<?php echo $i ?>" value="<?php echo $mb['cc_'.$i] ?>" id="cc_<?php echo $i ?>" class="frm_input" size="30" maxlength="255"></td>
    </tr>
    <?php } ?>

    </tbody>
    </table>
</div>

<div id="lec_vod_form">
       <input type="Button" value="VOD강의 추가" onclick="addForm()" class="btn_submit btn">
</div>
<input type="hidden" name="count" id="count" value="0">
<div id="addedFormDiv"></div><BR> <!-- 폼을 삽입할 DIV -->




<div class="btn_fixed_top">
    <a href="./lec_curriculum_list.php?<?php echo $qstr ?>" class="btn btn_02">목록</a>
    <input type="submit" value="확인" class="btn_submit btn" accesskey='s'>
</div>
</form>
<?php

$list = getListLecVod($mb['cc_id']);
echo "<pre>";
//var_dump($list);
echo "</pre>";
?>
<script>
var count = 0;
function addForm(){
    var addedFormDiv = document.getElementById("addedFormDiv");
    var str = "<div class='tbl_frm01 tbl_wrap'><table><caption>동영상 ["+count+"]</caption>";
    str +="<colgroup><col class='grid_4'><col><col class='grid_4'><col><col class='grid_4'></colgroup>";
    str +="<tbody><tr><th scope='row'><label for='cv_title'>동영상제목<?php echo $sound_only ?></label></th>";
    str += "<td><input type='hidden' name='cv_no["+count+"]' value='' id='cv_no_"+count+"'' >";
    str += "<input type='text' name='cv_title["+count+"]' id='cv_title_"+count+"'' class='frm_input' value='' style='max-width:500px;width:100%' >";
    str += "</td><td rowspan='4'><input type='button' value='삭제' onclick='delForm("+count+");' class='btn btn_02'></td></tr>";
    str +="<tr><th scope='row'><label for='cv_type'>유료/무료선택<?php echo $sound_only ?></label></th>";
    str += "<td>";
    str += "<input type='radio' name='cv_type["+count+"]' id='cv_type_"+count+"_1'' class='frm_input' value='1' >유료 &nbsp;&nbsp;";
    str += "<input type='radio' name='cv_type["+count+"]' id='cv_type_"+count+"_0'' class='frm_input' value='0' >무료";
    str += "</td></tr>";
    str +="<tr><th scope='row'><label for='cv_playtime'>재생시간<?php echo $sound_only ?></label></th>";
    str += "<td><input type='text' name='cv_playtime["+count+"]' id='cv_playtime_"+count+"'' class='frm_input' value='' >";
    str += "</td></tr>";
    str +="<tr><th scope='row'><label for='cv_url'>동영상 URL <?php echo $sound_only ?></label></th>";
    str += "<td><input type='text' name='cv_url["+count+"]' id='cv_url_"+count+"'' class='frm_input' value='' style='max-width:700px;width:100%' >";
    str += "</td></tr></table></div>";
    // 추가할 폼(에 들어갈 HTML)

    var addedDiv = document.createElement("div"); // 폼 생성
    addedDiv.id = "added_"+count; // 폼 Div에 ID 부여 (삭제를 위해)
    addedDiv.innerHTML  = str; // 폼 Div안에 HTML삽입
    addedFormDiv.appendChild(addedDiv); // 삽입할 DIV에 생성한 폼 삽입

    count++;
    document.fmember.count.value=count;
    // 다음 페이지에 몇개의 폼을 넘기는지 전달하기 위해 히든 폼에 카운트 저장
}

function delForm(cnt){
    var addedFormDiv = document.getElementById("addedFormDiv");
    var delcv = document.getElementById("delcv");
    if (delcv.value) delcv.value += ",";
    delcv.value += $("#cv_no_"+cnt).val();
    if(count >1){ // 현재 폼이 두개 이상이면
        var addedDiv = document.getElementById("added_"+(cnt));
        // 마지막으로 생성된 폼의 ID를 통해 Div객체를 가져옴
        addedFormDiv.removeChild(addedDiv); // 폼 삭제 
    }else{ // 마지막 폼만 남아있다면
        document.fmember.reset(); // 폼 내용 삭제
    }
}

function setForm(obj,i)  {
    $("#cv_no_"+i).val(obj['cv_no']);
    $("#cv_title_"+i).val(obj['cv_title']);

    $("#cv_type_"+i+"_"+obj['cv_type']).attr("checked",true);
    $("#cv_playtime_"+i).val(obj['cv_playtime']);
    $("#cv_url_"+i).val(obj['cv_url']);

}

$(function() {
    addForm();
    var obj = new Array();
    <?php
    $cnt = count($list);
    ?>
    var cnt = <?php echo $cnt; ?>;
    var idx = 0;
    <?php
    for ($i = 0; $i < $cnt;$i++) {
        ?>
        if (count < cnt && idx != 0)
            addForm();
        obj['cv_no'] = '<?php echo $list[$i]['cv_no'];?>';
        obj['cv_title'] = '<?php echo $list[$i]['cv_title'];?>';
        obj['cv_type'] = '<?php echo $list[$i]['cv_type'];?>';
        obj['cv_playtime'] = '<?php echo $list[$i]['cv_playtime'];?>';
        obj['cv_url'] = '<?php echo $list[$i]['cv_url'];?>';
       setForm(obj,'<?php echo $i?>');
       idx++;
    <?php
    }
    ?>
});

function fmember_submit(f)
{
    if (!f.cc_img_pc.value.match(/\.(gif|jpe?g|png)$/i) && f.cc_img_pc.value) {
        alert('PC용 베너는 이미지 파일만 가능합니다.');
        return false;
    }

   

    return true;
}
</script>

<?php
include_once (G5_ADMIN_PATH.'/admin.tail.php');
?>
