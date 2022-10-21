<?php
include_once("./_common.php");

//헤더영역(공통파일)
include_once(CLASS_PATH."/header.php");

$header_title = '제휴/광고문의';
//main head(공통파일)
include_once(CLASS_PATH."/head.php");
?>
<form name="fwrite" id="fwrite" action="/bbs/write_update.php" onsubmit="return fwrite_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off" role="form" class="form-horizontal">
    <input type="hidden" name="uid" value="<?php echo get_uniqid(); ?>">
    <input type="hidden" name="w" value="<?php echo $w ?>">
    <input type="hidden" name="bo_table" value="qa">
    <div class="wrapper">
        <div class="content">
            <div class="com_write">
                <ul>
                    <li>
                        <div class="select_st">
                            <?php
                            $sql = "select * from g5_shop_category order by ca_order asc";
                            $query = sql_query($sql);
                            ?>
                            <select name="ca_name">
                                <?php while($row = sql_fetch_array($query)) { ?>
                                    <option value="<?php echo $row['ca_name'] ?>"><?php echo $row['ca_name'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </li>
                    <li>
                        <div class="info_ent">
                            <input type="text" name="wr_subject" placeholder="제목">
                        </div>
                    </li>
                    <li>
                        <textarea placeholder="글을 작성하실 수 있습니다." name="wr_content"></textarea>
                    </li>
                </ul>
            </div>
            <div class="centerbtn mt25">
                <button class="w100" type="submit">등록하기</button>
            </div>
        </div>
    </div>
</form>
<?php

//푸터영역(공통파일)
include_once(CLASS_PATH."/footer.php");
