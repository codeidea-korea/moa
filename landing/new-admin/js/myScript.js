//쿠기 저장하기
function Set_Cookie(name, value, expires) {
	var expdate = new Date();
	expdate.setTime(expdate.getTime() + 1000 * 3600 * expires); // 1일
	document.cookie = name + "=" + escape (value) + "; path=/; expires=" + expdate.toGMTString();
}
function Get_Cookie(Name) {
	var search = Name + "=";
	if(document.cookie.length > 0) {   // 쿠키가 설정되어 있다면
		offset = document.cookie.indexOf(search);

		if(offset != -1) {    // 쿠키가 존재하면
			offset += search.length;
			// set index of beginning of value
			end = document.cookie.indexOf(";", offset);
			// 쿠키 값의 마지막 위치 인덱스 번호 설정
			if(end == -1) {
				end = document.cookie.length;
			}
			return unescape(document.cookie.substring(offset, end));
		}
	}
}

//이미지 에러 검사
function imgCheck() {
	$("img").each( function(i, ele){
		 var uri = "data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==";
		if( ele.src != '' && ele.complete == true && ele.naturalWidth == 0 ){ //이미 load된 이미지 처리
			//$(this).attr("src", uri );
			$(this).css({"display":"none"});
		}
		$(this).load( function(n){ //load되지 않은 이미지들은 load와 error 이벤트를 추가
			//do nothing
		})
		.error( function(){
			//$(this).attr("src", uri );
			$(this).css({"display":"none"});
		});
	});
}

//엘리먼트 온ㆍ오프 //match값은 ,구분 여러개 가능
function matchOnOff(elm, match, target, standard) {
	var val = $(elm).val();
	var arrMatch = match.split(",");
	if(standard == "hide") {
		$(target).show();
		for(var i in arrMatch) {
			if(val == arrMatch[i]) {
				$(target).hide();			
			}
		}
		$(elm).change(function (){
			var val = $(this).val();
			$(target).show();
			for(var i in arrMatch) {
				if(val == arrMatch[i]) {		
					$(target).hide();		
				}
			}
		});
	} else {
		$(target).hide();
		for(var i in arrMatch) {
			if(val == arrMatch[i]) {		
				$(target).show();	
			}
		}
		$(elm).change(function (){
			var val = $(this).val();
			$(target).hide();
			for(var i in arrMatch) {
				if(val == arrMatch[i]) {		
					$(target).show();	
				}
			}
		});
	}
}

//클릭하여 엘리먼트 온
function matchOn(opener, target, closer) {	
	if(opener == closer) {
		$(opener).click(function() {
			$(target).toggle();		
		});
	} else {
		$(opener).click(function() {
			$(target).show();		
		});
		$(closer).click(function() {
			if(opener != closer)
				$(target).hide();
		});
	}
}

//slide toggle
function slide_toggle(elm, target, start) {
	if(start != 'open') {
		$(target).css({'display':'none'});
	}
	$(elm).click(function() {
		$(target).slideToggle(300, 'easeInOutExpo', function() {
		});
		$(target).toggleClass('open');
	});
}

//메뉴 열기/닫기
function header_toggle(opener, target) {
	var nav_cookie = Get_Cookie( "nav_cookie" );
	if(nav_cookie == 1 || $(target).hasClass('show')) {
		$(target).addClass('show');		
	} else {
		$(target).removeClass('show');	
	}
	$(opener).click(function() {
		$(target).toggleClass('show');	
		if(nav_cookie == 1) {
			Set_Cookie('nav_cookie', '0', 1 );
		} else {
			Set_Cookie('nav_cookie', '1', 1 );
		}
	});
}

//document ready - start
$(document).ready(function(){
	
	var winHeight = $(window).height();
	$('#wrapper').css({"min-height": winHeight - 1});
	//$('#main, #view').css({"min-height": winHeight - 160});
	
	//if( $('body').attr('data-header-type') == 'toggleSlide' )  {
		//메뉴 열기/닫기
		header_toggle('#topContainer .navOpener', '#header');

		$(window).scroll(function() {			
			if( $(this).scrollTop() > 120 ) {
				$('#wrapper #topContainer').addClass('scroll-fixed');
				$('#wrapper #topContainer').animate({"top": 0}, 700, 'easeInOutExpo');
			}
			if( $(this).scrollTop() < 20 ){
				$('#wrapper #topContainer').removeClass("scroll-fixed");
				$('#wrapper #topContainer').removeAttr("style");
				$('#wrapper #topContainer').clearQueue();
			}			
		});
	//}

		
	$(function(){
		imgCheck(); //이미지 에러 검사
	});
	
	//토글 버튼
	$('.toggle-btn').click(function() {
		$(this).toggleClass('on');
		var container = $(this).parent().find('.toggle-container');
		container.toggleClass('open');
	});
	

	$('.tabs-wraper .tabs-group .tab').click(function(){
		var tab_index = $(this).index() + 1;
		$(this).siblings('.tab').removeClass('active');
		$(this).addClass('active');
		$(this).parent().parent().find('.tabCon').removeClass('active');
		$(this).parent().parent().find('.tabCon:nth-child(' + tab_index + ')').addClass('active');
	});
	
	$('.slide-toggle-list.open .slideCon').each(function() {
		$(this).slideDown(400, 'easeInOutExpo');
	});

	$('.slide-toggle-list .slide-opener').click(function(){
		$(this).parent().toggleClass('open');
		$(this).siblings('.slideCon').slideToggle(300, 'easeInOutExpo');
	});

	
	

	
	//최대사이즈로 통일
	var widths = $('.mathWidth').map(function (){ return $(this).outerWidth(true); }).get(),
		maxwidth = Math.max.apply(null, widths) + 3;
	$('.mathWidth').css({'width':maxwidth + 'px'});
	

	//외부 팝업 
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
	
	if( $('.popup-inline').length )  {
		$('.popup-inline:not(.inside)').magnificPopup({
			type: 'inline',
			fixedContentPos: false,
			fixedBgPos: true,
			closeOnContentClick: false, 
			closeOnBgClick: true,
			overflowY: 'auto',
			closeBtnInside: false,
			preloader: false,
			midClick: true,
			removalDelay: 300,
			mainClass: 'my-mfp-zoom-in'
		});
		$(document).on('click', '.mfp-wrap .popClose', function (e) {
			e.preventDefault();
			$.magnificPopup.close();
		});
		$('.myClick').click();
	}

	
	
});
//document ready - end