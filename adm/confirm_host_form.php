<?php
include_once('./_common.php');
$mb = apms_partner($pt_id);
if (!$mb['pt_id']) {
    alert('존재하지 않는 호스트입니다.');
}
// echo"<div style='margin-left:200px;margin-top:100px'>";
// print_r3($mb);
// echo "</div>";

include_once(G5_ADMIN_PATH.'/admin.head.php');

include_once(G5_ADMIN_PATH.'/apms_admin/apms.admin.lib.php');
include_once(G5_LIB_PATH.'/common.lib.php');
check_token();

$newis = ($mb['pt_register']=='')?true:false;
//echo '['.$mb['pt_register'].']'.$newis."<BR>";
//삭제시
if(isset($_POST['pt_del']) && $_POST['pt_del']) {

    //파일 삭제
    apms_delete_file("partner", $pt_id);

    //호스트 삭제
    sql_query(" delete from {$g5['apms_partner']} where pt_id = '$pt_id' ");

    //회원정보에서 정보변경
    sql_query(" update {$g5['member_table']} set as_partner = '0', as_marketer = '0' where mb_id = '$pt_id' ", false);

    //이동하기
    goto_url('./apms.admin.php?ap=plist&amp;'.$qstr);
}
else {

    $mb = get_member($pt_id);
    if ($mb['mb_level'] < '3')
        sql_query("update g5_member set mb_level = '3' where mb_id = '$pt_id'");
    $partner = get_partner($pt_id);
    if ($partner['pt_level'] < '3')
        $_POST['pt_level'] = '3';
}
//업데이트
if (isset($_POST['mode']) && $_POST['mode'] == 'pform') {


    // 2022.09.13. 호스트 권한 박탈시 호스트 승인 일시도 수정되어야 함 (기존 다른 로직에서 체크중)
    $mb_level = $_POST['mb_level'];
    $pt_level = $_POST['pt_level'];
    $pt_register = $_POST['pt_register'];
    $pt_partner = $_POST['pt_partner'];
    if(!$pt_partner) {
        $pt_level = '1';
        $pt_register = '';
        $pt_partner = '';

        sql_query("update g5_member set mb_level = '1', as_partner='' where mb_id = '$pt_id'");
    } else {
        if(!$pt_register || $pt_register == '') {
            $pt_register = date("Ymd");
        }
        $pt_partner = 1;
        $pt_level = 2;
        $mb_level = 3;

        sql_query("update g5_member set mb_level = '3', as_partner='1' where mb_id = '$pt_id'");
    }

    $sql = " update {$g5['apms_partner']}
                    set pt_type					= '{$_POST['pt_type']}'
                        , pt_register			= '{$pt_register}'
                        , pt_leave				= '{$_POST['pt_leave']}'
                        , pt_name				= '{$_POST['pt_name']}'
                        , pt_hp					= '{$_POST['pt_hp']}'
                        , pt_email				= '{$_POST['pt_email']}'
                        , pt_partner			= '{$pt_partner}'
                        , pt_marketer			= '{$_POST['pt_marketer']}'
                        , pt_company			= '{$_POST['pt_company']}'
                        , pt_company_name		= '{$_POST['pt_company_name']}'
                        , pt_company_president	= '{$_POST['pt_company_president']}'
                        , pt_company_saupja		= '{$_POST['pt_company_saupja']}'
                        , pt_company_addr		= '{$_POST['pt_company_addr']}'
                        , pt_company_type		= '{$_POST['pt_company_type']}'
                        , pt_company_item		= '{$_POST['pt_company_item']}'
                        , pt_bank_name			= '{$_POST['pt_bank_name']}'
                        , pt_bank_account		= '{$_POST['pt_bank_account']}'
                        , pt_bank_holder		= '{$_POST['pt_bank_holder']}'
                        , pt_bank_limit			= '{$_POST['pt_bank_limit']}'
                        , pt_flag				= '{$_POST['pt_flag']}'
                        , pt_point				= '{$_POST['pt_point']}'
                        , pt_benefit			= '{$_POST['pt_benefit']}'
                        , pt_level				= '{$pt_level}'
                        , pt_limit				= '{$_POST['pt_limit']}'
                        , pt_commission_1		= '{$_POST['pt_commission_1']}'
                        , pt_commission_2		= '{$_POST['pt_commission_2']}'
                        , pt_commission_3		= '{$_POST['pt_commission_3']}'
                        , pt_commission_4		= '{$_POST['pt_commission_4']}'
                        , pt_commission_5		= '{$_POST['pt_commission_5']}'
                        , pt_incentive_1		= '{$_POST['pt_incentive_1']}'
                        , pt_incentive_2		= '{$_POST['pt_incentive_2']}'
                        , pt_incentive_3		= '{$_POST['pt_incentive_3']}'
                        , pt_incentive_4		= '{$_POST['pt_incentive_4']}'
                        , pt_incentive_5		= '{$_POST['pt_incentive_5']}'
                        , pt_memo				= '{$_POST['pt_memo']}'
                        , pt_1					= '{$_POST['pt_1']}'
                        , pt_2					= '{$_POST['pt_2']}'
                        , pt_3					= '{$_POST['pt_3']}'
                        , pt_4					= '{$_POST['pt_4']}'
                        , pt_5					= '{$_POST['pt_5']}'
                        , pt_6					= '{$_POST['pt_6']}'
                        , pt_7					= '{$_POST['pt_7']}'
                        , pt_8					= '{$_POST['pt_8']}'
                        , pt_9					= '{$_POST['pt_9']}'
                        , pt_10					= '{$_POST['pt_10']}'
                        
                    where pt_id					= '{$pt_id}' ";
    sql_query($sql);

    //print_r3($sql);

    $partner = apms_partner($pt_id);
}
if($_POST['pt_register']) { // 승인정보가 있을 경우
   
    sql_query(" update {$g5['member_table']} set as_partner = '{$_POST['pt_partner']}', as_marketer = '{$_POST['pt_marketer']}' where mb_id = '$pt_id' ", false);
    if ($newis) {
//        doAssignPoint($pt_id,'hostreg');
        // 2022-08-11. botbinoo, 호스트 승인시 포인트 지급
        if($config['cf_use_host_reg'] == 1) {
            $config = sql_fetch("select * from {$g5['config_table']} ");
            $cf_host_reg_point = isset($config['cf_host_reg_point']) && $config['cf_host_reg_point'] > 0 ? $config['cf_host_reg_point'] : 0;
            $sql = "update g5_member set mb_point = mb_point + {$cf_host_reg_point} where mb_id = '{$pt_id}' ";
            $user = sql_fetch($sql);
        }
		include_once(G5_LIB_PATH."/kakao_alimtalk.lib.php");
        {
            $sql = "SELECT m.* FROM g5_member m where m.mb_id = '{$pt_id}'";
            $memb = sql_fetch($sql);
            $replaceText = ' [모아프렌즈] [호스트 승인 알림]

            #{이름} 호스트 님!
            호스트 신청 승인이 완료되었습니다!
            
            아래 링크를 통해 모임 개설 방법을 안내해 드릴게요!
            
            모임 개설 가이드 보기
            ☞#{비고1}';
            $reserve_type = 'NORMAL';
            $start_reserve_time = date('Y-m-d H:i:s');
            $reciver = '{"name":"'.$memb['mb_name'].'","mobile":"'.$memb['mb_hp'].'","note1":"https://moafriendshost.notion.site/0ce44224a51746d2be52e2c05a2303ac"}';
            sendBfAlimTalk(132, $replaceText, $reserve_type, $reciver, $start_reserve_time);
        }
    }

} else { // 없다면
    // 기 승인 유저도 화면 진입시 미승인 처리가 되어 로직 삭제
//    sql_query(" update {$g5['member_table']} set as_partner = '0', as_marketer = '0' where mb_id = '$pt_id' ", false);
}

