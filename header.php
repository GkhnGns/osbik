<?php
require_once 'SettingsManager.php';
$sm = new SettingsManager();
$siteTitle = $sm->get('site_title') ?: 'OSB IK';
$primaryColor = $sm->get('primary_color') ?: '#007bff';
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo htmlspecialchars($siteTitle); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    :root { --primary-color: <?php echo $primaryColor; ?>; }
    .bg-primary, .btn-primary { background-color: var(--primary-color) !important; border-color: var(--primary-color) !important; }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-primary navbar-dark mb-4">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php"><?php echo htmlspecialchars($siteTitle); ?></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="report.php">Reports</a></li>
                <li class="nav-item"><a class="nav-link" href="giris.php">Job Seeker</a></li>
                <li class="nav-item"><a class="nav-link" href="admin.php">Admin</a></li>
            </ul>
        </div>
    </div>
</nav>
<div class="container">
