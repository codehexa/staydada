<?php
include $_SERVER["DOCUMENT_ROOT"] . "/zbackoffice/include/head.php";

/***********************************************************************/
//호실 - 등록,수정 상세 
/***********************************************************************/

if($idx) {

	include $_SERVER["DOCUMENT_ROOT"] . "/proc/room_info_view_row.php";

	$typ = "edit";
} else {
	$typ = "write";
}
/***********************************************************************/
?>

<div id="contents">
	<div class="tit"><?php echo $title_text?>
		<div class="path"><img src="../img/icon-home.png">HOME<img src="../img/arr.png"><?php echo $menu_text2?><img src="../img/arr.png"><?php echo $title_text?></div>
	</div>

	<div class="content">
		<form name="frm" id="frm" method="post" enctype="multipart/form-data">
			<input type="hidden" name="mode" value="<?php echo $mode?>">
			<input type="hidden" name="typ" id="typ" value="<?php echo $typ?>">
			<input type="hidden" name="idx" id="idx" value="<?php echo $idx?>">


		<div class="tit">호실정보
		<div class="main-box">

			<table class="write">
				<colgroup>
					<col width="15%" />
					<col width="35%" />
					<col width="15%" />
					<col width="35%" />
				</colgroup>
				<tr>
					<th>지점명</th>
					<td class="txt_info">
						<select id="bh_idx" name="bh_idx" class="w180">
							<option value="">지점선택</option>
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
								<option value="<?php echo $branch_idx ?>" <?php echo ($bh_idx==$branch_idx)?"selected":""?>><?php echo $branch_name ?></option>
					<?php
					/*****************************************************************************************************/
						}
					/*지점정보 END*/
					/******************************************************************************************************/
					?>
						</select>
					</td>
					<th>객실상태</th>
					<td class="txt_info">
						<select id="room_state" name="room_state" class="w120">
							<option value="">객실상태</option>
					<?php
						/*객실상태 코드 START*/
							$result_cd =QRY_LIST("com_code","all","1"," AND gubun='BR005' AND useyn=1 "," sort ASC ");
							while($row_cd = mysqli_fetch_array($result_cd)){
								$code_idx = replace_out($row_cd["idx"]);
								$code_name = replace_out($row_cd["code_name"]);						
					?>
							<option value="<?php echo $code_idx?>" <?php echo ($room_state==$code_idx)?"selected":""?>><?php echo $code_name ?></option>
					<?php
							}
						/*룸타입 코드 END */
					?>
						</select>
					</td>
				</tr>
				<tr>
					<th>게시여부</th>
					<td>
						<input type="radio" id="view_yn1" name="view_yn" value="Y" <?php echo ($view_yn=="" || $view_yn=="Y")?"checked":""?>/><label for="view_yn1">게시</label>
						<input type="radio" id="view_yn2" name="view_yn" value="N" <?php echo ($view_yn=="N")?"checked":""?>/><label for="view_yn2">미게시</label>
					</td>
					<th>계약상태</th>
					<td class="txt_info">
						<select id="contract_state" name="contract_state" class="w120">
							<!--<option value="">계약상태</option>-->
					<?php
						/*계약상태 코드 START*/
							$result_cd =QRY_LIST("com_code","all","1"," AND gubun='BR004' AND useyn=1 "," sort ASC ");
							while($row_cd = mysqli_fetch_array($result_cd)){
								$code_idx = replace_out($row_cd["idx"]);
								$code_name = replace_out($row_cd["code_name"]);						
					?>
							<option value="<?php echo $code_idx?>" <?php echo ($contract_state==$code_idx)?"selected":""?>><?php echo $code_name ?></option>
					<?php
							}
						/*룸타입 코드 END */
					?>
						</select>
					</td>
				</tr>
			</table>
			<table class="write">
				<tr>
					<th class="ce" width="20%">층</th>
					<th class="ce" width="20%">호실</th>
					<th class="ce" width="20%">공급면적</th>
					<th class="ce" width="20%">전용면적</th>
				</tr>
				<tr>
					<td class="ce"><input type="text" id="room_floor" name="room_floor" value="<?php echo $room_floor ?>" class="w200" maxlength="10"/></td>
					<td class="ce"><input type="text" id="room_number" name="room_number" value="<?php echo $room_number ?>" class="w200" maxlength="20"/>호</td>
					<td class="ce"><input type="text" id="s_area" name="s_area" value="<?php echo $s_area ?>" class="w200" maxlength="10" />㎡</td>
					<td class="ce"><input type="text" id="d_area" name="d_area" value="<?php echo $d_area ?>" class="w200" maxlength="10" />㎡</td>
				</tr>
				<tr>
					<th class="ce" width="20%">실평수</th>
					<th class="ce" width="20%">룸타입</th>
					<th class="ce" width="20%">향</th>
					<th class="ce" width="20%">최소계약기간</th>
				</tr>
				<tr>
					<td class="ce"><input type="text" id="real_area" name="real_area" value="<?php echo $real_area ?>" class="w200" maxlength="10"/>P</td>
					<td class="ce">
						<select id="room_type" name="room_type" class="w200">
					<?php
						/*룸타입 코드 START*/
							$result_cd =QRY_LIST("com_code","all","1"," AND gubun='BR002' AND useyn=1 "," sort ASC ");
							while($row_cd = mysqli_fetch_array($result_cd)){
								$code_idx = replace_out($row_cd["idx"]);
								$code_name = replace_out($row_cd["code_name"]);						
					?>
							<option value="<?php echo $code_idx?>" <?php echo ($room_type==$code_idx)?"selected":""?>><?php echo $code_name ?></option>
					<?php
							}
						/*룸타입 코드 END */
					?>
						</select>
					</td>
					<td class="ce">
						<select id="way" name="way" class="w200">
					<?php
						/*향 코드 START*/
							$result_cd =QRY_LIST("com_code","all","1"," AND gubun='BR003' AND useyn=1 "," sort ASC ");
							while($row_cd = mysqli_fetch_array($result_cd)){
								$code_idx = replace_out($row_cd["idx"]);
								$code_name = replace_out($row_cd["code_name"]);						
					?>
							<option value="<?php echo $code_idx?>" <?php echo ($way==$code_idx)?"selected":""?>><?php echo $code_name ?></option>
					<?php
							}
						/*향 코드 END */
					?>
						</select>					
					</td>
					<td class="ce"><input type="text" id="contract_period" name="contract_period" value="<?php echo $contract_period ?>" numberOnly class="w200" maxlength="10"/>개월</td>
				</tr>
				<?php
				//파일 업로드 시작
					$si = 1; $ei = 16;
					for ($i = $si; $i <= $ei; $i++) {
				?>

					<tr>
						<th><?php echo ($i==1)?"썸네일":"상세사진"?><?php echo ($i==1)?"":$i-1 ?></th>
						<td colspan="3" >
							<input type="file" name="file<?php echo $i?>" id="file<?php echo $i?>" class="w340" accept=".jpg, .jpeg, .png">
				<?php 
					if($idx) : //수정인경우
						if(${"file".$i}):
				?>
							<p >
								<div id="prev_img_<?php echo $i ?>" style="float:left;">
									<div style="display:inline-block; width:150px;">
										<?
										$file_full_path = "http://". $_SERVER["HTTP_HOST"].$file_path.${"file".$i};
										$file_kind = pathinfo($file_full_path, PATHINFO_EXTENSION);
										if($file_kind == "gif" or $file_kind == "jpeg" or $file_kind == "jpg" or $file_kind == "png") {
										?>
										<img src="<?php echo $file_path2.${"file".$i}?>" id="img<?php echo $i?>" style="width:140px;" onClick="img_popup('<?php echo $file_path?><?php echo ${"file".$i}?>');">
										<? } ?>
									</div>
									<div style="display:inline-block;">
										<div><a href="javascript:down('filename=<?php echo ${"file".$i}?>&filereal=<?php echo ${"file_real".$i}?>&path=<?php echo $file_path?>&mode=<?php echo $mode?>&idx=<?php echo $idx?>&num=<?php echo $i?>');" ><?php echo ${"file_real".$i}?></a>&nbsp;<img src="/zbackoffice/img/btn_x.png" style="cursor:pointer;" onClick="img_delete('<?php echo $tbl ?>', '<?php echo $idx?>', '<?php echo $i?>', '<?php echo $i?>');"></div>
									</div>
								</div>

							</p>
				<?php	endif; ?>
							<input type="hidden" name="file_o<?php echo $i?>" id="file_o<?php echo $i?>" value="<?php echo ${"file".$i}?>">
							<input type="hidden" name="file_o_real<?php echo $i?>" id="file_o_real<?php echo $i?>" value="<?php echo ${"file_real".$i}?>">
				<?php endif; ?>
						</td>
					</tr>
				<?php
					} // end for 
				?>
			</table>
		</div>

		<div class="tit">호실옵션</div>
		<div class="main-box">
			<table class="write">
			 <tr>
				<th class="ce" width="16%">보일러</th>
				<th class="ce" width="16%">주방</th>
				<th class="ce" width="16%">화장실 겸 욕실</th>
				<th class="ce" width="16%">에어컨</th>
				<th class="ce" width="16%">온풍기</th>
				<th class="ce" width="17%">침대</th>
			 </tr>
			 <tr>
				<td class="ce">
					<input type="radio" id="rm_option1_1" name="room_option_1" value="I" <?php echo ($room_option_1==""||$room_option_1=="I")?"checked":""?>/><label for="rm_option1_1">개별</label>
					<input type="radio" id="rm_option1_2" name="room_option_1" value="C" <?php echo ($room_option_1=="C")?"checked":""?>/><label for="rm_option1_2">중앙</label>
					<input type="radio" id="rm_option1_3" name="room_option_1" value="N" <?php echo ($room_option_1=="N")?"checked":""?>/><label for="rm_option1_3">없음</label>
				</td>
				<td class="ce">
					<input type="radio" id="rm_option2_1" name="room_option_2" value="I" <?php echo ($room_option_2==""||$room_option_2=="I")?"checked":""?>/><label for="rm_option2_1">개별</label>
					<input type="radio" id="rm_option2_2" name="room_option_2" value="P" <?php echo ($room_option_2=="P")?"checked":""?>/><label for="rm_option2_2">공용</label>				
				</td>
				<td class="ce">
					<input type="radio" id="rm_option3_1" name="room_option_3" value="I" <?php echo ($room_option_3==""||$room_option_3=="I")?"checked":""?>/><label for="rm_option3_1">개별</label>
					<input type="radio" id="rm_option3_2" name="room_option_3" value="P" <?php echo ($room_option_3=="P")?"checked":""?>/><label for="rm_option3_2">공용</label>				
				</td>
				<td class="ce">
					<input type="radio" id="rm_option4_1" name="room_option_4" value="Y" <?php echo ($room_option_4==""||$room_option_4=="Y")?"checked":""?>/><label for="rm_option4_1">있음</label>
					<input type="radio" id="rm_option4_2" name="room_option_4" value="N" <?php echo ($room_option_4=="N")?"checked":""?>/><label for="rm_option4_2">없음</label>
				</td>
				<td class="ce">
					<input type="radio" id="rm_option5_1" name="room_option_5" value="Y" <?php echo ($room_option_5==""||$room_option_5=="Y")?"checked":""?>/><label for="rm_option5_1">있음</label>
					<input type="radio" id="rm_option5_2" name="room_option_5" value="N" <?php echo ($room_option_5=="N")?"checked":""?>/><label for="rm_option5_2">없음</label>			
				</td>
				<td class="ce">
					<input type="radio" id="rm_option6_1" name="room_option_6" value="Y" <?php echo ($room_option_6==""||$room_option_6=="Y")?"checked":""?>/><label for="rm_option6_1">있음</label>
					<input type="radio" id="rm_option6_2" name="room_option_6" value="N" <?php echo ($room_option_6=="N")?"checked":""?>/><label for="rm_option6_2">없음</label>					
				</td>
			 </tr>
			 <tr>
				<th class="ce" width="16%">세탁기</th>
				<th class="ce" width="16%">건조기</th>
				<th class="ce" width="16%">냉장고</th>
				<th class="ce" width="16%">전자레인지</th>
				<th class="ce" width="16%">인덕션</th>
				<th class="ce" width="17%">인터넷</th>
			 </tr>
			 <tr>
				<td class="ce">
					<input type="radio" id="rm_option7_1" name="room_option_7" value="Y" <?php echo ($room_option_7==""||$room_option_7=="Y")?"checked":""?>/><label for="rm_option7_1">있음</label>
					<input type="radio" id="rm_option7_2" name="room_option_7" value="N" <?php echo ($room_option_7=="N")?"checked":""?>/><label for="rm_option7_2">없음</label>	
				</td>
				<td class="ce">
					<input type="radio" id="rm_option8_1" name="room_option_8" value="Y" <?php echo ($room_option_8==""||$room_option_8=="Y")?"checked":""?>/><label for="rm_option8_1">있음</label>
					<input type="radio" id="rm_option8_2" name="room_option_8" value="N" <?php echo ($room_option_8=="N")?"checked":""?>/><label for="rm_option8_2">없음</label>			
				</td>
				<td class="ce">
					<input type="radio" id="rm_option9_1" name="room_option_9" value="Y" <?php echo ($room_option_9==""||$room_option_9=="Y")?"checked":""?>/><label for="rm_option9_1">있음</label>
					<input type="radio" id="rm_option9_2" name="room_option_9" value="N" <?php echo ($room_option_9=="N")?"checked":""?>/><label for="rm_option9_2">없음</label>			
				</td>
				<td class="ce">
					<input type="radio" id="rm_option10_1" name="room_option_10" value="Y" <?php echo ($room_option_10==""||$room_option_10=="Y")?"checked":""?>/><label for="rm_option10_1">있음</label>
					<input type="radio" id="rm_option10_2" name="room_option_10" value="N" <?php echo ($room_option_10=="N")?"checked":""?>/><label for="rm_option10_2">없음</label>
				</td>
				<td class="ce">
					<input type="radio" id="rm_option11_1" name="room_option_11" value="Y" <?php echo ($room_option_11==""||$room_option_11=="Y")?"checked":""?>/><label for="rm_option11_1">있음</label>
					<input type="radio" id="rm_option11_2" name="room_option_11" value="N" <?php echo ($room_option_11=="N")?"checked":""?>/><label for="rm_option11_2">없음</label>			
				</td>
				<td class="ce">
					<input type="radio" id="rm_option12_1" name="room_option_12" value="Y" <?php echo ($room_option_12==""||$room_option_12=="Y")?"checked":""?>/><label for="rm_option12_1">있음</label>
					<input type="radio" id="rm_option12_2" name="room_option_12" value="N" <?php echo ($room_option_12=="N")?"checked":""?>/><label for="rm_option12_2">없음</label>					
				</td>
			 </tr>
			 <tr>
				<th class="ce" width="16%">정수기</th>
				<th class="ce" width="16%">도어락</th>
				<th class="ce" width="16%">전세대출</th>
				<th class="ce" width="16%">반려동물</th>
				<th class="ce" width="16%">주차장</th>
				<th class="ce" width="17%">엘리베이터</th>
			 </tr>
			 <tr>
				<td class="ce">
					<input type="radio" id="rm_option13_1" name="room_option_13" value="Y" <?php echo ($room_option_13==""||$room_option_13=="Y")?"checked":""?>/><label for="rm_option13_1">있음</label>
					<input type="radio" id="rm_option13_2" name="room_option_13" value="N" <?php echo ($room_option_13=="N")?"checked":""?>/><label for="rm_option13_2">없음</label>	
				</td>
				<td class="ce">
					<input type="radio" id="rm_option14_1" name="room_option_14" value="Y" <?php echo ($room_option_14==""||$room_option_14=="Y")?"checked":""?>/><label for="rm_option14_1">있음</label>
					<input type="radio" id="rm_option14_2" name="room_option_14" value="N" <?php echo ($room_option_14=="N")?"checked":""?>/><label for="rm_option14_2">없음</label>			
				</td>
				<td class="ce">
					<input type="radio" id="rm_option15_1" name="room_option_15" value="Y" <?php echo ($room_option_15==""||$room_option_15=="Y")?"checked":""?>/><label for="rm_option15_1">가능</label>
					<input type="radio" id="rm_option15_2" name="room_option_15" value="N" <?php echo ($room_option_15=="N")?"checked":""?>/><label for="rm_option15_2">불가능</label>			
				</td>
				<td class="ce">
					<input type="radio" id="rm_option16_1" name="room_option_16" value="Y" <?php echo ($room_option_16==""||$room_option_16=="Y")?"checked":""?>/><label for="rm_option16_1">가능</label>
					<input type="radio" id="rm_option16_2" name="room_option_16" value="N" <?php echo ($room_option_16=="N")?"checked":""?>/><label for="rm_option16_2">불가능</label>
				</td>
				<td class="ce">
					<input type="radio" id="rm_option17_1" name="room_option_17" value="P" <?php echo ($room_option_17==""||$room_option_17=="P")?"checked":""?>/><label for="rm_option17_1">유료</label>
					<input type="text" id="room_option_17_txt" name="room_option_17_txt" maxlength="10" class="w120" numberOnly value="<?php echo $room_option_17_txt ?>" />원<br />
					<input type="radio" id="rm_option17_2" name="room_option_17" value="F" <?php echo ($room_option_17=="F")?"checked":""?>/><label for="rm_option17_2">무료</label>
					<input type="radio" id="rm_option17_3" name="room_option_17" value="N" <?php echo ($room_option_17=="N")?"checked":""?>/><label for="rm_option17_3">없음</label>			
				</td>
				<td class="ce">
					<input type="radio" id="rm_option18_1" name="room_option_18" value="Y" <?php echo ($room_option_18==""||$room_option_18=="Y")?"checked":""?>/><label for="rm_option18_1">있음</label>
					<input type="radio" id="rm_option18_2" name="room_option_18" value="N" <?php echo ($room_option_18=="N")?"checked":""?>/><label for="rm_option18_2">없음</label>					
				</td>
			 </tr>
			</table>
		</div>

		<div class="tit">임대금액</div>
		<div class="main-box">
			<table class="write">
					<col width="15%" />
					<col width="35%" />
					<col width="12%" />
					<col width="38%" />
				<tr>
					<th>보증금</th>
					<td><input type="text" id="deposit" name="deposit" maxlength="10" class="w200" value="<?php echo $deposit ?>" numberOnly/>만원</td>
					<th>월임대료</th>
					<td><input type="text" id="rental" name="rental" maxlength="10" class="w200" value="<?php echo $rental ?>" numberOnly/>원</td>
				</tr>
				<tr>
					<th>관리비</th>
					<td colspan="3"><input type="text" id="room_cost" name="room_cost" maxlength="10" class="w200" value="<?php echo $room_cost ?>" numberOnly/>원</td>
				</tr>
				<tr>
					<th>관리비 포함내역</th>
					<td><input type="text" id="in_desc" name="in_desc" maxlength="100" class="w450" value="<?php echo $in_desc ?>" /></td>
					<th>관리비 미포함(개별납부)</th>
					<td><input type="text" id="not_desc" name="not_desc" maxlength="100" class="w450" value="<?php echo $not_desc ?>" /></td>
				</tr>
			</table>
		</div>

		<div class="btn-center">
			<a href="javascript:fnSend();" class="btn"><?php echo ($typ=="write")? "저장":"수정" ?></a>
			<!--<? if($typ == "edit") { ?><a href="javascript:fnDel('del', '삭제');" class="btn line">삭제</a><? } ?>-->
			<a href="room_list.php?<?php echo $param?><?php echo $addpara?>" class="btn gray">목록</a>
		</div>

		</form>

	</div><!-- class="content" END -->

