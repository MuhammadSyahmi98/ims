<?php
require('includes/connect.php');
if(isset($_POST['button'])){
	if (empty($errors)){
		$title = $_POST['product-title'];
		$detail = $_POST['product-detail'];

		$category = $_POST['product-categorie'];
		$quantity = $_POST['product-quantity'];
		$buyPrice = $_POST['buy-price'];
		$sellPrice = $_POST['sell-price'];

		$query1 = "SELECT * FROM products WHERE product_name='$title'";
        $result=mysqli_query($conn,$query1);

		if (mysqli_num_rows($result)>0) {
			echo ' <script>alert("Product Already Exist!");</script>';
			echo "<script>window.location.assign('addProduct.php')</script>";
		}


		if ($quantity>0) {
			if ($buyPrice<$sellPrice) {
				$query  = "INSERT INTO products (";
        		$query .="product_name,product_detail,product_quantity,buy_price,sell_price,categorie_id";
       			$query .=") VALUES (";
       			$query .=" '{$title}', '{$detail}', '{$quantity}','{$buyPrice}', '{$sellPrice}', '{$category}'";
       			$query .=")";


				if ($conn->query($query)) {
					echo ' <script>alert("Success");</script>';
          			echo "<script>window.location.assign('manageProduct.php')</script>";
				}
				else {
					//failed
         			echo ' <script>alert("Failed");</script>';
         			echo "<script>window.location.assign('#')</script>";
				}
			}
			else
			{
				echo ' <script>alert("Sale Price Must Higher Than Buy Price");</script>';
				echo "<script>window.location.assign('addProduct.php')</script>";
			}
		}
		else
		{
			echo ' <script>alert("Invalid Number Of Quantity");</script>';
			echo "<script>window.location.assign('addProduct.php')</script>";
		}

	}
}
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
$result1 = mysqli_query($connect, $query);

?>



<!DOCTYPE html>
<html>
<head>
	<title>Add Product</title>
	<link rel="stylesheet" type="text/css" href="stylesheets/style.css">
</head>
<body>
	<?php include_once('layouts/header.php'); ?>
	<?php include_once('layouts/menu.php'); ?>

	<div class="main-page">
	<div class="table2 new-setting">
		<div class="tabl1 manage-user">
			<div class="head">
				<strong>
                <span>add new product<span>
              </strong>
			</div>
			<div class="body">
				<form method="post" action="#" class="clearfix setting">
					<div class="form-group">
						<div class="input-group">
							<input type="text" name="product-title" placeholder="Product Title" class="form-control1" required>
						</div>
					</div>

					<div class="form-group">
						<div class="input-group">
							<input type="text" name="product-detail" placeholder="Product Details" class="form-control1">
						</div>
					</div>

					<div class="form-group">
						<div class="input-group">
							<select class="form-control1" name="product-categorie">
								<option value="">Select Product Brand</option>
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
									<input min="0" type="number" name="product-quantity" class="form-control" placeholder="Product-Quantity" required>
								</div>
							</div>
							<div class="row3">
								<div class="input-group">
									<input min="0" type="number" name="buy-price" class="form-control" placeholder="Buy Price" required>
								</div>
							</div>
							<div class="row3">
								<div class="input-group">
									<input min="0" type="number" name="sell-price" class="form-control" placeholder="Sell Price" required>
								</div>
							</div>
						</div>
					</div>
					<button type="submit" class="button submit-button" name="button">Add Product</button>
				</form>
			</div>
		</div>
	</div>
</div>


</body>
</html>