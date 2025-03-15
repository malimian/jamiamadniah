<?php
require_once('../../admin_connect.php');

if(isset($_POST['submit_btn'])){


$form_name = escape($_POST['form_name']);
$form_code = escape($_POST['form_code']);
$form_data = escape($_POST['form_data']);
$form_date = escape($_POST['form_date']);
$is_active =$_POST['is_active'];



$sql = "INSERT INTO `form_template` (`form_name`,`form_code`,`form_data`,`create_date`,`isactive`) VALUES ('$form_name','$form_code','$form_data','$form_date','$is_active')";


$id = Insert($sql);
if($id > 0) echo $id;
else echo "0";

}

?>