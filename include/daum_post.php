<!-- 	<div class="post_top"><p>우편번호 검색</p><div class="post_close"> 닫기</div></div>	 -->		
<?
if(isset($_SERVER["HTTPS"])) {
?>
	<script src="https://ssl.daumcdn.net/dmaps/map_js_init/postcode.v2.js"></script>
<?
}else{
?>
	<script src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>	
<?
}
?>

<script>
    // 우편번호 찾기 찾기 화면을 넣을 element
    var element_wrap = document.getElementById('postpop');

    function foldDaumPostcode() {
        // iframe을 넣은 element를 안보이게 한다.
        element_wrap.style.display = 'none';
    }
 var geocoder = new daum.maps.services.Geocoder();
    function sample_execDaumPostcode() {
        // 현재 scroll 위치를 저장해놓는다.
        var currentScroll = Math.max(document.body.scrollTop, document.documentElement.scrollTop);
        new daum.Postcode({
            oncomplete: function(data) {
                // 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

				// 각 주소의 노출 규칙에 따라 주소를 조합한다.
				// 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
				var addr = ''; // 주소 변수
				var extraAddr = ''; // 참고항목 변수

				//사용자가 선택한 주소 타입에 따라 해당 주소 값을 가져온다.
				if (data.userSelectedType === 'R') { // 사용자가 도로명 주소를 선택했을 경우
					addr = data.roadAddress;
				} else { // 사용자가 지번 주소를 선택했을 경우(J)
					addr = data.jibunAddress;
				}

				// 사용자가 선택한 주소가 도로명 타입일때 참고항목을 조합한다.
				if(data.userSelectedType === 'R') {
					// 법정동명이 있을 경우 추가한다. (법정리는 제외)
					// 법정동의 경우 마지막 문자가 "동/로/가"로 끝난다.
					if(data.bname !== '' && /[동|로|가]$/g.test(data.bname)) {
						extraAddr += data.bname;
					}
					// 건물명이 있고, 공동주택일 경우 추가한다.
					if(data.buildingName !== '' && data.apartment === 'Y') {
						extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
					}
					// 표시할 참고항목이 있을 경우, 괄호까지 추가한 최종 문자열을 만든다.
					if(extraAddr !== '') {
						extraAddr = ' (' + extraAddr + ')';
					}
					// 조합된 참고항목을 해당 필드에 넣는다.
					document.getElementById("sample_address").value = extraAddr;

				} else {
					document.getElementById("sample_address").value = '';
				}


                // 우편번호와 주소 정보를 해당 필드에 넣는다.
                document.getElementById('sample_postcode').value = data.zonecode; //5자리 새우편번호 사용
                document.getElementById('sample_address').value = addr;
				document.getElementById('sample_detailAddress').focus();
				document.getElementById("post_txt").innerHTML="우편번호 검색";

                // iframe을 넣은 element를 안보이게 한다.
                // (autoClose:false 기능을 이용한다면, 아래 코드를 제거해야 화면에서 사라지지 않는다.)
              //  element_wrap.style.display = 'none';

                // 우편번호 찾기 화면이 보이기 이전으로 scroll 위치를 되돌린다.
                document.body.scrollTop = currentScroll;
            },
            // 우편번호 찾기 화면 크기가 조정되었을때 실행할 코드를 작성하는 부분. iframe을 넣은 element의 높이값을 조정한다.
            onresize : function(size) {
                element_wrap.style.height = size.height+'px';
            },
            width : '100%',
            height : '100%'
        }).embed(element_wrap);

        // iframe을 넣은 element를 보이게 한다.
			
		/*if(element_wrap.style.display=="none"){
			element_wrap.style.display = '';
			document.getElementById("post_txt").innerHTML="우편번호 검색";
		}else{
			element_wrap.style.display="none";
			document.getElementById("post_txt").innerHTML="우편번호 검색";
		}*/


		if(document.getElementById("post_txt").innerHTML=="우편번호 검색"){
			document.getElementById("post_txt").innerHTML="우편번호 검색 닫기";
			element_wrap.style.display = 'block';
		}else{
			document.getElementById("post_txt").innerHTML="우편번호 검색";
			element_wrap.style.display = 'none';
		}
		
	// iframe을 넣은 element의 위치를 화면의 가운데로 이동시킨다.
	initLayerPosition();

}

// 브라우저의 크기 변경에 따라 레이어를 가운데로 이동시키고자 하실때에는
// resize이벤트나, orientationchange이벤트를 이용하여 값이 변경될때마다 아래 함수를 실행 시켜 주시거나,
// 직접 element_wrap의 top,left값을 수정해 주시면 됩니다.
function initLayerPosition() {
	var width = 400; //우편번호서비스가 들어갈 element의 width
	var height = 500; //우편번호서비스가 들어갈 element의 height
	var borderWidth = 5; //샘플에서 사용하는 border의 두께

	// 위에서 선언한 값들을 실제 element에 넣는다.
	element_wrap.style.width = width + 'px';
	element_wrap.style.height = height + 'px';
	element_wrap.style.border = borderWidth + 'px solid';
	// 실행되는 순간의 화면 너비와 높이 값을 가져와서 중앙에 뜰 수 있도록 위치를 계산한다.
	element_wrap.style.left = (((window.innerWidth || document.documentElement.clientWidth) - width)/2 - borderWidth) + 'px';
	element_wrap.style.top = (((window.innerHeight || document.documentElement.clientHeight) - height)/2 - borderWidth) + 'px';
}
</script>

