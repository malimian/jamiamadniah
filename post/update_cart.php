<?php
include '../connect.php';


if(isset($_POST['delete'])){

	  $id = $_POST['id'];
	  
	  $total = $_SESSION['cart']['grand_total'] - $_SESSION['cart']['order']["$id"]['total_price'];

	  if(round($total)  > 0 )
	  	$_SESSION['cart']['grand_total'] = $total;
	  else
	  	$_SESSION['cart']['grand_total'] = 0;


	  unset($_SESSION['cart']['order']["$id"]);
}


?>