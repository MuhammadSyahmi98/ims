<?php
require('includes/connect.php');
if(isset($_POST['button1'])){	
   if(empty($errors)){
           	$name = $_POST['name'];
            $username = $_POST['username'];
            $password = $_POST['password'];
        	$repassword = $_POST['password1'];
            $role = $_POST['level'];

            $query1 = "SELECT * FROM user WHERE username='$username'";
            $result=mysqli_query($conn,$query1);

            if (mysqli_num_rows($result)<=0) {
            	if($password==$repassword){
        			$query  = "INSERT INTO user (";
        			$query .="username,password,name,level";
        			$query .=") VALUES (";
        			$query .=" '{$username}', '{$password}','{$name}', '{$role}'";
        			$query .=")";

        			if($conn->query($query)){
          	//sucess
          				echo ' <script>alert("Success");</script>';
          				echo "<script>window.location.assign('manageUser.php')</script>";
        			} 
        			else {
          	//failed
         				echo ' <script>alert("Failed");</script>';
         				echo "<script>window.location.assign('addUser.php')</script>";
        			}
        		}
        		else{
       				 echo ' <script>alert("Password doesnt match!");</script>';
        			echo "<script>window.location.assign('addUser.php')</script>";	
        		}
            }
            else
            {
            	echo ' <script>alert("Username Already Exist!");</script>';
            }

        
    }
        
   } 

?>

<?php

// mysql select query
$query = "SELECT * FROM group_detail";
$result1 = mysqli_query($conn, $query);

?>


<!DOCTYPE html>
<html>
<head>
	<title>Add user</title>
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
					<span>add user</span>
				</strong>
			</div>
			<div class="body">
				<form method="POST" action="" class="clearfix grp">
					<div class="form-group">
						<label for="level">Name</label>
						<div class="input-group">
							<input pattern="[a-zA-Z\s]+" title="Enter Alphabet Only" type="text" name="name" placeholder="Full name" class="box-setting" required>
						</div>
					</div>
					<div class="form-group">
						<label for="level">Username</label>
						<div class="input-group">
							<input   type="text" name="username" placeholder="Username" class="box-setting" required>
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
					<button class="button submit-button1" name="button1">Add User</button>
       		    		</form>
				</form>
			</div>
		</div>
	</div>
</div>


</body>
</html>

