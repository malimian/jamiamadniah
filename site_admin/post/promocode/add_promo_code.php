<?php
require_once('../../admin_connect.php');

if(isset($_POST['submit'])){

$p_title =htmlspecialchars($_POST['p_title'], ENT_QUOTES);
$p_percent = $_POST['p_percent'];
$p_code = $_POST['p_code'];
$p_desc = $_POST['editor1'];
$p_validity = $_POST['p_validity'];
$p_used_times = $_POST['p_used_times'];
$p_desc = htmlspecialchars($p_desc, ENT_QUOTES);
$uid = $_SESSION['user']['id'];
$isactive  = $_POST['isactive'];

	$sql = "INSERT INTO promocode ( p_title , p_percent , p_code , p_desc , p_validity , p_used_times ,  createdby , createdon , isactive ) VALUES
(
'$p_title' ,
'$p_percent' ,
'$p_code' ,
'$p_desc',
'$p_validity' ,
'$p_used_times' ,
'$uid', 
 NOW(),
'$isactive'
)";

$id = INSERT($sql);
if($id > 0) {

	echo $id;
}
else echo "1";


}

?>