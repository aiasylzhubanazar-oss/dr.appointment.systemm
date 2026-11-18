<?php
require_once 'includes/auth.php';
require_once 'includes/functions.php';
require_once 'includes/db.php';

require_login();   // жабық бет: кірмеген адам login.php-ге бағытталады

$stmt = db()->prepare('SELECT full_name, phone, email, role, created_at FROM users WHERE id = ?');
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();

if (!$user) {   // пайдаланушы дерекқордан өшірілген болса
    session_destroy();
    header('Location: login.php');
    exit;
}

$pageTitle = 'Профиль';
$active = 'profile.php';
include 'includes/header.php';
?>
<main class="container"><section>
<h1 class="title">Менің профилім</h1>
<div class="card profile">
  <div class="avatar" aria-hidden="true"><?= e(mb_strtoupper(mb_substr($user['full_name'], 0, 1))) ?></div>
  <dl class="profile-list">
    <dt>Аты-жөні</dt><dd><?= e($user['full_name']) ?></dd>
    <dt>Email</dt><dd><?= e($user['email']) ?></dd>
    <dt>Телефон</dt><dd><?= e($user['phone']) ?></dd>
    <dt>Рөлі</dt><dd><?= $user['role'] === 'admin' ? 'Әкімші' : 'Пациент' ?></dd>
    <dt>Тіркелген күні</dt><dd><?= e(date('d.m.Y', strtotime($user['created_at']))) ?></dd>
  </dl>
  <a class="btn" href="doctors.php">Дәрігерді табу</a>
</div>
</section></main>
<?php include 'includes/footer.php'; ?>
