<?php 
include 'admin_connect.php';

// With additional libraries
$extra_libs = [];

AdminHeader(
    "Menu Managment", 
    "", 
    $extra_libs,
    null,
    '

    '
);


// Initialize variables
$parent_category_filter = "";
$show_in_navbar_filter = "";
$status_filter = "";
$search_filter = "";
$page_link = "";
$current_page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$per_page = isset($_GET['per_page']) ? intval($_GET['per_page']) : 10;

// Parent Category filter
if(isset($_GET['parent_category']) && !empty($_GET['parent_category'])) {
    $parent_category_id = intval($_GET['parent_category']);
    $parent_category_filter = " AND ParentCategory = $parent_category_id ";
    $page_link .="&parent_category=".$parent_category_id;
}

// Show in NavBar filter
if(isset($_GET['show_in_navbar']) && $_GET['show_in_navbar'] !== '') {
    $show_in_navbar = intval($_GET['show_in_navbar']);
    $show_in_navbar_filter = " AND showInNavBar = $show_in_navbar ";
    $page_link .="&show_in_navbar=".$show_in_navbar;
}

// Status filter
if(isset($_GET['status']) && $_GET['status'] !== '') {
    $status = intval($_GET['status']);
    $status_filter = " AND isactive = $status ";
    $page_link .="&status=".$status;
}

// Search filter
if(isset($_GET['search']) && !empty($_GET['search'])) {
    $search = trim($_GET['search']);
    $search_filter = " AND catname LIKE '%".$conn->real_escape_string($search)."%' ";
    $page_link .="&search=".urlencode($search);
}

// Get total count
$total_query = "SELECT COUNT(*) as total FROM category WHERE soft_delete = 0 $parent_category_filter $show_in_navbar_filter $status_filter $search_filter";
$total_result = return_single_row($total_query);
$total_items = $total_result['total'];

// Calculate pagination
$total_pages = ($per_page > 0) ? ceil($total_items / $per_page) : 1;
$offset = ($current_page - 1) * $per_page;

// Get paginated data
$query = "SELECT * FROM category WHERE soft_delete = 0 $parent_category_filter $show_in_navbar_filter $status_filter $search_filter ORDER BY cat_sequence ASC";
if ($per_page > 0) {
    $query .= " LIMIT $offset, $per_page";
}
$categories = return_multiple_rows($query);

// Get all parent categories for filter dropdown
$parentCategories = return_multiple_rows("SELECT catid, catname FROM category WHERE ParentCategory = 0 AND soft_delete = 0 ORDER BY catname");
?>

<body id="page-top">
    <?php include 'includes/notification.php';?>

    <div id="wrapper">
        <?php include'includes/sidebar.php'; ?>
        
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
                    <h1 class="page-header mb-0">List of Menu</h1>
                    <a href="editmenue.php?action=add" class="btn btn-danger btn-md">
                        <i class="fa fa-plus"></i> Add Menu
                    </a>
                </div>

                <hr>

              <!-- Filter and Search Section -->
