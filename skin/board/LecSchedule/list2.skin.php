<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once("$board_skin_path/moonday.php"); // 석봉운님의 음력날짜 함수

if (preg_match('/%/', $width)) {
  $col_width = "14%"; //표의 가로 폭이 100보다 크면 픽셀값입력
} else{
  $col_width = round($width/7); //표의 가로 폭이 100보다 작거나 같으면 백분율 값을 입력
}
$col_height= 80 ;//내용 들어갈 사각공간의 세로길이를 가로 폭과 같도록


if (!$r_date)	{
	//echo $year . " - ".$month . " - ".$day."<br/>";
	if (!($year && $month && $day))	{
		$today = getdate(); 
		$b_mon = $today['mon']; 
		$b_day = $today['mday']; 
		$b_year = $today['year']; 
		if ($year < 1) { // 오늘의 달력 일때
			$month = $b_mon;
			$mday = $b_day;
			$year = $b_year;
			$day = $b_day;
		}
		if ($r_date == null || $r_date = '')	{
			$year = $b_year;
			$month = $b_mon;
			$day = $b_day;
		}
	}
}

$mday = $day;
//echo $mday."<br/>";

if(!$year) 	$year = date("Y");
$file_index = $board_skin_path."/day"; ### 기념일 폴더 위치 지정

### 양력 기념일 파일 지정 : 해당년도 파일이 없으면 기본파일(solar.txt)을 불러온다
if(file_exists($file_index."/".$year.".txt")) {
	$dayfile = file($file_index."/".$year.".txt");
} 
else { 
	$dayfile = file($file_index."/solar.txt");
}

$lastday=array(0,31,28,31,30,31,30,31,31,30,31,30,31);
if ($year%4 == 0) $lastday[2] = 29;
$dayoftheweek = date("w", mktime (0,0,0,$month,1,$year));

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
?>

<?php

$month = sprintf("%02d",$month);
$day = sprintf("%02d",$day);
$dates = $year."-".$month."-".$day;
$rst = resultDaysInfo($dates);
$rd = sql_fetch_array($rst);
$yoil = array('','일','월','화','수','목','금','토');
$p_date = ($r_date)?$r_date:$dates;
//var_dump($rd);
?>
<!--
<div style="margin-bottom:10px;"><img src="<?php //echo G5_THEME_IMG_URL ?>/main1.jpg" alt="메인베너" /></div>
-->

<!--<h2 id="container_title"><?php echo $board['bo_subject'] ?><span class="sound_only"> 목록</span></h2>
-->

<!-- 관리자 로긴 후 선박등록 및 선박일정 등록 -->
<?php if ($rss_href || $write_href) { ?>
<ul class="btn_bo_user">
	
	<?php if ($admin_href) { ?><li><a href="<?php echo "/bbs/board.php?bo_table=reserv&opt=ship" ?>" class="btn_b01">출항스케줄</a></li><?php } ?>
	<?php if ($admin_href) { ?><li><a href="<?php echo "/bbs/board.php?bo_table=aplylist" ?>" class="btn_b01">예약신청자 리스트</a></li><?php } ?>
	<?php if ($write_href) { ?><li><a href="<?php echo $write_href ?>" class="btn_b02"><font color="#ffffff">선박일정 등록</font></a></li><?php } ?>
	<?php if ($admin_href && false) { ?><li><a href="<?php echo $admin_href ?>" class="btn_admin"><font color="#ffffff">관리자</font></a></li><?php } ?>
</ul>
<?php } ?>

<!-- 년월 선택 -->
<table border="0" cellspacing="5" cellpadding="5" id="yearmonth">
	<tr>
		<td style="display:none"><a href="<?php echo $_SERVER['PHP_SELF']."?bo_table=".$bo_table."&"; ?><?php if ($month == 1) { $year_pre=$year-1; $month_pre=$month; } else {$year_pre=$year-1; $month_pre=$month;} echo ("year=$year_pre&month=$month_pre&sc_no=$sc_no&day=01");?>"><img src="<?php echo $board_skin_url ?>/img/y_prev.gif" border="0" alt="<?php echo $year_pre ?>년"></a></td>

		<td><a href="<?php echo $_SERVER['PHP_SELF']."?bo_table=".$bo_table."&"; ?><?php if ($month == 1) { $year_pre=$year-1; $month_pre=12; } else {$year_pre=$year; $month_pre=$month-1;} echo ("year=$year_pre&month=$month_pre&sc_no=$sc_no&day=01");?>"><img src="<?php echo $board_skin_url ?>/img/m_prev_big.gif" border="0" alt="<?php echo $month_pre ?>월"></a></td>

		<td class="today"><?php echo $year ?>년 <?php echo intval($month) ?>월</td>

		<td><a href="<?php echo $_SERVER['PHP_SELF']."?bo_table=".$bo_table."&"; ?><?php if ($month == 12) { $year_pre=$year+1; $month_pre=1; } else {$year_pre=$year; $month_pre=$month+1;} echo ("year=$year_pre&month=$month_pre&sc_no=$sc_no&day=01");?>"><img src="<?php echo $board_skin_url ?>/img/m_next_big.gif" border="0" alt="<?php echo $month_pre ?>월"></a></td>

		<td style="display:none"><a href="<?php echo $_SERVER['PHP_SELF']."?bo_table=".$bo_table."&"; ?><?php if ($month == 12) { $year_pre=$year+1; $month_pre=$month; } else {$year_pre=$year+1; $month_pre=$month;} echo ("year=$year_pre&month=$month_pre&sc_no=$sc_no&day=01");?>"><img src="<?php echo $board_skin_url ?>/img/y_next.gif" border="0" alt="<?php echo $year_pre ?>년"></a></td>
	</tr>
