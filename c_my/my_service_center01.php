<?php
include_once("./_common.php");

//헤더영역(공통파일)
include_once(CLASS_PATH."/header.php");

$header_title = '공지사항';
//main head(공통파일)
include_once(CLASS_PATH."/head.php");
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

?>

<div class="wrapper">
    <div class="content">
        <div class="tab_content p0 bt" id="host_content">
            <div class="t_list_area">
                <?php
                $i = 1;
                $sql = "select * from g5_write_notice order by wr_id desc limit 0,5";
                $query = sql_query($sql);
                while($row = sql_fetch_array($query)) {
                ?>
                    <input type="checkbox" id="box<?php echo $i; ?>">
                    <label for="box<?php echo $i; ?>" class="terms_list" style="font-size:1.5rem"><?php echo $row['wr_subject']; ?></label>
                    <section id="con0<?php echo $i; ?>">
                        <div class="box_txt">
							<?php
							$is_img_head = ($row['as_img']) ? false : true; // 상단
							$is_img_tail = ($row['as_img'] == "1") ? true : false; // 하단
							// 이미지 상단 출력
							
							$strSql = "select * from g5_board_file where bo_table='notice' and wr_id=".$row['wr_id'];
							$res = sql_query($strSql);
							if ($res && $is_img_head){
								echo '<div class="view-img">'.PHP_EOL;
								while($rowf = sql_fetch_array($res)) {
									if ($rowf['bf_file'] != "") {
										echo '<img src="/data/file/notice/'.$rowf['bf_file'].'">';
									}
								}
								echo '</div>'.PHP_EOL;
							}
							?>
                            <?php echo '<pre style="white-space: pre-wrap;word-break: break-all;overflow: auto;">'.$row['wr_content'].'</pre>'; ?>
							<?php
							// 이미지 하단 출력
							if($v_img_count && $is_img_tail) {
								echo '<div class="view-img">'.PHP_EOL;
								for ($i=0; $i<=count($view['file']); $i++) {
									if ($view['file'][$i]['view']) {
										echo '<img src="/data/file/notice/'.$rowf['bf_file'].'">';
									}
								}
								echo '</div>'.PHP_EOL;
							}
							?>
                        </div>
                    </section>
                <?php $i++; } ?>
            </div>
        </div>
    </div>
</div>
<?php

//푸터영역(공통파일)
include_once(CLASS_PATH."/footer.php");