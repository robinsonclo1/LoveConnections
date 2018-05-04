<?php
  require '../include/connection.php';
  require '../include/session.php';
  require "../include/topnav.php";

  $isOrg = $_SESSION['org'];

if ($isOrg) {
  header("location: ../postLogin/organizationWelcome.php");
} else {
  header("location: ../postLogin/memberWelcome.php");
}
