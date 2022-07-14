<?php
$sub_menu = '400410';
include_once('./_common.php');

auth_check($auth[$sub_menu], "r");

$g5['title'] = '모임관리';
include_once (G5_ADMIN_PATH.'/admin.head.php');

// 카테고리
$ca_list  = '<option value="">선택</option>'.PHP_EOL;
$sql = " select * from {$g5['g5_shop_category_table']} ";
if ($is_admin != 'super')
    $sql .= " where ca_id like '10%' and ca_mb_id = '{$member['mb_id']}' ";
else
    $sql .= " where ca_id like '10%' ";
$sql .= " order by ca_order, ca_id ";
//echo $sql."<BR>";
$result = sql_query($sql);
for ($i=0; $row=sql_fetch_array($result); $i++)
{
    $len = strlen($row['ca_id']) / 2 - 1;
    $nbsp = '';
    for ($i=0; $i<$len; $i++) {
        $nbsp .= '&nbsp;&nbsp;&nbsp;';
    }
    $ca_list .= '<option value="'.$row['ca_id'].'">'.$nbsp.$row['ca_name'].'</option>'.PHP_EOL;
}

$where = " and ";
$sql_search = "";
if ($stx != "") {
    $sql_search .= " $where (b.mb_name like '%$stx%' or c.it_name like '%$stx%') ";
    $where = " and ";
    if ($save_stx != $stx)
        $page = 1;
}

//if ($sfl == "")  $sfl = "it_name";

if($offline != '') {
    $sql_search .= " AND moa_onoff = '" . $offline . "'";
}

if($moa_kind != '') {
    $sql_search .= " AND a.moa_form = '" . $moa_kind . "' ";
}


if ($sch_startdt && $sch_enddt) {
    $stdt = str_replace("-","",$sch_startdt);
    $eddt = str_replace("-","",$sch_enddt);
    $sql_search .= " AND (a.day between '{$sch_startdt}' and '{$sch_enddt}') ";
}
else if ($sch_startdt && !$sch_enddt) {
    $sql_search .= " AND (a.day between '{$sch_startdt}') ";
}

$sql_common = " from g5_member b join deb_class_item a
                    on b.mb_id = a.mb_id join g5_shop_item c
                    on a.it_id = c.it_id join g5_write_class d
                    on c.it_2 = d.wr_id";
$sql_common .= $sql_search;

// 테이블의 전체 레코드수만 얻음
$sql = " select count(*) as cnt " . $sql_common;
$row = sql_fetch($sql);
$total_count = $row['cnt'];
$rows = $page_su ? $page_su : 10;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

if (!$sst) {
    $sst  = "a.it_id";
    $sod = "desc";
}
$sql_order = "order by $sst $sod";


$sql  = " select *
           $sql_common
           $sql_order
           limit $from_record, $rows ";
$result = sql_query($sql);
//$qstr  = $qstr.'&amp;sca='.$sca.'&amp;page='.$page;
$qstr  = $qstr.'&amp;sca='.$sca.'&moa_kind='. $moa_kind.'&offline='.$offline.'&amp;page='.$page.'&amp;save_stx='.$stx.'&sch_startdt='.$sch_startdt.'&sch_enddt='.$sch_enddt;

$listall = '<a href="'.$_SERVER['SCRIPT_NAME'].'" class="ov_listall">전체목록</a>';

$rday = getSearchDays();
?>

<?php
//html 팝업
include_once(G5_ADMIN_PATH.'/_add/pop.cancel-class.php'); //폐강처리
?>

<div class="boxContainer">

<form action="/adm/shop_admin/itemmoa_list.php" method="get">
<div class="data-search-wrap fx-wrap label120">
	<div class="fx-list">
		<div class="fx-list-label">검색</div>
		<div class="fx-list-con">
