<? 
$pass = $_POST["pwd"];
$pass = stripslashes($pass);

if($pass == "gg" || $member[no] || $data[is_secret] != 0) {
	
	$a_preview = str_replace("view_preview()","preview_m()",$a_preview);
	
	//������ �� ���ڸ� �߻�(1-8) �� ���Ǻ����� ����
	$num1 = rand(1,8);
	$num2 = rand(1,8);
	$num1num2 = $num1*10 + $num2;
	session_register("num1num2");
	//�ڸ�Ʈ ������ ���� ���Ǻ����� ����
	$ZBRD_SS_VRS = $num1num2;
	session_register("ZBRD_SS_VRS");
	//�̸�����, �׸�â��, �ڵ���� ��ư ���̰� �ϱ�
	$box_view=true;

	$align="right";
	if($member[no]){
		$align="left";
	}
	?>
	<SCRIPT LANGUAGE="JavaScript">
	<!--
	function zb_formresize(obj) {
		obj.rows += 3;
	}

	function check_submit_y() {
		<? if(!$member[no]) { ?>
		if(!document.write.name.value){
			alert('�̸��� �Է��Ͽ� �ּ���.');
			document.write.name.focus();
			return false;
		}
		else if(!document.write.password.value){
			alert('��ȣ�� �Է��Ͽ� �ּ���.\n\n��ȣ�� �Է��ϼž� ����/������ �Ҽ� �ֽ��ϴ�');
			document.write.password.focus();
			return false;
		}

		var nStr=document.write.name.value;
		var pStr=document.write.password.value;

		var nLen=nStr.length;
		var pLen=pStr.length;
		var cnt=0;

		for(i=0;i<nLen;i++){
			if(nStr.substr(i,1)=="\"") cnt++;
		}
		if(cnt>0){
			alert("�̸��� \" ���ڰ� �� �ֽ��ϴ�.");
			document.write.name.focus();
			return false;
		}

		cnt=0;
		for(i=0;i<pLen;i++){
			if(pStr.substr(i,1)=="\"") cnt++;
		}
		if(cnt>0){
			alert('�н����忡 \" ���ڰ� �� �ֽ��ϴ�.');
			document.write.password.focus();
			return false;
		}
		<? } ?>

		if(document.getElementById("memo").value==""){
			alert("������ �Է��ϼ���!");
			document.getElementById("memo").focus();
			return false;
		}

		return true;
	}

	function preview_m() {
		if(!document.write.memo.value)
		{
			alert('���� ������ �Է��Ͽ� �ּ���..');
			document.write.memo.focus();
			return false;
		}
		document.write.action = "view_preview2.php";
		document.write.target = "_blank";
		document.write.submit();
		document.write.action = "<?=$dir?>/comment_ok.php";
		document.write.target = "_self";
	}
	//-->
	</SCRIPT><br>
	<a name="m_review_w"><img src=<?=$dir?>/t.gif border=0 height=4></a><br>
	<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?> align=center>
	<form method=post name=write action=<?=$dir?>/comment_ok.php onsubmit="return check_submit_y();" enctype=multipart/form-data><input type=hidden name=page value=<?=$page?>><input type=hidden name=id value=<?=$id?>><input type=hidden name=no value=<?=$no?>><input type=hidden name=select_arrange value=<?=$select_arrange?>><input type=hidden name=desc value=<?=$desc?>><input type=hidden name=page_num value=<?=$page_num?>><input type=hidden name=keyword value="<?=$keyword?>"><input type=hidden name=category value="<?=$category?>"><input type=hidden name=sn value="<?=$sn?>"><input type=hidden name=ss value="<?=$ss?>"><input type=hidden name=sc value="<?=$sc?>"><input type=hidden name=sm value="<?=$sm?>"><input type=hidden name=mode value="write"><input type=hidden name=_zb_path value="<?=$config_dir?>"><input type=hidden name=_zb_url value="<?=$zb_url?>"><input type=hidden name=antispam value="<?=$num1num2?>">
	<col width=80 style=padding:0,3,0,5></col><col width=80 style=padding:0,3,0,3></col><col width=80 style=padding:0,3,0,3></col><col width=80 style=padding:0,3,0,3></col><col width=></col>
	<tr>
	<?if(!$member['no']){?>
	<td align=center><font class=list_eng><b>Name</b></font></td>
	<td><font class=list_han><?=$c_name?></font></td>
	<?}?>
	<?=$hide_c_password_start?>
	<td align=center><font class=list_eng><b>Password</b></font></td>
	<td><input type=password name=password <?=size(8)?> maxlength=20 class=input></td>
	<?=$hide_c_password_end?>
	<td width="100%"><div align=<?=$align?>><?if ($emoticon_use=="on"){?>
	<input onclick='showEmoticon()' type=checkbox name=Emoticons value='yes'><img src=<?=$dir?>/use_emo.gif>
	</div><?}?>
	</td>
	<?if($member[no]){?>
	<td align=right>
	<table border=0 cellspacing=0 cellpadding=3 width=100%><tr><td>
	<select name="_point1">
		<option value=0 style=background-color:#ffffff;color:555555 selected>����Ʈ</option>
		<option value=1 style=background-color:#ffffff;color:888888>��</option>
		<option value=2 style=background-color:#ffffff;color:666666>�ڡ�</option>
		<option value=3 style=background-color:#ffffff;color:444444>�ڡڡ�</option>
		<option value=4 style=background-color:#ffffff;color:222222>�ڡڡڡ�</option>
		<option value=5 style=background-color:#ffffff;color:000000>�ڡڡڡڡ�</option>
	</select></td>
	<td valign=top>
	<select name="_point2">
		<option value=0 style=background-color:#ffffff;color:555555 selected>����</option>
		<option value=1 style=background-color:#ffffff;color:black>��</option>
	</select></td>
	</tr></table>
	</td><?}?>
	</tr>
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
			<col width=></col><col width=90></col>
			<tr>
			<td width=100%><textarea name=memo id=memo cols=20 rows=5 class=textarea style=width:100% onkeydown='return doTab(event);'></textarea></td>
			<td width=90><input type=submit rows=5 class=submit value='��ȭ�򾲱�' accesskey="s" style=height:100%></td>
			</tr>
			</table>
			<table border=0 cellspacing=2 cellpadding=0 width=100% height=20>
			<col width=5%></col><col width=45%></col><col width=5%></col><col width=45%>
			<tr valign=top>
			<?=$hide_pds_start?>
			  <td width=52 align=right><font class=list_eng>Upload #1</font></td>
			  <td class=list_eng><input type=file name=file1 <?=size(50)?> maxlength=255 class=input style=width:99%></td>
			  <td width=52 align=right><font class=list_eng>Upload #2</font></td>
			  <td class=list_eng><input type=file name=file2 <?=size(50)?> maxlength=255 class=input style=width:99%></td>
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
	<br>
<?
} else {
?>
	<script language="javascript">
	<!--
	function sendit() {
		//�н�����
		if(document.myform.pwd.value=="") {
			alert("�н����带 �Է��� �ֽʽÿ�");
			return false;
		}
		document.myform.submit();
	}
	-->
	</script>
	<img src=<?=$dir?>/t.gif border=0 height=4><br>
	<form name="myform" method="post" action=<?=$PHP_SELF?> enctype=multipart/form-data>
	<input type=hidden name=page value=<?=$page?>><input type=hidden name=id value=<?=$id?>><input type=hidden name=no value=<?=$no?>><input type=hidden name=select_arrange value=<?=$select_arrange?>><input type=hidden name=desc value=<?=$desc?>><input type=hidden name=page_num value=<?=$page_num?>><input type=hidden name=keyword value="<?=$keyword?>"><input type=hidden name=category value="<?=$category?>"><input type=hidden name=sn value="<?=$sn?>"><input type=hidden name=ss value="<?=$ss?>"><input type=hidden name=sc value="<?=$sc?>"><input type=hidden name=sm value="<?=$sm?>"><input type=hidden name=mode value="<?=$mode?>">
	<table width=<?=$width?> height="120" border="0" cellpadding="0" cellspacing="1" bgcolor="#FFFFFF" align="center">
		<tr><td class=line1>
			<table width="320" height="70" border="1" style="border-collapse:collapse;" bordercolor="black" bgcolor="#BEEBDD" cellpadding="1" align="center">
				<tr><td height="45" align="center"><b><span style="font-size:11pt">���� �ޱ�!!<br>���Թ��� ���(<font color="red">gg</font>)�� �Է�: </span></b><input type="password" name="pwd" size="20">
				</td></tr>
				<tr><td height="25" align="center"><input type="button" value="Ȯ��" onClick="javascript:sendit();">
			</table>
		</td></tr>
	</table>
	</form>
<? } ?>