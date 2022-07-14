<?
session_start();
$_SESSION["lm"] = "1";

include $_SERVER["DOCUMENT_ROOT"] . "/zbackoffice/include/head.php";

$cnt = QRY_CNT("zadmin", " AND admin_gubun = 'sub' ", " admin_id");
$result = QRY_LIST("zadmin", "all", 1, " AND admin_gubun = 'sub' ", " admin_id");
?>
<div id="contents">
	<div class="tit"><?=$title_text?>
		<div class="path">
			<img src="../img/icon-home.png">
			HOME<img src="../img/arr.png"><?=$menu_text1?><img src="../img/arr.png"><?=$menu_text2?><img src="../img/arr.png"><?=$title_text?>
		</div>
	</div>

	<div class="content">
		<div class="main-box">
			<table id="div_result" class="list">
			</table>
		</div>
	</div>

	<div class="content">
		<div class="main-box">
			<table class="write">
				<colgroup>
					<col width="15%" />
					<col width="*" />
				</colgroup>

				<form name="Form" id="Form" method="post">
					<input type="hidden" name="typ" id="typ">
					<input type="hidden" name="admin_access_sum" id="admin_access_sum">

				<tr>
					<th>아이디</th>
					<td><input type="text" name="admin_id" id="admin_id" class="w340" maxlength="30" /></td>
				</tr>
				<tr>
					<th>이름</th>
					<td><input type="text" name="admin_name" id="admin_name" class="w340" maxlength="30" /></td>
				</tr>
				<tr>
					<th>비밀번호</th>
					<td><input type="password" name="admin_pwd" id="admin_pwd" class="w340" maxlength="30" /></td>
				</tr>
				<tr>
					<th>이메일</th>
					<td><input type="text" name="admin_mail" id="admin_mail" value="@test.com" class="w340" maxlength="100" /></td>
				</tr>
				<tr>
					<th>권한 설정</th>
					<td>
					<?
					$ac_txt = "사이트관리,회원관리,서비스관리,게시판관리,통계";
					$ac_txt_Arr = explode(",", $ac_txt);

					for($ai = 0; $ai < count($ac_txt_Arr); $ai++) {
						$val = ($ai + 1) * 10;
					?>
						<input type="checkbox" name="admin_access" id="admin_access_<?=$ai?>" value="<?=$val?>" onClick="chkVal(this.value);" /><?=$ac_txt_Arr[$ai]?>
					<?
					}
					?>
					</td>
				</tr>

				</form>
			</table>
		</div>

		<div id="btn_write" class="btn-center"><a href="javascript:fnSend('write', '등록', '');" class="btn">등록</a></div>
		<div id="btn_edit" class="btn-center" style="display:none;"><a href="javascript:fnSend('edit', '수정', '');" class="btn">수정</a></div>

	</div>
</div>

<script language="javascript">
<!--
$(function() {
	$("#admin_id").focus();
	$("#typ").val("write");
	fnSend2('list', '', '');
});

function chkVal(Arg) {
	var chk_arr = [];
	$("input[name='admin_access']:checked").each(function() {
		var chk = $(this).val();
		chk_arr.push(chk);
	});

	$("#admin_access_sum").val(chk_arr);
}

function fnSend(typ, typ_txt, admin_id) {
	if(typ == "write" || typ == "edit") {
		var admin_id = TrimStr($("#admin_id").val());
		var admin_name = TrimStr($("#admin_name").val());
		var admin_pwd = TrimStr($("#admin_pwd").val());
		var admin_mail = TrimStr($("#admin_mail").val());
		var admin_access = TrimStr($("#admin_access_sum").val());

		if(fnChkCommon("admin_id", "아이디", "2", "1", 0) == "N") {
			return;
		}

		if(fnChkCommon("admin_name", "이름", "1", "1", 0) == "N") {
			return;
		}

		if(typ == "write" && fnChkCommon("admin_pwd", "비밀번호", "2", "1", 0) == "N") {
			return;
		}

		if(fnChkCommon("admin_mail", "이메일", "1", "1", 0) == "N") {
			return;
		}

		if(fnChkCommon("admin_access_sum", "권한 설정", "1", "2", 0) == "N") {
			return;
		}
	}

	if(confirm(typ_txt + "하시겠습니까?")) {
		$.ajax({
			type : "post",
			url : "./ajax_change_sub.php",
			dataType : "text",
			timeout : 86400,
			cache : false,
			data: { "typ" : typ, "admin_id" : admin_id, "admin_name" : admin_name, "admin_pwd" : admin_pwd, "admin_mail" : admin_mail, "admin_access" : admin_access },
			success : function(result) {
				//console.log(result);

				if(typ == "write" && result == "NN") {
					alert("중복된 아이디입니다.");
					return;
				}

				//if(typ == "write" || typ == "edit") {
					$("#typ").val("write");
					$("#admin_id").val("");
					$("#admin_name").val("");
					$("#admin_pwd").val("");
					$("#admin_mail").val("");
					$("#admin_access_sum").val("");
					for(ai = 0; ai < 6; ai++) {
						$("#admin_access_" + ai).removeAttr("checked");
					}

					$("#admin_id").attr("readonly", false);

					$("#btn_write").show();
					$("#btn_edit").hide();
				//}

				fnSend2('list', '', '');
				$("#admin_id").focus();
			},
			error : function(request, status, error) {
				console.log("code : " + request.status + " / message : " + request.responseText + " / error : " + error);
			},
		});
	}
}

function fnSend2(typ, typ_txt, admin_id) {
	$.ajax({
		type : "post",
		url : "./ajax_change_sub.php",
		dataType : "text",
		timeout : 86400,
		cache : false,
		data: { "typ" : typ, "admin_id" : admin_id },
		success : function(result) {
			//console.log(result);
			if(typ == "view") {
				$("#admin_id").attr("readonly", true);

				$("#btn_write").hide();
				$("#btn_edit").show();

				var result_Arr = result.split("|+|");
				var access = result_Arr[3];

				$("#typ").val("edit");
				$("#admin_id").val(result_Arr[0]);
				$("#admin_name").val(result_Arr[1]);
				$("#admin_mail").val(result_Arr[2]);
				$("#admin_access_sum").val(access);

				$(":checkbox[name=admin_access]").prop("checked", false);

				for(ai = 0; ai < 6; ai++) {
					var val = (ai + 1) * 10;
					var txt = access.indexOf(val);
					if(txt != "-1") {
						$("#admin_access_" + ai).prop("checked", true);
					}
				}
			} else if (typ == "list") {
				$("#div_result").empty();
				$("#div_result").append(result);
			}
		},
		error : function(request, status, error) {
			console.log("code : " + request.status + " / message : " + request.responseText + " / error : " + error);
		},
	});
}
//-->
</script>

<? include $_SERVER["DOCUMENT_ROOT"]."/zbackoffice/include/footer.php"; ?>
</div>