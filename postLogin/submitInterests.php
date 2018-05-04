<?php

require '../include/connection.php';
require '../include/session.php';
require '../include/interestsObject.php';

$id = $_SESSION['id'];
$interests = new Interests($id);

$tfarray = [];

foreach ($_POST['interestList'] as $key => $value) {
  $tfarray[$value] = true;
}

$interests->changeBoolToBinary();
$interests->arraySetter($tfarray);
$interests->getQuery($conn);
