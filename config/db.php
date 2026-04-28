<?php
try {
    $pdo = new PDO(
        "mysql:host=localhost;dbname=;charset=utf8mb4",
        "root",
        ""
    );
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>