</table>

<?php // "/lib/ship.lib.php 파일안에 존재하는 함수로 처리했습니다.nextmonth()"?>

<!-- 중복이라 필요없을 듯 div id ="month" >
<?php echo nextmonth('6');?>
</div -->

<a id="schedal"></a>
<div id="month">
	<a href="<?php echo $_SERVER['PHP_SELF']."?bo_table=".$bo_table; ?>" title="오늘로" onfocus="this.blur()"><span>오늘 날짜로 이동</span></a>
</div>


<div id ='daylists' >
<?php echo monthdays($year, $month); ?>
</div>
<div id="today_schedule">
	<!-- 년도와 월, 일을 선택하면 선택된 날짜를 표시해줄 부분이 없는데 이 영역에 오늘이 맞으면 "오늘 출조정보"를 다른 날을 선택했으면 선택한 년도, 월, 일, (요일)이 나오면 좋겠음 -->
	<h3 style="font-weight:bold">
	<?php //if (!$r_date && false)	{?/>		<span>오늘</span>/</?/php 
	//} 	else {
		echo $p_date."(".$yoil[$rd['dow']].")"; 
	//}
	?> 출조정보</h3>
</div>

<script language="JavaScript">
<!--
// 미리보기 팝업 보이기
function PopupShow(n) {
	var position = $("#subject_"+n).position(); 
	$("#popup_"+n).animate({left:position.left-10+"px", top:position.top+30+"px"},0);
	$("#popup_"+n).show();
}

// 미리보기 팝업 숨기기
function PopupHide(n) {
	$("#popup_"+n).hide();
}
//-->
</script>

<script language="JavaScript">
function fhead_submit(f)
{
    if (!f.mb_id.value)
    {
        alert("회원아이디를 입력하십시오.");
        f.mb_id.focus();
        return;
    }    if (document.getElementById('pw2').style.display!='none' && !f.mb_password.value)
    {
        alert("패스워드를 입력하십시오.");
        f.mb_password.focus();
        return;
    }    f.action = "./bbs/login_check.php";
    f.submit();
}
</script>
<script language=javascript> 

function reserv_pop(dat,wid, kind)
{ 
	//window.open("./ship.reserv.php?bo_table=reserv&date="+dat+"&wr_id="+wid+"&kind="+kind,"left=300,top=0,width=700,height=800,scrollbars=yes");
	location.href ="/bbs/board.php?bo_table=reserv&r_date="+dat+"&wr_id="+wid+"&kind="+kind;
}
</script>


<?php // 클릭한 날짜 ?>
<table id="todayship" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<th width="16%">배이름</td>
		<th width="74%">예약현황</td>
		<th width="10%">남은자리</td>
	</tr>
	<?php
	
	//$rowspan = countship();
	
	
	
	$srdate = str_replace("-","",$dates);
	$ssql = "select a.wr_subject, a.wr_2 max from g5_write_ship a ";
	//echo $ssql."<br/>";
	//echo "dates : ".$dates."<BR>";
	$sresult = sql_query($ssql);
	while ($srow = sql_fetch_array($sresult)) {
		$con = getAplyInfo($dates,$srow['wr_subject']);		?>
	<tr>
		<td align="center">
			<p class="shipname"><?php echo $srow['wr_subject'];?></p>
			<?php echo $con['btn']; ?>
		</td>
		<td>
			<table id="todaybooking" cellspacing="0" cellpadding="0" border="0">
				<?php
				if ($con['notice']) {?>
				<tr>
					<td class="img_label"><img src="/skin/board/shipschedule/img/icon_01.gif" alt="공지"></td>
					<td ><span class="notice_box"><?php echo $con['notice']; ?>&nbsp;</span></td>
				</tr>
				<?php
				}
				
				if ($con['reservlist'] ) {?>
				
				<tr>
					<td><img src="/skin/board/shipschedule/img/icon_02.gif" alt="예약"></td>
					<td ><?php echo $con['reservlist']; ?></td>
				</tr>
				<?php
				}
				
				if ($con['waitlist'] ) {?>
				<tr>
					<td><img src="/skin/board/shipschedule/img/icon_04.gif" alt="입금"></td>
					<td ><?php echo $con['waitlist']; ?></td>
				</tr>
				<?php
				}
				
				if ($con['staning'] ) {?>
				<tr>
					<td><img src="/skin/board/shipschedule/img/icon_03.gif" alt="대기"></td>
					<td ><?php echo $con['staning']; ?></td>
				</tr>
				<?php
				}
				
				?>
				
			</table>
			<table id="todaybooking" style="display:none">
				<tr>
					<td><img src="/skin/board/shipschedule/img/icon_01.gif" alt="공지"></td>
					<td><span class="notice_box">sss★ 쭈,갑 출조 ★</span></td>
				</tr>
				<tr>
					<td><img src="/skin/board/shipschedule/img/icon_02.gif" alt="예약"></td>
					<td>박규철님(3) / 곰인가님(3) / 유주현님(2) </td>
				</tr>
				<tr>
					<td><img src="/skin/board/shipschedule/img/icon_04.gif" alt="입금"></td>
					<td>방상근님(2) / 전인석님(3)</td>
				</tr>
				<tr>
					<td><img src="/skin/board/shipschedule/img/icon_03.gif" alt="대기"></td>
					<td>방상근님(2) / 전인석님(3)</td>
				</tr>
			</table>
		</td>
		<td align="center">
			<?php echo $con['btn2']; ?>
		</td>
	</tr>
	<?php 
	}
	?>
