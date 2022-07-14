<div id='paging'>
<?
$intpage = "";
$LSP = (int)(($page - 1) / $viewpagecnt + 1);
$startpage = ($LSP - 1) * $viewpagecnt + 1;
$endpage = $LSP * $viewpagecnt;

if ($endpage > $totalpage) $endpage = $totalpage;

if ($cnt > 0) {
	// [이전글 10개] 페이지
	$intTemp = (int)((($page - 1) / $viewpagecnt) * $viewpagecnt + 1);

	$intpage .= "<a href='$pageurl?mode=$mode&page=1&search=$search&strsearch=$strsearch$addpara' class='btn_prev'><img src='/zbackoffice/img/page-first.png'></a>";
	if ($page == 1) {
	  $intpage .= "<a href='javascript:;' class='btn_prev'><img src='../img/page-pre.png'></a>";
	} else {
	  $prev = $page - 1;
	  $intpage .= "<a href='$pageurl?mode=$mode&page=$prev&search=$search&strsearch=" . urlencode($strsearch) . "&cate1=$cate1$addpara' class='btn_prev'><img src='../img/page-pre.png'></a>";

	}
	//페이지수
	$intloop = 1;
	for ($np = $startpage; $np <= $endpage; $np++) {
		if ($np == $page) {
			$intpage .= "<a href='javascript:;' class='active'>$np</a>";
		} else {
			$intpage .= "<a href='$pageurl?mode=$mode&page=$np&search=$search&strsearch=" . urlencode($strsearch) . "&cate1=$cate1$addpara' class=''>$np</a>";
		}
	}

	$next=$page+1;
	// [다음 10개] 페이지
	if ($intTemp < $totalpage) {
		$intpage .= "<a href='$pageurl?mode=$mode&page=$next&search=$search&strsearch=" . urlencode($strsearch) . "&cate1=$cate1$addpara' class='btn_next'><img src='../img/page-next.png'></a>";
	} else {
		$intpage .= "<a href='javascript:;' class='btn_next'><img src='../img/page-next.png'></a>";
	}
	$intpage .= "<a href='$pageurl?mode=$mode&page=$totalpage&search=$search&strsearch=$strsearch$addpara' class='btn_next'><img src='/zbackoffice/img/page-end.png'></a>";

	echo $intpage;
}
?>
</div>