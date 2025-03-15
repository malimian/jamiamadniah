<?php 
include '../connect.php';

if(isset($_POST['submit'])){

$username = escape($_POST['username']);
$email = escape($_POST['email']);
$userpass = $_POST['userpass'];
$userpass1 = $_POST['userpass1'];

if( ($userpass == $userpass1) && !empty($userpass) && !empty($userpass1)){

$ip = get_client_ip();

$userpass = md5_($userpass);

$sql ="INSERT INTO `loginuser` (`username`, `password`, `emailaddress`) VALUES ('$username', '$userpass', '$email')";

$id = Insert($sql);

echo $id;

}
 else echo "0";

}

?>