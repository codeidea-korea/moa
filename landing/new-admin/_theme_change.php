
<div id="theme-change">
	<style>
	#theme-change{font-family:'NanumSquareRound', sans-serif;font-size:13px;position:fixed;top:40px;right:-180px;width:180px;z-index:999;transition:all 0.2s cubic-bezier(0.5,0,0,1.25);}
	#theme-change.open{right:0;}
	#theme-change .opener{position:absolute;left:-25px;top:0;z-index:3;width:28px;height:25px;display:inline-flex;align-items:center;justify-content:center;cursor:pointer;color:#fff;background:#000;border-top-left-radius:3px;border-bottom-left-radius:3px;}
	#theme-change .opener:before{content:'\e99b';font-family:'intaefont';font-size:10px;}
	#theme-change.open .opener{background:#fff;border:1px solid rgba(0,0,0,0.15);border-right:0;}
	#theme-change.open .opener:before{content:'\e929';color:rgba(0,0,0,0.8);font-size:10px;}
	#theme-change > .inner{width:100%;padding:20px;background:#fff;border-radius:3px;border:1px solid rgba(0,0,0,0.15);box-shadow:0 4px 5px rgba(0,0,0,0.01);}
	#theme-change .color-panel{display:flex;flex-wrap:wrap;gap:8px;}
	#theme-change .color-panel [class*='panel-']{display:inline-flex;width:20px;height:20px;border-radius:3px;cursor:pointer;}
	#theme-change .panel-green{background:#1bc8a6}
	#theme-change .panel-red{background:#ff3f3f}
	#theme-change .panel-purple{background:#9d6fc8}
	#theme-change .panel-blue{background:#4abcdd}
	#theme-change .panel-turquoise{background:#b7db48}
	#theme-change .panel-sun-flower{background:#ebbb14}
	#theme-change .panel-orange{background:#f48522}
	#theme-change .panel-emerald{background:#2ecc71}
	#theme-change .panel-wet-asphalt{background:#3c546c}
	#theme-change .panel-gray{background:#797979}
	#theme-change .panel-default{border:1px solid rgba(0,0,0,0.1);display:inline-flex;align-items:center;justify-content:center;}
	#theme-change .panel-default:before{content:'\e929';font-family:'intaefont';color:#ff3f3f;font-size:9px;transform:scale(0.8);}
	#theme-change .p-label{font-size:13px;font-weight:bold;margin-bottom:5px;}
	#theme-change .bootstrap-select:not(.select-img) .dropdown-toggle{font-size:12px;padding-left:15px;padding-right:35px;height:32px;line-height:32px;}
	#theme-change .bootstrap-select:not(.select-img) .dropdown-toggle .caret{width:24px;padding-right:3px;}
	#theme-change .bootstrap-select:not(.select-img) .dropdown-toggle .caret:before{font-size:14px;}
	</style>

	<span class="opener"></span>
	<div class="inner">
		<ul class="color-panel">
			<li><span class="panel-green" data-themeColor="themeColor-green"></span></li>
			<li><span class="panel-red" data-themeColor="themeColor-red"></span></li>
			<li><span class="panel-purple" data-themeColor="themeColor-purple"></span></li>
			<li><span class="panel-blue" data-themeColor="themeColor-blue"></span></li>
			<li><span class="panel-turquoise" data-themeColor="themeColor-turquoise"></span></li>
			<li><span class="panel-sun-flower" data-themeColor="themeColor-sun-flower"></span></li>
			<li><span class="panel-orange" data-themeColor="themeColor-orange"></span></li>			
			<li><span class="panel-emerald" data-themeColor="themeColor-emerald"></span></li>
			<li><span class="panel-wet-asphalt" data-themeColor="themeColor-wet-asphalt"></span></li>
			<li><span class="panel-gray" data-themeColor="themeColor-gray"></span></li>
			<li><span class="panel-default" data-themeColor=""></span></li>
		</ul>
		<p class="p-label bold mt15">헤더 타입</p>
		<select id="header-type" data-style="selectColor-black" class="span">
			<option value="">기본</option>
			<option value="toggleSlide">슬라이드 토글</option>
		</select>
		<p class="p-label bold mt10">기본 폰트</p>
		<select id="font-family" data-style="selectColor-black" class="span">
			<option value="">기본 (나눔스퀘어)</option>
			<option value="noto">본고딕</option>
		</select>
	</div>

	<script>
	var header_type_cookie = Get_Cookie( "header_type_cookie" );
	$('body').attr('data-header-type', header_type_cookie);
	var header_type = $('body').attr('data-header-type');
	if(header_type) {
		$('#header-type').val(header_type);
		$('#header-type').selectpicker("refresh");
	}

	var font_family_cookie = Get_Cookie( "font_family_cookie" );
	$('body').attr('data-font-family', font_family_cookie);
	var font_family = $('body').attr('data-font-family');
	if(font_family) {
		$('#font-family').val(font_family);
		$('#font-family').selectpicker("refresh");
	}

	var themeColor_cookie = Get_Cookie( "themeColor_cookie" );	
	if(typeof themeColor_cookie !== typeof undefined && themeColor_cookie !== '') {
		$('body').attr('data-themeColor', themeColor_cookie);
	}

	$(document).ready(function(){
		$('#theme-change .opener').click(function(){
			$(this).parent().toggleClass('open');
		});
			
		$('#theme-change .color-panel span').click(function(){
			var theme_name = $(this).attr('data-themeColor');
			if(typeof theme_name !== typeof undefined && theme_name !== '') {
				$('body').attr('data-themeColor', theme_name);
				Set_Cookie('themeColor_cookie', theme_name, 1 );
			} else {
				$('body').attr('data-themeColor', '');
				Set_Cookie('themeColor_cookie', '', 0 );
			}
		});		

		$('#header-type').change(function (){
			var val = $(this).val();
			$('body').attr('data-header-type', val);
			Set_Cookie('header_type_cookie', val, 1);
		});		

		$('#font-family').change(function (){
			var val = $(this).val();
			$('body').attr('data-font-family', val);
			Set_Cookie('font_family_cookie', val, 1);
		});
	});
	</script>

</div>

