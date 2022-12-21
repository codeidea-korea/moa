<?php

?>
<table width="100%" cellpadding="0" cellspacing="0">
<tr height="20">
<td><b>:: 2017년 9월 19일 < 예약 1단계 입니다.></b></td>
</tr>
</table>

<table width="100%" cellpadding="0" cellspacing="0">
<tr height="10">
<td></td>
</tr>
</table>


<script language="JavaScript">

function form_check(f)
{
	if (!f.pa_uid.value)
	{
		alert('배를 선택해 주십시오.      ');
		return false;
	}
	if (!f.ps_uid.value)
	{
		alert('낚시종류를 선택해 주십시오.      ');
		return false;
	}
	if (!f.bi_name.value)
	{
		alert('예약자 성함을 입력해 주십시오.      ');
		f.bi_name.focus();
		return false;
	}
	if (f.bi_tel2.value.length<3)
	{
		alert('핸드폰번호를 입력해 주십시오.      ');
		f.bi_tel2.focus();
		return false;
	}
	if (f.bi_tel3.value.length<4)
	{
		alert('핸드폰번호를 입력해 주십시오.      ');
		f.bi_tel3.focus();
		return false;
	}
	if (!f.bi_bank.value)
	{
		alert('입금자 성함을 입력해 주십시오.      ');
		f.bi_bank.focus();
		return false;
	}

	if (!f.temp_in.value)
	{
		alert('인원을 선택해 주십시오.      ');
		//f.bi_bank.focus();
		return false;
	}
	if (deagi2=="NO")
	{
				if (doc_check == "Y")
					alert("이미 예약건이있어 독배 등록은 불가능합니다.");
				else
					alert("선택하신 인원은 남은 좌석수보다 많아 등록이 불가능합니다.");
		
		//f.bi_bank.focus();
		return false;
	}



	 if(doc_check == "Y") f.docbea.value="Y";
	 else f.docbea.value="";


	var check_in1 = parseInt(f.temp_check_in.value);
	var check_in2 = parseInt(f.temp_in.value);

	/*
if (check_in1 < check_in2)
	{
		alert('남은자리보다 많은인원을 선택하셨습니다.      ');
		f.temp_in.focus();
		//return false;
	}

 if (doc_check == "Y" && resev_inwon > 0 ){
			if (confirm("이미 예약하 인원이 있어 해당 낚시는 대기자로 등록가능합니다.\n대기자로 등록하시겠습니까?") == false) return false;
			//if (trim(v_in)) $("#j_choice").hide();
		}else{

		if (!confirm('\n예약하신 내용이 정확한지 확인 하시겠습니까?\n'))
			{
				return false;
			}
		}
		*/

	if(!deagi){	
		

			if (!confirm('\n예약하신 내용이 정확한지 확인 하시겠습니까?\n'))
			{
				return false;
			}

	}else{
		if ((total_inwon-resev_inwon) < check_in2 ){
			//deagi="Y"	
			if (confirm("선택하신 인원은 남은 좌석수보다 많아 대기자로 등록가능합니다.\n예약하신 내용이 정확한지 확인 하시겠습니까?\n") == false) return false;
			//if (trim(v_in)) $("#j_choice").hide();
		}else if (doc_check == "Y" && resev_inwon > 0 ){
			if (confirm("이미 예약하 인원이 있어 해당 낚시는 대기자로 등록가능합니다.\n예약하신 내용이 정확한지 확인 하시겠습니까?\n?") == false) return false;
			//if (trim(v_in)) $("#j_choice").hide();
		}

	}






}
</script>


<table width="100%" border="1" bordercolor="gray" style="border-collapse:collapse;">
<colgroup>
<col width="25%" />
<col width="75%" />
</colgroup>

<form name="write_form" method="post" action="/bk.popup.info.php" onsubmit="return form_check(this);">
<input type="hidden" name="action" value="write">
<input type="hidden" name="date" value="20170919">

<input type="hidden" name="pa_uid" value="">

<input type="hidden" name="ps_uid" value="">
<input type="hidden" name="ps_price" value="">
<input type="hidden" name="ps_so_price" value="">
<input type="hidden" name="ps_ye" value="">
<input type="hidden" name="pa_daegi_yn" value="">

<input type="hidden" name="bi_in" value="">
<input type="hidden" name="bi_so_in" value="">
<input type="hidden" name="temp_check_in" value="">
<input type="hidden" name="deagi" value="">
<input type="hidden" name="docbea" value="">


<tr height="30">
    <th align="center" bgcolor="#f4f4f4">*예약일</th>
    <td style="padding-left:10px;">2017년 9월 19일</td>
