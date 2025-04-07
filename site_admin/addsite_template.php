<?php 
include 'admin_connect.php';

// With additional libraries
$extra_libs = [];

AdminHeader(
    "Gallery", 
    "", 
    $extra_libs,
    null,
    '

    '
);

?>
<body id="page-top">
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
                     Add Template
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
                              <label for="colFormLabel" class="col-sm-2 col-form-label">Template Name</label>
                              <div class="col-sm-10">
                                 <input type="text" class="form-control" id="st_name" placeholder="Enter Template Name" name="st_name">
                                 <div class="valid-feedback">Valid.</div>
                                 <div class="invalid-feedback">Please fill out this field.</div>
                              </div>
                           </div>
                           <div class="form-group row">
                              <label for="colFormLabel" class="col-sm-2 col-form-label">Header</label>
                              <div class="col-sm-10">
                                 <textarea class="form-control" rows="10" id="st_header" name="st_header" placeholder="Enter Header" spellcheck="false"></textarea> 
                              </div>
                           </div>
                           <div class="form-group row">
                              <label for="colFormLabel" class="col-sm-2 col-form-label">Menue</label>
                              <div class="col-sm-10">
                                 <textarea class="form-control" rows="10" id="st_menue" name="st_menue" placeholder="Menue" spellcheck="false"></textarea>
                              </div>
                           </div>
                            <div class="form-group row">
                              <label for="colFormLabel" class="col-sm-2 col-form-label">Footer</label>
                              <div class="col-sm-10">
                                 <textarea class="form-control" rows="10" id="st_footer" name="st_footer" placeholder="Footer" spellcheck="false"></textarea>
                              </div>
                           </div>
                           <div class="form-group row">
                              <label for="colFormLabel" class="col-sm-2 col-form-label">Script</label>
                              <div class="col-sm-10">
                                 <textarea class="form-control" rows="10" id="st_script" name="st_script" placeholder="Script" spellcheck="false"></textarea>
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
                       <script type="text/javascript" src="js/site_template/addsite_template.js"></script>
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