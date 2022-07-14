<?php
include $_SERVER["DOCUMENT_ROOT"] . "/include/dbopen.php";
include $_SERVER["DOCUMENT_ROOT"] . "/zbackoffice/include/admin.php";
include $_SERVER["DOCUMENT_ROOT"] . "/include/fileuploader.php";
include $_SERVER["DOCUMENT_ROOT"] . "/PHPMailer/PHPMailerAutoload.php";

$mode = strtoupper(replace_in($mode));
$title = replace_in($title);
$view_date = replace_in($view_date);
$view_yn = replace_in($view_yn);
$content = replace_in($content);
//$content = str_replace("\r\n", "<br>", $content);

$re_title = replace_in($re_title);
$re_content = replace_in($re_content);
//$re_content = str_replace("\r\n", "<br>", $re_content);
$re_state = replace_in($re_state);

$dir_dest = "../.." . $file_path;	//파일 저장 폴더 지정
$dir_dest2 = "../.." . $file_path2;	//파일 저장 폴더 지정

/*echo "<pre>";
print_r($_REQUEST);
echo "</pre>";*/

if ($typ == "write") {
	/** 파일 업로드 ******************************************/
	for($i = 0; $i <= 5; $i++) {
		$query_name = "file" . $i;	//input 파라메터 이름
		if($_FILES[$query_name]) {
			$FILE_1 = RequestFile("file".$i);
			$FILE_1_size = $FILE_1[size];
			$FILE_1_name = $FILE_1[name];
			$FILE_1_type = $FILE_1[type];
//			$maxSize = '209715200';		//200mb, 파일 용량 제한
			$maxSize = '5242880'; //5mb, 파일 용량 제한
			${"filename" . $i} = uploadProc($query_name, $dir_dest, $maxSize, $i,$mode);
			${"filename_real" . $i} = $FILE_1_name;

			if($FILE_1_type=="image/pjpeg" || $FILE_1_type=="image/x-png" || $FILE_1_type=="image/jpeg" || $FILE_1_type=="image/png" || $FILE_1_type=="image/gif"){
               if(${"filename".$i}){
                    $file_info      = getimagesize($_FILES[$query_name]['tmp_name']);
                    $file_width     = $file_info[0]; //이미지 가로 사이즈
                    $file_height    = $file_info[1]; //이미지 세로 사이즈

					if($file_width > 690){
						$thumb_width = 690;
						$thumb_height = 518;
					}else{
						$thumb_width = $file_width;
						$thumb_height = $file_height;
					}
					 thumbnail_makeImg(${"filename".$i}, $dir_dest, $dir_dest2, $thumb_width, $thumb_height, false); //thumbnail.lib.php thumbnail()
			   }
			} //$FILE_1_type end if
		}
	}
	/*******************************************************/

	$sql = "INSERT board SET
		gubun = '$mode'
		,cate = '$cate'
		,mem_idx = '$session_admin_idx'
		,mem_id = '$session_admin_id'
		,name = '$session_admin_name'
		,title = '$title'
		,content = '$content'
		,re_content = '$re_content'
		,hp = '$hp'
		,file1 = '$filename1'
		,file2 = '$filename2'
		,file3 = '$filename3'
		,file4 = '$filename4'
		,file5 = '$filename5'
		,file_real1 = '$filename_real1'
		,file_real2 = '$filename_real2'
		,file_real3 = '$filename_real3'
		,file_real4 = '$filename_real4'
		,file_real5 = '$filename_real5'
		,startdate = '$startdate'
		,enddate = '$enddate'
		,view_yn = '$view_yn'
		,notice = '$notice'
		,secret = '$secret'
		,admin = 'Y'
		,ref = '0'
		,lev = '0'
		,step = '0'
		,view_date = '$view_date'
		,reg_ip = '$log_ip'
		,reg_date = '$log_date'";

	$result = mysqli_query($conn, $sql) or die ("SQL Error : ". mysqli_error($conn));
	$ins_idx=mysqli_insert_id($conn);
	if($result){
/*
		//공지사항-게시(노출)상태인 경우 push 발송 
		if($mode=="AA001"){
			if($view_yn=="Y"):
				//push 발송 넣을것...

				$push_title = get_want("com_code","code_name", "AND idx = 2 AND useyn=1 ");
				$push_msg = get_want("com_code", "etc1", "AND idx = 2 AND useyn=1 ");

				//알림설정한 회원들한테만 push발송
				$sql_mm = " SELECT mem_idx, push_token FROM member WHERE push_token !='' AND push_allow2=1 ";
				$rst_mm = sql_query($sql_mm);
				while($row_mm = mysqli_fetch_array($rst_mm)){
					$mem_idx = replace_out($row_mm["mem_idx"]);
					$push_token = replace_out($row_mm["push_token"]);
                    //get_update("member","push_count=push_count+1"," AND mem_idx = ".$mem_idx." ");
                    //$push_count = get_want("member", "push_count", " AND mem_idx = ".$mem_idx." ");

					//push발송 처리할것~~~


				}
			endif; //$view_yn endif
		}
*/

		Page_Msg_Url("등록되었습니다.", $list_url . "?mode=$mode");
	}
}

