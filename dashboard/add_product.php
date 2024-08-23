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
    $name=$_POST['name'];
    $hello=mysqli_query($con,"INSERT INTO products VALUES('','$name')");
    if($hello){
      echo "<script>
      alert('product added');
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
      <h1 class="greet">Hello <?php echo $_SESSION['logs'];?>, This is Add Products' Page</h1>
      <form method="POST">
        <p>Add Product</p>
        <label > Product Name</label>
        <input type="text" required placeholder="Enter Product Name" name="name">
        <button type="submit" name="add">Add Product</button>
      </form>
    </main>
  </div>
</body>
</html>