<!--			<select name="sfl">-->
<!--				<option value="mb_name" --><?php //echo $sca == 'mb_name' ? 'selected' : ''; ?><!--호스트명</option>-->
<!--				<option value="it_name" --><?php //echo $sca == 'it_name' ? 'selected' : ''; ?><!--모임명</option>-->
<!--				<option value="it_id" --><?php //echo $sca == 'it_id' ? 'selected' : ''; ?><!--모임ID</option>-->
<!--			</select>-->
			<input type="text" name="stx" value="<?php echo $stx; ?>" class="span160" placeholder="모임명/호스트명"><!--<a href="#" class="btn reverse span70">조회</a>-->
		</div>
	</div>
	<div class="fx-list">
		<div class="fx-list-label">모임 유형</div>
		<div class="fx-list-con">
		    <select name="offline" class="span160">
                <option value="">전체</option>
                <option value="온라인"<?php echo $offline == '온라인' ? 'selected' : '' ?>>온라인</option>
                <option value="오프라인"<?php echo $offline == '오프라인' ? 'selected' : '' ?>>오프라인</option>
            </select>
            <!--			<select class="">				-->
            <!--				<option>N회차</option>-->
            <!--				<option>1회차</option>-->
            <!--			</select>-->
            <select class="span160" name="moa_kind">
                <option value="">전체</option>
                <option value="자율형" <?php echo $moa_kind == '자율형' ? 'selected' : ''; ?>>자율형 모임</option>
				<option value="고정형" <?php echo $moa_kind == '고정형' ? 'selected' : ''; ?>>고정형 모임</option>
			</select>			
			<!--<a href="#" class="btn reverse span70">조회</a>-->
		</div>
	</div>
	<div class="fx-list">
        <div class="fx-list-label">모임 날짜</div>
        <div class="fx-list-con">
            <label class="inp-wrap label-inline"><input type="text" id="sch_startdt"  name="sch_startdt" value="<?php echo $sch_startdt;?>" class="span160 datepicker" placeholder="날짜 선택"><span class="label"></span></label>
            <span>~</span>
            <label class="inp-wrap label-inline"><input type="text" id="sch_enddt" name="sch_enddt" value="<?php echo $sch_enddt;?>" class="span160 datepicker" placeholder="날짜 선택"><span class="label"></span></label>
            <div class="datepickContainer small">
                <a href="javascript:" onclick="setdate(1);"  class="dl todays">오늘</a>
                <a href="javascript:" onclick="setdate(2);"  class="dl month1">1개월</a>
                <a href="javascript:" onclick="setdate(3);"  class="dl month6">6개월</a>
                <a href="javascript:" onclick="setdate(4);"  class="dl year1 ">1년</a>
                <a href="javascript:" onclick="setdate(5);"  class="dl year5">5년</a>
                <a href="javascript:" onclick="setdate(0);"  class="dl allday">전체</a>
            </div>
            <script>
                var today = "<?php echo $rday['today'];?>";
                var month1ago = "<?php echo $rday['month1ago'];?>";
                var month6ago = "<?php echo $rday['month6ago'];?>";
                var year1ago = "<?php echo $rday['year1ago'];?>";
                var year5ago = "<?php echo $rday['year5ago'];?>";

                function setdate(type) {
                    var sdt = today;
                    var edt = today;
                    $(".dl").removeClass("active");
                    switch(type) {
                        case 1 :
                            sdt = today;
                            $(".todays").addClass("active");
                            break;
                        case 2 :
                            sdt = month1ago;
                            $(".month1").addClass("active");
                            break;
                        case 3 :
                            sdt = month6ago;
                            $(".month6").addClass("active");
                            break;
                        case 4 :
                            sdt = year1ago;
                            $(".year1").addClass("active");
                            break;
                        case 5 :
                            sdt = year5ago;
                            $(".year5").addClass("active");
                            break;
                        default :
                            sdt = '2022-01-01';
                            edt = today;
                            $(".allday").addClass("active");
                            break;
                    }
                    $("#sch_startdt").val(sdt);
                    $("#sch_enddt").val(edt);
                }
                $(function() {
                    <?php if(!$sch_startdt) { ?>
                        setdate(0);
                    <?php } ?>
                });
            </script>
        </div>
	</div>
	<div class="btnSet">
		<button type="submit" class="btnSearch">조회</button>
		<button type="button" class="btnReset">초기화</button>
	</div>
</div>
</form>

<div class="local_ov01 local_ov none">
    <?php echo $listall; ?>
    <span class="btn_ov01"><span class="ov_txt">등록된 모임</span><span class="ov_num"> <?php echo $total_count; ?>건</span></span>
