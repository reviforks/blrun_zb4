<?
/***************************************************************************
 * ȸ������ ���ε�� �̹����� �����ִ� ������
 **************************************************************************/
	include "_head.php";

	if(!$id) Die("<Script>\nalert('�Խ��� �̸��� �Է��ϼž� �մϴ�');\nwindow.close();\n</Script>");

	$setup[header]="";
	$setup[footer]="";
	$setup[header_url]="";
	$setup[footer_url]="";
	$group[header]="";
	$group[footer]="";
	$group[header_url]="";
	$group[footer_url]="";
	$setup[skinname]="";

	if(!$member[no]) error("ȸ���� <br>��밡���մϴ�","window.close");
	if($setup[grant_write]<$member[level]&&!$is_admin) Error("��� ������ �����ϴ�","window.close");
	if($setup[grant_imagebox]<$member[level]) Error("��� ������ �����ϴ�","window.close");

// icon ���丮�� member_image_box ���丮�� ������� ���丮 ����
	$path = "icon/member_image_box";
	if(!is_dir($path)) {
		@mkdir($path,0707);
		@chmod($path,0707);
	}

// ȸ���� Path ����
	$path .="/".$member[no];

// ȸ���� ���丮�� ������ �ȵǾ� ������ ����
	if(!is_dir($path)) {
		@mkdir($path,0707);
		@chmod($path,0707);
	}

// ȸ���� �̹��� â�� ��ü �뷮 ����ϱ�
	$d = dir($path);
	while($entry = $d->read()) {
		if ($entry != "." && $entry != "..") {
			$image_list[] = $entry;
			$image_list_time[] = filemtime($path."/".$entry);
		}
	}

	@array_multisort ($image_list_time, SORT_DESC, SORT_NUMERIC,
                     $image_list, SORT_STRING, SORT_DESC);
	
	$dirSize = 0;
	for($i=0;$i<count($image_list);$i++) $dirSize += filesize($path."/".$image_list[$i]); 

// ȸ���� ��� �뷮 ���ϱ�
	$maxDirSize = zReadFile($path."_maxsize.php");
	if(!$maxDirSize) {
		// �⺻���� 20000kb �� �뷮�� ����
		$maxDirSize = 20000*1024; 
	} else {
		// ������ �ּ�ó�� ����
		$maxDirSize = str_replace("<?/*","",$maxDirSize);
		$maxDirSize = str_replace("*/?>","",$maxDirSize);
	}

// �Էµ� �̹����� ������ upload ��Ŵ
	if($exec=="upload") {
		if(!preg_match("/".$HTTP_HOST."/i",$HTTP_REFERER)) Error("���������� ���ε带 �Ͽ� �ֽñ� �ٶ��ϴ�.","window.close");
		if(!preg_match("/image_box.php/i",$HTTP_REFERER)) Error("���������� ���ε带 �Ͽ� �ֽñ� �ٶ��ϴ�.","window.close");
		if(getenv("REQUEST_METHOD") == 'GET' ) Error("���������� ���ε带 �Ͽ� �ֽñ� �ٶ��ϴ�","window.close");

		$num = (int)count($HTTP_POST_FILES[upload][name]);
		for($i=0;$i<$num;$i++) {
			$upload[$i] = $HTTP_POST_FILES[upload][tmp_name][$i];
			$upload_name[$i]  = $HTTP_POST_FILES[upload][name][$i];
			//Ư�����ڰ� ������ ����
			preg_match('/[0-9a-zA-Z.\(\)\[\] \+\-\_\xA1-\xFE\xA1-\xFE]+/',$upload_name[$i],$result);
			
			$upload_size[$i]  = $HTTP_POST_FILES[upload][size][$i];
			$upload_type[$i]  = $HTTP_POST_FILES[upload][type][$i];

			if($upload_name[$i]) {
				//Ư�����ڰ� ������
				if($result[0]!=$upload_name[$i]) Error("�ѱ�,������,����,��ȣ,����,+,-,_ ���� ����� �� �ֽ��ϴ�!"); 

				$upload[$i]=eregi_replace("\\\\","\\",$upload[$i]);
				$upload_name[$i]=str_replace(" ","_",$upload_name[$i]);
				$upload_name[$i]=str_replace("-","_",$upload_name[$i]);
				
				if(file_exists($path."/".$upload_name[$i])) Error("���� �̸��� ������ �����մϴ�.<br>�ٸ� �̸����� �Է��Ͽ� �ֽñ� �ٶ��ϴ�");

				$filesize = filesize($upload[$i]);
	
				// ���ε� �뷮 üũ
				if($maxDirSize < $filesize + $dirSize) Error("�̹��� â�� ��� �뷮�� �ʰ��Ͽ����ϴ�.");

				if($filesize) {
					if(!is_uploaded_file($upload[$i])) Error("�������� ������� ���ε� ���ּ���","window.close");
					if(!preg_match("#\.(jpg|jpeg|png|gif|bmp)$#i",$upload_name[$i])) Error("�̹����� jpg(jpeg) �Ǵ� png �Ǵ� gif �Ǵ� bmp ������ �÷��ּ���");
					$size=GetImageSize($upload[$i]);
					if(!$size[2]) Error("�̹��� ������ �÷��ֽñ� �ٶ��ϴ�");
					if(!@move_uploaded_file($upload[$i] , $path."/".$upload_name[$i])) Error("�̹��� ���ε尡 ����� ���� �ʾҽ��ϴ�");
				}

			}

		}

		movepage("$PHP_SELF?id=$id&image_page=$image_page");
		exit();
	}

