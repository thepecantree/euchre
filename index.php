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
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="style.css?ts=<?=time()?>">
</head>
<body>
    <?php include('hdr.html') ?>
    <?php include('postupload.php') ?>
<div class="header">
	<h2>Home</h2>
</div>
<div class="content">
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
    <?php  if (isset($_SESSION['username'])) {
    $username = $_SESSION['username']; 
}
    if ($username != "testuser") {
        echo "<p>Welcome, ".$_SESSION['username']."</p>
        <div style='height:90%;'> <img src='avatars/".$username.".jpg' style='width:40%' border='2'></div>";
        echo "<p style='color: green;'><b>Dough: ".$_SESSION['dough']."</b></p>";
        echo "<p> <a href='profile.php' style='color: blue;'>Profile</a></p>";
        echo "<p> <a href='inbox2.php?p=1&l=1' style='color: blue;'>Messages</a></p>";
    	echo "<p> <a href='index.php?logout='1'' style='color: red;'>Log out</a> </p>";
    }
    if ($username == "testuser") {
        echo "<p>Welcome, ".$_SESSION['username']." the God</p>
        <div style='height:90%;'> <img src='avatars/".$username.".jpg' style='width:40%' border='2'></div>";
        echo "<p style='color: green;'><b>Dough: ".$_SESSION['dough']."</b></p>";
        echo "<p> <a href='profile.php' style='color: blue;'>Profile</a></p>";
        echo "<p> <a href='inventory.php' style='color: blue;'>Inventory</a></p>";
        echo "<p> <a href='inbox2.php?p=1&l=1' style='color: blue;'>Messages</a></p>";
    	echo "<p> <a href='index.php?logout='1'' style='color: red;'>Log out</a> </p>";
        echo "</div>
        <form method='POST' action='index.php' enctype='multipart/form-data'>
  	<input type='hidden' name='size' value='10000000'>
  	<div>
  	  <input type='file' name='image'>
  	</div>
     	<div>
      <textarea 
        class='input-group'
      	id='text' 
      	name='title'
      	placeholder='Title'></textarea>
  	</div>
  	<div>
      <textarea 
        class='input-group'
      	id='text' 
      	name='description'
      	placeholder='Description'></textarea>
  	</div>
  	<div>
  		<button type='submit' class='btn' name='upload'>Upload</button>
  	</div>
  </form>";
    } ?>
    </div>
</body>
</html>