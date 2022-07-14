<?
session_start();

require  $_SERVER["DOCUMENT_ROOT"]."/include/dbopen.php";

$real_id = $_SESSION["ADMIN_ID"];
if(!$chg_pwd) $chg_pwd = $now_pwd;

$sql = "select * from zadmin where admin_id = '$real_id'";
$result = mysqli_query($conn, $sql) or die ("SQL Error : ". mysqli_error($conn));
$row = mysqli_fetch_array($result);
if($row) {
	$real_admin_idx = $row["admin_idx"];
	$real_admin_pwd = $row["admin_pwd"];

	if (md5($now_pwd) != $real_admin_pwd) {
		Page_Parent_Msg_Url("현재 비밀번호를 확인해주세요.", "/zbackoffice/change/change.php?mode=$mode");
	} else {
		$sql = "UPDATE zadmin SET
			admin_pwd = '" . md5($chg_pwd) . "',
			admin_mail = '$mail',
			admin_name = '$name'
			WHERE admin_idx = '$real_admin_idx'
		";
		$result = mysqli_query($conn, $sql) or die ("SQL Error : ". mysqli_error($conn));
		if($result) {
			$_SESSION["ADMIN_ID"] = $id;
			$_SESSION["ADMIN_NAME"] = $name;
			$_SESSION["ADMIN_MAIL"] = $mail;
			Page_Parent_Msg_Url("변경되었습니다.", "/zbackoffice/change/change.php?mode=$mode");
		}
	}
}
?>