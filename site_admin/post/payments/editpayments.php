<?php
require_once('../../admin_connect.php');

if(isset($_POST['submit'])){


$payment_Title = escape($_POST['payment_Title']);
$payment_detail = escape($_POST['payment_detail']);

$uid = $_SESSION['user']['id'];

$is_active =$_POST['is_active'];

$payment_id = $_POST['payment_id'];



$sql = "UPDATE `payments` SET `payment_Title` = '$payment_Title',`payment_detail` = '$payment_detail' WHERE `payments`.`pay_id` = $payment_id  ";


$id = Update($sql);
if($id > 0) echo $id;
else echo "0";


}

?>


