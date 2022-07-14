<?php 
include  $_SERVER["DOCUMENT_ROOT"]."/include/_head.php";

/******************************************************************/
/*지점상세-호실정보포함*/

if(strpos($_SERVER['HTTP_REFERER'], "stay.php") === false){
	$chkurl = "N";
}else{
	$chkurl = "Y";
	$list_url = "/stay/stay.php";
}

if($idx){
	//지점정보 
	include  $_SERVER["DOCUMENT_ROOT"]."/proc/branch_info_view_row.php";
}else{
	Page_Msg_Url("필요한 정보를 받지못하였습니다.", "/stay/stay.php");
}

/******************************************************************/
?>

 <!-- wrap -->
<div class="wrap">

	<!-- 상단정보 -->
	<section>
			<div class="row_wrap fir">
				<div class="copy_wrap_normal row_ti">
					<div class="relative">
						<ul>
							<li class="main_copy blue"><?php echo $bh_name ?></li>
							<li class="copy"><?php echo $bh_addr1 ?></li>
						</ul>
					<?php if($vr_link): //링크가 있을경우 버튼 보이기 -22.05.24 추가 ?>
						<a href="<?php echo $vr_link ?>" target="_blank"><p class="btn_box blue right_bottom stay_detail" style="margin-right: 220px;">3D 집구경하기</p></a>
					<?php endif; ?>
						<a href="/apply/apply_movein.php?bhidx=<?php echo $idx ?>"><p class="btn_box blue right_bottom stay_detail">입주 상담 신청<span class="icon_apply_18x18_w"></span></p></a>
					</div>
					<ul class="stay_detail_info_wrap fadeInUp ani_paused">
						<li class="detail_copy"><?php echo nl2br($content) ?></li>
						<li class="etc_copy">
							<span>○ 주택유형 : <?php echo $hous_type_txt ?></span>
							<span>○ 층 수 : <?php echo $bh_floor ?></span>
							<span>○ 세대정보 : <?php echo $bh_ginfo ?>가구</span>
							<span>○ 연면적 : <?php echo $bh_total_area ?> ㎡</span>
							<span>○ 주차 : <?php echo $parking_yn_txt ?></span>
							<span>○ 관리비 : <?php echo number_format($main_cost,0) ?>원</span>
							<span>○ 기타 옵션: <?php echo $etc_option ?></span>
						</li>
					</ul>
				</div>
			</div>
	</section>
	<!--/ 상단정보 -->

	<section class="center fade main_photo">
	<?php
	//상세사진4장->15장변경 22.05.31
		for($i=2;$i<16;$i++){
			if(${"file".$i}){
				echo "<div><img src=\"".$file_path2.${"file".$i}."\"></a></div>";
			}
		}
	?>
	</section>

	<div class="map_container">
		<div class="copy_wrap_normal row_ti">
			<ul class="fadeInUp ani_start">
				<li class="sub_copy">주변 대중교통 정보</li>
				<li class="copy"><?php echo $trans_info ?></li>
			</ul>
		</div>
		<!-- 지도 kakaomap 22.05.23 추가 -->
		<div class="map_wrap" id="branchMap" style="width:98%;height:450px;"></div>
		<script>

			var mapContainer = document.getElementById('branchMap'), // 지도를 표시할 div 
				mapOption = { 
					center: new kakao.maps.LatLng(<?php echo $lat ?>,<?php echo $lon ?>), // 지도의 중심좌표
					level: 3 // 지도의 확대 레벨
				};

			var branchMap = new kakao.maps.Map(mapContainer, mapOption); // 지도를 생성합니다

			// 마커를 표시할 위치와 title 객체 배열입니다 
			var positions = [
				{
					title: '<?php echo $bh_name ?>', 
					latlng: new kakao.maps.LatLng(<?php echo $lat ?>,<?php echo $lon ?>)
				}
			];

			// 마커 이미지의 이미지 주소입니다
			var imageSrc = "https://t1.daumcdn.net/localimg/localimages/07/mapapidoc/markerStar.png"; 

			for (var i = 0; i < positions.length; i ++) {
/*
				//커스텀 지점명 (sinwol01)
				var branch_icon = "<div class=\"map_marker\">"+positions[i].title+"</div>";
				console.log(branch_icon);
				// 커스텀 오버레이를 생성합니다
				var customOverlay = new kakao.maps.CustomOverlay({
					position: positions[i].latlng,
					content: branch_icon   
				});
				// 커스텀 오버레이를 지도에 표시합니다
				customOverlay.setMap(branchMap);
*/
				
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

			}

		</script>
		<!--/ 지도 END-->
	</div>


	<div class="hosil_wrap">
		<ul class="ti_wrap fadeInUp ani_start">
			<li class="sub_copy">호실 정보</li>
		</ul>
