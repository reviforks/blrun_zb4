<?
	 /* ������ ��� ���� ǥ��

	  -- ������ ��� ����
	  <?=$hide_start?> <?=$hide_end?> : ��� ���ο� ���� �̸��� �н����� �����ֱ�/ �����
	  <?=$hide_secret_start?> <?=$hide_secret_end?> : ��б� üũ �����ֱ�/ �����;;

	  <?=$name?> : �ڸ�Ʈ�� �̸� �Է��ϴ� ��;;

	  ** view.php ���� �Ʒ��ʿ� ������ ����� �����ϴ� <table>�±� ���ۺκ��� �ֽ��ϴ�.
		 �׸��� ������ ����� ������ view_comment.php ���Ͽ��� ����� �մϴ�.

	 */
?>

	<!-- ������ �亯�� ���� -->
	<tr>
	<td width=100%>
	<table border=0 width=100% cellspacing=0 cellpadding=0 height=30>
	<tr>
	<td width=0>
	<form method=post name=write action=comment_ok.php>
	<input type=hidden name=page value=<?=$page?>>
	<input type=hidden name=id value=<?=$id?>>
	<input type=hidden name=no value=<?=$no?>>
	<input type=hidden name=select_arrange value=<?=$select_arrange?>>
	<input type=hidden name=desc value=<?=$desc?>>
	<input type=hidden name=page_num value=<?=$page_num?>>
	<input type=hidden name=keyword value="<?=$keyword?>">
	<input type=hidden name=category value="<?=$category?>">
	<input type=hidden name=sn value="<?=$sn?>">
	<input type=hidden name=ss value="<?=$ss?>">
	<input type=hidden name=sc value="<?=$sc?>">
	<input type=hidden name=sm value="<?=$sm?>">
	<input type=hidden name=mode value="modify">
	<input type=hidden name=c_no value=<?=$c_no?>>
	<input type=hidden name=antispam value="<?=$num1num2?>">
	</td>
	<td align=center>
	   <?=$hide_start?>
	   <font color=444444 >�̸� : </b></font><input type=text name=name value="<?=$name?>" <?=size(10)?> maxlength=20 class=input> &nbsp; 
	   <font color=444444 >��й�ȣ : </b></font>  <input type=password name=password <?=size(10)?> maxlength=20 class=input>
	   <?=$hide_end?>
	   <font color=444444 >�ǰ� : </b></font> <input type=text name=memo value="<?=$memo?>" <?=size(40)?> maxlength=100 class=input>
	   <?=$hide_secret_start?> <input type=checkbox name=is_secret <?=$secret?> value=1> ��б� <?=$hide_secret_end?>
	   <input type=submit value="�Է�" class=submit>
	 </td>
	</tr>
	</table>
	</form>
	</table>