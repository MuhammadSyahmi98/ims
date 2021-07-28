<?php
require('includes/connect.php');
session_start();
$id2=$_SESSION['id'];
$res = $conn->query("SELECT * FROM products INNER JOIN categories ON products.categorie_id = categories.id WHERE products.product_id = '$id2'");
$row = $res->fetch_assoc();
$name=$row['product_name'];
$detail=$row['product_detail'];
$buy=$row['buy_price'];
$sell=$row['sell_price'];
$proQuan=$row['product_quantity'];
$categoryId=$row['categorie_id'];

$up=$conn->query("SELECT * FROM categories WHERE id ='$categoryId'");
$row1 = $up->fetch_assoc();	
$cateId=$row['id'];							
$categoryName= $row1['name'];


?>

<?php
$hostname = "localhost";
$username = "root";
$password = "";
$databaseName = "db";

// connect to mysql database

$connect = mysqli_connect($hostname, $username, $password, $databaseName);

// mysql select query
$query = "SELECT * FROM categories";
$result1 = mysqli_query($conn, $query);

?>



<!DOCTYPE html>
<html>
<head>
	<title>update Product</title>
	<link rel="stylesheet" type="text/css" href="stylesheets/style.css">
</head>
<body>
	<?php include_once('layouts/header.php'); ?>
<?php include_once('layouts/menu.php'); 
	require('includes/connect.php');?>


	<div class="main-page">
	<div class="table2 new-setting">
		<div class="tabl1 manage-user">
			<div class="head">
				<strong>
                <span>update product<span>
              </strong>
			</div>
			<div class="body">
				<form method="post" action="#" class="clearfix setting">
					<div class="form-group">
						<div class="input-group">
							<input type="text" name="product-title" placeholder="Product Title" class="form-control1" required value="<?php echo $name; ?>">
						</div>
					</div>

					<div class="form-group">
						<div class="input-group">
							<input type="text" name="product-detail" placeholder="Product Details" class="form-control1"  value="<?php echo $detail; ?>">
						</div>
					</div>

					<div class="form-group">
						<div class="input-group">
							<select class="form-control1" name="product-categorie">
								<option value="<?php echo $cateId  ?>"><?php echo $categoryName;?></option>
								 <?php while($row1 = mysqli_fetch_array($result1)):;?>
								 
								 	<option value="<?php echo $row1[0];?>"><?php echo $row1[1];?></option>

								
           					 	
           					 <?php endwhile;?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<div class="row2">
							<div class="row3">
								<div class="input-group">
									<input type="number" name="product-quantity" class="form-control" value="<?php echo $proQuan; ?>" placeholder="Product-Quantity" readonly>
								</div>
							</div>
							<div class="row3">
								<div class="input-group">
									<input min="0" type="number" name="buy-price" class="form-control" value="<?php echo $buy; ?>" placeholder="Buy Price">
								</div>
							</div>
							<div class="row3">
								<div class="input-group">
									<input min="0" type="number" name="sell-price" class="form-control" value="<?php echo $sell; ?>" placeholder="Sell Price">
								</div>
							</div>
						</div>
					</div>
					<button type="submit" class="button submit-button" name="button">Update Product</button>
					
				</form>
			</div>
		</div>
	</div>
</div>


</body>
</html>


<?php
require('includes/connect.php');
if (isset($_POST['button'])) {
	$id2=$_SESSION['id'];
	$name=$_POST['product-title'];
	$detail=$_POST['product-detail'];
	$buyPrice=$_POST['buy-price'];
	$sellPrice=$_POST['sell-price'];
	$proCategory=$_POST['product-categorie'];


	
	if($sellPrice>$buyPrice)
	{
		$sql= "UPDATE products SET product_name='$name', product_detail='$detail', buy_price='$buyPrice', sell_price='$sellPrice', categorie_id='$proCategory' WHERE product_id='$id2'";

		if ($conn->query($sql) == TRUE) {
   		  echo ' <script>alert("Update Succesfully");</script>';
   		 $conn->close();
		
	
			
			echo "<script>window.location.assign('manageProduct.php')</script>";
		} else {
   			 echo "Error updating record: " . $conn->error;
			 echo ' <script>alert("Update Failed");</script>';
			 $conn->close();
			 echo "<script>window.location.assign('manageProduct.php')</script>";
			}

	}
	else
	{
		

		echo ' <script>alert("Sale Price Must Higher Than Buy Price");</script>';
		echo "<script>window.location.assign('manageProduct.php')</script>";
	}
}
?>