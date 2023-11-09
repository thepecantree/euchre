<?php include('server.php') ?>
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
	<title>Messages</title>
	<link rel="stylesheet" type="text/css" href="style2.css?ts=<?=time()?>" />
</head>
<body>
    <?php include_once("includes/config.php"); ?>
    <?php include('hdr.html') ?>
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
    <?php endif ?>
    <?php 
    if (isset($_GET['id']))
    {
        $id = $_GET['id'];
        $sql6 = "SELECT * FROM messages WHERE id='$id'";
        
        $result6 = $conn->query($sql6);
        
        $row6 = $result6->fetch_assoc();
        
        if ($result6->num_rows > 0) {
            
            $recipId = $row6["recipId"];
            $senderId = $row6["senderId"];
            $sql7 = "SELECT * FROM users WHERE id='$recipId'";
            $result7 = $conn->query($sql7);
                if($row7 = $result7->fetch_assoc()) {
            $recipUsername = $row7["username"];
            }
            $sql8 = "SELECT * FROM users WHERE id='$senderId'";
            $result8 = $conn->query($sql8);
                if($row8 = $result8->fetch_assoc()) {
            $senderUsername = $row8["username"];
            }
            $sesUsername = ($_SESSION['username']);
            $sesId = ($_SESSION['id']);
            if($recipUsername == $sesUsername or $senderUsername == $sesUsername) {
                $title = $row6["title"];
            $description = $row6["description"];
            $id = $row6["id"];
            $timeSent = $row6["timeSent"];
                echo "<div class='header'>
    <h2>Messages</h2>
</div>";
    echo "<div class='content'>";
                echo "<p> <a href='usermessages.php' style='color: blue;'>Return</a></p>";
                echo "<h3>Message from ".$senderUsername." to ".$recipUsername."</h3><hr />";
                echo "<div class='content0'>";
                echo "<h4>".$title."</h4><hr /><p>".$description."</p>";
                echo "</div>";
                echo "<p>Sent at ".$timeSent."</p>";
                if($sesId == $senderId){
                echo "<p> <a href='message.php?id=".$recipId."' style='color: blue;'>Message again</a></p>";
                }
                elseif($sesId == $recipId){
                echo "<p> <a href='message.php?id=".$senderId."' style='color: blue;'>Reply</a></p>";
                }
            }
            else {
                header("location: usermessages.php");
            }
        }
        else {
            echo "<p>No data</p>";
        }
    }
    else {
        $thisUsername = $_SESSION['username'];
    echo "<div class='header'>
	<h2>Messages</h2>
</div>";
    echo "<div class='content'>";
    echo "<p> <a href='index.php' style='color: blue;'>Return</a></p>";
    $sql2 = "SELECT * FROM users WHERE username='$thisUsername'";
            $result2 = mysqli_query($db, $sql2);
            $row2 = mysqli_fetch_array($result2);
            if ($result2->num_rows > 0) {
            $thisId = $row2['id'];
            }
                else {
                    $thisId = "Blank";
                }
    $sql10 = "SELECT * FROM messages WHERE recipId='$thisId'";
        
        $result10 = $conn->query($sql10);
        
        if ($result10->num_rows > 0) {
            $rank1 = 1;
            while($row = $result10->fetch_assoc()) {
            $rank1++;
            }
        }
        $sql = "SELECT * FROM messages WHERE recipId='$thisId' order by id desc";
        
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            echo "<h3>Messages you've received</h3><hr />";
            while($row = $result->fetch_assoc()) {
            $rank1 -= 1;
            $title = $row["title"];
            $description = $row["description"];
            $id = $row["id"];
            $recipId = $row["recipId"];
            $senderId = $row["senderId"];
            $timeSent = $row["timeSent"];
            $sql5 = "SELECT * FROM users WHERE id='$recipId'";
            $result5 = $conn->query($sql5);
                if($row = $result5->fetch_assoc()) {
            $recipUsername = $row["username"];
            }
            $sql52 = "SELECT * FROM users WHERE id='$senderId'";
            $result52 = $conn->query($sql52);
                if($row = $result52->fetch_assoc()) {
            $senderUsername = $row["username"];
            }
            if($title != "") {
            $messagedata = "<div class='content0'><div></div><p> Sent by {".$senderUsername.", ID #".$senderId."}, to {".$recipUsername.", ID #".$recipId."}, at ".$timeSent."</p><div></div><a href='/fuckery/usermessages.php?id=".$id."' style='color: blue;'>".$title."</a><br /></div>";
            }
            else {
            $messagedata = "<div class='content0'><div></div><p> Sent by {".$senderUsername.", ID #".$senderId."}, to {".$recipUsername.", ID #".$recipId."}, at ".$timeSent."</p><div></div><a href='/fuckery/usermessages.php?id=".$id."' style='color: blue;'>{No title}</a><br /></div>";
            }
            echo $messagedata;
            }
        }
    else {
           echo "0 results";
        }
    echo '<hr />';
    
        $sql9 = "SELECT * FROM messages WHERE senderId='$thisId'";
        
        $result9 = $conn->query($sql9);
        
        if ($result9->num_rows > 0) {
            $rank2 = 1;
            while($row = $result9->fetch_assoc()) {
            $rank2++;
            }
        }
        $sql3 = "SELECT * FROM messages WHERE senderId='$thisId' order by id desc";
        
        $result3 = $conn->query($sql3);
        if ($result3->num_rows > 0) {
            echo "<h3>Messages you've sent</h3><hr />";
            while($row = $result3->fetch_assoc()) {
            $rank2 -= 1;
            $title = $row["title"];
            $description = $row["description"];
            $id = $row["id"];
            $recipId = $row["recipId"];
            $senderId = $row["senderId"];
            $timeSent = $row["timeSent"];
            $sql4 = "SELECT * FROM users WHERE id='$recipId'";
            $result4 = $conn->query($sql4);
                if($row = $result4->fetch_assoc()) {
            $recipUsername = $row["username"];
            }
            $sql42 = "SELECT * FROM users WHERE id='$senderId'";
            $result42 = $conn->query($sql42);
                if($row = $result42->fetch_assoc()) {
            $senderUsername = $row["username"];
            }
            if($title != "") {
            $messagedata = "<div class='content0'><div></div><p> Sent by {".$senderUsername.", ID #".$senderId."}, to {".$recipUsername.", ID #".$recipId."}, at ".$timeSent."</p><div></div><a href='/fuckery/usermessages.php?id=".$id."' style='color: blue;'>".$title."</a><br /></div>";
            }
            else {
            $messagedata = "<div class='content0'><div></div><p> Sent by {".$senderUsername.", ID #".$senderId."}, to {".$recipUsername.", ID #".$recipId."}, at ".$timeSent."</p><div></div><a href='/fuckery/usermessages.php?id=".$id."' style='color: blue;'>{No title}</a><br /></div>";
            }
            echo $messagedata;
            }
        }
    else {
           echo "0 results";
        }
    }
    echo "</center>
    </div>";
            ?>
</body>
</html>