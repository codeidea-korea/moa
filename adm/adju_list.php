<?php
$sub_menu = "750200";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

$days = date("Y-m");
if (!$stx1) 
    $stx1 = $days;
if (!$stx2)
    $stx2 = $days;


$sql_common = " from {$g5['adju_basic_table']} a
                left join {$g5['album_table']} b on (a.album_no = b.no)
                      ";

$sql_search = " where (1) ";
if ($stx || ($sfl && $stx1)) {
    $sql_search .= " and ( ";
    switch ($sfl) {
        case 'album_name' :
            $sql_search .= " ({$sfl} like '%{$stx}%') ";
            break;
        case 'adju_ym' :
            $sql_search .= " ( {$sfl}  between '{$stx1}' and '{$stx2}') ";
            break;
    }
    $sql_search .= " ) ";
}


if (!$sst) {
    $sst = "regdate";
    $sod = "desc";
}

$sql_order = " order by adju_ym desc, album_name asc, no desc ";

$sql = " select count(*) as cnt {$sql_common} {$sql_search} {$sql_order} ";
//echo $sql."<BR>";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];

$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

// 멤버쉽 확인 ------------------------




$listall = '<a href="'.$_SERVER['SCRIPT_NAME'].'" class="ov_listall">전체목록</a>';

$g5['title'] = '정산등록';
include_once('./admin.head.php');

$sql = " select a.*, b.album_name {$sql_common} {$sql_search} {$sql_order} limit {$from_record}, {$rows} ";
$result = sql_query($sql);

$colspan = ($is_membership) ? 17 : 16;
?>
    <script src="https://cdn.rawgit.com/digitalBush/jquery.maskedinput/1.4.1/dist/jquery.maskedinput.min.js"></script>
    <link href="https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css" rel="stylesheet" type="text/css" />    
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>

    <link href="/css/MonthPicker.css" rel="stylesheet" type="text/css" />
    <script src="/js/MonthPicker.js"></script>
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
<div class="local_ov01 local_ov">
    <?php echo $listall ?>
    <span class="btn_ov01"><span class="ov_txt">총앨범수 </span><span class="ov_num"> <?php echo number_format($total_count) ?></span></span>
</div>

<form id="fsearch" name="fsearch" class="local_sch01 local_sch" method="get">

<label for="sfl" class="sound_only">검색대상</label>
<select name="sfl" id="sfl" style="float:left;">
    <option value="adju_ym"<?php echo get_selected($_GET['sfl'], "adju_ym"); ?>>기간</option>
    <option value="album_name"<?php echo get_selected($_GET['sfl'], "album_name"); ?>>앨범명</option>
</select>

<label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
<input type="text" name="stx" value="<?php echo $stx ?>" id="stx"  class=" frm_input sfl_name">
    <input type="month" name="stx1" value="<?php echo $stx1 ?>" id="stx1" class=" frm_input sfl_ym"  readonly  size="20" maxlength="8">
    <span class="sfl_ym">~</span><input type="month" name="stx2" value="<?php echo $stx2 ?>" id="stx2"  class=" frm_input sfl_ym" readonly  size="20" maxlength="8">
<input type="submit" class="btn_submit" value="검색">

</form>

<div class="local_desc01 local_desc">
    <p>

    </p>
</div>

<form name="fmemberlist" id="fmemberlist" action="./adju_list_update.php" onsubmit="return fmemberlist_submit(this);" method="post">
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
        <th scope="col" id="mb_list_id" >정산월</a></th>
        <th scope="col" id="mb_list_id" >앨범명(제작사)</a></th>
        <th scope="col" id="mb_list_name">매출수량</a></th>
        <th scope="col" id="mb_list_tel">출고가</th>
        <th scope="col" id="mb_list_tel">정산 요율</th>
        <th scope="col" id="mb_list_mobile">피지컬 요율</th>
        <th scope="col" id="mb_list_mobile">파일다운받기</th>

    </tr>
    </thead>
    <tbody>
    <?php
    for ($i=0; $row=sql_fetch_array($result); $i++) {
        $s_mod = '<a href="./adju_form.php?'.$qstr.'&amp;w=u&amp;no='.$row['no'].'" class="btn btn_03">수정</a>';

        $no = $row['no'];

        $bg = 'bg'.($i%2);

       
    ?>

    <tr class="<?php echo $bg; ?>">
        <td headers="mb_list_chk" class="td_chk" >
            <input type="hidden" name="no[<?php echo $i ?>]" value="<?php echo $row['no'] ?>" id="no_<?php echo $i ?>">
            <label for="chk_<?php echo $i; ?>" class="sound_only"><?php echo get_text($row['album_name']); ?> <?php echo get_text($row['album_name']); ?></label>
            <input type="checkbox" name="chk[]" value="<?php echo $i ?>" id="chk_<?php echo $i ?>">
        </td>
        <td headers="mb_list_id" class="td_chk">
            <?php echo $row['no'] ?>
        </td>
        <td headers="mb_list_id" class="td_num_c">
            <a href="./adju_form.php?no=<?php echo $row['no'];?>&w=u"><?php echo $row['adju_ym'] ?></a>
        </td>
        <td headers="mb_list_id" class="td_mbcert sv_use">
            <a href="./adju_form.php?no=<?php echo $row['no'];?>&w=u"><?php echo $row['album_name'] ?></a>
        </td>
        <td headers="mb_list_name" class="td_price sv_use"><?php echo number_format($row['sale_quantity']); ?></td>
        <td headers="mb_list_nick" class="td_price sv_use"><?php echo number_format($row['cd_price']);?>원</td>
        <td headers="mb_list_tel" class="td_num_c"><?php echo get_text($row['royalty_rate']); ?>%</td>
        <td headers="mb_list_mobile" class="td_num_c"><?php echo get_text($row['physical_rate']); ?>%</td>
        <td headers="mb_list_mobile" class="td_category1">
            <?php if ($row['filename']) {?>
                <a href="<?php echo $row['dirname'].$row['filename'];?>" class="btn btn-info">엑셀파일다운로드</a>
            <?php } ?>
        </td>
        
        
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
    <a href="./adju_form.php" id="member_add" class="btn btn_01">정산등록하기</a>
    <?php } ?>

</div>

</form>

<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, '?'.$qstr.'&amp;page='); ?>

<script>
$(function() {
    $(".sfl_name").hide();
    $(".sfl_ym").show();
    $('#stx1').MonthPicker({ 
        Button: false,
        MonthFormat: 'M,yy', // Short month name, Full year.

    });
    $('#stx2').MonthPicker({ 
        Button: false,
        MonthFormat: 'M,yy', // Short month name, Full year.

    });
    $("#sfl").change(function() {
        var x = $("#sfl option:selected").val();
        if (x == "album_name") {
            $(".sfl_name").show();
            $(".sfl_ym").hide();

        }
        else if (x == "adju_ym") {
            $(".sfl_name").hide();
            $(".sfl_ym").show();
        }
    });

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
