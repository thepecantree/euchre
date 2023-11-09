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
  // Create database connection
  $db = mysqli_connect("localhost", "root", "", "avatar_upload");

  // Initialize message variable
  $msg = "";

  // If upload button is clicked ...
  if (isset($_POST['avatupload'])) {
  	// Get image name
  	$avatar = $_FILES['avatar']['name'];
  
    $username = $_SESSION['username'];
    
  // Image file directory
    $target = "avatars/".basename($username).".jpg";
                                  
  	$sql = "INSERT INTO avatars (avatar, username) VALUES ('$avatar', '$username')";
    
  	// execute query
  	mysqli_query($db, $sql);

  	if (move_uploaded_file($_FILES['avatar']['tmp_name'], $target)) {
  		$msg = "Avatar uploaded successfully";
  	}else{
  		$msg = "Failed to upload image";
  	}
      
    // Get username
  }
  $result = mysqli_query($db, "SELECT * FROM avatars");
?>