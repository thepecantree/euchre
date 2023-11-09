<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Member List</title>
  <link rel="stylesheet" type="text/css" href="style2.css?ts=<?=time()?>" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> 
</head>
<body>
    <?php 
    if (isset($_POST['doughu']))
                {
  $dough0 = $_POST['doughu'];
  echo "<p>H</p>";
  echo $dough0;
    }
    include('hdr.html');
    include_once("includes/config.php");
  $result = mysqli_query($db, "SELECT * FROM users");
    if (isset($_GET['id']))
    {
        $id = $_GET['id'];
        $sql = "SELECT * FROM users WHERE id='$id'";
        
        $result = $conn->query($sql);
        
        if($result && $result->num_rows > 0) {
            
            if($row = $result->fetch_assoc()) {
            $id = $row["id"];
            $username = $row["username"];
            $banStatus = $row["banStatus"];
            $adminStatus = $row["adminStatus"];
            $modStatus = $row["modStatus"];
            $dough2 = $row["dough"];
            $pointtotal2 = $row["userpoints"];
            echo "<center><div style='width:90%'>";
            echo "<div style='margin:0 auto'><div style='float:left; width:60%'>";
            echo "<div class='header' style='width:90%'>";
            echo '<h3>'.$row["username"]."'s Profile</h3>";
            echo '<tr><td></div><td><tr>';
            echo "<div class='content' style='width:90%'>";
            echo '<center><table><a href="/fuckery/profiles.php?p=1" style="color:blue;">Return</a><br />';
            echo "<img src='avatars/".$row['username'].".jpg' height='162' border='2'>";
            if ($banStatus != 0) {
                echo "<p style='color: red'>[USER BANNED]</p>";
            }
                else {}
            if ($adminStatus != 0) {
                echo "<p style='color: blue'>[ADMIN USER]</p>";
            }
                else {}
            if ($modStatus != 0) {
                echo "<p style='color: teal'>[MOD USER]</p>";
            }
                else {}
            echo '<tr><td>ID:</td><td>'.$row["id"].'</td></tr>';
            echo '<tr><td>Username:</td><td>'.$row["username"].'</td></tr>';
            echo '<tr><td><p><a href="message.php?id='.$id.'" style="color: blue;">Message</a></p></td></tr>';
            echo '<tr><td>';
            echo '</td></tr>';
            echo "<td><span>Good boy points: ".$pointtotal2."</span><form action='profiles.php?id=".$id."' method='POST' enctype='multipart/form-data'>
            <button type='submit' name='points' style='padding:10px;
  font-size:14px; height:27px;width:15px;'>
    </form></center></td>";
            $sql2 = "SELECT * FROM descriptions WHERE username='$username'";
            $result2 = mysqli_query($db, $sql2);
            if($row = $result2->fetch_assoc()) {
                $description = $row['description'];
                echo "<div style='width:80%'>";
                echo "<p>".$description."</p>";
                echo "</div></div>";
            }
                else {
                    echo "</div>";
                }
            echo '</table></center>';
            if (session_status() != PHP_SESSION_NONE) {
                if ($_SESSION['adminStatus']!="0") {
                echo "<center>";
            include('bothersome.php');
            echo "<p style='color:green'>Dough: ".$dough2."</p>
            <form action='profiles.php?id=".$id."' method='post' enctype='multipart/form-data'>
            <input type='text' name='doughu' value='' placeholder='' size='20>
    <button type='submit' value='Submit' name='Submit'>
    </form></center>";
            }
            }
        if (isset($_POST['unban']))
            {
        $sql3 = "UPDATE users
SET banStatus = '0'
WHERE username = '$username'";
        
        mysqli_query($conn, $sql3);
        echo "<script>
        window.location.replace('profiles.php?id=".$id."');
        </script>";
        }
        if (isset($_POST['ban']))
            {
        $sql4 = "UPDATE users
SET banStatus = '1'
WHERE username = '$username'";
        
        mysqli_query($conn, $sql4);
           echo "<script>
        window.location.replace('profiles.php?id=".$id."');
        </script>"; 
        }
        
        if (isset($_POST['unmod']))
            {
        $sql3 = "UPDATE users
SET modStatus = '0'
WHERE username = '$username'";
        
        mysqli_query($conn, $sql3);
        echo "<script>
        window.location.replace('profiles.php?id=".$id."');
        </script>";
        }
        if (isset($_POST['mod']))
            {
        $sql4 = "UPDATE users
SET modStatus = '1'
WHERE username = '$username'";
        
        mysqli_query($conn, $sql4);
           echo "<script>
        window.location.replace('profiles.php?id=".$id."');
        </script>"; 
        }
                              $db2 = mysqli_connect("localhost", "root", "", "registration");
        if (isset($_POST['points']))
            {
        $adds = 1;
        $oldtotal = $pointtotal2;
        $newtotal = $oldtotal + $adds;
        $sql3 = "UPDATE users
SET userpoints = $newtotal
WHERE username = '$username'";
        
        mysqli_query($conn, $sql3);
        echo "<script>
        window.location.replace('profiles.php?id=".$id."');
        </script>";
        }
          if (isset($_POST['upload'])) {
  	// Get text
  	$comment_text = mysqli_real_escape_string($db2, $_POST['comment_text']);
    // Get uploader
    $commenterUsername = $_SESSION['username'];
    $profileUsername = $username;
    $sql6 = "INSERT INTO comments (commenterUsername, profileUsername, commentData) VALUES ('$commenterUsername','$profileUsername','$comment_text')";
  	// execute query
  	mysqli_query($db2, $sql6);
  }
else {
}
  $uploadql = "SELECT * FROM images order by id asc";
  $result4 = mysqli_query($db2, $uploadql);
                if (isset($_POST['doughu']))
                {
  $dough = $_POST['doughu'];
  echo $_POST['doughu'];
  echo "<p>H</p>";
  $sql5 = "SELECT dough FROM users WHERE username='$username'";
  $dough2 = mysqli_query($db, "SELECT dough FROM users WHERE username = '$username'");
  $result3 = $conn->query($sql5);
        if ($dough2->num_rows > 0) {
            mysqli_query($db, "UPDATE users
SET dough = '$dough0'
WHERE username = '$username'");
        }
  	// image file directory
  	$sql5 = "MODIFY users set dough='".$dough0."' where username='".$username."')";
  	// execute query
  	mysqli_query($db, $sql5);
}
                echo "</div></div>";
                echo "<div style='float:right; width:40%'><div class='header' style='width:90%'><h3>".$username."'s gallery</h3></div><div class='content' style='width:90%'><form method='POST' action='profiles.php?id=".$id."' enctype='multipart/form-data'>
  	<input type='hidden' name='size' value='1000000000'>
  	<div>
      <textarea 
        class='input-group'
      	id='text' 
      	name='comment_text'
      	placeholder='Caption'></textarea>
  	</div>
  	<div>
  		<button type='submit' class='btn' name='upload'>Upload</button>
  	</div>
  </form>
  </div></div>
  <div style='float:right; width:40%'><div class='header' style='width:90%'><h3>".$username."'s gallery</h3></div><div class='content' style='width:90%'></div></div></div></div></div></center>";
        }
        }
        else {
           echo "<center><h3>Account not found</h3></center>";
        }
}
    else {
    include_once("includes/display.php");
    }
?>
    </body>