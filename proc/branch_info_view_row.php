<?php
/*********************************************************/
//지점정보 상세 내용
/*********************************************************/

if ($idx) {
    $tbl = "branch_info";

    $result = QRY_VIEW($tbl, " AND idx = '$idx'");
    $row = mysqli_fetch_array($result);

	$bh_name	= replace_out($row["bh_name"]);	//지점명
	$hous_type	= replace_out($row["hous_type"]);	//주택유형
	$hous_type_txt = get_want("com_code", "code_name", "AND idx = $hous_type");
	$bh_post	= replace_out($row["bh_post"]); //우편번호
	$bh_addr1	= replace_out($row["bh_addr1"]);	//지번주소
	$bh_addr2	= replace_out($row["bh_addr2"]);	//도로명주소
	$lat		= $row["lat"];	//y
	$lon		= $row["lon"];	//x
	$bh_floor	= replace_out($row["bh_floor"]); //층
	$bh_ginfo	= replace_out($row["bh_ginfo"]);	//세대정보
	$bh_total_area	= replace_out($row["bh_total_area"]);	//연면적
	$parking_yn	= replace_out($row["parking_yn"]);	//주차가능여부
	$parking_yn_txt = ($parking_yn=="Y"?"가능":"불가능");
	$main_cost	= replace_out($row["main_cost"]);	//관리비
	$view_yn	= replace_out($row["view_yn"]);
	$view_yn_txt = ($view_yn=="Y"?"게시":"미게시");
	$etc_option	= replace_out($row["etc_option"]);	//기타옵션
	$content	= replace_out($row["content"]);	//지점설명
	$trans_info	= replace_out($row["trans_info"]); //주변대중교통정보 
	$vr_link = replace_out($row["vr_link"]); // vr(3D)링크 추가 - 22.05.24

    $reg_date   = substr(replace_out($row["reg_date"]), 0, 10);
    $reg_date   = str_replace("-", ".",$reg_date);
    $ref        = replace_out($row["ref"]);
    $lev        = replace_out($row["lev"]);
    $step       = replace_out($row["step"]);

	/***********************************************************/
	//첨부사진(5->16개로추가) 22.05.31
	/***********************************************************/
	for($ii=1;$ii<16;$ii++){
		${"file".$ii} = replace_out($row["file".$ii]);
		${"file_real".$ii} = replace_out($row["file_real".$ii]);
	}
	/***********************************************************/
    /*$file1      = replace_out($row["file1"]); //썸네일사용
    $file2      = replace_out($row["file2"]);
    $file3      = replace_out($row["file3"]);
    $file4      = replace_out($row["file4"]);
    $file5      = replace_out($row["file5"]);
    $file_real1 = replace_out($row["file_real1"]);
    $file_real2 = replace_out($row["file_real2"]);
    $file_real3 = replace_out($row["file_real3"]);
    $file_real4 = replace_out($row["file_real4"]);
    $file_real5 = replace_out($row["file_real5"]);*/

    $typ = "edit";
    $btn_txt = "수정";
} else {
    $typ = "write";
    $btn_txt = "등록";


}
?>