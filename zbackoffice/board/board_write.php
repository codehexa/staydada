<?php
include $_SERVER["DOCUMENT_ROOT"] . "/zbackoffice/include/head.php";
include $_SERVER["DOCUMENT_ROOT"] . "/proc/board_view_row.php";

if($mode == "AA004") {
	header("Location: /zbackoffice/board/inquiry_write.php?" . $param . "&idx=" . $idx);
	exit;
}
?>
<script type="text/javascript" src="/zbackoffice/SE__/js/HuskyEZCreator.js" charset="utf-8"></script>

<div id="contents">
	<div class="tit"><?php echo $title_text?>
		<div class="path"><img src="../img/icon-home.png">HOME<img src="../img/arr.png"><?php echo $menu_text2?><img src="../img/arr.png"><?php echo $title_text?></div>
	</div>

	<div class="content">
		<div class="main-box">
			<form name="Form" id="Form" method="post" encType="multipart/form-data" action="./board_proc.php?<?php echo $param?>">
				<input type="hidden" name="mode" value="<?php echo $mode?>">
				<input type="hidden" name="typ" id="typ" value="<?php echo $typ?>">
				<input type="hidden" name="idx" value="<?php echo $idx?>">
				<input type="hidden" name="filecnt" value="5">
				<input type="hidden" name="temp_file" title="단수이미지 삭제">
				<input type="hidden" name="path" value="<?php echo $file_path?>" title="이미지 삭제 경로">
				<input type="hidden" name="list_url" value="/zbackoffice/board/board_list.php">

			<table class="write">
				<colgroup>
					<col width="12%" />
					<col width="*" />
					<col width="12%" />
					<col width="*" />
				</colgroup>
				<?php if($mode == "AA001") : ?>
				<tr>
					<th>공지여부</th>
					<td colspan="3"><input type="checkbox" name="notice" id="notice" value="Y"<? if($notice == "Y") echo " checked"; ?> /> 공지</td>
				</tr>
				<tr>
					<th>제목</th>
					<td colspan="3">
						<input type="text" name="title" id="title" value="<?php echo $title?>" maxlength="125" />
					</td>
				</tr>
				<tr>
					<th>노출상태</th>
					<td colspan="3">
						<select name="view_yn" id="view_yn" class="w120">
							<option value="Y"<? if($view_yn == "Y") echo " selected"; ?>>노출</option>
							<option value="N"<? if($view_yn == "N") echo " selected"; ?>>미노출</option>
						</select>
					</td>
				</tr>
				<?php endif;  ?>
				<?php
				//파일 업로드 시작
				if($mode == "TK001" || $mode=="TK002") {
					$si = 1; $ei = 1;
					for ($i = $si; $i <= $ei; $i++) {
						if($idx) {
							if(${"file" . $i}) {
				?>
					<tr id="tr_<?php echo $i?>">
						<th>썸네일></th>
						<td colspan="3" class="txt_info">
							<div style="float:left; width:150px;">
								<?
								$file_full_path = "http://" . $_SERVER["HTTP_HOST"] . $file_path . ${"file" . $i};
								$file_kind = pathinfo($file_full_path, PATHINFO_EXTENSION);
								if($file_kind == "gif" or $file_kind == "jpeg" or $file_kind == "jpg" or $file_kind == "png") {
								?>
								<img src="<?php echo $file_path2.${"file" . $i}?>" id="img<?php echo $i?>" style="width:110px;" onClick="img_popup('<?php echo $file_path?><?php echo ${"file" . $i}?>');">
								<? } ?>
							</div>
							<div style="float:left; width:64%;">
								<div><a href="javascript:down('filename=<?php echo ${"file" . $i}?>&filereal=<?php echo $row["file_real" . $i]?>&path=<?php echo $file_path?>&mode=<?php echo $mode?>&idx=<?php echo $idx?>&num=<?php echo $i?>');" ><?php echo $row["file_real" . $i]?></a>&nbsp;<img src="/zbackoffice/img/btn_x.png" style="cursor:pointer;" onClick="img_delete('<?php echo $tbl ?>', '<?php echo $idx?>', '<?php echo $i?>', '<?php echo $i?>');"></div>
							</div>
							<input type="hidden" name="file_o<?php echo $i?>" id="file_o<?php echo $i?>" value="<?php echo ${"file" . $i}?>">
							<input type="hidden" name="file_o_real<?php echo $i?>" id="file_o_real<?php echo $i?>" value="<?php echo $row["file_real" . $i]?>">
						</td>
					</tr>
					<?
							}
						}
					?>
					<tr>
						<th>썸네일<?php //echo $i?></th>
						<td><input type="file" name="file<?php echo $i?>" id="file<?php echo $i?>" class="w340" accept=".jpg, .jpeg, .png">
						</td>
					</tr>
				<?php
					}
				}
				?>
				<!-- 파일 업로드 끝 -->
			<?php if($mode=="CC001"){?>
				<tr>
					<th>등록일</th>
					<td colspan="3"><?php echo $reg_date ?></td>
				</tr>
				<tr>
					<th>문의자</th>
					<td><?php echo $name ?></td>
					<th>휴대폰번호</th>
					<td><?php echo hyphen_hp_number($hp) ?></td>
				</tr>
				<tr>
					<th>이메일</th>
					<td colspan="3"><?php echo $email ?></td>
				</tr>
				<tr>
					<th>지점</th>
					<td><?php echo $etc1 ?></td>
					<th>호실</th>
					<td><?php echo $etc2 ?></td>
				</tr>
				<tr>
					<th>희망입주시기</th>
					<td colspan="3"><?php echo $etc3 ?></td>
				</tr>
				<tr>
					<th>문의 내용</th>
					<td colspan="3">
						<?php echo $content ?>
					</td>
				</tr>
				<tr>
					<th>답변 내용</th>
					<td colspan="3" >
						<!--<textarea name="re_content" id="re_content" style="display:none"></textarea>
						<textarea name="ir1" id="ir1" style="width:98%; height:300px; display:none;"><?php echo $re_content?></textarea>-->
						<textarea name="re_content" id="re_content"><?php echo $re_content ?></textarea>
					</td>
				</tr>
				<? } else if($mode != "TK001") { ?>
				<tr>
					<th>내용</th>
					<td colspan="3" >
						<textarea name="content" id="content" style="display:none"></textarea>
						<textarea name="ir1" id="ir1" style="width:98%; height:300px; display:none;"><?php echo $content?></textarea>
					</td>
				</tr>
				<? } ?>
			</table>
			</form>
		</div>
		<div class="btn-center">
			<a href="./board_list.php?<?php echo $param?>" class="btn gray">목록</a>
		<?php 
			if($mode == "CC001") { 
				$txt_btn = ($re_content) ? "답변수정" : "답변저장";
			}else{
				$txt_btn = ($typ=="write") ? "저장" : "수정";
			}
		?>
			<a href="javascript:fnSend();" class="btn"><?php echo $txt_btn ?></a>
		<?php if($idx) { ?>
			<!--<a href="javascript:del();" class="btn line">삭제</a>-->
		<?php } ?>
		</div>

