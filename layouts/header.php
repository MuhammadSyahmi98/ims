<?php if (session_status() == PHP_SESSION_NONE) {
  session_start();
  } ?>

	<?php $user=$_SESSION['user'];?>
	<header id="header">
		<div class="brand">
			<img src="source/logo.png" class="logo">
			<div>
				<h6>inventory System</h6>
			</div>
		</div>
		
		<div class="date"><?php echo date("D, j-n-Y"); ?></div>
		
		<div class="profile">
			<form method="post">
				<button OnClick="return confirm('Are you sure to Log Out?');" name="log" class="button0">
					Log Out
				</button>
			</form>
		</div>
	</header>

	<?php

	if (isset($_POST['log'])) {
	
	session_unset();
	session_destroy();
	echo ' <script>alert("Log Out Succesfully");</script>';
	echo "<script>window.location.assign('index.php')</script>";
	exit();
	}
	?>
