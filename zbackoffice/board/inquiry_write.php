<?php

include $_SERVER["DOCUMENT_ROOT"] . "/zbackoffice/include/head.php";
include $_SERVER["DOCUMENT_ROOT"] . "/board/board_view_row.php";

if($re_title == "") $re_title = "안녕하세요. 문의하신 내용에 대한 답변입니다.";
?>
<script type="text/javascript" src="/zbackoffice/SE__/js/HuskyEZCreator.js" charset="utf-8"></script>
<script type="text/javascript" src="/include/calendar.js"></script>
<script type="text/javascript">
<!--
function check(){
	var frm = document.Form;

	oEditors.getById["ir1"].exec("UPDATE_CONTENTS_FIELD", []);		//스마트에디터 삽입
	frm.re_content.value = document.getElementById("ir1").value;		//스마트에디터 삽입

//	oEditors.getById["ir2"].exec("UPDATE_CONTENTS_FIELD", []);		//스마트에디터 삽입
//	frm.re_content.value = document.getElementById("ir2").value;		//스마트에디터 삽입	

	if (nullchk(frm.re_title, "제목을 입력하세요.") == false) return;

	frm.encoding = "multipart/form-data";
	frm.action = "./board_proc.php?<?=$param?>";
	frm.submit();
}

function del() {
	var frm = document.From;
	if (confirm("삭제하시겠습니까?")) {
		frm.typ.value = "del";
		frm.action = "./board_proc.php?<?=$param?>";
		frm.submit();
	}
}
//-->
</script>

