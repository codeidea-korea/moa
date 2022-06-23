<?php
$sub_menu = "300900";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');


$sql_common = " from {$g5['common_type_table']} ";
$types = isset($_REQUEST['types'])?$_REQUEST['types']:"";
if (!$types)
    $sql_search = " where (1) ";

if ($stx) {
    $sql_search .= " and ( ";
    switch ($sfl) {
        case 'type_id' :
            $sql_search .= " ({$sfl} = '{$stx}') ";
            break;
        default :
            $sql_search .= " ({$sfl} like '%{$stx}%') ";
            break;
    }
    $sql_search .= " ) ";
}

if (!$sst) {
    $sst  = " type_order ";
    $sod = "desc";
}
$sql_order = " order by {$sst} {$sod} ";

$sql = " select count(*) as cnt
            {$sql_common}
            {$sql_search}
            {$sql_order} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sql = " select *
            {$sql_common}
            {$sql_search}
            {$sql_order}
            limit {$from_record}, {$rows} ";
$result = sql_query($sql);

//echo nl2br($sql)."<BR><BR>";

$listall = '<a href="'.$_SERVER['SCRIPT_NAME'].'" class="ov_listall">전체목록</a>&nbsp;';

$mb = array();
if ($sfl == 'mb_id' && $stx)
    $mb = get_member($stx);

$g5['title'] = '코드유형관리';
include_once ('./admin.head.php');

$colspan = 9;


if (strstr($sfl, "mb_id"))
    $mb_id = $stx;
else
    $mb_id = "";
?>

<div class="local_ov01 local_ov">
    <?php echo $listall ?>
    <span class="btn_ov01"><span class="ov_txt">전체 </span><span class="ov_num"> <?php echo number_format($total_count) ?> 건 </span></span>
    
</div>

<form name="fsearch" id="fsearch" class="local_sch01 local_sch" method="get">
<label for="sfl" class="sound_only">검색대상</label>
<select name="sfl" id="sfl">
    <option value="type_id"<?php echo get_selected($_GET['sfl'], "type_id"); ?>>유형ID</option>
    <option value="type_name"<?php echo get_selected($_GET['sfl'], "type_name"); ?>>유형명</option>
</select>
<label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
<input type="text" name="stx" value="<?php echo $stx ?>" id="stx" required class="required frm_input">
<input type="submit" class="btn_submit" value="검색">
</form>

<form name="fpointlist" id="fpointlist" method="post" action="./common_type_list_delete.php" onsubmit="return fpointlist_submit(this);">
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
        <th scope="col">
            <label for="chkall" class="sound_only">유형 전체</label>
            <input type="checkbox" name="chkall" value="1" id="chkall" onclick="check_all(this.form)">
        </th>
        <th scope="col"><?php echo subject_sort_link('mb_id') ?>유형 ID</a></th>
        <th scope="col"><?php echo subject_sort_link('type_name') ?>유형 명</a></th>
        <th scope="col"><?php echo subject_sort_link('type_desc') ?>설명 내용</a></th>
        <th scope="col">코드순서</th>
    </tr>
    </thead>
    <tbody>
    <?php
    for ($i=0; $row=sql_fetch_array($result); $i++) {
        $expr = '';

        $bg = 'bg'.($i%2);
    ?>

    <tr class="<?php echo $bg; ?>">
        <td class="td_chk">
            <input type="hidden" name="type_id[<?php echo $i ?>]" value="<?php echo $row['type_id'] ?>" id="type_id_<?php echo $i ?>">
            <label for="chk_<?php echo $i; ?>" class="sound_only"><?php echo $row['type_id'] ?> 내역</label>
            <input type="checkbox" name="chk[]" value="<?php echo $i ?>" id="chk_<?php echo $i ?>">
        </td>
        <td class="td_left"><a href="?sfl=type_id&amp;stx=<?php echo $row['type_id'] ?>"><?php echo $row['type_id'] ?></a></td>
        <td class="td_left"><a href="?sfl=type_id&amp;stx=<?php echo $row['type_id'] ?>"><?php echo get_text($row['type_name']); ?></a></td>
        <td class="td_left"><?php echo $link1 ?><?php echo $row['type_desc'] ?><?php echo $link2 ?></td>
        <td class="td_left"><a href="?sfl=type_id&amp;stx=<?php echo $row['type_id'] ?>"><?php echo get_text($row['cd_order']); ?></a></td>
    </tr>

    <?php
    }

    if ($i == 0)
        echo '<tr><td colspan="'.$colspan.'" class="empty_table">자료가 없습니다.</td></tr>';
    ?>
    </tbody>
    </table>
