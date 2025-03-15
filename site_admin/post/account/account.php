<?php 

require_once('../../admin_connect.php');

if(isset($_POST['update'])){

$username = 	escape($_POST['username']);
$email = 		escape($_POST['email']);

$userpass = 	escape($_POST['userpass']);
$userpass1 = 	$_POST['userpass1'];

$uid = $_SESSION['user']['id'];
$profile = 	$_POST['p_image'];

if( ($userpass == $userpass1) && !empty($userpass) && !empty($userpass1)){



$sql ="UPDATE `user` SET 
				`uname` = '$username',
			 	`upass` = '$userpass',
			   	 `uemail` = '$email',
			   	 `profile_pic` = '$profile',
		       WHERE `user`.`id` = ".$uid;
		       
		$no_of_row_effected =  Update($sql);
        echo $no_of_row_effected;
}

 else echo "0";

}

?>