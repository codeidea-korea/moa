<?php
$sub_menu = "200100";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');


$rday = getSearchDays();

//$parter = get_partner($member['mb_id']);

if ($sch_startdt =="") 
	$sch_startdt = $rday['year1ago'];
if ($sch_enddt =="") 
	$sch_enddt = $rday['today'];

$sch_startdt = ($sch_startdt) ? $sch_startdt : $rday['year1ago'];
$sch_enddt = ($sch_enddt) ? $sch_enddt : $rday['today'];
$sch_startdt = str_replace(".","-",$sch_startdt);
$sch_enddt = str_replace(".","-",$sch_enddt);
$g5['cert_mail'] = DEB_TABLE_PREFIX."cert_mail";
$g5['cert_image'] = DEB_TABLE_PREFIX."cert_image";
$sql_common = " from {$g5['member_table']} a
	left outer join {$g5['apms_partner']} b on (b.pt_id = a.mb_id) 
	left outer join {$g5['certi_mail']} c on (c.mb_id = a.mb_id and c.cert_yn = 1) 
	left outer join {$g5['certi_image']} d on (d.mb_id = a.mb_id) 
	";

$sql_search = " where (1) and mb_leave_date = '' ";

if ($sch_startdt) {
	$sql_search .=" and date(a.mb_datetime) between '{$sch_startdt}' and '{$sch_enddt}' ";
}
if($stx) {
    $sql_search .= " and (a.mb_hp like '%$stx%' or a.mb_name like '%$stx%' or a.mb_id like '%$stx%' or a.mb_email like '%$stx%' or a.mb_nick like '%$stx%')";
}

if ($is_admin != 'super')
    $sql_search .= " and mb_level <= '{$member['mb_level']}' ";
if($mb_level) {
    $sql_search .= " and mb_level >= $mb_level";
}
if (!$sst) {
    $sst = "mb_datetime";
    $sod = "desc";
}

if($sst == "mb_email_certify") {
	$sql_order = " order by {$sst} {$sod} , mb_datetime asc";
} else {
	$sql_order = " order by {$sst} {$sod} ";
}

$sql = " select count(*) as cnt {$sql_common} {$sql_search} {$sql_order} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

// 멤버쉽 확인 ------------------------
$is_membership = (function_exists('apms_membership_item')) ? true : false;

// 멥버쉽 회원수
if($is_membership) {
	$sql = " SELECT count(*) as cnt {$sql_common} {$sql_search} and as_date > 0 {$sql_order} ";
	$row = sql_fetch($sql);
	$membership_count = $row['cnt'];
}

// 탈퇴회원수
$sql = " SELECT count(*) as cnt {$sql_common} {$sql_search} and mb_leave_date <> '' {$sql_order} ";
$row = sql_fetch($sql);
$leave_count = $row['cnt'];

// 차단회원수
$sql = " SELECT count(*) as cnt {$sql_common} {$sql_search} and mb_intercept_date <> '' {$sql_order} ";
$row = sql_fetch($sql);
$intercept_count = $row['cnt'];

$listall = '<a href="'.$_SERVER['SCRIPT_NAME'].'" class="ov_listall">전체목록</a>';
$excel_download_url = '/adm/memberListExcelDownload.php?sch_startdt='.$sch_startdt.'&amp;sch_enddt='.$sch_enddt.'&amp;sca='.$sca.'&amp;save_stx='.$stx.'&amp;stx='.$stx;
$g5['title'] = '회원관리';
include_once('./admin.head.php');

$sql = " SELECT 
		 a.*, 
		 if (b.pt_id is not null, '호스트','게스트') mb_gubun, 

		 if(a.com_cert_yn = 1, '직장인','미인증') mb_type,

		 if (d.file_type = 'free-file', '프리랜서',
		 	if (d.file_type = 'namecard' or d.file_type='name-camera', '직장인',
			 	if (c.cert_yn = 1,'직장인','미인증')
			)
		 ) f_mb_type, 
		 b.*
		 {$sql_common} 
		 {$sql_search} 
		 {$sql_order} 
		 limit {$from_record}, {$rows} ";
