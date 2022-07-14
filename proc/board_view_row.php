<?php
/*********************************************************/
//게시판 상세 내용- 공통사용
/*********************************************************/

if ($idx) {
    $tbl = "board";

    //조회수업데이트처리 
    if(!$vcmt){
        $sql_hit = "UPDATE $tbl SET hit = hit + 1 WHERE idx = $idx";
        $result_hit = mysqli_query($conn, $sql_hit) or die ("SQL ERROR : " . mysqli_error());

    }
    $result = QRY_VIEW($tbl, " AND idx = '$idx'");
    $row = mysqli_fetch_array($result);

    $cate           = replace_out($row["cate"]);
    $code_name      = get_want("com_code", "code_name", " AND idx = $cate ");
    $mem_idx        = replace_out($row["mem_idx"]);
    $mem_id         = replace_out($row["mem_id"]);
    $mem_name       = get_want("member", "mem_name", " AND mem_idx = $mem_idx");
    $mem_nickname   = get_want("member", "mem_nickname", " AND mem_idx = $mem_idx");
    $mem_hp         = get_want("member", "mem_hp", " AND mem_idx = $mem_idx");
    $langcode       = replace_out($row["langcode"]);
    $name           = replace_out($row["name"]);
    $pwd            = replace_out($row["pwd"]);
    $title          = replace_out($row["title"]);
    $content        = replace_out($row["content"]);
    $re_title       = replace_out($row["re_title"]);
    $re_content     = replace_out($row["re_content"]);
    $hp             = replace_out($row["hp"]);
	$email			= replace_out($row["email"]);
    $email1         = replace_out($row["email1"]);
    $email2         = replace_out($row["email2"]);
    $startdate      = replace_out($row["startdate"]);
    $enddate        = replace_out($row["enddate"]);
    $notice         = replace_out($row["notice"]);
    $secret         = replace_out($row["secret"]);
    $admin          = replace_out($row["admin"]);
    $hit            = replace_out($row["hit"]);
    $view_yn        = replace_out($row["view_yn"]);
	$state			= replace_out($row["state"]);
    //$comment_cnt = QRY_CNT("comment"," AND gubun='COMMUNITY' AND view_yn='Y' AND gubun_idx=$idx");  //댓글수
    $sort           = replace_out($row["sort"]);
    $etc1           = replace_out($row["etc1"]);
    $etc2           = replace_out($row["etc2"]);
    $etc3           = replace_out($row["etc3"]);
    $etc4           = replace_out($row["etc4"]);
    $etc5           = replace_out($row["etc5"]);
    $view_date      = replace_out($row["view_date"]);
//  $log_date = substr(replace_out($row["reg_date"]), 0, 10);
    $reg_date       = substr(replace_out($row["reg_date"]), 0, 10);
    $reg_date       = str_replace("-", ".",$reg_date);
    $ref            = replace_out($row["ref"]);
    $lev            = replace_out($row["lev"]);
    $step           = replace_out($row["step"]);
    $file1          = replace_out($row["file1"]);
    $file2          = replace_out($row["file2"]);
    $file3          = replace_out($row["file3"]);
    $file4          = replace_out($row["file4"]);
    $file5          = replace_out($row["file5"]);
    $file_real1     = replace_out($row["file_real1"]);
    $file_real2     = replace_out($row["file_real2"]);
    $file_real3     = replace_out($row["file_real3"]);
    $file_real4     = replace_out($row["file_real4"]);
    $file_real5     = replace_out($row["file_real5"]);

    $typ = "edit";
    $btn_txt = "수정";
} else {
    $typ = "write";
    $btn_txt = "등록";

    $view_date = date("Y-m-d");
}
?>