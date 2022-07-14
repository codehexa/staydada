<?php 
include  $_SERVER["DOCUMENT_ROOT"]."/include/_head.php";

/******************************************************************************************/
/*지점리스트*/
/******************************************************************************************/

$tbl = "branch_info";

$searchand = " AND view_yn='Y' AND bh_addr1 LIKE '%서울%' ";
$n_lat = get_want($tbl, "lat", $searchand." ORDER BY bh_name ASC LIMIT 1 " ); //위도
$n_lon = get_want($tbl, "lon", $searchand." ORDER BY bh_name ASC LIMIT 1 "); //경도
$b_result = QRY_LIST($tbl, "all", 1, $searchand, " bh_name ASC ");

$tcnt = mysqli_num_rows($b_result);

/******************************************************************************************/
?>

 <!-- wrap -->
<div class="wrap">

	<!-- 지도검색 -->
	<section>
			<div class="row_wrap fir">
				<div class="copy_wrap_normal row_ti">
					<ul class="fadeInUp ani_paused">
						<li><span class="en">Better Tommorrow, Better Together</span></li>
						<li class="main_copy">
						더 이상의 공유가 아닌<br>소유의 경험</li>
						<li class="copy">지금 바로 나에게 맞는 스테이다다를 찾아보세요.</li>
					</ul>
				</div>
				<!-- 지도 kakaomap 22.05.23 추가 -->
				<div class="map_wrap" id="branchMap" style="width:100%;height:550px;" >
					
					<script>

						var mapContainer = document.getElementById('branchMap'), // 지도를 표시할 div 
							mapOption = { 
								center: new kakao.maps.LatLng(<?php echo $n_lat ?>,<?php echo $n_lon ?>), // 지도의 중심좌표
								level: 8 // 지도의 확대 레벨
							};

						var branchMap = new kakao.maps.Map(mapContainer, mapOption); // 지도를 생성합니다

						// 마커를 표시할 위치와 title 객체 배열입니다 
						var positions = [
					<?php
					/******************************************************************/
					//지점리스트 									
						$num = 1;
						while($row_bh = mysqli_fetch_array($b_result)){
							$bh_idx	= replace_out($row_bh["idx"]);
							$bh_name = replace_out($row_bh["bh_name"]);
							$bh_lon = replace_out($row_bh["lon"]); //경도
							$bh_lat = replace_out($row_bh["lat"]); //위도
							 
					/******************************************************************/
					?>
						{
								title: '<?php echo $bh_name ?>', 
								latlng: new kakao.maps.LatLng(<?php echo $bh_lat ?>,<?php echo $bh_lon ?>)
						}<?php echo ($num < $tcnt)? ",":""?>
					<?php
					/******************************************************************/	
							$num++;	
						}
					/******************************************************************/
					?>
						];


						// 마커 이미지의 이미지 주소입니다
						var imageSrc = "https://t1.daumcdn.net/localimg/localimages/07/mapapidoc/markerStar.png"; 

						for (var i = 0; i < positions.length; i ++) {

							//커스텀 지점명 (sinwol01)
							var branch_icon = "<div class=\"map_marker\">"+positions[i].title+"</div>";

							// 커스텀 오버레이를 생성합니다
							var customOverlay = new kakao.maps.CustomOverlay({
								position: positions[i].latlng,
								content: branch_icon   
							});
							// 커스텀 오버레이를 지도에 표시합니다
							customOverlay.setMap(branchMap);
/*
//마커이미지 보여주기 
							// 마커 이미지의 이미지 크기 입니다
							var imageSize = new kakao.maps.Size(24, 35); 
							
							// 마커 이미지를 생성합니다    
							var markerImage = new kakao.maps.MarkerImage(imageSrc, imageSize); 
							
							// 마커를 생성합니다
							var marker = new kakao.maps.Marker({
								map: branchMap, // 마커를 표시할 지도
								position: positions[i].latlng, // 마커를 표시할 위치
								title : positions[i].title, // 마커의 타이틀, 마커에 마우스를 올리면 타이틀이 표시됩니다
								image : markerImage // 마커 이미지 
							});
*/
						}

					</script>
					<!--/ 지도 END-->
				</div>
				<form id="sfrm" name="sfrm" method="post">
				<div class="map_search_wrap">
					<div class="movein_input_wrap"><input type="text" id="srctxt" name="srctxt" value="<?php echo $srctxt ?>" class="movein" placeholder="지역, 주소, 주변대중교통으로 입력하세요."></div>
					<div><p class="btn_box blue"><a href="javascript:fnBhSearch();">검색하기<span class="icon_search_18x18 white"></span></a></p></div>
				</div>
				</form>
			</div>
	</section>
	<!--/ 지도검색 -->

