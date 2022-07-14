<?
$dmi = "https://".$_SERVER['HTTP_HOST'];
$mail_content = "
<meta charset='utf-8'>
<table style='width:100%;background:#f8f8f9;margin:0;padding:0'>
	<tr><td>

<table width='600' border='0' cellpadding='0' cellspacing='0' style='margin:0 auto;background:#fff; '> 
  <tr>
    <td align='center' style='font-size:17px;padding:10px 15px 10px 15px;'><h3><a href='$dmi/'>스테이다다</a></h3></td>
  </tr>
  <tr> 
    <td style='color:#666666;font-size:14px;padding:10px 15px 10px;line-height:24px;letter-spacing:-0.5px'>
     안녕하세요, [$user_name]님 문의하신 입주상담문의 답변입니다.</td>
  </tr>
	<tr>
		<td style='padding:15px:text-align:left;'>
			<table style='color:#999;border-top:2px solid #424240;border-bottom:1px solid #e5e5e5;width:100%'>
				<tr>
					<td style='padding:10px;font-size:15px;background:#eee;color:#333;text-align:center;'>문의내용</td>
				</tr>
				<tr>
					<td style='padding:30px;font-size:15px;'>$consult_content</td>
				</tr>
				<tr>
					<td style='padding:10px;font-size:15px;background:#eee;color:#333;text-align:center;'>답변내용</td>
				</tr>
				<tr>
					<td style='padding:30px;font-size:15px;'>
						<strong style='color:#171c61;font-size:15px;font-weight:bold'>$consult_re_content</strong>
					</td>
				</tr>
			</table>
		</td>
	</tr>

  <tr>
    <td style='margin:20px auto 20px;text-align:center;width:230px;background:#171c61;'><a href='$dmi/' style='font-size:14px;color:#fff;text-decoration:none'><span style='line-height:50px;'>스테이다다</span></a></td>
  </tr>
</table>

</td>
</tr>

</table>

";
//echo $mail_content;
?>