<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Heiwa";

//creating connection

$conn = new mysqli($servername, $username, $password);

//check connection 
if($conn->connect_error){
	die("Connection failed: " . $conn->connect_error);
	}
else{
	$conn->select_db($dbname);
	//echo "Connection successful";
	}


?>