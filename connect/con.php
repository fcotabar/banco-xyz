<?php

$servername = "localhost";
$username = "root";
$password = "root";
$database = "banco-xyz";
$dbport = "8889";

// Create connection
$conn = new mysqli($servername, $username, $password, $database, $dbport);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
?>


