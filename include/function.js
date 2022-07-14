function fnBack() {
	history.back();
}

function popup_window(url, winname, opt) {
    window.open(url, winname, opt);
}

//공백 체크=========================================================
function trim(str) {
	return str.replace(/(^\s+)|(\s+)$/, "");
}

//엔터키실행 onkeypress==============================================
function check_key(what) {
	if(window.event.keyCode == 13) {
		what();
	}
}

function check_search() {
	var f = document.searchfrm;
	f.submit();
}

function check_search2(){
	var f = document.top_searchfrm;
	if (f.top_strsearch.value==""){
	}else{
		//if (nullchk(f.strsearch2,"검색어를 입력하세요.")== false) return ;
		f.submit();
	}
}

//이미지 팝업====================================================
function img_popup(pathfile){
	var img = new Image();
	img.src = pathfile;
	var height=parseInt(img.height)+10;
	var width=parseInt(img.width)+20;
	win_open('/include/img_popup.php?pathfile='+pathfile, '', width, height, '0', '0', 'yes', '1')
}
//아이프레임 리사이징================================================
function resizeHeight(FrameName) {
    if(document.all) {
		 var body_height = frames[FrameName].document.body.scrollHeight;
	} else {
		 var body_height= document.getElementById(FrameName).contentWindow.document.body.offsetHeight;
	}

	// 자료가 없을경우 레이어를 보이지 안케하기위해
	if(body_height != 0){ // 자료가 없을대에 높이를 지정해주세요
		document.getElementById(FrameName).style.height=body_height + "px";
	}else{
		document.getElementById(FrameName).style.height=400 + "px";
	}
}


//팝업================================================
function win_pop(page_name,width,height,name,scroll){
	var opt="menubar=no,toolbar=no,resizable=no,location=no,status=no,scrollbars="+scroll+",width="+width+",height="+height;
	var page=page_name;
	var win=open(page,name, opt);
}

//새창
//url : 열릴 url, win_name : 창이름, width : 가로크기, height : 세로크기,
//top : 상하위치, left : 좌우위치, scroll 스크롤유무, center : 새창 가운데 뜨게
//center true 일 경우 top, left 무시
//예시 : <a href="/html/01_fcs/" onclick="win_open(this.href, '', '800', '700', '', '', '1', '1');return false;">
// '/html/01_fcs/' 를 새창에서 가로 800, 세로 700, 가운데로 띄움
function win_open(url, win_name, width, height, top, left, scroll, center){
	if(top)	{
		p_top=top;
	}	else	{
		p_top=0;
	}
	if(left)	{
		p_left=left;
	}	else	{
		p_left=0;
	}
	if(center)	{
		p_top=(screen.height - height) / 2;
		p_left=(screen.width - width) / 2;
	}

	win=window.open(url, win_name, "width="+width+", height="+height+", top="+p_top+", left="+p_left+", scrollbars="+scroll);
	win.window.focus();
}
function win_open2(url, win_name){
	win=window.open(url, win_name, "");
	win.window.focus();
}


//이메일체크================================================
function validEmail(strEmail) {
	var pattern = /^[_a-zA-Z0-9-\.]+@[\.a-zA-Z0-9-]+\.[a-zA-Z]+$/;
	return pattern.test(strEmail);
}

//이메일체크================================================
function validEmail2(obj, msg1, msg2) {
	var strEmail = obj.value;
	if (trim(strEmail)==""){
		alert(msg1 + "를 입력해 주십시오.");
		obj.focus();
		return false;
	}
	var pattern = /^[_a-zA-Z0-9-\.]+@[\.a-zA-Z0-9-]+\.[a-zA-Z]+$/;
	if (pattern.test(strEmail) == false) {
		alert(msg2 + "를 정확하게 입력해 주십시오.");
		obj.focus();
		return false;
	}
}

//아이디체크================================================
function validId(strId,min,max){
	var pattern = eval("/^[a-zA-Z0-9]{"+min+","+max+"}$/");
	return pattern.test(strId);
}

