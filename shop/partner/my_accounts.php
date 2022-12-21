<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

$act = isset($_POST['act'])?$_POST['act']:'';
$pt_id = isset($_REQUEST['pt_id'])?$_REQUEST['pt_id']:$member['mb_id'];
if ($act=="proc") {
    $pt_commission_2 = isset($_POST['pt_commission_2'])?$_POST['pt_commission_2']:'';
    $pt_bank_name    = isset($_POST['pt_bank_name'])?$_POST['pt_bank_name']:'';
    $pt_bank_owner   = isset($_POST['pt_bank_owner'])?$_POST['pt_bank_owner']:'';
    $pt_bank_account = isset($_POST['pt_bank_account'])?$_POST['pt_bank_account']:'';
    $pt_company      = isset($_POST['pt_company'])?$_POST['pt_company']:'';
    $pt_company_name = isset($_POST['pt_company_name'])?$_POST['pt_company_name']:'';
    $pt_company_saupja = isset($_POST['pt_company_saupja'])?$_POST['pt_company_saupja']:'';
    $sql = "UPDATE g5_apms_partner SET";
    $sql .= " pt_commission_2 = '{$pt_commission_2}'";
    $sql .= " , pt_bank_name = '{$pt_bank_name}'";
    $sql .= " , pt_bank_owner = '{$pt_bank_owner}'";
    $sql .= " , pt_bank_account = '{$pt_bank_account}'";
    $sql .= " , pt_company = '{$pt_company}'";
    $sql .= " , pt_company_name = '{$pt_company_name}'";
    $sql .= " , pt_company_saupja = '{$pt_company_saupja}'";
    $sql .= " where pt_id = '{$pt_id}'";

    sql_query($sql);
} 
if ($pt_id) {
    
    $partner = get_partner($pt_id);
}

//print_r3($partner);
include_once($skin_path.'/my_accounts.skin.php');