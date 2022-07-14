<?php
/*********************************************************/
//호실 상세 내용
/*********************************************************/

if ($idx) {
    $tbl = "room_info";

    $result = QRY_VIEW($tbl, " AND idx = '$idx'");
    $row = mysqli_fetch_array($result);

	$bh_idx		= replace_out($row["bh_idx"]);	//지점일련번호
	$bh_name	= get_want("branch_info","bh_name","AND idx = $bh_idx");	//지점명
	$room_state	= replace_out($row["room_state"]);	//객실상태
	$room_state_txt = get_want("com_code", "code_name", "AND idx = $room_state");
	/*** 22.05.24 추가 ***/
	$contract_state = replace_out($row["contract_state"]); //계약상태 
	$contract_state_txt = get_want("com_code", "code_name", "AND idx = $contract_state");
	$real_area = replace_out($row["real_area"]); //실평수  
	$contract_period = replace_out($row["contract_period"]); //최소계약기간
	/*** 22.05.24 추가 END ***/

	$room_floor	= replace_out($row["room_floor"]); //층
	$room_number	= replace_out($row["room_number"]);	//호실
	$s_area		= replace_out($row["s_area"]);	//공급면적
	$d_area		= replace_out($row["d_area"]);	//전용면적
	$room_type	= replace_out($row["room_type"]);	//룸타입
	$room_type_txt = get_want("com_code", "code_name", "AND idx = $room_type");
	$way	= replace_out($row["way"]);	//방향
	$way_txt = get_want("com_code", "code_name", "AND idx = $way");

	for($jj=1;$jj<19;$jj++){
		${"room_option_".$jj} = replace_out($row["room_option_".$jj]);
	}

	$room_option_17_txt	= replace_out($row["room_option_17_txt"]);	//주차장 유료금액
	$deposit	= replace_out($row["deposit"]);		//보증금
	$rental		= replace_out($row["rental"]);		//월임대료
	$room_cost	= replace_out($row["room_cost"]);	//관리비
	$in_desc	= replace_out($row["in_desc"]);		//관리비포함내역
	$not_desc	= replace_out($row["not_desc"]);	//관리비미포함(개별납부)
	$view_yn	= replace_out($row["view_yn"]);		//게시여부 

    $reg_date       = substr(replace_out($row["reg_date"]), 0, 10);
    $reg_date       = str_replace("-", ".",$reg_date);
    $ref            = replace_out($row["ref"]);
    $lev            = replace_out($row["lev"]);
    $step           = replace_out($row["step"]);

	/***********************************************************/
	//첨부사진(5->16개로추가) 22.05.31
	/***********************************************************/
	for($ii=1;$ii<16;$ii++){
		${"file".$ii} = replace_out($row["file".$ii]);
		${"file_real".$ii} = replace_out($row["file_real".$ii]);
	}
	/***********************************************************/   
	/*$file1          = replace_out($row["file1"]);
    $file2          = replace_out($row["file2"]);
    $file3          = replace_out($row["file3"]);
    $file4          = replace_out($row["file4"]);
    $file5          = replace_out($row["file5"]);
    $file_real1     = replace_out($row["file_real1"]);
    $file_real2     = replace_out($row["file_real2"]);
    $file_real3     = replace_out($row["file_real3"]);
    $file_real4     = replace_out($row["file_real4"]);
    $file_real5     = replace_out($row["file_real5"]);*/


    $typ = "edit";
    $btn_txt = "수정";
} else {
    $typ = "write";
    $btn_txt = "등록";


}
?>