</div>


<?php // echo $sql."<BR>";
$w = '';
if ($sfl == 'type_id') {
    $type_id = $stx;
    $w = "u";
}

$sql = "SELECT * from {$g5['common_type_table']} where type_id = '{$type_id}' ";
$cd = sql_fetch($sql);

?>


<div class="btn_fixed_top">
    <input type="submit" name="act_button" value="선택삭제" onclick="document.pressed=this.value" class="btn btn_02">
</div>

</form>

<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, "{$_SERVER['SCRIPT_NAME']}?$qstr&amp;page="); ?>

<section id="point_mng">
    <h2 class="h2_frm"> 코드유형 추가 설정</h2>

    <form name="fpointlist2" method="post" id="fpointlist2" action="./common_type_list_update.php" autocomplete="off">
    <input type="hidden" name="w" value="<?php echo $w ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="sst" value="<?php echo $sst ?>">
    <input type="hidden" name="sod" value="<?php echo $sod ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">
    <input type="hidden" name="token" value="<?php echo $token ?>">
    <input type="hidden" name="types" value="<?php echo $types ?>">

    <div class="tbl_frm01 tbl_wrap">
        <table>
        <colgroup>
            <col class="grid_4">
            <col>
        </colgroup>
        <tbody>
        <tr>
            <th scope="row"><label for="type_id">코드유형<strong class="sound_only">필수</strong></label></th>
            <td>
                <input name="type_id" id="type_id" id="type_id" required  class="required frm_input"  
                value="<?php echo $cd['type_id']?>">
            </td>
        </tr>
        <tr>
            <th scope="row"><label for="type_name"><span id="cdtype">코드유형 명</span><strong class="sound_only">필수</strong></label></th>
            <td>
                <input type="text" name="type_name" id="type_name" required class="required frm_input"  value="<?php echo $cd['type_name']?>"></td>
        </tr>
        <tr>
            <th scope="row"><label for="type_desc">설명<strong class="sound_only">필수</strong></label></th>
            <td>
                <input type="text" name="type_desc" id="type_desc"  class=" frm_input" value="<?php echo $cd['type_desc'];?>" size="80">
            </td>
        </tr>
       <tr>
            <th scope="row"><label for="type_order">순서<strong class="sound_only">필수</strong></label></th>
            <td>
                <input type="text" name="type_order" id="type_order"  class=" frm_input" value="<?php echo $cd['type_order'];?>">
            </td>
        </tr>
        
        </tbody>
        </table>
    </div>

    <div class="btn_confirm01 btn_confirm">
        <input type="submit" value="확인" class="btn_submit btn">
    </div>

    </form>

</section>

<script>
function fpointlist_submit(f)
{
    if (!is_checked("chk[]")) {
        alert(document.pressed+" 하실 항목을 하나 이상 선택하세요.");
        return false;
    }

    if(document.pressed == "선택삭제") {
        if(!confirm("선택한 자료를 정말 삭제하시겠습니까?")) {
            return false;
        }
        f.action= './common_type_list_delete.php';
    }

    return true;
}
</script>

<?php
include_once ('./admin.tail.php');
?>