</table>
	
<?php // 선택한 월별 ?>
<table id="m_list_all" width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
	<!-- 가로셀 크기 설정 -->
	<colgroup>
		<col width="6%" />
		<col width="10%" />
		<col width="14%" />
		<col width="60%" />
		<col width="10%" />
	</colgroup>
	<!-- 가로셀 크기 설정 -->
	<tr>
		<th>날짜</td>
		<th>물때</td>
		<th>배이름</td>
		<th><span class="now_mon"><?php echo intval($month)?>월</span> 전체 예약현황</td>
		<th>남은자리</td>
	</tr>

	<?php
	
	$rowspan = countship();
	
	$dates = $year."-".$month;
	$result = resultDaysInfo($year."-".$month);	// 물때, 일자 // 월간 
	
	while($row = sql_fetch_array($result)) {?>

	<tr>
		<td rowspan="<?php echo $rowspan?>" align="center" 
			class="<?php if ($row['dow'] == 1)
							{ echo 'sunday';} 
						 else if ($row['dow'] == 7 )
							 { echo 'satday';}?>"	>
		<span style="font-weight:bold">
			<?php echo intval($row['mon'])?>월<br />
			<?php echo intval($row['day'])?>일(<?php echo $yoil[$row['dow']]?>)
			</span>
		</td>
		<td rowspan="<?php echo $rowspan?>" align="center">
			<?php echo $row['mul7']?><br>
		</td>
		
	<?php
	$srdate = str_replace("-","",$row['date']);
	$ssql = "select a.wr_subject, a.wr_2 max from g5_write_ship a ";
	//echo $ssql."<br/>";
	$sresult = sql_query($ssql);
	$trowchk = 0;
	while ($srow = sql_fetch_array($sresult)) {
		
		$con = getAplyInfo($row['date'],$srow['wr_subject']);
		//var_dump($con);
		if($trowchk > 0) { 		?>
	<tr>	<?php
		}
			$trowchk++;
			?>
		<td align="center">
			<p class="shipname"><?php echo $srow['wr_subject'];?></p>
			<?php echo $con['btn']; ?>
		</td>
		<td>
			<table id="todaybooking" cellspacing="0" cellpadding="0" border="0">
				<?php
				if ($con['notice']) {?>
				<tr>
					<td class="img_label"><img src="/skin/board/shipschedule/img/icon_01.gif" alt="공지"></td>
					<td ><span class="notice_box"><?php echo $con['notice']; ?>&nbsp;</span></td>
				</tr>
				<?php
				}
				
				if ($con['reservlist'] ) {?>
				
				<tr>
					<td><img src="/skin/board/shipschedule/img/icon_02.gif" alt="예약"></td>
					<td ><?php echo $con['reservlist']; ?></td>
				</tr>
				<?php
				}
				
				if ($con['waitlist'] ) {?>
				<tr>
					<td><img src="/skin/board/shipschedule/img/icon_04.gif" alt="입금"></td>
					<td ><?php echo $con['waitlist']; ?></td>
				</tr>
				<?php
				}
				
				if ($con['staning'] ) {?>
				<tr>
					<td><img src="/skin/board/shipschedule/img/icon_03.gif" alt="대기"></td>
					<td ><?php echo $con['staning']; ?></td>
				</tr>
				<?php
				}
				
				?>
				
			</table>
		</td>
		<td align="center">
			<?php echo $con['btn2']; ?>
		</td>
	</tr>
<?php 
	}
}?>
</table>
