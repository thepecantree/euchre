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
    include('hdr.html');
    include_once("includes/config.php");
  $result = mysqli_query($db, "SELECT * FROM cards");
    if (isset($_GET['cardname']))
    {
        $cardname = $_GET['cardname'];
        $sql = "SELECT * FROM cards WHERE cardname='$cardname'";
        
        $result = $conn->query($sql);
        
        if($result && $result->num_rows > 0) {
            
            if($row = $result->fetch_assoc()) {
            $cardname = $row["cardname"];
            echo "<center><div style='width:90%'>";
            echo "<div style='margin:0 auto'><div style='float:left; width:60%'>";
            echo "<div class='header' style='width:90%'>";
            echo '<h3>'.$row["cardname"].'</h3>';
            echo '<tr><td></div><td><tr>';
            echo "<div class='content' style='width:90%'>";
            echo "<div style='width:200px, word-wrap: break-word;'>";
            echo '<center><table><a href="/fuckery/profiles.php?p=1" style="color:blue;">Return</a><br />';
            echo "<img src='cards/".$row['cardname'].".jpg' height='200'>";
            echo '<tr><td>Name:</td><td>'.$row["cardname"].'</td></tr>';
            echo '<tr><td>Casting cost:</td><td>'.$row["castingcost"].'</td></tr>';
            echo '<tr><td>Description:</td><td>'.$row["carddescription"].'</td></tr>';
            echo '<tr><td>Set:</td><td>'.$row["cardset"].'</td></tr>';
            echo '<tr><td>Rarity:</td><td>'.$row["rarity"].'</td></tr>';
            echo '<tr><td>Card cost:</td><td>$'.$row["cardcost"].'</td></tr>';
            echo '<tr><td><p><a href="message.php?id='.$id.'" style="color: blue;">Favorite</a></p></td></tr>';
            echo '<tr><td>';
            echo '</td></tr>';
            echo '<td><hr /></td></tr>';
            echo '</table></center>';
                              $db2 = mysqli_connect("localhost", "root", "", "registration");
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
                echo "</div></div></div>";
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
    include_once("includes/carddisplay.php");
    }
?>
    </body>