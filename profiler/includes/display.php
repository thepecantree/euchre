<?php 
//display all users
include_once("includes/config.php");

$sql = "SELECT * FROM users";
$result = $conn->query($sql);
if (!isset($_GET['p'])) {
    header("location: profiles.php?p=1");
}
else {
if ($result->num_rows > 0) {
    echo '<table>';
    while($row = $result->fetch_assoc()) {
        $id = $row["id"];
        echo '<tr><td><a href="/profiler/profiles.php?first='.$id.'">'.$id.'</a><br /></td></tr>';
    }
    echo '</table>';
}
else {
    echo "0 results";
}
}
include_once("menu.php");
?>