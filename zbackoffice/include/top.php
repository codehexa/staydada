<?php
session_start();
include $_SERVER["DOCUMENT_ROOT"] . "/include/dbopen.php";
include $_SERVER["DOCUMENT_ROOT"] . "/zbackoffice/include/admin.php";
include $_SERVER["DOCUMENT_ROOT"] . "/zbackoffice/include/mode_title.php";
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title><?=$sitename?> 관리자</title>
<script src="/zbackoffice/js/jquery-1.12.4.min.js"></script>
<script src="/js/jquery-ui.js"></script>
<script src="/zbackoffice/js/jquery.bpopup.min.js"></script>
<script src="/js/common.js"></script>
<script type="text/javascript" src="/include/function.js?v=<?=date("Y-m-d H:i:s")?>"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" />
<link rel="stylesheet" type="text/css" href="/zbackoffice/css/layout.css?v=<?=date("Y-m-d H:i:s")?>">
<?php include $_SERVER["DOCUMENT_ROOT"] . "/include/datepicker.php"; ?>
<script type="text/javascript">
<!--
function chg(src, v, c, idx) {
	document.getElementById("proc").src = src + "?typ=chg&idx=" + idx + "&c=" + c + "&v=" + v;
}
//-->
</script>

</head>
<body>