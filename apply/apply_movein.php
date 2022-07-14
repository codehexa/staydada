<?php 
include  $_SERVER["DOCUMENT_ROOT"]."/include/_head.php";

/********************************************************/
//입주상담신청
/********************************************************/


if(strpos($_SERVER['HTTP_REFERER'], "/stay/stay_detail.php") === false){
	$chkurl = "N";
}else{
	$chkurl = "Y";
	$list_url = "/stay/stay.php";
}


if(strpos($_SERVER['HTTP_REFERER'], "/apply/stay_select.php") === false){
	$chkurl2 = "N";
}else{
	$chkurl2 = "Y";
	$list_url = "/apply/apply.php";
}



/********************************************************/
?>

 <!-- wrap -->
<div class="wrap">

	<section>
		<div class="row_wrap fir">
			<ul class="fadeInUp ani_paused apply_ti">
				<li class="main_copy"><h3>입주 상담 신청</h3></li>
				<li class="copy">스테이다다 지점별 시설 문의 및 입주 관련 상담을 원하시면<br>
					아래 내용을 작성 후 신청해주세요.</li>
			</ul>
		</div>
		<form id="frm" name="frm" method="post">
		<input type="hidden" id="typ" name="typ" value="rescon_write" />
		<input type="hidden" id="mode" name="mode" value="CC001" />
		<input type="hidden" id="prev_url" name="prev_url" value="<?php echo $now_url ?>" />
		<div>
			<ul class="apply_wrap mb40">
				<li class="fir">
					<ul class="input_list_wrap">
						<li>
							<p class="input_ti">이 름</p>
							<p class="input_input"><input type="text" id="name" name="name" class="w100" placeholder="이름을 입력해 주세요." maxlength="20" tabindex="1"></p>
						</li>
						<li>
							<p class="input_ti">이메일</p>
							<p class="input_input"><input type="text" id="email" name="email" class="w100" placeholder="이메일 주소를 입력해 주세요." maxlength="60" tabindex="3"></p>
						</li>
						<li>
							<p class="input_ti">지점 <span class="red">*</span></p>
							<p class="input_input">
								<select name="etc1" id="etc1" class="w100" tabindex="4">
<?php
	/**************************************************************************************************/
	/*지점리스트 */

				$result_bh = QRY_LIST("branch_info", "all", 1, " AND view_yn='Y' ", " bh_name ASC ");
				while($row_bh = mysqli_fetch_array($result_bh)){
					$branch_idx = replace_out($row_bh["idx"]);
					$branch_name = replace_out($row_bh["bh_name"]);
	/**************************************************************************************************/
?>
							<option value="<?php echo $branch_idx ?>" <?php echo ($bidx==$branch_idx)?"selected":"" ?> ><?php echo $branch_name ?></option>
<?php
	/**************************************************************************************************/
				}
	/**************************************************************************************************/
?>
								</select>						
							</p>
						</li>
<!-- 						<li>
							<p class="input_ti">입주 가능시기</p>
							<p class="input_input"><input type="text" id="email" class="w100" placeholder="" value="바로가능" disabled></p>
						</li> -->
						<li>
							<p class="input_ti">희망 입주시기 <span class="red">*</span></p>
							<p class="input_input"><input type="text" id="etc3" name="etc3" class="w100" placeholder="희망 날짜를 텍스트로 입력해 주세요." maxlength="10"  tabindex="6"></p>
						</li>
					</ul>
				</li><!--/ fir -->
				<li class="sec">&nbsp;</li>
				<li class="thi">
					<ul class="input_list_wrap">
						<li>
							<p class="input_ti">휴대폰번호</p>
							<p class="input_input"><input type="text" id="hp" name="hp" class="w100" placeholder="휴대폰번호를 입력해 주세요" maxlength="11" numberOnly tabindex="2"></p>
						</li>
						<li class="empty">&nbsp;</li>
						<li>
							<p class="input_ti">호실</p>
							<p class="input_input"><input type="text" id="etc2" name="etc2" placeholder="호실을 입력해 주세요" value="<?php echo $rnumber ?>" maxlength="10" class="w100" tabindex="5"></p>
						</li>
						<li class="empty">&nbsp;</li>
<!-- 						<li>
							<p class="input_ti">요금</p>
							<p class="input_input">월 550,000원 [보증금 10,000,000원]<br>
						(월세 500,000원 + 관리비 50,000원)</p>
						</li> -->
					</ul>
				</li><!--/ thi -->
			</ul>
		</div>
		<p class="caution">* 시설관련/입주가능일 등 문의 내용을 남겨주시면 해당 지점 담당자가 직접 답변을 드립니다.<br>
		* 원하시는 지점이 만실인 경우 최대한 빠르게 입주 가능한 일자를 안내드리고 있습니다.</p>
		<ul class="input_content">
			<li>
				<p class="input_ti">내 용</p>
				<p class="input_input"><textarea id="content" name="content" placeholder="내용을 입력해주세요" tabindex="7"></textarea></p>
			</li>
		</ul>
		<a href="javascript:fnSave();"><p class="btn_box blue mr5" tabindex="8">상담 신청<span class="icon_apply_18x18_w"></span></p></a>
		<!-- <a href="##"><p class="btn_box line">임시저장하기<span class="icon_apply_18x18"></span></p></a> -->
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
		if (validEmail(frm.email.value)==false){
			alert("이메일 형식에 맞춰서 입력해주세요.");
			return;
		}
		if (nullchk(frm.etc1,"지점을 선택해 주십시오.")== false) return ;
		if (nullchk(frm.etc2,"호실을 입력해 주십시오.")== false) return ;
		if (nullchk(frm.etc3,"희망 입주시기를 입력해 주십시오.")== false) return ;
		if (nullchk(frm.content,"내용을 입력해 주십시오.")== false) return ;

		if(confirm("입력한 내용으로 입주상담신청을 하시겠습니까?")){
			frm.action = "/proc/consult_proc.php";
			frm.submit();
		}
	}
</script>
</body>
</html>