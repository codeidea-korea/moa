<?php
$sub_menu = "100420";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');
 
$sql_common = " from {$g5['maintestdate_table']} ";

$sql_search = " where (1) ";

if (!$sst) {
    $sst = "td_datetime";
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

$g5['title'] = '메인시험일정관리';
include_once('./admin.head.php');

$sql = " select * {$sql_common} {$sql_search} {$sql_order} limit {$from_record}, {$rows} ";
$result = sql_query($sql);

$colspan = 16;
?>


<form name="fmemberlist" id="fmemberlist" action="./maintestdate_list_update.php" onsubmit="return fmaintestdatelist_submit(this);" method="post">
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
        <th scope="col" id="td_list_chk"  >
            <label for="chkall" class="sound_only"> 전체</label>
            <input type="checkbox" name="chkall" value="1" id="chkall" onclick="check_all(this.form)">
        </th>
        
        <th scope="col"  id="td_list_cert">이미지</th>
        <!--
        <th scope="col" id="td_list_mailc">이미지Mobile</th>
    -->
        <th scope="col" id="td_testyear"><?php echo subject_sort_link('td_testyear', '', 'desc') ?>순서</a></th>
        <th scope="col" id="td_order"><?php echo subject_sort_link('td_order', '', 'desc') ?>순서</a></th>
        <th scope="col" id="td_list_text" ><?php echo subject_sort_link('td_btn_text') ?>시험일정 설명</a></th>
        
        <th scope="col"  id="td_list_mng">관리</th>
    </tr>
    
    </thead>
    <tbody>
    <?php
    for ($i=0; $row=sql_fetch_array($result); $i++) {
        
        if ($is_admin == 'group') {
            $s_mod = '';
        } else {
            $s_mod = '<a href="./maintestdate_form.php?'.$qstr.'&amp;w=u&amp;td_no='.$row['td_no'].'" class="btn btn_03">수정</a>';
        }

       
        $td_id = $row['td_id'];
        $leave_msg = '';
        $intercept_msg = '';
        $intercept_title = '';
        

        

        $bg = 'bg'.($i%2);

       
    ?>

    <tr class="<?php echo $bg; ?>">
        <td headers="td_list_chk" class="td_chk" >
            <input type="hidden" name="mb_id[<?php echo $i ?>]" value="<?php echo $row['mb_id'] ?>" id="mb_id_<?php echo $i ?>">
            <input type="hidden" name="td_no[<?php echo $i ?>]" value="<?php echo $row['td_no'] ?>" id="td_no _<?php echo $i ?>">
            <label for="chk_<?php echo $i; ?>" class="sound_only"><?php echo get_text($row['td_name']); ?> <?php echo get_text($row['td_nick']); ?>님</label>
            <input type="checkbox" name="chk[]" value="<?php echo $i ?>" id="chk_<?php echo $i ?>">
        </td>
        
        <td headers="td_img_pc"   class="td_img_pc">
           <?php if ($row['td_img_pc'])
            //echo "<img src=\"/data/mainbanner/pc/{$row['td_img_pc']}\" width=\"150\">";
            echo "<img src=\"{$row['td_img_pc_thumb']}\" width=\"150\">";?>
        </td>
        <!--
        <td headers="td_img_mo"   class="td_img_mo">
            <?php if ($row['td_img_mo'])
            //echo "<img src=\"/data/mainbanner/mobile/{$row['td_img_mo']}\" width=\"150\">";
            echo "<img src=\"{$row['td_img_mo_thumb']}\" width=\"150\">";?>
        </td>
        -->
        <td headers="td_testyear"   class="td_testyear">
           <?php echo $row['td_testyear'];?>
        </td>
        <td headers="td_order"   class="td_order">
           <?php echo $row['td_order'];?>
        </td>
        <td headers="td_btn_text"   class="td_btn_text">
           <?php echo $row['td_btn_text'];?>
        </td>
        <td headers="td_list_mng"  class="td_mng td_mng_s"><?php echo $s_mod ?></td>
    </tr>

    <?php
    }
    if ($i == 0)
        echo "<tr><td colspan=\"".$colspan."\" class=\"empty_table\">자료가 없습니다.</td></tr>";
    echo "<tr><td colspan=\"".$colspan."\"  class=\"td_btn_text\">최종연도의 가장큰 순번 1건이 메인에 나옵니다.</td></tr>";
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

function fmaintestdatelist_submit(f)
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
    <input type="submit" name="act_button" id="act_button" value="선택삭제" onclick="$('#btnText').val(this.value);" class="btn btn_02">
    <?php if ($is_admin == 'super') { ?>
    <a href="./maintestdate_form.php" id="member_add" class="btn btn_01">시험일정 추가</a>
    <?php } ?>

</div>


</form>

<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, '?'.$qstr.'&amp;page='); ?>

<?php
include_once ('./admin.tail.php');
?>
