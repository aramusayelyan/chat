<?php

  // Database connection details
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "fizikchat";
  $tablename = "chat";

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);

  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  // Fetch and display all the chat messages from the 'chat' table
  $stmt = $conn->prepare("SELECT * FROM $tablename");
  $stmt->execute();
  $result = $stmt->get_result();

  while ($row = $result->fetch_assoc()) {
    $username = $row['username'];
    $message = $row['message'];
    echo "<div class='message'><strong>$username:</strong> $message</div>";
  }

  $stmt->close();
  $conn->close();
?>
