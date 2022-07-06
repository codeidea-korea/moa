
$(document).ready(function(){
	
	//checkbox
	$('input[type="checkbox"]').each(function() {
		var wrap = $(this).parent('label'),
			span = $(this).next('span');

		if($(this).hasClass('toggle-light')) {
			var label_on = $(this).attr('data-on'),
				label_off = $(this).attr('data-off');
			$(this).removeClass('toggle-light');
			if(wrap.length == 0) {
				$(this).wrap('<label class="toggle-light"></label>');
			}
			if(span.length == 0) {
				$(this).after('<span></span><span class="labelOn">' + label_on + '</span><span class="labelOff">' + label_off + '</span>');
			}
		} else {
			var label = typeof $(this).attr('data-label') !== typeof undefined && $(this).attr('data-label') !== '' ? $(this).attr('data-label') : '';
			if(wrap.length == 0) {
				$(this).wrap('<label class="checkbox-wrap"></label>');
			}
			if(span.length == 0) {
				$(this).after('<span></span>' + label);
			}
		}
	});


	//radio
	$('input[type="radio"]').each(function() {
		var wrap = $(this).parent('label'),
			span = $(this).next('span');
		var label = typeof $(this).attr('data-label') !== typeof undefined && $(this).attr('data-label') !== '' ? $(this).attr('data-label') : '';
		if($(this).hasClass('radio-btn')) {
			if(wrap.length == 0) {
				$(this).wrap('<label class="radio-btn"></label>');	
			}
			if(span.length == 0) {
				$(this).after('<span>' + label + '</span>');
			}
			$(this).removeClass('radio-btn');	
		} else {
			if(wrap.length == 0) {
				$(this).wrap('<label class="radio-wrap"></label>');
			}
			if(span.length == 0) {
				$(this).after('<span></span>' + label);
			}
		}		
	});


	//input label
	$('input:not([type="checkbox"]):not([type="radio"]):not([type="file"]):not([type="range"])').each(function() {
		var label = typeof $(this).attr('data-label') !== typeof undefined && $(this).attr('data-label') !== '' ? $(this).attr('data-label') : '',
			label_right = typeof $(this).attr('data-label-right') !== typeof undefined && $(this).attr('data-label-right') !== '' ? $(this).attr('data-label-right') : '',
			label_inline = typeof $(this).attr('data-label-inline') !== typeof undefined && $(this).attr('data-label-inline') !== '' ? $(this).attr('data-label-inline') : '',
			label_color = typeof $(this).attr('data-label-color') !== typeof undefined && $(this).attr('data-label-color') !== '' ? ' ' + $(this).attr('data-label-color') : '',
			label_class = typeof $(this).attr('data-class') !== typeof undefined && $(this).attr('data-class') !== '' ? ' ' + $(this).attr('data-class') : '';

		if(label || label_right || label_inline) {
			var wrapClass = '';
			if(label) wrapClass += ' left-label';
			if(label_right) wrapClass += ' right-label';
			if(label_inline) wrapClass += ' inline-label';
			if(label_class) wrapClass += ' ' + label_class;
			$(this).wrap('<label class="inp-wrap' + wrapClass +'"></label>');
			if(label) $(this).before('<span class="label">' + label + '</span>');
			if(label_right) $(this).after('<span class="label">' + label_right + '</span>');
			if(label_inline) $(this).after('<span class="label-inline">' + label_inline + '</span>');
		}
	});

	//date
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
		console.log(date);
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

	$('.inp-wrap').each(function() {
		var input = $(this).find('input');
		if(input.hasClass('span') && !$(this).hasClass('span')) {
			$(this).addClass('span');
		}

		if(input.prev('span.label').length && !$(this).hasClass('left-label') && !$(this).hasClass('label-inline')) {
			$(this).addClass('left-label');
		}
		if(input.next('span.label').length && !$(this).hasClass('right-label') && !$(this).hasClass('label-inline')) {
			$(this).addClass('right-label');
		}
		input.blur(function() {
			$(this).parent().removeClass("focus");
		})
		.focus(function() {
			$(this).parent().addClass("focus");
		});
	});
	

	//date
	$('input.search-date').each(function() {
		$(this).datepicker({
			language: 'ko-KR',
			autoHide: true,
			//autoPick: true,
			format: 'yyyy.mm.dd'
		});
	});

	//휴대폰 번호 입력
	function phoneFomatter(num,type) {
		var formatNum = '';
		if(num.length==11) {
			if(type==0) {
				formatNum = num.replace(/(\d{3})(\d{4})(\d{4})/, '$1-****-$3');
			} else {
				formatNum = num.replace(/(\d{3})(\d{4})(\d{4})/, '$1-$2-$3');
			}
		} else if(num.length==8) {
			formatNum = num.replace(/(\d{4})(\d{4})/, '$1-$2');
		} else {
			if(num.indexOf('02')==0) {
				if(type==0) {
					formatNum = num.replace(/(\d{2})(\d{4})(\d{4})/, '$1-****-$3');
				} else {
					formatNum = num.replace(/(\d{2})(\d{4})(\d{4})/, '$1-$2-$3');
				}
			} else {
				if(type==0){
					formatNum = num.replace(/(\d{3})(\d{3})(\d{4})/, '$1-***-$3');
				} else {
					formatNum = num.replace(/(\d{3})(\d{3})(\d{4})/, '$1-$2-$3');
				}
			}
		}
		return formatNum;
	}
	$("input.phone").bind("keyup", function(event) {
		$(this).val(phoneFomatter($(this).val().replace(/[^0-9]/g,"")));
	});

	function numberFormat(inputNumber) {
	   return inputNumber.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
	}
	$('input.price').each(function() {
		$(this).val(numberFormat($(this).val().replace(/[^0-9]/g,"")));
	});
	$("input.price").bind("keyup", function(event) {
		$(this).val(numberFormat($(this).val().replace(/[^0-9]/g,"")));
	});	


	//PX or % 단위 자동변경
	$('input.percent').bind("keyup", function(event) {
		var thisValue = $(this).val();
		var label = $(this).next('span');
		if(thisValue <= 100 ) {
			label.html('%');
		} else {
			label.html('PX');
		}
	});
	
	//textarea 자동조절
	function textareaResize(obj) {
		obj.style.height = "1px";
		obj.style.height = (1+obj.scrollHeight)+"px";
	}
	$("textarea.autoSize").bind("keypress", function(event) {
		textareaResize(this);
	});
	$("textarea.autoSize").bind("keyup", function(event) {
		textareaResize(this);
	});

	$('textarea.label').each(function() {
		var label = $(this).attr('data-label');
		$(this).wrap('<div class="textarea-wrap"></div>');
		$(this).after('<span class="textarea-label" data-label="' + label + '"><i class="label-icon"></i></span>');
	});

	
	//모두선택 (채크박스)
	$('.chkall').each(function() {
		let chkall = $(this);
		let chk_name = chkall.attr('data-group');
		let chk = $('.' + chk_name);
		chkall.click(function() {
			if(chkall.is(":checked")) chk.prop("checked", true);
			else chk.prop("checked", false);
		});
		chk.click(function() {
			let total = chk.length;
			let checked = $('.' + chk_name + ':checked').length;
			
			if(total != checked) chkall.prop("checked", false);
			else chkall.prop("checked", true); 
		});
	});
	


	//file
	$('.my-filebox input[type="file"]').each(function(index) {
		$(this).on('change', function(){ // 값이 변경되면
			if(window.FileReader){ // modern browser
				var filename = $(this)[0].files[0].name;
			} else { // old IE
				var filename = $(this).val().split('/').pop().split('\\').pop(); // 파일명만 추출
			} // 추출한 파일명 삽입
			$(this).siblings('.upload-name').val(filename);
		});
	});

	// 업로드 이미지 미리보기
	$('input[type="file"].preview').each(function(index) {
		var inp = $(this);
		var upload = $(this)[0];
		$(this).parent().parent().find('.upImg-preview').attr('id', 'holder_' + index);
		var holder = document.getElementById('holder_' + index);
		upload.onchange = function (e) {
			e.preventDefault();
			var file = upload.files[0],
			reader = new FileReader();
			reader.onload = function (event) {
				var img = new Image();
				img.src = event.target.result;
				//btn.hide();
				//holder.children('img').remove();
				if(inp.hasClass('multiple')) {
				} else {
					holder.innerHTML = '';		
				}
				holder.appendChild(img);
				//$(holder).css('background-image', 'url("' + reader.result + '")'); //background로 추출
			};			
			reader.readAsDataURL(file);			
			return false;
		};
	});


	$('.limited').keyup(function () {
		var content = $(this).val();
		var max = $(this).attr('maxlength');
		if (content.length == 0 || content == '') {
			$('.textCount').text('0');
		} else {
			$('.textCount').text(content.length);
		}
		if (content.length > max) {			
			$(this).val($(this).val().substring(0, max));
			alert('글자수는 ' + max + '자까지 입력 가능합니다.');
		};
	});


	$('.rangeContainer').each(function() {
		var slider = $(this).find("input"),
			fill = $(this).find(".range-track-fill");
			val = slider.val(),
			per = Math.floor((100 / (slider.attr('max') - slider.attr('min'))) * (val - 1));
		fill.css({'width':per + '%'});

		slider.on('input', function() {
		//slider.change(function (){
			var val = $(this).val(),
				per = Math.floor((100 / (slider.attr('max') - slider.attr('min'))) * (val - 1));
			fill.css({'width':per + '%'});
		});		
	});

});