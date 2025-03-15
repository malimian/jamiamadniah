<?php include 'includes/header.php';?>
<body id="page-top">
   <?php include 'setting/company_name.php';?>
   <?php include 'includes/navbar_search.php';?>
   <?php include 'includes/notification.php';?>
   <?php
         $site_template = return_single_row("Select * from site_template Where st_id = ".$_GET['id']." $and_gc ");
   ?>
   <div id="wrapper">
   <?php include 'includes/sidebar.php'; ?>
   <div id="content-wrapper">
      <div class="container-fluid">
         <div class="container-fluid">
            <!-- /.Content From Here -fluid -->
            <!-- Page Content -->
            <div id="error_id"></div>
            <div id="page-content-wrapper">
               <div class="container-fluid">
                  <div class="row">
                     <div class="col-lg-12">
                        <form class="needs-validation" onsubmit="return false" novalidate>
                              
                              <div class="form-group row">
                              <label for="colFormLabel" class="col-sm-2 col-form-label"> Template Name</label>
                              <div class="col-sm-10">
                                 <input type="text" class="form-control" id="st_name" placeholder="Update Name" name="st_name" value="<?php echo $site_template['st_name'];?>">
                                 <div class="valid-feedback">Valid.</div>
                                 <div class="invalid-feedback">Please fill out this field.</div>
                              </div>
                           </div>
                            <div class="form-group row">
                              <label for="colFormLabel" class="col-sm-2 col-form-label">Header</label>
                              <div class="col-sm-10">
                                 <textarea class="form-control" rows="20" id="st_header" name="st_header" placeholder="Update Site Template Header" spellcheck="false"><?php echo $site_template['st_header']?></textarea> 
                              </div>
                           </div>
                           <div class="form-group row">
                              <label for="colFormLabel" class="col-sm-2 col-form-label">Menue</label>
                              <div class="col-sm-10">
                                 <textarea class="form-control" rows="20" id="st_menue" name="st_menue" placeholder="Update Site Template Menue" spellcheck="false"><?php echo $site_template['st_menue']?></textarea>
                              </div>
                           </div>
                            <div class="form-group row">
                              <label for="colFormLabel" class="col-sm-2 col-form-label">Footer</label>
                              <div class="col-sm-10">
                                 <textarea class="form-control" rows="20" id="st_footer" name="st_footer" placeholder="Update Site Template Footer" spellcheck="false"><?php echo $site_template['st_footer']?></textarea>
                              </div>
                           </div>
                           <div class="form-group row">
                              <label for="colFormLabel" class="col-sm-2 col-form-label">Scripts</label>
                              <div class="col-sm-10">
                                 <textarea class="form-control" rows="20" id="st_script" name="st_script" placeholder="Update Site Template Script" spellcheck="false"><?php echo $site_template['st_script']?></textarea>
                              </div>
                           </div>
                           <div class="form-group row">
                              <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Is Active</label>
                              <div class="col-sm-10">
                                 <select class="form-control form-control-sm" id='is_active' name="is_active">
                                    <option value="1" <?php if($site_template['isactive'] != 1) echo "selected";?> >YES</option>
                                    <option value="0" <?php if($site_template['isactive'] != 1) echo "selected";?> >NO</option>
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
                           var sitetemp_id = "<?php echo $_GET['id']; ?>";
                        </script>
                        
                        <script type="text/javascript" src="js/site_template/editsite_template.js"></script>
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