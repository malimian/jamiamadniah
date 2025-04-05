<?php include 'includes/header.php';

// Initialize variables
$template = "";
$category = "";
$author_filter = "";
$publisher_filter = "";
$status_filter = "";
$search_filter = "";
$page_link = "";
$current_page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$per_page = isset($_GET['per_page']) ? intval($_GET['per_page']) : 50;

// Template filter
if(isset($_GET['temp']) && !empty($_GET['temp'])) {
    $temp_id = $_GET['temp'];
    $template = " AND pages.site_template_id = $temp_id ";
    $page_link .="&temp=".$temp_id;
}

// Category filter
if(isset($_GET['cat']) && !empty($_GET['cat'])) {
    $cat_id = $_GET['cat'];
    $category = " AND pages.catid = $cat_id ";
    $page_link .="&cat=".$cat_id;
}

// Author (Creator) filter
if(isset($_GET['author']) && !empty($_GET['author'])) {
    $author_id = $_GET['author'];
    $author_filter = " AND pages.createdby = $author_id ";
    $page_link .="&author=".$author_id;
}

// Publisher filter
if(isset($_GET['publisher']) && !empty($_GET['publisher'])) {
    $publisher_id = $_GET['publisher'];
    $publisher_filter = " AND pages.activatedby = $publisher_id ";
    $page_link .="&publisher=".$publisher_id;
}

// Status filter
if(isset($_GET['status']) && $_GET['status'] !== '') {
    $status = $_GET['status'];
    $status_filter = " AND pages.isactive = $status ";
    $page_link .="&status=".$status;
}

// Search filter
if(isset($_GET['search']) && !empty($_GET['search'])) {
    $search = trim($_GET['search']);
    $search_filter = " AND (pages.page_title LIKE '%$search%' OR pages.page_url LIKE '%$search%') ";
    $page_link .="&search=".urlencode($search);
}

// Get total count
$total_query = "SELECT COUNT(*) as total FROM pages 
    LEFT JOIN category ON pages.catid = category.catid 
    WHERE pages.soft_delete = 0 AND category.soft_delete = 0 $template $category $author_filter $publisher_filter $status_filter $search_filter";
$total_result = return_single_row($total_query);
$total_items = $total_result['total'];

// Calculate pagination
$total_pages = ($per_page > 0) ? ceil($total_items / $per_page) : 1;
$offset = ($current_page - 1) * $per_page;

// Get all users
$users = return_multiple_rows("SELECT * FROM loginuser WHERE soft_delete = 0");
$user_lookup = [];
foreach ($users as $user) {
    $user_lookup[$user['id']] = $user;
}

// Get paginated data - make sure to include activatedby in your SELECT
$query = "SELECT *, pages.isactive as pages_isactive, pages.createdby as pages_createdby, pages.activatedby 
    FROM pages LEFT JOIN category ON pages.catid = category.catid 
    WHERE pages.soft_delete = 0 AND category.soft_delete = 0 $template $category $author_filter $publisher_filter $status_filter $search_filter
    ORDER BY pages.catid, pages_sequence ASC";
    
if ($per_page > 0) {
    $query .= " LIMIT $offset, $per_page";
}

$Pages = return_multiple_rows($query);

$site_templates = return_multiple_rows("Select * from og_template Where isactive = 1 and soft_delete = 0 ");
?>

