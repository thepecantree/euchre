<?php include('server2.php') ?>
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
require_once "inc/config.php";
$thisUsername = $_SESSION['username'];
$thisId = $_SESSION['id'];
$sesId = $_SESSION['id'];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Inbox System</title>
<link rel="stylesheet" type="text/css" href="style4.css?ts=<?=time()?>" />
<script type="text/javascript" src="jquery3.js"></script>
</head>

<body>
<?php include('hdr.html') ?>
<script type="text/javascript">

$("body").prepend('<div id="loading"><img src="img/loading.gif" alt="Loading.." title="Loading.." /></div>');

$(window).load(function(){
	$("#inbox, #msg").fadeIn("slow");
	$("#loading").fadeOut("slow");
});

</script>


<?php
    if (isset($_GET['id']))
    {
        $id = $_GET['id'];
        $sql62 = "SELECT * FROM messages WHERE id='$id' and recipDelete = '0'";
        $result62 = $conn->query($sql62);
        $row = $result62->fetch_assoc();
        $senderId = $row['senderId'];
        $recipId = $row['recipId'];
        if($recipId == $sesId or $senderId == $sesId) {
            if($recipId == $sesId) {
        mysqli_query($conn, "UPDATE messages SET recipOpened = '1' WHERE id = '$id'");
            }
            else {
            }
        $senderUsername = $row['senderUsername'];
        $recipUsername = $row['recipUsername'];
        $senderId = $row['senderId'];
        $recipId = $row['recipId'];
        $title = $row['title'];
        $description = $row['description'];
        $timeSent = $row['timeSent'];
?>

<div id="msg">

<a href="inbox2.php?p=1&l=1">← Back to Inbox</a>

<table>
	<tr>
		<td>From : <strong href='profiles.php?id=".$senderId."'><?php echo $senderUsername; ?></strong></td>
        <td>To : <strong href='profiles.php?id=".$recipId."'><?php echo $recipUsername; ?></strong></td>
		<td>Time sent : <strong><?php echo $timeSent; ?></strong></td>
		<td>Title : <strong><?php echo $title; ?></strong></td>
	</tr>
</table>

<pre><?php echo $description; ?></pre>

<?php if($sesId == $senderId){
                 echo "<a class='btn' href='message.php?id=".$recipId."' style='color: blue;'>Message again</a>";
                }
        elseif($sesId == $recipId){
                 echo "<a class='btn' href='message.php?id=".$senderId."' style='color: blue;'>Reply</a>";
                }
    ?>

<a class="remove btn danger" href="?remove=<?php echo $id; ?>">Delete this message</a>

</div>

<script type="text/javascript">

$('.remove').click(function(){
	var agree=confirm("Are you sure you want this message deleted from your inbox? (It will only be deleted on yours!)");
	if (agree) {
		return true;
	}else {
		return false;
	}
});

</script>
    
    
    
    <?php
    
    
    echo "<div id='inbox'>";
    echo "<center><p>Messages ".$senderUsername." has also sent to ".$recipUsername."</p></center> <table>";

    echo "<tr>

			<th>Title</th>
            <th>Description</th>
			<th>Sent</th>
			<th>Seen</th>

		</tr>";
            $limit3 = 10;
				$p = $_GET['p'];

				$get_total3 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM messages WHERE id!='$id' AND recipId='$recipId' AND senderId='$senderId' AND recipDelete = '0'"));
				$total3 = ceil($get_total3/$limit3);

				if(!isset($p)){
					$offset3 = 0;
				}else if($p == '1'){
					$offset3 = 0;
				}else if($p <= '0'){
					$offset3 = 0;
					echo '<script>window.location = "./";</script>';
				}else {
					$offset3 = ($p - 1) * $limit3;
				}

				$inbox3 = mysqli_query($conn, "SELECT * FROM messages WHERE id!='$id' AND recipId='$recipId' AND senderId='$senderId' AND recipDelete = '0' order by id desc LIMIT $offset3, $limit3");
				$rows3 = mysqli_num_rows($inbox3);
				while($row3 = mysqli_fetch_assoc($inbox3)){
					$id2 = $row3['id'];

					if(strlen($row3['title']) >= 25){
						$title = substr($row3['title'],0,25)."..";
					}else {
						$title = $row3['title'];
					}

					if(strlen($row3['description']) >= 64){
						$description = substr($row3['description'],0,64)."..";
					}else {
						$description = $row3['description'];
					}
					$timeSent = $row3['timeSent'];
					if($row3['recipOpened'] == '1'){
						$open = '<img src="img/open.png" alt="Opened" title="Opened" />';
					}else {
						$open = '<img src="img/not_open.png" alt="Opened" title="Opened" />';
					}

					echo '<tr class="border_bottom">';
                    
                        echo '<td><a href="?id='.$id2.'">'.$title.'</a></td>';
                        echo '<td><a href="?id='.$id2.'">'.$description.'</a></td>';
						echo '<td><a href="?id='.$id2.'">'.$timeSent.'</a></td>';
						echo '<td><a href="?id='.$id2.'">'.$open.'</a></td>';
					echo '</tr>';

				}

				if($rows3 <= 0){
					echo '<tr><td width="100%">There\'s no messages at this moment, check back later!</td></tr>';
				}

	echo "</table>";

        if($get_total3 > $limit3){ 

		echo "<div id='pages'>";

            for($i=0; $i<$total3; $i++){
					($p == $i);
                    echo '<a class="btn" href="?id='.$id.'&p='.($i+1).'">'.($i+1).'</a>';
				}

		echo "</div>";
    }

echo "</div>";
?>
    
    
    
    
    
    
    
    <?php
    }else {
                header("location:/inbox2.php?p=1&l=1");
            }

exit();

} else if(isset($_GET['remove'])){

	$id = $_GET['remove'];
	$remove = mysqli_query($conn, "UPDATE messages SET recipDelete = '1' WHERE id = '$id'");
	if($remove){
		echo '<script>window.location = "./"</script>';
	}else {
		die("Please Refresh the page.");
	}

	exit();

} else {

?>
    <center><p> <a href='index.php' style='color: blue;'>Return</a></p></center>
    
<div id="inbox">
    <center><p>Messages you've received</p></center>
	<table>

		<tr>

			<th width="10%">Avatar</th>
			<th>From</th>
			<th>Title</th>
			<th>Sent</th>
			<th>Seen</th>

		</tr>

			<?php

				$limit = 4;
				$p = $_GET['p'];
                $l = $_GET['l'];

				$get_total = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM messages WHERE recipId='$thisId' AND recipDelete = '0'"));
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

				$inbox = mysqli_query($conn, "SELECT * FROM messages WHERE recipId='$thisId' AND recipDelete = '0' order by id desc LIMIT $offset, $limit");
				$rows = mysqli_num_rows($inbox);
				while($row = mysqli_fetch_assoc($inbox)){
					$id = $row['id'];
					$senderUsername = $row['senderUsername'];
                    $senderId = $row['senderId'];

					if(strlen($row['title']) >= 50){
						$title = substr($row['title'],0,50)."..";
					}else {
						$title = $row['title'];
					}

					$description = $row['description'];
					$timeSent = $row['timeSent'];
					if($row['recipOpened'] == '1'){
						$open = '<img src="img/open.png" alt="Opened" title="Opened" />';
					}else {
						$open = '<img src="img/not_open.png" alt="Opened" title="Opened" />';
					}

					echo '<tr class="border_bottom">';
                    
                        echo "<td><a href='?id=".$id."&p=1'><img src='avatars/".$senderUsername.".jpg' height='36' border='2' style='border:solid black'></a></td>";
						echo '<td><a href="?id='.$id.'&p=1">'.$senderUsername.'</a></td>';
						echo '<td><a href="?id='.$id.'&p=1">'.$title.'</a></td>';
						echo '<td><a href="?id='.$id.'&p=1">'.$timeSent.'</a></td>';
						echo '<td><a href="?id='.$id.'&p=1">'.$open.'</a></td>';
					echo '</tr>';

				}

				if($rows <= 0){
					echo '<tr><td width="100%">There\'s no messages at this moment, check back later!</td></tr>';
				}

			?>

	</table>

	<?php if($get_total > $limit){ ?>

		<div id="pages">

			<?php
                $a = $l;
                for($i=0; $i<$total; $i++){
					($p == $i);
                    echo '<a class="btn" href="?p='.($i+1).'&l='.$a.'">'.($i+1).'</a>';
				}
			?>

		</div>

	<?php } ?>

</div>

<?php } ?>
    
