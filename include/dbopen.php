<?php
session_start();
@extract($_GET);
@extract($_POST);
@extract($_SERVER);
ob_start();
ini_set("session.cache_expire", 180); // 세션 캐쉬 보관시간 (분)
ini_set("session.gc_maxlifetime", 86400); // session data의 garbage collection 존재 기간을 지정 (초)
ini_set("session.gc_probability", 1); // session.gc_probability는 session.gc_divisor와 연계하여 gc(쓰레기 수거) 루틴의 시작 확률을 관리합니다. 기본값은 1입니다. 자세한 내용은 session.gc_divisor를 참고하십시오.
ini_set("session.gc_divisor", 100); // session.gc_divisor는 session.gc_probability와 결합하여 각 세션 초기화 시에 gc(쓰레기 수거) 프로세스를 시작할 확률을 정의합니다. 확률은 gc_probability/gc_divisor를 사용하여 계산합니다. 즉, 1/100은 각 요청시에 GC 프로세스를 시작할 확률이 1%입니다. session.gc_divisor의 기본값은 100입니다.

//session_set_cookie_params(0, "/");	//KSR 주석
session_set_cookie_params (0, '/', $_SERVER['HTTP_HOST']);	//KSR

ini_set("session.cookie_domain", $_SERVER['HTTP_HOST']);


set_time_limit(0);
ini_set('mysql.connect_timeout', '0');
ini_set('max_execution_time', '0');


// 자바스크립트에서 go(-1) 함수를 쓰면 폼값이 사라질때 해당 폼의 상단에 사용하면
// 캐쉬의 내용을 가져옴. 완전한지는 검증되지 않음
@header("Content-Type: text/html; charset=utf-8");
$gmnow = gmdate("D, d M Y H:i:s") . " GMT";
@header("Expires: 0"); // rfc2616 - Section 14.21
@header("Last-Modified: " . $gmnow);
@header("Cache-Control: no-store, no-cache, must-revalidate");			// HTTP/1.1
@header("Cache-Control: pre-check=0, post-check=0, max-age=0");	// HTTP/1.1
@header("Pragma: no-cache"); // HTTP/1.0

$_db_id = "staydada";
$_db = "staydada";
$conn = mysqli_connect("localhost", $_db_id, "stayDADA**", $_db);		// 서버 /ID/pw


//////////////////////////////////////////DB 관련 함수 설정 2016.09.25/////////////////////////////////////////////////
function sql_query($sql){
	global $conn;
    $result = @mysqli_query($conn,$sql) or die("<p>$sql<p>" . mysqli_errno($conn) . " : " .  mysqli_error($conn) . "<p>error file : {$_SERVER['SCRIPT_NAME']}");
    return $result;
}

// 쿼리를 실행한 후 결과값에서 한행을 얻는다.
function sql_fetch($sql){
    $result = sql_query($sql, $error, $conn);
    $row = sql_fetch_array($result);
    return $row;
}

// 결과값에서 한행 연관배열(이름으로)로 얻는다.
function sql_fetch_array($result){
    $row = @mysqli_fetch_assoc($result);
    return $row;
}

//일반 배열
function sql_fetch_row($result){
    $row = @mysqli_fetch_row($result);
    return $row;
}
//////////////////////////////////////////DB 관련 함수 설정 /////////////////////////////////////////////////
include $_SERVER["DOCUMENT_ROOT"] . "/include/function.php";
include $_SERVER["DOCUMENT_ROOT"] . "/include/config.php";
include $_SERVER["DOCUMENT_ROOT"] . "/include/sql.php";


// 로그인 ID 구분자
define('G5_OAUTH_ID_DELIMITER', '_');
// 닉네임 Prefix
define('G5_OAUTH_NICK_PREFIX',  '');


//카카오 API KEY 
define('_KKO_APP_JS_KEY', '383c795a884a4a66a90102e1357e745a');
?>