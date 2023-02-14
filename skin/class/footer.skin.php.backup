<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

?>

<?php include_once (G5_PATH."/includers.php");?>

<!-- 공통 푸터 -->
<div id="moa-footer-nav">
	<div class="inner">
		<nav>
			<ul>
				<li>
					<a class="<?php if(strpos(basename($_SERVER['PHP_SELF']),'index') !== false) echo 'on'; ?>" href="/">
						<span class="mn_home"></span>
						홈
					</a>
				</li>
				<li>
					<a class="<?php if(strpos($_url, '/c_category/') !== false) echo 'on';?>" href="<?php echo MOA_CATEGORY_URL;?>/category01.php">
						<span class="mn_ctgry"></span>
						카테고리
					</a>
				</li>
				<!-- <li>
					<a class="<?php if($board['bo_table']=='community') echo 'on';?>" href="<?php echo G5_BBS_URL;?>/board.php?bo_table=community">
						<span class="mn_cmnty"></span>
						커뮤니티
					</a>
				</li> -->
				<li>
					<a class="<?php if(strpos($_url, '/c_map/') !== false) echo 'on';?>" href="<?php echo MOA_MAP_URL;?>/map01.php">
						<span class="mn_location"></span>
						위치
					</a>
				</li>
				<li>
					<?php

					if ($is_member) {
					?> 
					<!-- 로그인한 사용자 링크 -->
					<a class="<?php if(strpos($_url, '/c_my/') !== false) echo 'on';?>" href="<?php echo MOA_MY_URL;?>/my_page01.php">
						<span class="mn_my"></span>
						마이페이지
					</a>
					<?php 
					} else { ?>
					<!-- 비회원 링크 / 로그인페이지로이동 -->
					<a class="<?php if(strpos($_url, '/c_my/') !== false) echo 'on';?>" href="<?php echo MOA_LOGIN_URL;?>/login.php">
						<span class="mn_my"></span>
						마이페이지
					</a>
					<?php } ?>
				</li>
			</ul>
		</nav>
		<!-- 커뮤니티 플러스버튼 -->
		<div class="writ_btn dp_none">
			<a href="<?php echo MOA_COMMUNITY_URL;?>/community03.php"><img src="../images/writing_ic.svg" alt=""></a>
		</div>
	</div>	
 </div>
<div id="moa-footer-nav-space"></div>

<script src="<?php echo MOA_URL;?>/js/common.js"></script>

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

$(function() {
    $(".chat-main").on('click', function() {
        var $this = $(this),
            $what = $this.closest('[data-mb_id]');
            value = $what.data('mb_id');
        var href = "<?php echo G5_BBS_URL; ?>/memo.php";
        var chat_win = window.open(href, 'win_'+value, 'left=400,top=50,width=450,height=600,scrollbars=1');
        chat_win.focus();
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

   // $.prototype.autocomplete = function() {}

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

//         $("#sch_stx").autocomplete({  //오토 컴플릿트 시작
//             source : searchSource,    // source 는 자동 완성 대상
//             select : function(event, ui) {    //아이템 선택시
//                 console.log(ui.item);
//             },
//             focus : function(event, ui) {    //포커스 가면
//                 return false;//한글 에러 잡기용도로 사용됨
//             },
//             open: function(){
//                 $('.ui-autocomplete').css('width', '100%');
//                 $('.ui-autocomplete').css('top', '60px');
//                 $('.ui-autocomplete').css('left', '0px');
//                 $('.ui-autocomplete').css('font-size', '12px');
//                 $('.ui-autocomplete').css('border', '0px');
//                 $('.ui-autocomplete').css('background-color', '#fff');
//                 $('.ui-autocomplete').css('max-height', '190px');
//                 $('.ui-autocomplete').css('overflow-y', 'scroll');
//                 $('.ui-autocomplete').css('overflow-x', 'hidden');
//                 $('.ui-autocomplete').css('border-bottom', '1px solid #eee');
//                 $('.ui-autocomplete').css('box-shadow', '10px 0px 10px rgba(0,0,0,0.1)');
//                 $('.ui-autocomplete').css('box-sizing', 'border-box');
//                 $('.ui-menu-item-wrapper').css('padding', '10px 10px 10px 10px');
//                 $('.ui-menu-item-wrapper').css('border', '0px');
//                 $('.ui-state-active').css('background', '#f9f9f9');
//                 $('.ui-state-active').css('font-weight', 'bold');
//             },
//             minLength: 1,// 최소 글자수
//             autoFocus: true, //첫번째 항목 자동 포커스 기본값 false
//             classes: {    //잘 모르겠음
//                 "ui-autocomplete": "highlight"
//             },
//             delay: 500,    //검색창에 글자 써지고 나서 autocomplete 창 뜰 때 까지 딜레이 시간(ms)
// //            disabled: true, //자동완성 기능 끄기
//             position: { my : "right top", at: "right bottom" },    //잘 모르겠음
//             close : function(event){    //자동완성창 닫아질때 호출
//                 console.log(event);
//             }
            
            
//         });
        
    });
    

/*
setInterval( function() {
    location.reload();	
}, 20000 ); //20초에 갱신
*/

</script>