<div id="inbox">
    <center><p>Messages you've sent</p></center>
	<table>

		<tr>

			<th width="10%">Avatar</th>
			<th>From</th>
			<th>Title</th>
			<th>Sent</th>
			<th>Seen</th>

		</tr>

			<?php

				$limit2 = 4;
                $p = $_GET['p'];
				$l = $_GET['l'];

				$get_total2 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM messages WHERE senderId='$thisId' AND senderDelete = '0'"));
				$total2 = ceil($get_total2/$limit2);

				if(!isset($l)){
					$offset2 = 0;
				}else if($l == '1'){
					$offset2 = 0;
				}else if($l <= '0'){
					$offset2 = 0;
					echo '<script>window.location = "./";</script>';
				}else {
					$offset2 = ($l - 1) * $limit2;
				}

				$inbox2 = mysqli_query($conn, "SELECT * FROM messages WHERE senderId='$thisId' AND senderDelete = '0' order by id desc LIMIT $offset2, $limit2");
				$rows2 = mysqli_num_rows($inbox2);
				while($row2 = mysqli_fetch_assoc($inbox2)){
					$id = $row2['id'];
					$recipUsername = $row2['recipUsername'];
                    $recipId = $row2['recipId'];

					if(strlen($row2['title']) >= 50){
						$title = substr($row['title'],0,50)."..";
					}else {
						$title = $row2['title'];
					}

					$description = $row2['description'];
					$timeSent = $row2['timeSent'];
					if($row2['recipOpened'] == '1'){
						$open = '<img src="img/open.png" alt="Opened" title="Opened" />';
					}else {
						$open = '<img src="img/not_open.png" alt="Opened" title="Opened" />';
					}

					echo '<tr class="border_bottom">';
                    
                        echo "<td><a href='?id=".$id."'><img src='avatars/".$recipUsername.".jpg' height='36' border='2' style='border:solid black'></a></td>";
						echo '<td><a href="?id='.$id.'&p=1">'.$recipUsername.'</a></td>';
						echo '<td><a href="?id='.$id.'&p=1">'.$title.'</a></td>';
						echo '<td><a href="?id='.$id.'&p=1">'.$timeSent.'</a></td>';
						echo '<td><a href="?id='.$id.'&p=1">'.$open.'</a></td>';
					echo '</tr>';

				}

				if($rows2 <= 0){
					echo '<tr><td width="100%">There\'s no messages at this moment, check back later!</td></tr>';
				}

			?>

	</table>

	<?php if($get_total2 > $limit2){ ?>

		<div id="pages2">

			<?php
            for($a = 0; $a<$total2; $a++){
					($l == $a);
                    echo '<a class="btn" href="?p='.$p.'&l='.($a+1).'">'.($a+1).'</a>';
				}
    ?>
			</div>

	<?php } ?>

</div>
</body>
</html>