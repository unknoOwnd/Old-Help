<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OldHelp - Your AI Companion</title>

    <!-- SEO Meta Tags -->
    <meta name="description" content="<?php echo htmlspecialchars($_SERVER['PROJECT_DESCRIPTION'] ?? 'An AI companion for elderly users.'); ?>">
    <meta name="author" content="OldHelp">
    <meta name="keywords" content="AI assistant, elderly support, computer help">

    <!-- Open Graph / Twitter Meta Tags (Platform Managed) -->
    <meta property="og:title" content="OldHelp - Your AI Companion">
    <meta property="og:description" content="<?php echo htmlspecialchars($_SERVER['PROJECT_DESCRIPTION'] ?? 'An AI companion for elderly users.'); ?>">
    <meta property="og:image" content="<?php echo htmlspecialchars($_SERVER['PROJECT_IMAGE_URL'] ?? ''); ?>">
    <meta name="twitter:card" content="summary_large_image">

    <!-- Bootstrap 5.3 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/custom.css?v=<?php echo time(); ?>">
</head>
<body>

    <header class="hero text-center">
        <div class="container">
            <h1 class="display-4">How can I help you today?</h1>
            <p class="lead">Click one of the buttons below to get started.</p>
        </div>
    </header>

    <main class="container my-5">
        <div class="row g-4">
            <div class="col-md-6 col-lg-4">
                <div class="action-card" data-task="Email">
                    <i class="bi bi-envelope-fill icon"></i>
                    <h3 class="card-title">Email</h3>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="action-card" data-task="Internet">
                    <i class="bi bi-globe icon"></i>
                    <h3 class="card-title">Internet</h3>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="action-card" data-task="Video Call">
                    <i class="bi bi-camera-video-fill icon"></i>
                    <h3 class="card-title">Video Call</h3>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="action-card" data-task="Files">
                    <i class="bi bi-folder-fill icon"></i>
                    <h3 class="card-title">My Files</h3>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="action-card" data-task="Computer Health">
                    <i class="bi bi-heart-pulse-fill icon"></i>
                    <h3 class="card-title">Computer Health</h3>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="action-card" data-task="Live Support">
                    <i class="bi bi-question-circle-fill icon"></i>
                    <h3 class="card-title">Live Support</h3>
                </div>
            </div>
        </div>
    </main>

    <footer class="mt-5 text-center text-muted">
        <p>&copy; <?php echo date("Y"); ?> OldHelp. All rights reserved. | <a href="admin/">Admin</a></p>
    </footer>

    <!-- Toast Container for Notifications -->
    <div class="toast-container"></div>

    <!-- Bootstrap 5.3 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    <script src="assets/js/main.js?v=<?php echo time(); ?>"></script>
</body>
</html>