<?php
include $_SERVER["DOCUMENT_ROOT"] . "/include/dbopen.php"; 

/*****************************************************************/
//호실 상세정보(modal창에 정보 보여주기...)
/*****************************************************************/

if($room_idx){
	//echo "idx==>".$idx;
	$room_arr = [];
	
    $result = QRY_VIEW("room_info", " AND idx = '$room_idx'");
    $row_room = mysqli_fetch_array($result);

	$bh_idx = replace_out($row_room["bh_idx"]);
	$bh_name = get_want("branch_info", "bh_name", " AND idx = $bh_idx ");
	$room_state = replace_out($row_room["room_state"]);
	$room_state_txt = $room_state == "C"? "수리완료":"수리중";
	$room_type	= replace_out($row_room["room_type"]);	//룸타입
	$room_type_txt = get_want("com_code", "code_name", "AND idx = $room_type");
	$way	= replace_out($row_room["way"]);	//방향
	$way_txt = get_want("com_code", "code_name", "AND idx = $way");


	$deposit	= replace_out($row_room["deposit"]);		//보증금
	$rental		= replace_out($row_room["rental"]);		//월임대료
	$room_cost	= replace_out($row_room["room_cost"]);	//관리비


	$room_arr["bh_name"] = $bh_name;
	$room_arr["room_state"] = $room_state;	//객실상태
	$room_arr["room_state_txt"] = $room_state_txt;
	$room_arr["room_floor"] = replace_out($row_room["room_floor"]); //층
	$room_arr["room_number"] = replace_out($row_room["room_number"]);	//호실
	$room_arr["s_area"] = replace_out($row_room["s_area"]);	//공급면적
	$room_arr["d_area"] = replace_out($row_room["d_area"]);	//전용면적
	$room_arr["num_people"] = replace_out($row_room["num_people"]); //기준인원
	$room_arr["room_type"] = $room_type;	//룸타입
	$room_arr["room_type_txt"] = $room_type_txt;
	$room_arr["way"] = $way;
	$room_arr["way_txt"] = $way_txt;

	for($jj=1;$jj<19;$jj++){
		${"room_option_".$jj} = replace_out($row_room["room_option_".$jj]);
		$room_arr["room_option_".$jj] = ${"room_option_".$jj};
	}

	$room_arr["room_option_17_txt"] = replace_out($row_room["room_option_17_txt"]);	//주차장 유료금액
	$room_arr["deposit"] = number_format($deposit,0);
	$room_arr["rental"] = number_format($rental,0);
	$room_arr["room_cost"] = number_format($room_cost,0);
	$room_arr["in_desc"] = replace_out($row_room["in_desc"]);		//관리비포함내역
	$room_arr["not_desc"] = replace_out($row_room["not_desc"]);	//관리비미포함(개별납부)

	/***********************************************************/
	//첨부사진(5->16개로추가) 22.05.31
	/***********************************************************/
	for($ii=1;$ii<16;$ii++){
		${"file".$ii} = replace_out($row_room["file".$ii]);
		${"file_real".$ii} = replace_out($row_room["file_real".$ii]);

		$room_arr["file".$ii] = ${"file".$ii};
		$room_arr["file_real".$ii] = ${"file_real".$ii};
	}
	/***********************************************************/

	/*$room_arr["file1"] = replace_out($row_room["file1"]);
	$room_arr["file2"] = replace_out($row_room["file2"]);
	$room_arr["file3"] = replace_out($row_room["file3"]);
	$room_arr["file4"] = replace_out($row_room["file4"]);
	$room_arr["file5"] = replace_out($row_room["file5"]);*/
	
//print_r($arr_room_info);
//print_r($row_room);

	$rst["success"] = "OK";
	$rst["room_info"] = $room_arr;
	echo json_encode($rst);
	exit;
}else{
	$rst["success"] = "PARAM";
	echo json_encode($rst,JSON_UNESCAPED_UNICODE);
	exit;
}

?>