//비밀번호체크================================================
function validPassWord(strPassWord,min,max){
	var pattern = eval("/^[a-zA-Z0-9]{"+min+","+max+"}$/");
	return pattern.test(strPassWord);
}

//비밀번호체크================================================
function valid(strPassWord,min,max){
	var pattern = eval("/.{"+min+","+max+"}$/");
	return pattern.test(strPassWord);
}
//비밀번호체크================================================

function nullchk(obj, msg) {
	if (trim(obj.value) == "") {
		alert(msg);
		obj.focus();
		return false;
	}
}

function nullchk_inner(obj,id,msg){
	if (trim(obj.value)==""){
		document.getElementById(id).innerHTML = msg;
		return false;
	}

}

function nullchk_inner2(id,msg){
	document.getElementById(id).innerHTML = msg;
}

//비밀번호체크================================================
function nullchkpwd_inner(obj,id,msg,min,max){
	if (trim(obj.value)=="" || trim(obj.value).length<min || trim(obj.value).length>max){
		document.getElementById(id).innerHTML = msg;
		obj.focus();
		return false;
	}else{
		document.getElementById(id).innerHTML = "";
	}

}

//비밀번호체크================================================
function nullchkleng(obj, msg, min, max) {
	if (trim(obj.value) == "" || trim(obj.value).length < min || trim(obj.value).length > max) {
		alert(msg);
		obj.focus();
		return;
	}
}

function nullchecked(obj,msg){
	var that = 0;
	for(var i=0;i<obj.length;i++){
		if (obj[i].checked==true){
			that = 1;
			break;
		}
	}
	if (that!=1){
		alert(msg);
		obj[0].focus();
		return false;
	}
}
function nullchecked2(obj,msg){
	var that = 0;
	var obj = document.getElementsByName(obj)
	for(var i=0;i<obj.length;i++){
		if (obj[i].checked==true){
			that = 1;
			break;
		}
	}
	if (that!=1){
		alert(msg);
		obj[0].focus();
		return false;
	}
}

function nullchecked3(obj,msg){
	var that = 0;
	var obj = document.getElementsByName(obj)
	for(var i=0;i<obj.length;i++){
		if (obj[i].checked==true){
			that = 1;
			break;
		}
	}
	if (that!=1){
		alert(msg);
		//obj[0].focus();
		return false;
	}
}
function nullchecked1(obj,msg){
	if (obj.checked==false){
		alert(msg);
		obj.focus();
		return false;
	}
}

//수량체크================================================
function isNumeric(s)
{
	for (i=0; i<s.length; i++) {
		c = s.substr(i, 1);
		if (c < "0" || c > "9") return false;
	}
	return true;
}

function isNum(numchar)
{
	len = numchar.value.length ;
	ch = numchar.value.charAt(len - 1) ;
	if ( ( ch < '0' ) || ( ch > '9') )
	{
		str = numchar.value ;
		for ( i = 0 ; i < len ; i ++ ){
			numchar.value = str.substr(0, len - 1) ;
		}
	}
}

function isNum2(id,x) {
	  x = x.replace(/[^0-9]/g,'');   // 입력값이 숫자가 아니면 공백
	  x = x.replace(/,/g,'');          // ,값 공백처리
	  $("#"+id).val(x.replace(/\B(?=(\d{3})+(?!\d))/g, ",")); // 정규식을 이용해서 3자리 마다 , 추가
	}

//?================================================
function isKorean(obj) {
    //var len = obj.value.length;
    var len = obj.length;
    var numUnicode;

    for(i=0;i < len; i++)
    {
        //numUnicode = obj.value.charCodeAt(i)
        numUnicode = obj.charCodeAt(i)
        if ( 44032 <= numUnicode && numUnicode <= 55203 )
        {
            continue;
        }else{
            return false;
            break;
        }
    }

    return true;
}

//전체체크================================================
function alldel_chk(bool) {
	var obj = document.getElementsByName("delchk[]");
	for (var i=0; i<obj.length; i++) {
		obj[i].checked = bool;
	}
}



