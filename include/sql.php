<?php
//갯수
function QRY_CNT($tbl, $searchand) {
	global $conn;

	$sql = "select count(*) CNT from $tbl where 1 = 1 $searchand";
//	echo "<br />" . $sql ;
	mysqli_query("SET NAMES utf8");
	$result = mysqli_query($conn, $sql) or die ("SQL ERROR_cnt : " . mysqli_error($conn));
	$row = mysqli_fetch_array($result);
	$total = $row['CNT'];
	return $total;
}

Function QRY_LIST($tbl, $cnt, $page, $searchand, $ord) {
	global $conn;

	$startno = ($page - 1) * $cnt;
	if($cnt != "all") {
		$limit = "limit $startno, $cnt";
	}
	$sql = "select * from $tbl where 1 = 1 $searchand order by $ord $limit";
	//echo $sql;
	mysqli_query("SET NAMES utf8");
	$result = mysqli_query($conn, $sql) or die ("SQL ERROR_list : " . mysqli_error($conn));
	return $result;
}

//갯수
function QRY_CNT_ECHO($tbl, $searchand) {
	global $conn;

	$sql = "select count(*) CNT from $tbl where 1 = 1 $searchand";
	echo "<br />" . $sql ;
	mysqli_query("SET NAMES utf8");
	$result = mysqli_query($conn, $sql) or die ("SQL ERROR1 : " . mysqli_error($conn));
	$row = mysqli_fetch_array($result);
	$total = $row['CNT'];
	return $total;
}

//갯수(group by로 묶음경우)
function QRY_CNT_GRP($tbl, $col, $searchand) {
	global $conn;

	$sql = "select count(z.col) cnt from (select $col col from $tbl where 1 = 1 $searchand) z";
	mysqli_query("SET NAMES utf8");
	$result = mysqli_query($conn, $sql) or die ("SQL ERROR1: " . mysqli_error($conn));
	$row = mysqli_fetch_array($result);
	$total = $row['CNT'];
	return $total;
}

//조인테이블 갯수
function QRY_CNT_JOIN($tbl_a, $tbl_b, $_on, $searchand) {
	global $conn;

	$sql = "select count(*) cnt from $tbl_a a inner join $tbl_b b on $_on where 1 = 1 $searchand";
	mysqli_query("SET NAMES utf8");
	$result = mysqli_query($conn, $sql) or die ("SQL ERROR1 : " . mysqli_error($conn));
	$row = mysqli_fetch_array($result);
	$total = $row['CNT'];
	return $total;
}

//총페이지수
Function QRY_TOTALPAGE($cnt, $recordcnt) {
	$total_page = (int)($cnt % $recordcnt);

	if ($total_page != 0) {
		$totalpage = (int)($cnt / $recordcnt) + 1;
	} else {
		$totalpage = (int)($cnt / $recordcnt);
	}
	return $totalpage;
}

Function QRY_LIST_ECHO($tbl, $cnt, $page, $searchand, $ord) {
	global $conn;

	$startno = ($page - 1) * $cnt;
	if($cnt != "all") {
		$limit = "limit $startno, $cnt";
	}
	$sql = "select * from $tbl where 1 = 1 $searchand order by $ord $limit";
	echo $sql;
	mysqli_query("SET NAMES utf8");
	$result = mysqli_query($conn, $sql) or die ("SQL ERROR1 : " . mysqli_error($conn));
	return $result;
}

Function QRY_LIST2($tbl, $cnt, $page, $searchand, $ord) {
	global $conn;

	$startno = ($page - 1) * $cnt;
	if($cnt != "all") {
		$limit = "limit $startno, $cnt";
	}
	$sql = "select a.* from $tbl where 1 = 1 $searchand order by $ord $limit";
	//	echo $sql;
	mysqli_query("SET NAMES utf8");
	$result = mysqli_query($conn, $sql) or die ("SQL ERROR2 : ".mysqli_error($conn));
	return $result;
}

Function QRY_C_LIST($tbl, $c, $cnt, $page, $searchand, $ord) {
	global $conn;

	$startno = ($page - 1) * $cnt;
	if($cnt != "all") {
		$limit = "limit $startno, $cnt";
	}	$sql = "select $c from $tbl where 1 = 1 $searchand order by $ord $limit";
	//	echo $sql;
	mysqli_query("SET NAMES utf8");
	$result = mysqli_query($conn, $sql) or die ("SQL ERROR : " . mysqli_error());
	return $result;
}
Function QRY_C_LIST_ECHO($tbl, $c, $cnt, $page, $searchand, $ord) {
	global $conn;

	$startno = ($page - 1) * $cnt;
	if($cnt != "all") {
		$limit = "limit $startno, $cnt";
	}
	$sql = "select $c from $tbl where 1 = 1 $searchand order by $ord $limit";
	echo $sql;
	//mysqli_query("SET NAMES utf8");
	//$result = mysqli_query($conn, $sql) or die ("SQL ERROR : " . mysqli_error());
	//return $result;
}

