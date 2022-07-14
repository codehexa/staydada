<?
include $_SERVER["DOCUMENT_ROOT"] . "/zbackoffice/include/head.php";

$result = QRY_VIEW("zadmin", " AND admin_idx = '$session_admin_idx'");
$row = mysqli_fetch_array($result);
$admin_gubun = replace_out($row["admin_gubun"]);
$admin_id = replace_out($row["admin_id"]);
$admin_name = replace_out($row["admin_name"]);
$admin_pwd = replace_out($row["admin_pwd"]);
$admin_mail = replace_out($row["admin_mail"]);
?>

<div id="contents">
	<div class="tit"><?php echo $title_text?>
		<div class="path">
			<img src="../img/icon-home.png">
			HOME<img src="../img/arr.png"><?php echo $menu_text2?><img src="../img/arr.png"><?php echo $title_text?>
		</div>
	</div>

	<div class="content">
		<div class="main-box">
			<form name="Form" id="Form" method="post">
				<input type="hidden" name="mode" value="<?php echo $mode?>">

			<table class="write">
				<colgroup>
					<col width="15%" />
					<col width="*" />
				</colgroup>

				<tr>
					<th>아이디</th>
					<td><?php echo $admin_id?><input type="hidden" name="id" id="id" value="<?php echo $admin_id?>" class="w340" maxlength="10"></td>
				</tr>
				<tr>
					<th>이름</th>
					<td><input type="text" name="name" id="name" value="<?php echo $admin_name?>" class="w340" maxlength="30"></td>
				</tr>
				<tr>
					<th>이메일</th>
					<td><input type="text" name="mail" id="mail" value="<?php echo $admin_mail?>" class="w340" maxlength="50"></td>
				</tr>
				<tr>
					<th>현재비밀번호</th>
					<td><input type="password" name="now_pwd" id="now_pwd" class="w340" maxlength="50"></td>
				</tr>
				<tr>
					<th>변경비밀번호</th>
					<td><input type="password" name="chg_pwd" id="chg_pwd" class="w340" maxlength="50"></td>
				</tr>
				<tr>
					<th>변경비밀번호 확인</th>
					<td><input type="password" name="chg_pwd2" id="chg_pwd2" class="w340" maxlength="50"></td>
				</tr>
			</table>
			</form>
		</div>
		<div class="btn-center"><a href="javascript:fnSend();" class="btn">저장</a></div>
	</div>
</div>

<script type="text/javascript">
<!--
function fnSend() {
	if(fnChkCommon("id", "아이디", "2", "1", 0) == "N") {
		return;
	}

	if(fnChkCommon("name", "이름", "1", "1", 0) == "N") {
		return;
	}

//	if(fnChkCommon("mail", "이메일", "1", "1", 0) == "N") {
//		return;
//	}

	if(fnChkCommon("now_pwd", "현재 비밀번호", "2", "1", 0) == "N") {
		return;
	}

	if(TrimStr($("#chg_pwd").val()) != "") {
		if(fnChkCommon("chg_pwd2", "변경 비밀번호 확인", "1", "1", 0) == "N") {
			return;
		}

		if(TrimStr($("#chg_pwd").val()) != TrimStr($("#chg_pwd2").val())) {
			alert("변경 비밀번호가 일치하지 않습니다.");
			$("#chg_pwd2").focus();
			return;
		}
	}

	$("#Form").attr("action", "./change_proc.php");
	$("#Form").submit();
}
//-->
</script>

<? include $_SERVER["DOCUMENT_ROOT"] . "/zbackoffice/include/footer.php";  ?>
</div>