<?php
/**************************************************************************************************/
/*지점리스트 (디폴트-전체, 검색시 - 입주가능한 지점만 보이도록(입주가능 호실 1개이상인것) 22.07.06 추가 
 contract_state값 com_code gubun='BR004'(계약완료 : idx=15, 입주가능 : idx=16 )
*/ 
/**************************************************************************************************/
$searchand = " AND A.view_yn='Y' ";

if($srctxt) $searchand .= " AND (A.bh_addr1 LIKE '%$srctxt%' OR A.bh_addr2 LIKE '%$srctxt%' OR A.trans_info LIKE '%$srctxt%' ) ";

if(!$srctxt) : 
	$cnt = QRY_CNT("branch_info as A", $searchand);
	$totalpage = QRY_TOTALPAGE($cnt, $recordcnt);
	$result = QRY_LIST("branch_info as A", $recordcnt, $page, $searchand, " A.idx DESC");
else:

	$sql_t = "
		SELECT COUNT(*) AS t_cnt
		FROM(
			SELECT A.*
			,(SELECT COUNT(idx) FROM room_info WHERE bh_idx=A.idx AND view_yn='Y' AND contract_state = 16 ) AS room_cnt
			FROM branch_info AS A
			WHERE 1=1 $searchand
		)Z
		WHERE Z.room_cnt > 0 
	";
	/*echo "<br/>=================================<br/>";
	echo $sql_t."<br/>";
	echo "<br/>=================================<br/>";*/
	$rst_t = sql_query($sql_t);
	$row_t = sql_fetch_array($rst_t);
	$cnt = $row_t["t_cnt"];
	$totalpage = QRY_TOTALPAGE($cnt, $recordcnt);
	$startno = ($page - 1) * $recordcnt;

	$sql_l = "
		SELECT Z.*
		FROM(
			SELECT A.*
			,(SELECT COUNT(idx) FROM room_info WHERE bh_idx=A.idx AND view_yn='Y' AND contract_state = 16 ) AS room_cnt
			FROM branch_info AS A
			WHERE 1=1 $searchand
		)Z
		WHERE Z.room_cnt > 0 
		LIMIT $startno, $recordcnt
	";
	/*echo "<br/>=================================<br/>";
	echo $sql_l."<br/>";
	echo "<br/>=================================<br/>";*/
	$result = sql_query($sql_l);
endif; 
/**************************************************************************************************/
?>

<style>
@media all and (max-width:639px) {
.mo {font-size: 14px;}
}
</style>
	<!-- 스테이리스트 -->
	<section>
			<div class="row_wrap mt0">
				<ul class="half_wrap">
<?php
/**************************************************************************************************/
		if($cnt == 0) { 
			echo "<li>등록된 데이터가 없습니다.</li>";
		}else{
			while($row = mysqli_fetch_array($result)){
				$idx = replace_out($row["idx"]);
				$bh_name = replace_out($row["bh_name"]);
				$bh_post = replace_out($row["bh_post"]);
				$bh_addr1 = replace_out($row["bh_addr1"]);
				$bh_addr2 = replace_out($row["bh_addr2"]);
				$file1 = replace_out($row["file1"]);

/**************************************************************************************************/
?>
					<li>
						<p><!--<span class="wish_icon main"></span>--><a href="stay_detail.php?idx=<?php echo $idx ?>&page=<?php echo $page?>&srctxt=<?php echo $srctxt ?>&srcbranch=<?php echo $srcbranch ?>"><?php if(!$file1){?><img src="/images/img_stay_photo01.jpg"><?php }else{?><img src="<?php echo $file_path2.$file1?>"><?php }?></a></p>
						<p class="shop_ti ti"><?php echo $bh_name ?></p>
						<p class="mo"><?php echo $bh_addr1." (".$bh_addr2.")" ?></p>
					</li>
<?php
/**************************************************************************************************/
			}
		}
/**************************************************************************************************/
?>
				</ul>
			</div>
	</section>
	<!--/ 스테이리스트  -->

<!-- 네비게이터 -->
	<?php 
		$addpara = "&srctxt=".$srctxt;
		include  $_SERVER["DOCUMENT_ROOT"]."/include/paging.php";
	?>



</div>
 <!--/ wrap -->

<?php include  $_SERVER["DOCUMENT_ROOT"]."/include/_footer.php";?>


</div>
<!--/ container -->

<script>
	function fnBhSearch(){
		var frm = document.sfrm;
		frm.action = "stay.php";
		frm.submit();
	}
</script>
</body>
</html>