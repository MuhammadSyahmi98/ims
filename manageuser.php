<?php session_start();?>

<!DOCTYPE html>
<html>
<head>
  <title>Manage User</title>
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
              <div class="user-head">
                <span>users </span>
              </div>
                 <div class="user-head1">
                  <form method="post" action="addUser.php">
                    <button class="button submit-button1">Add User</button>
                  </form>
                </div>
              </strong>
         </div>
         <div class="body">
             <table>
               <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>User Role</th>
                    <th>Actions</th>
                </tr>
                <tr></tr>
              </thead>

              <tbody>
                <tr>
                    <?php 
                  $con = mysqli_connect("localhost","muhammad_user1","H89EPXkT^^m4","muhammad_db");
                  $no =1;
                 
                  $result = $con->query("SELECT * FROM user ORDER BY level ASC");
                  
                  // output data of each row
                  while($row = $result->fetch_assoc()) {
                  echo "<tr><td>" . $no++. "</td><td>" . $row["name"] . "</td><td>"
                  . $row["level"]. "</td><td>" ?> <form method="POST"><input type="hidden" name="id3$no" value="<?php echo $row["userId"]; ?>"><button class="button0" name="edit">Edit</button>  <button OnClick="return confirm('Confirm to delete this data?');" class="button0" name="delete">Delete</button> </form><?php "</td></tr>";
                  $id=$row["userId"];
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
  
  $_SESSION['id1']=$_POST['id3$no'];
echo "<script>window.location.assign('updateUser.php')</script>";

}

?>


<?php
require('includes/connect.php');
if (isset($_POST['delete'])) {
  $id3=$_POST['id3$no'];
   $sql = "DELETE FROM user WHERE userId='$id3'";
     $conn->query($sql);
     echo ' <script>alert("Delete Succesfully");</script>';
     echo "<script>window.location.assign('manageUser.php')</script>";
}
?>