//우편번호찾기================================================
function search_post2(fname,pname1,pname2,aname){
	var opt="width=500,height=500,scrollbars=auto";
	var page="/zipcode/post_search?fname="+fname+"&pname1="+pname1+"&pname2="+pname2+"&aname="+aname+"";
	var win=open(page,"search_post",opt);
	return;
}

function search_post(fname,pname1,aname1,aname2){
	var opt="width=620,height=500,scrollbars=1";
	//var page="/zipcode/post_search.php?fname="+fname+"&pname1="+pname1+"&pname2="+pname2+"&aname="+aname+"";
	var page="/zipcode/zip_search_new?frm_name="+fname+"&frm_zip1="+pname1+"&frm_addr1="+aname1+"&frm_addr2="+aname2+"";
	//var win=open(page,"search_post",opt);

	win_open(page, '', '620', '500', '', '', '1', 'true')
	return;
}



//플래쉬영상 추가'20120513================================================
function objflash(URL,wid,hei,mode,LT,scale)
{
document.write("<object classid='clsid:D27CDB6E-AE6D-11cf-96B8-444553540000' codebase='http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0' width='"+wid+"' height='"+hei+"'>");
document.write("<param name='movie' value='"+URL+"'>");
document.write("<param name='quality' value='high'>");
document.write("<param name='wmode' value='"+mode+"'>");
document.write("<param name='salign' value='"+LT+"'>");
document.write("<param name='scale' value='" + scale + "'>");
document.write("<embed src='"+URL+"' width='"+wid+"' height='"+hei+"' quality='high' wmode='"+mode+"' scale='"+scale+"' salign='"+LT+"' pluginspage='http://www.macromedia.com/go/getflashplayer' type='application/x-shockwave-flash'></embed>");
document.write("</object>");
}


function objflash2(URL,wid,hei,mode,LT,scale,Fid)
{
document.write("<object classid='clsid:D27CDB6E-AE6D-11cf-96B8-444553540000' codebase='http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0' width='"+wid+"' height='"+hei+"' id='"+Fid+"'>");
document.write("<param name='movie' value='"+URL+"'>");
document.write("<param name='quality' value='high'>");
document.write("<param name='WMODE' value='"+mode+"'>");
document.write("<param name='salign' value='"+LT+"'>");
document.write("<param name='scale' value='" + scale + "'>");
document.write("<embed id='"+Fid+"' src='"+URL+"' width='"+wid+"' height='"+hei+"' quality='high' wmode='"+mode+"' scale='"+scale+"' salign='"+LT+"' pluginspage='http://www.macromedia.com/go/getflashplayer' type='application/x-shockwave-flash'></embed>");
document.write("</object>");
}

//엑셀다운로드
function down_excel(url){
	if (!confirm("엑셀 파일로 다운로드 하시겠습니까?")) return;
	var f = document.excel_down;
	f.action=url+".php";
	f.submit();
}


function gogo(idx){
	location.href=document.getElementById("go_"+idx).href;
}

//날짜검색=========================================================================================
function setSearchDate(num){
	var now = new Date();
	var enddate = now.getFullYear()+'-'+fncLPAD((now.getMonth()+1))+'-'+fncLPAD(now.getDate());
	var startdate
	now.setDate(now.getDate() - num);
	startdate = now.getFullYear()+'-'+fncLPAD((now.getMonth()+1))+'-'+fncLPAD(now.getDate())
	document.searchfrm.startdate.value=startdate;
	document.searchfrm.enddate.value=enddate;
}

function fncLPAD(num){
	if(num<10) return '0'+num;
	else return ''+num;
}

function setSearchDate2(num){
	var now = new Date();
	var enddate = now.getFullYear()+'-'+fncLPAD((now.getMonth()+1))+'-'+fncLPAD(now.getDate());
	var startdate
	now.setDate(now.getDate() + num);
	startdate = now.getFullYear()+'-'+fncLPAD((now.getMonth()+1))+'-'+fncLPAD(now.getDate())
	document.searchfrm.startdate.value=enddate;
	document.searchfrm.enddate.value=startdate;
}

function fncLPAD(num){
	if(num<10) return '0'+num;
	else return ''+num;
}

//날짜검색=========================================================================================