</div>

<form name="flist" class="local_sch01 local_sch none">
<input type="hidden" name="save_stx" value="<?php echo $stx; ?>">

<label for="sca" class="sound_only">카테고리선택</label>
<!--<select name="sca" id="sca">-->
<!--    <option value="">전체카테고리</option>-->
<!--    --><?php
//    $sql1 = " select ca_id, ca_name from {$g5['g5_shop_category_table']} where ca_id like '10%' order by ca_order, ca_id ";
//    $result1 = sql_query($sql1);
//    for ($i=0; $row1=sql_fetch_array($result1); $i++) {
//        $len = strlen($row1['ca_id']) / 2 - 1;
//        $nbsp = '';
//        for ($i=0; $i<$len; $i++) $nbsp .= '&nbsp;&nbsp;&nbsp;';
//        echo '<option value="'.$row1['ca_id'].'" '.get_selected($sca, $row1['ca_id']).'>'.$nbsp.$row1['ca_name'].'</option>'.PHP_EOL;
//    }
//    ?>
<!--</select>-->
<label for="sfl" class="sound_only">검색대상</label>
<select name="sfl" id="sfl">
    <option value="it_name" <?php echo get_selected($sfl, 'it_name'); ?>>모임명</option>
    <option value="it_id" <?php echo get_selected($sfl, 'it_id'); ?>>모임코드</option>
    <option value="it_maker" <?php echo get_selected($sfl, 'it_maker'); ?>>강사</option>
    <option value="it_sell_email" <?php echo get_selected($sfl, 'it_sell_email'); ?>>판매자 e-mail</option>
</select>
<label for="stx" class="sound_only">검색어</label>
<input type="text" name="stx" value="<?php echo $stx; ?>" id="stx" class="frm_input">
<input type="submit" value="검색" class="btn_submit">
</form>

<form name="fitemmoa_listupdate" method="post" action="./itemmoa_listupdate.php" onsubmit="return fitemmoa_list_submit(this);" autocomplete="off" id="fitemmoa_listupdate">
<input type="hidden" name="sca" value="<?php echo $sca; ?>">
<input type="hidden" name="sst" value="<?php echo $sst; ?>">
<input type="hidden" name="sod" value="<?php echo $sod; ?>">
<input type="hidden" name="sfl" value="<?php echo $sfl; ?>">
<input type="hidden" name="stx" value="<?php echo $stx; ?>">
<input type="hidden" name="page" value="<?php echo $page; ?>">

<div class="box-header">
<!--	<button type="button" data-onoff="오프라인" class="btn_onoff btn span110">오프라인</button>-->
<!--    <button type="button" data-onoff="온라인" class="btn_onoff btn span110 gray">온라인</button> 비활성화는 gray -->
        <a href="#" class=ight">
		<a href="/adm/shop_admin/moa_write.php?bo_table=class" target="_blank" class="btn span150">모임 등록</a>
		<select name="page_su" id="page_count">
			<option value="10" <?php echo $page_su == '10' ? 'selected' : ''; ?>>10개</option>
			<option value="15" <?php echo $page_su == '15' ? 'selected' : ''; ?>>15개</option>
			<option value="20" <?php echo $page_su == '20' ? 'selected' : ''; ?>>20개</option>
		</select>
	</a>
</div>

<div class="tbl-basic outline th-h5 fs13 odd">
    <table>
    <caption><?php echo $g5['title']; ?> 목록</caption>
    <thead>
    <tr>        
        <th scope="col" ><?php echo subject_sort_link('it_id', 'sca='.$sca); ?>모임ID</a></th>
		<th scope="col"  id="th_img">썸네일</th>
		<th scope="col"  id="th_pc_title"><?php echo subject_sort_link('it_name', 'sca='.$sca); ?>모임명</a></th>
		<th scope="col"  id="th_category">모임유형</th>
		<th scope="col"  id="th_category">모임유형</th>
		<th scope="col">주소(위치)</th><!-- 오프라인 선택시에만 출력 -->
		<th scope="col">호스트명</th>		
		<th scope="col">휴대폰 번호</th>
		<th scope="col">상태</th>
<!--		<th scope="col">승인/대기</th>-->
		<th scope="col">모임 날짜</th>
		<th scope="col">폐강 여부</th>
