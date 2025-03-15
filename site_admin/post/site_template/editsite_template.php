<?php
require_once('../../admin_connect.php');

if(isset($_POST['submit'])){


$st_name = escape($_POST['st_name']);
$st_header = escape($_POST['st_header']);
$st_menue = escape($_POST['st_menue']);
$st_footer = escape($_POST['st_footer']);
$st_script = escape($_POST['st_script']);
$is_active =$_POST['is_active'];
$sitetemp_id =$_POST['sitetemp_id'];



$sql = "UPDATE `site_template` SET `st_name` = '$st_name', `st_header` = '$st_header', `st_menue` = '$st_menue', `st_footer` = '$st_footer', `st_script` = '$st_script', `isactive` = '$is_active' WHERE `site_template`.`st_id` = $sitetemp_id";

$id = Update($sql);
if($id > 0) echo $id;
else echo "0";


}

?>