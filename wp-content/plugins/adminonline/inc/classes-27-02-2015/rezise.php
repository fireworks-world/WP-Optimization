<?php

function resize_image_crop($image,$width,$height) {
    $w = @imagesx($image); //current width
    $h = @imagesy($image); //current height
    if ((!$w) || (!$h)) { $GLOBALS['errors'][] = 'Image couldn\'t be resized because it wasn\'t a valid image.'; return false; }
    if (($w == $width) && ($h == $height)) { return $image; } //no resizing needed
    
    //try max width first...
    $ratio = $width / $w;
    $new_w = $width;
    $new_h = $h * $ratio;
    
    //if that created an image smaller than what we wanted, try the other way
    if ($new_h < $height) {
        $ratio = $height / $h;
        $new_h = $height;
        $new_w = $w * $ratio;
    }
    
    $image2 = imagecreatetruecolor ($new_w, $new_h);
    imagecopyresampled($image2,$image, 0, 0, 0, 0, $new_w, $new_h, $w, $h);

    //check to see if cropping needs to happen
    if (($new_h != $height) || ($new_w != $width)) {
        $image3 = imagecreatetruecolor ($width, $height);
        if ($new_h > $height) { //crop vertically
            $extra = $new_h - $height;
            $x = 0; //source x
            $y = round($extra / 2); //source y
            imagecopyresampled($image3,$image2, 0, 0, $x, $y, $width, $height, $width, $height);
        } else {
            $extra = $new_w - $width;
            $x = round($extra / 2); //source x
            $y = 0; //source y
            imagecopyresampled($image3,$image2, 0, 0, $x, $y, $width, $height, $width, $height);
        }
        imagedestroy($image2);
        return $image3;
    } else {
        return $image2;
    }
}



function resize_image_max($image,$max_width,$max_height) {
    $w = imagesx($image); //current width
    $h = imagesy($image); //current height
    if ((!$w) || (!$h)) { $GLOBALS['errors'][] = 'Image couldn\'t be resized because it wasn\'t a valid image.'; return false; }

    if (($w <= $max_width) && ($h <= $max_height)) { return $image; } //no resizing needed
    
    //try max width first...
    $ratio = $max_width / $w;
    $new_w = $max_width;
    $new_h = $h * $ratio;
    
    //if that didn't work
    if ($new_h > $max_height) {
        $ratio = $max_height / $h;
        $new_h = $max_height;
        $new_w = $w * $ratio;
    }
    
    $new_image = imagecreatetruecolor ($new_w, $new_h);
    imagecopyresampled($new_image,$image, 0, 0, 0, 0, $new_w, $new_h, $w, $h);
    return $new_image;
}



function resize_image_force($image,$width,$height) {
    $w = @imagesx($image); //current width
    $h = @imagesy($image); //current height
    if ((!$w) || (!$h)) { $GLOBALS['errors'][] = 'Image couldn\'t be resized because it wasn\'t a valid image.'; return false; }
    if (($w == $width) && ($h == $height)) { return $image; } //no resizing needed

    $image2 = imagecreatetruecolor ($width, $height);
    imagecopyresampled($image2,$image, 0, 0, 0, 0, $width, $height, $w, $h);

    return $image2;
}


