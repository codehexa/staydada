<?php
include $_SERVER["DOCUMENT_ROOT"] . "/include/dbopen.php";

error_reporting(E_ALL);
ini_set('display_errors', '0');

$tbl = "room_info";


if($srcbranch) $searchand .= " AND bh_idx = $srcbranch ";
if($srcrtype) $searchand .= " AND room_type = '$srcrtype' ";
if($src_option1) $searchand .= " AND room_option_1 = '$src_option1' ";
if($src_option2) $searchand .= " AND room_option_2 = '$src_option2' ";
if($src_option3) $searchand .= " AND room_option_3 = '$src_option3' ";
if($src_option4) $searchand .= " AND room_option_4 = '$src_option4' ";
if($src_option6) $searchand .= " AND room_option_6 = '$src_option6' ";
if($src_option7) $searchand .= " AND room_option_7 = '$src_option7' ";
if($src_option9) $searchand .= " AND room_option_9 = '$src_option9' ";
if($src_option12) $searchand .= " AND room_option_12 = '$src_option12' ";
if($src_option15) $searchand .= " AND room_option_15 = '$src_option15' ";
if($src_option16) $searchand .= " AND room_option_16 = '$src_option16' ";
if($src_option18) $searchand .= " AND room_option_18 = '$src_option18' ";

$cnt = QRY_CNT($tbl, $searchand);
$result = QRY_LIST($tbl, "all", 1, $searchand, " idx DESC");


header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Pragma: public");
print("<meta http-equiv=\"Content-Type\" content=\"application/vnd.ms-excel;charset=UTF-8\">");

$filename = $sitename . "_" . date("Ymd") . "_호실_List";
header("Content-Disposition: attachment; filename=" . $filename . ".xls");
/**********************************************************************************/
?>
<h2><?php echo $sitename." 호실리스트 - ".$today2 ?></h2>
<table width="100%" align="center" border="1" cellpadding="4" cellspacing="0" bordercolorlight="#ccc" bordercolordark="#fff">

	<tr align="right" height="28">
		<td style="font-family:Tahoma; font-size:10pt;" align="center">번호</td>
		<td style="font-family:Tahoma; font-size:10pt;" align="center">지점명</td>
		<td style="font-family:Tahoma; font-size:10pt;" align="center">객실상태</td>
		<td style="font-family:Tahoma; font-size:10pt;" align="center">층</td>
		<td style="font-family:Tahoma; font-size:10pt;" align="center">호실</td>
		<td style="font-family:Tahoma; font-size:10pt;" align="center">룸타입</td>
		<td style="font-family:Tahoma; font-size:10pt;" align="center">공급면적(㎡)</td>
		<td style="font-family:Tahoma; font-size:10pt;" align="center">전용면적(㎡)</td>
		<td style="font-family:Tahoma; font-size:10pt;" align="center">실평수(P)</td>
		<td style="font-family:Tahoma; font-size:10pt;" align="center">향</td>
		<td style="font-family:Tahoma; font-size:10pt;" align="center">최소계약기간</td>
		<td style="font-family:Tahoma; font-size:10pt;" align="center">보일러</td>
		<td style="font-family:Tahoma; font-size:10pt;" align="center">주방</td>
		<td style="font-family:Tahoma; font-size:10pt;" align="center">화장실</td>
		<td style="font-family:Tahoma; font-size:10pt;" align="center">에어컨</td>
		<td style="font-family:Tahoma; font-size:10pt;" align="center">온풍기</td>
		<td style="font-family:Tahoma; font-size:10pt;" align="center">침대</td>
		<td style="font-family:Tahoma; font-size:10pt;" align="center">세탁기</td>
		<td style="font-family:Tahoma; font-size:10pt;" align="center">건조기</td>
		<td style="font-family:Tahoma; font-size:10pt;" align="center">냉장고</td>
		<td style="font-family:Tahoma; font-size:10pt;" align="center">전자레인지</td>
		<td style="font-family:Tahoma; font-size:10pt;" align="center">전기밥솥</td>
		<td style="font-family:Tahoma; font-size:10pt;" align="center">인터넷</td>
		<td style="font-family:Tahoma; font-size:10pt;" align="center">정수기</td>
		<td style="font-family:Tahoma; font-size:10pt;" align="center">도어락</td>
		<td style="font-family:Tahoma; font-size:10pt;" align="center">전세대출</td>
		<td style="font-family:Tahoma; font-size:10pt;" align="center">반려동물</td>
		<td style="font-family:Tahoma; font-size:10pt;" align="center">주차장</td>
		<td style="font-family:Tahoma; font-size:10pt;" align="center">엘리베이터</td>
		<td style="font-family:Tahoma; font-size:10pt;" align="center">보증금</td>
		<td style="font-family:Tahoma; font-size:10pt;" align="center">월임대료</td>
		<td style="font-family:Tahoma; font-size:10pt;" align="center">월관리비</td>
		<td style="font-family:Tahoma; font-size:10pt;" align="center">관리비 포함내역</td>
		<td style="font-family:Tahoma; font-size:10pt;" align="center">관리비 미포함(개별납부)</td>
		<td style="font-family:Tahoma; font-size:10pt;" align="center">등록일</td>
	</tr>
