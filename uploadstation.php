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
<?php
  // Create database connection
  $db = mysqli_connect("localhost", "root", "", "image_upload");

  // Initialize message variable
  $msg = "";

  // If upload button is clicked ...
  if (isset($_POST['upload'])) {
  	// Get image name
    $file = $_FILES['image'];
  	$image = $_FILES['image']['name'];
    $image_name = $file['name'];
    $image_tmp = $file['tmp_name'];
    $image_size = $file['size'];
    $image_ext = explode('.', $image_name);
    $image_ext = strtolower(end($image_ext));
    $allowed = array('jpg','png','mp3','webm','jpeg','txt');
  	// Get text
  	$image_text = mysqli_real_escape_string($db, $_POST['image_text']);
    // Get uploader
    $uploader = $_SESSION['username'];
    $uploaderId = $_SESSION['id'];
    if (in_array($image_ext, $allowed)) {
  	// image file directory
   $target = "images/".$image;

  	$sql = "INSERT INTO images (image, image_text, uploader, uploaderId) VALUES ('$image', '$image_text', '$uploader', '$uploaderId')";
  	// execute query
  	mysqli_query($db, $sql);

  	if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
  		$msg = "Image uploaded successfully";
  	}else{
  		$msg = "Failed to upload image";
  	}
  }
  }
else {
}
  $uploadql = "SELECT * FROM images order by id asc";
  $result = mysqli_query($db, $uploadql);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Profile</title>
	<link rel="stylesheet" type="text/css" href="style2.css?ts=<?=time()?>" />
    <script type="text/javascript" src="jquery3.js"></script>
</head>
<body>
    <?php include('hdr.html') ?>
<div class="header">
	<h2>Upload Station</h2>
</div>
<div class="content">
<?php
$sql3 = "SELECT * FROM images order by id asc";
$sql4 = "SELECT * FROM id";
$db = mysqli_connect("localhost", "root", "", "image_upload");
$get_total = mysqli_num_rows(mysqli_query($db,$sql3));
$result2 = $db->query($sql3);
$limit = 5;
if (!isset($_GET['p'])) {
    header("location: uploadstation.php?p=1");
}
else {
$p = $_GET['p'];
$total = ceil($get_total/$limit);
if(!isset($p)){
					$offset = 0;
				}else if($p == '1'){
					$offset = 0;
				}else if($p <= '0'){
					$offset = 0;
					echo '<script>window.location = "./";</script>';
				}else {
					$offset = ($p - 1) * $limit;
				}
$imagesgather = mysqli_query($db, "SELECT * FROM images LIMIT $offset, $limit");
}
    if ($result2->num_rows > 0) {
    while($row = mysqli_fetch_assoc($imagesgather)){
    echo "<div class='content02'>";
        echo "<a href='images/".$row['image']."' style='color: blue;': left><span id='spanner'> - ".$row['image']." </span></a>";
        echo "<p: center>[".$row['image_text']."] </p>";
            if ($row['uploader'] != "") {
        $uploader = $row['uploader'];
        $uploaderId = $row['uploaderId'];
        echo <<< END
                <span: right>-- Uploaded by <a href="profiles.php?id=$uploaderId": right>$uploader</a></span>
            END;
        }
        else {
            echo "<span: right>-- Unknown uploader</span>";
        }
      echo "</div>";
    }
    if($get_total > $limit){ ?>
    <div id="pages" class="pages">

			<?php
            for($i = 0; $i<$total; $i++){
					($p == $i);
                    echo '<a class="btn" style="height:20px;" href="?p='.($i+1).'">'.($i+1).'</a>';
				}
}
          else {}
    }
          echo "</div>";
          echo "</div>";
?>
<?php $adminStatus = $_SESSION['adminStatus'];
    if ($adminStatus = 1) {
        echo "<div class='content'><form method='POST' action='uploadstation.php' enctype='multipart/form-data'>
  	<input type='hidden' name='size' value='1000000000'>
  	<div>
  	  <input type='file' name='image'>
  	</div>
  	<div>
      <textarea 
        class='input-group'
      	id='text' 
      	name='image_text'
      	placeholder='Caption'></textarea>
  	</div>
  	<div>
  		<button type='submit' style='height:20px;' class='btn' name='upload'>Upload</button>
  	</div>
  </form>
  </div>";
} ?>