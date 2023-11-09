<form action="add.php" method="post" enctype="multipart/form-data">
    <table>
    <tr><td>Firstname:</td><td><input type="text" name="first" value="" placeholder="" size="20"></td></tr>
    <tr><td>Lastname:</td><td><input type="text" name="last" value="" placeholder="" size="20"></td></tr>
    <tr><td>Country:</td><td><input type="text" name="country" value="" placeholder="" size="20"></td></tr>
    <tr><td>Avatar:</td><td><input type="text" name="avatar" value="" placeholder="" size="20"></td></tr>
    </table>
    <input type="submit" value="Create" name="submit">
</form>

<?php
    include_once("includes/config.php");

    if (isset($_POST['first']))
    {
        $firstname = $_POST['first'];
        $lastname = $_POST['last'];
        $country = $_POST['country'];
        $avatar = $_POST['avatar'];
        
        $sql = "INSERT INTO users (firstname, lastname, country, avatar) VALUES ('$firstname', '$lastname', '$country', 'img/$avatar.jpg')";
        
        if ($conn->query($sql) === TRUE) {
			echo "New user created!<br />";
		}
		else {
			echo "New user wasn't created!<br />";
		}
    }
    include_once("includes/menu.php");
?>