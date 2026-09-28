<?php
// require_login() вызывается на страницах ДО подключения header.php
$currentUserName = $_SESSION['user_name'] ?? 'Гость';
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= htmlspecialchars($pageTitle ?? 'Кофеин.Портал') ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="/dashboard.php">☕ Кофеин.Портал</a>
        <?php if (!empty($_SESSION['user_id'])): ?>
        <div class="d-flex align-items-center text-white">
            <span class="me-3"><?= htmlspecialchars($currentUserName) ?></span>
            <a href="/logout.php" class="btn btn-outline-light btn-sm">Выйти</a>
        </div>
        <?php endif; ?>
    </div>
</nav>
<main class="container py-4">
