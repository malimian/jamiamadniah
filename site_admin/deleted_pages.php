<?php 
include 'admin_connect.php';

// With additional libraries
$extra_libs = [
    '<link href="css/page/pages.css" rel="stylesheet">'
];

AdminHeader(
    "Deleted Pages", 
    "Restore deleted pages", 
    $extra_libs
);

// Initialize variables
$current_page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$per_page = isset($_GET['per_page']) ? intval($_GET['per_page']) : 50;

// Get total count of deleted pages
$total_query = "SELECT COUNT(*) as total FROM pages WHERE soft_delete = 1";
$total_result = return_single_row($total_query);
$total_items = $total_result['total'];

// Calculate pagination
$total_pages = ($per_page > 0) ? ceil($total_items / $per_page) : 1;
$offset = ($current_page - 1) * $per_page;

// Get paginated data
$query = "SELECT * FROM pages WHERE soft_delete = 1 ORDER BY deletedon DESC";
if ($per_page > 0) {
    $query .= " LIMIT $offset, $per_page";
}

$deletedPages = return_multiple_rows($query);

// Get all users for lookup
$users = return_multiple_rows("SELECT * FROM loginuser WHERE soft_delete = 0");
$user_lookup = [];
foreach ($users as $user) {
    $user_lookup[$user['id']] = $user;
}

