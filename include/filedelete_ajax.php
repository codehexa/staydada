<?php
include $_SERVER["DOCUMENT_ROOT"] . "/include/dbopen.php";

$table = replace_in($table);

if($table == "member") { //회원 첨부파일

	$result = QRY_VIEW($table, " AND mem_idx = '$idx'");
	$row = mysqli_fetch_array($result);
//	$mem_idx = $row["mem_idx"];
	$mem_file1 = $row["file1"];
	if($mem_file1) { unlink("$DOCUMENT_ROOT/$file_path/$mem_file1"); unlink("$DOCUMENT_ROOT/$file_path2/$mem_file1");}

	$sql = "UPDATE $table SET file1 = '', file_real1 = '' WHERE mem_idx = $idx";
	echo $sql."<br>";
	$result = mysqli_query($conn, $sql) or die ("SQL Error : ". mysqli_error($conn));

} else if($table == "branch_info" || $table == "room_info" || $table == "board") { //지점관리,호실관리, 커뮤니티

	$result = QRY_VIEW($table, " AND idx = '$idx'");
	$row = mysqli_fetch_array($result);
	$file1 = $row["file1"];
	$file2 = $row["file2"];
	$file3 = $row["file3"];
	$file4 = $row["file4"];
	$file5 = $row["file5"];
	if($num=="1"){
		if($file1) { unlink("$DOCUMENT_ROOT/$file_path/$file1"); unlink("$DOCUMENT_ROOT/$file_path2/$file1");}
		$add_query = "file1='', file_real1='' ";
	}else if($num=="2"){
		if($file2) { unlink("$DOCUMENT_ROOT/$file_path/$file2"); unlink("$DOCUMENT_ROOT/$file_path2/$file2");}
		$add_query = "file2='', file_real2='' ";
	}else if($num=="3"){
		if($file3) { unlink("$DOCUMENT_ROOT/$file_path/$file2"); unlink("$DOCUMENT_ROOT/$file_path2/$file3");}
		$add_query = "file3='', file_real3='' ";
	}else if($num=="4"){
		if($file4) { unlink("$DOCUMENT_ROOT/$file_path/$file2"); unlink("$DOCUMENT_ROOT/$file_path2/$file4");}
		$add_query = "file4='', file_real4='' ";
	}else if($num=="5"){
		if($file5) { unlink("$DOCUMENT_ROOT/$file_path/$file2"); unlink("$DOCUMENT_ROOT/$file_path2/$file5");}
		$add_query = "file5='', file_real5='' ";
	}

	$sql = "UPDATE $table SET $add_query WHERE idx = $idx";
	$result = mysqli_query($conn, $sql) or die ("SQL Error : ". mysqli_error($conn));

}
?>