<div class="card mb-4">
    <div class="card-body p-3">
        <!-- First Row of Filters -->
        <div class="row mb-3">
            <div class="col-md-4 mb-2 mb-md-0">
                <div class="form-group mb-0">
                    <label class="font-weight-bold">Parent Category</label>
                    <select class="form-control filter-select" id="filter-parent-category">
                        <option value="">All Categories</option>
                        <?php foreach($parentCategories as $cat): ?>
                        <option value="<?=$cat['catid']?>" <?=(isset($_GET['parent_category']) && $_GET['parent_category'] == $cat['catid']) ? 'selected' : '' ?>>
                            <?=htmlspecialchars($cat['catname'])?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="col-md-3 mb-2 mb-md-0">
                <div class="form-group mb-0">
                    <label class="font-weight-bold">Show in NavBar</label>
                    <select class="form-control filter-select" id="filter-show-navbar">
                        <option value="">All</option>
                        <option value="1" <?=(isset($_GET['show_in_navbar']) && $_GET['show_in_navbar'] == '1') ? 'selected' : '' ?>>Yes</option>
                        <option value="0" <?=(isset($_GET['show_in_navbar']) && $_GET['show_in_navbar'] == '0') ? 'selected' : '' ?>>No</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3 mb-2 mb-md-0">
                <div class="form-group mb-0">
                    <label class="font-weight-bold">Status</label>
                    <select class="form-control filter-select" id="filter-status">
                        <option value="">All</option>
                        <option value="1" <?=(isset($_GET['status']) && $_GET['status'] == '1') ? 'selected' : '' ?>>Active</option>
                        <option value="0" <?=(isset($_GET['status']) && $_GET['status'] == '0') ? 'selected' : '' ?>>Inactive</option>
                    </select>
                </div>
            </div>
        </div>
        
        <!-- Second Row of Filters -->
        <div class="row align-items-end">
            <div class="col-md-2 col-6 mb-2 mb-md-0">
                <div class="form-group mb-0">
                    <label class="font-weight-bold">Items Per Page</label>
                    <select class="form-control" id="per-page">
                        <option value="10" <?=$per_page == 10 ? 'selected' : ''?>>10</option>
                        <option value="25" <?=$per_page == 25 ? 'selected' : ''?>>25</option>
                        <option value="50" <?=$per_page == 50 ? 'selected' : ''?>>50</option>
                        <option value="100" <?=$per_page == 100 ? 'selected' : ''?>>100</option>
                    </select>
                </div>
            </div>
            <div class="col-md-7 col-12 mb-2 mb-md-0">
                <div class="form-group mb-0">
                    <label class="font-weight-bold">Search Category</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="search" placeholder="Search category..." 
                               value="<?=isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''?>">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button" id="search-button">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-6 text-md-right text-left">
                <button type="button" class="btn btn-outline-secondary" onclick="resetFilters()">
                    <i class="fas fa-redo mr-1"></i> Reset Filters
                </button>
            </div>
        </div>
    </div>
