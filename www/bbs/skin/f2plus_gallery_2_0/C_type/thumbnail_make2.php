<?
function thumbnail($size,$source_file,$save_path,$small,$large,$ratio){

	$img_info=@getimagesize($source_file);

	if($img_info[2]==1) $srcimg=@ImageCreateFromGIF($source_file);
	elseif($img_info[2]==2) $srcimg=@ImageCreateFromJPEG($source_file);
	else                     $srcimg=@ImageCreateFromPNG($source_file);

	for($i=0; $i<=sizeof($size)-1;$i++){
		if($size[$i]!=0){

			if($i==sizeof($size)-1) {
				//$ratio가 0으로 나누어지는 것 방지
				if($img_info[0]!="")
					$ratio=$img_info[1]/$img_info[0];
			}

			$max_width=$size[$i];
			$max_height=intval($size[$i]*$ratio);

			if($img_info[0]<=$max_width || $img_info[1]<=$max_height){
				$new_width=$img_info[0];
				$new_height=$img_info[1];
			}else{
				if($img_info[0]*$ratio >= $img_info[1]){
             		$alpha=(double)$max_height/$img_info[1];
					$new_width=intval($img_info[0]*$alpha);
					$new_height=$max_height;
				}
				else{
					$alpha=(double)$max_width/$img_info[0];
					$new_width=$max_width;
					$new_height=intval($alpha*$img_info[1]);
				}
			}

			$srcx=(int)($max_width-$new_width)/2;
			$srcy=(int)($max_height-$new_height)/2;

			if($img_info[2]==1){
				$dstimg=@ImageCreate($max_width,$max_height);
				@ImageColorAllocate($dstimg,255,255,255);
				@ImageCopyResized($dstimg, $srcimg,$srcx,$srcy,0,0,$new_width,$new_height,ImageSX($srcimg),ImageSY($srcimg));
			}else{
				$dstimg=@ImageCreateTrueColor($max_width,$max_height);
				@ImageColorAllocate($dstimg,255,255,255);
				@ImageCopyResampled($dstimg, $srcimg,$srcx,$srcy,0,0,$new_width,$new_height,ImageSX($srcimg),ImageSY($srcimg));
			}

			if($i==0){
				@ImageJPEG($dstimg,$save_path.$small,85);
			}
			else{
				@ImageJPEG($dstimg,$save_path.$large,85);
			}
			@ImageDestroy($dstimg);
		}
	}
	@ImageDestroy($srcimg);

	return $img_info[0];
}

function thumbnail2($size,$source_file,$save_file){

	$img_info=@getimagesize($source_file);

	if($img_info[2]==1) $srcimg=@ImageCreateFromGIF($source_file);
	elseif($img_info[2]==2) $srcimg=@ImageCreateFromJPEG($source_file);
	else                     $srcimg=@ImageCreateFromPNG($source_file);

	if($img_info[0]>=$size){
		$max_width=$size;
		$max_height=ceil($img_info[1]*$size/$img_info[0]);
	}else{
		$max_width=$img_info[0];
		$max_height=$img_info[1];
	}

	if($img_info[2]==1){
		$dstimg=@ImageCreate($max_width,$max_height);
		@ImageColorAllocate($dstimg,255,255,255);
		@ImageCopyResized($dstimg, $srcimg,0,0,0,0,$max_width,$max_height,ImageSX($srcimg),ImageSY($srcimg));
	}else{
		$dstimg=@ImageCreateTrueColor($max_width,$max_height);
		@ImageColorAllocate($dstimg,255,255,255);
		@ImageCopyResampled($dstimg, $srcimg,0,0,0,0,$max_width,$max_height,ImageSX($srcimg),ImageSY($srcimg));
	}

	@ImageJPEG($dstimg,$save_file,85);

	@ImageDestroy($dstimg);
	@ImageDestroy($srcimg);
}
?>