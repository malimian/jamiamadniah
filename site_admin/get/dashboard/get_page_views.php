<?php
include '../../admin_connect.php';

header('Content-Type: application/json');

// Default response
$response = [
    'success' => false,
    'message' => 'Invalid request'
];

try {
    // Get parameters
    $range = $_GET['range'] ?? '30';
    $start_date = $_GET['start'] ?? null;
    $end_date = $_GET['end'] ?? null;
    
    // Validate custom date range
    if ($range === 'custom') {
        if (!$start_date || !$end_date) {
            throw new Exception('Both start and end dates are required for custom range');
        }
        
        // Validate date format
        if (!strtotime($start_date) || !strtotime($end_date)) {
            throw new Exception('Invalid date format');
        }
        
        if (strtotime($start_date) > strtotime($end_date)) {
            throw new Exception('Start date must be before end date');
        }
    }
    
    // Calculate date ranges
    switch ($range) {
        case '7':
            $start_date = date('Y-m-d', strtotime('-7 days'));
            $end_date = date('Y-m-d');
            break;
        case '30':
            $start_date = date('Y-m-d', strtotime('-30 days'));
            $end_date = date('Y-m-d');
            break;
        case '90':
            $start_date = date('Y-m-d', strtotime('-90 days'));
            $end_date = date('Y-m-d');
            break;
        case '365':
            $start_date = date('Y-m-d', strtotime('-365 days'));
            $end_date = date('Y-m-d');
            break;
        case 'custom':
            // Already validated above
            break;
        default:
            throw new Exception('Invalid date range specified');
    }
    
    // Get total views
    $total_views = return_single_ans("
        SELECT SUM(views) 
        FROM pages 
        WHERE createdon BETWEEN '$start_date' AND '$end_date'
    ") ?? 0;
    
    // Get average views
    $avg_views = return_single_ans("
        SELECT AVG(views) 
        FROM pages 
        WHERE createdon BETWEEN '$start_date' AND '$end_date'
    ") ?? 0;
    
    // Get top page
    $top_page = return_single_row("
        SELECT p.page_title, p.views 
        FROM pages p
        WHERE p.createdon BETWEEN '$start_date' AND '$end_date'
        ORDER BY p.views DESC 
        LIMIT 1
    ") ?? ['page_title' => 'N/A', 'views' => 0];
    
    // Get new pages count
    $new_pages = return_single_ans("
        SELECT COUNT(pid) 
        FROM pages 
        WHERE createdon BETWEEN '$start_date' AND '$end_date'
    ") ?? 0;
    
    // Get top 5 pages for pie chart
    $top_pages_data = return_multiple_rows("
        SELECT p.pid, p.page_title, p.views, p.createdon, p.updatedon, p.isactive, 
               u.fullname as created_by
        FROM pages p
        LEFT JOIN loginuser u ON p.createdby = u.id
        WHERE p.createdon BETWEEN '$start_date' AND '$end_date'
        ORDER BY p.views DESC
        LIMIT 10
    ");
    
    // Prepare views distribution data for pie chart
    $views_distribution = [
        'labels' => [],
        'data' => []
    ];
    
    $top_5_pages = return_multiple_rows("
        SELECT page_title, views 
        FROM pages 
        WHERE createdon BETWEEN '$start_date' AND '$end_date'
        ORDER BY views DESC 
        LIMIT 5
    ");
    
    $top_views_total = 0;
    foreach ($top_5_pages as $page) {
        $views_distribution['labels'][] = $page['page_title'];
        $views_distribution['data'][] = $page['views'];
        $top_views_total += $page['views'];
    }
    
    $other_views = $total_views - $top_views_total;
    if ($other_views > 0) {
        $views_distribution['labels'][] = 'Other Pages';
        $views_distribution['data'][] = $other_views;
    }
    
    // Prepare creation period data for pie chart
    $creation_period = [
        'data' => [
            return_single_ans("SELECT SUM(views) FROM pages WHERE createdon BETWEEN '".date('Y-m-d', strtotime('-30 days'))."' AND '$end_date'") ?? 0,
            return_single_ans("SELECT SUM(views) FROM pages WHERE createdon BETWEEN '".date('Y-m-d', strtotime('-3 months'))."' AND '".date('Y-m-d', strtotime('-30 days'))."'") ?? 0,
            return_single_ans("SELECT SUM(views) FROM pages WHERE createdon BETWEEN '".date('Y-m-d', strtotime('-6 months'))."' AND '".date('Y-m-d', strtotime('-3 months'))."'") ?? 0,
            return_single_ans("SELECT SUM(views) FROM pages WHERE createdon < '".date('Y-m-d', strtotime('-6 months'))."'") ?? 0
        ]
    ];
    
    // Build response
    $response = [
        'success' => true,
        'total_views' => $total_views,
        'avg_views' => $avg_views,
        'top_page' => $top_page,
        'new_pages' => $new_pages,
        'views_distribution' => $views_distribution,
        'creation_period' => $creation_period,
        'top_pages' => $top_pages_data
    ];
    
} catch (Exception $e) {
    $response['message'] = $e->getMessage();
}

echo json_encode($response);
?>