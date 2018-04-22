<?php

require '../include/connection.php';
require '../include/session.php';
require '../include/interestsObject.php';

$id = $_SESSION['id'];
$interests = new Interests();
$arr = (array) $interests;

foreach ($arr as $key => $value) {
  echo "{$key} => {$value}<br>";
}

if(isset($_POST['submit'])) {
  if (!empty($_POST['interestList'])) {
    foreach($_POST['interestList'] as $checked) {
      echo $checked;
    }
    var_dump($_POST['interestList']);
  }
  var_dump($_POST['interestList']);

}
foreach($_POST['interestList'] as $checked) {
  // $interests->updateClass($checked);
}
//echo $interests;
?>