<body id="page-top">
    <?php include 'setting/company_name.php';?>
    <?php include 'includes/navbar_search.php';?>
    <?php include 'includes/notification.php';?>

    <div id="wrapper">
        <?php include'includes/sidebar.php'; ?>
        
        <div id="content-wrapper">
            <div class="container-fluid">
                <!-- Breadcrumbs-->
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="domain.php">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">Pages</li>
                </ol>

                <!-- Page Content -->
                <h3 class="page-header">
                    All Pages (<?php echo $total_items; ?>)
                    <?php if($has_add): ?>
                    <a href="addpage.php?<?php echo $page_link;?>" style="float:right;color: #fff" class="btn btn-danger btn-md">
                        <i class="fa fa-plus">&nbsp;</i>Add New
                    </a>
                    <?php endif; ?>
                </h3>

                <hr>

                <!-- Search and Filter Options -->
                <div class="row mb-3">
                    <!-- First Line - Search and Template -->
                    <div class="col-12 mb-2">
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <form method="get" action="">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="search" placeholder="Search by title..." 
                                            value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="submit">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <!-- Keep other filter parameters -->
                                    <?php if(isset($_GET['temp'])): ?>
                                        <input type="hidden" name="temp" value="<?= $_GET['temp'] ?>">
                                    <?php endif; ?>
                                    <?php if(isset($_GET['cat'])): ?>
                                        <input type="hidden" name="cat" value="<?= $_GET['cat'] ?>">
                                    <?php endif; ?>
                                    <?php if(isset($_GET['author'])): ?>
                                        <input type="hidden" name="author" value="<?= $_GET['author'] ?>">
                                    <?php endif; ?>
                                    <?php if(isset($_GET['publisher'])): ?>
                                        <input type="hidden" name="publisher" value="<?= $_GET['publisher'] ?>">
                                    <?php endif; ?>
                                    <?php if(isset($_GET['status'])): ?>
                                        <input type="hidden" name="status" value="<?= $_GET['status'] ?>">
                                    <?php endif; ?>
                                </form>
                            </div>
                            <div class="col-md-3 mb-2">
                                <select class="form-control" id="filter-template" onchange="filterPages()">
                                    <option value="">All Templates</option>
                                    <?php 
                                    foreach($site_templates as $template) {
                                        $selected = (isset($_GET['temp']) && $_GET['temp'] == $template['template_id']) ? 'selected' : '';
                                        echo '<option value="'.$template['template_id'].'" '.$selected.'>'.$template['template_title'].'</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-3 mb-2">
                                <button class="btn btn-outline-secondary btn-block" onclick="resetFilters()">
                                    <i class="fas fa-undo"></i> Reset Filters
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Second Line - Status, Category, Author, Publisher -->
                    <div class="col-12">
                        <div class="row">
                            <div class="col-md-3 mb-2">
                                <select class="form-control" id="filter-status" onchange="filterPages()">
                                    <option value="">Status</option>
                                    <option value="1" <?= (isset($_GET['status']) && $_GET['status'] == '1' ? 'selected' : '') ?>>Published</option>
                                    <option value="0" <?= (isset($_GET['status']) && $_GET['status'] == '0' ? 'selected' : '') ?>>Draft</option>
                                </select>
                            </div>
                            <div class="col-md-3 mb-2">
                                <select class="form-control" id="filter-category" onchange="filterPages()">
                                    <option value="">Category</option>
                                    <?php 
                                    $categories = return_multiple_rows("SELECT * FROM category WHERE soft_delete = 0 ORDER BY catname");
                                    foreach($categories as $cat) {
                                        $selected = (isset($_GET['cat']) && $_GET['cat'] == $cat['catid']) ? 'selected' : '';
                                        echo '<option value="'.$cat['catid'].'" '.$selected.'>'.$cat['catname'].'</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-3 mb-2">
                                <select class="form-control" id="filter-author" onchange="filterPages()">
                                    <option value="">Author</option>
                                    <?php 
                                    foreach($users as $user) {
                                        $selected = (isset($_GET['author']) && $_GET['author'] == $user['id']) ? 'selected' : '';
                                        echo '<option value="'.$user['id'].'" '.$selected.'>'.$user['username'].'</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-3 mb-2">
                                <select class="form-control" id="filter-publisher" onchange="filterPages()">
                                    <option value="">Publisher</option>
                                    <?php 
                                    foreach($users as $user) {
                                        $selected = (isset($_GET['publisher']) && $_GET['publisher'] == $user['id']) ? 'selected' : '';
                                        echo '<option value="'.$user['id'].'" '.$selected.'>'.$user['username'].'</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- DataTables Example -->
                <div class="card mb-3">
                    <div class="card-header">
                        <i class="fas fa-table"></i>
                        Pages List
                        <div class="float-right">
                            <div class="d-flex align-items-center">
                                <span class="badge badge-primary mr-2">Showing <?php echo ($per_page > 0) ? min($offset + 1, $total_items) : 1; ?>-<?php echo ($per_page > 0) ? min($offset + $per_page, $total_items) : $total_items; ?> of <?php echo $total_items; ?></span>
                                <select class="form-control form-control-sm" id="per_page" onchange="changePerPage()" style="width: 100px;">
                                    <option value="10" <?= $per_page == 10 ? 'selected' : '' ?>>10</option>
                                    <option value="25" <?= $per_page == 25 ? 'selected' : '' ?>>25</option>
                                    <option value="50" <?= $per_page == 50 ? 'selected' : '' ?>>50</option>
                                    <option value="100" <?= $per_page == 100 ? 'selected' : '' ?>>100</option>
                                    <option value="0" <?= $per_page == 0 ? 'selected' : '' ?>>All</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover" id="dataTable1" width="100%" cellspacing="0">
                                <thead class="thead-dark">
                                    <tr>
                                        <th width="40px">ID</th>
                                        <th width="50px">Order</th>
                                        <th width="150px">Author</th>
                                        <th width="120px">Image</th>
                                        <th>Title</th>
                                        <th width="120px">Category</th>
                                        <th width="100px">Template</th>
                                        <th width="80px">Status</th>
                                        <th width="80px">Visibility</th>
                                        <th width="80px">Views</th>
                                        <th width="120px">Last Modified</th>
                                        <th width="120px">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    if(count($Pages) > 0) {
                                        foreach($Pages as $page) {                        
                                            $author = isset($user_lookup[$page['pages_createdby']]) ? $user_lookup[$page['pages_createdby']] : null;
                                            $author_name = $author ? $author['username'] : 'System';

                                            $author_image = $author && !empty($author['profile_pic']) ? 
                                                BASE_URL.ABSOLUTE_IMAGEPATH.$author['profile_pic'] : 
                                                'https://ui-avatars.com/api/?name='.urlencode($author_name).'&size=40';  
                                            
                                            // Get publisher info (activatedby)
                                            $publisher = isset($user_lookup[$page['activatedby']]) ? $user_lookup[$page['activatedby']] : null;
                                            $publisher_name = $publisher ? $publisher['username'] : 'System';

                                             $publisher_image = $publisher && !empty($publisher['profile_pic']) ? 
                                                BASE_URL.ABSOLUTE_IMAGEPATH.$publisher['profile_pic'] : 
                                                'https://ui-avatars.com/api/?name='.urlencode($publisher_name).'&size=40';

                                            $same_user = ($page['pages_createdby'] == $page['activatedby']) && $page['pages_isactive'];

                                            $featured_class = $page['isFeatured'] ? 'featured-post' : '';
                                            $status_label = $page['pages_isactive'] ? 'Published' : 'Draft';
                                            $status_class = $page['pages_isactive'] ? 'success' : 'warning';
                                            
                                            $visibility_label = $page['visibility'] ? 'Public' : 'Private';
                                            $visibility_class = $page['visibility'] ? 'success' : 'secondary';
                                            
                                            $last_modified = date('M j, Y', strtotime($page['updatedon']));
                                            
                                            // Get template info
                                            $template_info = null;
                                            foreach($site_templates as $template) {
                                                if($template['template_id'] == $page['site_template_id']) {
                                                    $template_info = $template;
                                                    break;
                                                }
                                            }
                                            $template_name = $template_info ? $template_info['template_title'] : 'Unknown';
                                            
                                            // Featured image
                                            $featured_image = !empty($page['featured_image']) ? 
                                                $page['featured_image'] : 
                                                BASE_URL.'assets/img/no-image-available.jpg';
                                            ?>
                                            <tr id="tr_<?=$page['pid']?>" class="<?=$featured_class?>">
                                                <td><?=$page['pid']?></td>
                                                <td>
                                                    <input type="number" class="form-control form-control-sm sequence-input" 
                                                           value="<?=$page['pages_sequence']?>" 
                                                           data-id="<?=$page['pid']?>"
                                                           style="width: 60px;">
                                                </td>
                                                <td>
                                                    <div class="d-flex flex-column">
                                                        <?php if($same_user): ?>
                                                            <!-- Combined display when same user -->
                                                            <div class="d-flex align-items-center">
                                                                <img src="<?=$author_image?>" class="rounded-circle mr-2" width="30" height="30" alt="<?=$author_image?>">
                                                                <div>
                                                                    <small class="text-muted d-block">Author & Published by</small>
                                                                    <span><?=$author_name?></span>
                                                                </div>
                                                            </div>
                                                        <?php else: ?>
                                                            <!-- Creator -->
                                                            <div class="d-flex align-items-center mb-2">
                                                                <img src="<?=$author_image?>" class="rounded-circle mr-2" width="30" height="30" alt="<?=$author_name?>">
                                                                <div>
                                                                    <small class="text-muted d-block">Author</small>
                                                                    <span><?=$author_name?></span>
                                                                </div>
                                                            </div>
                                                            <!-- Publisher -->
                                                            <?php if($page['pages_isactive'] && $page['activatedby']): ?>
                                                            <div class="d-flex align-items-center">
                                                                <img src="<?=$publisher_image?>" class="rounded-circle mr-2" width="30" height="30" alt="<?=$publisher_name?>">
                                                                <div>
                                                                    <small class="text-muted d-block">Published by</small>
                                                                    <span><?=$publisher_name?></span>
                                                                </div>
                                                            </div>
                                                            <?php endif; ?>
                                                        <?php endif; ?>
                                                    </div>
                                                </td>
                                                <td>
                                                    <img src="<?=$featured_image?>" class="img-thumbnail" style="max-width: 100px; height: auto;" alt="Featured Image">
                                                </td>
                                                <td>
                                                    <strong><?=$page['page_title']?></strong>
                                                    <div class="text-muted small">/<?=$page['page_url']?></div>
                                                </td>
                                                <td>
                                                    <span class="badge badge-info"><?=$page['catname']?></span>
                                                </td>
                                                <td>
                                                    <span class="badge badge-secondary"><?=$template_name?></span>
                                                </td>
                                              
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <?php if ($has_status): ?>
                                                            <?php if ($page['pages_isactive'] == 1): ?>
                                                                <span id="status_<?=$page['pid']?>" class="badge badge-success">Published</span>
                                                                <input type="checkbox" data-id="<?=$page['pid']?>" class="js-switch" checked />
                                                            <?php else: ?>
                                                                <span id="status_<?=$page['pid']?>" class="badge badge-warning">Draft</span>
                                                                <input type="checkbox" data-id="<?=$page['pid']?>" class="js-switch" />
                                                            <?php endif; ?>
                                                        <?php else: ?>
                                                            <span class="badge badge-<?=$status_class?>"><?=$status_label?></span>
                                                        <?php endif; ?>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="badge badge-<?=$visibility_class?>"><?=$visibility_label?></span>
                                                </td>
                                                <td>
                                                    <span class="text-primary"><?=number_format($page['views'])?></span>
                                                </td>
                                                <td>
                                                    <small class="text-muted"><?=$last_modified?></small>
                                                </td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            Actions
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                            <?php if($has_edit): ?>
                                                            <a class="dropdown-item" href="editpage.php?id=<?=$page['pid']?>">
                                                                <i class="fas fa-edit fa-fw"></i> Edit
                                                            </a>
                                                            <?php endif; ?>
                                                            
                                                            <?php if($has_add): ?>
                                                            <a class="dropdown-item" href="copypage.php?id=<?=$page['pid']?>">
                                                                <i class="fas fa-copy fa-fw"></i> Duplicate
                                                            </a>
                                                            <?php endif; ?>
                                                            
                                                            <?php if($has_view): ?>
                                                            <a class="dropdown-item" target="_blank" href="<?=BASE_URL.$page['page_url']?>">
                                                                <i class="fas fa-eye fa-fw"></i> View
                                                            </a>
                                                            <?php endif; ?>
                                                            
                                                            <?php if($has_status): ?>
                                                            <div class="dropdown-divider"></div>
                                                            <a class="dropdown-item" href="#" onclick="toggleStatus(<?=$page['pid']?>, <?=$page['pages_isactive']?>)">
                                                                <i class="fas fa-power-off fa-fw"></i> <?=$page['pages_isactive'] ? 'Deactivate' : 'Activate'?>
                                                            </a>
                                                            <?php endif; ?>
                                                            
                                                            <?php if($has_delete): ?>
                                                            <div class="dropdown-divider"></div>
                                                            <a class="dropdown-item text-danger" onclick="delete_(<?=$page['pid']?>)">
                                                                <i class="fas fa-trash fa-fw"></i> Delete
                                                            </a>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    } else {
                                        echo '<tr><td colspan="12" class="text-center">No pages found</td></tr>';
                                    }
                                    ?>
                                </tbody>
                            </table>
                            
                            <!-- Pagination Controls -->
                            <?php if($total_pages > 1 && $per_page > 0): ?>
                            <nav aria-label="Page navigation">
                                <ul class="pagination justify-content-center">
                                    <!-- First Page Link -->
                                    <li class="page-item <?= ($current_page == 1) ? 'disabled' : '' ?>">
                                        <a class="page-link" href="?page=1<?=$page_link?>&per_page=<?=$per_page?>" aria-label="First">
                                            <span aria-hidden="true">&laquo;&laquo;</span>
                                        </a>
                                    </li>
                                    
                                    <!-- Previous Page Link -->
                                    <li class="page-item <?= ($current_page == 1) ? 'disabled' : '' ?>">
                                        <a class="page-link" href="?page=<?=($current_page - 1)?><?=$page_link?>&per_page=<?=$per_page?>" aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                        </a>
                                    </li>
                                    
                                    <!-- Page Numbers -->
                                    <?php
                                    // Show up to 5 page numbers around current page
                                    $start_page = max(1, $current_page - 2);
                                    $end_page = min($total_pages, $current_page + 2);
                                    
                                    // Adjust if we're at the beginning or end
                                    if($current_page <= 3) {
                                        $end_page = min(5, $total_pages);
                                    }
                                    if($current_page >= $total_pages - 2) {
                                        $start_page = max(1, $total_pages - 4);
                                    }
                                    
                                    // Show page numbers
                                    for($i = $start_page; $i <= $end_page; $i++): ?>
                                        <li class="page-item <?= ($i == $current_page) ? 'active' : '' ?>">
                                            <a class="page-link" href="?page=<?=$i?><?=$page_link?>&per_page=<?=$per_page?>"><?=$i?></a>
                                        </li>
                                    <?php endfor; ?>
                                    
                                    <!-- Next Page Link -->
                                    <li class="page-item <?= ($current_page == $total_pages) ? 'disabled' : '' ?>">
                                        <a class="page-link" href="?page=<?=($current_page + 1)?><?=$page_link?>&per_page=<?=$per_page?>" aria-label="Next">
                                            <span aria-hidden="true">&raquo;</span>
                                        </a>
                                    </li>
                                    
                                    <!-- Last Page Link -->
                                    <li class="page-item <?= ($current_page == $total_pages) ? 'disabled' : '' ?>">
                                        <a class="page-link" href="?page=<?=$total_pages?><?=$page_link?>&per_page=<?=$per_page?>" aria-label="Last">
                                            <span aria-hidden="true">&raquo;&raquo;</span>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="card-footer small text-muted">
                        Updated at <?=date('Y-m-d H:i:s')?>
                    </div>
                </div>
            </div>
            
            <div id="deletemodal"></div>
            <?php include 'includes/footer_copyright.php';?>
        </div>
    </div>

    <?php include 'includes/footer.php';?>

    <style>
        .featured-post {
            background-color: #f8f9fa;
        }
        .table-hover tbody tr:hover {
            background-color: rgba(0,0,0,.02);
        }
        .badge {
            font-weight: 500;
        }
        .pagination {
            margin-top: 20px;
        }
        .page-item.active .page-link {
            background-color: #007bff;
            border-color: #007bff;
        }
        .page-link {
            color: #007bff;
        }
        .img-thumbnail {
            max-height: 60px;
            object-fit: cover;
        }
        .sequence-input {
            text-align: center;
        }
        .sequence-input:focus {
            border-color: #80bdff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }
    </style>

    <script type="text/javascript" src="js/page/pages.js"></script>

    <script>
    function filterPages() {
        const status = document.getElementById('filter-status').value;
        const category = document.getElementById('filter-category').value;
        const template = document.getElementById('filter-template').value;
        const author = document.getElementById('filter-author').value;
        const publisher = document.getElementById('filter-publisher').value;
        const search = "<?= isset($_GET['search']) ? $_GET['search'] : '' ?>";
        const per_page = document.getElementById('per_page').value;
        
        let url = '?page=1'; // Always reset to page 1 when filtering
        
        if (status) url += '&status=' + status;
        if (category) url += '&cat=' + category;
        if (template) url += '&temp=' + template;
        if (author) url += '&author=' + author;
        if (publisher) url += '&publisher=' + publisher;
        if (search) url += '&search=' + encodeURIComponent(search);
        if (per_page) url += '&per_page=' + per_page;
        
        window.location.href = url;
    }
    
    function resetFilters() {
        window.location.href = '?page=1&per_page=<?=$per_page?>';
    }
    
    function changePerPage() {
        const per_page = document.getElementById('per_page').value;
        let url = '?page=1&per_page=' + per_page;
        
        // Preserve existing filters
        <?php 
        $preserve_params = ['temp', 'cat', 'author', 'publisher', 'status', 'search'];
        foreach($preserve_params as $param) {
            echo "if('".(isset($_GET[$param]) ? $_GET[$param] : '')."') url += '&$param=".(isset($_GET[$param]) ? $_GET[$param] : '')."';";
        }
        ?>
        
        window.location.href = url;
    }
    
    // Handle sequence changes
    $(document).on('change', '.sequence-input', function() {
        const page_id = $(this).data('id');
        const new_sequence = $(this).val();
        
        $.ajax({
            url: 'post/page/update_sequence.php',
            method: 'POST',
            data: {
                page_id: page_id,
                new_sequence: new_sequence
            },
            success: function(response) {
                const result = JSON.parse(response);
                if(result.success) {
                    toastr.success('Sequence updated successfully');
                } else {
                    toastr.error('Failed to update sequence');
                    // Revert the input value if needed
                }
            },
            error: function() {
                toastr.error('Error updating sequence');
            }
        });
    });
    </script>