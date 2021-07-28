<?php if (session_status() == PHP_SESSION_NONE) {
  session_start();
  } ?>

<!DOCTYPE html>
<html>
<head>
	<title>Admin's Menu</title>
	<link rel="stylesheet" type="text/css" href="stylesheet/style.css">
 
</head>
<body>
  <?php
  include_once('includes/session.php'); 

  $level=$_SESSION['level'];
  if ($level==2) {
   
    require('layouts/user_menu.php');
    
      }
  else if($level==1 || $level==3)  {

    require('layouts/admin_menu.php');

  }

  ?>
</body>
</html>