<?php
require_once('../../admin_connect.php');

if(isset($_POST['submit'])){


$page_title = escape($_POST['page_title']);
$page_url =$_POST['page_url'];
$showInNavBar =$_POST['showInNavBar'];
$CreateHierarchy =$_POST['CreateHierarchy'];
$uid = $_SESSION['user']['id'];
$is_active =$_POST['is_active'];
$menue_id = $_POST['menue_id'];
$ctname = $_POST['ctname'];


$sql = "UPDATE `category` SET `catname` = '$page_title', `cat_url` = '$page_url', `showInNavBar` = '$showInNavBar' , CreateHierarchy = '$CreateHierarchy', ParentCategory = '$ctname' WHERE `category`.`catid` = $menue_id  ";

$id = Update($sql);
if($id > 0) echo $id;
else echo "0";


}

?>