<?php
/**************************************************************************************************/
//호실 리스트 
/**************************************************************************************************/
$searchand = " AND view_yn='Y' AND bh_idx = $idx ";
$cnt_room = QRY_CNT("room_info", $searchand);
$result_room = QRY_LIST("room_info", "all", 1, $searchand, " room_number ASC");
/**************************************************************************************************/
?>
		<section class="center slider">
<?php 
/**************************************************************************************************/
	if($cnt_room==0){
		echo "<div>등록된 데이터가 없습니다.</div>";
	}else{
		//while($row_room = mysqli_fetch_array($result_room)){
		while($row_room = mysqli_fetch_array($result_room)){
			$room_idx		= replace_out($row_room["idx"]);
			$room_number	= replace_out($row_room["room_number"]);	//호실
			$room_file1		= replace_out($row_room["file1"]);
			$deposit		= replace_out($row_room["deposit"]);	//보증금
			$rental			= replace_out($row_room["rental"]);		//월임대료
			$s_area			= replace_out($row_room["s_area"]);	//공급면적
			$d_area			= replace_out($row_room["d_area"]);	//전용면적

			/****** 22.05.24 추가 *****************************************/
			$real_area		= replace_out($row_room["real_area"]); //실면적
			$contract_state = replace_out($row_room["contract_state"]); //계약상태
			$cont_state_txt = get_want("com_code", "code_name", "AND idx = $contract_state");

			if($cont_state_txt=="계약완료") : $class_cont_state="red";
			elseif($cont_state_txt=="입주가능") : $class_cont_state="blue";
			else: $class_cont_state="";
			endif;

/**************************************************************************************************/
?>
			<div>
				<ul class="slider_hosil_wrap">
					<li class="img">
					<?php if(!$room_file1): ?>
						<img src="/images/img_stay_photo_ho01.jpg">
					<?php else: ?>
						<img src="<?php echo $file_path2.$room_file1 ?>">
					<?php endif; ?>
					</li>
					<li class="num"><span><?php echo $room_number ?>호</span><!-- <span class="wish_icon hosil"></span>-->
					 <span class="floatright <?php echo $class_cont_state ?> mr0"><?php echo $cont_state_txt ?></span></li>
					<li class="price"><span><?php echo $s_area ?>㎡</span><span class="floatright mr0">보증금 <?php echo number_format($deposit,0) ?>만원</span></li>
					<li><span class="floatright mr0">월 <?php echo number_format($rental,0) ?>원</span></li>
					<!-- <li class="weight-300">룸:3개 / 주차:불가능 / 풀옵션 : 침대,화장대,서랍장,수납장,냉장고,세탁기,샤워부스,인덕션</li> -->
					<!--<li class="btn"><a href="javascript:fnGetViewDetail(<?php echo $room_idx?>)"><p class="btn_box blue">자세히보기<span class="icon_arrow_22x18_w"></span></p></a></li>-->
					<!-- 0526 기존모달
					<li class="btn"><a id="go" name="m_pop01" href="#m_pop01" onClick="fnGetViewDetail(<?php echo $room_idx ?>);" data-idx="<?php echo $room_idx?>"><p class="btn_box blue">자세히보기<span class="icon_arrow_22x18_w"></span></p></a></li> -->
					<li class="btn layer_open_a"><a href="javascript:;" onClick="fnGetViewDetail(<?php echo $room_idx ?>);" data-idx="<?php echo $room_idx?>"><p class="btn_box blue">자세히보기<span class="icon_arrow_22x18_w"></span></p></a></li>
				</ul>
			</div>
<?php 
/**************************************************************************************************/
		}
	}
