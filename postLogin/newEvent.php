<?php

  require '../include/connection.php';
session_start();

if(isset($_POST['eventName'])) {
  $eventName = htmlspecialchars(trim($_POST['eventName'])  ?? '');
  $eventDate = htmlspecialchars(trim($_POST['eventDate'])  ?? '');
  $numRounds = htmlspecialchars(trim($_POST['numRounds'])  ?? '');
  $location  = htmlspecialchars(trim($_POST['eventLocation']) ?? '');
  $id = $_SESSION['id'];

  $insertEventSQL = $conn->prepare("insert into EventInfo
    (memberID_FK, eventDate, eventName, eventLocation, numRounds)
	   VALUES(?, ?, ?, ?, ?)");
  $insertEventSQL->bind_param("isssi", $id, $eventDate, $eventName, $location, $numRounds);


	if ($insertEventSQL->execute() === TRUE) {
		echo "<h2>Event Added</h2>";
	} else {
		echo "<p>Unfortunately an error occured. Please go back and reenter your information</p>";
	}
}
?>
