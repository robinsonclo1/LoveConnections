<?php

//Edit Users (changeSettings.php)

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $firstPassword = trim($_POST["newFirstPassword"]);
  $secondPassword = trim($_POST["newSecondPassword"]);

  if (is_null($firstPassword) || is_null($secondPassword)){
      echo "<script type='text/javascript'>alert('Please verify that all values were entered correctly.');</script>";
  } else if ($firstPassword != $secondPassword) {
    echo "<script type='text/javascript'>alert('Please verify that both passwords match.');</script>";
  } else {
    //SQL insert First
    $passwordHash = password_hash($firstPassword, PASSWORD_DEFAULT);
    $id = $_SESSION['id'];
    $insertInfoSQL = "UPDATE MemberInfo set password = '$passwordHash' WHERE memberID_PK = $id;";

    if ($conn->query($insertInfoSQL) === TRUE) {
      echo "<script type='text/javascript'>alert('Password Changed');</script>";
    } else {
      echo "<script type='text/javascript'>alert('An unforseen error arose. The world will explode in 3...2...1...');</script>";
    }

  }
}
