<?php
require 'connect.php';
session_start();

if(empty($_SESSION['user_name'])){
  header('Location: login.php');
}
 ?>

 <!DOCTYPE html>
 <html>
   <head>
     <meta charset="utf-8">
     <title>View Files</title>
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
            <div class="card card-block">
              <a href="main.php" class="btn btn-secondary">Back</a>
              <hr />
              <h3>Files</h3>
              <hr />
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Size</th>
                    <th>View</th>
                    <th>Delete</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                   $query="SELECT * FROM file";
                   $result = mysqli_query($connection, $query);
                   while ($row = $result->fetch_assoc())
                   {
                    ?>
                          <tr>
                            <td><?php echo $row['file'] ?></td>
                            <td><?php echo $row['type'] ?></td>
                            <td><?php echo $row['size'] ?></td>
                            <td><a href="uploads/<?php echo $row['file'] ?>" target="_blank">View file</a></td>
                            <td><a class="text-danger" onClick="return confirmDelete();" href="deleteFile.php?id=<?php echo $row['id'] ?>">Delete</a></td>
                          </tr>
                    <?php
                   }
                   ?>
                </tbody>
              </table>
            </div>
         </div>
     </div>
     <link rel="import" href="./components/imports.html">
     <script>
       function confirmDelete() {
         return confirm('Are you sure you want to delete this file?');
       }
     </script>
   </body>
 </html>
