<?php
require 'connect.php';
require('fpdf.php');
session_start();

if(empty($_SESSION['user_name'])){
  header('Location: login.php');
}
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
  $pdf = new FPDF();
  $pdf->AddPage();
  $pdf->SetFont('Arial','',12);
  $pdf->MultiCell(200,10,$content);
  $pdf->Output('I',$title.".pdf",true);
} else {
  header('Location: main.php');
}
 ?>
