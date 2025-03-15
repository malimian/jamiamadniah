<?php
session_start();
include '../../../connect.php';
if (isset($_GET['logout'])) {
session_destroy();
echo "<script>location.href='".ADMIN_URL."login.php'</script>";
}
?>