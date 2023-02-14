
<?php if(!$nowrapper) { ?>
</div>
<!-- //#wrapper -->

<script>
$('.container.background').parent().addClass('bg');

//location text넣기
$(document).ready(function(){
	var opener_name = $('#header #nav_ul li.open > a').text(),
		page_name = $('#header #nav_ul li.active').text() ? $('#header #nav_ul li.active').text() : '<?=$page_title?>';
	if(typeof opener_name !== typeof undefined && opener_name !== '') {
		$('#topContainer .loaction').append('<span>'+opener_name+'</span>');
	}
	$('#topContainer .loaction').append('<span>'+page_name+'</span>');
});
</script>
<?php } ?>

</body>
</html>