
<!--====================[ sw_edit 파일명: ed_seting_edit.php ]====================-->
<table width='100%' id='ed_toolbar' name='ed_toolbar' border='0' cellpadding='0' cellspacing='0'>
<tr>
<td>
<? if($sw_edit_yn == "Y") { ?>
	<table width='100%' border='0' cellpadding='3' cellspacing='0' class='sw_bd_style_5'>
	<tr>
		<td>
<?
if($setup['use_html'] > 0) {
	include("$dir/swe/ed_toolbar.php");
} else {
	include("$dir/swe/ed_toolbar_no_grant.php");
}
?>
		</td>
	</tr>
	</table>
<? } ?>
</td>
</tr>
</table>
<div id='edit_windowdiv' name='edit_windowdiv' style='width:100%;'>  
<table width='100%' height='100%' border='0' cellpadding='0' cellspacing='0' class='sw_bd_style_6' style='table-layout:fixed'>
<tr>
<td height='100%' align='center'>
	<iframe id='memoi' name='memoi' style='width:100%; height:100%; display:none;' onbeforedeactivate='deactivate_handler()' scrolling='yes' frameborder='no' border='0' ALLOWTRANSPARENCY='true'></iframe>
	<textarea id='memo' name='memo' style='width:100%; height:100%; display:block;' class='sw_bd_style_7' onkeydown='return doTab(event,this);' onkeyup="addStroke()"><?if($mode=="modify"||($mode=="reply"&&!$c_no)){ echo "$memo"; } ?></textarea>
</td>
</tr>
</table>
</div>
<SCRIPT language="JavaScript">
var textArea = document.getElementById("memo");
if(sw_edit_use == "write") {
	edit_windowdiv.style.height = "300px";
	if(typeof window.getSelection == "undefined") //FF가 아니면
		textArea.rows = "20";
} else {
	edit_windowdiv.style.height = "150px";
	if(typeof window.getSelection == "undefined") //FF가 아니면
		textArea.rows = "10";
	document.getElementById("ed_toolbar").style.display = "none";
}
</SCRIPT>
<!--====================[ sw_edit 파일명: ed_seting_edit.php 끝]====================-->
