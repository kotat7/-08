<?php
require_once __DIR__ . '/config/database.php';

$error = '';
if (isset($_GET['registered'])) {
    $error = ''; // просто флаг для сообщения ниже
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email    = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    $stmt = $pdo->prepare('SELECT * FROM users WHERE email = ?'); // prepared statement
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password_hash'])) {
        $_SESSION['user_id']   = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        header('Location: /dashboard.php');
        exit;
    }
    $error = 'Неверный email или пароль.';
}

$pageTitle = 'Вход';
include __DIR__ . '/includes/header.php';
?>
<div class="row justify-content-center">
  <div class="col-md-5">
    <div class="card shadow-sm">
      <div class="card-body">
        <h1 class="h4 mb-3">Вход в систему</h1>
        <?php if (isset($_GET['registered'])): ?>
          <div class="alert alert-success">Регистрация успешна! Войдите в систему.</div>
        <?php endif; ?>
        <?php if ($error): ?>
          <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <form method="post" data-validate>
          <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Пароль</label>
            <input type="password" name="password" class="form-control" required>
          </div>
          <button type="submit" class="btn btn-dark w-100">Войти</button>
        </form>
        <p class="mt-3 mb-0 text-center">Нет аккаунта? <a href="/register.php">Зарегистрироваться</a></p>
      </div>
    </div>
  </div>
</div>
<?php include __DIR__ . '/includes/footer.php'; ?>
