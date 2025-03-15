<?php 
//session_start();
include 'front_connect.php';

echo Baseheader(SITE_TITLE.' Solar Company in Lahore Pakistan | Solar System in Lahore Pakistan',  SITE_TITLE.', leading solar energy company in lahore pakistan, solar system companies in lahore, best solar energy Company in lahore pakistan, UAESOLAR top solar company in lahore pakistan, solar services company in pakistan, no 1 solar company in lahore pakistan, pakistan solar services, UAESOLAR systems, renewable eneergy solutions provider in lahore pakistan, residential solar System solutions provider in lahore pakistan, commercial solar system provider in lahore pakistan, roof top solar companies in pakistan, solar panel company in pakistan, solar system company in system, solar energy companies in pakistan, solar power companies in pakistan, turnkey solar energy system'  , SITE_TITLE.' is a Solar Company in Lahore Pakistan sell Solar System in Lahore Pakistan. Go for Solar with No.1 Solar Company in Pakistan sell Solar System in Pakistan. Book Now!',
	'
    <link href="css/checkout_page.css" rel="stylesheet">
    <script src="https://code.jquery.com/ui/1.10.0/jquery-ui.js"></script>
	
	' , 1);
	

    $order_id = decrypt_($_GET['order_id']);

  
  if(empty($order_id)) exit( '<script type="text/javascript"> window.location = "'.BASE_URL.'" </script>');
  

    $order_detail = return_single_row("Select * from order_dh where order_id = ".$order_id);

   if($order_detail['payment_status'] != 0 )
      exit( '<script type="text/javascript"> window.location = "thankyou.php?order_id='.encrypt_($order_id).'" </script>');

    $payments_method = return_multiple_rows("Select * from payments $where_gc and isactive = 1 order by payment_sequence ASC ");

    echo replace_sysvari(BaseNavBar(1), getcwd()."/");

    $readonly ="";
    if(!isset($_GET['user'])){
      $readonly = "readonly";
    }

?>

<section>
<div class="topSecArea">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <center><h1>CHECKOUT INFORMATION<h1></center>
        </div>
      </div>
    </div>
  </div>
  <div class="innerPage">
    <div class="container">

      <div class="row">
          <div class="col-sm-6 orderBg">
                    <div class="orderHead">ORDER NOW : <?php echo $order_id;?></div>
          <div class="orderText">Payment Details</div>
                        <!--Start of form-->
                        <div id="error_id"></div>
            <div class="needs-validation checkoutForm">

                      <div class="form-group row customForm">
                              <label for="colFormLabel" class="col-form-label customLable">Name</label>
                              <div class="col-sm-12">
                                 <input type="text" class="form-control" required="required" <?php echo $readonly;?> placeholder="Enter Name Title" value="<?php echo $order_detail['username_dh'] ?>" id="username_dh">
                              </div>
                           </div>

                           <div class="form-group row customForm">
                              <label for="colFormLabel" class=" col-form-label customLable">Phone No#</label>
                              <div class="col-sm-12">
                                 <input type="text" class="form-control" required="required" <?php echo $readonly;?> placeholder="Enter Phone Number" value="<?php echo $order_detail['userphoneno_dh'] ?>" id="userphoneno_dh">
                              </div>
                           </div>

                           <div class="form-group row customForm">
                              <label for="colFormLabel" class=" col-form-label customLable">Email</label>
                              <div class="col-sm-12">
                                 <input type="text" class="form-control" id="user_email" required="required" <?php echo $readonly;?> placeholder="Enter Email" value="<?php echo $order_detail['useremail_dh'] ?>" name="user_email" id="useremail_dh">
                              </div>
                           </div>
                           <div class="form-group row customForm">
                             <div class="col-sm-12">
                                <div id="promo_code_result"></div>
                              </div>
                           </div>

                           <div class="form-group row customForm">
                              <label for="colFormLabel" class=" col-form-label customLable">Payment Method</label>
                              <div class="col-sm-12">
                                 <select id="payment_method" class="form-control form-control-sm" >
                                    <?php
                                    foreach ($payments_method as $payment) {
                                    ?>
                                  <option value="<?php echo $payment['pay_id']?>"><?php echo $payment['payment_Title']?></option>
                                 <?php }?>
                                 </select>
                              </div>
                           </div>
                           <div class="form-group row customForm">
                              <label for="colFormLabel" class=" col-form-label customLable">Transction Number</label>
                              <div class="col-sm-12">
                                 <input type="text" class="form-control" id="tx_id" required="required" placeholder="Enter Transction Number" name="tx_id">
                              </div>
                           </div>
                        
                             <div class="form-group row customForm" style="display: none;">
                              <label for="colFormLabel" class=" col-form-label customLable">Amount Sent</label>
                              <div class="col-sm-12">
                                 <input type="number" value="<?php echo $order_detail['total_price'] ?>" class="form-control" id="amount_sent" required="required" placeholder="Enter Amount" name="amount_sent">
                               </div>
                           </div>
                        

                             <div class="form-group row customForm">
                              <label for="colFormLabel" class=" col-form-label customLable">Attach Proof</label>
                              <div class="col-sm-12">
                                 <input type="file" class="form-control " id="files" placeholder="Enter Amount" name="files">
                               </div>
                           </div>

                           <div class="form-group row customForm">
                              <label for="colFormLabel" class=" col-form-label customLable"></label>
                              <div class="col-sm-5" style="float:right;">

                                 <button type="button" class="form-control btn btn-info" id="submit_btn" ><i class="fa fa-shopping-cart" aria-hidden="true"></i>&nbsp;Checkout</button>
                              </div>
                           </div>
                        </div>
                        <!--End of form -->
                      </div>
                      <div class="col-sm-6 summaryBg">
                            <div class="summaryHead">Order Summary</div>
                            <div class="form-group summay">
                              <p><?php echo $order_detail['order_summary'];?></p>
                            </div>
                              <div class="discountBox">
                                 <div class="spacerArea" id="promo_code_setion">
                                    <p>Actual Fee
                                       <span class="feeActual"><?php echo $order_detail['total_price']; ?></span>
                                    </p>
                                    
                                 </div>
                                
                                 <hr>
                                 <div class="totalArea">
                                   <h2>Total (<?php echo CURRENCY; ?>)<span id="final_price"><?php echo $order_detail['total_price']; ?></span></h2>
                                 </div>
                               </div>
                      </div>
                    </div>
                  </div>
                </div>
              <input type="hidden" id="order_Price" value="<?php echo $order_detail['total_price']; ?>">
</section>

<script type="text/javascript" src="js/promocode/check_promocode.js"></script>
<script type="text/javascript" src="js/checkout/checkout.js"></script>
<script type="text/javascript">
  var order_id = "<?php echo encrypt_($order_id);?>";
</script>

<?php 
  echo replace_sysvari( Basefooter(null,1) , getcwd()."/");
 ?>