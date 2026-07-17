<?php

$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
$message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);

$host = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "#";

$conn = new mysqli($host, $dbusername, $dbpassword, $dbname);

if ($conn->connect_error) {
  die('Connect Error ('. $conn->connect_errno .') '.$conn->connect_error);
} else {
  $stmt = $conn->prepare("INSERT INTO addyoudatabasenamexampp (name, email, message) VALUES(?, ?, ?)");

  if ($stmt === false) {
    die('Prepare failed: ' . $conn->error);
  }

  $stmt->bind_param("sss", $name, $email, $message);

  if ($stmt->execute()) {
    echo "You have succefully registered";
  } else {
    echo "Error; " . $stmt->error;
  }

  $stmt->close();
  $conn->close();
}
?>