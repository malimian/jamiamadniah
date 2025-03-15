<?php
$conn;
if($_SERVER['REMOTE_ADDR'] == "::1" || $_SERVER['REMOTE_ADDR'] == "127.0.0.1"){

	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "ibspotlight";
	$conn = new mysqli($servername, $username, $password, $dbname);
}
else{
	$servername = "localhost";
	$username = "ibspotlight9225";
	$password = "ibspotlight9225";
	$dbname = "ibspotlight9225";
	$conn = new mysqli($servername, $username, $password, $dbname);	
	//u
}
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else $GLOBALS['conn'] = $conn;