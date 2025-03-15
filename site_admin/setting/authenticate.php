<?php
if (!isset($_SESSION)) {
	session_start();
}

if (isset($_SESSION['user'])){
	$page = (pathinfo($_SERVER['PHP_SELF']));
	$page = $page['basename'];

	$all_modules_that_are_not_allowed = $_SESSION['user']['unautorize'];
	foreach ($all_modules_that_are_not_allowed as $not_allowed_module) {
		if($page == $not_allowed_module['url']){
 		exit("<script>location.href='".ADMIN_URL."get/user/logout.php?logout'</script>");
		}	
	}

} else {
 		exit("<script>location.href='".ADMIN_URL."get/user/logout.php?logout'</script>");
}

?>