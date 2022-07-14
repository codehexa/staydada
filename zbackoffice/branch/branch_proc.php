<?php
include $_SERVER["DOCUMENT_ROOT"] . "/include/dbopen.php";
include $_SERVER["DOCUMENT_ROOT"] . "/zbackoffice/include/admin.php";
include $_SERVER["DOCUMENT_ROOT"] . "/include/fileuploader.php";
include $_SERVER["DOCUMENT_ROOT"] . "/PHPMailer/PHPMailerAutoload.php";

/***********************************************************/
//지점등록,수정,삭제관련 처리 
/***********************************************************/

error_reporting(E_ALL);
ini_set('display_errors', '0');

/*echo "<pre>";
print_r($_REQUEST);
print_r($_FILES);
echo "</pre>";*/

$bh_name	= replace_in($bh_name);		//지점명
$hous_type	= replace_in($hous_type);	//주택유형
$bh_post	= replace_in($bh_post);		//우편번호
$bh_addr1	= replace_in($bh_addr1);	//주소
$bh_addr2	= replace_in($bh_addr2);	//상세주소
$lat		= replace_in($lat);			//위도
$lon		= replace_in($lon);			//경도
$bh_floor	= replace_in($bh_floor);	//층
$bh_ginfo	= replace_in($bh_ginfo);	//세대정보
$bh_total_area	= replace_in($bh_total_area);	//연면적
$parking_yn		= replace_in($parking_yn);	//주차가능여부
$main_cost	= replace_in($main_cost);		//관리비
$view_yn	= replace_in($view_yn);		//게시여부
$etc_option	= replace_in($etc_option);	//기타옵션
$content	= replace_in($content);		//지점설명
$trans_info = replace_in($trans_info);	//주변대중교통정보 
//$content = str_replace("\r\n", "<br>", $content);

/*** VR link 추가 - 22.05.24 ******/
$vr_link = replace_in($vr_link);	

$dir_dest = "../.." . $file_path;	//파일 저장 폴더 지정
$dir_dest2 = "../.." . $file_path2;	//파일 저장 폴더 지정

