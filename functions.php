<?php
declare(strict_types=1);
require_once 'db.php';

function verifyReCaptcha(string $recaptchaResponse): bool {
    $secret = getenv('RECAPTCHA_SECRET_KEY');
    $verifyResponse = file_get_contents(
        'https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $recaptchaResponse
    );
    $responseData = json_decode($verifyResponse);
    return $responseData->success;
}

function login(string $username, string $password): bool {
    $pdo = getDbConnection();
    //Using placeholders helps prevent SQL injection attacks, as the input is treated as data rather than executable code. 
    //This method prevents SQL injection because the user input is not directly concatenated into the query.
    $stmt = $pdo->prepare('SELECT * FROM users WHERE username = :username');
    $stmt->execute(['username' => $username]);
    $user = $stmt->fetch();
    //password_verify() function safely compares the two values, ensuring that the password is validated without exposing the actual password.
    if ($user && password_verify($password, $user['password'])) {
        // Store the user ID in the session to track login status
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        return true;
    }
    return false;
}
