$(document).ready(function(){
	

	$('.list-btn-set .openner').click(function(){
		let wrap = $(this).parent(),
			cover = $(this).siblings('.cover');
		if(wrap.hasClass('open')) {
			wrap.removeClass('open');
			cover.fadeOut(300);
			$('body').css('overflow', '');
		} else {
			wrap.addClass('open');
			cover.fadeIn(300);			
			$('body').css('overflow', 'hidden');
		}
	});


});