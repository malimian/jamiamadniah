<?php include 'includes/header.php';?>
<body id="page-top">
   <?php include 'setting/company_name.php';?>
   <?php include 'includes/navbar_search.php';?>
   <?php include 'includes/notification.php';?>
   <?php
         $category = return_single_row("Select * from category Where catid  = ".$_GET['id']." $and_gc ");
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
                    Update Menue Item
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
                              <label for="colFormLabel" class="col-sm-2 col-form-label">Title</label>
                              <div class="col-sm-10">
                                 <input type="text" class="form-control" id="page_title" required="required" placeholder="Enter Menue title" name="page_title" value="<?php echo $category['catname'];?>">
                                 <div class="valid-feedback">Valid.</div>
                                 <div class="invalid-feedback">Please fill out this field.</div>
                              </div>
                           </div>
                           <div class="form-group row">
                              <label for="colFormLabel" class="col-sm-2 col-form-label">Url</label>
                              <div class="col-sm-10">
                                 <input type="text" class="form-control" id="page_url" required="required" placeholder="Menue Url" name="page_url" value="<?php echo $category['cat_url'];?>">
                                 </div>
                           </div>
                           
                            <div class="form-group row">
                              <label for="colFormLabel" class="col-sm-2 col-form-label">Parent Category</label>
                              <div class="col-sm-10">
                                 <select type="text" class="form-control" id="ctname" required="required" placeholder="Enter Course title" name="ctname">
                                     <option value="0">None</option>
                                   <?php 

                                    $categories = return_multiple_rows("Select catname , catid  from category $where_gc and isactive = 1 ");

                                    foreach ($categories as $category_) {
                                      
                                      if($category['ParentCategory'] == $category_['catid'] ) 

                                       echo "<option value='".$category_['catid']."' selected  >".$category_['catname']."</option>";
                                      else
                                       echo "<option value='".$category_['catid']."'>".$category_['catname']."</option>";

                                    }

                                   ?>

                                 </select>
                              </div>
                           </div>

                            <div class="form-group row">
                              <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Show in Nav Bar</label>
                              <div class="col-sm-10">
                                 <select class="form-control form-control-sm" id='showInNavBar' name="showInNavBar">
                                    <option value="1" <?php if($category['showInNavBar'] == 1 ) echo "selected";?> >YES</option>
                                    <option value="0" <?php if($category['showInNavBar'] == 0) echo "selected";?> >NO</option>
                                 </select>
                              </div>
                           </div>
                        
                         <div class="form-group row">
                              <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">CREATE HIERARCHY</label>
                              <div class="col-sm-10">
                                 <select class="form-control form-control-sm" id='CreateHierarchy' name="CreateHierarchy">
                                    <option value="1" <?php if($category['CreateHierarchy'] == 1) echo "selected";?> >YES</option>
                                    <option value="0" <?php if($category['CreateHierarchy'] == 0) echo "selected";?> >NO</option>
                                 </select>
                              </div>
                           </div>
                     
                           <div class="form-group row">
                              <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Is Active</label>
                              <div class="col-sm-10">
                                 <select class="form-control form-control-sm" id='is_active' name="is_active">
                                    <option value="1" <?php if($category['isactive'] == 1) echo "selected";?> >YES</option>
                                    <option value="0" <?php if($category['isactive'] == 0) echo "selected";?> >NO</option>
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
                           var menue_id = "<?php echo $category['catid']; ?>";
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
   <?php //include 'modals.php';?>
   <?php include 'includes/footer.php';?>