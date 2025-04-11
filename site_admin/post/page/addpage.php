<?php
require_once('../../admin_connect.php');

// Check if user has Add permission (og_moduleactions_id = 2)
$hasAddPermission = false;
if (isset($_SESSION['user']['module_actions'])) {
    foreach ($_SESSION['user']['module_actions'] as $action) {
        if ($action['og_moduleactions_id'] == 2 && $action['title'] == 'Add') {
            $hasAddPermission = true;
            break;
        }
    }
}

if (!$hasAddPermission) {
    echo json_encode([
        'status' => 'error',
        'message' => 'You do not have permission to add/duplicate pages'
    ]);
    exit;
}

if (isset($_POST['submit'])) {
    // Required field validation
    $required_fields = ['page_title', 'page_url', 'ctname', 'template_page', 'site_template'];
    foreach ($required_fields as $field) {
        if (empty($_POST[$field])) {
            die(json_encode([
                'status' => 'error',
                'message' => 'Please fill all required fields',
                'field' => $field
            ]));
        }
    }

    // Process and validate inputs
    $ctname = (int)$_POST['ctname'];
    $page_title = escape(trim($_POST['page_title']));
    $original_url = escape(trim($_POST['page_url']));
    $template_page = (int)$_POST['template_page'];
    $site_template = (int)$_POST['site_template'];
    $featured_image = escape($_POST['p_image'] ?? '');
    $uid = (int)$_SESSION['user']['id'];
    $original_page_id = isset($_POST['original_page_id']) ? (int)$_POST['original_page_id'] : 0;

    // Normalize URL format
    $base_url = preg_replace('/\.html$/i', '', $original_url);
    $proposed_url = $base_url . '.html';
    $final_url = $proposed_url;
    $url_adjusted = false;

    // Check for existing URLs and generate unique version if needed
    $counter = 1;
    while (return_single_ans("SELECT 1 FROM pages WHERE page_url = '$final_url' AND soft_delete = 0 LIMIT 1")) {
        $final_url = $base_url . '-' . $counter . '.html';
        $counter++;
        $url_adjusted = true;
    }

    // Insert the new page
    $seq = (int)return_single_ans("SELECT COUNT(pid) FROM pages");
    $sql = "INSERT INTO pages (
        catid, page_url, template_id, site_template_id, 
        page_title, featured_image, pages_sequence, isactive, createdby, createdon
    ) VALUES (
        '$ctname', '$final_url', '$template_page', '$site_template',
        '$page_title', '$featured_image', '$seq', '0', '$uid', NOW()
    )";

    $id = Insert($sql);
    
    if ($id > 0) {
        // If duplicating a page, copy the selected elements
        if ($original_page_id > 0) {
            $copy_images = isset($_POST['copy_images']) && $_POST['copy_images'] == 1;
            $copy_videos = isset($_POST['copy_videos']) && $_POST['copy_videos'] == 1;
            $copy_documents = isset($_POST['copy_documents']) && $_POST['copy_documents'] == 1;
            $copy_addons = isset($_POST['copy_addons']) && $_POST['copy_addons'] == 1;
            $copy_attributes = isset($_POST['copy_attributes']) && $_POST['copy_attributes'] == 1;

            // Copy images if requested
            if ($copy_images) {
                $images = return_multiple_rows("
                    SELECT * FROM images 
                    WHERE pid = $original_page_id 
                    AND soft_delete = 0
                ");
                
                foreach ($images as $image) {
                    $next_sequence = (int)return_single_ans("SELECT MAX(i_sequence) FROM images WHERE pid = $id") + 1;
                    $sql = "INSERT INTO `images` 
                            (`pid`, `i_name`, `i_title`, `i_caption`, `i_alttext`, `i_description`, `i_sequence`, `isactive`, `soft_delete`) 
                            VALUES 
                            ('$id', 
                             '" . escape($image['i_name']) . "', 
                             '" . escape($image['i_title']) . "', 
                             '" . escape($image['i_caption']) . "', 
                             '" . escape($image['i_alttext']) . "', 
                             '" . escape($image['i_description']) . "', 
                             '$next_sequence', 
                             '1', 
                             '0')";
                    Insert($sql);
                }
            }

            // Copy videos if requested
            if ($copy_videos) {
                $videos = return_multiple_rows("
                    SELECT * FROM videos 
                    WHERE pid = $original_page_id 
                    AND soft_delete = 0
                ");
                
                foreach ($videos as $video) {
                    $next_sequence = (int)return_single_ans("SELECT MAX(v_sequence) FROM videos WHERE pid = $id") + 1;
                    $sql = "INSERT INTO `videos` 
                            (`pid`, `v_name`, `v_title`, `v_thumbnail`, `v_description`, `v_sequence`, `isactive`, `soft_delete`) 
                            VALUES 
                            ('$id', 
                             '" . escape($video['v_name']) . "', 
                             '" . escape($video['v_title']) . "', 
                             '" . escape($video['v_thumbnail']) . "', 
                             '" . escape($video['v_description']) . "', 
                             '$next_sequence', 
                             '1', 
                             '0')";
                    Insert($sql);
                }
            }

            // Copy files if requested
            if ($copy_documents) {
                $files = return_multiple_rows("
                    SELECT * FROM page_files 
                    WHERE pid = $original_page_id 
                    AND soft_delete = 0
                ");
                
                foreach ($files as $file) {
                    $next_sequence = (int)return_single_ans("SELECT MAX(f_sequence) FROM page_files WHERE pid = $id") + 1;
                    $sql = "INSERT INTO `page_files` 
                            (`pid`, `f_name`, `f_title`, `f_download_link`, `f_description`, `f_sequence`, `isactive`, `soft_delete`) 
                            VALUES 
                            ('$id', 
                             '" . escape($file['f_name']) . "', 
                             '" . escape($file['f_title']) . "', 
                             '" . escape($file['f_download_link']) . "', 
                             '" . escape($file['f_description']) . "', 
                             '$next_sequence', 
                             '1', 
                             '0')";
                    Insert($sql);
                }
            }

            // Copy page attributes if requested
            if ($copy_attributes) {
                $attributes = return_multiple_rows("
                    SELECT * FROM page_attribute_values 
                    WHERE page_id = $original_page_id
                ");
                
                foreach ($attributes as $attribute) {
                    $sql = "INSERT INTO page_attribute_values 
                            (page_id, attribute_id, attribute_value) 
                            VALUES 
                            ('$id', 
                             '" . (int)$attribute['attribute_id'] . "', 
                             '" . escape($attribute['attribute_value']) . "')";
                    Insert($sql);
                }
            }

        }

        // Prepare success response
        $response = [
            'status' => 'success',
            'page_id' => $id,
            'page_title' => $page_title,
            'url_adjusted' => $url_adjusted,
            'original_url' => $original_url,
            'final_url' => $final_url,
            'links' => [
                'view' => BASE_URL . $final_url,
                'edit' => 'editpage.php?id='.$id
            ],
            'copied_elements' => [
                'images' => $copy_images ?? false,
                'videos' => $copy_videos ?? false,
                'documents' => $copy_documents ?? false,
                'addons' => $copy_addons ?? false,
                'attributes' => $copy_attributes ?? false
            ]
        ];
        
        $page_details = return_single_row("SELECT 
            p.*, c.catname, st.st_name as site_template_name,
            og.template_title as page_template_name, page_title
            FROM pages p
            LEFT JOIN category c ON p.catid = c.catid
            LEFT JOIN site_template st ON p.site_template_id = st.st_id
            LEFT JOIN og_template og ON p.template_id = og.template_id
            WHERE p.pid = $id AND p.soft_delete = 0");

        $response['details'] = $page_details;

        echo json_encode($response);
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'Failed to create page. Please try again.'
        ]);
    }
    exit;
}

echo json_encode([
    'status' => 'error',
    'message' => 'Invalid request method'
]);
?>