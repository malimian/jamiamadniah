<?php 
require_once('../../../connect.php');

if(isset($_POST['submit'])){

$inputEmail = $_POST['inputEmail'];
$inputPassword1 = $_POST['inputPassword1'];
$inputPassword = $_POST['inputPassword'];
$confirmation_code = decrypt_($_POST['confirmation_code']);


$user = return_single_row(softdelete_check("SELECT id , emailaddress , emailaddress2 from loginuser Where emailaddress = '$inputEmail' AND isactive = 1 AND confirmation_code = '$confirmation_code' " , 'loginuser')." Limit 0,1");

	if(!empty($user) && ($inputPassword1 == $inputPassword) ) {
		
		$inputPassword = md5_($inputPassword);

		echo Update("Update loginuser SET password = '$inputPassword' , confirmation_code = '' Where id = ".$user['id']);
	
	}
	else echo "0";
}