</tr>
<tr height="30">
    <th align="center" bgcolor="#f4f4f4">*배선택</th>
    <td align="center" style="padding-left:10px;padding-right:10px;padding-top:10px;padding-bottom:10px;">
		<table width="100%" border="1" bordercolor="gray" style="border-collapse:collapse;">
		<tr height="25">
			<td bgcolor="#f4f4f4" align="center"><b>선택</b></td>
			<td bgcolor="#f4f4f4" align="center"><b>배명</b></td>
			<td bgcolor="#f4f4f4" align="center"><b>총인원</b></td>
			<td bgcolor="#f4f4f4" align="center"><b>남은자리</b></td>
		</tr>
	
				<tr height="25">
			<td align="center">
									<!-- <input type="radio" name="p1" id="pa_radio_1" value="1" onclick="pa_table_s(1,' 인원선택 가능합니다.','13','17');"> -->
					<input type="radio" name="p1" id="pa_radio_1" value="1" onclick="location.href='?date=20170919&pa_uid=1';" >
												</td>
			<td align="center">나폴리</td>
			<td align="center">17명</td>
			<td align="center"><font color="blue"><b>13명</b></font></td>
		</tr>
				<tr height="25">
			<td align="center">
									<!-- <input type="radio" name="p1" id="pa_radio_2" value="2" onclick="pa_table_s(2,' 인원선택 가능합니다. 인원선택 가능합니다.','14','17');"> -->
					<input type="radio" name="p1" id="pa_radio_2" value="2" onclick="location.href='?date=20170919&pa_uid=2';" >
												</td>
			<td align="center">뉴나폴리</td>
			<td align="center">17명</td>
			<td align="center"><font color="blue"><b>14명</b></font></td>
		</tr>
				<tr height="25">
			<td align="center">
									<!-- <input type="radio" name="p1" id="pa_radio_3" value="3" onclick="pa_table_s(3,' 인원선택 가능합니다. 인원선택 가능합니다. 인원선택 가능합니다.','11','17');" checked> -->
					<input type="radio" name="p1" id="pa_radio_3" value="3" onclick="location.href='?date=20170919&pa_uid=3';"  checked>
												</td>
			<td align="center">나폴리2</td>
			<td align="center">17명</td>
			<td align="center"><font color="blue"><b>11명</b></font></td>
		</tr>
				<tr height="25">
			<td align="center">
									<!-- <input type="radio" name="p1" id="pa_radio_4" value="4" onclick="pa_table_s(4,' 인원선택 가능합니다. 인원선택 가능합니다. 인원선택 가능합니다. 인원선택 가능합니다.','20','20');"> -->
					<input type="radio" name="p1" id="pa_radio_4" value="4" onclick="location.href='?date=20170919&pa_uid=4';" >
												</td>
			<td align="center">씨앵글러</td>
			<td align="center">20명</td>
			<td align="center"><font color="blue"><b>20명</b></font></td>
		</tr>
				</table>
	</td>