/**************************************************************************************************/
?>

		</section>
	</div>

	<!-- FAQ 
	<div class="faq_wrap">
		<div class="fir">
			<ul class="fadeInUp ani_start">
				<li class="sub_copy">자주 묻는 질문</li>
				<li class="copy">스테이다다에 관련하여 궁금하신 내용들은<br>
				우측에서 확인하시기 바랍니다.</li>
			</ul>
		</div>
		<div class="sec">

					<section class="cd-faq">
						<div class="cd-faq-items">
							<ul id="basics" class="cd-faq-group">
								<li class="pointer_faq">
									<span class="cd-faq-trigger">보증금/월세관련해서조정이가능한가요?</span>
									<div class="cd-faq-content">
										장기계약(1년 이상) 따라 조정이 가능합니다.
									</div>
								</li>
								<li class="pointer_faq">
									<span class="cd-faq-trigger">단기계약도 가능한가요?</span>
									<div class="cd-faq-content">
										월세로 계약이 가능한 지점에서는 최소 1개월부터 계약이 가능합니다. </br>
										(전세 전용 지점은 불가)
									</div>
								</li>
								<li class="pointer_faq">
									<span class="cd-faq-trigger">관리비는 얼마인가요?</span>	
									<div class="cd-faq-content">
										사용량에 따라 전기, 주차, 관리비는 [매월 말일], 수도는 [짝수 달 말일], 가스[개별고지서 납부] 형태로 진행됩니다. </br>
										지점에 따라 관리비 정산 시기가 조금씩 다른 관계로, 지점 계약 시 관리비 항목에 따라 납부방식/일자 등을 개별 안내드리고 있습니다.
									</div>
								</li>
								<li class="pointer_faq">
									<span class="cd-faq-trigger">중간에 다른 하우스로 이주 가능한가요?</span>	
									<div class="cd-faq-content">
										계약기간이 X 개월 이상 남은 상태에서 이주가 가능하며, 이주하고자 하는 스테이 가공실인 상태에서 가능합니다.</br>
										계약조건(월 임대료, 관리비 등)이 달라질 경우, 별도 협의가 필요한 사항입니다.
									</div>
								</li>
								<li class="pointer_faq">
									<span class="cd-faq-trigger">계약기간 만료 전에 퇴실이 가능한가요?</span>	
									<div class="cd-faq-content">
										지정된 계약만료일전 퇴실을 원하시는 경우, 해당 호식에 입주 대기자가 있다면 바로 가능합니다.</br> 다만, 해당 호식에 입주 대기자가 없다면, 퇴실 요청하신 달로부터 2달 이후 퇴실이 가능합니다.
									</div>
								</li>
								<li class="pointer_faq">
									<span class="cd-faq-trigger">반려동물과 함께 입주할 수 있나요?</span>	
									<div class="cd-faq-content">
										입주가 가능한 지점은 [ ]입니다. </br> 앞으로 반려동물과 함께 생활이 가능한 지점이 오픈 예정입니다. 조금만 기다려주세요.
									</div>
								</li>
								<li class="pointer_faq">
									<span class="cd-faq-trigger">게스트를 초대할 수 있나요?</span>	
									<div class="cd-faq-content">
										다른 입주자의 생활에 피해를 주지 않는 제한된 범위 내에서 게스트 방문을 허용하고 있습니다.</br>
										(방문전사전고지)
									</div>
								</li>
								<li class="pointer_faq">
									<span class="cd-faq-trigger">주차를 할 수 있나요?</span>	
									<div class="cd-faq-content">
										스테이 다다 지점 내 유료 주차가 가능한 지점은 [ ]입니다. 이 외지점은 무료주차가 어렵습니다. </br>
										필요시 건물 내 유료주차장 또는 인근의 민영 주차장을 이용해 주시기 바랍니다.
									</div>
								</li>
								<li class="pointer_faq">
									<span class="cd-faq-trigger">생활하고 있는 호실에 가구나 가전을 추가할 수 있나요?</span>	
									<div class="cd-faq-content">
										(추가 가능하다면 퇴실 시 최종 확인 후퇴 실처리 관련 규정)
									</div>
								</li>
							</ul>
						</div>
					</section>

			<!--/ faq_section
		</div>
	</div>
	<!--/ FAQ -->

</div>
 <!--/ wrap -->

<?php include  $_SERVER["DOCUMENT_ROOT"]."/include/_footer.php";?>