<iframe id="_hiddenFrm" name="_hiddenFrm" width="0" height="0" frameborder="0" marginheight="0" marginwidth="0" scrolling="yes" style="visible:false;display:none;" title="빈프레임"></iframe>
<script type="text/javascript">
<!--


function fnSend() {
	var f = document.frm;
	var typ = "<?php echo $typ?>";
	var txt = "등록";
	if(typ=="edit"){
		txt = "수정";
	}

    if (nullchk(f.bh_idx,"지점명을 선택해 주십시오.")== false) return ;
    if (nullchk(f.room_state,"객실상태를 선택해 주십시오.")== false) return;
    if (nullchk(f.room_floor,"층을 입력해 주십시오.")== false) return ;
    if (nullchk(f.room_number,"호실을 입력해 주십시오.")== false) return ;
    if (nullchk(f.s_area,"공급면먹을 입력해 주십시오.")== false) return ;
    if (nullchk(f.d_area,"전용면적을 입력해 주십시오.")== false) return ;
    if (nullchk(f.real_area,"실평수를 입력해 주십시오.")== false) return ;
    if (nullchk(f.room_type,"룸타입을 선택해 주십시오.")== false) return ;
    if (nullchk(f.way,"향을 선택해 주십시오.")== false) return ; 
    if (nullchk(f.contract_period,"최소 계약기간을 입력해 주십시오.")== false) return ;
<?php if($typ=="write"):?>
    if (nullchk(f.file1,"사진을 첨부해 주십시오.")== false) return ;
    if (nullchk(f.file2,"사진을 첨부해 주십시오.")== false) return ;
<?php elseif($typ=="edit"):?>
	if($("#file1").val()==false && $("#file_o1").val() == false){
		alert("사진을 첨부해 주십시오.");
		return;
	}
	if($("#file2").val()==false && $("#file_o2").val() == false){
		alert("사진을 첨부해 주십시오.");
		return;
	}
<?php endif;?>

	var room_option_17 = $('input[name="room_option_17"]:checked').val();
	if(room_option_17=="P"){
	    if (nullchk(f.room_option_17_txt,"주차요금을 입력해 주십시오.")== false) return ;
	}

    if (nullchk(f.deposit,"보증금을 입력해 주십시오.")== false) return ;
    if (nullchk(f.rental,"월임대료를 입력해 주십시오.")== false) return ;
    if (nullchk(f.room_cost,"관리비를 입력해 주십시오.")== false) return ;
    if (nullchk(f.in_desc,"관리비 포함내역을 입력해 주십시오.")== false) return ;
    if (nullchk(f.not_desc,"관리비 미포함(개별납부)을/를 입력해 주십시오.")== false) return ;

	if (confirm(txt+"하시겠습니까?")) {
		$("#frm").attr("action", "./room_proc.php?<?php echo $param?>");
		$("#frm").submit();
	}
}