// ���� ���� �����
	if($exec=="delete"&&strlen($no)&&$id) {
		if(!z_unlink($path."/".$image_list[$no])) die("����");
		//�� �Խ��� �ڷ�ǿ��� ��� ����� ����
		$table_name_result=mysql_query("select name from $admin_table order by name") or error(mysql_error());
		while($table_data=mysql_fetch_array($table_name_result)){
			$table_name=$table_data[name];
			// ����ϻ���
			if(preg_match("#(.+?)\.(jpg|jpeg|png)$#i",$image_list[$no],$out)){
				@z_unlink("./"."data/".$table_name."/thumbnail/".$member[no]."/fs_".$out[1].".jpg");
				@z_unlink("./"."data/".$table_name."/thumbnail/".$member[no]."/fl_".$out[1].".jpg");
				@z_unlink("./"."data/".$table_name."/thumbnail/".$member[no]."/fXL_".$out[1].".jpg");
				@z_unlink("./"."data/".$table_name."/thumbnail/".$member[no]."/ss_".$out[1].".jpg");
				@z_unlink("./"."data/".$table_name."/thumbnail/".$member[no]."/sl_".$out[1].".jpg");
				@z_unlink("./"."data/".$table_name."/thumbnail/".$member[no]."/sXL_".$out[1].".jpg");
			}
		}

		movepage("$PHP_SELF?id=$id&image_page=$image_page");
		exit();
	}

// ���������� ��µ� �׸� ���� ����
	$listnum = 18;

// ��ü������ ��ü ������ �� ����
	$total = count($image_list);
	$total_page=(int)(($total-1)/$listnum)+1; // ��ü ������ ����

// ������ ����
	if(!$image_page) $image_page = 1;

// �������� ��ü ���������� ũ�� ������ ��ȣ �ٲ�
	if($image_page>$total_page) $image_page=$total_page; 

// �̹����� ��� ũ�� ����
	$x_size = 75;
	$y_size = 75;

// �� �ٿ� ���� �̹��� �� ����
	$h_num = 6;


	head();
?>
<? include "script/popup.php"; ?>
<script>
function imagecheck(str,iwidth,iheight) {
	document.imageList.i_filename.value=str;
	document.imageList.i_width.value=iwidth;
	document.imageList.i_height.value=iheight;
	var obj=document.getElementById('inputTable');
	obj.style.visibility='visible';
}
function putStr() {
	var img_str="";
	var img_filename="";
	var img_align="";
	var img_width="";
	var img_height="";
	var img_vspace="";
	var img_hspace="";
	var img_border="";
	if(opener.window.document.getElementById('memo')) {
		img_filename=document.imageList.i_filename.value;
		img_width=document.imageList.i_width.value;
		img_height=document.imageList.i_height.value;
		img_vspace=document.imageList.i_vspace.value;
		img_hspace=document.imageList.i_hspace.value;
		img_align=document.imageList.i_align.value;
		img_border=document.imageList.i_border.value;
		img_str = "[img:"+img_filename+",align="+img_align+",width="+img_width+",height="+img_height+",vspace="+img_vspace+",hspace="+img_hspace+",border="+img_border+"]";
		if(img_align=="") {
			img_str = "\n"+img_str+"\n";
		}
		//opener.document.getElementById('memo').value = opener.document.getElementById('memo').value + img_str;
		insert_tag("",img_str,"");
	} else {
		alert ("�۾��� ȭ�鿡���� ����ϽǼ� �ֽ��ϴ�!");
	}
	var obj=document.getElementById('inputTable');
	obj.style.visibility='hidden';
}
function alignset(str) {
	document.imageList.i_align.value=str;
}
</script>

