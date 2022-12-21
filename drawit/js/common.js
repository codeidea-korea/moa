$(document).ready(function(){
	
	/* 미리보기용 GNB - 현재 있는 메뉴 찾아서 밑줄 스타일링 추가하기 */
	if (window.location.href.indexOf('class_') > -1) {
		$('.navbar-section a').removeClass('active');
    	$('a[href="list_class.html"]').addClass('active');
    } else if (window.location.href.indexOf('_class') > -1) {
		$('.navbar-section a').removeClass('active');
    	$('a[href="list_class.html"]').addClass('active');
    } else if (window.location.href.indexOf('list_teacher') > -1) {
		$('.navbar-section a').removeClass('active');
    	$('a[href="list_teacher.html"]').addClass('active');
    } else if (window.location.href.indexOf('board') > -1) {
		$('.navbar-section a').removeClass('active');
    	$('a[href="board_list.html"]').addClass('active');
    } else {
		$('.navbar-section a').removeClass('active');
    };
	
	/* 창 높이 가져와서 푸터 위치 맞추기 */
	var bodyH = $('html').outerHeight();
	var headerH = $('.header').outerHeight();
	var footerH = $('.footer').outerHeight();
	var contentH = bodyH - headerH - footerH;
	$('.contents').css('min-height', contentH);
	
	/* 브라우저 리사이즈일 때에도 */
	$(window).resize(function() {
		/* + 정사각형 썸네일 만들기 */
		//var cardThumbWidth = $('.card-image').width();
		//$('.card-image').height(cardThumbWidth);
		/* + 창 높이 가져와서 푸터 위치 맞추기 */
		var bodyHeight = $('body').outerHeight();
		var headerHeight = $('.header').outerHeight();
		var footerHeight = $('.footer').outerHeight();
		var contentHeight = bodyHeight - headerHeight - footerHeight;
		$('.contents').css('min-height', contentHeight);
	});
	
	$('.btn-search').click(function() {
		if($('.search-set').is(':visible')) {
			$('.btn-search .icon').removeClass('icon-cross').addClass('icon-search');
		} else {
			$('.btn-search .icon').removeClass('icon-search').addClass('icon-cross');
		};
		$('.search-set').slideToggle();
	});
	
	/* 미리보기용 로그아웃 클릭시 비로그인 폼으로 교환 */
	// 블라인드 레이어 영역 클릭시 레이어 닫기
	$('.blind').click(function(){
		$(this).parent('.layer-set').slideUp('fast');
	});
    $('.account-set .menu li:last-child a').click(function(){
		$('.account-set').load('logout.php');
	});
	$('.account-set .btn-group .btn:first-child').click(function(){
		$('.layer-set').slideUp('fast');
		$('#pop-login').slideToggle('fast');
	});
	$('.account-set .btn-group .btn:last-child').click(function(){
		$('.layer-set').slideUp('fast');
		$('#pop-register').slideToggle('fast');
	});
	$('.account-set .layer-tint a:only-child').click(function(){
		$('.layer-set').slideUp('fast');
		$('#pop-find-account').slideToggle('fast');
	});
	$('.account-set .btn.text-secondary').click(function(){
		$('.layer-set').slideUp('fast');
		$('.account-set').load('logged.php');
	});
    
    /* 샘플 팝업 레이어 제어용 */
    $('.btn-layer-close').click(function(){
		$(this).closest('.layer-set').slideUp('fast');
    });
    
    $('.btn-clear').click(function(){
		$(this).closest('.toast').slideUp('fast'); 
    });
    
    /* 미리보기용 필터 선택 */
    $('.filter-cloud :checked').parent('label').addClass('is-selected');
    $('.filter-cloud label').click(function(){
	    $(this).closest('.filter-cloud').find('label').removeClass();
		$(this).addClass('is-selected').find('input').prop('checked', true);
    });
    
    /* 수업 일정에서 체크박스 선택시 박스 레이아웃 제어하기 */
    $('.class-schedule label').click(function(){
	   if($(this).find('input').is(':checked')) {
		   $(this).parent('div').parent('.card').addClass('is-checked');
	   } else {
		   $(this).parent('div').parent('.card').removeClass('is-checked');
	   }
    });
    
    $('.class-info .tab-item').click(function(){
	    $('.tab-item').removeClass('active');
	    $(this).addClass('active');
		var currentTab = $(this).attr('data-tabname');
		$('.tab-content').hide();
		$('.tab-content[data-tabname-content='+currentTab+']').show();
    });
    
    /* 포트폴리오 이미지 썸네일 클릭시 크게 보기 */
    $('.portfolio .card').click(function(){
	    $(this).toggleClass('is-fullscreen');
    });
	
	/* 미리보기용 전화번호 사이 대시 넣기 */
	$('#contact-mobile[type=tel]').keyup(function(){
	    $(this).val($(this).val().replace(/(\d{3})\-?(\d{4})\-?(\d{4})/,'$1-$2-$3'))
	});
    
    /* 미리보기용 장바구니에 항목 세기 */
    var cartItemCount = $('.cart-item').length;
    $('.cart .single-header .avatar').attr('data-initial', cartItemCount);
    $('.is-login .badge').attr('data-badge', cartItemCount);
    
    /* 미리보기용 장바구니에서 아이템 제거 + 제거할때마다 새로 세기 */
    $('.cart-item-price .btn').click(function(){
		$(this).closest('.cart-item').remove(); 
	    var cartItemCount = $('.cart-item').length;
	    $('.cart .single-header .avatar').attr('data-initial', cartItemCount);
		$('.is-login .badge').attr('data-badge', cartItemCount);
    });
	
	/* 미리보기용 마이페이지 탭 클릭시 컨텐츠 로드 */
    $('.tab-item a').click(function(){
	    if($(this).is('[href="#mypoint"]')){
			$('.tab-content').load('mypoint.php');
	    } else if($(this).is('[href="#myhistory"]')){
			$('.tab-content').load('myhistory.php');
	    } else if($(this).is('[href="#myinfo"]')){
			$('.tab-content').load('myinfo.php');
	    } else if($(this).is('[href="#mypass"]')){
			$('.tab-content').load('mypass.php');
	    } else if($(this).is('[href="#mypurchased"]')){
			$('.tab-content').load('mypurchased.php');
	    }
		$(this).closest('.tab').find('.tab-item').removeClass('active');
		$(this).parent('li').addClass('active');
	});

});