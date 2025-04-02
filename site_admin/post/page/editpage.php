<?php
require_once('../../admin_connect.php');

if(isset($_POST['submit'])){

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
    $p_image = escape($_POST['p_image']);
    $uid = $_SESSION['user']['id'];
    $is_active = $_POST['is_active'];
    $postVisibility = $_POST['postVisibility'];
    $page_id = $_POST['page_id'];

    $sql = "UPDATE `pages` SET 
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
        `visibility` = '$postVisibility',
        `updatedon` = NOW(),
        `catid` = '$ctname'
        WHERE `pages`.`pid` = ".$page_id;

    $id = Update($sql);


    if($id > 0){


        // Handle dynamic attributes
        if (isset($_POST['attributes'])) {
            $attributes = json_decode($_POST['attributes'], true);
            
            // Delete existing attributes for this page
            Delete("DELETE FROM page_attribute_values WHERE page_id  = $page_id");
            
            // Insert new attribute values
            foreach ($attributes as $attrId => $value) {
                $attrId = (int)$attrId;
                $value = escape($value);
                
                if (!empty($value)) {
                    Insert("INSERT INTO page_attribute_values (page_id, attribute_id, attribute_value) 
                           VALUES ($page_id, $attrId, '$value')");
                }
            }
        }

        // Upload Images
        if (isset($_FILES['images'])) {
            $countfiles = count($_FILES['images']['name']);

            for ($i = 0; $i < $countfiles; $i++) {
                $filename = $_FILES['images']['name'][$i];
                $temp = explode(".", $filename);
                $temp1 = strtolower(end($temp));
                $newfilename = $temp[0] . "_" . uniqid() . '.' . $temp1;
                $newfilename = clean($newfilename);

                // Move the uploaded file
                $tvb = move_uploaded_file($_FILES['images']['tmp_name'][$i], '../../../' . ABSOLUTE_IMAGEPATH . $newfilename);

                if ($tvb == 1) {
                    // Insert file details into the database
                    $sql1 = "INSERT INTO `images` (`pid`, `i_name`, `isactive`, `soft_delete`) VALUES ('$page_id', '$newfilename', '1', '0')";
                    $id1 = Insert($sql1);
                }
            }
        }

        // Upload Videos
        if (isset($_FILES['videos'])) {
            $countfiles = count($_FILES['videos']['name']);

            for ($i = 0; $i < $countfiles; $i++) {
                $filename = $_FILES['videos']['name'][$i];
                $temp = explode(".", $filename);
                $temp1 = strtolower(end($temp));
                $newfilename = $temp[0] . "_" . uniqid() . '.' . $temp1;
                $newfilename = clean($newfilename);

                // Move the uploaded file
                $tvb = move_uploaded_file($_FILES['videos']['tmp_name'][$i], '../../../' . ABSOLUTE_VIDEOPATH . $newfilename);

                if ($tvb == 1) {
                    // Insert file details into the database
                    $sql1 = "INSERT INTO `videos` (`pid`, `v_name`, `isactive`, `soft_delete`) VALUES ('$page_id', '$newfilename', '1', '0')";
                    $id1 = Insert($sql1);
                }
            }
        }

        // Upload Files
        if (isset($_FILES['page_files'])) {
            $countfiles = count($_FILES['page_files']['name']);

            for ($i = 0; $i < $countfiles; $i++) {
                $filename = $_FILES['page_files']['name'][$i];
                $temp = explode(".", $filename);
                $temp1 = strtolower(end($temp));
                $newfilename = $temp[0] . "_" . uniqid() . '.' . $temp1;
                $newfilename = clean($newfilename);

                // Move the uploaded file
                $tvb = move_uploaded_file($_FILES['page_files']['tmp_name'][$i], '../../../' . ABSOLUTE_FILEPATH . $newfilename);

                if ($tvb == 1) {
                    // Insert file details into the database
                    $sql1 = "INSERT INTO `page_files` (`pid`, `f_name`, `isactive`, `soft_delete`) VALUES ('$page_id', '$newfilename', '1', '0')";
                    $id1 = Insert($sql1);
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