<?php session_start();?>
<?php
$userId=$_SESSION['userId'];
$level=$_SESSION['level'];
require('includes/connect.php');
 if (!$conn) {
    
 }else{
        $month = date('m');

        if ($level==2) {
          $sql ="SELECT products.product_name, SUM(total_quantity) as total FROM sales INNER JOIN products where products.product_id=sales.product_id AND MONTH(date)=$month AND UserId='$userId' GROUP BY sales.product_id";
        }
        else
        {
          $sql ="SELECT products.product_name, SUM(total_quantity) as total FROM sales INNER JOIN products where products.product_id=sales.product_id AND MONTH(date)=$month  GROUP BY sales.product_id";
        }
         
         $result = mysqli_query($conn,$sql);
         $chart_data="";
         while ($row = mysqli_fetch_array($result)) { 
 
            $productname[]  = $row['product_name']  ;
            $sales[] = $row['total'];
        }
 
 
 }
 
 
?>
<!DOCTYPE html>
<html lang="en"> 
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="stylesheets/style.css">
        <title>Graph</title> 
    </head>
    <body>
 		<?php include_once('layouts/header.php'); ?>
        <?php include_once('layouts/menu.php'); ?>
        <?php $month1 = date('M'); ?>
        <div style="width: 900px; height: 500px; position:absolute; top:100px; left:330px; z-index:3; text-align: center;">
            <h2 class="page-header" style="text-transform: uppercase;">Sales In <?php echo $month1; ?></h2>
            <div>Product</div>
            <br>
            <canvas   id="chartjs_bar"></canvas> 
        </div>  
        <div class="main-page" style="position: relative; top: 40em;">
        <div class="table new-setting">
             <div class="tabl1 manage-user">
             <div class="head">
                <strong>
                <span>All sales in <?php echo $month1; ?></span>
                 </strong>
             </div>
             <div class="body" style="margin-bottom: 2em;">
                 <table>
                     <thead>
                        <tr>
                            <th>No</th>
                            <th>Product Name</th>
                            <th>Detail</th>
                            <th>Quantity</th>
                            <th>Total Buy Price (RM)</th>
                            <th>Total Sell Price (RM)</th>
                            <th>Profit (RM)</th>
                            <th>Date</th>
                        </tr>
                        <tr></tr>
                    </thead>

                    <tbody>
                        <tr>
                            <?php 
                  require('includes/connect.php');
                  $month = date('m');
                  $no =1;
                  $totalBuyPrice1=0;
                  $totalSellPrice1=0;
                  if ($level==2) {
                     $result = $conn->query("SELECT * FROM sales INNER JOIN products ON sales.product_id = products.product_id WHERE MONTH(date)=$month AND UserId='$userId' ORDER BY date DESC ");
                  }
                  else
                  {
                     $result = $conn->query("SELECT * FROM sales INNER JOIN products ON sales.product_id = products.product_id WHERE MONTH(date)=$month  ORDER BY date DESC ");
                  }
                 
                  
                  // output data of each row
                  while($row = $result->fetch_assoc()) {

                    $totalSellPrice=($row["total_quantity"]*$row["total_price"]);
                    $totalBuyPrice=($row["total_quantity"]*$row["buy_price1"]);

                    $total=$totalSellPrice-$totalBuyPrice;

                    $totalBuyPrice1=$totalBuyPrice1+$totalBuyPrice;
                    $totalSellPrice1=$totalSellPrice1+$totalSellPrice;


                  echo "<tr><td>" . $no++. "</td><td>" . $row["product_name"] . "</td><td>" . $row["product_detail"] . "</td><td>"
                  . $row["total_quantity"]. "</td><td>" . $totalBuyPrice . "</td><td>" . $totalSellPrice . "</td><td>" . $total . "</td><td>" . $row["date"]. "</td></tr>";
                  $id=$row["sale_id"];
                }
              
                  ?>

                    <td style="font-weight: bold;">TOTAL</td> <td></td> <td></td> <td></td> <td style="font-weight: bold;"><?php echo $totalBuyPrice1 ?></td> <td style="font-weight: bold;"><?php echo $totalSellPrice1 ?></td> <td   style="font-weight: bold;"><?php echo ($totalSellPrice1-$totalBuyPrice1) ?></td> <td></td>

                    </tr>
                    </tbody>
                    <tbody></tbody>
                </table>
            </div>
            </div>
    
        </div>
    </div>  
    </body>
  <script src="//code.jquery.com/jquery-1.9.1.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
<script type="text/javascript">
      var ctx = document.getElementById("chartjs_bar").getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels:<?php echo json_encode($productname); ?>,
                        datasets: [{
                            backgroundColor: [
                               "#5969ff",
                                "#ff407b",
                                "#25d5f2",
                                "#ffc750",
                                "#800080",
                                "#008080",
                                "#000080",
                                "#FA8072",
                                "#FF00FF",
                                "#800000",
                                "#2ec551",
                                "#7040fa",
                                "#ff004e",
                                "#CD5C5C",
                                "#FFA07A"
                            ],
                            data:<?php echo json_encode($sales); ?>,
                        }]
                    },
                    options: {
                           legend: {
                        display: true,
                        position: 'bottom',
 
                        labels: {
                            fontColor: '#71748d',
                            fontFamily: 'Circular Std Book',
                            fontSize: 14,
                        }
                    },
 
 
                }
                });
    </script>
</html>


