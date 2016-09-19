<?php
   include 'connect.php';

   session_start();

   if(empty($_SESSION['user_name']) || empty($_GET['id'])) {
     header('Location: login.php');
   }

   $fileId = $_GET['id'];
   $query = "SELECT * FROM `file` WHERE id='$fileId'";
   $result = mysqli_query($connection, $query);
   $count = mysqli_num_rows($result);
   if ($count == 1) {
     while ($row = $result->fetch_assoc()) {
       $filename = $row['file'];
     }
     $query = "DELETE FROM `file` WHERE id='$fileId'";
     $result = mysqli_query($connection, $query);
     unlink("uploads/".$filename);
   } else {
     ?>
     <script>
      alert('Cant find that file!');
     </script>
     <?php
   }
   header('Location: view.php');
   ?>
