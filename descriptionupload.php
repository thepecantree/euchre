<?php 
  if (session_status() == PHP_SESSION_NONE) {
    session_start();
} 

  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: login.php");
  }
?>
<?php
    include_once("regconfig.php");
  // Create database connection
  $db = mysqli_connect("localhost", "root", "", "registration");

  // Initialize message variable
  $msg = "";

  // If upload button is clicked ...
if (isset($_POST['descupload'])) {
  $description = mysqli_real_escape_string($db, $_POST['description']);
  $username = $_SESSION['username'];
  $sql = "SELECT description FROM descriptions WHERE username='$username'";
  $description2 = mysqli_query($db, "SELECT description FROM descriptions WHERE username = '$username'");
  $result = $conn->query($sql);
        if ($description2->num_rows > 0) {
            mysqli_query($db, "UPDATE descriptions
SET description = '$description'
WHERE username = '$username'");
        }
  	// image file directory
  	$sql = "INSERT INTO descriptions (username, description) VALUES ('$username', '$description')";
  	// execute query
  	mysqli_query($db, $sql);
}
  $result = mysqli_query($db, "SELECT * FROM descriptions");
?>