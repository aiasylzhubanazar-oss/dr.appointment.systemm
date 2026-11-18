<?php
require_once __DIR__ . '/auth.php';
$pageTitle = $pageTitle ?? 'Басты бет';
$active    = $active ?? '';
function nav_link(string $href, string $text, string $active): string {
    $cur = ($href === $active) ? ' aria-current="page"' : '';
    return '<li><a href="' . $href . '"' . $cur . '>' . $text . '</a></li>';
}
?>
<!DOCTYPE html>
<html lang="kk">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= htmlspecialchars($pageTitle) ?> | Dr.tirkelu</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="css/style.css?v=<?= @filemtime(__DIR__ . '/../css/style.css') ?: 1 ?>">
</head>
<body>
<header><div class="container">
<a class="logo" href="index.php">Dr.<span>tirkelu</span></a>
<button class="burger" aria-label="Мәзір" aria-expanded="false">☰</button>
<nav><ul>
<?= nav_link('index.php', 'Басты бет', $active) ?>
<?= nav_link('doctors.php', 'Дәрігерлер', $active) ?>
<?php if (is_logged_in()): ?>
<?= nav_link('profile.php', 'Профиль: ' . htmlspecialchars($_SESSION['user_name'] ?? ''), $active) ?>
<li><form method="post" action="logout.php"><?= csrf_field() ?><button class="btn" type="submit">Шығу</button></form></li>
<?php else: ?>
<?= nav_link('login.php', 'Кіру', $active) ?>
<li><a class="btn" href="register.php">Тіркелу</a></li>
<?php endif; ?>
</ul></nav>
</div></header>
