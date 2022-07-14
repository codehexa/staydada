<?php
include $_SERVER["DOCUMENT_ROOT"] . "/zbackoffice/include/head.php";

/*************************************************/
// 지점관리 - 지점리스트 
/*************************************************/
$tbl = "branch_info";
$recordcnt = 20;

$ordbystr = " idx DESC ";

//기간
if($startdate && $enddate) $searchand .= " AND LEFT(reg_date, 10) BETWEEN '$startdate' AND '$enddate'";

if ($strsearch) $searchand .= " AND $search LIKE '%$strsearch%'";

$cnt = QRY_CNT($tbl, $searchand);
$totalpage = QRY_TOTALPAGE($cnt, $recordcnt);
$result = QRY_LIST($tbl, $recordcnt, $page, $searchand, " idx DESC");


$param2 = "&search=$search&strsearch=$strsearch"

/*************************************************************************************/
?>
<style type="text/css">
	.th { width:10%; }
	.td { width:40%; text-align:left !important; }
</style>

<div id="contents">
	<div class="tit"><?php echo $title_text?>
		<div class="path"><img src="../img/icon-home.png">HOME<img src="../img/arr.png"><?php echo $menu_text2?><img src="../img/arr.png"><?php echo $title_text?></div>
	</div>
	<div class="content">
		<div class="main-box">
			<div class="search-box">
				<form name="searchfrm" method="post" action="?mode=<?php echo $mode?>">
					<input type="hidden" name="mode" value="<?php echo $mode?>">

					<table class="list">
					 <tr>
						<td class="txt-left">
							<select name="search" id="search" style="width:120px;">
								<option value="bh_name"<? if($search == "bh_name") echo " selected"; ?>>지점명</option>
								<option value="bh_addr1"<? if($search == "bh_addr1") echo " selected"; ?>>위치</option>
							</select>
							<input type="text" name="strsearch" style="width:270px;" value="<?php echo $strsearch?>" onKeyPress="if(event.keyCode==13) check_search();" />
							<a href="javascript:check_search();" class="btn">조회</a>
							<a href="branch_list.php?mode=<?php echo $mode?>" class="btn">초기화</a>
							<div class="btn_right">
								검색건수 : <?php echo number_format($cnt)?>건 &nbsp;
								<a href="branch_write.php?mode=<?php echo $mode ?>" class="btn">지점 추가</a>
								<a href="javascript:fnExcel();" class="btn line"><img src="/zbackoffice/img/icon_excel.png"> 다운로드</a>
							</div>
						</td>
					</tr>
					</table>


				</form>
			</div>
		</div>

		<div class="main-box">
			<form name="Form" id="Form" method="post">
				<input type="hidden" name="typ" value="<?php echo $typ?>">

			<table class="list">
				<tr>
					<th width="6%"  style="text-align:center;vertical-align: middle;">번호</th>
					<th width="10%" style="text-align:center;vertical-align: middle;">지점명</th>
					<th width="*" style="text-align:center;vertical-align: middle;">지점주소</th>
					<th width="7%"  style="text-align:center;vertical-align: middle;">주택유형</th>
					<th width="15%" style="text-align:center;vertical-align: middle;">층</th>
					<th width="7%" style="text-align:center;vertical-align: middle;">세대정보</th>
					<th width="7%" style="text-align:center;vertical-align: middle;">연면적</th>
					<th width="7%" style="text-align:center;vertical-align: middle;">관리비</th>
					<th width="6%" style="text-align:center;vertical-align: middle;">주차</th>
					<th width="7%" style="text-align:center;vertical-align: middle;">게시여부</th>
					<th width="5%" style="text-align:center;vertical-align: middle;">관리</th>
				</tr>
	<?php if($cnt == 0 ) { ?>
				<tr>
					<td colspan="11" align="center" style="line-height:150px">데이터가 없습니다</td>
				</tr>
	<?php
		}else{
		 	$ListNO = $cnt - (($page - 1) * $recordcnt);
		 	while($row = mysqli_fetch_array($result)) {
				$idx		= replace_out($row["idx"]);
				$bh_name	= replace_out($row["bh_name"]);	//지점명
				$hous_type	= replace_out($row["hous_type"]);	//주택유형
				$hous_type_txt = get_want("com_code", "code_name", "AND idx = $hous_type");
				$bh_post	= replace_out($row["bh_post"]); //우편번호
				$bh_addr1	= replace_out($row["bh_addr1"]);	//지번주소
				$bh_addr2	= replace_out($row["bh_addr2"]);	//도로명주소
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

	?>
				<tr>
					<td><?php echo $ListNO ?></td>
					<td><a href="branch_write.php?mode=<?php echo $mode?>&idx=<?php echo $idx ?><?php echo $param2 ?>&page=<?php echo $page ?>"><?php echo $bh_name?></a></td>
					<td><?php echo $bh_addr1."<br/>".$bh_addr2?></td>
					<td><?php echo $hous_type_txt ?></td>
					<td><?php echo $bh_floor ?></td>
					<td><?php echo $bh_ginfo ?>가구</td>
					<td><?php echo $bh_total_area ?>㎡</td>
					<td><?php echo number_format($main_cost,0) ?>원</td>
					<td><?php echo $parking_yn_txt ?></td>
					<td><?php echo $view_yn_txt ?></td>
					<td><a href="branch_write.php?mode=<?php echo $mode?>&idx=<?php echo $idx ?><?php echo $param2 ?>&page=<?php echo $page ?>" class="btn gray">수정</a></td>
				</tr>
	<?php
				$ListNO--;
			} //end while
		}
	?>
			</table>
			</form>

			<? include $_SERVER["DOCUMENT_ROOT"] . "/zbackoffice/include/paging.php"; ?>

			<!--<div class="btn-right">
				<a href="./board_write.php?<?php echo $param?>" class="btn">등록</a>
				<a href="javascript:del();" class="btn line">삭제</a>
			</div>-->
		</div>
	</div>
</div>

<form id="excelForm" name="excelForm" method="post">
	<input type="hidden" id="mode" name="mode" value="<?php echo $mode?>" />
	<input type="hidden" id="search" name="search" value="<?php echo $search?>" />
	<input type="hidden" id="strsearch" name="strsearch" value="<?php echo $strsearch?>" />
</form>

<iframe id="_hiddenFrm" name="_hiddenFrm" width="0" height="0" frameborder="0" marginheight="0" marginwidth="0" scrolling="yes" style="visible:false;display:none;" title="빈프레임"></iframe>

<script type="text/javascript">
<!--
function fnExcel() {
	if (confirm("엑셀파일을 다운로드 하시겠습니까?")) {
		$("#excelForm").attr("action", "./branch_excel.php");
		$("#excelForm").submit();
	}
}
//-->
</script>

<? include $_SERVER["DOCUMENT_ROOT"] . "/zbackoffice/include/footer.php"; ?>
</div>