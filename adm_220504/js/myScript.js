$(document).ready(function(){
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

});