<?php

$conn = mysqli_connect('localhost', 'root', '', 'loveConnections');
  if ($conn === false) {
    die("Connection failed: " . mysqli_connect_error());
  }
session_start();

if(isset($_POST['eventName'])) {
  $eventName = trim($_POST['eventName'])  ?? '';
  $eventDate = trim($_POST['eventDate'])  ?? '';
  $numRounds = trim($_POST['numRounds'])  ?? '';
  $location  = trim($_POST['eventLocation']) ?? '';
  $id = $_POST['id'];

  $updateEventSQL = "UPDATE EventInfo set
    eventDate = '$eventDate',
    eventName = '$eventName',
    eventLocation = '$location',
    numRounds = $numRounds
    WHERE eventID_PK = $id;";

	if ($conn->query($updateEventSQL) === TRUE) {
		echo "<script type='text/javascript'>console.log('ignore')</script>";
	} else {
		 die('Invalid query: ' . mysql_error());
	}
} else {
  echo "<script type='text/javascript'>alert('didn'twork);</script>";
}
?>
