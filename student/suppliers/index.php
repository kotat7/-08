<?php
require_once __DIR__ . '/../config/database.php';
require_login();

// Только записи ТЕКУЩЕГО пользователя
$stmt = $pdo->prepare('SELECT * FROM suppliers WHERE user_id = ? ORDER BY id DESC');
$stmt->execute([$_SESSION['user_id']]);
$suppliers = $stmt->fetchAll();

$pageTitle = 'Поставщики';
include __DIR__ . '/../includes/header.php';
?>
<div class="d-flex justify-content-between align-items-center mb-3">
  <h1 class="h4 mb-0">Поставщики</h1>
  <a href="/suppliers/create.php" class="btn btn-dark btn-sm">+ Добавить</a>
</div>

<?php if (!$suppliers): ?>
  <div class="alert alert-info">Пока нет ни одного поставщика. <a href="/suppliers/create.php">Добавьте первого</a>.</div>
<?php else: ?>
<div class="card shadow-sm">
  <div class="card-body table-responsive">
    <table class="table table-striped align-middle">
      <thead>
        <tr><th>ID</th><th>Компания</th><th>Контактное лицо</th><th>Телефон</th><th class="text-end">Действия</th></tr>
      </thead>
      <tbody>
        <?php foreach ($suppliers as $s): ?>
        <tr>
          <td><?= (int)$s['id'] ?></td>
          <td><?= htmlspecialchars($s['name']) ?></td>
          <td><?= htmlspecialchars($s['contact_person'] ?? '—') ?></td>
          <td><?= htmlspecialchars($s['phone'] ?? '—') ?></td>
          <td class="text-end">
            <a href="/suppliers/edit.php?id=<?= (int)$s['id'] ?>" class="btn btn-sm btn-outline-primary">Редактировать</a>
            <a href="/suppliers/delete.php?id=<?= (int)$s['id'] ?>" class="btn btn-sm btn-outline-danger"
               data-confirm-delete>Удалить</a>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>
<?php endif; ?>
<?php include __DIR__ . '/../includes/footer.php'; ?>
