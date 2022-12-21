<?php
if (!defined('_GNUBOARD_')) exit;

// 쇼핑몰메인 불러오기
if (defined('G5_USE_SHOP') && G5_USE_SHOP) {
	//include_once (ADMIN_SKIN_PATH.'/shop.php');
}

// 커뮤니티메인
$new_member_rows = 3;
$new_point_rows = 5;
$new_write_rows = 5;

$sql_common = " from {$g5['member_table']} ";

$sql_search = " where (1)  and mb_datetime = (CURDATE() - INTERVAL 1 DAY) ";

if ($is_admin != 'super')
    $sql_search .= " and mb_level <= '{$member['mb_level']}' ";

if (!$sst) {
    $sst = "mb_datetime";
    $sod = "desc";
}

$sql_order = " order by {$sst} {$sod} ";

$sql = " select count(*) as cnt {$sql_common} {$sql_search} {$sql_order} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

// 탈퇴회원수
$sql = " select count(*) as cnt {$sql_common} {$sql_search} and mb_leave_date <> '' and mb_datetime = (CURDATE() - INTERVAL 1 DAY) {$sql_order} ";
$row = sql_fetch($sql);
$leave_count = $row['cnt'];

// 차단회원수
$sql = " select count(*) as cnt {$sql_common} {$sql_search} and mb_intercept_date <> '' and mb_datetime = (CURDATE() - INTERVAL 1 DAY) {$sql_order} ";
$row = sql_fetch($sql);
$intercept_count = $row['cnt'];

$sql = " select * {$sql_common} {$sql_search} {$sql_order} limit {$new_member_rows} ";
$result = sql_query($sql);

$colspan = 12;
?>

<style>.page-title{display:none}</style>

<div id="main"><?=$ca['as_partner']?>
	<div class="h3 mb30"><?php echo $member['mb_name']?>님, 반갑습니다.</div>

	<div class="boxContainer padding15">			
		<ul class="flex">
            <?php $visit = getLatestVisitCountList();
            for($i=0;$i<count($visit);$i++) { ?>
			<li class="flex1 tcenter">
                <span><?php echo date('Y.m.d', strtotime($visit[$i]['vi_date'])); ?></span>
                <b class="ml15 mainColor">방문 <?php echo $visit[$i]['cnt']; ?>명</b>
            </li>
            <?php } ?>
		</ul>
	</div>

	<div class="mt30"></div>
    <?php
        $partner = "SELECT count(*) cnt FROM g5_apms_partner WHERE (pt_register = '' or pt_register is null) ";
        $p_count = sql_fetch($partner);
