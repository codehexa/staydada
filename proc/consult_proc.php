<?php
include $_SERVER["DOCUMENT_ROOT"] . "/include/dbopen.php"; 

/*************************************************************/
//입주,프렌차이즈상담 신청관련 
/*************************************************************/

/*echo "<pre>";
print_r($_REQUEST);
echo "</pre>";*/

$mode = replace_in($mode);
$prev_url = replace_in($prev_url);
$name = replace_in($name);
$hp = replace_in($hp);
$email = replace_in($email);
$etc1 = replace_in($etc1);	//입주상담 - 지점, 프렌차이즈 - 물건주소
$etc2 = replace_in($etc2);	//입주상담 - 호실, 프렌차이즈 - 세대수 
$etc3 = replace_in($etc3);	//입주상담 - 희망입주시기 
$agree = replace_in($agree);	//프렌차이즈 - 개인정보동의값(Y)
$content = replace_in($content);
//$content = str_replace("\r\n", "<br>", $content);

if(!$prev_url) $prev_url = "/";

if ( $_SERVER['REQUEST_METHOD'] != "POST" ){
	Page_Msg_Url("잘못된 접근입니다.", $prev_url );
}


if(strpos($_SERVER['HTTP_REFERER'], "apply_movein.php") === false){
	$chkurl = "N";
}else{
	$chkurl = "Y";
	$list_url = "/apply/apply_movein.php";
}

if(strpos($_SERVER['HTTP_REFERER'], "franchise_inquire.php") === false){
	$chkurl2 = "N";
}else{
	$chkurl2 = "Y";
	$list_url = "/main/franchise_inquire.php";
}

/*
if($chkurl=="Y" || $$chkurl2 == "Y"){
}else{
	Page_Msg_Url("잘못된 접근입니다.", $prev_url );
}*/


/******** 입주상담신청 등록 ********************/
if($typ=="rescon_write"){
	
	$title = "입주상담신청";

	$sql = "INSERT INTO board SET 
		gubun = '$mode'
		,name = '$name'
		,hp = '$hp'
		,email = '$email'
		,etc1 = '$etc1'
		,etc2 = '$etc2'
		,etc3 = '$etc3'
		,title = '$title'
		,content = '$content'
		,state = 'N'
		,reg_ip = '$log_ip'	
		,reg_date = '$log_date'
	"; 
	//echo $sql."<br/>";
	$result = mysqli_query($conn, $sql) or die ("SQL Error : ". mysqli_error($conn));
	if($result) Page_Msg_Url("등록되었습니다.", $list_url);
}
/******** 입주상담신청 등록 END ********************/

/******** 프렌차이즈상담 등록 ********************/
if($typ=="francon_write"){

	$title = "프렌차이즈상담신청";

	$sql = "INSERT INTO board SET 
		gubun = '$mode'
		,name = '$name'
		,hp = '$hp'
		,email = '$email'
		,etc1 = '$etc1'
		,etc2 = '$etc2'
		,etc3 = '$agree'
		,title = '$title'
		,state = 'N'
		,reg_ip = '$log_ip'	
		,reg_date = '$log_date'
	"; 
	//echo $sql."<br/>";
	$result = mysqli_query($conn, $sql) or die ("SQL Error : ". mysqli_error($conn));
	if($result) Page_Msg_Url("등록되었습니다.", $list_url);
}
/******** 프렌차이즈상담 등록 END ********************/

?>