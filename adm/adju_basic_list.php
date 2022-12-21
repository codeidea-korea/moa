<?php
$sub_menu = "750300";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

if ($sfl == 'album')   {
    $view_column = " sum(a.admin_adju) admin_sum, ";
    $sql_add = " and y.album_company = x.album_company ";
}
else if ($sfl == 'singer')   {
    $view_column = " x.singer, ";
    $sql_add = " and y.singer = x.singer "; 
}
else if ($sfl == '')   {
    $view_column = " sum(a.admin_adju) admin_sum, 
                    x.singer, ";
    $sql_add = " and y.album_company = x.album_company ";
}


if ($sfl == "singer") {
    $orders = "singer";
}
if ($sfl == "album") {
    $orders = "album_company";
}

if (!$orders)
    $orders = "album_company";

$sql_order = " order by {$orders} asc ";

$sql_common_str = getSqlCommonStr($sql_order, $sfl);
$sql_common = " FROM ( {$sql_common_str } ) xx ";

$sql_search = " where (1) ";
if ($stx) {
    switch ($sfl) {
        case 'album' :
            $sql_search .= " and instr(album_company,'{$stx}') ";
            break;
        case 'singer' :
            $sql_search .= " and instr(singer,'{$stx}') ";
            break;
    }
}


$sql = " select count(*) as cnt {$sql_common} {$sql_search} {$sql_order} ";

$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

// 멤버쉽 확인 ------------------------




$listall = '<a href="'.$_SERVER['SCRIPT_NAME'].'" class="ov_listall">전체목록</a>';

$g5['title'] = '정산 기본자료 입력';
include_once('./admin.head.php');
    
    $sql = " SELECT
                
                xx.* 
                 {$sql_common} 
                 {$sql_search} 
                 
                 
                limit {$from_record}, {$rows} ";

//if ($member['mb_id'] == 'pletho')     echo nl2br($sql)."<BR><BR>";
if ($member['mb_id'] == 'pletho'
    || $_SERVER['REMOTE_ADDR']  == "218.38.13.130"
) {
    //echo "query : <br>".nl2br($sql)."<BR>";
//echo nl2br($sql)."<BR>";
}

    $result = sql_query($sql);

$colspan = ($is_membership) ? 11 : 10;
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
<div class="local_ov01 local_ov">
    <?php echo $listall ?>
    <span class="btn_ov01"><span class="ov_txt">총앨범수 </span><span class="ov_num"> <?php echo number_format($total_count) ?></span></span>
</div>

<form id="fsearch" name="fsearch" class="local_sch01 local_sch" method="get">

<label for="sfl" class="sound_only">검색대상</label>
<select name="sfl" id="sfl">
    <option value="" <?php echo get_selected($_GET['sfl'], ""); ?>>-전체-</option>
    <option value="album" <?php echo get_selected($_GET['sfl'], "album"); ?>>제작사</option>
    <option value="singer" <?php echo get_selected($_GET['sfl'], "singer"); ?>>가창자</option>
</select>
<label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
<input type="text" name="stx" value="<?php echo $stx ?>" id="stx"  class=" frm_input">
<input type="submit" class="btn_submit" value="검색">

</form>

<div class="local_desc01 local_desc">
    <p>
        <a href="./adju_basic_list_exceldown.php?<?php echo $_SERVER['QUERY_STRING'];?>" class="btn btn-info">엑셀자료 다운로드</a>
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
        <th scope="col" id="mb_list_chk"  rowspan="2">
            <label for="chkall" class="sound_only">앨범 전체</label>
            <input type="checkbox" name="chkall" value="1" id="chkall" onclick="check_all(this.form)">
        </th>
        <th scope="col" id="no" rowspan="2">No</th>
        <th scope="col" id="adju_ym"  rowspan="2">정산월</th>
        <?php 
        if ($sfl <> 'album')   {
        ?> 
        <th scope="col" id="singer" rowspan="2">가창자</th>
        <?php } ?>
        <?php 
        if ($sfl <> 'singer')   {
        ?> 
        <th scope="col" id="album_company"  rowspan="2">앨범명(제작사)</th>
        <?php } ?>
        <th scope="col" id="digital_royalty"  colspan="2">디지털 로열티</th>
        <?php 
        if ($sfl <> 'singer') {?>
        <th scope="col" id="admin_adju" rowspan="2">관리자 기본정산용</th>
        <?php } ?>
        <th scope="col" id="adju_ym_sum" rowspan="2">당월 합계</th>
        <th scope="col" id="adju_sum" rowspan="2">누적합계</th>

    </tr>
        <th scope="col" id="in_royalty">국내로열티</th>
        <th scope="col" id="out_royalty">해외로열티</th>
    <tr>
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
        <td headers="mb_list_id" class="td_num_c sv_use">
            <?php echo $row['no'] ?>
        </td>
        <td headers="mb_list_id" class="td_num_c sv_use">
            <?php echo $row['adju_ym'] ?>
        </td>
        <?php 
        if ($sfl <> 'album')   {
        ?>
        <td headers="mb_list_id" class="td_mbcert sv_use">
            <?php echo $row['singer'] ?>
        </td>
        <?php } ?>
        <?php 
        if ($sfl <> 'singer')   {
        ?> 
        <td headers="mb_list_id" class="td_mbcert sv_use">
            <?php echo $row['album_company'] ?>
        </td>
        <?php } ?>
        <td headers="mb_list_name" class="td_price"><?php echo number_format($row['in_royalty']); ?></td>
        <td headers="mb_list_name" class="td_price"><?php echo number_format($row['out_royalty']); ?></td>
        <?php 
        if ($sfl <> 'singer')   {
        ?>
        <td headers="mb_list_name" class="td_price "><?php echo $row['admin_adju'];?></td>
        <?php } ?>
        <td headers="mb_list_tel" class="td_price"><?php echo number_format($row['adju_ym_sum']); ?></td>
        <td headers="mb_list_mobile" class="td_price"><?php echo number_format($row['adju_sum']); ?></td>
        
        
    </tr>

    <?php
    }
    if ($i == 0)
        echo "<tr><td colspan=\"".$colspan."\" class=\"empty_table\">자료가 없습니다.</td></tr>";
    ?>
    </tbody>
    </table>
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