//		$member = "SELECT count(*) cnt FROM g5_member WHERE mb_status = ''";
		$member = "SELECT count(*) cnt FROM g5_member where com_cert_send is null and mb_status = '대기'";
        $m_count = sql_fetch($member);
        $class = "SELECT count(*) cnt FROM g5_write_class WHERE moa_status in ('0','')";
        $c_count = sql_fetch($class);
    ?>
	<div class="h6 mb10">승인 요청 [처리해야할 요청 사항 입니다]</div>
	<div class="flex gap20 flex-stretch">
		<div class="boxContainer flex1 flexCenter column">
			<span class="fs18 color-gray noto500">게스트 승인 요청</span>
			<span class="new-num"><?php echo $m_count['cnt']; ?></span>
			<a href="/adm/confirm_member_list.php" class="mt5 more">더보기<i class="ml5 arrow-right"></i></a>
		</div>
		<div class="boxContainer flex1 flexCenter column">
			<span class="fs18 color-gray noto500">호스트 승인 요청</span>
			<span class="new-num"><?php echo $p_count['cnt']; ?></span>
			<a href="/adm/confirm_host_list.php" class="mt5 more">더보기<i class="ml5 arrow-right"></i></a>
		</div>
		<div class="boxContainer flex1 flexCenter column">
			<span class="fs18 color-gray noto500">모임 승인 요청</span>
			<span class="new-num"><?php echo $c_count['cnt']?></span>
			<a href="/adm/shop_admin/confirm_moa_list.php" class="mt5 more">더보기<i class="ml5 arrow-right"></i></a>
		</div>
		<div class="boxContainer flex1 flexCenter column">
			<span class="fs18 color-gray noto500">프로필 수정 승인 요청</span>
			<span class="new-num">12</span>
			<a href="#" class="mt5 more">더보기<i class="ml5 arrow-right"></i></a>
		</div>
	</div>

	<div class="mt60"></div>

	<div class="slide-toggle-wraper">
		<div class="slide-toggle-list open">
            <?php
            $sql1 = "select * from deb_class_item a join g5_shop_item b on a.it_id = b.it_id join g5_write_class c on b.it_2 = c.wr_id join g5_member d on c.mb_id = d.mb_id where moa_status != '반려' AND moa_status != '삭제' AND moa_status != '취소' order by a.it_id desc limit 0, 5";
            $result1 = sql_query($sql1);
            ?>
			<div class="slide-opener">최근 등록 모임 <span class="noto600">5건</span></div>
			<div class="slideCon">
				<div class="tbl-basic white odd border">
					<table>
						<colgroup>
							<col width="70">
							<col>
							<col>
							<col>
							<col>
							<col>
							<col>
							<col>
						</colgroup>
						<thead>
							<tr>
								<th>번호</th>
								<th>모임 유형1</th>
								<th>모임 유형2</th>
								<th>모임 유형3</th>
								<th>모임 제목</th>
								<th>호스트명</th>
								<th>호스트 번호</th>
								<th>등록 날짜</th>
							</tr>
						</thead>
						<tbody>
                            <?php
                            $i = 1;
                            while($row1 = sql_fetch_array($result1)) { ?>
							<tr>
								<td><?php echo $i; ?></td>
								<td><?php echo $row1['moa_onoff']; ?></td>
								<td><?php echo $row1['cls_no']; ?>회차</td>
								<td><?php echo $row1['moa_form'] ?></td>
								<td><?php echo $row1['wr_subject']; ?></td>
								<td><?php echo $row1['mb_name']; ?></td>
								<td><?php echo $row1['mb_hp']; ?></td>
								<td class="date"><?php echo date('Y-m-d', strtotime($row1['wr_datetime'])); ?></td>
							</tr>
                            <?php $i++; } ?>
						</tbody>			
					</table>
				</div>
				<div class="btnSet mt20">
					<a href="/adm/shop_admin/itemmoa_list.php" class="btn small color-white">전체보기<i class="ml5 arrow-right"></i></a>
				</div>
			</div>
		</div>
	</div>

	<div class="mt60"></div>

	<div class="flex gap30">

		<div class="slide-toggle-wraper flex1">
			<div class="slide-toggle-list open">
                <?php
                    $cnt = 'select count(*) cnt from g5_member where mb_level = 3 and mb_datetime >= (CURDATE() - INTERVAL 1 DAY) order by mb_id';
                    $cnt_result = sql_fetch($cnt);
                    $sql3 = "select * from g5_member where mb_level = 3 and mb_datetime >= (CURDATE() - INTERVAL 1 DAY) order by mb_id desc limit 0, 3";
                    $result3 = sql_query($sql3);
                ?>
				<div class="slide-opener">최근 가입한 호스트 <span class="noto600"><?php echo $cnt_result['cnt'] ? $cnt_result['cnt'] : 0; ?>건</span></div>
				<div class="slideCon">
					<div class="flex fs13 line-height120 color-gray">
                        <?php
                        for($i=0; $row3=sql_fetch_array($result3); $i++) { ?>
                            <div class="flex1 tcenter">
                                <span class="profile-thumb"><?php echo get_mb_img($row3['mb_id'])?></span>
                                <p class="mt10">
                                    <?php echo get_text($row3['mb_name'])?><br>
                                    <span class="fs12"><?php echo $row3['mb_email']?></span>
                                </p>
                            </div>
                        <?php }
                        if($i == 0) { ?>
                            <div class="flex1 tcenter">
                                <p class="mt10">
                                    <span>최근 가입한 호스트가 없습니다</span>
                                </p>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="btnSet mt20">
						<a href="/adm/member_list.php?mb_level=3" class="btn small color-white">전체보기<i class="ml5 arrow-right"></i></a>
					</div>
				</div>
			</div>
		</div>
		<div class="slide-toggle-wraper flex1">
			<div class="slide-toggle-list open">
                <?php
                    $cnt1 = 'select count(*) cnt from g5_member where mb_level <= 2 and mb_datetime >= (CURDATE() - INTERVAL 1 DAY) order by mb_id';
                    $cnt_result1 = sql_fetch($cnt1);
                ?>
				<div class="slide-opener">최근 가입한 게스트 <span class="noto600"><?php echo $cnt_result1['cnt'] ? $cnt_result1['cnt'] : 0; ?>건</span></div>
				<div class="slideCon">
					<div class="flex fs13 line-height120 color-gray">
						<?php for($i=0; $row=sql_fetch_array($result); $i++) {
							// 접근가능한 그룹수
							$sql2 = " select count(*) as cnt from {$g5['group_member_table']} where mb_id = '{$row['mb_id']}' and mb_level <= 2 and  mb_datetime >= (CURDATE() - INTERVAL 1 DAY) ";
							$row2 = sql_fetch($sql2);
							$group = "";
							if ($row2['cnt'])
								$group = '<a href="./boardgroupmember_form.php?mb_id='.$row['mb_id'].'">'.$row2['cnt'].'</a>';

							if ($is_admin == 'group') {
								$s_mod = '';
								$s_del = '';
							} else {
								$s_mod = '<a href="./member_form.php?$qstr&amp;w=u&amp;mb_id='.$row['mb_id'].'">수정</a>';
								$s_del = '<a href="./member_delete.php?'.$qstr.'&amp;w=d&amp;mb_id='.$row['mb_id'].'&amp;url='.$_SERVER['SCRIPT_NAME'].'" onclick="return delete_confirm(this);">삭제</a>';
							}
							$s_grp = '<a href="./boardgroupmember_form.php?mb_id='.$row['mb_id'].'">그룹</a>';

							$leave_date = $row['mb_leave_date'] ? $row['mb_leave_date'] : date("Ymd", G5_SERVER_TIME);
							$intercept_date = $row['mb_intercept_date'] ? $row['mb_intercept_date'] : date("Ymd", G5_SERVER_TIME);

							$mb_nick = get_sideview($row['mb_id'], get_text($row['mb_nick']), $row['mb_email'], $row['mb_homepage']);

							$mb_id = $row['mb_id'];
							if ($row['mb_leave_date'])
								$mb_id = $mb_id;
							else if ($row['mb_intercept_date'])
								$mb_id = $mb_id;

						?>
						<div class="flex1 tcenter">
							<span class="profile-thumb"><?=get_mb_img($row['mb_id'])?></span>
							<p class="mt10">
								<?=get_text($row['mb_name'])?><br>
								<span class="fs12"><?=$row['mb_email']?></span>
							</p>
						</div>
						<?php
							}
						if ($i == 0)
							echo '<div class="flex1 tcenter">
                            <p>
                            <span>최근 가입한 게스트가 없습니다.</span>
							</p>
						</div>';
						?>						
					</div>
					<div class="btnSet mt20">
						<a href="/adm/member_list.php" class="btn small color-white">전체보기<i class="ml5 arrow-right"></i></a>
					</div>
				</div>
			</div>
		</div>		
		<div class="slide-toggle-wraper flex1">
			<div class="slide-toggle-list open">
                <?php
                    $notice_cnt = 'select count(*) cnt from g5_write_qa where wr_datetime >= (CURDATE() - INTERVAL 1 DAY) order by wr_id';
                    $notice_result = sql_fetch($notice_cnt);
                ?>
				<div class="slide-opener">최근 문의사항 <span class="noto600"><?php echo $notice_result['cnt'] ? $notice_result['cnt'] : 0; ?>건</span></div>
				<div class="slideCon">
                    <?php
                        $notice = "select * from g5_write_qa where wr_datetime >= (CURDATE() - INTERVAL 1 DAY) order by wr_id";
                        $result4 = sql_query($notice);
                    ?>
					<ul class="ul_basic fs13 color-gray">
                        <?php for($i=0; $row4=sql_fetch_array($result4); $i++) {  ?>
                                    <li><a href="/adm/bbs/board.php?bo_table=qa&wr_id=<?php echo $row4['wr_id']; ?>"><?php echo $row4['wr_subject'] ?></a></li>
                                <?php }
                            if($i=0){ ?>
                                <div class="flex1 tcenter">
                                    <p>
                                        <span>최근 등록된 문의가 없습니다.</span>
                                    </p>
                                </div>
                        <?php }?>
					</ul>
					<div class="btnSet mt25">
						<a href="/adm/bbs/board.php?bo_table=qa" class="btn small color-white">전체보기<i class="ml5 arrow-right"></i></a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="mt60"></div>


	<div class="boxContainer none">
	<section>
		<h2>신규가입회원 <?php echo $new_member_rows ?>건 목록</h2>
		<div class="local_desc02 local_desc">
			총회원수 <?php echo number_format($total_count) ?>명 중 차단 <?php echo number_format($intercept_count) ?>명, 탈퇴 : <?php echo number_format($leave_count) ?>명
		</div>

		<div class="tbl_head01 tbl_wrap">
			<table>
			<caption>신규가입회원</caption>
			<thead>
			<tr>
				<th scope="col">회원아이디</th>
				<th scope="col">이름</th>
				<th scope="col">닉네임</th>
				<th scope="col">권한</th>
				<th scope="col">포인트</th>
				<th scope="col">수신</th>
				<th scope="col">공개</th>
				<th scope="col">인증</th>
				<th scope="col">차단</th>
				<th scope="col">그룹</th>
			</tr>
			</thead>
			<tbody>
			<?php
			for ($i=0; $row=sql_fetch_array($result); $i++)
			{
				// 접근가능한 그룹수
				$sql2 = " select count(*) as cnt from {$g5['group_member_table']} where mb_id = '{$row['mb_id']}' ";
				$row2 = sql_fetch($sql2);
				$group = "";
				if ($row2['cnt'])
					$group = '<a href="./boardgroupmember_form.php?mb_id='.$row['mb_id'].'">'.$row2['cnt'].'</a>';

				if ($is_admin == 'group')
				{
					$s_mod = '';
					$s_del = '';
				}
				else
				{
					$s_mod = '<a href="./member_form.php?$qstr&amp;w=u&amp;mb_id='.$row['mb_id'].'">수정</a>';
					$s_del = '<a href="./member_delete.php?'.$qstr.'&amp;w=d&amp;mb_id='.$row['mb_id'].'&amp;url='.$_SERVER['SCRIPT_NAME'].'" onclick="return delete_confirm(this);">삭제</a>';
				}
				$s_grp = '<a href="./boardgroupmember_form.php?mb_id='.$row['mb_id'].'">그룹</a>';

				$leave_date = $row['mb_leave_date'] ? $row['mb_leave_date'] : date("Ymd", G5_SERVER_TIME);
				$intercept_date = $row['mb_intercept_date'] ? $row['mb_intercept_date'] : date("Ymd", G5_SERVER_TIME);

				$mb_nick = get_sideview($row['mb_id'], get_text($row['mb_nick']), $row['mb_email'], $row['mb_homepage']);

				$mb_id = $row['mb_id'];
				if ($row['mb_leave_date'])
					$mb_id = $mb_id;
				else if ($row['mb_intercept_date'])
					$mb_id = $mb_id;

			?>
			<tr>
				<td class="td_mbid"><?php echo $mb_id ?></td>
				<td class="td_mbname"><?php echo get_text($row['mb_name']); ?></td>
				<td class="td_mbname sv_use"><div><?php echo $mb_nick ?></div></td>
				<td class="td_num"><?php echo $row['mb_level'] ?></td>
				<td><a href="./point_list.php?sfl=mb_id&amp;stx=<?php echo $row['mb_id'] ?>"><?php echo number_format($row['mb_point']) ?></a></td>
				<td class="td_boolean"><?php echo $row['mb_mailling']?'예':'아니오'; ?></td>
				<td class="td_boolean"><?php echo $row['mb_open']?'예':'아니오'; ?></td>
				<td class="td_boolean"><?php echo preg_match('/[1-9]/', $row['mb_email_certify'])?'예':'아니오'; ?></td>
				<td class="td_boolean"><?php echo $row['mb_intercept_date']?'예':'아니오'; ?></td>
				<td class="td_category"><?php echo $group ?></td>
			</tr>
			<?php
				}
			if ($i == 0)
				echo '<tr><td colspan="'.$colspan.'" class="empty_table">자료가 없습니다.</td></tr>';
			?>
			</tbody>
			</table>
		</div>

		<div class="btn_list03 btn_list">
			<a href="./member_list.php">회원 전체보기</a>
		</div>

	</section>
	</div>
	
	<?php
	$sql_common = " from {$g5['board_new_table']} a, {$g5['board_table']} b, {$g5['group_table']} c where a.bo_table = b.bo_table and b.gr_id = c.gr_id ";

	if ($gr_id)
		$sql_common .= " and b.gr_id = '$gr_id' ";
	if ($view) {
		if ($view == 'w')
			$sql_common .= " and a.wr_id = a.wr_parent ";
		else if ($view == 'c')
			$sql_common .= " and a.wr_id <> a.wr_parent ";
	}
	$sql_order = " order by a.bn_id desc ";

	$sql = " select count(*) as cnt {$sql_common} ";
	$row = sql_fetch($sql);
	$total_count = $row['cnt'];

	$colspan = 5;
	?>

	<div class="boxContainer none">
	<section>
		<h2>최근게시물</h2>

		<div class="tbl_head01 tbl_wrap">
			<table>
			<caption>최근게시물</caption>
			<thead>
			<tr>
				<th scope="col">그룹</th>
				<th scope="col">게시판</th>
				<th scope="col">제목</th>
				<th scope="col">이름</th>
				<th scope="col">일시</th>
			</tr>
			</thead>
			<tbody>
			<?php
			$sql = " select a.*, b.bo_subject, c.gr_subject, c.gr_id {$sql_common} {$sql_order} limit {$new_write_rows} ";
			$result = sql_query($sql);
			for ($i=0; $row=sql_fetch_array($result); $i++)
			{
				$tmp_write_table = $g5['write_prefix'] . $row['bo_table'];

				if ($row['wr_id'] == $row['wr_parent']) // 원글
				{
					$comment = "";
					$comment_link = "";
					$row2 = sql_fetch(" select * from $tmp_write_table where wr_id = '{$row['wr_id']}' ");

					$name = get_sideview($row2['mb_id'], get_text(cut_str($row2['wr_name'], $config['cf_cut_name'])), $row2['wr_email'], $row2['wr_homepage']);
					// 당일인 경우 시간으로 표시함
					$datetime = substr($row2['wr_datetime'],0,10);
					$datetime2 = $row2['wr_datetime'];
					if ($datetime == G5_TIME_YMD)
						$datetime2 = substr($datetime2,11,5);
					else
						$datetime2 = substr($datetime2,5,5);

				}
				else // 코멘트
				{
					$comment = '댓글. ';
					$comment_link = '#c_'.$row['wr_id'];
					$row2 = sql_fetch(" select * from {$tmp_write_table} where wr_id = '{$row['wr_parent']}' ");
					$row3 = sql_fetch(" select mb_id, wr_name, wr_email, wr_homepage, wr_datetime from {$tmp_write_table} where wr_id = '{$row['wr_id']}' ");

					$name = get_sideview($row3['mb_id'], get_text(cut_str($row3['wr_name'], $config['cf_cut_name'])), $row3['wr_email'], $row3['wr_homepage']);
					// 당일인 경우 시간으로 표시함
					$datetime = substr($row3['wr_datetime'],0,10);
					$datetime2 = $row3['wr_datetime'];
					if ($datetime == G5_TIME_YMD)
						$datetime2 = substr($datetime2,11,5);
					else
						$datetime2 = substr($datetime2,5,5);
				}
			?>

			<tr>
				<td class="td_category"><a href="<?php echo G5_BBS_URL ?>/new.php?gr_id=<?php echo $row['gr_id'] ?>"><?php echo cut_str($row['gr_subject'],10) ?></a></td>
				<td class="td_category"><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=<?php echo $row['bo_table'] ?>"><?php echo cut_str($row['bo_subject'],20) ?></a></td>
				<td><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=<?php echo $row['bo_table'] ?>&amp;wr_id=<?php echo $row2['wr_id'] ?><?php echo $comment_link ?>"><?php echo $comment ?><?php echo conv_subject($row2['wr_subject'], 100) ?></a></td>
				<td class="td_mbname"><div><?php echo $name ?></div></td>
				<td class="td_datetime"><?php echo $datetime ?></td>
			</tr>

			<?php
			}
			if ($i == 0)
				echo '<tr><td colspan="'.$colspan.'" class="empty_table">자료가 없습니다.</td></tr>';
			?>
			</tbody>
			</table>
		</div>

		<div class="btn_list03 btn_list">
			<a href="<?php echo G5_BBS_URL ?>/new.php">최근게시물 더보기</a>
		</div>
	</section>
	</div>

	<?php
	$sql_common = " from {$g5['point_table']} ";
	$sql_search = " where (1) ";
	$sql_order = " order by po_id desc ";

	$sql = " select count(*) as cnt {$sql_common} {$sql_search} {$sql_order} ";
	$row = sql_fetch($sql);
	$total_count = $row['cnt'];

	$sql = " select * {$sql_common} {$sql_search} {$sql_order} limit {$new_point_rows} ";
	$result = sql_query($sql);

	$colspan = 7;
	?>

	<div class="boxContainer none">
	<section>
		<h2>최근 포인트 발생내역</h2>
		<div class="local_desc02 local_desc">
			전체 <?php echo number_format($total_count) ?> 건 중 <?php echo $new_point_rows ?>건 목록
		</div>

		<div class="tbl_head01 tbl_wrap">
			<table>
			<caption>최근 포인트 발생내역</caption>
			<thead>
			<tr>
				<th scope="col">회원아이디</th>
				<th scope="col">이름</th>
				<th scope="col">닉네임</th>
				<th scope="col">일시</th>
				<th scope="col">포인트 내용</th>
				<th scope="col">포인트</th>
				<th scope="col">포인트합</th>
			</tr>
			</thead>
			<tbody>
			<?php
			$row2['mb_id'] = '';
			for ($i=0; $row=sql_fetch_array($result); $i++)
			{
				if ($row2['mb_id'] != $row['mb_id'])
				{
					$sql2 = " select mb_id, mb_name, mb_nick, mb_email, mb_homepage, mb_point from {$g5['member_table']} where mb_id = '{$row['mb_id']}' ";
					$row2 = sql_fetch($sql2);
				}

				$mb_nick = get_sideview($row['mb_id'], $row2['mb_nick'], $row2['mb_email'], $row2['mb_homepage']);

				$link1 = $link2 = "";
				if (!preg_match("/^\@/", $row['po_rel_table']) && $row['po_rel_table'])
				{
					$link1 = '<a href="'.G5_BBS_URL.'/board.php?bo_table='.$row['po_rel_table'].'&amp;wr_id='.$row['po_rel_id'].'" target="_blank">';
					$link2 = '</a>';
				}
			?>

			<tr>
				<td class="td_mbid"><a href="./point_list.php?sfl=mb_id&amp;stx=<?php echo $row['mb_id'] ?>"><?php echo $row['mb_id'] ?></a></td>
				<td class="td_mbname"><?php echo get_text($row2['mb_name']); ?></td>
				<td class="td_name sv_use"><div><?php echo $mb_nick ?></div></td>
				<td class="td_datetime"><?php echo $row['po_datetime'] ?></td>
				<td><?php echo $link1.$row['po_content'].$link2 ?></td>
				<td class="td_numbig"><?php echo number_format($row['po_point']) ?></td>
				<td class="td_numbig"><?php echo number_format($row['po_mb_point']) ?></td>
			</tr>

			<?php
			}

			if ($i == 0)
				echo '<tr><td colspan="'.$colspan.'" class="empty_table">자료가 없습니다.</td></tr>';
			?>
			</tbody>
			</table>
		</div>

		<div class="btn_list03 btn_list">
			<a href="./point_list.php">포인트내역 전체보기</a>
		</div>
	</section>
	</div>
</div>