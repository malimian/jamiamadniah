<?php 
session_start();

include '../connect.php';

if(isset($_POST['submit_order'])){
	$file_name = "";
	
	$order_id=decrypt_($_POST['order_id']);
	$payment_method=$_POST['payment_method'];
	$tx_id=$_POST['tx_id'];
	$amount_sent=$_POST['amount_sent'];

	$useremail_dh=$_POST['useremail_dh'];
	$username_dh=$_POST['username_dh'];
	$userphoneno_dh=$_POST['userphoneno_dh'];


	if(isset($_FILES['file']["tmp_name"])){
		$file_name = upload_('../payment_uploads/');
		$file_name = ", `order_proof` = '$file_name'";

	}

	echo Update("UPDATE `order_dh` SET 
		`tx_id` = '$tx_id' ,
		`username_dh` = '$username_dh' ,
		`useremail_dh` = '$useremail_dh' ,
		`userphoneno_dh` = '$userphoneno_dh' ,
		`Amount_Sent` = '$amount_sent',
		payment_status = 1 ,
		payment_method = '$payment_method'
		$file_name 
		WHERE order_id = ".$order_id);

		$sub = "Payment For Order #".$order_id." - ".Company;

		$message = "Dear $username_dh ,\nCheck Payment updates on Order No# ".$order_id. "\nKindly Check Invoice Receipt ".BASE_URL."/invoice.php?order_id=".encrypt_($_POST['order_id'])."\n".Company;

	   
	   mail($useremail_dh,$sub,$message);

}


?>