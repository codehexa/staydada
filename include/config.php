<?php
$sitename = "스테이다다";
$headname = "스테이다다";
$log_date = date("Y-m-d H:i:s");
$log_ip = $_SERVER['REMOTE_ADDR'];
$today = date("Ymd");
$today2 = date("Y-m-d");
$today_year = date("Y");
$today_mon = date("Y-m");
$next_year = date("Y")+1;
$today_time = date("His");
$today2_time = date("H:i:s");
//$end_date = date('Y-m-d', strtotime("+2 months"));
$nowtime = date("H:i");
$nowtime2 = date("YmdHi");
$log_date2 = date("Y-m-d H:i:s");

//한페이지에 보여지는글수/페이지수
$recordcnt = 10;
$recordcnt20 = 20;
$viewpagecnt = 5;

//파일경로
$se_path = $osdir."/upload/se/";
$file_path = "/upload/file/";
$file_path2 = "/upload/thum/";

$imageKind = array ('image/pjpeg', 'image/jpeg', 'image/JPG', 'image/X-PNG', 'image/PNG', 'image/png', 'image/x-png');
$upfileKind = array ('xls', 'xlsx', 'zip');

//기본이미지(이미지 없음)
$http_host = $_SERVER['HTTP_HOST'];
$nopic = "/buyer/img/icon-user.png";
$noimg= "/buyer/img/no-img.png";
$logo_img = "https://" . $_SERVER['HTTP_HOST'] . "/img/common/logo.png";

//관리자이메일주소
$admin_mail_user = get_want("zadmin","admin_mail"," AND admin_gubun='admin' ");
//기본파라미터-자주쓰는 파라미터 추가
$typ = replace_in($_REQUEST['typ']);
$mode = replace_in($_REQUEST['mode']);
$idx = replace_in($_REQUEST['idx']);
$page = replace_in($_REQUEST['page']);
$pagec = replace_in($_REQUEST['pagec']);
$search = replace_in($_REQUEST['search']);
$strsearch = replace_in($_REQUEST['strsearch']);
//$cate = replace_in($_REQUEST['cate']);
$work = replace_in($_REQUEST['work']);
$tbl = replace_in($_REQUEST['tbl']);

if (!$page or $typ=="write") $page = 1;
if(!$page2) $page2=1;
if(!$page3) $page3=1;
$param = "tbl=$tbl&mode=$mode&page=$page&search=$search&strsearch=" . urlencode($strsearch) . "&startdate=$startdate&enddate=$enddate";
$param_new = "page=$page&search=$search&strsearch=" . urlencode($strsearch) . "&startdate=$startdate&enddate=$enddate";

// 로그인 유지
//echo "<br />cf_get_cookie_auto_login : " . get_cookie("auto_login");

if(get_cookie("auto_login") == "1") {
	$_SESSION["MEM_GBN"] = get_cookie("c_mem_gbn");
	$_SESSION["MEM_IDX"] = get_cookie("c_mem_idx");
	$_SESSION["MEM_ID"] = get_cookie("c_mem_id");
	$_SESSION["MEM_NAME"] = get_cookie("c_mem_name");
	$_SESSION["MEM_NICKNAME"] = get_cookie("c_mem_nickname");
	$_SESSION["MEM_HP"] = get_cookie("c_mem_hp");
}

$session_mem_gbn = $_SESSION["MEM_GBN"];
$session_mem_idx = $_SESSION["MEM_IDX"];
$session_mem_id = $_SESSION["MEM_ID"];
$session_mem_name = $_SESSION["MEM_NAME"];
$session_mem_nickname = $_SESSION["MEM_NICKNAME"];
$session_mem_hp = $_SESSION["MEM_HP"];
$session_mem_zone = $_SESSION["MEM_ZONE"];
$session_re_url = $_SESSION["RE_URL"];
//$session_mem_goods = get_want("member","mem_goods"," and mem_idx='$session_mem_idx' ");
//session_regenerate_id();  //새로운 생성하기
$session_id = session_id();  // 새 생성된 값


//도메인을 뺀 현제 페이지
$PHP_SELF = $_SERVER[PHP_SELF] ;
//도메인
$http_host = $_SERVER['HTTP_HOST'];
//도메인 제외 파라미터까지 주소
$now_url = $_SERVER['REQUEST_URI'] ;
//현재 전체주소
$now_url2 = $now_url;
$now_url = $http_host.$now_url;
//현재페이지주소
$host_filename =  $_SERVER['SCRIPT_FILENAME'];
$folder_split=explode("/",$host_filename);
$folder=$folder_split[3];
//전페이지주소
$host_filename_prev = $_SERVER['HTTP_REFERER'];
$folder_split_prev = explode("/",$host_filename_prev );
$folder_prev =$folder_split_prev [3];

//현재페이지 또는 이전페이지가 company인것
if(str_replace(" ","",$folder_split[3])=="seller" or str_replace(" ","",$folder_split_prev[3])=="seller"){
	$fd="/seller";
}else{
	$fd="/buyer";
}

$mobileBrower='/(iPod|iPhone|Android|BlackBerry|SymbianOS|SCH-M\d+|Opera Mini|Windows CE|Nokia|SonyEricsson|webOS|PalmOS)/';
$_agent = $_SERVER['HTTP_USER_AGENT'];
if(preg_match($mobileBrower,$_SERVER['HTTP_USER_AGENT'])){
	$mobile="y";
	$m_folder="";
	$mobilef="";
	$viewpagecnt =	5;
	if(preg_match("/(Android)/",$_agent)){
		$mobile_os = "Android";
	}else if(preg_match("/(iPod|iPhone)/",$_agent)){
		$mobile_os = "iOS";
	}
}else{
	$mobile="n";
	$m_folder="";
	$viewpagecnt =	10;
	$mobile_os = "PC";
}

if($_SERVER['HTTPS'] == 'on'){
	$strhttps="https://";
}else{
	$strhttps="http://";
}


//////////////////////////////////////////////
/* onpert 계정 (테스트)*/

define("_ALIGO_ID", "onpert");
define("_ALIGO_KEY", "irspushegi4hnwvyn6ds9kfdnffuqtge");
define("_ALIGO_SENDER", "0231442654");


/**** FCM KEY 설정 ***********************************/
$FCM_KEY="";
$FCM_URL = "";
$FCM_TOPIC ="";

?>