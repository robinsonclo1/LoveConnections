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

  $insertEventSQL = "insert into EventInfo (organizationID_FK, eventDate, eventName, eventLocation, numRounds)
	VALUES('" . $_SESSION['id'] . "', '" . $eventDate . "', '" . $eventName . "', '" . $location . "', '" . $numRounds . "' );" ;
	if ($conn->query($insertEventSQL) === TRUE) {
		echo "<h2>Event Added</h2>";
	} else {
		echo "<p>Unfortunately an error occured. Please go back and reenter your information</p>";
	}
	


}
?>