<?php
require_once __DIR__ . '/config.php';

try {
    $pdo = db();

    // 1. Create migrations table if it doesn't exist
    $pdo->exec("CREATE TABLE IF NOT EXISTS migrations (
        id INT AUTO_INCREMENT PRIMARY KEY,
        migration VARCHAR(255) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=INNODB;");

    // 2. Get all migrations that have been run
    $stmt = $pdo->query("SELECT migration FROM migrations");
    $run_migrations = $stmt->fetchAll(PDO::FETCH_COLUMN);

    // 3. Get all migration files
    $migration_files = glob(__DIR__ . '/migrations/*.sql');
    sort($migration_files);

    // 4. Run new migrations
    foreach ($migration_files as $file) {
        $migration_name = basename($file);
        if (!in_array($migration_name, $run_migrations)) {
            $sql = file_get_contents($file);
            $pdo->exec($sql);

            // Record the migration
            $stmt = $pdo->prepare("INSERT INTO migrations (migration) VALUES (?)");
            $stmt->execute([$migration_name]);

            echo "Migration successful: $migration_name\n";
        }
    }

    echo "All migrations are up to date.\n";

} catch (PDOException $e) {
    die("Migration failed: " . $e->getMessage() . "\n");
}