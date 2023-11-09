<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Member Search</title>
  <link rel="stylesheet" type="text/css" href="style2.css?ts=<?=time()?>" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> 
</head>
<body>
    <?php include('hdr.html'); ?>
    <div class="header">
	<h2>Search by Username</h2>
</div>
<div class="content">
<form action="search.php" method="post" enctype="multipart/form-data">
    <center>
    Username:  <input type="text" name="username" value="" placeholder="" size="20">
    <input type="submit" value="Search" name="submit">
    </center>
</form>

<?php 

include_once("includes/config.php");

    if (isset($_POST['username']))
    {
        $username = $_POST['username'];
        
        $sql = "SELECT * FROM users WHERE username='$username';";
        
        $result = $conn->query($sql);
        
        if($result && $result->num_rows > 0) {
   ?>

   <h3>Search results:</h3>

   <?php
            while($row = $result->fetch_assoc()) {
                echo '<center><h3>'.$username.'</h3>';
                echo '<table>';
                echo "<tr><td>Avatar:</td><td><img src='avatars/".$username.".jpg' height='54' border='2'></div>";
                echo '<tr><td>ID:</td><td>'.$row["id"].'</td></tr>';
                echo '<tr><td>Username:</td><td>'.$row["username"].'</td></tr>';
                echo '<tr><td><a href="profiles.php?id='.$row["id"].'">Profile</a></td></tr>';
            }
        }
        else {
           echo "0 results";
        }
    }
if (isset($_GET['username']))
    {
        $id = $_GET['id'];
        $username = $_GET['username'];
        $sql = "SELECT * FROM users WHERE id='$id'";
        
        $result = $conn->query($sql);
        
        if($result && $result->num_rows > 0) {
            
            if($row = $result->fetch_assoc()) {
                echo '<center><h1>'.$row["username"]."'s profile</h1>";
                echo '<table>';
                echo "<tr><td>Avatar:</td><td><img src='avatars/".$row['username'].".jpg' height='27' border='2'></div>";
                echo '<tr><td>ID:</td><td>'.$row["id"].'</td></tr>';
                echo '<tr><td>Username:</td><td>'.$row["username"].'</td></tr>';
            }
            echo '</table></center>';
        }
        else {
           echo "0 results";
        }
    }
?>
    </div>
    </body>
</html>