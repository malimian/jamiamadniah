<?php 
include 'admin_connect.php';

// Include SortableJS library
$extra_libs = [
    'sortable' => '<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.14.0/Sortable.min.js"></script>'
];

AdminHeader(
    "Menu Management", 
    "", 
    $extra_libs,
    null,
    '
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="css/categories/categories.css">
    <script src="js/category/menu-management.js"></script>
    '

);

// Get all menu items organized hierarchically
$menuItems = return_multiple_rows("SELECT * FROM category WHERE soft_delete = 0 ORDER BY cat_sequence ASC");

// Build the menu tree
function buildMenuTree($items, $parentId = 0) {
    $tree = [];
    foreach ($items as $item) {
        if ($item['ParentCategory'] == $parentId) {
            $children = buildMenuTree($items, $item['catid']);
            if ($children) {
                $item['children'] = $children;
            }
            $tree[] = $item;
        }
    }
    return $tree;
}

$menuTree = buildMenuTree($menuItems);

// Function to render menu items recursively
function renderMenuItems($items, $level = 0) {
    $html = '';
    foreach ($items as $item) {
        $hasChildren = !empty($item['children']);
        $isActive = $item['isactive'] == 1;
        
        $html .= '<div class="menu-item" data-id="'.$item['catid'].'">';
        $html .= '<div class="menu-item-handle"><i class="fas fa-bars"></i></div>';
        $html .= '<div class="menu-item-content">';
        $html .= htmlspecialchars($item['catname']);
        
        // Add status badge and toggle
        $html .= '<span id="status-badge-'.$item['catid'].'" class="status-badge '.($isActive ? 'active' : 'inactive').'">';
        $html .= $isActive ? 'Active' : 'Inactive';
        $html .= '</span>';
        
        $html .= '<label class="status-toggle">';
        $html .= '<input type="checkbox" class="status-toggle-input" data-id="'.$item['catid'].'" '.($isActive ? 'checked' : '').'>';
        $html .= '<span class="status-slider"></span>';
        $html .= '</label>';
        
        $html .= '</div>'; // Close menu-item-content
        
        // Add sequence number
        $html .= '<div class="sequence-number mr-2">'.$item['cat_sequence'].'</div>';
        
        // Add action buttons
        $html .= '<div class="menu-item-actions">';
        $html .= '<button class="sequence-up btn btn-sm btn-outline-primary"><i class="fas fa-arrow-up"></i></button>';
        $html .= '<button class="sequence-down btn btn-sm btn-outline-primary ml-1"><i class="fas fa-arrow-down"></i></button>';
        $html .= '<a href="editmenue.php?id='.$item['catid'].'&action=edit" title="Edit"><i class="fas fa-edit"></i></a>';
        $html .= '<a href="editmenue.php?parent_id='.$item['catid'].'&action=add" title="Add child"><i class="fas fa-plus"></i></a>';
        $html .= '<a href="#" class="delete-item" data-id="'.$item['catid'].'" title="Delete"><i class="fas fa-trash text-danger"></i></a>';
        $html .= '</div>';
        $html .= '</div>';
        
        if ($hasChildren) {
            $html .= '<div class="menu-item-children" data-parent="'.$item['catid'].'">';
            $html .= renderMenuItems($item['children'], $level + 1);
            $html .= '</div>';
        }
    }
    return $html;
}
?>

<body id="page-top">
    <?php include 'includes/notification.php';?>

    <div id="wrapper">
        <?php include'includes/sidebar.php'; ?>
        

        <!-- Add this modal for status changes -->
        <div class="modal fade" id="statusModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Change Status</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to change the status of this item?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" id="confirmStatusChange">Confirm</button>
                    </div>
                </div>
            </div>
        </div>

        <div id="content-wrapper">
            <div class="container-fluid">
                <!-- Breadcrumbs-->
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="<?php echo $_SESSION['user']['dashboard'];?>">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">Menu Management</li>
                </ol>

                <!-- Page Content -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1 class="page-header mb-0">Navigation</h1>
                    <div>
                        <a href="editmenue.php?action=add" class="btn btn-primary">
                            <i class="fa fa-plus"></i> Add menu item
                        </a>
                    </div>
                </div>

                <!-- Main Menu Container -->
                <div class="menu-container">
                    <div class="menu-header">
                        <div>
                            <div class="menu-title">Main menu</div>
                            <div class="menu-handle">main-menu</div>
                        </div>
                        <div>
                            <a href="#" class="btn btn-sm btn-outline-danger">Delete menu</a>
                        </div>
                    </div>
                    
                    <?php if (!empty($menuTree)): ?>
                        <div class="menu-items-list" id="sortable-menu">
                            <?php echo renderMenuItems($menuTree); ?>
                        </div>
                    <?php else: ?>
                        <div class="empty-state">
                            <p>No menu items yet. Click "Add menu item" to get started.</p>
                        </div>
                    <?php endif; ?>
                    
                    <div class="add-item-btn">
                        <a href="editmenue.php?action=add" class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-plus"></i> Add menu item
                        </a>
                    </div>
                </div>
            </div>

            <?php include 'includes/footer_copyright.php';?>
        </div>
        <!-- /.content-wrapper -->
    </div>
    <!-- /#wrapper -->

    <?php include 'includes/footer.php';?>