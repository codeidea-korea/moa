<style>
.includers {
    margin:10px;padding:10px;border:1px solid #AAA;background-color:#FEFEFE;
    display:block;
}
</style>
<?php
$thisaddr = $_SERVER['REMOTE_ADDR'];

if (!isset($includers)) {

    $thruaddr = "118.37.1.242";
    $thruaddr2 = "1.229.10.200"; //영준집
    $thruaddr3 = "118.37.1.242";  // 수빈집
    $thruaddr4 = "221.158.106.18";  // 수빈집
    $thruaddr5 = "116.41.82.205";  // 윤진아
    $thruaddr5 = "49.238.202.225";  // 정성민
    $includers = false;
    if ((strrpos($member['mb_id'],'pletho')!==false )
        || $thruaddr == $thisaddr
        || $thruaddr2 == $thisaddr
        || $thruaddr3 == $thisaddr
        || $thruaddr4 == $thisaddr
        || $thruaddr5 == $thisaddr
        )  {
            $includers = true;
    }
}

if ($includers) {
    $url = $_SERVER['REQUEST_URI'];
    //echo $url.'<BR>';
    if (strrpos($url, "/shop/item.php?it_id")!==false ||
    strrpos($url, "/bbs/write.php?bo_table=class")!==false)
    {   ?>
    <a href="<?php echo G5_BBS_URL?>/write.php?bo_table=class&w=u&wr_id=<?php echo $it["it_2"];?>">게시물수정</a>
    <?php
    }
    $notlist = array(
        "/lib/", "/data/", "/_common.php", "/common.php"
        , "config.php", "/extend/", "/plugin/"
        , "/home/prepend/"
        ,"visit_insert.inc.php"
        ,"db_table.optimize.php"
        //,"_tail.php"
        //,"settle_naverpay.inc.php"
        ,"includers.php"
,"/skin/visit/basic/visit.skin.php"
,"/lang/korean/lang.php"
//,"/shop/_head.php"
//,"/head.sub.php"
,"/thema/Basic/shop.head.php"
, "/thema/Basic/index.php"
//, "/_head.php"
,"/addon/qstr.php"
//,"/skin/outlogin/basic/outlogin.skin.2.php"
//,"/shop/shop.tail.php"
,"/thema/Basic/shop.tail.php"
//,"/shop/shop.head.php"
,"/bbs/visit_browscap.inc.php"
,"/thema/Basic/assets/thema.php"
 ,"admin.menu"
 ,"inicis"
,"adm in.lib"
    );
    $included_files = get_included_files();
    $cnt = count($notlist);
    echo "<div class='includers'>";
    foreach ($included_files as $filename)
    {
        $pfname = $filename;
        for ($i = 0; $i < $cnt; $i++)   {

            if (strrpos($filename,$notlist[$i])!==false){
                $pfname = "";
            }
        }

        if ($pfname)    {
            $pfname = str_replace("/var/www/yc3","",$pfname);
            $pfname = str_replace(G5_PATH,"",$pfname);
//            echo $pfname."<br>";
        }
    } 
    if ((strrpos($member['mb_id'],'pletho')!==false )
        || (strrpos($member['mb_id'],'yos6813')!==false )
        || $thruaddr5 == $thisaddr
        || $thruaddr2 == $thisaddr
        ) {
        ?>
        <a href="javascript:" Onclick="_noneviewon()">_v_</a>
        <script>
        var _none = true;
        function _noneviewon() {
            if (_none) {
                $(".none").removeClass("none");
            }
        }
        </script>
        <?php
    }
    echo "</div>";
}

