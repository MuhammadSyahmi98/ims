<?php session_start(); ?>

<?php
require('includes/connect.php');
if(isset($_POST['add'])){
  if(empty($errors)){
    $name = $_POST['category-Name'];

    $query1 = "SELECT * FROM categories WHERE name='$name'";
    $result=mysqli_query($conn,$query1);

    if (mysqli_num_rows($result)>0) {
      echo ' <script>alert("Brand Already Exist!");</script>';
      echo "<script>window.location.assign('category.php')</script>";
    }
    else
    {
    $query  = "INSERT INTO categories (";
    $query .= "name";
    $query .= ") VALUES (";
    $query .= " '{$name}' ";
    $query .=")";
    if($conn->query($query)){
     //sucess
      echo ' <script>alert("Success");</script>';
      echo "<script>window.location.assign('category.php')</script>";
    } 
    else {
       //failed
        echo ' <script>alert("Failed");</script>';
        echo "<script>window.location.assign('category.php')</script>";
        }
  }
    }


    
}
?>




<!DOCTYPE html>
<html>
<head>
	<title>Category</title>
	<link rel="stylesheet" type="text/css" href="stylesheets/style.css">
</head>
<body>
	<?php include_once('layouts/header.php'); ?>
	<?php include_once('layouts/menu.php'); ?>
  <?php require('includes/connect.php'); ?>

	<div class="main-page">
  <div class="table new-setting">

    <div class="table1 table1-setting">
      <div class="head category-head">
        <strong>
          <span>added new Brand</span>
        </strong>
      </div>
      <div class="body panel-body">
        <form method="POST" action="#">
          <div class="form-group">
          	 <input type="text" name="category-Name" placeholder="Brand Name" class="form-input" required="">
          </div>
          <button class="button submit-button" name="add">
             Add brand
           </button>
        </form>
      </div>
    </div>

     <div class="table1 table1-setting-all">
      <div class="head category-head-all">
        <strong>
          <span>all brand</span>
        </strong>
      </div>
      <div class="body">
        <table>
        <thead>
        <tr>
          <th>No</th>
          <th>Brand</th>
          <th>Action</th>
        </tr>
        <tr></tr>
        </thead>

        <tbody>
          <tr>
             <?php 
                  $result = $conn->query("SELECT * FROM categories ORDER BY name ASC");
                  // output data of each row
                  $no=1;
                  while($row = $result->fetch_assoc()) {
                  echo "<tr><td>" . $no++. "</td><td>" . $row["name"] . "</td><td>" ?> <form method="POST"> <input type="hidden" name="id7$no" value="<?php echo $row["id"]; ?>"><button class="button0" name="edit">Edit</button>  <button OnClick="return confirm('Confirm to delete this data?');" class="button0" name="delete">Delete</button> </form><?php "</td></tr>";
                  
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
require('includes/connect.php');
if (isset($_POST['delete'])) {
  $id=$_POST['id7$no'];
   $sql = "DELETE FROM categories WHERE id='$id'";
     $conn->query($sql);
     echo ' <script>alert("Delete Succesfully");</script>';
     echo "<script>window.location.assign('category.php')</script>";
}

?>

<?php 
if (isset($_POST['edit'])) {
  $_SESSION['id']=$_POST['id7$no'];
  echo "<script>window.location.assign('updateCategory.php')</script>";
}
?>