<div class="column col-8 col-md-12">
	
	<?php if($item_icon) { ?>
		<div class="label-tack"><?php echo $item_icon; ?></div>
	<?php } ?>
	<?php if(false && $dc) {?>
		<div class="label-band bg-red">DC</div>
	<?php } else if($new) {?>
		<div class="label-band bg-blue">New</div>
	<?php } ?>

	<ul class="tab">
		<li class="tab-item active" data-tabname="tab-info">
			<a href="#class-info">수업 설명</a>
		</li>
		<li class="tab-item" data-tabname="tab-career">
			<a href="#teacher-career">선생님 경력</a>
		</li>
		<li class="tab-item" data-tabname="tab-attention">
			<a href="#class-attention">주의사항</a>
		</li>
		<li class="tab-item">
			<a href="/drawit/board_list.php">수업 후기</a>
		</li>
	</ul>
		
	<div class="tab-content" data-tabname-content="tab-info">
		<h4>선생님 소개</h4>
		<?php
		$mb = apms_member($it['pt_id']);
		?>
		<p>
			<?php
			if ($mb['photo']) {
				echo "<img src='{$mb['photo']}' />";
			}
			if ($mb['mb_signature']) {
				echo nl2br(stripcslashes($mb['mb_signature']));
			}
				?>
					
				</p>
		
		<h4>수업 소개</h4>
		<p><div itemprop="description" class="view-content">
				<?php echo get_view_thumbnail($view['content']); ?>
			</div>
				
			</p>
		<p>
		<style>
			.caution {clear:both; background-color: #FDFDFD; border-radius: 15px; border:1px solid #FAFAFA;
			
				padding:5px; height:120px;}
			.caution_i {float:left; width:50px;margin-right: 20px;position: relative;margin-left:20px;}
			.caution_text {position: relative; float:left;
				font-size:20px;
				width:80%;max-width:800px; 
				margin-top:10px;
				padding:5px;
			}
		</style>
		
		<div class="clearfix"></div>

	</div>
	
	<div class="tab-content" data-tabname-content="tab-career" style="display:none;">
		<h4>주요 경력</h4>
		<p><?php 
			if ($mb['mb_profile']) {
				echo nl2br(stripcslashes($mb['mb_profile']));
			}
			?>
		</p>
	</div>

	<div class="tab-content" data-tabname-content="tab-attention" style="display:none;">
		<?php include_once 'caution.php' ?>
	</div>

</div>