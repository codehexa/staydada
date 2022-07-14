function fnBG(Arg) {
	if(Arg == "1") $(".layer-bg").fadeIn("1500");
	else $(".layer-bg").fadeOut("1500");
}

function fnBG2(Arg) {
	if(Arg == "1") $(".layer_bg2").fadeIn("1500");
	else $(".layer_bg2").fadeOut("1500");
}


function check_search() {
	var f = document.searchfrm;
	f.submit();
}

function TrimStr(Arg) {
	if(Arg != "undefined" && Arg != undefined) {
		var returnArg = Arg.replace(/^\s+|\s+$/g, "");
		return returnArg;
	}
}

// 공통 / ojb : input id / len : 길이 체크할 경우
function fnChkCommon(obj, txt1, txt2, txt3, len) {
	var Arg = TrimStr($("#" + obj).val());

	if(len > 0) var Arg_len = TrimStr($("#" + obj).val()).length;

	if(txt2 == "1") var txt2_str = "을 "; else var txt2_str = "를 ";
	if(txt3 == "1") var txt3_str = "입력"; else var txt3_str = "선택";


	if(Arg == "" || (len > 0 && Arg_len < len)) {
		alert(txt1 + txt2_str + txt3_str + "해 주십시오.");
		$("#" + obj).val("");
		$("#" + obj).focus();
		var returnArg = "N";
	} else {
		var returnArg = "Y";
	}
	return returnArg;
}

// 공통 / ojb : input id / len : 길이 체크할 경우
//function fnChkCommon2(obj, txt1, txt2, txt3, len) {
//	var Arg = TrimStr($("#" + obj).val());
//	if(len > 0) var Arg_len = TrimStr($("#" + obj).val()).length;
//
//	if(txt2 == "1") var txt2_str = "을 "; else var txt2_str = "를 ";
//	if(txt3 == "1") var txt3_str = "입력"; else var txt3_str = "선택";
//
//
//	if(Arg == "" || (len > 0 && Arg_len < len)) {
//		//alert(txt1 + txt2_str + txt3_str + "해 주십시오.");
//
//		$("#p_" + obj).show();
//
//		$("#" + obj).val("");
//		$("#" + obj).focus();
//		var returnArg = "N";
//	} else {
//		var returnArg = "Y";
//	}
//	return returnArg;
//}

// 숫자만 입력, 나머지 문자 자동으로 삭제
function onlyNum(obj) {
	var num_regx = /^[0-9]*$/;
	if( !num_regx.test(obj.value) ) {
		alert("숫자만 입력할 수 있습니다.");
    	obj.value = "";
    }
}

// 영문, 숫자만 입력되는 기능 / 나머지 문자 자동으로 삭제
function keyType(obj, event) {
	if (!(event.keyCode >=37 && event.keyCode <= 40)) {
		var inputVal = obj.value;
		obj.value = inputVal.replace(/[^a-z0-9]/gi, '');
   }
}

// 중복체크
function fnOverCheck(str, str2) {
	var insVal = TrimStr($("#" + str).val());
	if(str == "mem_id") {
		var txt = "아이디(이메일)";
		var chk_id = "idOverChk";

		if(insVal == "") {
			alert(txt + "를 입력해 주십시오.");
			$("#" + str).val("");
			$("#" + str).focus();
			return;
		}

		var regExp = /^[0-9a-zA-Z]([-_\.]?[0-9a-zA-Z])*@[0-9a-zA-Z]([-_\.]?[0-9a-zA-Z])*\.[a-zA-Z]{2,3}$/i;
		if (!regExp.test(insVal)) {
			alert("아이디(이메일)를 정확하게 입력해 주십시오.");
			$("#" + str).val("");
			$("#" + str).focus();
			return;
		}		
	}

	if(str == "mem_nickname") {
		var txt = "닉네임";
		var chk_id = "nickOverChk";

		if(insVal == "") {
			alert(txt + "를 입력해 주십시오.");
			$("#" + str).val("");
			$("#" + str).focus();
			return;
		}
	}

	/* if(str == "mem_id") {
		var regExp = /^[a-zA-Z0-9!]{6,12}$/;
		if (!regExp.test(Val) || /[^a-z0-9]+|^([a-z]+|[0-9]+)$/i.test(Val)) {
			alert("아이디는 영문 숫자 조합, 6-12자 이내로 입력해 주십시오.");
			$("#mem_id").val("");
			$("#mem_id").focus();
			return;
		}

		var txt = "아이디";
		var chk_id = "idOverChk";

	} else if(str == "mem_email") {
		var regExp = /^[0-9a-zA-Z]([-_\.]?[0-9a-zA-Z])*@[0-9a-zA-Z]([-_\.]?[0-9a-zA-Z])*\.[a-zA-Z]{2,3}$/i;
		if (!regExp.test(Val)) {
			alert("이메일주소를 정확하게 입력해 주십시오.");
			//$("#" + str).val("");
			$("#" + str).focus();
			return;
		}

		var txt = "이메일주소";
		var chk_id = "emailOverChk";
	} */

	$.ajax({
		type : "post",
		url : "/proc/member_proc.php",
		dataType : "json",
		data : { "str" : str, "insVal" : insVal, "typ" : chk_id },
		success : function(result) {
			console.log(result.success);
			if(result.success == "OK") {
				if(str == "mem_id") alert("사용 가능한 아이디입니다.");
				if(str == "mem_nickname") alert("사용 가능한 닉네임입니다.");
				$("#" + str).val(insVal);
				$("#" + str2).focus();
				$("#" + chk_id).val("Y");
			} else {
				if(str == "mem_id") alert("이미 사용중인 아이디입니다.");
				if(str == "mem_nickname") alert("이미 사용중인 닉네임입니다.");
				$("#" + str).focus();
				$("#" + chk_id).val("N");
				return;
			}
		},
		error : function(e) {
			console.log("code : " + result.status + " / message : " + result.responseText + " / error : " + error);
		}
	});
}



