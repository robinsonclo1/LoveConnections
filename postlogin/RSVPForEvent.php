<?php

require '../include/connection.php';
session_start();

if(isset($_GET['id'])) {
  $memberId = $_SESSION['id'];
  $eventId = $_GET['id'];
  $sql = $conn->prepare("insert into memberEventLink
    (memberID_FK, eventID_FK)
	   VALUES(?, ?)");
  $sql->bind_param("ii", $memberId, $eventId);


	if ($sql->execute() === TRUE) {
    $sql->Close(); 
		echo "<h2>Successfully RSVPed</h2>";
	} else {
		echo "<p>Unfortunately an error occured. Please RSVP again.</p>";
	}
}  else {
  echo "<p>Unfortunately an error occured. </p>";
}
