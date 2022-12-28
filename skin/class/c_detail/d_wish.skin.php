<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>

<!-- 찜한 호스트 / 찜한 모임 리스트 -->
<div class="s_content">
<!--        <input id="host" type="radio" name="tab_item02" checked="">-->
<!--        <label class="tab_item02" for="host">찜한 호스트</label>-->
<!--        <input id="group" type="radio" name="tab_item02">-->
<!--        <label class="tab_item02" for="group">찜한 모임</label>-->
<!--        <hr>-->
<!---->
<!--        <div class="tab_content p0" id="host_content">-->
<!--            <div class="srchVlm mt25"  style="display:none;">-->
<!--                <p>찜한 호스트 6개</p>-->
<!--            </div>-->
<!--			<div style="width:100%;text-align:center;padding:50px 0">-->
<!--                현재 찜한 호스트가 없습니다.-->
<!--            </div>-->
<!--            <ul class="wish_list last_list"  style="display:none;">-->
<!--                <li>-->
<!--                    <div class="host_info mt25">-->
<!--                        <div class="hpro_img"></div>-->
<!--                        <div class="t_area">-->
<!--                            <p>볼링왕<span>모임개수 3</span><span>리뷰 100개</span></p>-->
<!--                            <p class="txt">-->
<!--                                13년째 볼링을 치고 있는 볼링왕입니다.-->
<!--                                각종 아마추어 볼링대회 수상경력을 보유한 취미 볼링왕!-->
<!--                                어렵지 않은 포인트 레슨으로 10개의 핀을 다 쓰러트릴 수 있습니다!-->
<!--                            </p>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </li>-->
<!--                <li>-->
<!--                    <div class="host_info mt25">-->
<!--                        <div class="hpro_img"></div>-->
<!--                        <div class="t_area">-->
<!--                            <p>볼링왕<span>모임개수 3</span><span>리뷰 100개</span></p>-->
<!--                            <p class="txt">-->
<!--                                13년째 볼링을 치고 있는 볼링왕입니다.각종 아마추어 볼링대회 수상경력을 보유한 취미 볼링왕! 어렵지 않은 포인트 레슨으로 10개의 핀을 다 쓰러트릴 수 있습니다!-->
<!--                            </p>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </li>-->
<!--            </ul>-->
<!--        </div>-->
        
        <div class="p0">
            <!-- <div class="srchVlm mt25" style="display:none;">
                <p>찜한 모임 6개</p>
            </div> -->
            <ul class="day_list mt25 last_list">
                <?php
                $type = $_REQUEST['type'];
                $count = 0;
                    $sql = "select b.wr_subject, b.moa_onoff, b.moa_area1, b.wr_3, b.as_thumb, c.it_id, 
                            c.it_price, c.it_cust_price  
                            from g5_write_class b
                            join g5_shop_item c on b.wr_id = c.it_2 
                            join g5_apms_good a on a.it_id = c.it_id 
                            where a.mb_id = '{$member['mb_id']}' and a.pg_flag='good' 
                            group by b.wr_id
                            order by pg_id desc ";
                    $query = sql_query($sql);
                    if(sql_num_rows($query)) {
                    while($row = sql_fetch_array($query)) {
                        $count = $count + 1;
                        $use = "select count(*) as cnt, (sum(is_score) / count(*) )as score from g5_shop_item_use where it_id = '{$row['it_id']}'";
                        $uses = sql_fetch($use);

                        $likechk = checkLikeOn('class',$row['it_id'], $member['mb_id']);
                        $likeon = ($likechk)?"on":"";
                        $likenoon = ($likechk)?"":"";

                        if($count < 3 || $type == 'all'){
                ?>
                <li>
                    <a href="/shop/item.php?it_id=<?php echo $row['it_id']; ?>">
                        <img src="<?php echo filter_var($row['as_thumb'], FILTER_VALIDATE_URL) != '' ? $row['as_thumb'] : G5_URL . "/images/moa_logo.svg" ?>" style="width:337px;height:148px;"/>
                        <div class="lctn"><?php echo $row['moa_onoff']; ?></div>
                        <div class="ttl"><?php echo $row['moa_area1'] ? '['.get_common_type($row['moa_area1'])['type_name'].']' : ''; ?> <?php echo $row['wr_subject']; ?></div>
                        <p class="sale"></p>
                        <!--
                        <div class="rated">
                            <?php for($i=0;$i<$uses['score'];$i++){ ?>
                                <span class="on"></span>
                            <?php } ?>
                            <?php for($i=0;$i<(5-$uses['score']);$i++){ ?>
                            <span></span>
                            <?php }?>
                            <p>후기 <?php echo $uses['cnt']; ?>개</p>
                        </div>
                            -->
                        <div class="dsc_price">
                            <!--금액구현-->
                            <span>
                                <?php 
                                if ($row['it_price'] > 0){
                                    if ($row['it_price'] == $row['it_cust_price']){
                                        echo number_format($row['it_price']) . '원';
                                    }else{
                                        echo '<s>' . number_format($row['it_cust_price']) . '원</s><br>' . number_format($row['it_price']) . '원';
                                    }
                                }else{
                                    echo "무료";
                                }
                                ?>
                            </span>
                            <!--금액구현-->
                            <!--사용시점구현-->
                            <p>
                                <span>당일사용</span>
                            </p>
                            <!--사용시점구현-->
                        </div>
                    </a>
                    <button class="lick_btn <?php echo $likeon;?>" onclick="deb_goods_like('<?php echo $row['it_id'] ?>', '<? echo $likechk ? 'nogood' : 'good' ?>'); return false;"></button>
                </li>
                <?php }
                }
                    } else { ?>
                        <div style="width:100%;text-align:center;padding:50px 0">
                            현재 찜한 모임 리스트가 없습니다.
                        </div>
                <?php } ?>
            </ul>
            
            <? if($count > 2 && $type != 'all'){ ?>
            <!-- 더 보기 버튼 -->
            <div class="centerbtn mt45 more-btn">
                <button onclick="loadAll();">더보기</button>
            </div>
            <script>
            function loadAll(){
                location.href='/c_detail/d_wish.php?type=all';
            }
            </script>
            <? } ?>
        </div>
    </div>
