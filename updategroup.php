<?php

require('includes/connect.php');
session_start();
$id=$_SESSION['id'];
$res = $conn->query("SELECT * FROM group_detail WHERE group_id='$id'");
$row = $res->fetch_assoc();
$name=$row["group_name"];
$level=$row["group_level"];
$status=$row["group_status"];



?>

<!DOCTYPE html>
<html>
<head>
	<title>update Group</title>
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
					<span>Update Group</span>
				</strong>
			</div>
			<div class="body">
				<form method="post" action="" class="clearfix grp">
					<div class="form-group">
						<label for="level">Name</label>
						<div class="input-group">
							<input pattern="[a-zA-Z\s]+" type="text" name="group-name" placeholder="Group Name" class="box-setting" value="<?php echo $name;?>" >
						</div>
						<div class="input-group">
							<input type="hidden" name="group-id" placeholder="Group id" class="box-setting"  value="<?php echo $id;?>">
						</div>
					</div>
					<div class="form-group">
						<label for="level">Level</label>
						<div class="input-group">
							<input min="1" max="3" type="number" name="level" placeholder="Level" class="box-setting" value="<?php echo $level;?>" >
						</div>
					</div>
					<div class="form-group">
						<label for="level">Status</label>
						<div class="input-group">
							<input  pattern="[a-zA-Z]+" title="Enter Alphabet Only" type="text" name="status" placeholder="Status" class="box-setting" value="<?php echo $status;?>">
						</div>
					</div>
				  <form method="post" action="addUser.html">
                    <button class="button submit-button1" name="button">Update Group</button>
                  </form>
              </form>
			</div>
		</div>
	</div>
</div>
</body>
</html>

<?php 

if (isset($_POST['button'])) {
	require('includes/connect.php');
	$id=$_SESSION['id'];
	$name1=$_POST['group-name'];
	$level1=$_POST['level'];
	$status1=$_POST['status'];
	$id1=$_POST['group-id'];

	$sql= "UPDATE group_detail SET group_name='$name1', group_level='$level1', group_status='$status1' WHERE group_id='$id'";

		if ($conn->query($sql) == TRUE) {
   		  echo ' <script>alert("Update Succesfully");</script>';
   		 $conn->close();
		
	
			
			echo "<script>window.location.assign('manageGroup.php')</script>";
		} else {
   			 //echo "Error updating record: " . $conn->error;
			 echo ' <script>alert("Update Failed");</script>';
			 $conn->close();
       		
       		echo "<script>window.location.assign('manageGroup.php')</script>";

			}


}
?>