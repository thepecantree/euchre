<div class="content">
<form action="testsings.php" method="post" enctype="multipart/form-data">
    <center>
    Username:  <input type="text" name="username" value="" placeholder="" size="20">
    <input type="submit" value="Search" name="submit">
    </center>
</form>

<?php 

if (isset($_POST['username']))
    {
        $username = $_POST['username'];
$stack = array("orange", "banana");
array_push($stack, $username, "raspberry", $username);
print_r($stack);
}
    
$cart = array();
for($i=0;$i<=5;$i++){
    $cart[] = $i;  
}
echo "<pre>";
print_r($cart);
echo "</pre>"
?>