<div align=center>

<form method=post action="<?=$PHP_SELF?>" ENCTYPE="multipart/form-data" name=imageList>
<input type=hidden name=exec value="upload">
<input type=hidden name=page value="<?=$image_page?>">
<input type=hidden name=id value="<?=$id?>">
<input type=hidden name=i_align value="">
	<img src=images/t.gif border=0 height=10><Br>
	<table border=0 width=98% cellspacing=0 cellpadding=0>
	<tr>
		<td align=left><img src=images/im_title_left.gif border=0></td>
		<td width=100% background=images/im_title_back.gif><img src=images/im_title_back.gif></td>
		<td align=right onmouseover=zbHelp.style.visibility='visible'><img src=images/im_title_right.gif border=0></td>
	</tr>
	</table>
	<table border=0 width=98% cellspacing=0 cellpadding=5>
	<tr>
		<td align=left>&nbsp;<font color=444444 style=font-family:tahoma;font-size:7pt><b>Total : <?=$total?> ( <?=getfilesize($dirSize)?> / <?=getfilesize($maxDirSize)?>)</td>
		<td align=right><font color=444444 style=font-family:tahoma;font-size:7pt><b><?=$image_page?>/<?=$total_page?> Pages</td>
	</tr>
	</table>
	<br>

<div id='inputTable' style='position:absolute; left:50px; top:120px; width:500px; height: 250; z-index:1; visibility: hidden'>
	<table border=0 width=98% cellspacing=1 cellpadding=3 bgcolor=black>
	<tr>
		<td bgcolor=#F9F9F9>
			<img src=images/t.gif border=0 height=3><br><img src=images/im_underline.gif border=0 width=100% height=2><br><img src=images/t.gif border=0 height=3><br>

			<table border=0 cellspacing=0 cellpadding=4 width=100%>
			<tr>
				<td><b>�׸�����</b> : <input type=input value="" size=25 class=input name=i_filename style=height:16px></td>
			</tr>
			</table>

			<img src=images/t.gif border=0 height=3><br><img src=images/im_underline.gif border=0 width=100% height=2><br><img src=images/t.gif border=0 height=3><br>

			<table border=0 cellspacing=0 cellpadding=4 width=100%>
			<tr>
				<td><b>���ı���</td>
				<td>
					<table border=0 cellspacing=0 cellpadding=0 width=100%>
					<col width=17%></col><col width=17%></col><col width=17%></col><col width=17%></col><col width=17%></col><col width=17%></col>
					<tr>
						<td><img src=images/im_i_normal.gif border=0></td>
						<td><img src=images/im_i_top.gif border=0></td>
						<td><img src=images/im_i_center.gif border=0></td>
						<td><img src=images/im_i_bottom.gif border=0></td>
						<td><img src=images/im_i_left.gif border=0></td>
						<td><img src=images/im_i_right.gif border=0></td>
					</tr>
					<tr>
						<td><input type=radio name=aligncheck checked onclick=alignset('')> �� ��</td>
						<td><input type=radio name=aligncheck onclick=alignset('top')> ��</td>
						<td><input type=radio name=aligncheck onclick=alignset('middle')> �߰�</td>
						<td><input type=radio name=aligncheck onclick=alignset('bottom')> �Ʒ�</td>
						<td><input type=radio name=aligncheck onclick=alignset('left')> ����</td>
						<td><input type=radio name=aligncheck onclick=alignset('right')> ������</td>
					</tr>
					</table>

				</td>
			</tr>
			</table>

			<img src=images/t.gif border=0 height=3><br><img src=images/im_underline.gif border=0 width=100% height=2><br><img src=images/t.gif border=0 height=3><br>

			<table border=0 cellspacing=0 cellpadding=4 width=100%>
			<tr>
				<td nowrap='nowrap' height=30><b>ũ������</td>
				<td width=100%>
					���� : <input type=input value="" size=3 class=input name=i_width style=height:16px> &nbsp;
					���� : <input type=input value="" size=3 class=input name=i_height style=height:16px> &nbsp;
				</td>
				<td align=right nowrap='nowrap'><b>�׵θ��β�</b> : <input type=input name=i_border size=2 class=input value="1" style=height:16px> px</td>
			</tr>
			</table>

			<img src=images/t.gif border=0 height=3><br><img src=images/im_underline.gif border=0 width=100% height=2><br><img src=images/t.gif border=0 height=3><br>

			<table border=0 cellspacing=0 cellpadding=4 width=100%>
			<tr>
				<td nowrap='nowrap'><b>��������</td>
				<td width=100%>
					���� : <input type=input value="0" size=3 class=input name=i_hspace style=height:16px> px &nbsp;
					���� : <input type=input value="0" size=3 class=input name=i_vspace style=height:16px> px &nbsp;
				</td>
				<td nowrap='nowrap'><a href="javascript:void(putStr())"><img src=images/im_input.gif border=0></a> <a href=# onclick=inputTable.style.visibility='hidden'><img src=images/im_close.gif border=0></a></td>
			</tr>
			</table>

			<img src=images/t.gif border=0 height=3><br><img src=images/im_underline.gif border=0 width=100% height=2><br><img src=images/t.gif border=0 height=3><br>
		</td>
	</tr>
	</table>
	<table border=0 width=95% bgcolor=888888 height=3 cellspacing=0 cellpadding=0><tr><td></td><tr></table>

