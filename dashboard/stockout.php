<?php 
  session_start();
  include '../config.php';

  if(!isset($_SESSION['logs'])){
    echo "<script>
      alert('Please login first!');
      window.location.href = '../login.php';
    </script>";
  }

  if(isset($_GET['delete'])){
    $delId = $_GET['delete'];
    $qry = mysqli_query($con, "DELETE FROM stock_out WHERE SO_Id = '$delId'");

    if($qry){
      echo "<script>
        alert('Stock Out deleted successfully!')
        window.location.href = 'stockout.php';
      </script>";
    }
  }
  $retr = mysqli_query($con, "SELECT * FROM stock_out INNER JOIN products ON stock_out.Product_Id = products.ProductId");

  if(isset($_POST['report'])){
    $from = $_POST['from'];
    $to = $_POST['to'];

    $retr = mysqli_query($con, "SELECT * FROM stock_out INNER JOIN products ON stock_out.Product_Id = products.ProductId WHERE Date BETWEEN '$from' AND '$to'");
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>
  <div class="dashboard">
    <?php include 'nav.php'?>
    <main>
      <div class="top hidePrint">SJITC | Stock Management</div>
      <h1 class="greet hidePrint">Hello <?php echo $_SESSION['logs'];?>, This is Stock Out Page</h1>

      <form method="POST" class="leftForm hidePrint">
        <p>Make Report</p>
        <div class="split">
          <div class="each">
            <label > From Date</label>
            <input type="date" required name="from">
          </div>
          <div class="each">
            <label > To Date</label>
            <input type="date" required name="to">
          </div>
        </div>
        <button type="submit" name="report">Make Report</button>
      </form>

      <div class="tabless">
        <p class="title">
          Total Stock Outs (<?php echo mysqli_num_rows($retr)?>)
          <a href="add_stockout.php" class="hidePrint">Export From Stock</a>
        </p>
        <?php 
          if(mysqli_num_rows($retr) > 0){
        ?>
        <table>
          <tr>
            <th>#</th>
            <th>Name</th>
            <th>Date</th>
            <th>Quantity</th>
            <th class="hidePrint">Operations</th>
          </tr>
          <?php 
            $row = 0;
            while($fetch = mysqli_fetch_array($retr)){
              $stoid = $fetch['SO_Id'];
              $productName = $fetch['Product_Name'];
              $date = $fetch['Date'];
              $qty = $fetch['Quantity'];
              $row++;
          ?>
          <tr>
            <td><?php echo $row?></td>
            <td><?php echo $productName?></td>
            <td><?php echo $date?></td>
            <td><?php echo $qty?></td>
            <td class="hidePrint">
              <a href="update_stockout.php?id=<?php echo $stoid?>">Update</a>
              <a href="stockout.php?delete=<?php echo $stoid?>">Delete</a>
            </td>
          </tr>
          <?php } ?>
        </table>
        <button class="printBtn hidePrint" onclick="print()">Print</button>
        <?php } else { ?>
          <p>No Records Found</p>
        <?php } ?>
      </div>
    </main>
  </div>
</body>
</html>