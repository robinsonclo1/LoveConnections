<?php

require '../include/connection.php';
session_start();

$memberId = $_POST['memberID'];
$eventId = $_POST['eventID'];

$sql = "INSERT INTO memberEventLink
    (memberID_FK, eventID_FK)
	   VALUES($memberId, $eventId)";

$conn->query($sql);

header("location: ../postLogin/memberWelcome.php?success=1");
