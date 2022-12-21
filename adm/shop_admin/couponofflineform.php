<?php
$sub_menu = '400820';
include_once('./_common.php');

auth_check($auth[$sub_menu], "w");

$g5['title'] = '오프라인 쿠폰 관리';

if ($w == 'u') {
    $html_title = '쿠폰 수정';

    $sql = " select * from {$g5['g5_shop_coupon_offline_table']} where co_id = '$co_id' ";
    $cp = sql_fetch($sql);
    if (!$cp['co_id']) alert('등록된 자료가 없습니다.');
}
else
{
    $html_title = '쿠폰 입력';
    $cp['co_start'] = G5_TIME_YMD;
    $cp['co_end'] = date('Y-m-d', (G5_SERVER_TIME + 86400 * 15));
    $cp['co_period'] = 15;
    $cp['co_number'] = 2;
}

if($cp['co_method'] == 1) {
    $co_target_label = '적용분류';
    $co_target_btn = '분류검색';
} else {
    $co_target_label = '적용상품';
    $co_target_btn = '상품검색';
}

include_once (G5_ADMIN_PATH.'/admin.head.php');
include_once(G5_PLUGIN_PATH.'/jquery-ui/datepicker.php');
?>

<form name="fcouponform" action="./couponofflineformupdate.php" method="post" enctype="multipart/form-data" onsubmit="return form_check(this);">
<input type="hidden" name="w" value="<?php echo $w; ?>">
<input type="hidden" name="co_id" value="<?php echo $co_id; ?>">
<input type="hidden" name="stx" value="<?php echo $stx; ?>">
<input type="hidden" name="page" value="<?php echo $page;?>">

<div class="tbl_frm01 tbl_wrap">
    <table>
    <caption><?php echo $g5['title']; ?></caption>
    <colgroup>
        <col class="grid_4">
        <col>
    </colgroup>
    <tbody>
    <tr>
        <th scope="row"><label for="co_subject">쿠폰이름</label></th>
        <td>
            <input type="text" name="co_subject" value="<?php echo get_text($cp['co_subject']); ?>" id="co_subject" required class="required frm_input" size="50">
        </td>
    </tr>
    <tr>
        <th scope="row"><label for="co_start">발급시작일</label></th>
        <td>
            <input type="text" name="co_start" value="<?php echo stripslashes($cp['co_start']); ?>" id="co_start" class="frm_input required" required>
        </td>
    </tr>
    <tr>
	    <th scope="row"><label for="co_end">발급종료일</label></th>
	    <td>
		    <?php echo help('무기한 사용시 0입력'); ?>
		    <input type="text" name="co_end" value="<?php echo stripslashes($cp['co_end']); ?>" id="co_end" class="frm_input required" required>
	    </td>
    </tr>
    <tr>
        <th scope="row"><label for="co_period">쿠폰사용기한</label></th>
        <td>
            <?php echo help("쿠폰 발급 후 사용할 수 있는 기간을 설정합니다. 0일 입력시 제한이 없습니다."); ?>
            <input type="text" name="co_period" value="<?php echo stripslashes($cp['co_period']); ?>" id="co_period" class="frm_input required" required size="5"> 일
        </td>
    </tr>
    <tr>
        <th scope="row"><label for="co_method">발급쿠폰종류</label></th>
        <td>
           <select name="co_method" id="co_method">
                <option value="0"<?php echo get_selected('0', $cp['co_method']); ?>>개별상품할인</option>
                <option value="1"<?php echo get_selected('1', $cp['co_method']); ?>>카테고리할인</option>
                <option value="2"<?php echo get_selected('2', $cp['co_method']); ?>>주문금액할인</option>
                <option value="3"<?php echo get_selected('3', $cp['co_method']); ?>>배송비할인</option>
           </select>
        </td>
    </tr>
    <tr id="tr_co_target">
        <th scope="row"><label for="co_target"><?php echo $co_target_label; ?></label></th>
        <td>
           <input type="text" name="co_target" value="<?php echo stripslashes($cp['co_target']); ?>" id="co_target" required class="required frm_input">
           <button type="button" id="sch_target" class="btn_frmline"><?php echo $co_target_btn; ?></button>
        </td>
    </tr>
    <tr>
        <th scope="row"><label for="co_type">할인금액타입</label></th>
        <td>
           <select name="co_type" id="co_type">
                <option value="0"<?php echo get_selected('0', $cp['co_type']); ?>>정액할인(원)</option>
                <option value="1"<?php echo get_selected('1', $cp['co_type']); ?>>정률할인(%)</option>
           </select>
        </td>
    </tr>
    <tr>
        <th scope="row"><label for="co_price"><?php echo $cp['co_type'] ? '할인비율' : '할인금액'; ?></label></th>
        <td>
            <input type="text" name="co_price" value="<?php echo stripslashes($cp['co_price']); ?>" id="co_price" required class="frm_input required"> <span id="co_price_unit"><?php echo $cp['co_type'] ? '%' : '원'; ?></span>
        </td>
    </tr>
    <tr id="tr_co_trunc">
        <th scope="row"><label for="co_trunc">절사금액</label></th>
        <td>
            <select name="co_trunc" id="co_trunc">
            <option value="1"<?php echo get_selected('1', $cp['co_trunc']); ?>>1원단위</option>
            <option value="10"<?php echo get_selected('10', $cp['co_trunc']); ?>>10원단위</option>
            <option value="100"<?php echo get_selected('100', $cp['co_trunc']); ?>>100원단위</option>
            <option value="1000"<?php echo get_selected('1000', $cp['co_trunc']); ?>>1,000원단위</option>
           </select>
        </td>
    </tr>
    <tr>
        <th scope="row"><label for="co_minimum">최소주문금액</label></th>
        <td>
            <input type="text" name="co_minimum" value="<?php echo stripslashes($cp['co_minimum']); ?>" id="co_minimum" class="frm_input"> 원
        </td>
    </tr>
    <tr id="tr_co_maximum">
        <th scope="row"><label for="co_maximum">최대할인금액</label></th>
        <td>
            <input type="text" name="co_maximum" value="<?php echo stripslashes($cp['co_maximum']); ?>" id="co_maximum" class="frm_input"> 원
        </td>
    </tr>
    <tr>
	    <th scope="row"><label for="">발행 쿠폰 갯수</label></th>
	    <td>
		    <?php echo help('쿠폰 생성 이후 수정 불가'); ?>
		    <input type="text" name="co_number" value="<?php echo stripslashes($cp['co_number']) ?>" class="frm_input required" required <?php echo ($w == 'u' ? 'readonly' : '') ?>>
	    </td>
    </tr>
    </tbody>
    </table>
