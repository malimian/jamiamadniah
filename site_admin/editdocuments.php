<?php include 'includes/header.php';?>
<body id="page-top">
   <?php include 'setting/company_name.php';?>
   <?php include 'includes/navbar_search.php';?>
   <?php include 'includes/notification.php';?>
   <?php
         $documents = return_single_row("Select * from documents Where docu_id  = ".$_GET['id']." $and_gc ");
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
                    Update documents
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
                              <label for="colFormLabel" class="col-sm-2 col-form-label">document Title</label>
                              <div class="col-sm-10">
                                 <input type="text" class="form-control" id="document_Title" required="required" placeholder="Update document Title" name="document_Title" value="<?php echo $documents['document_Title'];?>">
                                 <div class="valid-feedback">Valid.</div>
                                 <div class="invalid-feedback">Please fill out this field.</div>
                              </div>
                           </div>
                           
                            <div class="form-group row">
                              <label for="colFormLabel" class="col-sm-2 col-form-label">Document Template</label>
                              <div class="col-sm-10">
                                <select class="form-control" id="document_page" name="document_page">
                                    <option value="sdocument_uaesolar.php" <?php if($documents['document_page'] == "sdocument_uaesolar.php") echo "selected";?> >Simple Document without stamp</option>
                                </select>
                                 <div class="valid-feedback">Valid.</div>
                                 <div class="invalid-feedback">Please fill out this field.</div>
                              </div>
                           </div>
                           
                            <div class="form-group row">
                              <label for="colFormLabel" class="col-sm-2 col-form-label">document Details</label>
                              <div class="col-sm-10">
                                 <textarea class="form-control" id="editor1" name="editor1" required="required" placeholder="Update document Details" name="editor1"><?php echo $documents['document_detail'];?></textarea>
                                 <div class="valid-feedback">Valid.</div>
                                 <div class="invalid-feedback">Please fill out this field.</div>
                              </div>
                           </div>
                        
                     
                            <div class="form-group row">
                              <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Is Active</label>
                              <div class="col-sm-10">
                                 <select class="form-control form-control-sm" id='is_active' name="is_active">
                                    <option value="1" <?php if($documents['isactive'] != 1) echo "selected";?> >YES</option>
                                    <option value="0" <?php if($documents['isactive'] != 1) echo "selected";?> >NO</option>
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
                           var document_id = "<?php echo $documents['docu_id']; ?>";
                        </script>
                        
                        <script type="text/javascript" src="js/documents/editdocuments.js"></script>
                       
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