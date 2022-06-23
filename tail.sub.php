<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if(defined('_THEME_PREVIEW_') && _THEME_PREVIEW_ === true) {
	if(defined('G5_THEME_PATH') && is_file(G5_THEME_PATH.'/tail.sub.php')) {
	    require_once(G5_THEME_PATH.'/tail.sub.php');
		return;
	}
} else if(USE_G5_THEME) {
	if(!defined('G5_IS_ADMIN') && defined('G5_THEME_PATH') && is_file(G5_THEME_PATH.'/tail.sub.php')) {
	    require_once(G5_THEME_PATH.'/tail.sub.php');
		return;
	}
}

if(APMS_PRINT) {
	@include_once($print_skin_path.'/print.tail.php');
}
?>

<!-- <?php //echo APMS_VERSION;?> -->
<?php if ($is_admin == 'super') {  ?>
<!-- RUN TIME : <?php echo get_microtime()-$begin_time; ?> -->
<?php }  ?>
<!-- ie6,7에서 사이드뷰가 게시판 목록에서 아래 사이드뷰에 가려지는 현상 수정 -->
<!--[if lte IE 7]>
<script>
$(function() {
    var $sv_use = $(".sv_use");
    var count = $sv_use.length;

    $sv_use.each(function() {
        $(this).css("z-index", count);
        $(this).css("position", "relative");
        count = count - 1;
    });
});
</script>
<![endif]-->
<script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
<script>
    function sample4_execDaumPostcode() {
        new daum.Postcode({
            oncomplete: function(data) {
                // 팝업에서 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

                // 도로명 주소의 노출 규칙에 따라 주소를 표시한다.
                // 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
                var roadAddr = data.roadAddress; // 도로명 주소 변수
                var extraRoadAddr = ''; // 참고 항목 변수

                // 법정동명이 있을 경우 추가한다. (법정리는 제외)
                // 법정동의 경우 마지막 문자가 "동/로/가"로 끝난다.
                if(data.bname !== '' && /[동|로|가]$/g.test(data.bname)){
                    extraRoadAddr += data.bname;
                }
                // 건물명이 있고, 공동주택일 경우 추가한다.
                if(data.buildingName !== '' && data.apartment === 'Y'){
                    extraRoadAddr += (extraRoadAddr !== '' ? ', ' + data.buildingName : data.buildingName);
                }
                // 표시할 참고항목이 있을 경우, 괄호까지 추가한 최종 문자열을 만든다.
                if(extraRoadAddr !== ''){
                    extraRoadAddr = ' (' + extraRoadAddr + ')';
                }

                // 우편번호와 주소 정보를 해당 필드에 넣는다.
                document.getElementById("moa_jibun").value = roadAddr;
                document.getElementById("moa_area1").value = data.sido;
                document.getElementById("moa_area2").value = data.sigungu;
            }
        }).open();
    }
</script>
</div>
<!-- //page-wrapper -->

<script>

$(function() {
    $(".chat-link").on('click', function() {
        var $this = $(this),
            $what = $this.closest('[data-mb_id]');
            value = $what.data('mb_id');
        var href = "<?php echo G5_BBS_URL; ?>/memo_form.php?me_recv_mb_id="+value;
        var new_win = window.open(href, 'win_'+value, 'left=400,top=50,width=450,height=600,scrollbars=1');
        new_win.focus();
    });
});

function chat_invite() {
	var mb_nick = $("#sch_stx").val();
	if( mb_nick == "" )
	{	
		alert( "추가하실 회원의 닉네임을 입력하세요." );
		$("#sch_stx").focus();
        return false;
	}
	$.ajax({
        type: "POST",
        data: {act:'search_member',mb_nick:mb_nick},
        url: '<?php echo G5_BBS_URL; ?>/ajax.memo.php',
        success: function(data) {
            var html = '';
            $.each(data, function(i, $i) {
                if (!$i) {
                    alert('대화상대를 추가하지 못하였습니다. 닉네임을 정확히 입력하세요.');
                    return false;
                } else {
                    var href = "<?php echo G5_BBS_URL; ?>/memo_form.php?me_recv_mb_id="+$i.mb_id;
                    var new_win = window.open(href, 'win_'+$i.mb_id, 'left=400,top=50,width=450,height=600,scrollbars=1');
                    new_win.focus();
                    return false;
                }
            });
           
        }
    });
    return false;
}

    

    $(function() {    //화면 다 뜨면 시작
        var searchSource = [
            <?php 
            for ($i=0; $row=sql_fetch_array($result); $i++) { 
                if($row['mb_level'] < 10) {
                    echo json_encode($row['mb_nick']).",";
                }
            }
            ?>
        ]; // 배열 형태로 

        $("#sch_stx").autocomplete({  //오토 컴플릿트 시작
            source : searchSource,    // source 는 자동 완성 대상
            select : function(event, ui) {    //아이템 선택시
                console.log(ui.item);
            },
            focus : function(event, ui) {    //포커스 가면
                return false;//한글 에러 잡기용도로 사용됨
            },
            open: function(){
                $('.ui-autocomplete').css('width', '100%');
                $('.ui-autocomplete').css('top', '60px');
                $('.ui-autocomplete').css('left', '0px');
                $('.ui-autocomplete').css('font-size', '12px');
                $('.ui-autocomplete').css('border', '0px');
                $('.ui-autocomplete').css('background-color', '#fff');
                $('.ui-autocomplete').css('max-height', '190px');
                $('.ui-autocomplete').css('overflow-y', 'scroll');
                $('.ui-autocomplete').css('overflow-x', 'hidden');
                $('.ui-autocomplete').css('border-bottom', '1px solid #eee');
                $('.ui-autocomplete').css('box-shadow', '10px 0px 10px rgba(0,0,0,0.1)');
                $('.ui-autocomplete').css('box-sizing', 'border-box');
                $('.ui-menu-item-wrapper').css('padding', '10px 10px 10px 10px');
                $('.ui-menu-item-wrapper').css('border', '0px');
                $('.ui-state-active').css('background', '#f9f9f9');
                $('.ui-state-active').css('font-weight', 'bold');
            },
            minLength: 1,// 최소 글자수
            autoFocus: true, //첫번째 항목 자동 포커스 기본값 false
            classes: {    //잘 모르겠음
                "ui-autocomplete": "highlight"
            },
            delay: 500,    //검색창에 글자 써지고 나서 autocomplete 창 뜰 때 까지 딜레이 시간(ms)
//            disabled: true, //자동완성 기능 끄기
            position: { my : "right top", at: "right bottom" },    //잘 모르겠음
            close : function(event){    //자동완성창 닫아질때 호출
                console.log(event);
            }
            
            
        });
        
    });
    

/*
setInterval( function() {
    location.reload();	
}, 20000 ); //20초에 갱신
*/

</script>
</body>
</html>
<?php echo html_end(); // HTML 마지막 처리 함수 : 반드시 넣어주시기 바랍니다. ?>