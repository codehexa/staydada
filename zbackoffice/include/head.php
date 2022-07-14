<?php include $_SERVER["DOCUMENT_ROOT"] . "/zbackoffice/include/top.php"; ?>

<div id="head-wrap">
	<div class="center-wrap">
		<div class="info" style="float:left; width:60%;"><img src="../img/user_icon.png"><?=$_SESSION["ADMIN_NAME"]?> <span>님께서 로그인 하셨습니다</span></div>

		<!-- <div class="f-right"> -->
		<div style="float:left; width:37%;">
			<a href="/" class="btn gray-s" target="_blank"><img src="../img/botn-info.png">&nbsp;웹사이트이동</a>&nbsp;&nbsp;
			<a href="../change/change.php?mode=SE001" class="btn gray-s"><img src="../img/botn-info.png">&nbsp;정보수정</a>&nbsp;&nbsp;
			<a href="../logout.php" class="btn blue"><img src="../img/botn-logout.png">로그아웃</a>
		</div>
	</div>
</div>

<div class="top-menu">
	<a href="/zbackoffice/change/change.php?mode=SE001"<? if(substr($mode, 0, 2) == "SE") echo " class='on'"; ?>>사이트관리</a>
	<!--<a href="#"<? if(substr($mode, 0, 2) == "MM" || substr($mode, 0, 2) == "ME") echo " class='on'"; ?>>회원관리</a>-->
	<a href="/zbackoffice/branch/branch_list.php?mode=BB001"<? if(substr($mode, 0, 2) == "BB") echo " class='on'"; ?>>지점관리</a>
	<a href="/zbackoffice/board/board_list.php?mode=CC001"<? if(substr($mode, 0, 2) == "AA" || substr($mode, 0, 2) == "CC") echo " class='on'"; ?>>게시판관리</a>
	<!--<a href="#"<? if(substr($mode, 0, 2) == "SS") echo " class='on'"; ?>>통계</a>-->
</div>

