<?php
require_once('../../admin_connect.php');

if(isset($_POST['submit'])){

$ptitle = escape($_POST['ptitle']);
$p_image = escape($_POST['p_image']);
$p_cost =$_POST['p_cost'];
$packages_category = escape($_POST['packages_category']);
$IsFeatured = escape($_POST['IsFeatured']);
$FeaturedText =escape($_POST['FeaturedText']);
$isactive =escape($_POST['isactive']);
$p_content = escape($_POST['p_content']);
$all_packages_id = $_POST['all_packages_id'];


$sql = "UPDATE `all_packages` SET `ptitle` = '$ptitle',`p_image` = '$p_image',`p_cost` = '$p_cost',`packages_category` = '$packages_category',`IsFeatured` = '$IsFeatured',`IsFeatured` = '$IsFeatured',`FeaturedText` = '$FeaturedText',`isactive` = '$isactive',`p_content` = '$p_content'  WHERE `all_packages`.`pid` = $all_packages_id  ";


$id = Update($sql);
if($id > 0) echo $id;
else echo "0";


}

?>


