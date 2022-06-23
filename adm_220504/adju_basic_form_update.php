<?php
$sub_menu = "750300";
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
    sql_query(" insert into $g5['adju_album_table']  set  regdate = now(), mb_id = '{$member['mb_id']}', {$sql_common} ");
}
else if ($w == 'u')
{

    $sql = " update $g5['adju_album_table'] 
                set {$sql_common}
                     , regdate = now()
				where no = '{$no}' ";
    sql_query($sql);
}
else
    alert('제대로 된 값이 넘어오지 않았습니다.');

goto_url('./adju_album_form.php?'.$qstr.'&amp;w=u&amp;mb_id='.$mb_id, false);
?>