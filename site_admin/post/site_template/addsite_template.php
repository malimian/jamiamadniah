<?php
require_once('../../admin_connect.php');

if(isset($_POST['submit'])){


$st_name = escape($_POST['st_name']);
$st_header = escape($_POST['st_header']);
$st_menue = escape($_POST['st_menue']);
$st_footer = escape($_POST['st_footer']);
$st_script = escape($_POST['st_script']);
$is_active =$_POST['is_active'];
$uid = $_SESSION['user']['id'];

$sql = "INSERT INTO `site_template` (`st_name`, `st_header`, `st_menue`, `st_footer`, `st_script`, `isactive`) VALUES ('$st_name', '$st_header', '$st_menue', '$st_footer', '$st_script', '$is_active')";

$id = Insert($sql);
if($id > 0) echo $id;
else echo "0";


}

?>