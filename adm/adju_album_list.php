<?php
$sub_menu = "750000";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

$sql_common = " from {$g5['adju_album_table']} ";

$sql_search = " where (1) ";
if ($stx) {
    $sql_search .= " and ( ";
    switch ($sfl) {
        case 'album_name' :
            $sql_search .= " ({$sfl} like '%{$stx}%') ";
            break;
    }
    $sql_search .= " ) ";
}

if (!$sst) {
    $sst = "regdate";
    $sod = "desc";
}


$sql = " select count(*) as cnt {$sql_common} {$sql_search} {$sql_order} ";
//recho $sql."<BR>";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

// 멤버쉽 확인 ------------------------




$listall = '<a href="'.$_SERVER['SCRIPT_NAME'].'" class="ov_listall">전체목록</a>';

$g5['title'] = '앨범입력';
include_once('./admin.head.php');

$sql = " select * {$sql_common} {$sql_search} {$sql_order} limit {$from_record}, {$rows} ";
$result = sql_query($sql);

$colspan = ($is_membership) ? 17 : 16;
?>

<div class="local_ov01 local_ov">
    <?php echo $listall ?>
    <span class="btn_ov01"><span class="ov_txt">총앨범수 </span><span class="ov_num"> <?php echo number_format($total_count) ?></span></span>
</div>

<form id="fsearch" name="fsearch" class="local_sch01 local_sch" method="get">

<label for="sfl" class="sound_only">검색대상</label>
<select name="sfl" id="sfl">
    <option value="no"<?php echo get_selected($_GET['sfl'], "album_name"); ?>>앨범명</option>
</select>
<label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
<input type="text" name="stx" value="<?php echo $stx ?>" id="stx" required class="required frm_input">
<input type="submit" class="btn_submit" value="검색">

</form>

<div class="local_desc01 local_desc">
    <p>

    </p>
</div>

<form name="fmemberlist" id="fmemberlist" action="./adju_album_list_update.php" onsubmit="return fmemberlist_submit(this);" method="post">
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
        <th scope="col" id="mb_list_chk">
            <label for="chkall" class="sound_only">앨범 전체</label>
            <input type="checkbox" name="chkall" value="1" id="chkall" onclick="check_all(this.form)">
        </th>
        <th scope="col" id="mb_list_no" ><?php echo subject_sort_link('mb_no') ?>No</a></th>
        <th scope="col" id="mb_list_id" >앨범명(제작사)</a></th>
        <th scope="col" id="mb_list_name">CD출고가</a></th>
        <th scope="col" id="mb_list_tel">BEP</th>
        <th scope="col" id="mb_list_tel">정산 요율</th>
        <th scope="col" id="mb_list_mobile">피지컬 요율</th>

    </tr>
    </thead>
    <tbody>
    <?php
    for ($i=0; $row=sql_fetch_array($result); $i++) {
        $s_mod = '<a href="./adju_album_form.php?'.$qstr.'&amp;w=u&amp;no='.$row['no'].'" class="btn btn_03">수정</a>';

        $no = $row['no'];

        $bg = 'bg'.($i%2);

       
    ?>

    <tr class="<?php echo $bg; ?>">
        <td headers="mb_list_chk" class="td_chk" >
            <input type="hidden" name="no[<?php echo $i ?>]" value="<?php echo $row['no'] ?>" id="no_<?php echo $i ?>">
            <label for="chk_<?php echo $i; ?>" class="sound_only"><?php echo get_text($row['album_name']); ?> <?php echo get_text($row['album_name']); ?></label>
            <input type="checkbox" name="chk[]" value="<?php echo $i ?>" id="chk_<?php echo $i ?>">
        </td>
        <td headers="mb_list_id" class="td_name sv_use">
            <?php echo $row['no'] ?>
        </td>
        <td headers="mb_list_id" class="td_name sv_use">
            <a href="./adju_album_form.php?no=<?php echo $row['no'];?>&w=u"><?php echo $row['album_name'] ?></a>
        </td>
        <td headers="mb_list_name" class="td_mbname"><?php echo get_text($row['cd_price']); ?></td>
        <td headers="mb_list_nick" class="td_name sv_use"><?php echo $row['bep'];?></td>
        <td headers="mb_list_tel" class="td_tel"><?php echo get_text($row['royalty_rate']); ?></td>
        <td headers="mb_list_mobile" class="td_tel"><?php echo get_text($row['physical_rate']); ?></td>
        
        
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
    <!--
    <input type="submit" name="act_button" value="선택수정" onclick="document.pressed=this.value" class="btn btn_02">
-->
    <?php if ($is_admin == 'super') { ?>
    <a href="./adju_album_form.php" id="member_add" class="btn btn_01">앨범 등록하기</a>
    <?php } ?>

</div>

</form>

<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, '?'.$qstr.'&amp;page='); ?>

<script>
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
