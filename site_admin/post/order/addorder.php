<?php
require_once('../../admin_connect.php');

if(isset($_POST['submit_btn'])){


$order_summary =    escape($_POST['order_summary']);
$username_dh =      escape($_POST['username_dh']);
$useremail_dh =     escape($_POST['useremail_dh']);
$userphoneno_dh =   escape($_POST['userphoneno_dh']);
$total_price =      escape($_POST['total_price']);
$discount =         escape($_POST['discount']);
$promocode =        escape($_POST['promocode']);
$order_proof =      escape($_POST['order_proof']);
$tx_id =            escape($_POST['tx_id']);
$Amount_Sent =      escape($_POST['Amount_Sent']);
$payment_method =   escape($_POST['payment_method']);
$payment_status =   escape($_POST['payment_status']);

$sql = "INSERT INTO `order_dh` (`order_summary`, `username_dh`,`useremail_dh`, `userphoneno_dh` , `total_price`, `discount`, `promocode`, `order_proof`, `tx_id`, `Amount_Sent`, `payment_method`, `payment_status`) VALUES ('$order_summary',  '$username_dh', '$useremail_dh', '$userphoneno_dh' ,'$total_price', '$discount', '$promocode', '$order_proof', '$tx_id', '$Amount_Sent', '$payment_method', '$payment_status')";

$id = Insert($sql);
if($id > 0) echo $id;
else echo "0";

}

?>