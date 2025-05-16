<?php
require_once('../../admin_connect.php');

if(isset($_POST['submit_btn'])){


$document_Title = escape($_POST['document_Title']);
$document_page = escape($_POST['document_page']);
$document_detail = escape($_POST['document_detail']);

$uid = $_SESSION['user']['id'];
$is_active =$_POST['is_active'];

$get_last_document_sequence = return_single_ans("Select Count(docu_id) from documents $where_gc");


$sql = "INSERT INTO `documents` (`document_Title`,`document_detail`,`isactive` , `document_sequence`, `document_page`) VALUES ('$document_Title','$document_detail','$is_active' , '$get_last_document_sequence' , '$document_page')";

$id = Insert($sql);

if($id > 0){
    $oid = encrypt_($id);
    echo $id;
}
else echo "0";

}

?>