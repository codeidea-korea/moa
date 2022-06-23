<?php
include_once("./_common.php");


$area1 = $_POST['area1'];
$rtn = "";
if ($area1) {
    $sql = "SELECT * from deb_common_code where type_id like '{$area1}' order by cd_id asc ";
    $result = sql_query($sql);
    while($row = sql_fetch_array($result)) {
        $rtn .= "<option value='".$row['cd_id']."'>".$row['cd_name']."</option>";
    }
}

die("{\"data\":\"$rtn\"}");