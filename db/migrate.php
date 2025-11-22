<?php
require_once __DIR__ . '/config.php';

$pdo = db();
$sql_file = __DIR__ . '/migrations/001_create_users_table.sql';

if (!file_exists($sql_file)) {
    die("Migration file not found: " . $sql_file);
}

try {
    $sql = file_get_contents($sql_file);
    $pdo->exec($sql);
    echo "Migration successful!\n";
} catch (PDOException $e) {
    die("Migration failed: " . $e->getMessage() . "\n");
}