</div>

<div class="btn_fixed_top">
    <a href="./couponoffline.php?<?php echo $qstr; ?>" class="btn_02 btn">목록</a>
    <input type="submit" value="확인" class="btn_submit btn" accesskey="s">
</div>

</form>

<script>
$(function() {
    <?php if($cp['co_method'] == 2 || $cp['co_method'] == 3) { ?>
    $("#tr_co_target").hide();
    $("#tr_co_target").find("input").attr("required", false).removeClass("required");
    <?php } ?>
    <?php if($cp['co_type'] != 1) { ?>
    $("#tr_co_maximum").hide();
    $("#tr_co_trunc").hide();
    <?php } ?>
    $("#co_method").change(function() {
        var co_method = $(this).val();
        change_method(co_method);
    });

    $("#co_type").change(function() {
        var co_type = $(this).val();
        change_type(co_type);
    });

    $("#sch_target").click(function() {
        var co_method = $("#co_method").val();
        var opt = "left=50,top=50,width=520,height=600,scrollbars=1";
        var url = "./coupontarget.php?sch_target=";

        if(co_method == "0") {
            window.open(url+"0", "win_target", opt);
        } else if(co_method == "1") {
            window.open(url+"1", "win_target", opt);
        } else {
            return false;
        }
    });

    $("#co_start, #co_end").datepicker(
        { changeMonth: true, changeYear: true, dateFormat: "yy-mm-dd", showButtonPanel: true, yearRange: "c-99:c+99" }
    );
});

function change_method(co_method)
{
    if(co_method == "0") {
        $("#sch_target").text("상품검색");
        $("#tr_co_target").find("label").text("적용상품");
        $("#tr_co_target").find("input").attr("required", true).addClass("required");
        $("#tr_co_target").show();
    } else if(co_method == "1") {
        $("#sch_target").text("분류검색");
        $("#tr_co_target").find("label").text("적용분류");
        $("#tr_co_target").find("input").attr("required", true).addClass("required");
        $("#tr_co_target").show();
    } else {
        $("#tr_co_target").hide();
        $("#tr_co_target").find("input").attr("required", false).removeClass("required");
    }
}

function change_type(co_type)
{
    if(co_type == "0") {
        $("#co_price_unit").text("원");
        $("#co_price_unit").closest("tr").find("label").text("할인금액");
        $("#tr_co_maximum").hide();
        $("#tr_co_trunc").hide();
    } else {
        $("#co_price_unit").text("%");
        $("#co_price_unit").closest("tr").find("label").text("할인비율");
        $("#tr_co_maximum").show();
        $("#tr_co_trunc").show();
    }
}

function form_check(f)
{
    var sel_type = f.co_type;
    var co_type = sel_type.options[sel_type.selectedIndex].value;
    var co_price = f.co_price.value;


    if(isNaN(co_price)) {
        if(co_type == "1")
            alert("할인비율을 숫자로 입력해 주십시오.");
        else
            alert("할인금액을 숫자로 입력해 주십시오.");

        return false;
    }

    co_price = parseInt(co_price);

    if(co_type == "1" && (co_price < 1 || co_price > 100)) {
        alert("할인비율을 1과 100 사이의 숫자로 입력해 주십시오.");
        return false;
    }

    return true;
}
</script>

<?php
include_once (G5_ADMIN_PATH.'/admin.tail.php');
?>