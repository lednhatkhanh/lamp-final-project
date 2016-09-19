<?php
    session_start();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Admin Demo</title>
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
          <div class="card card-block text-xs-center">
            <h1>Demo Admin</h1>
            <hr />
            <p>
              Just a simple page to demo our project!
            </p>
            <?php if(empty($_SESSION['user_name']))
                echo '<a href="register.php" class="card-link">Register</a> <a href="login.php" class="card-link">Login</a>';
                else echo '<a href="main.php" class="btn btn-primary">Main Page</a> <br /> <hr /> <a href="logout.php" class="card-link">Logout</a>'
            ?>
          </div>
        </div>
      </div>
    </div>

    <link rel="import" href="./components/imports.html">
  </body>
</html>
