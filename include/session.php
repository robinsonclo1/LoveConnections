<?php

// Initialize the session
session_start();

// If session variable is not set it will redirect to login page
if (!isset($_SESSION['email']) || empty($_SESSION['email'])) {
  header("location: ../preLogin/homepage.php");
  exit;
} else {
  $isOrg = $_SESSION['org'];
}
