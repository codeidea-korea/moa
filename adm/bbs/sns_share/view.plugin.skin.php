<?php
  if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

  //플로그인 경로 설정
  $plugin_path = G5_PATH.'/plugin/gnuboard_plugin_view_sns_share';
  $plugin_url = G5_URL.'/plugin/gnuboard_plugin_view_sns_share';

  //fontawesome CSS 인클루드
  //add_stylesheet('<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" />', 0);
  //echo '<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" />';
  //스킨 CSS 인클루드
  add_stylesheet('<link rel="stylesheet" href="'.$plugin_url.'/css/plugin.css?'.time().'" />', 0);

  //공유버튼 제목 등 설정
  $meta_title = $view['subject'];
  $meta_description = $meta_title;
  $item_url = $view['href'];
  $meta_image = '';
  $thumb = get_list_thumbnail($board['bo_table'], $wr_id, 200, 200, false, true);
  $youtube_url = $view['wr_link1'];
  $youtube_id = str_replace('http://youtu.be/','',$youtube_url);
  $youtube_id = str_replace('https://youtu.be/','',$youtube_id);
  if($youtube_id){
    $meta_image = 'https://img.youtube.com/vi/'.$youtube_id.'/hqdefault.jpg';
  }  else if($thumb){
    $meta_image = $thumb;
  }
?>


<div class="gnuboard_view_plugin_sns_share">
  <div class="sns_area">
    <div class="sns_btn_area">
      <a class="kakao btn_sns" id="btn_kakao_<?php echo $wr_id ?>" href="javascript:;">
        <img src="<?php echo $plugin_url ?>/images/icon_kakao.png" />
      </a>
      <a class="band btn_sns" title="BAND" href="https://band.us/plugin/share?body=<?php echo urlencode($meta_title.' '.$item_url) ?>" target="_blank">
        <img src="<?php echo $plugin_url ?>/images/icon_band.png" />
      </a>
      <a class="naver btn_sns" title="NAVER" href="https://share.naver.com/web/shareView.nhn?url='<?php echo urlencode($item_url) ?>&title=<?php echo urlencode($meta_title) ?>" target="_blank">
        <img src="<?php echo $plugin_url ?>/images/icon_naver.png" />
      </a>
      <a class="facebook" title="FACEBOOK" href="//www.facebook.com/share.php?u=<?php echo urlencode($item_url) ?>" target="_blank">
        <i class="fa fa-facebook-f"></i>
      </a>
      <a class="twitter" title="TWITTER" href="//twitter.com/intent/tweet?text=<?php echo urlencode($meta_title.' '.$item_url) ?>" target="_blank">
        <i class="fa fa-twitter"></i>
      </a>
      <a class="item_copy" title="COPY" href="#" onclick="copyItemLink(); return false;">
        <i class="fa fa-link"></i>
        <input type="text" value="<?php echo $item_url ?>" id="input_copy_item_link" readonly style="position:absolute; top:-100px; width:1px; padding:0px; border:0px; display:inline-block;" />
      </a>
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
  container: "#btn_kakao_<?php echo $wr_id ?>",
  objectType: "feed",
  content: {
    title: "<?php echo $meta_title ?>",
    description: "<?php echo $meta_description ?>",
    imageUrl: "<?php echo $meta_image ?>",
    link: {
      mobileWebUrl: "<?php echo $item_url ?>",
      webUrl: "<?php echo $item_url ?>"
    }
  }
});
</script>
<?php } ?>
