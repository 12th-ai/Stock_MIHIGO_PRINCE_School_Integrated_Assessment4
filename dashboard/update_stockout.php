<?php 
  session_start();
  include '../config.php';

  if(!isset($_SESSION['logs'])){
    echo "<script>
      alert('Please login first!');
      window.location.href = '../login.php';
    </script>";
  }
  if(isset($_GET['id'])){
    $id = $_GET['id'];

    $slct = mysqli_query($con, "SELECT * FROM stock_out WHERE SO_Id = '$id'");
    $fetchslct = mysqli_fetch_array($slct);

    $stId = $fetchslct['SO_Id'];
    $productid = $fetchslct['Product_Id'];
    $date = $fetchslct['Date'];
    $qty = $fetchslct['Quantity'];
  }

  if(isset($_POST['add'])){
    $prodId = $_POST['productid'];
    $date = $_POST['date'];
    $qty = $_POST['qty'];

    $insert = mysqli_query($con, "UPDATE stock_out SET Product_Id = '$prodId',Date = '$date',Quantity = '$qty' WHERE SO_Id = '$id'");
    if($insert){
      echo "<script>
        alert('Stock Out Updated Successfully!');
        window.location.href = 'stockout.php';
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
      <h1 class="greet">Hello <?php echo $_SESSION['logs'];?>, This is Update Stock Out Page</h1>
      <form method="POST">
        <p>Update Stock Out</p>
        <label for="">Product</label>
        <select name="productid" required id="">
          <option value="" disabled hidden selected>Choose Product</option>
          <?php 
            $optionQry = mysqli_query($con, "SELECT * FROM products");
            while($fOption = mysqli_fetch_array($optionQry)){
              $prodName = $fOption['Product_Name'];
              $prodId = $fOption['ProductId'];
          ?>
          <option <?php if($prodId == $productid){echo 'selected';} ?> value="<?php echo $prodId?>"><?php echo $prodName?></option>
          <?php } ?>
        </select>
        <label for="">Date</label>
        <input type="date" value="<?php echo $date?>" name="date" required required id="">
        <label for="">Quantity</label>
        <input type="number" value="<?php echo $qty?>" name="qty" placeholder="Enter Quantity" required min="0" id="">
        <button type="submit" name="add">Update Stock Out</button>
      </form>
    </main>
  </div>
</body>
</html>