<?php session_start(); ?>

<?php
require('includes/connect.php');

if (isset($_POST['login'])) {

	$username = $_POST['username'];
	$password = $_POST['password'];

	$res = $conn->query("SELECT * FROM user WHERE username='$username' and password='$password'");
	$row = $res->fetch_assoc();

	$user = $row['username'];
	$name = $row['name'];
	$pass = $row['password'];
	$level = $row['level'];
	$userId = $row['userId'];

	$_SESSION['user'] = $user;

	$_SESSION['userId'] = $userId;

	$_SESSION['level'] = $level;


	if ($user == $username && $pass == $password) {

		//session start

		$_SESSION['id'] = $user;
		if ($level == 2) {
			echo ' <script>alert("Welcome ' . $name . '");</script>';
			echo "<script>window.location.assign('dashboard_user.php')</script>";
		} else if ($level == 1 || $level == 3) {
			echo ' <script>alert("Welcome ' . $name . '");</script>';

			echo "<script>window.location.assign('dashboard_user.php')</script>";
		}
	} else {
		echo ' <script>alert("Wrong Credential");</script>';
		echo "<script>window.location.assign('index.php')</script>";
	}
}
?>




<!DOCTYPE html>
<html>

<head>
	<title>Welcome To E-Shop Management System</title>
	<link rel="stylesheet" type="text/css" href="stylesheets/style.css">
</head>

<body>
	<h2 class="header">Welcome to e-Shop Management<br>System</h2>
	<div class="login-wrapper">
		<form class="form" method="post">
			<h2>Login</h2>
			<div class="input-group">
				<input id="email" type="text" name="username" required>
				<label>User Name</label>
			</div>
			<div class="input-group">
				<input id="password" type="password" name="password" required>
				<label>Password</label>
			</div>
			<button class="submit-btn" name="login">Login</button>
		</form>
		<div style="margin-left: 10px;">
			<button onclick="admin()" style="padding: 16px;">Admin</button>
			<button onclick="staff()" style="padding: 16px;">Staff</button>
		</div>






		<div id="forgot-pw">
			<form class="form form-pw">
				<a href="#" class="close"></a>
				<h2>Reset Password</h2>
				<div class="input-group">
					<input type="email" name="email" id="email" required>
					<label for="email">Email</label>
				</div>
				<input type="submit" value="submit" class="submit-btn">

			</form>
		</div>
	</div>

	<script>
		function admin() {
			document.getElementById("email").value = "special";
			document.getElementById("password").value = "special";
		}

		function staff() {
			document.getElementById("email").value = "user";
			document.getElementById("password").value = "user";
		}
	</script>
</body>

</html>