<?php
require_once('../../admin_connect.php');

if (isset($_POST['submit'])) {
    // Existing fields
    $ctname = $_POST['ctname'];
    $page_title = escape($_POST['page_title']);
    $page_url = $_POST['page_url'];
    $header = escape($_POST['header']);
    $template_page = $_POST['template_page'];
    $site_template = $_POST['site_template'];
    $showInNavbar = $_POST['showInNavbar'];
    $editor1 = escape($_POST['editor1']);
    $meta_title = escape($_POST['meta_title']);
    $meta_keywords = escape($_POST['meta_keywords']);
    $meta_desc = escape($_POST['meta_desc']);
    $featured_image = escape($_POST['featured_image']);
    $uid = $_SESSION['user']['id'];
    $is_active = $_POST['is_active'];
    $sku = escape($_POST['sku']);

    // Flags
    $Instock = $_POST['Instock'];
    $NewArrival = $_POST['NewArrival'];
    $FeaturedProduct = $_POST['FeaturedProduct'];
    $OnSale = $_POST['OnSale'];
    $BestSeller = $_POST['BestSeller'];
    $TrendingItem = $_POST['TrendingItem'];
    $HotItem = $_POST['HotItem'];

    // Pricing
    $plistprice = $_POST['plistprice'];
    $pprice = $_POST['pprice'];

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

    // Get the last page sequence
    $get_last_page_sequence = return_single_ans("SELECT COUNT(pid) FROM pages");

    // Insert query with all fields
    $sql = "INSERT INTO `pages` (
        `catid`, `page_url`, `template_id`, `site_template_id`, `page_title`, `page_desc`, `page_meta_title`, `page_meta_keywords`, `page_meta_desc`, `isactive`, `pages_sequence`, `createdby`, `featured_image`, 
        `stock_status`, `new_arrivals`, `featured_product`, `on_sale`, `best_seller`, `trending_item`, `hot_item`, `sku`, `header`, `plistprice`, `pprice`, 
        `sale_start_date`, `sale_end_date`, `brand`, `type`, `condition`, `warranty`, `model`, `features`, `color`, `seller_notes`, `shipping_info`, `weight`, `length`, `width`, `height`, `return_policy`
    ) VALUES (
        '$ctname', '$page_url', '$template_page', '$site_template', '$page_title', '$editor1', '$meta_title', '$meta_keywords', '$meta_desc', '$is_active', '$get_last_page_sequence', '$uid', 
        '$featured_image', 
        '$Instock', '$NewArrival', '$FeaturedProduct', '$OnSale', '$BestSeller', '$TrendingItem', '$HotItem', '$sku', '$header', '$plistprice', '$pprice', 
        '$sale_start_date', '$sale_end_date', '$brand', '$type', '$condition', '$warranty', '$model', '$features', '$color', '$seller_notes', '$shipping_info', '$weight', '$length', '$width', '$height', '$return_policy'
    )";

    // Execute the query
    $id = Insert($sql);

    if ($id > 0) {
        // Handle file uploads
        $countfiles = 0;
        if (!empty($_FILES['files'])) {
            $countfiles = count($_FILES['files']['name']);
        }

        // Loop through all files
        for ($i = 0; $i < $countfiles; $i++) {
            $filename = $_FILES['files']['name'][$i];
            $temp = explode(".", $filename);
            $newfilename = $temp[0] . "_" . uniqid() . '.' . end($temp);
            $newfilename = clean($newfilename);

            // Upload file
            $tvb = move_uploaded_file($_FILES['files']['tmp_name'][$i], '../../../' . ABSOLUTE_IMAGEPATH . $newfilename);

            if ($tvb == 1) {
                $sql1 = "INSERT INTO `images` (`pid`, `i_name`, `isactive`, `soft_delete`) VALUES ('$id', '$newfilename', '1', '0')";
                $id1 = Insert($sql1);
            }
        }

        // Handle selected categories
        if (!empty($_POST['selectedcategory_list'])) {
            $selectedcategory_lists = $_POST['selectedcategory_list'];
            $selectedcategory_lists = explode(',', $selectedcategory_lists);

            foreach ($selectedcategory_lists as $selectedcategory_list) {
                if (!empty($selectedcategory_list)) {
                    $sql = "INSERT INTO `page_category` (`page_id`, `cat_id`, `isactive`) VALUES ('$id', '$selectedcategory_list', '1')";
                    Insert($sql);
                }
            }
        }

        // Return success response
        echo json_encode(return_single_row("SELECT pid, page_url, page_title FROM pages WHERE pid = $id AND soft_delete = 0"));
    } else {
        echo "0";
    }
}
?>