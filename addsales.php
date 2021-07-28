<?php session_start()?>

<?php
if (isset($_POST['search'])) {

	$name=$_POST['name'];

	$conn = mysqli_connect("localhost","muhammad_user1","H89EPXkT^^m4","muhammad_db");

	$query = "SELECT * FROM products WHERE product_name = '$name' LIMIT 1";

	$result = mysqli_query($conn, $query);



	if (mysqli_num_rows($result)>0) {
		while ($row = mysqli_fetch_array($result))
      	{
      	 	$name = $row['product_name'];
         	$price = $row['sell_price'];
          $buyPrice=$row['buy_price'];
          $currentQty=$row['product_quantity'];
         	$quantity=1;
         	$id1= $row['product_id'];
          echo "<script>window.location.assign('#product_info')</script>";
      	 
      	        	 
      	}
      }
    mysqli_free_result($result);
    mysqli_close($conn);
}
else{
	$name="";
    $price="";
   	$quantity="";
   	$date="";
}
?>

<?php
$conn = mysqli_connect("localhost","muhammad_user1","H89EPXkT^^m4","muhammad_db");
if (isset($_POST['button'])) {
	if(empty($errors)){
           	$id2 = $_POST['id'];
            $totalPrice = $_POST['price'];
            $buyPrice=$_POST['buyPrice'];
            $totalQuantity = $_POST['quantity'];
            $currentQty=$_POST['currentQty'];
        	$date = $_POST['date'];
           $userId=$_SESSION['userId'];

        
        	if ($totalQuantity<=$currentQty) {
        	  if ($totalQuantity>0) {
              $query  = "INSERT INTO sales (";
              $query .="total_price,buy_price1,total_quantity,product_id,date,UserId";
              $query .=") VALUES (";
              $query .=" '{$totalPrice}', '{$buyPrice}', '{$totalQuantity}','{$id2}', '{$date}', '{$userId}'";
              $query .=")";

              $result = $conn->query("SELECT * FROM products WHERE product_id='$id2'");
              $row = $result->fetch_assoc();

              $productQuan=$row['product_quantity'];

              if($conn->query($query)){
              //sucess

                $newTotalProduct=$productQuan-$totalQuantity;

                $query="UPDATE products SET product_quantity='$newTotalProduct' WHERE product_id='$id2'" ;          

                if ($conn->query($query) == TRUE) {
                  echo ' <script>alert("Success");</script>';
                  echo "<script>window.location.assign('manageSales.php')</script>";
                }
                else
                {
                  echo ' <script>alert("Failed");</script>';
                  echo "<script>window.location.assign('addSales.php')</script>";
                  }


            
              } 
              else {
              //failed
                echo ' <script>alert("Failed");</script>';
                echo "<script>window.location.assign('addSales.php')</script>";
              }
          }
          else
          {
            echo ' <script>alert("Failed! Quantity cannot below than 1");</script>';
            echo "<script>window.location.assign('addSales.php')</script>";
          }
        

        } 
        else
        {
        	echo ' <script>alert("Not Enough Stock. Current Stock =  '.$currentQty. '");</script>';
            echo "<script>window.location.assign('#')</script>";
          }       
      }
}
?>



<!DOCTYPE html>
<html>
<head>
	<title>Add Sales</title>
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
                		<span>Find Item</span>
              		</strong>
				</div>
				<div class="body">
					<form method="post" action="addSales.php" class="clearfix setting">
						Product Name : <input type="text" name="name" class="form-control1" required=""><br><br>
						<input type="submit" name="search" value="Find" class="button submit-button">
					</form>
				</div>
				
				<div class="head">
                 <strong>
                    <span>Add Sale</span>
                  </strong>
        </div>
				<div id="product_info" class="body">
					<form name="frm" method="post"  autocomplete="off" class="clearfix setting">

						<input type="hidden" name="id" value="<?php echo $id1; ?>">
            			<input type="hidden" name="buyPrice" value="<?php echo $buyPrice; ?>">
            			<input type="hidden" name="currentQty" value="<?php echo $currentQty; ?>">

						Product Name : <input type="text" name="name1" class="form-control1" value="<?php echo $name;?>" readonly><br><br>

						Price : <input type="number"  name="price"  class="form-control1" value="<?php echo $price;?>" readonly><br><br>

						Quantity : <input min="1" type="number" name="quantity"  class="form-control1" value="<?php echo $quantity;?>" onkeyup="calculateTotal()"><br><br>
						
						Total Price : <input type="number"  id="total" name="total" class="form-control1" value="<?php echo $quantity*$price;?>" readonly><br><br>

						Date : <input type="date" name="date" class="form-control1" value="" required><br><br>

						<button type="submit" class="button submit-button" name="button">Add Sale</button>
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