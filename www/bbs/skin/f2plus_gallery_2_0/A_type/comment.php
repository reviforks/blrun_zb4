<?
	$a_preview = str_replace(">","><font class=list_eng>",$a_preview)."&nbsp;&nbsp;";
	$a_imagebox = str_replace(">","><font class=list_eng>",$a_imagebox)."&nbsp;&nbsp;";
	$a_codebox = str_replace(">","><font class=list_eng>",$a_codebox)."&nbsp;&nbsp;";
	$emoticon_url=$dir."/emoticon";
?>

<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?> align=center>
<form method=post name=write action=comment_ok.php onsubmit="return check_submit();" enctype=multipart/form-data><input type=hidden name=page value=<?=$page?>><input type=hidden name=id value=<?=$id?>><input type=hidden name=no value=<?=$no?>><input type=hidden name=select_arrange value=<?=$select_arrange?>><input type=hidden name=desc value=<?=$desc?>><input type=hidden name=page_num value=<?=$page_num?>><input type=hidden name=keyword value="<?=$keyword?>"><input type=hidden name=category value="<?=$category?>"><input type=hidden name=sn value="<?=$sn?>"><input type=hidden name=ss value="<?=$ss?>"><input type=hidden name=sc value="<?=$sc?>"><input type=hidden name=sm value="<?=$sm?>"><input type=hidden name=mode value="modify"><input type=hidden name=c_no value=<?=$c_no?>><input type=hidden name=antispam value="<?=$num1num2?>">
<col width=60 style=padding:0,3,0,5></col><col width=80 style=padding:0,3,0,3></col><col width=80 style=padding:0,3,0,3></col><col width=80 style=padding:0,3,0,3></col><col width=></col>
<tr>
<?=$hide_start?>
<td class=list_eng><b>Name</b></td><td class=list_han><input type=text name=name value="<?=$name?>" <?=size(8)?> maxlength=20 class=input></td>
<td class=list_eng><b>Password</b></td><td class=list_han><input type=password name=password <?=size(8)?> maxlength=20 class=input></td>
<?=$hide_end?>
<td width="100%"><div align=right>
<?if($emoticon_use=="on"){?>
<input onclick='showEmoticon()' type=checkbox name=Emoticons value='yes'><img src=<?=$dir?>/use_emo.gif>
</div><?}?>
</td></tr>
<tr><td height=1 colspan=5 background=<?=$dir?>/dot.gif>
</td></tr>
<tr><td colspan=5 align=right class=list_eng><?=$hide_html_start?> <input type=checkbox name=use_html2<?=$use_html2?>> HTML��� <?=$hide_html_end?><?=$hide_secret_start?> <input type=checkbox name=is_secret <?=$secret?> value=1> ��б� <?=$hide_secret_end?>
</td></tr>
<tr><td bgcolor=white height=3 colspan=5>
</td></tr><tr><td colspan=5>
	<table border=0 cellspacing=0 cellpadding=3 width=100%>

	</table>
	<table border=0 cellspacing=1 cellpadding=0 width=100% height=120>
	<col width=5 align=center><col width=></col>
	<tr> 
	<td onclick="document.write.memo.rows=document.write.memo.rows+4" style=cursor:hand valign=top align=right>
	��</td>
	<td>
		<table border=0 cellspacing=2 cellpadding=0 width=100% height=100 style=table-layout:fixed>
		<col width=></col><col width=70></col>
		<tr>
		<td width=100%><textarea name=memo id=memo cols=20 rows=5 class=textarea style=width:100% onkeydown='return doTab(event);'><?=$memo?></textarea></td>
		<td width=70><input type=submit rows=5 class=submit value='�����ϱ�' accesskey="s" style=height:100%></td>
		</tr>
		</table>
		<table border=0 cellspacing=2 cellpadding=0 width=100% height=20>
		<col width=5%></col><col width=45%></col><col width=5%></col><col width=45%>
		<tr valign=top>
		<?=$hide_pds_start?>
		  <td width=52 align=right><font class=list_eng>Upload #1</font></td>
		  <td class=list_eng><input type=file name=file1 <?=size(50)?> maxlength=255 class=input style=width:99%> <?=$s_file_name1?></td>
		  <td width=52 align=right><font class=list_eng>Upload #2</font></td>
		  <td class=list_eng><input type=file name=file2 <?=size(50)?> maxlength=255 class=input style=width:99%> <?=$s_file_name2?></td>
		<?=$hide_pds_end?>
		</tr>
		</table>
	</td>
	</tr>
	</form>
	</table>

</td>
</tr>
</table>
<TABLE BORDER=0 CELLPADDING=0 CELLSPACING=0 align="center" width=<?=$width?>>
<TR>
<TD style=padding-left:18px><? if($emoticon_use=="on") include "$dir/emo.php"; ?>
</TD>
</TR>
</table>
<table border=0 width=<?=$width?> cellsapcing=1 cellpadding=0>
<tr>
	<td width=200 height=40>
		<?=$a_preview?>�̸�����</a><?=$a_imagebox?>�׸�â��</a><?=$a_codebox?>�ڵ����</a>
	</td>
</tr>
</table>