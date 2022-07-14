<?
include $_SERVER['DOCUMENT_ROOT'] . "/include/dbopen.php";
$filename = $_REQUEST['filename'];
$filereal = $_REQUEST['filereal'];
if(!$filereal) {
	$filereal = $filename;
}

$DownloadPath = ".." . $path.$filename;	// 파일 경로
$fileTmp = strstr($filereal, '^');				// 파일명 임시저장(앞의 '^'를 제거
$DownFile = substr($fileTmp, 2);

$filereal = iconv('utf-8', 'euc-kr', $filereal);

Header("Content-Type: file/unknown; charset=UTF-8");
Header("Content-Disposition: attachment; filename=". $filereal);
Header("Content-Length: ".filesize("$DownloadPath"));
header("Content-Transfer-Encoding: binary");
Header("Pragma: no-cache");
Header("Expires: 0");
flush();

if ($fp = fopen("$DownloadPath", "r")) {
	print fread($fp, filesize("$DownloadPath"));
}
fclose($fp);
?>