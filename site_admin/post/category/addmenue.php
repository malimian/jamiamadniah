<?php
require_once('../../admin_connect.php');

if(isset($_POST['submit'])){


$page_title = escape($_POST['page_title']);
$page_url =$_POST['page_url'];
$showInNavBar =$_POST['showInNavBar'];
$CreateHierarchy =$_POST['CreateHierarchy'];
$uid = $_SESSION['user']['id'];
$is_active =$_POST['is_active'];
$ctname = $_POST['ctname'];

$get_last_category_sequence = return_single_ans("Select Count(catid) from category $where_gc");


$sql = "INSERT INTO `category` (`catname`, `cat_url`, `showInNavBar`, `isactive`, `createdon` , cat_sequence , CreateHierarchy , ParentCategory ) VALUES ('$page_title',  '$page_url',  '$showInNavBar', '$is_active', current_timestamp() , '$get_last_category_sequence' , '$CreateHierarchy', '$ctname')";

$id = Insert($sql);
if($id > 0) echo $id;
else echo "0";


}

?>