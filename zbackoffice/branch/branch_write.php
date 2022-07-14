<?php
include $_SERVER["DOCUMENT_ROOT"] . "/zbackoffice/include/head.php";

/***********************************************************************/
//지점정보 등록,수정
/***********************************************************************/

if($idx) {

	include $_SERVER["DOCUMENT_ROOT"] . "/proc/branch_info_view_row.php";

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
			<input type="hidden" name="typ" id="typ" value="<?php echo $typ?>">
			<input type="hidden" name="mode" value="<?php echo $mode?>">
			<input type="hidden" name="idx" id="idx" value="<?php echo $idx?>">
			<input type="hidden" id="lat" name="lat" value="<?php echo $lat ?>" /><!-- x -->
			<input type="hidden" id="lon" name="lon" value="<?php echo $lon ?>"  /><!-- y -->

		<div class="tit">기본정보</div>
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
					<td class="txt_info"><input type="text" name="bh_name" id="bh_name" value="<?php echo $bh_name?>" class="w340" maxlength="30" /></td>
					<th>주택유형</th>
					<td class="txt_info">
						<select id="hous_type" name="hous_type" class="w120">
							<option value="">주택유형</option>
					<?php
						/*주택유형 코드 START*/
							$result_cd =QRY_LIST("com_code","all","1"," AND gubun='BR001' AND useyn=1 "," sort ASC ");
							while($row_cd = mysqli_fetch_array($result_cd)){
								$code_idx = replace_out($row_cd["idx"]);
								$code_name = replace_out($row_cd["code_name"]);						
					?>
							<option value="<?php echo $code_idx?>" <?php echo ($hous_type==$code_idx)?"selected":""?>><?php echo $code_name ?></option>
					<?php
							}
						/*주택유형 코드 END */
					?>
						</select>
					</td>
				</tr>
				<tr>
					<th>우편번호</th>
					<td colspan="3">
						<input type="text" name="bh_post" id="sample_postcode" value="<?php echo $bh_post?>" maxlength="6" readonly onClick="sample_execDaumPostcode();" class="w200">
						<span class="btn1"><a href="javascript:sample_execDaumPostcode();" class="btn line" id="post_txt">우편번호 검색</a></span>
						<div id="postpop" style="display:none;"></div>
					</td>
				</tr>
				<tr>
					<th>지점주소</th>
					<td colspan="3">
						<input type="text" name="bh_addr1" id="sample_address" value="<?php echo $bh_addr1?>" maxlength="50" readonly style="width:70%">
						<input type="text" name="bh_addr2" id="sample_detailAddress" value="<?php echo $bh_addr2?>" maxlength="50" readonly style="width:70%">
					</td>
				</tr>

				<?php include $_SERVER["DOCUMENT_ROOT"] . "/include/daum_post_geo.php";	?>
				<tr>
					<th>VR링크(3D집구경)</th>
					<td colspan="3"><input type="text" name="vr_link" id="vr_link" value="<?php echo $vr_link?>" maxlength="150" style="width:90%"></td>
				</tr>
				<tr>
					<th>게시여부</th>
					<td colspan="3">
						<input type="radio" id="view_yn1" name="view_yn" value="Y" <?php echo ($view_yn=="" || $view_yn=="Y")?"checked":""?>/><label for="view_yn1">게시</label>
						<input type="radio" id="view_yn2" name="view_yn" value="N" <?php echo ($view_yn=="N")?"checked":""?>/><label for="view_yn2">미게시</label>
					</td>
				</tr>
			</table>
		</div>

		<div class="tit">지점정보</div>
		<div class="main-box">
			<table class="write">
			 <tr>
				<th class="ce" width="20%">층</th>
				<th class="ce" width="20%">세대정보</th>
				<th class="ce" width="20%">연면적</th>
				<th class="ce" width="20%">주차</th>
				<th class="ce" width="20%">관리비</th>
			 </tr>
			 <tr>
				<td class="ce" ><input type="text" id="bh_floor" name="bh_floor" value="<?php echo $bh_floor ?>" class="w220" maxlength="50"/></td>
				<td class="ce" ><input type="text" id="bh_ginfo" name="bh_ginfo" value="<?php echo $bh_ginfo ?>" class="w80" maxlength="10"/>가구</td>
				<td class="ce" ><input type="text" id="bh_total_area" name="bh_total_area" value="<?php echo $bh_total_area ?>" class="w120" maxlength="10"/>㎡</td>
				<td class="ce" >
					<input type="radio" id="parking_yn1" name="parking_yn" value="Y" <?php echo ($parking_yn==""||$parking_yn=="Y")?"checked":""?>/><label for="parking_yn1">가능</label>
					<input type="radio" id="parking_yn2" name="parking_yn" value="N" <?php echo ($parking_yn=="N")?"checked":""?>/><label for="parking_yn2">불가능</label>
				</td>
				<td class="ce" ><input type="text" id="main_cost" name="main_cost" value="<?php echo $main_cost ?>" class="w150" maxlength="10"/>원</td>
			 </tr>
			 <tr>
				<th colspan="5" class="ce" >기타옵션</th>
			 </tr>
			 <tr>
				<td colspan="5"><input type="text" id="etc_option" name="etc_option" value="<?php echo $etc_option ?>" maxlength="100" style="width:95%"/></td>
			 </tr>
				<?php
				//파일 업로드 시작
					$si = 1; $ei = 16;
					for ($i = $si; $i <= $ei; $i++) {
				?>
					<tr>
						<th><?php echo ($i==1)?"썸네일":"상세사진"?><?php echo ($i==1)?"":$i-1 ?></th>
						<td colspan="4" >
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
				<!-- 파일 업로드 끝 -->
			</table>
		</div>

		<div class="tit">지점설명</div>
		<div class="main-box">
			<table class="write">
				<colgroup>
					<col width="10%" />
					<col width="40%" />
				</colgroup>
				<tr>
					<td colspan="2">
						<textarea id="content" name="content" ><?php echo $content ?></textarea>
					</td>
				</tr>
			</table>
		</div>

		<div class="tit">주변대중교통정보</div>
		<div class="main-box">
			<table class="write">
				<colgroup>
					<col width="10%" />
					<col width="40%" />
				</colgroup>
				<tr>
					<td colspan="2">
						<textarea name="trans_info" id="trans_info" style="display:none"></textarea>
						<textarea name="ir1" id="ir1" style="width:98%; height:300px; display:none;"><?php echo $trans_info?></textarea>
					</td>
				</tr>
			</table>
		</div>


		<div class="btn-center">
			<a href="javascript:fnSend();" class="btn"><?php echo ($typ=="write")? "저장":"수정" ?></a>
			<!--<? if($typ == "edit") { ?><a href="javascript:fnDel('del', '삭제');" class="btn line">삭제</a><? } ?>-->
			<a href="branch_list.php?<?php echo $param?><?php echo $addpara?>" class="btn gray">목록</a>
		</div>

		</form>

	</div><!-- class="content" END -->

<iframe id="_hiddenFrm" name="_hiddenFrm" width="0" height="0" frameborder="0" marginheight="0" marginwidth="0" scrolling="yes" style="visible:false;display:none;" title="빈프레임"></iframe>

<script type="text/javascript" src="/zbackoffice/SE__/js/HuskyEZCreator.js" charset="utf-8"></script>

<script type="text/javascript">
<!--

	var imagepath = "<?php echo $se_path?>";
	var hei = "350";
	var oEditors = [];
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: oEditors,
		elPlaceHolder: "ir1",
		sSkinURI: "/zbackoffice/SE__/SmartEditor2Skin.html",
		htParams : {
			bUseToolbar : true,				// 툴바 사용 여부 (true:사용/ false:사용하지 않음)
			bUseVerticalResizer : false,		// 입력창 크기 조절바 사용 여부 (true:사용/ false:사용하지 않음)
			bUseModeChanger : true,		// 모드 탭(Editor | HTML | TEXT) 사용 여부 (true:사용/ false:사용하지 않음)
			aAdditionalFontList : [['Noto Sans KR', 'sans-serif']],
			fOnBeforeUnload : function(){
				//alert("아싸!");
			}
		}, //boolean
		fOnAppLoad : function(){
			//예제 코드
			//oEditors.getById["ir1"].exec("PASTE_HTML", ["로딩이 완료된 후에 본문에 삽입되는 text입니다."]);
			oEditors.getById['ir1'].setDefaultFont("돋움", 12);	
			//oEditors.getById['ir1'].setDefaultFont("Noto Sans KR", 12);	
		},
		fCreator: "createSEditor2"
	});

