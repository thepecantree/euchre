<h1>Search by Username</h1>
<form action="search.php" method="post" enctype="multipart/form-data">
    Username:  <input type="text" name="username" value="" placeholder="" size="20">
    <input type="submit" value="Search" name="submit">
</form>

<?php 

include_once("includes/config.php");

    if (isset($_POST['username']))
    {
        $country = $_POST['username'];
        
        $sql = "SELECT * FROM users WHERE username='$username';";
        
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
   ?>

   <h3>Search results:</h3>

   <?php
            while($row = $result->fetch_assoc()) {
                echo '<table>';
                echo '<tr><td>ID:</td><td>'.$row["id"].'</td></tr>';
                echo '<tr><td>Avatar:</td><td><img src="'.$row["avatar"].'" width="100px" /></td></tr>';
                echo '<tr><td>Firstname:</td><td>'.$row["firstname"].'</td></tr>';
                echo '<tr><td>Lastname:</td><td>'.$row["lastname"].'</td></tr>';
                echo '<tr><td>Country:</td><td>'.$row["country"].'</td></tr>';
                echo '</table>';
                echo '<hr />';
            }
        }
        else {
           echo "0 results";
        }
    }
    include_once("includes/menu.php");

?>