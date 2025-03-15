<?php 
require_once('../../../connect.php');

if(isset($_POST['submit'])){
$inputEmail = $_POST['inputEmail'];

$user = return_single_row(softdelete_check("SELECT id , emailaddress , emailaddress2 from loginuser Where emailaddress = '$inputEmail' AND isactive = 1" , 'loginuser')." Limit 0,1");

	if(!empty($user)) {
		$new_confirmation_code = md5_(microtime());
		echo Update("Update loginuser SET confirmation_code = '$new_confirmation_code' Where id = ".$user['id']);

		password_recovery($user['emailaddress'] , EMAIL , $new_confirmation_code);

		if(!empty($user['emailaddress2'])) 
			password_recovery($user['emailaddress2'] , EMAIL , $new_confirmation_code);
	
	}
	else echo "0";
}