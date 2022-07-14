<?php
session_start();
$session_admin_idx = $_SESSION["ADMIN_IDX"];
$session_admin_id = $_SESSION["ADMIN_ID"];
$session_admin_name = $_SESSION["ADMIN_NAME"];
$session_admin_gubun = $_SESSION["ADMIN_GUBUN"];

if (!$session_admin_idx) {
	Page_Msg_Url("관리자 세션이 끊겼습니다. 다시 로그인 해주세요.", "/zbackoffice/index.php");
	exit;
}

if (substr($mode, 5, 1) == "E") {
	$emode = "E";
}

//관리자권한
$access_prev = get_want("zadmin", "admin_access", " AND admin_idx = '$session_admin_idx'");
?>