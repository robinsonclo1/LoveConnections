<?php

$conn = new mysqli('localhost', 'root', '', 'loveConnections');
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