</tr>
<tr height="30">
    <th align="center" bgcolor="#f4f4f4">*낚시종류 선택</th>
	<td style="padding-left:10px;padding-right:10px;padding-top:10px;padding-bottom:10px;">
		<span id="pa_table_notice" style="display:block;"><font color="blue">위 배선택시 출력됩니다</font></span>
				<table width="100%" border="1" bordercolor="gray" style="border-collapse:collapse;"  class="pa_table_all" id="pa_table_1" style="display:none;">
		<tr height="25">
			<td width="50" bgcolor="#f4f4f4" align="center"><b>선택</b></td>
			<td width="150" bgcolor="#f4f4f4" align="center"><b>낚시종류</b></td>
			<td width="100" bgcolor="#f4f4f4" align="center"><b>금액</b></td>
			<td width="100" bgcolor="#f4f4f4" align="center"><b>소인금액</b></td>
			<td width="100" bgcolor="#f4f4f4" align="center"><b>예약금</b></td>
		</tr>
					<tr height="25"  >
			<td width="10%" align="center"><input type="radio" name="p2" value="1" onclick="document.write_form.ps_uid.value='1';document.write_form.pa_daegi_yn.value='';document.write_form.ps_price.value='100000';document.write_form.ps_so_price.value='0';document.write_form.ps_ye.value='100000';inwon_set('0','','');rock_result();">
			</td>
			<td width="30%" align="center">광어.우럭			</td>
			<td width="20%" align="right">100,000원</td>
			<td width="20%" align="right">0원</td>
			<td width="20%" align="right">100,000원</td>
		</tr>
					<tr height="25"  >
			<td width="10%" align="center"><input type="radio" name="p2" value="2" onclick="document.write_form.ps_uid.value='2';document.write_form.pa_daegi_yn.value='';document.write_form.ps_price.value='70000';document.write_form.ps_so_price.value='0';document.write_form.ps_ye.value='70000';inwon_set('0','','');rock_result();">
			</td>
			<td width="30%" align="center">쭈꾸미			</td>
			<td width="20%" align="right">70,000원</td>
			<td width="20%" align="right">0원</td>
			<td width="20%" align="right">70,000원</td>
		</tr>
					<tr height="25"  >
			<td width="10%" align="center"><input type="radio" name="p2" value="24" onclick="document.write_form.ps_uid.value='24';document.write_form.pa_daegi_yn.value='';document.write_form.ps_price.value='50000';document.write_form.ps_so_price.value='0';document.write_form.ps_ye.value='50000';inwon_set('0','','');rock_result();">
			</td>
			<td width="30%" align="center">탐사			</td>
			<td width="20%" align="right">50,000원</td>
			<td width="20%" align="right">0원</td>
			<td width="20%" align="right">50,000원</td>
		</tr>
					</table>
				<table width="100%" border="1" bordercolor="gray" style="border-collapse:collapse;"  class="pa_table_all" id="pa_table_2" style="display:none;">
		<tr height="25">
			<td width="50" bgcolor="#f4f4f4" align="center"><b>선택</b></td>
			<td width="150" bgcolor="#f4f4f4" align="center"><b>낚시종류</b></td>
			<td width="100" bgcolor="#f4f4f4" align="center"><b>금액</b></td>
			<td width="100" bgcolor="#f4f4f4" align="center"><b>소인금액</b></td>
			<td width="100" bgcolor="#f4f4f4" align="center"><b>예약금</b></td>
		</tr>
					<tr height="25"  >
			<td width="10%" align="center"><input type="radio" name="p2" value="3" onclick="document.write_form.ps_uid.value='3';document.write_form.pa_daegi_yn.value='';document.write_form.ps_price.value='100000';document.write_form.ps_so_price.value='0';document.write_form.ps_ye.value='100000';inwon_set('0','','');rock_result();">
			</td>
			<td width="30%" align="center">광어.우럭			</td>
			<td width="20%" align="right">100,000원</td>
			<td width="20%" align="right">0원</td>
			<td width="20%" align="right">100,000원</td>
		</tr>
					<tr height="25"  >
			<td width="10%" align="center"><input type="radio" name="p2" value="21" onclick="document.write_form.ps_uid.value='21';document.write_form.pa_daegi_yn.value='';document.write_form.ps_price.value='140000';document.write_form.ps_so_price.value='0';document.write_form.ps_ye.value='140000';inwon_set('0','','');rock_result();">
			</td>
			<td width="30%" align="center">농어,부시리			</td>
			<td width="20%" align="right">140,000원</td>
			<td width="20%" align="right">0원</td>
			<td width="20%" align="right">140,000원</td>
		</tr>
					<tr height="25"  >
			<td width="10%" align="center"><input type="radio" name="p2" value="5" onclick="document.write_form.ps_uid.value='5';document.write_form.pa_daegi_yn.value='';document.write_form.ps_price.value='70000';document.write_form.ps_so_price.value='0';document.write_form.ps_ye.value='70000';inwon_set('0','','');rock_result();">
			</td>
			<td width="30%" align="center">쭈꾸미			</td>
			<td width="20%" align="right">70,000원</td>
			<td width="20%" align="right">0원</td>
			<td width="20%" align="right">70,000원</td>
		</tr>
					<tr height="25"  >
			<td width="10%" align="center"><input type="radio" name="p2" value="22" onclick="document.write_form.ps_uid.value='22';document.write_form.pa_daegi_yn.value='';document.write_form.ps_price.value='50000';document.write_form.ps_so_price.value='0';document.write_form.ps_ye.value='50000';inwon_set('0','','');rock_result();">
			</td>
			<td width="30%" align="center">탐사			</td>
			<td width="20%" align="right">50,000원</td>
			<td width="20%" align="right">0원</td>
			<td width="20%" align="right">50,000원</td>
		</tr>
					</table>
				<table width="100%" border="1" bordercolor="gray" style="border-collapse:collapse;"  class="pa_table_all" id="pa_table_3" style="display:none;">
		<tr height="25">
			<td width="50" bgcolor="#f4f4f4" align="center"><b>선택</b></td>
			<td width="150" bgcolor="#f4f4f4" align="center"><b>낚시종류</b></td>
			<td width="100" bgcolor="#f4f4f4" align="center"><b>금액</b></td>
			<td width="100" bgcolor="#f4f4f4" align="center"><b>소인금액</b></td>
			<td width="100" bgcolor="#f4f4f4" align="center"><b>예약금</b></td>
		</tr>
					<tr height="25"  >
			<td width="10%" align="center"><input type="radio" name="p2" value="6" onclick="document.write_form.ps_uid.value='6';document.write_form.pa_daegi_yn.value='';document.write_form.ps_price.value='100000';document.write_form.ps_so_price.value='0';document.write_form.ps_ye.value='100000';inwon_set('0','','');rock_result();">
			</td>
			<td width="30%" align="center">참돔			</td>
			<td width="20%" align="right">100,000원</td>
			<td width="20%" align="right">0원</td>
			<td width="20%" align="right">100,000원</td>
		</tr>
					<tr height="25"  >
			<td width="10%" align="center"><input type="radio" name="p2" value="7" onclick="document.write_form.ps_uid.value='7';document.write_form.pa_daegi_yn.value='';document.write_form.ps_price.value='70000';document.write_form.ps_so_price.value='0';document.write_form.ps_ye.value='70000';inwon_set('0','','');rock_result();">
			</td>
			<td width="30%" align="center">쭈꾸미			</td>
			<td width="20%" align="right">70,000원</td>
			<td width="20%" align="right">0원</td>
			<td width="20%" align="right">70,000원</td>
		</tr>
					<tr height="25"  >
			<td width="10%" align="center"><input type="radio" name="p2" value="8" onclick="document.write_form.ps_uid.value='8';document.write_form.pa_daegi_yn.value='';document.write_form.ps_price.value='80000';document.write_form.ps_so_price.value='0';document.write_form.ps_ye.value='80000';inwon_set('0','','');rock_result();">
			</td>
			<td width="30%" align="center">갑오징어			</td>
			<td width="20%" align="right">80,000원</td>
			<td width="20%" align="right">0원</td>
			<td width="20%" align="right">80,000원</td>
		</tr>
					<tr height="25"  >
			<td width="10%" align="center"><input type="radio" name="p2" value="23" onclick="document.write_form.ps_uid.value='23';document.write_form.pa_daegi_yn.value='';document.write_form.ps_price.value='100000';document.write_form.ps_so_price.value='0';document.write_form.ps_ye.value='100000';inwon_set('0','','');rock_result();">
			</td>
			<td width="30%" align="center">광어다운샷			</td>
			<td width="20%" align="right">100,000원</td>
			<td width="20%" align="right">0원</td>
			<td width="20%" align="right">100,000원</td>
		</tr>
					<tr height="25"  >
			<td width="10%" align="center"><input type="radio" name="p2" value="25" onclick="document.write_form.ps_uid.value='25';document.write_form.pa_daegi_yn.value='';document.write_form.ps_price.value='50000';document.write_form.ps_so_price.value='0';document.write_form.ps_ye.value='50000';inwon_set('0','','');rock_result();">
			</td>
			<td width="30%" align="center">탐사			</td>
			<td width="20%" align="right">50,000원</td>
			<td width="20%" align="right">0원</td>
			<td width="20%" align="right">50,000원</td>
		</tr>
					</table>
				<table width="100%" border="1" bordercolor="gray" style="border-collapse:collapse;"  class="pa_table_all" id="pa_table_4" style="display:none;">
		<tr height="25">
			<td width="50" bgcolor="#f4f4f4" align="center"><b>선택</b></td>
			<td width="150" bgcolor="#f4f4f4" align="center"><b>낚시종류</b></td>
			<td width="100" bgcolor="#f4f4f4" align="center"><b>금액</b></td>
			<td width="100" bgcolor="#f4f4f4" align="center"><b>소인금액</b></td>
			<td width="100" bgcolor="#f4f4f4" align="center"><b>예약금</b></td>
		</tr>
					<tr height="25"  >
			<td width="10%" align="center"><input type="radio" name="p2" value="13" onclick="document.write_form.ps_uid.value='13';document.write_form.pa_daegi_yn.value='';document.write_form.ps_price.value='100000';document.write_form.ps_so_price.value='0';document.write_form.ps_ye.value='100000';inwon_set('0','','');rock_result();">
			</td>
			<td width="30%" align="center">광어.우럭			</td>
			<td width="20%" align="right">100,000원</td>
			<td width="20%" align="right">0원</td>
			<td width="20%" align="right">100,000원</td>
		</tr>
					<tr height="25"  >
			<td width="10%" align="center"><input type="radio" name="p2" value="14" onclick="document.write_form.ps_uid.value='14';document.write_form.pa_daegi_yn.value='';document.write_form.ps_price.value='70000';document.write_form.ps_so_price.value='0';document.write_form.ps_ye.value='70000';inwon_set('0','','');rock_result();">
			</td>
			<td width="30%" align="center">쭈꾸미.갑오징어			</td>
			<td width="20%" align="right">70,000원</td>
			<td width="20%" align="right">0원</td>
			<td width="20%" align="right">70,000원</td>
		</tr>
					<tr height="25"  >
			<td width="10%" align="center"><input type="radio" name="p2" value="16" onclick="document.write_form.ps_uid.value='16';document.write_form.pa_daegi_yn.value='';document.write_form.ps_price.value='100000';document.write_form.ps_so_price.value='0';document.write_form.ps_ye.value='100000';inwon_set('0','','');rock_result();">
			</td>
			<td width="30%" align="center">참돔			</td>
			<td width="20%" align="right">100,000원</td>
			<td width="20%" align="right">0원</td>
			<td width="20%" align="right">100,000원</td>
		</tr>
					</table>
			</td>
