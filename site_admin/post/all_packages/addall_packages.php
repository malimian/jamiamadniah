<?php
require_once('../../admin_connect.php');

if(isset($_POST['submit_btn'])){

$ptitle = escape($_POST['ptitle']);
$p_image = escape($_POST['p_image']);
$p_cost =$_POST['p_cost'];
$packages_category = escape($_POST['packages_category']);
$IsFeatured = escape($_POST['IsFeatured']);
$FeaturedText =escape($_POST['FeaturedText']);
$isactive =escape($_POST['isactive']);
$p_content = escape($_POST['p_content']);


$sql = "INSERT INTO `all_packages` (`ptitle`,`p_image`,`p_cost`,`packages_category`,`IsFeatured`,`FeaturedText`,`isactive`,`p_content`) VALUES ('$ptitle','$p_image','$p_cost','$packages_category','$IsFeatured','$FeaturedText','$isactive','$p_content')";


$id = Insert($sql);
if($id > 0) echo $id;
else echo "0";

}

?>