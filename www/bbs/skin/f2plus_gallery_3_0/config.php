<?
$Thumbnail_small1="fs_".$data[reg_date].".jpg";
$Thumbnail_small2="ss_".$data[reg_date].".jpg";

$Thumbnail_large1="fl_".$data[reg_date].".jpg";
$Thumbnail_large2="sl_".$data[reg_date].".jpg";

//echo $data[memo];

if($_view_included==true){
	$imagePattern="#<img src\=\'icon\/member_image_box\/([^/]+?)\/(.+?)\.(jpg|jpeg|gif|png|bmp)\'#i";
	preg_match_all($imagePattern,$data[memo],$out,PREG_SET_ORDER);

	//�Ѱ��ִ� out ���� ����
	$out[0][1]=urldecode($out[0][2]);
	$out[1][1]=urldecode($out[1][2]);
	$out[0][2]=$out[0][3];
	$out[1][2]=$out[1][3];

	$iThumbnail_small1="fs_".$out[0][1].".jpg";
	$iThumbnail_small2="ss_".$out[1][1].".jpg";

	$iThumbnail_large1="fl_".$out[0][1].".jpg";
	$iThumbnail_large2="sl_".$out[1][1].".jpg";
}else{
	$imagePattern="#\[img\:(.+?)\.(jpg|jpeg|gif|png|bmp)\,#i";
	preg_match_all($imagePattern,$data[memo],$out,PREG_SET_ORDER);

	$iThumbnail_small1="fs_".$out[0][1].".jpg";
	$iThumbnail_small2="ss_".$out[1][1].".jpg";

	$iThumbnail_large1="fl_".$out[0][1].".jpg";
	$iThumbnail_large2="sl_".$out[1][1].".jpg";
}
?>