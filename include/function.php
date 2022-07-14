<?
//경고창
function Page_Msg_Back($msg) {
	echo "<script language='javascript'>
			alert(\"$msg\");
		    history.back();
		</script>";
}

function alert_close($msg) {
	echo "<script language='javascript'>
			alert(\"$msg\");
			self.close();
		</script>";
}

function Page_Msg($msg) {
	echo "<script language='javascript'>
			alert(\"$msg\");
		</script>";
}

function Page_Url($url) {
	echo "<script language='javascript'>
			location.href='$url'
		</script>";
}

function Page_Parent_Url($url) {
	echo "<script language='javascript'>
			parent.location.href='$url'
		</script>";
}

function Page_Opener_Url($url) {
	echo "<script language='javascript'>
			opener.location.href='$url';
			self.close();
		</script>";
}

function Page_Parent_Msg_Url($msg,$url) {
	echo "<script language='javascript'>
			alert(\"$msg\");
			parent.location.href='$url'
		</script>";
}

function Page_Parent_Msg_Reload($msg) {
	echo "<script language='javascript'>
			alert(\"$msg\");
			parent.location.reload();
		</script>";
}

function Page_Msg_Url($msg,$url) {
	echo "<script language='javascript'>
			alert(\"$msg\");
			location.href='$url'
		</script>";
}

function Page_Msg_Close($msg) {
	echo "<script language='javascript'>
			alert(\"$msg\");
			self.close();
		</script>";
}

function Page_Parent_reload() {
	echo "<script language='javascript'>
			parent.location.reload();
		</script>";
}

function Page_Url_Confirm_Parent($msg,$url) {
	echo "<script language='javascript'>
			if(confirm(\"$msg\")==true) {
				parent.location.href = '$url';
			}
		</script>";
}

function Page_Url_Confirm_Parent2($msg,$url1,$url2) {
	echo "<script language='javascript'>
			if(confirm('$msg')==true) {
				parent.location.href = '$url1';
			}else{
				parent.location.href = '$url2';
			}
		</script>";
}


// 랜덤 문자키 생성 START
function fnRandKey() {
	$len = 10;
	$chars = "1234567890";

	srand((double)microtime() * 1000000);

	$ki = 0;
	$str = "";

	while ($ki < $len) {
		$num = rand() % strlen($chars);
		$tmp = substr($chars, $num, 1);
		$str .= $tmp;
		$ki++;
	}

	$str = preg_replace('/([0-9A-Z]{4})([0-9A-Z]{4})([0-9A-Z]{4})([0-9A-Z]{4})/', '\1-\2-\3-\4', $str);
	return $str;
}

function fnReplace($chg, $Arg) {
	return str_replace("-", $chg, $Arg);
}

// 회원구분
function fnMemGbn($mem_gbn) {
	if($mem_gbn == "member") {
		$mem_gbn_txt = "일반";
	} else if($mem_gbn == "pause") {
		$mem_gbn_txt = "활동 중지";
	} else if($mem_gbn == "out") {
		$mem_gbn_txt = "탈퇴";
	}
	return $mem_gbn_txt;
}

// 회원정보
function fnMemInfo($column, $mem_idx) {
	$searchand = "and mem_idx = '$mem_idx'";
	$result_m = QRY_C_VIEW("member", $column, $searchand);
	$row_m = mysqli_fetch_array($result_m);
	return $row_m[$column];
}

function fnBadge($num) {
	if($num > 0) {
		return "+" . $num;
	} else {
		return "" . $num;
	}
}

Function fnSearchSel($search) {
	$fnSearchSel = "<select name='search' id='search' style='width:120px;'>\n";

	if($search == "mem_id") $fnSearchSel .= "<option value='mem_id' selected"; else $fnSearchSel .= "<option value='mem_id'";
	$fnSearchSel .= ">아이디</option>\n";

	if($search == "mem_hp") $fnSearchSel .= "<option value='mem_hp' selected"; else $fnSearchSel .= "<option value='mem_hp'";
	$fnSearchSel .= ">휴대폰</option>\n";

	if($search == "mem_name") $fnSearchSel .= "<option value='mem_name' selected"; else $fnSearchSel .= "<option value='mem_name'";
	$fnSearchSel .= ">이름</option>\n";

	if($search == "mem_nickname") $fnSearchSel .= "<option value='mem_nickname' selected"; else $fnSearchSel .= "<option value='mem_nickname'";
	$fnSearchSel .= ">닉네임</option>\n";

	$fnSearchSel .= "</select>\n";
	return $fnSearchSel;
}

Function fnSearchSel2($search) {
	$fnSearchSel = "<select name='search' id='search' style='width:120px;'>\n";

	if($search == "M.mem_id") $fnSearchSel .= "<option value='M.mem_id' selected"; else $fnSearchSel .= "<option value='M.mem_id'";
	$fnSearchSel .= ">아이디</option>\n";

	if($search == "M.mem_hp") $fnSearchSel .= "<option value='M.mem_hp' selected"; else $fnSearchSel .= "<option value='M.mem_hp'";
	$fnSearchSel .= ">휴대폰</option>\n";

	if($search == "M.mem_name") $fnSearchSel .= "<option value='M.mem_name' selected"; else $fnSearchSel .= "<option value='M.mem_name'";
	$fnSearchSel .= ">이름</option>\n";

	//if($search == "M.mem_nickname") $fnSearchSel .= "<option value='mem_nickname' selected"; else $fnSearchSel .= "<option value='M.mem_nickname'";
	$fnSearchSel .= ">닉네임</option>\n";

	$fnSearchSel .= "</select>\n";
	return $fnSearchSel;
}

function fnDealColor($Arg) {
	if($Arg == "판매") {
		$color_txt = "pink";
	} else if($Arg == "렌탈") {
		$color_txt = "blue";
	} else if($Arg == "구함") {
		$color_txt = "purple";
	}
	return $color_txt;
}

function fnDealState($Arg) {
	if($Arg == "1") {
		$color_txt = "거래 가능";
	} else if($Arg == "2") {
		$color_txt = "거래 진행중";
	} else if($Arg == "3") {
		$color_txt = "거래 완료";
	} else if($Arg == "0") {
		$color_txt = "거래 취소";
	}
	return $color_txt;
}

function fnMemLevel($mem_level) {
	switch ($mem_level) {
		case "1"; $level_txt = "수줍은"; break;
		case "2"; $level_txt = "평범한"; break;
		case "3"; $level_txt = "친절한"; break;
		case "4"; $level_txt = "노련한"; break;
		case "5"; $level_txt = "현명한"; break;
		case "6"; $level_txt = "완벽한"; break;
	}
	return $level_txt;
}

function fnDateDiff($date1, $date2, $gbn = "") {
	$datetime1 = new DateTime($date1);
	$datetime2 = new DateTime($date2);
	$interval = $datetime2->diff($datetime1);
	$datediff = $interval->format('%a');

	if($gbn == "d") {
		return $datediff;
	} else {
		$view_date = "";
		if($datediff == 0) {
			$view_date = "오늘";
		} else if ($datediff == 1) {
			$view_date = "어제";
		} else {
			$view_date = $datediff . "일 전";
		}
		echo $view_date;
	}

//	} else if ($datediff > 1 && $datediff < 4) {
//		$view_date = $datediff . "일 전";
//	} else if ($datediff > 4 && $datediff < 10) {
//		$view_date = "일주일 전";
//	} else if ($datediff > 29) {
//		$view_date = "한 달 전";
//	} else {
//		$view_date = $date2;
//	}
}

function fnDealFile($deal_no) {
	if($deal_no) {
		global $conn;

		$sql_d = "select filename from deal_file where deal_no = '$deal_no' order by file_idx limit 1";
		$result_d = mysqli_query($conn, $sql_d) or die ("SQL ERROR ? : " . mysqli_error());
		$row_d = mysqli_fetch_array($result_d);
		$filename = $row_d["filename"];
		if($filename) return "/upload/deal_thum/" . $row_d["filename"]; else return "/img/default.jpg";
	} else {
		return "/img/default.jpg";
	}
}

function charArryTxt($arryVal) {
    $rsTxt = "";
    $a = 0;
    foreach($arryVal as $code=>$name) {
        if($name != "") {
            $a++;
            $rsTxt .= ":" . $name;
        }
    }
    return $rsTxt;
}

function charQueryLike($arryVal) {
    $rsTxt = "";
    $arryA = explode(':', $arryVal);
    $a = 0;
    foreach($arryA as $code=>$name) {
        if($name != "") {
            $a++;
            if($a == 1) {
                $rsTxt .= "" . $name;
            } else {
                $rsTxt .= "|" . $name;
            }
        }
    }
    return "'" . $rsTxt . "'";
}


// 직접 접속 방지
function fnNotDirect($str1, $str2) {
	if (!preg_match("/" . $_SERVER['HTTP_HOST'] . "/i", $_SERVER['HTTP_REFERER']) || strpos($_SERVER['HTTP_REFERER'], $str1) === false) {
		Page_Msg_Url("잘못된 접근입니다.", $str2);
		exit;
	}
}

// 전화번호, 휴대폰 - 추가해서 리턴
function phone_format($tel) {
	$tel = preg_replace("/[^0-9]*/s", "", $tel);		//숫자 이외 제거
	$tel_2 = substr($tel, 0, 2);

	if ($tel_2 == "02") {
		return preg_replace("/([0-9]{2})([0-9]{3,4})([0-9]{4})$/", "$1-$2-$3", $tel);
	} else if($tel_2 == "8" && $tel_2 == "15" || $tel_2 == "16"|| $tel_2 == "18") {
		return preg_replace("/([0-9]{4})([0-9]{4})$/","$1-$2", $tel);
	} else {
		return preg_replace("/([0-9]{3})([0-9]{3,4})([0-9]{4})$/", "$1-$2-$3" , $tel);
	}
}

function RequestFile($name) {
	//global $HTTP_POST_FILES;

	//return $HTTP_POST_FILES[$name];
	return $_FILES[$name];
}
// 세션변수 생성
function set_session2($session_name, $value) {
    if (PHP_VERSION < '5.3.0')
        session_register($session_name);
    // PHP 버전별 차이를 없애기 위한 방법
    $session_name = $_SESSION["$session_name"] = $value;
}

function set_session($session_name, $value) {
	$_SESSION["$session_name"] = $value;
}

// 세션변수값 얻음
function get_session($session_name) {
    return $_SESSION[$session_name];
}

// 쿠키변수 생성
function set_cookie($cookie_name, $value, $expire) {
	$server_time=time();

    setcookie(md5($cookie_name), base64_encode($value), $server_time + $expire, '/', "");
}

// 쿠키변수값 얻음
function get_cookie($cookie_name) {
    return base64_decode($_COOKIE[md5($cookie_name)]);
}

//2020-09-01 딱 기본 넣기 : 작은따옴표와 sql inject 만 처리(개행 등 별도 태그처리 안함)
//일반 input 필드, 썸머노트
Function replace_in($string) {
	if ($string) {
		$string = addslashes($string);
		$string = str_replace("sp_", "", $string);
		$string = str_replace("xp_", "", $string);
		$string = str_replace("select", "**select**", $string);
		$string = str_replace("drop", "**drop**", $string);
		$string = str_replace("alter", "**alter**", $string);
		$string = str_replace("begin", "**begin**", $string);
		$string = str_replace("create", "**create**", $string);
		$string = str_replace("exec", "**exec**", $string);
		$string = str_replace("execute", "**execute**", $string);
		$string = str_replace("insert", "**insert**", $string);
		$string = str_replace("sys", "**sys**", $string);
		$string = str_replace("sysobjects", "**sysobjects**", $string);
		$string = str_replace("UPDATE", "**UPDATE**", $string);
		$string = str_replace("cursor", "**cursor**", $string);
		$string = str_replace("union", "**union**", $string);
	}
	return $string;
}

//2020-09-01 개행문 -> 줄바꿈 태그 변환하여 넣기
//for textarea
Function replace_in_cont($string) {
	if ($string) {
		$string = replace_in($string);
		$string = nl2br($string);
	}
	return $string;
}

//2020-09-01 딱 기본 빼기 : 작은따옴표와 sql inject 만 처리(개행 등 별도 태그처리 안함)
//일반 input 필드, 썸머노트
function replace_out($string) {
	if ($string) {
		$string = stripslashes($string);
		$string = str_replace("**select**", "select", $string);
		$string = str_replace("**drop**", "drop", $string);
		$string = str_replace("**alter**", "alter", $string);
		$string = str_replace("**begin**", "begin", $string);
		$string = str_replace("**create**", "create", $string);
		$string = str_replace("**exec**", "exec", $string);
		$string = str_replace("**execute**", "execute", $string);
		$string = str_replace("**insert**", "insert", $string);
		$string = str_replace("**sys**", "sys", $string);
		$string = str_replace("**sysobjects**", "sysobjects", $string);
		$string = str_replace("**UPDATE**", "UPDATE", $string);
		$string = str_replace("**cursor**", "cursor", $string);
		$string = str_replace("**union**", "union", $string);
	}
	return $string;
}

//2020-09-01 줄바꿈 태그 -> 개행문 변환하여 불러오기
//for textarea
Function replace_out_cont($string) {
	if ($string) {
		$string = replace_out($string);
		$string = str_replace("<br/>", Chr(13) & Chr(10), $string);
		$string = str_replace("<br>", Chr(13) & Chr(10), $string);
		$string = str_replace("<br />", Chr(13) & Chr(10), $string);
	}
	return $string;
}

// 개행문자 -> <br>변환
Function replace_out_br($string) {
	if ($string) {
		$string = replace_out($string);
		$string = str_replace(Chr(13) & Chr(10), "<br />", $string);
	}
	return $string;
}

Function replace_con_out_view($string) {
	if ($string) {
		//$string =   stripslashes($string);
		//$string = str_replace(chr(13)&chr(10),"<br>", $string);
		$string = str_replace("''", "'", $string);
		$string = str_replace("**select**", "select", $string);
		$string = str_replace("**drop**", "drop", $string);
		$string = str_replace("**alter**", "alter", $string);
		$string = str_replace("**begin**", "begin", $string);
		$string = str_replace("**create**", "create", $string);
		$string = str_replace("**exec**", "exec", $string);
		$string = str_replace("**execute**", "execute", $string);
		$string = str_replace("**insert**", "insert", $string);
		$string = str_replace("**sys**", "sys", $string);
		$string = str_replace("**sysobjects**", "sysobjects", $string);
		$string = str_replace("**UPDATE**", "UPDATE", $string);
		$string = str_replace("**cursor**", "cursor", $string);
		$string = str_replace("**union**", "union", $string);
	}
	return $string;
}

//2020-09-01 textarea 에 다시 보여줄때
Function replace_con_out($string) {
	if ($string) {
		$string = stripslashes($string);
		$string = str_replace("**select**", "select", $string);
		$string = str_replace("**drop**", "drop", $string);
		$string = str_replace("**alter**", "alter", $string);
		$string = str_replace("**begin**", "begin", $string);
		$string = str_replace("**create**", "create", $string);
		$string = str_replace("**exec**", "exec", $string);
		$string = str_replace("**execute**", "execute", $string);
		$string = str_replace("**insert**", "insert", $string);
		$string = str_replace("**sys**", "sys", $string);
		$string = str_replace("**sysobjects**", "sysobjects", $string);
		$string = str_replace("**UPDATE**", "UPDATE", $string);
		$string = str_replace("**cursor**", "cursor", $string);
		$string = str_replace("**union**", "union", $string);
		$string = str_replace("/admin/SE_/", "", $string);
		$string = str_replace("<br>", "\r\n", $string);
	}
	return $string;
}

//작은 따옴표만 처리 - OUT
Function replace_out_quot($string) {
	$string = str_replace("''", "'", $string);
	return $string;
}

// 일반 넘어온값
Function r_null($str, $want) {
	if (!$str) {
		$str = $want;
	}else{
		$str = $str;
	}

	return $str;
}

Function r_want($str, $a, $b) {
	If ($str == $a) {
		$r_want = $b;
	}else{
		$r_want = $str;
	}
}

Function r_want2($str,$a,$b,$c) {
	If ($str==$a) {
		$r_want = $b;
	}else{
		$r_want = $c;
	}
	return $r_want;
}

//'hit 증가 함수
Function plushit($tablename, $field1, $field2, $idx) {
	global $conn;
	$sql = " UPDATE $tablename SET $field1 = $field1 + 1  WHERE $field2=$idx";
	$result=mysqli_query($conn,$sql);
}

//'hit 증가 함수
Function minushit($tablename,$field1,$field2,$idx) {
	global $conn;
	$sql = " UPDATE $tablename SET $field1 = $field1 - 1  WHERE $field2=$idx";
	$result=mysqli_query($conn,$sql);
}

//'hit 증가 함수
Function get_update($tablename,$how,$searchand) {
	global $conn;
	$sql = " UPDATE $tablename SET $how  WHERE 1=1 $searchand";
	//echo $sql;
	//exit;
	$result=mysqli_query($conn,$sql);
}
//'hit 증가 함수
Function get_delete($tablename,$searchand) {
	global $conn;
	$sql = " DELETE from $tablename WHERE 1=1 $searchand";
	//echo $sql;
	//exit;
	$result=mysqli_query($conn,$sql);
}
//'hit 증가 함수
Function get_insert($tablename,$how) {
	global $conn;
	$sql = " INSERT $tablename SET $how ";
	//echo $sql;
	//exit;
	$result=mysqli_query($conn,$sql);
}
//'hit 증가 함수
Function get_insert_echo($tablename,$how,$searchand) {
	global $conn;
	$sql = " INSERT $tablename SET $how ";
	echo $sql;
	//exit;
	$result=mysqli_query($conn,$sql);
}


//'hit 증가 함수
Function get_update_echo($tablename,$how,$searchand) {
	global $conn;
	$sql = " UPDATE $tablename SET $how  WHERE 1=1 $searchand";
	echo $sql;
	//exit;
	$result=mysqli_query($conn,$sql);
}

function cutbyte($msg, $limit) {

	$msg = substr($msg, 0, $limit);
	for ($i = $limit - 1; $i > 1; $i--) {
		if (ord(substr($msg,$i,1)) < 128) break;
	}

	$msg = substr($msg, 0, $limit - ($limit - $i + 1) % 2);

	return $msg;

}

function cutbyte2($msg, $limit) {


	if (strlen($msg)>$limit) {
		$msg = substr($msg,0,$limit)."..";
	}
	return $msg;

}


Function minusvalue($tablename,$field1,$field2,$idx,$value) {
	global $conn;
	$sql = " UPDATE $tablename set $field1 = $field1 - $value  where $field2='$idx' ";

	$result=mysqli_query($conn,$sql);
}

//'인덱스 맥스 값 구하기
Function get_count_plus($tblname,$searchand) {
	$maxidxsql = " select count(*) as max_idx from $tblname where 1=1 $searchand";
	$maxresult=mysqli_query($maxidxsql);
	$maxrow = mysqli_fetch_array($maxresult);

	$max_idx = $maxrow["max_idx"];
	If ($max_idx>0) {
		$max_idx= $max_idx+1;
	} else {
		$max_idx = 1;
	}
	return $max_idx;
}

//'인덱스 맥스 값 구하기
Function get_max_idx_plus($tblname,$idx) {
	$maxidxsql = " select max($idx) as max_idx from $tblname ";
	$maxresult=mysqli_query($maxidxsql);
	$maxrow = mysqli_fetch_array($maxresult);

	$max_idx = $maxrow["max_idx"];
	If ($max_idx>0) {
		$max_idx= $max_idx+1;
	} else {
		$max_idx = 1;
	}
	return $max_idx;
}
//'인덱스 맥스 값 구하기
Function get_max_idx($tblname,$idx,$searchand) {
	$maxidxsql = " select max($idx) as max_idx from $tblname $searchand";
	$maxresult=mysqli_query($maxidxsql);
	$maxrow = mysqli_fetch_array($maxresult);

	$max_idx = $maxrow["max_idx"];
	If ($max_idx>0) {
		$max_idx= $max_idx;
	} else {
		$max_idx = 1;
	}
	return $max_idx;
}



//'인덱스 맥스 값 구하기
Function get_max_plus_search($tblname,$idx,$searchand) {
	$maxidxsql = " select max($idx) as max_idx from $tblname where 1=1 $searchand";
	$maxresult=mysqli_query($maxidxsql);
	$maxrow = mysqli_fetch_array($maxresult);

	$max_idx = $maxrow["max_idx"];
	If ($max_idx>0) {
		$max_idx= $max_idx+1;
	} else {
		$max_idx = 1;
	}
	return $max_idx;
}

//'인덱스 맥스 값 구하기
Function get_sum($tblname,$idx) {
	$maxidxsql = " select sum($idx) as sum_idx from $tblname ";
	$maxresult=mysqli_query($maxidxsql);
	$maxrow = mysqli_fetch_array($maxresult);

	$sum_idx = $maxrow["sum_idx"];
	return $sum_idx;
}

//'인덱스 맥스 값 구하기
Function get_sum_searchand($tblname,$idx,$searchand) {
	$maxidxsql = " select sum($idx) as sum_idx from $tblname where 1=1 $searchand";
	$maxresult=mysqli_query($maxidxsql);
	$maxrow = mysqli_fetch_array($maxresult);

	$sum_idx = $maxrow["sum_idx"];
	return $sum_idx;
}

function chg_characterset(  $p1   ) {
	  $p1  = iconv("EUC-KR", "UTF-8", $p1);
    return $p1;
}

function validId($val,$min,$max) {
	if(!ereg("(^[0-9a-zA-Z]{".$min.", ".$max."}$)",$val)) {
		$validId = "false";
	}else{
		$validId = "true";
	}
	return $validId;
}

function validPwd($val,$min,$max) {
	if(preg_match("/[0-9]/",$val)=="0" or preg_match("/[a-zA-Z]/",$val)=="0" or !ereg("(^.{".$min.", ".$max."}$)",$val)) {
		$validPwd = "false";
	}else{
		$validPwd = "true";
	}
	return $validPwd;
}

function str_count($str) {
	$kChar = 0;
	for( $i = 0 ; $i < strlen($str) ;$i++) {
		$lastChar = ord($str[$i]);
		if($lastChar >= 127) {
		$i++;
	}
		$kChar++;
	}
	//echo $kChar;
	return $kChar;
}


function validNickname($val, $min, $max) {
	//echo str_count($val);
	if (str_count($val) >= $min and str_count($val) <= $max) {
		$validPwd = "true";
	} else {
		$validPwd = "false";
	}
	echo $validPwd ;
	//if(!ereg("(.{".$min.", ".$max."}$)",$val)) {
	//	$validPwd = "false";
	//}else{
	//	$validPwd = "true";
	//}
	return $validPwd;
}

function validEmail($val) {
	if(!eregi("^([[:alnum:]_%+=.-]+)@([[:alnum:]_.-]+)\.([a-z]{2,3}|[0-9]{1,3})$", $val)) {
		$validEmail = "false";
	}else{
		$validEmail = "true";
	}
	return $validEmail;
}

// 이메일 목록
function EmailList() {
	$emailList =  "";
	$emailList .=  "<option value=\"\">직접입력</option>";
	$emailList .=  "<option value=\"test.com\">test.com</option>";
	$emailList .=  "<option value=\"gmail.com\">gmail.com</option>";
	$emailList .=  "<option value=\"naver.com\">naver.com</option>";
	$emailList .=  "<option value=\"daum.net\">daum.net</option>";
	$emailList .=  "<option value=\"hanmail.net\">hanmail.net</option>";
	$emailList .=  "<option value=\"nate.com\">nate.com</option>";
	$emailList .=  "<option value=\"hotmail.com\">hotmail.com</option>";
	echo $emailList;
}

function cateimg($val) {
	if ($val == 1) {
		//$cateimg = "/images/board/t_dowon.png";
	}else if ($val == 2) {
		$cateimg = "/images/board/t_dowon.png";
	}else if ($val == 3) {
		$cateimg = "/images/board/t_samgo.png";
	}else if ($val == 4) {
		$cateimg = "/images/board/t_gunwoong.png";
	}else if ($val == 5) {
		$cateimg = "/images/board/t_yosan.png";
	}else if ($val == 6) {
		$cateimg = "/images/board/t_samkuk.png";
	}else if ($val == 7) {
		$cateimg = "/images/board/t_samkuk.png";
	}else if ($val == 8) {
		$cateimg = "/images/common/t_review123.png";
	}else {
		$cateimg = "";
	}
	return $cateimg;
}

Function get_noimg($file_path, $img, $noimg) {
	If (!$img) {
		$get_noimg = $noimg;
	} Else {
		$get_noimg = $file_path . $img;
	}

	return $get_noimg;
}

//'인덱스 맥스 값 구하기
Function get_this($tblname,$f1,$f2,$v) {
	$thissql = " select $f1 as thisvalue from $tblname where $f2='$v'";
	$thisresult=mysqli_query($thissql);
	$thisrow = mysqli_fetch_array($thisresult);

	$thisvalue = $thisrow["thisvalue"];

	return $thisvalue;
}

//'인덱스 맥스 값 구하기
Function get_this_search($tblname,$f1,$searchand) {

	$thissql = " select $f1 as thisvalue from $tblname where 1=1 $searchand ";
	$thisresult=mysqli_query($thissql);
	$thisrow = mysqli_fetch_array($thisresult);

	$thisvalue = $thisrow["thisvalue"];

	return $thisvalue;
}

function get_date($date, $typ) {
	$date = substr($date,0,4).$typ.substr($date,4,2).$typ.substr($date,6,2);
	return $date;
}
function get_cut($val,$num) {
	if(mb_strlen($val,'UTF-8')>=$num) {
		$val = mb_substr($val,0,$num,'UTF-8')."...";
	}

	return $val;
}


// TEXT 형식으로 변환 //
function get_text($str, $html=0) {
    /* 3.22 막음 (HTML 체크 줄바꿈시 출력 오류때문)
    $source[] = "/  /";
    $target[] = " &nbsp;";
    */

    // 3.31
    // TEXT 출력일 경우 &amp; &nbsp; 등의 코드를 정상으로 출력해 주기 위함
    if ($html == 0) {
        $str = html_symbol($str);
    }

    $source[] = "/</";
    $target[] = "&lt;";
    $source[] = "/>/";
    $target[] = "&gt;";
    //$source[] = "/\"/";
    //$target[] = "&#034;";
    $source[] = "/\'/";
    $target[] = "&#039;";
    //$source[] = "/}/"; $target[] = "&#125;";
    if ($html) {
        $source[] = "/\n/";
        $target[] = "<br/>";
    }

    return preg_replace($source, $target, $str);
}

function get_comment($num) {
	$comment_text = "";

	if($num>0) { $comment_text="&nbsp;&nbsp;[$num]";}

	return $comment_text;
}

function get_comment2($num) {
	$comment_text = "";

	if($num>0) {
		$comment_text="답변완료";
	}else{
		$comment_text="답변대기";
	}

	return $comment_text;
}

function get_method($str) {
	if ($str=="mutong") {
		$str_method = "무통장입금";
	}else if ($str=="100000000000") {
		$str_method = "신용카드";
	}else{
		$str_method = "계좌이체";
	}
	return $str_method;
}
function get_pay_status($val) {
	if ($val == 0) {
		$status_txt = "접수완료";
	}else if ($val == 1) {
		$status_txt = "입금완료";
	}else if ($val == 2) {
		$status_txt = "주문접수";
	}else if ($val == 3) {
		$status_txt = "출고완료";
	}else if ($val == 4) {
		$status_txt = "거래완료";
	}else if ($val == 5) {
		$status_txt = "접수반려";
	}else if ($val == 6) {
		$status_txt = "반려완료";
	}else {
		$status_txt = "접수완료";
	}
	return $status_txt;
}
function get_pay_method($val) {
	if ($val == "100000000000") {
		$status_txt = "신용카드";
	}else if ($val == "mutong") {
		$status_txt = "무통장입금";
	}else if ($val == "000010000000") {
		$status_txt = "휴대폰결제";
	}else if ($val == "010000000000") {
		$status_txt = "실시간계좌이체";
	}
	return $status_txt;
}

function get_view_status($val) {
	if ($val == 0) {
		$status_txt = "입금대기";
	}else if ($val == 1) {
		$status_txt = "결제완료";
	}else if ($val == 2) {
		$status_txt = "결제취소";
	}else if ($val == 3) {
		$status_txt = "배송준비중";
	}else if ($val == 4) {
		$status_txt = "배송중";
	}else if ($val == 5) {
		$status_txt = "배송완료";
	}else if ($val == 6) {
		$status_txt = "반품완료";
	}else {
		$status_txt = "입금대기";
	}
	return $status_txt;
}

//랜덤숫자문자 얻기
Function RndomString($cnt)  {
	$ran= "";

	for( $i=0; $i<$cnt; $i++) //7자리만 출력
	{
		 if( rand(0,1) ) $ran .= rand( 0, 9 ); //숫자
		 else $ran .= strtoupper(chr(rand( 97, 122 ))); //영어소문자
	}

	return $ran;
}

//랜덤숫자문자 얻기
Function RndomNum($cnt) {
	$ran= "";

	for( $i=0; $i<$cnt; $i++) //7자리만 출력
	{
		 if( strlen($ran)<$cnt ) $ran .= rand( 0, 9 ); //숫자
	}

	return $ran;
}

//'원하는값 찾기
Function get_want($tblname, $want, $searchand) {
	global $conn;
	$wantsql = "select $want as wantvalue from $tblname where 1=1 $searchand";
	$wantresult=mysqli_query($conn,$wantsql);
	$wantrow = mysqli_fetch_array($wantresult);
	$wantvalue = $wantrow["wantvalue"];

	return $wantvalue;
}

//'원하는값 찾기
Function get_want_echo($tblname,$want,$searchand) {
	global $conn;
	$wantsql = " select $want as wantvalue from $tblname where 1=1 $searchand ";

	$wantresult=mysqli_query($conn,$wantsql);
	$wantrow = mysqli_fetch_array($wantresult);
	$wantvalue = $wantrow["wantvalue"];
	echo "<br />=================================<br/>";
	echo $wantsql;
	echo "<br />=================================<br/>";
	return $wantvalue;
}

//코드생성
Function codemake($code_text) {
	$code_text = Trim($code_text);

	for ($i=65;$i<91;$i++) { //97~122 소문자
		if(chr($i)==substr($code_text,0,1)) { //첫자리의 알파벳숫자 구하기
			for ($j=65;$j<91;$j++) {
				if (chr($j)==substr($code_text,-1)) {
					if ($j==90) {
						$code=chr($i+1)."A";
						$temp ="aa";
						//exit for;
					}else{
						$code=chr($i)."".chr($j+1);

						$temp ="bb";
						//exit for;

					}
				}
			} //for j = i to 90
		}
	}
	return $code;
}

function get_mem_gubun($val) {
	if ($val == 0) {
		$mem_gubun_txt = "전체";
	}else if ($val == 2) {
		$mem_gubun_txt = "일반";
	}else if ($val == 2) {
		$mem_gubun_txt = "직원";
	}else if ($val == 3) {
		$mem_gubun_txt = "가맹점";
	}else if ($val == 9) {
		$mem_gubun_txt = "탈퇴";
	}else {
		$mem_gubun_txt = "일반";
	}
	return $mem_gubun_txt;
}

function get_img_view($file_path, $file, $w, $h) {
	$file_kind = strtolower(substr( $file, -3)) ;
	if(  $file_kind == "gif" or $file_kind == "jpeg" or  $file_kind == "jpg" or  $file_kind == "png" ) {
		echo "<img src='$file_path$file' id='$file' onload='img_resize(\"$file\",\"$w\",\"$h\")'><br><br>";
	}
}

//-------------------------------------------------------------------------------
// Function 명 : GF_Common_SetComboList
// 용       도 : 공통코드 selectbox 항목 출력
// 작 성 일 시 :
// 수 정 이 력 : 2013-09-25 (정선진)
//-------------------------------------------------------------------------------

Function GF_Common_SetComboList($CheckBoxName,$CommTy, $ParCode, $Depth, $IsBlank, $BlankString, $CheckValue, $StyleOption) {
		$GF_Common_SetComboList .="<select ".$StyleOption." name='".$CheckBoxName."' id='".$CheckBoxName."'>\n";
		If($IsBlank=="True") {
			$GF_Common_SetComboList .="<option value='' ".($CheckValue==null?"selected":"").">" .$BlankString ."</option>\n";
		}
		If ($ParCode == "") {$ParCode = " =''";}else{ $ParCode = "=".$ParCode;}
		If ($Depth == "") {$Depth = " =1";}else{ $Depth = "=".$Depth;}
		$result =QRY_COMMON_LIST($CommTy ,$ParCode, $Depth);
		while($row = mysqli_fetch_array($result)) {
			$dtl_code = replace_out($row["dtl_code"]);
			$code_desc = replace_out($row["code_desc"]);
			If(strcmp($CheckValue,$dtl_code)==0) {
				$GF_Common_SetComboList .="<option value='".$dtl_code."' selected>".$code_desc."</option>\n";
			}else{
				$GF_Common_SetComboList .="<option value='".$dtl_code."'>".$code_desc."</option>\n";
			}
		}
		$GF_Common_SetComboList .="</select>\n";
		return $GF_Common_SetComboList;
}

//-------------------------------------------------------------------------------
// Function 명 : GF_warea_SetComboList
// 용       도 : 지도 검색용 지역 selectbox 항목 출력
// 작 성 일 시 :
// 수 정 이 력 : 2013-09-25 (정선진)
//-------------------------------------------------------------------------------
Function GF_warea_SetComboList($CheckBoxName,$ParCode, $Depth, $IsBlank, $BlankString, $CheckValue, $StyleOption,$mode) {
		$GF_Common_SetComboList .="<select ".$StyleOption." name='".$CheckBoxName."' id='".$CheckBoxName."' onchange='sel(\"$CheckBoxName\",this);'>\n";
		If($IsBlank=="True") {
			$GF_Common_SetComboList .="<option value='' ".($CheckValue==null || $CheckValue=="" ?"selected":"").">" .$BlankString ."</option>\n";
		}
		If ($ParCode == "") {$ParCode = " =''";}else{ $ParCode = "=".$ParCode;}
		If ($Depth == "") {$Depth = " =1";}else{ $Depth = "=".$Depth;}

		$result =QRY_WAREA_LIST($ParCode, $Depth);
		while($row = mysqli_fetch_array($result)) {
			$idx = replace_out($row["idx"]);
			$area_name = replace_out($row["area_name"]);
			if ($CheckBoxName=="area2" and $mode=="add") {
				//$area_name=iconv("EUC-KR", "UTF-8",$area_name);
			}
			If(strcmp($CheckValue,$idx)==0) {
				$GF_Common_SetComboList .="<option value='".$idx."' selected>".$area_name."</option>\n";
			}else{
				$GF_Common_SetComboList .="<option value='".$idx."'>".$area_name."</option>\n";
			}
		}
		$GF_Common_SetComboList .="</select>\n";

		return $GF_Common_SetComboList;
}

function QRY_WAREA_LIST($ParCode, $Depth) {
	$conn = dbconn();
	$sql = "select idx, area_name
		   FROM area
		   where area_dep  ".$Depth." ";
    if ($ParCode!="") {
		$sql.= "and area_parent ".$ParCode." ";
	}
	$sql.= "ORDER BY area_name ";
//	echo $sql;
	mysqli_query( "SET NAMES utf8");
	$result=mysqli_query($sql,$conn) or die ("SQL ERROR() : ".mysqli_error());
	return $result;

}

function get_navermap_coods($key,$p_str_addr="") {
	$int_x = 0;
	$int_y = 0;


	$str_addr = str_replace(" ", "", $p_str_addr);
	//$str_addr =$p_str_addr;

	// curl 이용해서 지도에 필요한 좌표를 취득
	$dest_url  = "http://openapi.map.naver.com/api/geocode.php?key=$key&encoding=euc-kr&coord=LatLng&query=" .$str_addr;
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $dest_url);
	curl_setopt($ch, CURLOPT_TIMEOUT, 30);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$str_result = curl_exec($ch);
	curl_close($ch);

	//$obj_xml = simplexml_load_string($str_result);
	//$obj_xml = simplexml_load_file($str_result);

	//$int_x = $obj_xml->item->point->x;
	$int_x = '126.9969899';
	//$int_y = $obj_xml->item->point->y;
	$int_y = '37.5584979';


	return array($int_x, $int_y);
}


//if you want to use it as a function;

if(!function_exists("simplexml_load_file")) {
	function simplexml_load_file($file) {

		require_once "simplexml.class.php";
		$sx = new simplexml;
		return $sx->xml_load_file($file);
	}
}

// 주소에 따른 좌표 정보 가져오기

function getNaverGeocode($addr, $cId, $cSecret) {
 $addr = urlencode($addr);
 $url = "https://openapi.naver.com/v1/map/geocode?encoding=utf-8&coord=latlng&output=json&query=".$addr;
 $headers = array();
 $headers[] = "GET https://openapi.naver.com/v1/map/geocode?".$addr;
 $headers[] ="Host: openapi.naver.com";
 $headers[] ="Accept: */*";
 $headers[] ="Content-Type: application/json";
 $headers[] ="X-Naver-Client-Id: ".$cId;
 $headers[] ="X-Naver-Client-Secret: ".$cSecret;
 $headers[] ="Connection: Close";
 $result = getHttp($url, $headers);
 return $result;
}

function getHttp($url, $headers=null) {
 $ch = curl_init();
 curl_setopt($ch, CURLOPT_URL, $url);
 curl_setopt($ch, CURLOPT_HEADER, false);
 curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 $result = curl_exec($ch);
 curl_close($ch);
 return $result;
}


function get_status_text($start_date,$end_date) {
	$status_txt="";
	$today = date("Y-m-d");
	If ($start_date=="" Or $end_date=="") {
		$status_txt = "";
	}else{
		If ($start_date_compute<0) {
			$status_txt = "진행예정";
		}Else If ($end_date_compute>0) {
			$status_txt = "종료";
		}Else If ($start_date_compute>=0 and $end_date_compute<=0) {
			$status_txt = "진행중";
		}
	}
	return $status_txt;
}

function get_event_status($start_date,$end_date) {
	$today2 = date("Y-m-d");

	$status_txt="";
	If ($start_date=="" Or $end_date=="") {
		$status_txt = "";
	}else{
		If ($today2<$start_date) {
			$status_txt = "예정" ;
		}Else If ($today2>$end_date) {
			$status_txt = "종료";
		}Else If ($start_date<=$today2 and $today2<=$end_date) {
			$status_txt = "진행중";
		}
	}
	return $status_txt;
}
// sns 공유하기
function get_sns_share_link($sns, $url, $title, $img, $style="")
{
    global $config;

    if(!$sns)
        return '';

    switch($sns) {
        case 'facebook':
            $str = '<a href="https://www.facebook.com/sharer/sharer.php?u='.urlencode($url).'&amp;p='.urlencode($title).'" class="share-facebook" target="_blank"><img src="'.$img.'" '.$style.' alt="페이스북에 공유"></a>';
            break;
        case 'twitter':
            $str = '<a href="https://twitter.com/share?url='.urlencode($url).'&amp;text='.urlencode($title).'" class="share-twitter" target="_blank"><img src="'.$img.'" '.$style.' alt="트위터에 공유"></a>';
            break;
        case 'googleplus':
            $str = '<a href="https://plus.google.com/share?url='.urlencode($url).'" class="share-googleplus" target="_blank"><img src="'.$img.'" '.$style.' alt="구글플러스에 공유"></a>';
            break;
		case 'kakaotalk':
			$str = '<a href="javascript:kakaolink_send(\''.str_replace('+', ' ', urlencode($title)).'\', \''.urlencode($url).'\');" class="share-kakaotalk"><img src="'.$img.'" '.$style.' alt="카카오톡 링크보내기"></a>';
            break;
		case 'blog':
			$str = '<a href="http://blog.naver.com/openapi/share?url='.urlencode($url).'&amp;title='.urlencode($title).'" class="share-twitter" target="_blank"><img src="'.$img.'" '.$style.' alt="네이버블로그에 공유"></a>';
            break;
    }

    return $str;
}

function get_new_od_id() {
	$conn = dbconn();

    // 주문서 테이블 Lock 걸고
   // sql_query(" LOCK TABLES $g4[yc4_order_table] READ, $g4[yc4_order_table] WRITE ", FALSE);
    // 주문서 번호를 만든다.
    $date = date("Ymd", time());    // 2002년 3월 7일 일경우 020307
    $sql = " select max(order_id) as max_od_id from goods_order where SUBSTRING(order_id, 1, 8) = '$date' ";
	//echo $sql;
    $result=mysqli_query($sql,$conn) or die ("SQL ERROR : ".mysqli_error());
    $row = mysqli_fetch_array($result);
    $od_id = $row[max_od_id];
    if ($od_id == 0) {
        $od_id = 1;
    }else{
        $od_id = (int)substr($od_id, -4);
        $od_id++;
    }
    $od_id = $date . substr("0000" . $od_id, -4);
    // 주문서 테이블 Lock 풀고
   // sql_query(" UNLOCK TABLES ", FALSE);

    return $od_id;
}


function get_cate_name($ca_id)
{

	if($ca_id) {
		$row = sql_fetch(" select ca_name from board_category where ca_id = TRIM('$ca_id') ");
		return $row['ca_name'];
	}else{
      return "";
	}
}

function get_cate_class($ca_id)
{

	if($ca_id) {
		$row = sql_fetch(" select class_style from board_category where ca_id = TRIM('$ca_id') ");
		return $row['class_style'];
	}else{
      return "";
	}
}

function get_mem_login_date($mem_idx)
{

	if($mem_idx) {
		$row = sql_fetch(" select login_date from member  where mem_idx = TRIM('$mem_idx') ");

    $now_time = date('Y-m-d H:i:s');
    $time_check = strtotime($now_time) - strtotime($row[login_date]); //대상 날짜 및 시간 필드

    $total_time = $time_check;

    $days = floor($total_time/86400);
    $time = $total_time - ($days*86400);
    $hours = floor($time/3600);
    $time = $time - ($hours*3600);
    $min = floor($time/60);
    $sec = $time - ($min*60);

    if($days==0&&$hours==0&&$min==0)
        return $sec."초 전";
    elseif($days==0&&$hours==0)
        return $min."분 전";
    elseif($days==0)
        return $hours."시간 전";
    else
        return $days."일". $hours."시간 전";
	}else{
      return "0시간 전";
	}
}


// 한글 요일
function get_yoil($date, $full=0)
{
    $arr_yoil = array ("일", "월", "화", "수", "목", "금", "토");

    $yoil = date("w", strtotime($date));
    $str = $arr_yoil[$yoil];
    if ($full) {
        $str .= "요일";
    }
    return $str;
}

// 요일 한글명
function get_yoil_txt($d_yoil){
	$arr_yoil_txt = array ("일", "월", "화", "수", "목", "금", "토");
	$yoil_txt = $arr_yoil_txt[$d_yoil];

	return $yoil_txt;
}

function get_mod($x, $y) {
    return $x % $y;
}

function get_mem_name($mem_idx)
{

	if($mem_idx) {
		$row = sql_fetch(" select mem_nickname from member where mem_idx = TRIM('$mem_idx') ");
		return $row['mem_nickname'];
	}else{
      return "";
	}
}
function get_mem($which,$mem_idx) {
	if($mem_idx) {
		$val=get_want("member",$which," and mem_idx = TRIM('$mem_idx')");
		return $val;
	}
}

function get_mem_deal_cnt($mem_idx)
{

	if($mem_idx) {
		$row = sql_fetch(" select deal_cnt from member where mem_idx = TRIM('$mem_idx') ");
		return $row['deal_cnt'];
	}else{
      return "0";
	}
}

function get_cate_tel_use($ca_id)
{

	if($ca_id) {
		$row = sql_fetch(" select tel_use from board_category where ca_id = TRIM('$ca_id') ");
		return $row['tel_use'];
	}else{
      return "";
	}
}

function get_mem_name1($mem_idx)
{

	if($mem_idx) {
		$row = sql_fetch(" select mem_name from member where mem_idx = TRIM('$mem_idx') ");
		return $row['mem_name'];
	}else{
      return "";
	}
}

function get_mem_tel($mem_idx)
{

	if($mem_idx) {
		$row = sql_fetch(" select mem_hp1 from member where mem_idx = TRIM('$mem_idx') ");
		return $row['mem_hp1'];
	}else{
      return "";
	}
}
function get_left_day($a,$b) {
	$left=intval((strtotime($a)-strtotime($b))/86400);

	$left_val = "D-".$left;
	//오늘일경우
	if ($left == "0") {


	}


	if ($left<0) {
		$left_val = "마감";
	}
	return $left_val;
}

function get_left_day_lhk($a,$b) {
	$total_time = strtotime($a)-strtotime($b);
	$days = floor($total_time/86400);
	$time = $total_time - ($days*86400);
	$hours = floor($time/3600);
	$time = $time - ($hours*3600);
	$min = floor($time/60);
	$sec = $time - ($min*60);

	$left_val = "D-".$days."";
	if ($days == 0) {
		//$left_val = "H-".$hours."";
		$left_val = "D-0";
		if ($hours == "0") {
			$left_val = "D-0";
			//$left_val = "M-".$min."";

			if ($min == "0") {
				$left_val = "마감";
			}
		}
	}

	if ($days < 0) {
		$left_val = "마감";

	}


	return $left_val;
}



function cut_str($str, $len, $suffix="…")
{
    $arr_str = preg_split("//u", $str, -1, PREG_SPLIT_NO_EMPTY);
    $str_len = count($arr_str);

    if ($str_len >= $len) {
        $slice_str = array_slice($arr_str, 0, $len);
        $str = join("", $slice_str);

        return $str . ($str_len > $len ? $suffix : '');
    } else {
        $str = join("", $arr_str);
        return $str;
    }
}

// 문자열에 utf8 문자가 들어 있는지 검사하는 함수
// 코드 : http://in2.php.net/manual/en/function.mb-check-encoding.php#95289
function is_utf8($str)
{
    $len = strlen($str);
    for($i = 0; $i < $len; $i++) {
        $c = ord($str[$i]);
        if ($c > 128) {
            if (($c > 247)) return false;
            elseif ($c > 239) $bytes = 4;
            elseif ($c > 223) $bytes = 3;
            elseif ($c > 191) $bytes = 2;
            else return false;
            if (($i + $bytes) > $len) return false;
            while ($bytes > 1) {
                $i++;
                $b = ord($str[$i]);
                if ($b < 128 || $b > 191) return false;
                $bytes--;
            }
        }
    }
    return true;
}

function get_heart($report) {
	$si=1;
	$ei=5;
	For ($i=$si;$i<=$report;$i++) {
		echo  '<img src="/zbackoffice/img/sub/star-on.jpg">';
		$si++;
	}

	return $heart;
}


/*
 * 랜덤 문자열 생성(인수 : 길이, 타입)
 * 지정된 타입의 문자열로 지정된 길이의 랜덤 문자열을 반환한다.
 * 타입 0 : 영문 대소문자(A-Z,a-z), 숫자(0-9)
 * 타입 1 : 영문 대문자(A-Z), 숫자(0-9)
 * 타입 2 : 영문 소문자(a-z), 숫자(0-9)
 * 타입 3 : 영문 대문자(A-Z)
 * 타입 4 : 영문 소문자(a-z)
 * 타입 5 : 숫자(0-9)
 * 디폴트 : false 반환.
*/
function rand_str($length, $type)
{
    switch($type) {
        case 0:
            $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890';
            break;
        case 1:
            $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
            break;
        case 2:
            $chars = 'abcdefghijklmnopqrstuvwxyz1234567890';
            break;
        case 3:
            $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            break;
        case 4:
            $chars = 'abcdefghijklmnopqrstuvwxyz';
            break;
        case 5:
            $chars = '1234567890';
            break;
        default:
            return false;
    }
    $chars_length = (strlen($chars) - 1);
    $string = '';
    for ($i = 0; $i < $length; $i = strlen($string)) {
        $string .= $chars{rand(0, $chars_length)};
    }
    return $string;
}

function iconv_utf8($str)
{
    return iconv('euc-kr', 'utf-8', $str);
}

// get_browser() 함수는 이미 있음
function get_brow($agent)
{
    $agent = strtolower($agent);

    //echo $agent; echo "<br/>";

    if (preg_match("/msie ([1-9][0-9]\.[0-9]+)/", $agent, $m)) { $s = 'MSIE '.$m[1]; }
    else if(preg_match("/firefox/", $agent))            { $s = "FireFox"; }
    else if(preg_match("/chrome/", $agent))             { $s = "Chrome"; }
    else if(preg_match("/x11/", $agent))                { $s = "Netscape"; }
    else if(preg_match("/opera/", $agent))              { $s = "Opera"; }
    else if(preg_match("/gec/", $agent))                { $s = "Gecko"; }
    else if(preg_match("/bot|slurp/", $agent))          { $s = "Robot"; }
    else if(preg_match("/internet explorer/", $agent))  { $s = "IE"; }
    else if(preg_match("/mozilla/", $agent))            { $s = "Mozilla"; }
    else { $s = "기타"; }

    return $s;
}

function get_os($agent)
{
    $agent = strtolower($agent);

    //echo $agent; echo "<br/>";

    if (preg_match("/windows 98/", $agent))                 { $s = "98"; }
    else if(preg_match("/windows 95/", $agent))             { $s = "95"; }
    else if(preg_match("/windows nt 4\.[0-9]*/", $agent))   { $s = "NT"; }
    else if(preg_match("/windows nt 5\.0/", $agent))        { $s = "2000"; }
    else if(preg_match("/windows nt 5\.1/", $agent))        { $s = "XP"; }
    else if(preg_match("/windows nt 5\.2/", $agent))        { $s = "2003"; }
    else if(preg_match("/windows nt 6\.0/", $agent))        { $s = "Vista"; }
    else if(preg_match("/windows nt 6\.1/", $agent))        { $s = "Windows7"; }
    else if(preg_match("/windows nt 6\.2/", $agent))        { $s = "Windows8"; }
    else if(preg_match("/windows 9x/", $agent))             { $s = "ME"; }
    else if(preg_match("/windows ce/", $agent))             { $s = "CE"; }
    else if(preg_match("/mac/", $agent))                    { $s = "MAC"; }
    else if(preg_match("/linux/", $agent))                  { $s = "Linux"; }
    else if(preg_match("/sunos/", $agent))                  { $s = "sunOS"; }
    else if(preg_match("/irix/", $agent))                   { $s = "IRIX"; }
    else if(preg_match("/phone/", $agent))                  { $s = "Phone"; }
    else if(preg_match("/bot|slurp/", $agent))              { $s = "Robot"; }
    else if(preg_match("/internet explorer/", $agent))      { $s = "IE"; }
    else if(preg_match("/mozilla/", $agent))                { $s = "Mozilla"; }
    else { $s = "기타"; }

    return $s;
}

function escape_trim($field) {
    $str = call_user_func("mysql_escape_string", $field);
    return $str;
}

// XSS 관련 태그 제거
function clean_xss_tags($str) {
    $str = preg_replace('#</*(?:applet|b(?:ase|gsound|link)|embed|frame(?:set)?|i(?:frame|layer)|l(?:ayer|ink)|meta|object|s(?:cript|tyle)|title|xml)[^>]*+>#i', '', $str);
    return $str;
}

function add_price($ordnum) {

	$conn = dbconn();
	$add_result = QRY_LIST("talent_order", "all", "1", " and parent_ordernum='$ordnum' ", " idx ");
	$add_p ="0";
	$payment_price ="0";
	while($add_row = mysqli_fetch_array($add_result)) {
		$use_point = replace_out($add_row["use_point"]);
		$coupon_price = replace_out($add_row["payment_coupon"]);
		$add_p = $add_p+$use_point+$coupon_price;
	}
	return $add_p;
}

function is_mobile()
{
    return preg_match('/phone|samsung|lgtel|mobile|[^A]skt|nokia|blackberry|android|sony/i', $_SERVER['HTTP_USER_AGENT']);
}

function get_picture($idx) {
	$result_mem = QRY_VIEW("member", " and mem_idx='$idx'");
	$row_mem = mysqli_fetch_array($result_mem);
	$file0 = replace_out($row_mem["file0"]);
	if($file0) {
		$pic="<img src='/upload/file/".$file0."' class='photo-img' id='pic'>";
	}else{
		$pic="<img src='/buyer/img/icon-user.png' class='photo-img' id='pic'>";
	}

	return $pic;
}
function get_picture2($idx) {
	$result_mem = QRY_VIEW("member", " and mem_idx='$idx'");
	$row_mem = mysqli_fetch_array($result_mem);
	$file0 = replace_out($row_mem["file0"]);
	if($file0) {
		$pic="<img src='/upload/thum/".$file0."'>";
	}else{
		$pic="<img src='/img/photo-noimg.png'>";
	}

	return $pic;
}



//회원테이블 사진 경로만.
function get_picture_src($idx,$num) {
	global $nopic, $file_path;
	//global $file_path;
	$result_mem = QRY_VIEW("member", " and mem_idx='$idx'");
	$row_mem = mysqli_fetch_array($result_mem);
	$_file = replace_out($row_mem["file".$num]);
	if($_file) {
		$src = $file_path.$_file;
	}else{
		$src = $nopic;
	}


	return $src;
}

function get_picture_board($idx,$num,$nopic) {
	$result_mem = QRY_VIEW("board", " and idx='$idx'");
	$row_mem = mysqli_fetch_array($result_mem);
	$file0 = replace_out($row_mem["file".$num]);
	if($file0) {
		$pic="<img src='/upload/thum/".$file0."'  name='asdf' id='pic".$num."'  class='photo' width='138' height='88'>";
	}else{
		$pic="<img src='$nopic' class='photo'  name='asdf' id='pic".$num."'  class='photo' width='138' height='88'>";
	}


	return $pic;
}

function sns_kind($sns_id) {
	if(strstr($sns_id,'kko')) {
		return "카카오톡";
	}
	if(strstr($sns_id,'ggl')) {
		return "구글";
	}
	if(strstr($sns_id,'fcb')) {
		return "페이스북";
	}
	if(strstr($sns_id,'nid')) {
		return "네이버";
	}

}

function get_point($mem_idx) {
	if($mem_idx) {
	$p =get_want ("member_point", "sum(point)", " and (gubun='P' or  gubun='p') and mem_idx='".$mem_idx."'");
	$m =get_want ("member_point", "sum(point)", " and (gubun='M' or  gubun='m') and mem_idx='".$mem_idx."'");
	$point = $p-$m;
	}else{
	$point=0;
	}
	return $point;
}
function get_point_m($mem_idx) {
	if($mem_idx) {
	$m =get_want ("member_point", "sum(point)", " and (gubun='M' or  gubun='m') and mem_idx='".$mem_idx."'");
	$point = $m;
	}else{
$point=0;
	}
	return $point;
}

function get_point_p($mem_idx,$search,$order_id) {
	$conn = dbconn();
	$result = QRY_VIEW("board_category",$search);
	$row = mysqli_fetch_array($result);

	$code = replace_out($row["ca_id"]);
	$point = replace_out($row["etc1"]);
	$etc = replace_out($row["etc2"]);
	$yn = replace_out($row["yn"]);
	$log_date =date("Y-m-d H:i:s");
	$today =date("Y-m-d");

	if($yn=="y") {
		if($point>0) {
			$sql = " insert into member_point set
					mem_idx =  '$mem_idx'
					,gubun =  'P'
					,code =  '$code'
					,point =  '$point'
					,reg_date =  '$log_date'
					,etc =  '$etc'
					,order_id =  '$order_id'";
					echo $sql;
			$result=mysqli_query($conn,$sql) or die ("SQL ERROR : ".mysqli_error($conn));
		}
	}
}

//2021-09-15 KSR 콘솔쓰기
function console_log($tt, $msg){
	echo "<script language='javascript'>
			console.log(\"$tt\", \"$msg\");
		</script>";
}

function chk_login($fd) {
	if(!$_SESSION["MEM_IDX"]) {
		Page_Msg_Url("로그인 후 이용가능합니다", "/member/login.php");
	}
}
function chk_login2() {
	if(!$_SESSION["MEM_IDX"]) {
		Page_Parent_Msg_Url("로그인 후 이용가능합니다", "$fd/member/login.php");
	}
}

function chk_login_url($url) {
	if(!$_SESSION["MEM_IDX"]) {
		Page_Msg_Url("로그인 후 이용가능합니다", "/member/login.php?next_url=$url");
	}
}

function chk_login_url2($url) {
	if(!$_SESSION["MEM_IDX"]) {
		Page_Url("/member/login.php?next_url=$url");
	}
}

function loged($fd) {
	if($_SESSION["MEM_IDX"]) {
		Page_Url("$fd/");
	}
}

function get_arr2($no,$bet) {
	$get_arr=$bet;
	for($i=0; $i<count($no); $i++) {
		$get_arr .= "$no[$i]".$bet;
	}
	return $get_arr;

}
function get_arr($no) {
	for($i=0; $i<count($no); $i++) {
		if($i==0) {
			$get_arr = "$no[$i]";
		}else{
			$get_arr .= ",$no[$i]";
		}
	}
	return $get_arr;
}

function get_checked($val1,$val2) {
	//$val1=문장;$val2=찾으려는문자
	$chk =strpos($val1,$val2);
	if (!empty($chk)) {
		$chk = "checked";
	}else{
		$chk = "";
	}
	return $chk;
}

function get_sido($id) {
	$conn = dbconn();
	echo '<tr id="tr'.$id.'">
			<td><select class="form__select" style="width:30%;" id="sido'.$id.'" name="sido'.$id.'" onchange="chg_sido('.$id.',this.value);">
				<option value="">::시/도::</option>';
				$sql = "SELECT co_si FROM zipcode GROUP BY co_si";
				$result=mysqli_query($conn,$sql) or die ("SQL ERROR : ".mysqli_error($conn));
				while($row = mysqli_fetch_array($result)) {
					$pg=$id+1;
					$result22 =QRY_LIST("expert_area",1,$pg," and mem_idx='".$_SESSION["MEM_IDX"]."'", " idx");
					while($row22 = mysqli_fetch_array($result22)) {
						$sido = $row22["sido"];
						if($sido==$row['co_si']) {
							$sel="selected";
							?>
							<script type="text/javascript">
							<!--
								chg_sido('<?=$id?>','<?=$sido?>');
							//-->
							</script>
							<?
						}else{
							$sel="";
						}
					}

					echo '<option value="'.$row['co_si'].'" '.$sel.'>'.$row['co_si'].'</option>';
				}
				echo '</select>';
				echo '
				<span id="setgugun'.$id.'">
				<select class="form__select" style="width:30%;" id="gugun'.$id.'" name="gugun'.$id.'">
						<option value="">::구/군::</option>
				 </select>
				 </span>
				 <a href="javascript:btndelrow('.$id.')" class="woobar-btn woobar-btn__small" style="background: #414453; color:#fff; border:0px;">삭제</a>
			</td>
		 </tr>
		 ';
}
function get_star($review) {
	$star_val = "";
	$f_star = floor($review);
	for($r=1;$r<=$review;$r++) {
		$star_val .= '<img src="../img/icon-star-on.png">';

	}
	$f_star2=5-$review;
	for($r=1;$r<=$f_star2;$r++) {
		$star_val .= '<img src="../img/icon-star.png">';
	}

	return $star_val;
}
function get_expert($mem_idx,$want) {
	global $conn;
	$wantsql = " select $want as wantvalue from member where 1=1 and mem_idx='$mem_idx' ";

	$wantresult=mysqli_query($conn,$wantsql);
	$wantrow = mysqli_fetch_array($wantresult);
	$wantvalue = $wantrow["wantvalue"];

	return $wantvalue;
}
//회원 보유포인트 조회
function get_points($mem_idx) {
	$sql = "select ifnull(sum(point),0) as point from member_point where mem_idx='$mem_idx' ";
	$row = sql_fetch($sql);
	return $row["point"];
}

//콤마 시공분야 idx -> 슬래쉬(/) 시공분야명 반환
function get_cate_nm_coma($arr) {
	$str = "";
	$sql = "select ca_name from board_category where ca_gubun='CT003' and ca_id IN($arr)";
	$result = sql_query($sql);
	$i=0;
	while($row = sql_fetch_array($result)) {
		$str .= ($i==0)? $row["ca_name"] : " / ".$row["ca_name"];
		$i++;
	}
	return $str;
}
//전문가쪽 코드 이름 반환
function get_pro_code($ty,$code) {
	$sql = "select code_nm from pro_code where code_ty='$ty' and code='$code' ";
	$row = sql_fetch($sql);
	$code_nm = $row["code_nm"];
	return $code_nm;
}

function get_new_od_id2() {
	$conn = dbconn();

    // 주문서 테이블 Lock 걸고
   // sql_query(" LOCK TABLES $g4[yc4_order_table] READ, $g4[yc4_order_table] WRITE ", FALSE);
    // 주문서 번호를 만든다.
    $od_id = date("Ymdhms", time()).RndomNum(5);    // 2002년 3월 7일 일경우 020307
    // 주문서 테이블 Lock 풀고
   // sql_query(" UNLOCK TABLES ", FALSE);

    return $od_id;
}
//결제수단명
function get_pay_nm($pay_code) {
	$sql = "select method_nm from pay_method where pay_code='$pay_code' ";
	$row = sql_fetch($sql);
	return $row["method_nm"];
}
//전문가 이름 가져오기
function get_expert_name($mem_idx)
{

	if($mem_idx) {
		$row = sql_fetch(" select expert_name from member where mem_idx = TRIM('$mem_idx') ");
		return $row['expert_name'];
	}else{
      return "";
	}
}

//board_cate 코드명 반환
function get_board_cate($ca_gubun,$ca_id) {
		$row = sql_fetch(" select ca_name from board_category where ca_gubun='$ca_gubun' and ca_id = '$ca_id' ");
		return $row['ca_name'];
}

//프로쪽 카트정보 UPDATE
function pro_cart_up($cart_idx, $s_id, $mem_idx) {
	get_update("pro_cart", "mem_idx='$mem_idx', session_id='' ", " and session_id='$s_id' ");
	if($cart_idx) {
		get_update("pro_cart", "cart_ty='cart'", " and cart_ty='pay' and mem_idx='$mem_idx' and cart_idx NOT IN($cart_idx) ");
	}
}

//주문 번호로 '시공의뢰일' 예약불가 처리
function set_req_sch($odr_no) {
	$req_date = get_want("pro_cart", "req_date", " and odr_no='$odr_no' ");
	$pro_idx = get_want("pro_cart", "pro_idx", " and odr_no='$odr_no' ");
	$sql = "INSERT INTO pro_sche_set SET
			set_ty = 'req'
			,pro_idx ='$pro_idx'
			,set_date = '$req_date'
			,set_val = '2'
			,set_memo = '고객 의뢰'
			,reg_date = now()
			";
	$result = sql_query($sql);
	return $result;
}

//입금계좌 가져오기(은행명 + 계좌번호)
function get_bank($idx) {
	$wantsql = "SELECT * FROM bank_account WHERE ba_idx=$idx";
	$wantresult=mysqli_query($conn,$wantsql);
	$wantrow = mysqli_fetch_array($wantresult);
	$bank_account = $wantrow["bank_account"];
	$bank_name = $wantrow["bank_name"];
	$bank_owner = $wantrow["bank_owner"];
	return $bank_name." ".$bank_account." ".$bank_owner;
}

//입금계좌 배열 반환
function get_bank_info($idx) {
	$rst = sql_query("SELECT * FROM bank_account WHERE ba_idx=$idx");
	$row=sql_fetch_array($rst);
	$b_name = replace_out($row["bank_name"]);
	$b_account = replace_out($row["bank_account"]);
	$b_owner = replace_out($row["bank_owner"]);
	return array("b_name" => $b_name, "b_account" => $b_account, "b_owner" => $b_owner);

}

function send_mail($frommail, $tomail, $toname, $html, $subject) {
	require $_SERVER["DOCUMENT_ROOT"] . "/PHPMailer/PHPMailerAutoload.php";

	$mail = new PHPMailer;	//Create a new PHPMailer instance
	$mail->isSMTP();			//Tell PHPMailer to use SMTP
	$mail->SMTPDebug = 0;	//0:off / 1:client / 2:cliend and server
	$mail->Debugoutput = 'html';		//Ask for HTML-friendly debug output
	$mail->CharSet = "utf-8";
	$mail->Host = "smtp.cafe24.com";
	$mail->Port = 587;
	$mail->SMTPSecure = "SSL";
	$mail->SMTPAuth = true;			//Whether to use SMTP authentication
	$mail->Username = "webmaster@xmail01.cafe24.com";	//Username to use for SMTP authentication
	$mail->Password = "whgdmstodrkr0070";						//Password to use for SMTP authentication
	$mail->setFrom($frommail, $sitename);
	$mail->addReplyTo($frommail, $sitename);
	$mail->addAddress($tomail, $toname);		//받는 사람
	$mail->Subject = $subject;
	$mail->msgHTML($html);		//메일내용
	//$mail->AltBody = 'Temporary your password:'.$tmp_pass;
	//send the message, check for errors
	if (!$mail->send()) {
//		echo "Mailer Error: " . $mail->ErrorInfo;
		return false;
	} else {
//		echo "Message sent!";
		return true;
	}
}	//end of function send_mail()

function send_mail2($frommail, $tomail, $toname, $html, $subject) {
	$mail = new PHPMailer;	//Create a new PHPMailer instance
	$mail->isSMTP();				//Tell PHPMailer to use SMTP
	$mail->SMTPDebug		= 0;	//0:off / 1:client / 2:cliend and server
	$mail->Debugoutput	= 'html';		//Ask for HTML-friendly debug output
	$mail->CharSet			= "utf-8";
	//$mail->Host				= "ppm2019.co.kr";
	$mail->Host				= "smtp.cafe24.com";
	$mail->Port				= 587;
	$mail->SMTPSecure		= "SSL";
	//$mail->SMTPSecure		= "TLS";	//좋은생각 웹메일 계정
	$mail->SMTPAuth		= true;			//Whether to use SMTP authentication
	//$mail->Username		= "webmaster@ppm2019.co.kr";	//Username to use for SMTP authentication
	$mail->Username		= "webmaster@xmail01.cafe24.com";	//Username to use for SMTP authentication
	//$mail->Password			= "ppm2019!";						//Password to use for SMTP authentication
	$mail->Password			= "whgdmstodrkr0070";						//Password to use for SMTP authentication
	$mail->setFrom($frommail, $sitename);
	$mail->addReplyTo($frommail, $sitename);
	$mail->addAddress($tomail, $toname);		//받는 사람
	$mail->Subject			= $subject;
	//$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));
	$mail->msgHTML($html);		//메일내용
	//$mail->AltBody			= 'Temporary your password:'.$tmp_pass;
	//send the message, check for errors
	if (!$mail->send()) {
		//echo "Mailer Error: " . $mail->ErrorInfo;
		return false;
	} else {
		//echo "Message sent!";
		return true;
	}
}	//end of function send_mail()

//전화번호 하이픈 넣기
function replace_tel_out($tel)
{
    $tel = preg_replace("/[^0-9]/", "", $tel);    // 숫자 이외 제거
    if (substr($tel,0,2)=='02')
        return preg_replace("/([0-9]{2})([0-9]{3,4})([0-9]{4})$/", "\\1-\\2-\\3", $tel);
    else if (strlen($tel)=='8' && (substr($tel,0,2)=='15' || substr($tel,0,2)=='16' || substr($tel,0,2)=='18'))
        // 지능망 번호이면
        return preg_replace("/([0-9]{4})([0-9]{4})$/", "\\1-\\2", $tel);
    else
        return preg_replace("/([0-9]{3})([0-9]{3,4})([0-9]{4})$/", "\\1-\\2-\\3", $tel);
}

//전화번호 숫자남 김기기
function replace_tel_in($num) {
	 $num = preg_replace("/[^0-9]/", "", $num);    // 숫자 이외 제거
	 return $num;
}

function get_star_name($name) {
	$name_len =mb_strlen($name,'UTF-8');
	$val = mb_substr($name,0,2,'UTF-8');
	for($i=3;$i<=$name_len;$i++) {
		$val .="*";
	}
	return $val;
}

//팬유 : 환율정보 가져오기 - KSR
function get_exch_rate() {
	$rst = sql_query("Select exch_rate From exchange_rate order by exch_idx DESC Limit 1");
	$row = sql_fetch_array($rst);
	return $row["exch_rate"];
}

//팬유 : 미화 계산
function calcu_exch_price($price) {
	if($price>0) {
		$_exch_rate = get_exch_rate();
		$_exch_price = round($price/$_exch_rate,2);
	}else{
		$_exch_price = 0;
	}

	return $_exch_price;
}
//팬유 : 추가정보(게시판 단일 글)가져오기 - KSR
function get_add_info($code, $lang) {
	/**
	$rst = sql_query("Select content_$lang As info_txt From board Where gubun='$code' order by idx DESC Limit 1");
	$r = sql_fetch_array($rst);
	$info_txt = replace_out($r["info_txt"]);
	return $info_txt;
	**/
	return get_want("board", "content_$lang", " and gubun='$code'");
}

//팬유 : 메시지 가져오기 - KSR
function get_msg($idx, $lang="en") {
	return get_want("message", "msg_$lang", " and msg_idx='$idx'");
}
//공용코드 값 - KSR
function get_code_nm($ca_gubun, $ca_id) {
	return get_want("category", "ca_name", " and ca_gubun='$ca_gubun' and ca_id='$ca_id'");
}

//팬유 : 공용코드 select option 반환 - KSR
function get_cate_opt($ca_gubun,$val,$lang="en") {
	$cate_rst = sql_query("select ca_id, ca_name_$lang AS ca_name from category Where ca_gubun='$ca_gubun' order by ca_sort ASC ");
	while($cate_row=sql_fetch_array($cate_rst)) {
		$ca_id = $cate_row["ca_id"];
		$ca_name = $cate_row["ca_name"];
		$_sel = ($val==$ca_id)?"selected":"";
		echo "<option value=\"$ca_id\" $_sel>$ca_name</option>";
	}
}

//팬유 : 회원 정보중 특정 항목(컬럼) 가져오기
function get_mem_info_col($mem_idx, $col) {
	return get_want("member", $col, " and mem_idx=$mem_idx");
}

//팬유 : 오프라인 샵(판매점) 이름 가져오기
function get_shop_name($shop_idx,$lang="en") {
	return get_want("shop_info", "shop_name_".$lang, " and shop_idx=$shop_idx");
}

//팬유 : 결제수단 이름 가져오기
function get_pay_method_name($code,$lang="en") {
	return get_want("pay_method", "paym_name_".$lang, " and paym_code='$code'");
}

//팬유 : 기본배송비 가져오기
//2020-12-03 0원 상품도 있음
function get_shipping_charge($sum_price) {
	//if($sum_price>0) {
		$cnt = QRY_CNT("shipping_charge", " and min_range <= $sum_price and max_range > $sum_price");
		if($cnt>0) {
			$shipping_price = get_want("shipping_charge", "shipping_price", "and min_range <= $sum_price and max_range > $sum_price");
		}else{
			$shipping_price = 0;
		}
	//}else{
		//$shipping_price = 0;
	//}

	return $shipping_price;
}

//팬유 : 설정값 체크
function check_setting() {
	//언어
	if(!$_SESSION["LANG"]) {
		//2020-06-29 KSR
		//2020-07-14 KIMO
		if($_SERVER['REQUEST_URI'] != "/setting/lang.php" && $_SERVER['REQUEST_URI'] != "/setting/mypagecountry.php" && $_SERVER['REQUEST_URI'] != "/setting/won.php") {
			Page_Url("/setting/lang.php");
			die;
		}
	}
	//국가2020-09-16

	if(!$_SESSION["COUNTRY"]) {
		if($_SERVER['REQUEST_URI'] != "/setting/lang.php" && $_SERVER['REQUEST_URI'] != "/setting/mypagecountry.php" && $_SERVER['REQUEST_URI'] != "/setting/won.php") {
			Page_Url("/setting/mypagecountry.php");
			die;
		}
	}
	//통화2020-09-16

	if(!$_SESSION["CURRENCY"]) {
		if($_SERVER['REQUEST_URI'] != "/setting/lang.php" && $_SERVER['REQUEST_URI'] != "/setting/mypagecountry.php" && $_SERVER['REQUEST_URI'] != "/setting/won.php") {
			Page_Url("/setting/won.php");
			die;
		}
	}


}

//팬유 : 비 노출 판매점 콤마 배열
function no_display_shop() {
	$rst = sql_query("Select shop_idx From shop_info Where display_yn='N'");
	$cnt=0;
	$shop_arr="";
	while($row=sql_fetch_array($rst)) {
		$shop_idx = $row["shop_idx"];
		if($cnt==0) {
			$shop_arr = $shop_idx;
		}else{
			$shop_arr .= ", ".$shop_idx;
		}
		$cnt++;
	}
	return $shop_arr;
}

//팬유 : 1인당 구매 제한 여부 체크(가능:true/불가:false) 2020-07-19 KSR
function psn_buy_chk($mem_idx, $goods_idx, $qty) {
	$chk = false;
	//해당 상품의 1인당 총 구매제한 수량
	$ea_p_max = get_want("goods", "ea_p_max", " and idx=$goods_idx");
	//현재 해당 회원의 총 구매 수량
	$mem_orderd_qty = get_want("goods_cart a INNER JOIN goods_order b ON a.order_idx=b.order_idx", "sum(a.cart_qty)", " and b.order_stat NOT IN('OD00' ,'OD99') and a.mem_idx=$mem_idx and a.goods_idx=$goods_idx");
	if($ea_p_max >= ($mem_orderd_qty+$qty)) {
		$chk = true;
	}else{
		$chk = false;
	}

	return $chk;
}

//팬유 : 해외 배송비(우체국) 계산(환율까지 계산해서 달러 반환)
//2020-07-15 환율계산 빼자... 해당 화면의 통화설정으로 계산
function global_shipping_charge($countrycd, $totweight) {

	$curl = curl_init();
	//EMS 프리미엄 premiumcd => 31:EMS / 32:EMS프리미엄
	//2020-09-08 EMS 프리미엄(32)으로 변경??
	//2020-11-12 카톡 요청으로 프리미엄(32)으로 변경
	//2020-11-17 카톡 요청으로 일반(31)로 변경
	//2020-11-18 국가별 일반 or 프리미엄 조회
	$premiumcd = get_ems_cd($countrycd);
	if($premiumcd==0) {
		return 0;
		die;
	}

	$sql = "INSERT INTO ems_log SET
			countrycd = '$countrycd',
			totweight = '$totweight',
			reg_date = now()
		";
	$result = sql_query($sql);

	curl_setopt_array($curl, array(
	  CURLOPT_URL => "http://eship.epost.go.kr/api.EmsTotProcCmd.ems?regkey=d3172b6b3a55b7ff41592963115874&premiumcd=".$premiumcd."&em_ee=em&countrycd=".$countrycd."&totweight=".$totweight."&boyn=N&boprc=0",
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => "",
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 0,
	  CURLOPT_FOLLOWLOCATION => true,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => "GET",
	  CURLOPT_HTTPHEADER => array(
		"Cookie: PHAROS_VISITOR=000000000172e40bdc4435000ade2531"
	  ),
	));
	$response = curl_exec($curl);
	curl_close($curl);

	$object = simplexml_load_string($response);
	$suggest = $object->EmsTotProcCmd->emsTotProc;
	//$suggest = calcu_exch_price($suggest);//환율계산 주석 2020-07-15
	return $suggest;
}


//EMS 배송 종류(프리미엄코드) 반환 ***********************************************************************
function get_ems_cd($countrycd) {
	$ems_cd = 0;
	$object = ems_check(31);
	foreach($object -> RetrieveNationList as $ems) {
		//echo $ems->nationcd."<br>";
		if($countrycd == trim($ems->nationcd)) {
			$ems_cd = 31;
			break;
		}
	}

	if($ems_cd==0) {//일반에 없으면 프리미엄으로 한번 더
		$object = ems_check(32);
		foreach($object -> RetrieveNationList as $ems) {
			//echo $ems->nationcd."<br>";
			if($countrycd == trim($ems->nationcd)) {
				$ems_cd = 32;
				break;
			}
		}
	}

	return $ems_cd;
}
//EMS 배송 가능국가 조회 ***************************************************************************************************************************************
function ems_check($premiumcd) {
	$curl = curl_init();
	curl_setopt_array($curl, array(
		CURLOPT_URL => "http://eship.epost.go.kr/api.RetrieveNationListRequest.ems?regkey=d3172b6b3a55b7ff41592963115874&premiumcd=".$premiumcd,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "GET",
		CURLOPT_HTTPHEADER => array(
			"Cookie: PHAROS_VISITOR=000000000172e40bdc4435000ade2531"
			),
	));
	$response = curl_exec($curl);
	curl_close($curl);
	$object = simplexml_load_string($response);
	return $object;
}


//팬유 : 승인취소(이니시스) - KSR-------------------------------------------------------------
function exec_refund($order_idx,$key,$mid) {
	$pg_idx = get_want("goods_order", "pg_idx", " and order_idx=$order_idx");
	$fr_key = $key;
	$rf_type = "Refund";
	$pay_method = get_want("pg_result", "P_TYPE", " and pg_idx=$pg_idx");
	$rf_timestamp = date("YmdHis");
	$rf_clientIp = $_SERVER['REMOTE_ADDR'];
	$rf_mid = $mid;
	$rf_tid = get_want("pg_result", "P_TID", " and pg_idx=$pg_idx");	//pg사 TID
	$rf_msg = "고객 취소요청";
	$hash_data = hash('sha512', $fr_key.$rf_type.$pay_method.$rf_timestamp.$rf_clientIp.$rf_mid.$rf_tid);
	$arr_data = array(
				"type" => $rf_type,
				"paymethod" => $pay_method,
				"timestamp" => $rf_timestamp,
				"clientIp" => $rf_clientIp,
				"mid" => $rf_mid,
				"tid" => $rf_tid,
				"msg" => $rf_msg,
				"hashData" => $hash_data
				);
	$arr_qry = http_build_query($arr_data);
	$curl = curl_init();
	curl_setopt_array($curl, array(
	  CURLOPT_URL => "https://iniapi.inicis.com/api/v1/refund?".$arr_qry,
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => "",
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 0,
	  CURLOPT_FOLLOWLOCATION => true,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => "POST",
	));
	$response = curl_exec($curl);
	curl_close($curl);
	//echo $response;

	$rst_arr = json_decode($response);

	return $rst_arr;
	/**
	$resultCode = $rst_arr->resultCode;
	$resultMsg = $rst_arr->resultMsg;
	echo "<br><br>resultCode : ".$resultCode;
	echo "<br><br>resultMsg : ".$resultMsg;
	**/

}//end of 승인취소(이니시스)

//팬유 : 부분취소(이니시스) - KSR------------------------------------------------------------------
function exec_prefund($order_idx,$key,$mid,$rf_price,$rest_price) {
	$pg_idx = get_want("goods_order", "pg_idx", " and order_idx=$order_idx");
	$fr_key = $key;
	$rf_type = "PartialRefund";
	$pay_method = get_want("pg_result", "P_TYPE", " and pg_idx=$pg_idx");
	$rf_timestamp = date("YmdHis");
	$rf_clientIp = $_SERVER['REMOTE_ADDR'];
	$rf_mid = $mid;
	$rf_tid = get_want("pg_result", "P_TID", " and pg_idx=$pg_idx");	//pg사 TID
	$rf_msg = "고객 부분취소 요청";
	//$rf_price : 취소요청금액 / $rest_price : 부분취소 후 남은금액


	//hash(KEY+type+paymethod+timestamp+clientIp+mid+tid+price+confirmPrice)
	$hash_data = hash('sha512', $fr_key.$rf_type.$pay_method.$rf_timestamp.$rf_clientIp.$rf_mid.$rf_tid.$rf_price.$rest_price);

	$arr_data = array(
				"type" => $rf_type,
				"paymethod" => $pay_method,
				"timestamp" => $rf_timestamp,
				"clientIp" => $rf_clientIp,
				"mid" => $rf_mid,
				"tid" => $rf_tid,
				"msg" => $rf_msg,
				"price" => $rf_price,
				"confirmPrice" => $rest_price,
				"hashData" => $hash_data
				);
	$arr_qry = http_build_query($arr_data);
	$curl = curl_init();
	curl_setopt_array($curl, array(
	  CURLOPT_URL => "https://iniapi.inicis.com/api/v1/refund?".$arr_qry,
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => "",
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 0,
	  CURLOPT_FOLLOWLOCATION => true,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => "POST",
	));
	$response = curl_exec($curl);
	curl_close($curl);
	//echo $response;

	$rst_arr = json_decode($response);

	return $rst_arr;
	/**
	$resultCode = $rst_arr->resultCode;
	$resultMsg = $rst_arr->resultMsg;
	echo "<br><br>resultCode : ".$resultCode;
	echo "<br><br>resultMsg : ".$resultMsg;
	**/

}

function get_arr4($no) {
	for($i=0; $i<count($no); $i++) {
		if($i==0) {
			$get_arr = "$no[$i]";
		}else{
			$get_arr .= ",$no[$i]";
		}
	}
	return $get_arr;
}
function get_point_txt1($code) {

	$code=str_replace("", " ",$code);
	if($code=="banner") {
		$txt=get_msg(79, $_SESSION["LANG"]);
	}else if($code=="stamp") {
		$txt=get_msg(80, $_SESSION["LANG"]);
	}else if($code=="join") {
		$txt=get_msg(81, $_SESSION["LANG"]);
	}else if($code=="like2") {
		$txt=$w178[$n];
	}else if($code=="like3") {
		$txt=$w179[$n];
	}else if($code=="join") {
		$txt=$w180[$n];
	}else if($code=="recom") {
		$txt=$w189[$n];
	}else if($code=="upload") {
		$txt=$w182[$n];
	}else if($code=="write") {
		$txt=$w183[$n];
	}else{
		$txt=$w189[$n];
	}
	return $txt;
}

function point_UPDATE($mem_idx,$code,$limit,$point2,$addqry ) { //회원인덱스,포인트코드,원글제목,하루적립횟수,지정포인트
	$today = date("Y-m-d");
	$log_date = date("Y-m-d H:i:s");
	$cnt= get_want("member_point", "count(*)", " and mem_idx='$mem_idx' and gubun='P' and code='$code' and date_format(reg_date, '%Y-%m-%d')='$today'");
	if($cnt<$limit or $limit=='n') {
		if(!$point2) {
			$point=get_want("point_setting", "point", " and gubun='$code'");
		}else{
			$point=$point2;
		}
		$kr=get_want("point_setting", "content_kr", " and gubun='$code'");
		$en=get_want("point_setting", "content_en", " and gubun='$code'");
		get_insert("member_point", " mem_idx='$mem_idx', gubun='P', code='$code', point='$point', reg_date='$log_date', etc_kr='$kr',etc_en='$en' $addqry ");
	}
}
function point_UPDATE_m($mem_idx,$code,$point2, $addqry) { //회원인덱스,포인트코드,지정포인트
	$log_date = date("Y-m-d H:i:s");
	if(!$point2) {
		$point=get_want("point_setting", "point", " and gubun='$code'");
	}else{
		$point=$point2;
	}
	$kr=get_want("point_setting", "content_kr", " and gubun='$code'");
	$en=get_want("point_setting", "content_en", " and gubun='$code'");
	get_insert("member_point", " mem_idx='$mem_idx', gubun='M', code='$code', point='$point', reg_date='$log_date', etc_kr='$kr',etc_en='$en' $addqry ");
}


function getDistance($lat1, $lng1, $lat2, $lng2)
{
    $earth_radius = 6371;
    $dLat = deg2rad($lat2 - $lat1);
    $dLon = deg2rad($lng2 - $lng1);
    $a = sin($dLat/2) * sin($dLat/2) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin($dLon/2) * sin($dLon/2);
    $c = 2 * asin(sqrt($a));
    $d = $earth_radius * $c;
    return $d;
}



// D-day
function d_day($d_date) {



    $t_date = date('Y-m-d',time());

    $d_day = intval((strtotime($t_date) - strtotime($d_date)) / 86400);



    return $d_day;


}

//타임스템프(밀리세컨드까지)
function get_timestamp() {
	list($microtime, $tStamp) = explode(' ',microtime());
	$timestamp = $tStamp . substr($microtime, 2, 3);
	return $timestamp;
}

//2020-07-31 주문건의 아이템 묶음 반환
function get_order_title($order_idx) {
	$ct_sql = "Select goods_name, opt_name, opt_val, cart_qty From goods_cart Where order_idx=$order_idx ";
	$ct_rst = sql_query($ct_sql);
	$ct_cnt = 0;
	while($ct_row=sql_fetch_array($ct_rst)) {
		$goods_name = replace_out($ct_row["goods_name"]);
		$opt_name = replace_out($ct_row["opt_name"]);
		$opt_val = replace_out($ct_row["opt_val"]);
		$cart_qty = replace_out($ct_row["cart_qty"]);

		$order_title .=($ct_cnt>0)?"<br>":"";
		$order_title .=$goods_name;
		if($opt_name) {
			$order_title .="(".$opt_name.":".$opt_val.")";
		}
		$order_title .=" * ".$cart_qty;
		$ct_cnt++;
	}//end of while

	return $order_title;
}

//2020-07-31 재고 없으면 품절 처리
function set_soldout() {
	get_update("goods", "soldout_yn='y'", " and ea_amount<=0");
	//2020-10-23 재고 체크하면서 수량 있으면 '품절' 풀림, 관리자가 임의 설정했을경우 문제가 됨
	//get_update("goods", "soldout_yn='n'", " and ea_amount>0");
}

//2020-08-27 배송. 주문=>품목 단위 변경에 따른 '주문'상태 체크
function chk_all_delv($order_idx) {
	$_AllCnt = QRY_CNT("goods_cart", " and order_idx=$order_idx");
	$_DelvCnt = QRY_CNT("goods_cart", " and order_idx=$order_idx and CHAR_LENGTH(delv_no)>0");
	return ($_AllCnt==$_DelvCnt) ? true : false;
}

//2020-09-01 주문상품 중 대표 상품명(1개) 가져오기
function get_goods_one($order_idx, $lang) {
	$order_cnt = QRY_CNT("goods_cart", " and order_idx=$order_idx");
	$goods_name = replace_out(get_want("goods_cart", "goods_name", " and order_idx=$order_idx order by cart_idx DESC limit 1"));
	if($order_cnt > 1) {//상품 여러개
		$goods_name .= ($lang=="kr") ? " 외" : " etc";
	}
	return $goods_name;

}

//2020-09-04 주문 번호로 옵션재고 체크하여 재고 차감 및 증가
function stock_UPDATE($order_idx, $typ) {
	//1. 주문번호로 가트 반복
	$cRst = sql_query("select cart_idx, goods_idx, cart_qty, opt_idx from goods_cart Where order_idx=$order_idx");

	while($cRow = sql_fetch_array($cRst)) {

		$cart_idx = $cRow["cart_idx"];
		$goods_idx = $cRow["goods_idx"];
		$cart_qty = $cRow["cart_qty"];
		$opt_idx = $cRow["opt_idx"];

		//2. 옵션에 재고 들어있는지의 여부
		if($opt_idx) {
			$opt_stock = get_want("goods_option", "opt_amount", " and idx=$opt_idx");
			if($opt_stock>0) {
				//3. 상품 옵션 재고수량 UPDATE
				$sql = "UPDATE goods_option SET ";
				if($typ=="P") {
					$sql .= "opt_amount = opt_amount + $cart_qty ";
				}else{
					$sql .= "opt_amount = opt_amount - $cart_qty ";
				}
				$sql .= "Where idx=$opt_idx";
				$Rst = sql_query($sql);
			}
		}

		//3. 상품 통합 재고수량 UPDATE
		$sql = "UPDATE goods SET ";
		if($typ=="P") {
			$sql .= "ea_amount = ea_amount + $cart_qty ";
		}else{
			$sql .= "ea_amount = ea_amount - $cart_qty ";
		}
		$sql .= "Where idx=$goods_idx";

		$Rst = sql_query($sql);
	}//end of while

	set_soldout();//품절처리

}

//주문 상태별 날짜 UPDATE
function UPDATE_odr_date($order_idx, $stat) {
	switch ($stat) {
	  case "OD20":	//결제완료(입금확인)
		get_update("goods_order", "pay_date=now()", " and order_idx=$order_idx");
		break;
	  case "OD50":	//구매확정(배송완료)
		get_update("goods_order", "done_date=now()", " and order_idx=$order_idx");
		break;
	  case "OD80":	//취소요청
		get_update("goods_order", "cancel_req_date=now()", " and order_idx=$order_idx");
		break;
	  case "OD85":	//취소완료
		get_update("goods_order", "cancel_date=now()", " and order_idx=$order_idx");
		break;
	}
}

//주문정보 UPDAE - 카트 상태 체크하여...
function eq_odr_cart($order_idx, $stat) {
	//1. 카트 갯수
	$cart_cnt = QRY_CNT("goods_cart", " and order_idx=$order_idx ");
	//2. 해당 상태 상태 갯수
	$stat_cnt = QRY_CNT("goods_cart", " and order_idx=$order_idx and order_stat='$stat' ");
	//3. 카트의 전체 상태가 같으면 주문테이블 상태 UPDATE
	if($cart_cnt==$stat_cnt) {
		get_update("goods_order", "order_stat='$stat', edit_date=now()", " and order_idx=$order_idx ");

		//상태에 따른 날짜 UPDATE
		if($stat=="OD50") {//구매확정
			get_update("goods_order", "cone_date=now()", " and order_idx=$order_idx ");
		}
		if($stat=="OD80") {//취소요청
			get_update("goods_order", "cancel_req_date=now()", " and order_idx=$order_idx ");
		}
		if($stat=="OD85") {//취소완료
			get_update("goods_order", "cancel_date=now()", " and order_idx=$order_idx ");
		}
	}
}

//정산정보 UPDAE - 카트 상태 체크하여...
function eq_calcu_cart($order_idx, $stat) {
	//1. 카트 갯수
	$cart_cnt = QRY_CNT("goods_cart", " and order_idx=$order_idx ");
	//2. 해당 상태 상태 갯수
	$stat_cnt = QRY_CNT("goods_cart", " and order_idx=$order_idx and calcu_stat='$stat' ");
	//3. 카트의 전체 상태가 같으면 주문테이블 상태 UPDATE
	if($cart_cnt==$stat_cnt) {
		get_update("goods_order", "calcu_stat='$stat', edit_date=now()", " and order_idx=$order_idx ");
	}
}


/**
공유백서 : 채팅방 URL 반환(2021-07-28 수정) - KSR
$propose_idx : 게시 글(deal) idx / corp_idx : 게시글 작성자(판매 주체) / $user_idx : 구매자(이용자)
**/
function get_chat_url($user_idx, $corp_idx, $myidx, $propose_idx=0) {
	global $conn, $uCahtUrl, $cCahtUrl, $log_ip;

	//1. 채팅방 존재 여부
	$room_idx = get_want("chat_room", "room_idx", " and propose_idx=$propose_idx and user_mem_idx=$user_idx and corp_mem_idx=$corp_idx");


	if($room_idx) {//--------------- 있다. -----------------
		get_update("chat_room", "propose_idx=$propose_idx", " and room_idx=$room_idx");

	}else{		//------------------- 없다. -----------------
		//거래 구분
		$deal_gbn = get_want("deal", "deal_gbn", " and idx=$propose_idx");
		$sql = "INSERT INTO chat_room SET
				user_mem_idx=$user_idx, corp_mem_idx=$corp_idx, propose_idx=$propose_idx, contact_cate='$deal_gbn', reg_date=now()";
		$rst = sql_query($sql);
		$room_idx = @mysqli_insert_id($conn);

		//2020-12-16 채팅 초기 메시지
		$sql = "INSERT INTO chat SET
				room_no=$room_idx, typ='CHAT', send_id='0', send_msg='Hello! Ask any questionstous! We will help you :)', send_date=now(), reg_ip='$log_ip'";
		//$rst = sql_query($sql);//공유백서는 초기 메세지 없음.
	}//end of. 채팅방 없다 or 있다.


	if($myidx==$user_idx) {//내가 일반 사용자이면
		$base_url = $uCahtUrl;
		$conn_idx = $user_idx;
	}else{	//업체
		$base_url = $cCahtUrl;
		$conn_idx = $corp_idx;
	}
	$chat_url = $base_url."?typ=user&room=".$room_idx."&name=".$conn_idx;

	return $chat_url;

}

//채팅방 정보 - KSR
function get_chatroom_info($room) {
	$cnt = QRY_CNT("chat_room", " and room_idx=$room ");
	if($cnt>0) {//채팅방 있다
		$corp = get_want("chat_room", "corp_mem_idx", " and room_idx=$room ");
		$user = get_want("chat_room", "user_mem_idx", " and room_idx=$room ");
		$propose_idx = get_want("chat_room", "propose_idx", " and room_idx=$room ");
		$_strArray = array("code"=>"OK", "corp"=>$corp, "user"=>$user, "propose_idx"=>$propose_idx);
	}else{		//채팅방 없다.
		$_strArray = array("code"=>"error");
	}
	return $_strArray;
}

//채팅 - 소켓전송(자동메세지) 외 - KSR
function send_chat_auto($room_no, $mem_idx, $chat_idx) {
	global $CHAT_SERVER;

	$url = $CHAT_SERVER.'/auto/'.$room_no."/".$mem_idx."/".$chat_idx;
	$ch = curl_init($url);
	curl_setopt($ch,  CURLOPT_RETURNTRANSFER, true);
	curl_exec($ch);
	$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	curl_close($ch);
}

//채팅 자동 전송(템플릿) - KSR -------------------------------------------------------------
function insert_chat_auto($room_no, $mem_idx, $code, $req_idx=0) {
	global $conn, $file_thum, $nopic;

	$_time = date("H:i");

	$user_mem_idx = get_want("chat_room", "user_mem_idx", " and room_idx=$room_no");
	$corp_mem_idx = get_want("chat_room", "corp_mem_idx", " and room_idx=$room_no");

	$to_mem_idx = ($mem_idx==$user_mem_idx) ? $corp_mem_idx : $user_mem_idx;

	$user_nick = get_want("member", "mem_nickname", " and mem_idx=$user_mem_idx");
	$corp_nick = get_want("member", "mem_nickname", " and mem_idx=$corp_mem_idx");

	$mtRst =  QRY_VIEW("message_template", " and template_code='$code' ");
	$mtRow = sql_fetch_array($mtRst);
	$user_msg = $mtRow["user_msg"];
	$corp_msg = $mtRow["corp_msg"];
	$template_title = $mtRow["template_title"];

	//구매자 메세지 --------------------------------------------------
	$user_msg = str_replace("{idx}",$req_idx, $user_msg);
	$user_msg = str_replace("{시간}",$_time, $user_msg);
	$_snd_user_msg = $user_msg;

	//판매자 메세지 ---------------------------------------------------
	$corp_msg = str_replace("{idx}",$req_idx, $corp_msg);
	$corp_msg = str_replace("{시간}",$_time, $corp_msg);
	$_snd_corp_msg = $corp_msg;

	$sql1 = "INSERT INTO message_auto SET
			msg_code = '$stat'
			, propose_idx = '$propose_idx'
			, to_mem_idx = '$to_mem_idx'
			, from_mem_idx = '$mem_idx'
			, user_msg = '$_snd_user_msg'
			, corp_msg = '$_snd_corp_msg'
			, reg_date = now()
			";
	$Rst1 = sql_query($sql1);
	$msg_idx = mysqli_insert_id($conn);

	$sql2 = "INSERT INTO chat SET
			room_no = '$room_no'
			, typ = 'AUTO'
			, propose_idx = '$propose_idx'
			, send_id = '$mem_idx'
			, msg_idx = '$msg_idx'
			, send_date = now()
			";
	$Rst2 = sql_query($sql2);
	$chat_idx = mysqli_insert_id($conn);

	//2021-03-21 chat_room 테이블에 최근메세지 UPDATE
	$sql = "UPDATE chat_room SET
			send_idx = '$mem_idx',
			last_typ = 'AUTO',
			last_msg = '$template_title',
			last_date = now()
			WHERE room_idx= '$room_no'
			";
	$Rst3 = sql_query($sql);

	send_chat_auto($room_no, $mem_idx, $chat_idx);

}//end of. 채팅 자동 전송(템플릿) -----------------------------

function get_page_want($gubun) {
	if($gubun=="GD001") {
		return "new";
	}
	if($gubun=="GD002") {
		return "reaper";
	}
	if($gubun=="GD003") {
		return "reform";
	}
	if($gubun=="GD004") {
		return "repair";
	}
}

//topic 푸시 20210817 추가 강혜성
function send_push_topic($title, $memo, $link) {

	global $FCM_KEY, $FCM_URL, $FCM_TOPIC; //config.php
	global $conn;
	$web_server = "https://".$_SERVER['HTTP_HOST'];



	//푸시 대상
	$_to =  "/topics/".$FCM_TOPIC;


	$data = array(
		'title'=>$title,
		'body' =>$memo,
		'image'=>$web_server.$img_url,
		'link'=>$link,
		'content_available' => 1,
		'priority' => 'high',
		'remote' => true,
		'channelId'=>'share_paper'
	);

	$notification = array(
		'title'=>$title,
		'body'=>$memo,
		'badge'=>1,
		'link'=>$link,
		'sound'=>'default',
		'content_available'=>"true",
		'mutable_content'=>"true",
		'android_channel_id'=>'share_paper'
	);


	$headers = array(
		'Content-Type:application/json',
		'Authorization:key='.$FCM_KEY,
	);

	$fields = array();
	$fields['data'] = $data;
	$fields['notification'] = $notification;
	$fields['to'] = $_to;


		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $FCM_URL);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
		$result = curl_exec($ch);
		//푸시 내역 insert
		//	$sql = " insert into push_list set
		//			 title = '$title',
		//			 memo = '$memo',
		//			 reg_date= now(),
		//			 mem_idx= '0',
		//			 mem_name= '관리자',
		//			 mem_id= 'admin'
		//			";

		//	$result = mysqli_query($conn,$sql) or die ("SQL Error : ". mysqli_error($conn));

}


//token 푸시 20210817 추가 강혜성
function send_push_token($title, $memo, $linkurl, $token) {

	global $conn, $FCM_KEY, $FCM_URL, $FCM_TOPIC; //config.php

	$notification = array('title' => $title, 'body' => $memo, 'link' => $linkurl, 'android_channel_id'=>'share_paper', 'sound' => 'default','content_available'=>"true",'mutable_content'=>"true", 'badge' => '1');
	$data = array('title' => $title, 'body' => $memo, 'link' => $linkurl, 'channelId'=>'share_paper');
	$arrayToSend = array('to' =>$token , 'notification' => $notification, 'data' => $data, 'priority'=>'high');
	$data = json_encode($arrayToSend);

	//FCM API end-point
	$url = $FCM_URL;

	//api_key in Firebase Console -> Project Settings -> CLOUD MESSAGING -> Server key
	$server_key =$FCM_KEY;

	//header with content_type api key
	$headers = array(
		'Content-Type:application/json',
		'Authorization:key='.$server_key
	);
	//CURL request to route notification to FCM connection server (provided by Google)
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	$result = curl_exec($ch);
	if ($result === FALSE) {
		die('Oops! FCM Send Error: ' . curl_error($ch));
	}


	curl_close($ch);


	$sql = " insert into push_list set
			 title = '$title'
			,memo = '$memo'
			,reg_date= now() ";
			echo $sql;
	
	$result=mysqli_query($conn,$sql) or die ("SQL ERROR : ".mysqli_error($conn));


}

//거래 푸시 시작 20210826 추가 강혜성
function send_deal_push1($title, $memo, $linkurl, $token) {

	global $conn, $FCM_KEY, $FCM_URL, $FCM_TOPIC; //config.php

	$notification = array('title' => $title, 'body' => $memo, 'link' => $linkurl, 'android_channel_id'=>'share_paper', 'sound' => 'default','content_available'=>"true",'mutable_content'=>"true", 'badge' => '1');
	$data = array('title' => $title, 'body' => $memo, 'link' => $linkurl, 'channelId'=>'share_paper');
	$arrayToSend = array('to' =>$token , 'notification' => $notification, 'data' => $data, 'priority'=>'high');
	$data = json_encode($arrayToSend);

	//FCM API end-point
	$url = $FCM_URL;

	//api_key in Firebase Console -> Project Settings -> CLOUD MESSAGING -> Server key
	$server_key =$FCM_KEY;

	//header with content_type api key
	$headers = array(
		'Content-Type:application/json',
		'Authorization:key='.$server_key
	);
	//CURL request to route notification to FCM connection server (provided by Google)
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	$result = curl_exec($ch);
	if ($result === FALSE) {
		die('Oops! FCM Send Error: ' . curl_error($ch));
	}


	curl_close($ch);

	//푸시 내역 insert
	$sql = " insert into push_list set
			 title = '$title',
			 memo = '$memo',
			 reg_date= now()";	
			 echo $sql;

	$result = mysqli_query($conn, $sql) or die ("SQL Error push_list : ". mysqli_error($conn));


}

function send_deal_push2($title, $memo, $linkurl, $token) {

	global $conn, $FCM_KEY, $FCM_URL, $FCM_TOPIC; //config.php

	$notification = array('title' => $title, 'body' => $memo, 'link' => $linkurl, 'android_channel_id'=>'share_paper', 'sound' => 'default','content_available'=>"true",'mutable_content'=>"true", 'badge' => '1');
	$data = array('title' => $title, 'body' => $memo, 'link' => $linkurl, 'channelId'=>'share_paper');
	$arrayToSend = array('to' =>$token , 'notification' => $notification, 'data' => $data, 'priority'=>'high');
	$data = json_encode($arrayToSend);

	//FCM API end-point
	$url = $FCM_URL;

	//api_key in Firebase Console -> Project Settings -> CLOUD MESSAGING -> Server key
	$server_key =$FCM_KEY;

	//header with content_type api key
	$headers = array(
		'Content-Type:application/json',
		'Authorization:key='.$server_key
	);
	//CURL request to route notification to FCM connection server (provided by Google)
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	$result = curl_exec($ch);
	if ($result === FALSE) {
		die('Oops! FCM Send Error: ' . curl_error($ch));
	}


	curl_close($ch);

	//푸시 내역 insert
	$sql = " insert into push_list set
			 title = '$title',
			 memo = '$memo',
			 reg_date= now()";	
			 echo $sql;

	$result = mysqli_query($conn, $sql) or die ("SQL Error push_list : ". mysqli_error($conn));


}
//거래푸시 끝

// 문자열 바이트로 커팅
function str_cutting($string, $len) {
	if(strlen($string) < $len) {
	   return $string;
	} else {
	   $string = substr($string, 0, $len);
	   $cnt = 0;
	   for ($i = 0; $i < strlen($string); $i++) {
		   if (ord($string[$i]) > 127) $cnt++; //한글일 경우 2byte 옮김,자릿수
		   $string = substr($string, 0, $len - ($cnt % 3));
		   $string .= ".."; //커팅된 문자열에 꼬리부분을 붙여서 리턴

		   return $string;
	   }
	}
}

//휴대폰번호 중간 하이픈
function hyphen_hp_number($hp)
{
    $hp = preg_replace("/[^0-9]/", "", $hp);
    return preg_replace("/([0-9]{3})([0-9]{3,4})([0-9]{4})$/", "\\1-\\2-\\3", $hp);
}



//////////////////////////////////////////////////////////
//입금계좌관련
//은행명
$banks['003'] = "IBK기업은행";
$banks['004'] = "KB국민은행";
$banks['005'] = "외환은행";
$banks['007'] = "수협은행";
$banks['011'] = "NH농협은행";
$banks['020'] = "우리은행";
$banks['023'] = "SC제일은행";
$banks['027'] = "한국씨티은행";
$banks['031'] = "대구은행";
$banks['032'] = "부산은행";
$banks['034'] = "광주은행";
$banks['035'] = "제주은행";
$banks['037'] = "전북은행";
$banks['039'] = "경남은행";
$banks['045'] = "새마을금고";
$banks['048'] = "신협";
//$banks['064'] = "산림조합";
$banks['071'] = "우체국";
$banks['081'] = "하나은행";
$banks['088'] = "신한은행";
$banks['089'] = "케이뱅크";
$banks['090'] = "카카오뱅크";


function getBankCode($name,$code=""){
  global $banks;
  if( 0 < count($banks) ){
    $str = "<select name='".$name."' id='".$name."' style='width:200px;'>";
	$str .= "<option value=''>은행명</option>";
    foreach( $banks as $i => $v ){
      $str .= "<option value='".$i."' ".($code > 0 && $i==$code?"selected":"").">";
     // $str .= "[".$i."] ".$v;
	  $str .= $v;
      $str .= "</option>";
    }
    $str .= "</select>";

    return $str;
  }
}

function getBankName($code){
	global $banks;
	foreach( $banks as $i => $v ){
		if($i==$code) $bankname = $v;
	}
	return $bankname;
}


////////////////////////////////////////////////////////////////
//웰컴페이먼츠 카드(은행)코드 - 2021.06.10
////////////////////////////////////////////////////////////////
$well_pfncd["01"] = "외환";
$well_pfncd["03"] = "롯데";
$well_pfncd["04"] = "현대";
$well_pfncd["06"] = "국민";
$well_pfncd["11"] = "BC";
$well_pfncd["12"] = "삼성";
$well_pfncd["14"] = "신한";
$well_pfncd["15"] = "한미";
$well_pfncd["16"] = "NH";
$well_pfncd["17"] = "하나카드";
$well_pfncd["21"] = "해외비자";
$well_pfncd["22"] = "해외마스터";
$well_pfncd["23"] = "JCB";
$well_pfncd["24"] = "해외아멕스";
$well_pfncd["25"] = "해외다이너스";
$well_pfncd["26"] = "중국은련";
$well_pfncd["32"] = "광주";
$well_pfncd["33"] = "전북";
$well_pfncd["34"] = "하나";
$well_pfncd["35"] = "산업카드";
$well_pfncd["41"] = "NH";
$well_pfncd["43"] = "씨티";
$well_pfncd["44"] = "우리";
$well_pfncd["48"] = "신협체크";
$well_pfncd["51"] = "수협";
$well_pfncd["52"] = "제주";
$well_pfncd["53"] = "씨티은행";
$well_pfncd["54"] = "MG새마을금고체크";
$well_pfncd["55"] = "케이뱅크";
$well_pfncd["56"] = "카카오뱅크";
$well_pfncd["70"] = "신안상호저축은행";
$well_pfncd["71"] = "우체국체크";
$well_pfncd["81"] = "하나은행";
$well_pfncd["83"] = "평화은행";
$well_pfncd["88"] = "신한은행";
$well_pfncd["89"] = "케이뱅크";
$well_pfncd["90"] = "카카오뱅크";
$well_pfncd["94"] = "SSG머니";
$well_pfncd["95"] = "저축은행체크";
$well_pfncd["97"] = "카카오 머니";
$well_pfncd["98"] = "페이코";

function getWellFnCdName($code){
	global $well_pfncd;
	foreach( $well_pfncd as $i => $v ){
		if($i==$code) $well_pfncd = $v;
	}
	return $well_pfncd;
}

//고유문자생성
function fnMakeRandomKey($len) {
	//$len = 7;
	$chars = 'ABCDEFGHJKLMNPQRSTUVWXYZ123456789';

	srand((double)microtime() * 1000000);

	$ki = 0;
	$str = "";

	while ($ki < $len) {
		$num = rand() % strlen($chars);
		$tmp = substr($chars, $num, 1);
		$str .= $tmp;
		$ki++;
	}

	$str = preg_replace('/([0-9A-Z]{4})([0-9A-Z]{4})([0-9A-Z]{4})([0-9A-Z]{4})/', '\1-\2-\3-\4', $str);
	return $str;
}

//시작,종료일 사이 선택한 요일날짜배열
function getDatesStartToLast($startDate, $lastDate, $week){
	$dates = array();

	$startDate = str_replace("-","",$startDate);
	$lastDate = str_replace("-","",$lastDate);
	for($i=$startDate;$i<=$lastDate;$i++){
		$year  = substr($i,0,4);
		$month = substr($i,4,2);
		$day   = substr($i,6,2);
		if(checkdate($month,$day,$year)){

			$d_date = $year."-".$month."-".$day;
			//공휴일인지 체크 
			$holiday_chk = QRY_CNT("holiday_info", "AND h_date='$d_date' ");
			if($holiday_chk <= 0){//공휴일 아닌 날짜만 넣기.
				$w = date("w",strtotime($d_date));

				if(in_array($w, $week)){
					$date_arr["w"] = $w;
					$date_arr["date"] = $d_date;
					$dates[] = $date_arr;
				}
			}
			//$date[] = $year."-".$month."-".$day;
		}
	}

	return $dates;

}

//구매이용권 시간 확인
function getTicketUseTime($mem_idx){
	$today = date("Y-m-d");
    $ord_sql ="
        SELECT  SUM(tk_time) AS tk_time
        FROM ticket_order
        WHERE mem_idx = $mem_idx AND pay_status = 2 AND expire_date >= '$today' ";
	//echo $ord_sql."<br/>";
	$b_row = sql_fetch($ord_sql);
	return $b_row["tk_time"];
}

//현재일 기준 예약사용한 시간
function getReservUseTime($mem_idx, $t_typ, $month_dt){
	$today = date("Y-m-d");

	$use_sql = " SELECT SUM(rsv_usetime) AS rsv_time
				FROM reserve_info
				WHERE mem_idx = $mem_idx  AND cancel_yn='N' ";

	if($t_typ=="A"){
		$use_sql .= " AND DATE_FORMAT(reg_date, '%Y-%m-%d') <= '$today' ";
	}else if($t_typ=="M"){
		$use_sql .= " AND DATE_FORMAT(rsv_sdate,'%Y-%m') = '$month_dt'
		";
	}
	/*echo "<br/>=========================<br/>";
	echo $use_sql."<br/>";
	echo "<br/>=========================<br/>";*/
	$use_row = sql_fetch($use_sql);

	return $use_row["rsv_time"];
}

//예약정보
function getReserveInfoList($rsv_code){
	$sql = " SELECT A.*, B.kids_name, B.kids_code
			FROM reserve_info AS A
			INNER JOIN member_kids AS B ON A.kids_idx = B.idx
			WHERE rsv_code='$rsv_code' ";
	$result = sql_query($sql);
	while($row = sql_fetch_array($result)){
		$rsv_info_list[] = $row;
	}
	return $rsv_info_list;
}

//예약자녀정보
function getReserveKidsInfo($rsv_code){
    $sql_kids="
        SELECT B.kids_name, B.kids_code
        FROM reserve_info AS A
	        INNER JOIN member_kids AS B ON A.kids_idx = B.idx
        WHERE A.rsv_code ='$rsv_code'
		GROUP BY B.kids_name, B.kids_code
		ORDER BY B.kids_code
    ";
	$result_kids = sql_query($sql_kids);
	while($row_kids = sql_fetch_array($result_kids)){
		$kids_info_list[] = $row_kids;
	}
//print_r($kids_info_list);
	return $kids_info_list;
}

//예약건수(현재일부터 이후날짜)
function getRsvTotCnt($ptype,$idx,$rsv_date){
	if($ptype=="P"){
		$searchtxt = "AND mem_idx = $idx AND cancel_yn='N' AND rsv_sdate >= '$rsv_date'";
	}else if($ptype=="K"){
		$searchtxt = "AND kids_idx = $idx AND cancel_yn='N' AND rsv_sdate >= '$rsv_date'";
	}
	$rsv_tcnt = QRY_CNT("reserve_info", $searchtxt);

	return $rsv_tcnt;
}

// 초를 'HH:mm:ss' 형태로 환산
function getTimeFromSeconds($seconds,$ptype){
    $h = sprintf("%02d", intval($seconds) / 3600);
    $tmp = $seconds % 3600;
    $m = sprintf("%02d", $tmp / 60);
    $s = sprintf("%02d", $tmp % 60);

    //return $h.':'.$m.':'.$s;
	if($m ==0 && $s==0){
	}else{
		if($ptype=="txt"){
			return $h."시간".$m."분";
		}else{
			return $h.":".$m;
		}
	}
}

?>