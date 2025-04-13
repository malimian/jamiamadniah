<?php 
include 'admin_connect.php';

// With additional libraries
$extra_libs = [
    '<link href="css/page/templates.css" rel="stylesheet">'
];

AdminHeader(
    "Templates", 
    "Template management", 
    $extra_libs
);

// Initialize variables
$status_filter = "";
$search_filter = "";
$page_link = "";
$current_page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$per_page = isset($_GET['per_page']) ? intval($_GET['per_page']) : 50;

// Status filter
if(isset($_GET['status']) && $_GET['status'] !== '') {
    $status = $_GET['status'];
    $status_filter = " AND isactive = $status ";
    $page_link .="&status=".$status;
}

// Search filter
if(isset($_GET['search']) && !empty($_GET['search'])) {
    $search = trim($_GET['search']);
    $search_filter = " AND (template_title LIKE '%$search%' OR template_key LIKE '%$search%') ";
    $page_link .="&search=".urlencode($search);
}

// Get total count
$total_query = "SELECT COUNT(*) as total FROM og_template WHERE soft_delete = 0 $status_filter $search_filter";
$total_result = return_single_row($total_query);
$total_items = $total_result['total'];

// Calculate pagination
$total_pages = ($per_page > 0) ? ceil($total_items / $per_page) : 1;
$offset = ($current_page - 1) * $per_page;

// Get paginated data
$query = "SELECT * FROM og_template WHERE soft_delete = 0 $status_filter $search_filter ORDER BY template_id DESC";
    
if ($per_page > 0) {
    $query .= " LIMIT $offset, $per_page";
}

$Templates = return_multiple_rows($query);

