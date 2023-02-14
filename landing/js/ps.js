$(function(){
	$(".header .prev").click(function () {
        if ($(this).attr('link') !== "") {
            if ($(this).attr('link') === "form") {
                $('#' + $(this).attr('formid')).submit();
            }else{
                location.href = $(this).attr('link');
            }
        } else {
            history.back();
        }
    })
});