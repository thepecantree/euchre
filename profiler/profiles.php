<?php
    include_once("includes/config.php");

    if (isset($_GET['first']))
    {
        $firstname = $_GET['first'];
        $sql = "SELECT * FROM users WHERE firstname='$firstname'";
        
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            
            if($row = $result->fetch_assoc()) {
               echo '<h1>'.$row["username"]."'s Profile</h1>";
                echo '<table>';
                echo "<tr><td>Avatar:</td><td><img src='avatars/".$row['username'].".jpg' height='27' border='2'></div>";
                echo '<tr><td>ID:</td><td>'.$row["id"].'</td></tr>';
                echo '<tr><td>Username:</td><td>'.$row["username"].'</td></tr>';
            }
            echo '</table>';
        }
        else {
           echo "0 results";
        }
    }
    else {

        echo '<h2>All our members:</h2>';

        $sql = "SELECT * FROM users";
        
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
   
            while($row = $result->fetch_assoc()) {
                
                echo '<hr />';
                echo '<table>';
                echo "<tr><td>Avatar:</td><td><img src='avatars/".$row['username'].".jpg' height='27' border='2'></div>";
                echo '<tr><td>ID:</td><td>'.$row["id"].'</td></tr>';
                echo '<tr><td>Username:</td><td>'.$row["username"].'</td></tr>';
                echo '</table>';
                
            }
        }
        else {
           echo "0 results";
        }
    }
    
    include_once("includes/menu.php");
?>