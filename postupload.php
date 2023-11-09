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
  // Create database connection
  $postdb = mysqli_connect("localhost", "root", "", "post_upload");

  // Initialize message variable
  $msg = "";

  // If upload button is clicked ...
  if (isset($_POST['upload'])) {
  	// Get information
  	$image = $_FILES['image']['name'];
  	$creator = $_SESSION['username'];
    $title = mysqli_real_escape_string($postdb, $_POST['title']);
  	$description = mysqli_real_escape_string($postdb, $_POST['description']);

  	// image file directory
  	$target = "postimg/".basename($image);

  	$sql = "INSERT INTO posts (image, title, description, creator) VALUES ('$image', '$title', '$description', '$creator')";
  	// execute query
  	mysqli_query($postdb, $sql);

  	if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
  		$msg = "Image uploaded successfully";
  	}else{
  		$msg = "Failed to upload image";
  	}
  }
  $result = mysqli_query($postdb, "SELECT * FROM posts");
?>