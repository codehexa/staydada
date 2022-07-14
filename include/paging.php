<!-- <div class="navigator_bottom_wrap">
	<span class="prev" onClick="location.href='##'"></span>
	<span><a href="##" class="active">1</a></span>
	<span><a href="##" class="">2</a></span>
	<span><a href="##" class="">3</a></span>
	<span><a href="##" class="">4</a></span>
	<span><a href="##" class="">5</a></span>
	<span class="next" onClick="location.href='##'"></span>
</div> -->
<!--<div id="paging">-->
<div class="navigator_bottom_wrap">
<?php

$intpage = "";
$LSP = (int)(($page - 1) / $viewpagecnt + 1);
$startpage = ($LSP - 1) * $viewpagecnt + 1;
$endpage = $LSP * $viewpagecnt ;
if ($endpage > $totalpage) $endpage = $totalpage;

//============= 페이지수를 세어준다 ====
if ($cnt > 0) {
	//[이전글10개]나타내기
	$intTemp = (int)((($page - 1) / $viewpagecnt) * $viewpagecnt + 1);

	//$intpage .= "<a href='$pageurl?mode=$mode&page=1&search=$search&strsearch=$strsearch$addpara' class='btn_prev'><img src='/img/sub/pre_bt02.png'></a> ";
	if ($page == 1) {
		//$intpage .= "<a href='javascript:;' class='prev' title='이전'>&lt;</a>";
		$intpage .= "<span class=\"prev\" onClick=\"location.href='javascript:;'\"></span>";
	} else {
		$prev = $page - 1;
		//$intpage .= "<a href='$pageurl?mode=$mode&page=$prev&search=$search&strsearch=".urlencode($strsearch)."$addpara' class='btn_prev' title='이전'>&lt;</a>";
		$intpage .= "<span class=\"prev\" onClick=\"location.href='$pageurl?mode=$mode&page=$prev&search=$search&strsearch=".urlencode($strsearch)."$addpara'\"></span>";
	}

	//페이지수 뿌려주기
	$intloop = 1;
	for ($np = $startpage; $np<=$endpage; $np++) {
		if ($np == $page) {
			//$intpage .= "<a href='javascript:;' class='active'>$np</a>";
			$intpage .= "<span><a href=\"javascript:;\" class=\"active\">$np</a></span>";
		} else {
			//$intpage .= "<a href='$pageurl?mode=$mode&page=$np&search=$search&strsearch=".urlencode($strsearch)."$addpara' class=''>$np</a>";
			$intpage .= "<span><a href=\"$pageurl?mode=$mode&page=$np&search=$search&strsearch=".urlencode($strsearch)."$addpara\">$np</a></span>";
		}
	}

	$next = $page + 1;
	//[다음10개]페이지 보여주기
	 if ($intTemp < $totalpage){

	    //$intpage .= "<a href='$pageurl?mode=$mode&page=$next&search=$search&strsearch=".urlencode($strsearch)."$addpara' class='btn_next' title=\"다음\">&gt;</a>";
		$intpage .= "<span class=\"next\" onClick=\"location.href='$pageurl?mode=$mode&page=$next&search=$search&strsearch=".urlencode($strsearch)."$addpara'\"></span>";

     } else {
		//$intpage .= "<a href='javascript:;' class='btn_next' title=\"다음\">&gt;</a>";
		$intpage .= "<span class=\"next\" onClick=\"location.href='javascript:;'\"></span>";
	 }

	echo $intpage;
}
?>
</div>