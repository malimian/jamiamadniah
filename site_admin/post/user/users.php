<?php
require_once('../../admin_connect.php');


if(isset($_POST['change_status'])){

$id= $_POST['id'];

$sql ="UPDATE loginuser SET loginuser.isactive = 1 - loginuser.isactive
Where loginuser.id = $id";

Update($sql);

echo "Updated Successfully";

}


if (isset($_POST['delete_user'])) {

$id= $_POST['id'];

$sql ="UPDATE loginuser SET loginuser.soft_delete = 1
Where loginuser.id = $id";

Update($sql);

echo "Deleted Successfully";

}




?>