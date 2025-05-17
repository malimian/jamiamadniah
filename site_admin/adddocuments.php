<?php 
include 'admin_connect.php';

// With additional libraries
$extra_libs = [];

AdminHeader(
    "Add Document", 
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
                     Add New Document 
                  </h3>
               </div>
            </div>
            <!-- /.Content From Here -fluid -->
            <?php echo include_module('modules/shortcode/short_code.php', array( 'css' => '.shortcode-panel {top:0px;}' )); ?>
            <!-- Page Content -->
            <div id="error_id"></div>
            <div id="page-content-wrapper">
               <div class="container-fluid">
                  <div class="row">
                     <div class="col-lg-12">
                        <form class="needs-validation" onsubmit="return false" novalidate>

                           <div class="form-group row">
                              <label for="colFormLabel" class="col-sm-2 col-form-label">Document Title</label>
                              <div class="col-sm-10">
                                 <input type="text" class="form-control" id="document_Title" required="required" placeholder="Enter Document Title" name="document_Title">
                                 <div class="valid-feedback">Valid.</div>
                                 <div class="invalid-feedback">Please fill out this field.</div>
                              </div>
                           </div>
                           
                           <div class="form-group row">
                              <label for="colFormLabel" class="col-sm-2 col-form-label">Document Template</label>
                              <div class="col-sm-10">
                                <select class="form-control" id="document_page" name="document_page">
                                    <option value="sdocument.php">Simple Document</option>
                                </select>
                                 <div class="valid-feedback">Valid.</div>
                                 <div class="invalid-feedback">Please fill out this field.</div>
                              </div>
                           </div>
                           
                           
                          <div class="form-group row">
                              <label for="colFormLabel" class="col-sm-2 col-form-label">Document Details</label>
                              <div class="col-sm-10">
                                <textarea class="form-control" id="editor1" name="editor1"  required="required" placeholder="Enter Document Details"></textarea>
                                 <div class="valid-feedback">Valid.</div>
                                 <div class="invalid-feedback">Please fill out this field.</div>
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
                        <script type="text/javascript" src="js/documents/adddocuments.js"></script>
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