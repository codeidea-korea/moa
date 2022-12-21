<?php
$sub_menu = "450000";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

// $days = date("Y-m");
// if (!$stx1) 
//     $stx1 = $days;
// if (!$stx2)
//     $stx2 = $days;


$sql_common = " from {$g5['common_code_table']} a
                     , {$g5['common_type_table']} b
                      ";

$sql_search = " where (a.type_id = b.type_id)  ";
if ($stx || ($sfl && $stx1)) {
    $sql_search .= " and ( ";
    switch ($sfl) {
        case 'cd_name' :
        case 'cd_id' :
        case 'type_id' :
        
            $sql_search .= " ({$sfl} like '%{$stx}%') ";
            break;
        case 'type_name' :
            $sql_search .= " a.type_id in (SELECT x.type_id from {$g5['common_type_table']} x where ({$sfl} like '%{$stx}%')) ";
                break;
            
            
            
    }
    $sql_search .= " ) ";
}


if (!$sst) {
    $sst = "regdate";
    $sod = "desc";
}

$sql_order = " order by type_id asc, cd_name asc, idx desc ";

$sql = " select count(*) as cnt {$sql_common} {$sql_search} {$sql_order} ";


//echo nl2br($sql)."<BR>";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];

$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

// 멤버쉽 확인 ------------------------




$listall = '<a href="'.$_SERVER['SCRIPT_NAME'].'" class="ov_listall">전체목록</a>';

$g5['title'] = '지역코드관리';
include_once('./admin.head.php');

$sql = " select a.*, b.type_name {$sql_common} {$sql_search} {$sql_order} limit {$from_record}, {$rows} ";
$result = sql_query($sql);

//echo $sql."<BR><BR><BR>";

