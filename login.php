<?php
session_start();

// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fizikchat";
$tablename = "users";

// Get the submitted username and password from the login form
$usernameInput = $_POST['username'] ?? '';
$passwordInput = $_POST['password'] ?? '';

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and execute the query to check if the user exists in the 'users' table
$stmt = $conn->prepare("SELECT * FROM $tablename WHERE username = ? AND password = ?");
$stmt->bind_param("ss", $usernameInput, $passwordInput);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    // User exists, set session variables
    $_SESSION['username'] = $usernameInput;
    
    // Redirect to the chat page
    header("Location: chat.php");
    exit();
} else {
    // Invalid login, redirect back to the login page
    header("Location: login.html");
    exit();
}

$stmt->close();
$conn->close();
?>
