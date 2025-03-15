<?php include 'includes/header.php';?>
<body id="page-top">
   <?php include 'setting/company_name.php';?>
   <?php include 'includes/navbar_search.php';?>
   <?php include 'includes/notification.php';?>
   <?php
         $order_dh = return_single_row("Select * from order_dh Where order_id  = ".$_GET['id']." $and_gc ");
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
                    Copy Order 
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
                              <label for="colFormLabel" class="col-sm-2 col-form-label">Client Name</label>
                              <div class="col-sm-10">
                                 <input type="text" class="form-control" id="username_dh" required="required" placeholder="Update Client Name" name="username_dh" value="<?php echo $order_dh['username_dh'];?>">
                                 <div class="valid-feedback">Valid.</div>
                                 <div class="invalid-feedback">Please fill out this field.</div>
                              </div>
                           </div>
                           <div class="form-group row">
                              <label for="colFormLabel" class="col-sm-2 col-form-label">Client Email</label>
                              <div class="col-sm-10">
                                 <input type="text" class="form-control" id="useremail_dh"  placeholder="Update Client Email" name="useremail_dh" value="<?php echo $order_dh['useremail_dh'];?>">
                                 <div class="valid-feedback">Valid.</div>
                                 <div class="invalid-feedback">Please fill out this field.</div>
                              </div>
                           </div>
                           <div class="form-group row">
                              <label for="colFormLabel" class="col-sm-2 col-form-label">Client Phone Number</label>
                              <div class="col-sm-10">
                                 <input type="text" class="form-control" id="userphoneno_dh"  placeholder="Update Client Phone Number" name="userphoneno_dh" value="<?php echo $order_dh['userphoneno_dh'];?>">
                                 <div class="valid-feedback">Valid.</div>
                                 <div class="invalid-feedback">Please fill out this field.</div>
                              </div>
                           </div>
                           <div class="form-group row">
                              <label for="colFormLabel" class="col-sm-2 col-form-label">Total Price</label>
                              <div class="col-sm-10">
                                 <input type="number" step="any" class="form-control" id="total_price" required="required" placeholder="Update Total Price" name="total_price" value="<?php echo $order_dh['total_price'];?>">
                                 <div class="valid-feedback">Valid.</div>
                                 <div class="invalid-feedback">Please fill out this field.</div>
                              </div>
                           </div>
                           <div class="form-group row">
                              <label for="colFormLabel" class="col-sm-2 col-form-label">Discount</label>
                              <div class="col-sm-10">
                                 <input type="number" step="any" class="form-control" id="discount"  placeholder="Update Discounted Price" name="discount" value="<?php echo $order_dh['discount'];?>">
                                 <div class="valid-feedback">Valid.</div>
                                 <div class="invalid-feedback">Please fill out this field.</div>
                              </div>
                           </div>
                           <div class="form-group row">
                              <label for="colFormLabel" class="col-sm-2 col-form-label">Promo Code</label>
                              <div class="col-sm-10">
                                 <input type="text" class="form-control" id="promocode"  placeholder="Update Promo Code" name="promocode" value="<?php echo $order_dh['promocode'];?>">
                                 <div class="valid-feedback">Valid.</div>
                                 <div class="invalid-feedback">Please fill out this field.</div>
                              </div>
                           </div>
                            <div class="form-group row">
                              <label for="colFormLabel" class="col-sm-2 col-form-label">Order Proof</label>
                              <div class="col-sm-10">
                                 <input type="text" class="form-control" id="order_proof"  placeholder="Update Order Proof" name="order_proof" value="<?php echo $order_dh['order_proof'];?>">
                                 <div class="valid-feedback" >Valid.</div>
                                 <div class="invalid-feedback">Please fill out this field.</div>
                              </div>
                           </div>
                           <div class="form-group row">
                              <label for="colFormLabel" class="col-sm-2 col-form-label">Transcation ID</label>
                              <div class="col-sm-10">
                                 <input type="text" class="form-control" id="tx_id"  placeholder="Update Transcation ID" name="tx_id" value="<?php echo $order_dh['tx_id'];?>">
                                 <div class="valid-feedback">Valid.</div>
                                 <div class="invalid-feedback">Please fill out this field.</div>
                              </div>
                           </div>
                           <div class="form-group row">
                              <label for="colFormLabel" class="col-sm-2 col-form-label">Amount Sent</label>
                              <div class="col-sm-10">
                                 <input type="number" step="any" class="form-control" id="Amount_Sent"  placeholder="Update Amount Sent" name="Amount_Sent" value="<?php echo $order_dh['Amount_Sent'];?>">
                                 <div class="valid-feedback">Valid.</div>
                                 <div class="invalid-feedback">Please fill out this field.</div>
                              </div>
                           </div>
                           <div class="form-group row">
                              <label for="colFormLabel" class="col-sm-2 col-form-label">Payment Method</label>
                              <div class="col-sm-10">
                                <select  id="payment_method" class="form-control" >
                                   <?php
                                   $payments = return_multiple_rows("Select * from payments $where_gc ");
                                   foreach ($payments as $payment) {
                                   ?>
                                 <option value="<?php echo $payment['pay_id']?>"
                                    <?php 
                                       if($payment['pay_id'] == $order_dh['payment_method'])
                                          echo "selected";
                                    ?>><?php echo $payment['payment_Title']?></option>
                                <?php }?>
                                </select>
                                </div>
                           </div>
                        
                           <div class="form-group row">
                              <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Payment Status</label>
                              <div class="col-sm-10">
                                 <select class="form-control form-control-sm" id='payment_status' name="payment_status">
                                    <option value="0" <?php if($order_dh['payment_status'] == 0) echo "selected";?> >Pending</option>
                                    <option value="1" <?php if($order_dh['payment_status'] == 1) echo "selected";?> >Payment Sent</option>
                                    <option value="2" <?php if($order_dh['payment_status'] == 2) echo "selected";?> >Payment Accepted</option>
                                    <option value="3" <?php if($order_dh['payment_status'] == 3) echo "selected";?> >Payment Rejected</option>
                                 </select>
                              </div>
                           </div>

                           <div class="form-group row">
                              <label for="colFormLabel" class="col-sm-2 col-form-label">Order Summary</label>
                              <div class="col-sm-10">
                                 <textarea class="form-control" id="editor1" name="editor1" placeholder="Save Order Summary" name="editor1" ><?php echo $order_dh['order_summary'];?></textarea>
                                 <div class="valid-feedback">Valid.</div>
                                 <div class="invalid-feedback">Please fill out this field.</div>
                              </div>
                           </div>
                          

                           <div class="form-group row">
                              <label for="colFormLabel" class="col-sm-2 col-form-label"></label>
                              <div class="col-sm-2" style="float:right;">
                                 <input type="submit" name="submit" class="form-control btn btn-info" value="Save" id="submit_btn" />
                              </div>
                           </div>
                        </form>
                   
                        <script type="text/javascript" src="js/order/addorder.js"></script>
                       
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