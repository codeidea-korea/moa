<?php
include_once("./_common.php");

//헤더영역(공통파일)
include_once(CLASS_PATH."/header.php");

//main head(공통파일)
include_once(CLASS_PATH."/head.php");
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
                    <label for="box<?php echo $i; ?>" class="terms_list"><?php echo $row['wr_subject']; ?></label>
                    <section id="con0<?php echo $i; ?>">
                        <div class="box_txt">
                            <?php echo $row['wr_content']; ?>
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