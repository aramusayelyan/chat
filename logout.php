<?php
  session_start();

  // Clear session data and redirect to the login page
  session_unset();
  session_destroy();
  header("Location: login.html");
  exit();
?>