// Get all users for createdby filter
$users = return_multiple_rows("SELECT * FROM loginuser WHERE soft_delete = 0");
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
                    <li class="breadcrumb-item active">Templates</li>
                </ol>

                <!-- Page Content -->
                <h3 class="page-header">
                    All Templates (<?php echo $total_items; ?>)
                    <?php if($has_add): ?>
                        <a href="addsite_template.php" style="float:right;color: #fff" class="btn btn-danger btn-md">
                            <i class="fa fa-plus">&nbsp;</i>Add New
                        </a>
                    <?php endif; ?>

                    <?php if($has_delete): ?>
                        <a href="deleted_templates.php" style="float:right;color: #fff; margin-right: 10px;" class="btn btn-warning btn-md">
                            <i class="fa fa-trash-restore">&nbsp;</i>Restore Deleted
                        </a>
                    <?php endif; ?>
                </h3>

                <hr>

                <!-- Search and Filter Options -->
                <div class="row mb-3">
                    <div class="col-12 mb-2">
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <form method="get" action="">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="search" placeholder="Search by title or key..." 
                                            value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="submit">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <!-- Keep other filter parameters -->
                                    <?php if(isset($_GET['status'])): ?>
                                        <input type="hidden" name="status" value="<?= $_GET['status'] ?>">
                                    <?php endif; ?>
                                </form>
                            </div>
                            <div class="col-md-3 mb-2">
                                <select class="form-control" id="filter-status" onchange="filterTemplates()">
                                    <option value="">All Statuses</option>
                                    <option value="1" <?= (isset($_GET['status']) && $_GET['status'] == '1' ? 'selected' : '') ?>>Active</option>
                                    <option value="0" <?= (isset($_GET['status']) && $_GET['status'] == '0' ? 'selected' : '') ?>>Inactive</option>
                                </select>
                            </div>
                            <div class="col-md-3 mb-2">
                                <button class="btn btn-outline-secondary btn-block" onclick="resetFilters()">
                                    <i class="fas fa-undo"></i> Reset Filters
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-3">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <i class="fas fa-table"></i>
                                Templates List
                            </div>
                            <div class="d-flex align-items-center">
                                <!-- Bulk Actions Dropdown -->
                                <?php if($has_delete || $has_status): ?>
                                <div class="dropdown mr-2">
                                    <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" id="bulkActionsDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Bulk Actions
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="bulkActionsDropdown">
                                        <?php if($has_delete): ?>
                                        <a class="dropdown-item" href="#" onclick="bulkAction('delete')"><i class="fas fa-trash fa-fw"></i> Delete Selected</a>
                                        <?php endif; ?>
                                        <?php if($has_status): ?>
                                        <a class="dropdown-item" href="#" onclick="bulkAction('activate')"><i class="fas fa-check-circle fa-fw"></i> Activate Selected</a>
                                        <a class="dropdown-item" href="#" onclick="bulkAction('deactivate')"><i class="fas fa-times-circle fa-fw"></i> Deactivate Selected</a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <?php endif; ?>
                                
                                <span class="badge badge-primary mr-2">Showing <?php echo ($per_page > 0) ? min($offset + 1, $total_items) : 1; ?>-<?php echo ($per_page > 0) ? min($offset + $per_page, $total_items) : $total_items; ?> of <?php echo $total_items; ?></span>
                                <select class="form-control form-control-sm" id="per_page" onchange="changePerPage()" style="width: 100px;">
                                    <option value="10" <?= $per_page == 10 ? 'selected' : '' ?>>10</option>
                                    <option value="25" <?= $per_page == 25 ? 'selected' : '' ?>>25</option>
                                    <option value="50" <?= $per_page == 50 ? 'selected' : '' ?>>50</option>
                                    <option value="100" <?= $per_page == 100 ? 'selected' : '' ?>>100</option>
                                    <option value="200" <?= $per_page == 200 ? 'selected' : '' ?>>200</option>
                                    <option value="500" <?= $per_page == 500 ? 'selected' : '' ?>>500</option>
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
                                        <th width="40px">
                                            <input type="checkbox" id="selectAll" onclick="toggleSelectAll(this)">
                                        </th>
                                        <th width="60px">ID</th>
                                        <th>Template Name</th>
                                        <th width="150px">Template Key</th>
                                        <th width="120px">Created By</th>
                                        <th width="100px">Status</th>
                                        <th width="150px">Last Modified</th>
                                        <th width="120px">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    if(count($Templates) > 0) {
                                        foreach($Templates as $template) {
                                            // Get creator info
                                            $creator = isset($user_lookup[$template['createdby']]) ? $user_lookup[$template['createdby']] : null;
                                            $creator_name = $creator ? $creator['username'] : 'System';
                                            
                                            $creator_image = $creator && !empty($creator['profile_pic']) ? 
                                                BASE_URL.ABSOLUTE_IMAGEPATH.$creator['profile_pic'] : 
                                                'https://ui-avatars.com/api/?name='.urlencode($creator_name).'&size=40';
                                            
                                            $status_label = $template['isactive'] ? 'Active' : 'Inactive';
                                            $status_class = $template['isactive'] ? 'success' : 'danger';
                                            
                                            $last_modified = date('M j, Y', strtotime($template['updatedon']));
                                            ?>
                                            <tr id="tr_<?=$template['template_id']?>">
                                                <td>
                                                    <input type="checkbox" class="template-checkbox" value="<?=$template['template_id']?>">
                                                </td>
                                                <td><?=$template['template_id']?></td>
                                                <td>
                                                    <strong><?=$template['template_title']?></strong>
                                                    <?php if(!empty($template['template_description'])): ?>
                                                        <p class="text-muted small mb-0"><?=$template['template_description']?></p>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <code><?=$template['template_key']?></code>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <img src="<?=$creator_image?>" class="rounded-circle mr-2" width="30" height="30" alt="<?=$creator_name?>">
                                                        <div>
                                                            <small class="text-muted d-block">Created by</small>
                                                            <span><?=$creator_name?></span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <?php if ($has_status): ?>
                                                            <?php if ($template['isactive'] == 1): ?>
                                                                <span id="status_<?=$template['template_id']?>" class="badge badge-success">Active</span>
                                                                <input type="checkbox" data-id="<?=$template['template_id']?>" class="js-switch" checked />
                                                            <?php else: ?>
                                                                <span id="status_<?=$template['template_id']?>" class="badge badge-danger">Inactive</span>
                                                                <input type="checkbox" data-id="<?=$template['template_id']?>" class="js-switch" />
                                                            <?php endif; ?>
                                                        <?php else: ?>
                                                            <span class="badge badge-<?=$status_class?>"><?=$status_label?></span>
                                                        <?php endif; ?>
                                                    </div>
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
                                                            <!-- Edit Action -->
                                                            <?php if($has_edit): ?>
                                                            <a class="dropdown-item" href="editsite_template.php?id=<?=$template['template_id']?>">
                                                                <i class="fas fa-edit fa-fw"></i> Edit
                                                            </a>
                                                            <?php endif; ?>
                                                            
                                                            <!-- Duplicate Action -->
                                                            <?php if($has_add): ?>
                                                            <a class="dropdown-item duplicate-template" href="#" data-templateid="<?=$template['template_id']?>">
                                                                <i class="fas fa-copy fa-fw"></i> Duplicate
                                                            </a>
                                                            <?php endif; ?>
                                                            
                                                            <!-- Preview Action -->
                                                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#previewTemplateModal" onclick="previewTemplate(<?=$template['template_id']?>)">
                                                                <i class="fas fa-eye fa-fw"></i> Preview
                                                            </a>
                                                            
                                                            <!-- Status Toggle -->
                                                            <?php if($has_status): ?>
                                                            <div class="dropdown-divider"></div>
                                                            <a class="dropdown-item" href="#" onclick="toggleStatus(<?=$template['template_id']?>, <?=$template['isactive']?>)">
                                                                <i class="fas fa-power-off fa-fw"></i> <?=$template['isactive'] ? 'Deactivate' : 'Activate'?>
                                                            </a>
                                                            <?php endif; ?>
                                                            
                                                            <!-- Delete Action -->
                                                            <?php if($has_delete): ?>
                                                            <div class="dropdown-divider"></div>
                                                            <a class="dropdown-item text-danger" onclick="deleteTemplate(<?=$template['template_id']?>)">
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
                                        echo '<tr><td colspan="8" class="text-center">No templates found</td></tr>';
                                    }
                                    ?>
                                </tbody>
                            </table>

                            <!-- Bulk Actions Footer -->
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <div>
                                    <span id="selectedCount">0</span> items selected
                                </div>
                                <div>
                                    <?php if($has_delete): ?>
                                    <button class="btn btn-sm btn-danger mr-2" onclick="bulkAction('delete')">
                                        <i class="fas fa-trash fa-fw"></i> Delete
                                    </button>
                                    <?php endif; ?>
                                    <?php if($has_status): ?>
                                    <button class="btn btn-sm btn-success mr-2" onclick="bulkAction('activate')">
                                        <i class="fas fa-check-circle fa-fw"></i> Activate
                                    </button>
                                    <button class="btn btn-sm btn-warning" onclick="bulkAction('deactivate')">
                                        <i class="fas fa-times-circle fa-fw"></i> Deactivate
                                    </button>
                                    <?php endif; ?>
                                </div>
                            </div>
                            
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

    <!-- Preview Template Modal -->
    <div class="modal fade" id="previewTemplateModal" tabindex="-1" role="dialog" aria-labelledby="previewTemplateModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="previewTemplateModalLabel">Template Preview</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="templatePreviewContent">
                    <!-- Preview content will be loaded here -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <?php include 'includes/footer.php';?>

    <script type="text/javascript" src="js/template/templates.js"></script>
    <script src="js/template/bulk_action.js"></script>

    <script>
    function filterTemplates() {
        const status = document.getElementById('filter-status').value;
        const search = "<?= isset($_GET['search']) ? $_GET['search'] : '' ?>";
        const per_page = document.getElementById('per_page').value;
        
        let url = '?page=1'; // Always reset to page 1 when filtering
        
        if (status) url += '&status=' + status;
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
        $preserve_params = ['status', 'search'];
        foreach($preserve_params as $param) {
            echo "if('".(isset($_GET[$param]) ? $_GET[$param] : '')."') url += '&$param=".(isset($_GET[$param]) ? $_GET[$param] : '')."';";
        }
        ?>
        
        window.location.href = url;
    }
    
    function previewTemplate(templateId) {
        // AJAX call to get template preview
        $.ajax({
            url: 'get_template_preview.php',
            type: 'GET',
            data: { id: templateId },
            success: function(response) {
                $('#templatePreviewContent').html(response);
            },
            error: function() {
                $('#templatePreviewContent').html('<div class="alert alert-danger">Could not load template preview.</div>');
            }
        });
    }
    
    function toggleSelectAll(source) {
        const checkboxes = document.querySelectorAll('.template-checkbox');
        checkboxes.forEach(checkbox => {
            checkbox.checked = source.checked;
        });
        updateSelectedCount();
    }
    
    function updateSelectedCount() {
        const selected = document.querySelectorAll('.template-checkbox:checked').length;
        document.getElementById('selectedCount').textContent = selected;
    }
    
    // Add event listeners to all checkboxes
    document.addEventListener('DOMContentLoaded', function() {
        const checkboxes = document.querySelectorAll('.template-checkbox');
        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', updateSelectedCount);
        });
    });
    
    function bulkAction(action) {
        const selected = [];
        document.querySelectorAll('.template-checkbox:checked').forEach(checkbox => {
            selected.push(checkbox.value);
        });
        
        if (selected.length === 0) {
            alert('Please select at least one template.');
            return;
        }
        
        if (confirm(`Are you sure you want to ${action} ${selected.length} template(s)?`)) {
            $.ajax({
                url: 'bulk_action_templates.php',
                type: 'POST',
                data: {
                    action: action,
                    ids: selected
                },
                success: function(response) {
                    const result = JSON.parse(response);
                    if (result.success) {
                        location.reload();
                    } else {
                        alert(result.message);
                    }
                },
                error: function() {
                    alert('An error occurred while processing your request.');
                }
            });
        }
    }
    </script>
</body>