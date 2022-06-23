<?php 
// 태그영역입니다.
for ($i=0; $i < $as_tag; $i++)  {
	$tag_list = apms_get_tag($list[$i]['as_tag']);
	?>
	<span class="label">

		<?php echo $tag_list;?>
	</span>
<?php } ?>