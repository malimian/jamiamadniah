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
         $all_packages = return_single_row("Select * from all_packages Where pid  = ".$_GET['id']." $and_gc ");
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
                    Update Packages
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
                              <label for="colFormLabel" class="col-sm-2 col-form-label">Package Title</label>
                              <div class="col-sm-10">
                                 <input type="text" class="form-control" id="ptitle" required="required" placeholder="Update Package Title" name="ptitle" value="<?php echo $all_packages['ptitle'];?>">
                                 <div class="valid-feedback">Valid.</div>
                                 <div class="invalid-feedback">Please fill out this field.</div>
                              </div>
                           </div>
                           <div class="form-group row">
                              <label for="colFormLabel" class="col-sm-2 col-form-label">Package Image</label>
                              <div class="col-sm-10">
                                 <div class="form-inline">
                                      <input type="text" class="form-control col-sm-10" id="p_image" required="required" placeholder="Update Image" required="required" name="p_image" value="<?php echo $all_packages['p_image'];?>">
                                      <button class="btn btn-primary form-control col-sm-2" onclick="OpenMediaGallery('p_image')" type="button">
                                       <i class="fa fa-picture-o"></i>&nbsp;Gallery
                                     </button> 
                                      <div class="valid-feedback">Valid.</div>
                                 <div class="invalid-feedback">Please fill out this field.</div>
                                 </div>
                              </div>
                           </div>
                           <div class="form-group row">
                              <label for="colFormLabel" class="col-sm-2 col-form-label">Package Price</label>
                              <div class="col-sm-10">
                                 <input type="number" step="0.01" class="form-control" id="p_cost"  placeholder="Update Package Price" name="p_cost" value="<?php echo $all_packages['p_cost'];?>">
                                 <div class="valid-feedback">Valid.</div>
                                 <div class="invalid-feedback">Please fill out this field.</div>
                              </div>
                           </div>
                           <div class="form-group row">
                              <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Catagory</label>
                              <div class="col-sm-10">
                                  <select class="form-control form-control-sm" id='packages_category' name="packages_category">
                                    <?php 
                                        $package_category = return_multiple_rows("Select * from og_packages_category $where_gc");
                                        foreach($package_category as $package_category_){
                                    ?>
                                    <option value="<?=$package_category_['og_all_packages_id']?>" <?php if($all_packages['packages_category'] == $package_category_['og_all_packages_id']) echo "selected"; ?> ><?=$package_category_['title']?></option>
                                    <?php }?>
                                 </select>
                              </div>
                           </div>
                           <div class="form-group row">
                              <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Is Featured</label>
                              <div class="col-sm-10">
                                 <select class="form-control form-control-sm" id='IsFeatured' name="IsFeatured">
                                    <option value="1" <?php if($all_packages['IsFeatured'] == 1 ) echo "selected";?> >YES</option>
                                    <option value="0" <?php if($all_packages['IsFeatured'] != 1) echo "selected";?> >NO</option>
                                 </select>
                              </div>
                            </div>
                           <div class="form-group row">
                              <label for="colFormLabel" class="col-sm-2 col-form-label">Featured Text</label>
                              <div class="col-sm-10">
                                 <input type="text" class="form-control" id="FeaturedText" placeholder="Update Featured Text" name="FeaturedText" value="<?php echo $all_packages['FeaturedText'];?>">
                                 <div class="valid-feedback">Valid.</div>
                                 <div class="invalid-feedback">Please fill out this field.</div>
                              </div>
                           </div>
                      <div class="form-group row">
                              <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Is Active</label>
                              <div class="col-sm-10">
                                 <select class="form-control form-control-sm" id='isactive' name="isactive">
                                    <option value="1" <?php if($all_packages['isactive'] == 1) echo "selected";?> >YES</option>
                                    <option value="0" <?php if($all_packages['isactive'] == 0) echo "selected";?> >NO</option>
                                 </select>
                              </div>
                           </div>
                           <div class="form-group row">
                              <label for="colFormLabel" class="col-sm-2 col-form-label">Package Description</label>
                              <div class="col-sm-10">
                                 <textarea class="form-control" id="editor1" name="editor1" placeholder="Update Package Description" name="editor1" ><?php echo $all_packages['p_content'];?></textarea>
                                 <div class="valid-feedback">Valid.</div>
                                 <div class="invalid-feedback">Please fill out this field.</div>
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
                           var all_packages_id = "<?php echo $all_packages['pid']; ?>";
                        </script>
                        <script type="text/javascript" src="js/all_packages/editall_packages.js"></script>
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

       <?php echo include_module('modules/upload_image.php' , null);?>

   <?php include 'includes/footer.php';?>