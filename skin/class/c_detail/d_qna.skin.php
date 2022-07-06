<div class="wrapper">
    <form name="fregister" id="fregister" action="/bbs/qa_update.php" method="post">
        <input name="it_id" value="<?php echo $it_id ?>" type="hidden" />
        <div class="s_content">
            <p class="r_contxt">
                모임정보 : <?php echo get_common_type($data['moa_area1'])['type_name'] ? '[' . get_common_type($data['moa_area1'])['type_name'] . ']' : ''; ?>
                <?php echo $data['wr_subject']; ?>
            </p>
            <div class="re_write">
                <input type="text" name="iq_subject" id="iq_subject" placeholder="제목입력" />
            </div>
            <div class="re_write">
                <textarea name="iq_question" id="iq_question" cols="30" rows="10" placeholder="문의 내용을 작성해주세요."></textarea>
            </div>
            <div class="empty_bt mt25">
                <button type="submit">등록하기</button>
            </div>
        </div>
    </form>
</div>