<?
	if($c_data[ismember]) {
		$imageBoxPattern = "/\[img\:(.+?)\.(jpg|jpeg|gif|png)\,align\=([a-z]+){0,}\,width\=([0-9]+)\,height\=([0-9]+)\,vspace\=([0-9]+)\,hspace\=([0-9]+)\,border\=([0-9]+)\]/i";
		$imageBoxPattern2 = "/\[img\:(.+?)\.(jpg|jpeg|gif|png)/e";
		$c_memo=preg_replace($imageBoxPattern2,"'[img:'.str_replace('%2F', '/', urlencode('\\1.\\2'))",$c_memo);
		$c_memo=preg_replace($imageBoxPattern,"<img src='icon/member_image_box/$c_data[ismember]/\\1.\\2' align='\\3' width='\\4' height='\\5' vspace='\\6' hspace='\\7' border='\\8'>",$c_memo);
	}
	
	$c_memo = love_convert($c_memo);

	if($is_admin) $show_comment_ip = $c_data['ip'];
	else $show_comment_ip = "";
	$a_del=str_replace("del_comment.php?","del_comment.php?_zb_url=$zb_url/&_zb_path=$zb_path&",$a_del);
?>
<a name="<?=$c_data[no]?>">
<table border=0 width=<?=$width?> cellspacing=0 cellpadding=3 align=center style=table-layout:fixed>
<col width=10></col><col width=></col><col width=10></col>
<tr valign=top>
	<td height=9 background=<?=$dir?>/images/c_head_bg1.gif></td>
	<td background=<?=$dir?>/images/c_head_bg2.gif></td>
	<td background=<?=$dir?>/images/c_head_bg3.gif></td>
	</tr>
<tr>
<td background=<?=$dir?>/images/c_middle_bg1.gif></td>
<td class=com9><font color=F2955C class=com><?=++$count?>.</font>
<?
if($c_data[is_secret]&&!$is_admin&&$c_data[ismember]!=$member[no]&&$data[ismember]!=$member[no]&&$member[level]>$setup[grant_view_secret])
	echo "<span style='color:gray;font-size:10pt'>��� �����Դϴ�</span>";
else {
?>
<?=$c_hide_download1_start?><font class=com9>- <b>Download #1</b> : <?=$c_file_link1?><?=$c_file_name1?> (<?=$c_file_size1?>)</a>, Download : <?=$c_file_download1?></font><br><?=$c_upload_image1?><?=$c_hide_download1_end?>
<?=$c_hide_download2_start?><font class=com9>- <b>Download #2</b> : <?=$c_file_link2?><?=$c_file_name2?> (<?=$c_file_size2?>)</a>, Download : <?=$c_file_download2?></font><br><?=$c_upload_image2?><?=$c_hide_download2_end?>
<br><?if($c_data[is_secret]) echo "<img src=".$dir."/images/post_security.gif border=0>";?><?=$c_memo?>
<? } ?></td>
<td background=<?=$dir?>/images/c_middle_bg2.gif></td></tr>
</table>
<table border=0 width=<?=$width?> cellspacing=0 cellpadding=3 align=center style=table-layout:fixed>
<col width=10></col><col width=></col><col width=240></col><col width=10></col>
<tr valign=bottom>
	<td background=<?=$dir?>/images/c_foot_bg1.gif height=45></td>
	<td background=<?=$dir?>/images/c_foot_bg2.gif align=left><?=$c_face_image?> <font class=thm7pt><?=$comment_name?>&nbsp;</font>
	</td>
	<td background=<?=$dir?>/images/c_foot_bg2.gif align=right><font class=com5><?=$show_comment_ip?></font><BR><img src=<?=$dir?>/images/t.gif height=7 align=absmiddle><BR><font class=com3><img src=<?=$dir?>/images/c_date.gif border=0 align=absmiddle> <?=date("Y-m-d",$c_data[reg_date])?>&nbsp;<?=date("H:i:s",$c_data[reg_date])?>&nbsp;</font> <?=$a_edit2?><img src=<?=$dir?>/images/edit2.gif border=0 valign=absmiddle></a> <?=$a_edit?><img src=<?=$dir?>/images/edit.gif border=0 valign=absmiddle></a> <font style=font-family:tahoma;color:f1f1f1;font-size:7pt><?=$a_del?><img src=<?=$dir?>/images/c_del.gif border=0 align=absmiddle></font></a></td>
	<td background=<?=$dir?>/images/c_foot_bg3.gif align=left></td>
</tr>
</table>
</a>