</tr>
<tr height="30">
    <th align="center" bgcolor="#f4f4f4">*인원선택</th>
    <td style="padding:10px;">
	<!-- *.남은 좌석보다 많은 인원을 선택시 대기자로 등록됩니다. <br> --><span id="temp_in2"></span><span id="temp_in3"></span><br>
		일반 : <select name="temp_in" id="temp_in" onchange="document.write_form.bi_in.value=this.value;inwon_reset();rock_result();">
				<option value="1">1명</option>
				<option value="2">2명</option>
				<option value="3">3명</option>
				<option value="4">4명</option>
				<option value="5">5명</option>
				<option value="6">6명</option>
				<option value="7">7명</option>
				<option value="8">8명</option>
				<option value="9">9명</option>
				<option value="10">10명</option>
				<option value="11">11명</option>
				<option value="12">12명</option>
				<option value="13">13명</option>
				<option value="14">14명</option>
				<option value="15">15명</option>
				<option value="16">16명</option>
				<option value="17">17명</option>
				<option value="18">18명</option>
				<option value="19">19명</option>
				<option value="20">20명</option>
				<option value="21">21명</option>
				<option value="22">22명</option>
				<option value="23">23명</option>
				<option value="24">24명</option>
				<option value="25">25명</option>
				<option value="26">26명</option>
				<option value="27">27명</option>
				<option value="28">28명</option>
				<option value="29">29명</option>
				<option value="30">30명</option>
				<option value="31">31명</option>
				<option value="32">32명</option>
				<option value="33">33명</option>
				<option value="34">34명</option>
				<option value="35">35명</option>
				<option value="36">36명</option>
				<option value="37">37명</option>
				<option value="38">38명</option>
				<option value="39">39명</option>
				<option value="40">40명</option>
				<option value="41">41명</option>
				<option value="42">42명</option>
				<option value="43">43명</option>
				<option value="44">44명</option>
				<option value="45">45명</option>
				<option value="46">46명</option>
				<option value="47">47명</option>
				<option value="48">48명</option>
				<option value="49">49명</option>
				<option value="50">50명</option>
				<option value="51">51명</option>
				<option value="52">52명</option>
				<option value="53">53명</option>
				<option value="54">54명</option>
				<option value="55">55명</option>
				<option value="56">56명</option>
				<option value="57">57명</option>
				<option value="58">58명</option>
				<option value="59">59명</option>
				<option value="60">60명</option>
				<option value="61">61명</option>
				<option value="62">62명</option>
				<option value="63">63명</option>
				<option value="64">64명</option>
				<option value="65">65명</option>
				<option value="66">66명</option>
				<option value="67">67명</option>
				<option value="68">68명</option>
				<option value="69">69명</option>
				<option value="70">70명</option>
				<option value="71">71명</option>
				<option value="72">72명</option>
				<option value="73">73명</option>
				<option value="74">74명</option>
				<option value="75">75명</option>
				<option value="76">76명</option>
				<option value="77">77명</option>
				<option value="78">78명</option>
				<option value="79">79명</option>
				<option value="80">80명</option>
				<option value="81">81명</option>
				<option value="82">82명</option>
				<option value="83">83명</option>
				<option value="84">84명</option>
				<option value="85">85명</option>
				<option value="86">86명</option>
				<option value="87">87명</option>
				<option value="88">88명</option>
				<option value="89">89명</option>
				<option value="90">90명</option>
				<option value="91">91명</option>
				<option value="92">92명</option>
				<option value="93">93명</option>
				<option value="94">94명</option>
				<option value="95">95명</option>
				<option value="96">96명</option>
				<option value="97">97명</option>
				<option value="98">98명</option>
				<option value="99">99명</option>
				</select>

		<!--소인 : <select name="temp_so_in" id="temp_so_in" onchange="document.write_form.bi_so_in.value=this.value;inwon_reset();rock_result();">
				<option value="1">1명</option>
				<option value="2">2명</option>
				<option value="3">3명</option>
				<option value="4">4명</option>
				<option value="5">5명</option>
				<option value="6">6명</option>
				<option value="7">7명</option>
				<option value="8">8명</option>
				<option value="9">9명</option>
				<option value="10">10명</option>
				<option value="11">11명</option>
				<option value="12">12명</option>
				<option value="13">13명</option>
				<option value="14">14명</option>
				<option value="15">15명</option>
				<option value="16">16명</option>
				<option value="17">17명</option>
				<option value="18">18명</option>
				<option value="19">19명</option>
				<option value="20">20명</option>
				<option value="21">21명</option>
				<option value="22">22명</option>
				<option value="23">23명</option>
				<option value="24">24명</option>
				<option value="25">25명</option>
				<option value="26">26명</option>
				<option value="27">27명</option>
				<option value="28">28명</option>
				<option value="29">29명</option>
				<option value="30">30명</option>
				<option value="31">31명</option>
				<option value="32">32명</option>
				<option value="33">33명</option>
				<option value="34">34명</option>
				<option value="35">35명</option>
				<option value="36">36명</option>
				<option value="37">37명</option>
				<option value="38">38명</option>
				<option value="39">39명</option>
				<option value="40">40명</option>
				<option value="41">41명</option>
				<option value="42">42명</option>
				<option value="43">43명</option>
				<option value="44">44명</option>
				<option value="45">45명</option>
				<option value="46">46명</option>
				<option value="47">47명</option>
				<option value="48">48명</option>
				<option value="49">49명</option>
				<option value="50">50명</option>
				<option value="51">51명</option>
				<option value="52">52명</option>
				<option value="53">53명</option>
				<option value="54">54명</option>
				<option value="55">55명</option>
				<option value="56">56명</option>
				<option value="57">57명</option>
				<option value="58">58명</option>
				<option value="59">59명</option>
				<option value="60">60명</option>
				<option value="61">61명</option>
				<option value="62">62명</option>
				<option value="63">63명</option>
				<option value="64">64명</option>
				<option value="65">65명</option>
				<option value="66">66명</option>
				<option value="67">67명</option>
				<option value="68">68명</option>
				<option value="69">69명</option>
				<option value="70">70명</option>
				<option value="71">71명</option>
				<option value="72">72명</option>
				<option value="73">73명</option>
				<option value="74">74명</option>
				<option value="75">75명</option>
				<option value="76">76명</option>
				<option value="77">77명</option>
				<option value="78">78명</option>
				<option value="79">79명</option>
				<option value="80">80명</option>
				<option value="81">81명</option>
				<option value="82">82명</option>
				<option value="83">83명</option>
				<option value="84">84명</option>
				<option value="85">85명</option>
				<option value="86">86명</option>
				<option value="87">87명</option>
				<option value="88">88명</option>
				<option value="89">89명</option>
				<option value="90">90명</option>
				<option value="91">91명</option>
				<option value="92">92명</option>
				<option value="93">93명</option>
				<option value="94">94명</option>
				<option value="95">95명</option>
				<option value="96">96명</option>
				<option value="97">97명</option>
				<option value="98">98명</option>
				<option value="99">99명</option>
				</select-->


		<!-- <span id="temp_in2"></span>  -->

	</td>
