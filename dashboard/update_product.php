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
    $productid = $_GET['id'];
    $gettt = mysqli_query($con, "SELECT * FROM products WHERE ProductId = '$productid'");
    $fetchhhh = mysqli_fetch_array($gettt);
    $prName = $fetchhhh['Product_Name'];
  }
  if(isset($_POST['add'])){
    $name=$_POST['name'];

    $qry = mysqli_query($con, "UPDATE products SET Product_Name = '$name' WHERE ProductId = '$productid'");
    if($qry){
      echo "<script>
      alert('product updated successfully');
      window.location.href='index.php'</script>";

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
      <h1 class="greet">Hello <?php echo $_SESSION['logs'];?>, This is Update Products' Page</h1>
      <form method="POST">
        <p>Update Product</p>
        <label > Product Name</label>
        <input type="text" value="<?php echo $prName;?>" required placeholder="Enter Product Name" name="name">
        <button type="submit" name="add">Update Product</button>
      </form>
    </main>
  </div>
</body>
</html>