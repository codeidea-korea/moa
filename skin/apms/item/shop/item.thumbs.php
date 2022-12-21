<div id="sit_pvi">
	<div id="sit_pvi_big" >

		<?php
		
			if ($view['as_thumb']) {
				echo "<img src='".$view['as_thumb']."' />";
			}

		?>
		
	<?php 
		// 그림자
		if(isset($wset['ishadow']) && $wset['ishadow']) echo apms_shadow($wset['ishadow']);

		// 썸네일
		$thumb1 = true;
		$thumb_count = 0;
		$total_count = count($thumbnails);
		if(false && $total_count > 0) {
			echo '<div id="sit_pvi_thumb">';
			foreach($thumbnails as $val) {
				$thumb_count++;
				echo '<a class="img_thumb">'.$val.'<span class="sound_only"> '.$thumb_count.'번째 이미지 새창</span></a>';
			}
			echo '</div>';
		}
	?>
</div>