<?php
include '../../admin_connect.php';

$file_arr = array();
 
 $path = __DIR__ . '/../../../'.ABSOLUTE_IMAGEPATH;

 $handle = opendir($path);


  while($file = readdir($handle)){


    if($file !== '.' && $file !== '..'){
    	
    	$file_arr_;
    	
    	if(file_exists($path."/".$file)){

    		if(filesize($path."/".$file) != 0){

    				 	if(exif_imagetype($path."/".$file)){

								$image_info = getimagesize($path."/".$file);

								$file_arr_['file_name'] = $file;
								$file_arr_['file_info'] = $image_info;
								$file_arr_['file_path'] = BASE_URL.ABSOLUTE_IMAGEPATH.$file;
								array_push($file_arr ,$file_arr_);
			    	}

    		}

    	}
		
    }

}
  echo json_encode($file_arr , TRUE);
