<?php
include $_SERVER["DOCUMENT_ROOT"]."/include/class.upload.php";

// $query_name : input 이름
// $folder : 저장 폴더

function uploadProc( $query_name, $dir_dest, $maxSize, $fnum, $ftail_part) {
	$arr_finfo = $_FILES[$query_name];
	$handle = new Upload($_FILES[$query_name]);

	if ($handle->uploaded) {
		$handle->file_max_size = $maxSize;
		$handle->file_name_body_pre      = date("YmdHis")."_".$ftail_part.$fnum;
		if(strtolower($arr_finfo["type"])=="image/jpeg"){
			$handle->file_new_name_ext = "jpg";
		}
		$advicesize = $maxSize/52428800;		//50mb바이트
		if ($handle->file_src_size > $handle->file_max_size ) {
			die(popupMsgBack("( $advicesize MB )이상 파일업로드를 금지합니다."));
			exit;
		}

		$handle->Process($dir_dest);

		if ( $handle->file_dst_name == null ) {
			die(popupMsg("Required Parameter Missing. An error occured."));
			return false;
		}

		if ($handle->processed) {
			return $handle->file_dst_name;
		} else {
			popupMsg($handle->error);
			return false;
		}

		$handle-> Clean();

	} else {
		//popupMsg($handle->error);
		return false;
	}
}

include $_SERVER["DOCUMENT_ROOT"]."/include/thumbnail.lib.php";
?>