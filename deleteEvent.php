<?php

$conn = mysqli_connect('localhost', 'root', '', 'loveConnections');
  if ($conn === false) {
    die("Connection failed: " . mysqli_connect_error());
  }
session_start();

$id = $_POST['id'];

$deleteEventSQL = "DELETE FROM EventInfo WHERE eventID_PK = $id;";

$conn->query($deleteEventSQL);
?>
