<?php
declare(strict_types=1);
session_start();

// Check if the user is logged in by verifying the session
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if not logged in
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
</head>
<body>
    <h1>Welcome, you are logged in!</h1>
    <p>This is a protected page.</p>
    <p><?=htmlspecialchars($_SESSION['username'])?></p>
    <a href="logout.php">Logout</a>
</body>
</html>