//echo nl2br($sql)."<BR>";
$result = sql_query($sql);

$colspan = ($is_membership) ? 17 : 16;
?>


<div class="boxContainer">

<form name="" action="" method="post">
<div class="data-search-wrap">
	<div class="flex flex-middle mb15 none">
		<label class="inp-wrap label-inline"><input type="text" name="" value="" class="span160 datepicker" placeholder="날짜 선택"><span class="label"></span></label>
		<span>~</span>
		<label class="inp-wrap label-inline"><input type="text" name="" value="" class="span160 datepicker" placeholder="날짜 선택"><span class="label"></span></label>
		
		<!--<a href="#" class="btn span80">검색</a>-->
	</div>
	<div class="data-sel">
		<div class="wr-wrap label80">
			<div class="wr-list none">
				<div class="wr-list-label">검색</div>
				<div class="wr-list-con" style="flex:0.8">
					<label class="radio-wrap"><input type="radio" name="member_s" value=""><span></span>남/여</label>
					<label class="radio-wrap"><input type="radio" name="member_s" value="남"><span></span>남</label>
					<label class="radio-wrap"><input type="radio" name="member_s" value="여" checked><span></span>여</label>
				</div>
                <div class="wr-list-label auto">신입/경력</div>
				<div class="wr-list-con">
					<label class="radio-wrap"><input type="radio" name="career" value="" checked><span></span>전체</label>
					<label class="radio-wrap"><input type="radio" name="career" value="" checked><span></span>신입</label>
					<label class="radio-wrap"><input type="radio" name="career" value=""><span></span>경력</label>
				</div>
				
				<div class="wr-list-label auto">등급</div>
				<div class="wr-list-con">
					<select class="span">
						<option>일반게스트</option>
						<option>OOO</option>
						<option>OOO</option>
						<option>...</option>
					</select>
				</div>
			</div>
			
			<div class="wr-list none">
                <div class="wr-list-label auto">직군</div>
				<div class="wr-list-con">
					<select class="span">
						<option>디자이너</option>
						<option>OOO</option>
						<option>OOO</option>
						<option>...</option>
					</select>
				</div>
				<div class="wr-list-label auto">직무</div>
				<div class="wr-list-con">
					<select class="span">
						<option>UXUI 디자이너</option>
						<option>OOO</option>
						<option>OOO</option>
						<option>...</option>
					</select>
				</div>
				<div class="wr-list-label auto">나이</div>
				<div class="wr-list-con">
					<select class="span">
						<option>20대</option>
						<option>OOO</option>
						<option>OOO</option>
						<option>...</option>
					</select>
				</div>
				<div class="wr-list-label auto">구분</div>
				<div class="wr-list-con">
					<select class="span">
						<option>직장인</option>
						<option>OOO</option>
						<option>OOO</option>
						<option>...</option>
					</select>
				</div>
			</div>
            <div class="wr-list  flex-top none">
				<div class="wr-list-label">관심분야</div>
				<div class="wr-list-con">
					<p>
						<label class="checkbox-wrap"><input type="checkbox" name="mo" value="액티비티" /><span></span>액티비티</label>
						<label class="checkbox-wrap"><input type="checkbox" name="mo" value="자기계발" checked /><span></span>자기계발</label>
						<label class="checkbox-wrap"><input type="checkbox" name="mo" value="커리어" /><span></span>커리어</label>
						<label class="checkbox-wrap"><input type="checkbox" name="mo" value="소셜링" /><span></span>소셜링</label>
					</p>
					<p>
						<label class="checkbox-wrap"><input type="checkbox" name="mo" value="쿠킹베이킹" /><span></span>쿠킹베이킹</label>
						<label class="checkbox-wrap"><input type="checkbox" name="mo" value="문화예술"  /><span></span>문화예술</label>
						<label class="checkbox-wrap"><input type="checkbox" name="mo" value="뷰티" /><span></span>뷰티</label>
						<label class="checkbox-wrap"><input type="checkbox" name="mo" value="힐링" checked /><span></span>힐링</label>
					</p>
				</div>
            </div>
			<div class="wr-list">
				<div class="wr-list-label">가입일</div>
				
				
                <label class="inp-wrap label-inline"><input type="text" id="sch_startdt"  name="sch_startdt" value="<?php echo $sch_startdt;?>" class="span160 datepicker" placeholder="날짜 선택"><span class="label"></span></label>
				<span>~</span>
				<label class="inp-wrap label-inline"><input type="text" id="sch_enddt" name="sch_enddt" value="<?php echo $sch_enddt;?>" class="span160 datepicker" placeholder="날짜 선택"><span class="label"></span></label>
				<input type="hidden" name="setday" id="setday" value="<?php echo $setday?>">
				<div class="datepickContainer small">
					<a href="javascript:" onclick="setdate(0);"  class="dl allday">전체</a>
					<a href="javascript:" onclick="setdate(1);"  class="dl todays">오늘</a>
					<a href="javascript:" onclick="setdate(2);"  class="dl month1">1개월</a>
					<a href="javascript:" onclick="setdate(3);"  class="dl month6">6개월</a>	
					<a href="javascript:" onclick="setdate(4);"  class="dl year1 ">1년</a>	
					<a href="javascript:" onclick="setdate(5);"  class="dl year5">5년</a>
				</div>

				<script>
				var today = "<?php echo $rday['today'];?>";
				var month1ago = "<?php echo $rday['month1ago'];?>";
				var month6ago = "<?php echo $rday['month6ago'];?>";
				var year1ago = "<?php echo $rday['year1ago'];?>";
				var year5ago = "<?php echo $rday['year5ago'];?>";
				var setday = "<?php echo ($setdate)?$setdate:4;?>";
				function setdate(type) {
					var sdt = today;
					var edt = today;
					$(".dl").removeClass("active");
					$("#setdate").val(type);
					switch(type) {
						case 1 :
							sdt = today; 
							$(".todays").addClass("active"); 
							break;
						case 2 : 
							sdt = month1ago;  
							$(".month1").addClass("active"); 
							break;
						case 3 : 
							sdt = month6ago;  
							$(".month6").addClass("active"); 
							break;
						case 4 : 
							sdt = year1ago;  
							$(".year1").addClass("active"); 
							break;
						case 5 : 
							sdt = year5ago;  
							$(".year5").addClass("active"); 
							break;
						default : 
							sdt = '2022-01-01';
							edt = today; 
							$(".allday").addClass("active"); 
							break;
					}
					$("#sch_startdt").val(sdt);
					$("#sch_enddt").val(edt);
					
				}
				$(function() {
					setdate(setday);
					
				});
				</script>
			</div>
            <div class="wr-list">
                <div class="wr-list-label">검색어</div>
                <input type="text" name="stx" value="<?php echo $stx?>" class="span280 ml10" placeholder="전화번호/이름/회원아이디/닉네임/이메일">
            </div>
		</div>
	</div>
	<div class="btnSet flex-center">
		<button type="submit" class="btnSearch">조회</button>
		<button type="button" class="btnReset">초기화</button>
	</div>