if ($typ == "edit") {

	/** 파일 업로드 ******************************************/
	for ($i = 1; $i <= 5; $i++) {
		$query_name = "file" . $i; //input 파라메터 이름
		if($_FILES[$query_name]) {
			$FILE_1 = RequestFile("file" . $i);
			$FILE_1_size = $FILE_1[size];
			$FILE_1_name = $FILE_1[name];
			$FILE_1_type = $FILE_1[type];
			$maxSize = '5242880'; //5mb, 파일 용량 제한
			${"filename" . $i} = uploadProc($query_name, $dir_dest, $maxSize, $i,$mode);
			${"filename_real" . $i} = $FILE_1_name;

			if(${"filename" . $i}) { //업로드된 파일이 있는 경우

				if($FILE_1_type=="image/pjpeg" || $FILE_1_type=="image/x-png" || $FILE_1_type=="image/jpeg" || $FILE_1_type=="image/png" || $FILE_1_type=="image/gif"){

	                $file_info      = getimagesize($_FILES[$query_name]['tmp_name']);
	                $file_width     = $file_info[0]; //이미지 가로 사이즈
	                $file_height    = $file_info[1]; //이미지 세로 사이즈

						if($file_width > 660){
							$thumb_width = 660;
							$thumb_height = 300;
						}else{
							//$thumb_width = (int)($file_width*0.5);
							//$thumb_height = (int)($file_height*0.5);
							$thumb_width = $file_width;
							$thumb_height = $file_height;
						}

					if(${"file_o" . $i}) {
						$old_file = ${"file_o" . $i};
						if(file_exists($DOCUMENT_ROOT . $dir_dest . $old_file)) {
							unlink($DOCUMENT_ROOT . $dir_dest . $old_file);
							unlink($DOCUMENT_ROOT . $dir_dest2 . $old_file);
						}
					}
					// include/thumbnail.lib.php
					thumbnail_makeImg(${"filename".$i}, $dir_dest, $dir_dest2, $thumb_width, $thumb_height, false);
				} // file_1_type end if
			}else{
				${"filename" . $i} = ${"file_o" . $i};
				${"filename_real" . $i} = ${"file_o_real" . $i};
			}// ${"filename" . $i} end if

		}
	}//end for
	/****************************************************/

	$sql = "UPDATE board SET
		cate = '$cate'
		,title = '$title'
		,content = '$content' 
		,re_content = '$re_content'
		,file1 = '$filename1'
		,file2 = '$filename2'
		,file3 = '$filename3'
		,file4 = '$filename4'
		,file5 = '$filename5'
		,file_real1 = '$filename_real1'
		,file_real2 = '$filename_real2'
		,file_real3 = '$filename_real3'
		,file_real4 = '$filename_real4'
		,file_real5 = '$filename_real5'
		,startdate = '$startdate'
		,enddate = '$enddate'
		,view_yn = '$view_yn'
		,view_date = '$view_date'
		,notice = '$notice'
		,mod_ip = '$log_ip'
		,mod_date = '$log_date'
	WHERE idx = '$idx'";
	$result = mysqli_query($conn, $sql) or die ("SQL Error : ". mysqli_error($conn));


	$txt_msg = "수정";

	if($result) Page_Msg_Url($txt_msg."되었습니다.", $list_url . "?$param&idx=$idx");
}

