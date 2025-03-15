<?php
session_start();
include '../connect.php';

if(isset($_POST['submit_order'])){

    $order_summary=$_POST['order_summary'];
	$username_dh=$_POST['username_dh'];
	$useremail_dh=$_POST['useremail_dh'];
	$userphoneno_dh=$_POST['userphoneno_dh'];
	$total_price=$_POST['total_price'];

	$order_id = Insert("INSERT INTO `order_dh` (`order_summary`, `username_dh`, `useremail_dh`, `userphoneno_dh`, `total_price`, `discount`, `promocode`, `isactive`, `createdon`, `createdby`, `updatedon`) VALUES ('$order_summary', '$username_dh', '$useremail_dh', '$userphoneno_dh', '$total_price', '0', NULL, '1', current_timestamp(), NULL, NULL)
		");

	// $_SESSION['cart']['order']['id'] = $order_id;
	// $_SESSION['cart']['order']['email'] = $useremail_dh;
	// $_SESSION['cart']['order']['phone_no'] = $userphoneno_dh;
	// $_SESSION['cart']['order']['order_summary'] = $order_summary;


	// echo "INSERT INTO `order_dh` (`order_summary`, `username_dh`, `useremail_dh`, `userphoneno_dh`, `total_price`, `discount`, `promocode`, `isactive`, `createdon`, `createdby`, `updatedon`) VALUES ('$order_summary', '$username_dh', '$useremail_dh', '$userphoneno_dh', '$total_price', '0', NULL, '1', current_timestamp(), NULL, NULL)
	// 	";

		$sub = "Invoice for Order #".$order_id." - ".Company;

		$message = "Dear $username_dh ,\nYou have placed Order No# ".$order_id. "\nKindly Check Invoice Receipt ".BASE_URL."/invoice.php?order_id=".encrypt_($order_id)."\n".Company;

	   	
	   	if(ENV ==  1)
	   		 mail($useremail_dh,$sub,$message);
	   

	if($order_id > 1) echo encrypt_($order_id);
	else echo "0";
	
}






?>