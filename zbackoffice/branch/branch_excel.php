<?php
include $_SERVER["DOCUMENT_ROOT"] . "/include/dbopen.php";

error_reporting(E_ALL);
ini_set('display_errors', '0');

$tbl = "branch_info";

if ($strsearch) $searchand .= " AND $search LIKE '%$strsearch%'";

$cnt = QRY_CNT($tbl, $searchand);
$result = QRY_LIST($tbl, "all", 1, $searchand, " idx DESC");


header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Pragma: public");
print("<meta http-equiv=\"Content-Type\" content=\"application/vnd.ms-excel;charset=UTF-8\">");

$filename = $sitename . "_" . date("Ymd") . "_지점_List";
header("Content-Disposition: attachment; filename=" . $filename . ".xls");
/**********************************************************************************/
?>
<h2><?php echo $sitename." 지점리스트 - ".$today2 ?></h2>
<table width="100%" align="center" border="1" cellpadding="4" cellspacing="0" bordercolorlight="#ccc" bordercolordark="#fff">

	<tr align="right" height="28">
		<td style="font-family:Tahoma; font-size:10pt;" align="center">번호</td>
		<td style="font-family:Tahoma; font-size:10pt;" align="center">지점명</td>
		<td style="font-family:Tahoma; font-size:10pt;" align="center">지점주소</td>
		<td style="font-family:Tahoma; font-size:10pt;" align="center">주택유형</td>
		<td style="font-family:Tahoma; font-size:10pt;" align="center">층</td>
		<td style="font-family:Tahoma; font-size:10pt;" align="center">세대정보</td>
		<td style="font-family:Tahoma; font-size:10pt;" align="center">연면적</td>
		<td style="font-family:Tahoma; font-size:10pt;" align="center">관리비</td>
		<td style="font-family:Tahoma; font-size:10pt;" align="center">주차</td>
		<td style="font-family:Tahoma; font-size:10pt;" align="center">등록일</td>
	</tr>
<?php
	$vi = 1;
	while($row = mysqli_fetch_array($result)) {
		$bh_name	= replace_out($row["bh_name"]);	//지점명
		$hous_type	= replace_out($row["hous_type"]);	//주택유형
		$hous_type_txt = get_want("com_code", "code_name", "AND idx = $hous_type");
		$bh_post	= replace_out($row["bh_post"]); //우편번호
		$bh_addr1	= replace_out($row["bh_addr1"]);	//주소
		$bh_addr2	= replace_out($row["bh_addr2"]);	//상세주소
		$lat		= replace_out($row["lat"]);	//위도
		$lon		= replace_out($row["lon"]);	//경도
		$bh_floor	= replace_out($row["bh_floor"]); //층
		$bh_ginfo	= replace_out($row["bh_ginfo"]);	//세대정보
		$bh_total_area	= replace_out($row["bh_total_area"]);	//연면적
		$parking_yn	= replace_out($row["parking_yn"]);	//주차가능여부
		$parking_yn_txt = ($parking_yn=="Y"?"가능":"불가능");
		$main_cost	= replace_out($row["main_cost"]);	//관리비
		$view_yn	= replace_out($row["view_yn"]);
		$view_yn_txt = ($view_yn=="Y"?"게시":"미게시");
		$reg_date = replace_out($row["reg_date"]);
?>
	<tr >
		<td style="font-family:Tahoma; font-size:10pt; mso-number-format:'@'" align="center"><?php echo $vi?></td>
		<td style="font-family:Tahoma; font-size:10pt; mso-number-format:'@'" align="center"><?php echo $bh_name?></td>
		<td style="font-family:Tahoma; font-size:10pt; mso-number-format:'@'" align="center"><?php echo $bh_addr1."<br/>".$bh_addr2?></td>
		<td style="font-family:Tahoma; font-size:10pt; mso-number-format:'@'" align="center"><?php echo $hous_type_txt ?></td>
		<td style="font-family:Tahoma; font-size:10pt; mso-number-format:'@'" align="center"><?php echo $bh_floor?></td>
		<td style="font-family:Tahoma; font-size:10pt; mso-number-format:'@'" align="center"><?php echo $bh_ginfo ?></td>
		<td style="font-family:Tahoma; font-size:10pt; mso-number-format:'@'" align="center"><?php echo $bh_total_area ?></td>
		<td style="font-family:Tahoma; font-size:10pt; mso-number-format:'@'" align="center"><?php echo $main_cost ?></td>
		<td style="font-family:Tahoma; font-size:10pt; mso-number-format:'@'" align="center"><?php echo $parking_yn_txt ?></td>
		<td style="font-family:Tahoma; font-size:10pt; mso-number-format:'@'" align="center"><?php echo $reg_date?></td>

	</tr>
<?php
		$vi++;
	}
?>
</table>