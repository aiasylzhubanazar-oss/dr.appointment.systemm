<?php
require_once 'includes/auth.php';
require_once 'includes/functions.php';
$doctors = require 'includes/data.php';

// $_GET арқылы іздеу және сүзу
$q    = trim($_GET['q'] ?? '');
$spec = trim($_GET['specialty'] ?? '');

$specialties = array_values(array_unique(array_column($doctors, 'spec')));

$result = array_filter($doctors, function ($d) use ($q, $spec) {
    $okName = ($q === '') || mb_stripos($d['name'], $q) !== false;
    $okSpec = ($spec === '') || $d['spec'] === $spec;
    return $okName && $okSpec;
});

$pageTitle = 'Дәрігерлер';
$active = 'doctors.php';
include 'includes/header.php';
?>
<main class="container"><section>
<h1 class="title">Дәрігерлер</h1>
<form class="filters" method="get" action="doctors.php">
  <input name="q" type="search" value="<?= e($q) ?>" placeholder="Дәрігердің аты бойынша іздеу" aria-label="Іздеу">
  <select name="specialty" aria-label="Мамандық">
    <option value="">Барлық мамандық</option>
    <?php foreach ($specialties as $s): ?>
      <option <?= $s === $spec ? 'selected' : '' ?>><?= e($s) ?></option>
    <?php endforeach; ?>
  </select>
  <button class="btn" type="submit">Іздеу</button>
</form>

<?php if (count($result) === 0): ?>
  <p>Дәрігер табылмады. Іздеу сөзін немесе мамандықты өзгертіңіз.</p>
<?php else: ?>
  <p><?= count($result) ?> дәрігер табылды</p>
  <div class="grid">
  <?php foreach ($result as $d): ?>
    <article class="card doctor">
      <div class="avatar" aria-hidden="true"><?= e($d['initials']) ?></div>
      <h3><?= e($d['name']) ?></h3>
      <div class="spec"><?= e($d['spec']) ?></div>
      <p><?= e($d['about']) ?></p>
      <?php if (is_logged_in()): ?><a class="btn ghost" href="profile.php">Жазылу — жақында</a>
      <?php else: ?><a class="btn" href="login.php">Жазылу</a><?php endif; ?>
    </article>
  <?php endforeach; ?>
  </div>
<?php endif; ?>
</section></main>
<?php include 'includes/footer.php'; ?>
