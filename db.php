<?php
declare(strict_types=1);

function getDbConnection(): PDO {
    // Retrieve environment variables for DB credentials
    $host = getenv('DB_HOST');
    $db = getenv('DB_NAME');
    $user = getenv('DB_USER');
    $pass = getenv('DB_PASS');
    $charset = 'utf8mb4';

    // Create the DSN (Data Source Name) string
    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";

    // Set PDO options for error handling and fetch mode
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];

    try {
        // Return a new PDO instance for database connection
        return new PDO($dsn, $user, $pass, $options);
    } catch (\PDOException $e) {
        // Handle connection failure by throwing an exception
        throw new \PDOException($e->getMessage(), (int)$e->getCode());
    }
}
