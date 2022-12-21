<?php
$sub_menu = "530110";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'w');

check_admin_token();

$mb_id = strip_tags($_POST['mb_id']);
$po_point = strip_tags($_POST['po_point']);
$po_content = strip_tags($_POST['po_content']);
$expire = preg_replace('/[^0-9]/', '', $_POST['po_expire_term']);

$mb = get_member($mb_id);

if (!$mb['mb_id'])
    alert('존재하는 회원아이디가 아닙니다.', './point_list.php?'.$qstr);

if (($po_point < 0) && ($po_point * (-1) > $mb['mb_point']))
    alert('포인트를 깎는 경우 현재 포인트보다 작으면 안됩니다.', './point_list.php?'.$qstr);

$po_action = ($po_exp) ? '@exp' : '@passive';

insert_point($mb_id, $po_point, $po_content, $po_action, $mb_id, $member['mb_id'].'-'.uniqid(''), $expire);

goto_url('./point_list.php?'.$qstr);
?>
