<?php
require_once('../../admin_connect.php');


$tbl = "images";
$tbl_id = "i_id";

if (isset($_POST['delete'])) {

$id= $_POST['id'];

$file_name = return_single_ans("Select i_name from $tbl Where $tbl_id = $id");

unlink('../../../'.ABSOLUTE_IMAGEPATH.$file_name);

$sql ="Delete from $tbl Where $tbl_id = $id";

echo Delete($sql);


}



?>