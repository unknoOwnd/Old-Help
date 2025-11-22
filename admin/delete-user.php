<?php
require_once 'auth.php';
require_once __DIR__ . '/../db/config.php';

// Check if ID is set
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: users.php");
    exit;
}

$id = $_GET['id'];

try {
    $pdo = db();
    $sql = "DELETE FROM users WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);

    // Redirect back to user list
    header("Location: users.php");
    exit;
} catch (PDOException $e) {
    // For a real app, you'd log this error and show a user-friendly message.
    die("Error: Could not delete user. " . $e->getMessage());
}
