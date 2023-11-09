<?php include('server.php') ?>
<?php 
  if (!isset($_SESSION)) {
      session_start(); 
  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: login.php");
  }
  }
  if (isset($_SESSION['username'])) {
  }
?>
<!DOCTYPE html>
<html>
<head>
  <title>Log In</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <?php include('hdr.html') ?>
  <div class="header">
  	<h2>Log In</h2>
  </div>
<form method="post" action="login.php">
  	<?php include('errors.php'); ?>
  	<div class="input-group">
  		<label>Username</label>
  		<input type="text" name="username" >
  	</div>
  	<div class="input-group">
  		<label>Password</label>
  		<input type="password" name="password">
  	</div>
  	<div class="input-group">
  		<button type="submit" class="btn" name="login_user">Log in</button>
  	</div>
  	<p>
  		Not yet a member? <a href="register.php">Sign up</a>
  	</p>
  </form>

</body>
</html>