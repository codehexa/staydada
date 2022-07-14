<?php 
include $_SERVER["DOCUMENT_ROOT"] . "/include/dbopen.php"; 

/****************************************************************/
//지점 호실리스트 (/apply/stay_select.php 사용)
/****************************************************************/

if($b_idx){
	$searchand = " AND view_yn='Y' AND bh_idx = $b_idx ";
	$result = QRY_LIST("room_info", "all", 1, $searchand, " room_number ");

	while($row_room = mysqli_fetch_array($result)){
		$room_idx		= replace_out($row_room["idx"]);
		$room_number	= replace_out($row_room["room_number"]);	//호실
		$s_area			= replace_out($row_room["s_area"]);			//공급면적
		$d_area			= replace_out($row_room["d_area"]);			//전용면적
		$rental			= replace_out($row_room["rental"]);			//월임대료
		$contract_state	= replace_out($row_room["contract_state"]);	//계약상태 
		$contract_txt = get_want("com_code", "code_name", "AND idx = $contract_state");
		if($contract_txt=="계약완료") : $txt_cont_state = "<span class=\"floatright red mr0\">계약완료</span>";
		else : $txt_cont_state = "<span class=\"floatright blue mr0\">입주가능</span>";
		endif;
?>
		<li id="room_<?php echo $room_idx ?>" data-rnum="<?php echo $room_number ?>"><a href="javascript:fnSelRoom(<?php echo $room_idx ?>);"><span><?php echo $room_number ?>호</span><?php echo $txt_cont_state ?><br/>(<?php echo $s_area ?>㎡/<?php echo $d_area ?>㎡)</a></li>
<?php
	}

}

?>