<style>
.includers {
    margin:10px;padding:10px;border:1px solid #AAA;background-color:#FEFEFE;
    display:block;
}
</style>
<?php

$thruaddr = "118.37.1.242";
$thruaddr2 = "118.37.1.242"; //영준집
$thruaddr3 = "118.37.1.242";  // 수빈집
$thruaddr4 = "221.158.106.18";  // 수빈집
$thruaddr5 = "221.158.106.18";  // 수빈집
$thisaddr = $_SERVER['REMOTE_ADDR'];
$includers = false;
//if ($is_admin  ||  (strrpos($member['mb_id'],'pletho')!==false ))  {
if ((strrpos($member['mb_id'],'pletho')!==false )
    || $thruaddr == $thisaddr
    || $thruaddr2 == $thisaddr
    || $thruaddr3 == $thisaddr
    || $thruaddr4 == $thisaddr
    || $thruaddr5 == $thisaddr
    )  {
    $includers = true;
}

if ($includers) {
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

//,"/skin/outlogin/basic/outlogin.skin.2.php"
//,"/shop/shop.tail.php"
,"/thema/Basic/shop.tail.php"
//,"/shop/shop.head.php"
,"/bbs/visit_browscap.inc.php"
,"/thema/Basic/assets/thema.php"
,"admin.menu"

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
            echo $pfname."<br>";
        }
    } 
    echo "</div><div style='height:150px'></div>";
}

