<?php
// Initialize session
session_start();

// Clear all session variables
session_unset();

// Destroy the session
session_destroy();

// Redirect to the login page or any other appropriate action after logout
header('Location: login.php'); // Replace 'login.php' with your desired destination
exit();
?>