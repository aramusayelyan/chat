<!DOCTYPE html>
<html>
<head>
    <title>Զրուցարան</title>
    <link rel="stylesheet" href="styles.css">
   
</head>
<body>
    <div class="container">
      <div class="con">
         <h1>Չատ</h1>

        <!-- Logout button -->
        <form  method="POST" action="logout.php">
            <button  class="logout-button" type="submit">Դուրս Գալ</button>
        </form>
      </div>
       
        
        <div class="chat-window">
            <?php
            session_start();

            // Check if the user is logged in
            if (!isset($_SESSION['username'])) {
                header("Location: login.html");
                exit();
            }

            // Database connection details
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "fizikchat";
            $tablename = "messages";

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Check if the form is submitted
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Get the submitted message
                $message = $_POST['message'] ?? '';

                // Prepare and execute the query to insert the message into the 'messages' table
                $stmt = $conn->prepare("INSERT INTO $tablename (username, message) VALUES (?, ?)");
                $stmt->bind_param("ss", $_SESSION['username'], $message);
                $stmt->execute();

                $stmt->close();
            }

            // Retrieve all messages from the 'messages' table
            $query = "SELECT * FROM $tablename ORDER BY id ASC";
            $result = $conn->query($query);

            // Display the chat messages
            while ($row = $result->fetch_assoc()) {
                echo "<div class='message'>";
                echo "<div class='username'>" . $row['username'] . "</div>";
                echo "<div class='content'>" . $row['message'] . "</div>";
                echo "</div>";
            }

            $conn->close();
            ?>
        </div>
        
        <div class="form-container">
            <form method="POST" action="chat.php">
                <input type="text" name="message" placeholder="Գրեք ձեր հաղորթագրությունը..." required>
                <button type="submit">Ուղարկել</button>
            </form>
        </div>
    </div>
</body>
</html>