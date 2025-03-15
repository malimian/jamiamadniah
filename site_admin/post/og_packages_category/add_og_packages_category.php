<?php
require_once('../../admin_connect.php');

if(isset($_POST['submit_btn'])){


$title = escape($_POST['title']);
$short_code =$_POST['short_code'];
$location =$_POST['location'];
$uid = $_SESSION['user']['id'];
$isactive =$_POST['isactive'];

$sql = "INSERT INTO `og_packages_category` (`title`,`short_code`,`location`,`isactive`) VALUES ('$title','$short_code','$location','$isactive')";


$id = Insert($sql);
if($id > 0) echo $id;
else echo "0";

}

?>