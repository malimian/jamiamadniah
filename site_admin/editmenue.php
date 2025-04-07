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
   <?php include 'includes/notification.php';?>
   
   <?php
   // Initialize variables
   $category = [];
   $is_edit = false;
   $current_image = '';
   
   if (isset($_GET['action']) && $_GET['action'] == 'edit' && isset($_GET['id'])) {
       $is_edit = true;
       $category = return_single_row("SELECT * FROM category WHERE catid = ".$_GET['id']." $and_gc");
 
       if (!empty($category['catimage'])) {

           $current_image =  BASE_URL.$category['catimage'];
       }
   }
   ?>

   
   <div id="wrapper">
   <?php include 'includes/sidebar.php'; ?>
   <div id="content-wrapper">
      <div class="container-fluid">
         <div class="container-fluid">
            <!-- Page Heading -->
            <div class="row">
               <div class="col-lg-12">
                  <h3 class="page-header">
                     <?php echo $is_edit ? 'Update Menu Item' : 'Add New Menu Item'; ?>
                  </h3>
               </div>
            </div>
            
            <div id="error_id"></div>
            <div id="page-content-wrapper">
               <div class="container-fluid">
                  <div class="row">
                     <div class="col-lg-12">
                        <form class="needs-validation" onsubmit="return false" novalidate enctype="multipart/form-data">

                           <div class="form-group row">
                              <label for="page_title" class="col-sm-2 col-form-label">Title</label>
                              <div class="col-sm-10">
                                 <input type="text" class="form-control" id="page_title" required placeholder="Enter Menu title" name="page_title" value="<?php echo $is_edit ? htmlspecialchars($category['catname']) : ''; ?>">
                                 <div class="valid-feedback">Valid.</div>
                                 <div class="invalid-feedback">Please fill out this field.</div>
                              </div>
                           </div>

                           <div class="form-group row">
                              <label for="page_url" class="col-sm-2 col-form-label">URL</label>
                              <div class="col-sm-10">
                                 <input type="text" class="form-control" id="page_url" required placeholder="Menu URL" name="page_url" value="<?php echo $is_edit ? htmlspecialchars($category['cat_url']) : ''; ?>">
                              </div>
                           </div>

                           <!-- Image Upload Field -->
                           <div class="form-group row">
                              <label for="menu_image" class="col-sm-2 col-form-label">Image</label>
                              <div class="col-sm-10">
                                 <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="menu_image" name="menu_image" accept="image/*">
                                    <label class="custom-file-label" for="menu_image">
                                       <?php echo $is_edit && !empty($category['catimage']) ? htmlspecialchars($category['catimage']) : 'Choose image file'; ?>
                                    </label>
                                    <small class="form-text text-muted">Max size: 2MB (Recommended: 500x500 pixels)</small>
                                 </div>
                                 
                                 <!-- Image Preview Section -->
                                 <div id="image-preview" class="mt-2" style="<?php echo (!empty($current_image)) ? '' : 'display:none;'; ?>">
                                     <img src="<?php echo !empty($current_image) ? $current_image : '#'; ?>" alt="Current Image" class="img-thumbnail" style="max-height: 150px;">
                                 </div>
                                 
                                 <?php if ($is_edit && !empty($current_image)): ?>
                                    <div class="form-check mt-2">
                                       <input class="form-check-input" type="checkbox" id="remove_image" name="remove_image">
                                       <label class="form-check-label" for="remove_image">
                                          Remove current image
                                       </label>
                                    </div>
                                 <?php endif; ?>
                              </div>
                           </div>

                           <!-- Description Textarea -->
                           <div class="form-group row">
                              <label for="menu_description" class="col-sm-2 col-form-label">Description</label>
                              <div class="col-sm-10">
                                 <textarea class="form-control" id="menu_description" name="menu_description" rows="4" placeholder="Enter detailed description..."><?php echo $is_edit ? htmlspecialchars($category['catdesc']) : ''; ?></textarea>
                              </div>
                           </div>
                           
                           <div class="form-group row">
                              <label for="ctname" class="col-sm-2 col-form-label">Parent Category</label>
                              <div class="col-sm-10">
                                 <select class="form-control" id="ctname" required name="ctname">
                                    <option value="0">None</option>
                                    <?php 
                                    $categories = return_multiple_rows("SELECT catname, catid, ParentCategory FROM category $where_gc AND isactive = 1");
                                    foreach ($categories as $cat) {
                                        $selected = ($is_edit && $category['ParentCategory'] == $cat['catid']) ? 'selected' : '';
                                        $catname = htmlspecialchars($cat['catname'], ENT_QUOTES, 'UTF-8');
                                        echo "<option value='".$cat['catid']."' $selected>".$catname."</option>";
                                    }
                                    ?>
                                 </select>
                              </div>
                           </div>

                           <div class="form-group row">
                              <label for="showInNavBar" class="col-sm-2 col-form-label col-form-label-sm">Show in Nav Bar</label>
                              <div class="col-sm-10">
                                 <select class="form-control form-control-sm" id="showInNavBar" name="showInNavBar">
                                    <option value="1" <?php echo ($is_edit && $category['showInNavBar'] == 1) ? 'selected' : ''; ?>>YES</option>
                                    <option value="0" <?php echo ($is_edit && $category['showInNavBar'] == 0) ? 'selected' : ''; ?>>NO</option>
                                 </select>
                              </div>
                           </div>

                           <div class="form-group row">
                              <label for="CreateHierarchy" class="col-sm-2 col-form-label col-form-label-sm">Create Hierarchy</label>
                              <div class="col-sm-10">
                                 <select class="form-control form-control-sm" id="CreateHierarchy" name="CreateHierarchy">
                                    <option value="1" <?php echo ($is_edit && $category['CreateHierarchy'] == 1) ? 'selected' : ''; ?>>YES</option>
                                    <option value="0" <?php echo ($is_edit && $category['CreateHierarchy'] == 0) ? 'selected' : ''; ?>>NO</option>
                                 </select>
                              </div>
                           </div>
                        
                           <div class="form-group row">
                              <label for="is_active" class="col-sm-2 col-form-label col-form-label-sm">Is Active</label>
                              <div class="col-sm-10">
                                 <select class="form-control form-control-sm" id="is_active" name="is_active">
                                    <option value="1" <?php echo ($is_edit && $category['isactive'] == 1) ? 'selected' : ''; ?>>YES</option>
                                    <option value="0" <?php echo ($is_edit && $category['isactive'] == 0) ? 'selected' : ''; ?>>NO</option>
                                 </select>
                              </div>
                           </div>

                           <div class="form-group row">
                              <label class="col-sm-2 col-form-label"></label>
                              <div class="col-sm-2" style="float:right;">
                                 <input type="submit" name="submit" class="form-control btn btn-info" value="<?php echo $is_edit ? 'Update' : 'Submit'; ?>" id="submit_btn">
                                 <?php if ($is_edit): ?>
                                    <input type="hidden" id="menu_id" value="<?php echo $category['catid']; ?>">
                                 <?php endif; ?>
                              </div>
                           </div>
                        </form>
                        
                        <script>
                           // Image preview functionality
                           document.getElementById('menu_image').addEventListener('change', function(e) {
                              const preview = document.getElementById('image-preview');
                              const previewImg = preview.querySelector('img');
                              
                              if (this.files && this.files[0]) {
                                 const reader = new FileReader();
                                 
                                 reader.onload = function(e) {
                                    previewImg.src = e.target.result;
                                    preview.style.display = 'block';
                                 }
                                 
                                 reader.readAsDataURL(this.files[0]);
                                 
                                 // Update file label
                                 document.querySelector('.custom-file-label').textContent = this.files[0].name;
                              }
                           });
                           
                           // Use the same JS file for both add and edit
                           var action = "<?php echo $is_edit ? 'edit' : 'add'; ?>";
                           var menu_id = "<?php echo $is_edit ? $category['catid'] : '0'; ?>";
                        </script>
                        <script type="text/javascript" src="js/category/editmenue.js"></script>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!-- /.container-fluid -->
         <?php include 'includes/footer_copyright.php';?>
      </div>
      <!-- /.content-wrapper -->
   </div>
   <!-- /#wrapper -->
   <?php include 'includes/footer.php';?>