//파일등록
$file_upload_msg = apms_upload_file('partner', $pt_id);


if ($file_upload_msg) {
    alert($file_upload_msg);
}

$token = get_token();
$mb = array_merge($mb,$partner);

$mb['pt_name'] = get_text($mb['pt_name']);
$mb['pt_email'] = get_text($mb['pt_email']);
$mb['pt_hp'] = get_text($mb['pt_hp']);
$mb['pt_company_name'] = get_text($mb['pt_company_name']);
$mb['pt_company_president'] = get_text($mb['pt_company_president']);
$mb['pt_company_saupja'] = get_text($mb['pt_company_saupja']);
$mb['pt_company_addr'] = get_text($mb['pt_company_addr']);
$mb['pt_company_type'] = get_text($mb['pt_company_type']);
$mb['pt_company_item'] = get_text($mb['pt_company_item']);
$mb['pt_bank_name'] = get_text($mb['pt_bank_name']);
$mb['pt_bank_account'] = get_text($mb['pt_bank_account']);
$mb['pt_bank_holder'] = get_text($mb['pt_bank_holder']);
$mb['pt_1'] = get_text($mb['pt_1']);
$mb['pt_2'] = get_text($mb['pt_2']);
$mb['pt_3'] = get_text($mb['pt_3']);
$mb['pt_4'] = get_text($mb['pt_4']);
$mb['pt_5'] = get_text($mb['pt_5']);
$mb['pt_6'] = get_text($mb['pt_6']);
$mb['pt_7'] = get_text($mb['pt_7']);
$mb['pt_8'] = get_text($mb['pt_8']);
$mb['pt_9'] = get_text($mb['pt_9']);
$mb['pt_10'] = get_text($mb['pt_10']);

