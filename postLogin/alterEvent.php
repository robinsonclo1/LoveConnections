<?php

  require '../include/connection.php';
session_start();

if(isset($_POST['eventName'])) {
  $eventName = trim(htmlspecialchars($_POST['eventName']))  ?? '';
  $eventDate = trim(htmlspecialchars($_POST['eventDate'])) ?? '';
  $numRounds = trim(htmlspecialchars($_POST['numRounds']))  ?? '';
  $location  = trim(htmlspecialchars($_POST['eventLocation'])) ?? '';
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
