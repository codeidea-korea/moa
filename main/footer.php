<!-- 글로벌 푸터 -->
	<?php if($col_name) { ?>
			<?php if($col_name == "two") { ?>
					</div>
					<div class="col-md-<?php echo $col_side;?><?php echo ($at_set['side']) ? ' pull-left' : '';?> at-col at-side">
						<?php include_once($is_side_file); // Side ?>
					</div>
				</div>
			<?php } else { ?>
				</div><!-- .at-content -->
			<?php } ?>
			</div><!-- .at-container -->
		<?php } ?>
	</div><!-- .at-body -->
<div class="footer">
	<div class="container grid-xl">
		<div class="dropdown dropdown-right float-right">
			<a class="btn btn-link dropdown-toggle" tabindex="0">
			한국어 <i class="icon icon-caret"></i>
			</a>
			<ul class="menu">
				<li clsss="menu-item active"><a href="#">한국어</a></li>
				<li clsss="menu-item"><a href="#">English</a></li>
				<li clsss="menu-item"><a href="#">日本語</a></li>
				<li clsss="menu-item"><a href="#">中文(简体)</a></li>
			</ul>
		</div>
		<div class="footer-info">
	        <a href="#" class="btn-top btn btn-primary"><span class="typcn typcn-arrow-up"></span></a>
	        <p><a href="#">DRAWIT 소개</a> · <a href="#">이용약관</a> · <a href="#">개인정보 처리방침</a> · <a href="#">비즈니스 문의</a></p>
	        <p>&copy; <strong>2019 DRAWIT.com, Inc.</strong></p>
		</div>
	</div>
</div>
<script src="/js/owl.carousel.min.js"></script>
<script src="/js/cq_common.js"></script>
<script>
	/* 슬라이더 제어용 */
    $('.owl-carousel').owlCarousel({
        loop: true,
        items: 1,
        nav: false,
        dots: true,
        margin: 0,
        autoplay: true
    });
</script>
<?php
include_once(G5_PATH."/includers.php");
?>
