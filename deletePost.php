<?php
  // TODO:10 Complete the deletePost page
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
   }

   $username = $_SESSION['user_name'];
   $query = "SELECT id from `thanhvien` WHERE username = '$username'";
   $result = mysqli_query($connection, $query);
   while ($row = $result->fetch_assoc()) {
       $userId = $row['id'];
   }
   //echo("<script>console.log('PHP: ".$userId."');</script>");
   if($authorId == $userId) {
     $query = "DELETE FROM `baidang` WHERE id='$postId'";
     $result = mysqli_query($connection, $query);
     header('Location: main.php');
   } else {
     header('Location: main.php');
   }
   ?>
