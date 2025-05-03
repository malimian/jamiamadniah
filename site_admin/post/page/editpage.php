<?php
require_once('../../admin_connect.php');

if(isset($_POST['submit'])) {
    // Existing fields
    $page_title = escape($_POST['page_title']);
    $page_url = $_POST['page_url'];
    $ctname = $_POST['ctname'];
    $template_page = $_POST['template_page'];
    $site_template = $_POST['site_template'];
    $showInNavbar = $_POST['showInNavbar'];
    $editor1 = escape($_POST['editor1']);
    $meta_title = escape($_POST['meta_title']);
    $meta_keywords = escape($_POST['meta_keywords']);
    $meta_desc = escape($_POST['meta_desc']);
    $header = escape($_POST['header']);
    $menu_content = escape($_POST['menu_content']);
    $footer_content = escape($_POST['footer_content']);
    $scripts_content = escape($_POST['scripts_content']);
    $p_image = escape($_POST['p_image']);
    $uid = $_SESSION['user']['id'];
    $is_active = $_POST['is_active'];
    $postVisibility = $_POST['postVisibility'];
    $page_id = $_POST['page_id'];
    $useCKEditor = (int)$_POST['useCKEditor'];


    $sql = "UPDATE `pages` SET 
        `page_url` = '$page_url',
        `template_id` = '$template_page',
        `site_template_id` = '$site_template',
        `page_title` = '$page_title',
        `page_desc` = '$editor1',
        `header` = '$header',
        `menu` = '$menu_content',
        `footer` = '$footer_content',
        `scripts` = '$scripts_content',
        `page_meta_title` = '$meta_title',
        `page_meta_keywords` = '$meta_keywords',
        `page_meta_desc` = '$meta_desc',
        `showInNavBar` = '$showInNavbar',
        `featured_image` = '$p_image',
        `isactive` = '$is_active',
        `visibility` = '$postVisibility',
        `useCKEditor` = '$useCKEditor',
        `updatedon` = NOW(), 
        `catid` = '$ctname'
        WHERE `pages`.`pid` = ".$page_id;

    $id = Update($sql);

    if($id > 0) {
        // Handle dynamic attributes
     if (isset($_POST['attributes']) && !empty($_POST['attributes'])) {
       
        $attributes = json_decode($_POST['attributes'], true);
        
        // Delete existing attributes for this page
        Delete("DELETE FROM page_attribute_values WHERE page_id = $page_id");
        
        // Insert new attribute values
        foreach ($attributes as $attrId => $values) {
            $attrId = (int)$attrId;
            
            // Ensure $values is always an array
            if (!is_array($values)) {
                $values = [$values];
            }
            
            foreach ($values as $value) {
                $value = escape($value);
                if ($value !== '' && $value !== null) {
                    Insert("INSERT INTO page_attribute_values (page_id, attribute_id, attribute_value) 
                           VALUES ($page_id, $attrId, '$value')");
                }
            }
        }
    }

        // Handle categories
        Delete("DELETE FROM page_category WHERE page_id = $page_id");
        if (isset($_POST['selectedcategory_list']) && !empty($_POST['selectedcategory_list'])) {
            $selectedcategory_lists = explode(',', $_POST['selectedcategory_list']);
            foreach ($selectedcategory_lists as $selectedcategory_list) {
                if (!empty($selectedcategory_list)) {
                    $selectedcategory_list = escape($selectedcategory_list);
                    $sql = "INSERT INTO `page_category` (`page_id`, `cat_id`, `isactive`) 
                            VALUES ('$page_id', '$selectedcategory_list', '1')";
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