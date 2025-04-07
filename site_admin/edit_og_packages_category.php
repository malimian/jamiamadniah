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
         $og_packages_category = return_single_row("Select * from og_packages_category Where og_all_packages_id  = ".$_GET['id']." $and_gc ");
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
                    Update Packages Catagory
                  </h3>
               </div>
            </div>
            <!-- /.Content From Here -fluid -->
            <!-- Page Content -->
            <div id="error_id"></div>
            <div id="page-content-wrapper">
               <div class="container-fluid">
                  <div class="row">
                     <div class="col-lg-12">
                        <form class="needs-validation" onsubmit="return false" novalidate>

                           <div class="form-group row">
                              <label for="colFormLabel" class="col-sm-2 col-form-label">Packages Catagory Title</label>
                              <div class="col-sm-10">
                                 <input type="text" class="form-control" id="title" required="required" placeholder="Update Packages Catagory Title" name="title" value="<?php echo $og_packages_category['title'];?>">
                                 <div class="valid-feedback">Valid.</div>
                                 <div class="invalid-feedback">Please fill out this field.</div>
                              </div>
                           </div>
                           <div class="form-group row">
                              <label for="colFormLabel" class="col-sm-2 col-form-label">Short Code</label>
                              <div class="col-sm-10">
                                 <input type="text" class="form-control" id="short_code" required="required" placeholder="Update Short Code" name="short_code" value="<?php echo $og_packages_category['short_code'];?>">
                                 <div class="valid-feedback">Valid.</div>
                                 <div class="invalid-feedback">Please fill out this field.</div>
                              </div>
                           </div>
                            <div class="form-group row">
                              <label for="colFormLabel" class="col-sm-2 col-form-label">Location</label>
                              <div class="col-sm-10">
                                 <input type="text" class="form-control" id="location" required="required" placeholder="Enter The Location" name="location" value="<?php echo $og_packages_category['location'];?>">
                                 <div class="valid-feedback">Valid.</div>
                                 <div class="invalid-feedback">Please fill out this field.</div>
                              </div>
                           </div>
                          
                           <div class="form-group row">
                              <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Is Active</label>
                              <div class="col-sm-10">
                                 <select class="form-control form-control-sm" id='isactive' name="isactive">
                                    <option value="1" <?php if($og_packages_category['isactive'] != 1) echo "selected";?> >YES</option>
                                    <option value="0" <?php if($og_packages_category['isactive'] != 1) echo "selected";?> >NO</option>
                                 </select>
                              </div>
                           </div>
                          

                           <div class="form-group row">
                              <label for="colFormLabel" class="col-sm-2 col-form-label"></label>
                              <div class="col-sm-2" style="float:right;">
                                 <input type="submit" name="submit" class="form-control btn btn-info" value="Submit" id="submit_btn" />
                              </div>
                           </div>
                        </form>
                        <script type="text/javascript">
                           var og_id = "<?php echo $og_packages_category['og_all_packages_id']; ?>";
                        </script>
                        
                        <script type="text/javascript" src="js/og_packages_category/edit_og_packages_category.js"></script>
                       
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
   <?php //include 'modals.php';?>
   <?php include 'includes/footer.php';?>