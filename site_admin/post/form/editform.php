<?php
require_once('../../admin_connect.php');

if(isset($_POST['submit'])){


$form_name = escape($_POST['form_name']);
$form_code = escape($_POST['form_code']);
$form_data = escape($_POST['form_data']);
$form_date = escape($_POST['form_date']);
$form_id   = escape($_POST['form_id']);
$is_active =$_POST['is_active'];


$sql = "UPDATE `form_template` SET `form_name` = '$form_name',`form_code` = '$form_code',`form_data`='$form_data',`create_date`='$form_date',`isactive`='$is_active' WHERE `form_template`.`form_id`= $form_id";


$id = Update($sql);
if($id > 0) echo $id;
else echo "0";


}

?>


