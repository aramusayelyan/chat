<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fizikchat";
$tablename = "users";

// Get the submitted username and password from the registration form
$usernameInput = $_POST['username'] ?? '';
$passwordInput = $_POST['password'] ?? '';

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and execute the query to insert user data into the 'users' table
$stmt = $conn->prepare("INSERT INTO $tablename (username, password) VALUES (?, ?)");
$stmt->bind_param("ss", $usernameInput, $passwordInput);
$stmt->execute();

$stmt->close();
$conn->close();

header("Location: chat.php");
?>
