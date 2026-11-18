<?php
require_once 'includes/auth.php';
require_once 'includes/functions.php';
require_once 'includes/db.php';

if (is_logged_in()) { header('Location: profile.php'); exit; }

$errors  = [];
$email   = '';
$flashOk  = flash('flash_ok');
$flashErr = flash('flash_error');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrf_valid()) {
        $errors['form'] = 'Сессия мерзімі өтті. Бетті жаңартып, қайта көріңіз.';
    }
    $email    = mb_strtolower(post('email'));
    $password = $_POST['password'] ?? '';

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Email дұрыс емес';
    }
    if ($password === '') {
        $errors['password'] = 'Құпия сөзді енгізіңіз';
    }

    if (!$errors) {
        $stmt = db()->prepare('SELECT id, full_name, password_hash, role FROM users WHERE email = ?');
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password_hash'])) {
            session_regenerate_id(true);   // сессияны ұрлаудан қорғау
            $_SESSION['user_id']   = (int)$user['id'];
            $_SESSION['user_name'] = $user['full_name'];
            $_SESSION['user_role'] = $user['role'];
            header('Location: profile.php');
            exit;
        }
        // Қай жері қате екенін айтпаймыз (қауіпсіздік үшін)
        $errors['form'] = 'Email немесе құпия сөз қате';
    }
}

$pageTitle = 'Кіру';
$active = 'login.php';
include 'includes/header.php';
?>
<main class="page-blue"><div class="form-wrap">
<h1>Жүйеге кіру</h1>
<?php if ($flashOk): ?><div class="success" role="status"><?= e($flashOk) ?></div><?php endif; ?>
<?php if ($flashErr): ?><div class="alert-error" role="alert"><?= e($flashErr) ?></div><?php endif; ?>
<?php if (isset($errors['form'])): ?><div class="alert-error" role="alert"><?= e($errors['form']) ?></div><?php endif; ?>
<form class="form" data-validate method="post" action="login.php" novalidate>
  <?= csrf_field() ?>
  <div class="field"><label for="email">Email</label>
    <input type="email" id="email" name="email" value="<?= e($email) ?>" autocomplete="email" required>
    <div class="error" role="alert"><?= error_html($errors, 'email') ?></div></div>
  <div class="field"><label for="password">Құпия сөз</label>
    <div class="pw"><input type="password" id="password" name="password" autocomplete="current-password" required><button type="button">Көрсету</button></div>
    <div class="error" role="alert"><?= error_html($errors, 'password') ?></div></div>
  <button class="btn" type="submit">Кіру</button>
</form>
<p class="alt">Тіркелмегенсіз бе? <a href="register.php">Тіркелу</a></p>
</div></main>
<?php include 'includes/footer.php'; ?>
