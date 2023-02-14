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

<!--<div class="section-title">모임 --><?php //echo ($w=='u')?'수정':'등록'; ?><!--</div>-->


<!------------------------------------------------------------------------------------------------------------------------------------------------------------------>
<!------------------------------------------------------------------------------------------------------------------------------------------------------------------>
<!------------------------------------------------------------------------------------------------------------------------------------------------------------------>

<div class="boxContainer padding40">
	<form name="fwrite" id="fwrite" action="<?php echo $action_url ?>" onsubmit="return fwrite_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off" role="form" class="form-horizontal">
	<input type="hidden" name="uid" value="<?php echo get_uniqid(); ?>">
        <input type="hidden" name="ap" value="moa_write" />
        <input type="hidden" name="returnUrl" value="<? echo $returnUrl; ?>" />
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
	
	<div class="wr-wrap gap10 label200">

		<div class="wr-list">
			<div class="wr-list-label required">모임 대표이미지</div>
			<div class="wr-list-con">
				<div class="fileContainer">									
					<div class="inner">
						<input type="file" name="bf_file[]" id="upload-01" class="multiple" accept="image/*" multiple>
						<label for="upload-01" class="upload-btn">모임 대표 이미지 업로드</label>
						<p class="help-block fs13">
							최소 1장 최대 5장의 이미지를 올려주세요.<br>
							권장 사이즈 : 가로 1000px * 세로 1000px<br>
<!--							최소 사이즈 : 가로 600px * 세로 600px <br> -->
							용량 : 10MB 이하 <br>
							파일 유형 : JPG, PNG, GIF
						</p>										
					</div>
					<?
					$today = date("Y-m-d");
					$fileSeq = 0;
					for($inx = 1; $inx <= 5; $inx++){
						$fileVal = addslashes(get_text($file[$fileSeq]['bf_content']));
						?>
						<input type="file" name="bf_file[]" id="upload-01<?= $inx ?>" <? echo 'data-key="'.$today.''.$inx.'"'; ?> value="<? echo $fileVal; ?>">
						<input type="hidden" name="bf_file_del[]" id="upload-del-01<?= $inx ?>" <? echo 'data-key="'.$today.''.$inx.'"'; ?>>
						<?
					} ?>	
					<ul class="upImg-list mt5">
					<!--
                        <li>
							<img src="<?php echo $write['as_thumb'] ?>"><span class="del" <? echo 'data-key="'.date("Y-m-d").$i.'"'; ?>></span>
						</li>
						-->
						<?
						$uploadKey = 0;
						if ($w == "u") {
							for ($i=1; $i<$file['count']; $i++) {
								if($file[$i]['view'] == null || $file[$i]['view'] == '') {
									continue;
								}
								echo '
								<li>
									'.($file[$i]['view']).'<span class="btn small del" data-key="'.date("Y-m-d").$i.'">삭제</span>
								</li>';
								$uploadKey++;
							}
						}
						?>
                        <li><label for="upload-01" class="upload-empty">사진 추가</label></li>
					</ul>
				</div>
			</div>
		</div>
		<div class="wr-list">
			<div class="wr-list-label required">모임 형태</div>
			<div class="wr-list-con">
				<input type="radio" name="moa_onoff" value="온라인" <?php if(!$write['moa_onoff'] | $write['moa_onoff'] == '온라인') echo 'checked'?> data-label="온라인" />
				<input type="radio" name="moa_onoff" value="오프라인" <?php if($write['moa_onoff'] == '오프라인') echo 'checked'?>  data-label="오프라인" />				
			</div>
		</div>
		<div class="wr-list">
			<div class="wr-list-label required">모임 유형</div>
			<div class="wr-list-con">
			<!--
				<input type="radio" name="moa_form" value="자율형" <?php if($write['moa_form'] == '자율형') echo 'checked'?> data-label="자율형" />