// Get templates
$site_templates = return_multiple_rows("Select * from og_template Where isactive = 1 and soft_delete = 0");
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
                        <a href="domain.php">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="pages.php">Pages</a>
                    </li>
                    <li class="breadcrumb-item active">Deleted Pages</li>
                </ol>

                <!-- Page Content -->
                <h3 class="page-header">
                    Deleted Pages (<?php echo $total_items; ?>)
                    <a href="pages.php" style="float:right;color: #fff" class="btn btn-primary btn-md">
                        <i class="fa fa-arrow-left">&nbsp;</i>Back to Pages
                    </a>
                </h3>

                <hr>

                <!-- Per Page Selector -->
                <div class="row mb-3">
                    <div class="col-md-3">
                        <select class="form-control" id="per_page" onchange="changePerPage()">
                            <option value="10" <?= $per_page == 10 ? 'selected' : '' ?>>10 per page</option>
                            <option value="25" <?= $per_page == 25 ? 'selected' : '' ?>>25 per page</option>
                            <option value="50" <?= $per_page == 50 ? 'selected' : '' ?>>50 per page</option>
                            <option value="100" <?= $per_page == 100 ? 'selected' : '' ?>>100 per page</option>
                            <option value="0" <?= $per_page == 0 ? 'selected' : '' ?>>Show All</option>
                        </select>
                    </div>
                </div>

                <div class="card mb-3">
                    <div class="card-header">
                        <i class="fas fa-trash"></i>
                        Recently Deleted Pages
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                                <thead class="thead-dark">
                                    <tr>
                                        <th width="40px">
                                            <input type="checkbox" id="selectAll" onclick="toggleSelectAll(this)">
                                        </th>
                                        <th width="40px">ID</th>
                                        <th>Title</th>
                                        <th width="120px">Category</th>
                                        <th width="100px">Template</th>
                                        <th width="150px">Deleted By</th>
                                        <th width="120px">Deleted On</th>
                                        <th width="120px">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    if(count($deletedPages) > 0) {
                                        foreach($deletedPages as $page) {
                                            $author = isset($user_lookup[$page['deletedby']]) ? $user_lookup[$page['deletedby']] : null;
                                            $author_name = $author ? $author['username'] : 'System';
                                            
                                            // Get template info
                                            $template_info = null;
                                            foreach($site_templates as $template) {
                                                if($template['template_id'] == $page['template_id']) {
                                                    $template_info = $template;
                                                    break;
                                                }
                                            }
                                            $template_name = $template_info ? $template_info['template_title'] : 'Unknown';
                                            
                                            // Get category info
                                            $category_info = return_single_row("SELECT catname FROM category WHERE catid = ".$page['catid']);
                                            $category_name = $category_info ? $category_info['catname'] : 'Unknown';
                                            
                                            $deleted_date = date('M j, Y H:i', strtotime($page['deletedon']));
                                            ?>
                                            <tr id="tr_<?=$page['pid']?>">
                                                <td>
                                                    <input type="checkbox" class="page-checkbox" value="<?=$page['pid']?>">
                                                </td>
                                                <td><?=$page['pid']?></td>
                                                <td>
                                                    <strong><?=$page['page_title']?></strong>
                                                    <div class="text-muted small">/<?=$page['page_url']?></div>
                                                </td>
                                                <td>
                                                    <span class="badge badge-info"><?=$category_name?></span>
                                                </td>
                                                <td>
                                                    <span class="badge badge-secondary"><?=$template_name?></span>
                                                </td>
                                                <td>
                                                    <?=$author_name?>
                                                </td>
                                                <td>
                                                    <?=$deleted_date?>
                                                </td>
                                                <td>
                                                    <div class="btn-group">
                                                        <button class="btn btn-sm btn-success" onclick="restorePage(<?=$page['pid']?>)">
                                                            <i class="fa fa-trash-restore"></i> Restore
                                                        </button>
                                                        <button class="btn btn-sm btn-danger" onclick="permanentDelete(<?=$page['pid']?>)">
                                                            <i class="fa fa-trash-alt"></i> Delete Permanently
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    } else {
                                        echo '<tr><td colspan="8" class="text-center">No deleted pages found</td></tr>';
                                    }
                                    ?>
                                </tbody>
                            </table>

                            <!-- Bulk Actions -->
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <div>
                                    <span id="selectedCount">0</span> items selected
                                </div>
                                <div>
                                    <button class="btn btn-sm btn-success mr-2" onclick="bulkRestore()">
                                        <i class="fas fa-trash-restore fa-fw"></i> Restore Selected
                                    </button>
                                    <button class="btn btn-sm btn-danger" onclick="bulkPermanentDelete()">
                                        <i class="fas fa-trash-alt fa-fw"></i> Delete Selected Permanently
                                    </button>
                                </div>
                            </div>
                            
                            <!-- Pagination -->
                            <?php if($total_pages > 1 && $per_page > 0): ?>
                            <nav aria-label="Page navigation">
                                <ul class="pagination justify-content-center">
                                    <li class="page-item <?= ($current_page == 1) ? 'disabled' : '' ?>">
                                        <a class="page-link" href="?page=1&per_page=<?=$per_page?>" aria-label="First">
                                            <span aria-hidden="true">&laquo;&laquo;</span>
                                        </a>
                                    </li>
                                    <li class="page-item <?= ($current_page == 1) ? 'disabled' : '' ?>">
                                        <a class="page-link" href="?page=<?=($current_page - 1)?>&per_page=<?=$per_page?>" aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                        </a>
                                    </li>
                                    
                                    <?php
                                    $start_page = max(1, $current_page - 2);
                                    $end_page = min($total_pages, $current_page + 2);
                                    
                                    if($current_page <= 3) {
                                        $end_page = min(5, $total_pages);
                                    }
                                    if($current_page >= $total_pages - 2) {
                                        $start_page = max(1, $total_pages - 4);
                                    }
                                    
                                    for($i = $start_page; $i <= $end_page; $i++): ?>
                                        <li class="page-item <?= ($i == $current_page) ? 'active' : '' ?>">
                                            <a class="page-link" href="?page=<?=$i?>&per_page=<?=$per_page?>"><?=$i?></a>
                                        </li>
                                    <?php endfor; ?>
                                    
                                    <li class="page-item <?= ($current_page == $total_pages) ? 'disabled' : '' ?>">
                                        <a class="page-link" href="?page=<?=($current_page + 1)?>&per_page=<?=$per_page?>" aria-label="Next">
                                            <span aria-hidden="true">&raquo;</span>
                                        </a>
                                    </li>
                                    <li class="page-item <?= ($current_page == $total_pages) ? 'disabled' : '' ?>">
                                        <a class="page-link" href="?page=<?=$total_pages?>&per_page=<?=$per_page?>" aria-label="Last">
                                            <span aria-hidden="true">&raquo;&raquo;</span>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="card-footer small text-muted">
                        Showing <?php echo ($per_page > 0) ? min($offset + 1, $total_items) : 1; ?>-<?php echo ($per_page > 0) ? min($offset + $per_page, $total_items) : $total_items; ?> of <?php echo $total_items; ?> deleted pages
                    </div>
                </div>
            </div>
            
            <!-- Delete Confirmation Modal -->
            <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-danger text-white">
                            <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Permanent Deletion</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure you want to permanently delete this page? This action cannot be undone.</p>
                            <p class="font-weight-bold" id="pageToDeleteTitle"></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-danger" id="confirmPermanentDelete">Delete Permanently</button>
                        </div>
                    </div>
                </div>
            </div>
            
            <?php include 'includes/footer_copyright.php';?>
        </div>
    </div>

    <?php include 'includes/footer.php';?>

    <script>
    // Toggle select all checkboxes
    function toggleSelectAll(source) {
        const checkboxes = document.querySelectorAll('.page-checkbox');
        checkboxes.forEach(checkbox => {
            checkbox.checked = source.checked;
        });
        updateSelectedCount();
    }
    
    // Update selected count display
    function updateSelectedCount() {
        const selected = document.querySelectorAll('.page-checkbox:checked').length;
        document.getElementById('selectedCount').textContent = selected;
    }
    
    // Attach event listeners to checkboxes
    document.querySelectorAll('.page-checkbox').forEach(checkbox => {
        checkbox.addEventListener('change', updateSelectedCount);
    });
    
    // Change items per page
    function changePerPage() {
        const per_page = document.getElementById('per_page').value;
        window.location.href = '?page=1&per_page=' + per_page;
    }
    
    // Restore a single page
    function restorePage(pageId) {
        if(confirm('Are you sure you want to restore this page?')) {
            $.ajax({
                url: 'ajax/restore_page.php',
                type: 'POST',
                data: { 
                    page_id: pageId,
                    action: 'restore'
                },
                success: function(response) {
                    if(response.success) {
                        showNotification('Page restored successfully', 'success');
                        $('#tr_' + pageId).fadeOut(300, function() {
                            $(this).remove();
                        });
                    } else {
                        showNotification('Error: ' + response.message, 'danger');
                    }
                },
                error: function() {
                    showNotification('Error restoring page', 'danger');
                }
            });
        }
    }
    
    // Bulk restore pages
    function bulkRestore() {
        const selected = [];
        document.querySelectorAll('.page-checkbox:checked').forEach(checkbox => {
            selected.push(checkbox.value);
        });
        
        if(selected.length === 0) {
            alert('Please select at least one page to restore');
            return;
        }
        
        if(confirm('Are you sure you want to restore ' + selected.length + ' selected pages?')) {
            $.ajax({
                url: 'ajax/restore_page.php',
                type: 'POST',
                data: { 
                    page_ids: selected,
                    action: 'bulk_restore'
                },
                success: function(response) {
                    if(response.success) {
                        showNotification(selected.length + ' pages restored successfully', 'success');
                        selected.forEach(pageId => {
                            $('#tr_' + pageId).fadeOut(300, function() {
                                $(this).remove();
                            });
                        });
                        document.getElementById('selectAll').checked = false;
                        updateSelectedCount();
                    } else {
                        showNotification('Error: ' + response.message, 'danger');
                    }
                },
                error: function() {
                    showNotification('Error restoring pages', 'danger');
                }
            });
        }
    }
    
    // Show confirmation for permanent delete
    function permanentDelete(pageId) {
        const pageTitle = $('#tr_' + pageId + ' td:nth-child(3) strong').text();
        $('#pageToDeleteTitle').text(pageTitle);
        $('#confirmDeleteModal').modal('show');
        
        $('#confirmPermanentDelete').off('click').on('click', function() {
            performPermanentDelete(pageId);
        });
    }
    
    // Perform permanent delete
    function performPermanentDelete(pageId) {
        $.ajax({
            url: 'ajax/restore_page.php',
            type: 'POST',
            data: { 
                page_id: pageId,
                action: 'permanent_delete'
            },
            success: function(response) {
                $('#confirmDeleteModal').modal('hide');
                if(response.success) {
                    showNotification('Page permanently deleted', 'success');
                    $('#tr_' + pageId).fadeOut(300, function() {
                        $(this).remove();
                    });
                } else {
                    showNotification('Error: ' + response.message, 'danger');
                }
            },
            error: function() {
                $('#confirmDeleteModal').modal('hide');
                showNotification('Error deleting page', 'danger');
            }
        });
    }
    
    // Bulk permanent delete
    function bulkPermanentDelete() {
        const selected = [];
        document.querySelectorAll('.page-checkbox:checked').forEach(checkbox => {
            selected.push(checkbox.value);
        });
        
        if(selected.length === 0) {
            alert('Please select at least one page to delete');
            return;
        }
        
        if(confirm('WARNING: This will permanently delete ' + selected.length + ' pages. This action cannot be undone. Are you sure?')) {
            $.ajax({
                url: 'ajax/restore_page.php',
                type: 'POST',
                data: { 
                    page_ids: selected,
                    action: 'bulk_permanent_delete'
                },
                success: function(response) {
                    if(response.success) {
                        showNotification(selected.length + ' pages permanently deleted', 'success');
                        selected.forEach(pageId => {
                            $('#tr_' + pageId).fadeOut(300, function() {
                                $(this).remove();
                            });
                        });
                        document.getElementById('selectAll').checked = false;
                        updateSelectedCount();
                    } else {
                        showNotification('Error: ' + response.message, 'danger');
                    }
                },
                error: function() {
                    showNotification('Error deleting pages', 'danger');
                }
            });
        }
    }
    </script>
</body>
</html>