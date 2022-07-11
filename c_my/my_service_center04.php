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
                        $sql = "select * from g5_faq a left join g5_faq_master b on a.fm_id=b.fm_id ";
                        if ($_REQUEST['fm_id'] != ""){
                            $sql .= "where b.fm_id=".$_REQUEST['fm_id'];
                        }
                        $sql .= " order by a.fa_id desc";
                        $query = sql_query($sql);
                        $i = 1;
                        while($row = sql_fetch_array($query)) {
                    ?>
                        <input type="checkbox" id="box<?php echo $i; ?>">
                        <label for="box<?php echo $i; ?>" class="terms_list">[<?php echo $row['fm_subject']; ?>] <?php echo $row['fa_subject']; ?></label>
                        <section id="con0<?php echo $i; ?>">
                            <div class="box_txt">
                                <?php echo $row['fa_content']; ?>
                            </div>
                        </section>
                    <?php
                        $i++;
                        }
                    ?>

                </div>
            </div>
        </div>
    </div>
<?php

//푸터영역(공통파일)
include_once(CLASS_PATH."/footer.php");
