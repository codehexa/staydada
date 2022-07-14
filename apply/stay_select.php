<?php 
include  $_SERVER["DOCUMENT_ROOT"]."/include/_head.php";

/******************************************************************************************/
//지점 및 호실선택?
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

	<section>
	<form id="frm" name="frm" method="post">
	<input type="hidden" id="bidx" name="bidx" />
	<input type="hidden" id="ridx" name="ridx" />
	<input type="hidden" id="rnumber" name="rnumber" />
		<div class="row_wrap fir">
			<div class="copy_wrap_normal row_ti">
				<ul class="fadeInUp ani_paused">
					<li class="main_copy">지점 및<br>호실 선택 </li>
					<li class="copy">지도에서 지점을 선택하면 우측 호실리스트에서 호실을 보실 수 있습니다.</li>
				</ul>
			</div>
			<div class="map_wrap"  id="branchMap" style="width:98%;height:550px;" >
				<!--<div class="map_marker sinwol01">신월1호점</div>
				<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d25301.22383600304!2d126.99980794178148!3d37.563238900000016!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x357ca2dda8b6c867%3A0x9589703a02af5bf3!2zKOyjvCnsnbXshKDri6Tri6Q!5e0!3m2!1sko!2skr!4v1634143508326!5m2!1sko!2skr" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>-->

				
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
							$bh_lon = replace_out($row_bh["lon"]);
							$bh_lat = replace_out($row_bh["lat"]);
							 
					/******************************************************************/
					?>
						{
								bh_idx: '<?php echo $bh_idx ?>',
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
							var branch_icon = "<div class=\"map_marker\"><a href=\"javascript:void(0);\" onClick=\"fnGetRoomInfo("+positions[i].bh_idx+",'"+positions[i].title+"')\">"+positions[i].title+"</div>";

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

<style>
.cd-faq-content {overflow-x: hidden; overflow-y: auto; max-height: 350px;}
</style>
				
				<div class="hosil_select_list_wrap" style="z-index:999;display:none;">
					<ul id="basics" class="cd-faq-group " >
						<li class="pointer_faq content-visible">
							<span class="cd-faq-trigger" id="branch_name"></span>
							<div class="cd-faq-content">
								<ul id="room_name_list">
									<!--<li><a id="go" rel="leanModal" name="m_pop01" href="#m_pop01">201호 (15.5㎡/ 월50만원)</a></li>
									<li><a id="go" rel="leanModal" name="m_pop01" href="#m_pop01">202호 (21.1㎡/ 월59만원)</a></li>
									<li><a id="go" rel="leanModal" name="m_pop01" href="#m_pop01">203호 (17.9㎡/ 월87만원)</a></li>
									<li><a id="go" rel="leanModal" name="m_pop01" href="#m_pop01">204호 (21.7㎡/ 월21만원)</a></li>
									<li><a id="go" rel="leanModal" name="m_pop01" href="#m_pop01">205호 (38.3㎡/ 월53만원)</a></li>-->
								</ul>
							</div>
						</li>
					</ul>
				</div>

			</div>
		</div>

		<div class="textcenter mt70">
			<a id="go" rel="leanModal" name="home_yesno" href="javascript:void(0);" onClick="fnSend();"><p class="btn_box blue">다음단계<span class="icon_arrow_22x18_w"></span></p></a>
		</div>
	</form>
	</section>

</div>
 <!--/ wrap -->

<?php include  $_SERVER["DOCUMENT_ROOT"]."/include/_footer.php";?>


</div>
<!--/ container -->

<script>
	//지점선택시 호실정보가져오기
	function fnGetRoomInfo(_idx,_bname){

		$("#bidx").val(_idx);
		var data = new FormData();
		data.append("b_idx", _idx);
		//$("#branch_name").text('');
		$(".cd-faq-trigger").text('');
		$("#room_name_list").html('');
		$.ajax({
			data: data,
			type: "POST",
			url: "/proc/ajax_branch_room_list.php",
			dataType: "html",
			cache: false,
			contentType: false,
			processData: false,
			success: function(data){
				//console.log(data);
				//$("#branch_name").text(_bname);
				$(".cd-faq-trigger").text(_bname);
				$("#room_name_list").html(data);
				$(".hosil_select_list_wrap").show();
			},
			error: function(data){
				console.log(data);
			}
		});

	}

	//호실선택
	function fnSelRoom(_room){
		//console.log(_room);
		var room_number = $("#room_"+_room).attr("data-rnum");
		//console.log(room_number);
		$(".cd-faq-trigger").text(room_number+"호");
		$("#ridx").val(_room);
		$("#rnumber").val(room_number);

	}
	//다음단계
	function fnSend(){
		var frm = document.frm;

		if (nullchk(frm.bidx,"지점을 선택해 주십시오.")== false) return ;
		if (nullchk(frm.ridx,"호실을 선택해 주십시오.")== false) return ;
		frm.action = "apply_movein.php";
		frm.submit();
	}
</script>

</body>
</html>