<?php 
include 'admin_connect.php';

// With additional libraries
$extra_libs = [
    '<link href="css/page/comments.css" rel="stylesheet">',
    '<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet">'
];

AdminHeader(
    "Comment Moderation", 
    "Approve or reject user comments", 
    $extra_libs
);

// Initialize variables
$status_filter = " AND is_approved = 0 "; // Default to pending approval
$search_filter = "";
$page_link = "";
$current_page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$per_page = isset($_GET['per_page']) ? intval($_GET['per_page']) : 50;

// Status filter
if(isset($_GET['status']) && $_GET['status'] !== '') {
    $status = $_GET['status'];
    if($status == 'all') {
        $status_filter = "";
    } else {
        $status_filter = " AND is_approved = $status ";
    }
    $page_link .="&status=".$status;
}

// Search filter
if(isset($_GET['search']) && !empty($_GET['search'])) {
    $search = trim($_GET['search']);
    $search_filter = " AND (comment_text LIKE '%$search%' OR guest_name LIKE '%$search%') ";
    $page_link .="&search=".urlencode($search);
}

// Get total count
$total_query = "SELECT COUNT(*) as total FROM pages_comments WHERE 1 $status_filter $search_filter";
$total_result = return_single_row($total_query);
$total_items = $total_result['total'];

// Calculate pagination
$total_pages = ($per_page > 0) ? ceil($total_items / $per_page) : 1;
$offset = ($current_page - 1) * $per_page;

// Get paginated data
$query = "SELECT c.*, 
                 u.username, u.fullname, u.profile_pic,
                 p.page_title, p.page_url
          FROM pages_comments c
          LEFT JOIN loginuser u ON c.user_id = u.id
          LEFT JOIN pages p ON c.pid = p.pid
          WHERE 1 $status_filter $search_filter 
          ORDER BY created_at DESC";
    
if ($per_page > 0) {
    $query .= " LIMIT $offset, $per_page";
}

