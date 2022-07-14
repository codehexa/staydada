<?php
include $_SERVER["DOCUMENT_ROOT"] . "/zbackoffice/include/head.php";

/*************************************************/
// 지점관리 - 호실리스트 
/*************************************************/
$tbl = "room_info";
$recordcnt = 20;

$ordbystr = " idx DESC ";

//기간
//if($startdate && $enddate) $searchand .= " AND LEFT(reg_date, 10) BETWEEN '$startdate' AND '$enddate'";

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
$totalpage = QRY_TOTALPAGE($cnt, $recordcnt);
$result = QRY_LIST($tbl, $recordcnt, $page, $searchand, " idx DESC");


$addpara = "&srcbranch=$srcbranch&srcrtype=$srcrtype&src_option1=$src_option1&src_option2=$src_option2&src_option3=$src_option3";
$addpara .= "&src_option4=$src_option4&src_option6=$src_option6&src_option7=$src_option7&src_option9=$src_option9";
$addpara .= "&src_option12=$src_option12&src_option15=$src_option15&src_option16=$src_option16&src_option18=$src_option18";

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
				<form id="searchfrm" name="searchfrm" method="post"  enctype="multipart/form-data" action="?mode=<?php echo $mode?>">
					<input type="hidden" id="typ" name="typ" />
					<input type="hidden" id="mode" name="mode" value="<?php echo $mode?>">
					<input type="hidden" id="page" name="page" value="<?php echo $page ?>" />
					<input type="hidden" id="bh_idx" name="bh_idx" />
					<input type="hidden" id="idx" name="idx" />
					<table class="list">
					 <tr>
						<td class="txt-left">
							<select id="srcbranch" name="srcbranch" class="w200" onChange="fnSearch(this.value)">
								<option value="">전체지점</option>
					<?php
					/*****************************************************************************************************/
					/*지점정보 START*/
					/*****************************************************************************************************/

						$result_branch = QRY_LIST("branch_info", "all", 1, "AND view_yn='Y'", " bh_name ASC");
						while($row_branch = mysqli_fetch_array($result_branch)){
							$branch_idx = replace_out($row_branch["idx"]);
							$branch_name = replace_out($row_branch["bh_name"]);
					/******************************************************************************************************/
					?>
								<option value="<?php echo $branch_idx ?>" <?php echo ($srcbranch==$branch_idx)?"selected":""?>><?php echo $branch_name ?></option>
					<?php
					/*****************************************************************************************************/
						}
					/*지점정보 END*/
					/******************************************************************************************************/
					?>
							</select>
							<select id="srcrtype" name="srcrtype" class="w100" onChange="fnSearch(this.value)">
								<option value="">룸타입</option>
					<?php
					/******************************************************************************************************/
					/*룸타입 코드 START*/
					/******************************************************************************************************/
						$result_cd =QRY_LIST("com_code","all","1"," AND gubun='BR002' and useyn=1 "," sort ASC ");
						while($row_cd = mysqli_fetch_array($result_cd)){
							$code_idx = replace_out($row_cd["idx"]);
							$code_name = replace_out($row_cd["code_name"]);						
					/******************************************************************************************************/
					?>
								<option value="<?php echo $code_idx?>" <?php echo ($srcrtype==$code_idx)?"selected":""?>><?php echo $code_name ?></option>
					<?php
					/******************************************************************************************************/
						}
					/*룸타입 코드 END */
					/******************************************************************************************************/
					?>
							</select>
						</td>
					 </tr>
					 <tr>
						<td class="txt-left">
							<select id="src_option1" name="src_option1" class="w90" onChange="fnSearch(this.value)">
								<option value="">보일러</option>
								<option value="I" <?php echo ($src_option1=="I")?"selected":""?>>개별</option>
								<option value="C" <?php echo ($src_option1=="C")?"selected":""?>>중앙</option>
								<option value="N" <?php echo ($src_option1=="N")?"selected":""?>>없음</option>
							</select>	
							<select id="src_option2" name="src_option2" class="w80" onChange="fnSearch(this.value)">
								<option value="">주방</option>
								<option value="I" <?php echo ($src_option2=="I")?"selected":""?>>개별</option>
								<option value="P" <?php echo ($src_option2=="P")?"selected":""?>>공용</option>
							</select>
							<select id="src_option3" name="src_option3" class="w90" onChange="fnSearch(this.value)">
								<option value="">화장실</option>
								<option value="I" <?php echo ($src_option3=="I")?"selected":""?>>개별</option>
								<option value="P" <?php echo ($src_option3=="P")?"selected":""?>>공용</option>
							</select>							
							<select id="src_option4" name="src_option4" class="w90" onChange="fnSearch(this.value)">
								<option value="">에어컨</option>
								<option value="Y" <?php echo ($src_option4=="Y")?"selected":""?>>유</option>
								<option value="N" <?php echo ($src_option4=="N")?"selected":""?>>무</option>
							</select>
							<select id="src_option6" name="src_option6" class="w80" onChange="fnSearch(this.value)">
								<option value="">침대</option>
								<option value="Y" <?php echo ($src_option6=="Y")?"selected":""?>>유</option>
								<option value="N" <?php echo ($src_option6=="N")?"selected":""?>>무</option>
							</select>
							<select id="src_option7" name="src_option7" class="w90" onChange="fnSearch(this.value)">
								<option value="">세탁기</option>
								<option value="Y" <?php echo ($src_option7=="Y")?"selected":""?>>유</option>
								<option value="N" <?php echo ($src_option7=="N")?"selected":""?>>무</option>
							</select>
							<select id="src_option9" name="src_option9" class="w90" onChange="fnSearch(this.value)">
								<option value="">냉장고</option>
								<option value="Y" <?php echo ($src_option9=="Y")?"selected":""?>>유</option>
								<option value="N" <?php echo ($src_option9=="N")?"selected":""?>>무</option>
							</select>
							<select id="src_option12" name="src_option12" class="w90" onChange="fnSearch(this.value)">
								<option value="">인터넷</option>
								<option value="Y" <?php echo ($src_option12=="Y")?"selected":""?>>유</option>
								<option value="N" <?php echo ($src_option12=="N")?"selected":""?>>무</option>
							</select>
							<select id="src_option15" name="src_option15" class="w120" onChange="fnSearch(this.value)">
								<option value="">전세대출</option>
								<option value="Y" <?php echo ($src_option15=="Y")?"selected":""?>>가능</option>
								<option value="N" <?php echo ($src_option15=="N")?"selected":""?>>불가능</option>
							</select>
							<select id="src_option16" name="src_option16" class="w120" onChange="fnSearch(this.value)">
								<option value="">반려동물</option>
								<option value="Y" <?php echo ($src_option16=="Y")?"selected":""?>>가능</option>
								<option value="N" <?php echo ($src_option16=="N")?"selected":""?>>불가능</option>
							</select>
							<select id="src_option18" name="src_option18" class="w80" onChange="fnSearch(this.value)">
								<option value="">엘베</option>
								<option value="Y" <?php echo ($src_option18=="Y")?"selected":""?>>유</option>
								<option value="N" <?php echo ($src_option18=="N")?"selected":""?>>무</option>
							</select>
							&nbsp;<a href="room_list.php?mode=<?php echo $mode?>" class="btn">초기화</a>
						</td>
					 </tr>
					 <tr>
						<td class="txt-left">
							<div class="btn_right">
								검색건수 : <?php echo number_format($cnt)?>건 &nbsp;
								<a href="room_write.php?mode=<?php echo $mode ?>" class="btn">호실 추가</a>
								<a href="javascript:fnExcel();" class="btn line"><img src="/zbackoffice/img/icon_excel.png"> 다운로드</a>
							</div>
						</td>
					</tr>
					</table>

				</form>
			</div>
		</div>

		<div class="main-box" style="border:0px solid red;overflow:auto;white-space:nowrap;">
			<form name="Form" id="Form" method="post">
				<input type="hidden" name="typ" value="<?php echo $typ?>">

			<table class="list">
				<tr>
					<th width="7%"  style="text-align:center;vertical-align: middle;">번호</th>
					<th width="10%" style="text-align:center;vertical-align: middle;">지점명</th>
					<th width="8%" style="text-align:center;vertical-align: middle;">층</th>
					<th width="10%"  style="text-align:center;vertical-align: middle;">호실</th>
					<th width="12%" style="text-align:center;vertical-align: middle;">룸타입</th>
					<th width="10%" style="text-align:center;vertical-align: middle;">공급면적(㎡)</th>
					<th width="8%" style="text-align:center;vertical-align: middle;">전용면적(㎡)</th>
					<th width="8%" style="text-align:center;vertical-align: middle;">보일러</th>
					<th width="8%" style="text-align:center;vertical-align: middle;">주방</th>
					<th width="8%" style="text-align:center;vertical-align: middle;">화장실</th>
					<th width="8%" style="text-align:center;vertical-align: middle;">에어컨</th>
					<th width="8%" style="text-align:center;vertical-align: middle;">침대</th>
					<th width="8%" style="text-align:center;vertical-align: middle;">세탁기</th>
					<th width="8%" style="text-align:center;vertical-align: middle;">냉장고</th>
					<th width="8%" style="text-align:center;vertical-align: middle;">인터넷</th>
					<th width="8%" style="text-align:center;vertical-align: middle;">전세대출</th>
					<th width="8%" style="text-align:center;vertical-align: middle;">반려동물</th>
					<th width="8%" style="text-align:center;vertical-align: middle;">엘베</th>
					<th width="8%" style="text-align:center;vertical-align: middle;">보증금</th>
					<th width="8%" style="text-align:center;vertical-align: middle;">월임대료</th>
					<th width="8%" style="text-align:center;vertical-align: middle;">월관리비</th>
					<th width="8%" style="text-align:center;vertical-align: middle;">게시여부</th>
					<th width="15%" style="text-align:center;vertical-align: middle;">관리</th>
				</tr>
	<?php if($cnt == 0 ) { ?>
				<tr>
					<td colspan="24" align="center" style="line-height:150px;">데이터가 없습니다</td>
				</tr>
	<?php
		}else{
		 	$ListNO = $cnt - (($page - 1) * $recordcnt);
		 	while($row = mysqli_fetch_array($result)) {
				$idx		= replace_out($row["idx"]);		//일련번호
				$bh_idx		= replace_out($row["bh_idx"]);	//지점일련번호
				$bh_name	= get_want("branch_info","bh_name","AND idx = $bh_idx");	//지점명
				$room_state	= replace_out($row["room_state"]);	//객실상태(C:수리완료,R:수리중)
				$room_floor	= replace_out($row["room_floor"]); //층
				$room_number	= replace_out($row["room_number"]);	//호실
				$s_area		= replace_out($row["s_area"]);	//공급면적
				$d_area		= replace_out($row["d_area"]);	//전용면적
				$num_people	= replace_out($row["num_people"]); //기준인원
				$room_type	= replace_out($row["room_type"]);	//룸타입
				$room_type_txt = get_want("com_code", "code_name", "AND idx = $room_type");
				$way	= replace_out($row["way"]);	//방향
				$way_txt = get_want("com_code", "code_name", "AND idx = $way");

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
	?>
				<tr>
					<td><?php echo $ListNO ?></td>
					<td><a href="room_write.php?mode=<?php echo $mode?>&idx=<?php echo $idx ?><?php echo $addpara ?>&page=<?php echo $page ?>"><?php echo $bh_name ?></a></td>
					<td><?php echo $room_floor?>층</td><!-- 층 -->
					<td><?php echo $room_number ?>호</td><!-- 호 -->
					<td><?php echo $room_type_txt ?></td><!-- 룸타입 -->
					<td><?php echo $s_area ?></td><!-- 공급면적 -->
					<td><?php echo $d_area ?></td><!--전용급면적 -->
					<td><?php 
						if($room_option_1=="I"): echo "개별";
						elseif($room_option_1=="C"): echo "중앙";
						elseif($room_option_1=="N"): echo "없음";
						endif;
					?></td>
					<td><?php echo ($room_option_2=="I")?"개별":"공용"?></td>
					<td><?php echo ($room_option_3=="I")?"개별":"공용"?></td>
					<td><?php echo ($room_option_4=="Y")?"○":"X"?></td><!--에어컨-->
					<td><?php echo ($room_option_6=="Y")?"○":"X"?></td><!--침대-->
					<td><?php echo ($room_option_7=="Y")?"○":"X"?></td><!--세탁기-->
					<td><?php echo ($room_option_9=="Y")?"○":"X"?></td><!--냉장고-->
					<td><?php echo ($room_option_12=="Y")?"○":"X"?></td><!--인터넷-->
					<td><?php echo ($room_option_15=="Y")?"○":"X"?></td><!--전세대출-->
					<td><?php echo ($room_option_16=="Y")?"○":"X"?></td><!--반려동물-->
					<td><?php echo ($room_option_18=="Y")?"○":"X"?></td><!--엘베-->
					<td><?php echo number_format($deposit,0) ?>만원</td>
					<td><?php echo number_format($rental,0) ?>원</td>
					<td><?php echo number_format($room_cost,0) ?>원</td>
					<!--<td></td><!--사진-->
					<!--<td></td><!--계약정보 -->
					<td><?php echo $view_yn_txt ?></td>
					<td>
						<a href="room_write.php?mode=<?php echo $mode?>&idx=<?php echo $idx ?><?php echo $addpara ?>&page=<?php echo $page ?>" class="btn gray">수정</a>
						<a href="javascript:fnRoomCopy('<?php echo $bh_idx ?>','<?php echo $idx ?>');" class="btn ">복사</a>
					</td>
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
	<input type="hidden" id="srcbranch" name="srcbranch" value="<?php echo $srcbranch?>" />
	<input type="hidden" id="srcrtype" name="srcrtype" value="<?php echo $srcrtype?>" />
	<input type="hidden" id="src_option1" name="src_option1" value="<?php echo $src_option1?>" />
	<input type="hidden" id="src_option2" name="src_option2" value="<?php echo $src_option2?>" />
	<input type="hidden" id="src_option3" name="src_option3" value="<?php echo $src_option3?>" />
	<input type="hidden" id="src_option4" name="src_option4" value="<?php echo $src_option4?>" />
	<input type="hidden" id="src_option6" name="src_option6" value="<?php echo $src_option6?>" />
	<input type="hidden" id="src_option7" name="src_option7" value="<?php echo $src_option7?>" />
	<input type="hidden" id="src_option9" name="src_option9" value="<?php echo $src_option9?>" />
	<input type="hidden" id="src_option12" name="src_option12" value="<?php echo $src_option12?>" />
	<input type="hidden" id="src_option15" name="src_option15" value="<?php echo $src_option15?>" />
	<input type="hidden" id="src_option16" name="src_option16" value="<?php echo $src_option16?>" />
	<input type="hidden" id="src_option18" name="src_option18" value="<?php echo $src_option18?>" />
</form>

<iframe id="_hiddenFrm" name="_hiddenFrm" width="0" height="0" frameborder="0" marginheight="0" marginwidth="0" scrolling="yes" style="visible:false;display:none;" title="빈프레임"></iframe>

<script type="text/javascript">
<!--

//검색
function fnSearch(){
	var frm = document.searchfrm;
	frm.submit();
}


//엑셀다운로드
function fnExcel() {
	if (confirm("엑셀파일을 다운로드 하시겠습니까?")) {
		$("#excelForm").attr("action", "./room_excel.php");
		$("#excelForm").submit();
	}
}

//복사(22.05.31 추가)
function fnRoomCopy(_bhidx, _idx){

	$("#typ").val("copy_room");
	$("#bh_idx").val(_bhidx);
	$("#idx").val(_idx);
	var formData = $("#searchfrm").serialize();

	if(confirm("해당 호실 내용을 복사하시겠습니까?")){
		$.ajax({
			url: 'room_proc.php',
			type: 'POST',
            data: formData,
            dataType : "json",
            async : false ,
			success: function(result){
				if(result.success=="OK"){
					location.href="room_write.php?mode=<?php echo $mode?>&idx="+result.room_idx;
				}else{
					alert("오류가 발생하였습니다.\n확인 후 다시 해주시기 바랍니다.");
					document.reload();
				}
			}
		});
	}
}

//-->
</script>

<? include $_SERVER["DOCUMENT_ROOT"] . "/zbackoffice/include/footer.php"; ?>
</div>