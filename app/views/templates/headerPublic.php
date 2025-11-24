<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CineCloud</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
            color: #fff;
            min-height: 100vh;
        }
    </style>
</head>
<body>

<?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CineCloud</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-dark text-white">
<nav class="navbar navbar-expand-lg navbar-dark bg-gradient" style="background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold" href="/">CineCloud</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <?php if (isset($_SESSION['auth'])): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Welcome, <?= htmlspecialchars($_SESSION['username']) ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/logout">Logout</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/login/index">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/create/index">Create Account</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
<div class="container py-4">
