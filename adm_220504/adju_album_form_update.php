<?php
$sub_menu = "750000";
include_once("./_common.php");
include_once(G5_LIB_PATH."/register.lib.php");
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

if ($w == 'u')
    check_demo();

auth_check($auth[$sub_menu], 'w');

check_admin_token();


$sql_common = "  album_name = '{$_POST['album_name']}',
                 cd_price = '{$_POST['cd_price']}',
                 bep = '{$_POST['bep']}',
                 royalty_rate = '{$_POST['royalty_rate']}'

                 ";

if ($w == '')
{
    $insql = " insert into {$g5['adju_album_table']}  set  regdate = now(), mb_id = '{$member['mb_id']}', {$sql_common} ";
}
else if ($w == 'u')
{

    $insql = " update {$g5['adju_album_table']}
                set {$sql_common}
                     , regdate = now()
				where no = '{$no}' ";
}
else
    alert('제대로 된 값이 넘어오지 않았습니다.');
$str .= $insql."<BR>";
sql_query($insql);
if ($w == '')
$no = sql_insert_id();


print_r2($_POST);
$singer_id = $_POST['singer_id'];
$sbep = $_POST['sbep'];
$sroyalty_rate = $_POST['sroyalty_rate'];

$dsql = "delete from {$g5['adju_album_singer_table']} where album_no = '{$no}' ";
$str .= $dsql."<BR>";
sql_query($dsql);
if (is_array($singer_id)) {
    $cnt = count($singer_id);
    for ($i=0; $i < $cnt; $i++) {
        $mb = get_member[$singer_id[$i]];
        $csql = "select count(*) cnt from {$g5['adju_album_singer_table']} where album_no = '{$no}' and singer_id = '{$singer_id[$i]}' ";
        $crow = sql_fetch($csql);
        if ($crow['cnt'] > 0)  {
            $dsql = "delete from {$g5['adju_album_singer_table']} where album_no = '{$no}' and singer_id = '{$singer_id[$i]}' ";
            sql_query($dsql);
        }
        
        $singer_sql = "insert into {$g5['adju_album_singer_table']} ";
        $singer_sql .= " set album_no = '{$no}' ";
        $singer_sql .= " , singer_id = '{$singer_id[$i]}' ";
        $singer_sql .= " , singer_name = '{$mb['mb_name']}' ";
        $singer_sql .= " , bep = '{$sbep[$i]}' ";
        $singer_sql .= " , royalty_rate = '{$sroyalty_rate[$i]}' ";
        $singer_sql .= " , mb_id = '{$member['mb_id']}' ";
        $singer_sql .= " , regdate = now() ";
        $str.= $singer_sql."<BR>";
        sql_query($singer_sql);
    }
}
else if ($singer_id) {
    $mb = get_member[$singer_id];
    $singer_sql = "insert into {$g5['adju_album_singer_table']} ";
    $singer_sql .= " set album_no = '{$no}' ";
    $singer_sql .= " , singer_id = '{$singer_id}' ";
    $singer_sql .= " , singer_name = '{$mb['mb_name']}' ";
    $singer_sql .= " , bep = '{$sbep}' ";
    $singer_sql .= " , royalty_rate = '{$sroyalty_rate}' ";
    $singer_sql .= " , mb_id = '{$member['mb_id']}' ";
    $singer_sql .= " , regdate = now() ";
    $str.= $singer_sql."<BR>";
    sql_query($singer_sql);

}

echo $str;
//exit;



goto_url('./adju_album_form.php?'.$qstr.'&amp;w=u&amp;no='.$no, false);
?>