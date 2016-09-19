<?php
  // TODO:0 Complete the changePost page
   include 'connect.php';

   session_start();

   if(empty($_SESSION['user_name']) || empty($_GET['id'])) {
     header('Location: login.php');
   }

   $postId = $_GET['id'];
   $query = "SELECT `user_id`, `title`, `content` FROM `baidang` WHERE id = '$postId'";
   $result = mysqli_query($connection, $query);
   while ($row = $result->fetch_assoc()) {
       $authorId = $row['user_id'];
       $title = $row['title'];
       $content = $row['content'];
   }

   $username = $_SESSION['user_name'];
   $query = "SELECT id from `thanhvien` WHERE username = '$username'";
   $result = mysqli_query($connection, $query);
   while ($row = $result->fetch_assoc()) {
       $userId = $row['id'];
   }
   //echo("<script>console.log('PHP: ".$userId."');</script>");
   if($authorId == $userId) {
     if(isset($_POST['title']) && isset($_POST['postContent'])) {
       $title = $_POST['title'];
       $content = trim($_POST['postContent']);

       $query = "UPDATE `baidang` SET title='$title', content='$content' WHERE user_id='$authorId' AND id='$postId'";
       $result = mysqli_query($connection, $query);
       if($result) {
         $smsg = "Post Updated!";
       } else {
         $fmsg = "Failed to update post!";
       }
     }
   } else {
     header('Location: main.php');
   }
   ?>
   <!DOCTYPE html>
   <html>
     <head>
       <meta charset="utf-8">
       <title>Modifie Post</title>
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
               <h3>Modifie Post</h3>
               <hr />
               <form id="changePostForm" method="post">
                 <?php if(isset($smsg)){ ?><div class="alert alert-success" role="alert"> <?php echo $smsg; ?> </div><?php } ?>
                 <?php if(isset($fmsg)){ ?><div class="alert alert-danger" role="alert"> <?php echo $fmsg; ?> </div><?php } ?>
                 <div class="form-group row">
                   <label for="title" class="col-sm-2 col-form-label">Title*</label>
                   <div class="col-sm-10">
                     <input
                      id="title"
                      name="title"
                      value="<?php echo $title ?>"
                      type="text"
                      class="form-control"
                      placeholder="Enter title"
                      required
                    />
                   </div>
                 </div>
                 <div class="form-group row">
                   <label for="postContent" class="col-sm-2 col-form-label">Password*</label>
                   <div class="col-sm-10">
                     <textarea
                      id="postContent"
                      name="postContent"
                      type="text"
                      rows="8"
                      class="form-control"
                      placeholder="Enter post content"
                      required><?php echo $content ?></textarea>
                   </div>
                 </div>
                 <div class="form-group row">
                   <div class="offset-sm-2 col-sm-10">
                     <button type="submit" class="btn btn-primary">Modifie</button>
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
         src="./changePost.js">
       </script>
     </body>
   </html>