<!--		<th scope="col">처리자</th>-->
		<th scope="col" class="none">
            <label for="chkall" class="sound_only">모임 전체</label>
            <input type="checkbox" name="chkall" value="1" id="chkall" onclick="check_all(this.form)">
        </th>
        <th scope="col" class="none"><?php echo subject_sort_link('it_order', 'sca='.$sca); ?>순서</a></th>
        <th scope="col" class="none"><?php echo subject_sort_link('it_popular', 'sca='.$sca, 1); ?>인기</a></th>
        <th scope="col" class="none"><?php echo subject_sort_link('it_use', 'sca='.$sca, 1); ?>판매</a></th>
        <th scope="col" id="th_camt" class="none"><?php echo subject_sort_link('it_cust_price', 'sca='.$sca); ?>정상금액</a></th>
        <th scope="col" id="th_amt" class="none"><?php echo subject_sort_link('it_price', 'sca='.$sca); ?>할인금액</a></th>
        <th scope="col" class="none"><?php echo subject_sort_link('it_hit', 'sca='.$sca, 1); ?>조회</a></th>
        <th scope="col" >관리1</th>
        <th scope="col" >관리2</th>
    </tr>
    </thead>
    <tbody>
    <?php
    while ($row = sql_fetch_array($result))
    {
        $href = G5_SHOP_URL.'/item.php?it_id='.$row['it_id'];
        $bg = 'bg'.($i%2);

        $it_point = $row['it_point'];
        if($row['it_point_type'])
            $it_point .= '%';
    ?>
    <tr class="">
        
        <td  class="td_num">
            <input type="hidden" name="it_id[<?php echo $i; ?>]" value="<?php echo $row['it_id']; ?>">
            <?php echo $row['it_id']; ?>
        </td>
		<td><a href="<?php echo $href; ?>"><img src="<?php echo $row['as_thumb']; ?>" width="30px" height="30px" /></a></td>
		<td><a href="<?php echo $href; ?>" class="color-blue underline"><?php echo $row['it_name']; ?></a></td>
		<td><?php echo $row['moa_onoff'] ?></td>
		<td><?php echo $row['moa_form']; ?></td>
		<td class="cell-mainColor">
            <?php echo get_common_type($row['moa_area1'])['type_name']; ?>
            (<?php echo get_common_code_name($row['moa_area1'], $row['moa_area2'])['cd_name']; ?>)
        </td><!-- 오프라인 선택시에만 출력 -->
		<td><?php echo $row['mb_name']; ?></td>
		<td><?php echo $row['mb_hp']; ?></td>
        <?php $status = array('준비','승인','반려','삭제', '취소','폐강'); ?>
		<td><?php echo $status[$row['moa_status']]; ?></td>
<!--		<td>0/5</td>-->
		<td><?php echo date('Y.m.d', strtotime($row['day'])); ?></td>
		<td><span data-href="#pop-cancel-class" data-wr_id="<?php echo $row['wr_id']; ?>" class="close_moim pop-inline btn mini span50">폐강</span></td><!-- <td>X</td>, <td>O</td> -->
<!--		<td>어드민#1</td>	-->

		<td  class="td_chk none">
            <label for="chk_<?php echo $i; ?>" class="sound_only"><?php echo get_text($row['it_name']); ?></label>
            <input type="checkbox" name="chk[]" value="<?php echo $i ?>" id="chk_<?php echo $i; ?>">
        </td>
        <td  class="td_num none">
            <label for="order_<?php echo $i; ?>" class="sound_only">순서</label>
            <input type="text" name="it_order[<?php echo $i; ?>]" value="<?php echo $row['it_order']; ?>" id="order_<?php echo $i; ?>" class="tbl_input" size="3">
        </td>
        <td class="none">
            <label for="popular_<?php echo $i; ?>" class="sound_only">인기</label>
            <input type="checkbox" name="it_type4[<?php echo $i; ?>]" <?php echo ($row['it_type4'] ? 'checked' : ''); ?> value="1" id="popular_<?php echo $i; ?>">
        </td>
        <td class="none">
            <label for="use_<?php echo $i; ?>" class="sound_only">판매여부</label>
            <input type="checkbox" name="it_use[<?php echo $i; ?>]" <?php echo ($row['it_use'] ? 'checked' : ''); ?> value="1" id="use_<?php echo $i; ?>">
        </td>
        <td  class="td_img none">
             <a href="<?php echo $href; ?>"><?php echo get_it_image($row['it_id'], 50, 50); ?></a>
        </td>
        <td  class="td_category none">
             <label for="ca_id_<?php echo $i; ?>" class="sound_only"><?php echo get_text($row['it_name']); ?> 기본카테고리</label>
            <select name="ca_id[<?php echo $i; ?>]" id="ca_id_<?php echo $i; ?>" >
                <?php echo conv_selected_option($ca_list, $row['ca_id']); ?>
            </select>
            <label for="ca_id2_<?php echo $i; ?>" class="sound_only"><?php echo get_text($row['it_name']); ?> 2차카테고리</label>
            <select name="ca_id2[<?php echo $i; ?>]" id="ca_id2_<?php echo $i; ?>">
                <?php echo conv_selected_option($ca_list, $row['ca_id2']); ?>
            </select>
        </td>
        <td headers="th_pc_title"  class="td_input none">
            <label for="name_<?php echo $i; ?>" class="sound_only">모임명</label>
            <input type="text" name="it_name[<?php echo $i; ?>]" value="<?php echo htmlspecialchars2(cut_str($row['it_name'],250, "")); ?>" id="name_<?php echo $i; ?>" required class="tbl_input required" size="30">
        </td>
        <td headers="th_camt" class="td_numbig td_input none">
            <label for="cust_price_<?php echo $i; ?>" class="sound_only">정상금액</label>
            <input type="text" name="it_cust_price[<?php echo $i; ?>]" value="<?php echo $row['it_cust_price']; ?>" id="cust_price_<?php echo $i; ?>" class="tbl_input sit_camt" size="7">
            <div style="display:none">
                <label for="it_skin_<?php echo $i; ?>" class="sound_only">PC 스킨</label>
                <?php echo get_skin_select('shop', 'it_skin_'.$i, 'it_skin['.$i.']', $row['it_skin']); ?>
            </div>
        
            <div style="display:none">
                <label for="it_mobile_skin_<?php echo $i; ?>" class="sound_only">모바일 스킨</label>
                <?php echo get_mobile_skin_select('shop', 'it_mobile_skin_'.$i, 'it_mobile_skin['.$i.']', $row['it_mobile_skin']); ?>
            </div>
        </td>
        <td headers="th_amt" class="td_numbig td_input none">
            <label for="price_<?php echo $i; ?>" class="sound_only">할인금액</label>
            <input type="text" name="it_price[<?php echo $i; ?>]" value="<?php echo $row['it_price']; ?>" id="price_<?php echo $i; ?>" class="tbl_input sit_amt" size="7">
        </td>
        <td  class="td_num none"><?php echo $row['it_hit']; ?></td>
        <td  class="td_mng td_mng_s none">
            <a href="./itemmoa_form.php?w=u&amp;it_id=<?php echo $row['it_id']; ?>&amp;ca_id=<?php echo $row['ca_id']; ?>&amp;<?php echo $qstr; ?>" class="btn btn_03"><span class="sound_only"><?php echo htmlspecialchars2(cut_str($row['it_name'],250, "")); ?> </span>수정</a>
            <!--
            <a href="./itemcopy.php?it_id=<?php echo $row['it_id']; ?>&amp;ca_id=<?php echo $row['ca_id']; ?>" class="itemcopy btn btn_02" target="_blank"><span class="sound_only"><?php echo htmlspecialchars2(cut_str($row['it_name'],250, "")); ?> </span>복사</a> -->
            <a href="<?php echo $href; ?>" class="btn btn_02"><span class="sound_only"><?php echo htmlspecialchars2(cut_str($row['it_name'],250, "")); ?> </span>보기</a>
        </td>
		<td class="td_mng td_mng_s">
            <select class="moim_picks" data-wr_id="<?php echo $row['wr_id']; ?>">
                <option value="">선택</option>
                <option value="기획전" <?php echo $row['moa_pick'] == '기획전' ? 'selected' : ''; ?>>기획전</option>
                <option value="모아픽" <?php echo $row['moa_pick'] == '모아픽' ? 'selected' : ''; ?>>모아픽</option>
            </select>
		</td>
        <td class="td_mng td_mng_s">
			<a href="/adm/shop_admin/orderer_list.php?it_id=<?php echo $row['it_id']; ?>&page=<?php echo $page ? $page : 1; ?>" class="btn btn_02">참여자</a>
			<a href="./itemmoa_form.php?w=u&amp;it_id=<?php echo $row['it_id']; ?>&amp;ca_id=<?php echo $row['ca_id']; ?>&amp;<?php echo $qstr; ?>" class="btn btn_03 none">수정</a><!-- 사용자페이지에서 등록 및 수정 가능 -->
			<button type="button" class="del_class btn btn_01" data-wr_id="<?php echo $row['wr_id']; ?>">삭제</button>
		</td>
    </tr>
    <?php
    }
    if ($i == 0)
        echo '<tr><td colspan="12" class="empty_table">자료가 한건도 없습니다.</td></tr>';
    ?>
    </tbody>
    </table>
