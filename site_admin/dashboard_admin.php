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


// 3. Process database cards and merge with hardcoded ones
$dashboard_cards = $hardcoded_cards;

foreach ($db_cards as $db_card) {
    $key = strtolower(str_replace(' ', '_', $db_card['title']));
    
    // Only add if not already defined in hardcoded cards
    if (!isset($dashboard_cards[$key])) {
        $dashboard_cards[$key] = [
            'title' => $db_card['title'],
            'icon' => !empty($db_card['iconclass']) ? $db_card['iconclass'] : 'fa-cube',
            'color' => 'secondary', // Default color for DB cards
            'link' => $db_card['url'],
            'counts' => [
                'total' => get_count($db_card['count_table'] ?? '', $db_card['count_field'] ?? 'id', $Where_gc),
                'active' => get_count($db_card['count_table'] ?? '', $db_card['count_field'] ?? 'id', $Where_gc, true)
            ]
        ];
        
        // You could add more sophisticated mapping here if your DB has color/icon info
    }
}

// Additional CSS and JS libraries
$extra_libs = [
    '<link href="css/dashboard/dashboard_admin.css" rel="stylesheet" type="text/css">',
    '<link href="https://cdn.jsdelivr.net/npm/animate.css@4.1.1/animate.min.css" rel="stylesheet">',
    '<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">'
];

AdminHeader(
    "Admin Dashboard", 
    "Overview of system statistics", 
    $extra_libs,
    null,
    '<script src="js/dashboard/custom.js"></script>'
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
                    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                        <i class="fas fa-download fa-sm text-white-50"></i> Generate Report
                    </a>
                </div>

                <!-- Stats Cards Row -->
                <div class="row">
                    <?php foreach ($dashboard_cards as $key => $card): ?>
                        <?php 
                        $color_class = "border-left-{$card['color']}";
                        $text_color = $card['text_color'] ?? 'gray';
                        ?>
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card <?= $color_class ?> shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-<?= $card['color'] ?> text-uppercase mb-1">
                                                <?= $card['title'] ?>
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-<?= $text_color ?>-800">
                                                <?= number_format($card['counts']['total']) ?>
                                                <?php if (isset($card['counts']['active'])): ?>
                                                    <small class="text-success">
                                                        (<?= number_format($card['counts']['active']) ?> active)
                                                    </small>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas <?= $card['icon'] ?> fa-2x text-<?= $text_color ?>-300"></i>
                                        </div>
                                    </div>
                                    <a href="<?= $card['link'] ?>" class="stretched-link"></a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            
            <?php include 'includes/footer_copyright.php'; ?>
        </div>
    </div>

    <?php include 'includes/footer.php'; ?>
</body>
</html>