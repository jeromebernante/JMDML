<?php
session_start(); // Start the session if not already started

// Unset all session variables
$_SESSION = [];

// Destroy the session
session_destroy();

// Redirect the user to the login page or home page
header("Location: login.php");
exit();
?>