//sns 메쉬업
function goSNS(sns){
	var f = document.snsf;

	f.sns.value = sns;
	f.target = "proc";
	f.action = "/oAuth/sns.asp";
	f.submit();
}


//sns 로그아웃
function snslogin(part){
	pageurl = "/oAuth/"+part+"/login.asp";
	if (part=="mariana"){
		var nowpage = location.href;
		document.location.href="/login.asp?return_url="+encodeURIComponent(nowpage);
	}else{
		window.open(pageurl,part,"width=800,height=600");
	}
}


//sns 로그인
function snslogout(part){
	pageurl = "/oAuth/"+part+"/logout.asp"
	window.open(pageurl,part,"width=800,height=600")
}

//sns를 이용한 코멘트 달기
function addComment(oForm) {
	if (!oForm)
		return;
	if (oForm.comm_content.value.length<1||oForm.comm_content.value.length>250){
		alert("댓글은 1자 이상 250자 이하로 입력해주세요.");
		return;
	}

	if (!confirm("댓글을 등록 하시겠습니까?")){
		return;
	}

	var comm_content_br = oForm.comm_content.value;
	comm_content_br= comm_content_br.replace(/\r\n/gi, "<br>");
	comm_content_br= comm_content_br.replace(/\n/gi, "<br>");
	comm_content_br= comm_content_br.replace(/\r/gi, "<br>");

	var request = new HTTPRequest("POST", oForm.action);
	var queryString = "typ=comm_write";
	if(oForm["idx"])
		queryString += "&idx=" + encodeURIComponent(oForm["idx"].value);
	if(comm_content_br)
		queryString += "&comm_content=" + comm_content_br ;
	if(oForm["sns_url"])
		queryString += "&sns_url=" + encodeURIComponent(oForm["sns_url"].value);
	//alert(oForm["sns_url"].value)

	oForm.comm_content.value="";
	request.send(queryString);

	request.onSuccess = function () {
		//oForm["comm_content"].value="";

		//document.getElementById("reply_list").innerHTML = document.getElementById("reply_list").innerHTML + this.getText("/response/commentBlock");
		$('#comment_list').append(this.getText("/response/commentBlock"));
		var comm_idx = this.getText("/response/comm_idx");
		var coTop = $('#co'+comm_idx+'').position().top;
		//window.scrollTo(0,coTop);
		jQuery('html,body').animate( { 'scrollTop': coTop }, 'slow' );
		$('#co'+comm_idx+'').fadeOut().fadeIn();
	}

	request.onError = function() {
		//alert(this.getText("/response/description"));
	}
}

//숫자에 콤마 삽입
function commaNum(num) {
   var minus = false;
   if (num < 0) {
      num *= -1;
      var minus = true;
   }
   var dotPos = (num+"").split(".")
   var dotU = dotPos[0];
   var dotD = dotPos[1];
   var commaFlag = dotU.length%3;
   var out = "";
   if (commaFlag) {
      out = dotU.substring(0, commaFlag);
      if (dotU.length > 3) out += ",";
   }
   for (var i = commaFlag; i < dotU.length; i+=3) {
      out += dotU.substring(i, i+3);
      if (i < dotU.length-3) out += ",";
   }
   if (minus) out = "-" + out;
   if (dotD) return out + "," + dotD;
   else return out;
}
function win_zip(frm_name, frm_zip1, frm_zip2, frm_addr1, frm_addr2)
{
	url = "/member/zipcode_search.php?frm_name="+frm_name+"&frm_zip1="+frm_zip1+"&frm_zip2="+frm_zip2+"&frm_addr1="+frm_addr1+"&frm_addr2="+frm_addr2;
	window.open(url, "winZip", "left=50,top=50,width=500,height=550,scrollbars=yes");
}

function is_checked(elements_name){
    var checked = false;
    var chk = document.getElementsByName(elements_name);
    for (var i=0; i<chk.length; i++) {
        if (chk[i].checked) {
            checked = true;
        }
    }
    return checked;
}

