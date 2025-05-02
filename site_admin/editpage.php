<?php 
include 'admin_connect.php';

// With additional libraries
$extra_libs = [];

AdminHeader(
    "dashboard Admin", 
    "", 
    $extra_libs,
    null,
    '

    '
);

?>

<body id="page-top">
   <?php include 'includes/notification.php'; ?>

<style type="text/css">
    /* Modern Color Scheme */
    :root {
        --primary-color: #4e73df;
        --secondary-color: #858796;
        --success-color: #1cc88a;
        --info-color: #36b9cc;
        --warning-color: #f6c23e;
        --danger-color: #e74a3b;
        --light-color: #f8f9fc;
        --dark-color: #5a5c69;
    }

    .form-switch .form-check-label {
        font-weight: 500;
        user-select: none;
        cursor: pointer;
        vertical-align: middle;
        margin-left: 0.5rem;
        color: var(--dark-color);
    }


      /* Consistent card styling */
    .card {
        margin-bottom: 20px;
        border: 1px solid rgba(0,0,0,.125);
        border-radius: 0.25rem;
    }
    
    .card-header {
        background-color: #f8f9fa;
        border-bottom: 1px solid rgba(0,0,0,.125);
        padding: 0.75rem 1.25rem;
    }
    
    .card-body {
        padding: 1.25rem;
    }

    /* Tab styling */
    .nav-tabs {
        border-bottom: 2px solid #e3e6f0;
    }

    .nav-tabs .nav-link {
        border: none;
        color: var(--secondary-color);
        font-weight: 600;
        padding: 1rem 1.5rem;
        transition: all 0.3s;
    }

    .nav-tabs .nav-link:hover {
        color: var(--primary-color);
        border-bottom: 2px solid var(--primary-color);
    }

    .nav-tabs .nav-link.active {
        color: var(--primary-color);
        background: transparent;
        border-bottom: 2px solid var(--primary-color);
    }

    /* Editor styling */
    #simpleEditor {
        min-height: 300px;
        font-family: 'SFMono-Regular', Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
        line-height: 1.6;
        padding: 1rem;
        border: 1px solid #d1d3e2;
        border-radius: 0.35rem;
        background-color: #f8f9fc;
        resize: vertical;
        transition: all 0.3s;
    }

    #simpleEditor:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
    }

    /* URL Lock Toggle */
    .url-lock-toggle {
        cursor: pointer;
        padding: 0.5rem;
        border: 1px solid #d1d3e2;
        border-radius: 0.35rem;
        background-color: #f8f9fc;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        height: calc(2.25rem + 2px);
        width: 100%;
        transition: all 0.3s ease;
    }

    .url-lock-toggle:hover {
        background-color: #e3e6f0;
        border-color: #b7b9cc;
    }

    .url-lock-toggle #urlLockIcon {
        font-size: 1.1rem;
        color: var(--dark-color);
        transition: all 0.3s;
    }

    #check_url:checked ~ #urlLockIcon {
        color: var(--success-color);
    }

    /* Form group spacing */
    .form-group.row {
        align-items: center;
        margin-bottom: 1.5rem;
    }

    /* Validation feedback */
    .valid-feedback {
        color: var(--success-color);
    }

    .invalid-feedback {
        color: var(--danger-color);
    }

    /* Page header */
    .page-header {
        padding-bottom: 1rem;
        margin-bottom: 2rem;
        border-bottom: 1px solid #e3e6f0;
        color: var(--dark-color);
    }
