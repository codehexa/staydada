<?php
if($_SERVER["HTTPS"]){
	header("Location: /main/main.php");
}else{
	header("Location: https://".$_SERVER['HTTP_HOST']."/main/main.php");
}
//header("Location: /main/main.php");
?>
