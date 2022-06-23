<?php
include_once(G5_PATH.'/common.php');
//if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_PLUGIN_PATH.'/jquery-ui/datepicker.php');

if($w=='' && $_GET['r_date']) {
	$write['wr_1'] = $_GET['r_date'];
	//$write['wr_2'] = $_GET['f_date'];  
}
$kind= $_GET['kind'];
if (!isset($kind)) $kind = 1;

if ($kind == 1)
	$status = "입금";
else if ($kind == 2)
	$status = "대기";
else
	alert('정상적으로 접근하세요!');

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);

$info = getShipInfo($write['wr_1'], $view['wr_subject']);

?>

<section id="bo_w">
    <!-- h2 id="container_title"><?php echo $g5['title'] ?> - <?php echo $write['wr_1'] ."일자 예약 ";?></h2 -->
	<?php $action_url = G5_BBS_URL."/write_update.php";?>
    <!-- 게시물 작성/수정 시작 { -->
    <form name="fwrite" id="fwrite" action="<?php echo $action_url ?>" onsubmit="return fwrite_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off" style="width:<?php echo $width; ?>">
	<input type="hidden" name="w" value="">
    <input type="hidden" name="wr_2" value="<?php echo $view['wr_subject'] ?>">
	<input type="hidden" name="wr_subject" value="<?php echo $view['wr_subject'] ."-".$_GET['r_date']." 예약" ?>">
	
	
    <input type="hidden" name="bo_table" value="aplylist">
    <input type="hidden" name="wr_id" value="<?php echo get_uniqid(); ?>">
    <input type="hidden" name="sca" value="<?php echo $sca ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="spt" value="<?php echo $spt ?>">
    <input type="hidden" name="sst" value="<?php echo $sst ?>">
    <input type="hidden" name="sod" value="<?php echo $sod ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">
    <?php
    $option = '';
    $option_hidden = '';
    if ($is_notice || $is_html || $is_secret || $is_mail) {
        $option = '';
        if ($is_notice) {
            $option .= "\n".'<input type="checkbox" id="notice" name="notice" value="1" '.$notice_checked.'>'."\n".'<label for="notice">공지</label>';
        }

        if ($is_html) {
            if ($is_dhtml_editor) {
                $option_hidden .= '<input type="hidden" value="html1" name="html">';
            } else {
                $option .= "\n".'<input type="checkbox" id="html" name="html" onclick="html_auto_br(this);" value="'.$html_value.'" '.$html_checked.'>'."\n".'<label for="html">html</label>';
            }
        }

        if ($is_secret) {
            if ($is_admin || $is_secret==1) {
                $option .= "\n".'<input type="checkbox" id="secret" name="secret" value="secret" '.$secret_checked.'>'."\n".'<label for="secret">비밀글</label>';
            } else {
                $option_hidden .= '<input type="hidden" name="secret" value="secret">';
            }
        }

        if ($is_mail) {
            $option .= "\n".'<input type="checkbox" id="mail" name="mail" value="mail" '.$recv_email_checked.'>'."\n".'<label for="mail">답변메일받기</label>';
        }
    }

    echo $option_hidden;
    ?>

	<table class="w_form">
		<tbody>
			<col width="20%00">
			<col>
			<tr>
				<th scope="row"><label for="wr_subject">선박명칭</label></th>
				<td><strong><?php echo $view['wr_subject'] ?></strong></td>
			</tr>
			<tr>
				<th scope="row"><label for="wr_1">예약<?php echo ($status=="대기")?"<span style='color:#E33;font-weight:bold'>$status</span>":""?>일자<strong class="sound_only">필수</strong></label></th>
				<td>
					<input type="hidden" name="wr_1" id="wr_1" value="<?php echo $r_date?>">
					<?php echo $r_date ." (".getYoil($dayinfo['dow']).")요일 ";?> &nbsp;<?php echo ($status=="대기")?"<span style='color:#E33;font-weight:bold'>$status</span>":""?>
				</td>
			</tr>
			<tr>
				<th scope="row"><label for="notice">출조공지</label></th>
				<td><?php echo $write['wr_6']?></td>
			</tr>

			<?php if ($is_name) { ?>
			<tr>
				<th scope="row"><label for="wr_name">이름<strong class="sound_only">필수</strong></label></th>
				<td><input type="text" name="wr_name" value="<?php echo $name ?>" id="wr_name" required class="frm_input required" size="10" maxlength="20"></td>
			</tr>
			<?php } ?>

			<?php if ($is_password) { ?>
			<tr>
				<th scope="row"><label for="wr_password">패스워드<strong class="sound_only">필수</strong></label></th>
				<td><input type="password" name="wr_password" id="wr_password" <?php echo $password_required ?> class="frm_input <?php echo $password_required ?>" maxlength="20"></td>
			</tr>
			<?php } ?>

			<?php if ($is_email) { ?>
			<tr>
				<th scope="row"><label for="wr_email">이메일</label></th>
				<td><input type="text" name="wr_email" value="<?php echo $email ?>" id="wr_email" class="frm_input email" size="50" maxlength="100"></td>
			</tr>
			<?php } ?>

			<?php if ($is_homepage) { ?>
			<tr>
				<th scope="row"><label for="wr_homepage">홈페이지</label></th>
				<td><input type="text" name="wr_homepage" value="<?php echo $homepage ?>" id="wr_homepage" class="frm_input" size="50"></td>
			</tr>
			<?php } ?>

			<?php if ($option && false) { ?>
			<tr>
				<th scope="row">옵션</th>
				<td><?php echo $option ?></td>
			</tr>
			<?php } ?>

			<?php if ($is_category) { ?>
			<tr>
				<th scope="row"><label for="ca_name">분류<strong class="sound_only">필수</strong></label></th>
				<td>
					<select name="ca_name" id="ca_name" required class="required" >
						<option value="">선택하세요</option>
						<?php echo $category_option ?>
					</select>
				</td>
			</tr>
			<?php } ?>

			<tr>
				<th scope="row"><label for="wr_3">낚시종류<strong class="sound_only">필수</strong></th>
					<td>
						<table width="100%" class="pa_table_all" id="pa_table_1">
							<tr>
								<th>선택</td>
								<th>낚시종류</td>
								<th>금액</td>
								<th>예약금</td>
							</tr>
							<?php
							$kinds = explode(',',$write['wr_9']);
							$sqls = "select * from db_fishing_kind ";
							if ($write['wr_9'])
								$sqladd = " where no in (".$write['wr_9'].")";
							$sqls .= $sqladd;
							$results = sql_query($sqls);
							//echo $sqls;
							while($rows = sql_fetch_array($results))	{ ?>
							<tr>
								<td>
									<input type="radio" name="wr9" value="<?php echo $rows['name']; ?>"  id="<?php echo $rows['no']; ?>" title="<?php echo $rows['reservmoney'];?>" alt="<?php echo $rows['money'];?>" <?php foreach($kinds as $val) {if ($val == $rows['no']) {echo " checked "; }}?> class="">
								</td>
								<td><?php echo $rows['name'];?></td>
								<td><?php echo number_format($rows['money'])."원";?></td>
								<td><?php echo number_format($rows['reservmoney'])."원";?></td>
							</tr>
							<?php }?>
						</table>

						<input type="hidden" name="rmoney" id="rmoney" value="">
						<input type="hidden" name="money" id="money" value="" />

						<script>
						$(function() {
							$('input:radio[name="wr9"]').on("change",function() {
								readyMoney(this);
								showMeTheMoney();
								//alert(this.title+":"+this.alt+":"+this.value);
							});
							fishkinds();
							$('#wr_4').change( function (data) {
								showMeTheMoney();
							});
						});
						function fishkinds(){
							var c = $('input:radio[name="wr9"]');
							var cstr = "";
							if (c.length > 1)
								for (var i =0; i < c.length;i++)	{
									if (c[i].checked)	{
										readyMoney(c[i]);
									}
								}
							else	{
								readyMoney(c);
							}
							showMeTheMoney();
						}
						function readyMoney(obj)	{
							
							$("#wr_3").val(obj.value);
							$("#money").val(obj.alt);
							$("#rmoney").val(obj.title);
						}
						function showMeTheMoney()	{
							var man = $("#wr_4 option:selected").val();
							var sum = 0;
							if (man && $("#money").val())	{
							sum = parseInt($("#money").val()) * parseInt(man);
							sum = ""+sum;
							sum = sum.split(/(?=(?:\d{3})+(?:\.|$))/g).join(',');  
							$("#wr_5").val(sum+"원");
							$("#wr_6").val(sum+"원");
							}
							else {
								$("#wr_5").val(0+"원");
								$("#wr_6").val(0+"원");
							}
						}
						</script>

				</td>
			</tr>	
			<tr>
				<th scope="row"><label for="wr_4">참여승선인원<strong class="sound_only">필수</strong></label></th>
				<td>
					<select name="wr_4" id="wr_4" class="required">
						<option value='' >  --  승선인원  --  </option>
						<?php
						$sql = "select wr_id, wr_subject, wr_1, wr_3  from g5_write_ship ";
						$result=sql_query($sql);
						$ablecnt = getAbleCount($r_date, $view['wr_subject']);
						if ($status =="대기")
							$ablecnt = 10;
						for ($i = 1; $i <= $ablecnt; $i++)	{
							echo "<option value='".$i."' >".$i."명</option>";
						}
						?>
					</select>
					<?php echo $view['wr_subject']?>의 총원은 <?php echo $info['max'] ?>명 입니다. 
					<?php if ($status == "대기") {?>
					현재는 대기만 가능합니다.
					<?php } else {?>
					현재 가능한 승선인원은 <span style="color:#F00;font-weight:bold"> <?php echo $ablecnt?></span>명 입니다.
					<?php } ?>
				</td>
			</tr>
			<tr>
				<th scope="row"><label for="wr_5">예약금액</th>
				<td>
					<input type="text" name="wr_5" value="0"  id="wr_5" class="required" size="18" maxlength="18" readonly> 
				</td>
			</tr>
			<tr>
				<th scope="row"><label for="wr_6">총금액</th>
				<td>
					<input type="text" name="wr_6" value="0"  id="wr_6"  class="required m_won" size="18" maxlength="18" readonly> 
				</td>
			</tr>
			<tr>
				<th scope="row"><label for="wr_7">예약자명<strong class="sound_only">필수</strong></th>
				<td>
					<textarea name="wr_7" id="wr_7"  class="required" style="width:600px;height:60px"><?php echo $member['mb_name']; ?></textarea>
				</td>
			</tr>
			<tr>
				<th scope="row"><label for="wr_8">휴대폰<strong class="sound_only">필수</strong></th>
				<td>
					<input type="text" name="wr_8" value="<?php echo $member['mb_hp']; ?>"  id="wr_8"  class="required" size="14" maxlength="14"> 
				</td>
			</tr>
			<tr>
				<th scope="row"><label for="wr_9">입금자명<strong class="sound_only">필수</strong></th>
				<td>
					<input type="text" name="wr_9" value="<?php echo $member['mb_name']; ?>"  id="wr_9"  class="required" size="14" maxlength="14"> 
				</td>
			</tr>
			<tr>
				<th scope="row"><label for="wr_content">요청사항</th>
				<td>
					<input type="hidden" name="wr_3" id="wr_3" value="<?php echo $write['wr_3'];?>" >
					<input type="hidden" name="wr_10" id="wr_10" value="<?php echo $status?>" >
					<textarea  name="wr_content" id="wr_content"  class="required" size="8" style="width:600px;height:80px"> </textarea>
				</td>
			</tr>

			<!--
			<?php for ($i=1; $is_link && $i<=G5_LINK_COUNT; $i++) { ?>
			<tr>
				<th scope="row"><label for="wr_link<?php echo $i ?>">링크 #<?php echo $i ?></label></th>
				<td><input type="text" name="wr_link<?php echo $i ?>" value="<?php if($w=="u"){echo$write['wr_link'.$i];} ?>" id="wr_link<?php echo $i ?>" class="frm_input" size="50"></td>
			</tr>
			<?php } ?>
			-->

			<?php for ($i=0; $is_file && $i<$file_count; $i++) { ?>
			<tr>
				<th scope="row">파일 #<?php echo $i+1 ?></th>
				<td>
					<input type="file" name="bf_file[]" title="파일첨부 <?php echo $i+1 ?> : 용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능" class="frm_file frm_input">
					<?php if ($is_file_content) { ?>
					<input type="text" name="bf_content[]" value="<?php echo ($w == 'u') ? $file[$i]['bf_content'] : ''; ?>" title="파일 설명을 입력해주세요." class="frm_file frm_input" size="50">
					<?php } ?>
					<?php if($w == 'u' && $file[$i]['file']) { ?>
					<input type="checkbox" id="bf_file_del<?php echo $i ?>" name="bf_file_del[<?php echo $i;  ?>]" value="1"> <label for="bf_file_del<?php echo $i ?>"><?php echo $file[$i]['source'].'('.$file[$i]['size'].')';  ?> 파일 삭제</label>
					<?php } ?>
				</td>
			</tr>
			<?php } ?>

			<?php if ($is_guest) { //자동등록방지  ?>
			<tr>
				<th scope="row">자동등록방지</th>
				<td>
					<?php echo $captcha_html ?>
				</td>
			</tr>
			<?php } ?>

		</tbody>
	</table>

    <div class="btn_confirm">
        <input type="submit" value="신청서 작성완료" id="btn_submit" accesskey="s" class="btn_submit">
        <a href="./board.php?bo_table=<?php echo $bo_table ?>" class="btn_cancel">취소</a>
    </div>
    </form>

    <script>
	$(function(){ // 날짜 입력
		//$("#wr_1, #wr_2").datepicker({ changeMonth: true, changeYear: true, dateFormat: "yymmdd", showButtonPanel: true }); 
	});

    <?php if($write_min || $write_max) { ?>
    // 글자수 제한
    var char_min = parseInt(<?php echo $write_min; ?>); // 최소
    var char_max = parseInt(<?php echo $write_max; ?>); // 최대
    check_byte("wr_content", "char_count");

    $(function() {
        $("#wr_content").on("keyup", function() {
            check_byte("wr_content", "char_count");
        });
    });

    <?php } ?>
    function html_auto_br(obj)
    {
        if (obj.checked) {
            result = confirm("자동 줄바꿈을 하시겠습니까?\n\n자동 줄바꿈은 게시물 내용중 줄바뀐 곳을<br>태그로 변환하는 기능입니다.");
            if (result)
                obj.value = "html2";
            else
                obj.value = "html1";
        }
        else
            obj.value = "";
    }

    function fwrite_submit(f)
    {
        <?php echo $editor_js; // 에디터 사용시 자바스크립트에서 내용을 폼필드로 넣어주며 내용이 입력되었는지 검사함   ?>

        var subject = "";
        var content = "";
		<?php if ($is_guest) { //자동등록방지  ?>
		$("#wr_name").val($("#wr_7").val());
		<?php } ?>
        $.ajax({
            url: g5_bbs_url+"/ajax.filter.php",
            type: "POST",
            data: {
                "subject": f.wr_subject.value,
                "content": f.wr_content.value
            },
            dataType: "json",
            async: false,
            cache: false,
            success: function(data, textStatus) {
                subject = data.subject;
                content = data.content;
            }
        });

        if (subject) {
            alert("제목에 금지단어('"+subject+"')가 포함되어있습니다");
            f.wr_subject.focus();
            return false;
        }

		
        if (content) {
            alert("내용에 금지단어('"+content+"')가 포함되어있습니다");
            if (typeof(ed_wr_content) != "undefined")
                ed_wr_content.returnFalse();
            else
                f.wr_content.focus();
            return false;
        }

        if (document.getElementById("char_count")) {
            if (char_min > 0 || char_max > 0) {
                var cnt = parseInt(check_byte("wr_content", "char_count"));
                if (char_min > 0 && char_min > cnt) {
                    alert("내용은 "+char_min+"글자 이상 쓰셔야 합니다.");
                    return false;
                }
                else if (char_max > 0 && char_max < cnt) {
                    alert("내용은 "+char_max+"글자 이하로 쓰셔야 합니다.");
                    return false;
                }
            }
        }

        <?php echo $captcha_js; // 캡챠 사용시 자바스크립트에서 입력된 캡챠를 검사함  ?>

        document.getElementById("btn_submit").disabled = "disabled";

        return true;
    }
    </script>
</section>
<!-- } 게시물 작성/수정 끝 -->