<?php
  // TODO:20 Completed the delete post function
  require 'connect.php';
  session_start();

  if(empty($_SESSION['user_name'])){
    header('Location: login.php');
  }

  $username = $_SESSION['user_name'];
  $query = "SELECT id FROM `thanhvien` WHERE username = '$username'";
  $result = mysqli_query($connection, $query);
  while ($row = $result->fetch_assoc()) {
    $user_id = $row['id'];
  }
 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Main Page</title>
    <link rel="import" href="./components/importStyles.html">
  </head>
  <body>
    <link rel="import" id="header" href="./components/header.html">
    <script>
      var getImport = document.querySelector('#header');
      var getContent = getImport.import.querySelector('#content');
      document.body.appendChild(document.importNode(getContent, true));
    </script>

    <div id="wrapper">
        <div class="col-md-8 offset-md-2">
          <div class="card card-outline-success">
            <div class="card-header">
                <ul class="nav nav-pills card-header-pills pull-xs-left">
                    <li class="nav-item">
                        <a class="nav-link btn btn-warning" href="changePassword.php">Change Password</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-danger" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
            <div class="card-block" style="background-color: #fff!important;">
                <h3>Hello, <?php echo $_SESSION['user_name'] ?>!</h3>
                <hr />
                <a href="addPost.php" class="btn btn-primary">Add new post</a>
            </div>
          </div>
          <hr class="break-page" />
          <div class="card card-block">
            <h3>Upload file</h3>
            <hr />
            <form action="upload.php" method="post" enctype="multipart/form-data">
              <input type="file" name="file" />
              <input type="submit" class="btn btn-primary" value="Upload File" name="btn-upload">
              <br />
              <a href="view.php" class="btn btn-info">View Files</a>
            </form>
            <hr />
            <?php
             if(isset($_GET['success']))
             {
              ?>
                    <label>File Uploaded Successfully...  <a href="view.php">click here to view file.</a></label>
                    <?php
             }
             else if(isset($_GET['fail']))
             {
              ?>
                    <label>Problem While File Uploading !</label>
                    <?php
             }
             else
             {
              ?>
                    <label>Try to upload any files(PDF, DOC, DOCX or TEXT)</label>
                    <?php
             }
             ?>
          </div>
          <hr class="break-page" />
        </div>
        <div class="col-md-10 offset-md-1">
          <?php
            $query = "SELECT * FROM `baidang`";
            $result = mysqli_query($connection, $query);

            while ($row = $result->fetch_assoc()) {
              $authorId = $row['user_id'];
              $queryUser = "SELECT username FROM `thanhvien` WHERE id='$authorId'";
              $resultUser = mysqli_query($connection, $queryUser);
              while ($rowUser = $resultUser->fetch_assoc()) {
                $author = $rowUser['username'];
              }
              if($row['user_id'] == $user_id) {
                echo "<div class='card post'>".
                  "<div class='card-header'>".
                  "<a href='changePost.php?id=".$row['id']."' class='btn btn-warning'>Modifie</a>".
                  "<a href='savePost.php?id=".$row['id']."' style='margin-left: 12px;' class='btn btn-primary'>Save</a>".
                  "<a href='deletePost.php?id=".$row['id']."' onClick='return confirmDelete()' class='btn btn-danger pull-xs-right'>Delete</a>".
                  "</div>".
                  "<div class='card-block'>".
                      "<h3>".$row['title']."</h3>".
                      "<hr />".
                      "<pre>".$row['content']."</pre>".
                      "<hr />".
                  "</div>".
                  "<div class='card-footer'>".
                    "".$row['createdAt']."".
                    "<span class='pull-xs-right'>Author: ".$author."</span>".
                  "</div>".
                "</div>";
              }
              else {
                echo "<div class='card post'>".
                  "<div class='card-header'>".
                  "</div>".
                  "<div class='card-block'>".
                      "<h3>".$row['title']."</h3>".
                      "<hr />".
                      "<p>".$row['content']."</p>".
                      "<hr />".
                  "</div>".
                  "<div class='card-footer'>".
                    "".$row['createdAt']."".
                    "<span class='pull-xs-right'>Author: ".$author."</span>".
                  "</div>".
                "</div>";
              }
            }
           ?>
        </div>
    </div>
    <link rel="import" href="./components/imports.html">
    <script>
      function confirmDelete() {
        return confirm('Are you sure you want to delete this post?');
      }
    </script>
  </body>
</html>
