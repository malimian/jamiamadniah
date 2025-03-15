<?php 
require_once('../../admin_connect.php');


if(isset($_POST['update'])){

$user_type_select = $_POST['user_type_select'];
$username = escape($_POST['username']);
$email = escape($_POST['email']);
$userpass = $_POST['userpass'];
$userphone =escape( $_POST['userphone']);
$userpass1 = $_POST['userpass1'];
$id = decrypt_($_POST['id']);
$ip = get_client_ip();
$uid = $_SESSION['user']['id'];


if( ($userpass == $userpass1) && !empty($userpass) && !empty($userpass1)){

$current_pass = return_single_ans("Select password from loginuser Where id =".$id);

// Userpass have been changed or not by User?
if($current_pass != $userpass)
	$userpass = md5_($userpass);


$sql ="UPDATE `loginuser` SET 
	`username` = '$username',
	 `password` = '$userpass',
	  `usertypeid` = '$user_type_select',
	   `phonenumber` = '$userphone',
	    `emailaddress` = '$email',
	     `updatedby` = '$uid',
	     `updatedon` = NOW(),
	      `lastaccessip` = '$ip'
	       WHERE `loginuser`.`id` = ".$id;


	$no_of_row_effected =  Update($sql);


	if(!empty($_POST['selectedusermodule_list'])){
		Delete("DELETE FROM user_module WHERE uid = ".$id);

		$selectedusermodule_list = $_POST['selectedusermodule_list'];

		foreach ($selectedusermodule_list as $module) {
		$sql ="INSERT INTO `user_module` (`uid`, `og_module_id`, `isactive`) VALUES ( '$id', '$module', '1');";
		Insert($sql);
	}		

	}

	if(!empty($_POST['selecteduserrights_list'])){
	    Delete("DELETE FROM user_rights WHERE uid = ".$id);
		$selecteduserrights_list = $_POST['selecteduserrights_list'];
		foreach ($selecteduserrights_list as $rights) {
		$sql ="INSERT INTO `user_rights` (`uid`, `og_moduleactions_id`, `isactive`) VALUES ( '$id', '$rights', '1');";
		Insert($sql);
		}
	}
}
 else echo "0";

}

?>