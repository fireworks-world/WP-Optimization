<?php
  ini_set('memory_limit', '256M');
  ini_set('post_max_size', '64M');
  ini_set('upload_max_filesize', '256M');
function CreateSquareThumb($source,$dest,$target,$new_width,$new_height,$dimen,$border=0)
{
			/*copy($source, $target);
			$new_width = 134; //
			$new_height = 134; //
			$sourcedate = 0;
			$destdate = 0;
			global $convert;
			if (file_exists($dest)) {
			clearstatcache();
			$sourceinfo = stat($target);
			$destinfo = stat($dest);
			$sourcedate = $sourceinfo[10];
			$destdate = $destinfo[10];
			}
			if (!file_exists("$dest") or ($sourcedate > $destdate)) {
			global $ImageTool;
			$imgsize = GetImageSize($target);
			$width = $imgsize[0];
			$height = $imgsize[1];
			
			if ($width > $height) { 
			$xoord = ceil(($width - $height) / 2 );
			$width = $height; 
			} else {
			$yoord = ceil(($height - $width) / 2);
			$height = $width;
			}
			$new_im = ImageCreatetruecolor($new_width,$new_height);
			//$im = ImageCreateFromJPEG($target);
			
				if($type==1) $im = imagecreatefromgif($target); 
			if($type==2) $im = imagecreatefromjpeg($target); 
			if($type==3) $im = imagecreatefrompng($target); 
			
			
			@imagecopyresampled($new_im,$im,0,0,$xoord,$yoord,$new_width,$new_height,$width,$height);
			//ImageJPEG($new_im,$dest,90);
			
			if($type==1) imagegif($new_im, $dest, 80);
			if($type==2) imagejpeg($new_im, $dest, 80);
			if($type==3) imagepng($new_im, $dest, 7);
			
			
			}*/

		    @copy($source, $target);
			list($width, $height,$type) = getimagesize($target); 					

			if($width>500)
			$modwidth = 500; 
			else
			$modwidth = $width; 
			$diff = $width / $modwidth;
			$modheight = (int)($height / $diff); 
			
			$tn = @imagecreatetruecolor($modwidth, $modheight); 	
			if($type==1) $image = imagecreatefromgif($target); 
			if($type==2) $image = imagecreatefromjpeg($target); 
			if($type==3) $image = imagecreatefrompng($target); 	
			@imagecopyresampled($tn, $image, 0, 0, 0, 0, $modwidth, $modheight, $width, $height) ; 
			if($type==1) imagegif($tn, $target, 80);
			if($type==2) imagejpeg($tn, $target, 80);
			if($type==3) imagepng($tn, $target, 7);
			/* code to create large Image ends here */
}

function make_thumb($img_name,$filename,$new_w,$new_h,$type){
			@copy($source, $target);
			$new_width = 280; //
			$new_height = 280; //
			$sourcedate = 0;
			$destdate = 0;
			global $convert;
			if (file_exists($dest)) {
			clearstatcache();
			$sourceinfo = stat($target);
			$destinfo = stat($dest);
			$sourcedate = $sourceinfo[10];
			$destdate = $destinfo[10];
			}
			if (!file_exists("$dest") or ($sourcedate > $destdate)) {
			global $ImageTool;
			$imgsize = GetImageSize($target);
			$width = $imgsize[0];
			$height = $imgsize[1];
			
			if ($width > $height) { 
			$xoord = ceil(($width - $height) / 2 );
			$width = $height; 
			} else {
			$yoord = ceil(($height - $width) / 2);
			$height = $width;
			}
			$new_im = ImageCreatetruecolor($new_width,$new_height);
			/*$im = ImageCreateFromJPEG($target);
			imagecopyresampled($new_im,$im,0,0,$xoord,$yoord,$new_width,$new_height,$width,$height);
			ImageJPEG($new_im,$dest,90);*/
			
			if($type==1) $im = imagecreatefromgif($target); 
			if($type==2) $im = imagecreatefromjpeg($target); 
			if($type==3) $im = imagecreatefrompng($target); 	
			@imagecopyresampled($new_im,$im,0,0,$xoord,$yoord,$new_width,$new_height,$width,$height);
			if($type==1) imagegif($new_im, $dest, 80);
			if($type==2) imagejpeg($new_im, $dest, 80);
			if($type==3) imagepng($new_im, $dest, 7);
			
			}
}
?>