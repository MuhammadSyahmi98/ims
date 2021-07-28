<?php
require('includes/connect.php');
session_start();
$id3=$_SESSION['id'];
$result = $conn->query("SELECT * FROM sales INNER JOIN products ON sales.product_id = products.product_id WHERE sales.sale_id= '$id3'");
$row = $result->fetch_assoc();

$productName=$row['product_name'];
$quan1=$row['total_quantity'];
$date=$row['date'];
$price=$row['sell_price'];
$product_id=$row['product_id'];

 $conn->close();
?>


<!DOCTYPE html>
<html>
<head>
	<title>Update Sales</title>
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
                    <span>Update Sale</span>
                  </strong>
        </div>
				<div id="product_info" class="body">
					<form name="frm" method="post"  autocomplete="off" class="clearfix setting">

						<input type="hidden" name="id" value="<?php echo $id3; ?>">
            			<input type="hidden" name="productId" value="<?php echo $product_id; ?>">
            			<input type="hidden" name="quanT" value="<?php echo $quan1; ?>">

						Product Name : <input type="text" name="name1" class="form-control1" value="<?php echo $productName; ?>" readonly><br><br>

						Price : <input type="number"  name="price"  class="form-control1" value="<?php echo $price;?>" readonly><br><br>

						Quantity : <input min="1" type="number" name="quantity"  class="form-control1" value="<?php echo $quan1;?>" onkeyup="calculateTotal()"><br><br>
						
						Total Price : <input type="number"  id="total" name="total" class="form-control1" value="<?php echo $quan1*$price;?>" readonly><br><br>

						Date : <input type="date" name="date" class="form-control1" value="<?php echo $date;?>" required><br><br>

						<button type="submit" class="button submit-button" name="button">Update Sale</button>
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
<?php
require('includes/connect.php');
if (isset($_POST['button'])) {

$id3=$_SESSION['id'];

$quan1=$_POST['quanT'];

$quan=$_POST['quantity'];
$total=$_POST['total'];
$date=$_POST['date'];
$product_id1=$_POST['productId'];

$intial=$quan1-$quan;

$res= $conn->query("SELECT * FROM products WHERE product_id='$product_id1'");
$row = $res->fetch_assoc();
$totalQuantity=$row['product_quantity'];

  if ($total>0) {
    if ($intial<0) {
      $intial1=$quan-$quan1;
      $newTotal=$totalQuantity-$intial1;

      echo $totalQuantity;

      $query="UPDATE products SET product_quantity='$newTotal' WHERE product_id='$product_id1'";

      $query1="UPDATE sales SET total_price='$total', total_quantity='$quan', date='$date' WHERE sale_id='$id3'";

      if (($conn->query($query) == TRUE) && ($conn->query($query1) == TRUE)) {
          echo ' <script>alert("Update Succesfully");</script>';
          $conn->close();
    
          echo "<script>window.location.assign('manageSales.php')</script>";
      }
      else {
          $conn->close();
          echo ' <script>alert("Update Failed");</script>';
          echo "<script>window.location.assign('manageSales.php')</script>";
      }


 
     }
    else if($intial>0)
    {
      $intial1=$quan1-$quan;
      $newTotal=$totalQuantity+$intial1;

      $query="UPDATE products SET product_quantity='$newTotal' WHERE product_id='$product_id1'";

      $query1="UPDATE sales SET total_price='$total', total_quantity='$quan', date='$date' WHERE sale_id='$id3'";

       if ($conn->query($query) == TRUE && $conn->query($query1) == TRUE) {
      echo ' <script>alert("Update Succesfully");</script>';
      $conn->close();
    
      echo "<script>window.location.assign('manageSales.php')</script>";
        }
      else {
          $conn->close();
          echo ' <script>alert("Update Failed");</script>';
          echo "<script>window.location.assign('manageSales.php')</script>";
      }
    }
  }
  else{
    echo ' <script>alert("Invalid Quantity");</script>';
    echo "<script>window.location.assign('manageSales.php')</script>";
  }

}
?>