function resize_image($method,$image_loc,$new_loc,$width,$height) {

/*echo $method;
echo"<br>". $image_loc;
echo "<br>source image=".$new_loc;
echo"<br>". $width;
echo"<br>". $height; exit;
*/
    if (!is_array(@$GLOBALS['errors'])) { $GLOBALS['errors'] = array(); }
    
    if (!in_array($method,array('force','max','crop'))) { $GLOBALS['errors'][] = 'Invalid method selected.'; }
    
    if (!$image_loc) { $GLOBALS['errors'][] = 'No source image location specified.'; }
    else {
        if ((substr(strtolower($image_loc),0,7) == 'http://') || (substr(strtolower($image_loc),0,7) == 'https://')) { /*don't check to see if file exists since it's not local*/ }
        elseif (!file_exists($image_loc)) { $GLOBALS['errors'][] = 'Image source file does not exist.'; }
        $extension = strtolower(substr($image_loc,strrpos($image_loc,'.')));
		//echo $extension;exit;
        if (!in_array($extension,array('.jpg','.jpeg','.png','.gif','.bmp'))) { $GLOBALS['errors'][] = 'Invalid source file extension!'; }
    }
    
    if (!$new_loc) { $GLOBALS['errors'][] = 'No destination image location specified.'; }
    else {
        $new_extension = strtolower(substr($new_loc,strrpos($new_loc,'.')));
		//echo"new==". $new_extension; exit;
        if (!in_array($new_extension,array('.jpg','.jpeg','.png','.gif','.bmp'))) { $GLOBALS['errors'][] = 'Invalid destination file extension!'; }
    }

    $width = abs(intval($width));
	//echo $width; exit;
    if (!$width) { $GLOBALS['errors'][] = 'No width specified!'; }
    
    $height = abs(intval($height));
	//echo"height====". $height; exit;
    if (!$height) { $GLOBALS['errors'][] = 'No height specified!'; }
    print_r($GLOBALS['errors']); exit;
    if (count($GLOBALS['errors']) > 0) { echo_errors(); return false; }
	
    if (in_array($extension,array('.jpg','.jpeg'))) { $image = @imagecreatefromjpeg($image_loc); }
    elseif ($extension == '.png') { $image = @imagecreatefrompng($image_loc); }
    elseif ($extension == '.gif') { $image = @imagecreatefromgif($image_loc); }
    elseif ($extension == '.bmp') { $image = @imagecreatefromwbmp($image_loc); }
    echo $image; exit;
    if (!$image) { $GLOBALS['errors'][] = 'Image could not be generated!'; }
    else {
        $current_width = imagesx($image);
        $current_height = imagesy($image);
        if ((!$current_width) || (!$current_height)) { $GLOBALS['errors'][] = 'Generated image has invalid dimensions!'; }
    }
    if (count($GLOBALS['errors']) > 0) { @imagedestroy($image); echo_errors(); return false; }

    if ($method == 'force') { $new_image = resize_image_force($image,$width,$height); }
    elseif ($method == 'max') { $new_image = resize_image_max($image,$width,$height); }
    elseif ($method == 'crop') { $new_image = resize_image_crop($image,$width,$height); }
    
    if ((!$new_image) && (count($GLOBALS['errors'] == 0))) { $GLOBALS['errors'][] = 'New image could not be generated!'; }
    if (count($GLOBALS['errors']) > 0) { @imagedestroy($image); echo_errors(); return false; }
    
    $save_error = false;
    if (in_array($extension,array('.jpg','.jpeg'))) { imagejpeg($new_image,$new_loc) or ($save_error = true); }
    elseif ($extension == '.png') { imagepng($new_image,$new_loc) or ($save_error = true); }
    elseif ($extension == '.gif') { imagegif($new_image,$new_loc) or ($save_error = true); }
    elseif ($extension == '.bmp') { imagewbmp($new_image,$new_loc) or ($save_error = true); }
    if ($save_error) { $GLOBALS['errors'][] = 'New image could not be saved!'; }
    if (count($GLOBALS['errors']) > 0) { @imagedestroy($image); @imagedestroy($new_image); echo_errors(); return false; }

    imagedestroy($image);
    imagedestroy($new_image);
    
    return true;
}

function echo_errors() {
    if (!is_array(@$GLOBALS['errors'])) { $GLOBALS['errors'] = array('Unknown error!'); }
    foreach ($GLOBALS['errors'] as $error) { echo '<p style="color:red;font-weight:bold;">Error: '.$error.'</p>'; }
}
//*********************
// Usage example to find the proper dimensions to resize an image down to 300x400 pixels maximum: 


// Calculates restricted dimensions with a maximum of $goal_width by $goal_height 
function resize_dimensions($goal_width,$goal_height,$width,$height) { 
    $return = array('width' => $width, 'height' => $height); 

    // If the ratio > goal ratio and the width > goal width resize down to goal width 
    if ($width/$height > $goal_width/$goal_height && $width > $goal_width) { 
        $return['width'] = $goal_width; 
        $return['height'] = $goal_width/$width * $height; 
    } 
    // Otherwise, if the height > goal, resize down to goal height 
    else if ($height > $goal_height) { 
        $return['width'] = $goal_height/$height * $width; 
        $return['height'] = $goal_height; 
    } 

    return $return; 
}


?>