//이미지 리사이징================================================
function img_resize(imgi,wid,hei){
	var img = new Image();
	img.src = document.getElementById(imgi).src;

	var height=img.height;
	var width=img.width;
	if (width>height){

		if (width>parseInt(wid)){
			document.getElementById(imgi).width = wid;
		}else{
			document.getElementById(imgi).width=img.width;
		}

	}else{
		//if (height>hei){
		//	document.getElementById(imgi).height = hei;
		//}else{
			document.getElementById(imgi).height=img.height;
		//}
	}
}

function wrestNumeric(fld)
    {
        if (fld.value.length > 0)
        {
            for (i = 0; i < fld.value.length; i++)
            {
                if (fld.value.charAt(i) < '0' || fld.value.charAt(i) > '9')
                {
                    alert("숫자만 입력가능합니다.");
                    fld.value="";
					fld.focus();
					return false;
                }
            }
        }
    }
function wrestNumeric2(fld)
    {
        if (fld.value.length > 0)
        {
            for (i = 0; i < fld.value.length; i++)
            {
                if (fld.value.charAt(i) < '1' || fld.value.charAt(i) > '9')
                {
                    alert("수량은 1 이상만 가능합니다.");
                    fld.value="1";
					fld.focus();
					return false;
                }
            }
        }
    }
function number_format(data)  {
	var tmp = '';
	var number = '';
	var cutlen = 3;
	var comma = ',';
	var i;

	len = data.length;
	mod = (len % cutlen);
	k = cutlen - mod;
	for (i=0; i<data.length; i++){
		number = number + data.charAt(i);

		if (i < data.length - 1){
			k++;
			if ((k % cutlen) == 0){
				number = number + comma;
				k = 0;
			}
		}
	}

	return number;
}

function down(para){
	window.open("/include/filedownload.php?"+para);
}


function check_checkbox(fm,name){
	if(fm.checked == false){
		alert(name + "을(를) 체크하지 않았습니다.\n\n" +  name + "을(를) 체크하여 주십시오.");
		return "wrong";
	}
}

//첨부파일
function file_chk(var_id){
        var aaaa= document.getElementById(var_id).value;
        j$("#"+var_id+"_dp").val(aaaa);

}

function file_profile_chk(var_id){
        var aaaa= document.getElementById(var_id).value;
		//alert (var_id);
         //$("#"+var_id+"_dp").val(aaaa);
		var f =  document.f;

		//alert (f.go_url.value);

		f.typ.value="profile_write";
		f.encoding = "multipart/form-data";
		f.action = "/mypage/mypage_proc.php";
		f.submit();



}

function file_profile_chk1(var_id){
        var aaaa= document.getElementById(var_id).value;
         $("#"+var_id+"_dp").val(aaaa);

}

function search_head(){
	//alert ("sdfsdf");
	var f =  document.searchfrm;

	f.action="/category/category_search_list.php";
	f.submit();
}

function search_head_request(){
	//alert ("sdfsdf");
	var f =  document.searchfrm;

	f.action="/request/request.php";
	f.submit();
}

function msg_write_go(idx_val, mem_idx_val){
	//alert (idx_val);
	//alert (mem_idx_val);
	location.href="/request/request_view.php?idx="+idx_val+"&p=&sel_status=&list=&bottom=1&suggest_idx_lhk="+mem_idx_val;
	///request/request_view.php?idx=24&p=&sel_status=&list=&bottom=1
}


function setCookie(name, value, exp) {


  var date = new Date();
  date.setTime(date.getTime() + exp*24*60*60*1000);
  document.cookie = name + '=' + value + ';expires=' + date.toUTCString() + ';path=/';

}

function getCookie(name) {
   var value = document.cookie.match('(^|;) ?' + name + '=([^;]*)(;|$)');
	return value? value[2] : null;
}



function email_domain_input(fm, idx) {
	if (idx == '0')
		fm.value = '';
	else
		fm.value = idx;
}


function check_num(fm,name){

	var str=fm.value
	for (i = 0; i < str.length; i++) {
		if (str.charAt(i) >= '0' && str.charAt(i) <= '9')
			continue;
		else {
			alert(name + "에는 숫자만 사용하실 수 있습니다.");
			fm.focus();
			fm.select();
			return "wrong";
		}
	}
}

