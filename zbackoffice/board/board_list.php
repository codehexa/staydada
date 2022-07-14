<?php
include $_SERVER["DOCUMENT_ROOT"] . "/zbackoffice/include/head.php";

/************************************************************/
//게시판 리스트 - 공용
/************************************************************/

//$recordcnt = 20;
$searchand = " AND gubun = '$mode'";
$tbl = "board";

// FAQ 제목이 textarea여서 content : 제목 / re_contetn : 내용으로 사용
if($mode == "AA001") {	//공지사항
	$colspan = "4";
}else if($mode == "AA002") {	//FAQ
	$colspan = "4";
} else if($mode == "AA003"){	//1:1문의
	$colspan = "7";
} else if($mode == "CC001") { //입주상담문의
	$colspan = "9";
} else if($mode == "CC002") { //프렌차이즈상담
	$colspan = "8";

}


if($srcreply) $searchand .= " AND (re_content = '' OR re_content IS NULL)"; //답변대기만보기
if($srcstate) $searchand .= " AND state = 'N' "; //미확인만보기 

if ($strsearch) $searchand .= " AND $search like '%$strsearch%'";

$cnt = QRY_CNT($tbl, $searchand);
$totalpage = QRY_TOTALPAGE($cnt, $recordcnt);
$resultno = QRY_LIST("board", $recordcnt, $page, $searchand . " AND notice = 'Y' ", " idx DESC");
$result = QRY_LIST_echo($tbl, $recordcnt, $page, $searchand, " idx DESC");

?>
<style type="text/css">
	.th { width:10%; }
	.td { width:40%; text-align:left !important; }
</style>


