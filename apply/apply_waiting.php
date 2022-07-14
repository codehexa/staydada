<?php include  $_SERVER["DOCUMENT_ROOT"]."/include/_head.php";?>

 <!-- wrap -->
<div class="wrap">

	<section>
		<div class="row_wrap fir">
			<ul class="fadeInUp ani_paused apply_ti">
				<li class="main_copy"><h3>입주대기 신청</h3></li>
				<li class="copy">스테이다다에 입주를 대기하시려면, 아래 내용을 작성 후 신청부탁드립니다.<br>
				신청하신 지점에 입주 가능한 호실이 발생할 경우 안내해 드리도록 하겠습니다.</li>
			</ul>
		</div>
		<div>
			<ul class="apply_wrap mb40">
				<li class="fir">
					<ul class="input_list_wrap">
						<li>
							<p class="input_ti">이 름</p>
							<p class="input_input"><input type="text" id="name" class="w100" placeholder="" value="김익선" disabled></p>
						</li>
						<li>
							<p class="input_ti">이메일</p>
							<p class="input_input"><input type="text" id="email" class="w100" placeholder="" value="ksundada@naver.com" disabled></p>
						</li>
						<li>
							<p class="input_ti">1순위 <span class="red">*</span></p>
							<p class="input_input">
								<select name="movein" class="w100">
									<option disabled="" selected="">1순위 지점을 선택하세요.</option>
									<option value="sinwol">신월1호점</option>
									<option value="Nakseongdae">낙성대점</option>
									<option value="Seoul">서울대입구점</option>
									<option value="Wangsimni">왕십리점</option>
								</select>						
							</p>
						</li>
						<li>
							<p class="input_ti">2순위</p>
							<p class="input_input">
								<select name="movein" class="w100">
									<option disabled="" selected="">2순위 지점을 선택하세요.</option>
									<option value="sinwol">신월1호점</option>
									<option value="Nakseongdae">낙성대점</option>
									<option value="Seoul">서울대입구점</option>
									<option value="Wangsimni">왕십리점</option>
								</select>						
							</p>
						</li>
						<li>
							<p class="input_ti">3순위</p>
							<p class="input_input">
								<select name="movein" class="w100">
									<option disabled="" selected="">3순위 지점을 선택하세요.</option>
									<option value="sinwol">신월1호점</option>
									<option value="Nakseongdae">낙성대점</option>
									<option value="Seoul">서울대입구점</option>
									<option value="Wangsimni">왕십리점</option>
								</select>						
							</p>
						</li>
					</ul>
				</li><!--/ fir -->
				<li class="sec">&nbsp;</li>
				<li class="thi">
					<ul class="input_list_wrap">
						<li>
							<p class="input_ti">휴대폰번호</p>
							<p class="input_input"><input type="text" id="phone" class="w100" placeholder="" value="010-1234-5678" disabled></p>
						</li>
						<li class="empty">&nbsp;</li>
						<li class="empty">&nbsp;</li>
						<li class="empty">&nbsp;</li>
						<li>
							<p class="input_ti">희망 입주시기 <span class="red">*</span></p>
							<p class="input_input"><input type="text" id="want_date" class="w100" placeholder="희망 날짜를 텍스트로 입력해 주세요." value=""></p>
						</li>
					</ul>
				</li><!--/ thi -->
			</ul>
		</div>
		<p class="caution mb80">※ 입주 대기 신청을 하면 선택하신 지점에 입주 가능한 호실이 나올 경우<br>담당자를 통해 연락을 드리도록 하겠습니다.</p>
		<a href="##"><p class="btn_box blue">입주대기 신청하기<span class="icon_apply_18x18_w"></span></p></a>
	</section>

</div>
 <!--/ wrap -->

<?php include  $_SERVER["DOCUMENT_ROOT"]."/include/_footer.php";?>


</div>
<!--/ container -->


</body>
</html>