</div>
<!--/ container -->

<!-- modal 호실 자세히 보기 창 -->
<div id="m_pop01" class="modalpop_container layer-pop_a">
	<div id="modalpop_wrap">
		<a class="modal_close" href="#"></a>
		<div class="half_wrap modal_half detail_room" id="room_detail"> 
		</div>

	</div>
</div>
<!--/ modal 자세히보기 창 END  -->
<style>
/*.layer-bg { position:fixed;width:100%;height:100%;left:0;top:0;background:rgba(0,0,0,.85);display:none;z-index:10000}*/
.layer-bg {position: fixed; z-index: 10000; top: 0px; left: 0px; height:100%; width:100%; background:#000; display: none;opacity:0.5}
section.fade.modal img{width:100%}
/* .layer-pop_a{position:fixed;} */
.layer-pop_a{position:fixed;top: 50%;left: 50%;z-index: 10001;}
</style>
<div class="layer-bg"></div>
<!-- slider -->
<script>

	$(function() {
		  $('.fade').slick({
			  dots: false,
			  slidesToShow: 1,
			  slidesToScroll: 1,
			  autoplay: true,
			  infinite: false,
			  autoplaySpeed: 2500
		  });
		  $('.slider').slick({
		  dots: false,
		  slidesToShow: 3,
		  slidesToScroll: 1,
		  autoplay: false,
		  autoplaySpeed: 1500,
		  infinite: false,
		  responsive: [
				{
				  breakpoint: 1024,
				  settings: {
					slidesToShow: 2,
					slidesToScroll: 1,
					infinite: true,
					dots: false
				  }
				},
				{
				  breakpoint: 639,
				  settings: {
					slidesToShow: 1,
					slidesToScroll: 1,
					infinite: true,
					dots: false
				  }
				}
			]
		});
	});

	//자세히보기 클릭시 해당 호실 정보 가져오기
	function fnGetViewDetail(ridx){

		$.ajax({
			type: "POST",
			url: "ajax_get_room_detail.php",
			data: {"room_idx" : ridx },
			dataType : "json",
			async : false ,
			success: function(result){
				if(result.success == "OK"){
					$("#room_detail").html("");
					var str_html = '<div class="fir">';
						str_html += '    <section class="center fade modal" id="pop_photo">';
						/*if(result.room_info["file2"]){
							str_html += '        <div><img src="<?php echo $file_path2?>'+result.room_info["file2"]+'" ></div>';
						}
						if(result.room_info["file3"]){
							str_html += '        <div><img src="<?php echo $file_path2?>'+result.room_info["file3"]+'" ></div>';
						}
						if(result.room_info["file4"]){
							str_html += '        <div><img src="<?php echo $file_path2?>'+result.room_info["file4"]+'" ></div>';
						}
						if(result.room_info["file5"]){
							str_html += '        <div><img src="<?php echo $file_path2?>'+result.room_info["file5"]+'" ></div>';
						}*/
						
						for(var i = 1; i < 17; i++){
							window["file"+i] = result.room_info["file"+i];
							//console.log(window["file"+i]);
							if(window["file"+i]){
								str_html += '        <div><img src="<?php echo $file_path2?>'+window["file"+i]+'" ></div>';
							}
						}
						str_html += '    </section>';
						str_html += '</div>';
						str_html += '<div class="sec">';
						str_html += '    <ul class="modal_hosil_wrap">';
						str_html += '        <li class="num"><span>'+ result.room_info["room_number"] +'호</span></li>';
						str_html += '        <li class="sti">호실정보</li>';
						str_html += '        <li class="copy">';
						str_html += '        · 공급면적 : '+ result.room_info["s_area"] +'㎡<br>';
						str_html += '        · 전용면적 : '+ result.room_info["d_area"] +'㎡<br>';
						str_html += '        · 룸 : '+ result.room_info["room_type_txt"] +' <br>';
						str_html += '        · 보증금 : '+ result.room_info["deposit"] +'만원<br>';
						str_html += '        · 월 임대료 : '+ result.room_info["rental"] +'원<br>';
						str_html += '        · 월 관리비 : '+ result.room_info["room_cost"] +'원 <br>';
						str_html += '        <span class="small_font">*관리비 포함 : '+ result.room_info["in_desc"] +'</span><br>';
						str_html += '        <span class="small_font">*관리비 미포함 : '+ result.room_info["not_desc"] +'</span><br>';
						str_html += '    </ul>';
						str_html += '    <ul class="modal_hosil_wrap sec">';
						str_html += '        <li class="sti">시설정보</li>';
						str_html += '        <li>';
						if(result.room_info["room_option_4"]=="Y"){
						str_html += '            <p class="icon"><img src="/images/hoicon_air_conditioner.png"><span>에어컨</span></p>';
						}
						if(result.room_info["room_option_5"]=="Y"){
						str_html += '            <p class="icon"><img src="/images/hoicon_04.png"><span>온풍기</span></p>';
						}
						if(result.room_info["room_option_6"]=="Y"){
						str_html += '            <p class="icon"><img src="/images/hoicon_06.png"><span>침대</span></p>';
						}
						if(result.room_info["room_option_7"]=="Y"){
						str_html += '            <p class="icon"><img src="/images/hoicon_dryer.png"><span>세탁기</span></p>';
						}
						if(result.room_info["room_option_8"]=="Y"){
						str_html += '            <p class="icon"><img src="/images/hoicon_dryer.png"><span>건조기</span></p>';
						}
						if(result.room_info["room_option_9"]=="Y"){
						str_html += '            <p class="icon"><img src="/images/hoicon_refrigerator.png"><span>냉장고</span></p>';
						}
						if(result.room_info["room_option_10"]=="Y"){
						str_html += '            <p class="icon"><img src="/images/hoicon_07.png"><span>전자레인지</span></p>';
						}
						if(result.room_info["room_option_11"]=="Y"){
						str_html += '            <p class="icon"><img src="/images/hoicon_05.png"><span>인덕션</span></p>';
						}
						if(result.room_info["room_option_12"]=="Y"){
						str_html += '            <p class="icon"><img src="/images/hoicon_03.png"><span>인터넷</span></p>';
						}
						if(result.room_info["room_option_13"]=="Y"){
						str_html += '            <p class="icon"><img src="/images/hoicon_01.png"><span>정수기</span></p>';
						}
						if(result.room_info["room_option_14"]=="Y"){
						str_html += '            <p class="icon"><img src="/images/hoicon_08.png"><span>도어락</span></p>';
						}
						if(result.room_info["room_option_16"]=="Y"){
						str_html += '            <p class="icon"><img src="/images/hoicon_02.png"><span>반려동물</span></p>';
						}
						if(result.room_info["room_option_18"]=="Y"){
						str_html += '            <p class="icon"><img src="/images/hoicon_09.png"><span>엘리베이터</span></p>';
						}
						str_html += '        </li>';
						str_html += '    </ul>';
						str_html += '    <div class="bottom_btn_wrap">';
						str_html += '        <a href="/apply/apply_movein.php?bidx=<?php echo $idx ?>&ridx='+ridx+'&rnumber='+ result.room_info["room_number"] +'"><p class="btn_box blue small">상담 신청하기<span class="icon_apply_18x18_w"></span></p></a>';
						str_html += '    </div>';
						str_html += '</div>';
		
					$("#room_detail").html(str_html);

					$(".layer-pop_a").fadeIn("1500");
					$(".layer-bg").fadeIn("1500");

					fnPopSlider(); //이미지 슬라이드

				}else if(result.success == "PARAM"){
					alert("필요한 정보를 받지 못하였습니다.");
					return false;
				}
			}
		});				

	}

    //  새 팝업 0526
    $(document).ready(function(){
        /*$(".layer_open_a").click(function(ev){
			ev.preventDefault();
            $(".layer-pop_a").fadeIn("1500");
            $(".layer-bg").fadeIn("1500");
        });*/
		$(".modal_close").click(function(ev){
			ev.preventDefault();
            $(".layer-pop_a").fadeOut("1500");
            $(".layer-bg").fadeOut("1500");
        });
    });

	//레이어팝업 이미지 슬라이드관련
	function fnPopSlider(){
		  $('#pop_photo').slick({
			  dots: false,
			  slidesToShow: 1,
			  slidesToScroll: 1,
			  autoplay: true,
			  infinite: false,
			  autoplaySpeed: 2500
		  });

	}

</script>

</body>


</html>