<?php
include_once("./_common.php");

//헤더영역(공통파일)
include_once(CLASS_PATH."/header.php");

//main head(공통파일)
include_once(CLASS_PATH."/head.php");
?>
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
                        <select name="category">
                            <?php while($row = sql_fetch_array($query)) { ?>
                                <option value="<?php echo $row['ca_id'] ?>"><?php echo $row['ca_name'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </li>
                <li>
                    <div class="info_ent">
                        <input type="text" name="wr_subject"  placeholder="제목">
                    </div>
                </li>
                <li>
                    <textarea placeholder="글을 작성하실 수 있습니다." name="wr_content" id="" ></textarea>
                </li>
            </ul>
        </div>
    </div>
    <div class="centerbtn mt25">
        <button class="w100">등록하기</button>
    </div>
</div>
<?php

//푸터영역(공통파일)
include_once(CLASS_PATH."/footer.php");