</div>

                <!-- Menu Table -->
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="catetable" width="100%" cellspacing="0">
                        <thead class="thead-dark">
                            <tr>
                                <th>No#</th>
                                <th>Category</th>
                                <th>Sequence</th>
                                <th>Shown In NavBar</th>
                                <th>Parent Category</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            // First, organize categories into a hierarchical structure
                            $categoryTree = [];
                            foreach($categories as $category) {
                                $parentId = $category['ParentCategory'];
                                if (!isset($categoryTree[$parentId])) {
                                    $categoryTree[$parentId] = [];
                                }
                                $categoryTree[$parentId][] = $category;
                            }
                            
                            // Function to display categories recursively
                            function displayCategories($parentId, $categories, $categoryTree, &$count, $level = 0) {
                                global $action_ids, $has_view, $has_add, $has_edit, $has_delete, $has_status;

                                if (!isset($categories[$parentId])) return;
                                
                                foreach ($categories[$parentId] as $category) {
                                    $hasChildren = isset($categoryTree[$category['catid']]) && !empty($categoryTree[$category['catid']]);
                                    $indent = str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;', $level);
                                    ?>
                                    <tr id="tr_<?=$category['catid']?>" class="<?= $level > 0 ? 'child-row' : '' ?>">
                                        <td><?=$count++;?></td>
                                        <td>
                                            <?= $indent ?>
                                            <?php if ($hasChildren): ?>
                                                <i class="fas fa-caret-down toggle-children" data-id="<?=$category['catid']?>" style="cursor:pointer;"></i>
                                            <?php else: ?>
                                                <i class="fas fa-minus" style="opacity:0.3;"></i>
                                            <?php endif; ?>
                                            <?=htmlspecialchars($category["catname"])?>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <button class="btn btn-sm btn-outline-primary mr-2" onclick="changeSequence(<?=$category['catid']?>, 'up')">
                                                    <i class="fa fa-arrow-up"></i>
                                                </button>
                                                <span id="seq_<?=$category['catid']?>"><?=$category["cat_sequence"]?></span>
                                                <button class="btn btn-sm btn-outline-primary ml-2" onclick="changeSequence(<?=$category['catid']?>, 'down')">
                                                    <i class="fa fa-arrow-down"></i>
                                                </button>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input js-switch" 
                                                       id="navbar_<?=$category['catid']?>" 
                                                       data-id="<?=$category['catid']?>"
                                                       <?=$category['showInNavBar'] == 1 ? 'checked' : ''?>>
                                                <label class="custom-control-label" for="navbar_<?=$category['catid']?>"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <?php
                                            $pc = return_single_ans("SELECT catname FROM category WHERE catid = ".$category['ParentCategory']." AND soft_delete = 0");
                                            echo ($pc == "0" || empty($pc)) ? "Parent" : htmlspecialchars($pc);
                                            ?>
                                        </td>
                                        <td>
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input js-switch" 
                                                       id="status_switch_<?=$category['catid']?>" 
                                                       data-id="<?=$category['catid']?>"
                                                       <?=($category['isactive'] == 1 && canActivate($category['isSystemOperated'])) ? 'checked' : ''?>
                                                       <?=!canActivate($category['isSystemOperated']) ? 'disabled' : ''?>>
                                                <label class="custom-control-label" for="status_switch_<?=$category['catid']?>">
                                                    <span id="status_<?=$category['catid']?>" class="badge <?=$category['isactive'] == 1 ? 'badge-success' : 'badge-danger'?>">
                                                        <?=$category['isactive'] == 1 ? 'Active' : 'Inactive'?>
                                                    </span>
                                                </label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="dropdown"> 
                                                <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" 
                                                        id="dropdownMenuButton_<?=$category['catid']?>" 
                                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-cog"></i>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton_<?=$category['catid']?>">
                                                    <?php if( isset($has_edit) && canEdit($category['isSystemOperated'])): ?>
                                                    <a class="dropdown-item" href="editmenue.php?id=<?=$category['catid']?>&action=edit">
                                                        <i class="fa fa-edit mr-2"></i>Edit
                                                    </a>
                                                    <?php endif; ?>
                                                    
                                                    <?php if($has_delete && canDelete($category['isSystemOperated'])): ?>
                                                    <a class="dropdown-item text-danger" onclick="delete_(<?=$category['catid']?>)">
                                                        <i class="fa fa-trash mr-2"></i>Delete
                                                    </a>
                                                    <?php endif; ?>
                                                    
                                                    <?php if($has_add && $level < 3): ?>
                                                    <a class="dropdown-item text-success" href="editmenue.php?parent_id=<?=$category['catid']?>&action=add">
                                                        <i class="fa fa-plus mr-2"></i>Add Child
                                                    </a>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                    // Display children recursively
                                    if ($hasChildren) {
                                        echo '<tbody class="child-rows child-rows-'.$category['catid'].'" style="display:none;">';
                                        displayCategories($category['catid'], $categoryTree, $categoryTree, $count, $level + 1);
                                        echo '</tbody>';
                                    }
                                }
                            }
                            
                            // Start displaying from root categories (parent_id = 0)
                            $count = $offset + 1;
                            displayCategories(0, $categoryTree, $categoryTree, $count);
                            ?>
                        </tbody>
                    </table>
                </div>

                <script>
                // Toggle child rows visibility
                $(document).on('click', '.toggle-children', function() {
                    const parentId = $(this).data('id');
                    const childRows = $('.child-rows-' + parentId);
                    const icon = $(this);
                    
                    if (childRows.is(':visible')) {
                        childRows.hide();
                        icon.removeClass('fa-caret-down').addClass('fa-caret-right');
                    } else {
                        childRows.show();
                        icon.removeClass('fa-caret-right').addClass('fa-caret-down');
                    }
                });

                // Initialize - show only top level categories by default
                $(document).ready(function() {
                    $('.child-rows').hide();
                });
                </script>

                <style>
                .child-row {
                    background-color: rgba(0,0,0,0.02);
                }
                </style>

                <!-- Pagination -->
                <?php if ($total_pages > 1): ?>
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center">
                        <li class="page-item <?= ($current_page <= 1) ? 'disabled' : '' ?>">
                            <a class="page-link" href="<?= getPaginationLink(1) ?>" aria-label="First">
                                <span aria-hidden="true">&laquo;&laquo;</span>
                            </a>
                        </li>
                        <li class="page-item <?= ($current_page <= 1) ? 'disabled' : '' ?>">
                            <a class="page-link" href="<?= getPaginationLink($current_page - 1) ?>" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        
                        <?php
                        // Show page numbers
                        $start_page = max(1, $current_page - 2);
                        $end_page = min($total_pages, $current_page + 2);
                        
                        if ($start_page > 1) {
                            echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
                        }
                        
                        for ($i = $start_page; $i <= $end_page; $i++) {
                            echo '<li class="page-item ' . ($i == $current_page ? 'active' : '') . '">';
                            echo '<a class="page-link" href="' . getPaginationLink($i) . '">' . $i . '</a>';
                            echo '</li>';
                        }
                        
                        if ($end_page < $total_pages) {
                            echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
                        }
                        ?>
                        
                        <li class="page-item <?= ($current_page >= $total_pages) ? 'disabled' : '' ?>">
                            <a class="page-link" href="<?= getPaginationLink($current_page + 1) ?>" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                        <li class="page-item <?= ($current_page >= $total_pages) ? 'disabled' : '' ?>">
                            <a class="page-link" href="<?= getPaginationLink($total_pages) ?>" aria-label="Last">
                                <span aria-hidden="true">&raquo;&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
                <?php endif; ?>
            </div>
            <!-- /.container-fluid -->

            <?php
            // Helper function to generate pagination links with current filters
            function getPaginationLink($page) {
                global $page_link, $per_page;
                $link = "?page=$page&per_page=$per_page";
                
                // Preserve all existing filters
                $preserve_params = ['parent_category', 'show_in_navbar', 'status', 'search'];
                foreach($preserve_params as $param) {
                    if(isset($_GET[$param])) {
                        $link .= "&$param=".urlencode($_GET[$param]);
                    }
                }
                
                return $link;
            }
            ?>

            <script type="text/javascript" src="js/category/categories.js"></script>
           <script>
                    // Apply filters automatically when dropdowns change
                    document.querySelectorAll('.filter-select').forEach(select => {
                        select.addEventListener('change', filterCategories);
                    });

                    // Apply filters when search button is clicked or Enter is pressed
                    document.getElementById('search-button').addEventListener('click', filterCategories);
                    document.getElementById('search').addEventListener('keypress', function(e) {
                        if (e.key === 'Enter') {
                            filterCategories();
                        }
                    });

                    // Apply filters when items per page changes
                    document.getElementById('per-page').addEventListener('change', changePerPage);

                    function filterCategories() {
                        const parentCategory = document.getElementById('filter-parent-category').value;
                        const showInNavbar = document.getElementById('filter-show-navbar').value;
                        const status = document.getElementById('filter-status').value;
                        const search = document.getElementById('search').value;
                        const perPage = document.getElementById('per-page').value;
                        
                        let url = '?page=1&per_page=' + perPage;
                        
                        if (parentCategory) url += '&parent_category=' + parentCategory;
                        if (showInNavbar) url += '&show_in_navbar=' + showInNavbar;
                        if (status) url += '&status=' + status;
                        if (search) url += '&search=' + encodeURIComponent(search);
                        
                        window.location.href = url;
                    }

                    function resetFilters() {
                        const perPage = document.getElementById('per-page').value;
                        window.location.href = '?page=1&per_page=' + perPage;
                    }

                    function changePerPage() {
                        const perPage = document.getElementById('per-page').value;
                        let url = '?page=1&per_page=' + perPage;
                        
                        // Preserve existing filters
                        <?php 
                        $preserve_params = ['parent_category', 'show_in_navbar', 'status', 'search'];
                        foreach($preserve_params as $param) {
                            echo "if('".(isset($_GET[$param]) ? $_GET[$param] : '')."') url += '&$param=".(isset($_GET[$param]) ? $_GET[$param] : '')."';";
                        }
                        ?>
                        
                        window.location.href = url;
                    }
                    </script>

            <div id="deletemodal"></div>
            <?php include 'includes/footer_copyright.php';?>
        </div>
        <!-- /.content-wrapper -->
    </div>
    <!-- /#wrapper -->

    <?php include 'includes/footer.php';?>