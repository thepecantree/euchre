<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Member List</title>
  <link rel="stylesheet" type="text/css" href="style.css?ts=<?=time()?>" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> 
</head>
<body>
    <?php 
    include('hdr.html');
?>
    <center>
    <div class="header">
	<h3>Message</h3>
</div>
<div class="content">
    <?php
    include_once("includes/config.php");
    $senderUsername = $_SESSION['username'];
    $sql2 = "SELECT * FROM users WHERE username='$senderUsername'";
            $result2 = mysqli_query($db, $sql2);
            $row2 = mysqli_fetch_array($result2);
            if ($result2->num_rows > 0) {
            $senderId = $row2['id'];
            }
                else {
                    $senderId = "Blank";
                }
    if (isset($_GET['id']))
    {
        $id = $_GET['id'];
        $sql = "SELECT * FROM users WHERE id='$id'";
        
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            
            if($row = $result->fetch_assoc()) {
            $recipId = $row["id"];
            $recipUsername = $row["username"];
            }
        }
            echo "<table>";
            echo "<tr><td>Recipient: </td><td><img src='avatars/".$recipUsername.".jpg' height='27' border='2'></td><td><span>$recipUsername, ID #$recipId</span></td></tr>";
            echo "<div></div>";
            echo "<tr><td>Sender: </td><td><img src='avatars/".$senderUsername.".jpg' height='27' border='2'></td><td><span>$senderUsername, ID #$senderId</span></td></tr>";
            echo '</table></center>';
            echo "<form method='POST' action='message.php?id=".$id."' enctype='multipart/form-data'>
  	<div>
    <label>Title</label>
  	  <div>
      <textarea 
        rows='1' cols='40'
        class='input-group'
      	id='title' 
      	name='title'
      	placeholder='Title'></textarea>
  	</div>
  	</div>
  	<div>
  	  <label>Description</label>
  	  <div>
      <textarea 
        rows='4' cols='40'
        class='input-group'
      	id='description' 
      	name='description'
      	placeholder='Descrption'></textarea>
  	</div>
  	<div>
  		<button type='submit' class='btn' name='send'>Send</button>
  	</div>
  </form>";
        }
        else {
           echo "0 results";
        }
if (isset($_POST['send'])) {
  	// Get text
    $title = mysqli_real_escape_string($db, $_POST['title']);
  	$description = mysqli_real_escape_string($db, $_POST['description']);
    $opened = 0;
    $recipDelete = 0;
    $senderDelete = 0;
    date_default_timezone_set('America/New_York');
    $dateTime = date('Y-m-d H:i:s');
    
    if($title!="" && $description!="") {
    
    echo "<p>Message sent!</p>";
    echo "<p>Title: ".$title."<div></div>Description: ".$description."</p>";
    echo "<p>Sent at: ".$dateTime."</p>";
        
  	$sql = "INSERT INTO messages (recipId, senderId, recipUsername, senderUsername, title, description, timeSent) VALUES ('$recipId', '$senderId', '$recipUsername', '$senderUsername', '$title', '$description', '$dateTime')";
  	// execute query
  	mysqli_query($db, $sql);

  	//if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
  		//$msg = "Image uploaded successfully";
  	//}else{
  		//$msg = "Failed to upload image";
  	//}
    }
    else {
        echo "<p>Make sure your message isn't empty!</p>";
    }
    }
    $result = mysqli_query($db, "SELECT * FROM messagess");
?>
        </div>
    </center>
    </body>