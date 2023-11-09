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
    if (isset($_GET['cardId']))
    {
        $cardId = $_GET['cardId'];
        $sql = "SELECT * FROM cards WHERE cardId='$cardId'";
        
        $result = $conn->query($sql);
        
        if($result && $result->num_rows > 0) {
            
            if($row = $result->fetch_assoc()) {
            $cardId = $row["cardId"];
            $cardname = $row["cardname"];
            echo "<center><div style='width:90%'>";
            echo "<div style='margin:0 auto'><div style='float:left; width:60%'>";
            echo "<div class='header' style='width:90%'>";
            echo '<h3>'.$row["cardname"].'</h3>';
            echo '<tr><td></div><td><tr>';
            echo "<div class='content' style='width:90%'>";
            echo '<center><table><a href="/fuckery/library.php?p=1" style="color:blue;">Return</a><br />';
            echo "<img src='cards/".$row['cardname'].".jpg' height='162' border='2'>";
            } else {}
        } else {}
    }
else {
}
    else {
    include_once("includes/display.php");
    }
?>
    </body>