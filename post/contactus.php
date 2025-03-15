<?php
session_start();
include '../connect.php';

if(isset($_POST['send_GNT'])){

	
	$GnTName = $_POST['GnTName'];
	
	
	$GnTPhone = "";
	if(isset($_POST['GnTService']))
	    $GnTPhone = $_POST['GnTPhone'];
	
	$GnTemail = $_POST['GnTemail'];
	$GnTcomment = $_POST['GnTcomment'];
	$GnTService = "";
	
	if(isset($_POST['GnTService']))
	    $GnTService = $_POST['GnTService'];
	else
	    $GnTService = "Contact Form ";

	
	$sub = "Message From ".$GnTName." - PAK SOLAR GRID";

	
	$message =  "Client Name : ".$GnTName."\n";
    $message .= "Client Phone No : ".$GnTPhone."\n";
    $message .= "Client Email : ".$GnTemail."\n";
	$message .= "Client Service : ".$GnTService."\n";
	$message .= "Client Message : ".$GnTcomment."\n";
	$message .= date("dd-M-Y");
	

	echo mail(EMAIL,$sub,$message);


}
