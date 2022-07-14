
<script>
$(function() {
	$(".datePickerCss").datepicker({
		//defaultDate : +30,
		//startMonths:'5',
		dateFormat: 'yy-mm-dd',
		monthNamesShort: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
		dayNamesMin: ['일','월','화','수','목','금','토'],
		weekHeader: 'Wk',
		changeMonth: true, //월변경가능
		changeYear: true, //년변경가능
		yearRange:'2022:+10', // 연도 셀렉트 박스 범위(현재와 같으면 1988~현재년)
		showMonthAfterYear: true, //년 뒤에 월 표시
		showOtherMonths: true,
		buttonImageOnly: true, //이미지표시
		buttonText: '날짜를 선택하세요',
		autoSize: false, //오토리사이즈(body등 상위태그의 설정에 따른다)
		buttonImage: '/zbackoffice/img/icon_day.png', //이미지주소
		showOn: "both" //엘리먼트와 이미지 동시 사용
		//minDate: '+0d',
		//maxDate: '+0d'
	});

	$(".datePickerCssNext").datepicker({
		//defaultDate : +30,
		//startMonths:'5',
		dateFormat: 'yy-mm-dd',
		monthNamesShort: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
		dayNamesMin: ['일','월','화','수','목','금','토'],
		weekHeader: 'Wk',
		changeMonth: true, //월변경가능
		changeYear: true, //년변경가능
		yearRange:'2022:+10', // 연도 셀렉트 박스 범위(현재와 같으면 1988~현재년)
		showMonthAfterYear: true, //년 뒤에 월 표시
		showOtherMonths: true,
		buttonImageOnly: true, //이미지표시
		//buttonText: '날짜를 선택하세요',
		autoSize: false, //오토리사이즈(body등 상위태그의 설정에 따른다)
		buttonImage: '/zbackoffice/img/icon_day.png', //이미지주소
		//buttonImageOnly: true,
		showOn: "both", //엘리먼트와 이미지 동시 사용
		//minDate: '+0d',
		maxDate: '+0d'

	});

	$(".datePickerCssPrev").datepicker({
		//defaultDate : +30,
		//startMonths:'5',
		dateFormat: 'yy-mm-dd',
		monthNamesShort: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
		dayNamesMin: ['일','월','화','수','목','금','토'],
		weekHeader: 'Wk',
		changeMonth: true, //월변경가능
		changeYear: true, //년변경가능
		yearRange:'2022:+10', // 연도 셀렉트 박스 범위(현재와 같으면 1988~현재년)
		showMonthAfterYear: true, //년 뒤에 월 표시
		showOtherMonths: true,
		buttonImageOnly: true, //이미지표시
		//buttonText: '날짜를 선택하세요',
		autoSize: false, //오토리사이즈(body등 상위태그의 설정에 따른다)
		buttonImage: '/zbackoffice/img/icon_day.png', //이미지주소
		//buttonImageOnly: true,
		showOn: "both", //엘리먼트와 이미지 동시 사용
		minDate: '+0d'
		//maxDate: '+0d'
	});

	$(".datePickerCssPrevHday").datepicker({
		//defaultDate : +30,
		//startMonths:'5',
		dateFormat: 'yy-mm-dd',
		monthNamesShort: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
		dayNamesMin: ['일','월','화','수','목','금','토'],
		weekHeader: 'Wk',
		changeMonth: true, //월변경가능
		changeYear: true, //년변경가능
		yearRange:'2022:+10', // 연도 셀렉트 박스 범위(현재와 같으면 1988~현재년)
		showMonthAfterYear: true, //년 뒤에 월 표시
		showOtherMonths: true,
		buttonImageOnly: true, //이미지표시
		//buttonText: '날짜를 선택하세요',
		autoSize: false, //오토리사이즈(body등 상위태그의 설정에 따른다)
		buttonImage: '/zbackoffice/img/icon_day.png', //이미지주소
		//buttonImageOnly: true,
		showOn: "both", //엘리먼트와 이미지 동시 사용
		minDate: '+0d',
		//maxDate: '+0d'
		beforeShowDay : disableAllHoliDays
	});

	$(".datePickerCssPreriod").datepicker({
		//defaultDate : +30,
		//startMonths:'5',
		dateFormat: 'yy-mm-dd',
		monthNamesShort: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
		dayNamesMin: ['일','월','화','수','목','금','토'],
		weekHeader: 'Wk',
		changeMonth: true, //월변경가능
		changeYear: true, //년변경가능
		yearRange:'2022:+10', // 연도 셀렉트 박스 범위(현재와 같으면 1988~현재년)
		showMonthAfterYear: true, //년 뒤에 월 표시
		showOtherMonths: true,
		//buttonImageOnly: false, //이미지표시
		//buttonText: '날짜를 선택하세요',
		autoSize: false, //오토리사이즈(body등 상위태그의 설정에 따른다)
		//buttonImage: '/zbackoffice/img/icon_day.png', //이미지주소
		//buttonImageOnly: true,
		//showOn: "both", //엘리먼트와 이미지 동시 사용
		minDate: '+0d',
		maxDate: '+3m',
		beforeShowDay : disableAllHoliDays
	});
});
</script>