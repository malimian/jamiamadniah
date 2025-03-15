<?php 
session_start();

include '../../admin_connect.php';


$path = __DIR__ . '/../../../'.ABSOLUTE_IMAGEPATH;

if(isset($_POST['upload_image'])){

	$file_name = "";
	
	if(isset($_FILES['file']["tmp_name"])){

		$file_arr_;
		$file_name = upload_image($path);
		$file_arr_['file_name'] =$file_name;
		$file_arr_['file_path'] = ABSOLUTE_IMAGEPATH.$file_name;

		echo json_encode($file_arr_);	

	}else echo "0";
	
}



if(isset($_POST['delete_file_submit'])){
	
	$file_name = $_POST['filename'];
	echo unlink($path.$file_name);
}


?>