<?php
require_once 'includes/auth.php';
require_once 'includes/functions.php';
require_once 'includes/db.php';

if (is_logged_in()) { header('Location: profile.php'); exit; }

$errors = [];
$full_name = $phone = $email = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrf_valid()) {
        $errors['form'] = 'Сессия мерзімі өтті. Бетті жаңартып, қайта көріңіз.';
    }
    $full_name = post('full_name');
    $phone     = preg_replace('/[\s()-]/', '', post('phone'));
    $email     = mb_strtolower(post('email'));
    $password  = $_POST['password'] ?? '';
    $password2 = $_POST['password2'] ?? '';

    if (mb_strlen($full_name) < 3 || mb_strlen($full_name) > 100) {
        $errors['full_name'] = 'Аты-жөніңізді толық жазыңыз (3-100 таңба)';
    }
    if (!preg_match('/^\+?\d{10,12}$/', $phone)) {
        $errors['phone'] = 'Телефон нөмірін дұрыс енгізіңіз';
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL) || mb_strlen($email) > 100) {
        $errors['email'] = 'Email дұрыс емес';
    }
    if (strlen($password) < 8) {
        $errors['password'] = 'Құпия сөз кемінде 8 таңба болуы керек';
    }
    if ($password !== $password2) {
        $errors['password2'] = 'Құпия сөздер сәйкес емес';
    }

    if (!$errors) {
        $pdo = db();
        // Email бұрын тіркелген бе?
        $stmt = $pdo->prepare('SELECT id FROM users WHERE email = ?');
        $stmt->execute([$email]);
        if ($stmt->fetch()) {
            $errors['email'] = 'Бұл email бұрын тіркелген';
        } else {
            // Құпия сөзді хэштеп сақтаймыз (ашық түрде ешқашан сақтамаймыз)
            $hash = password_hash($password, PASSWORD_DEFAULT);
            try {
                $stmt = $pdo->prepare('INSERT INTO users (full_name, phone, email, password_hash) VALUES (?, ?, ?, ?)');
                $stmt->execute([$full_name, $phone, $email, $hash]);
                $_SESSION['flash_ok'] = 'Тіркелу сәтті өтті! Енді жүйеге кіріңіз.';
                header('Location: login.php');
                exit;
            } catch (PDOException $e) {
                $errors['form'] = ($e->getCode() === '23000')
                    ? 'Бұл email бұрын тіркелген'
                    : 'Сервер қатесі. Кейінірек қайталап көріңіз.';
            }
        }
    }
}

$pageTitle = 'Тіркелу';
$active = 'register.php';
include 'includes/header.php';
?>
<main class="page-blue"><div class="form-wrap">
<h1>Тіркелу</h1>
<?php if (isset($errors['form'])): ?>
  <div class="alert-error" role="alert"><?= e($errors['form']) ?></div>
<?php endif; ?>
<form class="form" data-validate method="post" action="register.php" novalidate>
  <?= csrf_field() ?>
  <div class="field"><label for="full_name">Аты-жөні</label>
    <input type="text" id="full_name" name="full_name" value="<?= e($full_name) ?>" autocomplete="name" required>
    <div class="error" role="alert"><?= error_html($errors, 'full_name') ?></div></div>
  <div class="field"><label for="phone">Телефон</label>
    <input type="tel" id="phone" name="phone" value="<?= e($phone) ?>" placeholder="+7 700 000 00 00" required>
    <div class="error" role="alert"><?= error_html($errors, 'phone') ?></div></div>
  <div class="field"><label for="email">Email</label>
    <input type="email" id="email" name="email" value="<?= e($email) ?>" autocomplete="email" required>
    <div class="error" role="alert"><?= error_html($errors, 'email') ?></div></div>
  <div class="field"><label for="password">Құпия сөз (кемінде 8 таңба)</label>
    <div class="pw"><input type="password" id="password" name="password" autocomplete="new-password" required><button type="button">Көрсету</button></div>
    <div class="error" role="alert"><?= error_html($errors, 'password') ?></div></div>
  <div class="field"><label for="password2">Құпия сөзді қайталаңыз</label>
    <div class="pw"><input type="password" id="password2" name="password2" autocomplete="new-password" required><button type="button">Көрсету</button></div>
    <div class="error" role="alert"><?= error_html($errors, 'password2') ?></div></div>
  <button class="btn" type="submit">Тіркелу</button>
</form>
<p class="alt">Тіркелгіңіз бар ма? <a href="login.php">Кіру</a></p>
</div></main>
<?php include 'includes/footer.php'; ?>