</div>

<div class="btn_fixed_top none">

    <a href="./itemmoa_form.php" class="btn btn_01">모임등록</a>
    <?php /*
    <a href="./itemexcel.php" onclick="return excelform(this.href);" target="_blank" class="btn btn_02">모임일괄등록</a>
    <input type="submit" name="act_button" value="선택수정" onclick="document.pressed=this.value" class="btn btn_02">
    */?>
    <?php if ($is_admin == 'super') { ?>
    <input type="submit" name="act_button" value="선택삭제" onclick="document.pressed=this.value" class="btn btn_02">
    <?php } ?>
</div>
<!-- <div class="btn_confirm01 btn_confirm">
    <input type="submit" value="일괄수정" class="btn_submit" accesskey="s">
</div> -->
</form>

<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, "{$_SERVER['SCRIPT_NAME']}?$qstr&amp;page="); ?>

</div>

<script>
function fitemmoa_list_submit(f)
{
    if (!is_checked("chk[]")) {
        alert(document.pressed+" 하실 항목을 하나 이상 선택하세요.");
        return false;
    }

    if(document.pressed == "선택삭제") {
        if(!confirm("선택한 자료를 정말 삭제하시겠습니까?")) {
            return false;
        }
    }

    return true;
}

$(function() {
    $(".itemcopy").click(function() {
        var href = $(this).attr("href");
        window.open(href, "copywin", "left=100, top=100, width=300, height=200, scrollbars=0");
        return false;
    });
});

