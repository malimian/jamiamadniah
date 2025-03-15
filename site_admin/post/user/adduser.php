<?php 
require_once('../../admin_connect.php');


if(isset($_POST['save'])){

$user_type_select = escape($_POST['user_type_select']);
$username = escape($_POST['username']);
$email = escape($_POST['email']);
$userpass = $_POST['userpass'];
$userphone = escape($_POST['userphone']);
$userpass1 = $_POST['userpass1'];
$p_image = $_POST['p_image'];
$uid = $_SESSION['user']['id'];

if( ($userpass == $userpass1) && !empty($userpass) && !empty($userpass1)){

$ip = get_client_ip();
$userpass = md5_($userpass);

$sql ="INSERT INTO `loginuser` (`username`, `password`, `usertypeid`, `phonenumber`, `phonenumber2`, `emailaddress`, `emailaddress2`, `isactive`, `createdon`, `createdby`, `useraccessip`, `lastaccessip`, `fullname` , profile_pic) VALUES ('$username', '$userpass', '$user_type_select', '$userphone', NULL, '$email', NULL, '1', NOW(), '$uid', '$ip', '$ip', NULL , '$p_image')";

	$user_id =  Insert($sql);

	if(!empty($_POST['selectedusermodule_list'])){

		$selectedusermodule_list = $_POST['selectedusermodule_list'];

		foreach ($selectedusermodule_list as $module) {
		$sql ="INSERT INTO `user_module` (`uid`, `og_module_id`, `isactive`) VALUES ( '$user_id', '$module', '1');";
		Insert($sql);
	}		

	}

	if(!empty($_POST['selecteduserrights_list'])){
		$selecteduserrights_list = $_POST['selecteduserrights_list'];
		foreach ($selecteduserrights_list as $rights) {
		$sql ="INSERT INTO `user_rights` (`uid`, `og_moduleactions_id`, `isactive`) VALUES ( '$user_id', '$rights', '1');";
		Insert($sql);
	}
 }


}
 else echo "0";

}

?>