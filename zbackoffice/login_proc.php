<?php
include  $_SERVER["DOCUMENT_ROOT"] . "/include/dbopen.php";

$id = $adminid;
$pwd = md5($adminpwd);
$gubun = $admin_gubun;

//로그인처리
$sql = "SELECT * FROM zadmin WHERE admin_id = '$id'";
$result = mysqli_query($conn, $sql) or die ("SQL Error : ". mysqli_error());
$row = mysqli_fetch_array($result);

$real_admin_idx = $row["admin_idx"];
$real_admin_id = $row["admin_id"];
$real_admin_pwd = $row["admin_pwd"];
$real_admin_name = $row["admin_name"];
$real_admin_gubun = $row["admin_gubun"];
$real_admin_mail = $row["admin_mail"];

if($real_admin_pwd == $pwd) {

	// 쿠키 생성
	$_SESSION["ADMIN_IDX"] = $real_admin_idx;
	$_SESSION["ADMIN_ID"] = $real_admin_id;
	$_SESSION["ADMIN_NAME"] =	$real_admin_name;
	$_SESSION["ADMIN_GUBUN"] = $real_admin_gubun;
	$_SESSION["ADMIN_MAIL"] = $real_admin_mail;


//	$sql_login = "insert into admin_login_history (mem_id, login_ip, login_date, mem_page, mem_agent) values ('" . $real_admin_id . "', '" . $log_ip . "', now(), '" . $_SERVER["REQUEST_URI"] . "', '" . $mobile_os . "')";
//	$result_login = $conn->query($sql_login);

	$sql_up = "UPDATE zadmin SET login_count = login_count + 1, login_date = now() WHERE admin_id = '" . $real_admin_id . "'";
	$result_up = $conn->query($sql_up);

	if ($_SESSION["ADMIN_IDX"]) {
		//부운영자 있는 경우
		$A_IDX = $_SESSION["ADMIN_IDX"];
		$access_prev = get_want("zadmin", "admin_access", " AND admin_idx = '$A_IDX'");
		$access_prev_split = explode(",", $access_prev);
		$access_prev_split[0];
		if($access_prev_split[0] == "1") {
			$go = "/zbackoffice/member/member_list.php?mode=MM001";
		//} else if($access_prev_split[0] == "2") {
		//	$go="/zbackoffice/member/cate_list.php?mode=CM001";
		} else {
			$go="/zbackoffice/member/member_list.php?mode=MM001";
		}
		$go = "/zbackoffice/change/change.php?mode=SE001";
		Page_Parent_Url($go);
	}
} else {
	Page_Msg_Url("아이디와 비밀번호를 정확하게 입력해 주십시오.", "/zbackoffice/");
}
?>