</div>
</form>

<div class="mt20"></div>

<div class="box-header">
	<a href="#" class="btn span110 reverse gray none">회원 삭제</a>
	<a href="#" class="btn span110 reverse gray none">로그인 정보</a>
	<a href="#" class="btn span110 gray none">회원등록</a><!-- 아마도 사용하지 않을 버튼들.... -->
	<div class="right">
		<a href="<?php echo $excel_download_url ?>" class="btn span150">엑셀 다운로드</a>
		<select class="" title="">
			<option>최신순 / 과거순</option>
			<option>OOO</option>
			<option>OOO</option>
			<option>...</option>
		</select>
	</div>
</div>

<div class="local_ov01 local_ov none">
    <?php echo $listall ?>
    <span class="btn_ov01"><span class="ov_txt">총회원수 </span><span class="ov_num"> <?php echo number_format($total_count) ?>명 </span></span>
	<?php if($is_membership) { ?>
		<a href="?sst=as_date&amp;sod=desc&amp;sfl=<?php echo $sfl ?>&amp;stx=<?php echo $stx ?>" class="btn_ov01"> <span class="ov_txt">멤버쉽 </span><span class="ov_num"><?php echo number_format($membership_count) ?></span></a>
	<?php } ?>
	<a href="?sst=mb_intercept_date&amp;sod=desc&amp;sfl=<?php echo $sfl ?>&amp;stx=<?php echo $stx ?>" class="btn_ov01"> <span class="ov_txt">차단 </span><span class="ov_num"><?php echo number_format($intercept_count) ?>명</span></a>
    <a href="?sst=mb_leave_date&amp;sod=desc&amp;sfl=<?php echo $sfl ?>&amp;stx=<?php echo $stx ?>" class="btn_ov01"> <span class="ov_txt">탈퇴  </span><span class="ov_num"><?php echo number_format($leave_count) ?>명</span></a>
