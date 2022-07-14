<?php
include $_SERVER["DOCUMENT_ROOT"] . "/include/dbopen.php";
include $_SERVER["DOCUMENT_ROOT"] . "/zbackoffice/include/admin.php";
include $_SERVER["DOCUMENT_ROOT"] . "/include/fileuploader.php";
include $_SERVER["DOCUMENT_ROOT"] . "/PHPMailer/PHPMailerAutoload.php";

/***********************************************************/
//호실 등록,수정,삭제관련 처리 
/***********************************************************/

error_reporting(E_ALL);
ini_set('display_errors', '0');

/*echo "<pre>";
print_r($_REQUEST);
print_r($_FILES);
echo "</pre>";
exit;*/

$bh_idx			= replace_in($bh_idx);		//지점명 (branch_info.idx)
$room_state		= replace_in($room_state);	//객실상태
$view_yn		= replace_in($view_yn);		//게시여부
$room_floor		= replace_in($room_floor);	//층
$room_number	= replace_in($room_number);	//호실
$s_area			= replace_in($s_area);		//공급면적
$d_area			= replace_in($d_area);		//전용면적
$room_type		= replace_in($room_type);	//룸타입
$way			= replace_in($way);	//향

$room_option_17_txt	= replace_in($room_option_17_txt);	//주차장 유료금액

if($room_option_17 != "P") $room_option_17_txt = "";

$deposit	= replace_in($deposit);		//보증금
$rental		= replace_in($rental);		//월임대료
$room_cost	= replace_in($room_cost);	//관리비
$in_desc	= replace_in($in_desc);		//관리비 포함내역
$not_desc	= replace_in($not_desc);	//관리비 미포함(개별납부)

/**** 22.05.24 추가 ****************************************/
$contract_state = replace_in($contract_state);	//계약상태
$real_area		= replace_in($real_area);	//실평수 
$contract_period = replace_in($contract_period); //최소계약기간 
/*************************************************************/

//if(!$s_area) $s_area = 0;
//if(!$d_area) $d_area = 0;

$dir_dest = "../.." . $file_path;	//파일 저장 폴더 지정
$dir_dest2 = "../.." . $file_path2;	//파일 저장 폴더 지정

