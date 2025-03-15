<?php 
require_once('../../admin_connect.php');


if(isset($_POST['update'])){

	$username = escape($_POST['username']);
	$email = escape($_POST['email']);
	$userpass = $_POST['userpass'];
	$ip = get_client_ip();
	$userphone = escape($_POST['userphone']);
	$userpass1 = $_POST['userpass1'];
	$country  = $_POST['country'];
	$address  = $_POST['address'];
	$city  = $_POST['city'];
	$state  = $_POST['state'];
	$zip  = $_POST['zip'];
	$home_phone  = $_POST['home_phone'];
	$mobile_phone  = $_POST['mobile_phone'];
	$fax  = $_POST['fax'];
	$other_email_address  = $_POST['other_email_address'];
	$website  = $_POST['website'];
	$company  = $_POST['company'];
	$company_title  = $_POST['company_title'];
	$company_phone  = $_POST['company_phone'];
	$toll_phone  = $_POST['toll_phone'];
	$id = decrypt_($_POST['id']);
	
	
	
	$uid = $_SESSION['user']['id'];

if( ($userpass == $userpass1) && !empty($userpass) && !empty($userpass1)){

$current_pass = return_single_ans("Select password from loginuser Where id =".$id);

// Userpass have been changed or not by User?
if($current_pass != $userpass)
	$userpass = md5_($userpass);


	$sql ="UPDATE `loginuser` SET 
	`username` = '$username',
	 `password` = '$userpass',
	   `phonenumber` = '$userphone',
	    `emailaddress` = '$email',
	     `updatedby` = '$uid',
	     `updatedon` = NOW(),
	      `lastaccessip` = '$ip',
	      `country` = '$country',
	      `address` = '$address',
	      `city` = '$city',
	      `state` = '$state',
	      `zip` = '$zip',
	      `home_phone` = '$home_phone',
	      `mobile_phone` = '$mobile_phone',
	      `fax` = '$fax',
	      `other_email_address` = '$other_email_address',
	      `website` = '$website',
	      `company` = '$company',
	      `company_title` = '$company_title',
	      `company_phone` = '$company_phone',
	      `toll_phone` = '$toll_phone'
	       WHERE `loginuser`.`id` = ".$id;


	$no_of_row_effected =  Update($sql);




}
 else echo "0";

}

?>