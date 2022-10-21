<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>

<!-- BEST 후기 -->
<section class="s_content mt8">
    <!-- 타이틀 -->
    <div class="main_tit">
        <h1>BEST 후기</h1>
        <a href="<?php echo MOA_DETAIL_URL;?>/d_best_review.php">더보기</a>
    </div>
    <!-- BEST 후기 슬라이드-->
    <div class="swiper-container best">
        <div class="swiper8">
            <div class="swiper-wrapper">
                <?php while($row = sql_fetch_array($result5)) { ?>
                    <div class="swiper-slide">
                    <div class="bsw">
                        <a href="/shop/item.php?it_id=<?= $row['it_id']; ?>">
                            <div class="id_area">
                                <span></span> <p><?php echo $row['is_name'] ?></p>
                            </div>
                            <div class="thumb_box" style="position:relative;height:352px">
                                <img src="<?php echo filter_var($row['as_thumb'], FILTER_VALIDATE_URL) != '' ? $row['as_thumb'] : G5_URL . "/images/moa_logo.svg" ?>" alt="" style="position:absolute;top: 50%;left:50%;transform: translate(-50%, -50%);"><!-- <div style="background:url('<?php echo $row['as_thumb'] ?>');"></div> -->
                            </div>
                            <div class="con_txt">
                                <span><?php echo $row['is_subject'] ?></span>
                                <p><?php echo substr($row['is_content'], 0, 30); ?>...</p>
                            </div>
                        </a>
			<!--신고버튼-->
			<div class="d_tit cr mt14" style="margin:0;float:left;">
				<div class="com_chip color_red">
					<span onclick="report_btn('모임1')" style="cursor:pointer;">신고</span>
					<span onclick="report_btn('모임2')" style="cursor:pointer;">차단</span>
				</div>
			</div>
			<!--신고버튼-->
                    </div>
                </div>
                <?php } ?>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
</section>

<!--신고버튼-->
<script>
function report_btn(val){
	if(val=='모임1'){
		var result = confirm('해당 모임을 신고하시겠습니까?');

		if(result) {
		   //yes
		   //location.replace('index.php');
		   alert('신고되었습니다. 관리자 확인 후 처리예정입니다. 감사합니다.');
		   //처리예정 
		   /*
			$.ajax({
				type: 'POST',
				url: "../../app/ajax_check.php",
				data: {
					checkName : "company_01_ck",
					company_token_val : company_token_val,
					token_val : $('#token_val').val()
				},
				cache: false,
				async: false,
				error : function(request,status,error){
					alert("code : "+request.status+"\r\nmessage : " + request.responseText);
				},
				beforeSend:function(x){
				//처리중 화면구성
				},
				success: function(result) {
					result = result.replace(/(^\s*)|(\s*$)/g, "");
					var re=result.split("///");
					if(re[0]=='ok'){
						$("#company_01").html(re[1]);
						$("#company_01").selectpicker('refresh');
						
						$("#company_02").html(re[2]);
						$("#company_02").selectpicker('refresh');
						
						$("#company_03").html(re[3]);
						$("#company_03").selectpicker('refresh');
					}else{}
				}
			});
			*/
		} else {
			//no
		}
	}else if(val=='후기1'){
		var result = confirm('해당 후기를 신고하시겠습니까?');
		if(result) {
		   alert('신고되었습니다. 관리자 확인 후 처리예정입니다. 감사합니다.');
		} else {}
	}else if(val=='Q&A1'){
		var result = confirm('해당 질문을 신고하시겠습니까?');
		if(result) {
		   alert('신고되었습니다. 관리자 확인 후 처리예정입니다. 감사합니다.');
		} else {}

	}else if(val=='모임2'){
		var result = confirm('해당 사용자를 차단하시겠습니까?');

		if(result) {
		   alert('관리자 확인 후 처리예정입니다. 감사합니다.');
		} else {}
	}else if(val=='후기2'){
		var result = confirm('해당 사용자를 차단하시겠습니까?');

		if(result) {
		   alert('관리자 확인 후 처리예정입니다. 감사합니다.');
		} else {}
	}else if(val=='Q&A2'){
		var result = confirm('해당 사용자를 차단하시겠습니까?');

		if(result) {
		   alert('관리자 확인 후 처리예정입니다. 감사합니다.');
		} else {}
	}else{
	}
}
</script>
<!--신고버튼-->