Function QRY_C_LIST2($tbl, $c, $cnt, $page, $searchand) {
	global $conn;

	$startno = ($page - 1) * $cnt;
	if($cnt != "all") {
		$limit = "limit $startno, $cnt";
	}
		$sql = "select $c from $tbl where 1 = 1 $searchand $limit";
	//	echo $sql;
	mysqli_query("SET NAMES utf8");
	$result = mysqli_query($conn, $sql) or die ("SQL ERROR : " . mysqli_error());
	return $result;
}

Function QRY_VIEW($tbl, $searchand) {
	global $conn;

	$sql = "select * from $tbl where 1 = 1 $searchand";
//	echo $sql;
	mysqli_query("SET NAMES utf8");
	$result = mysqli_query($conn, $sql) or die ("SQL ERROR : " . mysqli_error());
	return $result;
}

Function QRY_VIEW_ECHO($tbl, $searchand) {
	global $conn;

	$sql = "select * from $tbl where 1 = 1 $searchand";
	echo $sql;
	mysqli_query("SET NAMES utf8");
	$result = mysqli_query($conn, $sql) or die ("SQL ERROR : " . mysqli_error());
	return $result;
}

Function QRY_C_VIEW($tbl, $field, $searchand) {
	global $conn;

	$sql = "select $field from $tbl where 1 = 1 $searchand";
	//echo $sql;
	mysqli_query("SET NAMES utf8");
	$result = mysqli_query($conn, $sql) or die ("SQL ERROR : " . mysqli_error());
	return $result;
}

Function QRY_C_VIEW_ECHO($tbl, $field, $searchand) {
	global $conn;

	$sql = "select $field from $tbl where 1 = 1 $searchand";
	echo $sql;
	mysqli_query("SET NAMES utf8");
	$result = mysqli_query($conn, $sql) or die ("SQL ERROR : " . mysqli_error());
	return $result;
}

Function QRY_DELETE($tbl, $deleteand) {
	global $conn;

	$sql = " delete from $tbl where 1 = 1 $deleteand";
	mysqli_query("SET NAMES utf8");
	$result = mysqli_query($conn, $sql) or die ("SQL ERROR : " . mysqli_error());
}


// Insert 직후 idx 리턴
function QRY_MAX_IDX($tbl, $idx_txt, $searchand) {
	global $conn;

	$sql = "select ifnull(max(" . $idx_txt . "), 0) max_idx from $tbl where 1 = 1 $searchand";
//	echo "<br />" . $sql ;
	mysqli_query("SET NAMES utf8");
	$result = mysqli_query($conn, $sql) or die ("SQL ERROR1 : " . mysqli_error($conn));
	$row = mysqli_fetch_array($result);
	$max_idx = $row['max_idx'];
	return $max_idx;
}

// 202105 / 카테고리, 서브카테고리, 클래스명 텍스트
function QRY_HOMES_TXT($level, $code_val) {
	global $conn;

	$sql = "select ca_name from homes where ca_level = '$level' and code_" . $level . " = '$code_val'";
//	echo "<br />" . $sql ;
	mysqli_query("SET NAMES utf8");
	$result = mysqli_query($conn, $sql) or die ("SQL ERROR1 : " . mysqli_error($conn));
	$row = mysqli_fetch_array($result);
	echo $row['ca_name'];
}


//2021.06.24
Function QRY_LIST_C_GRP($tbl, $field, $cnt, $page, $searchand, $grp, $ord) {
	global $conn;
	$startno = ($page - 1) * $cnt;
	if($cnt != "all") {
		$limit = "limit $startno, $cnt";
	}	$sql = "SELECT $field FROM $tbl WHERE 1 = 1 $searchand GROUP BY $grp ORDER BY $ord $limit";
	//	echo $sql;
	mysqli_query("SET NAMES utf8");
	$result = mysqli_query($conn, $sql) or die ("SQL ERROR : " . mysqli_error());
	return $result;
}

Function QRY_LIST_C_GRP_ECHO($tbl, $field, $cnt, $page, $searchand, $grp, $ord) {
	echo "<br />list";
	global $conn;
	$startno = ($page - 1) * $cnt;
	if($cnt != "all") {
		$limit = "limit $startno, $cnt";
	}	$sql = "SELECT $field FROM $tbl WHERE 1 = 1 $searchand GROUP BY $grp ORDER BY $ord $limit";
	echo "<br />" . $sql ;
	mysqli_query("SET NAMES utf8");
	$result = mysqli_query($conn, $sql) or die ("SQL ERROR : " . mysqli_error());
	return $result;
}

?>