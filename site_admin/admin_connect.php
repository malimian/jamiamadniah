<?php
if (!isset($_SESSION)) {
	session_start();
}
require_once dirname(dirname(__FILE__)) . '/connect.php';
require_once 'setting/authenticate.php';
require_once 'lib/db_dump.php';

require_once 'includes/header.php';
// require_once 'includes/footer.php';
// require_once 'includes/scripts.php';
// require_once 'includes/navbar.php';


?>