</div>

<form id="fsearch" name="fsearch" class="local_sch01 local_sch none" method="get">
<label for="sfl" class="sound_only">검색대상</label>
<select name="sfl" id="sfl">
    <option value="mb_id"<?php echo get_selected($_GET['sfl'], "mb_id"); ?>>회원아이디</option>
    <option value="mb_nick"<?php echo get_selected($_GET['sfl'], "mb_nick"); ?>>닉네임</option>
    <option value="mb_name"<?php echo get_selected($_GET['sfl'], "mb_name"); ?>>이름</option>
    <option value="mb_level"<?php echo get_selected($_GET['sfl'], "mb_level"); ?>>권한</option>
    <option value="mb_email"<?php echo get_selected($_GET['sfl'], "mb_email"); ?>>E-MAIL</option>
    <option value="mb_tel"<?php echo get_selected($_GET['sfl'], "mb_tel"); ?>>전화번호</option>
    <option value="mb_hp"<?php echo get_selected($_GET['sfl'], "mb_hp"); ?>>휴대폰번호</option>
    <option value="mb_point"<?php echo get_selected($_GET['sfl'], "mb_point"); ?>>포인트</option>
    <option value="mb_datetime"<?php echo get_selected($_GET['sfl'], "mb_datetime"); ?>>가입일시</option>
    <option value="mb_ip"<?php echo get_selected($_GET['sfl'], "mb_ip"); ?>>IP</option>
    <option value="mb_recommend"<?php echo get_selected($_GET['sfl'], "mb_recommend"); ?>>추천인</option>
    <option value="mb_1"<?php echo get_selected($_GET['sfl'], "mb_1"); ?>>여분필드1</option>
</select>
<label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
<input type="text" name="stx" value="<?php echo $stx ?>" id="stx" required class="required frm_input">
<input type="submit" class="btn_submit" value="검색">
</form>

<div class="local_desc01 local_desc none">
    <p>
        회원자료 삭제 시 다른 회원이 기존 회원아이디를 사용하지 못하도록 회원아이디, 이름, 닉네임은 삭제하지 않고 영구 보관합니다.
    </p>
</div>

<form name="fmemberlist" id="fmemberlist" action="./member_list_update.php" onsubmit="return fmemberlist_submit(this);" method="post">
<input type="hidden" name="sst" value="<?php echo $sst ?>">
<input type="hidden" name="sod" value="<?php echo $sod ?>">
<input type="hidden" name="sfl" value="<?php echo $sfl ?>">
<input type="hidden" name="stx" value="<?php echo $stx ?>">
<input type="hidden" name="page" value="<?php echo $page ?>">
<input type="hidden" name="token" value="">

