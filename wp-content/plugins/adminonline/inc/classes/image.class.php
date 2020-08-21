<?php

define('WP_MEMORY_LIMIT', '512M' );
ini_set('memory_limit', '512M');
 class Image1{
    private $file;
    private $image;
    public $info;
		
	public function __construct($file) {
		
		
		if (file_exists($file)) {
				
			$this->file = $file;

			$info = getimagesize($file);

			$this->info = array(
            	'width'  => $info[0],
            	'height' => $info[1],
            	'bits'   => $info['bits'],
            	'mime'   => $info['mime'],
				'image_type'   => $info['2']
        	);
        	
        	$this->image = $this->create($file);
    	} else {
      		exit('Error: Could not load image ' . $file . '!');
    	}
	}
		
	private function create($image) {
		$mime = $this->info['mime'];

		if ($mime == 'image/gif') {
			return imagecreatefromgif($image);
		} elseif ($mime == 'image/png') {
			return imagecreatefrompng($image);
		} elseif ($mime == 'image/jpeg') {
			return imagecreatefromjpeg($image);
		}
    }	
	
    public function save($file, $quality = 100) {
        $info = pathinfo($file);
        $extension = $info['extension'];
	 
   
        if ($extension == ('jpeg' || 'jpg')) {
            imagejpeg($this->image, $file, $quality);
        } elseif($extension == 'png') {
            imagepng($this->image, $file, 0);
        } elseif($extension == 'gif') {
            imagegif($this->image, $file);
        }
		   
	    imagedestroy($this->image);
    }	    
	
    public function resize($width = 0, $height = 0) {
    	if (!$this->info['width'] || !$this->info['height']) {
			return;
		}

		$xpos = 0;
		$ypos = 0;

		$scale = min($width / $this->info['width'], $height / $this->info['height']);
		
		if ($scale == 1) {
			return;
		}
		
		$new_width = (int)($this->info['width'] * $scale);
		$new_height = (int)($this->info['height'] * $scale);			
    	$xpos = 0;//(int)(($width - $new_width) / 2);
   		$ypos = 0;//(int)(($height - $new_height) / 2);
        		        
       	$image_old = $this->image;
        $this->image = imagecreatetruecolor($new_width, $new_height);
			
		$background = imagecolorallocate($this->image, 255, 255, 255);
    	if (isset($this->info['mime']) && $this->info['mime'] == 'image/png') {
			imagecolortransparent($this->image, $background);
		}
		imagefilledrectangle($this->image, 0, 0, $new_width, $new_height, $background);
	
        imagecopyresampled($this->image, $image_old, $xpos, $ypos, 0, 0, $new_width, $new_height, $this->info['width'], $this->info['height']);
        imagedestroy($image_old);
           
        $this->info['width']  = $width;
        $this->info['height'] = $height;
    }
    
    public function watermark($file, $position = 'bottomright') {
        $watermark = $this->create($file);
        
        $watermark_width = imagesx($watermark);
        $watermark_height = imagesy($watermark);
        
        switch($position) {
            case 'topleft':
                $watermark_pos_x = 0;
                $watermark_pos_y = 0;
                break;
            case 'topright':
                $watermark_pos_x = $this->info['width'] - $watermark_width;
                $watermark_pos_y = 0;
                break;
            case 'bottomleft':
                $watermark_pos_x = 0;
                $watermark_pos_y = $this->info['height'] - $watermark_height;
                break;
            case 'bottomright':
                $watermark_pos_x = $this->info['width'] - $watermark_width;
                $watermark_pos_y = $this->info['height'] - $watermark_height;
                break;
        }
        
        imagecopy($this->image, $watermark, $watermark_pos_x, $watermark_pos_y, 0, 0, 120, 40);
        
        imagedestroy($watermark);
    }
    
    public function crop($top_x, $top_y, $bottom_x, $bottom_y) {
        $image_old = $this->image;
        $this->image = imagecreatetruecolor($bottom_x - $top_x, $bottom_y - $top_y);
        
        imagecopy($this->image, $image_old, 0, 0, $top_x, $top_y, $this->info['width'], $this->info['height']);
        imagedestroy($image_old);
        
        $this->info['width'] = $bottom_x - $top_x;
        $this->info['height'] = $bottom_y - $top_y;
    }
    
    public function rotate($degree, $color = 'FFFFFF') {
		$rgb = $this->html2rgb($color);
		
        $this->image = imagerotate($this->image, $degree, imagecolorallocate($this->image, $rgb[0], $rgb[1], $rgb[2]));
        
		$this->info['width'] = imagesx($this->image);
		$this->info['height'] = imagesy($this->image);
    }
	    
    private function filter($filter) {
        imagefilter($this->image, $filter);
    }
            
    private function text($text, $x = 0, $y = 0, $size = 5, $color = '000000') {
		$rgb = $this->html2rgb($color);
        
		imagestring($this->image, $size, $x, $y, $text, imagecolorallocate($this->image, $rgb[0], $rgb[1], $rgb[2]));
    }
    
    private function merge($file, $x = 0, $y = 0, $opacity = 100) {
        $merge = $this->create($file);

        $merge_width = imagesx($image);
        $merge_height = imagesy($image);
		        
        imagecopymerge($this->image, $merge, $x, $y, 0, 0, $merge_width, $merge_height, $opacity);
    }
			
	private function html2rgb($color) {
		if ($color[0] == '#') {
			$color = substr($color, 1);
		}
		
		if (strlen($color) == 6) {
			list($r, $g, $b) = array($color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5]);   
		} elseif (strlen($color) == 3) {
			list($r, $g, $b) = array($color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2]);    
		} else {
			return FALSE;
		}
		
		$r = hexdec($r); 
		$g = hexdec($g); 
		$b = hexdec($b);    
		
		return array($r, $g, $b);
	}	
	
	
	
	
	/////////////////////////////////////////////////////////////////////////////////
	/////////////////////////////////////////////////////////////////////////////////
	function resize1($filename, $width, $height,$old_image,$ext) {
	

		if (!file_exists($filename) || !is_file($filename)) {
			//return;
		} 
		
		$old_image = $old_image;
		$new_image = substr($filename, 0, strrpos($filename, '.')) . $ext;
		
		if (!file_exists($new_image) || (filemtime($old_image) > filemtime($new_image))) {
			$path = '';
			
			$directories = explode('/', dirname(str_replace('../', '', $new_image)));
			
			foreach ($directories as $directory) {
				$path = $path . '/' . $directory;
				
				if (!file_exists($path)) {
					@mkdir($path, 0777);
				}		
			}
			$image = new Image($old_image);
			$image->resize($width, $height);
			$image->save($new_image);
		}
	
		if (isset($this->request->server['HTTPS']) && (($this->request->server['HTTPS'] == 'on') || ($this->request->server['HTTPS'] == '1'))) {
			return HTTPS_IMAGE . $new_image;
		} else {
			return HTTP_IMAGE . $new_image;
		}	
	}
	
	
	 function resizeToHeight($height) {
 
      $ratio = $height / $this->getHeight();
      $width = $this->getWidth() * $ratio;
      $this->resize($width,$height);
   }
 
   function resizeToWidth($width) {
      $ratio = $width / $this->getWidth();
      $height = $this->getheight() * $ratio;
      $this->resize($width,$height);
   }
   
   function getWidth() {
 
      return imagesx($this->image);
   }
   function getHeight() {
 
      return imagesy($this->image);
   }
   
}//class ends here

