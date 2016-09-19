<?php
  require 'connect.php';

  session_start();

  if(isset($_SESSION['user_name'])) {
    header('Location: main.php');
  }

  if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['passwordConfirm'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $passwordConfirm = $_POST['passwordConfirm'];

    if($password != $passwordConfirm) {
      $fmsg ="Password does not match!";
    } else {
      $query = "INSERT INTO `thanhvien` (username, password) VALUES ('$username', md5('$password'))";
      $result = mysqli_query($connection, $query);
      if($result) {
        $smsg = "User Created Successfully.";
        header("Location: http://localhost/lamp/login.php");
        exit();
      } else{
        $fmsg ="User Registration Failed";
      }
    }
  }
 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Register</title>
    <link rel="import" href="./components/importStyles.html">
  </head>
  <body>

    <link rel="import" id="header" href="./components/header.html">
    <script>
      var getImport = document.querySelector('#header');
      var getContent = getImport.import.querySelector('#content');
      document.body.appendChild(document.importNode(getContent, true));
    </script>

    <div id="wrapper" class="container-fluid">
      <div class="row">
        <div class="col-md-8 offset-md-2">
          <div class="card card-block">
            <h3>Register</h3>
            <hr />
            <form id="registerForm" method="post">
              <?php if(isset($smsg)){ ?><div class="alert alert-success" role="alert"> <?php echo $smsg; ?> </div><?php } ?>
              <?php if(isset($fmsg)){ ?><div class="alert alert-danger" role="alert"> <?php echo $fmsg; ?> </div><?php } ?>
              <div class="form-group">
                <label for="username">Username*</label>
                <input id="username" name="username" type="text" class="form-control" placeholder="Enter your username" required />
              </div>
              <div class="form-group">
                <label for="password">Password*</label>
                <input id="password" name="password" type="password" class="form-control" placeholder="Enter your password" required />
              </div>
              <div class="form-group">
                <label for="passwordConfirm">Password Confirm*</label>
                <input id="passwordConfirm" name="passwordConfirm" type="password" class="form-control" placeholder="Reenter your password" required />
              </div>
              <button type="submit" class="btn btn-primary">Register</button>
              <a href="login.php" class="btn btn-secondary">Login</a>
            </form>
          </div>
        </div>
      </div>
    </div>

    <link rel="import" href="./components/imports.html">
    <script
      type="text/javascript"
      src="./register.js">
    </script>
  </body>
</html>
