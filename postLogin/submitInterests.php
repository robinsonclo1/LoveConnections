<?php
require '../include/interestsObject.php';
require '../include/session.php';
require '../include/connection.php';

$interests = $_SESSION['interests'];

$tfarray = [];

foreach ($_POST['interestList'] as $key => $value) {
  array_push($tfarray, $value);
}

$interests->modifyArray($tfarray);
$interests->insertUpdateQuery($conn);
header("location: ../postLogin/personalityProfile.php?success=1");