<div id="left-wrap">
	<div class="logo"><?=$sitename?><span>ADMINISTRATOR</span></div>
	<div id="gnb">
		<ul class="depth1">
			<? if(substr($mode, 0, 2) == "SE" || substr($mode, 0, 2) == "PP") { ?>
			<li>
				<a href="#">관리자 계정 관리</a>
				<ul class="depth2">
					<li class="m03"><a href="/zbackoffice/change/change.php?mode=SE001"<? if($mode == "SE001") echo " class='active'"; ?>>운영자 관리</a></li>
					<!--<li class="m03"><a href="/zbackoffice/change/change_sub.php?mode=SE002"<? if($mode == "SE002") echo " class='active'"; ?>>부운영자 관리</a></li>-->
				</ul>
			</li>
			<li>
				<a href="#">약관관리</a>
				<ul class="depth2">
					<li class="m03"><a href="/zbackoffice/board/policy_write.php?mode=PP001"<? if($mode == "PP001") echo " class='active'"; ?>>이용약관</a></li>
					<li class="m03"><a href="/zbackoffice/board/policy_write.php?mode=PP002"<? if($mode == "PP002") echo " class='active'"; ?>>개인정보취급방침</a></li>
					<!--<li class="m03"><a href="/zbackoffice/board/policy_write.php?mode=PP003"<? if($mode == "PP003") echo " class='active'"; ?>>이벤트 마케팅 알림 수신</a></li>-->
				</ul>
			</li>
			<?
			}
			?>

			<? if(substr($mode, 0, 2) == "MM" || substr($mode, 0, 2) == "CM") { ?>
			<li>
				<a href="#">회원 관리</a>
				<ul class="depth2">
					<li class="m03"><a href="/zbackoffice/member/member_list.php?mode=MM001"<? if($mode == "MM001") echo " class='active'"; ?>>일반회원 관리</a></li>
					<li class="m03"><a href="/zbackoffice/member/member_list.php?mode=MM009"<? if($mode == "MM009") echo " class='active'"; ?>>탈퇴 회원 관리</a></li>
				</ul>
			</li>
			<!--<li>
				<a href="#">메일 발송 관리</a>
				<ul class="depth2">
					<li class="m03"><a href="/zbackoffice/msg/email_history.php?mode=CM001"<? if($mode == "CM001") echo " class='active'"; ?>>메일 발송 내역</a></li>
				</ul>
			</li>-->
			<li>
				<a href="#">푸시 발송 관리</a>
				<ul class="depth2">
					<li class="m03"><a href="/zbackoffice/msg/push_set.php?mode=CM001"<? if($mode == "CM001") echo " class='active'"; ?>>푸시 문구 설정</a></li>
					<li class="m03"><a href="/zbackoffice/msg/push_list.php?mode=CM002"<? if($mode == "CM002") echo " class='active'"; ?>>푸시 발송 내역</a></li>
				</ul>
			</li>
			<li>
				<a href="#">SMS 발송 관리</a>
				<ul class="depth2">
					<li class="m03"><a href="/zbackoffice/msg/push_set.php?mode=CM003"<? if($mode == "CM003") echo " class='active'"; ?>>SMS 문구 설정</a></li>
					<li class="m03"><a href="/zbackoffice/msg/sms_history.php?mode=CM004"<? if($mode == "CM004") echo " class='active'"; ?>>SMS 발송 내역</a></li>
				</ul>
			</li>
			<? } ?>

			<? if(substr($mode, 0, 2) == "BB" || substr($mode, 0, 2) == "BR") { ?>
			<li>
				<a href="#">지점 관리</a>
				<ul class="depth2">
					<li class="m03"><a href="/zbackoffice/branch/branch_list.php?mode=BB001"<? if($mode == "BB001") echo " class='active'"; ?>>지점관리</a></li>
					<li class="m03"><a href="/zbackoffice/branch/room_list.php?mode=BB002"<? if($mode == "BB002") echo " class='active'"; ?>>호실관리</a></li>
				</ul>
			</li>
			<?php //if($_SERVER["REMOTE_ADDR"] == "183.98.83.30") : ?>
			<li>
				<a href="#">코드 관리</a>
				<ul class="depth2">
					<li class="m03"><a href="/zbackoffice/change/comcode.php?mode=BR001"<? if($mode == "BR001") echo " class='active'"; ?>>주택유형</a></li>
					<li class="m03"><a href="/zbackoffice/change/comcode.php?mode=BR004"<? if($mode == "BR004") echo " class='active'"; ?>>계약상태</a></li>
					<li class="m03"><a href="/zbackoffice/change/comcode.php?mode=BR005"<? if($mode == "BR005") echo " class='active'"; ?>>객실상태</a></li>
					<li class="m03"><a href="/zbackoffice/change/comcode.php?mode=BR002"<? if($mode == "BR002") echo " class='active'"; ?>>룸타입</a></li>
					<li class="m03"><a href="/zbackoffice/change/comcode.php?mode=BR003"<? if($mode == "BR003") echo " class='active'"; ?>>향(방향)</a></li>
				</ul>
			</li>
			<?php //endif; ?>
			<? } ?>
			<? if(substr($mode, 0, 2) == "AA" || substr($mode, 0, 2) == "CC" ) { ?>
			<li>
				<a href="#">게시판 관리</a>
				<ul class="depth2">
					<li class="m03"><a href="/zbackoffice/board/board_list.php?mode=CC001"<? if($mode == "CC001") echo " class='active'"; ?>>입주상담문의</a></li>
					<li class="m03"><a href="/zbackoffice/board/board_list.php?mode=CC002"<? if($mode == "CC002") echo " class='active'"; ?>>프렌차이즈상담</a></li>
				<!--
					<li class="m03"><a href="/zbackoffice/board/board_list.php?mode=AA001"<? if($mode == "AA001") echo " class='active'"; ?>>공지사항</a></li>
					<li class="m03"><a href="/zbackoffice/board/board_list.php?mode=AA002"<? if($mode == "AA002") echo " class='active'"; ?>>FAQ</a></li>
					<li class="m03"><a href="/zbackoffice/board/board_list.php?mode=AA003"<? if($mode == "AA003") echo " class='active'"; ?>>1:1 문의</a></li>
				-->
				</ul>
			</li>
			<? } ?>

			<? if(substr($mode, 0, 2) == "SS") { ?>
			<li>
				<a href="#">통계</a>
				<ul class="depth2">
					<li class="m03"><a href="/zbackoffice/statistics/member.php?mode=SS001"<? if($mode == "SS001") echo " class='active'"; ?>>회원 통계</a></li>
					<li class="m03"><a href="/zbackoffice/statistics/ticket.php?mode=SS002"<? if($mode == "SS002") echo " class='active'"; ?>>이용권 통계</a></li>
					<li class="m03"><a href="/zbackoffice/statistics/reserve.php?mode=SS003"<? if($mode == "SS003") echo " class='active'"; ?>>이용 통계</a></li>
				</ul>
			</li>
			<? } ?>
		</ul>
	</div>
</div>