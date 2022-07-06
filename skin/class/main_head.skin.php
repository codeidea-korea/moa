<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

?>
<?php
if (defined('_INDEX_')) {?>
<header id="moa-header" class="header">
    <div class="inner app_header">
        <a href="/"><img src="../images/moa_logo.svg" alt=""></a>
        <div class="ic_area">
<!--            <a href="javascript:" class="win_pop numchip"><img src="../images/icon_bell.png" alt="">--><?php ////echo $member['response_cnt'];?><!-- <span>10</span></a>-->
            <a href="javascript:"  class="on chat-main numchip" data-mb_id="<?php echo $member['mb_id'];?>"><img src="../images/icon_chat.png" alt=""><span><?php echo $member['response_cnt'];?></span></a>
        </div>
    </div>
</header>
<div id="moa-header-space"></div> 
<?php 
}
else {?>

<div id="moa-header" class="header">
	<div class="inner">
		<button class="prev" OnClick="history.back();" style="cursor:hand"></button>
		<h2 class="pageTit"><?=$header_title?></h2>
        <?php if($it_id != '') { ?>
		<!-- 모임 상세페이지 아이콘 -->
            <div class="ic_area">
<!--                <a href=""><img src="../images/top_like_ic.svg" alt=""></a>-->
                <a onclick="$('#alert05').addClass('on')"><img src="../images/share_ic.svg" alt=""></a>
            </div>
        <?php } ?>
		<!-- 채팅 아이콘 -->
		<!--버튼 클릭 시 호스트로 변경 / 게스트로 변경 텍스트 변경되어야함-->
		<button class="change_h dp_none">게스트로 변경</button>

		 <!-- 문의 아이콘 문의작성 클릭 시 작성페이지 이동-->
		 <a href="<?php echo MOA_DETAIL_URL;?>/inquiry02.php" class="in_write dp_none">문의작성</a>

		<!-- 글쓰기 문의작성 클릭 시 작성페이지 이동-->
		<a href="<?php echo MOA_DETAIL_URL;?>/inquiry02.php" class="in_write dp_none" id="header_write ">글 작성</a>

		 <!-- 커뮤니티 초기 글 작성 페이지 이동-->
		<a href="<?php echo MOA_DETAIL_URL;?>/inquiry02.php" class="in_write dp_none" id="header_write ">글 작성</a>

		<!-- 작성완료 버튼  버튼 작동을 안함-->
		<a  class="in_write dp_none" id="header_write_complete" onClick="fwrite_submit('document.fwrite');">작성 완료</a>

		 <!-- 커뮤니티 아이콘 -->
		 <div class="ic_area t34 dp_none" id="header_icon">
			<a onclick="$('#alert09').addClass('on')"><img src="../images/dot_more.svg"  alt=""></a>
		</div>

		<!-- 마이페이지 설정 아이콘 -->
		<div class="ic_area dp_none">
			<a href=""><img src="../images/icon_setting.svg" alt=""></a>
		</div>

		<!-- 프로필 설정 아이콘 -->
		<button class="textbtn dp_none" onclick="$('#alert14').addClass('on')">저장</button>
	</div>	
</div>
<div id="moa-header-space"></div>
<?php }

$plugin_path = G5_PATH.'/plugin/gnuboard_plugin_view_sns_share';
$plugin_url = G5_URL.'/plugin/gnuboard_plugin_view_sns_share';

add_stylesheet('<link rel="stylesheet" href="'.$plugin_url.'/css/plugin.css?'.time().'" />', 0);

//공유버튼 제목 등 설정
$meta_title = $result['wr_subject'];
$meta_description = $meta_title;
$item_url = G5_URL . '/shop/item.php?it_id=' . $result['it_id'];
$meta_image = '';
$thumb = $result['as_thumb'];
?>

<div class="alert02" id="alert05">
    <div class="layerBody">
        <div class="confirm">
            <div class="mentBox">
                <p class="t_bold">공유하기</p>
                <span>친구에게 모임을 공유하세요!</span>
                <ul>
                    <li>
                        <a class="kakao btn_sns" id="btn_kakao_<?php echo $result['wr_id'] ?>" href="javascript:;">
                            <img src="../images/kakao_s.svg" alt="">
                            <p>카카오톡</p>
                        </a>
                    </li>
<!--                    <li>-->
<!--                        <img src="../images/sms_s.svg" alt="">-->
<!--                        <p>SMS</p>-->
<!--                    </li>-->
                    <li>
                        <a class="item_copy" title="COPY" href="#" onclick="copyItemLink(); return false;">
                            <img src="../images/code_s.svg" alt="">
                            <p>코드복사하기</p>
                            <input type="text" value="<?php echo $item_url ?>" id="input_copy_item_link" readonly style="position:absolute; top:-100px; width:1px; padding:0px; border:0px; display:inline-block;" />
                        </a>
                    </li>
                </ul>
                <div class="close_btn">
                    <button onclick="$('#alert05').removeClass('on')"><img src="../images/close_ic_.svg" alt=""></button>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
    //공유링크 복사 함수
    function copyItemLink(){
        var copyText = document.getElementById("input_copy_item_link");
        copyText.select();
        copyText.setSelectionRange(0, 99999)
        document.execCommand("copy");
        alert("공유링크가 복사되었습니다.");
    }
</script>

<?php if($config['cf_kakao_js_apikey']) { ?>
    <script src="//developers.kakao.com/sdk/js/kakao.min.js" charset="utf-8"></script>
    <script type='text/javascript'>
        // 사용할 앱의 Javascript 키를 설정해 주세요.
        Kakao.init("<?php echo $config['cf_kakao_js_apikey']; ?>");

        Kakao.Link.createDefaultButton({
            container: "#btn_kakao_<?php echo $result['wr_id'] ?>",
            objectType: "feed",
            content: {
                title: "<?php echo strip_tags($result['wr_subject']); ?>",
                description: "<?php echo strip_tags($result['wr_content']); ?>",
                imageUrl: "<?php echo $thumb ?>",
                link: {
                    mobileWebUrl: "<?php echo $item_url ?>",
                    webUrl: "<?php echo $item_url ?>"
                }
            }
        });
    </script>
<?php } ?>


<!-- 프로필 저장하기 팝업-->
<div class="alert02" id="alert14">
    <div class="layerBody">
        <div class="confirm">
            <div class="mentBox">
                <span class="mt40">프로필 수정이 완료되었습니다</span>
                <div class="btn_area">
                    <button class="gy" onclick="$('#alert14').removeClass('on')">취소</button>
                    <button class="gn" onclick="$('#alert14').removeClass('on')">확인</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 커뮤니티 팝업 팝업-->
<div class="i_laypop" id="alert09">
    <div class="layerBody">
        <div class="confirm">
            <div class="mentBox">
                <button class="color_blue" onclick="$('#alert09').removeClass('on')">수정</button>
                <button class="color_blue" onclick="$('#alert09').removeClass('on')">삭제</button>
                <button class="bgr color_dg" onclick="$('#alert09').removeClass('on')">닫기</button>
            </div>
        </div>
    </div>
</div>