<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// initializing variables
$username = "";
$email    = "";
$errors = array(); 

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'registration');

// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
  $image = mysqli_real_escape_string($db, $_FILES['image']['name']);
  
  $avdb = mysqli_connect("localhost", "root", "", "avatar_upload");

  // Initialize message variable
  $msg = "";

  $avatar = $_FILES['image']['name'];
    
  // Image file directory
    $target = "avatars/".basename($username).".jpg";
                                  
  	$sql = "INSERT INTO avatars (avatar, username) VALUES ('$avatar', '$username')";
    
  	// execute query
  	mysqli_query($avdb, $sql);
    
  	if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
  		$msg = "Avatar uploaded successfully";
  	}else{
  		$msg = "Failed to upload image";
  	}
      
    // Get username
  
  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($image)) { array_push($errors, "Avatar is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
  }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['username'] === $username) {
      array_push($errors, "Username already exists");
    }

    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$password = md5($password_1);//encrypt the password before saving in the database

  	$query = "INSERT INTO users (username, email, password) 
  			  VALUES('$username', '$email', '$password')";
  	mysqli_query($db, $query);
      
    $_SESSION['username'] = $username;
    $sql3 = "SELECT * FROM users WHERE username='$username'";
      $result3 = mysqli_query($db, $sql3);
      $row3 = mysqli_fetch_array($result3);
      if ($result3->num_rows > 0) {
        $_SESSION['id'] = $row3['id'];
        $_SESSION['dough'] = $row3['dough'];
        $_SESSION['adminStatus'] = $row3['adminStatus'];
        $_SESSION['banStatus'] = $row3['banStatus'];
                } else {}
  	$_SESSION['success'] = "You are now logged in";
  	header('location: index.php');
  }
}

// ... 
// ... 

// LOGIN USER
if (isset($_POST['login_user'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($username)) {
  	array_push($errors, "Username is required");
  }
  if (empty($password)) {
  	array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {
  	$password = md5($password);
  	$query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
  	$results = mysqli_query($db, $query);
  	if (mysqli_num_rows($results) == 1) {
  	  $_SESSION['username'] = $username;
      $ussrname = $_SESSION['username'];
      $sql2 = "SELECT * FROM users WHERE username='$ussrname'";
      $result2 = mysqli_query($db, $sql2);
      $row2 = mysqli_fetch_array($result2);
      if ($result2->num_rows > 0) {
        $_SESSION['id'] = $row2['id'];
        $_SESSION['dough'] = $row2['dough'];
        $_SESSION['adminStatus'] = $row2['adminStatus'];
        $_SESSION['banStatus'] = $row2['banStatus'];
                } else {}
    if ($_SESSION['banStatus'] = "0") {
        array_push($errors, "Log in failed, you are banned ):");
  	    header('location: index.php');
  	} elseif ($_SESSION['banStatus'] = "1") {
        $_SESSION['success'] = "You are now logged in";
        header("location: index.php");
  	}
  }
      else {}
}
    else {
        array_push($errors, "Username/Password combination incorrect");
    }
}
if (isset($_SESSION['username'])){
$ussrname = $_SESSION['username'];
$query3 = "SELECT * FROM users WHERE username='$ussrname'";
  	$results3 = mysqli_query($db, $query3);
    $row3 = mysqli_fetch_array($results3);
  	if ($results3->num_rows > 0) {
  	  $_SESSION['dough'] = $row3['dough'];
      $_SESSION['banStatus'] = $row3['banStatus'];
        if ($_SESSION['banStatus'] != "0") {
            header("location: index.php?logout=1"); 
exit();
        }
    }
}
?>