if($typ=="write"){

	/** 파일 업로드 ******************************************/
	for($i = 1; $i <= 16; $i++) {
		$query_name = "file".$i;	//input 파라메터 이름
		if($_FILES[$query_name]) {
			$FILE_1 = RequestFile("file".$i);
			$FILE_1_size = $FILE_1["size"];
			$FILE_1_name = $FILE_1["name"];
			$FILE_1_type = $FILE_1["type"];
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


	$sql = "INSERT INTO room_info SET 
			bh_idx = '$bh_idx'
			,room_state = '$room_state'
			,room_floor = '$room_floor'
			,room_number = '$room_number'
			,s_area = '$s_area'
			,d_area = '$d_area'
			,contract_state = $contract_state
			,contract_period = $contract_period
			,real_area = '$real_area'
			,room_type = '$room_type'
			,way = '$way'
			,room_option_1 = '$room_option_1'
			,room_option_2 = '$room_option_2'
			,room_option_3 = '$room_option_3'
			,room_option_4 = '$room_option_4'
			,room_option_5 = '$room_option_5'
			,room_option_6 = '$room_option_6'
			,room_option_7 = '$room_option_7'
			,room_option_8 = '$room_option_8'
			,room_option_9 = '$room_option_9'
			,room_option_10 = '$room_option_10'
			,room_option_11 = '$room_option_11'
			,room_option_12 = '$room_option_12'
			,room_option_13 = '$room_option_13'
			,room_option_14 = '$room_option_14'
			,room_option_15 = '$room_option_15'
			,room_option_16 = '$room_option_16'
			,room_option_17 = '$room_option_17'
			,room_option_17_txt = '$room_option_17_txt'
			,room_option_18 = '$room_option_18'
			,deposit = $deposit
			,rental = $rental
			,room_cost = $room_cost
			,in_desc = '$in_desc'
			,not_desc = '$not_desc'
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
	//$ins_idx=mysqli_insert_id($conn);
	if($result){
		Page_Msg_Url("등록되었습니다.", "room_list.php?mode=$mode");
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

	$sql = "UPDATE room_info SET 
				bh_idx = '$bh_idx'
				,room_state = '$room_state'
				,room_floor = '$room_floor'
				,room_number = '$room_number'
				,s_area = '$s_area'
				,d_area = '$d_area'
				,contract_state = $contract_state
				,contract_period = $contract_period
				,real_area = '$real_area'
				,room_type = '$room_type'
				,way = '$way'
				,room_option_1 = '$room_option_1'
				,room_option_2 = '$room_option_2'
				,room_option_3 = '$room_option_3'
				,room_option_4 = '$room_option_4'
				,room_option_5 = '$room_option_5'
				,room_option_6 = '$room_option_6'
				,room_option_7 = '$room_option_7'
				,room_option_8 = '$room_option_8'
				,room_option_9 = '$room_option_9'
				,room_option_10 = '$room_option_10'
				,room_option_11 = '$room_option_11'
				,room_option_12 = '$room_option_12'
				,room_option_13 = '$room_option_13'
				,room_option_14 = '$room_option_14'
				,room_option_15 = '$room_option_15'
				,room_option_16 = '$room_option_16'
				,room_option_17 = '$room_option_17'
				,room_option_17_txt = '$room_option_17_txt'
				,room_option_18 = '$room_option_18'
				,deposit = $deposit
				,rental = $rental
				,room_cost = $room_cost
				,in_desc = '$in_desc'
				,not_desc = '$not_desc'
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
	//echo $sql;

	$result = mysqli_query($conn, $sql) or die ("SQL Error : ". mysqli_error($conn));
	if($result) Page_Msg_Url("수정되었습니다.", "room_write.php?$param&idx=$idx");
}


/*****************************************************************/
//삭제
/*****************************************************************/
if($typ == "del") {
	$result = QRY_VIEW("room_info", " AND idx = '$idx'");
	$row = mysqli_fetch_array($result);
	for($ii=1;$ii<16;$ii++){
		${"file".$ii} = replace_out($row["file".$ii]);
		if(${"file".$ii}) { unlink($dir_dest.${"file".$ii}); unlink($dir_dest2.${"file".$ii}); }
	}

	$sql = "DELETE FROM room_info WHERE idx = '$idx'";
	$result = mysqli_query($conn, $sql) or die ("SQL Error : ". mysqli_error($conn));
	if($result) Page_Msg_Url("삭제되었습니다.", "room_list.php?mode=$mode");
}


/*****************************************************************/
//호실복사 추가 - 22.05.31
/*****************************************************************/
if($typ=="copy_room"){

	if($idx){
		include  $_SERVER["DOCUMENT_ROOT"]."/proc/room_info_view_row.php";

		for($ii=1;$ii<17;$ii++){

			if(${"file".$ii} && ${"file_real".$ii}){
				$file_info = pathinfo($dir_dest.${"file".$ii}); //업로드파일명
				$file_real_info = pathinfo($dir_dest2.${"file_real".$ii}); //원본파일명(실제파일x)

				${"file_o".$ii}=$file_info["filename"].".".$file_info["extension"]; //업로드파일명

				${"filename".$ii} = $file_info["filename"]."-re.".$file_info["extension"]; //copy파일명
				${"filename_real".$ii} = ${"file_real".$ii};
				
				/*echo "<br/>==================================<pre>";
				print_r($file_info);
				print_r($file_real_info);
				echo "====================================</pre>";*/
				copy($dir_dest.${"file_o".$ii}, $dir_dest.${"filename".$ii}); //업로드파일 copy
				copy($dir_dest2.${"file_o".$ii}, $dir_dest2.${"filename".$ii}); //썸네일파일copy
			}
		}

		$room_floor = $room_floor."-복사";
		$sql = " INSERT INTO room_info SET 
			bh_idx = '$bh_idx'
			,room_state = '$room_state'
			,room_floor = '$room_floor'
			,room_number = '$room_number'
			,s_area = '$s_area'
			,d_area = '$d_area'
			,contract_state = $contract_state
			,contract_period = $contract_period
			,real_area = '$real_area'
			,room_type = '$room_type'
			,way = '$way'
			,room_option_1 = '$room_option_1'
			,room_option_2 = '$room_option_2'
			,room_option_3 = '$room_option_3'
			,room_option_4 = '$room_option_4'
			,room_option_5 = '$room_option_5'
			,room_option_6 = '$room_option_6'
			,room_option_7 = '$room_option_7'
			,room_option_8 = '$room_option_8'
			,room_option_9 = '$room_option_9'
			,room_option_10 = '$room_option_10'
			,room_option_11 = '$room_option_11'
			,room_option_12 = '$room_option_12'
			,room_option_13 = '$room_option_13'
			,room_option_14 = '$room_option_14'
			,room_option_15 = '$room_option_15'
			,room_option_16 = '$room_option_16'
			,room_option_17 = '$room_option_17'
			,room_option_17_txt = '$room_option_17_txt'
			,room_option_18 = '$room_option_18'
			,deposit = $deposit
			,rental = $rental
			,room_cost = $room_cost
			,in_desc = '$in_desc'
			,not_desc = '$not_desc'
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
		//echo $sql."<br/>";
		$result = mysqli_query($conn, $sql) or die ("SQL Error : ". mysqli_error($conn));
		$ins_idx=mysqli_insert_id($conn);

		//echo "ins_idx=>".$ins_idx."<br/>";

		$rst["success"] = "OK";
		$rst["room_idx"] = $ins_idx;
		echo json_encode($rst,JSON_UNESCAPED_UNICODE);
		exit;

	}else{
		$rst["success"] = "NO";
		echo json_encode($rst,JSON_UNESCAPED_UNICODE);
		exit;
	}
}
?>