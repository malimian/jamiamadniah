<?php include 'includes/header.php';?>

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
                        <a href="<?php echo $_SESSION['user']['dashboard'];?>">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">Menu Management</li>
                </ol>

                <!-- Page Content -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1 class="page-header mb-0">List of Menu</h1>
                    <a href="addmenue.php?action=add" class="btn btn-danger btn-md">
                        <i class="fa fa-plus"></i> Add Menu
                    </a>
                </div>

                <hr>

                <!-- Filter Section -->
                <div class="card mb-4">
                    <div class="card-body">
                        <form id="filterForm">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Parent Category</label>
                                        <select class="form-control" name="parent_category" id="parent_category">
                                            <option value="">All Categories</option>
                                            <?php 
                                            $parentCategories = return_multiple_rows("SELECT catid, catname FROM category WHERE ParentCategory = 0 AND soft_delete = 0 ORDER BY catname");
                                            foreach($parentCategories as $cat) {
                                                echo '<option value="'.$cat['catid'].'">'.$cat['catname'].'</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Show in NavBar</label>
                                        <select class="form-control" name="show_in_navbar" id="show_in_navbar">
                                            <option value="">All</option>
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4 d-flex align-items-end">
                                    <button type="button" class="btn btn-primary mr-2" onclick="applyFilters()">
                                        <i class="fa fa-filter"></i> Apply Filters
                                    </button>
                                    <button type="button" class="btn btn-secondary" onclick="resetFilters()">
                                        <i class="fa fa-times"></i> Reset
                                    </button>
                                </div>
                            </div>
                        </form>
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
                            $categories = return_multiple_rows("SELECT * FROM category $where_gc ORDER BY cat_sequence ASC");
                            foreach($categories as $category) {
                                static $count = 1;
                            ?> 
                            <tr id="tr_<?=$category['catid']?>">
                                <td><?=$count++;?></td>
                                <td><?=htmlspecialchars($category["catname"])?></td>
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
                                        <input type="checkbox" class="custom-control-input navbar-switch" 
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
                                               <?=$category['isactive'] == 1 ? 'checked' : ''?>>
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
                                            <a class="dropdown-item" href="editmenue.php?id=<?=$category['catid']?>&action=edit">
                                                <i class="fa fa-edit mr-2"></i>Edit
                                            </a>
                                            <a class="dropdown-item text-danger" onclick="delete_(<?=$category['catid']?>)">
                                                <i class="fa fa-trash mr-2"></i>Delete
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <?php } ?>      
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.container-fluid -->

            <div id="deletemodal"></div>
            <?php include 'includes/footer_copyright.php';?>
        </div>
        <!-- /.content-wrapper -->
    </div>
    <!-- /#wrapper -->

    <?php include 'includes/footer.php';?>
<script>
$(document).ready(function() {
    // Initialize switches
    initSwitches();
    
    // Apply filters from URL if present
    const urlParams = new URLSearchParams(window.location.search);
    if(urlParams.has('parent_category')) {
        $('#parent_category').val(urlParams.get('parent_category'));
    }
    if(urlParams.has('show_in_navbar')) {
        $('#show_in_navbar').val(urlParams.get('show_in_navbar'));
    }
    
    if($('#parent_category').val() || $('#show_in_navbar').val()) {
        applyFilters();
    }
});

// Filter functions
function applyFilters() {
    const parentCategory = $('#parent_category').val();
    const showInNavbar = $('#show_in_navbar').val();
    
    // Update URL without reloading
    const urlParams = new URLSearchParams();
    if(parentCategory) urlParams.set('parent_category', parentCategory);
    if(showInNavbar) urlParams.set('show_in_navbar', showInNavbar);
    window.history.replaceState({}, '', `${location.pathname}?${urlParams}`);
    
    // Show loading indicator
    $('#categoryTableBody').html('<tr><td colspan="7" class="text-center"><i class="fa fa-spinner fa-spin"></i> Loading...</td></tr>');
    
    // Send filter request to server
    $.ajax({
        url: 'post/category/categories.php',
        type: 'POST',
        data: {
            filter_categories: true,
            parent_category: parentCategory,
            show_in_navbar: showInNavbar
        },
        success: function(response) {
            try {
                const data = JSON.parse(response);
                renderTable(data);
            } catch(e) {
                console.error('Error parsing response:', e);
                $('#categoryTableBody').html('<tr><td colspan="7" class="text-center text-danger">Error loading data</td></tr>');
            }
        },
        error: function(xhr, status, error) {
            console.error(error);
            $('#categoryTableBody').html('<tr><td colspan="7" class="text-center text-danger">Error loading data</td></tr>');
        }
    });
}

function renderTable(categories) {
    let html = '';
    
    if(categories.length > 0) {
        categories.forEach((category, index) => {
            html += `
            <tr id="tr_${category.catid}">
                <td>${index + 1}</td>
                <td>${escapeHtml(category.catname)}</td>
                <td>
                    <div class="d-flex align-items-center">
                        <button class="btn btn-sm btn-outline-primary mr-2" onclick="changeSequence(${category.catid}, 'up')">
                            <i class="fa fa-arrow-up"></i>
                        </button>
                        <span id="seq_${category.catid}">${category.cat_sequence}</span>
                        <button class="btn btn-sm btn-outline-primary ml-2" onclick="changeSequence(${category.catid}, 'down')">
                            <i class="fa fa-arrow-down"></i>
                        </button>
                    </div>
                </td>
                <td>
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input navbar-switch" 
                               id="navbar_${category.catid}" 
                               data-id="${category.catid}"
                               ${category.showInNavBar == 1 ? 'checked' : ''}>
                        <label class="custom-control-label" for="navbar_${category.catid}"></label>
                    </div>
                </td>
                <td>${category.parent_name ? escapeHtml(category.parent_name) : 'Parent'}</td>
                <td>
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input js-switch" 
                               id="status_switch_${category.catid}" 
                               data-id="${category.catid}"
                               ${category.isactive == 1 ? 'checked' : ''}>
                        <label class="custom-control-label" for="status_switch_${category.catid}">
                            <span id="status_${category.catid}" class="badge ${category.isactive == 1 ? 'badge-success' : 'badge-danger'}">
                                ${category.isactive == 1 ? 'Active' : 'Inactive'}
                            </span>
                        </label>
                    </div>
                </td>
                <td>
                    <div class="dropdown">
                        <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" 
                                id="dropdownMenuButton_${category.catid}" 
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-cog"></i>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton_${category.catid}">
                            <a class="dropdown-item" href="editmenue.php?id=${category.catid}&action=edit">
                                <i class="fa fa-edit mr-2"></i>Edit
                            </a>
                            <a class="dropdown-item text-danger" onclick="delete_(${category.catid})">
                                <i class="fa fa-trash mr-2"></i>Delete
                            </a>
                        </div>
                    </div>
                </td>
            </tr>`;
        });
    } else {
        html = '<tr><td colspan="7" class="text-center">No records found</td></tr>';
    }
    
    $('#categoryTableBody').html(html);
    initSwitches(); // Reinitialize switches for new elements
}

function resetFilters() {
    $('#filterForm')[0].reset();
    window.history.replaceState({}, '', location.pathname);
    applyFilters(); // Reload without filters
}

// Initialize switches
function initSwitches() {
    $('.js-switch').off('change').on('change', function() {
        const id = $(this).data("id");
        const isActive = $(this).is(':checked') ? 1 : 0;
        
        $.ajax({
            url: 'post/category/categories.php',
            type: 'POST',
            data: {
                id: id,
                change_status: true,
                isactive: isActive
            },
            success: function() {
                $('#status_'+id).removeClass('badge-success badge-danger')
                               .addClass(isActive ? 'badge-success' : 'badge-danger')
                               .text(isActive ? 'Active' : 'Inactive');
            },
            error: function() {
                $(this).prop('checked', !isActive);
            }
        });
    });
    
    $('.navbar-switch').off('change').on('change', function() {
        const id = $(this).data("id");
        const showInNavbar = $(this).is(':checked') ? 1 : 0;
        
        $.ajax({
            url: 'post/category/categories.php',
            type: 'POST',
            data: {
                id: id,
                change_navbar: true,
                showInNavBar: showInNavbar
            },
            error: function() {
                $(this).prop('checked', !showInNavbar);
            }
        });
    });
}

// Sequence change handler - fixed version
function changeSequence(id, direction) {
    const row = $('#tr_' + id);
    const currentSeq = parseInt(row.find('td:eq(2) span').text());
    
    $.ajax({
        url: 'post/category/categories.php',
        type: 'POST',
        dataType: 'json', // Explicitly tell jQuery to expect JSON
        data: {
            id: id,
            change_sequence: true,
            direction: direction
        },
        success: function(data) { // data is already parsed JSON
            if (data.success) {
                // Update sequence numbers in UI
                row.find('td:eq(2) span').text(data.new_sequence);
                
                if (direction === 'up') {
                    const prevRow = row.prev();
                    if (prevRow.length && data.other_id) {
                        prevRow.find('td:eq(2) span').text(data.other_new_sequence);
                        row.insertBefore(prevRow);
                    }
                } else if (direction === 'down') {
                    const nextRow = row.next();
                    if (nextRow.length && data.other_id) {
                        nextRow.find('td:eq(2) span').text(data.other_new_sequence);
                        row.insertAfter(nextRow);
                    }
                }
                
                showNotification('success', 'Sequence updated successfully');
            } else {
                showNotification('info', data.message || 'No changes made');
            }
        },
        error: function(xhr, status, error) {
            console.error('AJAX Error:', status, error);
            showNotification('danger', 'Failed to update sequence');
            
            // For debugging - check the actual response
            console.log('Server response:', xhr.responseText);
        }
    });
}


// Helper functions
function escapeHtml(unsafe) {
    return unsafe
        .replace(/&/g, "&amp;")
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;")
        .replace(/"/g, "&quot;")
        .replace(/'/g, "&#039;");
}

function showNotification(type, message) {
    const notification = `<div class="alert alert-${type} alert-dismissible fade show" role="alert">
        ${message}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>`;
    $('#notification-container').html(notification);
}

</script>
</body>
</html>