-->
				<input type="radio" name="moa_form" value="고정형" <?php if(!$write['moa_form'] | $write['moa_form'] == '고정형') echo 'checked'?> data-label="고정형" />	
			</div>
		</div>

		<div class="wr-list flex-top">
			<div class="wr-list-label required">모임 스케쥴</div>
			<div class="wr-list-con">
				<div id="moim-msg" class="color-red">해당 내용은 게스트와 직접 협의 후 진행합니다!</div>
				<div class="tbl-excel auto relative" id="moimSchedule">
					<div class="flex flex-right" style="position:absolute;top:-40px;right:0;">
						<span class="add-list btn small reverse">회차 추가</span>
					</div>
					<table>
						<colgroup>
							<col width="90">
							<col width="190">
							<col>
							<col width="120">
							<col>
							<col>
						</colgroup>
						<thead>
							<tr>
								<th>회차</th>
								<th>날짜</th>
								<th>시간</th>
								<th>진행시간</th>
								<!-- <th>모임 인원</th> -->
							</tr>
						</thead>
						<tbody class="last_none">
                        <?php if($w == 'u') { ?>
                        <?php for($j=0;$j<count($write['cls_no']);$j++) { ?>
							<tr>
								<th><span class="num">회차</span></th>
								<td class="bg">
									<label class="inp-wrap inline-label span">
                                        <input type="text" name="cls_day[]" value="<?php echo $write['cls_no'][$j]['day']; ?>" class="span datepicker" placeholder="날짜 선택" >
                                        <span class="label-inline"></span>
                                    </label>
								</td>
								<td class="bg">
									<div class="flex">
										<select name="cls_time[]" class="" title="몇시">
											<option value="">몇시</option>
											<?php for($i=1; $i<=24; $i++) {
												$i = $i < 10 ? '0'.$i:$i;
                                                $time = $write['cls_no'][$j]['time'] == $i ? 'selected' : '';
												echo '<option value="'.$i.'"' . $time . ' >'.$i.'시</option>';
											} ?>
										</select>
										<select name="cls_minute[]" class="" title="몇분">
											<option value="">몇분</option>
											<?php for($i=0; $i<=59; $i+=10) {
												$i = $i < 10 ? '0'.$i:$i;
                                                $minute = $write['cls_no'][$j]['minute'] == $i ? 'selected' : '';
												echo '<option value="'.$i.'" ' . $minute .' >'.$i.'분</option>';
											} ?>
										</select>
									</div>
								</td>
								<td class="bg">
									<label class="inp-wrap inline-label span">
                                        <input type="text" name="cls_timelimit[]" value="<?php echo $write['cls_no'][$j]['timelimit'] ?>" class="span" min="10" maxlength="3"><span class="label-inline">분</span></label>
								</td>
								<!-- <td class="bg">
									<div class="flex flex-middle">
										<input type="text" name="cls_minman[]" value="" class="span80" placeholder="" data-label="최소" data-label-inline="명">
										<span class="color-light">~</span>
										<input type="text" name="cls_maxman[]" value="" class="span80" placeholder="" data-label="최대" data-label-inline="명">
									</div>
								</td> -->
                                <?php if($j>0) { ?>
                                <td class="bg">
                                    <div class="flex flex-middle relative">
                                        <span class="btn small gray del-list" style="" clsid="<?=$write['cls_no'][$j]['id']?>">삭제</span>
                                    </div>
                                </td>
                                <?php } ?>
							</tr>
                        <?php }
                        } else { ?>
                            <tr>
                                <th><span class="num">회차</span></th>
                                <td class="bg">
                                    <label class="inp-wrap inline-label span">
                                        <input type="text" name="cls_day[]" value="" class="span datepicker" placeholder="날짜 선택">
                                        <span class="label-inline"></span>
                                    </label>
                                </td>
                                <td class="bg">
                                    <div class="flex">
                                        <select name="cls_time[]" class="" title="몇시">
                                            <option value="">몇시</option>
                                            <?php for($i=1; $i<=24; $i++) {
                                                $i = $i < 10 ? '0'.$i:$i;
                                                echo '<option value="'.$i.'" >'.$i.'시</option>';
                                            } ?>
                                        </select>
                                        <select name="cls_minute[]" class="" title="몇분">
                                            <option value="">몇분</option>
                                            <?php for($i=0; $i<=59; $i+=10) {
                                                $i = $i < 10 ? '0'.$i:$i;
                                                echo '<option value="'.$i.'" >'.$i.'분</option>';
                                            } ?>
                                        </select>
                                    </div>
                                </td>
                                <td class="bg">
                                    <label class="inp-wrap inline-label span">
                                        <input type="text" name="cls_timelimit[]" value="" class="span" min="10" maxlength="3"><span class="label-inline">분</span></label>
                                </td>
                            </tr>
                        <?php }?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<!--
		<div class="wr-list" id="moimSchedule2">
			<div class="wr-list-label required">신청 가능 시간</div>
			<div class="wr-list-con">
				<input type="number" min="3" name="moa_reglimittime"  id="moa_reglimittime" value="<?php echo $write['moa_reglimittime']; ?>" class="span100" placeholder="" min="1" max="100" data-label="모임" data-label-inline="일"> 이전까지 신청 가능 (최소 3일)
			</div>
		</div>
		-->
		<input type="hidden" name="moa_reglimittime"  id="moa_reglimittime" value="0">
		
        <script>
		$('#moa_reglimittime').focusout(function(){
			if (($(this).val() < 3 || !$.isNumeric($(this).val())) && $(this).val() != '') {
				//alert('숫자만 입력해주세요');
				$(this).val('');
				$(this).focus();
			}
		});
        </script>
		<?php 
		$addkind = array(
			1=> "최소인원",
			2=>"모임정원",
			3=>"참가료",
			4=>"할인참가료",
			5=>"",
			6=>"",
			7=>"",
			8=>"",
			9=>"",
		);
		$addkind2 = array(
			1=>"명",
			2=>"명",
			3=>"원",
			4=>"원",
			5=>"",
			6=>"",
			7=>"",
			8=>"",
			9=>"",
		);
		$addcnt = count($addkind);
		for ($i=1; $is_link && $i<=$addcnt; $i++) {
			if ($i < 5) {
				?>
				<div class="wr-list" >
					<div class="wr-list-label required"><?php echo $addkind[$i] ?></div>
					<div class="wr-list-con">
						<input type="<?php if ($i < 5) {echo "number";} else { echo "text";} ?>"
							name="wr_<?php echo $i ?>" value="<?php echo $write['wr_'.$i]; ?>" required 
							<?php if($i == 4) echo ' step="100" '; ?>
							id="wr_<?php echo $i ?>"
							max="<?php if ($i==2 || $i==5) { echo "100";} else { echo "1000000"; } ?>"
							class="form-control input-sm  required onlyNumbers"  style="width:<?php if ($i < 5) {echo "200";} else { echo "400";} ?>px" placehonder="<?php echo $addkind2[$i];?>">
							<?php if($i == '4') { ?>
								<small>실제 결제되는 금액(천원 단위 - 할인을 원치 않는 경우 참가료와 동일한 금액을 입력해 주세요. )</small>
							<?php } ?>
					</div>
				</div>
				<?php 
			} else { ?>
				<input type="hidden" name="wr_<?php echo $i?>" value="<?php echo $write['wr_'.$i]?>" />
			<?php
			}
		}
		?>
		<script>
			function checkValidCost(){
				var cost = $('#wr_3').val();
				var discountedCost = $('#wr_4').val();

				if(Number(cost) < Number(discountedCost)) {
					alert('할인 참가료는 참가료보다 클 수 없습니다.');
					$('#wr_4').val(0);
					return false;
				}
				return true;
			}
		$(document).ready(function(){
			$('#wr_4').change(function(){
				var n = $(this).val(); 
				var cost = $('#wr_3').val();
				if(!checkValidCost()) {
					return false;
				}
//				n = Math.floor(n/1000) * 1000; 
				n = Math.floor(n/100) * 100; 
				$(this).val(n);
			});
			$('#wr_3').change(function(){
				if(!checkValidCost()) {
					return false;
				}
			});
			$('#wr_2').change(function(){
				var wr_1 = $('#wr_1').val();
				var wr_2 = $('#wr_2').val();
				if(Number(wr_2) <= Number(wr_1)) {
					alert("모임 정원은 최소 인원보다 크게 설정해주세요.");
					return false;
				}
				return true;
			});
		});
        </script>
		<div style="margin-top:50px;margin-bottom:50px;border-top:1px dashed rgba(0,0,0,0.08);"></div>
		<div class="wr-list" >
			<div class="wr-list-label required">모임 제목</div>
			<div class="wr-list-con">
				<input type="text" onkeyup="characterCheck(this)" name="wr_subject" value="<?php echo $subject ?>" id="wr_subject" required class="span900" placeholder="모임 제목을 입력해주세요.(한글, 영문, 숫자만 입력해주세요)" size="50" maxlength="255">
			</div>
		</div>
        <script>
            // 특수문자 입력 방지
            function characterCheck(obj){
                var regExp = /[\{\}\/?.,;:|*~`!^\-_+┼<>@\#$%\\\=]/gi;
                // 허용할 특수문자는 여기서 삭제하면 됨
                if( regExp.test(obj.value) ){
                    alert("특수문자는 입력하실수 없습니다.");
                    obj.value = obj.value.substring( 0 , obj.value.length - 1 ); // 입력한 특수문자 한자리 지움
                }
            }
        </script>
		<div class="wr-list">
			<div class="wr-list-label required">카테고리 설정</div>
			<div class="wr-list-con flex">
				<?php if ($is_category) { ?>
				<select name="ca_name" id="ca_name" required>
					<option value="">상위 카테고리</option>
					<?php echo $category_option ?>
				</select>
				<?php } ?>
			</div>
		</div>
		<div class="wr-list">
			<div class="wr-list-label required">모임타입</div>
			<div class="wr-list-con">
				<?php
				// 모임유형
				$moimtype_online = array("랜선소셜링", "랜선스터디", "랜선튜터링", "랜선활동");
				$moimtype_offline = array("레슨", "모임", "클래스", "취미공유", "소셜링");
				$cnt = 1;
				echo '<div id="moimtype_online">';
				foreach($moimtype_online as $key => $value) {
					echo '<input type="radio" name="moa_type" value="'.$value.'" id="moa_type'.$cnt.'" data-label="'.$value.'"';
					if($write['moa_type']==$value) echo ' checked';
					echo '>';				 
					$cnt++;
				}
				echo '</div>';
				echo '<div id="moimtype_offline">';
				foreach($moimtype_offline as $key => $value) {
					echo '<input type="radio" name="moa_type" value="'.$value.'" id="moa_type'.$cnt.'" data-label="'.$value.'"';
					if($write['moa_type']==$value) echo ' checked';
					echo '>';				 
					$cnt++;
				}
				echo '</div>';
				?>
			</div>
		</div>
<!--		<div class="wr-list" id="li-map">-->
<!--			<div class="wr-list-label required">장소</div>-->
<!--			<div class="wr-list-con">-->
<!--				<input type="text" name="moa_addr1" id="moa_addr1" value="--><?php //echo $write['moa_addr1']; ?><!--" r equired class="span600" placeholder="장소를 입력해주세요.">-->
<!--				<div class="mt10"><img src="--><?php //echo $write_skin_url?><!--/temp/tmp_map.png"></div>-->
<!--			</div>-->
<!--		</div>-->

        <div class="wr-list">
            <input type="hidden" value="" id="moa_area1" name="moa_area1" readonly />
            <input type="hidden" readonly value="" id="moa_area2" name="moa_area2" />
            <div class="wr-list">
                <div class="wr-list-label required">주소</div>
            <div>
                <input type="hidden" name="moa_postcode" id="moa_postcode" class="form-control span300" />
                <input type="text" value="<?php echo $write['moa_addr1'] ?>" id="moa_jibun" placeholder="주소를 입력해주세요." name="moa_addr1"  readonly class="span700 form-control input-sm" />
                <button type="button" onclick="sample4_execDaumPostcode()" class="btn">주소 찾기</button><br>
                <input type="text" name="moa_addr2" class="span700 form-control input-sm" placeholder=" "/>
            </div>
        </div>
	</div>
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
						$('select').selectpicker('refresh');
					}
				});
			}
		});
	});
	</script>
		<div class="wr-list">
			<div class="wr-list-label required">모임 상세 설명</div>
			<div class="wr-list-con">
				<span class="color-red"><?php echo $editor_html; // 에디터 사용시는 에디터로, 아니면 textarea 로 노출 ?></span>
			</div>
		</div>
		<div class="wr-list">
			<div class="wr-list-label required">모임 커리큘럼</div>
			<div class="wr-list-con">
				<textarea name="moa_curriculum" id="moa_curriculum" class="form-control input-sm input-full" cols="30" rows="5" ><?php echo stripslashes($write['moa_curriculum']);?></textarea>
			</div>
		</div>

		

		

		<div style="margin-top:50px;margin-bottom:50px;border-top:1px dashed rgba(0,0,0,0.08);"></div>

		<div class="wr-list flex-top none">
			<div class="wr-list-label required">모임진행 순서</div>
			<div class="wr-list-con">
				<div class="flex mb10">
					<input type="radio" name="moim_program" value="1" checked data-label="시간표로 작성" />
					<!-- <input type="radio" name="moim_program" value="2" data-label="구간표로 작성" />	
					<input type="radio" name="moim_program" value="3" data-label="기타" /> -->
				</div>

				<div class="tbl-excel auto" id="moim-program1">
					<table>
						<colgroup>
							<col width="120">
							<col>
						</colgroup>
						<thead>
							<tr>
								<th>시간</th>
								<th>모임내용</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td class="bg">
									<label class="inp-wrap inline-label span"><input type="text" name="moa_time[]" value="" class="span" maxlength="2"><span class="label-inline">분</span></label>
								</td>
								<td class="bg">
									<div class="flex flex-middle">
										<input type="text" name="moa_time_content[]" value="" class="span600" placeholder="모임 해당 내용을 입력해주세요.">
									</div>
								</td>
							</tr>
						</tbody>
						<tfoot>
							<tr>
								<td colspan="2" class="padding0">
									<span class="add-list">+ 추가하기</span>
								</td>								
							</tr>								
						</tfoot>
					</table>
				</div>

				<div class="tbl-excel auto" id="moim-program2">
					<table>
						<colgroup>
							<col>
							<col>
						</colgroup>
						<thead>
							<tr>
								<th>시간</th>
								<th>모임내용</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td class="bg">
									<div class="flex flex-middle">
										<input type="text" name="moa_time21[]" value="" class="span80" placeholder="00:00">
										<span class="color-gray">~</span>
										<input type="text" name="moa_time22[]" value="" class="span80" placeholder="00:00">
									</div>
								</td>
								<td class="bg">
									<div class="flex flex-middle">
										<input type="text" name="moa_time_content2[]" value="" class="span600" placeholder="모임 해당 내용을 입력해주세요.">
									</div>
								</td>
							</tr>
						</tbody>
						<tfoot>
							<tr>
								<td colspan="2" class="padding0">
									<span class="add-list">+ 추가하기</span>
								</td>								
							</tr>								
						</tfoot>
					</table>
				</div>
			
				<div class="tbl-excel auto" id="moim-program3">
					<table>
						<colgroup>
							<col width="200">
							<col>
						</colgroup>
						<thead>
							<tr>
								<th>사용자 임의</th>
								<th>모임내용</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td class="bg">
									<input type="text" name="moa_time3[]" value="" class="span">
								</td>
								<td class="bg">
									<div class="flex flex-middle">
										<input type="text" name="moa_content3[]" value="" class="span600" placeholder="모임 해당 내용을 입력해주세요.">
									</div>
								</td>
							</tr>
						</tbody>
						<tfoot>
							<tr>
								<td colspan="2" class="padding0">
									<span class="add-list">+ 추가하기</span>
								</td>								
							</tr>								
						</tfoot>
					</table>
				</div>

			</div>

		</div>

		<div class="wr-list">
			<div class="wr-list-label">모임포함사항<small class="block gray">(선택)</small></div>
			<div class="wr-list-con">
				<input type="text" name="moa_support" value="<?php echo $write['moa_support']; ?>" class="span500" placeholder="모임 포함 사항을 입력하세요.">
				<div class="mt10"><span class="srtag">※복수입력시 ,로 구분해서 입력해주세요</span></div>
				<!-- <a href="#" class="btn reverse span100">등록</a>
				<div class="mt10">
					<span class="srtag">태그A<i class="del"></i></span>
					<span class="srtag">태그B<i class="del"></i></span>
					<span class="srtag">태그C<i class="del"></i></span>
					<span class="srtag">태그D<i class="del"></i></span>
				</div> -->
			</div>
		</div>
		<div class="wr-list">
			<div class="wr-list-label">모임불포함사항<small class="block gray">(선택)</small></div>
			<div class="wr-list-con">
				<input type="text" name="moa_nosupport" value="<?php echo $write['moa_nosupport']; ?>" class="span500" placeholder="모임 불포함 사항을 입력하세요.">
				<div class="mt10"><span class="srtag">※복수입력시 ,로 구분해서 입력해주세요</span></div>
				<!-- <a href="#" class="btn reverse span100">등록</a>
				<div class="mt10">
					<span class="srtag">태그A<i class="del"></i></span>
					<span class="srtag">태그B<i class="del"></i></span>
					<span class="srtag">태그C<i class="del"></i></span>
					<span class="srtag">태그D<i class="del"></i></span>
				</div> -->
			</div>
		</div>
		<div class="wr-list">
			<div class="wr-list-label">준비물<small class="block gray">(선택)</small></div>
			<div class="wr-list-con">
				<input type="text" name="moa_supplies" value="<?php echo $write['moa_supplies']; ?>" class="span500" placeholder="준비물을 입력하세요.">
				<div class="mt10"><span class="srtag">※복수입력시 ,로 구분해서 입력해주세요</span></div>
				<!-- <a href="#" class="btn reverse span100">등록</a>
				<div class="mt10">
					<span class="srtag">태그A<i class="del"></i></span>
					<span class="srtag">태그B<i class="del"></i></span>
					<span class="srtag">태그C<i class="del"></i></span>
					<span class="srtag">태그D<i class="del"></i></span>
				</div> -->
			</div>
		</div>
		<?
		/*
		<div class="wr-list">
			<div class="wr-list-label">키워드(해시태그)<small class="block gray">(선택)</small></div>
			<div class="wr-list-con">
				<input type="text" name="as_tag" value="<?php echo $write['as_tag']; ?>" class="span500" placeholder="키워드를 입력하세요.">
				<div class="mt10"><span class="srtag">※복수입력시 ,로 구분해서 입력해주세요</span></div>
				<!-- <a href="#" class="btn reverse span100">등록</a>
				<div class="mt10">
					<span class="srtag">태그A<i class="del"></i></span>
					<span class="srtag">태그B<i class="del"></i></span>
					<span class="srtag">태그C<i class="del"></i></span>
					<span class="srtag">태그D<i class="del"></i></span>
				</div> -->
			</div>
		</div>
		*/
		?>
		<?php 
			$statuscombo = array(
				'0'=>'준비',
				'1'=>'승인',
				'2'=>'반려',
				'3'=>'삭제', 
				'4'=>'취소',
				'5'=>'폐강'
			);
		if ($is_admin) { 
			$statuslist = $statuscombo;
		}
		else {
			$statuslist = array();
			$statuslist[$write['moa_write']] = $statuscombo[$write['moa_write']];
			if ($write['moa_write'] != '4')
				$statuslist['4'] = $statuscombo['4'];
			if ($write['moa_write'] != '5')
				$statuslist['5'] = $statuscombo['5'];
			
		}
		
		?>
	</div>

	<div class="btn_fixed_top">
		<button type="submit" id="btn_submit" accesskey="s" class="btn_submit btn">작성완료</button>
		<a href="./?ap=list" class="btn_02 btn">취소</a>
	</div>

</div>





<script>
//모임형태값이 바뀔때
function moim_type1_change(val) {
	if(val == '온라인') {
		$('#moimtype_online').show();
		$('#moimtype_offline').hide();
		$('#li-map').hide();
	} else {
		$('#moimtype_online').hide();
		$('#moimtype_offline').show();
		$('#li-map').show();
	}
}
//모임유형값이 바뀔때
function moim_type2_change(val) {
	if(val == '자율형') {
		$('#moim-msg').show();
		$('#moimSchedule, #moimSchedule2').hide();		
	} else {
		$('#moim-msg').hide();
		$('#moimSchedule, #moimSchedule2').show();
	}
}

//모임진행 순서값이 바뀔때
function moim_program_change(val) {
	if(val == '2') {
		$('#moim-program1').show();
		$('#moim-program2').hide();
		$('#moim-program3').hide();
	} else if(val == '3') {
		$('#moim-program1').hide();
		$('#moim-program2').show();
		$('#moim-program3').hide();
	} else {
		$('#moim-program1').hide();
		$('#moim-program2').hide();
		$('#moim-program3').show();
	}
}


$(document).ready(function(){
	let moim_type1 = $('input[name="moa_onoff"]'),
		moim_type2 = $('input[name="moa_form"]'),
		moim_program = $('input[name="moim_program"]');

	moim_type1_change($('input[name="moa_onoff"]:checked').val());
	moim_type1.change(function (){
		moim_type1_change($(this).val());
	});

	moim_type2_change($('input[name="moa_form"]:checked').val());
	moim_type2.change(function (){
		moim_type2_change($(this).val());
	});

	moim_program_change($('input[name="moim_program"]:checked').val());
	moim_program.change(function (){
		moim_program_change($(this).val());
	});
});

//모임스케쥴 추가/삭제
$(function() {
	$(document).on("click", "#moimSchedule .add-list", function() {
		add_list();
	});
	$(document).on("click", "#moimSchedule .del-list", function() {
		if(!confirm("선택하신 회차가 삭제됩니다. 계속하시겠습니까?")) { return false; }
		var $tr = $(this).closest("tr");
		if ($(this).attr('clsid') != ""){
			$.ajax({
				type: "POST", url: '/ajax/moim_schedule_remove.php',
				data: {'cls_id': $(this).attr('clsid'), 'wr_id': <?=$wr_id?>},
				cache: false,  async: false, dataType: "text",
				success: function (data) {
					//console.log(data); return false;
					if (data === "success"){
						$tr.remove();
					}else{
						alert('데이터 처리중 오류가 발생하였습니다.'); return false;
					}
				}
			})
		}else{
			$tr.remove();
		}
	});
});
function add_list() {
	var $moim = $("#moimSchedule");
	var list = '<tr>';
	list += '		<th><span class="num">회차</span></th>';
	list += '		<td class="bg">';
	list += '			<label class="inp-wrap inline-label span"><input type="text" name="cls_day[]" value="" class="span datepicker" placeholder="날짜 선택"><span class="label-inline"></span></label>';
	list += '		</td>';
	list += '		<td class="bg">';
	list += '			<div class="flex">';
	list += '				<select name="cls_time[]" class="" title="몇시"><option value="">몇시</option>';
	<?php for($i=1; $i<=24; $i++) {
		$i = $i < 10 ? "0".$i:$i;
	?>
	list += '					<option value="<?php echo $i?>"><?php echo $i?>시</option>';
	<?php } ?>
	list += '				</select>';
	list += '				<select name="cls_minute[]" class="" title="몇분"><option value="">몇분</option>';
	<?php for($i=0; $i<=59; $i+=10) {
		$i = $i < 10 ? "0".$i:$i;
	?>
	list += '					<option value="<?php echo $i?>" ><?php echo $i?>분</option>';
	<?php } ?>
	list += '				</select>';
	list += '			</div>';
	list += '		</td>';
	list += '		<td class="bg">';
	list += '			<label class="inp-wrap inline-label span"><input type="text" name="cls_timelimit[]" value="" min="10" class="span" maxlength="3"><span class="label-inline">분</span></label>	';
	list += '		</td>';
	list += '		<td cla ss="bg">';
    list += '			<div cl ass="flex flex-middle relative">';
	// list += '				<label class="inp-wrap left-label inline-label"><span class="label">최소</span>';
	//list += '<input type="text" name="cls_minman" value="" class="span80" placeholder=""><span class="label-inline">명</span></label>';
	// list += '				<span class="color-light">~</span>';
	// list += '				<label class="inp-wrap left-label inline-label"><span class="label">최대</span>';
	// list += '<input type="text" name="cls_maxman" value="" class="span80" placeholder=""><span class="label-inline">명</span></label>';
	list += '				<span class="btn small gray del-list" style="" clsid="">삭제</span>';
	list += '			</div>';	
	list += '		</td>';
	list += '</tr>';
	var $tr_last = null;
	var $tr_last = $moim.find("tbody tr:last");
	$tr_last.after(list);
	$('select').selectpicker('refresh');

    $('input.datepicker').each(function(i) {
        if(!$(this).parent().hasClass('inp-wrap')) $(this).wrap('<label class="inp-wrap"></label>');
        if($(this).next('span').length == 0) $(this).after('<span></span>');
        var is_autoPick = typeof $(this).attr('placeholder') !== typeof undefined && $(this).attr('placeholder') !== '' ? false : true;

        $(this).datepicker({
            language: 'ko-KR',
            autoPick: is_autoPick,
            format: 'yyyy-mm-dd',
            startDate: $('input.datepicker').eq(i-1).val(),
        }).on('change', function(e){
            $(this).datepicker('hide');
            $('input.datepicker').eq(i+1).val('');
            $('input.datepicker').eq(i+1).datepicker('setStartDate', e.currentTarget.value);
        })
    });

    $('input[name="cls_timelimit[]"]').on('focusout',function(){
        if (($(this).val() < 0 || !$.isNumeric($(this).val())) && $(this).val() != '') {
            alert('숫자만 입력해주세요');
            $(this).val('');
            $(this).focus();
        }
    });
}
$('input[name="cls_day[]"]').each(function(){
    $('input.datepicker').each(function(i) {
        if(!$(this).parent().hasClass('inp-wrap')) $(this).wrap('<label class="inp-wrap"></label>');
        if($(this).next('span').length == 0) $(this).after('<span></span>');
        var is_autoPick = typeof $(this).attr('placeholder') !== typeof undefined && $(this).attr('placeholder') !== '' ? false : true;

        var today = new Date(),
            y = today.getFullYear(),
            m = today.getMonth()+1,
            d = today.getDate();
        var date = y + '-' + m + '-' + d
        if(i > 0) {date = $(this).eq(i-1).val()}
        $(this).datepicker({
            language: 'ko-KR',
            autoPick: is_autoPick,
            format: 'yyyy-mm-dd',
            startDate: date,
        }).on('change', function(e){
            $(this).datepicker('hide');
            $('input.datepicker').eq(i+1).datepicker('setStartDate', e.currentTarget.value);
        })
    });
})
//모임 진행 순서 [시간표로 작성]
$(function() {
	$(document).on("click", "#moim-program1 .add-list", function() {
		add_moim_program1_list();
	});
	$(document).on("click", "#moim-program1 .del-list", function() {
		if(!confirm("선택하신 시간표가 삭제됩니다. 계속하시겠습니까?"))
			return false;
		var $tr = $(this).closest("tr");
		$tr.remove();        
	});
});
function add_moim_program1_list() {
	var $moim = $("#moim-program1");
	var list = '<tr>';
	list += '<td class="bg"><label class="inp-wrap inline-label"><input type="text" name="" value="" class="span" maxlength="2"><span class="label-inline">분</span></label></td>';
	list += '<td>';
	list += '<div class="flex flex-middle">';
	list += '<input type="text" name="" value="" class="span" placeholder="모임 해당 내용을 입력해주세요.">';
	list += '<span class="btn small gray del-list">삭제</span>';
	list += '</div>';
	list += '</td>';
	list += '</tr>';
	var $tr_last = null;
	var $tr_last = $moim.find("tbody tr:last");
	$tr_last.after(list);
	$('select').selectpicker('refresh');
}

//모임 진행 순서 [구간표로 작성]
$(function() {
	$(document).on("click", "#moim-program2 .add-list", function() {
		add_moim_program2_list();
	});
	$(document).on("click", "#moim-program2 .del-list", function() {
		if(!confirm("선택하신 구간표가 삭제됩니다. 계속하시겠습니까?"))
			return false;
		var $tr = $(this).closest("tr");
		$tr.remove();        
	});
});
function add_moim_program2_list() {
	var $moim = $("#moim-program2");
	var list = '<tr>';
	list += '<td class="bg">';
	list += '<div class="flex flex-middle">';
	list += '<input type="text" name="" value="" class="span80" placeholder="00:00">';
	list += '<span class="color-gray">~</span>';
	list += '<input type="text" name="" value="" class="span80" placeholder="00:00">';
	list += '</div>';
	list += '</td>';
	list += '<td>';
	list += '<div class="flex flex-middle">';
	list += '<input type="text" name="" value="" class="span" placeholder="모임 해당 내용을 입력해주세요.">';
	list += '<span class="btn small gray del-list">삭제</span>';
	list += '</div>';
	list += '</td>';
	list += '</tr>';
	var $tr_last = null;
	var $tr_last = $moim.find("tbody tr:last");
	$tr_last.after(list);
	$('select').selectpicker('refresh');
}

//모임 진행 순서 [기타]
$(function() {
	$(document).on("click", "#moim-program3 .add-list", function() {
		add_moim_program3_list();
	});
	$(document).on("click", "#moim-program3 .del-list", function() {
		if(!confirm("선택하신 시간표가 삭제됩니다. 계속하시겠습니까?"))
			return false;
		var $tr = $(this).closest("tr");
		$tr.remove();        
	});
});
function add_moim_program3_list() {
	var $moim = $("#moim-program3");
	var list = '<tr>';
	list += '<td class="bg"><input type="text" name="" value="" class="span"></td>';
	list += '<td>';
	list += '<div class="flex flex-middle">';
	list += '<input type="text" name="" value="" class="span" placeholder="모임 해당 내용을 입력해주세요.">';
	list += '<span class="btn small gray del-list">삭제</span>';
	list += '</div>';
	list += '</td>';
	list += '</tr>';
	var $tr_last = null;
	var $tr_last = $moim.find("tbody tr:last");
	$tr_last.after(list);
	$('select').selectpicker('refresh');
}

var uploadKey = <? echo ($uploadKey % 5) + 1; ?>;
//업로드 이미지 미리보기
$('.fileContainer input[type="file"]').each(function(index) {
	var inp = $(this);
	var upload = $(this)[0];
	$(this).parent().parent().find('.upImg-list').attr('id', 'holder_' + index);
	var holder = document.getElementById('holder_' + index);
	var last = $(holder).find('li:last');
	console.log(inp);
	upload.onchange = function (e) {
		e.preventDefault();
		var file = upload.files[0],
		reader = new FileReader();
		reader.onload = function (event) {
			var img = new Image();
			img.src = event.target.result;
			img.onload = function(e) {
				var imgtag = '<img src="' + reader.result + '">';
				//holder.children('img').remove();
//				if(img.width != 1000 || img.height != 1000) {
				if(img.width != img.height) {
//					alert('가로/세로는 같은 사이즈여야 합니다.');
					alert('가로/세로는 같은 사이즈를 권장합니다.');
					console.log(img.width);
					console.log(img.height);
                    $('input[type="file"]').val("");
					upload.files[0] = null;
					return;
				} 
				const key = new Date().getTime();
				last.before('<li>' + imgtag + '<span class="del" data-key="'+(key)+'"></span></li>');
				// upload-011
				$('#upload-01' + uploadKey).attr('data-key', key);
				uploadKey = uploadKey + 1;
				$('.upload-btn').attr('for', 'upload-01'+uploadKey);
				$('.upload-empty').attr('for', 'upload-021'+uploadKey);
				
				$('#upload-del-01'+uploadKey).val('1');
				deleteImageAction('.del');
			};
		};			
		reader.readAsDataURL(file);			
		return false;		
	};
});
function deleteImageAction(el) {
	$(el).click(function() {
		$(this).parent('li').remove(); 
		var key = $(this).attr('data-key');
		$('input[type=file][data-key=' + key + ']').val('');
		$('input[name*=bf_file_del][data-key=' + key + ']').val('1');		
	});
}
deleteImageAction('.upImg-list .del');
$('.upload-btn').attr('for', 'upload-01'+uploadKey);
$('.upload-empty').attr('for', 'upload-01'+uploadKey);
</script>



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
	// 회차 정보 체크
	for(var i=0; i<$('input[name*=cls_day]').length; i++){
		if ($('input[name*=cls_day]').eq(i).val() === ""){ alert((i+1) + '회차 스케쥴 날짜를 입력해주세요.'); return false;}
	}
	for(var i=0; i<$('select[name*=cls_time]').length; i++){
		if ($('select[name*=cls_time] option:selected').eq(i).val() === ""){ alert((i+1) + '회차 스케쥴 시간(시)을 선택해주세요.'); return false;}
	}
	for(var i=0; i<$('select[name*=cls_minute]').length; i++){
		if ($('select[name*=cls_minute] option:selected').eq(i).val() === ""){ alert((i+1) + '회차 스케쥴 시간(분)을 입력해주세요.'); return false;}
	}
	for(var i=0; i<$('input[name*=cls_timelimit]').length; i++){
		if ($('input[name*=cls_timelimit]').eq(i).val() === ""){ alert((i+1) + '회차 스케쥴 진행시간을 입력해주세요.'); return false;}
		if (($('input[name*=cls_timelimit]').eq(i).val() <= 0 || 
			!$.isNumeric($('input[name*=cls_timelimit]').eq(i).val())) && $('input[name*=cls_timelimit]').eq(i).val() != '') {
			alert('0이상의 숫자만 입력해주세요');
			$('input[name*=cls_timelimit]').eq(i).val('')
			$('input[name*=cls_timelimit]').eq(i).focus();
			return false;
		}
	}

	
	for(var i=0; i<$('input[name*=cls_day]').length; i++){
		if (i > 0){
			let fdate = new Date($('input[name*=cls_day]').eq(i-1).val());
			let edate = new Date($('input[name*=cls_day]').eq(i).val());
			if (fdate >= edate){
				alert('이전 회차보다 모임일이 빠르거나 같은 회차가 있습니다.'); return false;
			}
		}
	}

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

	<?
	if($w == '') {
		?>
		var file = $('#upload-011').val();
		if(!file || file == '') {
			alert("모임 대표이미지를 등록해주세요.");
			return false;
		}
		<?
	} else if($w == 'u') {
		?>
		<?
	} 
	?>

	var moa_reglimittime = $('#moa_reglimittime').val();
	let checkedGatherType = $('input[name=moa_form]:checked').val();

	if(checkedGatherType != "자율형" && (!moa_reglimittime || moa_reglimittime == '')) {
		alert("신청 가능 시간을 입력해주세요.");
		return false;
	}
	var wr_1 = $('#wr_1').val();
	if(!wr_1 || wr_1 == '') {
		alert("모임 최소 인원을 입력해주세요.");
		return false;
	}
	var wr_2 = $('#wr_2').val();
	if(!wr_2 || wr_2 == '') {
		alert("모임 정원을 입력해주세요.");
		return false;
	}
	if(Number(wr_2) <= Number(wr_1)) {
		alert("모임 정원은 최소 인원보다 크게 설정해주세요.");
		return false;
	}
	var wr_3 = $('#wr_3').val();
	if(!wr_3 || wr_3 == '') {
		alert("참가료를 입력해주세요.");
		return false;
	}
	var wr_4 = $('#wr_4').val();
	if(!wr_4 || wr_4 == '') {
		alert("할인 참가료를 입력해주세요.");
		return false;
	}
	if(!checkValidCost()) {
		return false;
	}
	var wr_subject = $('#wr_subject').val();
	if(!wr_subject ||wr_subject == '') {
		alert("모임 제목을 입력해주세요.");
		return false;
	}
    var reg = /[\{\}\[\]\/?.,;:|\)*~'!^\-_+<>@\#$%&\\\=\(\'\"]/g;
    if(reg.test(wr_subject)){
        alert("모임 제목에 특수문자가 들어가있습니다.");
        return false;
    }
	var ca_name = $('#ca_name').val();
	if(!ca_name ||ca_name == '') {
		alert("카테고리를 선택해주세요.");
		return false;
	}
	var moa_type = $('input[name=moa_type]:checked').val();
	if(!moa_type ||moa_type == '') {
		alert("모임 타입을 선택해주세요.");
		return false;
	}
	var moa_jibun = $('#moa_jibun').val();
	if(!moa_jibun ||moa_jibun == '') {
		alert("주소를 입력해주세요.");
		return false;
	}
	var moa_curriculum = $('#moa_curriculum').val();
	if(!moa_curriculum ||moa_curriculum == '') {
		alert("모아 커리큘럼을 입력해주세요.");
		return false;
	}


	if ($('input[name*=cls_day]').val() == ""){ 
//		alert('모임스케쥴을 입력하세요.'); return false; 
	} else {
		if ($('input[name*=cls_time]').val() == ""){ 
			alert('모임 시각(시간)을 입력하세요.'); return false; 
		}
		if ($('input[name*=cls_minute]').val() == ""){ 
			alert('모임 시각(분)을 입력하세요.'); return false; 
		}
		if ($('input[name*=cls_timelimit]').val() == ""){ 
			alert('모임 진행시간을 입력하세요.'); return false; 
		}
	}
	// $('input[name*="cls_timelimit"]').val()
	
	if (checkedGatherType != "자율형" && $('input[name*=cls_day]').val() == ""){
		alert('모임스케쥴을 입력하세요.');
		return false;
	}

	<?php echo $captcha_js; // 캡챠 사용시 자바스크립트에서 입력된 캡챠를 검사함  ?>

	document.getElementById("btn_submit").disabled = "disabled";
    alert('관리자 승인 완료 후 모임이 노출됩니다.');
	return true;
}

$('input[type="text"]').keydown(function() {
    if (event.keyCode === 13) {
        event.preventDefault();
    }
});
$(function(){
	$("#wr_content").addClass("form-control input-sm write-content");
});
</script>
