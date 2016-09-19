<?php
  include 'connect.php';

  session_start();

  if(empty($_SESSION['user_name'])) {
    header('Location: login.php');
  }

  if(isset($_POST['oldPass']) && isset($_POST['newPass']) && isset($_POST['newPassConfirm'])) {
      $username = $_SESSION['user_name'];
      $oldPassword = trim($_POST['oldPass']);
      $newPassword = trim($_POST['newPass']);
      $newPasswordConfirm = trim($_POST['newPassConfirm']);
      if($newPassword == $newPasswordConfirm){
          $query = "SELECT id FROM thanhvien WHERE username='$username' and password=md5('$oldPassword')";
          $result = mysqli_query($connection, $query);
          while ($row = $result->fetch_assoc()) {
              $userId = $row['id'];
          }
          $count = mysqli_num_rows($result);
          if ($count == 1) {
              $query = "UPDATE `thanhvien` SET password=md5('$newPassword') WHERE id='$userId'";
              $result = mysqli_query($connection, $query);
              $smsg = "Password changed!";
          } else{
              $fmsg = 'Your old password is invalid';
          }
      } else {
          $fmsg = "Password does not match!";
      }
  }
  ?>
  <!DOCTYPE html>
  <html>
    <head>
      <meta charset="utf-8">
      <title>Change Password</title>
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
              <h3>Change Password</h3>
              <p><strong><?php echo("Hello, {$_SESSION['user_name']}!"."<br />");?></strong></p>
              <hr />
              <form id="changePasswordForm" method="post">
                <?php if(isset($smsg)){ ?><div class="alert alert-success" role="alert"> <?php echo $smsg; ?> </div><?php } ?>
                <?php if(isset($fmsg)){ ?><div class="alert alert-danger" role="alert"> <?php echo $fmsg; ?> </div><?php } ?>
                <div class="form-group row">
                  <label for="oldPass" class="col-sm-2 col-form-label">Old Password*</label>
                  <div class="col-sm-10">
                    <input id="oldPass" name="oldPass" type="password" class="form-control" placeholder="Enter old password" required />
                  </div>
                </div>
                <div class="form-group row">
                  <label for="newPass" class="col-sm-2 col-form-label">Password*</label>
                  <div class="col-sm-10">
                    <input id="newPass" name="newPass" type="password" class="form-control" placeholder="Enter new password" required />
                  </div>
                </div>
                <div class="form-group row">
                  <label for="newPassConfirm" class="col-sm-2 col-form-label">Confirm*</label>
                  <div class="col-sm-10">
                    <input id="newPassConfirm" name="newPassConfirm" type="password" class="form-control" placeholder="Reenter new password" required />
                  </div>
                </div>
                <div class="form-group row">
                  <div class="offset-sm-2 col-sm-10">
                    <button type="submit" class="btn btn-primary">Change Password</button>
                    <a href="main.php" class="btn btn-secondary">Back</a>
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
        src="./changePassword.js">
      </script>
    </body>
  </html>
