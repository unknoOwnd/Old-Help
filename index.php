<?php
$pageTitle = "Request Help";
include 'partials/header.php';
require_once __DIR__ . '/db/config.php';

$pdo = db();
$stmt = $pdo->query('SELECT id, title, description, icon FROM tasks WHERE status = \'pending\' ORDER BY id DESC');
$tasks = $stmt->fetchAll();
?>

<div class="hero text-center">
    <h1 class="display-4">How can we help you today?</h1>
    <p class="lead">Select a task from the options below to get started.</p>
</div>

<div class="container mt-5">
    <div class="row g-4">
        <?php foreach ($tasks as $task): ?>
            <div class="col-lg-4 col-md-6">
                <div class="action-card h-100">
                    <i data-feather="<?php echo htmlspecialchars($task['icon']); ?>" class="icon"></i>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($task['title']); ?></h5>
                        <p class="card-text"><?php echo htmlspecialchars($task['description']); ?></p>
                        <a href="#" class="btn btn-primary">Request Help</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php include 'partials/footer.php'; ?>