/*****************************************************************/
//등록
/*****************************************************************/
if($typ=="write"){

	/** 파일 업로드 ******************************************/
	for($i = 1; $i <= 16; $i++) {
		$query_name = "file".$i;	//input 파라메터 이름
		if($_FILES[$query_name]) {
			$FILE_1 = RequestFile("file".$i);
			$FILE_1_size = $FILE_1[size];
			$FILE_1_name = $FILE_1[name];
			$FILE_1_type = $FILE_1[type];
			$maxSize = '5242880'; //5mb, 파일 용량 제한
			${"filename" . $i} = uploadProc($query_name, $dir_dest, $maxSize, $i,$mode);
			${"filename_real" . $i} = $FILE_1_name;

			if($FILE_1_type=="image/pjpeg" || $FILE_1_type=="image/x-png" || $FILE_1_type=="image/jpeg" || $FILE_1_type=="image/png" || $FILE_1_type=="image/gif"){
               if(${"filename".$i}){
                    $file_info      = getimagesize($_FILES[$query_name]['tmp_name']);
                    $file_width     = $file_info[0]; //이미지 가로 사이즈
                    $file_height    = $file_info[1]; //이미지 세로 사이즈

					if($file_width > 1440){
						$thumb_width = 1440;
						$thumb_height = 1080;
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

	$sql = "INSERT INTO branch_info SET 
			bh_name = '$bh_name'
			,hous_type = '$hous_type'
			,bh_post = '$bh_post'
			,bh_addr1 = '$bh_addr1'
			,bh_addr2 = '$bh_addr2'
			,lat = '$lat'
			,lon = '$lon'
			,bh_floor = '$bh_floor'
			,bh_ginfo ='$bh_ginfo'
			,bh_total_area = '$bh_total_area'
			,parking_yn = '$parking_yn'
			,main_cost = $main_cost
			,etc_option = '$etc_option'
			,content = '$content'
			,trans_info = '$trans_info'
			,vr_link = '$vr_link'
			,view_yn = '$view_yn'
			,file1 = '$filename1'
			,file2 = '$filename2'
			,file3 = '$filename3'
			,file4 = '$filename4'
			,file5 = '$filename5'
			,file6 = '$filename6'
			,file7 = '$filename7'
			,file8 = '$filename8'
			,file9 = '$filename9'
			,file10 = '$filename10'
			,file11 = '$filename11'
			,file12 = '$filename12'
			,file13 = '$filename13'
			,file14 = '$filename14'
			,file15 = '$filename15'
			,file16 = '$filename16'
			,file_real1 = '$filename_real1'
			,file_real2 = '$filename_real2'
			,file_real3 = '$filename_real3'
			,file_real4 = '$filename_real4'
			,file_real5 = '$filename_real5'
			,file_real6 = '$filename_real6'
			,file_real7 = '$filename_real7'
			,file_real8 = '$filename_real8'
			,file_real9 = '$filename_real9'
			,file_real10 = '$filename_real10'
			,file_real11 = '$filename_real11'
			,file_real12 = '$filename_real12'
			,file_real13 = '$filename_real13'
			,file_real14 = '$filename_real14'
			,file_real15 = '$filename_real15'
			,file_real16 = '$filename_real16'
			,reg_id = '".$_SESSION["ADMIN_ID"]."'
			,reg_ip = '$log_ip'
			,reg_date = '$log_date'
	";
	//echo $sql;
	$result = mysqli_query($conn, $sql) or die ("SQL Error : ". mysqli_error($conn));
	$ins_idx=mysqli_insert_id($conn);
	if($result){
		Page_Msg_Url("등록되었습니다.", "branch_list.php?mode=$mode");
	}
}

/*****************************************************************/
//수정
/*****************************************************************/
if($typ=="edit"){

	/** 파일 업로드 ******************************************/
	for ($i = 1; $i <= 16; $i++) {
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

						if($file_width > 1440){
							$thumb_width = 1440;
							$thumb_height = 1080;
						}else{
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


	$sql = "UPDATE branch_info SET 
				bh_name = '$bh_name'
				,hous_type = '$hous_type'
				,bh_post = '$bh_post'
				,bh_addr1 = '$bh_addr1'
				,bh_addr2 = '$bh_addr2'
				,lat = '$lat'
				,lon = '$lon'
				,bh_floor = '$bh_floor'
				,bh_ginfo ='$bh_ginfo'
				,bh_total_area = '$bh_total_area'
				,parking_yn = '$parking_yn'
				,main_cost = $main_cost
				,etc_option = '$etc_option'
				,content = '$content'
				,trans_info = '$trans_info'
				,vr_link = '$vr_link'
				,view_yn = '$view_yn'
				,file1 = '$filename1'
				,file2 = '$filename2'
				,file3 = '$filename3'
				,file4 = '$filename4'
				,file5 = '$filename5'
				,file6 = '$filename6'
				,file7 = '$filename7'
				,file8 = '$filename8'
				,file9 = '$filename9'
				,file10 = '$filename10'
				,file11 = '$filename11'
				,file12 = '$filename12'
				,file13 = '$filename13'
				,file14 = '$filename14'
				,file15 = '$filename15'
				,file16 = '$filename16'
				,file_real1 = '$filename_real1'
				,file_real2 = '$filename_real2'
				,file_real3 = '$filename_real3'
				,file_real4 = '$filename_real4'
				,file_real5 = '$filename_real5'
				,file_real6 = '$filename_real6'
				,file_real7 = '$filename_real7'
				,file_real8 = '$filename_real8'
				,file_real9 = '$filename_real9'
				,file_real10 = '$filename_real10'
				,file_real11 = '$filename_real11'
				,file_real12 = '$filename_real12'
				,file_real13 = '$filename_real13'
				,file_real14 = '$filename_real14'
				,file_real15 = '$filename_real15'
				,file_real16 = '$filename_real16'
				,mod_id = '".$_SESSION["ADMIN_ID"]."'
				,mod_ip = '$log_ip'
				,mod_date = '$log_date'
			WHERE idx = $idx 
	";
	$result = mysqli_query($conn, $sql) or die ("SQL Error : ". mysqli_error($conn));
	if($result) Page_Msg_Url("수정되었습니다.", "branch_write.php?$param&idx=$idx");
}


/*****************************************************************/
//삭제
/*****************************************************************/
if($typ == "del") {
	$result = QRY_VIEW("branch_info", " AND idx = '$idx'");
	$row = mysqli_fetch_array($result);
	/*$file1 = $row["file1"];
	$file2 = $row["file2"];
	$file3 = $row["file3"];
	$file4 = $row["file4"];
	$file5 = $row["file5"];
	if($file1) { unlink("$DOCUMENT_ROOT/$file_path/$file1"); unlink("$DOCUMENT_ROOT/$file_path2/$file1"); }
	if($file2) { unlink("$DOCUMENT_ROOT/$file_path/$file2"); unlink("$DOCUMENT_ROOT/$file_path2/$file2"); }
	if($file3) { unlink("$DOCUMENT_ROOT/$file_path/$file3"); unlink("$DOCUMENT_ROOT/$file_path2/$file3"); }
	if($file4) { unlink("$DOCUMENT_ROOT/$file_path/$file4"); unlink("$DOCUMENT_ROOT/$file_path2/$file4"); }
	if($file5) { unlink("$DOCUMENT_ROOT/$file_path/$file5"); unlink("$DOCUMENT_ROOT/$file_path2/$file5"); }*/

	for($ii=1;$ii<16;$ii++){
		${"file".$ii} = replace_out($row["file".$ii]);
		if(${"file".$ii}) { unlink($dir_dest.${"file".$ii}); unlink($dir_dest2.${"file".$ii}); }
	}

	$sql = "DELETE FROM branch_info WHERE idx = '$idx'";
	$result = mysqli_query($conn, $sql) or die ("SQL Error : ". mysqli_error($conn));
	if($result) Page_Msg_Url("삭제되었습니다.", "branch_list.php?mode=$mode");
}

?>