<?php
$sub_menu = "400310";
include_once('./_common.php');
include_once(G5_EDITOR_LIB);
include_once(G5_LIB_PATH.'/iteminfo.lib.php');

auth_check($auth[$sub_menu], 'r');
 
$sql_common = " from {$g5['lec_curriculum_table']} ";

$sql_search = " where (1) ";

if (!$sst) {
    $sst = "cc_datetime";
    $sod = "desc";
}

$sql_order = " order by {$sst} {$sod} ";

$sql = " select count(*) as cnt {$sql_common} {$sql_search} {$sql_order} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함


$listall = '<a href="'.$_SERVER['SCRIPT_NAME'].'" class="ov_listall">전체목록</a>';

$g5['title'] = '강의커리큘럼';
//echo G5_ADMIN_PATH."<BR>";
include_once(G5_ADMIN_PATH.'/admin.head.php');

$sql = " select * {$sql_common} {$sql_search} {$sql_order} limit {$from_record}, {$rows} ";
$result = sql_query($sql);

$colspan = 16;
?>


<form name="fmemberlist" id="fmemberlist" action="./lec_curriculum_list_update.php" onsubmit="return flec_curriculumlist_submit(this);" method="post">
<input type="hidden" name="sst" value="<?php echo $sst ?>">
<input type="hidden" name="sod" value="<?php echo $sod ?>">
<input type="hidden" name="sfl" value="<?php echo $sfl ?>">
<input type="hidden" name="stx" value="<?php echo $stx ?>">
<input type="hidden" name="page" value="<?php echo $page ?>">
<input type="hidden" name="token" value="">
<input type="hidden" name="btnText" id="btnText" value="">


<div class="tbl_head01 tbl_wrap">
    <table>
    <caption><?php echo $g5['title']; ?> 목록</caption>
    <thead>
    <tr>
        <th scope="col" id="cc_list_chk"  >
            <label for="chkall" class="sound_only"> 전체</label>
            <input type="checkbox" name="chkall" value="1" id="chkall" onclick="check_all(this.form)">
        </th>
        
        <th scope="col"  id="cc_list_cert">우선순위</th>
        <th scope="col"  id="cc_list_cert">이미지</th>
        <!--
        <th scope="col" id="cc_list_mailc">이미지Mobile</th>
    -->
        <th scope="col" id="cc_list_url"><?php echo subject_sort_link('cc_url', '', 'desc') ?>커리큘럼명 </a></th>
        <th scope="col" id="cc_list_text" ><?php echo subject_sort_link('cc_btn_text') ?>동영상 수</a></th>
        
        <th scope="col"  id="cc_list_mng">관리</th>
    </tr>
    
    </thead>
    <tbody>
    <?php
    for ($i=0; $row=sql_fetch_array($result); $i++) {
        
        if ($is_admin == 'group') {
            $s_mod = '';
        } else {
            $s_mod = '<a href="./lec_curriculum_form.php?'.$qstr.'&amp;w=u&amp;cc_id='.$row['cc_id'].'" class="btn btn_03">수정</a>';
        }

       
        $cc_id = $row['cc_id'];
        $leave_msg = '';
        $intercept_msg = '';
        $intercept_title = '';
        

        

        $bg = 'bg'.($i%2);

       
    ?>

    <tr class="<?php echo $bg; ?>">
        <td headers="cc_list_chk" class="cc_chk" >
            <input type="hidden" name="mb_id[]" value="<?php echo $row['mb_id'] ?>" id="mb_id_<?php echo $i ?>">
            <input type="hidden" name="cc_id[]" value="<?php echo $row['cc_id'] ?>" id="cc_id _<?php echo $i ?>">
            <label for="chk_<?php echo $i; ?>" class="sound_only"><?php echo get_text($row['cc_name']); ?> <?php echo get_text($row['cc_nick']); ?></label>
            <input type="checkbox" name="chk[]" value="<?php echo $i ?>" id="chk_<?php echo $i ?>">
        </td>
        
        <td headers="cc_order"   class="cc_order">
           <input type="text" name="cc_order[<?php echo $i?>]" id="cc_order_<?php echo $i?>" value="<?php echo $row['cc_order'];?>" class="required frm_input" style="width:50px">
        </td>
        <td headers="cc_img_pc"   class="cc_img_pc">
           <?php if ($row['cc_img_pc'])
            //echo "<img src=\"/data/mainbanner/pc/{$row['cc_img_pc']}\" width=\"150\">";
            echo "<img src=\"{$row['cc_img_pc_thumb']}\" width=\"150\">";?>
        </td>
       
        <td headers="cc_name"   class="cc_name">
           <?php echo $row['cc_name'];?>
        </td>
        <td headers="cc_btn_text"   class="cc_btn_text">
           <?php 
           $sql = "selct count(*) cnt from g5_shop_curriculum_vod where cc_id = '{$row['cc_id']}'";
           $cnt = sql_fetch($sql);
           echo $cnt['cnt'];?>
        </td>
        <td headers="cc_list_mng"  class="cc_mng cc_mng_s"><?php echo $s_mod ?></td>
    </tr>

    <?php
    }
    if ($i == 0)
        echo "<tr><td colspan=\"".$colspan."\" class=\"empty_table\">자료가 없습니다.</td></tr>";
    ?>
    </tbody>
    </table>
</div>

<script>
$(function() {
    $("#act_button").click(function(data){
        $('#btnText').val(this.value);
    });
});

function flec_curriculumlist_submit(f)
{
    if (!is_checked("chk[]")) {
        alert($("#btnText").val()+" 하실 항목을 하나 이상 선택하세요.");
        return false;
    }
    if($("#btnText").val() == "선택삭제") {
        if(!confirm("선택한 자료를 정말 삭제하시겠습니까?")) {
            return false;
        }
    }
    return true;
}
</script>

<div class="btn_fixed_top">
    <input type="submit" name="act_button" id="act_button" value="선택수정" onclick="$('#btnText').val(this.value);" class="btn btn_02">
    <input type="submit" name="act_button" id="act_button" value="선택삭제" onclick="$('#btnText').val(this.value);" class="btn btn_02">
    <?php if ($is_admin == 'super') { ?>
    <a href="./lec_curriculum_form.php" id="member_add" class="btn btn_01">강의커리큘럼 등록</a>
    <?php } ?>

</div>


</form>

<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, '?'.$qstr.'&amp;page='); ?>

<?php
include_once (G5_ADMIN_PATH.'/admin.tail.php');
?>
