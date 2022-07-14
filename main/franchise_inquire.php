<?php include  $_SERVER["DOCUMENT_ROOT"]."/include/_head.php";?>

 <!-- wrap -->
<div class="wrap">

	<section>
		<div class="row_wrap fir">
			<ul class="fadeInUp ani_paused apply_ti">
				<li class="main_copy"><h3>프렌차이즈 문의</h3></li>
				<li class="copy">스테이다다와 함께 새로운 주거 서비스 제공을 원하시면, 아래 내용을 작성 후 신청 부탁드립니다.<br>
				담당자가 확인 후 빠르게 안내해 드리도록 하겠습니다.</li>
			</ul>
		</div>
		<form id="frm" name="frm" method="post">
		<input type="hidden" id="typ" name="typ" value="francon_write" />
		<input type="hidden" id="mode" name="mode" value="CC002" />
		<input type="hidden" id="prev_url" name="prev_url" value="<?php echo $now_url ?>" />
		<div>
			<ul class="apply_wrap mb40">
				<li class="fir">
					<ul class="input_list_wrap">
						<li>
							<p class="input_ti">이 름 <span class="red">*</span></p>
							<p class="input_input"><input type="text" id="name" name="name" class="w100" placeholder="이름을 입력해 주세요." maxlength="20" tabindex="1"></p>
						</li>
						<li>
							<p class="input_ti">이메일</p>
							<p class="input_input"><input type="text" id="email" name="email" class="w100" placeholder="이메일 주소를 입력해 주세요." maxlength="60"  tabindex="3"></p>
						</li>
						<li>
							<p class="input_ti">물건주소 <span class="red">*</span></p>
							<p class="input_input"><input type="text" id="etc1" name="etc1" class="w100" placeholder="주소를 입력해 주세요."  maxlength="80" tabindex="4"></p>
						</li>
					</ul>
				</li><!--/ fir -->
				<li class="sec">&nbsp;</li>
				<li class="thi">
					<ul class="input_list_wrap">
						<li>
							<p class="input_ti">휴대폰번호 <span class="red">*</span></p>
							<p class="input_input"><input type="text" id="hp" name="hp" class="w100" maxlength="11" numberOnly placeholder="휴대폰번호를 입력해 주세요" tabindex="2"></p>
						</li>
						<li class="empty">&nbsp;</li>
						<li>
							<p class="input_ti">세대수</p>
							<p class="input_input"><input type="text" id="etc2" name="etc2" class="w100" placeholder="세대수를 입력해 주세요" maxlength="30" tabindex="5"></p>
						</li>
					</ul>
				</li><!--/ thi -->
			</ul>
		</div>

		<div class="ag_info_wrap">
			<p class="mb10">개인정보 수집 및 이용에 대한 안내</p>
			<div class="ag_info">
				<strong>1. 개인정보의 수집 및 이용목적</strong><br>
				- 고객의 문의 사항에 대한 회신 및 비즈니스 상담의 원활한 의사소통을 목적으로 다음과 같이 개인정보를 동의를 받아 수집하고 위 수집 목적에 이용하고자 합니다.<br>
				- 개인정보를 수집 목적 외의 용도로 이용하거나 제공하는 경우, 제3자에게 제공하거나 국외 제3자에게 제공하거나 마케팅 목적으로 처리하는 경우 별도로 고객의 동의를 받습니다.<br>
				- 만14세 미만 아동은 수집 및 이용에 대해 법정대리인이 동의해야 합니다.<br><br>

				<strong>2. 수집하는 개인정보의 항목</strong><br>
				- 이름, 소속, 연락처, 이메일주소<br><br>

				<strong>3. 개인정보의 보유 및 이용 기간</strong><br>
				- 고객문의 사항 및 비즈니스 상담을 통해 수집된 개인정보는 회사의 데이타베이스에 저장되어, 최종 접속시점 이후부터 3년간 보관합니다. <br>
				- 3년이 지나면 수집된 정보는 파기합니다.<br>
				- 고객은 회사에게 개인정보의 열람을 요구할 수 있고, 개인정보의 삭제를 원하는 경우 요청할 수 있습니다. 회사는 요청을 받으면 지체 없이 해당 정보를 파기합니다.<br><br>

				<strong>4. 동의를 거부할 권리 및 동의 거부에 따른 불이익</strong><br>
				- 작성자는 개인정보의 수집, 이용 등과 관련한 위 사항에 대하여 원하지 않는 경우 동의를 거부할 수 있습니다.<br>
				- 다만, 수집하는 개인정보의 항목에서 필수정보에 대한 수집 및 이용에 대하여 동의하지 않는 경우는 상담에 제한이 있을 수 있습니다.<br><br>

				<strong>5. 동의의 방법</strong><br>
				- 고객은 위와 같이 게재된 내용을 확인하고 개인정보의 수집 및 이용에 동의 여부를 표시하여 개인정보의 처리에 대하여 동의할 수 있습니다.
			</div>
			<p class="ag_check"><input type="checkbox" name="agree" id="agree" class="input_ag_info" value="Y"> <label for="agree">개인정보 수집 및 이용에 동의합니다.</label></p>
		</div>

		<a href="javascript:fnSave();"><p class="btn_box blue">프랜차이즈 문의하기<span class="icon_apply_18x18_w"></span></p></a>
		</form>
	</section>

</div>
 <!--/ wrap -->
<iframe id="_hiddenFrm" name="_hiddenFrm" width="0" height="0" frameborder="0" marginheight="0" marginwidth="0" scrolling="yes" style="visible:false;display:none;" title="빈프레임"></iframe>

<?php include  $_SERVER["DOCUMENT_ROOT"]."/include/_footer.php";?>


</div>
<!--/ container -->


<script>
	function fnSave(){
		var frm = document.frm;
		if (nullchk(frm.name,"이름을 입력해 주십시오.")== false) return ;
		if (nullchk(frm.hp,"휴대폰번호를 입력해 주십시오.")== false) return ;
		if (nullchk(frm.email,"이메일주소를 입력해 주십시오.")== false) return ;
		/*if(fnChkEmail("email", "1", TrimStr($("#email").val()), "") == "N") {
			return false;
		}*/
		if (validEmail(frm.email.value)==false){
			alert("이메일 형식에 맞춰서 입력해주세요.");
			return;
		}
		if (nullchk(frm.etc1,"물건주소를 입력해 주십시오.")== false) return ;
		if (nullchk(frm.etc2,"세대수를 입력해 주십시오.")== false) return ;

		if (nullchecked1(frm.agree,"개인정보 수집 및 이용에 동의해 주십시오.")== false) return;

		if(confirm("입력한 내용으로 프렌차이즈 문의를 하시겠습니까?")){
			frm.action = "/proc/consult_proc.php";
			frm.submit();
		}
	}
</script>

</body>
</html>