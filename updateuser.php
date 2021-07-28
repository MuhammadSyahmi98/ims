<?php

require('includes/connect.php');
session_start();
$id=$_SESSION['id1'];
$res = $conn->query("SELECT * FROM user WHERE userId='$id'");
$row = $res->fetch_assoc();
$username1=$row["username"];
$name1=$row["name"];
$level=$row["level"];

?>


<?php
$hostname = "localhost";
$username = "root";
$password = "";
$databaseName = "db";

// connect to mysql database

$connect = mysqli_connect($hostname, $username, $password, $databaseName);

// mysql select query
$query = "SELECT * FROM group_detail";
$result1 = mysqli_query($connect, $query);

?>


<!DOCTYPE html>
<html>
<head>
	<title>update user</title>
	<link rel="stylesheet" type="text/css" href="stylesheets/style.css">
</head>
<body>
<?php include_once('layouts/header.php'); ?>
<?php include_once('layouts/menu.php'); ?>
<?php require('includes/connect.php');?>
<div class="main-page">
	<div class="table new-setting">
		<div class="tabl1 manage-user">
			<div class="head">
				<strong>
					<span>update user</span>
				</strong>
			</div>
			<div class="body">
				<form method="POST" action="" class="clearfix grp">
					<div class="form-group">
						<label for="level">Name</label>
						<div class="input-group">
							<input pattern="[a-zA-Z]+" title="Enter Alphabet Only" type="text" name="name" placeholder="Full name" class="box-setting" value="<?php echo $name1;?>" required>
						</div>
					</div>
					<div class="form-group">
						<label for="level">Username</label>
						<div class="input-group">
							<input type="text" name="username" placeholder="Username" class="box-setting" value="<?php echo $username1;?>" required>
						</div>
					</div>
					<div class="form-group">
						<label for="level">Password</label>
						<div class="input-group">
							<input type="password" name="password" placeholder="password" class="box-setting" required>
						</div>
					</div>
					<div class="form-group">
						<label for="level">Re-Password</label>
						<div class="input-group">
							<input type="password" name="password1" placeholder="re-password" class="box-setting" required>
						</div>
					</div>
					<div class="form-group">
						<label for="level">User Role</label>
						 <select class="box-setting" name="level">

           					 <?php while($row1 = mysqli_fetch_array($result1)):;?>

           					 <option value="<?php echo $row1[2];?>"><?php echo $row1[1];?></option>

           					 <?php endwhile;?>

        				</select>
					</div>
					<button class="button submit-button1" name="button1">update User</button>
       		    		</form>
				</form>
			</div>
		</div>
	</div>
</div>


</body>
</html>

<?php
require('includes/connect.php');
if (isset($_POST['button1'])) {
	
	$id=$_SESSION['id1'];
	$name2=$_POST['name'];
	$username2=$_POST['username'];
	$password1=$_POST['password'];
	$password2=$_POST['password1'];
	$level2=$_POST['level'];
	

	if ($password1==$password2) {
		$query= "UPDATE user SET username='$username2',password='$password1', name='$name2', level='$level2' WHERE userId='$id'";


		if ($conn->query($query) == TRUE) {
   		 echo ' <script>alert("Update Succesfully");</script>';
   		 $conn->close();
		
		echo "<script>window.location.assign('manageUser.php')</script>";
		} else {
			  
   			  $conn->close();
   			  echo ' <script>alert("Update Failed");</script>';
   			  echo "<script>window.location.assign('manageUser.php')</script>";

			}

	
	}
}
?>