<?php if($mode=="AA009") : ?>
		<div class="tit">댓글관리</div>
		<div class="main-box">
			<div id="div_comment_list"></div>
		</div>
<?php endif; ?>
	</div>
</div>

<? include $_SERVER["DOCUMENT_ROOT"] . "/zbackoffice/include/footer.php"; ?>
</div>

<script language="javascript">
<!--
$(function() {
	//$("#title").focus();
	//fnGetCommentList(1);
});
/*
function fnGetCommentList(page){
	var idx = "<?php echo $idx?>";
	$.ajax({
		type: "POST",
		url: "/zbackoffice/include/ajax_comment_list.php",
		data: { "gubun":"COMMUNITY", "gubun_idx" : idx, "page" : page },
		dataType : "html",
		async : false ,
		success: function(result){
			if(result){
				$("#div_comment_list").empty();
				$("div_comment_list").append(result);
			}else{
			}
		}
	});
}
*/

function fnPaging(fnName, page, Arg) {
	if(fnName == "fnComment") fnGetCommentList(page);
}

function fnSend() {
	var frm = document.Form;

	<?php if($mode=="CC001"):?>
		if (nullchk(frm.re_content,"답변내용을 입력해 주십시오.")== false) return ;
		frm.typ.value = "consult_reply";
	<?php endif; ?>

		<?php if($mode == "AA001"):?>
		oEditors.getById["ir1"].exec("UPDATE_CONTENTS_FIELD", []);	//스마트에디터 삽입
		frm.content.value = document.getElementById("ir1").value;		//스마트에디터 삽입
		<?php endif; ?>


	if(confirm("저장하시겠습니까?")) $("#Form").submit();
}

function del() {
	var frm = document.Form;
	if (confirm("삭제하시겠습니까?")) {
		frm.typ.value = "del";
		frm.action = "./board_proc.php?<?php echo $param?>";
		frm.submit();
	}
}

<?php 
if($mode =="CC001" || $mode=="CC002"){
}else{	
?>

	// 이미지업로드 경로
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
			fOnBeforeUnload : function(){
				//alert("아싸!");
			}
		}, //boolean
		fOnAppLoad : function(){
			//예제 코드
			//oEditors.getById["ir1"].exec("PASTE_HTML", ["로딩이 완료된 후에 본문에 삽입되는 text입니다."]);
		},
		fCreator: "createSEditor2"
	});
<?php
}	
?>
//-->
</script>