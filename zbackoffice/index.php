<?php
include $_SERVER["DOCUMENT_ROOT"] . "/zbackoffice/include/top_index.php";
?>
<style type="text/css">
	body { background:#24292e; }
</style>

<div class="login-wrap-box">
	<div class="login-wrap">
		<p><?=$sitename?></p>
		<b>관리자로그인</b>
		<span>사이트 관리자 로그인 페이지입니다.<br />아이디와 비밀번호를 입력해 주십시오. </span>
		<form name="f" method="post">
		<input type="text" name="adminid" id="adminid" placeholder="아이디" onKeyPress="check_key(check);">
		<input type="password" name="adminpwd" placeholder="비밀번호" onKeyPress="check_key(check); if(event.keyCode==13) check();">
		<!--<div class="terms_chk-login ">
			<input  class="joinchk chk1" id="agree_chk4" type="checkbox"   name="chk2" value="1" id="agree11"><i></i><label for="agree_chk4">자동 로그인
		</div>-->
		<input type="button" value="로그인" onClick="check();">
		</form>
	</div>
	<div class="f-box">Copyrights <?=$sitename?> All rights Reserved.</div>
</div>

<script type="text/javascript">
<!--
$(function() {
	$("#adminid").focus();
});

function check() {
	var f = document.f;
	if(nullchk(f.adminid, "아이디를 입력해 주십시오.") == false) return;
	if(nullchk(f.adminpwd, "비밀번호를 입력해 주십시오.") == false) return;
	
	f.action = "/zbackoffice/login_proc.php";
	f.submit();
}

$("#adminid").keyup(function(e) {
	if (!(e.keyCode >=37 && e.keyCode <= 40)) {
		var v = $(this).val();
		$(this).val(v.replace(/[^a-z0-9_]/gi, ''));
	}
});

function getCookie(cookieName) {
    cookieName = cookieName + '=';
    var cookieData = document.cookie;
    var start = cookieData.indexOf(cookieName);
    var cookieValue = '';
    if(start != -1) {
        start += cookieName.length;
        var end = cookieData.indexOf(';', start);
        if(end == -1)end = cookieData.length;
        cookieValue = cookieData.substring(start, end);
    }
    return unescape(cookieValue);
}

function setCookie(cookieName, value, exdays) {
    var exdate = new Date();
    exdate.setDate(exdate.getDate() + exdays);
    var cookieValue = escape(value) + ((exdays==null) ? "" : "; expires=" + exdate.toGMTString());
    document.cookie = cookieName + "=" + cookieValue;
}

$(function() {
	$("#adminid").keyup(function() {
		var admin_save_id = $("#adminid").val();
		setCookie("admin_save_id", admin_save_id, 30);
    });

	if(getCookie("admin_save_id") != "") {
	    $("#adminid").val(getCookie("admin_save_id"));
	}
});
//-->
</script>