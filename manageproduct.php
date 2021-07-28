<?php session_start();?>
<!DOCTYPE html>
<html>
<head>
	<title>Manage Product</title>
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
                	<span>Manage Product<span>
                </div>
                <div class="user-head1">
                	<form method="post" action="addProduct.php">
       		    			<button class="button submit-button1">Add Product</button>
       		    	</form>
                </div>
              </strong>
         </div>
         <div class="body" style="margin-bottom: 2em;">
             <table>
               <thead>
                <tr>
                    <th>No</th>
                    <th>Product Name</th>
                    <th>Brand</th>
                    <th>Detail</th>
                    <th>Instock (Qty)</th>
                    <th>Buying Price (RM)</th>
                    <th>selling Price (RM)</th>
                    <th>Actions</th>
                </tr>
                <tr></tr>
              </thead>

              <tbody>
                  <tr>
                   <?php 
                  $con = mysqli_connect("localhost","muhammad_user1","H89EPXkT^^m4","muhammad_db");
                  $no =1;
                 
                  $result = $con->query("SELECT * FROM products INNER JOIN categories ON products.categorie_id = categories.id ORDER BY product_id DESC");
                  
                  // output data of each row
                  while($row = $result->fetch_assoc()) {
                  echo "<tr><td>" . $no++. "</td><td>" . $row["product_name"] . "</td><td>"
                  . $row["name"]. "</td><td>" . $row["product_detail"] . "</td><td>" . $row["product_quantity"] . "</td><td>" . $row["buy_price"] . "</td><td>" . $row["sell_price"] . "</td><td>" ?> <form method="POST">
                    <input type="hidden" name="id5$no" value="<?php echo $row["product_id"]; ?>"><button  class="button0" name="edit">Edit</button>  <button OnClick="return confirm('Confirm to delete this data?');"class="button0" name="delete">Delete</button> </form><?php "</td></tr>";
                  $id=$row["product_id"];
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
  
$_SESSION['id']=$_POST['id5$no'];
echo "<script>window.location.assign('updateProduct.php')</script>";
}

?>


<?php
require('includes/connect.php');
if (isset($_POST['delete'])) {
  $id1=$_POST['id5$no'];
   $sql = "DELETE FROM products WHERE product_id='$id1'";
     $conn->query($sql);
     echo ' <script>alert("Delete Succesfully");</script>';
     echo "<script>window.location.assign('manageProduct.php')</script>";
}

?>