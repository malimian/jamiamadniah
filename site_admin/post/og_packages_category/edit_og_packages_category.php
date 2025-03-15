<?php
require_once('../../admin_connect.php');

if(isset($_POST['submit'])){


$title = escape($_POST['title']);
$short_code =$_POST['short_code'];
$location =$_POST['location'];
$uid = $_SESSION['user']['id'];

$isactive =$_POST['isactive'];
$og_id = $_POST['og_id'];

$sql = "UPDATE `og_packages_category` SET `title` = '$title', `short_code` = '$short_code', `location` = '$location',`isactive` = '$isactive' WHERE `og_packages_category`.`og_all_packages_id` = $og_id  ";

$id = Update($sql);
if($id > 0) echo $id;
else echo "0";


}

?>