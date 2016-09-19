<?php
  require 'connect.php';
  if(isset($_POST['btn-upload'])){
    $file = $_FILES['file']['name'];
    $file_loc = $_FILES['file']['tmp_name'];
    $file_size = $_FILES['file']['size'];
    $file_type = $_FILES['file']['type'];
    $folder="uploads/";
    echo("<script>console.log('PHP: ".$file_type."');</script>");
    $allowed = array('application/pdf', 'application/octet-stream', 'text/plain');
    // echo("<script>console.log('PHP: ".$_FILES['file']."');</script>");
    if(in_array($file_type, $allowed) && move_uploaded_file($file_loc,$folder.$file)){
      $query = "INSERT INTO `file` (file, type, size) VALUES ('$file', '$file_type', '$file_size')";
      $result = mysqli_query($connection, $query);
      if($result) {
        ?>
        <script>
          alert('successfully uploaded');
          window.location.href='main.php?success';
        </script>
        <?php
      } else {
        ?>
        <script>
          alert('error while uploading file');
          window.location.href='main.php?fail';
        </script>
        <?php
      }
    } else {
      ?>
      <script>
        alert('error while uploading file');
        window.location.href='main.php?fail';
      </script>
      <?php
    }
  }
 ?>
