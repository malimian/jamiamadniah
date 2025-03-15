<?php 
include 'front_connect.php';
echo Baseheader('PAK SOLAR GRID ',  'PAK SOLAR GRID'  , 'PAK SOLARGRID',
    '
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <link href="css/thankyou.css" rel="stylesheet">' , 0);


  $order_id = decrypt_($_GET['order_id']);

  if(empty($order_id)) exit( '<script type="text/javascript"> window.location = "'.BASE_URL.'" </script>');
  
  $order_detail = return_single_row("Select * , DATE(createdon) as order_date  from order_dh
   LEFT JOIN payments ON order_dh.payment_method = payments.pay_id
   where order_id = ".$order_id);


?>

<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <div class="row">
                <div class="col-xs-2">
                    <img src="images/paksolargrid-logo.png" class="img-responsive" alt="<?php echo SITE_TITLE;?>">
                </div>
            </div>
            <div class="invoice-title ">
    			<div class="col-sm-6">
                    <h2>Invoice</h2>         
                </div>
                <div class="col-sm-6">
                    <h3 class="pull-right">Order # <?php echo $order_detail['order_id']?></h3>         
                </div>
           </div>
            <div class="col-md-12 row">

            <?php 
                            if($order_detail['payment_status'] == 0)
                                
                                echo '<div class="alert alert-warning" role="alert">
                                        Your Payment Clearance is Pending
                                    </div>';

                            if($order_detail['payment_status'] == 1)
                                
                                echo '<div class="alert alert-warning" role="alert">
                                        Your Payment Clearance is Pending
                                    </div>';

                                if($order_detail['payment_status'] == 2)
                                
                                echo '<div class="alert alert-success" role="alert">
                                        Your Payment is Cleared
                                    </div>';

                                if($order_detail['payment_status'] == 3)
                                
                                echo '<div class="alert alert-danger" role="alert">
                                        Your Payment has Declined
                                    </div>';
                            
            ?>
            </div>
    		<div class="row">
    			<div class="col-xs-6">
    				<address>
    				<strong>Billed To:</strong><br>
    					<?php echo $order_detail['username_dh']?><br>
    					<?php echo $order_detail['useremail_dh']?><br>
    					<?php echo $order_detail['userphoneno_dh']?><br>
    				</address>
    			</div>
    		</div>
    		<div class="row">
    			<div class="col-xs-6">
    				<address>
    					<strong>Payment Method:</strong><br>
    					<?php echo $order_detail['payment_Title']?><br>
                        <?php echo $order_detail['payment_detail']?><br>
    				</address>
    			</div>
    			<div class="col-xs-6 text-right">
    				<address>
    					<strong>Order Date:</strong><br>
    					<?php echo $order_detail['order_date']?><br><br>
    				</address>
    			</div>
    		</div>
    	</div>
    </div>
    
    <div class="row">
    	<div class="col-md-12">
    		<div class="panel panel-default">
    			<div class="panel-heading">
    				<h3 class="panel-title"><strong>Order summary</strong></h3>
    			</div>
    			<div class="panel-body">
    				<div>
    					<p>
                            <?php echo $order_detail['order_summary']?>
                        </p>
    				</div>
    			</div>
    		</div>
			<div class="discoutArea">
                 <p>Total Price <span>(PKR)<?php echo $order_detail['total_price']?></span></p>
			</div>
    	</div>
    </div>

    <div class="row">
        <div class="col-md-12 text-right identity">
            <p>Company<br><strong><?php echo SITE_TITLE;?></strong></p>
        </div>
    </div>

</div>