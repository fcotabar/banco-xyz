<?php

$servername = "localhost";
$username = "root";
$password = "root";
$database = "banco-xyz";
$dbport = "8889";

// Create connection
$conn = new mysqli($servername, $username, $password, $database, $dbport);


//Check connection
if ($conn->connect_error) {
  die('Connect Error (' . $conn->connect_errno . ') '
          . $conn->connect_error);
}

//Set Charset to UTF8
if (!$conn->set_charset("utf8")) {
  printf("Error loading character set utf8: %s\n", $conn->error);
  exit();
}



?>


