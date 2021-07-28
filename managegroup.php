<?php session_start();?>


<!DOCTYPE html>
<html>
<head>
	<title>Manage-Group</title>
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
                <span>All group</span>
                 <div class="user-head1">
                  <form method="post" action="addGroup.php">
                    <button class="button submit-button1">Add Group</button>
                  </form>
                </div>
              </strong>
         </div>
         <div class="body">
             <table>
               <thead>
                <tr>
                    <th>No</th>
                    <th>Group Name</th>
                    <th>Group Level</th>
                    <th>Actions</th>
                </tr>
                <tr></tr>
              </thead>
              
              <tbody>
                <tr>
                  <?php 
                  $con = mysqli_connect("localhost","muhammad_user1","H89EPXkT^^m4","muhammad_db");
                  $no =1;
                 
                  $result = $con->query("SELECT * FROM group_detail ORDER BY group_level ASC");
                  
                  // output data of each row
                  while($row = $result->fetch_assoc()) {
                  echo "<tr><td>" . $no++. "</td><td>" . $row["group_name"] . "</td><td>"
                  . $row["group_level"]. "</td><td>"?> <form method="POST"> <input type="hidden" name="id2$no" value="<?php echo $row["group_id"]; ?>"><input type="hidden" name="id$no" value="<?php echo $row["product_id"]; ?>"><button class="button0" name="edit">Edit</button>  <button OnClick="return confirm('Confirm to delete this data?');" class="button0" name="delete">Delete</button> </form><?php "</td></tr>";
                  
                }
              
                  ?>

                    </tr>


              </tbody>
              <tbody></tbody>
            </table>
          </div>
        </div> 
    </div>
  </div>
</body>
</html>
<?php
if (isset($_POST['edit'])) {

    $_SESSION['id']=$_POST['id2$no'];
echo "<script>window.location.assign('updateGroup.php')</script>";

}

?>
<?php

if (isset($_POST['delete'])) {
  require('includes/connect.php');
  $id2=$_POST['id2$no'];
   $sql = "DELETE FROM group_detail WHERE group_id='$id2'";
     $conn->query($sql);
     echo ' <script>alert("Delete Succesfully");</script>';
     echo "<script>window.location.assign('manageGroup.php')</script>";
}

?>