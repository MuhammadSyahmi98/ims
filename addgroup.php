
<?php
require('includes/connect.php');
if(isset($_POST['button'])){
   if(empty($errors)){
           $name = $_POST['group-name'];
          $level = $_POST['level'];
         $status = $_POST['status'];

         $query1 = "SELECT * FROM group_detail WHERE group_name='$name'";
           $result=mysqli_query($conn,$query1);
        
         if (mysqli_num_rows($result)<=0) {
         	$query  = "INSERT INTO group_detail (";
        	$query .="group_name,group_level,group_status";
        	$query .=") VALUES (";
        	$query .=" '{$name}', '{$level}','{$status}'";
        	$query .=")";
        	if($conn->query($query)){
          	//sucess
          		echo ' <script>alert("Success");</script>';
          		echo "<script>window.location.assign('manageGroup.php')</script>";
        	}
        	else {
          		//failed
         		echo ' <script>alert("Failed");</script>';
        		echo "<script>window.location.assign('addGroup.php')</script>";
        	}
         }
         else
         {
         	echo ' <script>alert("Group Already Exist!");</script>';
         }

        
   } else {
     $session->msg("d", $errors);
      redirect('addGroup.php',false);
   }
 }




?>




<!DOCTYPE html>
<html>
<head>
	<title>Add Group</title>
	<link rel="stylesheet" type="text/css" href="stylesheets/style.css">
</head>
<body>
<?php include_once('layouts/header.php'); ?>
<?php include_once('layouts/menu.php'); ?>

<div class="main-page">
	<div class="table new-setting">
		<div class="tabl1 manage-user">
			<div class="head">
				<strong>
					<span>add new user</span>
				</strong>
			</div>
			<div class="body">
				<form method="post" action="" class="clearfix grp">
					<div class="form-group">
						<label for="level">Name</label>
						<div class="input-group">
							<input pattern="[a-zA-Z\s]+" type="text" name="group-name" placeholder="Group Name" class="box-setting" required>
						</div>
					</div>
					<div class="form-group">
						<label for="level">Level</label>
						<div class="input-group">
							<input min="1" max="3" type="number" name="level" placeholder="Level" class="box-setting" required>
						</div>
					</div>
					<div class="form-group">
						<label for="level">Status</label>
						<div class="input-group">
							<input  pattern="[a-zA-Z]+" title="Enter Alphabet Only" type="text" name="status" placeholder="Status" class="box-setting" required>
						</div>
					</div>
				  <form method="post" action="addUser.html">
                    <button class="button submit-button1" name="button">Add Group</button>
                  </form>
			</div>
		</div>
	</div>
</div>


						
						



</body>
</html>