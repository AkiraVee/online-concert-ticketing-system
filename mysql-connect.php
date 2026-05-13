<?php 

$dbhost = "localhost";
$dbuser = "root"; 
$dbpass = ""; 
$dbname = "ticketdb"; 

$conn = mysqli_connect($dbhost, $dbuser, $dbpass); 
mysqli_select_db($conn, $dbname) or die("Unable to select database");  
?>