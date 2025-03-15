<?php
require_once('../../admin_connect.php');

if(isset($_POST['submit'])){


$ctname =$_POST['ctname'];    
$page_title = escape($_POST['page_title']);
$page_url =$_POST['page_url'];
$template_page =$_POST['template_page'];
$site_template =$_POST['site_template'];
$showInNavbar =$_POST['showInNavbar'];
$editor1 =escape($_POST['editor1']);
$meta_title =escape($_POST['meta_title']);
$meta_keywords =escape($_POST['meta_keywords']);
$meta_desc =escape($_POST['meta_desc']);
$header =escape($_POST['header']);
$p_image =escape($_POST['p_image']);
$uid = $_SESSION['user']['id'];
$is_active =$_POST['is_active'];
$page_id =$_POST['page_id'];


$sql = "UPDATE `pages` SET 
 `catid` = '$ctname',
  `page_url` = '$page_url',
  `template_id` = '$template_page',
  `site_template_id` = '$site_template',
   `page_title` = '$page_title',
    `page_desc` = '$editor1',
    `header` = '$header',
     `page_meta_title` = '$meta_title',
      `page_meta_keywords` = '$meta_keywords',
       `page_meta_desc` = '$meta_desc' ,
         `showInNavBar` = '$showInNavbar',
         `featured_image` = '$p_image',
          `isactive` = '$is_active',
          `updatedon` = NOW() 
        WHERE `pages`.`pid` = ".$page_id;



$id = Update($sql);
if($id > 0){
    
    if(isset($_FILES['files'])){
        
     $countfiles = count($_FILES['files']['name']);

     // Looping all files
     for($i=0;$i<$countfiles;$i++){
         
      $filename = $_FILES['files']['name'][$i];
      
      $temp = explode(".", $filename);
      $temp1 = strtolower(end($temp));
    
      $newfilename  =  $temp[0]."_".uniqid().'.'.$temp1;
    
      $newfilename = clean($newfilename);
      
      
      // Upload file
        $tvb =  move_uploaded_file($_FILES['files']['tmp_name'][$i], '../../../'.ABSOLUTE_IMAGEPATH.$newfilename);
        
        if($tvb == 1){
            $sql1 ="INSERT INTO `images` ( `pid`, `i_name`, `isactive`, `soft_delete`) VALUES ( '$page_id', '$newfilename', '1', '0')";
            $id1 = Insert($sql1);
        }
         
     }
    }
   
    
    
    echo $id;
    
}
else echo "0";


}

?>