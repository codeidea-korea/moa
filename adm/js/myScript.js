$(document).ready(function(){
	//tab메뉴 토글
	$('.tabs-wraper .tabs-group .tab').click(function(){
		var tab_index = $(this).index() + 1;
		$(this).siblings('.tab').removeClass('active');
		$(this).addClass('active');
		$(this).parent().parent().find('.tabCon').removeClass('active');
		$(this).parent().parent().find('.tabCon:nth-child(' + tab_index + ')').addClass('active');
	});
	
	//슬라이드 토글 위젯
	$('.slide-toggle-list.open .slideCon').each(function() {
		$(this).slideDown(400, 'easeInOutExpo');
	});
	$('.slide-toggle-list .slide-opener').click(function(){
		$(this).parent().toggleClass('open');
		$(this).siblings('.slideCon').slideToggle(300, 'easeInOutExpo');
	});
	
	//테이블 버튼 모음 div 감싸기..
	$('table .td_mng').each(function() {
		$(this).wrapInner('<div class="btnSet"></div>');
	});
	
	//html 팝업 제어
	$('.pop-inline').click(function() {
		let target = $(this).attr('data-href');
		$(target).addClass('open');
		$('body').css('overflow', 'hidden');
	});
	$('.pop-closer, .popClose').click(function() {
		let el = $(this).closest('.layer-popup');
		el.removeClass('open');
		$('body').css('overflow', '');
	});
	
	$('.myClick').click();
	
	//팝업 
	$('.popWin').click(function(event){
		var href = $(this).attr('href'),
		winWidth = $(this).attr('data-width'),
		winHeight = $(this).attr('data-height'),
		board = $(this).attr('title'),
		data_top = $(this).attr('data-top'),
		data_left = $(this).attr('data-left');

		if(typeof data_top !== typeof undefined && data_top !== false && data_top)
			var top = $(this).attr('data-top');
		else
			var top = Math.ceil((window.screen.height - winHeight)/2);
		
		if(typeof data_left !== typeof undefined && data_left !== false && data_left)
			var left = $(this).attr('data-left');
		else
			var left = Math.ceil((window.screen.width - winWidth)/2);

		window.open(href,board,'width='+winWidth+',height='+winHeight+',top='+top+',left='+left+',scrollbars=yes, toolbar=no, menubar=no, location=no, statusbar=no, status=no, resizable=yes');
		event.preventDefault();
	});
});