$colspan = ($is_membership) ? 17 : 16;
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
.sfl_ym {display:none;float:left;}
.btn {border:1px solid #777; background-color: #DDD; border-radius: 5px;}
.btn-info {border:1px solid #77A; background-color: #77F; border-radius: 5px; color:white; font-weight: bold}
</style>
<?php 
?>

<div class="boxContainer">

<div class="local_ov01 local_ov">
    <?php echo $listall ?>
    <span class="btn_ov01"><span class="ov_txt">총수 </span><span class="ov_num"> <?php echo number_format($total_count) ?></span></span>
</div>

<form id="fsearch" name="fsearch" class="local_sch01 local_sch" method="get">

<label for="sfl" class="sound_only">검색대상</label>
<select name="sfl" id="sfl" style="float:left;">
    <option value="type_name"<?php echo get_selected($_GET['sfl'], "type_name"); ?>>유형명</option>
    <option value="cd_name"<?php echo get_selected($_GET['sfl'], "cd_name"); ?>>코드명</option>
    <option value="cd_id"<?php echo get_selected($_GET['sfl'], "cd_id"); ?>>코드ID</option>
    <option value="type_id"<?php echo get_selected($_GET['sfl'], "type_id"); ?>>유형ID</option>
</select>

<label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
<input type="text" name="stx" value="<?php echo $stx ?>" id="stx"  class=" frm_input sfl_name">
    <input type="month" name="stx1" value="<?php echo $stx1 ?>" id="stx1" class=" frm_input sfl_ym"  readonly  size="20" maxlength="8">
    <span class="sfl_ym"></span><input type="month" name="stx2" value="<?php echo $stx2 ?>" id="stx2"  class=" frm_input sfl_ym" readonly  size="20" maxlength="8">
<input type="submit" class="btn_submit" value="검색">

</form>

<div class="local_desc01 local_desc">
    <p>

    </p>
</div>

<form name="fmemberlist" id="fmemberlist" action="./common_code_list_update.php" onsubmit="return fmemberlist_submit(this);" method="post">
<input type="hidden" name="sst" value="<?php echo $sst ?>">
<input type="hidden" name="sod" value="<?php echo $sod ?>">
<input type="hidden" name="sfl" value="<?php echo $sfl ?>">
<input type="hidden" name="stx" value="<?php echo $stx ?>">
<input type="hidden" name="page" value="<?php echo $page ?>">
<input type="hidden" name="token" value="">

<div class="tbl_head01 tbl_wrap">
    <table>
    <caption><?php echo $g5['title']; ?> 목록</caption>
    <thead>
    <tr>
        <th scope="col" id="cd_list_chk">
            <label for="chkall" class="sound_only">코드 전체</label>
            <input type="checkbox" name="chkall" value="1" id="chkall" onclick="check_all(this.form)">
        </th>
        <th scope="col" id="cd_list_no" ><?php echo subject_sort_link('idx') ?>순번</a></th>
        <th scope="col" id="cd_list_type" >코드유형</a></th>
        <th scope="col" id="cd_cd_id">코드ID</a></th>
        <th scope="col" id="cd_cd_name">코드명</th>
        <th scope="col" id="cd_cd_desc">코드설명</th>
       <!-- <th scope="col" id="cd_list_mobile">파일다운받기</th> -->

    </tr>
    </thead>
    <tbody>
    <?php
    for ($i=0; $row=sql_fetch_array($result); $i++) {
        $s_mod = '<a href="./common_code_form.php?'.$qstr.'&amp;w=u&amp;idx='.$row['idx'].'" class="btn btn_03">수정</a>';

        $idx = $row['idx'];

        $bg = 'bg'.($i%2);

       
    ?>

    <tr class="<?php echo $bg; ?>">
        <td headers="cd_list_chk" class="td_chk" >
            <input type="hidden" name="idx[<?php echo $i ?>]" value="<?php echo $row['idx'] ?>" id="no_<?php echo $i ?>">
            <label for="chk_<?php echo $i; ?>" class="sound_only"><?php echo get_text($row['type_name']); ?> <?php echo get_text($row['type_name']); ?></label>
            <input type="checkbox" name="chk[]" value="<?php echo $i ?>" id="chk_<?php echo $i ?>">
        </td>
        <td headers="cd_list_idx" class="td_chk">
            <?php echo $row['idx'] ?>
        </td>
        <td headers="cd_list_maker" class="td_num_c">
            <a href="./common_code_form.php?idx=<?php echo $row['idx'];?>&w=u"><?php echo $row['type_name'] ?></a>
        </td>
        <td headers="cd_list_type" class="td_mbcert sv_use">
            <a href="./common_code_form.php?idx=<?php echo $row['idx'];?>&w=u"><?php echo $row['cd_id'] ?></a>
        </td>
        <td headers="cd_list_type" class="td_mbcert sv_use">
            <a href="./common_code_form.php?idx=<?php echo $row['idx'];?>&w=u"><?php echo $row['cd_name'] ?></a>
        </td>
        <td headers="cd_list_car" class="td_ sv_use"><?php echo $row['cd_desc']; ?></td>
       
        
        
    </tr>

    <?php
    }
    if ($i == 0)
        echo "<tr><td colspan=\"".$colspan."\" class=\"empty_table\">자료가 없습니다.</td></tr>";
    ?>
    </tbody>
    </table>
</div>

<div class="btn_list01 btn_list">
	<input type="submit" name="act_button" value="선택삭제" onclick="document.pressed=this.value" class="btn btn_02">
</div>

<div class="btn_fixed_top">
	<?php if ($is_admin == 'super') { ?>
    <a href="./common_code_form.php" id="member_add" class="btn btn_01">지역코드등록하기</a>
    <?php } ?>

</div>

</form>

<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, '?'.$qstr.'&amp;page='); ?>

</div>

<script>
$(function() {
    
    

});
function fmemberlist_submit(f)
{
    if (!is_checked("chk[]")) {
        alert(document.pressed+" 하실 항목을 하나 이상 선택하세요.");
        return false;
    }

    if(document.pressed == "선택삭제") {
        if(!confirm("선택회원의 기본정보만 삭제되며 아이디, 닉네임 기록은 남습니다.\n\n선택한 자료를 정말 삭제하시겠습니까?")) {
            return false;
        }
    }

    if(document.pressed == "완전삭제") {
        if(!confirm("선택회원의 회원정보 자체를 DB에서 완전히 삭제합니다.\n\n선택한 자료를 정말 삭제하시겠습니까?")) {
            return false;
        }
    }

    return true;
}
</script>

<?php
include_once ('./admin.tail.php');
?>
