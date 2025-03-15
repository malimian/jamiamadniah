<?php

require_once('../../admin_connect.php');

$path = __DIR__ . '/../../../';


if (!isset($_GET['type'])) exit;

// Parameters
$type = $_GET['type'];
$CKEditor = $_GET['CKEditor'];
$funcNum = $_GET['CKEditorFuncNum'];

// Image upload
if($type == 'image'){

    $allowed_extension = array(
      "png","jpg","jpeg","gif"
    );

    // Get image file extension
    $file_extension = pathinfo($_FILES["upload"]["name"], PATHINFO_EXTENSION);

    if(in_array(strtolower($file_extension),$allowed_extension)){

      $temp = explode(".", $_FILES["upload"]["name"]);

      $newfilename = md5(round(microtime(true))) . '.' . end($temp); 

       if(move_uploaded_file($_FILES['upload']['tmp_name'], $path.ABSOLUTE_IMAGEPATH.$newfilename)){
          // File path
          
          $url = BASE_URL.ABSOLUTE_IMAGEPATH.$newfilename;
       
          echo '<script>window.parent.CKEDITOR.tools.callFunction('.$funcNum.', "'.$url.'", "'.$message.'")</script>';
       }

    }

    exit;
} 

// File upload
if($type == 'file'){

    $allowed_extension = array(
       "doc","pdf","docx","txt","epub"
    );

    // Get image file extension
    $file_extension = pathinfo($_FILES["upload"]["name"], PATHINFO_EXTENSION);

    if(in_array(strtolower($file_extension),$allowed_extension)){

      $temp = explode(".", $_FILES["upload"]["name"]);

      $newfilename = md5(round(microtime(true))) . '.' . end($temp); 

       if(move_uploaded_file($_FILES['upload']['tmp_name'], $path.ABSOLUTE_FILEPATH.$newfilename)){
          // File path
   
          $url = BASE_URL.ABSOLUTE_FILEPATH.$newfilename;
         
          echo '<script>window.parent.CKEDITOR.tools.callFunction('.$funcNum.', "'.$url.'", "'.$message.'")</script>';
       }

    }

    exit;
}