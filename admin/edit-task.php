<?php
require_once 'auth.php';
$pageTitle = "Edit Task";
include 'partials/header.php';
require_once __DIR__ . '/../db/config.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    header("Location: tasks.php");
    exit;
}

$pdo = db();
$title = $icon = $description = $status = '';
$errors = [];

// Fetch task data for the form
$stmt = $pdo->prepare("SELECT * FROM tasks WHERE id = ?");
$stmt->execute([$id]);
$task = $stmt->fetch();

if (!$task) {
    // Optional: Add a flash message here
    header("Location: tasks.php");
    exit;
}

$title = $task['title'];
$icon = $task['icon'];
$description = $task['description'];
$status = $task['status'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = trim($_POST['title']);
    $icon = trim($_POST['icon']);
    $description = trim($_POST['description']);
    $status = trim($_POST['status']);

    if (empty($title)) {
        $errors['title'] = 'Title is required';
    }

    if (empty($icon)) {
        $errors['icon'] = 'Icon is required';
    }

    if (empty($errors)) {
        try {
            $sql = "UPDATE tasks SET title = ?, icon = ?, description = ?, status = ? WHERE id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$title, $icon, $description, $status, $id]);

            header("Location: tasks.php");
            exit;
        } catch (PDOException $e) {
            $errors['db'] = "Database error: " . $e->getMessage();
        }
    }
}
?>

<div class="container-fluid">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit Task</h1>
    </div>

    <?php if (!empty($errors['db'])): ?>
        <div class="alert alert-danger"><?php echo htmlspecialchars($errors['db']); ?></div>
    <?php endif; ?>

    <form method="POST" action="edit-task.php?id=<?php echo htmlspecialchars($id); ?>">
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control <?php echo !empty($errors['title']) ? 'is-invalid' : ''; ?>" id="title" name="title" value="<?php echo htmlspecialchars($title); ?>">
            <?php if (!empty($errors['title'])): ?>
                <div class="invalid-feedback"><?php echo $errors['title']; ?></div>
            <?php endif; ?>
        </div>
        <div class="mb-3">
            <label for="icon" class="form-label">Icon</label>
            <input type="text" class="form-control <?php echo !empty($errors['icon']) ? 'is-invalid' : ''; ?>" id="icon" name="icon" value="<?php echo htmlspecialchars($icon); ?>">
            <?php if (!empty($errors['icon'])): ?>
                <div class="invalid-feedback"><?php echo $errors['icon']; ?></div>
            <?php endif; ?>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3"><?php echo htmlspecialchars($description); ?></textarea>
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-control" id="status" name="status">
                <option value="pending" <?php echo ($status == 'pending') ? 'selected' : ''; ?>>Pending</option>
                <option value="in_progress" <?php echo ($status == 'in_progress') ? 'selected' : ''; ?>>In Progress</option>
                <option value="completed" <?php echo ($status == 'completed') ? 'selected' : ''; ?>>Completed</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update Task</button>
        <a href="tasks.php" class="btn btn-secondary">Cancel</a>
    </form>

</div>

<?php include 'partials/footer.php'; ?>