function excelform(url)
{
    var opt = "width=600,height=450,left=10,top=10";
    window.open(url, "win_excel", opt);
    return false;
}
$('.moim_picks').change(function(){
    var value = $(this).val();
    if(confirm(value + '로 지정하시겠습니까?')) {
        $.ajax({
            type: "POST",
            url: '/ajax/moaPick.php',
            data: {'wr_id': $(this).data('wr_id'), 'pick': $(this).val() },
            cache: false,
            async: false,
            dataType: "json",
            success: function(data) {
                alert('지정되었습니다.');
                location.reload();
            }
        })
    } else {
        return false;
    }
})
$('.del_class').click(function(){
    if(confirm('삭제하시겠습니까?')) {
        $.ajax({
            type: "POST",
            url: '/ajax/delClass.php',
            data: {'wr_id': $(this).data('wr_id')},
            cache: false,
            async: false,
            dataType: "json",
            success: function(data) {
                alert('삭제되었습니다.');
                location.reload();
            }
        })
    } else {
        return false;
    }
})

$('#page_count').change(function(){
    if(location.search != '') { location.search += '&page_su=' + $(this).val(); }
    else { location.search = '?page_su=' + $(this).val(); }
})

$('.close_moim').click(function(){
    var wr_id = $(this).data('wr_id');

    $('#fregister').children('input[name="wr_id"]').val(wr_id);
})

$('.btnReset').click(function(){
    $('input[name="stx"]').val('');
    $('input[name="sch_startdt"]').val('');
    $('input[name="sch_enddt"]').val('');
})
</script>

<?php
include_once (G5_ADMIN_PATH.'/admin.tail.php');
?>
