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
  $db = mysqli_connect("localhost", "root", "", "registration");

  // Initialize message variable
  $msg = "";

  // If upload button is clicked ...
  if (isset($_POST['cardupload'])) {
      echo '<p>h</p>';
  	// Get image name
    $file = $_FILES['cardimage'];
  	$image = $_FILES['cardimage']['name'];
    $image_name = $file['name'];
    $image_tmp = $file['tmp_name'];
    $image_size = $file['size'];
    $image_ext = explode('.', $image_name);
    $image_ext = strtolower(end($image_ext));
    $allowed = array('jpg','png','mp3','webm','jpeg','txt');
  	// Get text
  	$cardname = mysqli_real_escape_string($db, $_POST['cardname']);
    $carddescription = mysqli_real_escape_string($db, $_POST['carddescription']);
    $castingcost = mysqli_real_escape_string($db, $_POST['castingcost']);
    $cardset = mysqli_real_escape_string($db, $_POST['cardset']);
    $rarity = mysqli_real_escape_string($db, $_POST['rarity']);
    if (in_array($image_ext, $allowed)) {
  	// image file directory
   $target = "cards/".$image;

  	$sql = "INSERT INTO cards (cardname, carddescription, castingcost, cardset, rarity) VALUES ( '$cardname', '$carddescription', '$castingcost', '$cardset', '$rarity')";
  	// execute query
  	mysqli_query($db, $sql);

  	if (move_uploaded_file($_FILES['cardimage']['tmp_name'], $target)) {
  		$msg = "Card uploaded successfully";
  	}else{
  		$msg = "Failed to upload card";
  	}
  }
  }
else {
}
  $uploadql = "SELECT * FROM images order by id asc";
  $result = mysqli_query($db, $uploadql);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Card Upload Station</title>
	<link rel="stylesheet" type="text/css" href="style2.css?ts=<?=time()?>" />
</head>
<body>
    <?php include('hdr.html') ?>
    <?php include('avatarupload.php') ?>
    <?php include('descriptionupload.php') ?>
<div class="header1">
	<h2>Card Uploading</h2>
</div>
<div class="content1">
  	<!-- notification message -->
  	<?php if (isset($_SESSION['success'])) : ?>
      <div class="error success" >
      	<h3>
          <?php 
          	echo $_SESSION['success']; 
          	unset($_SESSION['success']);
          ?>
      	</h3>
      </div>
  	<?php endif ?>

    <!-- logged in user information -->
    
    <?php  if (isset($_SESSION['username'])) : ?>
    <center>
    	<div id="chanlist1">
        <div>
        <form method="post" enctype="multipart/form-data" action="carduploadstation.php">
  	<div class="input-group">
  	  <label>Card name</label>
  	  <input type="text" name="cardname">
  	</div>
    <div class="input-group">
        <label>Card image</label>
        <input type="file" name="cardimage">
      </div>
    <div class="input-group">
  	  <label>Card description</label>
  	  <input type="text" name="carddescription">
  	</div>
  	<div class="input-group">
  	  <label>Casting cost</label>
  	  <input type="text" name="castingcost">
  	</div>
  	<div class="input-group">
  	  <label>Set</label>
  	  <input type="text" name="cardset">
  	</div>
  	<div class="input-group">
  	  <label>Rarity</label>
  	  <input type="text" name="rarity">
  	</div>
  	<div class="input-group">
  	  <button type="submit" class="btn" name="cardupload">Upload</button>
  	</div>
</form>
        </div>
        </div>
    </center>
        <p> <a href="index.php" style="color: blue;">Home</a></p>
        <p> <a href="inbox2.php?p=1&l=1" style="color: blue;">Messages</a></p>
    	<p> <a href="index.php?logout='1'" style="color: red;">Log out</a> </p>
    </div>
    <?php endif ?>