</div>

	<br>

	<table border=0 width=98% cellspacing=0 cellpadding=2>
<?
	$_t_width = (int)(100 / $h_num);
	for($i=0;$i<$h_num;$i++) echo"<col width=$_t_width"."%></col>";
?>

<?
	$_x = 1;

	$startNum = ($image_page-1)*$listnum;
	$endNum = $startNum+$listnum;
	if($endNum>$total) $endNum = $total;
	for($i=$startNum;$i<$endNum;$i++) {
		$size=GetImageSize($path."/".$image_list[$i]);

		if($size[0]>$x_size) {
			$_width=$x_size;
			$_div = (int)($size[0]/$x_size);
			$_height=(int)($size[1]/$_div);
		} elseif($size[1]>$y_size) {
			$_height=$y_size;
			$_div = (int)($size[1]/$y_size);
			$_width=(int)($size[0]/$_div);
		} else {
			$_width=$size[0];
			$_height=$size[1];
		}

		if($_width) $image_size = " width=$_width ";
		elseif($_height) $image_size = " height=$_height ";

		if($_x<=1) echo "<tr bgcolor=white>";
		$file_name1_ = str_replace("%2F", "/", urlencode($path."/".$image_list[$i]));
?>
		<td align=center valign=top height=75>
			<table border=0 cellspacing=1 cellpadding=2 width=100% height=100% bgcolor=666666>
			<tr>
				<td bgcolor=white align=center >
					<a href="javascript:void(imagecheck('<?=$image_list[$i]?>','<?=$size[0]?>','<?=$size[1]?>'))"><img src="<?=$file_name1_?>" border=0 <?=$image_size?>></a>
				</td>
			</tr>
			<tr>
				<td bgcolor=eeeeee height=20 align=center>
					<img src=images/t.gif border=0 height=2><br>
					<a href="#" onclick="javascript:void(window.open('<?=$file_name1_?>','imageBoxViewer','width=<?=$size[0]+20?>,height=<?=$size[1]+40?>,toolbars=no'))"><font color=555555 style=font-size:7pt;font-family:verdana>[<b>view</b>]</font></a>
					<a href=<?=$PHP_SELF?>?id=<?=$id?>&exec=delete&no=<?=$i?>&image_page=<?=$image_page?> onclick="return confirm('�����Ͻðڽ��ϱ�?')"><font color=555555 style=font-size:7pt;font-family:verdana>[<b>del</b>]</font></a>
					<img src=images/t.gif border=0 height=6><br>
				</td>
			</tr>
			</table>
		</td>
<?
		$_x ++;
		if($_x > $h_num) {
			$_x = 1;
			echo "</tr>";
		}
	}
	if($_x < $h_num) {
		for($i=$_x;$i<=$h_num;$i++)  echo "<td bgcolor=white>&nbsp;</td>";
		echo "</tr>";
	}
