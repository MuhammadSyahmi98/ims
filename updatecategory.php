<?php session_start();?>

<?php
require('includes/connect.php');
$id=$_SESSION['id'];

$query="SELECT * FROm Categories WHERE id='$id'";
$res=$conn->query($query);
$row = $res->fetch_assoc();
$name=$row['name'];

?>


<?php
require('includes/connect.php');
if (isset($_POST['update'])) {
  $id=$_SESSION['id'];
  $Nname=$_POST['category-Name'];
  $sql="UPDATE Categories SET name='$Nname' WHERE id='$id'";
  if ($conn->query($sql) == TRUE) {
        echo ' <script>alert("Update Succesfully");</script>';
       $conn->close();
       
       echo "<script>window.location.assign('Category.php')</script>";

    } else {
         //echo "Error updating record: " . $conn->error;
       echo ' <script>alert("Update Failed");</script>';
       echo "<script>window.location.assign('Category.php')</script>";
       $conn->close();
       
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

	<div class="main-page">
  <div class="table new-setting">

    <div class="table1 table1-setting">
      <div class="head category-head">
        <strong>
          <span>Update Brand</span>
        </strong>
      </div>
      <div class="body panel-body">
        <form method="POST" action="#">
          <div class="form-group">
          	 <input type="text" name="category-Name" placeholder="Brand Name" class="form-input" value="<?php echo $name; ?>" required="">
          </div>
          <button class="button submit-button" name="update">
             update brand
           </button>
        </form>
      </div>
    </div>
    
  </div>
</div>


</body>
</html>
