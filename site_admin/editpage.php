<?php include 'includes/header.php'; ?>
<body id="page-top">
   <?php include 'setting/company_name.php'; ?>
   <?php include 'includes/navbar_search.php'; ?>
   <?php include 'includes/notification.php'; ?>

   <?php
   $page = return_single_row("SELECT * FROM pages WHERE pid = {$_GET['id']} $and_gc");
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
                        <!-- Photo Gallery Tab -->
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#menu4">
                                <i class="fa fa-image"></i> Photo Gallery
                            </a>
                        </li>
                        <!-- Shop Tab -->
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#menu5">
                                <i class="fa fa-shopping-cart"></i> Shop
                            </a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <!-- Description Tab Content -->
                        <div id="home" class="container tab-pane active">
                            <!-- Category -->
                            <div class="form-group row">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Category</label>
                                <div class="col-sm-10">
                                    <select type="text" class="form-control" id="ctname" required="required" name="ctname">
                                        <?php
                                        $categories = return_multiple_rows("SELECT catname, catid FROM category $where_gc AND isactive = 1");
                                        foreach ($categories as $category) {
                                            $isselected_cat = ($page['catid'] == $category['catid']) ? "selected" : "";
                                            echo "<option value='{$category['catid']}' $isselected_cat>{$category['catname']}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <!-- Title -->
                            <div class="form-group row">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Title</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="page_title" required="required" placeholder="Enter Page title" name="page_title" value="<?php echo $page['page_title']; ?>">
                                    <div class="valid-feedback">Valid.</div>
                                    <div class="invalid-feedback">Please fill out this field.</div>
                                </div>
                            </div>

                            <!-- URL -->
                            <div class="form-group row">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">URL</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="page_url" required="required" placeholder="Page URL" name="page_url" value="<?php echo $page['page_url']; ?>" readonly>
                                </div>
                                <div class="col-sm-2">
                                    <input type="checkbox" class="form-control minecheck" id="check_url" />
                                </div>
                            </div>

                            <!-- Featured Image -->
                            <div class="form-group row">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Featured Image</label>
                                <div class="col-sm-10">
                                    <div class="form-inline">
                                        <input type="text" value="<?php echo $page['featured_image']; ?>" class="form-control col-sm-10" id="p_image" placeholder="Choose Image" name="p_image">
                                        <button class="btn btn-primary form-control col-sm-2" onclick="OpenMediaGallery('p_image')" type="button">
                                            <i class="fa fa-picture-o"></i>&nbsp;Gallery
                                        </button>
                                        <div class="valid-feedback">Valid.</div>
                                        <div class="invalid-feedback">Please fill out this field.</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Description -->
                            <div class="form-group row">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Description</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" id="editor1" name="editor1" required="required"><?php echo replaceTextArea($page['page_desc']); ?></textarea>
                                    <div class="valid-feedback">Valid.</div>
                                    <div class="invalid-feedback">Please fill out this field.</div>
                                </div>
                            </div>

                            <!-- Show in Nav Bar -->
                            <div class="form-group row">
                                <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Show in Nav Bar</label>
                                <div class="col-sm-10">
                                    <select class="form-control form-control-sm" id="showInNavbar" name="showInNavbar">
                                        <option value="1" <?php if ($page['showInNavBar'] == 1) echo "selected"; ?>>YES</option>
                                        <option value="0" <?php if ($page['showInNavBar'] != 1) echo "selected"; ?>>NO</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Is Active -->
                            <div class="form-group row">
                                <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Is Active</label>
                                <div class="col-sm-10">
                                    <select class="form-control form-control-sm" id="is_active" name="is_active">
                                        <option value="1" <?php if ($page['isactive'] == 1) echo "selected"; ?>>YES</option>
                                        <option value="0" <?php if ($page['isactive'] != 1) echo "selected"; ?>>NO</option>
                                    </select>
                                </div>
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
                            <label for="colFormLabel" class="col-sm-5 col-form-label">Upload Photo Gallery</label>
                            <input class="form-control" type="file" id="files" name="files[]" multiple style="opacity: 100%; margin: 17px">

                            <?php
                            $photogallery = return_multiple_rows("SELECT * FROM images WHERE pid = {$_GET['id']} AND isactive = 1 AND soft_delete = 0");
                            if (!empty($photogallery)) {
                            ?>
                                <div class="container">
                                    <div class="row">
                                        <div class="col-12">
                                            <table class="table table-image">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Image</th>
                                                        <th scope="col">Name</th>
                                                        <th scope="col">Delete</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    foreach ($photogallery as $photogallery_) {
                                                    ?>
                                                        <tr id="dr_<?php echo $photogallery_['i_id']; ?>">
                                                            <td class="w-25">
                                                                <img src="<?php echo "../" . ABSOLUTE_IMAGEPATH . $photogallery_['i_name']; ?>" class="img-fluid img-thumbnail" alt="Sheep">
                                                            </td>
                                                            <td><?php echo $photogallery_['i_name']; ?></td>
                                                            <td>
                                                                <button onclick="delete_image(<?php echo $photogallery_['i_id']; ?>)" class="btn btn-danger btn-sm rounded-0" type="button" title="Delete">
                                                                    <i class="fa fa-trash"></i>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>

                        <!-- Shop Tab Content -->
                        <div id="menu5" class="container tab-pane fade">
                            <?php echo include_module('modules/add_product_module.php', array('action' => "edit" , 'page' => array($page) )); ?>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="form-group row">
                        <div class="col-sm-10"></div>
                        <div class="col-sm-2">
                            <input type="submit" name="submit" class="form-control btn btn-info" value="Submit" id="submit_btn" />
                        </div>
                    </div>
                </form>
                <script type="text/javascript">
                    var page_id = "<?php echo $page['pid']; ?>";
                </script>
                <script type="text/javascript" src="js/page/editpage.js"></script>
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
                            <button type="button" class="btn btn-secondary btn-block">Save Draft</button>
                            <button type="button" class="btn btn-secondary btn-block">Preview</button>
                        </div>
                        <div class="form-group">
                            <label for="postStatus">Status:</label>
                            <select id="postStatus" class="form-control">
                                <option value="draft">Draft</option>
                                <option value="published">Published</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="postVisibility">Visibility:</label>
                            <select id="postVisibility" class="form-control">
                                <option value="public">Public</option>
                                <option value="private">Private</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <button type="button" class="btn btn-danger btn-block">Move to Trash</button>
                            <button type="button" class="btn btn-primary btn-block">Publish</button>
                        </div>
                    </div>
                </div>
                <!-- Page Categories Section -->
                <div class="card mb-3">
                    <div class="card-header">
                        <h5 class="card-title">Page Categories</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-lg" id="category_list">
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
            </div>
        </div>
    </div>
</div>
            </div>
            <!-- /.container-fluid -->
            <?php include 'includes/footer_copyright.php'; ?>
         </div>
         <!-- /.content-wrapper -->
      </div>
      <!-- /#wrapper -->
      <?php echo include_module('modules/upload_image.php', null); ?>
      <?php include 'includes/footer.php'; ?>