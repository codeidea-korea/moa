<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>

<style>
    .re>div{
        display: flex;
        align-items: center;
    }
    .re_text{
        font-weight: 300;
        margin-top:8px;
    }
</style>
<!-- 후기 리스트 -->
<section class="wrapper">
    <div class="s_content" style="padding:0!important;position:relative;">
    <div class="tabs02">
                <input id="host" type="radio" name="tab_item02" checked="">
                <label class="tab_item02" for="host">Q&amp;A</label>

                <input id="group" type="radio" name="tab_item02">
                <label class="tab_item02" for="group">고객센터 문의</label>
                <hr>
                <div class="tab_content p0 bt" id="host_content" style="border-top:1px solid #eee;">
                    <ul class="qa_list" style="padding:0 5%;">
                <?php
                    $sql = "select a.*,b.mb_nick from g5_shop_item_qa a left join g5_member b on a.pt_id = b.mb_id where a.mb_id = '{$member['mb_id']}' ";
                    $query = sql_query($sql);
                    $cnt = sql_num_rows($query);
                    if(sql_num_rows($query) > 0) 
                    {
                    while($row = sql_fetch_array($query)) {
                    ?>
                    
                    <li>
                                <div class="re_txt">
                                    <p><? echo $row['iq_subject']; ?></p>
                                </div>
                                <div class="review">
                                    <div class="pro_img"><?php echo moaMemberProfile($row['mb_id']); ?></div>
                                    <div class="t_area">
                                        <p>
                                            <i <? echo !empty($row['iq_answer']) && $row['iq_answer'] != '' ? 'class="on"' : ''; ?>><? echo !empty($row['iq_answer']) && $row['iq_answer'] != '' ? '답변 완료' : ''; ?></i>
                                        </p>
                                        <p style="width:200px;">  
                                            <? echo $row['iq_name']; ?>
                                        </p>
                                        <div style="margin-top:4px; font-size:13px; color:#939393">
                                            <span>  <? echo $row['iq_time']; ?></span>
                                        </div>
                                        <p class="txt">
                                            <? echo $row['iq_question']; ?>
                                        </p>
                                        <?
                                        if(!empty($row['iq_answer']) && $row['iq_answer'] != ''){
                                        ?>
                                        <div class="re">
                                            <div>
                                                <div class="pro_img"><?php echo moaMemberProfile($row['pt_id']); ?></div>
                                                <div>
                                                    <? echo $row['mb_nick']?>
                                                    <div style="margin-top:4px; font-size:13px; color:#939393">
                                                        <span>   <? echo $row['pt_answer_time']; ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <p class="re_text">
                                                <? echo $row['iq_answer']; ?>
                                            </p>
                                        </div>
                                        <?
                                        }
                                        ?>
                                    </div>
                                </div>
                            </li>
                <?php
                    }
                } else { ?>
                    <div style="width:100%;text-align:center;padding:50px 0">
                        현재 Q&A가 없습니다.
                    </div>
                <?php }?>
                    </ul>
                </div>
                
                <div class="tab_content p0" id="group_content" style="border-top:1px solid #eee;">
                <?
                $query = sql_query($counselings);
                $cnt = sql_num_rows($query);
                if(sql_num_rows($query) > 0) 
                {
                    while($row = sql_fetch_array($query)) {
                        $reply = sql_fetch("SELECT * FROM classboard01.g5_board_new n join g5_write_qa c on n.wr_id = c.wr_id
                        where n.bo_table = 'qa' 
                        and n.wr_id != n.wr_parent 
                        and n.wr_parent = '{$row['wr_id']}'  
                        order by n.bn_id");
                    ?>
                        <ul class="qa_list" style="padding:0 5%;">
                            <li>
                                <div class="re_txt">
                                    <p><? echo $row['wr_subject']; ?></p>
                                </div>
                                <div class="review">
                                    <div class="pro_img"></div>
                                    <div class="t_area layout">
                                        <p>
                                            <? echo $row['wr_name']; ?>
                                            <span><? echo $reply['wr_datetime']; ?></span>
                                            <i <? echo empty($reply) ? '' : 'class="on"'; ?>><? echo empty($reply) ? '' : '답변 완료'; ?></i>
                                        </p>
                                        
                                        
                                            <p class="txt">
                                            <? echo $row['wr_content']; ?>
                                        </p>
                                        <?
                                        if(!empty($reply)){
                                        ?>
                                        <div class="re">
                                            <p><? echo $reply['wr_name']; ?><span><? echo $reply['wr_datetime']; ?></span></p>
                                            <p class="re_text">
                                                <? echo $reply['wr_content']; ?>
                                            </p>
                                        </div>
                                        <?
                                        }
                                        ?>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    <?
                    }
                } else { ?>
                    <div style="width:100%;text-align:center;padding:50px 0">
                        현재 문의가 없습니다.
                    </div>
                <?php }?>
                </div>
            </div>



<?
/*
        <br/><br/><br/><br/><br/><br/><br/><br/><br/>
        <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
        <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
        <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
        <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
        <div class="p0 bt" id="host_content">
            <ul class="my_re_layout last_list">
                <?php
                    $sql = "select * from g5_shop_item_qa where mb_id = '{$member['mb_id']}' ";
                    $query = sql_query($sql);
                    $cnt = sql_num_rows($query);
                    if(sql_num_rows($query) > 0) 
                    {
                    while($row = sql_fetch_array($query)) {
                    ?>
                    <li>
                    <!--
                        <div class="re_txt">
                            <p><?php echo $row['ca_name'] ? '[' . $row['ca_name'] . ']' : ''; ?><?php echo $row['wr_subject']; ?></p>
                        </div>
                        <div class="review">
                            <div class="pro_img"><?php echo get_mb_img($row['mb_id']); ?></div>
                            <div class="t_area">
                                <p><?php echo $row['wr_name']; ?><span><?php echo date('Y-m-d', strtotime($row['wr_datetime'])) ?></span></p>
                                <p class="txt">
                                    <?php echo conv_content($row['wr_content'], 0); ?>
                                </p>
                            </div>
                        </div>
                        -->

                        <div class="re_txt">
                            <p><?php echo $row['ca_name'] ? '[' . $row['ca_name'] . ']' : ''; ?><?php echo $row['iq_subject']; ?></p>
                        </div>
                        <div class="review">
                            <div class="pro_img"><?php echo get_mb_img($row['mb_id']); ?></div>
                            <div class="t_area">
                                <p><?php echo $row['iq_name']; ?><span><?php echo $row['iq_time'] ?></span></p>
                                <p class="txt">
                                    <?php echo $row['iq_question']; ?>
                                </p>
                            </div>
                            <? if(!empty($row['iq_answer']) && $row['iq_answer'] != ''){ ?>
                            <div class="t_area">
                                <p><?php echo $row['pt_id']; ?><span></p>
                                <p class="txt">
                                    <?php echo $row['iq_answer']; ?>
                                </p>
                            </div>
                            <? } ?>
                        </div>

                        <?php 
                        /*
                        $sql2 = "SELECT * FROM g5_shop_item_qa WHERE wr_num = '{$row['wr_num']}' AND wr_reply != ''";
                        $query2 = sql_query($sql2);
                        if(sql_num_rows($query2)) {
                        while($row2 = sql_fetch_array($query2)) { ?>
                            <ul>
                                <li>
                                    <div class="re_txt">
                                        <p><a href="/bbs/board.php?bo_table=qa&wr_id=<?php echo $row2['wr_id']; ?>"><?php echo $row2['ca_name'] ? '[' . $row2['ca_name'] . ']' : ''; ?><?php echo $row2['wr_subject']; ?></a></p>
                                    </div>
                                    <div class="review">
                                        <div class="pro_img"><?php echo get_mb_img($row2['mb_id']); ?></div>
                                        <div class="t_area">
                                            <p><?php echo $row2['wr_name']; ?><span><?php echo date('Y-m-d', strtotime($row2['wr_datetime'])) ?></span></p>
                                            <p class="txt">
                                                <?php echo conv_content($row2['wr_content'], 0); ?>
                                            </p>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        <?php }
                        }*//* ?>
                    </li>
                <?php
                    }
                } else { ?>
                    <div style="width:100%;text-align:center;padding:50px 0">
                        현재 Q&A가 없습니다.
                    </div>
                <?php }?>
            </ul>
        </div>
*/
        ?>
    </div>
</section>