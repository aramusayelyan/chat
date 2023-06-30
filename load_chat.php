<?php


  // Database connection details
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "fizikchat";

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);

  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  // Retrieve all chat messages from the database
  $sql = "SELECT * FROM chat";
  $result = $conn->query($sql);

  // Generate the chat messages HTML
  $chatHTML = "";
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $username = $row['username'];
      $message = $row['message'];
      $chatHTML .= "<p><strong>$username:</strong> $message</p>";
    }
  }

  $conn->close();

  echo $chatHTML;
?>
