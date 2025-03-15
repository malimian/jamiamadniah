<?php
require_once('../../admin_connect.php');

if(isset($_POST['submit'])){


$document_Title = escape($_POST['document_Title']);
$document_page = escape($_POST['document_page']);
$document_detail = escape($_POST['document_detail']);

$uid = $_SESSION['user']['id'];

$is_active =$_POST['is_active'];

$document_id = $_POST['document_id'];



$sql = "UPDATE `documents` SET `document_Title` = '$document_Title',`document_detail` = '$document_detail' , `document_page` = '$document_page' 
WHERE `documents`.`docu_id` = $document_id  ";


$id = Update($sql);
if($id > 0) echo $id;
else echo "0";


}

?>


