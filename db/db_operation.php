<?php

function return_single_ans($sql){
global $conn;
$bt = debug_backtrace();
$result = $conn->query($sql);
if ($result == TRUE) {
if ($result->num_rows > 0) {
$row = $result->fetch_assoc();
   return reset($row);
  }
 }
    else return debug_($bt , $sql);
}

function return_single_row($sql){
global $conn;
$bt = debug_backtrace();
$result = $conn->query($sql);
if ($result == TRUE) {
if ($result->num_rows > 0) {
$row = $result->fetch_assoc();
return $row;
}
}
	else return debug_($bt , $sql);

}

function return_multiple_rows($sql){
$arr = [];
global $conn;
$bt = debug_backtrace();
$result = $conn->query($sql);
if ($result == TRUE) {
while($row = $result->fetch_assoc()) {
  $arr[] = $row; 
}
 return $arr;
}  
	else return  debug_($bt , $sql);

}

//MYSQLI Real Escape String
function escape($string){
global $conn;
return $conn->real_escape_string($string);
}


function Insert($sql){
global $conn;
$bt = debug_backtrace();

if ($conn->query($sql) === TRUE) {
    $last_id = $conn->insert_id;
   	return $last_id;
} 
	else return debug_($bt , $sql);
}


function Update($sql){
global $conn;
$bt = debug_backtrace();
if ($conn->query($sql) === TRUE) {
    $affected_rows = $conn->affected_rows;
   	return $affected_rows;
} 
	else return debug_($bt , $sql);
}

function Delete($sql){
global $conn;
$bt = debug_backtrace();
if ($conn->query($sql) === TRUE) {
    $affected_rows = $conn->affected_rows;
   	return $affected_rows;
} 
 return debug_($bt , $sql);
}

