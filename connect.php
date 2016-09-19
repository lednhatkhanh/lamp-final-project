<?php
  define('DB_SERVER', 'localhost');
  define('DB_USERNAME', 'admin');
  define('DB_PASSWORD', 'admin');
  define('DB_DATABASE', 'demo');
  $connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
  if (!$connection) {
      die('Database Connection Failed'.mysqli_error($connection));
  }
  $select_db = mysqli_select_db($connection, DB_DATABASE);
  if (!$select_db) {
      die('Database Selection Failed'.mysqli_error($connection));
  }
