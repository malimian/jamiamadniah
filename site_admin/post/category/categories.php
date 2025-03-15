<?php
require_once('../../admin_connect.php');


$tbl = "category";
$tbl_id = "catid";
$tbl_seq = "cat_sequence";


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



if (isset($_POST['updatesequence'])) {

$id= $_POST['id'];

$sequence= $_POST['sequence'];

$sql ="UPDATE `$tbl` SET  $tbl_seq = '$sequence' WHERE $tbl_id = $id";

echo Update($sql);

}





?>