</tr>
<tr height="30">
    <th align="center" bgcolor="#f4f4f4">*예약금액</th>
    <td style="padding-left:10px;">
		<span id="temp_ye"></span> 
	</td>
</tr>
<tr height="30">
    <th align="center" bgcolor="#f4f4f4">*총금액</th>
    <td style="padding-left:10px;">
		<span id="temp_to"></span> 
	</td>
</tr>
<tr height="30">
    <th align="center" bgcolor="#f4f4f4">입금 안내 공지</th>
    <td style="padding-left:10px;">
			</td>
</tr>
<tr height="30">
    <th align="center" bgcolor="#f4f4f4">*예약자 성함</th>
    <td style="padding-left:10px;">

    <input type="text" name="bi_name" size="20" style="ime-mode:active;" onkeyup="han(this)"></td>
</tr>
<tr height="30">
    <th align="center" bgcolor="#f4f4f4">*핸드폰 번호</th>
    <td style="padding-left:10px;">
		<select name="bi_tel1">
		<option value="010">010</option>
		<option value="011">011</option>
		<option value="016">016</option>
		<option value="017">017</option>
		<option value="018">018</option>
		<option value="019">019</option>
		</select>
		-
		<input type="number" name="bi_tel2" size="4" id="bi_tel2" maxlength="4" oninput="maxLengthCheck(this)" onkeyup="this.value=this.value.replace(/\D/,'')" value="" >
		-
		<input type="number" name="bi_tel3" size="4" id="bi_tel3" maxlength="4" oninput="maxLengthCheck(this)" onkeyup="this.value=this.value.replace(/\D/,'')" value=""  >
	</td>
