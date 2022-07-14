<?
session_start();
include $_SERVER["DOCUMENT_ROOT"]."/zbackoffice/include/header_index.php";

$_SESSION["ADMIN_IDX"] = "";	// id
$_SESSION["ADMIN_ID"] = "";		// id
$_SESSION["ADMIN_NAME"] = "";	// 이름
$_SESSION["ADMIN_GUBUN"] = "";	// 로그인 구분
?>
<script language="JavaScript">
<!--
alert("관리자 페이지를 종료합니다.");
location.href="index.php"
//-->
</script>
