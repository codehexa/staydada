<?php
//이메일 history
$mail_content = replace_in($mail_content);
$sql2 = "INSERT INTO email_history SET
		 code_name =  '$code_name'
		,mem_idx=$real_mem_idx
		,board_idx = $board_idx
		,to_email='$tomail'	
		,to_name='$real_mem_name'
		,from_email='$frommail'
		,from_name='$sitename'				
		,send_date='$log_date'
		,reg_date =  '$log_date'
		,reg_ip =  '$log_ip'	
		,title =  '$mail_title'			
		,send_msg='$mail_content'
		,rand_code = '$randString'
		,chk_yn = 'N'
	";
//echo "mail==>".$sql2."<br>";
$result2 = mysqli_query($conn,$sql2) or die ("SQL Error : ". mysqli_error($conn));
//end 
?>