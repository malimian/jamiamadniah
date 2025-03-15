<?php
require_once('../../admin_connect.php');

if(isset($_POST['submit'])){




$ctname =$_POST['ctname'];    
$page_title = escape($_POST['page_title']);
$page_url =$_POST['page_url'];
$header = escape($_POST['header']);
$template_page =$_POST['template_page'];
$site_template =$_POST['site_template'];
$showInNavbar =$_POST['showInNavbar'];
$editor1 =escape($_POST['editor1']);
$meta_title =escape($_POST['meta_title']);
$meta_keywords =escape($_POST['meta_keywords']);
$meta_desc =escape($_POST['meta_desc']);
$featured_image =escape($_POST['featured_image']);
$uid = $_SESSION['user']['id'];
$is_active =$_POST['is_active'];
$sku = escape($_POST['sku']);


$Instock =$_POST['Instock'];
$NewArrival =$_POST['NewArrival'];
$FeaturedProduct =$_POST['FeaturedProduct'];
$OnSale =$_POST['OnSale'];
$BestSeller =$_POST['BestSeller'];
$TrendingItem =$_POST['TrendingItem'];
$HotItem =$_POST['HotItem'];


$plistprice =$_POST['plistprice'];
$pprice =$_POST['pprice'];


$get_last_page_sequence = return_single_ans("Select Count(pid) from pages $where_gc");

$sql = "INSERT INTO `pages` ( `catid`, `page_url`, `template_id`,`site_template_id`, `page_title`, `page_desc`, `page_meta_title`, `page_meta_keywords`, `page_meta_desc`, `isactive` , pages_sequence , createdby , featured_image, stock_status , new_arrivals , featured_product , on_sale , best_seller , trending_item , hot_item , sku , header , plistprice , pprice ) VALUES
	 ('$ctname', '$page_url', '$template_page', '$site_template' ,'$page_title', '$editor1', '$meta_title', '$meta_keywords', '$meta_desc', '$is_active' , '$get_last_page_sequence' , '$uid' , 
	 	'$featured_image',
	 	'$Instock','$NewArrival','$FeaturedProduct','$OnSale','$BestSeller','$TrendingItem','$HotItem' , '$sku' , '$header' , '$plistprice' , '$pprice'
	)";


$id = Insert($sql);

if($id > 0) {
    
    
     $countfiles = 0;
    
     if(!empty($_FILES['files']))
        $countfiles = count($_FILES['files']['name']);

     // Looping all files
     for($i=0;$i<$countfiles;$i++){
         
      $filename = $_FILES['files']['name'][$i];
      
      $temp = explode(".", $filename);
    
      $newfilename  =  $temp[0]."_".uniqid().'.'.end($temp);
    
      $newfilename = clean($newfilename);
      
      // Upload file
        $tvb =  move_uploaded_file($_FILES['files']['tmp_name'][$i], '../../../'.ABSOLUTE_IMAGEPATH.$newfilename);
        
        if($tvb == 1){
            $sql1 ="INSERT INTO `images` ( `pid`, `i_name`, `isactive`, `soft_delete`) VALUES ( '$id', '$newfilename', '1', '0')";
            $id1 = Insert($sql1);
        }
     
     }

    
    if(!empty($_POST['selectedcategory_list'])){
            $selectedcategory_lists = $_POST['selectedcategory_list'];
            $selectedcategory_lists = explode(',', $selectedcategory_lists);
    		
    		foreach ($selectedcategory_lists as $selectedcategory_list) {
    		
    		if(!empty($selectedcategory_list)){
    		        		$sql ="INSERT INTO `page_category` (`page_id`, `cat_id`, `isactive`) VALUES ( '$id', '$selectedcategory_list', '1');";    
    	                    Insert($sql);
    		}

    	}
     }
    
    
    echo json_encode(return_single_row("Select pid , page_url , page_title from pages Where pid = $id and soft_delete = 0 "));
    
}
else echo "0";


}

?>