<?php 
//session_start();
include 'front_connect.php';

$url = "checkout.php";

// Fetch page data using proper URL sanitization
$safe_url = addslashes($url); // Basic sanitization for SQL

$content = return_single_row(
    "SELECT page_meta_title, site_template_id, page_meta_keywords, page_meta_desc, 
    page_title, featured_image, pages.createdon, pid, catname, cat_url, page_url 
    FROM pages 
    LEFT JOIN category ON pages.catid = category.catid 
    WHERE pages.soft_delete = 0 
    AND category.soft_delete = 0 
    AND page_url = '$safe_url' 
    AND pages.isactive = 1"
);

// Initialize template ID with default if not found
$template_id = !empty($content['site_template_id']) ? (int)$content['site_template_id'] : 0;

  // Prepare additional CSS/JS libraries
  $additional_libs = [
      '<link href="css/checkout.css" rel="stylesheet">',
      '<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">',
      // Add any other CSS/JS files needed
  ];

  // Output the header with all meta information
  echo front_header(
      htmlspecialchars($content['page_meta_title'] ?? 'Default Page Title'),
      htmlspecialchars($content['page_meta_keywords'] ?? ''),
      htmlspecialchars($content['page_meta_desc'] ?? ''),
      $additional_libs,
      $template_id
  );
  

      if(empty($_GET['order_id'])) exit( '<script type="text/javascript"> window.location = "'.BASE_URL.'" </script>');

    $order_id = decrypt_($_GET['order_id']);   

    $order_detail = return_single_row("Select * from order_dh where order_id = ".$order_id);

   if($order_detail['payment_status'] != 0 )
      exit( '<script type="text/javascript"> window.location = "thankyou.php?order_id='.encrypt_($order_id).'" </script>');

    $payments_method = return_multiple_rows("Select * from payments $where_gc and isactive = 1 order by payment_sequence ASC ");

        // Output the navbar with path replacement
    $navbar_content = front_menu( null ,$template_id);
    if (!empty($navbar_content)) {
        echo replace_sysvari($navbar_content, getcwd() . "/");
    }


    $readonly ="";
    if(!isset($_GET['user'])){
      $readonly = "readonly";
    }


        $IsPromocode = false;
        
         if($order_detail['promocode'] != 0 || !empty($order_detail['promocode'])){

         $promocode = return_single_row("Select * from promocode Where p_id = ".$order_detail['promocode']." and isactive = 1 and soft_delete = 0 ");
         
         $IsPromocode= true;
         
        }

?>


