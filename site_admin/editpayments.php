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
   <?php include 'setting/company_name.php';?>
   <?php include 'includes/navbar_search.php';?>
   <?php include 'includes/notification.php';?>
   <?php
         $payments = return_single_row("Select * from payments Where pay_id  = ".$_GET['id']." $and_gc ");
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
                    Update Payments
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
                              <label for="colFormLabel" class="col-sm-2 col-form-label">Payment Title</label>
                              <div class="col-sm-10">
                                 <input type="text" class="form-control" id="payment_Title" required="required" placeholder="Update Payment Title" name="payment_Title" value="<?php echo $payments['payment_Title'];?>">
                                 <div class="valid-feedback">Valid.</div>
                                 <div class="invalid-feedback">Please fill out this field.</div>
                              </div>
                           </div>
                            <div class="form-group row">
                              <label for="colFormLabel" class="col-sm-2 col-form-label">Payment Details</label>
                              <div class="col-sm-10">
                                 <textarea class="form-control" id="editor1" name="editor1" required="required" placeholder="Update Payment Details" name="editor1"><?php echo $payments['payment_detail'];?></textarea>
                                 <div class="valid-feedback">Valid.</div>
                                 <div class="invalid-feedback">Please fill out this field.</div>
                              </div>
                           </div>
                        
                     
                            <div class="form-group row">
                              <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Is Active</label>
                              <div class="col-sm-10">
                                 <select class="form-control form-control-sm" id='is_active' name="is_active">
                                    <option value="1" <?php if($payments['isactive'] != 1) echo "selected";?> >YES</option>
                                    <option value="0" <?php if($payments['isactive'] != 1) echo "selected";?> >NO</option>
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
                           var payment_id = "<?php echo $payments['pay_id']; ?>";
                        </script>
                        
                        <script type="text/javascript" src="js/payments/editpayments.js"></script>
                       
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