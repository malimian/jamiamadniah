<?php 
session_start();
include 'front_connect.php';

echo Baseheader('Efik History - Calabar - The Efik National Association ',  'Efik History - Calabar - The Efik National Association'  , 'Efik History - Calabar - The Efik National Association',
	'<link href="css/thankyou.css" rel="stylesheet">' , 1);


  $order_id = decrypt_($_GET['order_id']);
  
  if(empty($order_id)) exit( '<script type="text/javascript"> window.location = "'.BASE_URL.'" </script>');

  $order_detail = return_single_row("Select * from order_dh where order_id = ".$order_id);

    echo replace_sysvari(BaseNavBar(1), getcwd()."/");

?>

<section>
	<div class="innerPage">
		<div class="container">
			<div class="row p-3">
				<div class="col-sm-12">
					<div id="div_content">
						<h1>Order # <?php echo $order_detail['order_id'];?></h1>
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
			    		
						<p>
							<?php echo $order_detail['order_summary'];?>
						</p>
						
						<div class="discoutArea">
            				<p>Total Price (<?php echo CURRENCY; ?>)<span><?php echo $order_detail['total_price']?></span></p>
        			    </div>
						
						<div style="float:right;">
						    <?php if(!empty($order_detail['order_proof'])){ ?>
                            <a href="<?php echo BASE_URL; ?>payment_uploads/<?php echo $order_detail['order_proof'];?>" class="btn btn-warning"><i class="fa fa-file-text-o" aria-hidden="true"></i>&nbsp;Payment Proof</a>
					        <?php } ?>
							<a href="invoice.php?order_id=<?php echo encrypt_($order_id); ?>" class="btn btn-info"><i class="fa fa-print" aria-hidden="true"></i>&nbsp;Invoice</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>


<?php 
	echo replace_sysvari( Basefooter(null,1) , getcwd()."/");
 ?>