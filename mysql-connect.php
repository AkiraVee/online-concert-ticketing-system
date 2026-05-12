<?php 
$dbhost = "	sql208.yzz.me";
$dbuser = "yzzme_41901649"; 
$dbpass = "DqugW7sno8pL"; 
$dbname = "yzzme_41901649_ticketdb"; 

//$dbhost = "localhost";
//$dbuser = "root"; 
//$dbpass = ""; 
//$dbname = "ticketdb"; 

$conn = mysqli_connect($dbhost, $dbuser, $dbpass); 
mysqli_select_db($conn, $dbname) or die("Unable to select database");  
?>