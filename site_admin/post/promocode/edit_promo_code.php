<?php
require_once('../../admin_connect.php');

if(isset($_POST['submit'])){

    
$p_title = htmlspecialchars($_POST['p_title'], ENT_QUOTES);
$p_percent =$_POST['p_percent'];
$p_code = $_POST['p_code'];
$p_desc =$_POST['editor1'];
$p_validity = $_POST['p_validity'];
$p_used_times = $_POST['p_used_times'];
$p_desc = htmlspecialchars($p_desc, ENT_QUOTES);
$uid = $_SESSION['user']['id'];
$isactive  = $_POST['isactive'];



$sql = "UPDATE promocode SET  
p_title = '$p_title',
p_percent = '$p_percent',
p_code = '$p_code',
p_desc = '$p_desc',
p_validity = '$p_validity',
p_used_times = '$p_used_times',
updatedby = '$uid',
isactive = '$isactive',
updatedon = NOW()
WHERE p_id = ".decrypt_($_GET['id']);


if ($conn->query($sql) === TRUE) {
    echo "1";

} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

    
}

?>
