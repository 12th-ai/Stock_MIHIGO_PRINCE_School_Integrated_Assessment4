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
    $qry = mysqli_query($con, "DELETE FROM products WHERE ProductId = '$delId'");

    if($qry){
      echo "<script>
        alert('Product deleted successfully!')
        window.location.href = 'index.php';
      </script>";
    }
  }

  $retr = mysqli_query($con, "SELECT * FROM products");
  if(isset($_POST['report'])){
    $name = $_POST['search'];
    $retr = mysqli_query($con, "SELECT * FROM products WHERE Product_Name LIKE '%$name%' OR ProductId LIKE '%$name'");
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
      <h1 class="greet hidePrint">Hello <?php echo $_SESSION['logs'];?>, This is Products' Page</h1>

      <form method="POST" class="leftForm hidePrint">
        <p>Filter Products</p>
        <label for="">Search</label>
        <input type="text" name="search" placeholder="Enter Search Keyword" id="">
        <button type="submit" name="report">Search</button>
      </form>
      <div class="tabless">
        <p class="title">
          Total Products (<?php echo mysqli_num_rows($retr)?>)
          <a href="add_product.php" class="hidePrint">Add Product</a>
        </p>
        <?php 
          if(mysqli_num_rows($retr) > 0){
        ?>
        <table>
          <tr>
            <th>#</th>
            <th>Names</th>
            <th class="hidePrint">Operations</th>
          </tr>
          <?php 
            $row = 0;
            while($fetch = mysqli_fetch_array($retr)){
              $name = $fetch['Product_Name'];
              $id = $fetch['ProductId'];
              $row++;
          ?>
          <tr>
            <td><?php echo $row?></td>
            <td><?php echo $name?></td>
            <td class="hidePrint">
              <a href="./update_product.php?id=<?php echo $id?>">Update</a>
              <a href="./index.php?delete=<?php echo $id?>">Delete</a>
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