//print_r3($mb);
// g5_apms_partner
?>

    <style>
        .apms-helper { font-size:12px;font-weight:normal;color:#888; }
        .none {display:none}
    </style>

    <div class="boxContainer">


        <form name="fmember" id="fmember" action="/adm/confirm_host_form.php" onsubmit="return fmember_submit(this);" method="post" enctype="multipart/form-data">
            <input type="hidden" name="ap" value="pform">
            <input type="hidden" name="mode" value="pform">
            <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
            <input type="hidden" name="stx" value="<?php echo $stx ?>">
            <input type="hidden" name="sst" value="<?php echo $sst ?>">
            <input type="hidden" name="sod" value="<?php echo $sod ?>">
            <input type="hidden" name="page" value="<?php echo $page ?>">
            <input type="hidden" name="token" value="<?php echo $token ?>">
            <input type="hidden" name="pt_id" value="<?php echo $pt_id ?>">

            <div class="tbl_frm01 tbl_wrap">
                <table>
                    <colgroup>
                        <col class="grid_4">
                        <col>
                        <col class="grid_4">
                        <col>
                    </colgroup>
                    <tbody>
                    <tr>
                        <td colspan="4" style="border-top:0px;padding-left:0px;">
                            <h2 class="h2_frm" style="margin:0px;padding:0px;">
                                기본정보
                                <span class="apms-helper"> - 승인일 등록시 호스트 등록승인이 완료된 것으로 처리됩니다.</span>
                            </h2>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">닉네임/아이디</th>
                        <td>
                            <b>
                                <?php
                                $pmb = get_member($mb['mb_id'], 'mb_nick, mb_email, mb_homepage');
                                echo ($pmb['mb_nick']) ? apms_sideview($mb['mb_id'], get_text($pmb['mb_nick']), $pmb['mb_email'], $pmb['mb_homepage']) : '탈퇴';
                                ?>
                            </b>
                            (<?php echo $mb['mb_id'];?>)
                        </td>
                        <th scope="row">신청일</th>
                        <td><?php echo $mb['pt_datetime'];?></td>
                    </tr>
                    <tr>
                        <th scope="row">승인일</label></th>
                        <td>
                            <input type="text" name="pt_register" value="<?php echo $mb['pt_register'] ?>" id="pt_register" class="frm_input" maxlength="8" size="10">
                            <input type="checkbox" value="<?php echo date("Ymd"); ?>" id="pt_register_today" onclick="if (this.form.pt_register.value==this.form.pt_register.defaultValue) {
this.form.pt_register.value=this.value; } else { this.form.pt_register.value=this.form.pt_register.defaultValue; }">
                            <label for="pt_register_today">승인일을 오늘로 지정</label>
                        </td>
                        <th scope="row">탈퇴일</label></th>
                        <td>
                            <input type="text" name="pt_leave" value="<?php echo $mb['pt_leave'] ?>" id="pt_leave" class="frm_input" maxlength="8" size="10">
                            <input type="checkbox" value="<?php echo date("Ymd"); ?>" id="pt_leave_today" onclick="if (this.form.pt_leave.value==this.form.pt_leave.defaultValue) {
