<?php
require_once('../../admin_connect.php');

header('Content-Type: application/json');


try {
    if (!isset($_POST['page_id']) || !is_numeric($_POST['page_id'])) {
        throw new Exception('Invalid page ID');
    }
    
    $pageId = (int)$_POST['page_id'];
    $userId = $_SESSION['user']['id'];
    
    // Check permissions and get page data
    $page = return_single_row("SELECT p.* FROM pages p 
                             JOIN category c ON p.catid = c.catid 
                             WHERE p.pid = $pageId AND p.soft_delete = 0");
    
    if (!$page) {
        throw new Exception('Page not found');
    }

    
    // Prepare response data
    $response = [
        'status' => 'success',
        'data' => [
            'page_title' => $page['page_title'],
            'page_url' => $page['page_url'],
            'ctname' => $page['catid'],
            'p_image' => $page['featured_image'] ?? '',
            'site_template' => $page['site_template_id'],
            'template_page' => $page['template_id']
        ]
    ];
    
    echo json_encode($response);
    
} catch (Exception $e) {
    echo json_encode([
        'status' => 'error',
        'message' => $e->getMessage()
    ]);
}