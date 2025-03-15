<?php include 'includes/header.php';?>
<body id="page-top">
   <?php include 'setting/company_name.php';?>
   <?php include 'includes/navbar_search.php';?>
   <?php include 'includes/notification.php';?>
   <div id="wrapper">
   <?php include 'includes/sidebar.php'; ?>
   <div id="content-wrapper">
      <div class="container-fluid">
         <div class="container-fluid">
            <!-- Page Heading -->
            <div class="row">
               <div class="col-lg-12">
                  <h3 class="page-header">
                     Add New Menue Item
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
                                 <input type="text" class="form-control" id="page_title" required="required" placeholder="Enter Menue title" name="page_title">
                                 <div class="valid-feedback">Valid.</div>
                                 <div class="invalid-feedback">Please fill out this field.</div>
                              </div>
                           </div>
                           <div class="form-group row">
                              <label for="colFormLabel" class="col-sm-2 col-form-label">Url</label>
                              <div class="col-sm-10">
                                 <input type="text" class="form-control" id="page_url" required="required" placeholder="Menue Url" name="page_url" >
                                 </div>
                           </div>
                           
                           
                              <div class="form-group row">
                              <label for="colFormLabel" class="col-sm-2 col-form-label">Parent Category</label>
                              <div class="col-sm-10">
                                 <select type="text" class="form-control" id="ctname" required="required" placeholder="Enter title" name="ctname">
                                     <option value="0">None</option>
                                   <?php 

                                    $categories = return_multiple_rows("Select catname , catid  from category $where_gc and isactive = 1 ");

                                    foreach ($categories as $category) {
                                    
                                     $isselected_cat = "";
                                     if(isset($_GET['pcat'])){
                                               if(!empty($_GET['pcat'])){
                                                   if($_GET['pcat'] == $category['ParentCategory']) $isselected_cat = "selected";
                                               }
                                      }
                                      
                                      echo "<option value='".$category['ParentCategory']."' $isselected_cat >".$category['catname']."</option>";

                                    }

                                   ?>

                                 </select>
                              </div>
                           </div>

                           <div class="form-group row">
                              <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Show in Nav Bar</label>
                              <div class="col-sm-10">
                                 <select class="form-control form-control-sm" id='showInNavBar' name="showInNavBar">
                                    <option value="1">YES</option>
                                    <option value="0">NO</option>
                                 </select>
                              </div>
                           </div>

                           <div class="form-group row">
                              <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Create Hierarchy</label>
                              <div class="col-sm-10">
                                 <select class="form-control form-control-sm" id='CreateHierarchy' name="CreateHierarchy">
                                    <option value="1">YES</option>
                                    <option value="0">NO</option>
                                 </select>
                              </div>
                           </div>
                        
                     
                           <div class="form-group row">
                              <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Is Active</label>
                              <div class="col-sm-10">
                                 <select class="form-control form-control-sm" id='is_active' name="is_active">
                                    <option value="1">YES</option>
                                    <option value="0">NO</option>
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
                        <script type="text/javascript" src="js/category/addmenue.js"></script>
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