</tr>
<tr height="30">
    <th align="center" bgcolor="#f4f4f4">*입금자 성함</th>
    <td style="padding-left:10px;"><input type="text" name="bi_bank" size="20" style="ime-mode:active;" onkeyup="han(this)"></td>
</tr>
<tr height="30">
    <th align="center" bgcolor="#f4f4f4">요청사항</th>
    <td style="padding-left:10px;"><textarea name="bi_memo" rows="20" cols="58" style="width:97%;height:100px;padding:5px;overflow:visible;"></textarea></td>
</tr>
</table>

<br>

<table width="100%" cellpadding="0" cellspacing="0">
<tr>
    <td align="center">
        <input type="submit" style="cursor:pointer;" value=" 예약 내용 확인 ">
    </td>
</tr>
</form>
</table>

<style>
.red {
       background-color: red;

    }

</style>
<script type="text/javascript"> 
//<![CDATA[

var sel_inwon=0; //기본 인원
var doc_check=""; //독배여부 독배는 인원별 금액 없음
var my_inwon=0;
var seat_open="Y" ;  //좌석 선택 여부
	var in_limit="N";
	var total_inwon=17; //예약최대인원

var resev_inwon=6; //현재 예약된 인원
var deagi="";
var deagi2="";
$(document).ready(function(){


	$(".seat").each(function() {
		mmnum=$(this).attr("value");
		


	});

  // document.getElementById("temp_in2").innerHTML = '<font color="blue"><b>최대 '+total_inwon+'명 선택가능합니다.</b></font>';
 //document.getElementById("temp_in3").innerHTML = '<font color="red"><b>(남은좌석은 '+(total_inwon-resev_inwon)+'명) </b></font>';


		$(".seat").click(function() {
			//alert(my_inwon);
			var check_inwon=0;
			var nono="";
			$(".seat").each(function() {
				if($(this).is(':checked'))
					check_inwon++;

				if (check_inwon > my_inwon) {
					nono="Y";
					//break;
				}
				   //$(this).attr("checked", true);
				//else
				//	$(this).attr("checked", false);				

			});

			if (nono=="Y"){
				alert(my_inwon +"명까지 선택 가능합니다.");
				$(this).attr("checked", false);	
			}

		});



/*
for(i=0;i<100;i++){

		$("#temp_in option:last").remove();
	}
alert('11명')
for(i=0;i<100;i++){

		$("#temp_in option:last").remove();
	}
	*/

});

