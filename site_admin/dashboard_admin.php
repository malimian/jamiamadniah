<?php
include 'admin_connect.php';

/**
 * Helper function to get counts from database
 */
function get_count($table, $id_field, $where = '', $active_only = false) {
    $where_clause = trim($where);
    if ($active_only) {
        $where_clause .= ($where_clause ? ' AND ' : ' WHERE ') . "isactive = 1";
    }
    $query = "SELECT COUNT($id_field) AS total FROM $table $where_clause";
    return (int)return_single_ans($query);
}

// Handle CSV export if requested
if (isset($_GET['export']) && $_GET['export'] == 'csv') {
    $report_type = $_GET['report'] ?? 'user_activity';
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename='.$report_type.'_report_'.date('Y-m-d').'.csv');
    
    $output = fopen('php://output', 'w');
    
    switch ($report_type) {
        case 'user_activity':
            fputcsv($output, ['User Activity Report - Generated '.date('Y-m-d H:i:s')]);
            fputcsv($output, ['Metric', 'Value']);
            
            // User Statistics
            $total_users = get_count('loginuser', 'id', $Where_gc);
            $active_users = get_count('loginuser', 'id', $Where_gc . " AND lastaccessip IS NOT NULL AND lastaccessip != ''");
            $new_users = get_count('loginuser', 'id', $Where_gc . " AND createdon >= '".date('Y-m-01')."'");
            
            fputcsv($output, ['Total Users', $total_users]);
            fputcsv($output, ['Active Users (last 30 days)', $active_users]);
            fputcsv($output, ['New Users (this month)', $new_users]);
            
            // User Preferences
            $with_profile_pic = return_single_ans("SELECT COUNT(id) FROM loginuser WHERE profile_pic IS NOT NULL AND profile_pic != ''");
            $with_contact_info = return_single_ans("SELECT COUNT(id) FROM loginuser WHERE (emailaddress IS NOT NULL AND emailaddress != '') OR (phonenumber IS NOT NULL AND phonenumber != '')");
            
            fputcsv($output, ['']);
            fputcsv($output, ['User Preferences']);
            fputcsv($output, ['Profile pictures uploaded', round(($with_profile_pic/$total_users)*100, 2).'%']);
            fputcsv($output, ['Contact information completed', round(($with_contact_info/$total_users)*100, 2).'%']);
            
            // Geographic Distribution
            $top_countries = return_multiple_rows("SELECT country, COUNT(id) as count FROM loginuser WHERE country IS NOT NULL AND country != '' GROUP BY country ORDER BY count DESC LIMIT 5");
            fputcsv($output, ['']);
            fputcsv($output, ['Top Countries by Users']);
            foreach ($top_countries as $country) {
                fputcsv($output, [$country['country'], $country['count']]);
            }
            break;
            
        case 'content_management':
            fputcsv($output, ['Content Management Report - Generated '.date('Y-m-d H:i:s')]);
            fputcsv($output, ['Metric', 'Value']);
            
            // Page Statistics
            $total_pages = get_count('pages', 'pid', $Where_gc);
            $active_pages = get_count('pages', 'pid', $Where_gc, true);
            $pages_this_month = get_count('pages', 'pid', $Where_gc . " AND createdon >= '".date('Y-m-01')."'");
            
            fputcsv($output, ['Total Pages', $total_pages]);
            fputcsv($output, ['Active Pages', $active_pages]);
            fputcsv($output, ['Pages Created This Month', $pages_this_month]);
            
            // Pages by Creator
            $creators = return_multiple_rows("
                SELECT u.id, u.fullname, COUNT(p.pid) as page_count, MAX(p.createdon) as last_created 
                FROM pages p 
                LEFT JOIN loginuser u ON p.createdby = u.id 
                GROUP BY p.createdby, u.fullname 
                ORDER BY page_count DESC
            ");
            
            fputcsv($output, ['']);
            fputcsv($output, ['Pages by Creator', 'Count', 'Last Created']);
            foreach ($creators as $creator) {
                fputcsv($output, [
                    $creator['fullname'] ?? 'Unknown',
                    $creator['page_count'],
                    $creator['last_created']
                ]);
            }
            
            // Most Viewed Pages
            $popular_pages = return_multiple_rows("SELECT page_title, views FROM pages ORDER BY views DESC LIMIT 5");
            fputcsv($output, ['']);
            fputcsv($output, ['Most Viewed Pages', 'Views']);
            foreach ($popular_pages as $page) {
                fputcsv($output, [$page['page_title'], $page['views']]);
            }
            break;
            
        case 'system_activity':
            fputcsv($output, ['System Activity Report - Generated '.date('Y-m-d H:i:s')]);
            fputcsv($output, ['Metric', 'Value']);
            
            // API Usage
            $active_api_keys = get_count('api_keys', 'api_id', $Where_gc, true);
            fputcsv($output, ['Active API Keys', $active_api_keys]);
            
            // Soft Deleted Items
            $deleted_pages = return_single_ans("SELECT COUNT(pid) FROM pages WHERE soft_delete = 1");
            $deleted_users = return_single_ans("SELECT COUNT(id) FROM loginuser WHERE soft_delete = 1");
            
            fputcsv($output, ['']);
            fputcsv($output, ['Soft Deleted Items']);
            fputcsv($output, ['Pages', $deleted_pages]);
            fputcsv($output, ['Users', $deleted_users]);
            break;
    }
    
    fclose($output);
    exit();
}

// Define all dashboard cards with their metadata
$hardcoded_cards = [
    'orders' => [
        'title' => 'Orders',
        'icon' => 'fa-truck',
        'color' => 'primary',
        'link' => 'order.php',
        'counts' => [
            'total' => get_count('order_dh', 'order_id', $Where_gc),
            'active' => get_count('order_dh', 'order_id', $Where_gc, true)
        ]
    ],
    'promocodes' => [
        'title' => 'Promo Codes',
        'icon' => 'fa-gift',
        'color' => 'success',
        'link' => 'view_promo_code.php',
        'counts' => [
            'total' => get_count('promocode', 'p_id', $Where_gc),
            'active' => get_count('promocode', 'p_id', $Where_gc, true)
        ]
    ],
    'users' => [
        'title' => 'Users',
        'icon' => 'fa-users',
        'color' => 'info',
        'link' => 'user.php',
        'counts' => [
            'total' => get_count('loginuser', 'id', $Where_gc),
            'active' => get_count('loginuser', 'id', $Where_gc, true),
            'regular' => get_count('loginuser', 'id', $Where_gc . " AND usertypeid = 4", true)
        ]
    ],
    'payments' => [
        'title' => 'Payments',
        'icon' => 'fa-credit-card',
        'color' => 'warning',
        'link' => 'payments.php',
        'counts' => [
            'total' => get_count('payments', 'pay_id', $Where_gc),
            'active' => get_count('payments', 'pay_id', $Where_gc, true)
        ]
    ],
    'packages' => [
        'title' => 'Packages',
        'icon' => 'fa-cubes',
        'color' => 'secondary',
        'link' => 'all_packages.php',
        'counts' => [
            'total' => get_count('all_packages', 'pid', $Where_gc),
            'active' => get_count('all_packages', 'pid', $Where_gc, true)
        ]
    ],
    'pages' => [
        'title' => 'Pages',
        'icon' => 'fa-file-text',
        'color' => 'dark',
        'link' => 'pages.php',
        'counts' => [
            'total' => get_count('pages', 'pid', $Where_gc),
            'active' => get_count('pages', 'pid', $Where_gc, true)
        ]
    ],
    'categories' => [
        'title' => 'Categories',
        'icon' => 'fa-clipboard-list',
        'color' => 'danger',
        'link' => 'categories.php',
        'counts' => [
            'total' => get_count('category', 'catid', $Where_gc),
            'active' => get_count('category', 'catid', $Where_gc, true)
        ]
    ],
    'documents' => [
        'title' => 'Documents',
        'icon' => 'fa-file-alt',
        'color' => 'light',
        'text_color' => 'dark', // For light background
        'link' => 'documents.php',
        'counts' => [
            'total' => get_count('documents', 'docu_id', $Where_gc),
            'active' => get_count('documents', 'docu_id', $Where_gc, true)
        ]
    ]
];

$db_cards = return_multiple_rows("
    SELECT * 
    FROM og_module 
    INNER JOIN user_module ON og_module.id = user_module.og_module_id 
    WHERE og_module.isactive = 1 
      AND og_module.soft_delete = 0 
      AND og_module.showInNavBar = 0 
      AND user_module.uid = " . $_SESSION['user']['id']
);

// Process database cards and merge with hardcoded ones
$dashboard_cards = $hardcoded_cards;

foreach ($db_cards as $db_card) {
    $key = strtolower(str_replace(' ', '_', $db_card['title']));
    
    if (!isset($dashboard_cards[$key])) {
        $dashboard_cards[$key] = [
            'title' => $db_card['title'],
            'icon' => !empty($db_card['iconclass']) ? $db_card['iconclass'] : 'fa-cube',
            'color' => 'secondary',
            'link' => $db_card['url'],
            'counts' => [
                'total' => get_count($db_card['count_table'] ?? '', $db_card['count_field'] ?? 'id', $Where_gc),
                'active' => get_count($db_card['count_table'] ?? '', $db_card['count_field'] ?? 'id', $Where_gc, true)
            ]
        ];
    }
}

// Additional CSS and JS libraries
$extra_libs = [
    '<link href="css/dashboard/dashboard_admin.css" rel="stylesheet" type="text/css">',
    '<link href="https://cdn.jsdelivr.net/npm/animate.css@4.1.1/animate.min.css" rel="stylesheet">',
    '<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">',
    '<link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">'
];

AdminHeader(
    "Admin Dashboard", 
    "Overview of system statistics", 
    $extra_libs,
    null,
    '<script src="js/dashboard/custom.js"></script>
     <script src="vendor/datatables/jquery.dataTables.min.js"></script>
     <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>'
);
?>

<body id="page-top" class="dashboard-body">
    <?php include 'includes/notification.php'; ?>

    <div id="wrapper">
        <?php include 'includes/sidebar.php'; ?>
        
        <div id="content-wrapper" class="animate__animated animate__fadeIn">
            <div class="container-fluid">
                <!-- Breadcrumbs-->
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="#"><i class="fas fa-home"></i> Home</a>
                    </li>
                    <li class="breadcrumb-item active">Dashboard Overview</li>
                </ol>

                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Dashboard Overview</h1>
                    <div class="btn-group">
                        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-download fa-sm text-white-50"></i> Generate Report
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="?export=csv&report=user_activity">User Activity Report (CSV)</a>
                            <a class="dropdown-item" href="?export=csv&report=content_management">Content Management Report (CSV)</a>
                            <a class="dropdown-item" href="?export=csv&report=system_activity">System Activity Report (CSV)</a>
                        </div>
                    </div>
                </div>

                <!-- Stats Cards Row -->
                <div class="row">
                    <?php foreach ($dashboard_cards as $key => $card): ?>
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-<?= $card['color'] ?> shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-<?= $card['color'] ?> text-uppercase mb-1">
                                                <?= $card['title'] ?>
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?= number_format($card['counts']['total']) ?>
                                                <?php if (isset($card['counts']['active'])): ?>
                                                    <small class="text-success">
                                                        (<?= number_format($card['counts']['active']) ?> active)
                                                    </small>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas <?= $card['icon'] ?> fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                    <a href="<?= $card['link'] ?>" class="stretched-link"></a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- Reports Section -->
                <div class="row">
                    <!-- User Activity Report -->
                    <div class="col-lg-6 mb-4">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">User Activity Summary</h6>
                                <a href="?export=csv&report=user_activity" class="btn btn-sm btn-success">Export CSV</a>
                            </div>
                            <div class="card-body">
                                <?php
                                $total_users = get_count('loginuser', 'id', $Where_gc);
                                $active_users = get_count('loginuser', 'id', $Where_gc . " AND lastaccessip IS NOT NULL AND lastaccessip != ''");
                                $new_users = get_count('loginuser', 'id', $Where_gc . " AND createdon >= '".date('Y-m-01')."'");
                                ?>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <h5 class="small font-weight-bold">Total Users <span class="float-right"><?= $total_users ?></span></h5>
                                            <div class="progress mb-2">
                                                <div class="progress-bar bg-primary" role="progressbar" style="width: 100%"></div>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <h5 class="small font-weight-bold">Active Users (30 days) <span class="float-right"><?= $active_users ?></span></h5>
                                            <div class="progress mb-2">
                                                <div class="progress-bar bg-success" role="progressbar" style="width: <?= ($total_users > 0) ? round(($active_users/$total_users)*100) : 0 ?>%"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <h5 class="small font-weight-bold">New Users (this month) <span class="float-right"><?= $new_users ?></span></h5>
                                            <div class="progress mb-2">
                                                <div class="progress-bar bg-info" role="progressbar" style="width: <?= ($total_users > 0) ? round(($new_users/$total_users)*100) : 0 ?>%"></div>
                                            </div>
                                        </div>
                                        <?php
                                        $with_profile_pic = return_single_ans("SELECT COUNT(id) FROM loginuser WHERE profile_pic IS NOT NULL AND profile_pic != ''");
                                        ?>
                                        <div class="mb-3">
                                            <h5 class="small font-weight-bold">Profiles with Photos <span class="float-right"><?= round(($with_profile_pic/$total_users)*100, 2) ?>%</span></h5>
                                            <div class="progress mb-2">
                                                <div class="progress-bar bg-warning" role="progressbar" style="width: <?= round(($with_profile_pic/$total_users)*100) ?>%"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <h6 class="font-weight-bold">Top Countries</h6>
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-sm">
                                            <thead>
                                                <tr>
                                                    <th>Country</th>
                                                    <th>Users</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $top_countries = return_multiple_rows("SELECT country, COUNT(id) as count FROM loginuser WHERE country IS NOT NULL AND country != '' GROUP BY country ORDER BY count DESC LIMIT 5");
                                                foreach ($top_countries as $country) {
                                                    echo "<tr><td>{$country['country']}</td><td>{$country['count']}</td></tr>";
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Management Report -->
                    <div class="col-lg-6 mb-4">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">Content Management Summary</h6>
                                <a href="?export=csv&report=content_management" class="btn btn-sm btn-success">Export CSV</a>
                            </div>
                            <div class="card-body">
                                <?php
                                $total_pages = get_count('pages', 'pid', $Where_gc);
                                $active_pages = get_count('pages', 'pid', $Where_gc, true);
                                $pages_this_month = get_count('pages', 'pid', $Where_gc . " AND createdon >= '".date('Y-m-01')."'");
                                $stale_pages = return_single_ans("SELECT COUNT(pid) FROM pages WHERE updatedon < '".date('Y-m-d', strtotime('-6 months'))."' AND soft_delete = 0");
                                ?>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <h5 class="small font-weight-bold">Total Pages <span class="float-right"><?= $total_pages ?></span></h5>
                                            <div class="progress mb-2">
                                                <div class="progress-bar bg-primary" role="progressbar" style="width: 100%"></div>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <h5 class="small font-weight-bold">Active Pages <span class="float-right"><?= $active_pages ?></span></h5>
                                            <div class="progress mb-2">
                                                <div class="progress-bar bg-success" role="progressbar" style="width: <?= ($total_pages > 0) ? round(($active_pages/$total_pages)*100) : 0 ?>%"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <h5 class="small font-weight-bold">Pages This Month <span class="float-right"><?= $pages_this_month ?></span></h5>
                                            <div class="progress mb-2">
                                                <div class="progress-bar bg-info" role="progressbar" style="width: <?= ($total_pages > 0) ? round(($pages_this_month/$total_pages)*100) : 0 ?>%"></div>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <h5 class="small font-weight-bold">Stale Pages (6+ months) <span class="float-right"><?= $stale_pages ?></span></h5>
                                            <div class="progress mb-2">
                                                <div class="progress-bar bg-danger" role="progressbar" style="width: <?= ($total_pages > 0) ? round(($stale_pages/$total_pages)*100) : 0 ?>%"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <h6 class="font-weight-bold">Top Content Creators</h6>
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-sm">
                                            <thead>
                                                <tr>
                                                    <th>User</th>
                                                    <th>Pages</th>
                                                    <th>Last Created</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $creators = return_multiple_rows("
                                                    SELECT u.id, u.fullname, COUNT(p.pid) as page_count, MAX(p.createdon) as last_created 
                                                    FROM pages p 
                                                    LEFT JOIN loginuser u ON p.createdby = u.id 
                                                    GROUP BY p.createdby, u.fullname 
                                                    ORDER BY page_count DESC
                                                    LIMIT 5
                                                ");
                                           foreach ($creators as $creator) {
                                                        echo "<tr>
                                                            <td>" . (isset($creator['fullname']) ? $creator['fullname'] : 'System') . "</td>
                                                            <td>{$creator['page_count']}</td>
                                                            <td>" . date('M d, Y', strtotime($creator['last_created'])) . "</td>
                                                        </tr>";
                                                    }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- System Activity Report -->
                <div class="row">
                    <div class="col-lg-12 mb-4">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">System Activity Summary</h6>
                                <a href="?export=csv&report=system_activity" class="btn btn-sm btn-success">Export CSV</a>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="card border-left-info shadow h-100 py-2 mb-4">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col mr-2">
                                                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                            Active API Keys
                                                        </div>
                                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                            <?= get_count('api_keys', 'api_id', $Where_gc, true) ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <i class="fas fa-key fa-2x text-gray-300"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card border-left-warning shadow h-100 py-2 mb-4">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col mr-2">
                                                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                            Soft Deleted Pages
                                                        </div>
                                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                            <?= return_single_ans("SELECT COUNT(pid) FROM pages WHERE soft_delete = 1") ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <i class="fas fa-trash-alt fa-2x text-gray-300"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card border-left-danger shadow h-100 py-2 mb-4">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col mr-2">
                                                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                                            Soft Deleted Users
                                                        </div>
                                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                            <?= return_single_ans("SELECT COUNT(id) FROM loginuser WHERE soft_delete = 1") ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <i class="fas fa-user-slash fa-2x text-gray-300"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <h6 class="font-weight-bold">Recent Activity</h6>
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-sm small">
                                            <thead>
                                                <tr>
                                                    <th>Timestamp</th>
                                                    <th>User</th>
                                                    <th>Action</th>
                                                    <th>Details</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                // This would need an activity log table to work properly
                                                // Example placeholder - you'd need to implement actual logging
                                                echo "<tr><td colspan='4' class='text-center'>Activity logging not implemented</td></tr>";
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <?php include 'includes/footer_copyright.php'; ?>
        </div>
    </div>

    <?php include 'includes/footer.php'; ?>
    
    <script>
    $(document).ready(function() {
        // Initialize DataTables
        $('table').DataTable({
            "paging": false,
            "searching": false,
            "info": false,
            "ordering": false
        });
    });
    </script>
</body>
</html>