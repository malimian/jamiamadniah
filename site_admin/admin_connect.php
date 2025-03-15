<?php
if (!isset($_SESSION)) {
	session_start();
}
require_once dirname(dirname(__FILE__)) . '/connect.php';
require_once 'setting/authenticate.php';
require_once 'lib/db_dump.php';
?>