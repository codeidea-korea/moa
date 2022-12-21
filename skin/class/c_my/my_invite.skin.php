<div class="wrapper">
    <div class="s_content mt16">
        <div class="in_code">
            <p>나의 초대코드</p>
            <p><?php echo $member['invite_code'] ?></p>
        </div>
        <div class="btw_btn mt20">
            <a class="kakao btn_sns" id="btn_kakao" href="javascript:;">
                <button class="w100">친구에게 공유하기</button>
            </a>

        </div>
    </div>

    <div class="s_content mt60">
        <p class="invite_tit">친구 초대 현황 </p>
        <div class="invite_f">
            <p>초대한 친구</p>
            <p>1</p>
        </div>
    </div>
</div>

<?php if($config['cf_kakao_js_apikey']) { ?>
    <script src="//developers.kakao.com/sdk/js/kakao.min.js" charset="utf-8"></script>
    <script type='text/javascript'>
        // 사용할 앱의 Javascript 키를 설정해 주세요.
        Kakao.init("<?php echo $config['cf_kakao_js_apikey']; ?>");

        Kakao.Link.createDefaultButton({
            container: "#btn_kakao",
            objectType: "feed",
            content: {
                title: "MOA에 가입",
                description: "친구 초대를 받아 가입을 해보세요![초대코드: <?php echo $member['invite_code'] ?>]",
                imageUrl: "",
                link: {
                    mobileWebUrl: "<?php echo G5_URL . '/c_login/e-mail01.php?invite_code=' . $member['invite_code']?>",
                    webUrl: "<?php echo G5_URL . '/c_login/e-mail01.php?invite_code=' . $member['invite_code']?>"
                }
            }
        });
    </script>
<?php } ?>