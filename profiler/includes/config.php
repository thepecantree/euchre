<?php 
/*
$today = date("d-m-Y");
echo "<strong>Date: ".$today."</strong>";
list ($tday, $tmonth, $tyear) = preg_split("[-]", $today);
*/
// connect to DB
$servername = "localhost";
$username = "root";
$password = "";
$database = "registration";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die('<p style="color:red">'."Database connection failed: " . $conn->connect_error);
}
// END of connect to DB
?>