<div class="tbl-basic fs13 outline odd line-nth-2">
    <table>
    <caption><?php echo $g5['title']; ?> 목록</caption>
    <thead>
    <tr>
        <th scope="col" id="mb_list_chk" >
            <label for="chkall" class="sound_only">회원 전체</label>
            <input type="checkbox" name="chkall" value="1" id="chkall" onclick="check_all(this.form)">
        </th>
		<th scope="col">NO</th>
		<th scope="col">승인</th>
		<th scope="col">호스트 /<br>게스트</th>
		<th scope="col">직장인 /<br>프리랜서</th>
		<th scope="col">회원코드</th>
        <th scope="col" id="mb_list_id" ><?php echo subject_sort_link('mb_id') ?>아이디</a></th>
		<th scope="col" id="mb_list_nick"><?php echo subject_sort_link('mb_nick') ?>닉네임</a></th>
		<th scope="col" id="mb_list_name"><?php echo subject_sort_link('mb_name') ?>이름</a></th>
		<th scope="col" id="mb_list_mobile">휴대폰 번호</th>
		<th scope="col">이메일</th>
		<!-- <th scope="col">성별</th> -->
		<!-- <th scope="col">생년월일</th> -->
		<th scope="col" id="mb_list_join"><?php echo subject_sort_link('mb_datetime', '', 'desc') ?>가입일</a></th>
		<th scope="col">직장</th>
		<!-- <th scope="col">신입/경력</th> -->
		<!-- <th scope="col">직군</th> -->
		<!-- <th scope="col">직무</th> -->
		<th scope="col">관심분야<br>(2개이상)</th>
		<!-- <th scope="col">접속수</th>		 -->
		<th scope="col" id="mb_list_mng">관리</th>       
	</tr>
	<tr class="none"> 
        <!--<th scope="col" id="mb_list_cert"><?php echo subject_sort_link('mb_certify', '', 'desc') ?>본인확인</a></th>
        <th scope="col" id="mb_list_mailc"><?php echo subject_sort_link('mb_email_certify', '', 'desc') ?>메일인증</a></th>
        <th scope="col" id="mb_list_open"><?php echo subject_sort_link('mb_open', '', 'desc') ?>정보공개</a></th>
        <th scope="col" id="mb_list_mailr"><?php echo subject_sort_link('mb_mailling', '', 'desc') ?>메일수신</a></th>
        <th scope="col" id="mb_list_auth">상태</th>        
        <th scope="col" id="mb_list_lastcall"><?php echo subject_sort_link('mb_today_login', '', 'desc') ?>최종접속</a></th>
        <th scope="col" id="mb_list_grp">접근그룹</th>
		<?php if($is_membership) { ?>
	        <th scope="col" id="as_membership"><?php echo subject_sort_link('as_date', '', 'desc') ?>멤버쉽기간(잔여시간)</a></th>
		<?php } ?>
		<th scope="col" id="mb_list_sms"><?php echo subject_sort_link('mb_sms', '', 'desc') ?>SMS수신</a></th>
        <th scope="col" id="mb_list_adultc"><?php echo subject_sort_link('mb_adult', '', 'desc') ?>성인인증</a></th>
        <th scope="col" id="mb_list_auth"><?php echo subject_sort_link('mb_intercept_date', '', 'desc') ?>접근차단</a></th>
        <th scope="col" id="mb_list_deny"><?php echo subject_sort_link('mb_level', '', 'desc') ?>권한</a></th>
        <th scope="col" id="mb_list_tel">전화번호</th>        
        <th scope="col" id="mb_list_point"><?php echo subject_sort_link('mb_point', '', 'desc') ?> 포인트</a></th>
		<?php if($is_membership) { ?>
			<th scope="col" id="as_membership_add">기간증감/해제</th>
		<?php } ?>-->       
    </tr>
    </thead>
    <tbody>
    <?php
    for ($i=0; $row=sql_fetch_array($result); $i++) {
        // 접근가능한 그룹수
        $sql2 = " select count(*) as cnt from {$g5['group_member_table']} where mb_id = '{$row['mb_id']}' ";
        $row2 = sql_fetch($sql2);
        $group = '';
        if ($row2['cnt'])
            $group = '<a href="./boardgroupmember_form.php?mb_id='.$row['mb_id'].'">'.$row2['cnt'].'</a>';

        if ($is_admin == 'group') {
            $s_mod = '';
        } else {
            $s_mod = '<a href="./member_form.php?'.$qstr.'&amp;w=u&amp;mb_id='.$row['mb_id'].'" class="btn btn_03 mini">수정</a>';
        }
        $s_grp = '<a href="./boardgroupmember_form.php?mb_id='.$row['mb_id'].'" class="btn btn_02">그룹</a>';

        $leave_date = $row['mb_leave_date'] ? $row['mb_leave_date'] : date('Ymd', G5_SERVER_TIME);
        $intercept_date = $row['mb_intercept_date'] ? $row['mb_intercept_date'] : date('Ymd', G5_SERVER_TIME);

        $mb_nick = get_text($row['mb_nick']);
//        $mb_nick = get_sideview($row['mb_id'], get_text($row['mb_nick']), $row['mb_email'], $row['mb_homepage']);

        $mb_id = $row['mb_id'];
        $leave_msg = '';
        $intercept_msg = '';
        $intercept_title = '';
        if ($row['mb_leave_date']) {
            $mb_id = $mb_id;
            $leave_msg = '<span class="mb_leave_msg">탈퇴함</span>';
        }
        else if ($row['mb_intercept_date']) {
            $mb_id = $mb_id;
            $intercept_msg = '<span class="mb_intercept_msg">차단됨</span>';
            $intercept_title = '차단해제';
        }
        if ($intercept_title == '')
            $intercept_title = '차단하기';

        $address = $row['mb_zip1'] ? print_address($row['mb_addr1'], $row['mb_addr2'], $row['mb_addr3'], $row['mb_addr_jibeon']) : '';

        $bg = 'bg'.($i%2);

        switch($row['mb_certify']) {
            case 'hp':
                $mb_certify_case = '휴대폰';
                $mb_certify_val = 'hp';
                break;
            case 'ipin':
                $mb_certify_case = '아이핀';
                $mb_certify_val = '';
                break;
            case 'admin':
                $mb_certify_case = '관리자';
                $mb_certify_val = 'admin';
                break;
            default:
                $mb_certify_case = '&nbsp;';
                $mb_certify_val = 'admin';
                break;
        }
    ?>

    <tr class="<?php echo $bg; ?>">
        <td headers="mb_list_chk" class="td_chk">
            <input type="hidden" name="mb_id[<?php echo $i ?>]" value="<?php echo $row['mb_id'] ?>" id="mb_id_<?php echo $i ?>">
            <label for="chk_<?php echo $i; ?>" class="sound_only"><?php echo get_text($row['mb_name']); ?> <?php echo get_text($row['mb_nick']); ?>님</label>
            <input type="checkbox" name="chk[]" value="<?php echo $i ?>" id="chk_<?php echo $i ?>">
        </td>
		<td><?php echo ($page-1)*$rows+$i+1;?></td>
		<td><?php echo $row['membership'];?></td>
		<td><?php echo $row['mb_gubun']; ?></td>
		<td><?php echo $row['mb_type']; ?></td>
		<td><?php echo $row['invite_code']; ?></td>		
        <td headers="mb_list_id"  class="td_name sv_use" style="
    display: flex;
    justify-content: center;
">
            <?php echo $mb_id ?>
            <?php
            //소셜계정이 있다면
            if(function_exists('social_login_link_account')){
                if( $my_social_accounts = social_login_link_account($row['mb_id'], false, 'get_data') ){
                    
                    echo '<div class="member_social_provider sns-wrap-over sns-wrap-32">';
                    foreach( (array) $my_social_accounts as $account){     //반복문
                        if( empty($account) || empty($account['provider']) ) continue;
                        
                        $provider = strtolower($account['provider']);
                        $provider_name = social_get_provider_service_name($provider);
                        
                        echo '<span class="sns-icon sns-'.$provider.'" title="'.$provider_name.'">';
                        echo '<span class="ico"></span>';
                        echo '<span class="txt">'.$provider_name.'</span>';
                        echo '</span>';
                    }
                    echo '</div>';
                }
            }
            ?>
        </td>
		<td headers="mb_list_nick" class="td_name sv_use"><div><?php echo $mb_nick ?></div></td>
		<td headers="mb_list_name" class="td_mbname"><?php echo get_text($row['mb_name']); ?></td>        
		<td headers="mb_list_mobile" class="td_tel"><?php echo get_text($row['mb_hp']); ?></td>
		<td><?php echo get_text($row['mb_email']);?></td>
		<!-- <td>남</td> -->
		<!-- <td>1995-05-04</td> -->
		<td headers="mb_list_join" class="td_date"><?php echo substr($row['mb_datetime'],2,8); ?></td>
		<td><?php echo get_text($row['company_name']);?></td>
		<!-- <td>신입</td> -->
		<!-- <td>디자이너</td> -->
		<!-- <td>UXUI 디자이너</td> -->
		<td>액티비티,뷰티</td>
		<!-- <td>2</td> -->
		<td headers="mb_list_mng" class="td_mng td_mng_s"><?php echo $s_mod ?></td>
		
	</tr>
	<tr class="none">
        <td headers="mb_list_cert"  class="td_mbcert none">
            <input type="radio" name="mb_certify[<?php echo $i; ?>]" value="ipin" id="mb_certify_ipin_<?php echo $i; ?>" <?php echo $row['mb_certify']=='ipin'?'checked':''; ?>>
            <label for="mb_certify_ipin_<?php echo $i; ?>">아이핀</label><br>
            <input type="radio" name="mb_certify[<?php echo $i; ?>]" value="hp" id="mb_certify_hp_<?php echo $i; ?>" <?php echo $row['mb_certify']=='hp'?'checked':''; ?>>
            <label for="mb_certify_hp_<?php echo $i; ?>">휴대폰</label>
        </td>
        <td headers="mb_list_mailc" class="none"><?php echo preg_match('/[1-9]/', $row['mb_email_certify'])?'<span class="txt_true">Yes</span>':'<span class="txt_false">No</span>'; ?></td>
        <td headers="mb_list_open" class="none">
            <label for="mb_open_<?php echo $i; ?>" class="sound_only">정보공개</label>
            <input type="checkbox" name="mb_open[<?php echo $i; ?>]" <?php echo $row['mb_open']?'checked':''; ?> value="1" id="mb_open_<?php echo $i; ?>">
        </td>
        <td headers="mb_list_mailr" class="none">
            <label for="mb_mailling_<?php echo $i; ?>" class="sound_only">메일수신</label>
            <input type="checkbox" name="mb_mailling[<?php echo $i; ?>]" <?php echo $row['mb_mailling']?'checked':''; ?> value="1" id="mb_mailling_<?php echo $i; ?>">
        </td>
        <td headers="mb_list_auth" class="td_mbstat none">
            <?php
            if ($leave_msg || $intercept_msg) echo $leave_msg.' '.$intercept_msg;
            else echo "정상";
            ?>
        </td>        
        <td headers="mb_list_lastcall" class="td_date none"><?php echo substr($row['mb_today_login'],2,8); ?></td>
        <td headers="mb_list_grp" class="td_numsmall none"><?php echo $group ?></td>
		<?php if($is_membership) { ?>
			<td headers="as_membership" class="td_tel none">
				<?php if($row['as_date']) { ?>
					<?php echo date("Y/m/d", $row['as_date']);?>(<?php echo number_format(($row['as_date'] - G5_SERVER_TIME) / 3600);?>시간)
				<?php } ?>
				<input type="hidden" name="as_date[<?php echo $i; ?>]" value="<?php echo $row['as_date'];?>" id="as_date_<?php echo $i;?>">
			</td>
		<?php } ?>
        <td headers="mb_list_sms" class="none">
            <label for="mb_sms_<?php echo $i; ?>" class="sound_only">SMS수신</label>
            <input type="checkbox" name="mb_sms[<?php echo $i; ?>]" <?php echo $row['mb_sms']?'checked':''; ?> value="1" id="mb_sms_<?php echo $i; ?>">
        </td>
        <td headers="mb_list_adultc" class="none">
            <label for="mb_adult_<?php echo $i; ?>" class="sound_only">성인인증</label>
            <input type="checkbox" name="mb_adult[<?php echo $i; ?>]" <?php echo $row['mb_adult']?'checked':''; ?> value="1" id="mb_adult_<?php echo $i; ?>">
        </td>
        <td headers="mb_list_deny" class="none">
            <?php if(empty($row['mb_leave_date'])){ ?>
            <input type="checkbox" name="mb_intercept_date[<?php echo $i; ?>]" <?php echo $row['mb_intercept_date']?'checked':''; ?> value="<?php echo $intercept_date ?>" id="mb_intercept_date_<?php echo $i ?>" title="<?php echo $intercept_title ?>">
            <label for="mb_intercept_date_<?php echo $i; ?>" class="sound_only">접근차단</label>
            <?php } ?>
        </td>
        <td headers="mb_list_auth" class="td_mbstat none">
            <?php echo get_member_level_select("mb_level[$i]", 1, $member['mb_level'], $row['mb_level']) ?>
        </td>
        <td headers="mb_list_tel" class="td_tel none"><?php echo get_text($row['mb_tel']); ?></td>
        
        <td headers="mb_list_point" class="td_num none"><a href="point_list.php?sfl=mb_id&amp;stx=<?php echo $row['mb_id'] ?>"><?php echo number_format($row['mb_point']) ?></a></td>
		<?php if($is_membership) { ?>
			<td headers="as_membership_add" class="td_date">
				<?php if($row['as_date']) { ?>
					± <input type="text" name="as_date_plus[<?php echo $i; ?>]" value="" id="as_date_plus_<?php echo $i;?>" maxlength="20" class="frm_input" size="4"> 일
					-
					<label><input type="checkbox" name="as_date_del[<?php echo $i; ?>]" value="1" id="as_date_del_<?php echo $i;?>"> 해제</label>
				<?php } ?>
			</td>
		<?php } ?>  
		
		<td headers="mb_list_mng" class="td_mng td_mng_s"><?php echo $s_mod ?></td>
    </tr>
    <?php
    }
    if ($i == 0)
        echo "<tr><td colspan=\"".$colspan."\" class=\"empty_table\">자료가 없습니다.</td></tr>";
    ?>
    </tbody>
    </table>