// 비밀번호 필수 입력 + 형식 체크
function fnChkPw(str, txt, Val) {
	//var regExp = /^[a-zA-Z0-9!]{6,20}$/;		// 영문 숫자
	//var regExp = /^(?=.*[a-zA-Z])(?=.*[!@#$%^&*()+=-])(?=.*[0-9]).{8,12}$/;	// 영문 숫자 특수문자
	var regExp = /^(?=.*[a-zA-Z])(?=.*[~!@#$%^&*()_+|<>?:{}])(?=.*[0-9]).{8,16}$/;	// 영문 숫자 특수문자

	//if (!regExp.test(Val) || /[^a-z0-9]+|^([a-z]+|[0-9]+)$/i.test(Val)) {
	if (!regExp.test(Val)) {
		alert(txt + " 영문 숫자 특수문자 조합, 8-16자로 입력해 주십시오.");
		$("#" + str).val("");
		$("#" + str).focus();
		var returnArg = "N";
	} else {
		var returnArg = "Y";
		//$("#p_" + str).hide();
	}
	return returnArg;
}

// 이메일주소 필수 입력 + 형식 체크
function fnChkEmail(str, Arg, email1, email2) {
	var regExp = /^[0-9a-zA-Z]([-_\.]?[0-9a-zA-Z])*@[0-9a-zA-Z]([-_\.]?[0-9a-zA-Z])*\.[a-zA-Z]{2,3}$/i;
	if(Arg == "1") var email = email1; else var email = email1 + "@" + email2;

	if (!regExp.test(email)) {
		alert("이메일주소 형식이 맞지 않습니다.");
		//$("#" + str).val("");
		$("#" + str).focus();
		var returnArg = "N";
	} else {
		var returnArg = "Y";
	}
	return returnArg;
}

// 메일 직접입력, 선택
function fnEmail2(Arg1, Arg2) {
	if(Arg2 == "") {
		$("#" + Arg1).val("");
		$("#" + Arg1).focus();
	} else {
		$("#" + Arg1).val(Arg2);
	}
}

function fnReset(Arg) {
	$("#" + Arg).val("");
}

//// 쿠키로 아이디 저장
//function getCookie(cookieName) {
//    cookieName = cookieName + '=';
//    var cookieData = document.cookie;
//    var start = cookieData.indexOf(cookieName);
//    var cookieValue = '';
//    if(start != -1) {
//        start += cookieName.length;
//        var end = cookieData.indexOf(';', start);
//        if(end == -1)end = cookieData.length;
//        cookieValue = cookieData.substring(start, end);
//    }
//    return unescape(cookieValue);
//}
//
//function setCookie(cookieName, value, exdays) {
//    var exdate = new Date();
//    exdate.setDate(exdate.getDate() + exdays);
//    var cookieValue = escape(value) + ((exdays==null) ? "" : "; expires=" + exdate.toGMTString());
//    document.cookie = cookieName + "=" + cookieValue;
//}
//
//$(function() {
//	$("#mem_id").keyup(function() {
//		var save_id = $("#mem_id").val();
//		setCookie("save_id", save_id, 30);
//    });
//
//	if(getCookie("save_id") != "") {
//	    $("#mem_id").val(getCookie("save_id"));
//	}
//});

// 프론트단에서 파일 다운
function fnFileDown(mode, idx, ca_id) {
	window.open("/include/filedownload_new.php?mode=" + mode + "&idx=" + idx + "&ca_id=" + ca_id);
}