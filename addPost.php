<?php
  require 'connect.php';
  session_start();

  if(empty($_SESSION['user_name'])){
    header('Location: login.php');
  }

  if(isset($_POST['title']) && isset($_POST['postContent'])) {
    $title = trim($_POST['title']);
    $postContent = $_POST['postContent'];
    $username = $_SESSION['user_name'];

    $query = "SELECT id FROM `thanhvien` WHERE username = '$username'";
    $result = mysqli_query($connection, $query);

    // important: Read from result mysql php!
    // while ($row = $result->fetch_assoc()) {
    //     echo("<script>console.log('PHP: ".$row['id']."');</script>");
    // }

    while ($row = $result->fetch_assoc()) {
      $id = $row['id'];
    }

    $query = "INSERT INTO `baidang` (title, content, user_id) VALUES ('$title', '$postContent', '$id')";
    $result = mysqli_query($connection, $query);
    if($result) {
      $smsg = "Post created!";
      header('Location: main.php');
    } else {
      $fmsg = "Failed to create post!";
    }
  }
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
          <div class="card card-block">
            <h3>Add Post</h3>
            <hr />
            <form id="addPostForm" method="post">
                <?php if(isset($smsg)){ ?><div class="alert alert-success" role="alert"> <?php echo $smsg; ?> </div><?php } ?>
                <?php if(isset($fmsg)){ ?><div class="alert alert-danger" role="alert"> <?php echo $fmsg; ?> </div><?php } ?>
                <div class="form-group row">
                  <label for="title" class="col-sm-2 col-form-label">Title*</label>
                  <div class="col-sm-10">
                    <input id="title" name="title" type="text" class="form-control" required />
                  </div>
                </div>
                <div class="form-group row">
                  <label for="postContent" class="col-sm-2 col-form-label">Content*</label>
                  <div class="col-sm-10">
                    <textarea id="postContent" name="postContent" rows="5" type="text" class="form-control" required></textarea>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="offset-sm-2 col-sm-10">
                    <button type="submit" class="btn btn-primary">Add</button>
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
      src="./addPost.js">
    </script>
  </body>
</html>
