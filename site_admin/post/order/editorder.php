<?php
require_once('../../admin_connect.php');

if(isset($_POST['submit_btn'])){


$order_summary = escape($_POST['order_summary']);
$username_dh =$_POST['username_dh'];
$useremail_dh =$_POST['useremail_dh'];
$userphoneno_dh =$_POST['userphoneno_dh'];
$total_price =$_POST['total_price'];
$discount =$_POST['discount'];
$promocode =$_POST['promocode'];
$order_proof =$_POST['order_proof'];
$tx_id =$_POST['tx_id'];
$Amount_Sent =$_POST['Amount_Sent'];
$payment_method =$_POST['payment_method'];
$payment_status =$_POST['payment_status'];
$order_id = $_POST['order_id'];

$order_proof_ = "";

if(!empty($order_proof)){
    $order_proof = "`order_proof` = '$order_proof' ,";
}


$sql = "UPDATE `order_dh` SET `order_summary` = '$order_summary', `username_dh` = '$username_dh', `useremail_dh` = '$useremail_dh', `userphoneno_dh` = '$userphoneno_dh', `total_price` = '$total_price', `discount` = '$discount',
`promocode` = '$promocode',  $order_proof_  `tx_id` = '$tx_id', `Amount_Sent` = '$Amount_Sent', `payment_method` = '$payment_method', `payment_status` = '$payment_status'  WHERE `order_dh`.`order_id` = $order_id  ";


$id = Update($sql);
if($id > 0) echo $id;
else echo "0";


}

?>