this.form.pt_leave.value=this.value; } else { this.form.pt_leave.value=this.form.pt_leave.defaultValue; }">
                            <label for="pt_leave_today">탈퇴일을 오늘로 지정</label>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">호스트 영역</th>
                        <td>
                        <!-- 2022.09.13. botbinoo, 호스트 필드를 잘못된 것으로 보고 있어 수정 -->
                        <!-- 
                            <label><input type="checkbox" name="pt_partner" value="1"<?php echo ($mb['pt_partner'] == "1") ? ' checked' : '';?>> 호스트</label>
                            -->
                            <?
                            $ptLevelOption = '';
                            if($mb['pt_partner'] != '1') {
                                $ptLevelOption = '';
                            }else {
                                $ptLevelOption = 'checked';
                            }
                            ?>
                            <label><input type="checkbox" name="pt_partner" value="1" <?php echo $ptLevelOption;?>> 호스트</label>
                            &nbsp;
                            <!-- <label><input type="checkbox" name="pt_marketer" value="1"<?php echo ($mb['pt_marketer'] == "1") ? ' checked' : '';?>> 추천인(마케터)</label> -->
                        </td>
                        <th scope="row">호스트 유형</th>
                        <td>
                            <label><input type="radio" name="pt_type" value="1"<?php echo ($mb['pt_type'] == "1") ? ' checked' : '';?>> 기업</label>
                            &nbsp;
                            <label><input type="radio" name="pt_type" value="2"<?php echo ($mb['pt_type'] == "2") ? ' checked' : '';?>> 개인</label>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">호스트 이름</th>
                        <td><input type="text" name="pt_name" value="<?php echo $mb['pt_name'] ?>" class="frm_input" size="30"></td>
                    </tr>
                    <tr>
                        <th scope="row">호스트 연락처</th>
                        <td><input type="text" name="pt_hp" value="<?php echo $mb['pt_hp'] ?>" class="frm_input" size="30"></td>
                        <th scope="row">호스트 이메일</th>
                        <td><input type="text" name="pt_email" value="<?php echo $mb['pt_email'] ?>" class="frm_input" size="30"></td>
                    </tr>
                    <tr>
                        <th scope="row">알림메모</th>
                        <td colspan="3"><textarea name="pt_memo" id="pt_memo"><?php echo $mb['pt_memo'] ?></textarea></td>
                    </tr>
                    <tr>
                        <td colspan="4" style="padding-left:0px;padding-top:30px;">
                            <h2 class="h2_frm" style="margin:0px;padding:0px;">
                                정산정보
                                <span class="apms-helper"> - 호스트 수수료 미등록시 '기본설정'의 기본 수수료가 자동적용되며, 추천인(마케터) 적립율은 각 상품에 따라 다릅니다.</span>
                            </h2>
                        </td>
                    </tr>
                    <tr class="none">
                        <th scope="row">일반상품 수수료</th>
                        <td>부가세를 포함한 총판매금액에서 수수료 <input type="number"  step="0.01" name="pt_commission_1" value="<?php echo ($mb['pt_commission_1'])?$mb['pt_commission_1']:$apms['apms_commission_1']; ?>" class="numeric sit_camt frm_input" size="4"> % 를 공제후 호스트에게 적립</td>
                        <th scope="row">일반상품 인센티브</th>
                        <td>정산금액의 <input type="number"  step="0.01" name="pt_incentive_1" value="<?php echo $mb['pt_incentive_1'] ?>" class="numeric sit_camt frm_input" size="4"> % 를 호스트에게 추가 적립</td>
                    </tr>
                    <tr>
                        <th scope="row">모임 정산 수수료</th>
                        <td>부가세를 포함한 총판매금액에서 수수료 <input type="number"  step="0.01" name="pt_commission_2" value="<?php echo ($mb['pt_commission_2'] != "")?$mb['pt_commission_2']:$apms['apms_commission_2']; ?>" class="numeric sit_camt frm_input" size="4"> % 를 공제후 호스트에게 적립</td>
                        <th scope="row" class="none">모임 정산 인센티브</th>
                        <td  class="none">정산금액의 <input type="number"  step="0.01" name="pt_incentive_2" value="<?php echo $mb['pt_incentive_2'] ?>" class="numeric sit_camt frm_input" size="4"> % 를 호스트에게 추가 적립</td>
                    </tr>
                    <tr class="none">
                        <th scope="row">상품 등록비</th>
                        <td><input type="text" name="pt_point" value="<?php echo $mb['pt_point'] ?>" class="frm_input sit_camt" size="13"> 점 (분류 등록비와 합산, 호스트 대상)</td>
                        <th scope="row">일일 등록제한</th>
                        <td><input type="text" name="pt_limit" value="<?php echo $mb['pt_limit'] ?>" class="frm_input sit_camt" size="4"> 개 상품만 호스트는 하루동안 상품 등록 가능</td>
                    </tr>
                    <tr class="none">
                        <th scope="row">추천인(마케터) 레벨</th>
                        <td>
                            <?php echo get_member_level_select("pt_level", 1, 10, $mb['pt_level']) ?> 레벨
                        </td>
                        <th scope="row">추천인(마케터) 인센티브</th>
                        <td>추천인(마케터) 적립금액의 <input type="text" name="pt_benefit" value="<?php echo $mb['pt_benefit'] ?>" class="frm_input sit_camt" size="4"> % 를 추가 적립 - 추천인(마케터) 기본 적립율은 각 상품마다 다릅니다.</td>
                    </tr>
                    <tr>
                        <th scope="row">은행이름</th>
                        <td><input type="text" name="pt_bank_name" value="<?php echo $mb['pt_bank_name'] ?>" class="frm_input" size="30"></td>
                        <th scope="row">출금신청</th>
                        <td>
                            <label><input type="radio" name="pt_bank_limit" value="0"<?php echo ($mb['pt_bank_limit'] == "0") ? ' checked' : '';?>> 가능</label>
                            &nbsp;
                            <label><input type="radio" name="pt_bank_limit" value="1"<?php echo ($mb['pt_bank_limit'] == "1") ? ' checked' : '';?>> 불가</label>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">계좌번호</th>
                        <td><input type="text" name="pt_bank_account" value="<?php echo $mb['pt_bank_account'] ?>" class="frm_input" size="30"></td>
                        <th scope="row">예금주명</th>
                        <td><input type="text" name="pt_bank_holder" value="<?php echo $mb['pt_bank_holder'] ?>" class="frm_input" size="30"></td>
                    </tr>
                    <tr>
                        <th scope="row"><label id="pt_company_select">정산유형</label></th>
                        <td>
                            <input type="hidden" name="pt_company" id="pt_company" value="<?php echo $mb['pt_company'];?>">
                            
                            <select name="pt_company_select" id="pt_company_select" onChange="$('#pt_company').val($(this).val());">
                                <option value="">선택해 주세요</option>
                                <option value="개인(원천징수)"<?php if($mb['pt_company'] == '개인(원천징수)') echo ' selected';?>>개인(원천징수)</option>
                                <option value="개인사업자(일반과세)"<?php if($mb['pt_company'] == '개인사업자(일반과세)') echo ' selected';?>>개인사업자(일반과세)</option>
                                <option value="개인사업자(간이과세)"<?php if($mb['pt_company'] == '개인사업자(간이과세)') echo ' selected';?>>개인사업자(간이과세)</option>
                                <option value="개인사업자(일반면세)"<?php if($mb['pt_company'] == '개인사업자(일반면세)') echo ' selected';?>>개인사업자(일반면세)</option>
                                <option value="법인사업자(일반과세)"<?php if($mb['pt_company'] == '법인사업자(일반과세)') echo ' selected';?>>법인사업자(일반과세)</option>
                                <option value="법인사업자(일반면세)"<?php if($mb['pt_company'] == '법인사업자(일반면세)') echo ' selected';?>>법인사업자(일반면세)</option>
                            </select>
                        </td>
                        <th scope="row"><label id="pt_flag_select">정산방법</label></th>
                        <td>
                            <input type="hidden" name="pt_flag" id="pt_flag" value="<?php echo $mb['pt_flag'];?>">
                            <select name="pt_flag_select" id="pt_flag_select" onChange="$('#pt_flag').val($(this).val())">
                                <option value="">선택해 주세요</option>
                                <option value="1"<?php if($mb['pt_flag'] == "1") echo ' selected';?>>신청금액</option>
                                <option value="2"<?php if($mb['pt_flag'] == "2") echo ' selected';?>>신청금액 - 부가세</option>
                                <option value="3"<?php if($mb['pt_flag'] == "3") echo ' selected';?>>신청금액 - 부가세 - 제세공제(원천징수 3.3%)</option>
                                <option value="4"<?php if($mb['pt_flag'] == "4") echo ' selected';?>>기타</option>
                            </select>
                        </td>
                    </tr>
                    <script>
                    $(function() {

                        $('select').on('change', function(e){
                            console.log(this.id,
                                        this.options[this.selectedIndex].value,
                                        $(this).find("option:selected").val(),);
                        });

                    });
                    </script>
                    <tr>
                        <td colspan="4" style="padding-left:0px;padding-top:30px;">
                            <h2 class="h2_frm" style="margin:0px;padding:0px;">
                                기업정보
                                <span class="apms-helper"> - 세금계산서 발행시 필요한 사업등록증 상의 정보를 입력합니다.</span>
                            </h2>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">기업명(상호)</th>
                        <td><input type="text" name="pt_company_name" value="<?php echo $mb['pt_company_name'] ?>" class="frm_input" size="30"></td>
                        <th scope="row">대표자명</th>
                        <td><input type="text" name="pt_company_president" value="<?php echo $mb['pt_company_president'] ?>" class="frm_input" size="30"></td>
                    </tr>
                    <tr>
                        <th scope="row">사업자등록번호</th>
                        <td><input type="text" name="pt_company_saupja" value="<?php echo $mb['pt_company_saupja'] ?>" class="frm_input" size="30"></td>
                        <th scope="row">사업장소재지</th>
                        <td><input type="text" name="pt_company_addr" value="<?php echo $mb['pt_company_addr'] ?>" class="frm_input" size="30"></td>
                    </tr>
                    <tr>
                        <th scope="row">업태</th>
                        <td><input type="text" name="pt_company_type" value="<?php echo $mb['pt_company_type'] ?>" class="frm_input" size="30"></td>
                        <th scope="row">종목</th>
                        <td><input type="text" name="pt_company_item" value="<?php echo $mb['pt_company_item'] ?>" class="frm_input" size="30"></td>
                    </tr>

                    <tr>
                        <td colspan="4" style="padding-left:0px;padding-top:30px;">
                            <h2 class="h2_frm" style="margin:0px;padding:0px;">
                                첨부파일
                                <span class="apms-helper"> - 사업자등록증 사본, 신분증 사본 등</span>
                            </h2>
                        </td>
                    </tr>
                    <?php $attach = apms_get_file('partner', $mb['pt_id']); ?>
                    <?php for ($i=0; $i < 5; $i++) { ?>
                        <tr>
                            <th scope="row">파일등록 #<?php echo $i+1 ?></th>
                            <td>
                                <input type="file" name="pf_file[]" title="파일첨부 <?php echo $i+1 ?> : 용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능">
                                <?php if($attach[$i]['file']) { ?>
                                    &nbsp;
                                    <input type="checkbox" id="pf_file_del<?php echo $i ?>" name="pf_file_del[<?php echo $i;  ?>]" value="1">
                                    <label for="pf_file_del<?php echo $i ?>">삭제</label>
                                <?php } ?>
                            </td>
                            <th scope="row">파일확인 #<?php echo $i+1 ?></th>
                            <td>
                                <?php if($attach[$i]['file']) { ?>
                                    <a href="<?php echo $attach[$i]['href'];?>"><?php echo $attach[$i]['source'];?> (<?php echo $attach[$i]['size'];?>)</a>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php } ?>
                </table>
                <table class="none">
                    <tr>
                        <td colspan="4" style="padding-left:0px;padding-top:30px;">
                            <h2 class="h2_frm" style="margin:0px;padding:0px;">
                                여분필드
                            </h2>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="pt_1">여분필드 1</label></th>
                        <td><input type="text" name="pt_1" value="<?php echo $mb['pt_1'] ?>" id="pt_1" class="frm_input" size="30" maxlength="255"></td>
                        <th scope="row"><label for="pt_2">여분필드 2</label></th>
                        <td><input type="text" name="pt_2" value="<?php echo $mb['pt_2'] ?>" id="pt_2" class="frm_input" size="30" maxlength="255"></td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="pt_3">여분필드 3</label></th>
                        <td><input type="text" name="pt_3" value="<?php echo $mb['pt_3'] ?>" id="pt_3" class="frm_input" size="30" maxlength="255"></td>
                        <th scope="row"><label for="pt_4">여분필드 4</label></th>
                        <td><input type="text" name="pt_4" value="<?php echo $mb['pt_4'] ?>" id="pt_4" class="frm_input" size="30" maxlength="255"></td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="pt_5">여분필드 5</label></th>
                        <td><input type="text" name="pt_5" value="<?php echo $mb['pt_5'] ?>" id="pt_5" class="frm_input" size="30" maxlength="255"></td>
                        <th scope="row"><label for="pt_6">여분필드 2</label></th>
                        <td><input type="text" name="pt_6" value="<?php echo $mb['pt_6'] ?>" id="pt_6" class="frm_input" size="30" maxlength="255"></td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="pt_7">여분필드 7</label></th>
                        <td><input type="text" name="pt_7" value="<?php echo $mb['pt_7'] ?>" id="pt_7" class="frm_input" size="30" maxlength="255"></td>
                        <th scope="row"><label for="pt_8">여분필드 8</label></th>
                        <td><input type="text" name="pt_8" value="<?php echo $mb['pt_8'] ?>" id="pt_8" class="frm_input" size="30" maxlength="255"></td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="pt_9">여분필드 9</label></th>
                        <td><input type="text" name="pt_9" value="<?php echo $mb['pt_9'] ?>" id="pt_9" class="frm_input" size="30" maxlength="255"></td>
                        <th scope="row"><label for="pt_10">여분필드 10</label></th>
                        <td><input type="text" name="pt_10" value="<?php echo $mb['pt_10'] ?>" id="pt_10" class="frm_input" size="30" maxlength="255"></td>
                    </tr>
                    <tr>
                        <td colspan="4"><label><input type="checkbox" name="pt_del" value="1"> 호스트 정보를 DB에서 완전 삭제합니다. </label></td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <div class="btn_fixed_top">
                <a href="/adm/confirm_host_list.php" class="btn btn_02">목록</a>

                <!-- 2022.09.13. botbinoo, 태그 정의 잘못되어 submit 이 안되는 오류 수정 -->
                <!--
                <input type="submit" value="확인" class="btn_submit btn" accesskey='s'>
                -->
                <button type="button" value="확인" class="btn_submit btn" accesskey='s' onclick="submitFmemberFrm()">확인</button>
            </div>

        </form>

    </div>

    <script>
        function fmember_submit(f) {

            return true;
        }
        function submitFmemberFrm(){
            $('#fmember').submit();
        }
    </script>


<?php include_once(G5_ADMIN_PATH.'/admin.tail.php'); ?>