<?php 
include 'admin_connect.php';

// With additional libraries
$extra_libs = [
    '<link href="css/user/users.css" rel="stylesheet">',
    '<link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">',
    '<link href="vendor/select2/css/select2.min.css" rel="stylesheet">'
];

AdminHeader(
    "User Management", 
    "Manage system users and permissions", 
    $extra_libs,
    null,
    '<script src="vendor/datatables/jquery.dataTables.min.js"></script>
     <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
     <script src="vendor/select2/js/select2.min.js"></script>'
);

// Initialize variables for filtering
$status_filter = "";
$type_filter = "";
$search_filter = "";
$page_link = "";
$current_page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$per_page = isset($_GET['per_page']) ? intval($_GET['per_page']) : 25;

// Status filter
if(isset($_GET['status']) && $_GET['status'] !== '') {
    $status = $_GET['status'];
    $status_filter = " AND loginuser.isactive = $status ";
    $page_link .="&status=".$status;
}

// User type filter
if(isset($_GET['type']) && !empty($_GET['type'])) {
    $type_id = $_GET['type'];
    $type_filter = " AND loginuser.usertypeid = $type_id ";
    $page_link .="&type=".$type_id;
}

// Search filter
if(isset($_GET['search']) && !empty($_GET['search'])) {
    $search = trim($_GET['search']);
    $search_filter = " AND (loginuser.username LIKE '%$search%' OR loginuser.emailaddress LIKE '%$search%' OR loginuser.fullname LIKE '%$search%' OR loginuser.phonenumber LIKE '%$search%') ";
    $page_link .="&search=".urlencode($search);
}

// Get total count
$total_query = "SELECT COUNT(*) as total FROM loginuser 
    INNER JOIN og_usertype ON og_usertype.id = loginuser.usertypeid 
    WHERE  loginuser.soft_delete = 0 AND og_usertype.soft_delete = 0 
    $status_filter $type_filter $search_filter";
$total_result = return_single_row($total_query);
$total_items = $total_result['total'];

// Calculate pagination
$total_pages = ($per_page > 0) ? ceil($total_items / $per_page) : 1;
$offset = ($current_page - 1) * $per_page;

// Get paginated data
$query = "SELECT *, loginuser.isactive as user_isactive, loginuser.id as loginuser_id, 
          loginuser.createdon as loginuser_createdon FROM loginuser 
          INNER JOIN og_usertype ON og_usertype.id = loginuser.usertypeid 
          WHERE  loginuser.soft_delete = 0 AND og_usertype.soft_delete = 0 
          $status_filter $type_filter $search_filter
          ORDER BY loginuser.createdon DESC";
    
if ($per_page > 0) {
    $query .= " LIMIT $offset, $per_page";
}

$users = return_multiple_rows($query);

