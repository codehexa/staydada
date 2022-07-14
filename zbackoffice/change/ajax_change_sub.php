<?
include $_SERVER["DOCUMENT_ROOT"] . "/include/dbopen.php";
include $_SERVER["DOCUMENT_ROOT"] . "/zbackoffice/include/admin.php";

$typ = replace_in($typ);
$admin_id = replace_in($admin_id);
$admin_pwd = replace_in($admin_pwd);
$admin_pwd = md5($admin_pwd);
$admin_name = replace_in($admin_name);
$admin_mail = replace_in($admin_mail);
$admin_access = replace_in($admin_access);

//admin_gubun, admin_id, admin_pwd, admin_name, admin_mail, admin_access, admin_memo

if($typ == "write") {
	$cnt = QRY_CNT("zadmin", " AND admin_id = '$admin_id'");

	if($cnt > 0) {
		echo "NN";
	} else {
		$sql = "INSERT INTO zadmin SET
			admin_gubun = 'sub',
			admin_id = '$admin_id',
			admin_pwd = '$admin_pwd',
			admin_name = '$admin_name',
			admin_mail = '$admin_mail',
			admin_access = '$admin_access',
			reg_date = now()";
		$result = mysqli_query($conn, $sql) or die ("SQL Error : ". mysqli_error($conn));
	}

} else if ($typ == "edit") {
	$sql = "UPDATE zadmin SET ";
	$sql .= "admin_name = '$admin_name', ";
	$sql .= "admin_mail = '$admin_mail', ";
	$sql .= "admin_access = '$admin_access' ";

	if($admin_pwd != "") $sql .= ", admin_pwd = '$admin_pwd'";
	$sql .= "WHERE admin_id = '$admin_id'";
	$result = mysqli_query($conn, $sql) or die ("SQL Error : ". mysqli_error($conn));

} else if ($typ == "del") {
	$sql = "DELETE FROM zadmin WHERE admin_id = '$admin_id'";
	$result = mysqli_query($conn, $sql) or die ("SQL Error : ". mysqli_error($conn));

} else if ($typ == "view") {
	$result_view = QRY_VIEW("zadmin", " AND admin_id = '$admin_id'");
	$row_view = mysqli_fetch_array($result_view);
	echo $row_view["admin_id"] . "|+|". $row_view["admin_name"] . "|+|". $row_view["admin_mail"] . "|+|". $row_view["admin_access"];

} else if($typ == "list") {
	$result = QRY_LIST("zadmin", "all", "1", " AND admin_gubun = 'sub'", " admin_id");
?>
	<table id="write" class="list">
		<colgroup>
			<col width="10%" />
			<col width="10%" />
			<col width="10%" />
			<col width="*" />
			<col width="20%" />
		</colgroup>
		<tr>
			<th>No.</th>
			<th>아이디</th>
			<th>이름</th>
			<th>권한</th>
			<th>관리</th>
		</tr>
		<?
		$cnt_sub = QRY_CNT("zadmin", " AND admin_gubun = 'sub'");
		if($cnt_sub == 0) echo "<tr><td colspan='5'>데이터가 없습니다.</td></tr>";

		$vi = 1;
		while($row = mysqli_fetch_array($result)) {
			$admin_access = $row["admin_access"];
			$admin_access_txt = str_replace("10", "사이트관리", $admin_access);
			$admin_access_txt = str_replace("20", "회원관리", $admin_access_txt);
			$admin_access_txt = str_replace("30", "홈트관리", $admin_access_txt);
			$admin_access_txt = str_replace("40", "이용권관리", $admin_access_txt);
			$admin_access_txt = str_replace("50", "게시판관리", $admin_access_txt);
			$admin_access_txt = str_replace("60", "통계", $admin_access_txt);
		?>
		<tr>
			<td><?=$vi?></td>
			<td><?=$row["admin_id"]?></td>
			<td><?=$row["admin_name"]?></td>
			<td><?=$admin_access_txt?></td>
			<td>
				<a href="javascript:fnSend2('view', '', '<?=$row["admin_id"]?>');">[수정]</a>&nbsp;
				<a href="javascript:fnSend('del', '삭제', '<?=$row["admin_id"]?>');">[삭제]</a>
			</td>
		</tr>
		<?
			$vi++;
		}
		?>
	</table>
<?
}
?>