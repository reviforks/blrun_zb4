<?
if(!preg_match("/Zeroboard/i",$a_list)) $a_list = str_replace(">","><font class=list_eng>",$a_list)."";
if(!preg_match("/Zeroboard/i",$a_reply)) $a_reply = str_replace(">","><font class=list_eng>",$a_reply)."";
if(!preg_match("/Zeroboard/i",$a_modify)) $a_modify = str_replace(">","><font class=list_eng>",$a_modify)."";
//if(!preg_match("/Zeroboard/i",$a_delete)) $a_delete = str_replace(">","><font class=list_eng>",$a_delete)."";
if(!preg_match("/Zeroboard/i",$a_write)) $a_write = str_replace(">","><font class=list_eng>",$a_write)."";
if(!preg_match("/Zeroboard/i",$a_vote)) $a_vote = str_replace(">","><font class=list_eng>",$a_vote)."";
if(!preg_match("/Zeroboard/i",$a_preview)) $a_preview = str_replace(">","><font class=list_eng>",$a_preview)."";
if(!preg_match("/Zeroboard/i",$a_imagebox)) $a_imagebox = str_replace(">","><font class=list_eng>",$a_imagebox)."";
if(!preg_match("/Zeroboard/i",$a_codebox))	$a_codebox = str_replace(">","><font class=list_eng>",$a_codebox)."";

if(!preg_match("/Zeroboard/i",$a_home)) $a_home = str_replace(">","><font class=list_eng>",$a_home)."&nbsp;&nbsp;";
if(!preg_match("/Zeroboard/i",$a_bitly)) $a_bitly = str_replace(">","><font class=list_eng>",$a_bitly)."&nbsp;&nbsp;";
if(!preg_match("/Zeroboard/i",$a_keyword)) $a_keyword = str_replace(">","><font class=list_eng>",$a_keyword)."&nbsp;&nbsp;";
if(!preg_match("/Zeroboard/i",$a_delete)) $a_delete=str_replace("delete.php?","$dir/delete.php?_zb_path=$config_dir&_zb_url=$zb_url&",$a_delete)."";
?>

<table border=0 cellspacing=0 cellpadding=0 height=1 width=<?=$width?> align=center>
<tr><td background=<?=$dir?>/dot.gif border=0 height=1></td></tr>
</table>

<table width=<?=$width?> cellspacing=0 cellpadding=0 align=center>
<col width=265></col><col width=170></col><col width=></col>
<tr>
 <td height=30>
	<?=$a_reply?><img src=<?=$dir?>/bt_reply.gif border=0></a>
	<?=$a_modify?><img src=<?=$dir?>/bt_modify.gif border=0></a>
	<?=$a_delete?><img src=<?=$dir?>/bt_del.gif border=0></a>
	<?=$a_vote?><img src=<?=$dir?>/bt_vote.gif border=0></a>
 </td>
 <td align=left>
	<table border=0>
		<tr><td>
		<? if($box_view) { echo $a_preview."�̸�����</a>"."&nbsp;&nbsp;".$a_imagebox."�׸�â��</a>"."&nbsp;&nbsp;".$a_codebox."�ڵ����</a>"; }?>
		</td></tr>
	</table>
 </td>
 <td align=right>
    <table border=0 cellpadding=0 cellspacing=0>
	<tr>
		<td><?=$a_home?>[HOME]</a></td><td><?=$a_bitly?>[bitly]</a></td><td><?=$a_keyword?>[��������]</a></td>
		<td><?=$a_list?><img src=<?=$dir?>/bt_list.gif border=0></a></td>
		<td><?=$a_write?><img src=<?=$dir?>/bt_write.gif border=0></a></td>
	</tr>
	</table>
 </td>
</tr>
</table>
<br><br>