if($typ == "del") {
	$result = QRY_VIEW("board", " AND idx = '$idx'");
	$row = mysqli_fetch_array($result);
	$file1 = $row["file1"];
	$file2 = $row["file2"];
	$file3 = $row["file3"];
	$file4 = $row["file4"];
	$file5 = $row["file5"];
	if($file1) { unlink("$DOCUMENT_ROOT/$file_path/$file1"); unlink("$DOCUMENT_ROOT/$file_path2/$file1"); }
	if($file2) { unlink("$DOCUMENT_ROOT/$file_path/$file2"); unlink("$DOCUMENT_ROOT/$file_path2/$file2"); }
	if($file3) { unlink("$DOCUMENT_ROOT/$file_path/$file3"); unlink("$DOCUMENT_ROOT/$file_path2/$file3"); }
	if($file4) { unlink("$DOCUMENT_ROOT/$file_path/$file4"); unlink("$DOCUMENT_ROOT/$file_path2/$file4"); }
	if($file5) { unlink("$DOCUMENT_ROOT/$file_path/$file5"); unlink("$DOCUMENT_ROOT/$file_path2/$file5"); }

	$sql = "delete from board where idx = '$idx'";
	$result = mysqli_query($conn, $sql) or die ("SQL Error : ". mysqli_error($conn));
	if($result) Page_Msg_Url("삭제되었습니다.", "/zbackoffice/board/board_list.php?mode=$mode");
}

if($typ == "alldel") {
	 $no = $_POST[delchk];
	 for($i = 0; $i < count($no); $i++) {
		$result = QRY_VIEW("board"," AND idx = '$no[$i]'");
		$row = mysqli_fetch_array($result);
		$file1 = $row["file1"];
		$file2 = $row["file2"];
		$file3 = $row["file3"];
		$file4 = $row["file4"];
		$file5 = $row["file5"];
		if($file1) { unlink("$DOCUMENT_ROOT/$file_path/$file1"); unlink("$DOCUMENT_ROOT/$file_path2/$file1"); }
		if($file2) { unlink("$DOCUMENT_ROOT/$file_path/$file2"); unlink("$DOCUMENT_ROOT/$file_path2/$file2"); }
		if($file3) { unlink("$DOCUMENT_ROOT/$file_path/$file3"); unlink("$DOCUMENT_ROOT/$file_path2/$file3"); }
		if($file4) { unlink("$DOCUMENT_ROOT/$file_path/$file4"); unlink("$DOCUMENT_ROOT/$file_path2/$file4"); }
		if($file5) { unlink("$DOCUMENT_ROOT/$file_path/$file5"); unlink("$DOCUMENT_ROOT/$file_path2/$file5"); }

		$sql = "delete from board where idx = '$no[$i]'";
		$result = mysqli_query($conn, $sql) or die ("SQL Error : ". mysqli_error($conn));
	}

	if($result) Page_Msg_Url("삭제되었습니다.", "/zbackoffice/board/board_list.php?mode=$mode");
}

//입주상담문의 답변내용등록,수정
if($typ=="consult_reply"){
	if($idx){

		/********************************************************/
		//메일발송
		/********************************************************/
		$tomail = get_want("board", "email", "AND idx = $idx");
		$user_name = get_want("board", "name", "AND idx = $idx");
		$consult_content = get_want("board", "content", "AND idx = $idx");
		$consult_re_content = str_replace("\r\n", "<br>", $re_content);;

		$real_mem_idx = 0;
		$board_idx = $idx;
		$real_mem_name = $user_name;
		//$frommail = $_SESSION["ADMIN_MAIL"];  //보내는 사람 메일
		$frommail = $admin_mail_user;
		//$frommail = "admin@staydada.com";
		$mail_title = "[$sitename] ".$user_name." 님의 입주상담문의 답변입니다.";  //제목

		include $_SERVER["DOCUMENT_ROOT"]."/include/mail_html/mail01_cc001.php";
		//보내는사람이름,보내는사람이메일,받는사람이메일,제목,내용,1
		send_mail2($frommail,$tomail, $user_name, $mail_content, $mail_title);
		
		$code_name = "입주상담문의";
		include $_SERVER["DOCUMENT_ROOT"]."/include/mail_history.php";
		/********************************************************/

		get_update("board", "re_content='$re_content', state='Y' ", " AND idx = $idx ");
		Page_Msg_Url("답변이 메일발송 되었습니다.", "/zbackoffice/board/board_list.php?mode=$mode");
	}else{
		Page_Msg_Url("필요한 정보를 받지 못하였습니다.", "/zbackoffice/board/board_list.php?mode=$mode");
	}
}

//프렌차이즈상담 확인완료처리
if($typ=="state_flag"){

	if($idx){

		get_update("board", "state='Y'", " AND idx = $idx ");
		$rst["success"] = "OK";
		echo json_encode($rst,JSON_UNESCAPED_UNICODE);
		exit;

	}else{
		$rst["success"] = "NO";
		echo json_encode($rst,JSON_UNESCAPED_UNICODE);
		exit;
	}

}
?>