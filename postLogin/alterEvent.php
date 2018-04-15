<?php

  require '../include/connection.php';
session_start();

if(isset($_POST['eventName'])) {
  $eventName = trim(htmlspecialchars($_POST['eventName']))  ?? '';
  $eventDate = trim(htmlspecialchars($_POST['eventDate'])) ?? '';
  $numRounds = trim(htmlspecialchars($_POST['numRounds']))  ?? '';
  $location  = trim(htmlspecialchars($_POST['eventLocation'])) ?? '';
  $id = $_POST['id'];

  $updateEventSQL = $conn->prepare("UPDATE EventInfo set
    eventDate = ?,
    eventName = ?,
    eventLocation = ?,
    numRounds = ?
    WHERE eventID_PK = $id;");
  $updateEventSQL->bind_param("sssi", $eventDate, $eventName, $location, $numRounds);

	if ($updateEventSQL->execute() === TRUE) {
    $updateEventSQL->close();
	} else {
		 die('Invalid query: ' . mysql_error());
	}
} else {
  echo "<script type='text/javascript'>alert('didn't work);</script>";
}
?>
