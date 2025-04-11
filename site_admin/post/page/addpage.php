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

    // Normalize URL format
    $base_url = preg_replace('/\.html$/i', '', $original_url);
    $proposed_url = $base_url . '.html';
    $final_url = $proposed_url;
    $url_adjusted = false;

    // Check for existing URLs and generate unique version if needed
    $counter = 1;
    while (return_single_ans("SELECT 1 FROM pages WHERE page_url = '$final_url' and soft_delete = 0 LIMIT 1")) {
        $final_url = $base_url . '-' . $counter . '.html';
        $counter++;
        $url_adjusted = true;
    }

    // Insert the new page
    $seq = (int)return_single_ans("SELECT COUNT(pid) FROM pages");
    $sql = "INSERT INTO pages (
        catid, page_url, template_id, site_template_id, 
        page_title, featured_image, pages_sequence, isactive , createdby, createdon
    ) VALUES (
        '$ctname', '$final_url', '$template_page', '$site_template',
        '$page_title', '$featured_image', '$seq', '0' , '$uid', NOW()
    )";

    $id = Insert($sql);
    
    if ($id > 0) {
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
            ]
        ];
            
            $page_details = return_single_row("SELECT 
                p.*, c.catname, st.st_name as site_template_name,
                og.template_title as page_template_name , page_title
                FROM pages p
                LEFT JOIN category c ON p.catid = c.catid
                LEFT JOIN site_template st ON p.site_template_id = st.st_id
                LEFT JOIN og_template og ON p.template_id = og.template_id
                WHERE p.pid = $id");

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