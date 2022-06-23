<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
//include_once(G5_PLUGIN_PATH.'/jquery-ui/datepicker.php');

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
//echo '<link rel="stylesheet" href="'.THEMA_URL.'/assets/bs3/css/bootstrap.min.css" type="text/css">';
//echo '<link rel="stylesheet" href="'.COLORSET_URL.'/colorset.css" type="text/css">';
//echo '<link rel="stylesheet" href="'.$write_skin_url.'/write.css" media="screen">';
if(!$header_skin) { 
?>
<div class="section-title"><?php echo $g5['title'] ?></div>
<?php } ?>

<div class="section-title">모임 등록/수정</div>

<div class="boxContainer padding40">
<form name="fwrite" id="fwrite" action="<?php echo $action_url ?>" onsubmit="return fwrite_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off" role="form" class="form-horizontal">
<input type="hidden" name="uid" value="<?php echo get_uniqid(); ?>">
<input type="hidden" name="w" value="<?php echo $w ?>">
<input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
<input type="hidden" name="wr_id" value="<?php echo $wr_id ?>">
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
			if ($is_notice) {
				$option .= "\n".'<label class="control-label sp-label"><input type="checkbox" id="notice" name="notice" value="1" '.$notice_checked.'> 공지</label>';
			}

			if ($is_html) {
				if ($is_dhtml_editor) {
					$option_hidden .= '<input type="hidden" value="html1" name="html">';
				} else {
					$option .= "\n".'<label class="control-label sp-label"><input type="checkbox" id="html" name="html" onclick="html_auto_br(this);" value="'.$html_value.'" '.$html_checked.'> HTML</label>';
				}
			}

			if ($is_secret) {
				if ($is_admin || $is_secret==1) {
					$option .= "\n".'<label class="control-label sp-label"><input type="checkbox" id="secret" name="secret" value="secret" '.$secret_checked.'> 비밀글</label>';
				} else {
					$option_hidden .= '<input type="hidden" name="secret" value="secret">';
				}
			}

			if ($is_notice) {
				$main_checked = ($write['as_type']) ? ' checked' : '';
				$option .= "\n".'<label class="control-label sp-label"><input type="checkbox" id="as_type" name="as_type" value="1" '.$main_checked.'> 메인글</label>';
			}

			if ($is_mail) {
				$option .= "\n".'<label class="control-label sp-label"><input type="checkbox" id="mail" name="mail" value="mail" '.$recv_email_checked.'> 답변메일받기</label>';
			}
		}

		echo $option_hidden;
	?>

	<?php if ($is_name) { ?>
	<div class="form-group has-feedback">
		<label class="col-sm-2 control-label" for="wr_name">이름<strong class="sound_only">필수</strong></label>
		<div class="col-sm-3">
			<input type="text" name="wr_name" value="<?php echo $name ?>" id="wr_name" required class="form-control input-sm" size="10" maxlength="20">
			<span class="fa fa-check form-control-feedback"></span>
		</div>
	</div>
	<?php } ?>

	<?php if ($is_password) { ?>
	<div class="form-group has-feedback">
		<label class="col-sm-2 control-label" for="wr_password">비밀번호<strong class="sound_only">필수</strong></label>
		<div class="col-sm-3">
			<input type="password" name="wr_password" id="wr_password" <?php echo $password_required ?> class="form-control input-sm" maxlength="20">
			<span class="fa fa-check form-control-feedback"></span>
		</div>
	</div>
	<?php } ?>

	<?php if ($is_email) { ?>
	<div class="form-group">
		<label class="col-sm-2 control-label" for="wr_email">E-mail</label>
		<div class="col-sm-6">
			<input type="text" name="wr_email" id="wr_email" value="<?php echo $email ?>" class="form-control input-sm email input-full" size="50" maxlength="100">
		</div>
	</div>
	<?php } ?>

	<?php if ($is_homepage) { ?>
	<div class="form-group">
		<label class="col-sm-2 control-label" for="wr_homepage">홈페이지</label>
		<div class="col-sm-6">
			<input type="text" name="wr_homepage" id="wr_homepage" value="<?php echo $homepage ?>" class="form-control input-sm input-full" size="50">
		</div>
	</div>
	<?php } ?>

	<div class="form-group" style="display:none">
		<label class="col-sm-2 control-label hidden-xs">포토</label>
		<div class="col-sm-10">
			<input type="hidden" name="as_icon" value="<?php echo $write['as_icon'];?>" id="picon">
			<?php
				$fa_photo = (isset($boset['ficon']) && $boset['ficon']) ? apms_fa($boset['ficon']) : '<i class="fa fa-user"></i>';		
				$myicon = ($w == 'u') ? apms_photo_url($write['mb_id']) : apms_photo_url($member['mb_id']);
				$myicon = ($myicon) ? '<img src="'.$myicon.'">' : $fa_photo;
				if($write['as_icon']) {
					$as_icon = apms_fa(apms_emo($write['as_icon']));
					$as_icon = ($as_icon) ? $as_icon : $myicon;
				} else {
					$as_icon = $myicon;
				}
			?>
			<style>
				.write-wrap .talker-photo i { 
					<?php echo (isset($boset['ibg']) && $boset['ibg']) ? 'background:'.apms_color($boset['icolor']).'; color:#fff' : 'color:'.apms_color($boset['icolor']);?>; 
				}
			</style>
			<span id="ticon" class="talker-photo"><?php echo $as_icon;?></span>
			&nbsp;
			<div class="btn-group" data-toggle="buttons">
				<label class="btn btn-default" onclick="apms_emoticon('picon', 'ticon');" title="이모티콘">
					<input type="radio" name="select_icon" id="select_icon1">
					<i class="fa fa-smile-o fa-lg"></i><span class="sound_only">이모티콘</span>
				</label>
				<label class="btn btn-default" onclick="win_scrap('<?php echo G5_BBS_URL;?>/ficon.php?fid=picon&sid=ticon');" title="FA아이콘">
					<input type="radio" name="select_icon" id="select_icon2">
					<i class="fa fa-info-circle fa-lg"></i><span class="sound_only">FA아이콘</span>
				</label>
				<label class="btn btn-default" onclick="apms_myicon();" title="내사진">
					<input type="radio" name="select_icon" id="select_icon3">
					<i class="fa fa-user fa-lg"></i><span class="sound_only">내사진</span>
				</label>
			</div>
		</div>
	</div>
	<input type="hidden" name="wr_10" value="<?php echo $write['wr_10']?>" />
	<div class="form-group" style="display:none">
		<a class="btn btn-<?php echo $btn2;?> btn-sm" id="btnAddDays" style="width:300px">모임일시 일괄생성</a>
	</div>
	<div class="form-group none">
		<label class="col-sm-2 control-label hidden-xs">모임 스케쥴</label>
		<div class="col-sm-10">
			<p class="form-control-static text-muted" style="padding:0px; padding-top:4px;">
				<span class="cursor" onclick="add_class_item();"><i class="fa fa-plus-circle fa-lg"></i> 모임 일시 추가</span>
				&nbsp;
				<span class="cursor" onclick="del_class_item();"><i class="fa fa-times-circle fa-lg"></i> 모임 일시 삭제</span>
			</p>
		</div>
	</div>
	<div class="form-group none" style="margin-bottom:0;">
		<div class="col-sm-10 col-sm-offset-2">
			<table id="variableHistories"></table>
		</div>
	</div>
	<script>
	var hlen = 0;
	function add_class_item(delete_code,values) {
		var upload_count = <?php echo (int)$board['bo_upload_count']; ?>;
		/*if (upload_count && flen >= upload_count) {
			alert("이 게시판은 "+upload_count+"개 까지만 파일 업로드가 가능합니다.");
			return;
		}
		*/

		var objTbl;
		var objNum;
		var objRow;
		var objCell;
		var objContent;
		if (document.getElementById)
			objTbl = document.getElementById("variableHistories");
		else
			objTbl = document.all["variableHistories"];

		objNum = objTbl.rows.length;
		objRow = objTbl.insertRow(objNum);
		objCell = objRow.insertCell(0);

		objContent = "<div class='row'>";
		if (values) 
			objContent += values;
		else {
			//objContent += "<div class='col-sm-10'><div class='form-group col-sm-10'><div class='input-group input-group-sm  '><select name='cls_type[]' class=' input-small' style='display:none;width:0px'><option value='0' selected>본모임 </option><option value='1'>보조모임</option></select><input type='text' class=' input-small cls_date' name='cls_day[]' placeholder='모임일자 '>&nbsp;:&nbsp;&nbsp;<select class=' input-small' name='cls_time[]' placeholder='모임시간 ' style='padding-left:5px;'>";
			objContent += "<div class='col-sm-10'><div class='form-group col-sm-10'><div class='input-group input-group-sm  '><input type='hidden' name='cls_type[]' class=' input-small' /><input type='text' class='datepicker' name='cls_day[]' placeholder='모임일자 '>&nbsp;:&nbsp;&nbsp;<select class=' input-small' name='cls_time[]' placeholder='모임시간 ' style='padding-left:5px;'>";
			var t = "";
			for (var j = 8; j < 20;j++) {
				t = ((j<10)?"0":"")+j+":00";
				objContent += "<option value='"+t+"'>"+t+"</option>";
				t = ((j<10)?"0":"")+j+":30";
				objContent += "<option value='"+t+"'>"+t+"</option>";
			}
			t = ((j<10)?"0":"")+j+":00";
			objContent += "<option value='"+t+"'>"+t+"</option>";
				
			objContent += "</select><input type='text' class='form-control input-sm  col-sm-5' name='cls_content[]' placeholder='모임 해당 내용을 입력해주세요.' style='border:1px solid #d3d3d3;'></div></div></div>";
		}
		if (delete_code) {
			objContent += delete_code;
		} else {
			<?php if ($is_file_content) { ?>
			objContent += "<div class='col-sm-5'><div class='form-group'><input type='text'name='cls_content[]' class='form-control input-sm  col-sm-5' placeholder='주제'></div></div>";
			<?php } ?>
			;
		}
		objContent += "</div>";

		objCell.innerHTML = objContent;

		hlen++;
		<?php
		if ($w == '') { ?>
		addpicker();
		<?php } ?>
		//addpicker();
	}

	<?php //echo $class_item_script; //수정시에 필요한 스크립트?>

	function del_class_item() {
		// file_length 이하로는 필드가 삭제되지 않아야 합니다.
		var file_length = <?php echo (int)$file_length; ?>;
		var objTbl = document.getElementById("variableHistories");
		if (objTbl.rows.length - 1 > file_length) {
			objTbl.deleteRow(objTbl.rows.length - 1);
			hlen--;
		}
	}
	</script>

	<!------------------------------------------------------------------------------------------------------------------------------------------------------------------>
	<!------------------------------------------------------------------------------------------------------------------------------------------------------------------>
	<!------------------------------------------------------------------------------------------------------------------------------------------------------------------>
	
	<div class="tbl_frm01 tbl_wrap">
		<table>
			<colgroup>
				<col width="150">
				<col>
			</colgroup>

			<tbody>
				<?php
				// 모임유형 
				$moatypeOn = array("랜선소셜링", "랜선스터디", "랜선튜터링", "랜선활동");
				$moatypeOff = array("레슨", "모임", "클래스", "취미공유", "소셜링",);
				?>
				<tr>
					<th scope="row">모임형태</th>
					<td>
						<select  name="moa_onoff" id="moa_onoff" class="form-control input-sm input-small" style="padding-top:0;">
							<option value="온라인" <?php if ($write['moa_onoff'] == '온라인') {echo " selected ";} ?>>온라인</option>
							<option value="오프라인" <?php if ($write['moa_onoff'] == '오프라인') {echo " selected ";} ?>>오프라인</option>
						</select>
					</td>
				</tr>

				<tr>
					<th scope="row">쿠폰 적용 범위</th>
					<td>
						<input type="checkbox" name="" value="" checked data-label="전체" />
						<input type="checkbox" name="" value="" data-label="온라인" />
						<input type="checkbox" name="" value="" data-label="오프라인" />
						<input type="checkbox" name="" value="" data-label="게스트" />
						<input type="checkbox" name="" value="" data-label="호스트" />
					</td>
				</tr>
				<?php if ($is_category || $option) { ?>
				<tr>
					<th scope="row"><?php echo ($is_category) ? '카테고리 설정' : '옵션';?></th>
					<td>
						<?php if ($is_category) { ?>
						<select name="ca_name" id="ca_name" required class="form-control input-sm" style="padding-top:0;">
							<option value="">선택하세요</option>
							<?php echo $category_option ?>
						</select>
						<?php } ?>
						<?php if (false && $option) echo $option; ?>
					</td>
				</tr>
				<?php } ?>
				
				<tr>
					<th scope="row">모임타입</th>
					<td>
						<?php
						$cnt = 1;
						foreach($moatypeOn as $key => $value) {?>
							<input type="radio" name="moa_type" id="moa_type<?php echo $cnt;?>">
							<label for="moa_type<?php echo $cnt;?>"						
							 <?php if ($write['moa_type']==$value) { echo " checked ";} ?>
						><?php echo $value; ?></label>
						<?php 
							$cnt++;
						} 
						?>
						<?php foreach($moatypeOff as $key => $value) {?>
							<input type="radio" name="moa_type" id="moa_type<?php echo $cnt;?>">
							<label for="moa_type<?php echo $cnt;?>" 
						
							 <?php if ($write['moa_type']==$value) { echo " checked ";} ?>
						><?php echo $value; ?></label>
						&nbsp;&nbsp;
						<?php 
							$cnt++;
						} 
						?>
					</td>
				</tr>

				<?php if (false && $is_member) { // 임시 저장된 글 기능 ?>
				<tr>
					<th scope="row">모임타입</th>
					<td><?php if($editor_content_js) echo $editor_content_js; ?></td>
				</tr>
				<script src="<?php echo G5_JS_URL; ?>/autosave.js"></script>
				<?php } ?>

				<tr>
					<th scope="row">모임제목<strong class="sound_only">필수</strong></th>
					<td>
						<input type="text" name="wr_subject" value="<?php echo $subject ?>" id="wr_subject" required class="form-control input-sm input-full" size="50" maxlength="255" style="border:1px solid #d3d3d3;">
					</td>
				</tr>

				<tr>
					<th scope="row">모임내용<strong class="sound_only">필수</strong></th>
					<td>					
						<?php if($write_min || $write_max) { ?>
						<!-- 최소/최대 글자 수 사용 시 -->
						현재 <strong><span id="char_count"></span></strong> 글자이며, 최소 <strong><?php echo $write_min; ?></strong> 글자 이상, 최대 <strong><?php echo $write_max; ?></strong> 글자 이하까지 쓰실 수 있습니다.
						<?php } ?>
						<?php echo $editor_html; // 에디터 사용시는 에디터로, 아니면 textarea 로 노출 ?>
					</td>
				</tr>
				<tr>
					<th scope="row">커리큘럼</th>
					<td><textarea name="moa_curriculum" id="moa_curriculum" class="form-control input-sm input-full" cols="30" rows="5" ><?php echo stripslashes($write['moa_curriculum']);?></textarea></td>
				</tr>
				<tr>
					<th scope="row">모임진행시간</th>
					<td>
						<input type="text" name="moa_totime" id="moa_totime" value="<?php echo $write['moa_totime']; ?>" class=" input-sm input-small" size="50" style="border:1px solid #d3d3d3;">&nbsp;분
					</td>
				</tr>
				<tr>
					<th scope="row">신청가능시간</th>
					<td>
						모임<input type="text" name="moa_reglimittime" id="moa_reglimittime" value="<?php echo $write['moa_reglimittime']; ?>" class="form-control input-sm input-small" size="50">일 이전까지 신청가능
					</td>
				</tr>
				<tr>
					<th scope="row">모임포함사항</br><span style='color:gray;'>(선택)</span></th>
					<td>
						<input type="text" name="moa_support" id="moa_support" value="<?php echo $write['moa_support']; ?>" class="form-control input-sm input-full" size="50" style="border:1px solid #d3d3d3;">
					</td>
				</tr>
				<tr>
					<th scope="row">모임불포함사항</br><span style='color:gray;'>(선택)</span></th>
					<td>
						<input type="text" name="moa_nosupport" id="moa_nosupport" value="<?php echo $write['moa_nosupport']; ?>" class="form-control input-sm input-full" size="50" style="border:1px solid #d3d3d3;">
					</td>
				</tr>
				<tr>
					<th scope="row">준비물</br><span style='color:gray;'>(선택)</span></th>
					<td>
						<input type="text" name="moa_supplies" id="moa_supplies" value="<?php echo $write['moa_supplies']; ?>" class="form-control input-sm input-full" size="50" style="border:1px solid #d3d3d3;">
					</td>
				</tr>
				<tr>
					<th scope="row">키워드(해시태그)</br><span style='color:gray;'>(선택)</span></th>
					<td>
						<input type="text" name="as_tag" id="as_tag" value="<?php echo $write['as_tag']; ?>" class="form-control input-sm input-full" size="50" style="border:1px solid #d3d3d3;">
					</td>
				</tr>
				<script>
				$(function() {
					$("#moa_onoff").change(function() {
						onoffshow();
					});
					onoffshow();

					
				});
				function onoffshow() {

					var onoff = $("#moa_onoff option:selected").val();
					if (onoff == "온라인") {
						$(".online").show();
						$(".offline").hide();
					}
					else {
						$(".online").hide();
						$(".offline").show();
					}
				}
				</script>

				<?php // 지역1
				$sql = "SELECT * from deb_common_type where type_id like 'AREA%' order by type_id asc ";
				$result = sql_query($sql); ?>
				<tr>
					<th scope="row">지역</th>
					<td>
						<select  name="moa_area1" id="moa_area1" class="form-control input-sm input-small" style="padding-top:0;">							
							<option value="" >전체</option>
							<?php while ($row = sql_fetch_array($result)) {?>
							<option value="<?php echo $row['type_id'];?>" <?php if ($row['type_id'] == $write['moa_area1']) {echo " selected ";} ?>><?php echo $row['type_name'];?></option>
							<?php } ?>
						</select>
					</td>
				</tr>
				<?php //} ?>
				<?php // 지역1
				$sql = "SELECT * from deb_common_code where type_id like 'AREA01' order by cd_id asc ";
				$result = sql_query($sql); ?>
				<tr>
					<th>상세지역</th>
					<td>
						<select  name="moa_area2" id="moa_area2" class="form-control input-sm input-small" style="padding-top:0;">							
							<?php
							while ($row = sql_fetch_array($result)) {?>
							<option value="<?php echo $row['cd_id'];?>" <?php if ($row['cd_id'] == $write['moa_area2']) {echo " selected ";} ?>><?php echo $row['cd_name'];?></option>
							<?php } ?>
						</select>
					</td>
				</tr>
				<?php //} ?>
				<script>
				$(function() {
					$("#moa_area1").change(function() {
						var area1 = $("#moa_area1 option:selected").val();
						if (area1) {
							$.ajax({
								url: "/ajax/getArea2ofArea1.php",
								type: "POST",
								data: {
									"area1": area1
								},
								dataType: "text",
								async: false,
								cache: false,
								success: function(data) {
									$("#moa_area2").html(data);
								}
							});
						}
					});
				});
				</script>
				<?php 
				$addkind = array(
					1=>"모임정원", 
					2=>"참가료",
					3=>"할인참가료",
					4=>"",
					5=>"",
					6=>"",
					7=>"",
					8=>"",
				);
				$addkind2 = array(
					1=>"명", 
					2=>"원",
					3=>"원",
					4=>"",
					5=>"",
					6=>"",
					7=>"",
					8=>"",
				);
				$addcnt = count($addkind);
				for ($i=1; $is_link && $i<=$addcnt; $i++) { 
					if ($i < 4) {

					?>
					<tr>
						<th><?php echo $addkind[$i] ?></th>
						<td>
							<input type="<?php if ($i < 4) {echo "number";} else { echo "text";} ?>" name="wr_<?php echo $i ?>" value="<?php echo $write['wr_'.$i]; ?>" required id="wr_<?php echo $i ?>" class="form-control input-sm  required "  style="width:<?php if ($i < 4) {echo "200";} else { echo "400";} ?>px" placehonder="<?php echo $addkind2[$i];?>">
						</td>
					</tr>
					<?php } else { ?>
					<input type="hidden" name="wr_<?php echo $i?>" value="<?php echo $write['wr_'.$i]?>" />
					<?php
					}
				}
				?>


				<?php for ($i=1; $is_link && $i<=G5_LINK_COUNT; $i++) { ?>
				<tr class="none">
					<th>참조링크 #<?php echo $i ?></th>
					<td>
						<input type="text" name="wr_link<?php echo $i ?>" value="<?php echo $write['wr_link'.$i]; ?>" id="wr_link<?php echo $i ?>" class="form-control input-sm" size="50">
						<?php if($i == "1") { ?>
							<div class="text-muted font-12" style="margin-top:4px;">
								유튜브, 비메오 등 동영상 공유주소 등록시 해당 동영상은 본문 자동실행
							</div>
						<?php } ?>
					</td>
				</tr>
				<?php } ?>

				<?php if ($is_file) { ?>
				<tr>
					<th>모임 이미지</th>
					<td>
						<table id="variableFiles"></table>
					</td>
				</tr>
				<script>
				var flen = 0;
				function add_file(delete_code) {
					var upload_count = <?php echo (int)$board['bo_upload_count']; ?>;
					if (upload_count && flen >= upload_count) {
						alert("이 게시판은 "+upload_count+"개 까지만 파일 업로드가 가능합니다.");
						return;
					}

					var objTbl;
					var objNum;
					var objRow;
					var objCell;
					var objContent;
					if (document.getElementById)
						objTbl = document.getElementById("variableFiles");
					else
						objTbl = document.all["variableFiles"];

					objNum = objTbl.rows.length;
					objRow = objTbl.insertRow(objNum);
					objCell = objRow.insertCell(0);

					objContent = "<div class='row'>";
					objContent += "<div class='col-sm-7'><div class='form-group'><div class='input-group input-group-sm'><span class='input-group-addon'>파일 "+objNum+"</span><input type='file'  accept='image/*;capture=camera' class='form-control input-sm' name='bf_file[]' title='파일 용량 <?php echo $upload_max_filesize; ?> 이하만 업로드 가능'></div></div></div>";
					if (delete_code) {
						objContent += delete_code;
					} else {
						<?php if ($is_file_content) { ?>
						objContent += "<div class='col-sm-5'><div class='form-group'><input type='text'name='bf_content[]' class='form-control input-sm' placeholder='이미지에 대한 내용을 입력하세요.'></div></div>";
						<?php } ?>
						;
					}
					objContent += "</div>";

					objCell.innerHTML = objContent;

					flen++;
				}

				<?php echo $file_script; //수정시에 필요한 스크립트?>

				function del_file() {
					// file_length 이하로는 필드가 삭제되지 않아야 합니다.
					var file_length = <?php echo (int)$file_length; ?>;
					var objTbl = document.getElementById("variableFiles");
					if (objTbl.rows.length - 1 > file_length) {
						objTbl.deleteRow(objTbl.rows.length - 1);
						flen--;
					}
				}
				</script>
				<?php } ?>

				<?php if ($is_guest) { //자동등록방지  ?>
				<tr>
					<th>자동등록방지</th>
					<td><?php echo $captcha_html; ?></td>
				</tr>
				<?php } ?>
				
			</tbody>
		</table>
	</div>

	<div class="btn_fixed_top">
		<button type="submit" id="btn_submit" accesskey="s" class="btn_submit btn">작성완료</button>
		<a href="./board.php?bo_table=<?php echo $bo_table ?>" class="btn_02 btn">취소</a>
	</div>

</form>


















<script>

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

function apms_myicon() {
	document.getElementById("picon").value = '';
	document.getElementById("ticon").innerHTML = '<?php echo str_replace("'","\"", $myicon);?>';
	return true;
}

function html_auto_br(obj) {
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

function fwrite_submit(f) {

	<?php echo $editor_js; // 에디터 사용시 자바스크립트에서 내용을 폼필드로 넣어주며 내용이 입력되었는지 검사함   ?>

	var subject = "";
	var content = "";
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

$(function(){
	$("#wr_content").addClass("form-control input-sm write-content");
});
</script>
