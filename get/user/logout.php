<?php
// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include '../../connect.php';

if (isset($_GET['logout'])) { 
	
	session_destroy();
	
	isset($_GET['return']) ? 
	exit ("<script>location.href='".BASE_URL.$_GET['return']."'</script>") : 
	exit ("<script>location.href='".BASE_URL."login.php'</script>") ;

}
?>