<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Card Search</title>
  <link rel="stylesheet" type="text/css" href="style2.css?ts=<?=time()?>" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> 
</head>
<body>
    <?php include('hdr.html'); ?>
    <div class="header">
	<h2>Search by Card</h2>
</div>
<div class="content">
<form action="cardsearch.php" method="post" enctype="multipart/form-data">
    <center>
    Card name:  <input type="text" name="cardname" value="" placeholder="" size="30">
    <input type="submit" value="Search" name="submit">
    </center>
</form>

<?php 

include_once("includes/config.php");

    if (isset($_POST['cardname']))
    {
        $cardname = $_POST['cardname'];
        
        $sqlc = "SELECT * FROM cards WHERE cardname='$cardname';";
        
        $result = $conn->query($sqlc);
        
        if($result && $result->num_rows > 0) {
   ?>

   <h3>Search results:</h3>

   <?php
            while($row = $result->fetch_assoc()) {
                echo '<table>';
                echo "<img src='cards/".$row['cardname'].".jpg' height='200'></div>";
                $cardset = $row["cardset"];
                echo '<tr><td>Card name:</td><td>'.$row["cardname"].'</td></tr>';
                echo '<tr><td>Set:</td><td>'.$cardset.'</td></tr>';
                echo '<tr><td><a href="/fuckery/library.php?cardname='.$cardname.'" style="color:blue;">View profile</a></td></tr>';
                echo '</table>';
            }
        }
        else {
           echo "0 results";
        }
    }
?>
    </div>
    </body>
</html>