// Get all user types for filter dropdown
$user_types = return_multiple_rows("SELECT * FROM og_usertype WHERE soft_delete = 0");
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
                        <a href="<?=$_SESSION['user']['dashboard'];?>">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">User Management</li>
                </ol>

                <!-- Page Content -->
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h3 class="mb-0">User Management</h3>
                    <div>
                        <?php if($has_add): ?>
                            <a href="adduser.php" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Add User
                            </a>
                        <?php endif; ?>
                    </div>
                </div>

                <hr>

                <!-- Search and Filter Options -->
                <div class="row mb-3">
                    <div class="col-12 mb-2">
                        <div class="row">
                            <div class="col-md-4 mb-2">
                                <form method="get" action="">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="search" placeholder="Search by name, email or phone..." 
                                            value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="submit">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-3 mb-2">
                                <select class="form-control" id="filter-type" onchange="filterUsers()">
                                    <option value="">All User Types</option>
                                    <?php 
                                    foreach($user_types as $type) {
                                        $selected = (isset($_GET['type']) && $_GET['type'] == $type['id']) ? 'selected' : '';
                                        echo '<option value="'.$type['id'].'" '.$selected.'>'.$type['title'].'</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-3 mb-2">
                                <select class="form-control" id="filter-status" onchange="filterUsers()">
                                    <option value="">All Statuses</option>
                                    <option value="1" <?= (isset($_GET['status'])) && $_GET['status'] == '1' ? 'selected' : '' ?>>Active</option>
                                    <option value="0" <?= (isset($_GET['status'])) && $_GET['status'] == '0' ? 'selected' : '' ?>>Inactive</option>
                                </select>
                            </div>
                            <div class="col-md-2 mb-2">
                                <button class="btn btn-outline-secondary btn-block" onclick="resetFilters()">
                                    <i class="fas fa-times"></i> Clear Filters
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
                                User List (<?= $total_items ?>)
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
                                
                                <span class="badge badge-primary mr-2">
                                    Showing <?= ($per_page > 0) ? min($offset + 1, $total_items) : 1 ?>-<?= ($per_page > 0) ? min($offset + $per_page, $total_items) : $total_items ?> of <?= $total_items ?>
                                </span>
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
                            <table class="table table-bordered table-hover" id="userTable" width="100%" cellspacing="0">
                                <thead class="thead-dark">
                                    <tr>
                                        <th width="40px">
                                            <input type="checkbox" id="selectAll" onclick="toggleSelectAll(this)">
                                        </th>
                                        <th width="50px">#</th>
                                        <th>User Details</th>
                                        <th width="150px">User Type</th>
                                        <th width="120px">Contact Info</th>
                                        <th width="150px">Created On</th>
                                        <th width="200px">Modules</th>
                                        <th width="120px">Status</th>
                                        <th width="100px" class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(count($users) > 0): ?>
                                        <?php foreach($users as $index => $user): ?>
                                            <?php
                                            // Get user modules
                                            $modules = return_multiple_rows(
                                                "SELECT title FROM og_module 
                                                INNER JOIN user_module ON og_module.id = user_module.og_module_id 
                                                WHERE user_module.uid = ".$user['loginuser_id']." 
                                                AND og_module.soft_delete = 0 AND user_module.soft_delete = 0"
                                            );
                                            
                                            $status_label = $user['user_isactive'] ? 'Active' : 'Inactive';
                                            $status_class = $user['user_isactive'] ? 'success' : 'danger';
                                            $created_date = date('M j, Y', strtotime($user['loginuser_createdon']));
                                            $profile_pic = !empty($user['profile_pic']) ? 
                                                BASE_URL.ABSOLUTE_IMAGEPATH.$user['profile_pic'] : 
                                                'https://ui-avatars.com/api/?name='.urlencode($user['username']).'&size=100';
                                            ?>
                                            <tr id="tr_<?= $user['loginuser_id'] ?>">
                                                <td>
                                                    <input type="checkbox" class="user-checkbox" value="<?= $user['loginuser_id'] ?>">
                                                </td>
                                                <td><?= $index + $offset + 1 ?></td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <img src="<?= $profile_pic ?>" class="rounded-circle mr-3" width="40" height="40" alt="<?= $user['username'] ?>">
                                                        <div>
                                                            <strong><?= $user['username'] ?></strong>
                                                            <?php if(!empty($user['fullname'])): ?>
                                                                <div class="text-muted small"><?= $user['fullname'] ?></div>
                                                            <?php endif; ?>
                                                            <div class="text-muted small">ID: <?= $user['loginuser_id'] ?></div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="badge badge-info"><?= $user['title'] ?></span>
                                                </td>
                                                <td>
                                                    <div class="small">
                                                        <?php if(!empty($user['emailaddress'])): ?>
                                                            <div><i class="fas fa-envelope mr-2"></i><?= $user['emailaddress'] ?></div>
                                                        <?php endif; ?>
                                                        <?php if(!empty($user['phonenumber'])): ?>
                                                            <div><i class="fas fa-phone mr-2"></i><?= $user['phonenumber'] ?></div>
                                                        <?php endif; ?>
                                                    </div>
                                                </td>
                                                <td>
                                                    <small class="text-muted"><?= $created_date ?></small>
                                                </td>
                                                <td>
                                                    <div class="module-tags">
                                                        <?php foreach($modules as $module): ?>
                                                            <span class="badge badge-success mb-1"><?= $module['title'] ?></span>
                                                        <?php endforeach; ?>
                                                        <?php if(empty($modules)): ?>
                                                            <small class="text-muted">No modules assigned</small>
                                                        <?php endif; ?>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <?php if ($has_status): ?>
                                                            <?php if ($user['user_isactive'] == 1): ?>
                                                                <span id="status_<?= $user['loginuser_id'] ?>" class="badge badge-success">Active</span>
                                                                <input type="checkbox" data-id="<?= $user['loginuser_id'] ?>" class="js-switch" checked />
                                                            <?php else: ?>
                                                                <span id="status_<?= $user['loginuser_id'] ?>" class="badge badge-danger">Inactive</span>
                                                                <input type="checkbox" data-id="<?= $user['loginuser_id'] ?>" class="js-switch" />
                                                            <?php endif; ?>
                                                        <?php else: ?>
                                                            <span class="badge badge-<?= $status_class ?>"><?= $status_label ?></span>
                                                        <?php endif; ?>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <div class="dropdown">
                                                        <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" 
                                                            id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" 
                                                            aria-expanded="false">
                                                            <i class="fas fa-cog"></i>
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                                            <?php if($has_edit): ?>
                                                            <a class="dropdown-item" href="edituser.php?id=<?= encrypt_($user['loginuser_id']) ?>">
                                                                <i class="fas fa-edit fa-fw"></i> Edit
                                                            </a>
                                                            <?php endif; ?>
                                                            
                                                            
                                                            <?php if($has_status): ?>
                                                            <div class="dropdown-divider"></div>
                                                            <a class="dropdown-item" href="#" onclick="toggleStatus(<?= $user['loginuser_id'] ?>, <?= $user['user_isactive'] ?>)">
                                                                <i class="fas fa-power-off fa-fw"></i> <?= $user['user_isactive'] ? 'Deactivate' : 'Activate' ?>
                                                            </a>
                                                            <?php endif; ?>
                                                            
                                                            <?php if($has_delete): ?>
                                                            <div class="dropdown-divider"></div>
                                                            <a class="dropdown-item text-danger" href="#" onclick="deleteUser(<?= $user['loginuser_id'] ?>)">
                                                                <i class="fas fa-trash fa-fw"></i> Delete
                                                            </a>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="9" class="text-center">No users found</td>
                                        </tr>
                                    <?php endif; ?>
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
                                        <a class="page-link" href="?page=1<?= $page_link ?>&per_page=<?= $per_page ?>" aria-label="First">
                                            <span aria-hidden="true">&laquo;&laquo;</span>
                                        </a>
                                    </li>
                                    
                                    <!-- Previous Page Link -->
                                    <li class="page-item <?= ($current_page == 1) ? 'disabled' : '' ?>">
                                        <a class="page-link" href="?page=<?= ($current_page - 1) ?><?= $page_link ?>&per_page=<?= $per_page ?>" aria-label="Previous">
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
                                            <a class="page-link" href="?page=<?= $i ?><?= $page_link ?>&per_page=<?= $per_page ?>"><?= $i ?></a>
                                        </li>
                                    <?php endfor; ?>
                                    
                                    <!-- Next Page Link -->
                                    <li class="page-item <?= ($current_page == $total_pages) ? 'disabled' : '' ?>">
                                        <a class="page-link" href="?page=<?= ($current_page + 1) ?><?= $page_link ?>&per_page=<?= $per_page ?>" aria-label="Next">
                                            <span aria-hidden="true">&raquo;</span>
                                        </a>
                                    </li>
                                    
                                    <!-- Last Page Link -->
                                    <li class="page-item <?= ($current_page == $total_pages) ? 'disabled' : '' ?>">
                                        <a class="page-link" href="?page=<?= $total_pages ?><?= $page_link ?>&per_page=<?= $per_page ?>" aria-label="Last">
                                            <span aria-hidden="true">&raquo;&raquo;</span>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="card-footer small text-muted">
                        Updated at <?= date('Y-m-d H:i:s') ?>
                    </div>
                </div>
            </div>
            
            <div id="deletemodal"></div>
            <?php include 'includes/footer_copyright.php';?>
        </div>
    </div>

    <?php include 'includes/footer.php';?>

    <script type="text/javascript" src="js/user/users.js"></script>

    <script>
    // Initialize DataTable
    $(document).ready(function() {
   
        $('#userTable').DataTable({
            "paging": false,
            "searching": false,
            "info": false,
            "ordering": true
        });
    });

    function filterUsers() {
        const status = document.getElementById('filter-status').value;
        const type = document.getElementById('filter-type').value;
        const search = "<?= isset($_GET['search']) ? $_GET['search'] : '' ?>";
        const per_page = document.getElementById('per_page').value;
        
        let url = '?page=1'; // Always reset to page 1 when filtering
        
        if (status) url += '&status=' + status;
        if (type) url += '&type=' + type;
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
        $preserve_params = ['status', 'type', 'search'];
        foreach($preserve_params as $param) {
            echo "if('".(isset($_GET[$param]) ? $_GET[$param] : '')."') url += '&$param=".(isset($_GET[$param]) ? $_GET[$param] : '')."';";
        }
        ?>
        
        window.location.href = url;
    }
    
    function deleteUser(userId) {
        createmodal('Delete User', 'Are you sure you want to delete this user?', userId, 'deletemodal', function(){
            senddata(
                'post/user/users.php',
                "POST",
                {id: userId, delete_user: true},
                function(result) {
                    const response = JSON.parse(result);
                    if(response.success) {
                        $('#tr_' + userId).fadeOut();
                        showNotification('success', response.message);
                    } else {
                        showNotification('danger', response.message);
                    }
                },
                function(error) {
                    showNotification('danger', 'An error occurred while deleting the user');
                }
            );
            $('#custommodal').modal('toggle');
        });
        $('#custommodal').modal('toggle');
    }
    
    function toggleStatus(userId, currentStatus) {
        const newStatus = currentStatus ? 0 : 1;
        const statusText = newStatus ? 'activate' : 'deactivate';
        
        if(confirm(`Are you sure you want to ${statusText} this user?`)) {
            senddata(
                'post/user/users.php',
                "POST",
                {id: userId, toggle_status: true, new_status: newStatus},
                function(result) {
                    const response = JSON.parse(result);
                    if(response.success) {
                        // Update status display
                        const statusBadge = $('#status_' + userId);
                        const statusSwitch = $('input[data-id="' + userId + '"]');
                        
                        if(newStatus) {
                            statusBadge.removeClass('badge-danger').addClass('badge-success').text('Active');
                            statusSwitch.prop('checked', true);
                        } else {
                            statusBadge.removeClass('badge-success').addClass('badge-danger').text('Inactive');
                            statusSwitch.prop('checked', false);
                        }
                        
                        showNotification('success', response.message);
                    } else {
                        showNotification('danger', response.message);
                    }
                },
                function(error) {
                    showNotification('danger', 'An error occurred while updating user status');
                }
            );
        }
    }
    
    function toggleSelectAll(source) {
        const checkboxes = document.querySelectorAll('.user-checkbox');
        checkboxes.forEach(checkbox => {
            checkbox.checked = source.checked;
        });
        updateSelectedCount();
    }
    
    function updateSelectedCount() {
        const selected = document.querySelectorAll('.user-checkbox:checked').length;
        document.getElementById('selectedCount').textContent = selected;
    }
    
    // Add event listeners to all checkboxes
    document.addEventListener('DOMContentLoaded', function() {
        const checkboxes = document.querySelectorAll('.user-checkbox');
        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', updateSelectedCount);
        });
    });
    
    function bulkAction(action) {
        const selected = [];
        document.querySelectorAll('.user-checkbox:checked').forEach(checkbox => {
            selected.push(checkbox.value);
        });
        
        if (selected.length === 0) {
            alert('Please select at least one user.');
            return;
        }
        
        if (confirm(`Are you sure you want to ${action} ${selected.length} user(s)?`)) {
            $.ajax({
                url: 'post/user/bulk_actions.php',
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