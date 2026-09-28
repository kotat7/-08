<?php
require_once __DIR__ . '/../config/database.php';
require_login();

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name           = trim($_POST['name'] ?? '');
    $contact_person = trim($_POST['contact_person'] ?? '') ?: null;
    $phone          = trim($_POST['phone'] ?? '') ?: null;

    if ($name === '') {
        $error = 'Поле «Название компании» обязательно для заполнения.';
    } else {
        $stmt = $pdo->prepare('INSERT INTO suppliers (name, contact_person, phone, user_id) VALUES (?, ?, ?, ?)');
        $stmt->execute([$name, $contact_person, $phone, $_SESSION['user_id']]);
        header('Location: /suppliers/index.php'); // редирект на список
        exit;
    }
}

$pageTitle = 'Добавление поставщика';
include __DIR__ . '/../includes/header.php';
?>
<div class="row justify-content-center">
  <div class="col-md-6">
    <div class="card shadow-sm"><div class="card-body">
      <h1 class="h4 mb-3">Добавить поставщика</h1>
      <?php if ($error): ?><div class="alert alert-danger"><?= htmlspecialchars($error) ?></div><?php endif; ?>
      <form method="post" data-validate>
        <div class="mb-3">
          <label class="form-label">Название компании *</label>
          <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($_POST['name'] ?? '') ?>" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Контактное лицо</label>
          <input type="text" name="contact_person" class="form-control" value="<?= htmlspecialchars($_POST['contact_person'] ?? '') ?>">
        </div>
        <div class="mb-3">
          <label class="form-label">Телефон</label>
          <input type="tel" name="phone" class="form-control" value="<?= htmlspecialchars($_POST['phone'] ?? '') ?>">
        </div>
        <button type="submit" class="btn btn-dark">Сохранить</button>
        <a href="/suppliers/index.php" class="btn btn-outline-secondary">Отмена</a>
      </form>
    </div></div>
  </div>
</div>
<?php include __DIR__ . '/../includes/footer.php'; ?>
