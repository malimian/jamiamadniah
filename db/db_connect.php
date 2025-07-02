<?php
$conn;
if($_SERVER['REMOTE_ADDR'] == "::1" || $_SERVER['REMOTE_ADDR'] == "127.0.0.1"){

	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "jamiamadniah";
	$conn = new mysqli($servername, $username, $password, $dbname);
}
else{
	$servername = "localhost";
	$username = "jamiamadniah123";
	$password = "jamiamadniah123";
	$dbname = "jamiamadniah";
	$conn = new mysqli($servername, $username, $password, $dbname);	
	//u
}
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else $GLOBALS['conn'] = $conn;