?>

	</table>
	<br><br>
	<table border=0 width=98% cellspacing=1 cellpadding=2>
	<tr>
		<td align=center nowrap='nowrap'>
			<input type=file name=upload[] size=25 class=input style=width:33%>
			<input type=file name=upload[] size=25 class=input style=width:33%>
			<input type=file name=upload[] size=25 class=input style=width:33%><br>
			<input type=file name=upload[] size=25 class=input style=width:33%>
			<input type=file name=upload[] size=25 class=input style=width:33%>
			<input type=file name=upload[] size=25 class=input style=width:33%><br>
			<input type=file name=upload[] size=25 class=input style=width:33%>
			<input type=file name=upload[] size=25 class=input style=width:33%>
			<input type=file name=upload[] size=25 class=input style=width:33%><br>
			<input type=file name=upload[] size=25 class=input style=width:33%>
			<input type=file name=upload[] size=25 class=input style=width:33%>
			<input type=file name=upload[] size=25 class=input style=width:33%><br>
			<input type=submit value="���ε�" class=submit style= width=100%;height:18px><br>
			<img src=images/t.gif border=0 height=3><br>
			(<b><?=getfilesize($maxDirSize)?></b> ��밡��, <b><?=getfilesize($dirSize)?></b> �����, <b><?=getfilesize($maxDirSize-$dirSize)?></b> ���ε� ����)</td>
	</tr>
	<tr>
		<td align=center height=40>
			<a href=<?=$PHP_SELF?>?id=<?=$id?>&image_page=1>[First]</a><?
	$startPageNum = $image_page - 5;
	if($startPageNum<0) $startPageNum=1;
	$endPageNum = $image_page + 5 ;
	if($endPageNum>=$total_page) $endPageNum=$total_page;
	for($i=$startPageNum;$i<=$endPageNum;$i++) {
		if($i==$image_page) echo"&nbsp;<b>$i</b>&nbsp;";
		else echo"<a href=$PHP_SELF?id=$id&image_page=$i>[$i]</a>";
	}
?><a href=<?=$PHP_SELF?>?id=<?=$id?>&image_page=<?=$total_page?>>[Last]</a>
		</td>
	</tr>
	</table>
</form>

<div id='zbHelp' style='position:absolute; left:5px; top:5px; width:99%; height: 100%; z-index:1; visibility: hidden' onmousedown=this.style.visibility='hidden'>
	<table border=0 width=98% cellspacing=1 cellpadding=3 bgcolor=black height=250>
	<tr>
		<td bgcolor=white style=line-height:160% valign=top>
			<b>Image Box ?</b>
			<table border=0 cellspacing=0 cellpadding=3 bgcolor=efefef>
			<tr>
				<td style=line-height:160% >
					Image Box �� ȸ���鸸�� �̹��� ����â���Դϴ�.<br>
					������ �Խ��ǿ��� �Խù��� �ۼ��� ��� �̹����� �����ϴ� �Խù��� ��� ���� �ڽ��� ������ ������ �÷��� ��ũ�ϴ� ����� ���� ���������, ������ �۾��ؾ� �ϴ� �������� �ֽ��ϴ�.<br>
					Image Box �� �����ڰ� ����� �뷮���� �̹��� �ڷḦ â���� �ְ� �Խù��� ���ϴ� ���� �߰��Ҽ� �ֽ��ϴ�.
				</td>
			</tr>
			</table>
			<br>
			<b>����</b>
			<table border=0 cellspacing=0 cellpadding=3 bgcolor=efefef>
			<tr>
				<td style=line-height:160% >
					���ϴ� �̹����� ���ε� �Ͻð� �̹����� Ŭ���Ͻø� �Խ��ǿ� �̹����� �߰��Ҽ� �ִ� �޴��� ��Ÿ���ϴ�.<br>
					���ϴ� ������ �����Ͻð� �Է��� �����ø� �Խù����� Ư���� �ڵ尡 ���ϴ�.<br>
				</td>
			</tr>
			</table>
			<br>
			<b>�ڵ��� ����</b>
			<table border=0 cellspacing=0 cellpadding=3 bgcolor=efefef>
			<tr>
				<td style=line-height:160% >
					[img:�����̸�,align=,width=500,height=375,vspace=0,hspace=0,border=1]<Br>
					<br>
					HTML�� img �±׿� ��������� ���� ���ĸ� ����ϽǼ� �ֽ��ϴ�.<br>
					�� �Ӽ��� , (�޸�)�� ����Ǿ� ������ ���� �����ϼŵ� ������ ���� ���Ŀ� ��߳��� ����� ����� ���� �ʽ��ϴ�.<br>
				</td>
			</tr>
			</table>
			<br>
			<div align=right>* Ŭ���Ͻø� ������ �����ϴ�</div>
		</td>
	</tr>
	</table>
</div>

<?
	foot();
	include "_foot.php";
?>