<?php
require_once('../../admin_connect.php');

if(isset($_POST['submit_btn'])){


$payment_Title = escape($_POST['payment_Title']);
$payment_detail = escape($_POST['payment_detail']);

$uid = $_SESSION['user']['id'];
$is_active =$_POST['is_active'];

$get_last_payment_sequence = return_single_ans("Select Count(pay_id) from payments $where_gc");


$sql = "INSERT INTO `payments` (`payment_Title`,`payment_detail`,`isactive` , `payment_sequence`) VALUES ('$payment_Title','$payment_detail','$is_active' , '$get_last_payment_sequence')";


$id = Insert($sql);
if($id > 0) echo $id;
else echo "0";

}

?>