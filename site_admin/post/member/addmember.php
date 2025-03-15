<?php 
require_once('../../admin_connect.php');


if(isset($_POST['save'])){


$username = escape($_POST['username']);
$email = escape($_POST['email']);
$userpass = $_POST['userpass'];
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



$uid = $_SESSION['user']['id'];

if( ($userpass == $userpass1) && !empty($userpass) && !empty($userpass1)){

$ip = get_client_ip();
$userpass = md5_($userpass);

$sql ="INSERT INTO `loginuser` (`username`, `password`, `usertypeid`, `phonenumber`, `phonenumber2`, `emailaddress`, 
`emailaddress2`, `isactive`, `createdon`, `createdby`, `useraccessip`, `lastaccessip`,
 `fullname` , `profile_pic`,
`country`,`address`,`city`,`state`,`zip`,`home_phone`,`mobile_phone`,`fax`,
`other_email_address`,`website`,`company`,`company_title`,`company_phone`,`toll_phone`)


 VALUES ('$username', '$userpass', '3', '$userphone', NULL, '$email', 
 NULL, '1',  NOW(),'$uid', '$ip', '$ip',
  NULL , NULL, 
  '$country','$address','$city','$state','$zip','$home_phone','$mobile_phone','$fax',
  '$other_email_address','$website','$company','$company_title','$company_phone','$toll_phone')";

	$user_id =  Insert($sql);

}
 else echo "0";
}


?>