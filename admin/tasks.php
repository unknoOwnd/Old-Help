<?php
require_once 'auth.php';
$pageTitle = "Task Management";
include 'partials/header.php';
require_once __DIR__ . '/../db/config.php';

$pdo = db();

// Search and filter logic
$search = $_GET['search'] ?? '';
$status = $_GET['status'] ?? '';

$sql = 'SELECT id, title, icon, description, status FROM tasks';
$params = [];
$whereClauses = [];

if ($search) {
    $whereClauses[] = '(title LIKE ? OR description LIKE ?)';
    $params[] = '%' . $search . '%';
    $params[] = '%' . $search . '%';
}

if ($status) {
    $whereClauses[] = 'status = ?';
    $params[] = $status;
}

if (!empty($whereClauses)) {
    $sql .= ' WHERE ' . implode(' AND ', $whereClauses);
}

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$tasks = $stmt->fetchAll();
?>

<div class="container-fluid">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Task Management</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="add-task.php" class="btn btn-sm btn-outline-secondary">
                <span data-feather="plus-circle"></span>
                Add Task
            </a>
        </div>
    </div>

    <!-- Search and filter form -->
    <form method="GET" action="tasks.php" class="mb-3">
        <div class="row g-2">
            <div class="col-md-6">
                <input type="text" name="search" class="form-control" placeholder="Search by title or description..." value="<?php echo htmlspecialchars($search); ?>">
            </div>
            <div class="col-md-4">
                <select name="status" class="form-select">
                    <option value="">All Statuses</option>
                    <option value="pending" <?php echo ($status == 'pending') ? 'selected' : ''; ?>>Pending</option>
                    <option value="in_progress" <?php echo ($status == 'in_progress') ? 'selected' : ''; ?>>In Progress</option>
                    <option value="completed" <?php echo ($status == 'completed') ? 'selected' : ''; ?>>Completed</option>
                </select>
            </div>
            <div class="col-md-2">
                <button class="btn btn-primary w-100" type="submit">Filter</button>
            </div>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Icon</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($tasks)): ?>
                    <tr>
                        <td colspan="6" class="text-center">No tasks found.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($tasks as $task): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($task['id']); ?></td>
                        <td><?php echo htmlspecialchars($task['title']); ?></td>
                        <td><i data-feather="<?php echo htmlspecialchars($task['icon']); ?>"></i></td>
                        <td><?php echo htmlspecialchars($task['description']); ?></td>
                        <td><?php echo htmlspecialchars($task['status']); ?></td>
                        <td>
                            <a href="edit-task.php?id=<?php echo $task['id']; ?>" class="btn btn-sm btn-outline-secondary">Edit</a>
                            <a href="delete-task.php?id=<?php echo $task['id']; ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this task?');">Delete</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'partials/footer.php'; ?>