function fnSend() {
	var f = document.frm;
	var typ = "<?php echo $typ?>";
	var txt = "등록";
	if(typ=="edit"){
		txt = "수정";
	}

    if (nullchk(f.bh_name,"지점명을 입력해 주십시오.")== false) return ;
    if (nullchk(f.hous_type,"주택유형을 선택해 주십시오.")== false) return;
    if (nullchk(f.bh_post,"우편번호를 입력해 주십시오.")== false) return ;
    if (nullchk(f.bh_addr2,"지점주소를 입력해 주십시오.")== false) return ;
    if (nullchk(f.bh_floor,"층을 입력해 주십시오.")== false) return ;
    if (nullchk(f.bh_ginfo,"세대정보를 입력해 주십시오.")== false) return ;
    if (nullchk(f.bh_total_area,"연면적을 입력해 주십시오.")== false) return ;
    if (nullchk(f.main_cost,"관리비를 입력해 주십시오.")== false) return ;
<?php if($typ=="write"):?>
    if (nullchk(f.file1,"사진을 첨부해 주십시오.")== false) return ;
<?php elseif($typ=="edit"):?>
	if($("#file1").val()==false && $("#file_o1").val() == false){
		alert("사진을 첨부해 주십시오.");
		return;
	}
<?php endif;?>
    if (nullchk(f.content,"지점설명을 입력해 주십시오.")== false) return ;

	oEditors.getById["ir1"].exec("UPDATE_CONTENTS_FIELD", []);	//스마트에디터 삽입
	frm.trans_info.value = document.getElementById("ir1").value;		//스마트에디터 삽입


	var lat = $("#lat").val();
	var lon = $("#lon").val();
	console.log('lat='+lat);
	console.log('lon='+lon);

	if (confirm(txt+"하시겠습니까?")) {
		$("#frm").attr("action", "./branch_proc.php?<?php echo $param?>");
		$("#frm").submit();
	}
}


//삭제
function fnDel(Arg, txt) {

	if (confirm(txt + "하시겠습니까?")) {
		$("#typ").val(Arg);
		$("#frm").attr("action", "./branch_proc.php?<?php echo $param?>");
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