</style>


   <?php

   // Validate page ID
    if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
        ?>
        <div class="container mt-5">
            <div class="alert alert-danger">
                <h4 class="alert-heading">Invalid Page ID</h4>
                <p>The page ID is missing or invalid. Please check the URL and try again.</p>
                <hr>
                <p class="mb-0"><a href="pages.php" class="alert-link">Return to pages list</a></p>
            </div>
        </div>
        <?php
        exit;
    }

   $page = return_single_row("SELECT * FROM pages WHERE pid = {$_GET['id']} $and_gc");
   
    $useCKEditor = isset($page['useCKEditor']) ? (int)$page['useCKEditor'] : 0;

   ?>

   <div id="wrapper">
      <?php include 'includes/sidebar.php'; ?>
      <div id="content-wrapper">
         <div class="container-fluid">
            <div class="container-fluid">
               <!-- Page Heading -->
               <div class="row">
                  <div class="col-lg-12">
                     <h3 class="page-header">Update Page</h3>
                  </div>
               </div>
               <!-- /.Content From Here -fluid -->
               <!-- Page Content -->
               <div id="error_id"></div>
               <div id="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <!-- Form Section (9 columns) -->
            <div class="col-lg-9">
                <form class="needs-validation" onsubmit="return false" novalidate>
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <!-- Description Tab -->
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#home">
                                <i class="fa fa-file-text"></i> Description
                            </a>
                        </li>
                        <!-- SEO Tab -->
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#menu1">
                                <i class="fa fa-search"></i> SEO
                            </a>
                        </li>
                        <!-- HEADER Tab -->
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#menu2">
                                <i class="fa fa-header"></i> HEADER
                            </a>
                        </li>
                        <!-- TEMPLATE Tab -->
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#menu3">
                                <i class="fa fa-code"></i> TEMPLATE
                            </a>
                        </li>
                        <!-- Media Tab -->
                         <li class="nav-item">
                            <a class="nav-link <?php echo (isset($_GET['media_type']) || isset($_GET['media_action'])) ? 'active' : ''; ?>" data-toggle="tab" href="#menu4" aria-selected="false">
                                <i class="fa fa-image"></i> Media
                            </a>
                        </li>
                        <!-- Adds On Tab -->
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#menu5">
                                <i class="fa fa-plus"></i> Adds On
                            </a>
                        </li>
                        <!-- Adds On Tab -->
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <!-- Description Tab Content -->
                        <div id="home" class="container tab-pane active">
                            <!-- Title -->
                            <div class="form-group row">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Title</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="page_title" required="required" placeholder="Enter Page title" name="page_title" value="<?php echo $page['page_title']; ?>">
                                    <div class="valid-feedback">Valid.</div>
                                    <div class="invalid-feedback">Please fill out this field.</div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="ctname" class="col-sm-2 col-form-label">Category</label>
                                <div class="col-sm-10">
                                    <select class="form-control" id="ctname" required name="ctname">
                                        <?php 
                                        // Get categories from database
                                        $categories = return_multiple_rows("SELECT catname, catid FROM category $where_gc AND isactive = 1");
                                        
                                        foreach ($categories as $category) {
                                            $selected = ($page['catid'] == $category['catid']) ? 'selected' : '';
                                            $catname = htmlspecialchars($category['catname'], ENT_QUOTES, 'UTF-8');
                                            $catid = (int)$category['catid'];
                                            
                                            echo "<option value='{$catid}' {$selected}>{$catname}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <!-- URL -->
                           <div class="form-group row align-items-center">
                                <label for="page_url" class="col-sm-2 col-form-label">URL</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="page_url" required placeholder="Page URL" 
                                           name="page_url" value="<?php echo htmlspecialchars($page['page_url']); ?>" readonly>
                                </div>
                                <div class="col-sm-2">
                                    <div class="d-flex align-items-center h-100">
                                        <label class="url-lock-toggle m-0">
                                            <input type="checkbox" class="d-none" id="check_url">
                                            <i class="fas fa-lock" id="urlLockIcon"></i>
                                            <span class="sr-only">Toggle URL editing</span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <!-- Featured Image -->
                            <div class="form-group row">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Featured Image</label>
                                <div class="col-sm-10">
                                    <div class="form-inline">
                                        <input type="text" value="<?php echo $page['featured_image']; ?>" class="form-control col-sm-10" id="p_image" placeholder="Choose Image" name="p_image">
                                        <button class="btn btn-primary form-control col-sm-2" onclick="OpenMediaGallery('p_image' , 'page')" type="button">
                                            <i class="fa fa-picture-o"></i>&nbsp;Gallery
                                        </button>
                                        <div class="valid-feedback">Valid.</div>
                                        <div class="invalid-feedback">Please fill out this field.</div>
                                    </div>
                                </div>
                            </div>

                           <!-- Description -->
                                    <!-- Toggle Switch -->
                                   <div class="form-check form-switch mb-2">
                                        <input class="form-check-input" type="checkbox" id="editorToggle" <?php echo $useCKEditor === 1 ? 'checked' : ''; ?>>
                                        <label class="form-check-label" for="editorToggle">Rich Text Editor</label>
                                    </div>

                                    <!-- Textarea (initially hidden if using CKEditor) -->
                                    <textarea class="form-control" id="simpleEditor" name="editor1" style="<?php echo $useCKEditor === 1 ? 'display:none;' : ''; ?>"><?php 
                                        // Remove indentation to avoid whitespace issues
                                        echo replaceTextArea($page['page_desc']); 
                                    ?></textarea>

                                    <!-- CKEditor Container (initially shown if using CKEditor) -->
                                    <div id="ckeditorContainer" style="<?php echo $useCKEditor !== 1 ? 'display:none;' : ''; ?>">
                                        <textarea class="form-control" id="editor1" name="editor1"><?php 
                                            echo replaceTextArea($page['page_desc']); 
                                        ?></textarea>
                                    </div>

                        </div>

                        <!-- SEO Tab Content -->
                        <div id="menu1" class="container tab-pane fade">
                            <!-- Meta Title -->
                            <div class="form-group row">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Meta Title</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="meta_title" placeholder="Update Title" name="meta_title" value="<?php echo $page['page_meta_title']; ?>">
                                </div>
                            </div>

                            <!-- Meta Keywords -->
                            <div class="form-group row">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Meta Keywords</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="meta_keywords" placeholder="Comma separated" name="meta_keywords" value="<?php echo $page['page_meta_keywords']; ?>">
                                </div>
                            </div>

                            <!-- Meta Description -->
                            <div class="form-group row">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Meta Description</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" id="meta_desc" name="meta_desc"><?php echo $page['page_meta_desc']; ?></textarea>
                                    <div class="valid-feedback">Valid.</div>
                                    <div class="invalid-feedback">Please fill out this field.</div>
                                </div>
                            </div>
                        </div>

                        <!-- HEADER Tab Content -->
                        <div id="menu2" class="container tab-pane fade">
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <textarea class="form-control" rows="10" id="header" placeholder="Update Header Files" name="editor1"><?php echo $page['header']; ?></textarea>
                                    <div class="valid-feedback">Valid.</div>
                                    <div class="invalid-feedback">Please fill out this field.</div>
                                </div>
                            </div>
                        </div>

                        <!-- TEMPLATE Tab Content -->
                        <div id="menu3" class="container tab-pane fade">
                            <!-- Main Template -->
                            <div class="form-group row">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Main Template</label>
                                <div class="col-sm-10">
                                    <select type="text" class="form-control" id="site_template" required="required" name="site_template">
                                        <?php
                                        $site_templates = return_multiple_rows("SELECT st_id, st_name FROM site_template $where_gc AND isactive = 1");
                                        foreach ($site_templates as $site_template) {
                                            $isselected = ($page['site_template_id'] == $site_template['st_id']) ? "selected" : "";
                                            echo "<option value='{$site_template['st_id']}' $isselected>{$site_template['st_name']}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <!-- Template Page -->
                            <div class="form-group row">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Template Page</label>
                                <div class="col-sm-10">
                                    <select type="text" class="form-control" id="template_page" required="required" name="template_page">
                                        <?php
                                        $og_templates = return_multiple_rows("SELECT template_title, template_id FROM og_template $where_gc AND isactive = 1");
                                        foreach ($og_templates as $og_template) {
                                            $isselected = ($page['template_id'] == $og_template['template_id']) ? "selected" : "";
                                            echo "<option value='{$og_template['template_id']}' $isselected>{$og_template['template_title']}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Photo Gallery Tab Content -->
                        <div id="menu4" class="container tab-pane fade">
                            <?php echo include_module('modules/page/media_tab_module.php', array('action' => "edit" , 'page' => array($page) )); ?>
                        </div>

                        <!-- Addson Tab Content -->
                        <div id="menu5" class="container tab-pane fade">
                            <?php echo include_module('modules/page/add_attributes_module.php', array('action' => "edit" , 'page' => array($page) )); ?>
                        </div>

                         <!-- Parameters Tab Content -->
                        <div id="menu6" class="container tab-pane fade">
                            <?php echo include_module('modules/page/dynamic_sections_module.php', array('action' => "edit" , 'page' => array($page) )); ?>
                        </div>

                    </div>
                
                <script type="text/javascript">
                    var page_id = "<?php echo $page['pid']; ?>";
                </script>
            </div>

            <!-- Page Categories and Publish Section (3 columns) -->
            <div class="col-lg-3">
               <!-- Publish Section -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Publish</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                                <div class="form-group">
                                    <a href="<?php echo BASE_URL . $page['page_url']; ?>" id="previewLink" class="btn btn-secondary btn-block">
                                        <i class="fa fa-eye"></i> Preview
                                    </a>
                                </div>
                        </div>
                        <!-- Moved Show in Navbar here -->
                        <div class="form-group mb-3">
                            <label for="showInNavbar">Show in Navigation:</label>
                            <select id="showInNavbar" class="form-control">
                                <option value="1" <?= $page['showInNavBar'] == 1 ? 'selected' : '' ?>>Yes</option>
                                <option value="0" <?= $page['showInNavBar'] != 1 ? 'selected' : '' ?>>No</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="postStatus">Status:</label>
                            <select id="is_active" name="is_active" class="form-control">
                                <option value="0" <?php echo ($page['isactive'] == 0) ? 'selected' : ''; ?>>Draft</option>
                                <option value="1" <?php echo ($page['isactive'] == 1) ? 'selected' : ''; ?>>Published</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="postVisibility">Visibility:</label>
                            <select id="postVisibility" class="form-control">
                                <option <?php echo ($page['visibility'] == 1) ? 'selected' : ''; ?> value="1">Public</option>
                                <option <?php echo ($page['visibility'] == 0) ? 'selected' : ''; ?> value="0">Private</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <button type="submit" id="submit_btn" class="btn btn-primary btn-block">Publish</button>
                        </div>
                    </div>
                </div>
        <!-- Page Categories Section -->
                <div class="card mb-3">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">Page Categories</h5>
                        <a class="btn btn-sm btn-outline-secondary maximize-categories" title="Maximize">
                            <i class="fas fa-expand"></i>
                        </a>
                    </div>
                    <div class="card-body p-0">
                        <div class="form-group row m-0">
                            <div class="col-lg p-3" id="category_list" style="max-height: 300px; overflow-x: hidden; overflow-y: auto;">
                                <?php
                                // Fetch selected categories for the current page
                                $selected_categories = return_multiple_rows("SELECT cat_id FROM page_category WHERE page_id = " . $page['pid'] . " AND isactive = 1 AND soft_delete = 0");

                                // Extract cat_id values into a simple array
                                $selected_cat_ids = array_column($selected_categories, 'cat_id');

                                // Build the menu structure
                                $menus = array(
                                    'items' => array(),
                                    'parents' => array()
                                );

                                // Fetch all categories
                                $p_cats = return_multiple_rows("SELECT catid, catname, cat_url, ParentCategory FROM category WHERE isactive = 1 AND soft_delete = 0");

                                // Populate the menu structure
                                foreach ($p_cats as $p_cat) {
                                    $menus['items'][$p_cat['catid']] = $p_cat;
                                    $menus['parents'][$p_cat['ParentCategory']][] = $p_cat['catid'];
                                }

                                // Render the multi-level checkbox structure
                                echo createmulltilevelcheckbox(0, $menus, $selected_cat_ids);
                                ?>
                            </div>
                        </div>
                    </div>
                </div>

                <style>
                    .maximized-categories {
                        position: fixed;
                        top: 0;
                        left: 0;
                        width: 100%;
                        height: 100%;
                        z-index: 1050;
                        background: white;
                        overflow: auto;
                    }
                    .maximized-categories #category_list {
                        max-height: none !important;
                        height: calc(100vh - 100px) !important;
                    }
                </style>

                <script>
                $(document).ready(function() {
                    $('.maximize-categories').click(function() {
                        const card = $(this).closest('.card');
                        const isMaximized = card.hasClass('maximized-categories');
                        
                        if (isMaximized) {
                            card.removeClass('maximized-categories');
                            $(this).html('<i class="fas fa-expand"></i>');
                            $(this).attr('title', 'Maximize');
                        } else {
                            card.addClass('maximized-categories');
                            $(this).html('<i class="fas fa-compress"></i>');
                            $(this).attr('title', 'Minimize');
                        }
                    });
                });
                </script>

            </div>
            </form>
        </div>
    </div>
</div>

                <script type="text/javascript" src="js/page/editpage.js"></script>

            </div>
            <!-- /.container-fluid -->
            <?php include 'includes/footer_copyright.php'; ?>
         </div>
         <!-- /.content-wrapper -->
      </div>
      <!-- /#wrapper -->
      <?php echo include_module('modules/upload_image.php', null); ?>
      <?php include 'includes/footer.php'; ?>