<?php

require '../include/connection.php';
session_start();

$id = $_POST['id'];

$deleteEventSQL = "DELETE FROM EventInfo WHERE eventID_PK = $id;";

$conn->query($deleteEventSQL);
