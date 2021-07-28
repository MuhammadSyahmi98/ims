<?php 
      			$conn = mysqli_connect("localhost","muhammad_user1","H89EPXkT^^m4","muhammad_db");


      			$query = "SELECT COUNT(*) AS c FROM user;";
				$result = $conn->query($query);
				$row =$result->fetch_assoc();
				$total = $row['c']; //Here is your count
 ?>
    

<?php 
      			$conn = mysqli_connect("localhost","muhammad_user1","H89EPXkT^^m4","muhammad_db");


      			$query = "SELECT COUNT(*) AS c FROM categories;";
				$result = $conn->query($query);
				$row =$result->fetch_assoc();
				$categorie = $row['c']; //Here is your count
 ?>

 <?php 
      			$conn = mysqli_connect("localhost","muhammad_user1","H89EPXkT^^m4","muhammad_db");


      			$query = "SELECT COUNT(*) AS c FROM products;";
				$result = $conn->query($query);
				$row =$result->fetch_assoc();
				$product = $row['c']; //Here is your count
 ?>   


 <?php 
      			$conn = mysqli_connect("localhost","muhammad_user1","H89EPXkT^^m4","muhammad_db");


      			$query = "SELECT COUNT(*) AS c FROM sales;";
				$result = $conn->query($query);
				$row =$result->fetch_assoc();
				$sale = $row['c']; //Here is your count
 ?>      

<!DOCTYPE html>
<html>
<head>
	<title>Dashboard</title>
	<link rel="stylesheet" type="text/css" href="stylesheets/style.css">
  
</head>
<body>
<?php include_once('layouts/header.php'); ?>
<?php include_once('layouts/menu.php'); ?>


<div class="row">
	<div class="row1">
		<div class="name" style="background-color: #9786ff">
			<img src="source/person.png" class="symbol">
		</div>
		<div class="data">
			
			<h2 class="totalName"><?php echo $total; ?></h2>
			<p class="pName">Users</p>
		</div>
	</div>
	<div class="row1">
		<div class="name" style="background-color: #ff9595">
			<img src="source/list.png" class="symbol">
		</div>
		<div class="data">
			<h2 class="totalName"><?php echo $categorie; ?></h2>
			<p class="pName">Brands</p>
		</div>
	</div>
	<div class="row1">
		<div class="name" style="background-color: #81deec">
			<img src="source/shoppingCart.png" class="symbol">
		</div>
		<div class="data">
			<h2 class="totalName"><?php echo $product; ?></h2>
			<p class="pName">Products</p>
		</div>
	</div>
	<div class="row1">
		<div class="name"  style="background-color:#f5aadf">
			<img src="source/money.png" class="symbol"> 
		</div>
		<div class="data">
			<h2 class="totalName"><?php echo $sale; ?></h2>
			<p class="pName">Sales</p>
		</div>
	</div>
</div>

<div class="table">

	<div class="table3">

		<div class="head">
			<strong>
				<span>Highest Selling Products</span>
			</strong>
		</div>

		<div class="body" style="margin-bottom: 2em;">
			<table>
				<thead>
				<tr>
					
					<th>Product</th>
					<th>Total Sold</th>
					<th>Total Quantity</th>
				</tr>
				<tr></tr>
				</thead>

				<tbody>
					<tr>
						<?php 
                  $conn = mysqli_connect("localhost","muhammad_user1","H89EPXkT^^m4","muhammad_db");

                  
                  $result = $conn->query("SELECT B.product_name,count(A.sale_id) AS total, SUM(A.total_quantity) as sum1 FROM sales AS A INNER JOIN products AS B ON B.product_id = A.product_id GROUP BY B.product_name ORDER BY total desc  LIMIT 5");
                  
                  // output data of each row
                  while($row = $result->fetch_assoc()) {
                  echo "<tr><td>" . $row["product_name"]. "</td><td>"
                  . $row["total"]. "</td><td>" . $row["sum1"] . "</td></tr>";
                }
              
                  ?>
					</tr>
				</tbody>
				<tbody></tbody>
			</table>
		</div>
	</div>

	<div class="table1">

		<div class="head">
			<strong>
				<span>latest sales</span>
			</strong>
		</div>

		<div class="body">
			<table>
				<thead>
				<tr>
					<th>Product</th>
					<th>Date</th>
					<th>Total Sales (RM)</th>
				</tr>
				<tr></tr>
				</thead>

				<tbody>
					<tr>
						<?php 
                  $conn = mysqli_connect("localhost","muhammad_user1","H89EPXkT^^m4","muhammad_db");

                  
                  $result = $conn->query("SELECT * FROM sales INNER JOIN products where sales.product_id = products.product_id ORDER BY sales.date desc LIMIT 5");
                  
                  // output data of each row
                  while($row = $result->fetch_assoc()) {
                  echo "<tr><td>" . $row["product_name"] . "</td><td>"
                  . $row["date"]. "</td><td>" . $row["total_quantity"]* $row["total_price"] . "</td></tr>";
                }
              
                  ?>
					</tr>
				</tbody>
				<tbody></tbody>
			</table>
		</div>
	</div>


	<div class="table1">

		<div class="head">
			<strong>
				<span>recently added products</span>
			</strong>
		</div>

		<div class="body" style="margin-bottom: 2em;">
			<table>
				<thead>
				<tr>
					
					<th>Product</th>
					<th>Brand</th>
					<th>Price</th>
				</tr>
				<tr></tr>
				</thead>

				<tbody>
					<tr>
						<?php 
                  $conn = mysqli_connect("localhost","muhammad_user1","H89EPXkT^^m4","muhammad_db");

                  
                  $result = $conn->query("SELECT * FROM products INNER JOIN categories WHERE products.categorie_id = categories.id ORDER BY product_id desc LIMIT 5");
                  
                  // output data of each row
                  while($row = $result->fetch_assoc()) {
                  echo "<tr><td>" . $row["product_name"] . "</td><td>"
                  . $row["name"]. "</td><td>" . $row["sell_price"] . "</td></tr>";
                }
              
                  ?>
					</tr>
				</tbody>
				<tbody></tbody>
			</table>
		</div>
	</div>


</div>




</body>
</html>

<?php

function getName($conn)
   {
     $strSql = "SELECT product_name FROM products WHERE  product_id ='1'";
     $result = mysql_query($strSql,$conn);
     

     echo "string "+$result;
   }
	
?>