<section>
    <div class="gradient-header">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h1><i class="fas fa-shopping-cart mr-2"></i> CHECKOUT INFORMATION</h1>
                </div>
            </div>
        </div>
    </div>
    
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mb-4">
                <div class="checkout-card order-section">
                    <div class="section-header">
                        <i class="fas fa-credit-card mr-2"></i> ORDER NOW: <?php echo $order_id; ?>
                    </div>
                    
                    <div class="payment-details">
                        <h5 class="mb-4"><i class="fas fa-money-bill-wave mr-2"></i> Payment Details</h5>
                        
                        <!--Start of form-->
                        <div id="error_id"></div>
                        
                        <div class="needs-validation checkoutForm">
                            <div class="form-group">
                                <label for="username_dh" class="font-weight-bold">Full Name</label>
                                <input type="text" class="form-control" required <?php echo $readonly; ?> 
                                       placeholder="Enter your full name" value="<?php echo $order_detail['username_dh'] ?>" 
                                       id="username_dh">
                            </div>

                            <div class="form-group">
                                <label for="userphoneno_dh" class="font-weight-bold">Phone Number</label>
                                <input type="text" class="form-control" required <?php echo $readonly; ?> 
                                       placeholder="Enter your phone number" value="<?php echo $order_detail['userphoneno_dh'] ?>" 
                                       id="userphoneno_dh">
                            </div>

                            <div class="form-group">
                                <label for="useremail_dh" class="font-weight-bold">Email Address</label>
                                <input type="email" class="form-control" id="user_email" required <?php echo $readonly; ?> 
                                       placeholder="Enter your email" value="<?php echo $order_detail['useremail_dh'] ?>" 
                                       name="user_email" id="useremail_dh">
                            </div>
                            
                       <div class="form-group">
                              <label for="promo_code" class="font-weight-bold">Promo Code</label>
                              <div class="input-group">
                                <?php if(!$IsPromocode): ?>
                                  <input type="text" class="form-control" id="promo_code" placeholder="Enter promo code" name="promo_code">
                                  <input type="hidden" name="promo_code_id" id="promo_code_id" value="">
                                  <button id="check_promocode" class="btn btn-primary" type="button">
                                    Apply
                                  </button>
                                <?php else: ?>
                                  <input type="text" class="form-control" id="promo_code" value="<?php echo $promocode['p_code']; ?>" readonly>
                                <?php endif; ?>
                              </div>
                              <small id="promoHelp" class="form-text text-muted">Enter your discount code if you have one</small>
                            </div>


                            
                            <div id="promo_code_result" class="mt-2"></div>

                            <div class="form-group">
                                <label for="payment_method" class="font-weight-bold">Payment Method</label>
                                <select id="payment_method" class="form-control">
                                    <?php foreach ($payments_method as $payment) { ?>
                                        <option value="<?php echo $payment['pay_id']?>">
                                            <?php echo $payment['payment_Title']?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="tx_id" class="font-weight-bold">Transaction Number</label>
                                <input type="text" class="form-control" id="tx_id" required 
                                       placeholder="Enter transaction number" name="tx_id">
                            </div>
                            
                            <div class="form-group" style="display: none;">
                                <label for="amount_sent" class="font-weight-bold">Amount Sent</label>
                                <input type="number" value="<?php echo $order_detail['total_price'] ?>" 
                                       class="form-control" id="amount_sent" required 
                                       placeholder="Enter amount" name="amount_sent">
                            </div>
                            
                            <div class="form-group">
                                <label for="files" class="font-weight-bold">Payment Proof</label>
                                <div class="custom-file-label" id="file-label">
                                    <i class="fas fa-cloud-upload-alt mr-2"></i> Choose payment proof file
                                </div>
                                <input type="file" class="custom-file-input" id="files" name="files">
                                <small class="form-text text-muted">Upload screenshot or receipt of your payment</small>
                            </div>

                            <div class="form-group mt-4">
                                <button type="button" class="btn btn-checkout btn-block" id="submit_btn">
                                    <i class="fas fa-lock mr-2"></i> Complete Secure Checkout
                                </button>
                            </div>
                        </div>
                        <!--End of form -->
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6 mb-4">
                <div class="checkout-card summary-section">
                    <div class="section-header">
                        <i class="fas fa-receipt mr-2"></i> Order Summary
                    </div>
                    
                    <div class="order-summary mb-4">
                        <p class="text-muted"><?php echo $order_detail['order_summary'];?></p>
                    </div>
                    
                    <div class="pricing-summary">
                        <div class="summary-item">
                            <div class="d-flex justify-content-between">
                                <span class="font-weight-bold">Actual Fee</span>
                                <span class="feeActual"><?php echo $order_detail['total_price']; ?></span>
                            </div>
                        </div>
                        
                        <hr class="my-3">
                        
                        <div class="summary-item total-price">
                            <div class="d-flex justify-content-between">
                                <span>Total (<?php echo CURRENCY; ?>)</span>
                                <span id="final_price"><?php echo $order_detail['total_price']; ?></span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="security-info mt-4 p-3 bg-light rounded">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-shield-alt text-success mr-2"></i>
                            <small class="text-muted">Your transaction is secure and encrypted</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <input type="hidden" id="order_Price" value="<?php echo $order_detail['total_price']; ?>">
</section>

<script>
  document.addEventListener('DOMContentLoaded', function () {
      document.getElementById('files').addEventListener('change', function (e) {
          var fileName = e.target.files[0] ? e.target.files[0].name : "Choose payment proof file";
          document.getElementById('file-label').innerHTML = '<i class="fas fa-cloud-upload-alt mr-2"></i> ' + fileName;
      });
  });
</script>


<?php 
echo replace_sysvari(front_script(null, $template_id), getcwd() . "/");
?>

<script type="text/javascript" src="js/promocode/check_promocode.js"></script>
<script type="text/javascript" src="js/checkout/checkout.js"></script>

<?php
echo replace_sysvari(front_footer(null, $template_id), getcwd() . "/");
?>