function check_contact() {

	var fm = document.f_contact;

	if (nullchk(fm.name,"이름을 입력해주세요.")== false) return ;
	if (nullchk(fm.tel1,"연락처를 입력해주세요.")== false) return ;
	if (nullchk(fm.etc1,"나이를 입력해주세요.")== false) return ;
	if(check_checkbox(fm.chk2, '개인정보취급방침동의')=='wrong') {return;}
    fm.encoding = "multipart/form-data";
	fm.action="/board/board_proc.php";
	fm.submit();
}


function go_where(type,val){
if(type=="t"){
window.open("https://twitter.com/intent/tweet?"+val);
}else if (type=="f")
{
window.open("http://www.facebook.com/sharer/sharer.php?"+val);
}else if (type=="k")
{
window.open("https://story.kakao.com/share?"+val);
}

}

function profile_up(idx, objIdTxt){
	var datas, xhr;
	datas = new FormData();
	if($('#file'+objIdTxt ).val() != ""){
		datas.append( 'file'+objIdTxt, $( '#file'+objIdTxt )[0].files[0] );
		datas.append( 'idx', idx);
		datas.append( 'num', objIdTxt);

		$.ajax({
			url: "/include/ajax_fileupload.php",
			contentType: 'multipart/form-data',
			type: 'POST',
			data: datas,
			success: function (data) {
				if(data!="no"){
					document.getElementById("pic"+objIdTxt).src = "/upload/thum/"+trim(data);
				}
			},
			cache: false,
			contentType: false,
			processData: false,
		});
	}

}

function profile_up2(idx, objIdTxt,file_id){
	var datas, xhr;
	datas = new FormData();
	if($('#file'+objIdTxt ).val() != ""){
		datas.append( 'file'+objIdTxt, $( '#file'+objIdTxt )[0].files[0] );
		datas.append( 'idx', idx);
		datas.append( 'num', objIdTxt);
		datas.append( 'file_id', file_id);
		$.ajax({
			url: "/include/ajax_fileupload2.php",
			contentType: 'multipart/form-data',
			type: 'POST',
			data: datas,
			success: function (data) {
				if(data!="no"){
					document.getElementById("pic"+objIdTxt).src = "/upload/file/"+trim(data);
				}
			},
			cache: false,
			contentType: false,
			processData: false,
		});
	}

}
//sns 공유하기 ====================================================
function sns_share(path){

		window.open(path, '_blank', 'location=yes,height=570,width=520,scrollbars=yes,status=yes');
}


//3자리 단위마다 콤마 생성
function addCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

//모든 콤마 제거
function removeCommas(x) {
    if(!x || x.length == 0) return "";
    else return x.split(",").join("");
}

$(document).ready(function(){
	//숫자만 입력되고 자동으로 콤마 삽입.
	$(document).on("keyup","input:text[numberComma]",function(){
	//$("input:text[numberComma]").on("keyup", function() {
		$(this).val(addCommas($(this).val().replace(/[^0-9]/g,"")));
	});
	$("input:text[numberOnly]").on("keyup", function() {
		$(this).val($(this).val().replace(/[^0-9]/g,""));
	});
});


function go_login(mem){
	if(mem==""){
		alert("로그인 후 이용가능합니다");
		location.href="/buyer/member/login.php";
	}
}

function go_login_url(mem,url){ //구매자 회원체크 로그인 또는 해당링크 이동
	if(mem==""){
		alert("로그인 후 이용가능합니다");
		location.href="/buyer/member/login.php";
	}else{
		location.href=url;
	}
}

function go_login_url2(mem,url){ //판매자 회원체크 로그인 또는 해당링크 이동
	if(mem==""){
		alert("로그인 후 이용가능합니다");
		location.href="/seller/member/login.php"
	}else{
		location.href=url;
	}
}

//datepicker 공휴일 제외
function disableAllHoliDays(date){
	var day = date.getDay();
	return[(day !=0 && day != 6)];
	//-0:일요일, 6:토요일 안나오게..
}