//Crop image function 

function cropImages(  $source_path, $thumb_name,$new_w,$new_h){

  $source_path=$source_path;

  list( $source_width, $source_height, $source_type ) = getimagesize( $source_path );

  switch ( $source_type )
  {
    case IMAGETYPE_GIF:
      $source_gdim = imagecreatefromgif( $source_path );
      break;

    case IMAGETYPE_JPEG:
      $source_gdim = imagecreatefromjpeg( $source_path );
      break;

    case IMAGETYPE_PNG:
      $source_gdim = imagecreatefrompng( $source_path );
      break;
  }

  $source_aspect_ratio = $source_width / $source_height;
  $desired_aspect_ratio =  $new_w /  $new_h;

  if ( $source_aspect_ratio > $desired_aspect_ratio )
  {
    //
    // Triggered when source image is wider
    //
    $temp_height =  $new_h;
    $temp_width = ( int ) (  $new_h * $source_aspect_ratio );
  }
  else
  {
    //
    // Triggered otherwise (i.e. source image is similar or taller)
    //
    $temp_width =  $new_w;
    $temp_height = ( int ) (  $new_w / $source_aspect_ratio );
  }

  //
  // Resize the image into a temporary GD image
  //

  $temp_gdim = imagecreatetruecolor( $temp_width, $temp_height );
  imagecopyresampled(    $temp_gdim,    $source_gdim,    0, 0,    0, 0,    $temp_width, $temp_height,    $source_width, $source_height  );

  //
  // Copy cropped region from temporary image into the desired GD image
  //

   $x0 = ( $temp_width -  $new_w ) / 2;
 $y0 = ( $temp_height -  $new_h ) / 2;

  $desired_gdim = imagecreatetruecolor(  $new_w,  $new_h );
  imagecopy(    $desired_gdim,    $temp_gdim,    0, 0,    $x0, $y0,     $new_w,  $new_h  );

    switch ( $source_type )
  {
    case IMAGETYPE_GIF:
     imagegif( $desired_gdim, $thumb_name );
      break;

    case IMAGETYPE_JPEG:
  imagejpeg( $desired_gdim, $thumb_name );
      break;

    case IMAGETYPE_PNG:
   imagepng( $desired_gdim, $thumb_name );
      break;
  }
 }
  //
  // Add clean-up code here
  //

function GetExtension($argFileType)
{

	switch($argFileType)
	{
	
		case 'image/gif':
			return '.gif';
			break;
		case 'image/jpg':
			return '.jpg';
			break;
		case 'image/jpeg':
			return '.jpg';
			break;	
		case 'image/pjpeg':
			return '.jpeg';
			break;
		case 'image/png':
			return '.png';
			break;
		case 'image/x-png':
			return '.png';
			break;
		case 'application/msword':
			return '.doc';
			break;
		case 'application/pdf':
			return '.pdf';
			break;
		case 'text/plain':
			return '.txt';
			break;
		case 'application/vnd.ms-excel':
			return '.xls';
			break;
		case 'multipart/x-zip':
		   return '.zip';
		   break;
		
		default:
			return "";
			break;
	}
}

//Crop image function 


?>