//alert($("#temp_in option").size());



function commaSplit(srcNumber) 
{ 
	var txtNumber = '' + srcNumber; 

	var rxSplit = new RegExp('([0-9])([0-9][0-9][0-9][,.])'); 
	var arrNumber = txtNumber.split('.'); 
	arrNumber[0] += '.'; 
	do { 
		arrNumber[0] = arrNumber[0].replace(rxSplit, '$1,$2'); 
	} 
	while (rxSplit.test(arrNumber[0])); 
	if (arrNumber.length > 1) { 
		return arrNumber.join(''); 
	} 
	else { 
		return arrNumber[0].split('.')[0]; 
	} 
}

function pa_table_s(n,inwon_mesage,inwon_input,inwon)
{



	$(".pa_table_all").hide();
document.getElementById('pa_table_'+n).style.display = 'block';

	for (var j = 1; j <= 4; j++)
	{
		if(document.getElementById('pa_radio_'+j))
		{
			if(j == n)
			{
				document.getElementById('pa_table_'+j).style.display = 'block';
				document.getElementById('pa_table_notice').style.display = 'none';
				document.write_form.pa_uid.value = n;
			}
			else
			{
				document.getElementById('pa_table_'+j).style.display = 'none';
			}
		}
	}




	document.write_form.ps_uid.value = '';
	document.write_form.ps_price.value = '';
	document.write_form.ps_ye.value = '';
	document.getElementById("temp_ye").innerHTML = '<font color="blue">배와 낚시종류 선택시 자동 계산 됩니다</font>';
	document.getElementById("temp_to").innerHTML = '<font color="blue">배와 낚시종류 선택시 자동 계산 됩니다</font>';

	sel_inwon=inwon;
	for(i=0;i<100;i++){

		$("#temp_in option:last").remove();
		$("#temp_so_in option:last").remove();
	}

document.write_form.bi_in.value = '';
document.write_form.bi_so_in.value = '';

	if (document.write_form.pa_daegi_yn.value=="N"){
		i_inwon=(total_inwon-resev_inwon);
		document.getElementById("temp_in2").innerHTML = '';
		document.getElementById("temp_in3").innerHTML = '<font color="red"><b>남은좌석은 '+(total_inwon-resev_inwon)+'명 입니다.</b></font>';
	}
	else
	{
		i_inwon=inwon;
		document.getElementById("temp_in2").innerHTML = '<font color="blue"><b>최대 '+total_inwon+'명 선택가능합니다.</b></font>';
		 document.getElementById("temp_in3").innerHTML = '*.남은 좌석보다 많은 인원을 선택시 대기자로 등록됩니다. <br><font color="red"><b>(남은좌석은 '+(total_inwon-resev_inwon)+'명) </b></font>';
	}

	$("#temp_in").append("<option value=''>인원선택</option>");
   for(i=1;i<=i_inwon;i++){
		$("#temp_in").append("<option value='"+i+"'>"+i+"명</option>");

   }

$("#temp_so_in").append("<option value=''>인원선택</option>");
   for(i=1;i<=i_inwon;i++){
		$("#temp_so_in").append("<option value='"+i+"'>"+i+"명</option>");

   }



   //document.getElementById("temp_in2").innerHTML = '<font color="blue"><b>최대 '+inwon+'명 선택가능합니다.</b></font>';
	inwon_reset();
}


