<?php
if (!defined('_GNUBOARD_')) exit;
?>

			<noscript>
				<p>
					귀하께서 사용하시는 브라우저는 현재 <strong>자바스크립트를 사용하지 않음</strong>으로 설정되어 있습니다.<br>
					<strong>자바스크립트를 사용하지 않음</strong>으로 설정하신 경우는 수정이나 삭제시 별도의 경고창이 나오지 않으므로 이점 주의하시기 바랍니다.
				</p>
			</noscript>

		</div>
	</div>
</div>
</div>
<footer id="ft">
	빌더정보 &copy; <?php echo APMS_VERSION;?> 버전
	<span class="pull-right">
		Copyright &copy; <?php echo $_SERVER['HTTP_HOST']; ?>. All rights reserved.
	</span>
</footer>

<section id="admin-switcher">
	<div class="switcher-title btn-switcher cursor">
		<i class="fa fa-arrow-circle-left"></i>&nbsp;
		Close Switcher
	</div>
	<div class="switcher-content">
		<form id="adminSwitcher" name="adminSwitcher" method="post">
		<input type="hidden" name="asave" value="1" id="asave">
			<p>
				<label>CSS 스타일 설정</label>
				<select name="aset[css]" id="mycss" class="frm_input">
				<?php
				$arr = get_skin_dir('', ADMIN_SKIN_PATH.'/css');
				for ($i=0; $i<count($arr); $i++) {
					echo "<option value=\"".$arr[$i]."\"".get_selected($aset['css'], $arr[$i]).">".$arr[$i]."</option>\n";
				}
				?>
				</select>
			</p>
			<P>
				<label>
					로고 설정
					<a href="<?php echo G5_BBS_URL;?>/ficon.php?fid=mylogo" class="pull-right sel_icon win_scrap">아이콘 선택</a>
				</label>
				<input id="mylogo" class="frm_input" type="text" name="aset[logo]" value="<?php echo $aset['logo']; ?>">
			</p>
			<p>
				<label>선택메뉴 글자색 설정</label>
				<input id="mycolor1" class="frm_input iColorPicker" type="text" name="aset[font]" value="<?php echo $aset['font']; ?>">
			</p>
			<P>
				<label>선택메뉴 배경색 설정</label>
				<input id="mycolor2" class="frm_input iColorPicker" type="text" name="aset[hover]" value="<?php echo $aset['hover']; ?>">
			</p>
			<p>
				<label class="chkbox">
					<input type="checkbox" id="myfixed" name="aset[fixed]" value="1"<?php echo get_checked('1', $aset['fixed']);?>>
					상단메뉴바 고정하기
				</label>
			</p>
			<div class="btn_confirm01 btn_confirm">
				<button type="submit" class="btn_submit">저장하기</button>
			</div>
		</form>
	</div>
</section>

<!-- JavaScript -->
<script>
var imageUrl = '<?php echo ADMIN_SKIN_URL;?>/img/color.png';
</script>
<script src="<?php echo ADMIN_SKIN_URL;?>/js/iColorPicker.js"></script>
<script src="<?php echo ADMIN_SKIN_URL;?>/js/ui.totop.min.js"></script>
<script src="<?php echo ADMIN_SKIN_URL;?>/js/admin.js"></script>
<?php if(isset($aset['fixed']) && $aset['fixed']) { ?>
<script src="<?php echo ADMIN_SKIN_URL;?>/js/sticky.js"></script>
<?php } ?>
