<?php
require('includes/connect.php');
if (isset($_POST['button'])) {
  $id=$_POST['id'];
$stock=$_POST['currentStock'];
$newStock=$_POST['newStock'];
  if ($newStock>0) {
    $totalStock=$stock+$newStock;
    $query="UPDATE products SET product_quantity='$totalStock' WHERE product_id='$id'";

    if ($conn->query($query) == TRUE) {
      echo ' <script>alert("Update Succesfully");</script>';
      $conn->close();
      echo "<script>window.location.assign('manageProduct.php')</script>";
       }
    else {
          $conn->close();
          echo ' <script>alert("Update Failed");</script>';
          echo "<script>window.location.assign('manageProduct.php')</script>";
           }
  }
  else
  {
    echo ' <script>alert("Invalid data");</script>';
     echo "<script>window.location.assign('manageProduct.php')</script>";
  }
}
?>



<?php
require('includes/connect.php');

if (isset($_POST['search'])) {

	$name=$_POST['name'];

	

	$query = "SELECT * FROM products WHERE product_name = '$name' LIMIT 1";

	$result = mysqli_query($conn, $query);



	if (mysqli_num_rows($result)>0) {
		while ($row = mysqli_fetch_array($result))
      	{
      	 	$name = $row['product_name'];	
         	$id1= $row['product_id'];
          $stock=$row['product_quantity'];
      	 
      	        	 
      	}
      }
    mysqli_free_result($result);
    mysqli_close($conn);
}
else{
	$name="";
    $price="";
   	$quantity="";
}
?>





<!DOCTYPE html>
<html>
<head>
	<title>Update  Stock</title>
	<link rel="stylesheet" type="text/css" href="stylesheets/style.css">
</head>
<body>
  <?php include_once('layouts/header.php'); ?>
  <?php include_once('layouts/menu.php'); ?>
	<div class="main-page">
		<div class="table2 new-setting">
			<div class="manage-user">
				<div class="head">
          			 <strong>
                		<span>Find Product</span>
              		</strong>
				</div>
				<div class="body">
					<form method="post"  class="clearfix setting">
						Product Name : <input type="text" name="name" class="form-control1" required=""><br><br>
						<input type="submit" name="search" value="Find" class="button submit-button">
					</form>
				</div>
				
				<div class="head">
                 <strong>
                    <span>Add New Stock</span>
                  </strong>
        </div>
				<div id="product_info" class="body">
					<form name="frm" method="post"  autocomplete="off" class="clearfix setting">

						<input type="hidden" name="id" value="<?php echo $id1; ?>">

						Product Name : <input type="text" name="name1" class="form-control1" value="<?php echo $name;?>" readonly><br><br>

            Current Stock : <input type="number" name="currentStock" class="form-control1" value="<?php echo $stock;?>" readonly><br><br>

            New Stock : <input min="0" type="number" name="newStock" class="form-control1" value="" ><br><br>

						

						<button type="submit" class="button submit-button" name="button">Update Stock</button>
					</form>
				</div>
		
			</div>
		</div>
	</div>
	<script type="text/javascript">
	
    

  function calculateTotal() {
    
    var totalAmt = document.frm.price.value;
    var totalQuantity = document.frm.quantity.value;
    //alert("xx " + totalAmt*totalQuantity);

    var totalAll = totalAmt*totalQuantity;
   
    document.getElementById("total").value = totalAll;
   
  }


	</script>
</body>
</html>

