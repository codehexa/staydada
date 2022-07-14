<?php
include $_SERVER["DOCUMENT_ROOT"] . "/zbackoffice/include/head.php";

/**********************************************************/
//약관 등록/수정
/**********************************************************/

$result = QRY_VIEW("board", " AND gubun = '$mode'");
$row = mysqli_fetch_array($result);
if($row) {
	$idx = replace_out($row["idx"]);
	$content = replace_out($row["content"]);
	$view_yn = replace_out($row["view_yn"]);
	$typ = "edit";
} else {
	$typ = "write";
}
?>
<script type="text/javascript" src="/zbackoffice/SE__/js/HuskyEZCreator.js" charset="utf-8"></script>
<script type="text/javascript">
<!--
function check() {
	var f =  document.f;
	oEditors.getById["ir1"].exec("UPDATE_CONTENTS_FIELD", []);	//스마트에디터 삽입
	f.content.value = document.getElementById("ir1").value;			//스마트에디터 삽입
	f.encoding = "multipart/form-data";
	f.action = "/zbackoffice/board/board_proc.php?<?php echo $param?>"
	f.submit();
}
//-->
</script>

<div id="contents">
	<div class="tit"><?php echo $title_text?>
		<div class="path"><img src="../img/icon-home.png">HOME<img src="../img/arr.png"><?php echo $menu_text2?><img src="../img/arr.png"><?php echo $title_text?></div>
	</div>

	<div class="content">
		<div class="main-box">
			<form name="f" method="post">
				<input type="hidden" name="mode" value="<?php echo $mode?>">
				<input type="hidden" name="typ" value="<?php echo $typ?>">
				<input type="hidden" name="idx" value="<?php echo $idx?>">
				<input type="hidden" name="title" value="<?php echo $title_text?>">
				<input type="hidden" name="view_yn" value="<?php echo $view_yn?>">
				<input type="hidden" name="list_url" value="/zbackoffice/board/policy_write.php">

			<table class="write">
				<colgroup>
					<col width="15%" />
					<col width="*" />
				</colgroup>

				<tr>
					<th>제목</th>
					<td><input type="text" name="title" value="<?php echo str_replace(" 관리", "", $title_text)?>" class="w80" readonly /></td>
				</tr>
				<tr>
					<th>내용</th>
					<td>
						<textarea name="content" style="display:none"></textarea>
						<textarea name="ir1" id="ir1" style="width:98%;height:500px;display:none;"><?php echo $content?></textarea>
					</td>
				</tr>

			</table>
			</form>
		</div>
		<div class="btn-center"><a href="javascript:check();" class="btn">확인</a></div>
	</div>

</div>
<? include $_SERVER["DOCUMENT_ROOT"] . "/zbackoffice/include/footer.php"; ?>
</div>

<script language="javascript">
// 이미지업로드 경로
var imagepath = "<?php echo $se_path?>";
var hei = "350"
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
</script>