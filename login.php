<?php 
  session_start();
  include 'config.php';
  if(isset($_POST['login'])){
    $name = $_POST['uname'];
    $pw = $_POST['upassword'];

    $sql = mysqli_query($con, "SELECT * FROM user WHERE UserName = '$name' AND Password = '$pw'");
    if(mysqli_num_rows($sql) == 0){
      echo "<script>
          alert('User not found!');
        </script>";
    } else {
      $_SESSION['logs'] = $name;
      echo "<script>
        alert('Logged in successfully');
        window.location.href = './dashboard/index.php';
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
  <title>Log In</title>
  <link rel="stylesheet" href="./css/style.css">
</head>
<body class="bodyWithForm"> 
  <form method="POST">
    <p>SJITC Stock Management | Log In</p>
    <label > User name</label>
    <input type="text" placeholder="Enter User Name" name="uname">
    <label > User password</label>
    <input type="password" placeholder="Enter User password" name="upassword">
    <span>No Account? <a href="index.php">Sign Up</a></span>
    <button type="submit" name="login">Log In</button>
  </form>
</body>
</html>