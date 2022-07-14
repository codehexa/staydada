<?php
include $_SERVER["DOCUMENT_ROOT"]."/include/dbopen.php";
include $_SERVER["DOCUMENT_ROOT"]."/zbackoffice/include/admin.php";

$code_name = replace_in($code_name);
$sort = replace_in($sort);
//echo $typ;

if(!$sort) $sort = 99;

if($mode=="BR001") : $com_code="주택유형";
elseif($mode=="BR002") : $com_code="룸타입";
elseif($mode=="BR003") : $com_code="향";
elseif($mode=="BR004") : $com_code="계약상태";
elseif($mode=="BR005") : $com_code="객실상태";
endif;

if ($typ=="write"){ 

		/*$thereis=get_want("code","idx"," AND gubun ='$mode' AND com_code ='$com_code' AND code_name ='$code_name'");
		if($thereis){
			Page_Msg("이미 등록된 코드입니다");
			exit;
		}*/

        $sql="
            INSERT INTO com_code SET
                gubun ='$mode'
				,com_code = '$com_code'
                ,code_name ='$code_name'
                ,etc1 ='$etc1'
                ,etc2 ='$etc2'
                ,etc3 ='$etc3'
                ,etc4 ='$etc4'
                ,etc5 ='$etc5'
                ,sort ='$sort'
                ,useyn ='$useyn'
                ,regdate ='$log_date'
            ";

        $result = mysqli_query($conn,$sql) or die ("SQL Error : ". mysqli_error($conn));
        if($result){
            Page_Parent_Url("$write_url?mode=$mode");
        }
}
if ($typ == "edit"){    
    $sql="
        UPDATE
            com_code
        SET
            code_name ='$code_name'
			,com_code = '$com_code'
            ,etc1 ='$etc1'
            ,etc2 ='$etc2'
            ,etc3 ='$etc3'
            ,etc4 ='$etc4'
            ,etc5 ='$etc5'
            ,sort ='$sort'
            ,useyn ='$useyn'
            ,regdate ='$log_date'
        WHERE
            idx=$idx
    ";
    $result = mysqli_query($conn,$sql) or die ("SQL Error : ". mysqli_error($conn));
    if($result){
       // Page_Msg("수정되었습니다");
        Page_Parent_Url("$write_url?mode=$mode"); 
    }
}
if($typ=="del"){    
    $sql="DELETE FROM com_code WHERE idx='$idx'
        ";
    $result = mysqli_query($conn,$sql) or die ("SQL Error : ". mysqli_error($conn));
    if($result){
        //Page_Msg("삭제되었습니다");
        Page_Parent_Url("$write_url?mode=$mode");
    }
}

?>
