<!DOCTYPE html>
<html>
<head>
  <title>Display</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<?php
include("hdr.html");
//display all users
include_once("includes/config.php");

if (!isset($_GET['p'])) {
    header("location: profiles.php?p=1");
}
    else {
$sql = "SELECT * FROM users";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    echo '<table>';
    while($row = $result->fetch_assoc()) {
        $id = $row["id"];
        echo '<tr><td><a href="/profiles.php?id='.$id.'">'.$id.'</a><br /></td></tr>';
    }
    echo '</table>';
}
else {
    echo "0 results";
}
    }
?>
    </body>
</html>