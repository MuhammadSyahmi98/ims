<?php

if (session_status() == PHP_SESSION_NONE) {
  session_start();
  } 

if ( !isset($_SESSION['id']) )
{
    echo ' <script>alert("Please login");</script>';
  	echo "<script>window.location.assign('index.php')</script>";
   
}


?>