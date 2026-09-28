<?php
require_once __DIR__ . '/config/database.php';
header('Location: ' . (!empty($_SESSION['user_id']) ? '/dashboard.php' : '/login.php'));
exit;
