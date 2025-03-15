<?php
include 'front_connect.php';

echo Baseheader(SITE_TITLE,  SITE_TITLE , SITE_TITLE,
	'<link href="css/cart.css" rel="stylesheet">
	
	<link href="css/checkout.css" rel="stylesheet">
	
	' , 1);

    echo replace_sysvari(BaseNavBar(1), getcwd()."/");

	if(round($_SESSION['cart']['grand_total'])  > 0)
	  	 $total = $_SESSION['cart']['grand_total'];
	  else
	  	$total = "0.00";

?>

<!-- BAR -->

    <div class="container-fluid back-to-shopping">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 ">
                <a href="<?php echo BASE_URL;?>" class="back-to-shopping-text"> < Back to shopping</a>
            </div>
            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 total-price">
                <h3>Total Price: <span id="grand_total"><?php echo $total;?></span> <?php echo CURRENCY?></h3>
            </div>
        </div>
    </div>

<!-- BAR -->


<section class="quote-size-section web-center">

<div class="container">


<div class="card">
<table class="table table-hover shopping-cart-wrap">
<thead class="text-muted">
<tr>
  <th scope="col">Product</th>
    <th scope="col" width="120">Total Price</th>
  <th scope="col" width="200" class="text-right">Action</th>
</tr>
</thead>
<tbody>

<?php 
	if(!empty($_SESSION['cart']['order']))
		foreach ($_SESSION['cart']['order'] as $order){
		static $i = 0 ;
?>
<tr id="row_<?php echo $order['order_tempid'];?>">

<td>
<figure class="media">
	<div class="img-wrap">
		<img src="<?php echo $order['shape_img'];?>" class="img-thumbnail img-fluid"></div>
	<figcaption class="media-body">
		<?php echo $order['order_summary'];?>
	</figcaption>
</figure> 
	</td>

	<td> 
		<div class="price-wrap"> 
			<var class="price"><?php echo CURRENCY?> <?php echo $order['total_price'];?></var> 
			<!-- <small class="text-muted">(USD5 each)</small>  -->
		</div> <!-- price-wrap .// -->
	</td>
	
	<td class="text-right">
		<button onclick="delete_row('<?php echo $order['order_tempid'];?>')" class="btn btn-outline-danger btn-round"> × Remove</button>
		
		<div style="display: none" id="price_<?php echo $order['order_tempid'];?>"><?php echo $order['total_price'];?></div>

	</td>

</tr>

<?php }?>

</tbody>
</table>
</div> <!-- card.// -->
</div> 

</section>

<div class="container for-btn">
    <div class="row">
        <div class="col-12 for-btn-col">
            <button id="checkout" class="btn btn-lg btn-primary check-out-btn" <?php if(round($_SESSION['cart']['grand_total'])  <= 0) echo "disabled"; ?> ><i class="fa fa-shopping-cart" aria-hidden="true"></i>&nbsp;Check out</button>
        </div>
    </div>
</div>

<script type="text/javascript" src="js/cart/cart.js"></script>

<?php 
	echo replace_sysvari( Basefooter(null,1) , getcwd()."/");
 ?>