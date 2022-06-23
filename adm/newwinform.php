<?php
$sub_menu = '580220';
include_once('./_common.php');
include_once(G5_EDITOR_LIB);

auth_check($auth[$sub_menu], "w");

$nw_id = preg_replace('/[^0-9]/', '', $nw_id);

$html_title = "팝업";

// 팝업레이어 테이블에 쇼핑몰, 커뮤니티 인지 구분하는 여부 필드 추가
$sql = " ALTER TABLE `{$g5['new_win_table']}` ADD `nw_division` VARCHAR(10) NOT NULL DEFAULT 'both' ";
sql_query($sql, false);

if ($w == "u")
{
    $html_title .= " 수정";
    $sql = " SELECT a.*, 
                date(a.nw_begin_time) begin_date, 
                date_format(a.nw_begin_time, '%H') begin_hour, 
                date_format(a.nw_begin_time, '%i') begin_time, 
                date(a.nw_end_time) end_date, 
                date_format(a.nw_end_time, '%H') end_hour, 
                date_format(a.nw_end_time, '%i') end_time, 
                '' blank
             from {$g5['new_win_table']} a
            where nw_id = '$nw_id' ";
    $nw = sql_fetch($sql);
    if (!$nw['nw_id']) alert("등록된 자료가 없습니다.");
}
else
{
    $sql = " SELECT 
                curdate() begin_date, 
                date_format(now(), '%H') begin_hour, 
                date_format(now(), '%i') begin_time, 
                curdate() end_date, 
                date_format(now(), '%H') end_hour, 
                date_format(now(), '%i') end_time
            ";
    $nw = sql_fetch($sql);

    $html_title .= " 입력";
    $nw['nw_device'] = 'both';
    $nw['nw_disable_hours'] = 24;
    $nw['nw_left']   = 10;
    $nw['nw_top']    = 10;
    $nw['nw_width']  = 450;
    $nw['nw_height'] = 500;
    $nw['nw_content_html'] = 2;

}

$g5['title'] = $html_title;
include_once (G5_ADMIN_PATH.'/admin.head.php');
?>

<form name="frmnewwin" action="./newwinformupdate.php" onsubmit="return frmnewwin_check(this);" method="post">
<input type="hidden" name="w" value="<?php echo $w; ?>">
<input type="hidden" name="nw_id" value="<?php echo $nw_id; ?>">
<input type="hidden" name="token" value="">

<div class="local_desc01 local_desc none">
    <p>초기화면 접속 시 자동으로 뜰 팝업레이어를 설정합니다.</p>
</div>

<div class="tbl_frm01 tbl_wrap none">
    <table>
    <caption><?php echo $g5['title']; ?></caption>
    <colgroup>
        <col class="grid_4">
        <col>
    </colgroup>
    <tbody>
    <tr>
        <th scope="row"><label for="nw_division">구분</label></th>
        <td>
            <?php echo help("커뮤니티에 표시될 것인지 쇼핑몰에 표시될 것인지를 설정합니다."); ?>
            <select name="nw_division" id="nw_division">
                <option value="both"<?php echo get_selected($nw['nw_division'], 'both', true); ?>>커뮤니티와 쇼핑몰</option>
                <option value="comm"<?php echo get_selected($nw['nw_division'], 'comm'); ?>>커뮤니티</option>
                <option value="shop"<?php echo get_selected($nw['nw_division'], 'shop'); ?>>쇼핑몰</option>
            </select>
        </td>
    </tr>
    
    <tr>
        <th scope="row"><label for="nw_disable_hours">시간<strong class="sound_only"> 필수</strong></label></th>
        <td>
            <?php echo help("고객이 다시 보지 않음을 선택할 시 몇 시간동안 팝업레이어를 보여주지 않을지 설정합니다."); ?>
            <input type="text" name="nw_disable_hours" value="<?php echo $nw['nw_disable_hours']; ?>" id="nw_disable_hours" required class="frm_input required" size="12"> 시간
        </td>
    </tr>
    <tr>
        <th scope="row"><label for="nw_begin_time">시작일시<strong class="sound_only"> 필수</strong></label></th>
        <td>
           
            <input type="checkbox" name="nw_begin_chk" value="<?php echo date("Y-m-d 00:00:00", G5_SERVER_TIME); ?>" id="nw_begin_chk" onclick="if (this.checked == true) this.form.nw_begin_time.value=this.form.nw_begin_chk.value; else this.form.nw_begin_time.value = this.form.nw_begin_time.defaultValue;">
            <label for="nw_begin_chk">시작일시를 오늘로</label>
        </td>
    </tr>
    <tr>
        <th scope="row"><label for="nw_end_time">종료일시<strong class="sound_only"> 필수</strong></label></th>
        <td>
            
            <input type="checkbox" name="nw_end_chk" value="<?php echo date("Y-m-d 23:59:59", G5_SERVER_TIME+(60*60*24*7)); ?>" id="nw_end_chk" onclick="if (this.checked == true) this.form.nw_end_time.value=this.form.nw_end_chk.value; else this.form.nw_end_time.value = this.form.nw_end_time.defaultValue;">
            <label for="nw_end_chk">종료일시를 오늘로부터 7일 후로</label>
        </td>
    </tr>
    
    
    </tbody>
    </table>
