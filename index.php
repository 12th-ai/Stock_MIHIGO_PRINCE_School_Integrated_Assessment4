<?php 
  include 'config.php';
  if(isset($_POST['signup'])){
    $username = $_POST['uname'];
    $pw = $_POST['upassword'];

    $sql = mysqli_query($con, "INSERT INTO user VALUES ('', '$username', '$pw')");

    if($sql){
      echo "<script>
        alert('User created Successfully!');
        window.location.href = 'login.php';
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
  <title>Sign Up</title>
  <link rel="stylesheet" href="./css/style.css">
</head>
<body class="bodyWithForm"> 
  <form method="POST">
    <p>SJITC Stock Management | Sign Up</p>
    <label > User name</label>
    <input type="text" required placeholder="Enter User Name" name="uname">
    <label > User password</label>
    <input type="password" required placeholder="Enter User password" name="upassword">
    <span>Have Account? <a href="login.php">Log In</a></span>
    <button type="submit" name="signup">Sign Up</button>
  </form>
</body>
</html>