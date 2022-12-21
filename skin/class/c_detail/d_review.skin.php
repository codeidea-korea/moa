<div class="wrapper">
    <form name="fregister" id="fregister" action="/bbs/review_update.php" method="post">
        <div class="s_content">
            <p class="r_contxt">
                모임정보 : <?php echo get_common_type($data['moa_area1'])['type_name'] ? '[' . get_common_type($data['moa_area1'])['type_name'] . ']' : ''; ?>
                <?php echo $data['wr_subject']; ?>
            </p>
            <div class="rating">
                <p>참여한 모임은 어떠셨나요?</p>
                <div class="m_review scope">
                    <span class="on"></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <input type="hidden" name="is_score" value="1" />
                    <input type="hidden" name="it_id" value="<?php echo $it_id; ?>" />
                </div>
            </div>
            <p class="m_r_text">탭해서 평가하기</p>
            <div class="re_write">
                <textarea name="is_content" id="" cols="30" rows="10" placeholder="참여하신 모임에 대해서 자세히 말해주세요. 나의 후기가 다른 게스트들에게 도움도 되고 포인트를 받아 다시 모아를 즐겨보세요! (최소 OO자 이상 작성 해 주세요)"></textarea>
            </div>
            <div class="empty_bt mt25">
                <button type="submit">등록하기</button>
            </div>
            <span class="point">예상 적립 포인트 1000p</span>
        </div>
    </form>
</div>
<script>
    $('.m_review span').click(function(){
        $('.m_review span').removeClass('on');
        $(this).prevAll().addClass('on');
        $(this).addClass('on');
        $('input[name="is_score"]').val($('.m_review span.on').length)
    })
</script>