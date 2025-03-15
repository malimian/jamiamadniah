<?php
require_once('../../admin_connect.php');

if(isset($_POST['submit'])){


$title = escape($_POST['title']);    
$tagline =escape($_POST['tagline']);
$url =$_POST['url'];
$email =$_POST['email'];
$key =$_POST['key'];
$key_pass =$_POST['key_pass'];
$env =$_POST['env'];
$logo =$_POST['logo'];
$img_path =$_POST['img_path'];
$time_zone =$_POST['time_zone'];
$file_path =$_POST['file_path'];
$uid = $_SESSION['user']['id'];
$friendly_url = $_POST['friendly_url'];
$page_loader = $_POST['page_loader'];


update("Update og_settings SET settings_value = '$title' Where settings_id  = 1 ");
update("Update og_settings SET settings_value = '$tagline' Where settings_id  = 2 ");
update("Update og_settings SET settings_value = '$url' Where settings_id  = 3 ");
update("Update og_settings SET settings_value = '$email' Where settings_id  = 5 ");
update("Update og_settings SET settings_value = '$key' Where settings_id  = 6 ");
update("Update og_settings SET settings_value = '$key_pass' Where settings_id  = 7 ");
update("Update og_settings SET settings_value = '$env' Where settings_id  = 8 ");
update("Update og_settings SET settings_value = '$logo' Where settings_id  = 9 ");
update("Update og_settings SET settings_value = '$img_path' Where settings_id  = 10 ");
update("Update og_settings SET settings_value = '$time_zone' Where settings_id  = 11 ");
update("Update og_settings SET settings_value = '$file_path' Where settings_id  = 12 ");
update("Update og_settings SET settings_value = '$friendly_url' Where settings_id  = 13 ");
update("Update og_settings SET settings_value = '$page_loader' Where settings_id  = 14 ");


echo "1";

}

?>