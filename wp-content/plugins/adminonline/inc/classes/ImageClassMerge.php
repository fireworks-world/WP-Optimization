<?php
  ini_set('memory_limit', '256M');
  ini_set('post_max_size', '64M');
  ini_set('upload_max_filesize', '256M');
class  ImageClass
{
  private  $width,$height,$type,$attr,$ext,$source,$target;
  private  $img_width,$modwidth,$modheight,$diff,$image,$tn;
  private  $before_width,$before_height,$after_width,$after_height;
  private  $final_width,$final_height,$new_width,$new_height,$src,$imgBuf,$links,$iTmp,$iOut,$white;
  public   $before_path,$after_path,$merge_path;
 
 public function mergeImages($merge_path,$before_path,$after_path)
  {
  					  list($this->before_width,$this->before_height)= @getimagesize($before_path); 
					  list($this->after_width,$this->after_height)= @getimagesize($after_path); 
					  $this->final_width=$this->before_width;							
	    				  $this->final_height = ($this->before_height > $this->after_height) ?  $this->before_height : $this->after_height;														
					  $this->src = array ($before_path,$after_path);   							
					  $this->imgBuf = array ();
							foreach ($this->src as $this->links)
								{
 								     switch(substr ($this->links,strrpos ($this->links,".")+1))
  									 {
   										case 'png':
   									        $this->iTmp = @imagecreatefrompng($this->links);
      									        break;
     										case 'gif':
          									$this->iTmp = @imagecreatefromgif($this->links);
        									break;               
      										case 'jpeg':           
     										case 'jpg':
    									    $this->iTmp = @imagecreatefromjpeg($this->links);
         									break;               
   									}
      						   array_push ($this->imgBuf,$this->iTmp);
                          }
						  

                             $this->new_width = (($this->final_width)*2)+20;  
                              $this->new_height = $this->final_height+10; 							  
                              $this->iOut = @imagecreatetruecolor ($this->new_width,$this->new_height) ;
                              $this->white = @imagecolorallocate($this->iOut, 255, 255, 255);
                              @imagefill($this->iOut , 0, 0, $this->white);							
			      @imagecopy ($this->iOut,$this->imgBuf[0],5,5,0,0,$this->before_width,$this->before_height);
			      @imagedestroy ($this->imgBuf[0]);
                              @imagecopy ($this->iOut,$this->imgBuf[1],($this->before_width+15),5,0,0,$this->after_width,$this->after_height);
                              @imagedestroy ($this->imgBuf[1]);   
                              $this->merge_path=$merge_path.date(dmY).date(His).".jpg";                         
	                      $this->tn = @imagecreatetruecolor($this->new_width, $this->new_height); 	
	                      @imagecopyresampled($this->tn, $this->iOut, 0, 0, 0, 0, $this->new_width, $this->new_height, $this->new_width, $this->new_height) ; 
	                      @imagejpeg($this->tn, $this->merge_path, 80);					  
  }
   
}
?>