<div id="contents">
	<div class="tit"><?php echo $title_text?>
		<div class="path"><img src="../img/icon-home.png">HOME<img src="../img/arr.png"><?php echo $menu_text2?><img src="../img/arr.png"><?php echo $title_text?></div>
	</div>
	<div class="content">
		<div class="main-box">
			<div class="search-box">
				<form name="searchfrm" method="post" action="?mode=<?php echo $mode?>">
					<input type="hidden" name="mode" value="<?php echo $mode?>">

					<table class="list">
					 <tr>
						<td class="txt-left">
							<input type="text" name="startdate" id="startdate" value="<?=$startdate?>" class="datePickerCss" placeholder="<?=date("Y-m-d")?>" /> -
							<input type="text" name="enddate" id="enddate" value="<?=$enddate?>" class="datePickerCss" placeholder="<?=date("Y-m-d")?>" />	
							<div class="terms_chk02 ">
								<input  class="joinchk chk1" id="date1" name="chk2" onclick="setSearchDate(0)"><i></i><label for="date1">오늘
							</div>
							<div class="terms_chk02 ">
								<input  class="joinchk chk1" id="date2" name="chk2" onclick="setSearchDate(7)"><i></i><label for="date2">일주일
							</div>
							<div class="terms_chk02 ">
								<input  class="joinchk chk1" id="date3" name="chk2" onclick="setSearchDate(30)"><i></i><label for="date3">한달
							</div>
						</td>
					 </tr>
					 <tr>
						<td class="txt-left">
						<?php
							if($mode != "AA004") {
						?>
							<select name="search" id="search" style="width:120px;">
						<?php if($mode == "CC001" || $mode=="CC002") : ?>
								<option value="name"<? if($search == "name") echo " selected"; ?>>작성자</option>
								<option value="hp"<? if($search == "hp") echo " selected"; ?>>휴대폰번호</option>
								<option value="email"<? if($search == "email") echo " selected"; ?>>이메일</option>
						<?php else:?>
								<option value="title"<? if($search == "title") echo " selected"; ?>>제목</option>
								<option value="content"<? if($search == "content") echo " selected"; ?>>내용</option>
						<?php endif; ?>
							</select>
						<?php
							}
						?>
							<input type="text" name="strsearch" style="width:270px;" value="<?php echo $strsearch?>" placeholder="검색어" onKeyPress="if(event.keyCode==13) check_search();" />
							<a href="javascript:check_search();" class="btn">조회</a>
							<a href="/zbackoffice/board/board_list.php?mode=<?php echo $mode?>" class="btn">초기화</a>
						<?php if($mode=="CC001"):?>
							&nbsp;<input type="checkbox" id="srcreply" name="srcreply" value="N" onClick="fnStateView();" <?php echo ($srcreply=="N")?"checked":""?>/><label for="srcreply">답변 대기만 보기</label>
						<?php elseif($mode=="CC002"):?>
							&nbsp;
							&nbsp;<input type="checkbox" id="srcstate" name="srcstate" value="R" onClick="fnStateView();" <?php echo ($srcstate=="R")?"checked":""?> /><label for="srcstate">미확인만 보기</label>
						<?php endif; ?>
							<div class="btn_right">
								검색건수 : <?php echo number_format($cnt)?>건 
							</div>
						</td>
					</tr>
					</table>

				</form>
			</div>
		</div>

		<div class="main-box">
			<form name="Form" id="Form" method="post">
				<input type="hidden" name="typ" value="<?php echo $typ?>">

			<table class="list">
				<tr>
					<!--<th width="5%"><div class="terms_chk"><input type="checkbox" name="alldelchk" id="alldelchk" class="chk1" onClick="alldel_chk(this.checked);"><i></i><label for="alldelchk"></div></th>-->
					<th width="7%">번호</th>
					<th width="12%">이름</th>
				<?php if($mode=="AA001") : ?>
					<th width="*" >제목</th>
					<th width="10%">게시여부</th>
				<?php elseif($mode=="AA002") : ?>
					<th width="*" >제목</th>
					<th width="10%">노출</th>
				<?php else : ?>
					<th width="12%">휴대펀번호</th>
					<th width="12%">이메일</th>
					<?php if($mode=="CC001"):?>
					<th width="12%">지점</th>
					<th width="12%">호실</th>
					<th width="12%">희망입주시기</th>
					<th width="12%">상태</th>
					<?php elseif($mode=="CC002"):?>
					<th width="12%">물건주소</th>
					<th width="12%">세대수</th>
					<th width="12%">상태</th>
					<?php endif;?>
				<?php endif; ?>
					<th width="12%">등록일시</th>
				</tr>

			<?php
			/****************************************************************************/
				while($rowno = mysqli_fetch_array($resultno)) {
					$idx = replace_out($rowno["idx"]);
					$title = replace_out($rowno["title"]);
					$name = replace_out($rowno["name"]);
					$view_yn = replace_out($rowno["view_yn"]);
					$reg_date = substr(replace_out($rowno["reg_date"]), 0, 10);
				/****************************************************************************/
			?>
				<tr>
					<td>[공지]</td>
					<td><?php echo $reg_date ?></td> <!--  class="txt-left" -->
				<?php if($mode=="CC001"):?>
					<td><a href="javascript:;" onClick="gogo('<?php echo $idx?>');"><?php echo $title; ?></a></td>
				<?php elseif($mode=="CC002"):?>
					<td><?php echo $title; ?></td>
				<?php endif; ?>
					<td><?php echo ($view_yn=="Y")? "노출":"미노출" ?></td>
				</tr>
			<?php
				/****************************************************************************/
				}
				/****************************************************************************/
			?>

				<?php
				if ($cnt == 0) {
				?>
				<tr><td colspan="<?php echo $colspan ?>" align="center">데이터가 없습니다</td></tr>
				<?php
				}

				$ListNO = $cnt - (($page - 1) * $recordcnt);
				while($row = mysqli_fetch_array($result)) {
					$idx = replace_out($row["idx"]);
					$mem_idx = replace_out($row["mem_idx"]);
					if($mode=="AA003"){
						$mem_hp = get_want("member", "mem_hp", "AND mem_idx = $mem_idx ");
					}
					$mem_id = replace_out($row["mem_id"]);
					$name = replace_out($row["name"]);
					$hp = replace_out($row["hp"]);
					$email = replace_out($row["email"]);
					$title = replace_out($row["title"]);
					$content = replace_out($row["content"]);
					$re_content = replace_out($row["re_content"]);
					$state_txt = $re_content != "" ? "답변완료" : "답변대기";
					$startdate = replace_out($row["startdate"]);
					$enddate = replace_out($row["enddate"]);
					$state = replace_out($row["state"]); //프렌차이즈상담-상태(N:미확인,Y:확인완료)
					$etc1 = replace_out($row["etc1"]);	//입주상담(지점), 프렌차이즈(물건주소)
					if($mode=="CC001"){
						$branch_name = get_want("branch_info","bh_name"," AND idx=$etc1 ");
					}
					$etc2 = replace_out($row["etc2"]);	//입주상담(호실), 프렌차이즈(세대수)
					$etc3 = replace_out($row["etc3"]);	//입주상담(희망입주시기)
					$hit = replace_out($row["hit"]);
					$view_yn = replace_out($row["view_yn"]);
					if($mode=="CC001"):
						$view_yn_txt = $state == "Y" ? "답변완료" : "답변대기";
					elseif($mode=="CC002"):
						$view_yn_txt = $state == "Y" ? "확인완료" : "<a href='javascript:fnStateChk($idx)' class='btn line'>확인</a>";
					else:
						$view_yn_txt = $view_yn == "Y" ? "노출" : "미노출";
					endif;
					$reg_date = substr(replace_out($row["reg_date"]), 0, 10);

				?>
				<a href="./board_write.php?<?php echo $param?>&idx=<?php echo $idx?>" id="go_<?php echo $idx?>">
				<tr>
					<td><?php echo $ListNO?></td>
				<?php if($mode=="CC002"):?>
					<td><?php echo $name?></td>
				<?php else:?>
					<td><a href="javascript:;" onClick="gogo('<?php echo $idx?>');"><?php echo $name?></a></td>	
				<?php endif; ?>
				<?php if($mode=="AA001" || $mode=="AA002"): ?>
					<td><a href="javascript:;" onClick="gogo('<?php echo $idx?>');"><?php echo $title; ?></a></td>
					<td><?php echo $view_yn_txt?></td>
				<?php else:?>
					<?php if($mode=="CC002"):?>
						<td><?php echo hyphen_hp_number($hp) ?></td>
						<td><?php echo $email ?></td>
					<?php else :?>
						<td><a href="javascript:;" onClick="gogo('<?php echo $idx?>');"><?php echo hyphen_hp_number($hp) ?></a></td>
						<td><a href="javascript:;" onClick="gogo('<?php echo $idx?>');"><?php echo $email ?></a></td>
					<?php endif; ?>
					<?php if($mode=="CC001"):?>
						<td><?php echo $branch_name ?></td>
						<td><?php echo $etc2 ?></td>
						<td><?php echo $etc3 ?></td>
						<td><?php echo $view_yn_txt ?></td>
					<?php elseif($mode=="CC002"):?>
						<td><?php echo $etc1 ?></td>
						<td><?php echo $etc2 ?></td>
						<td><?php echo $view_yn_txt ?></td>
					<?php endif;?>
				<?php endif; ?>
						<td><?php echo $reg_date ?></td>
				</tr>
				<?
					$ListNO--;
				}
				?>
			</table>
			</form>

			<? include $_SERVER["DOCUMENT_ROOT"] . "/zbackoffice/include/paging.php"; ?>

			<div class="btn-right">
			<?php if($mode !="AA003") : ?>
				<!--<a href="./board_write.php?<?php echo $param?>" class="btn">등록</a>
				<a href="javascript:del();" class="btn line">삭제</a>-->
			<?php endif; ?>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
<!--
function del() {
	var f = document.Form;
	if (confirm("삭제하시겠습니까?")) {
		f.typ.value = "alldel";
		f.action = "./board_proc.php?<?php echo $param?>";
		f.submit();
	}
}

function fnStateView(){
	var frm = document.searchfrm;
	frm.submit();
}

//프렌차이즈상담 상태확인
function fnStateChk(num){
	if(confirm("확인완료 하시겠습니까?")){
		$.ajax({
			type : "post",
			url : "board_proc.php",
			dataType : "json",
			timeout : 86400,
			cache : false,
			data: { "typ" : "state_flag", "idx" : num },
			success : function(result) {
				if(result.success == "OK"){
					alert("확인완료 되었습니다.");
					parent.location.reload();
				}else{
					alert("오류가 발생하였습니다.");
					return false;
				}
			}
		});
	}
}
//-->
</script>

<? include $_SERVER["DOCUMENT_ROOT"] . "/zbackoffice/include/footer.php"; ?>
</div>