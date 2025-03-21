<?php
require_once('../../admin_connect.php');

if(isset($_POST['submit'])){

    // Existing fields
    $ctname = $_POST['ctname'];    
    $page_title = escape($_POST['page_title']);
    $page_url = $_POST['page_url'];
    $template_page = $_POST['template_page'];
    $site_template = $_POST['site_template'];
    $showInNavbar = $_POST['showInNavbar'];
    $editor1 = escape($_POST['editor1']);
    $meta_title = escape($_POST['meta_title']);
    $meta_keywords = escape($_POST['meta_keywords']);
    $meta_desc = escape($_POST['meta_desc']);
    $header = escape($_POST['header']);
    $p_image = escape($_POST['p_image']);
    $uid = $_SESSION['user']['id'];
    $is_active = $_POST['is_active'];
    $page_id = $_POST['page_id'];

    // New fields
    $sale_start_date = escape($_POST['sale_start_date']);
    $sale_end_date = escape($_POST['sale_end_date']);
    $brand = escape($_POST['brand']);
    $type = escape($_POST['type']);
    $condition = escape($_POST['condition']);
    $warranty = escape($_POST['warranty']);
    $model = escape($_POST['model']);
    $features = escape($_POST['features']);
    $color = escape($_POST['color']);
    $seller_notes = escape($_POST['seller_notes']);
    $shipping_info = escape($_POST['shipping_info']);
    $weight = escape($_POST['weight']);
    $length = escape($_POST['length']);
    $width = escape($_POST['width']);
    $height = escape($_POST['height']);
    $return_policy = escape($_POST['return_policy']);

    // Flags
    $Instock = isset($_POST['Instock']) ? 1 : 0;
    $NewArrival = isset($_POST['NewArrival']) ? 1 : 0;
    $FeaturedProduct = isset($_POST['FeaturedProduct']) ? 1 : 0;
    $OnSale = isset($_POST['OnSale']) ? 1 : 0;
    $BestSeller = isset($_POST['BestSeller']) ? 1 : 0;
    $TrendingItem = isset($_POST['TrendingItem']) ? 1 : 0;
    $HotItem = isset($_POST['HotItem']) ? 1 : 0;

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
        `page_meta_desc` = '$meta_desc',
        `showInNavBar` = '$showInNavbar',
        `featured_image` = '$p_image',
        `isactive` = '$is_active',
        `sale_start_date` = '$sale_start_date',
        `sale_end_date` = '$sale_end_date',
        `brand` = '$brand',
        `type` = '$type',
        `condition` = '$condition',
        `warranty` = '$warranty',
        `model` = '$model',
        `features` = '$features',
        `color` = '$color',
        `seller_notes` = '$seller_notes',
        `shipping_info` = '$shipping_info',
        `weight` = '$weight',
        `length` = '$length',
        `width` = '$width',
        `height` = '$height',
        `return_policy` = '$return_policy',
        `stock_status` = '$Instock',
        `new_arrivals` = '$NewArrival',
        `featured_product` = '$FeaturedProduct',
        `on_sale` = '$OnSale',
        `best_seller` = '$BestSeller',
        `trending_item` = '$TrendingItem',
        `hot_item` = '$HotItem',
        `updatedon` = NOW() 
        WHERE `pages`.`pid` = ".$page_id;

    $id = Update($sql);

    if($id > 0){
        if(isset($_FILES['files'])){
            $countfiles = count($_FILES['files']['name']);
            for($i=0;$i<$countfiles;$i++){
                $filename = $_FILES['files']['name'][$i];
                $temp = explode(".", $filename);
                $temp1 = strtolower(end($temp));
                $newfilename  =  $temp[0]."_".uniqid().'.'.$temp1;
                $newfilename = clean($newfilename);
                $tvb =  move_uploaded_file($_FILES['files']['tmp_name'][$i], '../../../'.ABSOLUTE_IMAGEPATH.$newfilename);
                if($tvb == 1){
                    $sql1 ="INSERT INTO `images` ( `pid`, `i_name`, `isactive`, `soft_delete`) VALUES ( '$page_id', '$newfilename', '1', '0')";
                    $id1 = Insert($sql1);
                }
            }
        }


      // Delete all existing entries for the given page_id
        Delete("DELETE FROM page_category WHERE page_id = $page_id");

        // Handle selected categories
        if (isset($_POST['selectedcategory_list']) && !empty($_POST['selectedcategory_list'])) {
            // Convert the comma-separated string into an array
            $selectedcategory_lists = explode(',', $_POST['selectedcategory_list']);

            foreach ($selectedcategory_lists as $selectedcategory_list) {
                // Ensure the category ID is not empty
                if (!empty($selectedcategory_list)) {
                    $selectedcategory_list = escape($selectedcategory_list); // Assuming `escape` is a function to sanitize input

                    // Insert the new entry
                    $sql = "INSERT INTO `page_category` (`page_id`, `cat_id`, `isactive`) VALUES ('$page_id', '$selectedcategory_list', '1')";
                    Insert($sql);
                }
            }
        }

        echo $id;

    } else {
        echo "0";
    }
}
?>