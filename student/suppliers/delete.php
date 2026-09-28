<?php
require_once __DIR__ . '/../config/database.php';
require_login();

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    // Удаляем ТОЛЬКО свою запись (проверка по user_id)
    $stmt = $pdo->prepare('DELETE FROM suppliers WHERE id = ? AND user_id = ?');
    $stmt->execute([(int)$_GET['id'], $_SESSION['user_id']]);
}
header('Location: /suppliers/index.php');
exit;
