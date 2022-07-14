<div class="layer-bg"></div>
<div class="footer-con">Copyrights <?=$sitename?> All rights Reserved.</div>
<iframe name="proc" id="proc" src="" width="0" height="0" title="" frameborder="0"></iframe>
<iframe name="imgdelifr" id="imgdelifr" src="" width="500" height="0" frameborder="0" title="이미지 삭제 프로시져 프레임"></iframe>

<script type="text/javascript">
<!--
function img_del(id, file, num) {
	if (confirm("파일을 삭제하시겠습니까?")) {
		document.f.temp_file.value = file;
		document.f.target = "imgdelifr";
		document.f.action ="/include/filedelete1.php?<?=$param?>&file_idx=" + id + "&num=" + num;
		document.f.submit();
	}
}

function img_delete(table, idx, num, id) {
	if(confirm("해당 파일을 삭제하시겠습니까?")) {
		$.ajax({
			type : "post",
			url : "/include/filedelete_ajax.php",
			dataType : "text",
			timeout : 86400,
			cache : false,
			data: { "table" : table, "idx" : idx, "num" : num, "id" : id },
			success : function(result) {
				//console.log(result);
				$("#prev_img_"+id).remove();
				$("#file_o"+id).val("");
				$("#file_o_real"+id).val("");
			},
			error : function(request, status, error) {
				alert("새로고침 후에 다시 삭제해 주십시오.");
				//console.log(pt_idx + " / code : " + request.status + " / message : " + request.responseText + " / error : " + error);
			},
		});
	}
}
//-->
</script>