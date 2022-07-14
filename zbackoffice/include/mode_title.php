<?php
switch ($mode) {
	//1. 사이트관리
	case "SE001";
		$menu_text2 = "사이트관리";
		$title_text = "운영자 관리";
		break;
	case "SE002";
		$menu_text2 = "사이트관리";
		$title_text = "부운영자 관리";
		break;
	case "PP001";
		$menu_text2 = "사이트관리";
		$title_text = "이용약관";
		break;
	case "PP002";
		$menu_text2 = "사이트관리";
		$title_text = "개인정보취급방침";
		break;
	case "PP003";
		$menu_text2 = "사이트관리";
		$title_text = "이벤트 마케팅 알림 수신";
		break;

	//2. 회원목록
	case "MM001";
		$menu_text2 = "회원관리";
		$title_text = "일반회원 관리";
		break;
	case "MM009";
		$menu_text2 = "회원관리";
		$title_text = "탈퇴 회원 관리";
		break;
	case "CM001";
		$menu_text2 = "푸시발송관리";
		$title_text = "푸시 문구 설정";
		break;
	case "CM002";
		$menu_text2 = "푸시발송관리";
		$title_text = "푸시 발송 내역";
		break;
	case "CM003";
		$menu_text2 = "SMS발송관리";
		$title_text = "SMS 문구 설정";
		break;
	case "CM004";
		$menu_text2 = "SMS발송관리";
		$title_text = "SMS 발송 내역";
		break;

	// 3. 지점 관리
	case "BB001";
		$menu_text2 = "지점 관리";
		$title_text = "지점관리";
		break;
	case "BB002";
		$menu_text2 = "지점 관리";
		$title_text = "호실관리";
		break;
	case "BR001";
		$menu_text2 = "코드관리";
		$title_text = "주택유형";
		break;
	case "BR002";
		$menu_text2 = "코드관리";
		$title_text = "룸타입";
		break;
	case "BR003";
		$menu_text2 = "코드관리";
		$title_text = "향(방향)";
		break;
	case "BR004";
		$menu_text2 = "코드관리";
		$title_text = "계약상태";
		break;
	case "BR005";
		$menu_text2 = "코드관리";
		$title_text = "객실상태";
		break;

	// 4. 게시판
	case "CC001";
		$menu_text2 = "게시판 관리";
		$title_text = "입주상담문의";
		break;
	case "CC002";
		$menu_text2 = "게시판 관리";
		$title_text = "프렌차이즈상담";
		break;
	case "AA001";
		$menu_text2 = "게시판 관리";
		$title_text = "공지사항";
		break;
	case "AA002";
		$menu_text2 = "게시판 관리";
		$title_text = "FAQ";
		break;
	case "AA003";
		$menu_text2 = "게시판 관리";
		$title_text = "1:1문의";
		break;

	// 5.통계
	case "SS001";
		$menu_text2 = "통계";
		$title_text = "회원 통계";
		break;
	case "SS002";
		$menu_text2 = "통계";
		$title_text = "이용권 통계";
		break;
	case "SS003";
		$menu_text2 = "통계";
		$title_text = "이용 통계";
		break;
}
?>