<?php
// Initialize the session
session_start();

// If session variable is not set it will redirect to login page
if(!isset($_SESSION['email']) || empty($_SESSION['email'])){
  header("location: homepage.php");
  exit;
}

$conn = mysqli_connect('localhost', 'root', '', 'loveConnections');
if ($conn === false) {
  die("Connection failed: " . mysqli_connect_error());
}

require "topnav.php";
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Match Members (WIP)</title>
  </head>

  <body>
    <h1>Match Members (WIP)</h1>
  </body>
</html>
