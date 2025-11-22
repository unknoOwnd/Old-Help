<?php
require_once 'auth.php';
$pageTitle = "Add User";
include 'partials/header.php';
require_once __DIR__ . '/../db/config.php';

$name = $email = $password = $password_confirm = '';
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];

    if (empty($name)) {
        $errors['name'] = 'Name is required';
    }

    if (empty($email)) {
        $errors['email'] = 'Email is required';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Invalid email format';
    }

    if (empty($password)) {
        $errors['password'] = 'Password is required';
    }

    if ($password !== $password_confirm) {
        $errors['password_confirm'] = 'Passwords do not match';
    }

    if (empty($errors)) {
        try {
            $pdo = db();
            // Check if email already exists
            $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
            $stmt->execute([$email]);
            if ($stmt->fetch()) {
                $errors['email'] = 'Email already exists';
            } else {
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $sql = "INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, 'user')";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$name, $email, $hashed_password]);

                // Redirect to users list
                header("Location: users.php");
                exit;
            }
        } catch (PDOException $e) {
            // Ideally, log this error
            $errors['db'] = "Database error: " . $e->getMessage();
        }
    }
}
?>

<div class="container-fluid">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Add New User</h1>
    </div>

    <?php if (!empty($errors['db'])): ?>
        <div class="alert alert-danger"><?php echo htmlspecialchars($errors['db']); ?></div>
    <?php endif; ?>

    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control <?php echo !empty($errors['name']) ? 'is-invalid' : ''; ?>" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>">
            <?php if (!empty($errors['name'])): ?>
                <div class="invalid-feedback"><?php echo $errors['name']; ?></div>
            <?php endif; ?>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control <?php echo !empty($errors['email']) ? 'is-invalid' : ''; ?>" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>">
            <?php if (!empty($errors['email'])): ?>
                <div class="invalid-feedback"><?php echo $errors['email']; ?></div>
            <?php endif; ?>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control <?php echo !empty($errors['password']) ? 'is-invalid' : ''; ?>" id="password" name="password">
            <?php if (!empty($errors['password'])): ?>
                <div class="invalid-feedback"><?php echo $errors['password']; ?></div>
            <?php endif; ?>
        </div>
        <div class="mb-3">
            <label for="password_confirm" class="form-label">Confirm Password</label>
            <input type="password" class="form-control <?php echo !empty($errors['password_confirm']) ? 'is-invalid' : ''; ?>" id="password_confirm" name="password_confirm">
            <?php if (!empty($errors['password_confirm'])): ?>
                <div class="invalid-feedback"><?php echo $errors['password_confirm']; ?></div>
            <?php endif; ?>
        </div>
        <button type="submit" class="btn btn-primary">Save User</button>
        <a href="users.php" class="btn btn-secondary">Cancel</a>
    </form>

</div>

<?php include 'partials/footer.php'; ?>
