<?php 
  session_start();
  include '../config.php';

  if(!isset($_SESSION['logs'])){
    echo "<script>
      alert('Please login first!');
      window.location.href = '../login.php';
    </script>";
  }
  if(isset($_POST['add'])){
    $prodId = $_POST['productid'];
    $date = $_POST['date'];
    $qty = $_POST['qty'];
    $price = $_POST['price'];
    $total = $qty * $price;

    $insert = mysqli_query($con, "INSERT INTO stock_in VALUES ('', '$prodId', '$date', '$qty', '$price', '$total')");
    if($insert){
      echo "<script>
        alert('Added In Stock Successfully!');
        window.location.href = 'stockin.php';
      </script>";
    }
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
      <div class="top">SJITC | Stock Management</div>
      <h1 class="greet">Hello <?php echo $_SESSION['logs'];?>, This is Add In Stock' Page</h1>
      <form method="POST">
        <p>Import In Stock</p>
        <label for="">Product</label>
        <select name="productid" required id="">
          <option value="" disabled hidden selected>Choose Product</option>
          <?php 
            $optionQry = mysqli_query($con, "SELECT * FROM products");
            while($fOption = mysqli_fetch_array($optionQry)){
              $prodName = $fOption['Product_Name'];
              $prodId = $fOption['ProductId'];
          ?>
          <option value="<?php echo $prodId?>"><?php echo $prodName?></option>
          <?php } ?>
        </select>
        <label for="">Date</label>
        <input type="date" name="date" required required id="">
        <label for="">Quantity</label>
        <input type="number" name="qty" placeholder="Enter Quantity" required min="0" id="">
        <label for="">Unit Price [FRW]</label>
        <input type="number" name="price" placeholder="Enter Unit Price" required min="0" id="">
        <button type="submit" name="add">Import In Stock</button>
      </form>
    </main>
  </div>
</body>
</html>