<div id="contents">
	<div class="tit"><?=$title_text?>
		<div class="path">
			<img src="../img/icon-home.png">
			HOME<img src="../img/arr.png"><?=$menu_text1?><img src="../img/arr.png"><?=$menu_text2?><img src="../img/arr.png"><?=$title_text?>
		</div>
	</div>

	<div class="content">
		<div class="main-box">
			<form name="Form" id="Form" method="post">
				<input type="hidden" name="mode" value="<?=$mode?>">
				<input type="hidden" name="typ" value="<?=$typ?>">
				<input type="hidden" name="idx" value="<?=$idx?>">
				<input type="hidden" name="filecnt" value="5">
				<input type="hidden" name="temp_file" title="단수이미지 삭제">
				<input type="hidden" name="path" value="<?=$file_path?>" title="이미지 삭제 경로">
				<input type="hidden" name="list_url" value="/zbackoffice/board/board_list.php">

				<input type="hidden" name="title" id="title" value="<?=$title?>" />
				<input type="hidden" name="content" id="content" value="<?=$content?>" />				
				<input type="hidden" name="to_id" id="to_id" value="<?=$mem_id?>" />
				<input type="hidden" name="to_name" id="to_name" value="<?=$name?>" />
				<input type="hidden" name="to_email" id="to_email" value="<?=$email1?>@<?=$email2?>" />
				<input type="hidden" name="from_id" id="from_id" value="<?=$session_admin_id?>" />
				<input type="hidden" name="from_email" id="from_email" value="admin@refit.com" />

			<table class="write">
				<colgroup>
					<col width="15%" />
					<col width="*" />
				</colgroup>

				<tr>
					<th>작성자</th>
					<td><?=$name?></td>
				</tr>
				<tr>
					<th>휴대전화번호</th>
					<td><?=$hp?></td>
				</tr>
				<tr>
					<th>이메일</th>
					<td><?=$email1?>@<?=$email2?></td>
				</tr>
				<tr>
					<th>내용</th>
					<td><?=$content?></td>
				</tr>
				<tr>
					<th>답변 작성자</th>
					<td><input type="text" name="from_name" id="from_name" class="w340" value="<?=$session_admin_name?>" maxlength="50" readonly /></td>
					
				</tr>
				<tr>
					<th>답변 제목</th>
					<td><input type="text" name="re_title" class="w80" value="<?=$re_title?>" maxlength="150"></td>
				</tr>

				<!-- 파일 업로드 시작 -->
				<?
				if($mode != "AA004") {		// 우선 문의사항 답변에서 파일 첨부 없는 걸로
				$si = 1;
				$ei = 1;
				for ($i = $si; $i <= $ei; $i++) {
					if($idx) {
						if($row["file" . $i]) {
					?>
					<tr>
						<th>첨부파일_<?=$i?></th>
						<td>
							<?
							$file_full_path = "http://" . $_SERVER["HTTP_HOST"] . $file_path . $row["file" . $i];
							$file_kind = pathinfo($file_full_path, PATHINFO_EXTENSION);
							if($file_kind == "gif" or $file_kind == "jpeg" or $file_kind == "jpg" or $file_kind == "png") {
							?>
							<img src="<?=$file_path?><?=$row["file" . $i]?>" onLoad="img_resize('img<?=$i?>', '300', '800')" id="img<?=$i?>" onClick="img_popup('<?=$file_path?><?=$row["file" . $i]?>');"><br>
							<? } ?>
							<a href="javascript:down('filename=<?=$row["file" . $i]?>&filereal=<?=$row["file_real" . $i]?>&path=<?=$file_path?>&mode=<?=$mode?>&idx=<?=$idx?>&num=<?=$i?>');" ><?=$row["file_real" . $i]?></a><!--target="_new"-->
							&nbsp;&nbsp;<input type="button" value="이미지 삭제" style="cursor:pointer;" onClick="img_del('<?=$idx?>', '<?=$row["file" . $i]?>', '<?=$i?>');">

							<input type="hidden" name="file_o<?=$i?>" value="<?=$row["file" . $i]?>">
							<input type="hidden" name="file_o_real<?=$i?>" value="<?=$row["file_real" . $i]?>">
						</td>
					</tr>
						<? } ?>
					<? } ?>
					<tr>
						<th>첨부파일_<?=$i?></th>
						<td><input name="file<?=$i?>" type="file" class="w340">
						<? if ($i == 1) { ?><br />※ 갤러리/이벤트 형태 게시판의 경우 첫번째 첨부이미지가 리스트이미지가 됩니다.<? } ?>
						</td>
					</tr>
				<?
					}
				}
				?>
				<!-- 파일 업로드 끝 -->

				<tr>
					<th>답변</th>
					<td>
						<textarea name="re_content" style="display:none"></textarea>
						<textarea name="ir1" id="ir1" style="width:98%;height:300px;display:none;"><?=$re_content?></textarea>
					</td>
				</tr>
			</table>
			</form>
		</div>

		<?
		$cnt_reply = QRY_CNT("email_history", " and board_idx = '$idx'");
		?>
		<div class="btn-center">
			<!--<? if($cnt_reply == 0) { ?><a href="javascript:check();" class="btn">답변 등록</a><? } ?>-->
			<? if(!$re_content) { ?><a href="javascript:check();" class="btn">답변 등록</a><? } ?>		
			<a href="./board_list.php?<?=$param?>" class="btn gray">목록</a>
		</div>
	</div>
</div>

<? include $_SERVER["DOCUMENT_ROOT"] . "/zbackoffice/include/footer.php"; ?>
</div>

<script language="javascript">
// 이미지업로드 경로
var imagepath = "<?=$se_path?>";
var hei = "350";
var oEditors = [];
nhn.husky.EZCreator.createInIFrame({
	oAppRef: oEditors,
	elPlaceHolder: "ir1",
	sSkinURI: "/zbackoffice/SE__/SmartEditor2Skin.html",
	htParams : {
		bUseToolbar : true,				// 툴바 사용 여부 (true:사용/ false:사용하지 않음)
		bUseVerticalResizer : false,		// 입력창 크기 조절바 사용 여부 (true:사용/ false:사용하지 않음)
		bUseModeChanger : true,			// 모드 탭(Editor | HTML | TEXT) 사용 여부 (true:사용/ false:사용하지 않음)
		fOnBeforeUnload : function(){
			//alert("아싸!");
		}
	}, //boolean
	fOnAppLoad : function(){
		//예제 코드
		//oEditors.getById["ir1"].exec("PASTE_HTML", ["로딩이 완료된 후에 본문에 삽입되는 text입니다."]);
	},
	fCreator: "createSEditor"
});
</script>