</div>


<!--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
<!--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
<!--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->


<div class="boxContainer padding40">

	<div class="tbl_frm01 tbl_wrap">
		<table>
		<caption><?php echo $g5['title']; ?></caption>
		<colgroup>
			<col class="grid_4">
			<col>
		</colgroup>
		<tbody>
		<tr>
			<th scope="row"><label for="nw_subject">팝업 제목<strong class="sound_only"> 필수</strong></label></th>
			<td>
				<input type="text" name="nw_subject" value="<?php echo get_sanitize_input($nw['nw_subject']); ?>" id="nw_subject" required class="frm_input required" size="80">
                
			</td>
		</tr>
        <tr>
            <th scope="row"><label for="nw_device">접속기기</label></th>
            <td>
                <?php echo help("팝업레이어가 표시될 접속기기를 설정합니다."); ?>
                <select name="nw_device" id="nw_device">
                    <option value="both"<?php echo get_selected($nw['nw_device'], 'both', true); ?>>PC와 모바일</option>
                    <option value="pc"<?php echo get_selected($nw['nw_device'], 'pc'); ?>>PC</option>
                    <option value="mobile"<?php echo get_selected($nw['nw_device'], 'mobile'); ?>>모바일</option>
                </select>
            </td>
        </tr>
		<tr>
			<th scope="row">시작일시</th>
			<td>
				<label class="inp-wrap label-inline"><input type="text" name="begin_date"  id="begin_date" value="<?php echo $nw['begin_date'];?>" class="span160 datepicker beginenddate" placeholder="날짜 선택">
                <span class="label"></span></label>
				<select name="begin_hour" id="begin_hour" title="몇시" class="ml5 beginenddate" >
					<?php for($i=1; $i<=24; $i++) {
						$i = $i < 10 ? '0'.$i:$i;
						echo "<option value='{$i}'";
                        if ($i == $nw['begin_hour'])
                            echo " selected ";
						echo ">".$i."시</option>";
					} ?>
			   </select>
			   <select name="begin_time" id="begin_time" title="몇분" class="ml5 beginenddate">
					<?php for($i=0; $i<=59; $i++) {
						$i = $i < 10 ? '0'.$i:$i;
						echo "<option value='{$i}'";
                        if ($i == $nw['begin_time'])
                            echo " selected ";
						echo ">".$i."분</option>";
					} ?>
			   </select>
               <input type="hidden" name="nw_begin_time" value="<?php echo $nw['nw_begin_time']; ?>" id="nw_begin_time" required class="frm_input required " size="21" maxlength="19">
			</td>
		</tr>
		<tr>
			<th scope="row">종료일시</th>
			<td>
				<label class="inp-wrap label-inline"><input type="text" name="end_date"  id="end_date" value="<?php echo $nw['end_date'];?>" class="span160 datepicker beginenddate" placeholder="날짜 선택"><span class="label"></span></label>
				<select name="end_hour" id="end_hour" title="몇시" class="ml5 beginenddate">
					<?php for($i=1; $i<=24; $i++) {
						$i = $i < 10 ? '0'.$i:$i;
                        echo "<option value='{$i}'";
                        if ($i == $nw['end_hour'])
                            echo " selected ";
						echo ">".$i."시</option>";
					} ?>
			   </select>
			   <select name="end_time" id="end_time" title="몇분" class="ml5 beginenddate">
					<?php for($i=0; $i<=59; $i++) {
						$i = $i < 10 ? '0'.$i:$i;
						echo "<option value='{$i}'";
                        if ($i == $nw['end_time'])
                            echo " selected ";
						echo ">".$i."분</option>";
					} ?>
			   </select>
               <input type="hidden" name="nw_end_time" value="<?php echo $nw['nw_end_time']; ?>" id="nw_end_time" required class="frm_input required" size="21" maxlength="19">

               <script>
               function setMoaClass_ChangeDateTime() {
                   var begindate = $("#begin_date").val();
                   var beginhour = $("#begin_hour option:selected").val();
                   var begintime = $("#begin_time option:selected").val();
                   var nwbegin = begindate+" "+beginhour+":"+begintime+":00";
                   var enddate = $("#end_date").val();
                   var endhour = $("#end_hour option:selected").val();
                   var endtime = $("#end_time option:selected").val();
                   var nwend = enddate+" "+endhour+":"+endtime+":00";
                    $("#nw_begin_time").val(nwbegin);
                    $("#nw_end_time").val(nwend);
               }
               $(function() {
                setMoaClass_ChangeDateTime();
                $(".beginenddate").change(function() {
                    setMoaClass_ChangeDateTime();
                }); 
               });
               </script>
			</td>
		</tr>
		
		<tr>
			<th scope="row"><label for="nw_content">내용</label></th>
			<td><?php echo editor_html('nw_content', get_text(html_purifier($nw['nw_content']), 0)); ?></td>
		</tr>

		<tr>
			<th scope="row"><label for="nw_left">팝업 위치<strong class="sound_only"> 필수</strong></label></th>
			<td>
			   <input type="text" name="nw_left" value="<?php echo $nw['nw_left']; ?>" id="nw_left" required class="frm_input required" size="5" data-label="좌측위치" data-label-inline="px">
			   <input type="text" name="nw_top" value="<?php echo $nw['nw_top']; ?>" id="nw_top" required class="frm_input required"  size="5" data-class="ml10" data-label="상단위치" data-label-inline="px">
			</td>
		</tr>
		<tr>
			<th scope="row"><label for="nw_width">팝업 사이즈<strong class="sound_only"> 필수</strong></label></th>
			<td>
				<input type="text" name="nw_width" value="<?php echo $nw['nw_width'] ?>" id="nw_width" required class="frm_input required" size="5" data-label="팝업넓이" data-label-inline="px">
				<input type="text" name="nw_height" value="<?php echo $nw['nw_height'] ?>" id="nw_height" required class="frm_input required" size="5" data-class="ml10" data-label="팝업높이" data-label-inline="px">
			</td>
		</tr>
		</tbody>
		</table>
	</div>

	<div class="btn_fixed_top">
		<a href="./newwinlist.php" class=" btn btn_02">목록</a>
		<input type="submit" value="확인" class="btn_submit btn" accesskey="s">
	</div>

</div>

</form>

<script>
function frmnewwin_check(f)
{
    errmsg = "";
    errfld = "";

    <?php echo get_editor_js('nw_content'); ?>

    check_field(f.nw_subject, "제목을 입력하세요.");

    if (errmsg != "") {
        alert(errmsg);
        errfld.focus();
        return false;
    }
    return true;
}
</script>

<?php
include_once (G5_ADMIN_PATH.'/admin.tail.php');
?>
