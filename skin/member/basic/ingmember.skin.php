<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$skin_url.'/style.css">', 0);
//<script src="<?/p/hp echo G5_JS_URL; /?/>/viewimageresize.js"></script>
?>

<style>
/* The switch - the box around the slider */
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

/* Hide default HTML checkbox */
.switch input {display:none;}

/* The slider */
.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 30px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>
<!-- 상품 사용후기 시작 { 
<section id="sit_use_list">

<form name="frmuseline" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
    <div class="clfx" style="border:1px solid #ddd; padding:10px; ">
    <input type="hidden" name="skind" value="useline"/>
    <select name="vtype" id="vtype" class="frm_input" >
        <option value="">--전체--</option>
        <option value="category">카테고리별 보기</option></!--추후카테고리개념추가-- />
    </select>
    <select name="ordtype" id="ordtype"class="frm_input" >
        <option value="">--기본--</option>
        <option value="is_score desc">평점높은순</option>
        <option value="is_score asc">평점높은순</option>
    </select>
    <input type="text" name="stx" id="stx" value="" class="frm_input" />
    <button type="submit" class="btn_submit btn" >검색어입력</button>
    </div>
</form>
-->
<!-- 전체 상품 사용후기 목록 시작 { --/>
<form method="get" action="<?php echo $_SERVER['SCRIPT_NAME']; ?>" style="display:none">
<div id="sps_sch">
    <a href="<?php echo $_SERVER['SCRIPT_NAME']; ?>">전체보기</a>
    <div class="sch_wr">
    <label for="sfl" class="sound_only">검색항목<strong class="sound_only"> 필수</strong></label>
    <select name="sfl" id="sfl" required>
        <option value="">선택</option>
        <option value="b.it_name"   <?php echo get_selected($sfl, "b.it_name"); ?>>상품명</option>
        <option value="a.it_id"     <?php echo get_selected($sfl, "a.it_id"); ?>>상품코드</option>
        <option value="a.is_subject"<?php echo get_selected($sfl, "a.is_subject"); ?>>후기제목</option>
        <option value="a.is_content"<?php echo get_selected($sfl, "a.is_content"); ?>>후기내용</option>
        <option value="a.is_name"   <?php echo get_selected($sfl, "a.is_name"); ?>>작성자명</option>
        <option value="a.mb_id"     <?php echo get_selected($sfl, "a.mb_id"); ?>>작성자아이디</option>
    </select>
    <label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
    <input type="text" name="stx" value="<?php echo $stx; ?>" id="stx" required class="sch_input">
    <button type="submit" value="검색" class="sch_btn"><i class="fa fa-search" aria-hidden="true"></i><span class="sound_only">검색</span></button>
    </div>
</div>
</form>
-->

<div class="review main sps">
    <div class="table-responsive">
        <h4>셀럽 리스트 </h4>
        <table class="table mypage-tbl">            
        <thead>
        <tr>
            <th scope="col">셀럽명</th>
            <th scope="col">등록일</th>
            <th scope="col">참여카테고리명</th>
            <th scope="col">등록 기사수 </th>
        </tr>
        </thead>
        <tbody>
        <?php 
    $thumbnail_width = 500;

    for ($i=0; $row=sql_fetch_array($result); $i++)
    {
        $num = $total_count - ($page - 1) * $rows - $i;
    ?>

   
            <tr >
                <td onclick="reviewToggle('<?php echo $i?>');" style="cursor:pointer">
                    <input type="hidden" name="wr_id[<?php echo $i; ?>]" value="<?php echo $row['wr_id']; ?>">
                    <input type="hidden" name="rtoggle<?php echo $i; ?>" id="rtoggle<?php echo $i; ?>" value="<?php echo $i; ?>">
                    <?php
                    $row['name'] = apms_sideview($row['mb_id'], get_text($row['mb_nick']), $row['mb_email'], $row['mb_homepage']);
                    echo $row['name']; ?></td>
                <td onclick="reviewToggle('<?php echo $i?>');"><?php echo $row['mb_datetime']; ?></td>
                <td onclick="reviewToggle('<?php echo $i?>');"><?php echo $row['bosub']; ?></td>
                <td onclick="reviewToggle('<?php echo $i?>');"><?php echo $row['cnt']; ?>
                </td>
                
            </tr>
             <?php
            $sql2 = " select 
                        x.wr_id,
                        x.wr_subject program,
                        x.wr_datetime regdate,
                        x.wr_hit,
                        x.wr_good,
                        x.wr_nogood
                      from g5_write_".$row['botable']." x,
                        g5_member y
                     where x.wr_is_comment ='0' 
                        and x.mb_id = y.mb_id
                        and x.mb_id = '".$row['mb_id']."'
                      ";
                    //echo $sql2."<BR>";
            $result2 = sql_query($sql2);
            ?>
            <tr  >
                <td colspan="4">
                    <table  style="display:none" class="table mypage-tbl" id="ing_con<?php echo $i?>">
            <?php 
            for ($j = 0; $row2 = sql_fetch_array($result2); $j++)   {      ?>
            <tr>
                <td>
                    <input type="hidden" name="wr_id[<?php echo $i; ?>]" value="<?php echo $row2['wr_id']; ?>">
                    <a href="/bbs/board.php?bo_table=<?php echo $row['botable'];?>&wr_id=<?php echo $row2['wr_id']; ?>"><?php echo $row2['program']; ?></a>
                  </td>
                <td><?php echo $row2['regdate']; ?></td>
                <td><?php
                    $row2['name'] = apms_sideview($row2['mb_id'], get_text($row2['mb_nick']), $row2['mb_email'], $row2['mb_homepage']);
                    echo $row2['name']; ?></td>
                <td><?php echo $row2['wr_hit']; ?>/<?php echo $row2['wr_good']; ?></td>
            </tr>
                <?php
            }
            echo '</table></td>';
            ?>
            </tr>
           
<?php } ?>
<?php if ($i == 0) { ?>
    <tr><td colspan="4" class="empty_table">등록 내역이 없습니다.</td></tr>
<?php } ?>
        </tbody>
        </table>
    </div>


<?php
echo ingmember_page($config['cf_write_pages'], $page, $total_page, "./ingmember.php?page=", "");
?>
</div>

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    function reviewToggle(i){
        var v = "#ing_con"+i;
        var r = "#rtoggle"+i;
        var aa = "#arrow"+i;

        if ($(r).val() == '0')    {
            $(r).val('1');
            $(aa).removeClass("fa-caret-down");
            $(aa).addClass("fa-caret-up");
        }
        else {
            $(r).val('0');
            $(aa).removeClass("fa-caret-up");
            $(aa).addClass("fa-caret-down");
        }
        $(v).toggle("slow",function() {

        });
    }

    function onCheckStatus(val,id) {
        //alert(val.checked+":"+id);
        var status = "중지";
        if (val.checked)
            status = "운영";
        $.ajax({
            type: "POST",
            url: g5_bbs_url+"/ajax.changestatus.php",
            data: {
                "type": "reghealth"
                ,"date": ""
                ,"wr_id": id
                ,"status": status
            },
            cache: false,
            async: false,
            success: function(data) {
                result = data;
                if (result)
                    alert(status+"(으)로 상태가 변경 되었습니다.");
            }
        });
    }


$(function(){
    $(".pg_page").click(function(){
        $("#ingmember").load($(this).attr("href"));
        return false;
    });
    //$( ".controlgroup" ).controlgroup();
 
});

</script>

<?php //echo get_paging($config['cf_write_pages'], $page, $total_page, "{$_SERVER['SCRIPT_NAME']}?$qstr&amp;page="); 
//echo itemuse_page($config['cf_write_pages'], $page, $total_page, "./itemuselist.php?page=", "");
?>
