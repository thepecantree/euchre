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
	<title>Profile</title>
	<link rel="stylesheet" type="text/css" href="style2.css?ts=<?=time()?>" />
</head>
<body>
    <?php include('hdr.html') ?>
    <?php include('avatarupload.php') ?>
    <?php include('descriptionupload.php') ?>
<div class="header1">
	<h2>Profile</h2>
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
    	<p><strong><?php echo $_SESSION['username']; ?>'s profile</strong></p>
        <div id="chanlist1">
        <div id="leftie1">
        <?php include('avatarH108.php') ?>
        </div>
        <div id="rightie1">
        <div class="content000">
        <form method="POST" action="profile.php" enctype="multipart/form-data" style='width:180px'>
            <input type="hidden" name="size" value="10000000">
            <div>
                <input type="file" name="avatar">
            </div>
            <div></div>
            <div>
            <button type="submit" class="btn" style="padding:10px;
  font-size:14px; height:27px;width: 70%;" name="avatupload">Change avatar</button>
            </div>
            </form>
            </div>
            </div>
        </div>
        <div id="chanlist1">
        <div id="leftie1">
            <div class="content000">
            <p style="font-size: 12px;">Description</p>
            <?php
    $username = $_SESSION['username'];
    $sql2 = "SELECT * FROM descriptions WHERE username='$username'";
            $result2 = mysqli_query($db, $sql2);
            while ($row = mysqli_fetch_array($result2)) {
                echo "<hr /><p style='font-size: 10px'>".$row['description']."</p>";
            }
        ?>
            </div>
            </div>
            <div id="rightie1">
            <div class="content000">
            <form method="POST" action="profile.php" enctype="multipart/form-data" style="width: 100%">
            <div><textarea 
        style='width: 90%'
        class='input-group'
      	id='descriptionfield' 
      	name='description'
      	placeholder='Description'></textarea>
            </div><div>
           <button type="submit" class="btn" style="padding:10px;
  font-size:14px; height:27px;width: 100%;"  "font-size: 100%;" name="descupload">Change description</button>
            </div>
            </form>
                </div>
            </div>
        </div>
    </center>
        <p> <a href="index.php" style="color: blue;">Home</a></p>
        <p> <a href="inventory.php" style="color: blue;">Inventory</a></p>
        <p> <a href="inbox2.php?p=1&l=1" style="color: blue;">Messages</a></p>
    	<p> <a href="index.php?logout='1'" style="color: red;">Log out</a> </p>
    </div>
    <?php endif ?>
</body>
</html>