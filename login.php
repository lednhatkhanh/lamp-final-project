<?php
  include 'connect.php';

  session_start();

  include_once 'securimage/securimage.php';
  $securimage = new Securimage();


  if(isset($_SESSION['user_name'])) {
    header('Location: main.php');
  }

  if (isset($_POST['username']) && isset($_POST['password'])) {
      if ($securimage->check($_POST['captcha_code']) == false) {
          $fmsg = 'Wrong captcha!';
      }
      else{
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
        $remember = $_POST['remember'];
        if($remember == "Yes"){
            setcookie("username_cookie", trim($_POST['username']));
            setcookie("password_cookie", trim($_POST['password']));
        }
        $query = "SELECT id FROM thanhvien WHERE username = '$username' and password = md5('$password')";
        $result = mysqli_query($connection, $query);
        $count = mysqli_num_rows($result);
        if ($count == 1) {
            $_SESSION['user_name'] = $username;
            header('Location: main.php');
        }
        else {
            $fmsg = 'Your username or password is invalid';
        }
      }
  }
  ?>
  <!DOCTYPE html>
  <html>
    <head>
      <meta charset="utf-8">
      <title>Login</title>
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
              <h3>Login</h3>
              <hr />
              <form id="loginForm" method="post">
                <?php if(isset($smsg)){ ?><div class="alert alert-success" role="alert"> <?php echo $smsg; ?> </div><?php } ?>
                <?php if(isset($fmsg)){ ?><div class="alert alert-danger" role="alert"> <?php echo $fmsg; ?> </div><?php } ?>
                <div class="form-group row">
                  <label for="username" class="col-sm-2 col-form-label">Username*</label>
                  <div class="col-sm-10">
                    <input
                        id="username"
                        name="username"
                        type="text"
                        value="<?php if(isset($_COOKIE['username_cookie'])){echo $_COOKIE['username_cookie'];} else {echo "";} ?>"
                        class="form-control"
                        placeholder="Enter your username"
                        required
                    />
                  </div>
                </div>
                <div class="form-group row">
                  <label for="password" class="col-sm-2 col-form-label">Password*</label>
                  <div class="col-sm-10">
                    <input
                        id="password"
                        name="password"
                        type="password"
                        value="<?php if(isset($_COOKIE['password_cookie'])){echo $_COOKIE['password_cookie'];} else {echo "";} ?>"
                        class="form-control"
                        placeholder="Enter your password"
                        required
                    />
                  </div>
                </div>
                <div class="row">
                    <div class="offset-sm-2 col-sm-10">
                        <div class="form-check">
                            <label class="form-check-label">
                            <input id="remember" name="remember" type="checkbox" class="form-check-input" value="Yes">
                            Remember password?
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="offset-sm-2 col-sm-10">
                        <div class="row">
                            <img id="captcha" src="securimage/securimage_show.php" alt="CAPTCHA Image" />
                        </div>
                        <br />
                        <div class="row">
                            <div class="col-sm-4 parent">
                                <input type="text" class="form-control" id="captcha_code" name="captcha_code" maxlength="6" />
                            </div>
                            <div class="col-sm-4 parent">
                                <a href="#" onclick="document.getElementById('captcha').src = 'securimage/securimage_show.php?' + Math.random(); return false">[ Different Image ]</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                  <div class="offset-sm-2 col-sm-10">
                    <button type="submit" class="btn btn-primary">Login</button>
                    <a href="register.php" class="btn btn-secondary">Register</a>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

      <link rel="import" href="./components/imports.html">
      <script
        type="text/javascript"
        src="./login.js">
      </script>
    </body>
  </html>