<?php
	$vi = 1;
	while($row = mysqli_fetch_array($result)) {

		$idx		= replace_out($row["idx"]);		//일련번호
		$bh_idx		= replace_out($row["bh_idx"]);	//지점일련번호
		$bh_name	= get_want("branch_info","bh_name","AND idx = $bh_idx");	//지점명
		$room_state	= replace_out($row["room_state"]);	//객실상태(C:수리완료,R:수리중)
		$room_state_txt = get_want("com_code", "code_name", "AND idx = $room_state");
		$room_floor	= replace_out($row["room_floor"]); //층
		$room_number	= replace_out($row["room_number"]);	//호실
		$s_area		= replace_out($row["s_area"]);	//공급면적
		$d_area		= replace_out($row["d_area"]);	//전용면적
		$real_area	= replace_out($row["real_area"]); //기준인원->실평수로변경
		$room_type	= replace_out($row["room_type"]);	//룸타입
		$room_type_txt = get_want("com_code", "code_name", "AND idx = $room_type");
		$way	= replace_out($row["way"]);	//방향
		$way_txt = get_want("com_code", "code_name", "AND idx = $way");
		$contract_period = replace_out($row["contract_period"]);	//최소계약기간 추가 

		for($jj=1;$jj<19;$jj++){
			${"room_option_".$jj} = replace_out($row["room_option_".$jj]);
		}

		$room_option_17_txt	= replace_out($row["room_option_17_txt"]);	//주차장 유료금액
		$deposit	= replace_out($row["deposit"]);		//보증금
		$rental		= replace_out($row["rental"]);		//월임대료
		$room_cost	= replace_out($row["room_cost"]);	//관리비
		$in_desc	= replace_out($row["in_desc"]);		//관리비포함내역
		$not_desc	= replace_out($row["not_desc"]);	//관리비미포함(개별납부)
		$view_yn	= replace_out($row["view_yn"]);		//게시여부 
		$view_yn_txt = ($view_yn=="Y"?"게시":"미게시");
		$reg_date = replace_out($row["reg_date"]);
?>
	<tr >
		<td style="font-family:Tahoma; font-size:10pt; mso-number-format:'@'" align="center"><?php echo $vi?></td>
		<td style="font-family:Tahoma; font-size:10pt; mso-number-format:'@'" align="center"><?php echo $bh_name?></td>
		<td style="font-family:Tahoma; font-size:10pt; mso-number-format:'@'" align="center"><?php echo $room_state_txt?></td>
		<td style="font-family:Tahoma; font-size:10pt; mso-number-format:'@'" align="center"><?php echo $room_floor ?></td>
		<td style="font-family:Tahoma; font-size:10pt; mso-number-format:'@'" align="center"><?php echo $room_number?></td>
		<td style="font-family:Tahoma; font-size:10pt; mso-number-format:'@'" align="center"><?php echo $room_type_txt ?></td>
		<td style="font-family:Tahoma; font-size:10pt; mso-number-format:'@'" align="center"><?php echo $s_area ?></td>
		<td style="font-family:Tahoma; font-size:10pt; mso-number-format:'@'" align="center"><?php echo $d_area ?></td>
		<td style="font-family:Tahoma; font-size:10pt; mso-number-format:'@'" align="center"><?php echo $real_area ?></td>
		<td style="font-family:Tahoma; font-size:10pt; mso-number-format:'@'" align="center"><?php echo $way_txt ?></td>
		<td style="font-family:Tahoma; font-size:10pt; mso-number-format:'@'" align="center"><?php echo $contract_period ?>개월</td>
		<td style="font-family:Tahoma; font-size:10pt; mso-number-format:'@'" align="center">
		<?php if($room_option_1=="I") :  echo "개별";
			elseif($room_option_1=="C") : echo "중앙";
			elseif($room_option_1=="N") : echo "없음";
			endif;
		?>
		</td>
		<td style="font-family:Tahoma; font-size:10pt; mso-number-format:'@'" align="center"><?php echo ($room_option_2=="I")?"개별":"공용" ?></td>
		<td style="font-family:Tahoma; font-size:10pt; mso-number-format:'@'" align="center"><?php echo ($room_option_3=="I")?"개별":"공용" ?></td>
		<td style="font-family:Tahoma; font-size:10pt; mso-number-format:'@'" align="center"><?php echo ($room_option_4=="Y")?"있음":"없음" ?></td>
		<td style="font-family:Tahoma; font-size:10pt; mso-number-format:'@'" align="center"><?php echo ($room_option_5=="Y")?"있음":"없음" ?></td>
		<td style="font-family:Tahoma; font-size:10pt; mso-number-format:'@'" align="center"><?php echo ($room_option_6=="Y")?"있음":"없음" ?></td>
		<td style="font-family:Tahoma; font-size:10pt; mso-number-format:'@'" align="center"><?php echo ($room_option_7=="Y")?"있음":"없음" ?></td>
		<td style="font-family:Tahoma; font-size:10pt; mso-number-format:'@'" align="center"><?php echo ($room_option_8=="Y")?"있음":"없음" ?></td>
		<td style="font-family:Tahoma; font-size:10pt; mso-number-format:'@'" align="center"><?php echo ($room_option_9=="Y")?"있음":"없음" ?></td>
		<td style="font-family:Tahoma; font-size:10pt; mso-number-format:'@'" align="center"><?php echo ($room_option_10=="Y")?"있음":"없음" ?></td>
		<td style="font-family:Tahoma; font-size:10pt; mso-number-format:'@'" align="center"><?php echo ($room_option_11=="Y")?"있음":"없음" ?></td>
		<td style="font-family:Tahoma; font-size:10pt; mso-number-format:'@'" align="center"><?php echo ($room_option_12=="Y")?"있음":"없음" ?></td>
		<td style="font-family:Tahoma; font-size:10pt; mso-number-format:'@'" align="center"><?php echo ($room_option_13=="Y")?"있음":"없음" ?></td>
		<td style="font-family:Tahoma; font-size:10pt; mso-number-format:'@'" align="center"><?php echo ($room_option_14=="Y")?"있음":"없음" ?></td>
		<td style="font-family:Tahoma; font-size:10pt; mso-number-format:'@'" align="center"><?php echo ($room_option_15=="Y")?"가능":"불가능" ?></td>
		<td style="font-family:Tahoma; font-size:10pt; mso-number-format:'@'" align="center"><?php echo ($room_option_16=="Y")?"가능":"불가능" ?></td>
		<td style="font-family:Tahoma; font-size:10pt; mso-number-format:'@'" align="center">
		<?php 
			if($room_option_17=="P") : echo "유료"."-".number_format($room_option_17_txt,0);
			elseif($room_option_17=="F") : echo "무료";
			elseif($room_option_17=="N") : echo "없음";
			endif;
		?>
		</td>
		<td style="font-family:Tahoma; font-size:10pt; mso-number-format:'@'" align="center"><?php echo ($room_option_18=="Y")?"있음":"없음" ?></td>


		<td style="font-family:Tahoma; font-size:10pt; mso-number-format:'@'" align="center"><?php echo number_format($deposit,0) ?></td>
		<td style="font-family:Tahoma; font-size:10pt; mso-number-format:'@'" align="center"><?php echo number_format($rental,0) ?></td>
		<td style="font-family:Tahoma; font-size:10pt; mso-number-format:'@'" align="center"><?php echo number_format($room_cost,0) ?></td>
		<td style="font-family:Tahoma; font-size:10pt; mso-number-format:'@'" align="center"><?php echo $in_desc ?></td>
		<td style="font-family:Tahoma; font-size:10pt; mso-number-format:'@'" align="center"><?php echo $not_desc ?></td>
		<td style="font-family:Tahoma; font-size:10pt; mso-number-format:'@'" align="center"><?php echo $reg_date?></td>

	</tr>
<?php
		$vi++;
	}
?>
</table>