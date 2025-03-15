<?php
require_once('../../admin_connect.php');


$tbl = "documents";
$tbl_id = "docu_id";



if(isset($_POST['change_status'])){

$id= $_POST['id'];

$sql ="UPDATE $tbl SET isactive = 1 - isactive  
Where  $tbl_id = $id";

echo Update($sql);

}


if (isset($_POST['delete'])) {

$id= $_POST['id'];

$sql ="UPDATE $tbl SET soft_delete = 1
Where $tbl_id = $id";

echo Update($sql);

}




?>