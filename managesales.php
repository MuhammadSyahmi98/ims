<?php session_start();?>

<!DOCTYPE html>
<html>
<head>
	<title>Manage Sales</title>
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
                <span>All sales</span>
                 <div class="user-head1">
                  <form method="post" action="addSales.php">
                    <button class="button submit-button1">Add sale</button>
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
                    <th>Description</th>
          					<th>Quantity</th>
          					<th>Total Price (RM)</th>
                    <th>Date</th>
                    <th>Actions</th>
       					</tr>
        				<tr></tr>
        			</thead>

        			<tbody>
          				<tr>
            				<?php 
                  require('includes/connect.php');

                  $level=$_SESSION['level'];
                  $userId=$_SESSION['userId'];

                  $no =1;
                  if ($level==2) {
                      $result = $conn->query("SELECT * FROM sales INNER JOIN products ON sales.product_id = products.product_id WHERE UserId='$userId' ORDER BY date DESC ");
                  }
                  else
                  {
                      $result = $conn->query("SELECT * FROM sales INNER JOIN products ON sales.product_id = products.product_id ORDER BY date DESC");
                  }
                
                  
                  // output data of each row
                  while($row = $result->fetch_assoc()) {
                  echo "<tr><td>" . $no++. "</td><td>" . $row["product_name"] . "</td><td>" . $row["product_detail"] . "</td><td>"
                  . $row["total_quantity"]. "</td><td>" . $row["total_price"]*$row['total_quantity'] . "</td><td>" . $row["date"] . "</td><td>" ?> <form method="POST"><input type="hidden" name="id4$no" value="<?php echo $row["sale_id"]; ?>"><input type="hidden" name="id9$no" value="<?php echo $row["total_quantity"]; ?>"><button class="button0" name="edit">Edit</button>  <button OnClick="return confirm('Confirm to delete this data?');" class="button0" name="delete">Delete</button> </form><?php "</td></tr>";
                  $id=$row["sale_id"];
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
  $id4=$_POST['id4$no'];
  //total item that be sold
  $total_quantity=$_POST['id9$no'];

  $query="SELECT * FROM sales WHERE sale_id='$id4'";
  $res=$conn->query($query);
  $row = $res->fetch_assoc();
  $productId=$row['product_id'];


  $query1="SELECT * FROM products WHERE product_id='$productId'";
  $res=$conn->query($query1);
  $row = $res->fetch_assoc();
  //totalQuantityFromDatabase
  $intialTotal=$row['product_quantity'];

  $newTotal=$intialTotal+$total_quantity;


  if (($conn->query($query)==true)&&($conn->query($query1)==true)) {

  	$query="UPDATE products SET product_quantity='$newTotal' WHERE product_id='$productId'";

  	if ($conn->query($query) == TRUE) {

  		$sql = "DELETE FROM sales WHERE sale_id='$id4'";

    	 if ($conn->query($sql) == TRUE) {

    	 	echo ' <script>alert("Delete Succesfully");</script>';
    		echo "<script>window.location.assign('manageSales.php')</script>";

    	 }
     
  	}
  }

   
}

?>

<?php
if (isset($_POST['edit'])) {
  
$_SESSION['id']=$_POST['id4$no'];
echo "<script>window.location.assign('updateSales.php')</script>";
}

?>