$comments = return_multiple_rows($query);
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
                    <li class="breadcrumb-item active">Comment Moderation</li>
                </ol>

                <!-- Page Content -->
                <h3 class="page-header">
                    Comments Needing Approval (<?php echo $total_items; ?>)
                    <button style="float:right" class="btn btn-info btn-md" onclick="refreshComments()">
                        <i class="fas fa-sync-alt"></i> Refresh
                    </button>
                </h3>

                <hr>

                <!-- Search and Filter Options -->
                <div class="row mb-3">
                    <div class="col-12 mb-2">
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <form method="get" action="">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="search" placeholder="Search comments..." 
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
                                <select class="form-control" id="filter-status" onchange="filterComments()">
                                    <option value="0" <?= (isset($_GET['status']) && $_GET['status'] == '0' ? 'selected' : '') ?>>Pending Approval</option>
                                    <option value="1" <?= (isset($_GET['status']) && $_GET['status'] == '1' ? 'selected' : '') ?>>Approved</option>
                                    <option value="all" <?= (isset($_GET['status']) && $_GET['status'] == 'all' ? 'selected' : '') ?>>All Comments</option>
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
                                <i class="fas fa-comments"></i>
                                Comment Moderation Queue
                            </div>
                            <div class="d-flex align-items-center">
                                <!-- Bulk Actions Dropdown -->
                                <div class="dropdown mr-2">
                                    <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" id="bulkActionsDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Bulk Actions
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="bulkActionsDropdown">
                                        <a class="dropdown-item" href="#" onclick="bulkAction('approve')"><i class="fas fa-check fa-fw"></i> Approve Selected</a>
                                        <a class="dropdown-item" href="#" onclick="bulkAction('reject')"><i class="fas fa-times fa-fw"></i> Reject Selected</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item text-danger" href="#" onclick="bulkAction('delete')"><i class="fas fa-trash fa-fw"></i> Delete Selected</a>
                                    </div>
                                </div>
                                
                                <span class="badge badge-primary mr-2">Showing <?php echo ($per_page > 0) ? min($offset + 1, $total_items) : 1; ?>-<?php echo ($per_page > 0) ? min($offset + $per_page, $total_items) : $total_items; ?> of <?php echo $total_items; ?></span>
                                <select class="form-control form-control-sm" id="per_page" onchange="changePerPage()" style="width: 100px;">
                                    <option value="10" <?= $per_page == 10 ? 'selected' : '' ?>>10</option>
                                    <option value="25" <?= $per_page == 25 ? 'selected' : '' ?>>25</option>
                                    <option value="50" <?= $per_page == 50 ? 'selected' : '' ?>>50</option>
                                    <option value="100" <?= $per_page == 100 ? 'selected' : '' ?>>100</option>
                                    <option value="200" <?= $per_page == 200 ? 'selected' : '' ?>>200</option>
                                    <option value="0" <?= $per_page == 0 ? 'selected' : '' ?>>All</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover" id="commentsTable" width="100%" cellspacing="0">
                                <thead class="thead-dark">
                                    <tr>
                                        <th width="40px">
                                            <input type="checkbox" id="selectAll" onclick="toggleSelectAll(this)">
                                        </th>
                                        <th width="60px">ID</th>
                                        <th>Comment</th>
                                        <th width="150px">Author</th>
                                        <th width="150px">Page</th>
                                        <th width="120px">Status</th>
                                        <th width="150px">Date</th>
                                        <th width="120px">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    if(count($comments) > 0) {
                                        foreach($comments as $comment) {
                                            $status_label = $comment['is_approved'] ? 'Approved' : 'Pending';
                                            $status_class = $comment['is_approved'] ? 'success' : 'warning';
                                            
                                            $author_name = $comment['user_id'] ? 
                                                ($comment['fullname'] ?: $comment['username']) : 
                                                $comment['guest_name'];
                                            
                                            $author_avatar = $comment['user_id'] ? 
                                                (BASE_URL.ABSOLUTE_IMAGEPATH . $comment['profile_pic']) : 
                                                'https://www.gravatar.com/avatar/'.md5(strtolower(trim($comment['guest_email']))).'?d=mp';
                                            
                                            $comment_date = date('M j, Y g:i a', strtotime($comment['created_at']));
                                            ?>
                                            <tr id="comment_<?=$comment['comment_id']?>">
                                                <td>
                                                    <input type="checkbox" class="comment-checkbox" value="<?=$comment['comment_id']?>">
                                                </td>
                                                <td><?=$comment['comment_id']?></td>
                                                <td>
                                                    <div class="comment-text">
                                                        <?=nl2br(htmlspecialchars($comment['comment_text']))?>
                                                        <?php if($comment['is_nsfw']): ?>
                                                            <span class="badge badge-danger ml-2">NSFW</span>
                                                        <?php endif; ?>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <img src="<?=$author_avatar?>" class="rounded-circle mr-2" width="40" height="40" alt="<?=$author_name?>">
                                                        <div>
                                                            <strong><?=$author_name?></strong><br>
                                                            <small><?=$comment['user_id'] ? 'User' : 'Guest'?></small>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="<?=BASE_URL.$comment['page_url']?>" target="_blank">
                                                        <?=mb_strimwidth($comment['page_title'], 0, 30, '...')?>
                                                    </a>
                                                </td>
                                                <td>
                                                    <span class="badge badge-<?=$status_class?>"><?=$status_label?></span>
                                                    <?php if($comment['is_nsfw']): ?>
                                                        <span class="badge badge-danger">NSFW</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <small class="text-muted"><?=$comment_date?></small>
                                                </td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            Actions
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                            <a class="dropdown-item" href="#" onclick="approveComment(<?=$comment['comment_id']?>)">
                                                                <i class="fas fa-check text-success fa-fw"></i> Approve
                                                            </a>
                                                            <a class="dropdown-item" href="#" onclick="rejectComment(<?=$comment['comment_id']?>)">
                                                                <i class="fas fa-times text-danger fa-fw"></i> Reject
                                                            </a>
                                                            <div class="dropdown-divider"></div>
                                                            <a class="dropdown-item" href="#" onclick="flagNsfw(<?=$comment['comment_id']?>, <?=$comment['is_nsfw'] ? 0 : 1?>)">
                                                                <i class="fas fa-flag fa-fw"></i> <?=$comment['is_nsfw'] ? 'Unflag NSFW' : 'Flag NSFW'?>
                                                            </a>
                                                            <div class="dropdown-divider"></div>
                                                            <a class="dropdown-item text-danger" href="#" onclick="deleteComment(<?=$comment['comment_id']?>)">
                                                                <i class="fas fa-trash fa-fw"></i> Delete
                                                            </a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    } else {
                                        echo '<tr><td colspan="8" class="text-center">No comments found</td></tr>';
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
                                    <button class="btn btn-sm btn-success mr-2" onclick="bulkAction('approve')">
                                        <i class="fas fa-check fa-fw"></i> Approve
                                    </button>
                                    <button class="btn btn-sm btn-danger mr-2" onclick="bulkAction('reject')">
                                        <i class="fas fa-times fa-fw"></i> Reject
                                    </button>
                                    <button class="btn btn-sm btn-dark" onclick="bulkAction('delete')">
                                        <i class="fas fa-trash fa-fw"></i> Delete
                                    </button>
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
                        Last updated <?=date('M j, Y g:i a')?>
                    </div>
                </div>
            </div>
            
            <div id="deletemodal"></div>
            <?php include 'includes/footer_copyright.php';?>
        </div>
    </div>

    <?php include 'includes/footer.php';?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script src="js/comments/bulk_action.js"></script>

    <script>
    function filterComments() {
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
    
    function refreshComments() {
        window.location.reload();
    }
    
    function toggleSelectAll(source) {
        const checkboxes = document.querySelectorAll('.comment-checkbox');
        checkboxes.forEach(checkbox => {
            checkbox.checked = source.checked;
        });
        updateSelectedCount();
    }
    
    function updateSelectedCount() {
        const selected = document.querySelectorAll('.comment-checkbox:checked').length;
        document.getElementById('selectedCount').textContent = selected;
    }
    
    // Add event listeners to all checkboxes
    document.addEventListener('DOMContentLoaded', function() {
        const checkboxes = document.querySelectorAll('.comment-checkbox');
        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', updateSelectedCount);
        });
    });
    
    function approveComment(commentId) {
        moderateComment(commentId, 'approve');
    }
    
    function rejectComment(commentId) {
        moderateComment(commentId, 'reject');
    }
    
    function flagNsfw(commentId, flag) {
        moderateComment(commentId, flag ? 'flag_nsfw' : 'unflag_nsfw');
    }
    
    function deleteComment(commentId) {
        if (confirm('Are you sure you want to delete this comment? This cannot be undone.')) {
            moderateComment(commentId, 'delete');
        }
    }
    
    function moderateComment(commentId, action) {
        senddata(
            'post/comments/moderate.php',
            'POST',
            { comment_id: commentId, action: action },
            function(response) {
                const result = JSON.parse(response);
                if (result.success) {
                    if (action === 'delete') {
                        // Remove the row from the table
                        $('#comment_' + commentId).remove();
                        showAlert('Comment deleted successfully', 'success');
                    } else {
                        // Refresh the page to show updated status
                        showAlert('Comment updated successfully', 'success');
                        setTimeout(() => location.reload(), 1000);
                    }
                } else {
                    showAlert(result.message, 'danger');
                }
            },
            function(error) {
                showAlert('An error occurred while processing your request', 'danger');
                console.error("Moderation Error:", error);
            }
        );
    }
    
    function bulkAction(action) {
        const selected = [];
        document.querySelectorAll('.comment-checkbox:checked').forEach(checkbox => {
            selected.push(checkbox.value);
        });

        if (selected.length === 0) {
            showAlert('Please select at least one comment', 'warning');
            return;
        }

        if (confirm(`Are you sure you want to ${action} ${selected.length} comment(s)?`)) {
            senddata(
                'post/comments/bulk_moderate.php',
                'POST',
                { action: action, comment_ids: selected },
                function(response) {
                    const result = JSON.parse(response);
                    if (result.success) {
                        showAlert(result.message, 'success');
                        setTimeout(() => location.reload(), 1000);
                    } else {
                        showAlert(result.message, 'danger');
                    }
                },
                function(error) {
                    showAlert('An error occurred while processing your request', 'danger');
                    console.error("Bulk Action Error:", error);
                }
            );
        }
    }
    </script>
</body>