</div>

<div class="btn_list01 btn_list">
	<input type="button" name="act_button" value="선택 회원 삭제" onclick="submitDeleteUserForm()" class="btn btn_02">
	<!-- <input type="submit" name="act_button" value="완전 회원 삭제" onclick="document.pressed=this.value" class="btn btn_02"> -->
</div>

<div class="btn_fixed_top">
	<?php if ($is_admin == 'super') { ?>
    <a href="./member_form.php" id="member_add" class="btn btn_01">회원등록</a>
    <?php } ?>
</div>

</form>

<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, '?'.$qstr.'&amp;page='); ?>

</div>

<script>
    $('.btnReset').click(function(){
        $('select').val('');
        $('input[name="stx"]').val('');
        $('input[name="sch_startdt"]').val('');
        $('input[name="sch_enddt"]').val('');
    })
function submitDeleteUserForm(){
    if (!alert("선택된 회원을 삭제 하시겠습니까?")) {
        return false;
    }

	$('#fmemberlist').attr('action', './member_list_delete.php');
	$('#fmemberlist').submit();
}
function fmemberlist_submit(f)
{
    if (!is_checked("chk[]")) {
        alert(document.pressed+" 하실 항목을 하나 이상 선택하세요.");
        return false;
    }

    if(document.pressed == "선택 회원 삭제") {
        if(!confirm("선택회원의 기본정보만 삭제되며 아이디, 닉네임 기록은 남습니다.\n\n선택한 자료를 정말 삭제하시겠습니까?")) {
            return false;
        }
    }

    if(document.pressed == "완전 회원 삭제") {
        if(!confirm("선택회원의 회원정보 자체를 DB에서 완전히 삭제합니다.\n\n선택한 자료를 정말 삭제하시겠습니까?")) {
            return false;
        }
    }

    return true;
}
</script>

<?php
include_once ('./admin.tail.php');
?>