//삭제
function fnDel(Arg, txt) {

	if (confirm(txt + "하시겠습니까?")) {
		$("#typ").val(Arg);
		$("#frm").attr("action", "./room_proc.php?<?php echo $param?>");
		$("#frm").submit();
	}

}


// 관리자 메모 입력
function fnMemoReg() {
	var mem_idx = "<?php echo $mem_idx?>";
	var admin_memo = TrimStr($("#admin_memo").val());

	if(fnChkCommon("admin_memo", "관리자 메모 내용", 1, 1, 0) == "N") {
		return;
	}

	$.ajax({
		type : "post",
		url : "./ajax_admin_memo_proc.php",
		dataType : "text",
		timeout : 86400,
		cache : false,
		data: { "Arg" : "W", "mem_idx" : mem_idx, "admin_memo" : admin_memo },
		success : function(result) {
			fnMemoList();
			$("#admin_memo").val("");
		},
		error : function(request, status, error) {
			console.log("code : " + request.status + " / message : " + request.responseText + " / error : " + error);
		},
	});
}

// 관리자 메모 목록
function fnMemoList() {
	var mem_idx = "<?php echo $mem_idx?>";
	$.ajax({
		type : "post",
		url : "./ajax_admin_memo_proc.php",
		dataType : "text",
		timeout : 86400,
		cache : false,
		data: { "Arg" : "L", "mem_idx" : mem_idx },
		success : function(result) {
			$("#div_memo").empty();
			$("#div_memo").append(result);
		},
		error : function(request, status, error) {
			console.log("code : " + request.status + " / message : " + request.responseText + " / error : " + error);
		},
	});
}

// 관리자 메모 삭제
function fnMemoDel(idx) {
	var mem_idx = "<?php echo $mem_idx?>";
	$.ajax({
		type : "post",
		url : "./ajax_admin_memo_proc.php",
		dataType : "text",
		timeout : 86400,
		cache : false,
		data: { "Arg" : "D", "mem_idx" : mem_idx, "idx" : idx },
		success : function(result) {
			fnMemoList();
		},
		error : function(request, status, error) {
			console.log("code : " + request.status + " / message : " + request.responseText + " / error : " + error);
		},
	});
}

function fnPaging(fnName, page, Arg) {
	if(fnName == "fnTicket") fnGetTicketList(page);
	//if(fnName == "fnService") fnGetServieList(page);
}

//-->
</script>

</div>
<? include $_SERVER["DOCUMENT_ROOT"]."/zbackoffice/include/footer.php"; ?>
</div>