function inwon_set(check_inwon,doc,ps_seat_use){

	seat_open="Y";
	if (check_inwon==0) inwon=sel_inwon;
	else inwon=check_inwon;

	total_inwon=inwon;


	for(i=0;i<100;i++){

		$("#temp_in option:last").remove();
		$("#temp_so_in option:last").remove();
	}
	document.write_form.bi_in.value = '';
	document.write_form.bi_so_in.value = '';


	if (document.write_form.pa_daegi_yn.value=="N"){
		i_inwon=(total_inwon-resev_inwon);
		document.getElementById("temp_in2").innerHTML = '';
		document.getElementById("temp_in3").innerHTML = '<font color="red"><b>남은좌석은 '+(total_inwon-resev_inwon)+'명 입니다.</b></font>';
	}
	else
	{
		i_inwon=inwon;
		document.getElementById("temp_in2").innerHTML = '<font color="blue"><b>최대 '+total_inwon+'명 선택가능합니다.</b></font>';
		 document.getElementById("temp_in3").innerHTML = '*.남은 좌석보다 많은 인원을 선택시 대기자로 등록됩니다. <br><font color="red"><b>(남은좌석은 '+(total_inwon-resev_inwon)+'명) </b></font>';
	}
//alert(document.write_form.ps_daegi_yn.value);
	$("#temp_in").append("<option value=''>인원선택</option>");
   for(i=1;i<=i_inwon;i++){
		$("#temp_in").append("<option value='"+i+"'>"+i+"명</option>");

   }

$("#temp_so_in").append("<option value=''>인원선택</option>");
   for(i=1;i<=i_inwon;i++){
		$("#temp_so_in").append("<option value='"+i+"'>"+i+"명</option>");

   }

	//document.getElementById("temp_in2").innerHTML = '<font color="blue"><b>최대 '+inwon+'명 선택가능합니다.</b></font>';

	if (doc){
		doc_check="Y";
		$("#temp_in3").hide();
	}else if (!ps_seat_use){
		seat_open="N";
		$("#j_choice").hide();
		$("#temp_in3").show();
		$("#temp_in2").show();
	}else if (check_inwon>0){
		in_limit="Y";
		//doc_check="Y";
		//$("#temp_in3").hide();
	}else{
		in_limit="N";
		doc_check="";
		$("#temp_in3").show();
		$("#temp_in2").show();
	}
	inwon_reset();
	rock_result();

}


function inwon_reset(){
	$(".seat").each(function() {
			$(this).attr("checked", false);				

	});


}

function rock_result()
{
	if (document.write_form.ps_so_price=="") document.write_form.ps_so_price=0;
	
		var v_pc = document.write_form.ps_price;
		var v_so_pc = document.write_form.ps_so_price;
		var v_ye = document.write_form.ps_ye;

		if (doc_check == "Y"){
				var v_in = 1;
				var v_so_in=0;
				document.write_form.bi_in=1;
				//$("#j_choice").hide();
		}else{
			var v_in = document.write_form.bi_in.value;
			var v_so_in = document.write_form.bi_so_in.value;

			//if (trim(v_in)) $("#j_choice").show();
			//else $("#j_choice").hide();

			my_inwon=v_in;
			my_so_inwon=v_so_in;

		}

	
			


		if(v_pc.value>0 && v_ye.value>=0 && v_in>0)
		{
			document.getElementById("temp_ye").innerHTML = commaSplit(parseInt(v_ye.value * v_in)) +'원';
			document.getElementById("temp_to").innerHTML = commaSplit(parseInt(v_pc.value * v_in)+parseInt(v_so_pc.value * v_so_in)) +'원';

			if (doc_check == "Y" || in_limit=="Y" || seat_open=="N"){
					$("#j_choice").hide();
			}else{
				if (trim(v_in)) $("#j_choice").show();
			}


		}else{
				if (trim(v_in)) $("#j_choice").hide();
		}

		deagi2="";

		//alert(document.write_form.pa_daegi_yn.value);

		if ( ( (total_inwon-resev_inwon) < parseInt(v_in) + parseInt(v_so_in/2) )  || (doc_check == "Y" && resev_inwon > 0 ) ){

			if (document.write_form.pa_daegi_yn.value=="N"){
				deagi2="NO";

				if (doc_check == "Y")
					alert("이미 예약건이있어 독배 등록은 불가능합니다.");
				else
					alert("선택하신 인원은 남은 좌석수보다 많아 등록이 불가능합니다.");
			}

			deagi="Y"	
			document.write_form.deagi.value="Y";
			//alert("선택하신 인원은 남은 좌석수보다 많아 대기자로 예약가능합니다.");
			if (trim(v_in)) $("#j_choice").hide();
		}else{
			deagi=""	
			document.write_form.deagi.value="";
		}

		//if (doc_check == "Y" && resev_inwon > 0 ){
			//deagi="Y"	
			//alert("이미 예약하신 인원이 있어 대기자로 예약가능합니다.");
			//if (trim(v_in)) $("#j_choice").hide();
		//}

	

}

window.onload = function()
{ 
	pa_table_s(3,'11명 인원선택 가능합니다.','11',total_inwon);
} 
//]]>
//maxlength 체크
  function maxLengthCheck(object){
   if (object.value.length > object.maxLength){
    object.value = object.value.slice(0, object.maxLength);
   }    
  }
</script>


<?php
include_once(G5_PATH.'/tail.sub.php');
?>
