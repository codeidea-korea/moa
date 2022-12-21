<?php
$sub_menu = "100410";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');
 
$sql_common = " from {$g5['itemvod_table']} ";

$sql_search = " where (1) ";

if (!$sst) {
    $sst = "mv_datetime";
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

$g5['title'] = '강의 상세 공통항목 관리';
include_once('./admin.head.php');

$sql = " select * {$sql_common} {$sql_search} {$sql_order} limit {$from_record}, {$rows} ";
$result = sql_query($sql);

$colspan = 16;
?>


<form name="fmemberlist" id="fmemberlist" action="./itemvod_list_update.php" onsubmit="return fitemvodlist_submit(this);" method="post">
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
        <th scope="col" id="mv_list_chk"  >
            <label for="chkall" class="sound_only"> 전체</label>
            <input type="checkbox" name="chkall" value="1" id="chkall" onclick="check_all(this.form)">
        </th>
        
        <!--<th scope="col" rowspan="2" id="mv_list_cert"><?php echo subject_sort_link('mv_certify', '', 'desc') ?>이미지PC</a></th>
        <th scope="col" id="mv_list_mailc"><?php echo subject_sort_link('mv_email_certify', '', 'desc') ?>이미지Mobile</a></th>
    -->
        <th scope="col" id="mv_list_url"><?php echo subject_sort_link('mv_url', '', 'desc') ?>VOD URL</a></th>
        <th scope="col" id="mv_list_text" ><?php echo subject_sort_link('mv_btn_text') ?>VOD 설명</a></th>
        
        <th scope="col" rowspan="2" id="mv_list_mng">관리</th>
    </tr>
    
    </thead>
    <tbody>
    <?php
    for ($i=0; $row=sql_fetch_array($result); $i++) {
        
        if ($is_admin == 'group') {
            $s_mod = '';
        } else {
            $s_mod = '<a href="./itemvod_form.php?'.$qstr.'&amp;w=u&amp;mv_no='.$row['mv_no'].'" class="btn btn_03">수정</a>';
        }

        $leave_date = $row['mv_leave_date'] ? $row['mv_leave_date'] : date('Ymd', G5_SERVER_TIME);
        $intercept_date = $row['mv_intercept_date'] ? $row['mv_intercept_date'] : date('Ymd', G5_SERVER_TIME);

        $mv_nick = get_sideview($row['mv_id'], get_text($row['mv_nick']), $row['mv_email'], $row['mv_homepage']);

        $mv_id = $row['mv_id'];
        $leave_msg = '';
        $intercept_msg = '';
        $intercept_title = '';
        if ($row['mv_leave_date']) {
            $mv_id = $mv_id;
            $leave_msg = '<span class="mv_leave_msg">탈퇴함</span>';
        }
        else if ($row['mv_intercept_date']) {
            $mv_id = $mv_id;
            $intercept_msg = '<span class="mv_intercept_msg">차단됨</span>';
            $intercept_title = '차단해제';
        }
        if ($intercept_title == '')
            $intercept_title = '차단하기';

        $address = $row['mv_zip1'] ? print_address($row['mv_addr1'], $row['mv_addr2'], $row['mv_addr3'], $row['mv_addr_jibeon']) : '';

        $bg = 'bg'.($i%2);

        switch($row['mv_certify']) {
            case 'hp':
                $mv_certify_case = '휴대폰';
                $mv_certify_val = 'hp';
                break;
            case 'ipin':
                $mv_certify_case = '아이핀';
                $mv_certify_val = '';
                break;
            case 'admin':
                $mv_certify_case = '관리자';
                $mv_certify_val = 'admin';
                break;
            default:
                $mv_certify_case = '&nbsp;';
                $mv_certify_val = 'admin';
                break;
        }
    ?>

    <tr class="<?php echo $bg; ?>">
        <td headers="mv_list_chk" class="td_chk" >
            <input type="hidden" name="mb_id[<?php echo $i ?>]" value="<?php echo $row['mb_id'] ?>" id="mb_id_<?php echo $i ?>">
            <input type="hidden" name="mv_no[<?php echo $i ?>]" value="<?php echo $row['mv_no'] ?>" id="mv_no _<?php echo $i ?>">
            <label for="chk_<?php echo $i; ?>" class="sound_only"><?php echo get_text($row['mv_name']); ?> <?php echo get_text($row['mv_nick']); ?>님</label>
            <input type="checkbox" name="chk[]" value="<?php echo $i ?>" id="chk_<?php echo $i ?>">
        </td>
        
        <!--
        <td headers="mv_img_pc"   class="mv_img_pc">
           <?php if ($row['mv_img_pc'])
            //echo "<img src=\"/data/mainbanner/pc/{$row['mv_img_pc']}\" width=\"150\">";
            echo "<img src=\"{$row['mv_img_pc_thumb']}\" width=\"150\">";?>
        </td>
        <td headers="mv_img_mo"   class="mv_img_mo">
            <?php if ($row['mv_img_mo'])
            //echo "<img src=\"/data/mainbanner/mobile/{$row['mv_img_mo']}\" width=\"150\">";
            echo "<img src=\"{$row['mv_img_mo_thumb']}\" width=\"150\">";?>
        </td>
    -->
        <td headers="mv_url"   class="mv_url">
           <?php echo $row['mv_url'];?>
        </td>
        <td headers="mv_btn_text"   class="td_btn_text">
           <?php echo $row['mv_btn_text'];?>
        </td>
        <td headers="mv_list_mng"  class="td_mng td_mng_s"><?php echo $s_mod ?></td>
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

function fitemvodlist_submit(f)
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
    <a href="./itemvod_form.php" id="member_add" class="btn btn_01">VOD추가</a>
    <?php } ?>

</div>


</form>

<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, '?'.$qstr.'&amp;page='); ?>

<?php
include_once ('./admin.tail.php');
?>
