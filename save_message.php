<?php
  session_start();

  // Redirect the user to the login page if not logged in
  if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit();
  }

  // Database connection details
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "fizikchat";
  $tablename = "chat";

  // Get the submitted message from the chat page
  $message = $_POST['message'] ?? '';

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);

  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  // Insert the new chat message into the 'chat' table
  $username = $_SESSION['username'];
  $stmt = $conn->prepare("INSERT INTO $tablename (username, message) VALUES (?, ?)");
  $stmt->bind_param("ss", $username, $message);
  $stmt->execute();

  $stmt->close();
  $conn->close();
?>
