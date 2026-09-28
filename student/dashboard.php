<?php
require_once __DIR__ . '/config/database.php';
require_login(); // неавторизованного перекидывает на /login.php

$stmt = $pdo->prepare('SELECT COUNT(*) AS cnt FROM suppliers WHERE user_id = ?');
$stmt->execute([$_SESSION['user_id']]);
$count = $stmt->fetch()['cnt'];

$pageTitle = 'Личный кабинет';
include __DIR__ . '/includes/header.php';
?>
<div class="row">
  <div class="col-md-8">
    <div class="card shadow-sm">
      <div class="card-body">
        <h1 class="h4">Личный кабинет</h1>
        <p class="mb-1">Здравствуйте, <strong><?= htmlspecialchars($_SESSION['user_name']) ?></strong>!</p>
        <p class="text-muted">Вы — администратор портала сети кофеен «Кофеин».</p>
        <div class="d-flex gap-2">
          <a href="/suppliers/index.php" class="btn btn-dark">Список поставщиков (<?= (int)$count ?>)</a>
          <a href="/suppliers/create.php" class="btn btn-outline-dark">+ Добавить поставщика</a>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include __DIR__ . '/includes/footer.php'; ?>
